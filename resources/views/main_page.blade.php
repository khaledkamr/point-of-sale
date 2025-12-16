@extends('layouts.app')

@section('title', 'نظام نقاط البيع')

@section('content')
    <div class="bg-gray-50 min-h-screen">

        <!-- Main POS Container -->
        <div class="flex h-full">
            <!-- Products Section (Left Side) -->
            <div class="flex-1 p-6">
                <!-- Category Navigation -->
                <div class="mb-6">
                    <div class="flex space-x-2 bg-white rounded-lg p-2 shadow-sm border border-gray-200">
                        <button
                            class="category-tab active flex flex-col items-center justify-center w-20 h-16 rounded-lg bg-orange-500 text-white hover:bg-orange-600 transition-colors">
                            <span class="text-xs font-medium">كل القائمة</span>
                            <span class="text-xs opacity-75">110 صنف</span>
                        </button>
                        <button
                            class="category-tab flex flex-col items-center justify-center w-20 h-16 rounded-lg hover:bg-orange-50 text-gray-700 transition-colors">
                            <span class="text-xs font-medium">الخبز</span>
                            <span class="text-xs text-gray-500">20 صنف</span>
                        </button>
                        <button
                            class="category-tab flex flex-col items-center justify-center w-20 h-16 rounded-lg hover:bg-orange-50 text-gray-700 transition-colors">
                            <span class="text-xs font-medium">الكيك</span>
                            <span class="text-xs text-gray-500">20 صنف</span>
                        </button>
                        <button
                            class="category-tab flex flex-col items-center justify-center w-20 h-16 rounded-lg hover:bg-orange-50 text-gray-700 transition-colors">
                            <span class="text-xs font-medium">الدونت</span>
                            <span class="text-xs text-gray-500">20 صنف</span>
                        </button>
                        <button
                            class="category-tab flex flex-col items-center justify-center w-20 h-16 rounded-lg hover:bg-orange-50 text-gray-700 transition-colors">
                            <span class="text-xs font-medium">المعجنات</span>
                            <span class="text-xs text-gray-500">20 صنف</span>
                        </button>
                        <button
                            class="category-tab flex flex-col items-center justify-center w-20 h-16 rounded-lg hover:bg-orange-50 text-gray-700 transition-colors">
                            <span class="text-xs font-medium">السندوتش</span>
                            <span class="text-xs text-gray-500">20 صنف</span>
                        </button>
                    </div>
                </div>

                <!-- Search Bar -->
                <div class="mb-6">
                    <div class="relative">
                        <input type="text" placeholder="ابحث عن شيء حلو في قائمتنا..."
                            class="w-full pl-4 pr-12 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent bg-white">
                        <button
                            class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-orange-500">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div>

                <!-- Products Grid -->
                <div class="grid grid-cols-4 gap-4">
                    <!-- Product Card 1 -->
                    <div class="product-card bg-white rounded-lg p-4 shadow-sm border border-gray-200 hover:shadow-md hover:border-orange-500 border-2 cursor-pointer transition-all"
                        data-product='{"name": "برجر لحم", "category": "ساندوتش", "price": 5.50, "image": "/api/placeholder/80/80"}'>
                        <div class="aspect-square bg-gray-100 rounded-lg mb-3 overflow-hidden">
                            <img src="/api/placeholder/80/80" alt="برجر لحم" class="w-full h-full object-cover">
                        </div>
                        <h3 class="font-semibold text-gray-800 text-sm mb-1">برجر لحم</h3>
                        <span
                            class="inline-block bg-orange-100 text-orange-800 text-xs px-2 py-1 rounded mb-2">ساندوتش</span>
                        <div class="text-lg font-bold text-gray-800">5.50 ر.س</div>
                    </div>

                    <!-- Product Card 2 -->
                    <div class="product-card bg-white rounded-lg p-4 shadow-sm border border-gray-200 hover:shadow-md hover:border-orange-500 border-2 cursor-pointer transition-all"
                        data-product='{"name": "كرواسان بالزبدة", "category": "معجنات", "price": 4.00, "image": "/api/placeholder/80/80"}'>
                        <div class="aspect-square bg-gray-100 rounded-lg mb-3 overflow-hidden">
                            <img src="/api/placeholder/80/80" alt="كرواسان بالزبدة" class="w-full h-full object-cover">
                        </div>
                        <h3 class="font-semibold text-gray-800 text-sm mb-1">كرواسان بالزبدة</h3>
                        <span
                            class="inline-block bg-purple-100 text-purple-800 text-xs px-2 py-1 rounded mb-2">معجنات</span>
                        <div class="text-lg font-bold text-gray-800">4.00 ر.س</div>
                    </div>

                    <!-- Product Card 3 -->
                    <div class="product-card bg-white rounded-lg p-4 shadow-sm border border-gray-200 hover:shadow-md hover:border-orange-500 border-2 cursor-pointer transition-all"
                        data-product='{"name": "دونت كريم الحبوب", "category": "دونت", "price": 2.45, "image": "/api/placeholder/80/80"}'>
                        <div class="aspect-square bg-gray-100 rounded-lg mb-3 overflow-hidden">
                            <img src="/api/placeholder/80/80" alt="دونت كريم الحبوب" class="w-full h-full object-cover">
                        </div>
                        <h3 class="font-semibold text-gray-800 text-sm mb-1">دونت كريم الحبوب</h3>
                        <span class="inline-block bg-orange-100 text-orange-800 text-xs px-2 py-1 rounded mb-2">دونت</span>
                        <div class="text-lg font-bold text-gray-800">2.45 ر.س</div>
                    </div>

                    <!-- Product Card 4 -->
                    <div class="product-card bg-white rounded-lg p-4 shadow-sm border border-gray-200 hover:shadow-md hover:border-orange-500 border-2 cursor-pointer transition-all"
                        data-product='{"name": "تشيز كيك", "category": "كيك", "price": 3.75, "image": "/api/placeholder/80/80"}'>
                        <div class="aspect-square bg-gray-100 rounded-lg mb-3 overflow-hidden">
                            <img src="/api/placeholder/80/80" alt="تشيز كيك" class="w-full h-full object-cover">
                        </div>
                        <h3 class="font-semibold text-gray-800 text-sm mb-1">تشيز كيك</h3>
                        <span class="inline-block bg-pink-100 text-pink-800 text-xs px-2 py-1 rounded mb-2">كيك</span>
                        <div class="text-lg font-bold text-gray-800">3.75 ر.س</div>
                    </div>

                    <!-- Product Card 5 -->
                    <div class="product-card bg-white rounded-lg p-4 shadow-sm border border-gray-200 hover:shadow-md hover:border-orange-500 border-2 cursor-pointer transition-all"
                        data-product='{"name": "خبز الجبن", "category": "خبز", "price": 4.50, "image": "/api/placeholder/80/80"}'>
                        <div class="aspect-square bg-gray-100 rounded-lg mb-3 overflow-hidden">
                            <img src="/api/placeholder/80/80" alt="خبز الجبن" class="w-full h-full object-cover">
                        </div>
                        <h3 class="font-semibold text-gray-800 text-sm mb-1">خبز الجبن</h3>
                        <span class="inline-block bg-blue-100 text-blue-800 text-xs px-2 py-1 rounded mb-2">خبز</span>
                        <div class="text-lg font-bold text-gray-800">4.50 ر.س</div>
                    </div>

                    <!-- Product Card 6 -->
                    <div class="product-card bg-white rounded-lg p-4 shadow-sm border border-gray-200 hover:shadow-md hover:border-orange-500 border-2 cursor-pointer transition-all"
                        data-product='{"name": "تارت البيض", "category": "تارت", "price": 3.25, "image": "/api/placeholder/80/80"}'>
                        <div class="aspect-square bg-gray-100 rounded-lg mb-3 overflow-hidden">
                            <img src="/api/placeholder/80/80" alt="تارت البيض" class="w-full h-full object-cover">
                        </div>
                        <h3 class="font-semibold text-gray-800 text-sm mb-1">تارت البيض</h3>
                        <span class="inline-block bg-yellow-100 text-yellow-800 text-xs px-2 py-1 rounded mb-2">تارت</span>
                        <div class="text-lg font-bold text-gray-800">3.25 ر.س</div>
                    </div>

                    <!-- Product Card 7 -->
                    <div class="product-card bg-white rounded-lg p-4 shadow-sm border border-gray-200 hover:shadow-md hover:border-orange-500 border-2 cursor-pointer transition-all"
                        data-product='{"name": "خبز الحبوب", "category": "خبز", "price": 4.50, "image": "/api/placeholder/80/80"}'>
                        <div class="aspect-square bg-gray-100 rounded-lg mb-3 overflow-hidden">
                            <img src="/api/placeholder/80/80" alt="خبز الحبوب" class="w-full h-full object-cover">
                        </div>
                        <h3 class="font-semibold text-gray-800 text-sm mb-1">خبز الحبوب</h3>
                        <span class="inline-block bg-blue-100 text-blue-800 text-xs px-2 py-1 rounded mb-2">خبز</span>
                        <div class="text-lg font-bold text-gray-800">4.50 ر.س</div>
                    </div>

                    <!-- Product Card 8 -->
                    <div class="product-card bg-white rounded-lg p-4 shadow-sm border border-gray-200 hover:shadow-md hover:border-orange-500 border-2 cursor-pointer transition-all"
                        data-product='{"name": "رول سبيناتشو", "category": "معجنات", "price": 4.00, "image": "/api/placeholder/80/80"}'>
                        <div class="aspect-square bg-gray-100 rounded-lg mb-3 overflow-hidden">
                            <img src="/api/placeholder/80/80" alt="رول سبيناتشو" class="w-full h-full object-cover">
                        </div>
                        <h3 class="font-semibold text-gray-800 text-sm mb-1">رول سبيناتشو</h3>
                        <span
                            class="inline-block bg-purple-100 text-purple-800 text-xs px-2 py-1 rounded mb-2">معجنات</span>
                        <div class="text-lg font-bold text-gray-800">4.00 ر.س</div>
                    </div>
                </div>

                <!-- Track Orders Section -->
                <div class="mt-8">
                    <div class="bg-white rounded-lg p-4 border border-gray-200">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4">تتبع الطلبات</h3>
                        <div class="grid grid-cols-4 gap-4">
                            <div class="text-center p-3 bg-blue-50 rounded-lg">
                                <div class="font-semibold text-blue-800">مايك</div>
                                <div class="text-sm text-blue-600">الطاولة 04 • تناول بالداخل</div>
                                <div class="text-xs text-blue-500">10:00 صباحاً</div>
                            </div>
                            <div class="text-center p-3 bg-green-50 rounded-lg">
                                <div class="font-semibold text-green-800">بيلي</div>
                                <div class="text-sm text-green-600">الطاولة 05 • للاستلام</div>
                                <div class="text-xs text-green-500">08:45 صباحاً</div>
                            </div>
                            <div class="text-center p-3 bg-orange-50 rounded-lg">
                                <div class="font-semibold text-orange-800">ريتشارد</div>
                                <div class="text-sm text-orange-600">الطاولة 02 • تناول بالداخل</div>
                                <div class="text-xs text-orange-500">08:15 صباحاً</div>
                            </div>
                            <div class="text-center p-3 bg-purple-50 rounded-lg">
                                <div class="font-semibold text-purple-800">شارون</div>
                                <div class="text-sm text-purple-600">الطاولة 01</div>
                                <div class="text-xs text-purple-500"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Order Section (Right Side) -->
            <div class="w-80 bg-white border-r border-gray-200 flex flex-col">
                <!-- Order Header -->
                <div class="p-4 border-b border-gray-200">
                    <div class="flex items-center justify-between mb-4">
                        <h2 class="text-lg font-bold text-gray-800">طلب إلويز</h2>
                        <button class="text-gray-400 hover:text-gray-600">
                            <i class="fas fa-edit"></i>
                        </button>
                    </div>
                    <div class="text-sm text-gray-500 mb-3">رقم الطلب: #005</div>
                    <div class="grid grid-cols-2 gap-3">
                        <select
                            class="border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-orange-500 focus:border-transparent">
                            <option>الطاولة 05</option>
                            <option>الطاولة 01</option>
                            <option>الطاولة 02</option>
                            <option>الطاولة 03</option>
                        </select>
                        <select
                            class="border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-orange-500 focus:border-transparent">
                            <option>تناول بالداخل</option>
                            <option>للاستلام</option>
                            <option>توصيل</option>
                        </select>
                    </div>
                </div>

                <!-- Order Items -->
                <div class="flex-1 p-4 overflow-y-auto " id="order-items">
                    <!-- Order Item 1 -->
                    <div class="order-item flex items-center justify-between mb-4 p-2">
                        <div class="flex items-center flex-1">
                            <img src="/api/placeholder/40/40" class="w-10 h-10 rounded object-cover ml-3">
                            <div class="flex-1">
                                <div class="font-semibold text-gray-800 text-sm">برجر لحم</div>
                                <div class="text-gray-500 text-xs">5.50 ر.س</div>
                            </div>
                        </div>
                        <div class="flex items-center space-x-2">
                            <button
                                class="quantity-btn decrease-btn w-6 h-6 bg-gray-100 hover:bg-gray-200 text-gray-600 rounded-full flex items-center justify-center text-xs">
                                <i class="fas fa-minus"></i>
                            </button>
                            <span class="quantity px-2 text-sm font-semibold">1</span>
                            <button
                                class="quantity-btn increase-btn w-6 h-6 bg-gray-100 hover:bg-gray-200 text-gray-600 rounded-full flex items-center justify-center text-xs">
                                <i class="fas fa-plus"></i>
                            </button>
                        </div>
                    </div>

                    <!-- Order Item 2 -->
                    <div class="order-item flex items-center justify-between mb-4 p-2">
                        <div class="flex items-center flex-1">
                            <img src="/api/placeholder/40/40" class="w-10 h-10 rounded object-cover ml-3">
                            <div class="flex-1">
                                <div class="font-semibold text-gray-800 text-sm">كيك الغابة السوداء</div>
                                <div class="text-gray-500 text-xs">5.00 ر.س</div>
                            </div>
                        </div>
                        <div class="flex items-center space-x-2">
                            <button
                                class="quantity-btn decrease-btn w-6 h-6 bg-gray-100 hover:bg-gray-200 text-gray-600 rounded-full flex items-center justify-center text-xs">
                                <i class="fas fa-minus"></i>
                            </button>
                            <span class="quantity px-2 text-sm font-semibold">2</span>
                            <button
                                class="quantity-btn increase-btn w-6 h-6 bg-gray-100 hover:bg-gray-200 text-gray-600 rounded-full flex items-center justify-center text-xs">
                                <i class="fas fa-plus"></i>
                            </button>
                        </div>
                    </div>

                    <!-- Order Item 3 -->
                    <div class="order-item flex items-center justify-between mb-4 p-2">
                        <div class="flex items-center flex-1">
                            <img src="/api/placeholder/40/40" class="w-10 h-10 rounded object-cover ml-3">
                            <div class="flex-1">
                                <div class="font-semibold text-gray-800 text-sm">خبز سولو فلوس</div>
                                <div class="text-gray-500 text-xs">4.50 ر.س</div>
                            </div>
                        </div>
                        <div class="flex items-center space-x-2">
                            <button
                                class="quantity-btn decrease-btn w-6 h-6 bg-gray-100 hover:bg-gray-200 text-gray-600 rounded-full flex items-center justify-center text-xs">
                                <i class="fas fa-minus"></i>
                            </button>
                            <span class="quantity px-2 text-sm font-semibold">1</span>
                            <button
                                class="quantity-btn increase-btn w-6 h-6 bg-gray-100 hover:bg-gray-200 text-gray-600 rounded-full flex items-center justify-center text-xs">
                                <i class="fas fa-plus"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Order Summary -->
                <div class="border-t border-gray-200 p-4">
                    <div class="space-y-2 text-sm mb-4">
                        <div class="flex justify-between">
                            <span class="text-gray-600">المجموع الفرعي</span>
                            <span id="subtotal" class="font-semibold">20.00 ر.س</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">الضريبة (15%)</span>
                            <span id="tax" class="font-semibold">2.00 ر.س</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">الخصم</span>
                            <span id="discount" class="font-semibold">- ر.س</span>
                        </div>
                        <div class="border-t border-gray-300 pt-2">
                            <div class="flex justify-between">
                                <span class="text-lg font-bold text-gray-800">الإجمالي</span>
                                <span id="total" class="text-lg font-bold text-gray-800">21.00 ر.س</span>
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="space-y-2">
                        <div class="flex space-x-2">
                            <button
                                class="flex-1 bg-green-100 text-green-800 py-2 px-3 rounded-lg text-sm font-semibold hover:bg-green-200 transition-colors flex items-center justify-center">
                                <i class="fas fa-check-circle mr-2"></i>
                                عرض مطبق
                            </button>
                            <button
                                class="bg-blue-100 text-blue-800 py-2 px-4 rounded-lg text-sm font-semibold hover:bg-blue-200 transition-colors">
                                ORIS
                            </button>
                        </div>
                        <button
                            class="w-full bg-orange-500 hover:bg-orange-600 text-white py-3 rounded-lg font-semibold transition-colors">
                            تأكيد الطلب
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .product-card:hover {
            transform: translateY(-2px);
        }

        .category-tab.active {
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        }

        .order-item {
            animation: slideIn 0.3s ease-out;
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateX(20px);
            }

            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        .quantity-btn {
            transition: all 0.2s ease;
        }

        .quantity-btn:hover {
            transform: scale(1.1);
        }

        .quantity-btn:active {
            transform: scale(0.95);
        }

        #order-items::-webkit-scrollbar {
            width: 4px;
        }

        #order-items::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 2px;
        }

        #order-items::-webkit-scrollbar-thumb {
            background: #f97316;
            border-radius: 2px;
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let cart = [{
                    name: 'برجر لحم',
                    price: 5.50,
                    quantity: 1,
                    image: '/api/placeholder/40/40'
                },
                {
                    name: 'كيك الغابة السوداء',
                    price: 5.00,
                    quantity: 2,
                    image: '/api/placeholder/40/40'
                },
                {
                    name: 'خبز سولو فلوس',
                    price: 4.50,
                    quantity: 1,
                    image: '/api/placeholder/40/40'
                }
            ];

            // Category tabs functionality
            const categoryTabs = document.querySelectorAll('.category-tab');
            categoryTabs.forEach(tab => {
                tab.addEventListener('click', function() {
                    // Remove active class from all tabs
                    categoryTabs.forEach(t => {
                        t.classList.remove('active', 'bg-orange-500', 'text-white');
                        t.classList.add('text-gray-700', 'hover:bg-orange-50');
                    });

                    // Add active class to clicked tab
                    this.classList.add('active', 'bg-orange-500', 'text-white');
                    this.classList.remove('text-gray-700', 'hover:bg-orange-50');
                });
            });

            // Product selection functionality
            const productCards = document.querySelectorAll('.product-card');
            productCards.forEach(card => {
                card.addEventListener('click', function() {
                    const productData = JSON.parse(this.getAttribute('data-product'));
                    addToCart(productData);
                });
            });

            // Add to cart function
            function addToCart(product) {
                const existingItem = cart.find(item => item.name === product.name);

                if (existingItem) {
                    existingItem.quantity += 1;
                } else {
                    cart.push({
                        ...product,
                        quantity: 1
                    });
                }

                updateCartDisplay();
                showToast(`تم إضافة ${product.name} إلى الطلب`, 'success', 2000);
            }

            // Update cart display
            function updateCartDisplay() {
                updateTotals();
            }

            // Quantity change handlers
            const quantityBtns = document.querySelectorAll('.quantity-btn');
            quantityBtns.forEach(btn => {
                btn.addEventListener('click', function(e) {
                    e.stopPropagation();
                    const isIncrease = this.classList.contains('increase-btn');
                    const orderItem = this.closest('.order-item');
                    const quantitySpan = orderItem.querySelector('.quantity');
                    const itemName = orderItem.querySelector('.font-semibold').textContent;

                    let quantity = parseInt(quantitySpan.textContent);
                    if (isIncrease) {
                        quantity += 1;
                    } else {
                        quantity = Math.max(1, quantity - 1);
                    }

                    quantitySpan.textContent = quantity;

                    // Update cart array
                    const cartItem = cart.find(item => item.name === itemName);
                    if (cartItem) {
                        cartItem.quantity = quantity;
                    }

                    updateTotals();
                });
            });

            // Update totals
            function updateTotals() {
                const subtotal = cart.reduce((sum, item) => sum + (item.price * item.quantity), 0);
                const tax = subtotal * 0.15; // 15% tax
                const discount = 0; // No discount for now
                const total = subtotal + tax - discount;

                document.getElementById('subtotal').textContent = `${subtotal.toFixed(2)} ر.س`;
                document.getElementById('tax').textContent = `${tax.toFixed(2)} ر.س`;
                document.getElementById('discount').textContent = discount > 0 ? `- ${discount.toFixed(2)} ر.س` :
                    '- ر.س';
                document.getElementById('total').textContent = `${total.toFixed(2)} ر.س`;
            }

            // Search functionality
            const searchInput = document.querySelector('input[type="text"]');
            if (searchInput) {
                searchInput.addEventListener('input', function() {
                    const searchTerm = this.value.toLowerCase();
                    const productCards = document.querySelectorAll('.product-card');

                    productCards.forEach(card => {
                        const productName = card.querySelector('h3').textContent.toLowerCase();
                        if (productName.includes(searchTerm)) {
                            card.style.display = 'block';
                        } else {
                            card.style.display = 'none';
                        }
                    });
                });
            }

            // Initialize totals
            updateTotals();
        });
    </script>
@endsection
