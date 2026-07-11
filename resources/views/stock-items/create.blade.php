@extends('layouts.app')

@section('title', 'เพิ่มรายการ')

@section('content')
<div class="bg-white rounded-xl border p-6 max-w-2xl">
    <h2 class="font-medium mb-4">เพิ่มรายการใหม่</h2>
    <form action="{{ route('stock-items.store') }}" method="POST">
        @csrf
        @include('stock-items._form')
    </form>
</div>
@endsection
