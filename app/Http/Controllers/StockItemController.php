<?php

namespace App\Http\Controllers;

use App\Models\StockItem;
use Illuminate\Http\Request;

class StockItemController extends Controller
{
    public function index(Request $request)
    {
        $stockItems = StockItem::when($request->q, function ($query) use ($request) {
                $query->where('name', 'like', "%{$request->q}%");
            })
            ->orderBy('name')
            ->paginate(20)
            ->withQueryString();

        return view('stock-items.index', compact('stockItems'));
    }

    public function create()
    {
        return view('stock-items.create');
    }

    public function store(Request $request)
    {
        $validated = $this->validated($request);

        StockItem::create($validated);

        return redirect()->route('stock-items.index')->with('success', 'เพิ่มรายการเรียบร้อยแล้ว');
    }

    public function edit(StockItem $stockItem)
    {
        return view('stock-items.edit', compact('stockItem'));
    }

    public function update(Request $request, StockItem $stockItem)
    {
        $validated = $this->validated($request);

        $stockItem->update($validated);

        return redirect()->route('stock-items.index')->with('success', 'บันทึกการแก้ไขเรียบร้อยแล้ว');
    }

    public function destroy(StockItem $stockItem)
    {
        $stockItem->delete();

        return back()->with('success', 'ลบรายการเรียบร้อยแล้ว');
    }

    private function validated(Request $request): array
    {
        return $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'unit' => ['nullable', 'string', 'max:30'],
            'price' => ['required', 'numeric', 'min:0'],
            'stock_qty' => ['required', 'numeric', 'min:0'],
            // ใช้ไปต้องไม่เกินจำนวนที่มี กันยอดคงเหลือติดลบ
            'used_qty' => ['required', 'numeric', 'min:0', 'lte:stock_qty'],
            'checked_by' => ['nullable', 'string', 'max:255'],
            'checked_at' => ['nullable', 'date'],
        ]);
    }
}
