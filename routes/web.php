<?php

use App\Http\Controllers\ClientController;
use App\Http\Controllers\DelegateController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\WelcomeController;
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

Route::get('/', [WelcomeController::class, 'index']);

Route::get('/clients', [ClientController::class, 'index'])->name('clients');

Route::delete('/client/{id}', [ClientController::class, 'destroy'])->name('clients.delete');

Route::post('/client', [ClientController::class, 'store'])->name('clients.store');

Route::get('/client_edit/{id}', [ClientController::class, 'edit'])->name('clients.edit');

Route::put('/client_update/{id}', [ClientController::class, 'update'])->name('clients.update');


// delegates

Route::get('/delegates', [DelegateController::class, 'index'])->name('delegates');

Route::delete('/delegate/{id}', [DelegateController::class, 'destroy'])->name('delegates.delete');

Route::post('/delegate', [DelegateController::class, 'store'])->name('delegates.store');

Route::get('/delegate_edit/{id}', [DelegateController::class, 'edit'])->name('delegates.edit');

Route::put('/delegate_update/{id}', [DelegateController::class, 'update'])->name('delegates.update');


// products

Route::get('/products', [ProductController::class, 'index'])->name('products');

Route::delete('/product/{id}', [ProductController::class, 'destroy'])->name('products.delete');

Route::post('/product', [ProductController::class, 'store'])->name('products.store');

Route::get('/product_edit/{id}', [ProductController::class, 'edit'])->name('products.edit');

Route::put('/product_update/{id}', [ProductController::class, 'update'])->name('products.update');


// products

Route::post('/transaction', [ProductController::class, 'store'])->name('transactions.store');
