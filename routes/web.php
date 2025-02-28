<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\SuppliersController;
use App\Http\Controllers\SaleController;

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
    return view('auth.login');
});

Route::middleware(['auth'])->group(function () {
    Route::resource('products', ProductController::class);
    Route::resource('categories', CategoriesController::class);
    Route::resource('suppliers', SuppliersController::class);
    Route::get('sales', [SaleController::class, 'index'])->name('sales.index');
    Route::get('sales/create', [SaleController::class, 'create'])->name('sales.create');
    Route::get('sales/{sale}', [SaleController::class, 'show'])->name('sales.show');

    Route::post('sales', [SaleController::class, 'store'])->name('sales.store');
    Route::get('inventories', [InventoryController::class, 'index'])->name('inventories.index');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::middleware(['role:Admin'])->group(function () {
        Route::get('/admin', function () {
            return view('admin.index');
        })->name('admin.dashboard');
    });

    Route::middleware(['role:Vendedor'])->group(function () {
        Route::get('/ventas', function () {
            return view('ventas.index');
        })->name('ventas.dashboard');
    });

    Route::middleware(['role:Cliente'])->group(function () {
        Route::get('/cliente', function () {
            return view('cliente.index');
        })->name('cliente.dashboard');
    });
});
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
