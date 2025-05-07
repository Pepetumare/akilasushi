<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\ProductoAdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ArmaTuSushiController;

/*
|--------------------------------------------------------------------------
| RUTAS PÚBLICAS
|--------------------------------------------------------------------------
*/

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/menu/{slug}', [ProductoController::class, 'categoria'])->name('menu.categoria');
Route::get('/menu', [ProductoController::class, 'index'])->name('menu');
Route::get('/menu/{filter?}', [App\Http\Controllers\ProductoController::class, 'menu'])->name('menu');


Route::get('/arma', [ProductoController::class, 'arma'])->name('arma');
Route::get('/locales', [HomeController::class, 'locales'])->name('locales');
Route::get('/contacto', [HomeController::class, 'contacto'])->name('contacto');

Route::get('/producto/{id}', [ProductoController::class, 'detalle'])->name('producto.detalle');
Route::post('/producto/{id}/agregar', [ProductoController::class, 'agregarPersonalizado'])->name('producto.agregar');
Route::get('/producto/modal/{id}', [ProductoController::class, 'modal'])->name('producto.modal');


/*
|--------------------------------------------------------------------------
| CARRITO
|--------------------------------------------------------------------------
*/
Route::get('/carrito', [CartController::class, 'index'])->name('cart.index');
Route::get('/carrito/agregar/{id}', [CartController::class, 'add'])->name('cart.add');
Route::get('/carrito/eliminar/{id}', [CartController::class, 'remove'])->name('cart.remove');
Route::get('/carrito/checkout', [CartController::class, 'checkout'])->name('cart.checkout');

/*
|--------------------------------------------------------------------------
| ARMA TU SUSHI
|--------------------------------------------------------------------------
*/
Route::get('/arma', [ArmaTuSushiController::class, 'index'])->name('arma');
Route::post('/arma/agregar', [ArmaTuSushiController::class, 'agregar'])->name('arma.agregar');

/*
|--------------------------------------------------------------------------
| ADMIN
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function () {
    // Dashboard dinámico con datos
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

    // CRUD de productos
    Route::resource('/productos', ProductoAdminController::class);
});
/*
|--------------------------------------------------------------------------
| VENDEDOR
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:vendedor'])->prefix('vendedor')->group(function () {
    Route::get('/dashboard', function () {
        return view('vendedor.dashboard');
    })->name('vendedor.dashboard');
});

/*
|--------------------------------------------------------------------------
| USUARIO NORMAL
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:user'])->prefix('perfil')->group(function () {
    Route::get('/', function () {
        return view('user.perfil');
    })->name('user.perfil');
});


Route::get('/debug-token', function () {
    return csrf_token();
});
/*
|--------------------------------------------------------------------------
| AUTENTICACIÓN (BREEZE)
|--------------------------------------------------------------------------
*/
require __DIR__.'/auth.php';
