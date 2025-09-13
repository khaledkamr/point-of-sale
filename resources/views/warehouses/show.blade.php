@extends('layouts.app')

@section('title', 'تفاصيل المستودع')

@section('content')
    <div class="bg-white p-6 rounded-lg shadow-md">
        <h1 class="text-2xl font-bold mb-4">المستودع: {{ $warehouse->name }}</h1>
        <div class="space-y-2">
            <p><strong>الرقم:</strong> {{ $warehouse->id }}</p>
            <p><strong>الموقع:</strong> {{ $warehouse->location }}</p>
        </div>
        <div class="mt-4 flex space-x-2 space-x-reverse">
            <a href="{{ route('warehouses.edit', $warehouse) }}" class="bg-yellow-600 text-white px-4 py-2 rounded hover:bg-yellow-700">تعديل</a>
            <a href="{{ route('warehouses.index') }}" class="bg-gray-600 text-white px-4 py-2 rounded hover:bg-gray-700">رجوع</a>
        </div>
    </div>
@endsection