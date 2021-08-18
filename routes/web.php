<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Master\MasterController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SalesController;
use App\View\Components\Customer;
use Illuminate\Support\Facades\Auth;
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

Route::get('/', [AuthController::class, 'index'])->name('login.index');

// ############################# master #######################################
Route::post('/master/pagination', [MasterController::class, 'dataPagination'])->name('pagination');

// ############################# AUTH #######################################
Route::prefix('auth')->group(function() {
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::post('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/login', [AuthController::class, 'login'])->name("login");
});

// ############################## DASHBOARD ###############################
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

// ############################## CUSTOMER ####################################
Route::prefix('customer')->group(function() {
    Route::post('/', [CustomerController::class, 'getCustomer'])->name('customer.get');
    Route::post('/post', [AuthController::class, 'register'])->name('customer.post');
    Route::post('/change', [CustomerController::class, "changeStatus"])->name('customer.change');
    Route::post('/edit', [CustomerController::class, "edit"])->name('customer.edit');
    Route::post('/post-edit', [CustomerController::class, "postEdit"])->name('customer.post.edit');
    Route::post('/delete', [CustomerController::class, "delete"])->name('customer.post.delete');
});


// ############################### PRODUCT ############################################
Route::prefix("product")->group(function() {
    Route::post('/get', [ProductController::class, 'get'])->name('product.get');
    Route::post('/post', [ProductController::class, 'post'])->name('product.post');
    Route::post('/change', [ProductController::class, 'change'])->name('product.change');
    Route::post('/edit', [ProductController::class, 'edit'])->name('product.edit');
    Route::post('/postEditProduct', [ProductController::class, 'postProduct'])->name('product.post.edit');
    Route::post('/delete', [ProductController::class, 'delete'])->name('product.post.delete');
});

// ############################### PRODUCT ############################################
Route::prefix('sales')->group(function() {
    Route::get('/getProduct', [SalesController::class, 'getProduct'])->name('product.add.row');
    Route::post('/add-row', [SalesController::class, 'addRow'])->name('product.add.row');
    Route::post('/post', [SalesController::class, 'post'])->name('sales.post');
    Route::post('/get', [SalesController::class, 'get'])->name('sales.get');
});
