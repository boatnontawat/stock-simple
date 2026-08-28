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

    /**
     * บันทึกการใช้สินค้า (auto): กรอกแค่ "ใช้ไปเท่าไหร่ตอนนี้"
     * ระบบจะบวกเพิ่มเข้า used_qty ให้เอง เช่น มี 500 ใช้ 100 -> เหลือ 400
     * ครั้งถัดไปใช้อีก 100 -> เหลือ 300 โดยไม่ต้องคำนวณเอง
     */
    public function recordUsage(Request $request, StockItem $stockItem)
    {
        $validated = $request->validate([
            'use_qty' => ['required', 'numeric', 'gt:0'],
        ], [
            'use_qty.required' => 'กรุณากรอกจำนวนที่ใช้',
            'use_qty.numeric' => 'กรุณากรอกตัวเลข',
            'use_qty.gt' => 'จำนวนที่ใช้ต้องมากกว่า 0',
        ]);

        $useQty = (float) $validated['use_qty'];

        if ($useQty > $stockItem->remaining_qty) {
            return back()
                ->withErrors(['use_qty' => 'จำนวนที่ใช้ (' . number_format($useQty, 2) . ') มากกว่าคงเหลือ (' . number_format($stockItem->remaining_qty, 2) . ')'])
                ->withFragment('use-form');
        }

        $stockItem->used_qty = (float) $stockItem->used_qty + $useQty;
        $stockItem->save();

        return back()->with('success', "บันทึกการใช้ {$stockItem->name} จำนวน " . number_format($useQty, 2) . ' แล้ว คงเหลือ ' . number_format($stockItem->remaining_qty, 2));
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
