@extends('layouts.app')

@section('title', 'العملاء')

@section('content')
    <div class="p-6">
        <h1 class="text-3xl font-bold text-gray-800 flex items-center mb-6">
            <i class="fas fa-users ml-3 text-orange-500"></i>
            العملاء
        </h1>
        <div class="bg-white p-6 rounded-lg shadow-md">
            <!-- Header -->
            <div class="flex items-center gap-5 mb-6">
                <form class="flex-1">
                    <div class="relative w-full">
                        <input type="search" id="search-dropdown" name="search" value="{{ request('search') }}"
                            class="block p-2.5 w-full z-20 text-sm text-gray-900 bg-gray-50 rounded-e-lg border-gray-50 border-s-2 border border-gray-300 focus:ring-orange-500 focus:border-orange-500"
                            placeholder="إبحث عن عميل بالاسم" />
                        @if (request('search'))
                            <a href="{{ route('customers.index', array_merge(request()->except('search'), request()->only(['type']))) }}"
                                class="absolute top-1/2 end-13 -translate-y-1/2 text-gray-400 hover:text-gray-600 cursor-pointer">
                                ✕
                            </a>
                        @endif
                        <button type="submit"
                            class="absolute top-0 end-0 p-2.5 text-sm font-medium h-full text-white bg-primary rounded-e-lg border border-orange-500 hover:bg-orange-800 focus:ring-4 focus:outline-none focus:ring-orange-300">
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
                    @foreach (request()->except('type') as $key => $value)
                        <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                    @endforeach
                    <select id="typeFilter" name="type"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-orange-500 focus:border-orange-500 block p-1.5"
                        onchange="this.form.submit()">
                        <option value="all">كل الانواع</option>
                        @foreach ($types as $type)
                            <option value="{{ $type }}" {{ request('type') == $type ? 'selected' : '' }}>
                                {{ $type }}
                            </option>
                        @endforeach
                    </select>
                </form>

                <button data-modal-target="add-customer-modal" data-modal-toggle="add-customer-modal" type="button"
                    class="bg-primary text-white px-6 py-2 rounded-lg hover:opacity-90 transition-all duration-300 flex items-center">
                    <i class="fas fa-plus ml-2"></i>
                    إضافة عميل جديد
                </button>
            </div>

            <div id="add-customer-modal" tabindex="-1" aria-hidden="true"
                class="modal hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                <div class="relative p-4 w-full max-w-6xl max-h-full">
                    <div class="relative bg-white rounded-lg shadow-sm">
                        <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t border-gray-200">
                            <h2 class="text-xl font-bold text-gray-800 flex items-center">
                                <i class="fas fa-plus-circle ml-2 text-orange-500"></i>
                                إضافة عميل جديد
                            </h2>
                            <button type="button"
                                class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center"
                                data-modal-toggle="add-customer-modal">
                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 14 14">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                </svg>
                                <span class="sr-only">إغلاق النافذة</span>
                            </button>
                        </div>
                        <form action="{{ route('customers.store') }}" method="POST" enctype="multipart/form-data"
                            class="p-4 md:p-5">
                            @csrf
                            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                                <div>
                                    <div class="mb-4">
                                        <label class="block text-sm font-bold text-dark mb-2">الاسم بالعربية</label>
                                        <input type="text" name="name_ar" required
                                            class="w-full p-1 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent transition-all duration-200">
                                        @error('name_ar')
                                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="mb-4">
                                        <label class="block text-sm font-bold text-dark mb-2">رقم السجل التجاري</label>
                                        <input type="text" name="CR"
                                            class="w-full p-1 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent transition-all duration-200">
                                        @error('CR')
                                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="mb-4">
                                        <label class="block text-sm font-bold text-dark mb-2">البريد الإلكتروني</label>
                                        <input type="email" name="email"
                                            class="w-full p-1 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent transition-all duration-200">
                                        @error('email')
                                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="mb-4">
                                        <label class="block text-sm font-bold text-dark mb-2">رقم IBAN</label>
                                        <input type="text" name="IBAN"
                                            class="w-full p-1 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent transition-all duration-200">
                                        @error('IBAN')
                                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div>
                                    <div class="mb-4">
                                        <label class="block text-sm font-bold text-dark mb-2">الاسم بالإنجليزية</label>
                                        <input type="text" name="name_en" required
                                            class="w-full p-1 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent transition-all duration-200">
                                        @error('name_en')
                                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="mb-4">
                                        <label class="block text-sm font-bold text-dark mb-2">الرقم الضريبي</label>
                                        <input type="text" name="tax_number"
                                            class="w-full p-1 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent transition-all duration-200">
                                        @error('tax_number')
                                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="mb-4">
                                        <label class="block text-sm font-bold text-dark mb-2">رقم الهاتف</label>
                                        <input type="text" name="phone"
                                            class="w-full p-1 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent transition-all duration-200">
                                        @error('phone')
                                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="mb-4">
                                        <label class="block text-sm font-bold text-dark mb-2">حد الائتمان</label>
                                        <input type="number" step="0.01" name="credit_limit"
                                            class="w-full p-1 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent transition-all duration-200">
                                        @error('credit_limit')
                                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div>
                                    <div class="mb-4">
                                        <label class="block text-sm font-bold text-dark mb-2">النوع</label>
                                        <select name="type"
                                            class="w-full p-0 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent transition-all duration-200">
                                            <option value="نقدي">نقدي</option>
                                            <option value="آجل">آجل</option>
                                        </select>
                                        @error('type')
                                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="mb-4">
                                        <label class="block text-sm font-bold text-dark mb-2">نسبة الضريبة (%)</label>
                                        <input type="number" step="0.01" name="tax_rate"
                                            class="w-full p-1 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent transition-all duration-200">
                                        @error('tax_rate')
                                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="mb-4">
                                        <label class="block text-sm font-bold text-dark mb-2">العنوان</label>
                                        <input type="text" name="address"
                                            class="w-full p-1 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent transition-all duration-200">
                                        @error('address')
                                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="mb-4">
                                        <label for="activeEdit"
                                            class="block mb-2 text-sm font-bold text-gray-900">نشط</label>
                                        <label class="inline-flex items-center cursor-pointer">
                                            <input type="hidden" name="active" value="0">
                                            <input type="checkbox" name="active" id="activeEdit" value="1" checked
                                                class="sr-only peer">
                                            <div
                                                class="relative w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-orange-300 rounded-full peer peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-orange-500">
                                            </div>
                                        </label>
                                        @error('active')
                                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div>
                                    <div class="mb-4">
                                        <label class="block text-sm font-bold text-dark mb-2">صورة الشعار</label>
                                        <div id="imageBox"
                                            class="relative cursor-pointer group flex items-center justify-center
                                                w-full h-47 border-2 border-dashed border-gray-300 rounded-lg
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
                                        @error('img_url')
                                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div>
                                        <label class="block text-sm font-bold text-dark mb-2">ملاحظات</label>
                                        <textarea name="notes" rows="3"
                                            class="w-full p-1 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent transition-all duration-200"></textarea>
                                        @error('notes')
                                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="flex space-x-3 space-x-reverse mt-8">
                                <button type="submit"
                                    class="flex-1 bg-primary text-white font-bold py-3 rounded-lg hover:opacity-90 transition-all duration-200 flex items-center justify-center">
                                    حفظ العميل
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Table -->
            <div class="overflow-x-auto">
                <table class="w-full border-collapse bg-white rounded-lg overflow-hidden shadow-sm">
                    <thead>
                        <tr class="bg-gray-200">
                            <th class="p-4 text-center font-bold text-gray-700 border-b border-gray-200">#</th>
                            <th class="p-4 text-center font-bold text-gray-700 border-b border-gray-200">الاسم</th>
                            <th class="p-4 text-center font-bold text-gray-700 border-b border-gray-200">الشعار</th>
                            <th class="p-4 text-center font-bold text-gray-700 border-b border-gray-200">النوع</th>
                            <th class="p-4 text-center font-bold text-gray-700 border-b border-gray-200">البريد الإلكتروني
                            </th>
                            <th class="p-4 text-center font-bold text-gray-700 border-b border-gray-200">رقم الهاتف</th>
                            <th class="p-4 text-center font-bold text-gray-700 border-b border-gray-200">الإجراءات</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($customers as $customer)
                            <tr class="hover:bg-orange-100 transition-colors duration-200 {{ !$customer->active ? 'opacity-50 bg-gray-50' : '' }}">
                                <td class="p-4 text-center border-b border-gray-200 font-medium text-gray-600">
                                    {{ $loop->iteration }}
                                    @if (!$customer->active)
                                        <i class="fas fa-ban text-red-500 ml-1"></i>
                                    @endif
                                </td>
                                <td class="p-4 text-center border-b border-gray-200 font-medium text-gray-800">
                                    {{ $customer->name_ar }}
                                </td>
                                <td class="p-4 text-center border-b border-gray-200">
                                    @if ($customer->img_url)
                                        <img src="{{ asset('storage/' . $customer->img_url) }}" alt="شعار العميل"
                                            class="w-12 h-12 object-contain mx-auto {{ !$customer->active ? 'grayscale' : '' }}">
                                    @else
                                        <div class="w-12 h-12 bg-gray-100 flex items-center justify-center rounded-lg mx-auto">
                                            <i class="fas fa-image text-gray-300"></i>
                                        </div>
                                    @endif
                                </td>
                                <td class="p-4 text-center border-b border-gray-200 text-gray-600">
                                    {{ $customer->type ?? 'N/A' }}
                                </td>
                                <td class="p-4 text-center border-b border-gray-200 text-gray-600">
                                    {{ $customer->email ?? 'N/A' }}
                                </td>
                                <td class="p-4 text-center border-b border-gray-200 text-gray-600">
                                    {{ $customer->phone ?? 'N/A' }}
                                </td>
                                <td class="p-4 text-center border-b border-gray-200">
                                    <div class="flex justify-center space-x-2">
                                        <a href="{{ route('customers.show', $customer) }}"
                                            class="inline-flex items-center px-3 py-2 bg-blue-100 text-blue-700 rounded-lg hover:bg-blue-200 transition-colors duration-200">
                                            <i class="fas fa-eye"></i>
                                        </a>
    
                                        <button data-modal-target="edit-customer-modal{{ $customer->id }}"
                                            data-modal-toggle="edit-customer-modal{{ $customer->id }}" type="button"
                                            class="inline-flex items-center px-3 py-2 bg-orange-100 text-orange-700 rounded-lg hover:bg-orange-200 transition-colors duration-200">
                                            <i class="fas fa-edit"></i>
                                        </button>
    
                                        <button data-modal-target="delete-modal{{ $customer->id }}"
                                            data-modal-toggle="delete-modal{{ $customer->id }}" type="button"
                                            class="inline-flex items-center px-3 py-2 bg-red-100 text-red-700 rounded-lg hover:bg-red-200 transition-colors duration-200">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
    
                            {{-- edit modal --}}
                            <div id="edit-customer-modal{{ $customer->id }}" tabindex="-1" aria-hidden="true"
                                class="modal hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                <div class="relative p-4 w-full max-w-6xl max-h-full">
                                    <div class="relative bg-white rounded-lg shadow-sm">
                                        <div
                                            class="flex items-center justify-between p-4 md:p-5 border-b rounded-t border-gray-200">
                                            <h2 class="text-xl font-bold text-gray-800 flex items-center">
                                                <i class="fas fa-edit ml-2 text-orange-500"></i>
                                                تعديل بيانات العميل
                                            </h2>
                                            <button type="button"
                                                class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center"
                                                data-modal-toggle="edit-customer-modal{{ $customer->id }}">
                                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                                    fill="none" viewBox="0 0 14 14">
                                                    <path stroke="currentColor" stroke-linecap="round"
                                                        stroke-linejoin="round" stroke-width="2"
                                                        d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                                </svg>
                                                <span class="sr-only">إغلاق النافذة</span>
                                            </button>
                                        </div>
                                        <div class="p-4">
                                            <form action="{{ route('customers.update', $customer) }}" method="POST"
                                                enctype="multipart/form-data">
                                                @csrf
                                                @method('PUT')
                                                <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                                                    <div>
                                                        <div class="mb-4">
                                                            <label class="block text-sm font-bold text-dark mb-2">الاسم
                                                                بالعربية</label>
                                                            <input type="text" name="name_ar" required
                                                                value="{{ $customer->name_ar }}"
                                                                class="w-full p-1 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent transition-all duration-200">
                                                            @error('name_ar')
                                                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                                            @enderror
                                                        </div>
                                                        <div class="mb-4">
                                                            <label class="block text-sm font-bold text-dark mb-2">رقم السجل
                                                                التجاري</label>
                                                            <input type="text" name="CR" value="{{ $customer->CR }}"
                                                                class="w-full p-1 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent transition-all duration-200">
                                                            @error('CR')
                                                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                                            @enderror
                                                        </div>
                                                        <div class="mb-4">
                                                            <label class="block text-sm font-bold text-dark mb-2">البريد
                                                                الإلكتروني</label>
                                                            <input type="email" name="email"
                                                                value="{{ $customer->email }}"
                                                                class="w-full p-1 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent transition-all duration-200">
                                                            @error('email')
                                                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                                            @enderror
                                                        </div>
                                                        <div class="mb-4">
                                                            <label class="block text-sm font-bold text-dark mb-2">رقم
                                                                IBAN</label>
                                                            <input type="text" name="IBAN"
                                                                value="{{ $customer->IBAN }}"
                                                                class="w-full p-1 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent transition-all duration-200">
                                                            @error('IBAN')
                                                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div>
                                                        <div class="mb-4">
                                                            <label class="block text-sm font-bold text-dark mb-2">الاسم
                                                                بالإنجليزية</label>
                                                            <input type="text" name="name_en" required
                                                                value="{{ $customer->name_en }}"
                                                                class="w-full p-1 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent transition-all duration-200">
                                                            @error('name_en')
                                                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                                            @enderror
                                                        </div>
                                                        <div class="mb-4">
                                                            <label class="block text-sm font-bold text-dark mb-2">الرقم
                                                                الضريبي</label>
                                                            <input type="text" name="tax_number"
                                                                value="{{ $customer->tax_number }}"
                                                                class="w-full p-1 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent transition-all duration-200">
                                                            @error('tax_number')
                                                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                                            @enderror
                                                        </div>
                                                        <div class="mb-4">
                                                            <label class="block text-sm font-bold text-dark mb-2">رقم
                                                                الهاتف</label>
                                                            <input type="text" name="phone"
                                                                value="{{ $customer->phone }}"
                                                                class="w-full p-1 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent transition-all duration-200">
                                                            @error('phone')
                                                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                                            @enderror
                                                        </div>
                                                        <div class="mb-4">
                                                            <label class="block text-sm font-bold text-dark mb-2">حد
                                                                الائتمان</label>
                                                            <input type="number" step="0.01" name="credit_limit"
                                                                value="{{ $customer->credit_limit }}"
                                                                class="w-full p-1 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent transition-all duration-200">
                                                            @error('credit_limit')
                                                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div>
                                                        <div class="mb-4">
                                                            <label class="block text-sm font-bold text-dark mb-2">النوع</label>
                                                            <select name="type"
                                                                class="w-full p-0 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent transition-all duration-200">
                                                                <option value="نقدي"
                                                                    {{ $customer->type == 'نقدي' ? 'selected' : '' }}>نقدي
                                                                </option>
                                                                <option value="آجل"
                                                                    {{ $customer->type == 'آجل' ? 'selected' : '' }}>آجل
                                                                </option>
                                                            </select>
                                                            @error('type')
                                                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                                            @enderror
                                                        </div>
                                                        <div class="mb-4">
                                                            <label class="block text-sm font-bold text-dark mb-2">نسبة الضريبة
                                                                (%)</label>
                                                            <input type="number" step="0.01" name="tax_rate"
                                                                value="{{ $customer->tax_rate }}"
                                                                class="w-full p-1 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent transition-all duration-200">
                                                            @error('tax_rate')
                                                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                                            @enderror
                                                        </div>
                                                        <div class="mb-4">
                                                            <label
                                                                class="block text-sm font-bold text-dark mb-2">العنوان</label>
                                                            <input type="text" name="address"
                                                                value="{{ $customer->address }}"
                                                                class="w-full p-1 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent transition-all duration-200">
                                                            @error('address')
                                                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                                            @enderror
                                                        </div>
                                                        <div class="mb-4">
                                                            <label for="activeEdit{{ $customer->id }}"
                                                                class="block mb-2 text-sm font-bold text-gray-900">نشط</label>
                                                            <label class="inline-flex items-center cursor-pointer">
                                                                <input type="hidden" name="active" value="0">
                                                                <input type="checkbox" name="active"
                                                                    id="activeEdit{{ $customer->id }}" value="1"
                                                                    {{ $customer->active ? 'checked' : '' }}
                                                                    class="sr-only peer">
                                                                <div
                                                                    class="relative w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-orange-300 rounded-full peer peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-orange-500">
                                                                </div>
                                                            </label>
                                                            @error('active')
                                                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div>
                                                        <div class="mb-4">
                                                            <label class="block text-sm font-bold text-dark mb-2">صورة
                                                                الشعار</label>
                                                            <div id="imageBoxEdit{{ $customer->id }}"
                                                                class="relative cursor-pointer group flex items-center justify-center
                                                                        w-full h-47 border-2 border-dashed border-gray-300 rounded-lg
                                                                        bg-gray-50 hover:bg-orange-100 transition-all duration-200">
    
                                                                @if ($customer->img_url)
                                                                    <!-- Current Image -->
                                                                    <img id="imagePreviewEdit{{ $customer->id }}"
                                                                        src="{{ asset('storage/' . $customer->img_url) }}"
                                                                        class="absolute inset-0 w-full h-full object-contain rounded-lg">
    
                                                                    <!-- Overlay -->
                                                                    <div id="imgOverlayEdit{{ $customer->id }}"
                                                                        class="absolute inset-0 bg-black/40 opacity-0 hover:opacity-100
                                                                            flex items-center justify-center text-white text-sm font-semibold transition rounded-lg">
                                                                        تغيير الصورة
                                                                    </div>
                                                                @else
                                                                    <!-- Placeholder -->
                                                                    <div id="imgPlaceholderEdit{{ $customer->id }}"
                                                                        class="flex flex-col items-center text-gray-500 hover:text-orange-700">
                                                                        <i class="fa-solid fa-image text-4xl mb-2"></i>
                                                                        <span class="text-sm">اضغط لاختيار صورة</span>
                                                                    </div>
    
                                                                    <!-- Image Preview (Hidden Initially) -->
                                                                    <img id="imagePreviewEdit{{ $customer->id }}"
                                                                        class="hidden absolute inset-0 w-full h-full object-contain rounded-lg">
    
                                                                    <!-- Overlay (Hidden Initially) -->
                                                                    <div id="imgOverlayEdit{{ $customer->id }}"
                                                                        class="hidden absolute inset-0 bg-black/40 opacity-0 hover:opacity-100
                                                                            flex items-center justify-center text-white text-sm font-semibold transition rounded-lg">
                                                                        تغيير الصورة
                                                                    </div>
                                                                @endif
                                                            </div>
                                                            <input id="imageInputEdit{{ $customer->id }}" type="file"
                                                                name="img_url" accept="image/*" class="hidden">
                                                            @error('img_url')
                                                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                                            @enderror
                                                        </div>
                                                        <div>
                                                            <label
                                                                class="block text-sm font-bold text-dark mb-2">ملاحظات</label>
                                                            <textarea name="notes" rows="3"
                                                                class="w-full p-1 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent transition-all duration-200">{{ $customer->notes }}</textarea>
                                                            @error('notes')
                                                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="flex space-x-3 space-x-reverse mt-8">
                                                    <button type="submit"
                                                        class="flex-1 bg-primary text-white font-bold py-3 rounded-lg hover:opacity-90 transition-all duration-200 flex items-center justify-center">
                                                        حفظ التعديلات
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
    
                            {{-- delete modal --}}
                            <div id="delete-modal{{ $customer->id }}" tabindex="-1"
                                class="modal hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                <div class="relative p-4 w-full max-w-md max-h-full">
                                    <div class="relative bg-white rounded-lg shadow-sm">
                                        <button type="button"
                                            class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center"
                                            data-modal-hide="delete-modal{{ $customer->id }}">
                                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                                fill="none" viewBox="0 0 14 14">
                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                    stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                            </svg>
                                            <span class="sr-only">إغلاق النافذة</span>
                                        </button>
                                        <div class="p-4 md:p-5 text-center">
                                            <svg class="mx-auto mb-4 text-red-500 w-12 h-12" aria-hidden="true"
                                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                    stroke-width="2"
                                                    d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                            </svg>
                                            <h3 class="mb-5 text-lg font-normal text-dark">هل أنت متأكد من حذف العميل
                                                <strong>{{ $customer->name_ar }}</strong>؟</h3>
                                            <p
                                                class="mb-5 text-sm font-medium text-amber-600 bg-amber-50 border border-amber-200 rounded-lg p-3">
                                                <i class="fas fa-exclamation-triangle ml-2"></i>
                                                سيتم حذف جميع البيانات المرتبطة بهذا العميل.
                                            </p>
                                            <form action="{{ route('customers.destroy', $customer) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button data-modal-hide="delete-modal{{ $customer->id }}" type="submit"
                                                    class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-bold rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
                                                    حذف
                                                </button>
                                                <button data-modal-hide="delete-modal{{ $customer->id }}" type="button"
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
                                <td colspan="7" class="p-8 text-center text-gray-500">
                                    <div class="flex flex-col items-center">
                                        <i class="fas fa-users text-4xl text-gray-300 mb-4"></i>
                                        <p class="text-lg">لا يوجد عملاء متاحين</p>
                                        <p class="text-sm text-gray-400 mt-2">ابدأ بإضافة عميل جديد</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        $('#typeFilter').select2({
            placeholder: 'كل الانواع',
            allowClear: true,
            dir: 'rtl',
            language: {
                noResults: function() {
                    return 'لا توجد نتائج';
                },
                searching: function() {
                    return 'جارِ البحث...';
                }
            },
            theme: 'default',
            width: '100%'
        });

        // Add customer modal image handling
        const imageBox = document.getElementById('imageBox');
        const input = document.getElementById('imageInput');
        const preview = document.getElementById('imagePreview');
        const placeholder = document.getElementById('imgPlaceholder');
        const overlay = document.getElementById('imgOverlay');

        if (imageBox && input && preview && placeholder && overlay) {
            imageBox.addEventListener('click', () => input.click());

            input.addEventListener('change', () => {
                const file = input.files[0];
                if (!file) return;

                preview.src = URL.createObjectURL(file);
                preview.classList.remove('hidden');
                placeholder.classList.add('hidden');

                overlay.classList.remove('hidden');
            });
        }

        // Edit customer modals image handling
        @foreach ($customers as $customer)
            (function() {
                const imageBoxEdit = document.getElementById('imageBoxEdit{{ $customer->id }}');
                const inputEdit = document.getElementById('imageInputEdit{{ $customer->id }}');
                const previewEdit = document.getElementById('imagePreviewEdit{{ $customer->id }}');
                const placeholderEdit = document.getElementById('imgPlaceholderEdit{{ $customer->id }}');
                const overlayEdit = document.getElementById('imgOverlayEdit{{ $customer->id }}');

                if (imageBoxEdit && inputEdit && previewEdit && overlayEdit) {
                    imageBoxEdit.addEventListener('click', () => inputEdit.click());

                    inputEdit.addEventListener('change', () => {
                        const file = inputEdit.files[0];
                        if (!file) return;

                        previewEdit.src = URL.createObjectURL(file);
                        previewEdit.classList.remove('hidden');

                        if (placeholderEdit) {
                            placeholderEdit.classList.add('hidden');
                        }

                        overlayEdit.classList.remove('hidden');
                    });
                }
            })();
        @endforeach

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
    </script>

@endsection
