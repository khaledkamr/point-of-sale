<?php
use App\Http\Controllers\WarehouseController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\PurchaseRequestController;
use App\Http\Controllers\PurchaseOfferController;
use App\Http\Controllers\PurchaseOrderController;
use App\Http\Controllers\ReceiptController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\SalesInvoiceController;
use App\Http\Controllers\SalesReturnController;
use App\Http\Controllers\SupplierReturnController;
use App\Http\Controllers\InventoryTransactionController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('warehouses', WarehouseController::class);
Route::resource('categories', CategoryController::class);
Route::resource('products', ProductController::class);
Route::resource('suppliers', SupplierController::class);
Route::resource('purchase-requests', PurchaseRequestController::class);
Route::resource('purchase-offers', PurchaseOfferController::class);
Route::resource('purchase-orders', PurchaseOrderController::class);
Route::resource('receipts', ReceiptController::class);
Route::resource('customers', CustomerController::class);
Route::resource('sales-invoices', SalesInvoiceController::class);
Route::resource('sales-returns', SalesReturnController::class);
Route::resource('supplier-returns', SupplierReturnController::class);
Route::resource('inventory-transactions', InventoryTransactionController::class);