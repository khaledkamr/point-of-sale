@extends('layouts.app')

@section('title', 'تفاصيل أمر الشراء #' . $purchaseOrder->id)

@section('content')
    <div class="p-6">
        <!-- Back Button & Header -->
        <div class="mb-6">
            <a href="{{ route('purchase-orders.index') }}"
                class="inline-flex items-center text-gray-600 hover:text-gray-900 mb-4 transition-colors duration-200">
                <i class="fas fa-arrow-right ml-2"></i>
                العودة إلى أوامر الشراء
            </a>

            <div class="bg-white p-6 rounded-lg shadow-md">
                <div class="flex flex-col lg:flex-row lg:justify-between lg:items-start gap-4">
                    <div>
                        <h1 class="text-3xl font-bold text-gray-800 flex items-center mb-2">
                            <i class="fas fa-shopping-cart ml-3 text-orange-500"></i>
                            أمر شراء #{{ $purchaseOrder->id }}
                        </h1>
                        <p class="text-gray-600">
                            <i class="fas fa-calendar-alt ml-2"></i>
                            تاريخ الإنشاء: {{ $purchaseOrder->created_at->format('Y-m-d H:i') }}
                        </p>
                    </div>

                    <div class="flex flex-wrap gap-3">
                        <span
                            class="px-4 py-2 rounded-full text-sm font-medium
                            {{ $purchaseOrder->status == 'pending' || $purchaseOrder->status == 'في الانتظار' ? 'bg-yellow-100 text-yellow-800' : '' }}
                            {{ $purchaseOrder->status == 'completed' || $purchaseOrder->status == 'مكتمل' ? 'bg-green-100 text-green-800' : '' }}
                            {{ $purchaseOrder->status == 'cancelled' || $purchaseOrder->status == 'ملغي' ? 'bg-red-100 text-red-800' : '' }}">
                            <i class="fas fa-circle text-xs ml-1"></i>
                            {{ $purchaseOrder->status }}
                        </span>

                        @if ($purchaseOrder->receipt)
                            <span class="px-4 py-2 rounded-full text-sm font-medium bg-green-100 text-green-800">
                                <i class="fas fa-check-circle ml-1"></i>
                                تم استلام البضاعة
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
                            @if ($purchaseOrder->purchaseOffer && $purchaseOrder->purchaseOffer->supplier)
                                <div>
                                    <label class="text-sm font-medium text-gray-500 mb-1 block">المورد</label>
                                    <p class="text-lg font-semibold text-gray-800 flex items-center">
                                        <i class="fas fa-building ml-2 text-orange-500"></i>
                                        {{ $purchaseOrder->purchaseOffer->supplier->name_ar ?? 'غير محدد' }}
                                    </p>
                                </div>
                            @endif

                            @if ($purchaseOrder->purchaseRequest && $purchaseOrder->purchaseRequest->warehouse)
                                <div>
                                    <label class="text-sm font-medium text-gray-500 mb-1 block">المستودع</label>
                                    <p class="text-lg font-semibold text-gray-800 flex items-center">
                                        <i class="fas fa-warehouse ml-2 text-orange-500"></i>
                                        {{ $purchaseOrder->purchaseRequest->warehouse->name_ar ?? 'غير محدد' }}
                                    </p>
                                </div>
                            @endif

                            <div>
                                <label class="text-sm font-medium text-gray-500 mb-1 block">عدد المنتجات</label>
                                <p class="text-lg font-semibold text-gray-800 flex items-center">
                                    <i class="fas fa-box ml-2 text-orange-500"></i>
                                    {{ count($purchaseOrder->items) }} منتج
                                </p>
                            </div>

                            <div>
                                <label class="text-sm font-medium text-gray-500 mb-1 block">المبلغ الإجمالي</label>
                                <p class="text-lg font-semibold text-orange-600 flex items-center">
                                    <i class="fas fa-money-bill-wave ml-2"></i>
                                    {{ number_format($purchaseOrder->total_price, 2) }} ج.م
                                </p>
                            </div>

                            @if ($purchaseOrder->purchaseRequest)
                                <div>
                                    <label class="text-sm font-medium text-gray-500 mb-1 block">طلب الشراء</label>
                                    <a href="{{ route('purchase-requests.show', $purchaseOrder->purchaseRequest->id) }}"
                                        class="text-lg font-semibold text-orange-600 hover:text-orange-800 flex items-center">
                                        <i class="fas fa-clipboard-list ml-2"></i>
                                        طلب شراء #{{ $purchaseOrder->purchaseRequest->id }}
                                    </a>
                                </div>
                            @endif

                            <div>
                                <label class="text-sm font-medium text-gray-500 mb-1 block">آخر تحديث</label>
                                <p class="text-lg font-semibold text-gray-800 flex items-center">
                                    <i class="fas fa-clock ml-2 text-orange-500"></i>
                                    {{ $purchaseOrder->updated_at->format('Y-m-d H:i') }}
                                </p>
                            </div>
                        </div>

                        @if ($purchaseOrder->notes)
                            <div class="mt-6 pt-6 border-t border-gray-200">
                                <label class="text-sm font-medium text-gray-500 mb-2 block">الملاحظات</label>
                                <div class="bg-gray-50 p-4 rounded-lg">
                                    <p class="text-gray-700 leading-relaxed">{{ $purchaseOrder->notes }}</p>
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
                            المنتجات
                        </h2>
                    </div>
                    <div class="p-6">
                        @if (count($purchaseOrder->items) > 0)
                            <div class="space-y-4">
                                @foreach ($purchaseOrder->items as $item)
                                    <div
                                        class="flex items-center justify-between p-4 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors duration-200">
                                        <div class="flex items-center gap-4 flex-1">
                                            @if ($item->product && $item->product->img_url)
                                                <img src="{{ asset('storage/' . $item->product->img_url) }}"
                                                    alt="{{ $item->product->name_ar }}"
                                                    class="w-16 h-16 object-cover rounded-lg">
                                            @else
                                                <div
                                                    class="w-16 h-16 bg-orange-100 rounded-lg flex items-center justify-center">
                                                    <i class="fas fa-cube text-orange-600 text-2xl"></i>
                                                </div>
                                            @endif
                                            <div>
                                                <h4 class="font-semibold text-gray-800">
                                                    {{ $item->product->name_ar ?? 'منتج غير معروف' }}
                                                </h4>
                                                @if ($item->product && $item->product->name_en)
                                                    <p class="text-sm text-gray-500">{{ $item->product->name_en }}</p>
                                                @endif
                                                @if ($item->product && $item->product->sku)
                                                    <p class="text-xs text-gray-400 mt-1">
                                                        <i class="fas fa-barcode ml-1"></i>
                                                        {{ $item->product->sku }}
                                                    </p>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="text-left">
                                            <div class="flex items-center gap-4">
                                                <div>
                                                    <p class="text-xs text-gray-500">الكمية</p>
                                                    <p class="text-lg font-bold text-orange-600">
                                                        {{ number_format($item->quantity) }}
                                                    </p>
                                                    <p class="text-xs text-gray-500">{{ $item->product->unit ?? 'قطعة' }}
                                                    </p>
                                                </div>
                                                <div class="text-right">
                                                    <p class="text-xs text-gray-500">السعر</p>
                                                    <p class="text-lg font-bold text-gray-800">
                                                        {{ number_format($item->price, 2) }}
                                                    </p>
                                                    <p class="text-xs text-gray-500">ج.م</p>
                                                </div>
                                                <div class="text-right">
                                                    <p class="text-xs text-gray-500">الإجمالي</p>
                                                    <p class="text-lg font-bold text-orange-600">
                                                        {{ number_format($item->quantity * $item->price, 2) }}
                                                    </p>
                                                    <p class="text-xs text-gray-500">ج.م</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <!-- Total Summary -->
                            <div class="mt-6 pt-6 border-t border-gray-200">
                                <div class="flex justify-between items-center">
                                    <h3 class="text-lg font-bold text-gray-800">المبلغ الإجمالي:</h3>
                                    <p class="text-2xl font-bold text-orange-600">
                                        {{ number_format($purchaseOrder->total_price, 2) }} ج.م
                                    </p>
                                </div>
                            </div>
                        @else
                            <div class="text-center py-8">
                                <i class="fas fa-box-open text-4xl text-gray-300 mb-3"></i>
                                <p class="text-gray-500">لا توجد منتجات في هذا الأمر</p>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Receipt Information (if exists) -->
                @if ($purchaseOrder->receipt)
                    <div class="bg-white rounded-lg shadow-md overflow-hidden">
                        <div class="bg-gradient-to-r from-green-500 to-green-600 px-6 py-4">
                            <h2 class="text-xl font-bold text-white flex items-center">
                                <i class="fas fa-receipt ml-3"></i>
                                معلومات الاستلام
                            </h2>
                        </div>
                        <div class="p-6">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label class="text-sm font-medium text-gray-500 mb-1 block">رقم الاستلام</label>
                                    <p class="text-lg font-semibold text-gray-800">
                                        #{{ $purchaseOrder->receipt->id }}
                                    </p>
                                </div>
                                <div>
                                    <label class="text-sm font-medium text-gray-500 mb-1 block">تاريخ الاستلام</label>
                                    <p class="text-lg font-semibold text-gray-800">
                                        {{ $purchaseOrder->receipt->created_at->format('Y-m-d H:i') }}
                                    </p>
                                </div>
                            </div>
                            <a href="{{ route('receipts.show', $purchaseOrder->receipt->id) }}"
                                class="mt-4 inline-flex items-center text-green-600 hover:text-green-800 font-medium">
                                <i class="fas fa-eye ml-2"></i>
                                عرض تفاصيل الاستلام
                            </a>
                        </div>
                    </div>
                @endif
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
                        @if ($purchaseOrder->status === 'pending' || $purchaseOrder->status === 'في الانتظار')
                            <button onclick="markAsCompleted()"
                                class="w-full bg-green-500 text-white px-4 py-3 rounded-lg hover:bg-green-600 transition-all duration-200 flex items-center justify-center font-medium">
                                <i class="fas fa-check-circle ml-2"></i>
                                تحديد كمكتمل
                            </button>

                            @if (!$purchaseOrder->receipt)
                                <button onclick="createReceipt()"
                                    class="w-full bg-orange-500 text-white px-4 py-3 rounded-lg hover:bg-orange-600 transition-all duration-200 flex items-center justify-center font-medium">
                                    <i class="fas fa-receipt ml-2"></i>
                                    إنشاء استلام
                                </button>
                            @endif
                        @endif

                        @if ($purchaseOrder->receipt)
                            <a href="{{ route('receipts.show', $purchaseOrder->receipt->id) }}"
                                class="w-full bg-green-500 text-white px-4 py-3 rounded-lg hover:bg-green-600 transition-all duration-200 flex items-center justify-center font-medium">
                                <i class="fas fa-eye ml-2"></i>
                                عرض الاستلام
                            </a>
                        @endif

                        <button onclick="window.print()"
                            class="w-full bg-orange-500 text-white px-4 py-3 rounded-lg hover:bg-orange-600 transition-all duration-200 flex items-center justify-center font-medium">
                            <i class="fas fa-print ml-2"></i>
                            طباعة الأمر
                        </button>

                        @if ($purchaseOrder->purchaseRequest)
                            <a href="{{ route('purchase-requests.show', $purchaseOrder->purchaseRequest->id) }}"
                                class="w-full bg-orange-500 text-white px-4 py-3 rounded-lg hover:bg-orange-600 transition-all duration-200 flex items-center justify-center font-medium">
                                <i class="fas fa-clipboard-list ml-2"></i>
                                عرض طلب الشراء
                            </a>
                        @endif
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
                                <span class="text-sm font-medium text-gray-700">عدد المنتجات</span>
                            </div>
                            <span class="text-lg font-bold text-gray-800">{{ count($purchaseOrder->items) }}</span>
                        </div>

                        <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 bg-orange-100 rounded-lg flex items-center justify-center">
                                    <i class="fas fa-calculator text-orange-600"></i>
                                </div>
                                <span class="text-sm font-medium text-gray-700">إجمالي الكمية</span>
                            </div>
                            <span class="text-lg font-bold text-gray-800">
                                {{ $purchaseOrder->items->sum('quantity') }}
                            </span>
                        </div>

                        <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 bg-orange-100 rounded-lg flex items-center justify-center">
                                    <i class="fas fa-money-bill-wave text-orange-600"></i>
                                </div>
                                <span class="text-sm font-medium text-gray-700">المبلغ الإجمالي</span>
                            </div>
                            <span class="text-lg font-bold text-orange-600">
                                {{ number_format($purchaseOrder->total_price, 2) }}
                            </span>
                        </div>

                        @if ($purchaseOrder->items->count() > 0)
                            <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 bg-orange-100 rounded-lg flex items-center justify-center">
                                        <i class="fas fa-dollar-sign text-orange-600"></i>
                                    </div>
                                    <span class="text-sm font-medium text-gray-700">متوسط السعر</span>
                                </div>
                                <span class="text-lg font-bold text-orange-600">
                                    {{ number_format($purchaseOrder->items->avg('price'), 2) }}
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
                            <!-- Created -->
                            <div class="flex gap-3">
                                <div class="flex flex-col items-center">
                                    <div class="w-8 h-8 bg-orange-500 rounded-full flex items-center justify-center">
                                        <i class="fas fa-check text-white text-xs"></i>
                                    </div>
                                    @if ($purchaseOrder->receipt || $purchaseOrder->status === 'completed' || $purchaseOrder->status === 'مكتمل')
                                        <div class="w-0.5 h-12 bg-orange-300"></div>
                                    @endif
                                </div>
                                <div class="flex-1">
                                    <p class="font-medium text-gray-800">تم الإنشاء</p>
                                    <p class="text-xs text-gray-500">
                                        {{ $purchaseOrder->created_at->format('Y-m-d H:i') }}
                                    </p>
                                </div>
                            </div>

                            <!-- Completed or Receipt -->
                            @if ($purchaseOrder->status === 'completed' || $purchaseOrder->status === 'مكتمل' || $purchaseOrder->receipt)
                                <div class="flex gap-3">
                                    <div class="flex flex-col items-center">
                                        <div class="w-8 h-8 bg-green-500 rounded-full flex items-center justify-center">
                                            <i class="fas fa-check-circle text-white text-xs"></i>
                                        </div>
                                    </div>
                                    <div class="flex-1">
                                        <p class="font-medium text-gray-800">
                                            @if ($purchaseOrder->receipt)
                                                تم الاستلام
                                            @else
                                                مكتمل
                                            @endif
                                        </p>
                                        <p class="text-xs text-gray-500">
                                            {{ $purchaseOrder->updated_at->format('Y-m-d H:i') }}
                                        </p>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        @media print {
            .no-print {
                display: none !important;
            }

            body * {
                visibility: hidden;
            }

            .bg-white,
            .bg-white * {
                visibility: visible;
            }

            .bg-white {
                position: absolute;
                left: 0;
                top: 0;
            }
        }
    </style>

    <script>
        function markAsCompleted() {
            if (confirm('هل أنت متأكد من تحديد هذا الأمر كمكتمل؟')) {
                fetch(`/purchase-orders/{{ $purchaseOrder->id }}/complete`, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            location.reload();
                        } else {
                            alert(data.message || 'حدث خطأ أثناء تحديث حالة الأمر');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('حدث خطأ أثناء تحديث حالة الأمر');
                    });
            }
        }

        function createReceipt() {
            if (confirm('هل تريد إنشاء استلام لهذا الأمر؟')) {
                window.location.href = `/receipts/create?purchase_order_id={{ $purchaseOrder->id }}`;
            }
        }
    </script>
@endsection
