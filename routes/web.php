<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ArmaTuSushiController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\ProductoAdminController;

//-----------------------------------------------------------------------------------
// Páginas públicas

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/locales', [HomeController::class, 'locales'])->name('locales');
Route::get('/contacto', [HomeController::class, 'contacto'])->name('contacto');

//-----------------------------------------------------------------------------------
// Menú y Personalización

Route::get('/menu', [ProductoController::class, 'index'])->name('menu');
Route::get('/producto/{id}', [ProductoController::class, 'detalle'])->name('producto.detalle');
Route::post('/producto/{id}/agregar', [ProductoController::class, 'agregarPersonalizado'])->name('producto.agregar');

Route::get('/arma', [ArmaTuSushiController::class, 'index'])->name('arma');
Route::post('/arma/agregar', [ArmaTuSushiController::class, 'agregar'])->name('arma.agregar');

//-----------------------------------------------------------------------------------
// Carrito

Route::get('/carrito', [CartController::class, 'index'])->name('cart.index');
Route::get('/carrito/agregar/{id}', [CartController::class, 'add'])->name('cart.add');
Route::get('/carrito/eliminar/{id}', [CartController::class, 'remove'])->name('cart.remove');
Route::get('/carrito/checkout', [CartController::class, 'checkout'])->name('cart.checkout');

//-----------------------------------------------------------------------------------
// Área Administrador

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    
    // CRUD de productos
    Route::resource('/productos', ProductoAdminController::class);
});

//-----------------------------------------------------------------------------------
// Área Vendedor

Route::middleware(['auth', 'role:vendedor'])->prefix('vendedor')->group(function () {
    Route::get('/dashboard', function () {
        return view('vendedor.dashboard');
    })->name('vendedor.dashboard');
});

//-----------------------------------------------------------------------------------
// Área Usuario Normal

Route::middleware(['auth', 'role:user'])->prefix('perfil')->group(function () {
    Route::get('/', function () {
        return view('user.perfil');
    })->name('user.perfil');
});

//-----------------------------------------------------------------------------------

require __DIR__.'/auth.php';
