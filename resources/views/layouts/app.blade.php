<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - POS</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Cairo', sans-serif;
        }
        .bg-primary {
            background: linear-gradient(135deg, #f97316, #ea580c);
        }
        input:focus {
            outline: none;
        }
        .active-link {
            background: linear-gradient(135deg, #f97316, #ea580c);
            border-right: 4px solid #fed7aa;
        }
        .sidebar-link {
            transition: all 0.3s ease;
        }
        .sidebar-link:hover {
            background: rgba(249, 115, 22, 0.1);
            border-right: 2px solid #f97316;
        }
        .notification-badge {
            animation: pulse 2s infinite;
        }
        @keyframes pulse {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.7; }
        }
    </style>
</head>
<body class="bg-gray-50">
    <div class="flex min-h-screen">
        <!-- Sidebar -->
        <aside class="w-64 bg-white shadow-lg border-l border-gray-200">
            <!-- Sidebar Header -->
            <div class="p-6">
                <div class="flex flex-col items-center justify-center">
                    <img src="{{ asset('imgs/POS-logo.png') }}" width="120" alt="logo" class="mx-auto">
                </div>
            </div>
            
            <!-- Navigation Menu -->
            <nav class="mt-6">
                <h2 class="text-lg font-semibold mb-4 px-6 text-gray-800">القائمة الرئيسية</h2>
                <ul class="space-y-1 px-3">
                    <li>
                        <a href="{{ route('warehouses.index') }}" 
                           class="sidebar-link flex items-center p-3 rounded-lg text-gray-700 hover:text-orange-600 
                                  {{ request()->routeIs('warehouses.*') ? 'active-link text-white' : '' }}">
                            <i class="fas fa-warehouse ml-3"></i>
                            <span>المستودعات</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('categories.index') }}" 
                           class="sidebar-link flex items-center p-3 rounded-lg text-gray-700 hover:text-orange-600
                                  {{ request()->routeIs('categories.*') ? 'active-link text-white' : '' }}">
                            <i class="fas fa-tags ml-3"></i>
                            <span>الأصناف</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('products.index') }}" 
                           class="sidebar-link flex items-center p-3 rounded-lg text-gray-700 hover:text-orange-600
                                  {{ request()->routeIs('products.*') ? 'active-link text-white' : '' }}">
                            <i class="fas fa-box ml-3"></i>
                            <span>المنتجات</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('suppliers.index') }}" 
                           class="sidebar-link flex items-center p-3 rounded-lg text-gray-700 hover:text-orange-600
                                  {{ request()->routeIs('suppliers.*') ? 'active-link text-white' : '' }}">
                            <i class="fas fa-truck ml-3"></i>
                            <span>الموردين</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('purchase-requests.index') }}" 
                           class="sidebar-link flex items-center p-3 rounded-lg text-gray-700 hover:text-orange-600
                                  {{ request()->routeIs('purchase-requests.*') ? 'active-link text-white' : '' }}">
                            <i class="fas fa-clipboard-list ml-3"></i>
                            <span>طلبات الشراء</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('purchase-offers.index') }}" 
                           class="sidebar-link flex items-center p-3 rounded-lg text-gray-700 hover:text-orange-600
                                  {{ request()->routeIs('purchase-offers.*') ? 'active-link text-white' : '' }}">
                            <i class="fas fa-file-invoice ml-3"></i>
                            <span>عروض الشراء</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('purchase-orders.index') }}" 
                           class="sidebar-link flex items-center p-3 rounded-lg text-gray-700 hover:text-orange-600
                                  {{ request()->routeIs('purchase-orders.*') ? 'active-link text-white' : '' }}">
                            <i class="fas fa-shopping-cart ml-3"></i>
                            <span>أوامر الشراء</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('receipts.index') }}" 
                           class="sidebar-link flex items-center p-3 rounded-lg text-gray-700 hover:text-orange-600
                                  {{ request()->routeIs('receipts.*') ? 'active-link text-white' : '' }}">
                            <i class="fas fa-receipt ml-3"></i>
                            <span>إيصالات الاستلام</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('customers.index') }}" 
                           class="sidebar-link flex items-center p-3 rounded-lg text-gray-700 hover:text-orange-600
                                  {{ request()->routeIs('customers.*') ? 'active-link text-white' : '' }}">
                            <i class="fas fa-users ml-3"></i>
                            <span>العملاء</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('sales-invoices.index') }}" 
                           class="sidebar-link flex items-center p-3 rounded-lg text-gray-700 hover:text-orange-600
                                  {{ request()->routeIs('sales-invoices.*') ? 'active-link text-white' : '' }}">
                            <i class="fas fa-file-invoice-dollar ml-3"></i>
                            <span>فواتير المبيعات</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('sales-returns.index') }}" 
                           class="sidebar-link flex items-center p-3 rounded-lg text-gray-700 hover:text-orange-600
                                  {{ request()->routeIs('sales-returns.*') ? 'active-link text-white' : '' }}">
                            <i class="fas fa-undo ml-3"></i>
                            <span>مرتجعات المبيعات</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('supplier-returns.index') }}" 
                           class="sidebar-link flex items-center p-3 rounded-lg text-gray-700 hover:text-orange-600
                                  {{ request()->routeIs('supplier-returns.*') ? 'active-link text-white' : '' }}">
                            <i class="fas fa-truck-loading ml-3"></i>
                            <span>مرتجعات الموردين</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('inventory-transactions.index') }}" 
                           class="sidebar-link flex items-center p-3 rounded-lg text-gray-700 hover:text-orange-600
                                  {{ request()->routeIs('inventory-transactions.*') ? 'active-link text-white' : '' }}">
                            <i class="fas fa-exchange-alt ml-3"></i>
                            <span>حركات المخزون</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </aside>

        <!-- Main Content Area -->
        <div class="flex-1 flex flex-col">
            <!-- Top Navbar -->
            <header class="bg-white shadow-sm border-b border-gray-200 px-6 py-4">
                <div class="flex items-center justify-between">
                    <!-- Search Bar -->
                    <div class="flex-1 max-w-md">
                        <div class="relative">
                            <input type="text" 
                                   placeholder="البحث..." 
                                   class="w-full pr-10 pl-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent">
                            <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                <i class="fas fa-search text-gray-400"></i>
                            </div>
                        </div>
                    </div>

                    <!-- Right Side Actions -->
                    <div class="flex items-center space-x-4 space-x-reverse">
                        <!-- Localization Dropdown -->
                        <div class="relative group">
                            <button class="flex items-center p-2 rounded-lg hover:bg-gray-100 transition-colors">
                                <i class="fas fa-globe text-gray-600 ml-2"></i>
                                <span class="text-sm text-gray-700">العربية</span>
                                <i class="fas fa-chevron-down text-gray-400 mr-2"></i>
                            </button>
                            <div class="absolute left-0 mt-2 w-32 bg-white rounded-lg shadow-lg border border-gray-200 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 z-50">
                                <a href="#" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-orange-50 hover:text-orange-600">
                                    <span class="mr-2">🇸🇦</span>
                                    العربية
                                </a>
                                <a href="#" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-orange-50 hover:text-orange-600">
                                    <span class="mr-2">🇺🇸</span>
                                    English
                                </a>
                            </div>
                        </div>

                        <!-- Notifications -->
                        <div class="relative">
                            <button class="relative p-2 rounded-lg hover:bg-gray-100 transition-colors">
                                <i class="fas fa-bell text-gray-600"></i>
                                <span class="notification-badge absolute -top-1 -left-1 bg-orange-500 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center">3</span>
                            </button>
                        </div>

                        <!-- Settings -->
                        <div class="relative group">
                            <button class="p-2 rounded-lg hover:bg-gray-100 transition-colors">
                                <i class="fas fa-cog text-gray-600"></i>
                            </button>
                            <div class="absolute left-0 mt-2 w-48 bg-white rounded-lg shadow-lg border border-gray-200 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 z-50">
                                <a href="#" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-orange-50 hover:text-orange-600">
                                    <i class="fas fa-user-cog ml-3"></i>
                                    إعدادات الحساب
                                </a>
                                <a href="#" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-orange-50 hover:text-orange-600">
                                    <i class="fas fa-palette ml-3"></i>
                                    المظهر
                                </a>
                                <a href="#" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-orange-50 hover:text-orange-600">
                                    <i class="fas fa-shield-alt ml-3"></i>
                                    الأمان
                                </a>
                            </div>
                        </div>

                        <!-- Profile Dropdown -->
                        <div class="relative group">
                            <button class="flex items-center space-x-2 space-x-reverse p-2 rounded-lg hover:bg-gray-100 transition-colors">
                                <div class="w-8 h-8 bg-gradient-to-r from-orange-400 to-orange-600 rounded-full flex items-center justify-center">
                                    <span class="text-white text-sm font-semibold">أ</span>
                                </div>
                                <div class="hidden md:block text-right">
                                    <div class="text-sm font-medium text-gray-700">أحمد محمد</div>
                                    <div class="text-xs text-gray-500">مدير النظام</div>
                                </div>
                                <i class="fas fa-chevron-down text-gray-400"></i>
                            </button>
                            <div class="absolute left-0 mt-2 w-56 bg-white rounded-lg shadow-lg border border-gray-200 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 z-50">
                                <div class="px-4 py-3 border-b border-gray-200">
                                    <div class="flex items-center space-x-3 space-x-reverse">
                                        <div class="w-10 h-10 bg-gradient-to-r from-orange-400 to-orange-600 rounded-full flex items-center justify-center">
                                            <span class="text-white font-semibold">أ</span>
                                        </div>
                                        <div>
                                            <div class="font-medium text-gray-900">أحمد محمد</div>
                                            <div class="text-sm text-gray-500">ahmad@company.com</div>
                                        </div>
                                    </div>
                                </div>
                                <a href="#" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-orange-50 hover:text-orange-600">
                                    <i class="fas fa-user ml-3"></i>
                                    الملف الشخصي
                                </a>
                                <a href="#" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-orange-50 hover:text-orange-600">
                                    <i class="fas fa-history ml-3"></i>
                                    سجل النشاطات
                                </a>
                                <hr class="my-1">
                                <a href="#" class="flex items-center px-4 py-2 text-sm text-red-600 hover:bg-red-50">
                                    <i class="fas fa-sign-out-alt ml-3"></i>
                                    تسجيل الخروج
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Main Content -->
            <main class="flex-1 p-6 bg-gray-50">
                @if (session('success'))
                    <div class="bg-green-50 border border-green-200 text-green-800 p-4 rounded-lg mb-6 flex items-center">
                        <i class="fas fa-check-circle ml-3 text-green-600"></i>
                        <span>{{ session('success') }}</span>
                    </div>
                @endif
                @if (session('error'))
                    <div class="bg-red-50 border border-red-200 text-red-800 p-4 rounded-lg mb-6 flex items-center">
                        <i class="fas fa-exclamation-circle ml-3 text-red-600"></i>
                        <span>{{ session('error') }}</span>
                    </div>
                @endif
                @yield('content')
            </main>
        </div>
    </div>

    <script>
        // Add active state management for better UX
        document.addEventListener('DOMContentLoaded', function() {
            // Handle dropdown toggles
            const dropdowns = document.querySelectorAll('.group');
            dropdowns.forEach(dropdown => {
                const trigger = dropdown.querySelector('button');
                const menu = dropdown.querySelector('[class*="group-hover"]');
                
                trigger.addEventListener('click', (e) => {
                    e.preventDefault();
                    menu.classList.toggle('opacity-0');
                    menu.classList.toggle('invisible');
                });
            });

            // Close dropdowns when clicking outside
            document.addEventListener('click', (e) => {
                dropdowns.forEach(dropdown => {
                    if (!dropdown.contains(e.target)) {
                        const menu = dropdown.querySelector('[class*="group-hover"]');
                        menu.classList.add('opacity-0');
                        menu.classList.add('invisible');
                    }
                });
            });
        });
    </script>
</body>
</html>