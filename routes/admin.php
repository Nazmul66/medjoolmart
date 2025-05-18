<?php


/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
*/

use App\Http\Controllers\Admin\PosController;
use App\Http\Controllers\Admin\QRCodeController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\Backend\PermissionController;
use App\Http\Controllers\Backend\RoleController;
use App\Http\Controllers\Backend\AttributeNameController;
use App\Http\Controllers\Backend\SettingController;
use App\Http\Controllers\Backend\AttributeValueController;
use App\Http\Controllers\Backend\AdminRoleController;
use App\Http\Controllers\Backend\ShippingRuleController;
use App\Http\Controllers\Backend\AdminController;
use App\Http\Controllers\Backend\BrandsController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\SubcategoryController;
use App\Http\Controllers\Backend\ChildCategoryController;
use App\Http\Controllers\Backend\FaqController;
use App\Http\Controllers\Backend\FlashSaleController;
use App\Http\Controllers\Backend\CouponController;
use App\Http\Controllers\Backend\CustomPageController;
use App\Http\Controllers\Backend\OrderController;
use App\Http\Controllers\Backend\MarqueeController;
use App\Http\Controllers\Backend\ReviewController;
use App\Http\Controllers\Backend\ContactController;
use App\Http\Controllers\Backend\SliderController;
use App\Http\Controllers\Backend\ProductCollectionController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\TransactionController;
use App\Http\Controllers\Backend\CustomerController;
use App\Http\Controllers\Backend\SubscriptionController;
use App\Http\Controllers\Backend\HomeSettingController;
use App\Http\Controllers\Backend\EssentialSettingController;
use App\Http\Controllers\Backend\Hrms\ExpenseController;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;


// set multi-language
Route::post('/set-language', function (Request $request) {
    Session::put('langName', $request->language); 
    App::setLocale($request->language); 

    return redirect()->back(); 
});


