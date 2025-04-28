<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductoController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/menu', [ProductoController::class, 'index'])->name('menu');
Route::get('/arma', [ProductoController::class, 'arma'])->name('arma');
Route::get('/locales', [HomeController::class, 'locales'])->name('locales');
Route::get('/contacto', [HomeController::class, 'contacto'])->name('contacto');

// Ruta para ver detalle de producto si quieres en futuro
Route::get('/producto/{id}', [ProductoController::class, 'show'])->name('producto.show');

require __DIR__.'/auth.php';
