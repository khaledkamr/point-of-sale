@extends('layouts.app')

@section('title', 'أوامر الشراء')

@section('content')
    <div class="p-6">
        <!-- Page Header -->
        <div class="bg-white p-6 rounded-lg shadow-md mb-6">
            <div class="flex flex-col lg:flex-row lg:justify-between lg:items-center gap-4">
                <h1 class="text-3xl font-bold text-gray-800 flex items-center">
                    <i class="fas fa-shopping-cart ml-3 text-orange-500"></i>
                    أوامر الشراء
                </h1>

                <div class="flex flex-col sm:flex-row gap-4 lg:items-center">
                    <div class="relative">
                        <input type="text" id="searchInput" placeholder="البحث في أوامر الشراء..."
                            class="w-full sm:w-64 pr-10 pl-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent">
                        <div class="absolute inset-y-0 right-0 pr-3 flex items-center">
                            <i class="fas fa-search text-gray-400"></i>
                        </div>
                    </div>

                    <select id="statusFilter" class="w-full sm:w-48 px-4 py-1 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent">
                        <option value="">جميع الحالات</option>
                        <option value="pending">قيد الانتظار</option>
                        <option value="completed">مكتمل</option>
                        <option value="cancelled">ملغي</option>
                    </select>

                    <button type="button" onclick="openAddPurchaseOrderModal()"
                        class="hidden lg:flex bg-orange-500 text-white font-bold px-6 py-2 rounded-lg hover:opacity-90 transition-all duration-300 items-center">
                        <i class="fas fa-plus ml-2"></i>
                        أمر شراء جديد
                    </button>
                </div>
            </div>
        </div>

        <!-- Statistics Cards -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-6">
            <div class="bg-white py-3 px-6 rounded-lg shadow-md">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-600 mb-1">إجمالي الأوامر</p>
                        <p class="text-2xl font-bold text-gray-800">{{ count($purchaseOrders) }}</p>
                    </div>
                    <div class="w-12 h-12 bg-orange-100 rounded-lg flex items-center justify-center">
                        <i class="fas fa-shopping-cart text-orange-600 text-xl"></i>
                    </div>
                </div>
            </div>
            <div class="bg-white py-3 px-6 rounded-lg shadow-md">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-600 mb-1">قيد الانتظار</p>
                        <p class="text-2xl font-bold text-yellow-600">
                            {{ $purchaseOrders->where('status', 'pending')->count() }}
                        </p>
                    </div>
                    <div class="w-12 h-12 bg-yellow-100 rounded-lg flex items-center justify-center">
                        <i class="fas fa-clock text-yellow-600 text-xl"></i>
                    </div>
                </div>
            </div>
            <div class="bg-white py-3 px-6 rounded-lg shadow-md">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-600 mb-1">تم الإستلام</p>
                        <p class="text-2xl font-bold text-green-600">
                            {{ $purchaseOrders->where('status', 'completed')->count() }}
                        </p>
                    </div>
                    <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                        <i class="fas fa-check-circle text-green-600 text-xl"></i>
                    </div>
                </div>
            </div>
            <div class="bg-white py-3 px-6 rounded-lg shadow-md">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-600 mb-1">إجمالي المبالغ</p>
                        <p class="text-2xl font-bold text-orange-600">
                            {{ number_format($purchaseOrders->sum('total_price'), 2) }}
                        </p>
                    </div>
                    <div class="w-12 h-12 bg-orange-100 rounded-lg flex items-center justify-center">
                        <i class="fas fa-money-bill-wave text-orange-600 text-xl"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Purchase Orders Table -->
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-orange-500 text-white">
                        <tr>
                            <th class="px-6 py-4 text-center text-sm font-bold">#</th>
                            <th class="px-6 py-4 text-center text-sm font-bold">رقم الأمر</th>
                            <th class="px-6 py-4 text-center text-sm font-bold">المستودع</th>
                            <th class="px-6 py-4 text-center text-sm font-bold">المورد</th>
                            <th class="px-6 py-4 text-center text-sm font-bold">عدد المنتجات</th>
                            <th class="px-6 py-4 text-center text-sm font-bold">المبلغ الإجمالي</th>
                            <th class="px-6 py-4 text-center text-sm font-bold">الحالة</th>
                            <th class="px-6 py-4 text-center text-sm font-bold">تاريخ الإنشاء</th>
                            <th class="px-6 py-4 text-center text-sm font-bold">الإجراءات</th>
                        </tr>
                    </thead>
                    <tbody id="ordersTableBody" class="divide-y divide-gray-200">
                        @forelse ($purchaseOrders as $order)
                            <tr class="order-row hover:bg-gray-50 transition-colors duration-200"
                                data-status="{{ $order->status }}"
                                data-search="{{ $order->id }} {{ $order->supplier->name_ar ?? '' }}">
                                <td class="px-6 text-center text-gray-800 font-medium">{{ $loop->iteration }}</td>
                                <td class="px-6 text-center">
                                    <a href="{{ route('purchase-orders.show', $order) }}"
                                        class="text-orange-600 hover:text-orange-800 font-semibold">
                                        {{ $order->id }}
                                    </a>
                                </td>
                                <td class="px-6 text-center">
                                    {{ $order->warehouse->name_ar ?? 'غير محدد' }}
                                </td>
                                <td class="px-6 text-center">
                                    {{ $order->supplier->name_ar ?? 'غير محدد' }}
                                </td>
                                <td class="px-6 text-center">
                                    <span class="inline-flex items-center px-3 py-1 bg-orange-100 text-orange-800 rounded-full text-sm font-semibold">
                                        <i class="fas fa-boxes ml-2 text-xs"></i>
                                        {{ count($order->items) }}
                                    </span>
                                </td>
                                <td class="px-6 text-center">
                                    <span class="text-lg font-bold text-orange-600">
                                        {{ number_format($order->total_price, 2) }} ر.س
                                    </span>
                                </td>
                                <td class="px-6 text-center">
                                    <span class="px-3 py-1 rounded-full text-xs font-semibold
                                        {{ $order->status === 'في الانتظار' ? 'bg-yellow-100 text-yellow-800' : '' }}
                                        {{ $order->status === 'تم الإستلام' ? 'bg-green-100 text-green-800' : '' }}
                                        {{ $order->status === 'ملغي' ? 'bg-red-100 text-red-800' : '' }}">
                                        {{ $order->status }}
                                    </span>
                                </td>
                                <td class="px-6 py-3 text-center text-gray-600">
                                    <div class="flex items-center justify-center">
                                        <i class="fas fa-calendar-alt ml-2 text-orange-500 text-sm"></i>
                                        {{ $order->created_at->format('Y/m/d') }}
                                    </div>
                                    <div class="text-xs text-gray-500 mt-1">
                                        {{ $order->created_at->format('H:i') }}
                                    </div>
                                </td>
                                <td class="px-6 py-3">
                                    <div class="flex items-center justify-center gap-2">
                                        <a href="{{ route('purchase-orders.show', $order) }}"
                                            class="bg-orange-100 text-orange-700 px-3 py-2 rounded-lg hover:bg-orange-200 transition-colors duration-200 text-sm flex items-center"
                                            title="عرض التفاصيل">
                                            <i class="fas fa-eye"></i>
                                        </a>

                                        @if ($order->status === 'pending')
                                            <button onclick="markAsCompleted({{ $order->id }})"
                                                class="bg-green-100 text-green-700 px-3 py-2 rounded-lg hover:bg-green-200 transition-colors duration-200 text-sm flex items-center"
                                                title="تحديد كمكتمل">
                                                <i class="fas fa-check"></i>
                                            </button>
                                        @endif

                                        <form action="{{ route('purchase-orders.destroy', $order) }}" method="POST" onsubmit="return confirm('هل أنت متأكد من حذف أمر الشراء هذا؟');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="bg-red-100 text-red-700 px-3 py-2 rounded-lg hover:bg-red-200 transition-colors duration-200 text-sm flex items-center"
                                                title="حذف أمر الشراء">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="px-6 py-12 text-center">
                                    <i class="fas fa-shopping-cart text-6xl text-gray-300 mb-4"></i>
                                    <h3 class="text-xl font-semibold text-gray-600 mb-2">لا توجد أوامر شراء</h3>
                                    <p class="text-gray-500">لم يتم إنشاء أي أوامر شراء بعد</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div>
            {{ $purchaseOrders->links() }}
        </div>
    </div>

    <!-- Add Purchase Order Modal -->
    <div id="addPurchaseOrderModal" tabindex="-1" aria-hidden="true"
        class="modal hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="fixed inset-0 bg-gray-900/80 transition-opacity duration-300"></div>
        <div class="relative p-4 w-full max-w-2xl max-h-full z-60">
            <div class="relative bg-white rounded-lg shadow-xl">
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t">
                    <h3 class="text-xl font-semibold text-gray-900 flex items-center">
                        <i class="fas fa-plus-circle ml-3 text-orange-500"></i>
                        أمر شراء جديد
                    </h3>
                    <button type="button" onclick="closeAddPurchaseOrderModal()"
                        class="text-gray-400 hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 flex items-center justify-center">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                <form action="{{ route('purchase-orders.store') }}" method="POST" class="p-4 md:p-5">
                    @csrf
                    <div class="grid gap-4 mb-4">
                        <div>
                            <label for="warehouse_id"
                                class="block mb-2 text-sm font-medium text-gray-900">المستودع</label>
                            <select name="warehouse_id" id="warehouse_id" required
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500 focus:border-transparent transition-all duration-200 block w-full p-1">
                                <option value="">اختر المستودع</option>
                                @foreach ($warehouses ?? [] as $warehouse)
                                    <option value="{{ $warehouse->id }}">{{ $warehouse->name_ar }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <div class="flex justify-between items-center mb-3">
                                <label class="block text-sm font-medium text-gray-900">المنتجات المطلوبة</label>
                                <button type="button" onclick="addProductRow()"
                                    class="text-orange-600 hover:text-orange-800 text-sm flex items-center">
                                    <i class="fas fa-plus ml-1"></i>
                                    إضافة منتج
                                </button>
                            </div>
                            <div id="productsContainer" class="space-y-3">
                                <!-- Product rows will be added here -->
                            </div>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label for="supplier_id" class="block mb-2 text-sm font-medium text-gray-900">المورد</label>
                                <select name="supplier_id" id="supplier_id" required
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500 focus:border-transparent transition-all duration-200 block w-full p-1">
                                    <option value="">اختر المورد</option>
                                    @foreach ($suppliers ?? [] as $supplier)
                                        <option value="{{ $supplier->id }}">{{ $supplier->name_ar }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label for="total_price" class="block mb-2 text-sm font-medium text-gray-900">السعر الإجمالي</label>
                                <input type="number" name="total_price" id="total_price" step="0.01" min="0" required
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500 focus:border-transparent transition-all duration-200 block w-full p-2">
                            </div>
                        </div>
                        <div>
                            <label for="notes" class="block mb-2 text-sm font-medium text-gray-900">ملاحظات</label>
                            <textarea name="notes" id="notes" rows="2"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-2 focus:ring-orange-500 focus:outline-transparent focus:border-transparent block w-full p-2.5"
                                placeholder="أدخل أي ملاحظات إضافية..."></textarea>
                        </div>
                    </div>
                    <div class="flex items-center space-x-3">
                        <button type="submit" class="text-white bg-primary hover:opacity-90 focus:ring-4 focus:outline-none focus:ring-orange-300 font-bold rounded-lg text-sm px-5 py-2.5 text-center flex items-center">
                            حفظ الأمر
                        </button>
                        <button type="button" onclick="closeAddPurchaseRequestModal()"
                            class="py-2.5 px-5 text-sm font-bold text-gray-900 focus:outline-none bg-gray-200 rounded-lg border border-gray-200 hover:bg-gray-100">
                            إلغاء
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        let productCounter = 0;

        function openAddPurchaseOrderModal() {
            document.getElementById('addPurchaseOrderModal').classList.remove('hidden');
            document.getElementById('addPurchaseOrderModal').classList.add('flex');
            addProductRow(); // Add initial product row
        }

        function closeAddPurchaseOrderModal() {
            document.getElementById('addPurchaseOrderModal').classList.add('hidden');
            document.getElementById('addPurchaseOrderModal').classList.remove('flex');
            document.getElementById('productsContainer').innerHTML = '';
            productCounter = 0;
        }

        // Product Management
        function addProductRow() {
            productCounter++;
            const container = document.getElementById('productsContainer');
            const productRow = document.createElement('div');
            productRow.className = 'product-row flex gap-3 items-end';
            productRow.innerHTML = `
                <div class="flex-1">
                    <label class="block mb-1 text-xs font-medium text-gray-700">المنتج</label>
                    <select name="products[${productCounter}][product_id]" required 
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500 focus:border-transparent transition-all duration-200 block w-full p-1">
                        <option value="">اختر المنتج</option>
                        @foreach ($products ?? [] as $product)
                            <option value="{{ $product->id }}">{{ $product->name_ar }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="w-24">
                    <label class="block mb-1 text-xs font-medium text-gray-700">الكمية</label>
                    <input type="number" name="products[${productCounter}][quantity]" min="1" required class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500 focus:border-transparent transition-all duration-200 block w-full py-2 px-2" placeholder="1">
                </div>
                <button type="button" onclick="removeProductRow(this)" class="text-red-600 hover:text-red-800 p-2.5 rounded-lg hover:bg-red-50">
                    <i class="fas fa-trash-can fa-lg"></i>
                </button>
            `;
            container.appendChild(productRow);
        }

        function removeProductRow(button) {
            button.closest('.product-row').remove();
        }
    </script>
@endsection