Route::middleware('setLanguage')->group(function(){

    Route::get('/cc', [AdminController::class, "cacheClear"])->name('cacheClear');
    Route::get('/admin/logout', [AdminController::class, "logout"]);
    Route::match(["get", "post"], '/admin/login', [AdminController::class, "login"]); // login page


    Route::group(["as" => 'admin.',"prefix" => '/admin', 'middleware' => ['auth:admin', 'role:SuperAdmin|Admin']], function () {

        Route::get('/dashboards', [AdminController::class, "dashboards"])->name('dashboards');
        Route::get('/profiles', [AdminController::class, "profiles"])->name('profiles');
        Route::get('/profile-update', [AdminController::class, "profileUpdate"])->name('profile-update');
        Route::put('/profile-update', [AdminController::class, "changeProfile"])->name('change-profile');
        Route::put('/change-password', [AdminController::class, "changePassword"])->name('change-password');
        Route::post('/current-password', [AdminController::class, "checkCurrentPassword"])->name('current-password');

        //______ Customers _____//
        Route::resource('/customer', CustomerController::class)->names('customer');
        Route::get('/customer-data', [CustomerController::class, 'getData'])->name('customer-data');
        Route::get('/customer/view/{id}', [CustomerController::class, 'customerView'])->name('customer.view');


        //______ Contacts _____//
        Route::resource('/contact', ContactController::class)->names('contact');
        Route::get('/contact-data', [ContactController::class, 'getData'])->name('contact-data');
        Route::get('/contact/view/{id}', [ContactController::class, 'contactView'])->name('contact.view');


        //______ Subscription _____//
        Route::resource('/subscription', SubscriptionController::class)->names('subscription');
        Route::get('/subscription-data', [SubscriptionController::class, 'getData'])->name('subscription-data');
        Route::get('/subscription-view', [SubscriptionController::class, 'subscriptionView'])->name('subscription-view');


        //______ FAQ _____//
        Route::resource('/faq', FaqController::class)->names('faq');
        Route::get('/faq-data', [FaqController::class, 'getData'])->name('faq-data');
        Route::post('/faq/status', [FaqController::class, 'changeFaqStatus'])->name('faq.status');
        Route::get('/faq/view/{id}', [FaqController::class, 'faqView'])->name('faq.view');


        //______ Slider _____//
        Route::resource('/slider', SliderController::class)->names('slider');
        Route::get('/slider-data', [SliderController::class, 'getData'])->name('slider-data');
        Route::post('/slider/status', [SliderController::class, 'changeSliderStatus'])->name('slider.status');
        Route::get('/slider/view/{id}', [SliderController::class, 'sliderView'])->name('slider.view');


        //______ Category _____//
        Route::resource('/categories', CategoryController::class)->names('category');
        Route::get('/category-data', [CategoryController::class, 'getData'])->name('category-data');
        Route::post('/categories/status', [CategoryController::class, 'changeCategoryStatus'])->name('category.status');
        Route::get('/categories/view/{id}', [CategoryController::class, 'CategoryView'])->name('category.view');


        //______ Subcategory _____//
        Route::resource('/subcategories', SubcategoryController::class)->names('subcategory');
        Route::get('/subcategory-data', [SubcategoryController::class, 'getData'])->name('subcategory-data');
        Route::post('/subcategory/status', [SubcategoryController::class, 'changeSubCategoryStatus'])->name('subcategory.status');
        Route::get('/subcategories/view/{id}', [SubcategoryController::class, 'subCategoryView'])->name('subcategory.view');


        //______ ChildCategory _____//
        Route::resource('/childCategories', ChildCategoryController::class)->names('childCategory');
        Route::get('/childCategory-data', [ChildCategoryController::class, 'getData'])->name('childCategory-data');
        Route::post('/childCategory/status', [ChildCategoryController::class, 'changeChildCategoryStatus'])->name('childCategory.status');
        Route::get('/childCategories/view/{id}', [ChildCategoryController::class, 'childSubCategoryView'])->name('childCategory.view');
        Route::post('/get/subCategory-data', [ChildCategoryController::class, 'get_subCategory_data'])->name('childCategory.subCategory.data');


        //______ Brand _____//
        Route::resource('/brands', BrandsController::class)->names('brand');
        Route::get('/brand-data', [BrandsController::class, 'getData'])->name('brand-data');
        Route::post('/change-brand-status', [BrandsController::class, 'changeBrandStatus'])->name('brand.status');
        Route::get('/brands/view/{id}', [BrandsController::class, 'brandView'])->name('brand.view');


        //______ Attribute Name _____//
        // Route::resource('/attribute-name', AttributeNameController::class)->names('attribute.name')->except(['show']);
        // Route::get('/attribute-name/data', [AttributeNameController::class, 'getData'])->name('attribute-name.data');
        // Route::post('/attribute-name-status', [AttributeNameController::class, 'changeStatus'])->name('attribute-name.status');


        //______ Attribute Values _____//
        Route::resource('/attribute-value', AttributeValueController::class)->names('attribute.value')->except(['show']);
        Route::get('/attribute-value/data', [AttributeValueController::class, 'getData'])->name('attribute-value.data');
        Route::post('/attribute-value-status', [AttributeValueController::class, 'changeStatus'])->name('attribute-value.status');
        Route::get('/attribute-value/view/{id}', [AttributeValueController::class, 'attributeView'])->name('attribute-value.view');
        

        //______ Product _____//
        Route::resource('/product', ProductController::class)->names('product');
        Route::get('/product-data', [ProductController::class, 'getData'])->name('product-data');
        // Route::get('/creates', [ProductController::class, 'creates']);
        Route::post('/change-product-status', [ProductController::class, 'changeProductStatus'])->name('product.status');

        Route::post('/get/product/subCategory-data', [ProductController::class, 'get_product_subCategory_data'])->name('get.product.subCategory.data');
        Route::post('/get/product/childCategory-data', [ProductController::class, 'get_product_childCategory_data'])->name('get.product.childCategory.data');

        Route::get('/product/variant/{id}', [ProductController::class, 'product_variant'])->name('product-variant');
        Route::put('/product/variant/{id}', [ProductController::class, 'update_product_variant'])->name('product-variant.update'); 


        Route::put('/product-images-store/{id}', [ProductController::class, 'product_images_store'])->name('product.images.store'); 
        Route::post('/product-images-sortable', [ProductController::class, 'product_images_sortable'])->name('product.images.sortable'); 
        Route::delete('/multiple-image/delete/{id}', [ProductController::class, 'delete_multiple_image'])->name('multiple-image.delete'); 


        Route::delete('/size-variants/delete/{id}', [ProductController::class, 'delete_size_variants'])->name('size.variants.delete'); 
        Route::delete('/color-variants/delete/{id}', [ProductController::class, 'delete_color_variants'])->name('color.variants.delete'); 


        //______ Home Settings _____//
        Route::controller(HomeSettingController::class)->group(function () {
            Route::get('/home-page-setting', 'index')->name('home.page.setting');
            Route::put('/popular-category-section', 'updatePopularCategorySection')->name('popular.category.section');
            Route::put('/product-slider-section-one', 'updateProductSliderSectionOne')->name('product.slider.section.one');
            Route::put('/product-slider-section-two', 'updateProductSliderSectionTwo')->name('product.slider.section.two');
            Route::put('/product-slider-section-three', 'updateProductSliderSectionThree')->name('product.slider.section.three');

            // ajax call 
            Route::get('/get-subCategory-data', 'get_subCategory_data')->name('get.subCategory.data');
            Route::get('/get-childCategory-data', 'get_childCategory_data')->name('get.childCategory.data');
        });

        //______ Product Collection _____//
        Route::resource('/product-collection', ProductCollectionController::class)->names('product.collection');
        Route::get('/product-collection-data', [ProductCollectionController::class, 'getData'])->name('product-collection.data');
        Route::post('/product-collection-change-status', [ProductCollectionController::class, 'changeCollectionStatus'])->name('product.collection.status');
        Route::delete('/product-collection/delete/{product_id}', [ProductCollectionController::class, 'productCollectionDelete'])->name('product.collection.delete');


        //______ Orders _____//
        // Route::resource('/order', OrderController::class)->names('order');
        Route::get('/order/{status}', [OrderController::class, 'index'])->name('order.index');
        Route::get('/order-data', [OrderController::class, 'getData'])->name('order-data');
        Route::get('/order/show/{id}', [OrderController::class, 'orderShow'])->name('order.show');
        Route::get('/order/destroy/{id}', [OrderController::class, 'orderDestroy'])->name('order.destroy');
        Route::post('/order/payment-status', [OrderController::class, 'changePaymentStatus'])->name('change.payment.status');
        Route::post('/order/order-status', [OrderController::class, 'changeOrderStatus'])->name('change.order.status');
        Route::get('/order/invoice-pdf/{id}', [OrderController::class, 'order_invoice_pdf'])->name('order.order_invoice_pdf');


        //______ Transactions _____//
        Route::resource('/transaction', TransactionController::class)->names('transaction');
        Route::get('/transaction-data', [TransactionController::class, 'getData'])->name('transaction-data');
        Route::get('/transaction/view/{id}', [TransactionController::class, 'transactionView'])->name('transaction.view');
        

        //______ Flash Sale _____//
        Route::put('/flash-sale', [FlashSaleController::class, 'flashSale_index'])->name('flashSale.index');
        Route::resource('/flash-sale-item', FlashSaleController::class)->names('flashSale.item')->except(['show']);
        Route::get('/flash-sale-item-data', [FlashSaleController::class, 'getData'])->name('flashSale.item-data');
        Route::post('/flash-sale-item/status', [FlashSaleController::class, 'changeFlashSaleItemStatus'])->name('flashSale.item.status');
        Route::post('/flash-sale-item/show-home', [FlashSaleController::class, 'showFlashSaleItem'])->name('flashSale.item.show');
        

        //______ Coupon _____//
        Route::resource('/coupons', CouponController::class)->names('coupons');
        Route::get('/coupon-data', [CouponController::class, 'getData'])->name('coupon-data');
        Route::post('/change-coupon-status', [CouponController::class, 'changeCouponStatus'])->name('coupon.status');
        Route::get('/coupons/view/{id}', [CouponController::class, 'couponView'])->name('coupon.view');


        //______ Shipping-Rule _____//
        Route::resource('/shipping-rule', ShippingRuleController::class)->names('shipping-rule');
        Route::get('/shipping-rule-data', [ShippingRuleController::class, 'getData'])->name('shipping-rule-data');
        Route::post('/change-shipping-rule-status', [ShippingRuleController::class, 'changeShippingRuleStatus'])->name('shipping-rule.status');
        Route::get('/shipping-rule/view/{id}', [ShippingRuleController::class, 'shippingRuleView'])->name('shipping-rule.view');


        //______ Review _____//
        Route::resource('/reviews', ReviewController::class)->names('reviews');
        Route::get('/review-data', [ReviewController::class, 'getData'])->name('review-data');
        Route::post('/change-review-status', [ReviewController::class, 'changeReviewStatus'])->name('review.status');


        //______ Custom Page _____//
        Route::resource('/customPage', CustomPageController::class)->names('customPage');
        Route::get('/customPage-data', [CustomPageController::class, 'getData'])->name('customPage-data');
        Route::post('/change-customPage-status', [CustomPageController::class, 'changeCustomPageStatus'])->name('customPage.status');


        //______ Role & Permission _____//
        Route::resource('/permission', PermissionController::class)->names('permission');
        Route::get('/permission-data', [PermissionController::class, 'getData'])->name('permission-data');
        
        Route::resource('/role', RoleController::class)->names('role');
        Route::resource('/admin-role', AdminRoleController::class)->names('admin-role');


        //______ Settings _____//
        Route::resource('/settings', SettingController::class)->names('settings');
        Route::get('/email-setup', [SettingController::class, 'emailSetupIndex'])->name('email.setup');
        Route::put('/email-setting-update', [SettingController::class, 'emailConfigSettingUpdate'])->name('email.setting.update');

        //______ Marquee _____//
        Route::resource('/marquee', MarqueeController::class)->names('marquee');
        Route::get('/marquee-data', [MarqueeController::class, 'getData'])->name('marquee-data');
        Route::post('/marquee/status', [MarqueeController::class, 'changeMarqueeStatus'])->name('marquee.status');
        Route::get('/marquee/view/{id}', [MarqueeController::class, 'marqueeView'])->name('marquee.view');

        //______ Essential Setting _____//
        Route::controller(EssentialSettingController::class)->group(function () {
            Route::get('/essential-setting', 'index')->name('essential.setting');
            Route::put('/time-schedule', 'timeScheduleSection')->name('time.schedule');
            Route::put('/website-rules', 'websiteRules')->name('website-rules');
        });  

        //______ POS _____//
        Route::resource('/pos', PosController::class)->names('pos');

        //______ QRCode _____//
        Route::resource('/qrcode', QRCodeController::class)->names('qrcode');
        Route::get('/qrcode-data', [QRCodeController::class, 'getData'])->name('qrcode-data');
        Route::post('/qrcode/status', [QRCodeController::class, 'changeQrcodeStatus'])->name('qrcode.status');
        Route::get('/qrcode/view/{id}', [QRCodeController::class, 'qrcodeView'])->name('qrcode.view');


            
        /****************************
        *      All HRMS Modules
        ******************************/
        Route::group(["as" => 'hrms.',"prefix" => '/hrms'], function () {

            //______ Expense _____//
            Route::resource('/expense', ExpenseController::class)->names('expense');
            Route::get('/expense-data', [ExpenseController::class, 'getData'])->name('expense-data');
            Route::post('/expense/status', [ExpenseController::class, 'changeExpenseStatus'])->name('expense.status');
            Route::get('/expense/view/{id}', [ExpenseController::class, 'expenseView'])->name('expense.view');


            //______ Payroll _____//


            Route::get('/multi', function (){
                return view('backend.pages.hrms.multi.index');
            })->name('multi');

            Route::get('/elementor', function (){
                return view('backend.pages.elementor.index');
            })->name('elementor');
        });

    });

});

