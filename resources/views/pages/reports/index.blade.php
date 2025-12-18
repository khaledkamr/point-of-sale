@extends('layouts.app')

@section('title', 'التقارير والإحصائيات')

@section('content')
    <div class="p-6">
        <!-- Page Header -->
        <div class="flex items-center justify-between mb-8">
            <h1 class="text-3xl font-bold text-gray-800 flex items-center">
                <i class="fas fa-chart-bar ml-3 text-orange-500"></i>
                التقارير والإحصائيات
            </h1>
            <div class="flex items-center space-x-3 space-x-reverse">
                <button type="button"
                    class="text-white bg-orange-500 hover:bg-orange-600 focus:ring-4 focus:ring-orange-300 font-medium rounded-lg text-sm px-5 py-2.5 flex items-center">
                    <i class="fas fa-download ml-2"></i>
                    تصدير التقرير
                </button>
                <button type="button"
                    class="text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-100 font-medium rounded-lg text-sm px-5 py-2.5 flex items-center">
                    <i class="fas fa-calendar ml-2"></i>
                    اختيار الفترة
                </button>
            </div>
        </div>

        <!-- Statistics Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <!-- Total Sales Card -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600">إجمالي المبيعات</p>
                        <p class="text-3xl font-bold text-gray-900">245,670 ر.س</p>
                        <p class="text-sm text-orange-600 flex items-center">
                            <i class="fas fa-arrow-up ml-1"></i>
                            12.5% من الشهر الماضي
                        </p>
                    </div>
                    <div class="p-3 bg-orange-100 rounded-full">
                        <i class="fas fa-chart-line text-2xl text-orange-600"></i>
                    </div>
                </div>
            </div>

            <!-- Total Orders Card -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600">عدد الطلبات</p>
                        <p class="text-3xl font-bold text-gray-900">1,247</p>
                        <p class="text-sm text-orange-600 flex items-center">
                            <i class="fas fa-arrow-up ml-1"></i>
                            8.2% من الشهر الماضي
                        </p>
                    </div>
                    <div class="p-3 bg-orange-100 rounded-full">
                        <i class="fas fa-shopping-cart text-2xl text-orange-600"></i>
                    </div>
                </div>
            </div>

            <!-- Total Products Card -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600">المنتجات المباعة</p>
                        <p class="text-3xl font-bold text-gray-900">3,892</p>
                        <p class="text-sm text-red-600 flex items-center">
                            <i class="fas fa-arrow-down ml-1"></i>
                            2.1% من الشهر الماضي
                        </p>
                    </div>
                    <div class="p-3 bg-orange-100 rounded-full">
                        <i class="fas fa-box text-2xl text-orange-600"></i>
                    </div>
                </div>
            </div>

            <!-- Average Order Value Card -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600">متوسط قيمة الطلب</p>
                        <p class="text-3xl font-bold text-gray-900">197 ر.س</p>
                        <p class="text-sm text-orange-600 flex items-center">
                            <i class="fas fa-arrow-up ml-1"></i>
                            4.7% من الشهر الماضي
                        </p>
                    </div>
                    <div class="p-3 bg-orange-100 rounded-full">
                        <i class="fas fa-calculator text-2xl text-orange-600"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Charts Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
            <!-- Sales Trend Chart -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-lg font-semibold text-gray-900">اتجاه المبيعات</h3>
                    <div class="flex items-center space-x-2 space-x-reverse">
                        <select class="text-sm border border-gray-300 rounded px-2 py-1">
                            <option>آخر 7 أيام</option>
                            <option>آخر 30 يوم</option>
                            <option>آخر 3 أشهر</option>
                        </select>
                    </div>
                </div>
                <canvas id="salesTrendChart" width="400" height="200"></canvas>
            </div>

            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-lg font-semibold text-gray-900">توزيع المبيعات حسب الفئة</h3>
                </div>
                <canvas id="categoryChart" style="max-height: 300px;"></canvas>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
            <div class="lg:col-span-2 bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-lg font-semibold text-gray-900">الإيرادات الشهرية</h3>
                    <div class="flex items-center space-x-2 space-x-reverse">
                        <span
                            class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-orange-100 text-orange-800">
                            <span class="w-2 h-2 bg-orange-600 rounded-full ml-1"></span>
                            الإيرادات
                        </span>
                        <span
                            class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-orange-200 text-orange-900">
                            <span class="w-2 h-2 bg-orange-700 rounded-full ml-1"></span>
                            الأرباح
                        </span>
                    </div>
                </div>
                <canvas id="revenueChart" style="max-height: 500px;"></canvas>
            </div>

            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-6">أفضل المنتجات مبيعاً</h3>
                <div class="space-y-4">
                    <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                        <div class="flex items-center">
                            <div class="w-10 h-10 bg-orange-100 rounded-full flex items-center justify-center ml-3">
                                <span class="text-orange-600 font-bold">1</span>
                            </div>
                            <div>
                                <p class="font-medium text-gray-900">قهوة عربية</p>
                                <p class="text-sm text-gray-500">247 مبيعة</p>
                            </div>
                        </div>
                        <span class="text-green-600 font-bold">12,350 ر.س</span>
                    </div>

                    <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                        <div class="flex items-center">
                            <div class="w-10 h-10 bg-orange-200 rounded-full flex items-center justify-center ml-3">
                                <span class="text-orange-700 font-bold">2</span>
                            </div>
                            <div>
                                <p class="font-medium text-gray-900">شاي أحمر</p>
                                <p class="text-sm text-gray-500">189 مبيعة</p>
                            </div>
                        </div>
                        <span class="text-orange-600 font-bold">8,920 ر.س</span>
                    </div>

                    <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                        <div class="flex items-center">
                            <div class="w-10 h-10 bg-orange-300 rounded-full flex items-center justify-center ml-3">
                                <span class="text-orange-800 font-bold">3</span>
                            </div>
                            <div>
                                <p class="font-medium text-gray-900">عصير برتقال</p>
                                <p class="text-sm text-gray-500">156 مبيعة</p>
                            </div>
                        </div>
                        <span class="text-green-600 font-bold">6,240 ر.س</span>
                    </div>

                    <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                        <div class="flex items-center">
                            <div class="w-10 h-10 bg-purple-100 rounded-full flex items-center justify-center ml-3">
                                <span class="text-purple-600 font-bold">4</span>
                            </div>
                            <div>
                                <p class="font-medium text-gray-900">مياه معدنية</p>
                                <p class="text-sm text-gray-500">134 مبيعة</p>
                            </div>
                        </div>
                        <span class="text-green-600 font-bold">2,680 ر.س</span>
                    </div>

                    <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                        <div class="flex items-center">
                            <div class="w-10 h-10 bg-red-100 rounded-full flex items-center justify-center ml-3">
                                <span class="text-red-600 font-bold">5</span>
                            </div>
                            <div>
                                <p class="font-medium text-gray-900">شوكولاتة</p>
                                <p class="text-sm text-gray-500">98 مبيعة</p>
                            </div>
                        </div>
                        <span class="text-green-600 font-bold">4,900 ر.س</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Transactions Table -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200">
            <div class="p-6 border-b border-gray-200">
                <div class="flex items-center justify-between">
                    <h3 class="text-lg font-semibold text-gray-900">آخر المعاملات</h3>
                    <a href="#" class="text-blue-600 hover:text-blue-800 text-sm font-medium">عرض الكل</a>
                </div>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-right text-gray-500">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3">رقم الطلب</th>
                            <th scope="col" class="px-6 py-3">العميل</th>
                            <th scope="col" class="px-6 py-3">المنتجات</th>
                            <th scope="col" class="px-6 py-3">المبلغ</th>
                            <th scope="col" class="px-6 py-3">الحالة</th>
                            <th scope="col" class="px-6 py-3">التاريخ</th>
                            <th scope="col" class="px-6 py-3">الإجراءات</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="bg-white border-b hover:bg-gray-50">
                            <td class="px-6 py-4 font-medium text-gray-900">#ORD-001</td>
                            <td class="px-6 py-4">أحمد محمد</td>
                            <td class="px-6 py-4">3 منتجات</td>
                            <td class="px-6 py-4 font-bold text-green-600">245 ر.س</td>
                            <td class="px-6 py-4">
                                <span
                                    class="bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded">مكتمل</span>
                            </td>
                            <td class="px-6 py-4">2024-12-18</td>
                            <td class="px-6 py-4">
                                <button class="text-blue-600 hover:text-blue-900">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </td>
                        </tr>
                        <tr class="bg-white border-b hover:bg-gray-50">
                            <td class="px-6 py-4 font-medium text-gray-900">#ORD-002</td>
                            <td class="px-6 py-4">فاطمة علي</td>
                            <td class="px-6 py-4">2 منتجات</td>
                            <td class="px-6 py-4 font-bold text-green-600">180 ر.س</td>
                            <td class="px-6 py-4">
                                <span class="bg-yellow-100 text-yellow-800 text-xs font-medium px-2.5 py-0.5 rounded">قيد
                                    المعالجة</span>
                            </td>
                            <td class="px-6 py-4">2024-12-18</td>
                            <td class="px-6 py-4">
                                <button class="text-blue-600 hover:text-blue-900">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </td>
                        </tr>
                        <tr class="bg-white border-b hover:bg-gray-50">
                            <td class="px-6 py-4 font-medium text-gray-900">#ORD-003</td>
                            <td class="px-6 py-4">محمد خالد</td>
                            <td class="px-6 py-4">5 منتجات</td>
                            <td class="px-6 py-4 font-bold text-green-600">420 ر.س</td>
                            <td class="px-6 py-4">
                                <span
                                    class="bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded">مكتمل</span>
                            </td>
                            <td class="px-6 py-4">2024-12-17</td>
                            <td class="px-6 py-4">
                                <button class="text-blue-600 hover:text-blue-900">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </td>
                        </tr>
                        <tr class="bg-white border-b hover:bg-gray-50">
                            <td class="px-6 py-4 font-medium text-gray-900">#ORD-004</td>
                            <td class="px-6 py-4">سارة أحمد</td>
                            <td class="px-6 py-4">1 منتج</td>
                            <td class="px-6 py-4 font-bold text-green-600">85 ر.س</td>
                            <td class="px-6 py-4">
                                <span class="bg-red-100 text-red-800 text-xs font-medium px-2.5 py-0.5 rounded">ملغي</span>
                            </td>
                            <td class="px-6 py-4">2024-12-17</td>
                            <td class="px-6 py-4">
                                <button class="text-blue-600 hover:text-blue-900">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </td>
                        </tr>
                        <tr class="bg-white hover:bg-gray-50">
                            <td class="px-6 py-4 font-medium text-gray-900">#ORD-005</td>
                            <td class="px-6 py-4">عبدالله سعد</td>
                            <td class="px-6 py-4">4 منتجات</td>
                            <td class="px-6 py-4 font-bold text-green-600">320 ر.س</td>
                            <td class="px-6 py-4">
                                <span
                                    class="bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded">مكتمل</span>
                            </td>
                            <td class="px-6 py-4">2024-12-16</td>
                            <td class="px-6 py-4">
                                <button class="text-blue-600 hover:text-blue-900">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Chart.js CDN -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Sales Trend Chart
            const salesTrendCtx = document.getElementById('salesTrendChart').getContext('2d');
            new Chart(salesTrendCtx, {
                type: 'line',
                data: {
                    labels: ['الاثنين', 'الثلاثاء', 'الأربعاء', 'الخميس', 'الجمعة', 'السبت', 'الأحد'],
                    datasets: [{
                        label: 'المبيعات (ر.س)',
                        data: [12000, 19000, 15000, 25000, 22000, 30000, 28000],
                        borderColor: 'rgb(249, 115, 22)',
                        backgroundColor: 'rgba(249, 115, 22, 0.1)',
                        tension: 0.1,
                        fill: true
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            display: false
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                callback: function(value) {
                                    return value.toLocaleString() + ' ر.س';
                                }
                            }
                        }
                    }
                }
            });

            // Category Distribution Chart
            const categoryCtx = document.getElementById('categoryChart').getContext('2d');
            new Chart(categoryCtx, {
                type: 'doughnut',
                data: {
                    labels: ['مشروبات', 'طعام', 'حلويات', 'مخبوزات', 'أخرى'],
                    datasets: [{
                        data: [35, 25, 20, 15, 5],
                        backgroundColor: [
                            '#f97316',
                            '#ea580c',
                            '#fb923c',
                            '#fed7aa',
                            '#ffedd5'
                        ],
                        borderWidth: 2,
                        borderColor: '#ffffff'
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'bottom',
                            labels: {
                                padding: 20,
                                usePointStyle: true
                            }
                        }
                    }
                }
            });

            // Monthly Revenue Chart
            const revenueCtx = document.getElementById('revenueChart').getContext('2d');
            new Chart(revenueCtx, {
                type: 'bar',
                data: {
                    labels: ['يناير', 'فبراير', 'مارس', 'أبريل', 'مايو', 'يونيو', 'يوليو', 'أغسطس',
                        'سبتمبر', 'أكتوبر', 'نوفمبر', 'ديسمبر'
                    ],
                    datasets: [{
                            label: 'الإيرادات',
                            data: [65000, 78000, 85000, 72000, 68000, 95000, 89000, 92000, 78000, 86000,
                                94000, 98000
                            ],
                            backgroundColor: 'rgba(249, 115, 22, 0.8)',
                            borderColor: 'rgb(249, 115, 22)',
                            borderWidth: 1
                        },
                        {
                            label: 'الأرباح',
                            data: [25000, 32000, 38000, 28000, 26000, 42000, 38000, 40000, 32000, 36000,
                                41000, 45000
                            ],
                            backgroundColor: 'rgba(234, 88, 12, 0.8)',
                            borderColor: 'rgb(234, 88, 12)',
                            borderWidth: 1
                        }
                    ]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            display: false
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                callback: function(value) {
                                    return (value / 1000) + 'ك ر.س';
                                }
                            }
                        }
                    }
                }
            });
        });
    </script>
@endsection
