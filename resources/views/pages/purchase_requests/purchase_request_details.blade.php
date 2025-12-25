@extends('layouts.app')

@section('title', 'تفاصيل طلب الشراء #' . $purchaseRequest->id)

@section('content')
    <div class="p-6">
        <!-- Back Button & Header -->
        <div class="mb-6">
            <a href="{{ route('purchase-requests.index') }}"
                class="inline-flex items-center text-gray-600 hover:text-gray-900 mb-4 transition-colors duration-200">
                <i class="fas fa-arrow-right ml-2"></i>
                العودة إلى طلبات الشراء
            </a>

            <div class="bg-white p-6 rounded-lg shadow-md">
                <div class="flex flex-col lg:flex-row lg:justify-between lg:items-start gap-4">
                    <div>
                        <h1 class="text-3xl font-bold text-gray-800 flex items-center mb-2">
                            <i class="fas fa-clipboard-list ml-3 text-orange-500"></i>
                            طلب شراء #{{ $purchaseRequest->id }}
                        </h1>
                        <p class="text-gray-600">
                            <i class="fas fa-calendar-alt ml-2"></i>
                            تاريخ الإنشاء: {{ $purchaseRequest->created_at->format('Y-m-d H:i') }}
                        </p>
                    </div>

                    <div class="flex flex-wrap gap-3">
                        <span
                            class="px-4 py-2 rounded-full text-sm font-medium
                            {{ $purchaseRequest->status == 'open' ? 'bg-orange-100 text-orange-800' : '' }}
                            {{ $purchaseRequest->status == 'closed' ? 'bg-gray-100 text-gray-800' : '' }}
                            {{ $purchaseRequest->status == 'في الانتظار' ? 'bg-orange-100 text-orange-800' : '' }}">
                            <i class="fas fa-circle text-xs ml-1"></i>
                            {{ $purchaseRequest->status }}
                        </span>

                        @if ($purchaseRequest->purchaseOrder)
                            <span class="px-4 py-2 rounded-full text-sm font-medium bg-orange-100 text-orange-800">
                                <i class="fas fa-check-circle ml-1"></i>
                                تم إنشاء أمر شراء
                            </span>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Main Content -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Basic Information -->
                <div class="bg-white rounded-lg shadow-md overflow-hidden">
                    <div class="bg-gradient-to-r from-orange-500 to-orange-600 px-6 py-4">
                        <h2 class="text-xl font-bold text-white flex items-center">
                            <i class="fas fa-info-circle ml-3"></i>
                            المعلومات الأساسية
                        </h2>
                    </div>
                    <div class="p-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="text-sm font-medium text-gray-500 mb-1 block">المستودع</label>
                                <p class="text-lg font-semibold text-gray-800 flex items-center">
                                    <i class="fas fa-warehouse ml-2 text-orange-500"></i>
                                    {{ $purchaseRequest->warehouse->name ?? 'غير محدد' }}
                                </p>
                            </div>

                            <div>
                                <label class="text-sm font-medium text-gray-500 mb-1 block">عدد المنتجات</label>
                                <p class="text-lg font-semibold text-gray-800 flex items-center">
                                    <i class="fas fa-box ml-2 text-orange-500"></i>
                                    {{ count($purchaseRequest->items) }} منتج
                                </p>
                            </div>

                            <div>
                                <label class="text-sm font-medium text-gray-500 mb-1 block">عدد العروض</label>
                                <p class="text-lg font-semibold text-gray-800 flex items-center">
                                    <i class="fas fa-tags ml-2 text-orange-500"></i>
                                    {{ count($purchaseRequest->offers ?? []) }} عرض
                                </p>
                            </div>

                            <div>
                                <label class="text-sm font-medium text-gray-500 mb-1 block">آخر تحديث</label>
                                <p class="text-lg font-semibold text-gray-800 flex items-center">
                                    <i class="fas fa-clock ml-2 text-orange-500"></i>
                                    {{ $purchaseRequest->updated_at->format('Y-m-d H:i') }}
                                </p>
                            </div>
                        </div>

                        @if ($purchaseRequest->notes)
                            <div class="mt-6 pt-6 border-t border-gray-200">
                                <label class="text-sm font-medium text-gray-500 mb-2 block">الملاحظات</label>
                                <div class="bg-gray-50 p-4 rounded-lg">
                                    <p class="text-gray-700 leading-relaxed">{{ $purchaseRequest->notes }}</p>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Products List -->
                <div class="bg-white rounded-lg shadow-md overflow-hidden">
                    <div class="bg-gradient-to-r from-orange-500 to-orange-600 px-6 py-4">
                        <h2 class="text-xl font-bold text-white flex items-center">
                            <i class="fas fa-boxes ml-3"></i>
                            المنتجات المطلوبة
                        </h2>
                    </div>
                    <div class="p-6">
                        @if (count($purchaseRequest->items) > 0)
                            <div class="space-y-4">
                                @foreach ($purchaseRequest->items as $item)
                                    <div
                                        class="flex items-center justify-between p-4 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors duration-200">
                                        <div class="flex items-center gap-4 flex-1">
                                            <div
                                                class="w-12 h-12 bg-orange-100 rounded-lg flex items-center justify-center">
                                                <i class="fas fa-cube text-orange-600 text-xl"></i>
                                            </div>
                                            <div>
                                                <h4 class="font-semibold text-gray-800">
                                                    {{ $item->product->name_ar ?? 'منتج غير معروف' }}</h4>
                                                @if ($item->product->name_en)
                                                    <p class="text-sm text-gray-500">{{ $item->product->name_en }}</p>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="text-left">
                                            <p class="text-lg font-bold text-orange-600">
                                                {{ number_format($item->quantity) }}
                                            </p>
                                            <p class="text-xs text-gray-500">{{ $item->product->unit ?? 'قطعة' }}</p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="text-center py-8">
                                <i class="fas fa-box-open text-4xl text-gray-300 mb-3"></i>
                                <p class="text-gray-500">لا توجد منتجات في هذا الطلب</p>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Purchase Offers -->
                <div class="bg-white rounded-lg shadow-md overflow-hidden">
                    <div class="bg-gradient-to-r from-orange-500 to-orange-600 px-6 py-4">
                        <h2 class="text-xl font-bold text-white flex items-center">
                            <i class="fas fa-handshake ml-3"></i>
                            عروض الشراء
                        </h2>
                    </div>
                    <div class="p-6">
                        @if (count($purchaseRequest->offers ?? []) > 0)
                            <div class="space-y-4">
                                @foreach ($purchaseRequest->offers as $offer)
                                    <div
                                        class="border-2 rounded-lg overflow-hidden transition-all duration-200 hover:shadow-lg
                                        {{ $offer->selected ? 'border-orange-500 bg-orange-50' : 'border-gray-200' }}">
                                        <div class="p-5">
                                            <div class="flex items-start justify-between mb-4">
                                                <div class="flex items-center gap-3">
                                                    <div
                                                        class="w-10 h-10 bg-orange-100 rounded-full flex items-center justify-center">
                                                        <i class="fas fa-building text-orange-600"></i>
                                                    </div>
                                                    <div>
                                                        <h4 class="font-semibold text-gray-800">
                                                            {{ $offer->supplier->name ?? 'مورد غير محدد' }}</h4>
                                                        <p class="text-sm text-gray-500">
                                                            <i class="fas fa-calendar-alt ml-1"></i>
                                                            {{ $offer->created_at->format('Y-m-d') }}
                                                        </p>
                                                    </div>
                                                </div>

                                                @if ($offer->selected)
                                                    <span
                                                        class="px-3 py-1 bg-orange-500 text-white text-xs font-medium rounded-full">
                                                        <i class="fas fa-check-circle ml-1"></i>
                                                        محدد
                                                    </span>
                                                @endif
                                            </div>

                                            <div class="flex items-center justify-between">
                                                <div>
                                                    <p class="text-sm text-gray-600 mb-1">السعر الإجمالي</p>
                                                    <p class="text-2xl font-bold text-orange-600">
                                                        {{ number_format($offer->total_price, 2) }} ج.م
                                                    </p>
                                                </div>

                                                @if ($offer->purchaseOrder)
                                                    <a href="{{ route('purchase-orders.show', $offer->purchaseOrder->id) }}"
                                                        class="px-4 py-2 bg-orange-500 text-white rounded-lg hover:bg-orange-600 transition-colors duration-200 text-sm font-medium">
                                                        <i class="fas fa-shopping-cart ml-2"></i>
                                                        عرض أمر الشراء
                                                    </a>
                                                @endif
                                            </div>

                                            @if ($offer->notes)
                                                <div class="mt-4 pt-4 border-t border-gray-200">
                                                    <p class="text-sm text-gray-600">
                                                        <i class="fas fa-sticky-note ml-2"></i>
                                                        {{ $offer->notes }}
                                                    </p>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="text-center py-8">
                                <i class="fas fa-tag text-4xl text-gray-300 mb-3"></i>
                                <p class="text-gray-500">لا توجد عروض لهذا الطلب</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="space-y-6">
                <!-- Quick Actions -->
                <div class="bg-white rounded-lg shadow-md overflow-hidden">
                    <div class="bg-gradient-to-r from-orange-500 to-orange-600 px-6 py-4">
                        <h3 class="text-lg font-bold text-white flex items-center">
                            <i class="fas fa-bolt ml-2"></i>
                            إجراءات سريعة
                        </h3>
                    </div>
                    <div class="p-6 space-y-3">
                        @if (!$purchaseRequest->purchaseOrder)
                            <button onclick="openAddOfferModal({{ $purchaseRequest->id }})"
                                class="w-full bg-orange-500 text-white px-4 py-3 rounded-lg hover:bg-orange-600 transition-all duration-200 flex items-center justify-center font-medium">

                                @if (count($purchaseRequest->offers ?? []) > 0)
                                    <button onclick="openCreateOrderModal({{ $purchaseRequest->id }})"
                                        class="w-full bg-orange-500 text-white px-4 py-3 rounded-lg hover:bg-orange-600 transition-all duration-200 flex items-center justify-center font-medium">
                                        <i class="fas fa-shopping-cart ml-2"></i>
                                        إنشاء أمر شراء
                                    </button>
                                @endif
                            @else
                                <a href="{{ route('purchase-orders.show', $purchaseRequest->purchaseOrder->id) }}"
                                    class="w-full bg-orange-500 text-white px-4 py-3 rounded-lg hover:bg-orange-600 transition-all duration-200 flex items-center justify-center font-medium">
                                    <i class="fas fa-eye ml-2"></i>
                                    عرض أمر الشراء
                                </a>
                        @endif

                        <button onclick="window.print()"
                            class="w-full bg-orange-500 text-white px-4 py-3 rounded-lg hover:bg-orange-600 transition-all duration-200 flex items-center justify-center font-medium">
                            <i class="fas fa-print ml-2"></i>
                            طباعة التفاصيل
                        </button>
                    </div>
                </div>

                <!-- Statistics -->
                <div class="bg-white rounded-lg shadow-md overflow-hidden">
                    <div class="bg-gradient-to-r from-orange-500 to-orange-600 px-6 py-4">
                        <h3 class="text-lg font-bold text-white flex items-center">
                            <i class="fas fa-chart-bar ml-2"></i>
                            إحصائيات
                        </h3>
                    </div>
                    <div class="p-6 space-y-4">
                        <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 bg-orange-100 rounded-lg flex items-center justify-center">
                                    <i class="fas fa-boxes text-orange-600"></i>
                                </div>
                                <span class="text-sm font-medium text-gray-700">إجمالي المنتجات</span>
                            </div>
                            <span class="text-lg font-bold text-gray-800">{{ count($purchaseRequest->items) }}</span>
                        </div>

                        <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 bg-orange-100 rounded-lg flex items-center justify-center">
                                    <i class="fas fa-tags text-orange-600"></i>
                                </div>
                                <span class="text-sm font-medium text-gray-700">عدد العروض</span>
                            </div>
                            <span
                                class="text-lg font-bold text-gray-800">{{ count($purchaseRequest->offers ?? []) }}</span>
                        </div>

                        <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 bg-orange-100 rounded-lg flex items-center justify-center">
                                    <i class="fas fa-calculator text-orange-600"></i>
                                </div>
                                <span class="text-sm font-medium text-gray-700">إجمالي الكمية</span>
                            </div>
                            <span
                                class="text-lg font-bold text-gray-800">{{ $purchaseRequest->items->sum('quantity') }}</span>
                        </div>

                        @if (count($purchaseRequest->offers ?? []) > 0)
                            <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 bg-orange-100 rounded-lg flex items-center justify-center">
                                        <i class="fas fa-money-bill-wave text-orange-600"></i>
                                    </div>
                                    <span class="text-sm font-medium text-gray-700">أفضل عرض</span>
                                </div>
                                <span class="text-lg font-bold text-orange-600">
                                    {{ number_format($purchaseRequest->offers->min('total_price'), 2) }} ج.م
                                </span>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Timeline -->
                <div class="bg-white rounded-lg shadow-md overflow-hidden">
                    <div class="bg-gradient-to-r from-orange-500 to-orange-600 px-6 py-4">
                        <h3 class="text-lg font-bold text-white flex items-center">
                            <i class="fas fa-history ml-2"></i>
                            التسلسل الزمني
                        </h3>
                    </div>
                    <div class="p-6">
                        <div class="space-y-4">
                            <div class="flex gap-3">
                                <div class="flex flex-col items-center">
                                    <div class="w-8 h-8 bg-orange-500 rounded-full flex items-center justify-center">
                                        <i class="fas fa-check text-white text-xs"></i>
                                    </div>
                                    @if (count($purchaseRequest->offers ?? []) > 0 || $purchaseRequest->purchaseOrder)
                                        <div class="w-0.5 h-12 bg-orange-300"></div>
                                    @endif
                                </div>
                                <div class="flex-1">
                                    <p class="font-medium text-gray-800">تم الإنشاء</p>
                                    <p class="text-xs text-gray-500">
                                        {{ $purchaseRequest->created_at->format('Y-m-d H:i') }}</p>
                                </div>
                            </div>

                            @if (count($purchaseRequest->offers ?? []) > 0)
                                <div class="flex gap-3">
                                    <div class="flex flex-col items-center">
                                        <div class="w-8 h-8 bg-orange-500 rounded-full flex items-center justify-center">
                                            <i class="fas fa-tag text-white text-xs"></i>
                                        </div>
                                        @if ($purchaseRequest->purchaseOrder)
                                            <div class="w-0.5 h-12 bg-orange-300"></div>
                                        @endif
                                    </div>
                                    <div class="flex-1">
                                        <p class="font-medium text-gray-800">استلام عروض</p>
                                        <p class="text-xs text-gray-500">{{ count($purchaseRequest->offers) }} عرض</p>
                                    </div>
                                </div>
                            @endif

                            @if ($purchaseRequest->purchaseOrder)
                                <div class="flex gap-3">
                                    <div class="flex flex-col items-center">
                                        <div class="w-8 h-8 bg-orange-500 rounded-full flex items-center justify-center">
                                            <i class="fas fa-shopping-cart text-white text-xs"></i>
                                        </div>
                                    </div>
                                    <div class="flex-1">
                                        <p class="font-medium text-gray-800">أمر شراء</p>
                                        <p class="text-xs text-gray-500">
                                            {{ $purchaseRequest->purchaseOrder->created_at->format('Y-m-d H:i') }}</p>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Include modals from index page -->
    {{-- @include('pages.purchase_requests.partials.add_offer_modal')
    @include('pages.purchase_requests.partials.create_order_modal') --}}

    <style>
        @media print {
            .no-print {
                display: none !important;
            }
        }
    </style>

    <script>
        let selectedOfferId = null;
        let selectedRequestId = {{ $purchaseRequest->id }};

        function openAddOfferModal(purchaseRequestId) {
            // This function will be implemented if modals are included
            console.log('Open add offer modal for request:', purchaseRequestId);
        }

        function openCreateOrderModal(purchaseRequestId) {
            // This function will be implemented if modals are included
            console.log('Open create order modal for request:', purchaseRequestId);
        }
    </script>
@endsection
