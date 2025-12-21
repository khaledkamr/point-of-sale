@extends('layouts.app')

@section('title', 'المستودعات')

@section('content')
<div class="p-6">
    <h1 class="text-3xl font-bold text-gray-800 flex items-center mb-6">
        <i class="fas fa-warehouse ml-3 text-orange-500"></i>
        المستودعات
    </h1>

    <div class="bg-white p-6 rounded-lg shadow-md">

        <div class="flex items-center gap-5 mb-6">
            <form class="flex-1">
                <div class="relative w-full">
                    <input type="search" id="search-dropdown" name="search" value="{{ request('search') }}"
                        class="block p-2.5 w-full z-20 text-sm text-gray-900 bg-gray-50 rounded-e-lg border-gray-50 border-s-2 border border-gray-300 focus:ring-orange-500 focus:border-orange-500"
                        placeholder="إبحث عن مستودع بالإسم" />
                    @if (request('search'))
                        <a href="{{ route('warehouses.index', array_merge(request()->except('search'), request()->only(['location']))) }}"
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
                @foreach (request()->except('location') as $key => $value)
                    <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                @endforeach
                <select id="locationFilter" name="location"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-orange-500 focus:border-orange-500 block p-1.5"
                    onchange="this.form.submit()">
                    <option value="all">كل المواقع</option>
                    @foreach ($locations as $location)
                        <option value="{{ $location }}"
                            {{ request('location') == $location ? 'selected' : '' }}>
                            {{ $location }}
                        </option>
                    @endforeach
                </select>
            </form>

            <button data-modal-target="add-warehouse-modal" data-modal-toggle="add-warehouse-modal" type="button"
                    class="bg-primary text-white px-6 py-2 rounded-lg hover:opacity-90 transition-all duration-300 flex items-center">
                <i class="fas fa-plus ml-2"></i>
                إضافة مستودع جديد
            </button>
        </div>
        
        <!-- add modal -->
        <div id="add-warehouse-modal" tabindex="-1" aria-hidden="true" class="modal hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
            <div class="relative p-4 w-full max-w-md max-h-full">
                <div class="relative bg-white rounded-lg shadow-sm">
                    <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t border-gray-200">
                        <h2 class="text-xl font-bold text-gray-800 flex items-center">
                            <i class="fas fa-plus-circle ml-2 text-orange-500"></i>
                            إضافة مستودع جديد
                        </h2>
                        <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center" data-modal-toggle="add-warehouse-modal">
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                            </svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                    </div>
                    <form action="{{ route('warehouses.store') }}" method="POST" class="p-4 md:p-5">
                        @csrf
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-bold text-dark mb-2">إسم المستودع بالعربي</label>
                                <input type="text" name="name_ar" required
                                    class="w-full p-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent transition-all duration-200">
                            </div>
                            <div>
                                <label class="block text-sm font-bold text-dark mb-2">إسم المستودع بالإنجليزي</label>
                                <input type="text" name="name_en" required
                                    class="w-full p-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent transition-all duration-200">
                            </div>
                            <div>
                                <label class="block text-sm font-bold text-dark mb-2">الموقع</label>
                                <input type="text" name="location" required
                                    class="w-full p-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent transition-all duration-200">
                            </div>
                        </div>
                        <div class="flex space-x-3 space-x-reverse mt-8">
                            <button type="submit" class="flex-1 bg-primary text-white font-bold py-3 rounded-lg hover:opacity-90 transition-all duration-200 flex items-center justify-center">
                                حفظ المستودع
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
                        <th class="p-4 text-center font-bold text-gray-700 border-b border-gray-200">الموقع</th>
                        <th class="p-4 text-center font-bold text-gray-700 border-b border-gray-200">عدد المنتجات</th>
                        <th class="p-4 text-center font-bold text-gray-700 border-b border-gray-200">الإجراءات</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($warehouses as $warehouse)
                        <tr class="hover:bg-orange-100 transition-colors duration-200">
                            <td class="p-4 text-center border-b border-gray-200 font-medium text-gray-600">
                                {{ $warehouse->id }}
                            </td>
                            <td class="p-4 text-center border-b border-gray-200 font-medium text-gray-800">
                                {{ $warehouse->name_ar }}
                            </td>
                            <td class="p-4 text-center border-b border-gray-200 text-gray-600">
                                {{ $warehouse->location }}
                            </td>
                            <td class="p-4 text-center border-b border-gray-200 text-gray-600">
                                {{ $warehouse->stocks->count() * $warehouse->stocks->sum('quantity') }}
                            </td>
                            <td class="p-4 text-center border-b border-gray-200">
                                <div class="flex justify-center space-x-2">
                                    <a href="" class="inline-flex items-center px-3 py-2 bg-blue-100 text-blue-700 rounded-lg hover:bg-blue-200 transition-colors duration-200">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    
                                    <button data-modal-target="edit-warehouse-modal{{ $warehouse->id }}" data-modal-toggle="edit-warehouse-modal{{ $warehouse->id }}" type="button"
                                            class="inline-flex items-center px-3 py-2 bg-orange-100 text-orange-700 rounded-lg hover:bg-orange-200 transition-colors duration-200">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    
                                    <button data-modal-target="delete-modal{{ $warehouse->id }}" data-modal-toggle="delete-modal{{ $warehouse->id }}" type="button"
                                            class="inline-flex items-center px-3 py-2 bg-red-100 text-red-700 rounded-lg hover:bg-red-200 transition-colors duration-200">
                                        <i class="fas fa-trash "></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        
                        {{-- edit modal --}}
                        <div id="edit-warehouse-modal{{ $warehouse->id }}" tabindex="-1" aria-hidden="true" class="modal hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                            <div class="relative p-4 w-full max-w-md max-h-full">
                                <div class="relative bg-white rounded-lg shadow-sm">
                                    <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t border-gray-200">
                                        <h2 class="text-xl font-bold text-gray-800 flex items-center">
                                            <i class="fas fa-edit ml-2 text-orange-500"></i>
                                            تعديل بيانات المستودع
                                        </h2>
                                        <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center" data-modal-toggle="edit-warehouse-modal{{ $warehouse->id }}">
                                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                            </svg>
                                            <span class="sr-only">Close modal</span>
                                        </button>
                                    </div>
                                    <div class="p-4">
                                        <form action="{{ route('warehouses.update', $warehouse) }}" method="POST" class="pt-3">
                                            @csrf
                                            @method('PUT')
                                            <div class="space-y-4">
                                                <div>
                                                    <label class="block text-sm font-bold text-dark mb-2">اسم المستودع بالعربي</label>
                                                    <input type="text" id="editNameAr" name="name_ar" required value="{{ $warehouse->name_ar }}"
                                                        class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent transition-all duration-200">
                                                </div>
                                                <div>
                                                    <label class="block text-sm font-bold text-dark mb-2">اسم المستودع بالإنجليزي</label>
                                                    <input type="text" id="editNameEn" name="name_en" required value="{{ $warehouse->name_en }}"
                                                        class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent transition-all duration-200">
                                                </div>
                                                <div>
                                                    <label class="block text-sm font-bold text-dark mb-2">الموقع</label>
                                                    <input type="text" id="editLocation" name="location" required value="{{ $warehouse->location }}"
                                                        class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent transition-all duration-200">
                                                </div>
                                            </div>
                                            <div class="flex space-x-3 space-x-reverse mt-6">
                                                <button type="submit" class="flex-1 bg-primary text-white font-bold py-3 rounded-lg hover:opacity-90 transition-all duration-200 flex items-center justify-center">
                                                    حفظ التعديلات
                                                </button>
                                            </div>
                                        </form>
                                    </div>

                                </div>
                            </div>
                        </div> 

                        {{-- delete modal --}}
                        <div id="delete-modal{{ $warehouse->id }}" tabindex="-1" class="modal hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                            <div class="relative p-4 w-full max-w-md max-h-full">
                                <div class="relative bg-white rounded-lg shadow-sm">
                                    <button type="button" class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center" data-modal-hide="delete-modal{{ $warehouse->id }}">
                                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                        </svg>
                                        <span class="sr-only">Close modal</span>
                                    </button>
                                    <div class="p-4 md:p-5 text-center">
                                        <svg class="mx-auto mb-4 text-red-500 w-12 h-12" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                                        </svg>
                                        <h3 class="mb-5 text-lg font-normal text-dark">هل انت متأكد من حذف مستودع <strong>{{ $warehouse->name_ar }}</strong>؟</h3>
                                      
                                        <p class="mb-5 text-sm font-medium text-amber-600 bg-amber-50 border border-amber-200 rounded-lg p-3">
                                                <i class="fas fa-exclamation-triangle ml-2"></i>
                                                <span class="font-bold">تحذير:</span> سيتم حذف جميع المنتجات المرتبطة بهذا المستودع
                                            </p>
                                        <form action="{{ route('warehouses.destroy', $warehouse) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button data-modal-hide="delete-modal{{ $warehouse->id }}" type="submit" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-bold rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
                                                حذف
                                            </button>
                                            <button data-modal-hide="delete-modal{{ $warehouse->id }}" type="button" class="py-2.5 px-5 ms-3 text-sm font-bold text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100">
                                                إلغاء
                                            </button>
                                        </form>    
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <tr>
                            <td colspan="5" class="p-8 text-center text-gray-500">
                                <div class="flex flex-col items-center">
                                    <i class="fas fa-warehouse text-4xl text-gray-300 mb-4"></i>
                                    <p class="text-lg">لا توجد مستودعات متاحة</p>
                                    <p class="text-sm text-gray-400 mt-2">ابدأ بإضافة مستودع جديد</p>
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
    $('#locationFilter').select2({
        placeholder: 'كل المواقع',
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