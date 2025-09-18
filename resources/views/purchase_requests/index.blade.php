@extends('layouts.app')

@section('title', 'طلبات الشراء')

@section('content')
    <!-- Page Header -->
    <div class="bg-white p-6 rounded-lg shadow-md mb-6">
        <div class="flex flex-col lg:flex-row lg:justify-between lg:items-center gap-4">
            <!-- Title and Add Button -->
            <div class="flex items-center justify-between">
                <h1 class="text-3xl font-bold text-gray-800 flex items-center">
                    <i class="fas fa-clipboard-list ml-3 text-orange-500"></i>
                    طلبات الشراء
                </h1>
                <button type="button" onclick="openAddPurchaseRequestModal()" 
                        class="bg-primary text-white px-6 py-3 rounded-lg hover:opacity-90 transition-all duration-300 flex items-center lg:hidden">
                    <i class="fas fa-plus ml-2"></i>
                    طلب شراء جديد
                </button>
            </div>

            <!-- Search and Filters -->
            <div class="flex flex-col sm:flex-row gap-4 lg:items-center">
                <!-- Search -->
                <div class="relative">
                    <input type="text" id="searchInput" placeholder="البحث في طلبات الشراء..." 
                           class="w-full sm:w-64 pr-10 pl-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent">
                    <div class="absolute inset-y-0 right-0 pr-3 flex items-center">
                        <i class="fas fa-search text-gray-400"></i>
                    </div>
                </div>

                <!-- Status Filter -->
                <select id="statusFilter" class="w-full sm:w-48 px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent">
                    <option value="">جميع الحالات</option>
                    <option value="open">مفتوح</option>
                    <option value="closed">مغلق</option>
                    <option value="pending">في الانتظار</option>
                </select>

                <!-- Add Button (Desktop) -->
                <button type="button" onclick="openAddPurchaseRequestModal()" 
                        class="hidden lg:flex bg-primary text-white font-bold px-6 py-3 rounded-lg hover:opacity-90 transition-all duration-300 items-center">
                    <i class="fas fa-plus ml-2"></i>
                    طلب شراء جديد
                </button>
            </div>
        </div>
    </div>

    <!-- Purchase Requests Grid -->
    <div id="purchaseRequestsContainer" class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">
        @forelse ($purchaseRequests as $request)
            <div class="purchase-request-card overflow-hidden bg-white rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300" 
                 data-status="{{ $request->status }}" data-search="{{ $request->id }} {{ $request->warehouse->name ?? '' }}">
                
                <!-- Card Header -->
                <div class="p-6 border-b border-gray-200">
                    <div class="flex justify-between items-start mb-4">
                        <div>
                            <h3 class="text-lg font-semibold text-gray-800">طلب شراء #{{ $request->id }}</h3>
                            <p class="text-sm text-gray-600 mt-1">
                                <i class="fas fa-warehouse ml-2"></i>
                                {{ $request->warehouse->name ?? 'مستودع غير محدد' }}
                            </p>
                        </div>
                        <span class="status-badge px-3 py-1 rounded-full text-xs font-medium
                                   {{ $request->status === 'open' ? 'bg-green-100 text-green-800' : '' }}
                                   {{ $request->status === 'closed' ? 'bg-red-100 text-red-800' : '' }}
                                   {{ $request->status === 'pending' ? 'bg-yellow-100 text-yellow-800' : '' }}">
                            {{ $request->status === 'open' ? 'مفتوح' : ($request->status === 'closed' ? 'مغلق' : 'في الانتظار') }}
                        </span>
                    </div>

                    {{-- @if($request->notes)
                        <p class="text-sm text-gray-600 mb-4">
                            <i class="fas fa-sticky-note ml-2"></i>
                            {{ $request->notes }}
                        </p>
                    @endif --}}

                    <!-- Products List - Always show -->
                    <div>
                        <h4 class="text-sm font-medium text-gray-700 mb-3 flex items-center">
                            <i class="fas fa-boxes ml-2"></i>
                            المنتجات المطلوبة:
                        </h4>
                        @if($request->items && count($request->items) > 0)
                            <div class="space-y-2">
                                @foreach($request->items as $item)
                                    <div class="flex justify-between items-center bg-gray-100 p-3 rounded-lg">
                                        <span class="text-sm text-gray-700 font-medium">{{ $item->product->name }}</span>
                                        <span class="text-sm font-bold text-orange-600 bg-orange-100 px-2 py-1 rounded">{{ $item->quantity ?? 0 }}</span>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Card Actions -->
                <div class="p-6 bg-white">
                    <div class="flex flex-wrap gap-2">
                        <!-- Add Purchase Offer -->
                        <button onclick="openAddOfferModal({{ $request->id }})" 
                                class="flex-1 min-w-0 bg-blue-100 text-blue-700 px-3 py-2 rounded-lg hover:bg-blue-200 transition-colors duration-200 text-sm flex items-center justify-center">
                            <i class="fas fa-tag ml-1"></i>
                            إضافة عرض
                        </button>

                        <!-- Expand Offers -->
                        <button onclick="toggleOffers({{ $request->id }})" 
                                class="flex-1 min-w-0 bg-orange-100 text-orange-700 px-3 py-2 rounded-lg hover:bg-orange-200 transition-colors duration-200 text-sm flex items-center justify-center">
                            <i class="fas fa-chevron-down ml-1 expand-icon-{{ $request->id }} transition-transform duration-300"></i>
                            عرض العروض (<span class="offers-count">{{ count($request->offers ?? []) }}</span>)
                        </button>

                        <!-- Create Purchase Order (if offers exist) -->
                        @if(count($request->offers ?? []) > 0)
                            <button onclick="openCreateOrderModal({{ $request->id }})" 
                                    class="w-full bg-primary text-white font-bold px-3 py-2 rounded-lg hover:opacity-90 transition-all duration-200 text-sm flex items-center justify-center">
                                <i class="fa-solid fa-cart-plus ml-1"></i>
                                إنشاء أمر شراء
                            </button>
                        @endif
                    </div>
                </div>

                <!-- Collapsible Offers Section -->
                <div id="offers-{{ $request->id }}" class="offers-section hidden border-t border-gray-200">
                    <div class="p-6 bg-white">
                        <h4 class="text-sm font-medium text-gray-700 mb-4 flex items-center">
                            <i class="fas fa-handshake ml-2"></i>
                            عروض الشراء
                        </h4>
                        
                        @if(count($request->offers ?? []) > 0)
                            <div class="space-y-3">
                                @foreach($request->offers as $offer)
                                    <div class="offer-card bg-white p-4 rounded-lg border-2 border-gray-200 hover:border-gray-300 cursor-pointer transition-all duration-200 relative" 
                                         onclick="selectOffer({{ $offer->id }}, {{ $request->id }})" 
                                         data-offer-id="{{ $offer->id }}" 
                                         data-request-id="{{ $request->id }}">
                                        <!-- Checkbox -->
                                        <div class="offer-checkbox absolute top-2 left-2 w-4 h-4 border-2 border-gray-300 rounded bg-white hidden">
                                            <i class="fas fa-check text-white text-xs absolute inset-0 flex items-center justify-center"></i>
                                        </div>
                                        
                                        <div class="flex justify-between items-start">
                                            <div class="flex-1">
                                                <h5 class="font-medium text-gray-800">{{ $offer->supplier->name ?? 'مورد غير محدد' }}</h5>
                                            </div>
                                            <div class="text-left">
                                                <p class="text-lg font-bold text-orange-600">{{ number_format($offer->total_price, 2) }} ريال</p>
                                            </div>
                                        </div>
                                        @if($offer->notes)
                                            <p class="text-sm text-gray-600">{{ $offer->notes }}</p>
                                        @endif
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="text-center py-4 text-gray-500">
                                <i class="fas fa-inbox text-2xl mb-2"></i>
                                <p class="text-sm">لا توجد عروض شراء حتى الآن</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            
        @empty
            <div class="col-span-full">
                <div class="bg-white rounded-lg shadow-md p-12 text-center">
                    <i class="fas fa-clipboard-list text-6xl text-gray-300 mb-4"></i>
                    <h3 class="text-xl font-semibold text-gray-600 mb-2">لا توجد طلبات شراء</h3>
                    <p class="text-gray-500 mb-6">ابدأ بإنشاء طلب شراء جديد</p>
                    <button onclick="openAddPurchaseRequestModal()" 
                            class="bg-primary text-white px-6 py-3 rounded-lg hover:opacity-90 transition-all duration-300 flex items-center mx-auto">
                        <i class="fas fa-plus ml-2"></i>
                        طلب شراء جديد
                    </button>
                </div>
            </div>
        @endforelse
    </div>

    <!-- Error Toast -->
    <div id="errorToast" class="fixed top-5 left-1/2 transform -translate-x-1/2 bg-red-500 text-white px-6 py-3 rounded-lg shadow-lg z-50 hidden transition-all duration-300">
        <div class="flex items-center">
            <i class="fas fa-exclamation-triangle ml-2"></i>
            <span id="errorToastMessage">يرجى اختيار عرض أولاً قبل إنشاء أمر الشراء</span>
        </div>
    </div>

    <!-- Success Toast -->
    <div id="successToast" class="fixed top-5 left-1/2 transform -translate-x-1/2 bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg z-50 hidden transition-all duration-300">
        <div class="flex items-center">
            <i class="fas fa-check-circle ml-2"></i>
            <span id="successToastMessage">تم الحفظ بنجاح</span>
        </div>
    </div>

    <!-- Add Purchase Request Modal -->
    <div id="addPurchaseRequestModal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <!-- Dark Background Overlay -->
        <div class="fixed inset-0 bg-gray-900/80 transition-opacity duration-300"></div>
        
        <div class="relative p-4 w-full max-w-2xl max-h-full z-60">
            <div class="relative bg-white rounded-lg shadow-xl">
                <!-- Modal header -->
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t">
                    <h3 class="text-xl font-semibold text-gray-900 flex items-center">
                        <i class="fas fa-plus-circle ml-3 text-orange-500"></i>
                        طلب شراء جديد
                    </h3>
                    <button type="button" onclick="closeAddPurchaseRequestModal()" class="text-gray-400 hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 flex items-center justify-center">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                
                <!-- Modal body -->
                <form action="{{ route('purchase-requests.store') }}" method="POST" class="p-4 md:p-5">
                    @csrf
                    <div class="grid gap-4 mb-4">
                        <!-- Warehouse Selection -->
                        <div>
                            <label for="warehouse_id" class="block mb-2 text-sm font-medium text-gray-900">المستودع</label>
                            <select name="warehouse_id" id="warehouse_id" required class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500 focus:border-transparent transition-all duration-200 block w-full p-2.5">
                                <option value="">اختر المستودع</option>
                                @foreach($warehouses ?? [] as $warehouse)
                                    <option value="{{ $warehouse->id }}">{{ $warehouse->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Products Section -->
                        <div>
                            <div class="flex justify-between items-center mb-3">
                                <label class="block text-sm font-medium text-gray-900">المنتجات المطلوبة</label>
                                <button type="button" onclick="addProductRow()" class="text-orange-600 hover:text-orange-800 text-sm flex items-center">
                                    <i class="fas fa-plus ml-1"></i>
                                    إضافة منتج
                                </button>
                            </div>
                            <div id="productsContainer" class="space-y-3">
                                <!-- Product rows will be added here -->
                            </div>
                        </div>
                        
                        <!-- Notes -->
                        <div>
                            <label for="notes" class="block mb-2 text-sm font-medium text-gray-900">ملاحظات</label>
                            <textarea name="notes" id="notes" rows="3" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-2 focus:ring-orange-500 focus:outline-transparent focus:border-transparent block w-full p-2.5" placeholder="أدخل أي ملاحظات إضافية..."></textarea>
                        </div>
                    </div>

                    <!-- Hidden status field -->
                    <input type="hidden" name="status" value="pending">

                    <!-- Modal footer -->
                    <div class="flex items-center space-x-3">
                        <button type="submit" class="text-white bg-primary hover:opacity-90 focus:ring-4 focus:outline-none focus:ring-orange-300 font-bold rounded-lg text-sm px-5 py-2.5 text-center flex items-center">
                            حفظ الطلب
                        </button>
                        <button type="button" onclick="closeAddPurchaseRequestModal()" class="py-2.5 px-5 text-sm font-bold text-gray-900 focus:outline-none bg-gray-200 rounded-lg border border-gray-200 hover:bg-gray-100">
                            إلغاء
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Add Purchase Offer Modal -->
    <div id="addOfferModal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <!-- Dark Background Overlay -->
        <div class="fixed inset-0 bg-gray-900/80 transition-opacity duration-300"></div>
        
        <div class="relative p-4 w-full max-w-md max-h-full z-60">
            <div class="relative bg-white rounded-lg shadow-xl">
                <!-- Modal header -->
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t">
                    <h3 class="text-lg font-semibold text-gray-900 flex items-center">
                        <i class="fas fa-tag ml-3 text-blue-500"></i>
                        إضافة عرض شراء
                    </h3>
                    <button type="button" onclick="closeAddOfferModal()" class="text-gray-400 hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 flex items-center justify-center">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                
                <!-- Modal body -->
                <form id="addOfferForm" action="{{ route('purchase-offers.store') }}" method="POST" class="p-4 md:p-5">
                    @csrf
                    <input type="hidden" id="offer_purchase_request_id" name="purchase_request_id">
                    
                    <div class="grid gap-4 mb-4">
                        <!-- Supplier Selection -->
                        <div>
                            <label for="supplier_id" class="block mb-2 text-sm font-medium text-gray-900">المورد</label>
                            <select name="supplier_id" id="supplier_id" required class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                <option value="">اختر المورد</option>
                                @foreach($suppliers ?? [] as $supplier)
                                    <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Total Price -->
                        <div>
                            <label for="total_price" class="block mb-2 text-sm font-medium text-gray-900">السعر الإجمالي</label>
                            <input type="number" name="total_price" id="total_price" step="0.01" required class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="0.00">
                        </div>

                        <!-- Notes -->
                        <div>
                            <label for="offer_notes" class="block mb-2 text-sm font-medium text-gray-900">ملاحظات</label>
                            <textarea name="notes" id="offer_notes" rows="3" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="أدخل أي ملاحظات إضافية..."></textarea>
                        </div>
                    </div>

                    <!-- Modal footer -->
                    <div class="flex items-center">
                        <button type="submit" class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-bold rounded-lg text-sm px-5 py-2.5 text-center flex items-center justify-center">
                            حفظ العرض
                        </button>
                        <button type="button" onclick="closeAddOfferModal()" class="w-full py-2.5 px-5 text-sm font-bold text-gray-900 focus:outline-none bg-gray-200 rounded-lg border border-gray-200 hover:bg-gray-100 mr-3">
                            إلغاء
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Create Purchase Order Modal -->
    <div id="createOrderModal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <!-- Dark Background Overlay -->
        <div class="fixed inset-0 bg-gray-900/80 transition-opacity duration-300"></div>
        
        <div class="relative p-4 w-full max-w-md max-h-full z-60">
            <div class="relative bg-white rounded-lg shadow-xl">
                <!-- Modal header -->
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t">
                    <h3 class="text-lg font-bold text-gray-900 flex items-center">
                        <i class="fas fa-shopping-cart ml-3 text-orange-500"></i>
                        إنشاء أمر شراء
                    </h3>
                    <button type="button" onclick="closeCreateOrderModal()" class="text-gray-400 hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 flex items-center justify-center">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                
                <!-- Modal body -->
                <form id="createOrderForm" action="{{ route('purchase-orders.store') }}" method="POST" class="p-4 md:p-5">
                    @csrf
                    <input type="hidden" id="order_purchase_request_id" name="purchase_request_id">
                    <input type="hidden" id="selected_offer_id" name="purchase_offer_id">
                    
                    <div class="mb-4">
                        <p class="text-sm text-gray-700 mb-4">
                            سيتم إنشاء أمر شراء بناءً على العرض المحدد. يرجى التأكد من صحة البيانات قبل المتابعة.
                        </p>
                        
                        <div id="selectedOfferDetails" class="bg-gray-100 p-3 rounded-lg mb-4">
                            <!-- Selected offer details will be displayed here -->
                        </div>
                        
                        <div>
                            <label for="order_notes" class="block mb-2 text-sm font-medium text-gray-900">ملاحظات إضافية</label>
                            <textarea name="notes" id="order_notes" rows="3" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-2 focus:ring-orange-500 focus:outline-transparent focus:border-transparent block w-full p-2.5" placeholder="أدخل أي ملاحظات إضافية لأمر الشراء..."></textarea>
                        </div>
                    </div>

                    <!-- Modal footer -->
                    <div class="flex gap-3">
                        <button type="submit" class="w-full text-white bg-orange-500 hover:bg-orange-600 focus:ring-4 focus:outline-none focus:ring-orange-300 font-bold rounded-lg text-sm px-5 py-2.5 text-center flex items-center justify-center">
                            <i class="fas fa-check ml-2"></i>
                            إنشاء الأمر
                        </button>
                        <button type="button" onclick="closeCreateOrderModal()" class="w-full py-2.5 px-5 text-sm font-bold text-gray-900 focus:outline-none bg-gray-200 rounded-lg border border-gray-200 hover:bg-gray-100 text-center">
                            إلغاء
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <style>
        .offers-section {
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.3s ease-in-out;
        }
        
        .offers-section.show {
            max-height: 1000px;
        }

        .offer-card.selected {
            border-color: #f97316 !important;
            box-shadow: 0 0 0 1px #f97316;
        }

        .offer-card.selected .offer-checkbox {
            background-color: #f97316;
            border-color: #f97316;
        }
        .toast-show {
            animation: slideInFromTop 0.3s ease-out;
        }

        .toast-hide {
            animation: slideOutToTop 0.3s ease-in;
        }

        @keyframes slideInFromTop {
            from {
                transform: translateX(-50%) translateY(-100%);
                opacity: 0;
            }
            to {
                transform: translateX(-50%) translateY(0);
                opacity: 1;
            }
        }

        @keyframes slideOutToTop {
            from {
                transform: translateX(-50%) translateY(0);
                opacity: 1;
            }
            to {
                transform: translateX(-50%) translateY(-100%);
                opacity: 0;
            }
        }
    </style>

    <script>
        let productCounter = 0;
        let selectedOfferId = null;
        let selectedRequestId = null;

        // Modal Functions
        function openAddPurchaseRequestModal() {
            document.getElementById('addPurchaseRequestModal').classList.remove('hidden');
            document.getElementById('addPurchaseRequestModal').classList.add('flex');
            addProductRow(); // Add initial product row
        }

        function closeAddPurchaseRequestModal() {
            document.getElementById('addPurchaseRequestModal').classList.add('hidden');
            document.getElementById('addPurchaseRequestModal').classList.remove('flex');
            document.getElementById('productsContainer').innerHTML = '';
            productCounter = 0;
        }

        function openAddOfferModal(purchaseRequestId) {
            document.getElementById('offer_purchase_request_id').value = purchaseRequestId;
            document.getElementById('addOfferForm').action = `{{ url('/purchase-offers') }}`;
            document.getElementById('addOfferModal').classList.remove('hidden');
            document.getElementById('addOfferModal').classList.add('flex');
        }

        function closeAddOfferModal() {
            document.getElementById('addOfferModal').classList.add('hidden');
            document.getElementById('addOfferModal').classList.remove('flex');
            document.getElementById('addOfferForm').reset();
        }

        function openCreateOrderModal(purchaseRequestId) {
            if (!selectedOfferId || selectedRequestId !== purchaseRequestId) {
                showErrorToast('يرجى اختيار عرض من هذا الطلب أولاً');
                return;
            }
            
            document.getElementById('order_purchase_request_id').value = purchaseRequestId;
            document.getElementById('selected_offer_id').value = selectedOfferId;
            document.getElementById('createOrderForm').action = `{{ url('/purchase-orders') }}`;
            updateSelectedOfferDetails();
            document.getElementById('createOrderModal').classList.remove('hidden');
            document.getElementById('createOrderModal').classList.add('flex');
        }

        function closeCreateOrderModal() {
            document.getElementById('createOrderModal').classList.add('hidden');
            document.getElementById('createOrderModal').classList.remove('flex');
            document.getElementById('createOrderForm').reset();
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
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500 focus:border-transparent transition-all duration-200 block w-full p-2.5">
                        <option value="">اختر المنتج</option>
                        @foreach($products ?? [] as $product)
                        <option value="{{ $product->id }}">{{ $product->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="w-24">
                    <label class="block mb-1 text-xs font-medium text-gray-700">الكمية</label>
                    <input type="number" name="products[${productCounter}][quantity]" min="1" required class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500 focus:border-transparent transition-all duration-200 block w-full py-3.5 px-2.5" placeholder="1">
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

        // Offers Management
        function toggleOffers(purchaseRequestId) {
            const offersSection = document.getElementById(`offers-${purchaseRequestId}`);
            const icon = document.querySelector(`.expand-icon-${purchaseRequestId}`);
            
            if (offersSection.classList.contains('show')) {
                offersSection.classList.remove('show');
                offersSection.classList.add('hidden');
                icon.style.transform = 'rotate(0deg)';
            } else {
                offersSection.classList.add('show');
                offersSection.classList.remove('hidden');
                icon.style.transform = 'rotate(180deg)';
            }
        }

        function selectOffer(offerId, requestId) {
            // Remove selection from all offers across all requests
            document.querySelectorAll('.offer-card').forEach(card => {
                card.classList.remove('selected');
                const checkbox = card.querySelector('.offer-checkbox');
                checkbox.classList.add('hidden');
            });

            // Select the clicked offer
            const selectedCard = document.querySelector(`[data-offer-id="${offerId}"]`);
            if (selectedCard) {
                selectedCard.classList.add('selected');
                const checkbox = selectedCard.querySelector('.offer-checkbox');
                checkbox.classList.remove('hidden');
                
                selectedOfferId = offerId;
                selectedRequestId = requestId;
            }
        }

        function updateSelectedOfferDetails() {
            const selectedCard = document.querySelector(`[data-offer-id="${selectedOfferId}"]`);
            const detailsContainer = document.getElementById('selectedOfferDetails');
            
            if (selectedCard) {
                const supplierName = selectedCard.querySelector('h5').textContent;
                const price = selectedCard.querySelector('.text-orange-600').textContent;
                
                detailsContainer.innerHTML = `
                    <h4 class="font-medium text-gray-800 mb-2">العرض المحدد:</h4>
                    <div class="flex justify-between items-center">
                        <div>
                            <p class="text-sm font-medium text-gray-700">${supplierName}</p>
                            <p class="text-xs text-gray-500">معرف العرض: ${selectedOfferId}</p>
                        </div>
                        <p class="text-lg font-bold text-orange-600">${price}</p>
                    </div>
                `;
            }
        }

        // Toast Functions
        function showErrorToast(message) {
            const toast = document.getElementById('errorToast');
            const messageEl = document.getElementById('errorToastMessage');
            
            messageEl.textContent = message;
            toast.classList.remove('hidden');
            toast.classList.add('toast-show');
            
            setTimeout(() => {
                hideErrorToast();
            }, 3000);
        }

        function hideErrorToast() {
            const toast = document.getElementById('errorToast');
            toast.classList.add('toast-hide');
            
            setTimeout(() => {
                toast.classList.add('hidden');
                toast.classList.remove('toast-show', 'toast-hide');
            }, 300);
        }

        function showSuccessToast(message) {
            const toast = document.getElementById('successToast');
            const messageEl = document.getElementById('successToastMessage');
            
            messageEl.textContent = message;
            toast.classList.remove('hidden');
            toast.classList.add('toast-show');
            
            setTimeout(() => {
                hideSuccessToast();
            }, 2000);
        }

        function hideSuccessToast() {
            const toast = document.getElementById('successToast');
            toast.classList.add('toast-hide');
            
            setTimeout(() => {
                toast.classList.add('hidden');
                toast.classList.remove('toast-show', 'toast-hide');
            }, 300);
        }

        // Search and Filter Functions
        function filterCards() {
            const searchTerm = document.getElementById('searchInput').value.toLowerCase();
            const statusFilter = document.getElementById('statusFilter').value;
            const cards = document.querySelectorAll('.purchase-request-card');
            
            cards.forEach(card => {
                const cardStatus = card.dataset.status;
                const searchText = card.dataset.search.toLowerCase();
                
                const matchesSearch = searchText.includes(searchTerm);
                const matchesStatus = !statusFilter || cardStatus === statusFilter;
                
                if (matchesSearch && matchesStatus) {
                    card.style.display = 'block';
                } else {
                    card.style.display = 'none';
                }
            });
        }

        // Event Listeners
        document.addEventListener('DOMContentLoaded', function() {
            // Search input
            document.getElementById('searchInput').addEventListener('input', filterCards);
            
            // Status filter
            document.getElementById('statusFilter').addEventListener('change', filterCards);
            
            // Close modals when clicking on overlay
            document.addEventListener('click', function(event) {
                // Check if clicked element is the modal overlay (not the modal content)
                if (event.target.classList.contains('fixed') && event.target.classList.contains('inset-0')) {
                    const modals = [
                        'addPurchaseRequestModal',
                        'addOfferModal', 
                        'createOrderModal'
                    ];
                    
                    modals.forEach(modalId => {
                        const modal = document.getElementById(modalId);
                        if (!modal.classList.contains('hidden')) {
                            modal.classList.add('hidden');
                            modal.classList.remove('flex');
                        }
                    });
                }
            });
            
            // Close modals with Escape key
            document.addEventListener('keydown', function(event) {
                if (event.key === 'Escape') {
                    closeAddPurchaseRequestModal();
                    closeAddOfferModal();
                    closeCreateOrderModal();
                    hideErrorToast();
                    hideSuccessToast();
                }
            });
        });

        // Form Submissions
        document.getElementById('addOfferForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            // Show loading state
            const submitBtn = this.querySelector('button[type="submit"]');
            const originalText = submitBtn.innerHTML;
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin ml-2"></i>جاري الحفظ...';
            submitBtn.disabled = true;
            
            // You can add AJAX submission here
            // For now, we'll use normal form submission after a delay
            setTimeout(() => {
                this.submit();
            }, 500);
        });

        document.getElementById('createOrderForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            if (!selectedOfferId) {
                showErrorToast('يرجى اختيار عرض أولاً');
                return;
            }
            
            // Show loading state
            const submitBtn = this.querySelector('button[type="submit"]');
            const originalText = submitBtn.innerHTML;
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin ml-2"></i>جاري الإنشاء...';
            submitBtn.disabled = true;
            
            // You can add AJAX submission here
            // For now, we'll use normal form submission after a delay
            setTimeout(() => {
                this.submit();
            }, 500);
        });

        // Prevent form submission if no products are added
        document.querySelector('form[action*="purchase-requests"]').addEventListener('submit', function(e) {
            const productRows = document.querySelectorAll('.product-row');
            if (productRows.length === 0) {
                e.preventDefault();
                showErrorToast('يجب إضافة منتج واحد على الأقل');
                return;
            }
        });

        // Auto-close toast when clicked
        document.getElementById('errorToast').addEventListener('click', hideErrorToast);
        document.getElementById('successToast').addEventListener('click', hideSuccessToast);
    </script>
@endsection