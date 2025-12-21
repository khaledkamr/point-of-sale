@extends('layouts.app')

@section('title', 'المنتجات')

@section('content')
    <div class="p-6">
        <h1 class="text-3xl font-bold text-gray-800 flex items-center mb-6">
            <i class="fas fa-box ml-3 text-orange-500"></i>
            المنتجــــات
        </h1>
        <div class="bg-white p-6 rounded-lg shadow-md">
            <!-- Header -->
            <div class="flex items-center gap-5 mb-6">
                <form class="flex-1">
                    <div class="relative w-full">
                        <input type="search" id="search-dropdown" name="search" value="{{ request('search') }}"
                            class="block p-2.5 w-full z-20 text-sm text-gray-900 bg-gray-50 rounded-e-lg border-gray-50 border-s-2 border border-gray-300 focus:ring-orange-500 focus:border-orange-500"
                            placeholder="إبحث عن منتج بالإسم او بالكود" />
                        @if (request('search'))
                            <a href="{{ route('products.index', array_merge(request()->except('search'), request()->only(['warehouse_id', 'category_id']))) }}"
                                class="absolute top-1/2 end-13 -translate-y-1/2 text-gray-400 hover:text-gray-600 cursor-pointer">
                                ✕
                            </a>
                        @endif
                        <button type="submit" class="absolute top-0 end-0 p-2.5 text-sm font-medium h-full text-white bg-primary rounded-e-lg border border-orange-500 hover:bg-orange-800 focus:ring-4 focus:outline-none focus:ring-orange-300">
                            <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                            </svg>
                            <span class="sr-only">Search</span>
                        </button>
                    </div>
                    @foreach (request()->except('search') as $key => $value)
                        <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                    @endforeach
                </form>

                <form method="GET" action="" class="w-50">
                    @foreach (request()->except('warehouse_id') as $key => $value)
                        <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                    @endforeach
                    <select id="warehouseFilter" name="warehouse_id"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-orange-500 focus:border-orange-500 block p-1.5"
                        onchange="this.form.submit()">
                        <option value="all">كل المستودعات</option>
                        @foreach ($warehouses as $warehouse)
                            <option value="{{ $warehouse->id }}"
                                {{ request('warehouse_id') == $warehouse->id ? 'selected' : '' }}>
                                {{ $warehouse->name_ar }}
                            </option>
                        @endforeach
                    </select>
                </form>

                <form method="GET" action="" class="w-50">
                    @foreach (request()->except('category_id') as $key => $value)
                        <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                    @endforeach
                    <select id="categoryFilter" name="category_id"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-orange-500 focus:border-orange-500 block p-1.5"
                        onchange="this.form.submit()">
                        <option value="all">كل الفئات</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                                {{ $category->name_ar }}
                            </option>
                        @endforeach
                    </select>
                </form>

                <button data-modal-target="add-product-modal" data-modal-toggle="add-product-modal" type="button"
                    class="bg-primary text-white px-6 py-2 rounded-lg hover:opacity-90 transition-all duration-300 flex items-center">
                    <i class="fas fa-plus ml-2"></i>
                    إضافة منتج جديد
                </button>
            </div>

            <div id="add-product-modal" tabindex="-1" aria-hidden="true"
                class="modal hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                <div class="relative p-4 w-full max-w-2xl max-h-full">
                    <div class="relative bg-white rounded-lg shadow-sm">
                        <div class="flex items-center justify-between p-4 border-b rounded-t">
                            <h2 class="text-xl font-bold text-gray-800 flex items-center">
                                <i class="fas fa-plus-circle ml-2 text-orange-500"></i>
                                إضافة منتج جديد
                            </h2>
                            <button type="button"
                                class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center"
                                data-modal-toggle="add-product-modal">
                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 14 14">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                </svg>
                                <span class="sr-only">Close modal</span>
                            </button>
                        </div>
                        <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data"
                            class="p-4">
                            @csrf
                            <div class="grid gap-4 mb-4 grid-cols-2">
                                <div class="col-span-2 sm:col-span-1">
                                    <label class="block mb-2 text-sm font-bold text-gray-900">إسم المنتج بالعربي <span
                                            class="text-red-500">*</span></label>
                                    <input type="text" name="name_ar"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent transition-all duration-200 block w-full p-2"
                                        required="">
                                </div>
                                <div class="col-span-2 sm:col-span-1">
                                    <label class="block mb-2 text-sm font-bold text-gray-900">إسم المنتج
                                        بالإنجليزي</label>
                                    <input type="text" name="name_en"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent transition-all duration-200 block w-full p-2"
                                        required="">
                                </div>
                                <div class="col-span-2 sm:col-span-1">
                                    <label class="block mb-2 text-sm font-bold text-gray-900">الكود <span
                                            class="text-red-500">*</span></label>
                                    <input type="text" name="sku"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent transition-all duration-200 block w-full p-2"
                                        required="">
                                </div>
                                <div class="col-span-2 sm:col-span-1">
                                    <label class="block mb-2 text-sm font-bold text-gray-900">الفئة <span
                                            class="text-red-500">*</span></label>
                                    <select id="categorySelect" name="category_id"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent transition-all duration-200 block w-full p-1">
                                        <option disabled selected="">إختر فئة المنتج</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name_ar }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-span-2 sm:col-span-1">
                                    <label class="block mb-2 text-sm font-bold text-gray-900">المستودعات <span
                                            class="text-red-500">*</span></label>
                                    <select id="warehouseSelect"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500 w-full p-1">
                                        <option value="">اختر مستودع</option>
                                        <option value="all">كل المستودعات</option>
                                        @foreach ($warehouses as $warehouse)
                                            <option value="{{ $warehouse->id }}">{{ $warehouse->name_ar }}</option>
                                        @endforeach
                                    </select>
                                    <div id="selectedWarehouses" class="flex flex-wrap gap-2 mt-2"></div>
                                    <div id="warehouseInputs"></div>
                                </div>
                                <div class="col-span-2 sm:col-span-1">
                                    <div class="flex gap-2">
                                        <div>
                                            <label for="unit" class="block mb-2 text-sm font-bold text-gray-900">وحدة
                                                القياس <span class="text-red-500">*</span></label>
                                            <input type="text" name="unit" id="unit"
                                                placeholder="قطعة/ كجم/ لتر"
                                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent transition-all duration-200 block w-full p-2"
                                                required="">
                                        </div>
                                        <div>
                                            <label for="profit_margin"
                                                class="block mb-2 text-sm font-bold text-gray-900">نسبة الربح <span
                                                    class="text-red-500">*</span></label>
                                            <input type="number" name="profit_margin" id="profit_margin" step="0.01"
                                                min="0"
                                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent transition-all duration-200 block w-full p-2"
                                                required="">
                                        </div>
                                    </div>
                                    <div class="flex gap-3 pt-3">
                                        <div class="flex items-center gap-17">
                                            <label for="featuredEdit" class="block mb-2 text-sm font-bold text-gray-900">مميز</label>
                                            <label class="inline-flex items-center cursor-pointer">
                                                <input type="hidden" name="is_featured" value="0"> 
                                                <input type="checkbox" name="is_featured" id="featuredEdit" value="1" class="sr-only peer">
                                                <div class="relative w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-orange-300 rounded-full peer peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-orange-500"></div>
                                            </label>
                                        </div>
                                        <div class="flex items-center gap-16">
                                            <label for="activeEdit" class="block mb-2 text-sm font-bold text-gray-900">فعال</label>
                                            <label class="inline-flex items-center cursor-pointer">
                                                <input type="hidden" name="is_active" value="0">
                                                <input type="checkbox" name="is_active" id="activeEdit" value="1" checked class="sr-only peer">
                                                <div class="relative w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-orange-300 rounded-full peer peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-orange-500"></div>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-span-2 sm:col-span-1">
                                    <label class="block mb-2 text-sm font-bold text-gray-900">صورة المنتج</label>
                                    <div id="imageBox"
                                        class="relative cursor-pointer group flex items-center justify-center
                                                w-full h-40 border-2 border-dashed border-gray-300 rounded-lg
                                                bg-gray-50 hover:bg-orange-100 transition-all duration-200">

                                        <!-- Placeholder -->
                                        <div id="imgPlaceholder"
                                            class="flex flex-col items-center text-gray-500 hover:text-orange-700">
                                            <i class="fa-solid fa-image text-4xl mb-2"></i>
                                            <span class="text-sm">اضغط لاختيار صورة</span>
                                        </div>

                                        <!-- Image -->
                                        <img id="imagePreview"
                                            class="hidden absolute inset-0 w-full h-full object-contain rounded-lg">

                                        <!-- Overlay -->
                                        <div id="imgOverlay"
                                            class="hidden absolute inset-0 bg-black/40 opacity-0 hover:opacity-100
                                                flex items-center justify-center text-white text-sm font-semibold transition rounded-lg">
                                            تغيير الصورة
                                        </div>
                                    </div>
                                    <input id="imageInput" type="file" name="img_url" accept="image/*"
                                        class="hidden">
                                </div>
                                <div class="col-span-2 sm:col-span-1">
                                    <label class="block mb-2 text-sm font-bold text-gray-900">وصف المنتج</label>
                                    <textarea name="description" rows="7"
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

            <div class="overflow-x-auto">
                <table class="w-full border-collapse bg-white rounded-lg overflow-hidden shadow-sm">
                    <thead>
                        <tr class="bg-gray-200">
                            <th class="text-center fw-bold text-gray-700 border-b border-gray-200">#</th>
                            <th class="p-4 text-center font-bold text-gray-700 border-b border-gray-200">المنتج</th>
                            <th class="p-4 text-center font-bold text-gray-700 border-b border-gray-200">الكود</th>
                            <th class="p-4 text-center font-bold text-gray-700 border-b border-gray-200">الصورة</th>
                            <th class="p-4 text-center font-bold text-gray-700 border-b border-gray-200">الفئة</th>
                            <th class="p-4 text-center font-bold text-gray-700 border-b border-gray-200">سعر التكلفة</th>
                            <th class="p-4 text-center font-bold text-gray-700 border-b border-gray-200">نسبة الربح</th>
                            <th class="p-4 text-center font-bold text-gray-700 border-b border-gray-200">سعر البيع</th>
                            <th class="p-4 text-center font-bold text-gray-700 border-b border-gray-200">المستودع</th>
                            <th class="p-4 text-center font-bold text-gray-700 border-b border-gray-200">الكمية</th>
                            <th class="p-4 text-center font-bold text-gray-700 border-b border-gray-200">الإجراءات</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($products as $product)
                            @foreach ($product->stocks as $stock)
                                @if (request()->has('warehouse_id') && request('warehouse_id') != 'all' && $stock->warehouse->id != request('warehouse_id'))
                                    @continue
                                @endif
                                <tr class="hover:bg-orange-100 transition-colors duration-200 {{ !$product->is_active ? 'opacity-50 bg-gray-100' : '' }}">
                                    <td class="p-4 text-center border-b border-gray-200">
                                        {{ $loop->parent->iteration }}
                                        @if(!$product->is_active)
                                            <i class="fas fa-ban text-red-500 ml-1"></i>
                                        @elseif($product->is_featured)
                                            <i class="fas fa-star text-yellow-400 ml-1"></i>
                                        @endif
                                    </td>
                                    <td class="p-4 text-center border-b border-gray-200 font-medium text-gray-800">
                                        {{ $product->name_ar }}
                                    </td>
                                    <td class="p-4 text-center border-b border-gray-200 font-medium text-gray-600">
                                        {{ $product->sku }}
                                    </td>
                                    <td class="p-4 text-center border-b border-gray-200 font-medium text-gray-600">
                                        <img src="{{ asset('storage/' . $product->img_url) }}"
                                            alt="{{ $product->name_ar }}" class="mx-auto h-12 w-12 object-cover rounded {{ !$product->is_active ? 'grayscale' : '' }}">
                                    </td>
                                    <td class="p-4 text-center border-b border-gray-200 text-gray-600">
                                        <span
                                            class="inline-block bg-orange-100 text-orange-800 text-xs px-2 py-1 rounded-xl mb-2">
                                            {{ $product->category->name_ar }}
                                        </span>
                                    </td>
                                    <td class="p-4 text-center border-b border-gray-200 text-gray-600">
                                        {{ $product->price }}
                                    </td>
                                    <td class="p-4 text-center border-b border-gray-200 text-gray-600">
                                        {{ $product->profit_margin }}%
                                    </td>
                                    <td class="p-4 text-center border-b border-gray-200 text-gray-600">
                                        {{ $product->price }}
                                    </td>
                                    <td class="p-4 text-center border-b border-gray-200 text-gray-600">
                                        {{ $stock->warehouse->name_ar }}
                                    </td>
                                    <td class="p-4 text-center border-b border-gray-200 text-gray-600">
                                        {{ $stock->quantity }}
                                    </td>
                                    <td class="p-4 text-center border-b border-gray-200">
                                        <div class="flex justify-center space-x-2">
                                            <!-- View Button -->
                                            <a href="" class="inline-flex items-center px-3 py-2 bg-blue-100 text-blue-700 rounded-lg hover:bg-blue-200 transition-colors duration-200 {{ !$product->is_active ? 'pointer-events-none opacity-50' : '' }}">
                                                <i class="fas fa-eye"></i>
                                            </a>

                                            <!-- Edit Button -->
                                            <button data-modal-target="edit-product-modal{{ $product->id }}" data-modal-toggle="edit-product-modal{{ $product->id }}" type="button"
                                                class="inline-flex items-center px-3 py-2 bg-orange-100 text-orange-700 rounded-lg hover:bg-orange-200 transition-colors duration-200">
                                                <i class="fas fa-edit"></i>
                                            </button>

                                            <!-- Delete Button -->
                                            <button data-modal-target="delete-modal{{ $product->id }}" data-modal-toggle="delete-modal{{ $product->id }}" type="button"
                                                class="inline-flex items-center px-3 py-2 bg-red-100 text-red-700 rounded-lg hover:bg-red-200 transition-colors duration-200">
                                                <i class="fas fa-trash "></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach

                            {{-- edit modal --}}
                            <div id="edit-product-modal{{ $product->id }}" tabindex="-1" aria-hidden="true"
                                class="modal hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                <div class="relative p-4 w-full max-w-2xl max-h-full">
                                    <div class="relative bg-white rounded-lg shadow-sm">
                                        <div class="flex items-center justify-between p-4 border-b rounded-t">
                                            <h2 class="text-xl font-bold text-gray-800 flex items-center">
                                                <i class="fas fa-edit ml-2 text-orange-500"></i>
                                                تعديل بيانات المنتج
                                            </h2>
                                            <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center"
                                                data-modal-toggle="edit-product-modal{{ $product->id }}">
                                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                                </svg>
                                                <span class="sr-only">Close modal</span>
                                            </button>
                                        </div>
                                        <div class="p-4">
                                            <form id="edit-product-form-{{ $product->id }}" action="{{ route('products.update', $product) }}" method="POST" enctype="multipart/form-data">
                                                @csrf
                                                @method('PUT')
                                                <div class="grid gap-4 mb-4 grid-cols-2">
                                                    <div class="col-span-2 sm:col-span-1">
                                                        <label class="block mb-2 text-sm font-bold text-gray-900">إسم المنتج بالعربي <span class="text-red-500">*</span></label>
                                                        <input type="text" name="name_ar" value="{{ $product->name_ar }}"
                                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent transition-all duration-200 block w-full p-2"
                                                            required="">
                                                    </div>
                                                    <div class="col-span-2 sm:col-span-1">
                                                        <label class="block mb-2 text-sm font-bold text-gray-900">إسم المنتج بالإنجليزي</label>
                                                        <input type="text" name="name_en" value="{{ $product->name_en }}"
                                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent transition-all duration-200 block w-full p-2"
                                                            required="">
                                                    </div>
                                                    <div class="col-span-2 sm:col-span-1">
                                                        <label class="block mb-2 text-sm font-bold text-gray-900">الكود <span class="text-red-500">*</span></label>
                                                        <input type="text" name="sku" value="{{ $product->sku }}"
                                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent transition-all duration-200 block w-full p-2"
                                                            required="">
                                                    </div>
                                                    <div class="col-span-2 sm:col-span-1">
                                                        <label class="block mb-2 text-sm font-bold text-gray-900">الفئة
                                                            <span class="text-red-500">*</span></label>
                                                        <select id="categorySelectEdit{{ $product->id }}" name="category_id"
                                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent transition-all duration-200 block w-full p-1">
                                                            <option disabled>إختر فئة المنتج</option>
                                                            @foreach ($categories as $category)
                                                                <option value="{{ $category->id }}" {{ $product->category->id == $category->id ? 'selected' : '' }}>
                                                                    {{ $category->name_ar }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="col-span-2 sm:col-span-1">
                                                        <label class="block mb-2 text-sm font-bold text-gray-900">المستودعات <span class="text-red-500">*</span></label>
                                                        <select id="warehouseSelectEdit{{ $product->id }}"
                                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500 w-full p-1">
                                                            <option value="">اختر مستودع</option>
                                                            @foreach ($warehouses as $warehouse)
                                                                @if ($product->stocks->pluck('warehouse_id')->contains($warehouse->id))
                                                                    @continue
                                                                @endif
                                                                <option value="{{ $warehouse->id }}">
                                                                    {{ $warehouse->name_ar }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                        <div id="selectedWarehousesEdit{{ $product->id }}" class="flex flex-wrap gap-2 mt-2">
                                                            @foreach ($product->stocks as $stock)
                                                                <span data-id={{ $stock->warehouse->id }}
                                                                    class="flex items-center gap-1 bg-orange-100 text-orange-700 text-xs font-semibold px-2 py-1 rounded-full cursor-pointer">
                                                                    {{ $stock->warehouse->name_ar }} ✕
                                                                </span>
                                                            @endforeach
                                                        </div>
                                                        <div id="warehouseInputsEdit{{ $product->id }}">
                                                            @foreach ($product->stocks as $stock)
                                                                <input type="hidden" name="warehouse_id[]"
                                                                    value="{{ $stock->warehouse->id }}"
                                                                    id="warehouse-input-edit-{{ $stock->warehouse->id }}-{{ $product->id }}">
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                    <div class="col-span-2 sm:col-span-1">
                                                        <div class="flex gap-2">
                                                            <div>
                                                                <label for="unitEdit{{ $product->id }}" class="block mb-2 text-sm font-bold text-gray-900">وحدة القياس <span class="text-red-500">*</span></label>
                                                                <input type="text" name="unit" id="unitEdit{{ $product->id }}" value="{{ $product->unit }}" placeholder="قطعة/ كجم/ لتر"
                                                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent transition-all duration-200 block w-full p-2"
                                                                    required="">
                                                            </div>
                                                            <div>
                                                                <label for="profitMarginEdit{{ $product->id }}" class="block mb-2 text-sm font-bold text-gray-900">نسبة الربح <span class="text-red-500">*</span></label>
                                                                <input type="number" name="profit_margin" id="profitMarginEdit{{ $product->id }}" step="0.01" min="0" value="{{ $product->profit_margin }}"
                                                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent transition-all duration-200 block w-full p-2"
                                                                    required="">
                                                            </div>
                                                        </div>
                                                        <div class="flex gap-3 pt-3">
                                                            <div class="flex items-center gap-17">
                                                                <label for="featuredEdit{{ $product->id }}" class="block mb-2 text-sm font-bold text-gray-900">مميز</label>
                                                                <label class="inline-flex items-center cursor-pointer">
                                                                    <input type="hidden" name="is_featured" value="0"> 
                                                                    <input type="checkbox" name="is_featured" id="featuredEdit{{ $product->id }}" value="1" {{ $product->is_featured ? 'checked' : '' }} class="sr-only peer">
                                                                    <div class="relative w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-orange-300 rounded-full peer peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-orange-500"></div>
                                                                </label>
                                                            </div>
                                                            <div class="flex items-center gap-16">
                                                                <label for="activeEdit{{ $product->id }}" class="block mb-2 text-sm font-bold text-gray-900">فعال</label>
                                                                <label class="inline-flex items-center cursor-pointer">
                                                                    <input type="hidden" name="is_active" value="0">
                                                                    <input type="checkbox" name="is_active" id="activeEdit{{ $product->id }}" value="1" {{ $product->is_active ? 'checked' : '' }} class="sr-only peer">
                                                                    <div class="relative w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-orange-300 rounded-full peer peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-orange-500"></div>
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-span-2 sm:col-span-1">
                                                        <label class="block mb-2 text-sm font-bold text-gray-900">صورة المنتج</label>
                                                        <div id="imageBoxEdit{{ $product->id }}" class="relative cursor-pointer group flex items-center justify-center
                                                                w-full h-40 border-2 border-dashed border-gray-300 rounded-lg
                                                                bg-gray-50 hover:bg-orange-100 transition-all duration-200">

                                                            <!-- Placeholder -->
                                                            <div id="imgPlaceholderEdit{{ $product->id }}" class="flex flex-col items-center text-gray-500 hover:text-orange-700 {{ $product->img_url ? 'hidden' : '' }}">
                                                                <i class="fa-solid fa-image text-4xl mb-2"></i>
                                                                <span class="text-sm">اضغط لاختيار صورة</span>
                                                            </div>

                                                            <!-- Image -->
                                                            <img id="imagePreviewEdit{{ $product->id }}" src="{{ $product->img_url ? asset('storage/' . $product->img_url) : '' }}"
                                                                class="{{ $product->img_url ? '' : 'hidden' }} absolute inset-0 w-full h-full object-contain rounded-lg">

                                                            <!-- Overlay -->
                                                            <div id="imgOverlayEdit{{ $product->id }}" class="{{ $product->img_url ? '' : 'hidden' }} absolute inset-0 bg-black/40 opacity-0 hover:opacity-100
                                                                    flex items-center justify-center text-white text-sm font-semibold transition rounded-lg">
                                                                تغيير الصورة
                                                            </div>
                                                        </div>
                                                        <input id="imageInputEdit{{ $product->id }}" type="file" name="img_url" accept="image/*" class="hidden">
                                                    </div>
                                                    <div class="col-span-2 sm:col-span-1">
                                                        <label class="block mb-2 text-sm font-bold text-gray-900">وصف المنتج</label>
                                                        <textarea name="description" rows="7" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-2 focus:ring-orange-500 focus:outline-transparent focus:border-transparent transition-all duration-200">{{ $product->description }}</textarea>
                                                    </div>
                                                </div>
                                                <div class="flex space-x-3 space-x-reverse mt-8">
                                                    <button type="submit" class="flex-1 bg-primary text-white font-bold py-3 rounded-lg hover:opacity-90 transition-all duration-200 flex items-center justify-center">
                                                        حفظ المنتج
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- delete modal --}}
                            <div id="delete-modal{{ $product->id }}" tabindex="-1"
                                class="modal hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                <div class="relative p-4 w-full max-w-md max-h-full">
                                    <div class="relative bg-white rounded-lg shadow-sm">
                                        <button type="button"
                                            class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center"
                                            data-modal-hide="delete-modal{{ $product->id }}">
                                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                                fill="none" viewBox="0 0 14 14">
                                                <path stroke="currentColor" stroke-linecap="round"
                                                    stroke-linejoin="round" stroke-width="2"
                                                    d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                            </svg>
                                            <span class="sr-only">Close modal</span>
                                        </button>
                                        <div class="p-4 md:p-5 text-center">
                                            <svg class="mx-auto mb-4 text-red-500 w-12 h-12" aria-hidden="true"
                                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                                <path stroke="currentColor" stroke-linecap="round"
                                                    stroke-linejoin="round" stroke-width="2"
                                                    d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
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
                                <td colspan="11" class="p-8 text-center text-gray-500">
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

            <div class="mt-4">
                {{ $products->links('components.pagination') }}
            </div>
        </div>
    </div>

    <script>
        // Handle warehouse selection with Select2
        const selectedWarehouses = new Set();
        $('#warehouseSelect').on('select2:select', function(e) {
            const data = e.params.data;
            const value = data.id;
            const text = data.text;

            if (!value || selectedWarehouses.has(value)) return;

            selectedWarehouses.add(value);

            // Create chip
            const chip = $(`
                <span class="flex items-center gap-1 bg-orange-100 text-orange-700 text-xs font-semibold px-2 py-1 rounded-full cursor-pointer">
                    ${text} ✕
                </span>
            `);

            chip.on('click', function() {
                selectedWarehouses.delete(value);
                $(this).remove();
                $(`#warehouse-input-${value}`).remove();
            });

            $('#selectedWarehouses').append(chip);

            // Create hidden input
            const hiddenInput = $(`
                <input type="hidden" name="warehouse_id[]" value="${value}" id="warehouse-input-${value}">
            `);
            $('#warehouseInputs').append(hiddenInput);

            // Clear the select
            $('#warehouseSelect').val(null).trigger('change');
        });

        const imageBox = document.getElementById('imageBox');
        const input = document.getElementById('imageInput');
        const preview = document.getElementById('imagePreview');
        const placeholder = document.getElementById('imgPlaceholder');
        const overlay = document.getElementById('imgOverlay');

        imageBox.addEventListener('click', () => input.click());

        input.addEventListener('change', () => {
            const file = input.files[0];
            if (!file) return;

            preview.src = URL.createObjectURL(file);
            preview.classList.remove('hidden');
            placeholder.classList.add('hidden');

            overlay.classList.remove('hidden');
        });

        // Initialize Select2 for searchable select inputs
        $(document).ready(function() {
            $('#categorySelect').select2({
                placeholder: 'إختر فئة المنتج',
                allowClear: true,
                dir: 'rtl',
                language: {
                    noResults: function() {
                        return 'لا توجد نتائج';
                    },
                    searching: function() {
                        return 'جارٍ البحث...';
                    }
                },
                theme: 'default',
                width: '100%'
            });

            $('#warehouseSelect').select2({
                placeholder: 'اختر مستودع',
                allowClear: true,
                dir: 'rtl',
                language: {
                    noResults: function() {
                        return 'لا توجد نتائج';
                    },
                    searching: function() {
                        return 'جارٍ البحث...';
                    }
                },
                theme: 'default',
                width: '100%'
            });

            // Initialize Category Filter Select2
            $('#categoryFilter').select2({
                placeholder: 'كل الفئات',
                allowClear: true,
                dir: 'rtl',
                language: {
                    noResults: function() {
                        return 'لا توجد نتائج';
                    },
                    searching: function() {
                        return 'جارٍ البحث...';
                    }
                },
                theme: 'default',
                width: '100%'
            });

            // Handle categoryFilter change event to submit form
            $('#categoryFilter').on('change', function() {
                this.form.submit();
            });

            $('#warehouseFilter').select2({
                placeholder: 'كل المستودعات',
                allowClear: true,
                dir: 'rtl',
                language: {
                    noResults: function() {
                        return 'لا توجد نتائج';
                    },
                    searching: function() {
                        return 'جارٍ البحث...';
                    }
                },
                theme: 'default',
                width: '100%'
            });

            $('#warehouseFilter').on('change', function() {
                this.form.submit();
            });

            $('<style>')
                .prop('type', 'text/css')
                .html(`
                    .select2-container--default .select2-selection--single {
                        background-color: rgb(249 250 251);
                        border: 1px solid rgb(209 213 219);
                        border-radius: 0.5rem;
                        height: 2.5rem;
                        font-size: 0.875rem;
                    }
                    .select2-container--default .select2-selection--single .select2-selection__rendered {
                        color: rgb(17 24 39);
                        line-height: 2.25rem;
                        padding-right: 0.75rem;
                        padding-left: 0.75rem;
                    }
                    .select2-container--default .select2-selection--single .select2-selection__arrow {
                        height: 2.25rem;
                        right: 0.75rem;
                        left: auto;
                    }
                    .select2-dropdown {
                        border: 1px solid rgb(209 213 219);
                        border-radius: 0.5rem;
                        font-size: 0.875rem;
                    }
                    .select2-container--default .select2-results__option--highlighted[aria-selected] {
                        background-color: rgb(254 215 170);
                        color: rgb(154 52 18);
                    }
                    .select2-container--default .select2-search--dropdown .select2-search__field {
                        border: 1px solid rgb(209 213 219);
                        border-radius: 0.375rem;
                        font-size: 0.875rem;
                        padding: 0.5rem;
                        text-align: right;
                    }
                    .select2-container--default .select2-search--dropdown .select2-search__field:focus {
                        border-color: rgb(249 115 22);
                        outline: none;
                        box-shadow: 0 0 0 1px rgb(249 115 22);
                    }
                    .select2-container--default .select2-selection--single .select2-selection__clear {
                        color: rgb(107 114 128);
                        cursor: pointer;
                        font-size: 1.2rem;
                        font-weight: bold;
                        position: absolute;
                        left: 1.5rem;
                        top: 10%;
                        width: 1.25rem;
                        height: 1.25rem;
                        border-radius: 50%;
                        transition: all 0.2s ease;
                    }   
                    .select2-container--default .select2-selection--single .select2-selection__clear:active {
                        transform: translateY(-50%) scale(0.95);
                    }
                    .select2-container--default.select2-container--open .select2-selection--single .select2-selection__arrow,
                    .select2-container--default .select2-selection--single:has(.select2-selection__clear) .select2-selection__arrow {
                        left: 0.25rem;
                    }
                `)
                .appendTo('head');

            // Initialize edit modal functionality for each product
            @foreach ($products as $product)
                // Initialize Select2 for edit modal category select
                $('#categorySelectEdit{{ $product->id }}').select2({
                    placeholder: 'إختر فئة المنتج',
                    allowClear: true,
                    dir: 'rtl',
                    language: {
                        noResults: function() {
                            return 'لا توجد نتائج';
                        },
                        searching: function() {
                            return 'جارٍ البحث...';
                        }
                    },
                    theme: 'default',
                    width: '100%'
                });

                // Initialize Select2 for edit modal warehouse select
                $('#warehouseSelectEdit{{ $product->id }}').select2({
                    placeholder: 'اختر مستودع',
                    allowClear: true,
                    dir: 'rtl',
                    language: {
                        noResults: function() {
                            return 'لا توجد نتائج';
                        },
                        searching: function() {
                            return 'جارٍ البحث...';
                        }
                    },
                    theme: 'default',
                    width: '100%'
                });

                // Handle warehouse selection for edit modal
                const selectedWarehousesEdit{{ $product->id }} = new Set();
                @foreach ($product->stocks as $stock)
                    selectedWarehousesEdit{{ $product->id }}.add('{{ $stock->warehouse->id }}');
                @endforeach

                $('#warehouseSelectEdit{{ $product->id }}').on('select2:select', function(e) {
                    const data = e.params.data;
                    const value = data.id;
                    const text = data.text;

                    if (!value || selectedWarehousesEdit{{ $product->id }}.has(value)) return;

                    selectedWarehousesEdit{{ $product->id }}.add(value);

                    // Create chip
                    const chip = $(`
                        <span data-id="${value}" class="flex items-center gap-1 bg-orange-100 text-orange-700 text-xs font-semibold px-2 py-1 rounded-full cursor-pointer">
                            ${text} ✕
                        </span>
                    `);

                    chip.on('click', function() {
                        selectedWarehousesEdit{{ $product->id }}.delete(value);
                        $(`#warehouse-input-edit-${value}-{{ $product->id }}`).remove();
                        $(this).remove();
                    });

                    $('#selectedWarehousesEdit{{ $product->id }}').append(chip);

                    // Create hidden input
                    const hiddenInput = $(`
                        <input type="hidden" name="warehouse_id[]" value="${value}" id="warehouse-input-edit-${value}-{{ $product->id }}">
                    `);
                    // append to the form instead of a the hidden inputs container to solve issue when adding new warehouses
                    $('#edit-product-form-{{ $product->id }}').append(hiddenInput);

                    // Clear the select
                    $('#warehouseSelectEdit{{ $product->id }}').val(null).trigger('change');
                });

                // Handle existing warehouse chips removal
                $('#selectedWarehousesEdit{{ $product->id }} span').on('click', function() {
                    const warehouseId = $(this).data('id');
                    selectedWarehousesEdit{{ $product->id }}.delete(warehouseId);
                    $(`#warehouse-input-edit-${warehouseId}-{{ $product->id }}`).remove();
                    $(this).remove();
                });

                // Image upload functionality for edit modal
                const imageBoxEdit{{ $product->id }} = document.getElementById(
                    'imageBoxEdit{{ $product->id }}');
                const inputEdit{{ $product->id }} = document.getElementById(
                    'imageInputEdit{{ $product->id }}');
                const previewEdit{{ $product->id }} = document.getElementById(
                    'imagePreviewEdit{{ $product->id }}');
                const placeholderEdit{{ $product->id }} = document.getElementById(
                    'imgPlaceholderEdit{{ $product->id }}');
                const overlayEdit{{ $product->id }} = document.getElementById(
                    'imgOverlayEdit{{ $product->id }}');

                if (imageBoxEdit{{ $product->id }}) {
                    imageBoxEdit{{ $product->id }}.addEventListener('click', () => inputEdit{{ $product->id }}
                        .click());

                    inputEdit{{ $product->id }}.addEventListener('change', () => {
                        const file = inputEdit{{ $product->id }}.files[0];
                        if (!file) return;

                        previewEdit{{ $product->id }}.src = URL.createObjectURL(file);
                        previewEdit{{ $product->id }}.classList.remove('hidden');
                        placeholderEdit{{ $product->id }}.classList.add('hidden');
                        overlayEdit{{ $product->id }}.classList.remove('hidden');
                    });
                }
            @endforeach
        });
    </script>

@endsection
