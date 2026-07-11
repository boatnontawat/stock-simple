@extends('layouts.app')

@section('title', 'รายการคลังเวชภัณฑ์')

@section('content')
<div class="flex items-center justify-between mb-4 gap-3 flex-wrap">
    <form method="GET" class="flex-1 max-w-sm">
        <input type="text" name="q" value="{{ request('q') }}" placeholder="ค้นหารายการ..."
               class="w-full rounded-lg border-gray-300 text-sm">
    </form>
    <a href="{{ route('stock-items.create') }}" class="bg-slate-900 text-white text-sm px-4 py-2 rounded-lg whitespace-nowrap">
        + เพิ่มรายการ
    </a>
</div>

<div class="bg-white rounded-xl border overflow-x-auto">
    <table class="w-full text-sm min-w-[720px]">
        <thead>
            <tr class="text-left text-gray-500 border-b bg-gray-50">
                <th class="p-3">รายการ</th>
                <th class="p-3 text-right">ราคา/หน่วย</th>
                <th class="p-3 text-right">มีทั้งหมด</th>
                <th class="p-3 text-right">ใช้ไป</th>
                <th class="p-3 text-right">คงเหลือ</th>
                <th class="p-3">คงเหลือ %</th>
                <th class="p-3">ผู้เช็คล่าสุด</th>
                <th class="p-3"></th>
            </tr>
        </thead>
        <tbody>
            @forelse ($stockItems as $item)
                @php
                    $percent = $item->remaining_percent;
                    $barColor = $percent <= 20 ? 'bg-red-500' : ($percent <= 50 ? 'bg-amber-500' : 'bg-green-500');
                    $textColor = $percent <= 20 ? 'text-red-600' : ($percent <= 50 ? 'text-amber-600' : 'text-green-600');
                @endphp
                <tr class="border-b last:border-0">
                    <td class="p-3">
                        <div class="font-medium">{{ $item->name }}</div>
                        @if ($item->unit)
                            <div class="text-xs text-gray-400">หน่วย: {{ $item->unit }}</div>
                        @endif
                    </td>
                    <td class="p-3 text-right">{{ number_format($item->price, 2) }}</td>
                    <td class="p-3 text-right">{{ number_format($item->stock_qty, 2) }}</td>
                    <td class="p-3 text-right">{{ number_format($item->used_qty, 2) }}</td>
                    <td class="p-3 text-right font-medium">{{ number_format($item->remaining_qty, 2) }}</td>
                    <td class="p-3 w-40">
                        <div class="flex items-center gap-2">
                            <div class="flex-1 h-2 rounded-full bg-gray-100 overflow-hidden">
                                <div class="h-full {{ $barColor }}" style="width: {{ min(100, max(0, $percent)) }}%"></div>
                            </div>
                            <span class="text-xs {{ $textColor }} font-medium w-10 text-right">{{ $percent }}%</span>
                        </div>
                    </td>
                    <td class="p-3 text-gray-500">
                        {{ $item->checked_by ?? '-' }}
                        @if ($item->checked_at)
                            <div class="text-xs text-gray-400">{{ $item->checked_at->format('d/m/Y') }}</div>
                        @endif
                    </td>
                    <td class="p-3 text-right space-x-2 whitespace-nowrap">
                        <a href="{{ route('stock-items.edit', $item) }}" class="text-blue-600">แก้ไข</a>
                        <form action="{{ route('stock-items.destroy', $item) }}" method="POST" class="inline"
                              onsubmit="return confirm('ยืนยันการลบ?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600">ลบ</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" class="p-8 text-center text-gray-400">ยังไม่มีรายการ เริ่มเพิ่มรายการแรกได้เลย</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="mt-4">{{ $stockItems->links() }}</div>
@endsection
