<?php

use App\Http\Controllers\BackupController;
use App\Http\Controllers\CategorieController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PurchaseInvoiceController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\UserController;

use App\Models\Invoice;
use App\Models\Product;
use App\Models\PurchaseInvoice;
use App\Models\Service;
use App\Models\Supplier;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect()->route('dashboard');
});

Route::get('/log', function () {
    return view('Login.login');
});




Route::middleware('auth')->group(function () {
    Route::get('/company/create', [CompanyController::class, 'create'])->name('company.create');
    Route::post('/company', [CompanyController::class, 'store'])->name('company.store');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth','company.check'])->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');


    //les routes de l'entreprise
    Route::get('/company', [CompanyController::class, 'index'])->name('company.index');
    Route::get('/company/{company}', [CompanyController::class, 'show'])->name('company.show');
    Route::get('/company/{company}/edit', [CompanyController::class, 'edit'])->name('company.edit');
    Route::put('/company/{company}', [CompanyController::class, 'update'])->name('company.update');
    Route::delete('/company/{company}', [CompanyController::class, 'destroy'])->name('company.destroy');
    //les routes de fournisseur
    Route::resource('supplier',SupplierController::class);
    Route::get('supplier.archive',[SupplierController::class ,'archive'])->name('supplier.archive');
    Route::get('supplier.search', [SupplierController::class,'search'])->name('supplier.search');
    Route::get('supplier.searchArchive', [SupplierController::class,'searchArchive'])->name('supplier.searchArchive');
    Route::patch('/supplier/{id}/restore',[SupplierController::class,'restore'])->name('supplier.restore');
    Route::get('/suppliers/export', [SupplierController::class,'exportExcel'])->name('supplier.export');
    Route::get('suppliers/export-pdf', [SupplierController::class,'exportPdf'])->name('supplier.export-pdf');


    //les routes de categorie
    Route::resource('category',CategoryController::class)->except(['show']);
    //les routes de product
    Route::resource('product',ProductController::class)->except(['show']);
    Route::get('product.search', [ProductController::class,'search'])->name('product.search');
    Route::get('product.archive',[ProductController::class ,'archive'])->name('product.archive');
    Route::patch('/product/{id}/restore',[ProductController::class,'restore'])->name('product.restore');
    Route::get('/products/export', [ProductController::class,'exportExcel'])->name('product.export');
    Route::get('products/export-pdf', [ProductController::class,'exportPdf'])->name('product.export-pdf');

    //les roles
    Route::resource('roles',RoleController::class);
    Route::resource('user',UserController::class);

    Route::get('user.search', [UserController::class,'search'])->name('user.search');

    // les routes des achats
    Route::resource('purchase', PurchaseInvoiceController::class);
    Route::get('purchase/downloadJustif/{id}', [PurchaseInvoiceController::class, 'downloadJustif'])->name('purchase.downloadJustif');
    Route::get('purchase/download/{id}', [PurchaseInvoiceController::class, 'download'])->name('purchase.download');
    Route::delete('purchase/{id}/forcedelelete',[PurchaseInvoiceController::class,'forcedelete'])->name('purchase.forcedelete');
    Route::patch('purchase/{id}/restore',[PurchaseInvoiceController::class,'restore'])->name('purchase.restore');
    Route::get('purchase.archive',[PurchaseInvoiceController::class ,'archive'])->name('purchase.archive');
    Route::get('purchase.search', [PurchaseInvoiceController::class,'search'])->name('purchase.search');

    // les routes des factures
    Route::resource('invoice',InvoiceController::class);
    Route::delete('invoice/{id}/forcedelelete',[InvoiceController::class,'forcedelete'])->name('invoice.forcedelete');
    Route::get('invoice.archive',[InvoiceController::class ,'archive'])->name('invoice.archive');

    Route::patch('invoice/{id}/restore',[InvoiceController::class,'restore'])->name('invoice.restore');
    Route::get('invoice.search', [InvoiceController::class,'search'])->name('invoice.search');
    // les routes des services
    Route::resource('service',ServiceController::class)->except(['show']);
    Route::get('service.archive',[ServiceController::class ,'archive'])->name('service.archive');
    Route::get('service.search', [ServiceController::class,'search'])->name('service.search');
    Route::patch('service/{id}/restore',[ServiceController::class,'restore'])->name('service.restore');
    Route::delete('service/{id}/forcedelelete',[ServiceController::class,'forcedelete'])->name('service.forcedelete');
    Route::get('/services/export', [ServiceController::class,'exportExcel'])->name('service.export');
    Route::get('services/export-pdf', [ServiceController::class,'exportPdf'])->name('service.export-pdf');

    // les routes des clients
    Route::resource('customer',CustomerController::class)->except(['show']);
    Route::get('customer.archive',[CustomerController::class ,'archive'])->name('customer.archive');
    Route::get('customer.search', [CustomerController::class,'search'])->name('customer.search');
    Route::patch('customer/{id}/restore',[CustomerController::class,'restore'])->name('customer.restore');
    Route::get('customer/export-suppliers', [CustomerController::class,'exportCustomers'])->name('customers.export');
    Route::get('customers/export-pdf', [CustomerController::class,'exportPdf'])->name('customer.export-pdf');
    Route::get('backup', [backupController::class,'backup']);

    Route::get('setting',[SettingController::class,'show'])->name('setting.show');



});

require __DIR__.'/auth.php';
