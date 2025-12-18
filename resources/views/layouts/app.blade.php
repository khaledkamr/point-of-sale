<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>POS - @yield('title')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Cairo', sans-serif;
        }

        ::-webkit-scrollbar {
            width: 8px;
            height: 0;
        }

        nav::-webkit-scrollbar {
            width: 5px;
        }

        ::-webkit-scrollbar-track {
            background: #121212 !important;
        }

        ::-webkit-scrollbar-thumb {
            background: #f97316 !important;
            /* color: #00246171; */
            cursor: grab;
            transition: 0.3s;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #b14409;
        }

        ::selection {
            background-color: rgba(249, 115, 22, 0.2);
            color: #ea580c;
        }

        .bg-primary {
            background: linear-gradient(135deg, #f97316, #ea580c);
        }

        input:focus {
            outline: none;
        }

        button {
            cursor: pointer;
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

            0%,
            100% {
                opacity: 1;
            }

            50% {
                opacity: 0.7;
            }
        }

        /* Enhanced Toast Styles */
        .toast-container {
            position: fixed;
            top: 100px;
            left: 50%;
            transform: translateX(-50%);
            z-index: 9999;
            pointer-events: none;
        }

        .toast {
            pointer-events: auto;
            min-width: 300px;
            max-width: 500px;
            margin-bottom: 10px;
            transform: translateY(-100px);
            opacity: 0;
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }

        .toast.show {
            transform: translateY(0);
            opacity: 1;
        }

        .toast.hide {
            transform: translateY(-100px);
            opacity: 0;
        }

        /* Toast Animation */
        @keyframes slideInDown {
            from {
                transform: translateY(-100px);
                opacity: 0;
            }

            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        @keyframes slideOutUp {
            from {
                transform: translateY(0);
                opacity: 1;
            }

            to {
                transform: translateY(-100px);
                opacity: 0;
            }
        }

        .toast-enter {
            animation: slideInDown 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }

        .toast-exit {
            animation: slideOutUp 0.3s ease-in;
        }
    </style>
</head>

<body class="bg-gray-50">
    <!-- Toast Container - Fixed positioned and centered -->
    <div id="toast-container" class="toast-container"></div>

    <div class="flex min-h-screen">
        <!-- Sidebar -->
        <aside class="w-64 bg-white shadow-lg border-l border-gray-200 h-screen flex flex-col fixed z-100">
            <!-- Sidebar Header -->
            <div class="p-6 flex-shrink-0">
                <div class="flex flex-col items-center justify-center">
                    <img src="{{ asset('imgs/POS-logo.png') }}" width="120" alt="logo" class="mx-auto">
                </div>
            </div>

            <!-- Navigation Menu - Scrollable -->
            <nav class="mt-6 flex-1 overflow-y-auto">
                <ul class="space-y-1 px-3 pb-6">
                    <li>
                        <a href="{{ route('pos.index') }}"
                            class="sidebar-link flex items-center p-3 rounded-lg text-gray-700 hover:text-orange-600 
                                  {{ request()->routeIs('pos.index') ? 'active-link text-white' : '' }}">
                            <i class="fas fa-home ml-3"></i>
                            <span>الصفحة الرئيسيـة</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('warehouses.index') }}"
                            class="sidebar-link flex items-center p-3 rounded-lg text-gray-700 hover:text-orange-600 
                                  {{ request()->routeIs('warehouses.*') ? 'active-link text-white' : '' }}">
                            <i class="fas fa-warehouse ml-3"></i>
                            <span>المستـــودعــــات</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('categories.index') }}"
                            class="sidebar-link flex items-center p-3 rounded-lg text-gray-700 hover:text-orange-600
                                  {{ request()->routeIs('categories.*') ? 'active-link text-white' : '' }}">
                            <i class="fas fa-tags ml-3"></i>
                            <span>الأصـنــــــــــــــاف</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('products.index') }}"
                            class="sidebar-link flex items-center p-3 rounded-lg text-gray-700 hover:text-orange-600
                                  {{ request()->routeIs('products.*') ? 'active-link text-white' : '' }}">
                            <i class="fas fa-box ml-3"></i>
                            <span>المـنـتـجــــــــــــات</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('suppliers.index') }}"
                            class="sidebar-link flex items-center p-3 rounded-lg text-gray-700 hover:text-orange-600
                                  {{ request()->routeIs('suppliers.*') ? 'active-link text-white' : '' }}">
                            <i class="fas fa-truck ml-3"></i>
                            <span>المــــــورديـــــــن</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('customers.index') }}"
                            class="sidebar-link flex items-center p-3 rounded-lg text-gray-700 hover:text-orange-600
                                  {{ request()->routeIs('customers.*') ? 'active-link text-white' : '' }}">
                            <i class="fas fa-users ml-3"></i>
                            <span>العمــــــــــــــــلاء</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('purchase-requests.index') }}"
                            class="sidebar-link flex items-center p-3 rounded-lg text-gray-700 hover:text-orange-600
                                  {{ request()->routeIs('purchase-requests.*') ? 'active-link text-white' : '' }}">
                            <i class="fas fa-clipboard-list ml-3"></i>
                            <span>طلبــــات الشــــراء</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('purchase-orders.index') }}"
                            class="sidebar-link flex items-center p-3 rounded-lg text-gray-700 hover:text-orange-600
                                  {{ request()->routeIs('purchase-orders.*') ? 'active-link text-white' : '' }}">
                            <i class="fas fa-shopping-cart ml-3"></i>
                            <span>أوامـــــر الشــــراء</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('receipts.index') }}"
                            class="sidebar-link flex items-center p-3 rounded-lg text-gray-700 hover:text-orange-600
                                  {{ request()->routeIs('receipts.*') ? 'active-link text-white' : '' }}">
                            <i class="fas fa-receipt ml-3"></i>
                            <span>إيصــالات الإستـلام</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('sales-invoices.index') }}"
                            class="sidebar-link flex items-center p-3 rounded-lg text-gray-700 hover:text-orange-600
                                  {{ request()->routeIs('sales-invoices.*') ? 'active-link text-white' : '' }}">
                            <i class="fas fa-file-invoice-dollar ml-3"></i>
                            <span>فواتير المبيعــــــات</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('sales-returns.index') }}"
                            class="sidebar-link flex items-center p-3 rounded-lg text-gray-700 hover:text-orange-600
                                  {{ request()->routeIs('sales-returns.*') ? 'active-link text-white' : '' }}">
                            <i class="fas fa-undo ml-3"></i>
                            <span>مرتجعات المبيعـات</span>
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
                            <span>حركـــات المخـــزون</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('pos.reports') }}"
                            class="sidebar-link flex items-center p-3 rounded-lg text-gray-700 hover:text-orange-600 
                                  {{ request()->routeIs('pos.reports') ? 'active-link text-white' : '' }}">
                            <i class="fas fa-chart-line ml-3"></i>
                            <span>التقـــــــــاريــــــــر</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </aside>

        <!-- Main Content Area -->
        <div class="flex-1 flex flex-col mr-64">
            <!-- Top Navbar -->
            <header class="bg-white shadow-sm border-b border-gray-200 px-6 py-4">
                <div class="flex items-center justify-between">
                    <!-- Search Bar -->
                    <div class="flex-1 max-w-md">
                        <div class="relative">
                            <input type="text" placeholder="البحث..."
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
                            <div
                                class="absolute left-0 mt-2 w-32 bg-white rounded-lg shadow-lg border border-gray-200 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 z-50">
                                <a href="#"
                                    class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-orange-50 hover:text-orange-600">
                                    <img src="https://upload.wikimedia.org/wikipedia/commons/0/0d/Flag_of_Saudi_Arabia.svg"
                                        width="20" class="ml-2"></img>
                                    العربية
                                </a>
                                <a href="#"
                                    class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-orange-50 hover:text-orange-600">
                                    <img src="https://upload.wikimedia.org/wikipedia/commons/a/a4/Flag_of_the_United_States.svg"
                                        width="20" class="ml-2"></img>
                                    English
                                </a>
                            </div>
                        </div>

                        <!-- Notifications -->
                        <div class="relative">
                            <button class="relative p-2 rounded-lg hover:bg-gray-100 transition-colors">
                                <i class="fas fa-bell text-gray-600"></i>
                                <span
                                    class="notification-badge absolute -top-1 -left-1 bg-orange-500 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center">3</span>
                            </button>
                        </div>

                        <!-- Settings -->
                        <div class="relative group">
                            <button class="p-2 rounded-lg hover:bg-gray-100 transition-colors">
                                <i class="fas fa-cog text-gray-600"></i>
                            </button>
                            <div
                                class="absolute left-0 mt-2 w-48 bg-white rounded-lg shadow-lg border border-gray-200 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 z-50">
                                <a href="#"
                                    class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-orange-50 hover:text-orange-600">
                                    <i class="fas fa-user-cog ml-3"></i>
                                    إعدادات الحساب
                                </a>
                                <a href="#"
                                    class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-orange-50 hover:text-orange-600">
                                    <i class="fas fa-palette ml-3"></i>
                                    المظهر
                                </a>
                                <a href="#"
                                    class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-orange-50 hover:text-orange-600">
                                    <i class="fas fa-shield-alt ml-3"></i>
                                    الأمان
                                </a>
                            </div>
                        </div>

                        <!-- Profile Dropdown -->
                        <div class="relative group">
                            <button
                                class="flex items-center space-x-2  p-2 rounded-lg hover:bg-gray-100 transition-colors">
                                <div
                                    class="w-8 h-8 bg-gradient-to-r from-orange-400 to-orange-600 rounded-full flex items-center justify-center">
                                    <span class="text-white text-sm font-semibold">خ</span>
                                </div>
                                <div class="hidden md:block text-right">
                                    <div class="text-sm font-medium text-gray-700">خالد قمر</div>
                                    <div class="text-xs text-gray-500">مدير النظام</div>
                                </div>
                                <i class="fas fa-chevron-down text-gray-400"></i>
                            </button>
                            <div
                                class="absolute left-0 mt-2 w-56 bg-white rounded-lg shadow-lg border border-gray-200 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 z-50">
                                <div class="px-4 py-3 border-b border-gray-200">
                                    <div class="flex items-center space-x-3">
                                        <div
                                            class="w-10 h-10 bg-gradient-to-r from-orange-400 to-orange-600 rounded-full flex items-center justify-center">
                                            <span class="text-white font-semibold">خ</span>
                                        </div>
                                        <div>
                                            <div class="font-medium text-gray-900">خالد قمر</div>
                                            <div class="text-sm text-gray-500">kk@company.com</div>
                                        </div>
                                    </div>
                                </div>
                                <a href="#"
                                    class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-orange-50 hover:text-orange-600">
                                    <i class="fas fa-user ml-3"></i>
                                    الملف الشخصي
                                </a>
                                <a href="#"
                                    class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-orange-50 hover:text-orange-600">
                                    <i class="fas fa-history ml-3"></i>
                                    سجل النشاطات
                                </a>
                                <hr class="my-1">
                                <a href="#"
                                    class="flex items-center px-4 py-2 text-sm text-red-600 hover:bg-red-50">
                                    <i class="fas fa-sign-out-alt ml-3"></i>
                                    تسجيل الخروج
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Main Content -->
            <main class="flex-1 bg-gray-100">
                @yield('content')
            </main>
        </div>
    </div>

    <script>
        // Enhanced Toast System
        class ToastManager {
            constructor() {
                this.container = document.getElementById('toast-container');
                this.toasts = [];
            }

            createToast(message, type = 'info', duration = 5000) {
                const iconConfig = {
                    success: {
                        bgColor: 'bg-green-100',
                        textColor: 'text-green-500',
                        icon: `<path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z"/>`
                    },
                    error: {
                        bgColor: 'bg-red-100',
                        textColor: 'text-red-500',
                        icon: `<path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 11.793a1 1 0 1 1-1.414 1.414L10 11.414l-2.293 2.293a1 1 0 0 1-1.414-1.414L8.586 10 6.293 7.707a1 1 0 0 1 1.414-1.414L10 8.586l2.293-2.293a1 1 0 0 1 1.414 1.414L11.414 10l2.293 2.293Z"/>`
                    },
                    info: {
                        bgColor: 'bg-blue-100',
                        textColor: 'text-blue-500',
                        icon: `<path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>`
                    },
                    warning: {
                        bgColor: 'bg-orange-100',
                        textColor: 'text-orange-500',
                        icon: `<path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566ZM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5Zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2Z"/>`
                    }
                };

                const config = iconConfig[type] || iconConfig.info;

                const toast = document.createElement('div');
                toast.className = `toast flex items-center w-full max-w-xs p-4 text-gray-500 ${config.bgColor} rounded-lg shadow-lg border border-gray-200`;
                toast.setAttribute('role', 'alert');

                toast.innerHTML = `
                    <div class="inline-flex items-center justify-center shrink-0 w-5 h-5 ${config.textColor} rounded-xl">
                        <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                            ${config.icon}
                        </svg>
                        <span class="sr-only">${type} icon</span>
                    </div>
                    <div class="ms-3 text-sm font-semibold text-gray-700">${message}</div>
                    <button type="button" class="ms-auto -mx-1.5 -my-1.5 text-gray-400 hover:text-gray-900 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 hover:inline-flex items-center justify-center h-8 w-8 toast-close" aria-label="Close">
                        <span class="sr-only">Close</span>
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                        </svg>
                    </button>
                `;

                // Add close functionality
                const closeBtn = toast.querySelector('.toast-close');
                closeBtn.addEventListener('click', () => this.removeToast(toast));

                // Add to container and animate in
                this.container.appendChild(toast);
                this.toasts.push(toast);

                // Trigger show animation
                setTimeout(() => {
                    toast.classList.add('show');
                }, 100);

                // Auto remove after duration
                if (duration > 0) {
                    setTimeout(() => {
                        this.removeToast(toast);
                    }, duration);
                }

                return toast;
            }

            removeToast(toast) {
                if (!toast || !toast.parentNode) return;

                toast.classList.remove('show');
                toast.classList.add('hide');

                setTimeout(() => {
                    if (toast.parentNode) {
                        toast.parentNode.removeChild(toast);
                    }
                    this.toasts = this.toasts.filter(t => t !== toast);
                }, 400);
            }

            showSuccess(message, duration = 5000) {
                return this.createToast(message, 'success', duration);
            }

            showError(message, duration = 5000) {
                return this.createToast(message, 'error', duration);
            }

            showInfo(message, duration = 5000) {
                return this.createToast(message, 'info', duration);
            }

            showWarning(message, duration = 5000) {
                return this.createToast(message, 'warning', duration);
            }
        }

        // Initialize Toast Manager
        const toast = new ToastManager();

        // Handle Laravel session messages
        document.addEventListener('DOMContentLoaded', function() {
            // Check for success messages
            @if (session('success'))
                toast.showSuccess('{{ session('success') }}', 5000);
            @endif

            // Check for error messages
            @if (session('error'))
                toast.showError('{{ session('error') }}', 5000);
            @endif

            @if($errors->any())
                @foreach ($errors->all() as $error)
                    toast.showError('{{ $error }}', 5000);
                @endforeach
            @endif

            // Check for info messages
            @if (session('info'))
                toast.showInfo('{{ session('info') }}', 5000);
            @endif

            // Check for warning messages
            @if (session('warning'))
                toast.showWarning('{{ session('warning') }}', 5000);
            @endif

            // Handle dropdown toggles
            const dropdowns = document.querySelectorAll('.group');
            dropdowns.forEach(dropdown => {
                const trigger = dropdown.querySelector('button');
                const menu = dropdown.querySelector('[class*="group-hover"]');

                if (trigger && menu) {
                    trigger.addEventListener('click', (e) => {
                        e.preventDefault();
                        menu.classList.toggle('opacity-0');
                        menu.classList.toggle('invisible');
                    });
                }
            });

            // Close dropdowns when clicking outside
            document.addEventListener('click', (e) => {
                dropdowns.forEach(dropdown => {
                    if (!dropdown.contains(e.target)) {
                        const menu = dropdown.querySelector('[class*="group-hover"]');
                        if (menu) {
                            menu.classList.add('opacity-0');
                            menu.classList.add('invisible');
                        }
                    }
                });
            });
        });

        // Global toast function for manual use
        window.showToast = function(message, type = 'info', duration = 5000) {
            return toast.createToast(message, type, duration);
        };

        // Demo buttons for testing (remove in production)
        window.testToasts = function() {
            toast.showSuccess('تم حفظ البيانات بنجاح!');
            setTimeout(() => toast.showError('حدث خطأ أثناء المعالجة'), 1000);
            setTimeout(() => toast.showWarning('تحذير: تحقق من البيانات'), 2000);
            setTimeout(() => toast.showInfo('معلومات إضافية متاحة'), 3000);
        };
    </script>
</body>

</html>
