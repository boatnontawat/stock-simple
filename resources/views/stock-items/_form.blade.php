<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
    <div class="md:col-span-2">
        <label class="block text-sm text-gray-600 mb-1">ชื่อรายการ <span class="text-red-500">*</span></label>
        <input type="text" name="name" value="{{ old('name', $stockItem->name ?? '') }}" required
               class="w-full rounded-lg border-gray-300 text-sm">
        @error('name') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
    </div>

    <div>
        <label class="block text-sm text-gray-600 mb-1">หน่วย</label>
        <input type="text" name="unit" value="{{ old('unit', $stockItem->unit ?? '') }}"
               placeholder="เช่น ชิ้น, กล่อง, ขวด" class="w-full rounded-lg border-gray-300 text-sm">
    </div>

    <div>
        <label class="block text-sm text-gray-600 mb-1">ราคาต่อหน่วย <span class="text-red-500">*</span></label>
        <input type="number" step="0.01" min="0" name="price" value="{{ old('price', $stockItem->price ?? '') }}"
               required class="w-full rounded-lg border-gray-300 text-sm">
        @error('price') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
    </div>

    <div>
        <label class="block text-sm text-gray-600 mb-1">จำนวนที่มีทั้งหมด (stock) <span class="text-red-500">*</span></label>
        <input type="number" step="0.01" min="0" name="stock_qty" value="{{ old('stock_qty', $stockItem->stock_qty ?? '') }}"
               required class="w-full rounded-lg border-gray-300 text-sm">
        @error('stock_qty') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
    </div>

    <div>
        <label class="block text-sm text-gray-600 mb-1">จำนวนที่ใช้ไปแล้ว <span class="text-red-500">*</span></label>
        <input type="number" step="0.01" min="0" name="used_qty" value="{{ old('used_qty', $stockItem->used_qty ?? 0) }}"
               required class="w-full rounded-lg border-gray-300 text-sm">
        @error('used_qty') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
    </div>

    <div>
        <label class="block text-sm text-gray-600 mb-1">ผู้เช็คสต๊อก</label>
        <input type="text" name="checked_by" value="{{ old('checked_by', $stockItem->checked_by ?? '') }}"
               placeholder="ชื่อผู้เช็ค" class="w-full rounded-lg border-gray-300 text-sm">
    </div>

    <div>
        <label class="block text-sm text-gray-600 mb-1">วันที่เช็คล่าสุด</label>
        <input type="date" name="checked_at"
               value="{{ old('checked_at', optional($stockItem->checked_at ?? null)->format('Y-m-d')) }}"
               class="w-full rounded-lg border-gray-300 text-sm">
    </div>
</div>

@if (isset($stockItem))
    <div class="mt-4 p-3 rounded-lg bg-gray-50 text-sm text-gray-600">
        คงเหลือปัจจุบัน:
        <span class="font-medium text-gray-800">{{ number_format($stockItem->remaining_qty, 2) }}</span>
        ({{ $stockItem->remaining_percent }}%)
    </div>
@endif

<div class="mt-6 flex gap-3">
    <button type="submit" class="bg-slate-900 text-white text-sm px-5 py-2 rounded-lg">บันทึก</button>
    <a href="{{ route('stock-items.index') }}" class="text-sm text-gray-600 px-5 py-2">ยกเลิก</a>
</div>
