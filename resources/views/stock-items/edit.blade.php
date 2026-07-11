@extends('layouts.app')

@section('title', 'แก้ไขรายการ')

@section('content')
<div class="bg-white rounded-xl border p-6 max-w-2xl">
    <h2 class="font-medium mb-4">แก้ไขรายการ</h2>
    <form action="{{ route('stock-items.update', $stockItem) }}" method="POST">
        @csrf
        @method('PUT')
        @include('stock-items._form')
    </form>
</div>
@endsection
