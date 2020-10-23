<?php

use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EntradaController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\ProveedorController;
use App\Http\Controllers\SalidaController;
use App\Http\Controllers\UnidadMedidaController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::resource('/', DashboardController::class);
Route::resource('/medida', UnidadMedidaController::class);
Route::resource('/categoria', CategoriaController::class);
Route::resource('/proveedor', ProveedorController::class);
Route::resource('/producto', ProductoController::class);
Route::resource('/entrada', EntradaController::class);
Route::resource('/salida', SalidaController::class);