@extends('layouts.app')

@section('title', 'المستودعات')

@section('content')
    <div class="bg-white p-6 rounded-lg shadow-md">
        <!-- Header -->
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold text-gray-800 flex items-center">
                <i class="fas fa-warehouse ml-3 text-orange-500"></i>
                المستودعات
            </h1>
            <button onclick="openAddModal()" 
                    class="bg-primary text-white px-6 py-3 rounded-lg hover:opacity-90 transition-all duration-300 flex items-center">
                <i class="fas fa-plus ml-2"></i>
                إضافة مستودع جديد
            </button>
        </div>

        <!-- Table -->
        <div class="overflow-x-auto">
            <table class="w-full border-collapse bg-white rounded-lg overflow-hidden shadow-sm">
                <thead>
                    <tr class="bg-gradient-to-r from-gray-50 to-gray-100">
                        <th class="p-4 text-center font-semibold text-gray-700 border-b border-gray-200">الرقم</th>
                        <th class="p-4 text-center font-semibold text-gray-700 border-b border-gray-200">الاسم</th>
                        <th class="p-4 text-center font-semibold text-gray-700 border-b border-gray-200">الموقع</th>
                        <th class="p-4 text-center font-semibold text-gray-700 border-b border-gray-200">الإجراءات</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($warehouses as $warehouse)
                        <tr class="hover:bg-gray-50 transition-colors duration-200">
                            <td class="p-4 text-center border-b border-gray-100 font-medium text-gray-600">
                                {{ $warehouse->id }}
                            </td>
                            <td class="p-4 text-center border-b border-gray-100 font-medium text-gray-800">
                                {{ $warehouse->name }}
                            </td>
                            <td class="p-4 text-center border-b border-gray-100 text-gray-600">
                                {{ $warehouse->location }}
                            </td>
                            <td class="p-4 text-center border-b border-gray-100">
                                <div class="flex justify-center space-x-2 space-x-reverse">
                                    <!-- View Button -->
                                    <a href="{{ route('warehouses.show', $warehouse) }}" 
                                       class="inline-flex items-center px-3 py-2 bg-blue-100 text-blue-700 rounded-lg hover:bg-blue-200 transition-colors duration-200">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    
                                    <!-- Edit Button -->
                                    <button onclick="openEditModal({{ $warehouse->id }}, '{{ $warehouse->name }}', '{{ $warehouse->location }}')" 
                                            class="inline-flex items-center px-3 py-2 bg-orange-100 text-orange-700 rounded-lg hover:bg-orange-200 transition-colors duration-200">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    
                                    <!-- Delete Button -->
                                    <button onclick="openDeleteModal({{ $warehouse->id }}, '{{ $warehouse->name }}')" 
                                            class="inline-flex items-center px-3 py-2 bg-red-100 text-red-700 rounded-lg hover:bg-red-200 transition-colors duration-200">
                                        <i class="fas fa-trash "></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="p-8 text-center text-gray-500">
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

        <!-- Pagination (if applicable) -->
        @if(method_exists($warehouses, 'links'))
            <div class="mt-6">
                {{ $warehouses->links() }}
            </div>
        @endif
    </div>

    <!-- Add Warehouse Modal -->
    <div id="addModal" class="fixed inset-0 bg-gray-900/80 hidden items-center justify-center z-50">
        <div class="bg-white rounded-lg p-6 w-full max-w-md mx-4 transform scale-95 transition-transform duration-300">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-xl font-bold text-gray-800 flex items-center">
                    <i class="fas fa-plus-circle ml-2 text-orange-500"></i>
                    إضافة مستودع جديد
                </h2>
                <button onclick="closeAddModal()" class="text-gray-400 hover:text-gray-600 transition-colors">
                    <i class="fas fa-times text-xl"></i>
                </button>
            </div>
            
            <form action="{{ route('warehouses.store') }}" method="POST">
                @csrf
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">اسم المستودع</label>
                        <input type="text" name="name" required
                               class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent transition-all duration-200"
                               placeholder="أدخل اسم المستودع">
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">الموقع</label>
                        <input type="text" name="location" required
                               class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent transition-all duration-200"
                               placeholder="أدخل موقع المستودع">
                    </div>
                </div>
                
                <div class="flex space-x-3 space-x-reverse mt-6">
                    <button type="submit" 
                            class="flex-1 bg-primary text-white py-3 rounded-lg hover:opacity-90 transition-all duration-200 flex items-center justify-center">
                        <i class="fas fa-save ml-2"></i>
                        حفظ
                    </button>
                    <button type="button" onclick="closeAddModal()"
                            class="flex-1 bg-gray-300 text-gray-700 py-3 rounded-lg hover:bg-gray-400 transition-all duration-200">
                        إلغاء
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Edit Warehouse Modal -->
    <div id="editModal" class="fixed inset-0 bg-gray-900/80 hidden items-center justify-center z-50">
        <div class="bg-white rounded-lg p-6 w-full max-w-md mx-4 transform scale-95 transition-transform duration-300">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-xl font-bold text-gray-800 flex items-center">
                    <i class="fas fa-edit ml-2 text-orange-500"></i>
                    تعديل المستودع
                </h2>
                <button onclick="closeEditModal()" class="text-gray-400 hover:text-gray-600 transition-colors">
                    <i class="fas fa-times text-xl"></i>
                </button>
            </div>
            
            <form id="editForm" method="POST">
                @csrf
                @method('PUT')
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">اسم المستودع</label>
                        <input type="text" id="editName" name="name" required
                               class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent transition-all duration-200">
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">الموقع</label>
                        <input type="text" id="editLocation" name="location" required
                               class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent transition-all duration-200">
                    </div>
                </div>
                
                <div class="flex space-x-3 space-x-reverse mt-6">
                    <button type="submit" 
                            class="flex-1 bg-primary text-white py-3 rounded-lg hover:opacity-90 transition-all duration-200 flex items-center justify-center">
                        <i class="fas fa-save ml-2"></i>
                        تحديث
                    </button>
                    <button type="button" onclick="closeEditModal()"
                            class="flex-1 bg-gray-300 text-gray-700 py-3 rounded-lg hover:bg-gray-400 transition-all duration-200">
                        إلغاء
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div id="deleteModal" class="fixed inset-0 bg-gray-900/80 hidden items-center justify-center z-50">
        <div class="bg-white rounded-lg p-6 w-full max-w-md mx-4 transform scale-95 transition-transform duration-300">
            <div class="flex items-center mb-4">
                <div class="w-12 h-12 bg-red-100 rounded-full flex items-center justify-center ml-4">
                    <i class="fas fa-exclamation-triangle text-red-600 text-xl"></i>
                </div>
                <div>
                    <h2 class="text-xl font-bold text-gray-800">تأكيد الحذف</h2>
                    <p class="text-sm text-gray-600 mt-1">هذا الإجراء لا يمكن التراجع عنه</p>
                </div>
            </div>
            
            <p class="text-gray-700 mb-6">
                هل أنت متأكد من أنك تريد حذف المستودع 
                <strong id="deleteWarehouseName" class="text-red-600"></strong>؟
            </p>
            
            <form id="deleteForm" method="POST">
                @csrf
                @method('DELETE')
                <div class="flex space-x-3 space-x-reverse">
                    <button type="submit" 
                            class="flex-1 bg-red-600 text-white py-3 rounded-lg hover:bg-red-700 transition-all duration-200 flex items-center justify-center">
                        <i class="fas fa-trash ml-2"></i>
                        نعم، احذف
                    </button>
                    <button type="button" onclick="closeDeleteModal()"
                            class="flex-1 bg-gray-300 text-gray-700 py-3 rounded-lg hover:bg-gray-400 transition-all duration-200">
                        إلغاء
                    </button>
                </div>
            </form>
        </div>
    </div>

    <style>
        #addModal.show, #editModal.show, #deleteModal.show {
            display: flex !important;
        }
    </style>

    <script>
        // Add Modal Functions
        function openAddModal() {
            const modal = document.getElementById('addModal');
            modal.classList.remove('hidden');
            modal.classList.add('show');
            setTimeout(() => {
                modal.querySelector('.transform').style.transform = 'scale(1)';
            }, 10);
        }

        function closeAddModal() {
            const modal = document.getElementById('addModal');
            modal.querySelector('.transform').style.transform = 'scale(0.95)';
            setTimeout(() => {
                modal.classList.add('hidden');
                modal.classList.remove('show');
                // Clear form
                modal.querySelector('form').reset();
            }, 300);
        }

        // Edit Modal Functions
        function openEditModal(id, name, location) {
            const modal = document.getElementById('editModal');
            const form = document.getElementById('editForm');
            const nameInput = document.getElementById('editName');
            const locationInput = document.getElementById('editLocation');

            // Set form action
            form.action = `{{ url('/warehouses') }}/${id}`;
            
            // Populate form fields
            nameInput.value = name;
            locationInput.value = location;

            modal.classList.remove('hidden');
            modal.classList.add('show');
            setTimeout(() => {
                modal.querySelector('.transform').style.transform = 'scale(1)';
            }, 10);
        }

        function closeEditModal() {
            const modal = document.getElementById('editModal');
            modal.querySelector('.transform').style.transform = 'scale(0.95)';
            setTimeout(() => {
                modal.classList.add('hidden');
                modal.classList.remove('show');
            }, 300);
        }

        // Delete Modal Functions
        function openDeleteModal(id, name) {
            const modal = document.getElementById('deleteModal');
            const form = document.getElementById('deleteForm');
            const nameSpan = document.getElementById('deleteWarehouseName');

            // Set form action
            form.action = `{{ url('/warehouses') }}/${id}`;
            
            // Set warehouse name
            nameSpan.textContent = name;

            modal.classList.remove('hidden');
            modal.classList.add('show');
            setTimeout(() => {
                modal.querySelector('.transform').style.transform = 'scale(1)';
            }, 10);
        }

        function closeDeleteModal() {
            const modal = document.getElementById('deleteModal');
            modal.querySelector('.transform').style.transform = 'scale(0.95)';
            setTimeout(() => {
                modal.classList.add('hidden');
                modal.classList.remove('show');
            }, 300);
        }

        // Close modals when clicking outside
        document.addEventListener('click', function(event) {
            const modals = ['addModal', 'editModal', 'deleteModal'];
            modals.forEach(modalId => {
                const modal = document.getElementById(modalId);
                if (event.target === modal) {
                    if (modalId === 'addModal') closeAddModal();
                    else if (modalId === 'editModal') closeEditModal();
                    else if (modalId === 'deleteModal') closeDeleteModal();
                }
            });
        });

        // Close modals with Escape key
        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape') {
                closeAddModal();
                closeEditModal();
                closeDeleteModal();
            }
        });
    </script>
@endsection