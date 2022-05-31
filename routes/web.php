<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AjaxController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SubcategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductImageController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\SliderController;
use App\Http\Controllers\Sub_SubcategoryController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WishlistController;

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

// User Authentication Route
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/register', [UserController::class, 'register'])->name('user.register')->middleware('guest');
Route::post('/register', [UserController::class, 'register'])->name('user.register')->middleware('guest');
Route::get('/login', [SessionController::class, 'login'])->name('user.login')->middleware('guest');
Route::post('/login', [SessionController::class, 'store'])->name('user.authenticate')->middleware('guest');
Route::post('/logout', [SessionController::class, 'destroy'])->name('user.logout')->middleware('auth');
Route::get('/verification/{random_token}', [UserController::class, 'emailVerify'])->name('user.verify');
Route::get('/forgetPassword', [UserController::class, 'forgetPassword'])->name('user.forgetPassword')->middleware('guest');
Route::post('/forgetPassword', [UserController::class, 'forgetPassword'])->name('user.forgetPassword')->middleware('guest');
Route::get('/resetPassword/{random_token}', [UserController::class, 'resetPassword'])->name('resetPassword.verify');
Route::post('/resetConfirm', [UserController::class, 'resetConfirm'])->name('user.resetConfirm');
Route::get('/changePassword', [UserController::class, 'changePassword'])->name('user.changePassword')->middleware('auth');
Route::post('/changePassword', [UserController::class, 'changePassword'])->name('user.changePassword')->middleware('auth');
Route::get('/user/profile', [UserController::class, 'userProfile'])->name('user.profile')->middleware('auth');
Route::get('/user/profile/manage', [UserController::class, 'manageProfile'])->name('user.manageProfile')->middleware('auth');
Route::post('/user/profile/manage', [UserController::class, 'manageProfile'])->name('user.manageProfile')->middleware('auth');

// Product Route
Route::get('/productDetails/{id}/{slug}', [HomeController::class, 'productDetails'])->name('productDetails');
Route::get('/tagWiseProducts/{tag}', [HomeController::class, 'tagWiseProducts'])->name('tagWiseProducts');
Route::get('/subCategoryWiseProducts/{subCat_id}/{subCat_name}', [HomeController::class, 'subCategoryWiseProducts'])->name('subCategoryWiseProducts');
Route::get('/sub-subCategoryWiseProducts/{sub_subCat_id}/{sub_subCat_name}', [HomeController::class, 'sub_subCategoryWiseProducts'])->name('sub_subCategoryWiseProducts');
Route::post('/fetchProductData', [AjaxController::class, 'fetchProductData'])->name('fetchProductData');

// Cart Route
Route::post('/cart/addToCart/{product_id}', [CartController::class, 'addToCart'])->name('cart.addToCart');
Route::get('/cart/getFromCart', [CartController::class, 'getFromCart'])->name('cart.getFromCart');
Route::post('/cart/removeFromCart/{rowId}', [CartController::class, 'removeFromCart'])->name('cart.removeFromCart');

// Wishlist Route
Route::get('/wishlist/index', [WishlistController::class, 'index'])->name('wishlist.index')->middleware('auth');
Route::get('/wishlist/count', [WishlistController::class, 'countWishlist'])->name('wishlist.countWishlist')->middleware('auth');
Route::post('/wishlist/store', [WishlistController::class, 'store'])->name('wishlist.addToWishlist');
Route::delete('/wishlist/delete/{product_id}', [WishlistController::class, 'destroy'])->name('wishlist.destroy')->middleware('auth');

// Admin Login Route
Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
Route::post('/admin/auth', [AdminController::class, 'auth'])->name('admin.auth');

Route::group(['middleware' => 'admin_auth'], function()
{
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/admin/logout', [AdminController::class, 'logout'])->name('admin.logout');
    Route::delete('/product-images/{id}/destoryAll', [ProductImageController::class, 'destoryAll'])->name('product-images.destroyAll');
    Route::resource('/admin/category', CategoryController::class);
    Route::resource('/admin/subcategory', SubcategoryController::class);
    Route::resource('/admin/subSubcategory', Sub_SubcategoryController::class);
    Route::resource('/admin/product', ProductController::class);
    Route::resource('/admin/product-images', ProductImageController::class);
    Route::resource('/admin/coupon', CouponController::class);
    Route::resource('/admin/slider', SliderController::class);

    // Ajax Controller Route
    Route::post('/categoryUpdateStatus', [AjaxController::class, 'categoryUpdateStatus'])->name('category.updateStatus');
    Route::post('/subcategoryUpdateStatus', [AjaxController::class, 'subcategoryUpdateStatus'])->name('subcategory.updateStatus');
    Route::post('/subSubcategoryUpdateStatus', [AjaxController::class, 'subSubcategoryUpdateStatus'])->name('subSubcategory.updateStatus');
    Route::post('/productUpdateStatus', [AjaxController::class, 'productUpdateStatus'])->name('product.updateStatus');
    Route::post('/couponUpdateStatus', [AjaxController::class, 'couponUpdateStatus'])->name('coupon.updateStatus');
    Route::post('/productImageUpdateStatus', [AjaxController::class, 'productImageUpdateStatus'])->name('productImage.updateStatus');
    Route::post('/sliderUpdateStatus', [AjaxController::class, 'sliderUpdateStatus'])->name('slider.updateStatus');
    Route::post('/loadSubcategory', [AjaxController::class, 'loadSubcategory'])->name('product.loadSubcategory');
    Route::post('/loadSubSubcategory', [AjaxController::class, 'loadSubSubcategory'])->name('product.loadSubSubcategory');
    Route::post('/loadSeletedSubcategory', [AjaxController::class, 'loadSeletedSubcategory'])->name('product.loadSeletedSubcategory');
    Route::post('/loadSeletedSubSubcategory', [AjaxController::class, 'loadSeletedSubSubcategory'])->name('product.loadSeletedSubSubcategory');

});
