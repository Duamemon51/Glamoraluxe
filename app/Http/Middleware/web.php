<?php 

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\TagController; // upar import kar lena
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\StripeController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\HomeController;
use App\Models\Category;
use App\Http\Controllers\ContactController;
use Illuminate\Support\Facades\Storage;

use App\Http\Controllers\SearchController;

// ✅ KEEP THIS:
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/product/{id}', [ProductController::class, 'show'])->name('product.details');
Route::get('/About-us', function () {
    return view('about');
});

Route::get('/search', [SearchController::class, 'search'])->name('search');
Route::middleware(['auth', 'check.checkout'])->group(function () {
    Route::get('/checkout', [OrderController::class, 'showCheckoutForm'])->name('checkout.form');
    Route::post('/checkout', [OrderController::class, 'placeOrder'])->name('checkout.place');
});

Route::get('/new-arrivals', [HomeController::class, 'showNewArrivals'])->name('new.arrivals');

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');
Route::get('/contact', function () {
    return view('contact');
})->name('contact');

// Public auth routes - no prefix, guest only
Route::middleware('guest')->group(function () {
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);

    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

// Logout route for authenticated users
Route::middleware('auth')->post('/logout', [AuthController::class, 'logout'])->name('logout');

// Admin routes (only for authenticated admins)
Route::prefix('admin')->middleware(['auth', 'role:admin'])->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

    // Baaki admin routes yahan
});


Route::get('/categories', [AdminController::class, 'home'])->name('admin.categories.home');
Route::get('/admin/products/{category}', [\App\Http\Controllers\AdminController::class, 'showByCategory'])->name('admin.products.home');

Route::view('shoping', 'shoping')->name('shoping');









Route::middleware('auth')->group(function () {
   
Route::post('/rate-product', [ProductRatingController::class, 'rate'])->name('rate.product');
Route::post('/rate-product', [AdminController::class, 'rate'])->name('rate.product');

  // Change the POST route to use a different name
Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add'); // For adding items to the cart
// web.php
Route::post('/cart', [CartController::class, 'update'])->name('cart.update');


// In web.php
Route::get('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');
   
Route::get('/cart', [CartController::class, 'index'])->name('cart.index'); // For viewing the cart


Route::get('/cart', [CartController::class, 'showCart'])->name('cart.index');

Route::post('/apply-coupon', [CouponController::class, 'applyCoupon']);

Route::get('/checkout', [OrderController::class, 'showCheckoutForm'])->name('checkout.form');
Route::post('/checkout', [OrderController::class, 'placeOrder'])->name('checkout.place');
Route::get('/thank-you', [OrderController::class, 'thankYou'])->name('checkout.thankyou');
   Route::put('/profile/update', [HomeController::class, 'update'])->name('profile.update');
Route::delete('/user/delete', [HomeController::class, 'destroy'])->name('user.delete');
Route::get('/thankyou', function () {
    return view('thankyou');
})->name('thankyou');
});



















Route::get('/shoping', [AdminController::class, 'index'])->name('shoping');

Route::post('/rate-product', [ProductRatingController::class, 'rate'])->name('rate.product');
Route::post('/rate-product', [AdminController::class, 'rate'])->name('rate.product');


Route::get('/shop/{id}', [AdminController::class, 'show'])->name('shop-single');






Route::get('/stripe/checkout/{order_id}', [StripeController::class, 'checkout'])->name('stripe.checkout');
Route::get('/stripe/success/{order_id}', [StripeController::class, 'success'])->name('stripe.success');
Route::get('/stripe/cancel', [StripeController::class, 'cancel'])->name('stripe.cancel');

// Routes/web.php

Route::get('/category/{id}/products', [HomeController::class, 'showProducts'])->name('category.products');
Route::get('/products', [HomeController::class, 'indexx'])->name('products');

// User routes

// routes/web.php

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Route for admin dashboard (only accessible to users with the 'admin' role)
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard');  // Make sure admin.dashboard.blade.php exists in resources/views/admin
    })->name('admin.dashboard');
});

Route::prefix('admin')->middleware('auth', 'role:admin')->group(function() {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    
    Route::get('/categories', [AdminController::class, 'categories'])->name('admin.categories.list');
    Route::get('/categories/create', [AdminController::class, 'createCategory'])->name('admin.categories.create');
 

    Route::post('/categories/store', [AdminController::class, 'storeCategory'])->name('admin.categories.store');
    
    Route::get('/categories/{id}/edit', [AdminController::class, 'editCategory'])->name('admin.categories.edit');
    Route::put('/categories/{id}', [AdminController::class, 'updateCategory'])->name('admin.categories.update');
    Route::delete('/categories/{id}', [AdminController::class, 'destroyCategory'])->name('admin.categories.destroy');
    Route::get('/categories/create', [AdminController::class, 'createCategory'])->name('admin.categories.create');


    Route::get('/users', [AdminController::class, 'indexuser'])->name('admin.users.index');
    Route::get('/users/create', [AdminController::class, 'create'])->name('admin.users.create');
    Route::post('/users', [AdminController::class, 'store'])->name('admin.users.store');
    Route::get('/users/{user}/edit', [AdminController::class, 'edit'])->name('admin.users.edit');
    Route::put('/users/{user}', [AdminController::class, 'update'])->name('admin.users.update');
    Route::delete('/users/{user}', [AdminController::class, 'destroy'])->name('admin.users.destroy');

    Route::get('/tags', [AdminController::class, 'tags'])->name('admin.tags.index');
   
    
    // Create Tag
    Route::get('/tags/create', [AdminController::class, 'createTag'])->name('admin.tags.create');
    
    // Store Tag
    Route::post('/tags', [AdminController::class, 'storeTag'])->name('admin.tags.store');
    
    // Edit Tag
   // Edit a tag (GET request)
// Route for editing a tag
Route::get('admin/tags/edit/{id}', [AdminController::class, 'editTag'])->name('admin.tags.edit');

// Route for updating a tag
Route::put('admin/tags/{id}', [AdminController::class, 'updateTag'])->name('admin.tags.update');

    // Delete Tag
    Route::delete('/tags/delete/{id}', [AdminController::class, 'deleteTag'])->name('admin.tags.delete');
  
    Route::get('/products', [AdminController::class, 'products'])->name('admin.products.index');
 // Create Product
    Route::get('/admin/products/create', [AdminController::class, 'createProduct'])->name('admin.products.create');
    
    // Store Product
  // web.php
  Route::post('/products/store', [AdminController::class, 'storeProduct'])->name('admin.products.store');


Route::get('/admin/tags/suggestions', [TagController::class, 'suggest']);

    // Edit Product
    Route::get('/products/{product}/edit', [AdminController::class, 'editProduct'])->name('admin.products.edit');

    
    // Update Product
    Route::put('/products/{product}', [AdminController::class, 'updateProduct'])->name('admin.products.update');
    
    // Delete Product
    Route::delete('/products/{product}', [AdminController::class, 'destroyProduct'])->name('admin.products.destroy');
    Route::get('/customers', [AdminController::class, 'customers'])->name('admin.customers.list');
   
    Route::get('/settings', [AdminController::class, 'settings'])->name('admin.settings.general');
    Route::get('/settings/payment', [AdminController::class, 'paymentSettings'])->name('admin.settings.payment');


    Route::get('/admin/categories', [AdminController::class, 'categories'])->name('admin.categories.index');
    
    Route::get('/orders', [AdminController::class, 'orders'])->name('admin.orders.list');
    Route::get('/orders/{order}', [AdminController::class, 'showOrder'])->name('admin.orders.show');
    Route::get('/admin/orders/{order}/delete', [OrderController::class, 'deleteOrder'])->name('admin.orders.delete');
    Route::post('/admin/orders/{order}/update-status', [OrderController::class, 'updateStatus'])->name('admin.orders.update-status');
    Route::get('/admin/orders/{order}/change-status', [OrderController::class, 'showStatusChangeForm'])->name('admin.orders.change-status');
  
    Route::get('/coupon', [CouponController::class, 'index'])->name('admin.coupons.index');
    Route::get('/coupon/create', [CouponController::class, 'create'])->name('admin.coupons.create');
    Route::post('/coupon', [CouponController::class, 'store'])->name('admin.coupons.store');
    Route::get('/coupon/{coupon}/edit', [CouponController::class, 'edit'])->name('admin.coupons.edit');
   
    Route::delete('/coupon/{id}', [CouponController::class, 'destroy'])->name('admin.coupons.destroy');
    // Admin Route
Route::get('/admin/contacts', [ContactController::class, 'index'])->name('admin.contacts');
Route::get('/admin/contacts/{id}', [ContactController::class, 'show'])->name('admin.contacts.show');

Route::delete('/admin/contacts/{id}', [ContactController::class, 'destroy'])->name('admin.contacts.destroy');
Route::post('/admin/contacts/{id}/toggle-read', [ContactController::class, 'toggleRead'])->name('admin.contacts.toggleRead');

});
Route::prefix('admin')->name('admin.')->group(function () {
    Route::put('/coupon/{coupon}', [CouponController::class, 'update'])->name('coupons.update');
    
});
