<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AjaxController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\SubcategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductImageController;
use App\Http\Controllers\ReviewController;
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
Route::get('/productDetails/{id}', [HomeController::class, 'productDetails'])->name('productDetails');
Route::get('/tagWiseProducts/{tag}', [HomeController::class, 'tagWiseProducts'])->name('tagWiseProducts');
Route::get('/subCategoryWiseProducts/{subCat_id}/{subCat_name}', [HomeController::class, 'subCategoryWiseProducts'])->name('subCategoryWiseProducts');
Route::get('/sub-subCategoryWiseProducts/{sub_subCat_id}/{sub_subCat_name}', [HomeController::class, 'sub_subCategoryWiseProducts'])->name('sub_subCategoryWiseProducts');
Route::post('/fetchProductData', [AjaxController::class, 'fetchProductData'])->name('fetchProductData');
Route::post('/search/products', [HomeController::class, 'searchProduct'])->name('search.product');

// Cart, Coupon, Checkout Route
Route::post('/cart/addToCart/{product_id}', [CartController::class, 'addToCart'])->name('cart.addToCart');
Route::get('/cart/getFromCart', [CartController::class, 'getFromCart'])->name('cart.getFromCart');
Route::post('/cart/removeFromCart/{rowId}', [CartController::class, 'removeFromCart'])->name('cart.removeFromCart');
Route::post('/cart/cartIncrement/{rowId}', [CartController::class, 'cartIncrement'])->name('cart.cartIncrement');
Route::post('/cart/cartDecrement/{rowId}', [CartController::class, 'cartDecrement'])->name('cart.cartDecrement');
Route::get('/cart/myCart', [CartController::class, 'index'])->name('cart.index');
Route::post('/coupon/applyCoupon', [CouponController::class, 'applyCoupon'])->name('coupon.applyCoupon')->middleware('auth');
Route::get('/coupon/calculate', [CouponController::class, 'couponCalculate'])->name('coupon.calculate')->middleware('auth');
Route::post('/coupon/remove', [CouponController::class, 'couponRemove'])->name('coupon.remove')->middleware('auth');
Route::get('/cart/checkout', [CheckoutController::class, 'checkoutPage'])->name('checkoutPage')->middleware('auth');
Route::post('/checkout/store', [CheckoutController::class, 'store'])->name('checkout.store')->middleware('auth');
Route::post('/checkout/stripe/order', [CheckoutController::class, 'stripeOrder'])->name('checkout.stripeOrder')->middleware('auth');
Route::post('/checkout/cod/order', [CheckoutController::class, 'codOrder'])->name('checkout.codOrder')->middleware('auth');

