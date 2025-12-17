@extends('layouts.app')

@section('title', 'المستودعات')

@section('content')
    <div class="p-6">
        <h1 class="text-3xl font-bold text-gray-800 flex items-center mb-6">
            <i class="fas fa-box ml-3 text-orange-500"></i>
            المنتجــــات
        </h1>
        <div class="bg-white p-6 rounded-lg shadow-md">
            <!-- Header -->
            <div class="flex justify-between items-center gap-8 mb-6">
                <form class="flex-1">
                    <div class="flex">
                        <label for="search-dropdown" class="mb-2 text-sm font-medium text-gray-900 sr-only">Your Email</label>
                        <button id="dropdown-button" data-dropdown-toggle="dropdown"
                            class="shrink-0 inline-flex items-center py-2.5 px-4 text-sm font-medium text-center text-gray-900 bg-gray-100 border border-gray-300 rounded-s-lg hover:bg-gray-200 focus:ring-4 focus:outline-none focus:ring-gray-100"
                            type="button">
                            كل المخازن
                            <svg class="w-2.5 h-2.5 ms-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                fill="none" viewBox="0 0 10 6">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="m1 1 4 4 4-4" />
                            </svg>
                        </button>
                        <div id="dropdown" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow-sm w-44">
                            <ul class="py-2 text-sm text-gray-700" aria-labelledby="dropdown-button">
                                @foreach ($warehouses as $warehouse)
                                    <li>
                                        <button type="button"
                                            class="inline-flex w-full px-4 py-2 hover:bg-orange-200">{{ $warehouse->name }}</button>
                                    </li>
                                @endforeach
                        </div>
                        <div class="relative w-full">
                            <input type="search" id="search-dropdown"
                                class="block p-2.5 w-full z-20 text-sm text-gray-900 bg-gray-50 rounded-e-lg border-s-gray-50 border-s-2 border border-gray-300 focus:ring-orange-500 focus:border-orange-500"
                                placeholder="إبحث عن منتج بالإسم او بالرقم" required />
                            <button type="submit"
                                class="absolute top-0 end-0 p-2.5 text-sm font-medium h-full text-white bg-primary rounded-e-lg border border-orange-500 hover:bg-orange-800 focus:ring-4 focus:outline-none focus:ring-orange-300">
                                <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 20 20">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                                </svg>
                                <span class="sr-only">Search</span>
                            </button>
                        </div>
                    </div>
                </form>

                <button data-modal-target="add-product-modal" data-modal-toggle="add-product-modal" type="button"
                    class="bg-primary text-white px-6 py-2 rounded-lg hover:opacity-90 transition-all duration-300 flex items-center">
                    <i class="fas fa-plus ml-2"></i>
                    إضافة منتج جديد
                </button>

                <div id="add-product-modal" tabindex="-1" aria-hidden="true"
                    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                    <div class="relative p-4 w-full max-w-2xl max-h-full">
                        <div class="relative bg-white rounded-lg shadow-sm">
                            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t">
                                <h2 class="text-xl font-bold text-gray-800 flex items-center">
                                    <i class="fas fa-plus-circle ml-2 text-orange-500"></i>
                                    إضافة منتج جديد
                                </h2>
                                <button type="button"
                                    class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center"
                                    data-modal-toggle="add-product-modal">
                                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                        fill="none" viewBox="0 0 14 14">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                    </svg>
                                    <span class="sr-only">Close modal</span>
                                </button>
                            </div>
                            <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data"
                                class="p-4 md:p-5">
                                @csrf
                                <div class="grid gap-4 mb-4 grid-cols-2">
                                    <div class="col-span-2 sm:col-span-1">
                                        <label class="block mb-2 text-sm font-bold text-gray-900">إسم المنتج</label>
                                        <input type="text" name="name"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent transition-all duration-200 block w-full p-2.5"
                                            required="">
                                    </div>
                                    <div class="col-span-2 sm:col-span-1">
                                        <label class="block mb-2 text-sm font-bold text-gray-900">الكود</label>
                                        <input type="text" name="sku"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent transition-all duration-200 block w-full p-2.5"
                                            required="">
                                    </div>
                                    <div class="col-span-2 sm:col-span-1">
                                        <label for="price"
                                            class="block mb-2 text-sm font-bold text-gray-900">السعر</label>
                                        <input type="number" name="price" id="price"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent transition-all duration-200 block w-full p-2.5"
                                            required="">
                                    </div>
                                    <div class="col-span-2 sm:col-span-1">
                                        <label class="block mb-2 text-sm font-bold text-gray-900">الصنف</label>
                                        <select name="category_id"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent transition-all duration-200 block w-full p-1.5">
                                            <option disabled selected="">إختر صنف</option>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-span-2 sm:col-span-1">
                                        <label class="block mb-2 text-sm font-bold text-gray-900">المستودع</label>
                                        <select name="warehouse_id"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent transition-all duration-200 focus:border-orange-500 block w-full p-1.5">
                                            <option disabled selected="">إختر مستودع</option>
                                            @foreach ($warehouses as $warehouse)
                                                <option value="{{ $warehouse->id }}">{{ $warehouse->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-span-2 sm:col-span-1">
                                        <label class="block mb-2 text-sm font-bold text-gray-900">الكمية</label>
                                        <input type="number" name="quantity"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent transition-all duration-200 block w-full p-2.5"
                                            required="">
                                    </div>
                                    <div class="col-span-2 sm:col-span-2">
                                        <label class="block mb-2 text-sm font-bold text-gray-900">الصورة</label>
                                        <input type="file" name="image" accept="image/*"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent transition-all duration-200 block w-full p-2.5">
                                    </div>
                                    <div class="col-span-2">
                                        <label class="block mb-2 text-sm font-bold text-gray-900">وصف المنتج</label>
                                        <textarea name="description" rows="2"
                                            class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-2 focus:ring-orange-500 focus:outline-transparent focus:border-transparent transition-all duration-200"></textarea>
                                    </div>
                                </div>
                                <div class="flex space-x-3 space-x-reverse mt-8">
                                    <button type="submit"
                                        class="flex-1 bg-primary text-white font-bold py-3 rounded-lg hover:opacity-90 transition-all duration-200 flex items-center justify-center">
                                        حفظ المنتج
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Table -->
            <div class="overflow-x-auto">
                <table class="w-full border-collapse bg-white rounded-lg overflow-hidden shadow-sm">
                    <thead>
                        <tr class="bg-gray-200">
                            <th class="p-4 text-center font-bold text-gray-700 border-b border-gray-200">المنتج</th>
                            <th class="p-4 text-center font-bold text-gray-700 border-b border-gray-200">الكود</th>
                            <th class="p-4 text-center font-bold text-gray-700 border-b border-gray-200">الصورة</th>
                            <th class="p-4 text-center font-bold text-gray-700 border-b border-gray-200">الصنف</th>
                            <th class="p-4 text-center font-bold text-gray-700 border-b border-gray-200">السعر</th>
                            <th class="p-4 text-center font-bold text-gray-700 border-b border-gray-200">المخزن</th>
                            <th class="p-4 text-center font-bold text-gray-700 border-b border-gray-200">الكمية</th>
                            <th class="p-4 text-center font-bold text-gray-700 border-b border-gray-200">الإجراءات</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($products as $product)
                            <tr class="hover:bg-orange-100 transition-colors duration-200">
                                <td class="p-4 text-center border-b border-gray-200 font-medium text-gray-800">
                                    {{ $product->name }}
                                </td>
                                <td class="p-4 text-center border-b border-gray-200 font-medium text-gray-600">
                                    {{ $product->sku }}
                                </td>
                                <td class="p-4 text-center border-b border-gray-200 font-medium text-gray-600">
                                    <img src="{{ asset('storage/' . $product->img_url) }}" alt="{{ $product->name }}"
                                        class="mx-auto h-12 w-12 object-cover rounded">
                                </td>
                                <td class="p-4 text-center border-b border-gray-200 text-gray-600">
                                    <span
                                        class="inline-block bg-orange-100 text-orange-800 text-xs px-2 py-1 rounded mb-2">
                                        {{ $product->category->name }}
                                    </span>
                                </td>
                                <td class="p-4 text-center border-b border-gray-200 text-gray-600">
                                    {{ $product->price . ' ' . 'ريال' }}
                                </td>
                                <td class="p-4 text-center border-b border-gray-200 text-gray-600">
                                    {{ $product->stocks->first()->warehouse->name }}
                                </td>
                                <td class="p-4 text-center border-b border-gray-200 text-gray-600">
                                    {{ $product->stocks->first()->quantity }}
                                </td>
                                <td class="p-4 text-center border-b border-gray-200">
                                    <div class="flex justify-center space-x-2">
                                        <!-- View Button -->
                                        <a href=""
                                            class="inline-flex items-center px-3 py-2 bg-blue-100 text-blue-700 rounded-lg hover:bg-blue-200 transition-colors duration-200">
                                            <i class="fas fa-eye"></i>
                                        </a>

                                        <!-- Edit Button -->
                                        <button data-modal-target="edit-product-modal{{ $product->id }}"
                                            data-modal-toggle="edit-product-modal{{ $product->id }}" type="button"
                                            class="inline-flex items-center px-3 py-2 bg-orange-100 text-orange-700 rounded-lg hover:bg-orange-200 transition-colors duration-200">
                                            <i class="fas fa-edit"></i>
                                        </button>

                                        <!-- Delete Button -->
                                        <button data-modal-target="delete-modal{{ $product->id }}"
                                            data-modal-toggle="delete-modal{{ $product->id }}" type="button"
                                            class="inline-flex items-center px-3 py-2 bg-red-100 text-red-700 rounded-lg hover:bg-red-200 transition-colors duration-200">
                                            <i class="fas fa-trash "></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>

                            {{-- edit modal --}}
                            <div id="edit-product-modal{{ $product->id }}" tabindex="-1" aria-hidden="true"
                                class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                <div class="relative p-4 w-full max-w-2xl max-h-full">
                                    <div class="relative bg-white rounded-lg shadow-sm">
                                        <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t">
                                            <h2 class="text-xl font-bold text-gray-800 flex items-center">
                                                <i class="fas fa-plus-circle ml-2 text-orange-500"></i>
                                                تعديل بيانات المنتج
                                            </h2>
                                            <button type="button"
                                                class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center"
                                                data-modal-toggle="edit-product-modal{{ $product->id }}">
                                                <svg class="w-3 h-3" aria-hidden="true"
                                                    xmlns="http://www.w3.org/2000/svg" fill="none"
                                                    viewBox="0 0 14 14">
                                                    <path stroke="currentColor" stroke-linecap="round"
                                                        stroke-linejoin="round" stroke-width="2"
                                                        d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                                </svg>
                                                <span class="sr-only">Close modal</span>
                                            </button>
                                        </div>
                                        <form action="{{ route('products.update', $product) }}" method="POST"
                                            enctype="multipart/form-data" class="p-4 md:p-5">
                                            @csrf
                                            @method('PUT')
                                            <div class="grid gap-4 mb-4 grid-cols-2">
                                                <div class="col-span-2 sm:col-span-1">
                                                    <label class="block mb-2 text-sm font-bold text-gray-900">إسم
                                                        المنتج</label>
                                                    <input type="text" name="name" value="{{ $product->name }}"
                                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent transition-all duration-200 block w-full p-2.5"
                                                        required="">
                                                </div>
                                                <div class="col-span-2 sm:col-span-1">
                                                    <label class="block mb-2 text-sm font-bold text-gray-900">الكود</label>
                                                    <input type="text" name="sku" value="{{ $product->sku }}"
                                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent transition-all duration-200 block w-full p-2.5"
                                                        required="">
                                                </div>
                                                <div class="col-span-2 sm:col-span-1">
                                                    <label for="price"
                                                        class="block mb-2 text-sm font-bold text-gray-900">السعر</label>
                                                    <input type="number" name="price" id="price"
                                                        value="{{ $product->price }}"
                                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent transition-all duration-200 block w-full p-2.5"
                                                        required="">
                                                </div>
                                                <div class="col-span-2 sm:col-span-1">
                                                    <label class="block mb-2 text-sm font-bold text-gray-900">الصنف</label>
                                                    <select name="category_id"
                                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent transition-all duration-200 block w-full p-1.5">
                                                        <option disabled selected="">إختر صنف</option>
                                                        @foreach ($categories as $category)
                                                            <option value="{{ $category->id }}"
                                                                {{ $product->category->id == $category->id ? 'selected' : '' }}>
                                                                {{ $category->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-span-2 sm:col-span-1">
                                                    <label
                                                        class="block mb-2 text-sm font-bold text-gray-900">المستودع</label>
                                                    <select name="warehouse_id"
                                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent transition-all duration-200 focus:border-orange-500 block w-full p-1.5">
                                                        <option disabled selected="">إختر مستودع</option>
                                                        @foreach ($warehouses as $warehouse)
                                                            <option value="{{ $warehouse->id }}"
                                                                {{ $product->stocks->first()->warehouse->id == $warehouse->id ? 'selected' : '' }}>
                                                                {{ $warehouse->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-span-2 sm:col-span-1">
                                                    <label
                                                        class="block mb-2 text-sm font-bold text-gray-900">الكمية</label>
                                                    <input type="number" name="quantity"
                                                        value="{{ $product->stocks->first()->quantity }}"
                                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent transition-all duration-200 block w-full p-2.5"
                                                        required="">
                                                </div>
                                                <div class="col-span-2 sm:col-span-2">
                                                    <label
                                                        class="block mb-2 text-sm font-bold text-gray-900">الصورة</label>
                                                    <input type="file" name="img_url" accept="image/*"
                                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent transition-all duration-200 block w-full p-2.5">
                                                </div>
                                                <div class="col-span-2">
                                                    <label class="block mb-2 text-sm font-bold text-gray-900">وصف
                                                        المنتج</label>
                                                    <textarea name="description" rows="2"
                                                        class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-2 focus:ring-orange-500 focus:outline-transparent focus:border-transparent transition-all duration-200">{{ $product->description }}</textarea>
                                                </div>
                                            </div>
                                            <div class="flex space-x-3 space-x-reverse mt-8">
                                                <button type="submit"
                                                    class="flex-1 bg-primary text-white font-bold py-3 rounded-lg hover:opacity-90 transition-all duration-200 flex items-center justify-center">
                                                    حفظ المنتج
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            {{-- delete modal --}}
                            <div id="delete-modal{{ $product->id }}" tabindex="-1"
                                class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                <div class="relative p-4 w-full max-w-md max-h-full">
                                    <div class="relative bg-white rounded-lg shadow-sm">
                                        <button type="button"
                                            class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center"
                                            data-modal-hide="delete-modal{{ $product->id }}">
                                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                                viewBox="0 0 14 14">
                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                    stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                            </svg>
                                            <span class="sr-only">Close modal</span>
                                        </button>
                                        <div class="p-4 md:p-5 text-center">
                                            <svg class="mx-auto mb-4 text-red-500 w-12 h-12" aria-hidden="true"
                                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                    stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                            </svg>
                                            <h3 class="mb-5 text-lg font-normal text-dark">هل انت متأكد من حذف المنتج
                                                <strong>{{ $product->name }}</strong>؟
                                            </h3>
                                            <form action="{{ route('products.destroy', $product) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button data-modal-hide="delete-modal{{ $product->id }}" type="submit"
                                                    class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-bold rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
                                                    حذف
                                                </button>
                                                <button data-modal-hide="delete-modal{{ $product->id }}" type="button"
                                                    class="py-2.5 px-5 ms-3 text-sm font-bold text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100">
                                                    إلغاء
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <tr>
                                <td colspan="8" class="p-8 text-center text-gray-500">
                                    <div class="flex flex-col items-center">
                                        <i class="fas fa-box text-4xl text-gray-300 mb-4"></i>
                                        <p class="text-lg">لا توجد منتجات متاحة</p>
                                        <p class="text-sm text-gray-400 mt-2">ابدأ بإضافة منتج جديد</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection
