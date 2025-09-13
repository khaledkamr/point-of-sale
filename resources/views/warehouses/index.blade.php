@extends('layouts.app')

@section('title', 'المستودعات')

@section('content')
    <div class="bg-white p-6 rounded-lg shadow-md">
        <div class="flex justify-between items-center mb-4">
            <h1 class="text-2xl font-bold">المستودعات</h1>
            <a href="{{ route('warehouses.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">إضافة مستودع جديد</a>
        </div>
        <table class="w-full border-collapse">
            <thead>
                <tr class="bg-gray-200">
                    <th class="p-3 text-right">الرقم</th>
                    <th class="p-3 text-right">الاسم</th>
                    <th class="p-3 text-right">الموقع</th>
                    <th class="p-3 text-right">الإجراءات</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($warehouses as $warehouse)
                    <tr class="border-b">
                        <td class="p-3">{{ $warehouse->id }}</td>
                        <td class="p-3">{{ $warehouse->name }}</td>
                        <td class="p-3">{{ $warehouse->location }}</td>
                        <td class="p-3 flex space-x-2 space-x-reverse">
                            <a href="{{ route('warehouses.show', $warehouse) }}" class="text-blue-600 hover:underline">عرض</a>
                            <a href="{{ route('warehouses.edit', $warehouse) }}" class="text-yellow-600 hover:underline">تعديل</a>
                            <form action="{{ route('warehouses.destroy', $warehouse) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:underline" onclick="return confirm('هل أنت متأكد؟')">حذف</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection