<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\AdminController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\SslCommerzPaymentController;
use App\Http\Controllers\Frontend\BkashController;
use App\Http\Controllers\Frontend\CODController;
use App\Http\Controllers\Frontend\ProductController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\CouponController;
use App\Http\Controllers\Frontend\FlashSaleController;
use App\Http\Controllers\Frontend\CheckoutController;
use App\Http\Controllers\Frontend\ShippingRuleController;
use App\Http\Controllers\Frontend\AjaxCallController;
use App\Http\Controllers\Frontend\NewsletterController;
use App\Http\Controllers\Frontend\AccountController;
use App\Http\Controllers\Frontend\ProductReviewController;
use App\Http\Controllers\Frontend\WishlistController;

/*
|--------------------------------------------------------------------------
| Frontend Routes
|--------------------------------------------------------------------------
|
*/
Route::middleware('landingPageSession')->group(function(){

    Route::controller(HomeController::class)->group(function () {
        Route::get('/', "home")->name('home');
        Route::get('/about-us', "about_us")->name('about.us');
        Route::get('/contact-us', "contact_us")->name('contact.us');
        Route::post('/contact-us', "handleContactForm")->name('handle.contact.form');
        Route::get('/faq', "faq_page")->name('faq');
        Route::get('/team', "team_page")->name('team');
        Route::get('/privacy-policy', "privacy_policy")->name('privacy.policy');
        Route::get('/terms-condition', "terms_condition")->name('terms.condition');
        Route::get('/return-refund', "return_refund")->name('return.refund');
        Route::get('/shipping', "shipping")->name('shipping');
        Route::get('/customer-feedback', "customer_feedback")->name('customer.feedback');
        Route::get('/blogs', "blogs")->name('blogs');
        Route::get('/blogs-details', "blogs_details")->name('blogs.details');
        Route::get('/product-collection/{slug}', "product_collection")->name('product.collection');
        // Route::get('/compare', "compare_view")->name('compare');
        Route::get('/tracking-order', "track_order")->name('track.order');
        Route::get('/register-login', "register_login")->name('register.login');
    });


    Route::controller(AjaxCallController::class)->group(function () {
        Route::get('/cart-quick-view', "cartQuickView")->name('cart.quick.view');
    });

    //__ Flash Sales __//
    Route::controller(FlashSaleController::class)->group(function () {
        Route::get('/flash-sale', "index")->name('flash.sale');
    });

    //__ Products __//
    Route::controller(ProductController::class)->group(function () {
        Route::get('/products', "product_page")->name('product.page');
        Route::get('/product-details/{slug}', "show_product_details")->name('product.details');
        Route::post('/get-color-size-price', 'getColorSizePrice')->name('get.color.size.price');
        Route::post('/product/add-to-cart', 'productAddToCart')->name('addToCart');
        Route::get('/remove-cart/{id}/{color_id?}/{size_id?}', 'removeCart')->name('remove.cart');
        Route::get('/get-cart-data', 'getCart')->name('get.cart.data');
        Route::post('/get_filter_product_ajax', 'get_filter_product_ajax');
        Route::get('/pagination/paginate-data', 'pagination');
    });


    //__ Products Review __//
    Route::controller(ProductReviewController::class)->group(function () {
        Route::post('/review', 'review_store')->name('review.store');
    });


    //__ Wishlist __//
    Route::controller(WishlistController::class)->group(function () {
        Route::get('/wishlist', "index")->name('wishlist.index');
        Route::get('/wishlist/add-product', "addToWishlist")->name('wishlist.store');
        Route::get('/wishlist/count', "wishlist_count")->name('wishlist.count');
    });
    
    
    //__ Carts __//
    Route::controller(CartController::class)->group(function () {
        Route::get('/cart', 'cart_view')->name('show-cart');
        Route::post('/add-cart', "addCart")->name('add.cart');
        Route::post('/cart/update-quantity', "updateProductQuantity")->name('cart.update.quantity');
        Route::get('/cart/remove-product/{rowId}', "cart_remove_product")->name('cart.remove.product');
        Route::get('/get-sidebar-cart', "get_sidebar_cart")->name('get.sidebar.cart');
        Route::get('/cart-count', "cart_count")->name('cart.count');
        Route::get('/cart-sidebar-product-total', "getTotalCart")->name('cart.sidebar-product-total');
        Route::get('/clear-cart', "clear_cart")->name('clear.cart');
    });

    // Route::post('/update-cart-quantity', [CartController::class, 'update_cart_quantity'])->name('update.cart.quantity');
    // Route::post('/cart/delete-item', [CartController::class, 'deleteCartItem'])->name('delete.cart.item');
    // Route::post('/clear-cart', [CartController::class, 'clearCart'])->name('clear.cart');
    // Route::get('/get-sidebar-cart', [CartController::class, 'get_sidebar_cart'])->name('get.sidebar.cart');
    // Route::get('/get-main-cart', [CartController::class, 'get_main_cart'])->name('get.main.cart');


    //__ Coupon __//
    Route::controller(CouponController::class)->group(function () {
        Route::post('/apply-coupon', 'apply_coupon')->name('apply.coupon');
        Route::get('/coupon-calculation', 'coupon_calculation')->name('coupon.calculation');
    });


    //__ Newsletter __//
    Route::controller(NewsletterController::class)->group(function () {
        Route::post('/newsletter-request', 'newsletter_request')->name('newsletter.request');
        Route::get('/newsletter-verify/{token}', 'newsletterEmailVerify')->name('newsletter.verify');
    });


    //__ Shipping Rules  __//
    Route::controller(ShippingRuleController::class)->group(function () {
        Route::post('/apply-shipping', 'apply_shipping')->name('apply.shipping');
        Route::get('/shipping-rules-calculation', 'shipping_rules_calculation')->name('shipping.rules.calculation');
    });


    //__ Checkout __//
    Route::middleware(['NoBack'])->controller(CheckoutController::class)->group(function () {
        Route::get('/checkout', 'checkout')->name('checkout');
    });

    //__ Cash On Delivery Payment Gateway __//
    Route::controller(CODController::class)->group(function () {
        Route::post('/cod', 'index')->name('payment.cod');
        Route::get('/success-payment/{order_id}', 'success_payment')->name('payment.success')->middleware('NoBack');
    });


    //__ SSL_Commerze Payment Gateway __//
    Route::controller(SslCommerzPaymentController::class)->group(function () {
        Route::post('/ssl_commercz-pay', 'index')->name('payment.ssl_commercz');
        Route::post('/success', 'success')->name('order-success');
        Route::post('/fail', 'fail');
        Route::post('/cancel', 'cancel');
    });


    // Route::get('/change-password', [HomeController::class, "changePassword"])->name('change.password');
    // Route::get('/forget-password', [HomeController::class, "forgetPassword"])->name('forget.password'); 
    
    
    
    Route::group(["as" => 'user.',"prefix" => '/user', 'middleware' => ['auth', 'userMiddleware']], function () {

        Route::controller(AccountController::class)->group(function () {
            Route::get('/dashboard', "dashboard")->name('dashboard');
            Route::get('/dashboard/profile', "dashboard_profile")->name('dashboard.profile');
            Route::get('/dashboard/review', "dashboard_review")->name('dashboard.review');
            Route::put('/dashboard/profile-update/{id}', "dashboard_profile_update")->name('dashboard.profile.update');
            Route::get('/dashboard/orders', "dashboard_orders")->name('dashboard.orders');
            Route::get('/dashboard/order-view/{id}', "dashboard_orders_views")->name('dashboard.order.view');
            Route::get('/dashboard/wishlist', "dashboard_wishlist")->name('dashboard.wishlist');
            Route::delete('/dashboard/wishlist-remove/{id}', "dashboard_wishlist_remove")->name('dashboard.wishlist.remove');

            Route::post('/dashboard/current-password', "checkCurrentPassword")->name('current-password');
            Route::put('/dashboard/change-password', "changePassword")->name('change-password');
        });
    });
    
});

/*
|--------------------------------------------------------------------------
| Breeze Package Routes
|--------------------------------------------------------------------------
|
*/


require __DIR__.'/auth.php';
require __DIR__.'/admin.php';
// require __DIR__.'/user.php';
