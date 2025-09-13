@extends('layouts.app')

@section('title', 'تعديل مستودع')

@section('content')
    <div class="bg-white p-6 rounded-lg shadow-md">
        <h1 class="text-2xl font-bold mb-4">تعديل مستودع</h1>
        <form action="{{ route('warehouses.update', $warehouse) }}" method="POST" class="space-y-4">
            @csrf
            @method('PUT')
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700">الاسم</label>
                <input type="text" name="name" id="name" value="{{ $warehouse->name }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 text-right" required>
                @error('name')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <label for="location" class="block text-sm font-medium text-gray-700">الموقع</label>
                <input type="text" name="location" id="location" value="{{ $warehouse->location }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 text-right">
                @error('location')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div class="flex space-x-2 space-x-reverse">
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">تحديث</button>
                <a href="{{ route('warehouses.index') }}" class="bg-gray-600 text-white px-4 py-2 rounded hover:bg-gray-700">رجوع</a>
            </div>
        </form>
    </div>
@endsection