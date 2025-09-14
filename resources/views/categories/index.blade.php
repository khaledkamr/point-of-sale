@extends('layouts.app')

@section('title', 'المستودعات')

@section('content')
    <h1 class="text-3xl font-bold text-gray-800 flex items-center mb-6">
        <i class="fas fa-tags ml-3 text-orange-500"></i>
        الأصنـــاف
    </h1>
    <div class="bg-white p-6 rounded-lg shadow-md">
        <!-- Header -->
        <div class="flex justify-between items-center gap-8 mb-6">
            <form class="flex-1">
                <div class="flex">
                    <label for="search-dropdown" class="mb-2 text-sm font-medium text-gray-900 sr-only">Your Email</label>
                    <button id="dropdown-button" data-dropdown-toggle="dropdown" class="shrink-0 inline-flex items-center py-2.5 px-4 text-sm font-medium text-center text-gray-900 bg-gray-100 border border-gray-300 rounded-s-lg hover:bg-gray-200 focus:ring-4 focus:outline-none focus:ring-gray-100" type="button">
                        كل المواقع 
                        <svg class="w-2.5 h-2.5 ms-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
                        </svg>
                    </button>
                    <div id="dropdown" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow-sm w-44">
                        <ul class="py-2 text-sm text-gray-700" aria-labelledby="dropdown-button">
                        <li>
                            <button type="button" class="inline-flex w-full px-4 py-2 hover:bg-orange-200">الرياض</button>
                        </li>
                        <li>
                            <button type="button" class="inline-flex w-full px-4 py-2 hover:bg-orange-200">الدمام</button>
                        </li>
                        <li>
                            <button type="button" class="inline-flex w-full px-4 py-2 hover:bg-orange-200">المدينة</button>
                        </li>
                        <li>
                            <button type="button" class="inline-flex w-full px-4 py-2 hover:bg-orange-200">مكه</button>
                        </li>
                        </ul>
                    </div>
                    <div class="relative w-full">
                        <input type="search" id="search-dropdown" class="block p-2.5 w-full z-20 text-sm text-gray-900 bg-gray-50 rounded-e-lg border-s-gray-50 border-s-2 border border-gray-300 focus:ring-orange-500 focus:border-orange-500" placeholder="إبحث عن صنف بالإسم او بالرقم" required />
                        <button type="submit" class="absolute top-0 end-0 p-2.5 text-sm font-medium h-full text-white bg-primary rounded-e-lg border border-orange-500 hover:bg-orange-800 focus:ring-4 focus:outline-none focus:ring-orange-300">
                            <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                            </svg>
                            <span class="sr-only">Search</span>
                        </button>
                    </div>
                </div>
            </form>

            <button data-modal-target="add-warehouse-modal" data-modal-toggle="add-warehouse-modal" type="button"
                    class="bg-primary text-white px-6 py-2 rounded-lg hover:opacity-90 transition-all duration-300 flex items-center">
                <i class="fas fa-plus ml-2"></i>
                إضافة صنف جديد
            </button>

            <div id="add-warehouse-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                <div class="relative p-4 w-full max-w-md max-h-full">
                    <div class="relative bg-white rounded-lg shadow-sm">
                        <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t border-gray-200">
                            <h2 class="text-xl font-bold text-gray-800 flex items-center">
                                <i class="fas fa-plus-circle ml-2 text-orange-500"></i>
                                إضافة صنف جديد
                            </h2>
                            <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center" data-modal-toggle="add-warehouse-modal">
                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                </svg>
                                <span class="sr-only">Close modal</span>
                            </button>
                        </div>
                        <form action="{{ route('categories.store') }}" method="POST" class="p-4 md:p-5">
                            @csrf
                            <div class="space-y-4">
                                <div>
                                    <label class="block text-sm font-bold text-dark mb-2">إسم الصنف</label>
                                    <input type="text" name="name" required
                                        class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent transition-all duration-200"
                                        placeholder="أدخل اسم المستودع">
                                </div>
                                <div>
                                    <label class="block text-sm font-bold text-dark mb-2">إسم الصنف الأب</label>
                                    <input type="text" name="parent_id"
                                        class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent transition-all duration-200"
                                        placeholder="أدخل موقع المستودع">
                                </div>
                            </div>
                            <div class="flex space-x-3 space-x-reverse mt-8">
                                <button type="submit" class="flex-1 bg-primary text-white font-bold py-3 rounded-lg hover:opacity-90 transition-all duration-200 flex items-center justify-center">
                                    حفظ الصنف
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
                        <th class="p-4 text-center font-bold text-gray-700 border-b border-gray-200">الرقم</th>
                        <th class="p-4 text-center font-bold text-gray-700 border-b border-gray-200">الإسم</th>
                        <th class="p-4 text-center font-bold text-gray-700 border-b border-gray-200">الصنف الأب</th>
                        <th class="p-4 text-center font-bold text-gray-700 border-b border-gray-200">الإجراءات</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($categories as $category)
                        <tr class="hover:bg-orange-100 transition-colors duration-200">
                            <td class="p-4 text-center border-b border-gray-200 font-medium text-gray-600">
                                {{ $category->id }}
                            </td>
                            <td class="p-4 text-center border-b border-gray-200 font-medium text-gray-800">
                                {{ $category->name }}
                            </td>
                            <td class="p-4 text-center border-b border-gray-200 text-gray-600">
                                {{ $category->parent->name ?? '-' }}
                            </td>
                            <td class="p-4 text-center border-b border-gray-200">
                                <div class="flex justify-center space-x-2">
                                    <!-- View Button -->
                                    <a href="" 
                                       class="inline-flex items-center px-3 py-2 bg-blue-100 text-blue-700 rounded-lg hover:bg-blue-200 transition-colors duration-200">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    
                                    <!-- Edit Button -->
                                    <button data-modal-target="edit-category-modal{{ $category->id }}" data-modal-toggle="edit-category-modal{{ $category->id }}" type="button"
                                            class="inline-flex items-center px-3 py-2 bg-orange-100 text-orange-700 rounded-lg hover:bg-orange-200 transition-colors duration-200">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    
                                    <!-- Delete Button -->
                                    <button data-modal-target="delete-modal{{ $category->id }}" data-modal-toggle="delete-modal{{ $category->id }}" type="button"
                                            class="inline-flex items-center px-3 py-2 bg-red-100 text-red-700 rounded-lg hover:bg-red-200 transition-colors duration-200">
                                        <i class="fas fa-trash "></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        
                        {{-- edit modal --}}
                        <div id="edit-category-modal{{ $category->id }}" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                            <div class="relative p-4 w-full max-w-md max-h-full">
                                <div class="relative bg-white rounded-lg shadow-sm">
                                    <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t border-gray-200">
                                        <h2 class="text-xl font-bold text-gray-800 flex items-center">
                                            <i class="fas fa-edit ml-2 text-orange-500"></i>
                                            تعديل بيانات الصنف
                                        </h2>
                                        <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center" data-modal-toggle="edit-category-modal{{ $category->id }}">
                                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                            </svg>
                                            <span class="sr-only">Close modal</span>
                                        </button>
                                    </div>
                                    <div class="p-4">
                                        <form action="{{ route('categories.update', $category) }}" method="POST" class="pt-3">
                                            @csrf
                                            @method('PUT')
                                            <div class="space-y-4">
                                                <div>
                                                    <label class="block text-sm font-bold text-dark mb-2">اسم الصنف</label>
                                                    <input type="text" id="editName" name="name" required value="{{ $category->name }}"
                                                        class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent transition-all duration-200">
                                                </div>
                                                <div>
                                                    <label class="block text-sm font-bold text-dark mb-2">إسم الصنف الأب</label>
                                                    <input type="text" id="editLocation" name="location" value="{{ $category->parent->id ?? '' }}"
                                                        class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent transition-all duration-200">
                                                </div>
                                            </div>
                                            <div class="flex space-x-3 space-x-reverse mt-6">
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
                        <div id="delete-modal{{ $category->id }}" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                            <div class="relative p-4 w-full max-w-md max-h-full">
                                <div class="relative bg-white rounded-lg shadow-sm">
                                    <button type="button" class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center" data-modal-hide="delete-modal{{ $category->id }}">
                                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                        </svg>
                                        <span class="sr-only">Close modal</span>
                                    </button>
                                    <div class="p-4 md:p-5 text-center">
                                        <svg class="mx-auto mb-4 text-red-500 w-12 h-12" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                                        </svg>
                                        <h3 class="mb-5 text-lg font-normal text-dark">هل انت متأكد من حذف الصنف <strong>{{ $category->name }}</strong>؟</h3>
                                        <form action="{{ route('categories.destroy', $category) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button data-modal-hide="delete-modal{{ $category->id }}" type="submit" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-bold rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
                                                حذف
                                            </button>
                                            <button data-modal-hide="delete-modal{{ $category->id }}" type="button" class="py-2.5 px-5 ms-3 text-sm font-bold text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100">
                                                إلغاء
                                            </button>
                                        </form>    
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <tr>
                            <td colspan="4" class="p-8 text-center text-gray-500">
                                <div class="flex flex-col items-center">
                                    <i class="fas fa-tags text-4xl text-gray-300 mb-4"></i>
                                    <p class="text-lg">لا توجد أصناف متاحة</p>
                                    <p class="text-sm text-gray-400 mt-2">ابدأ بإضافة صنف جديد</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection