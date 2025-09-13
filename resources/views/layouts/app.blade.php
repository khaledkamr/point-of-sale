<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - نظام نقاط البيع</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Cairo', sans-serif;
        }
    </style>
</head>
<body class="bg-gray-100">
    <!-- Navbar -->
    <nav class="bg-blue-600 text-white p-4 shadow-md">
        <div class="container mx-auto flex justify-between items-center">
            <a href="/" class="text-2xl font-bold">نظام نقاط البيع</a>
            <div>
                <a href="#" class="px-4">تسجيل الخروج</a> <!-- Add auth logic later -->
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="flex">
        <!-- Sidebar -->
        <aside class="w-64 bg-gray-800 text-white min-h-screen p-4">
            <h2 class="text-xl font-semibold mb-4">التنقل</h2>
            <ul>
                <li class="mb-2">
                    <a href="{{ route('warehouses.index') }}" class="hover:bg-gray-700 p-2 rounded block">المستودعات</a>
                </li>
                <li class="mb-2">
                    <a href="{{ route('categories.index') }}" class="hover:bg-gray-700 p-2 rounded block">الأصناف</a>
                </li>
                <li class="mb-2">
                    <a href="{{ route('products.index') }}" class="hover:bg-gray-700 p-2 rounded block">المنتجات</a>
                </li>
                <li class="mb-2">
                    <a href="{{ route('suppliers.index') }}" class="hover:bg-gray-700 p-2 rounded block">الموردين</a>
                </li>
                <li class="mb-2">
                    <a href="{{ route('purchase-requests.index') }}" class="hover:bg-gray-700 p-2 rounded block">طلبات الشراء</a>
                </li>
                <li class="mb-2">
                    <a href="{{ route('purchase-offers.index') }}" class="hover:bg-gray-700 p-2 rounded block">عروض الشراء</a>
                </li>
                <li class="mb-2">
                    <a href="{{ route('purchase-orders.index') }}" class="hover:bg-gray-700 p-2 rounded block">أوامر الشراء</a>
                </li>
                <li class="mb-2">
                    <a href="{{ route('receipts.index') }}" class="hover:bg-gray-700 p-2 rounded block">إيصالات الاستلام</a>
                </li>
                <li class="mb-2">
                    <a href="{{ route('customers.index') }}" class="hover:bg-gray-700 p-2 rounded block">العملاء</a>
                </li>
                <li class="mb-2">
                    <a href="{{ route('sales-invoices.index') }}" class="hover:bg-gray-700 p-2 rounded block">فواتير المبيعات</a>
                </li>
                <li class="mb-2">
                    <a href="{{ route('sales-returns.index') }}" class="hover:bg-gray-700 p-2 rounded block">مرتجعات المبيعات</a>
                </li>
                <li class="mb-2">
                    <a href="{{ route('supplier-returns.index') }}" class="hover:bg-gray-700 p-2 rounded block">مرتجعات الموردين</a>
                </li>
                <li class="mb-2">
                    <a href="{{ route('inventory-transactions.index') }}" class="hover:bg-gray-700 p-2 rounded block">حركات المخزون</a>
                </li>
            </ul>
        </aside>

        <!-- Content -->
        <main class="flex-1 p-6">
            @if (session('success'))
                <div class="bg-green-100 text-green-700 p-4 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif
            @yield('content')
        </main>
    </div>
</body>
</html>