// User Orders & Review
Route::get('/user/orders', [UserController::class, 'userOrders'])->name('user.orders')->middleware('auth');
Route::get('/user/orders/{order_id}', [UserController::class, 'userOrderDetails'])->name('user.orderDetails')->middleware('auth');
Route::get('/user/invoice/download/{order_id}', [UserController::class, 'invoiceDownload'])->name('user.invoiceDownload')->middleware('auth');
Route::post('/user/product/review', [ReviewController::class, 'store'])->name('review.store')->middleware('auth');

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

    Route::get('/admin/list', [AdminController::class, 'list'])->name('admin.list');
    Route::get('/admin/create', [AdminController::class, 'create'])->name('admin.create');
    Route::post('/admin/create', [AdminController::class, 'create'])->name('admin.create');
    Route::get('/admin/update/{id}', [AdminController::class, 'update'])->name('admin.update');
    Route::put('/admin/update/{id}', [AdminController::class, 'update'])->name('admin.update');
    Route::delete('/admin/destroy/{id}', [AdminController::class, 'destroy'])->name('admin.destroy');
    
    Route::get('/admin/customer/list', [AdminController::class, 'customerList'])->name('customer.list');
    Route::get('/admin/customer/create', [AdminController::class, 'createCustomer'])->name('customer.create');
    Route::post('/admin/customer/create', [AdminController::class, 'createCustomer'])->name('customer.create');
    Route::get('/admin/customer/update/{id}', [AdminController::class, 'updateCustomer'])->name('customer.update');
    Route::put('/admin/customer/update/{id}', [AdminController::class, 'updateCustomer'])->name('customer.update');
    Route::delete('/admin/customer/destroy/{id}', [AdminController::class, 'destroyCustomer'])->name('customer.destroy');

    Route::post('/admin/logout', [AdminController::class, 'logout'])->name('admin.logout');
    Route::delete('/product-images/{id}/destoryAll', [ProductImageController::class, 'destoryAll'])->name('product-images.destroyAll');
    Route::resource('/admin/category', CategoryController::class);
    Route::resource('/admin/subcategory', SubcategoryController::class);
    Route::resource('/admin/subSubcategory', Sub_SubcategoryController::class);
    Route::resource('/admin/brand', BrandController::class);
    Route::resource('/admin/product', ProductController::class);
    Route::resource('/admin/product-images', ProductImageController::class);
    Route::resource('/admin/coupon', CouponController::class);
    Route::resource('/admin/slider', SliderController::class);
    Route::get('/admin/order/{order_id}/show', [OrderController::class, 'show'])->name('admin.orderShow');

    Route::get('/admin/order/pending', [OrderController::class, 'pending'])->name('order.pending');
    Route::get('/admin/order/processing', [OrderController::class, 'processing'])->name('order.processing');
    Route::get('/admin/order/halt', [OrderController::class, 'halt'])->name('order.halt');
    Route::get('/admin/order/shipping', [OrderController::class, 'shipping'])->name('order.shipping');
    Route::get('/admin/order/delivered', [OrderController::class, 'delivered'])->name('order.delivered');
    Route::get('/admin/order/completed', [OrderController::class, 'completed'])->name('order.completed');
    Route::get('/admin/order/cancelled', [OrderController::class, 'cancelled'])->name('order.cancelled');

    Route::get('/admin/order/index', [OrderController::class, 'index'])->name('admin.orderIndex');
    Route::get('/admin/order/{order_id}/edit', [OrderController::class, 'edit'])->name('admin.orderEdit');
    Route::put('/admin/order/{order_id}/update', [OrderController::class, 'update'])->name('admin.orderUpdate');

    Route::get('/admin/review/index', [ReviewController::class, 'index'])->name('review.index');
    Route::get('/admin/review/edit/{id}', [ReviewController::class, 'update'])->name('review.edit');
    Route::put('/admin/review/update/{id}', [ReviewController::class, 'update'])->name('review.update');
    Route::delete('/admin/review/destroy/{id}', [ReviewController::class, 'destroy'])->name('review.destroy');

    // Ajax Controller Route
    Route::post('/adminUpdateStatus', [AjaxController::class, 'adminUpdateStatus'])->name('admin.updateStatus');
    Route::post('/customerUpdateStatus', [AjaxController::class, 'customerUpdateStatus'])->name('customer.updateStatus');
    Route::post('/categoryUpdateStatus', [AjaxController::class, 'categoryUpdateStatus'])->name('category.updateStatus');
    Route::post('/subcategoryUpdateStatus', [AjaxController::class, 'subcategoryUpdateStatus'])->name('subcategory.updateStatus');
    Route::post('/subSubcategoryUpdateStatus', [AjaxController::class, 'subSubcategoryUpdateStatus'])->name('subSubcategory.updateStatus');
    Route::post('/brandUpdateStatus', [AjaxController::class, 'brandUpdateStatus'])->name('brand.updateStatus');
    Route::post('/productUpdateStatus', [AjaxController::class, 'productUpdateStatus'])->name('product.updateStatus');
    Route::post('/couponUpdateStatus', [AjaxController::class, 'couponUpdateStatus'])->name('coupon.updateStatus');
    Route::post('/productImageUpdateStatus', [AjaxController::class, 'productImageUpdateStatus'])->name('productImage.updateStatus');
    Route::post('/sliderUpdateStatus', [AjaxController::class, 'sliderUpdateStatus'])->name('slider.updateStatus');
    Route::post('/reviewUpdateStatus', [AjaxController::class, 'reviewUpdateStatus'])->name('review.updateStatus');
    Route::post('/loadSubcategory', [AjaxController::class, 'loadSubcategory'])->name('product.loadSubcategory');
    Route::post('/loadSubSubcategory', [AjaxController::class, 'loadSubSubcategory'])->name('product.loadSubSubcategory');
    Route::post('/loadSeletedSubcategory', [AjaxController::class, 'loadSeletedSubcategory'])->name('product.loadSeletedSubcategory');
    Route::post('/loadSeletedSubSubcategory', [AjaxController::class, 'loadSeletedSubSubcategory'])->name('product.loadSeletedSubSubcategory');

});
