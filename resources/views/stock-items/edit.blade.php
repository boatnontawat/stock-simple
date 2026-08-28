@extends('layouts.app')

@section('title', 'แก้ไขรายการ')

@section('content')
<div class="max-w-2xl space-y-4">

    {{-- การ์ดสรุป + บันทึกการใช้ (ทำบ่อยสุด เลยขึ้นก่อน) --}}
    <div id="use-form" class="bg-white rounded-xl border p-6">
        <div class="flex items-start justify-between gap-4 flex-wrap mb-4">
            <div>
                <h2 class="font-medium">{{ $stockItem->name }}</h2>
                @if ($stockItem->unit)
                    <div class="text-xs text-gray-400">หน่วย: {{ $stockItem->unit }}</div>
                @endif
            </div>
            @php
                $percent = $stockItem->remaining_percent;
                $textColor = $percent <= 20 ? 'text-red-600' : ($percent <= 50 ? 'text-amber-600' : 'text-green-600');
            @endphp
            <div class="text-right">
                <div class="text-xs text-gray-400">คงเหลือ</div>
                <div class="text-2xl font-semibold {{ $textColor }}">{{ number_format($stockItem->remaining_qty, 2) }}</div>
                <div class="text-xs {{ $textColor }}">{{ $percent }}% จาก {{ number_format($stockItem->stock_qty, 2) }}</div>
            </div>
        </div>

        <form action="{{ route('stock-items.use', $stockItem) }}" method="POST" class="flex items-end gap-3 flex-wrap">
            @csrf
            <div class="flex-1 min-w-[160px]">
                <label class="block text-sm text-gray-600 mb-1">ใช้ไปเท่าไหร่ตอนนี้?</label>
                <input type="number" step="0.01" min="0.01" name="use_qty" required autofocus
                       placeholder="เช่น 100"
                       class="w-full rounded-lg border-gray-300 text-lg">
            </div>
            <button type="submit" class="bg-slate-900 text-white text-sm px-6 py-2.5 rounded-lg whitespace-nowrap">
                บันทึกการใช้
            </button>
        </form>
        <p class="text-xs text-gray-400 mt-2">
            ระบบจะหักออกจากคงเหลือให้อัตโนมัติ เช่น มี 500 ใช้ 100 → เหลือ 400 ครั้งถัดไปใช้อีก 100 → เหลือ 300
        </p>
    </div>

    {{-- แก้ไขข้อมูลสินค้า --}}
    <details class="bg-white rounded-xl border p-6" {{ $errors->has('name') || $errors->has('price') || $errors->has('stock_qty') || $errors->has('used_qty') ? 'open' : '' }}>
        <summary class="font-medium cursor-pointer select-none">แก้ไขข้อมูลสินค้า / แก้ไขยอดด้วยตนเอง</summary>
        <div class="mt-4">
            <form action="{{ route('stock-items.update', $stockItem) }}" method="POST">
                @csrf
                @method('PUT')
                @include('stock-items._form')
            </form>
        </div>
    </details>

    <a href="{{ route('stock-items.index') }}" class="inline-block text-sm text-gray-600">&larr; กลับไปหน้ารายการ</a>
</div>
@endsection
