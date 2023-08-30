<?php

use App\Http\Controllers\CategorieController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\SupplierController;
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
    return view('template.dashboard');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    //les routes de l'entreprise
    Route::resource('company',CompanyController::class);
    //les routes de fournisseur
    Route::resource('supplier',SupplierController::class);
    //les routes de categorie
    Route::resource('category',CategoryController::class)->except(['show']);

    Route::get('supplier.archive',[SupplierController::class ,'archive'])->name('supplier.archive');


    Route::get('supplier.search', [SupplierController::class,'search'])->name('supplier.search');
    Route::get('supplier.searchArchive', [SupplierController::class,'searchArchive'])->name('supplier.searchArchive');
    Route::patch('/supplier/{id}/restore',[SupplierController::class,'restore'])->name('supplier.restore');

    Route::get('setting',[SettingController::class,'show'])->name('setting.show');

});

require __DIR__.'/auth.php';
