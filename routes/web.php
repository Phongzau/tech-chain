<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\Backend\AdminController;
use App\Http\Controllers\Backend\DanhMucController;
use App\Http\Controllers\Backend\DonHangController;
use App\Http\Controllers\Backend\SanPhamController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\HomeController as FrontendHomeController;
use App\Http\Controllers\Frontend\OrderController;
use App\Http\Controllers\Frontend\ProductController;
use App\Http\Controllers\HomeController;
use App\Http\Middleware\CheckRoleAdminMiddleware;
use Illuminate\Support\Facades\Auth;
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
    return view('welcome');
});

Auth::routes();
// Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::get('/', [FrontendHomeController::class, 'index'])->name('home');

Route::get('/product/detail/{id}', [ProductController::class, 'detailSanPham'])->name('products.detail');

/** Cart Routes */
Route::get('/list-cart', [CartController::class, 'listCart'])->name('cart.list');
Route::post('/add-to-cart', [CartController::class, 'addCart'])->name('cart.add');
Route::post('/update-cart', [CartController::class, 'updateCart'])->name('cart.update');

/** Product Routes*/
Route::get('/product', [ProductController::class, 'listSanPham'])->name('product');

Route::middleware('auth')
    ->group(function () {
        Route::resource('don-hang', OrderController::class);
    });



/** Admin Routes */
Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {
    Route::get('login', [AdminController::class, 'showFormLogin'])->name('login');
    Route::get('register', [AdminController::class, 'showFormRegister'])->name('register');

    Route::group(['middleware' => ['auth', 'auth.admin']], function () {
        Route::get('dashboard', [AdminController::class, 'index'])->name('dashboard');

        Route::resource('danh-muc', DanhMucController::class);

        Route::resource('san-pham', SanPhamController::class);
    });

    Route::resource('don-hang', DonHangController::class);
});
