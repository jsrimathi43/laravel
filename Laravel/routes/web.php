<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\BookingCalendarTaskController;
use App\Http\Controllers\DeliveryPartnerController;
use App\Http\Controllers\OrderAddressController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\DropdownController;
use App\Http\Controllers\Frontend\FrontendAuthController;
use App\Http\Controllers\FullCalenderController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrdersController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Site\CheckoutController;
use App\Http\Controllers\UsersController;
use App\Models\OrderAddress;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AdminDropdownController;

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

// Route::get('/admin', function () {
//     return view('admin/dashboard');
// });

Route::get('/', [FrontController::class, 'home'])->name('home');
// Route::get('/products', [FrontController::class, 'products'])->name('products.index');
Route::get('/about-us', [FrontController::class, 'aboutUs'])->name('aboutUs');
Route::get('/menu', [FrontController::class, 'menu'])->name('menu');
Route::get('/direction', [FrontController::class, 'direction'])->name('direction');
Route::post('/myaccount/direction', [FrontController::class, 'saveContactus'])->name('myaccount.directions');
Route::get('/contact-us', [ContactController::class, 'index']);
Route::post('/contact-us', [ContactController::class, 'store'])->name('contact.us.store');
Route::controller(FullCalenderController::class)->group(function(){
    Route::get('/fullcalender', 'index');
    Route::post('/fullcalenderAjax', 'fullcalendarajax');
});

Route::post('/home', [BookingCalendarTaskController::class, 'store'])->name('calendar.fullcalender.store');
Route::get('/calendar/{id}/edit', [BookingCalendarTaskController::class, 'edit'])->name('calendar.fullcalender.edit');
Route::post('/calendar/update', [BookingCalendarTaskController::class, 'update'])->name('calendar.fullcalender.update');

Route::get('/myaccount/login', [FrontendAuthController::class, 'loginGet'])->name('myaccount.login');
Route::post('/myaccount/login', [FrontendAuthController::class, 'loginPost']);
Route::get('/myaccount/logout', [FrontendAuthController::class, 'logout'])->name('myaccount.logout');
Route::get('/myaccount/register', [FrontendAuthController::class, 'registerGet'])->name('myaccount.register');
Route::post('/myaccount/register', [FrontendAuthController::class, 'registerPost']);

Route::get('/myaccount/forgot-password', [ForgotPasswordController::class, 'userIndex'])->name('user.password.request');
Route::post('/myaccount/forgot-password', [ForgotPasswordController::class, 'userForgotPassword'])->name('user.password.email');
Route::get('/myaccount/reset-password/{token}',[ForgotPasswordController::class, 'userResetPasswordIndex'])->name('user.password.reset');
Route::post('/myaccount/reset-password', [ForgotPasswordController::class, 'userResetPassword'])->name('user.password.update');

Route::resource('myaccount/dashboard', 'App\Http\Controllers\Frontend\FrontendAuthController');
Route::get('myaccount/ordersview', [OrdersController::class, 'ordersView'])->name('myaccount.ordersview');
Route::get('myaccount/accountdetailsview', [OrdersController::class, 'accountDetailsView'])->name('myaccount.accountdetailsview');
Route::post('myaccount/accountdetailsupdate/{user_id}', [OrdersController::class, 'accountDetailsUpdate'])->name('myaccount.accountdetailsupdate');
Route::get('myaccount/delivery_partner', [OrdersController::class, 'deliveryPartner'])->name('myaccount.deliverypartner');
Route::get('myaccount/deliveryLogin', [OrdersController::class, 'deliveryLogin'])->name('myaccount.deliveryLogin');
Route::post('myaccount/delivery_partner/accept_order', [OrdersController::class, 'acceptOrder'])->name('myaccount.deliverypartner.acceptorder');
Route::post('myaccount/delivery_partner/update_status', [OrdersController::class, 'updateStatus'])->name('myaccount.deliverypartner.updatestatus');
Route::get('myaccount/delivery_partner/{id}', [OrdersController::class, 'deliverypartnerEdit'])->name('myaccount.delivery_partner.edit');
Route::get('myaccount/ordersview/{id}', [OrdersController::class, 'ordersViewEdit'])->name('myaccount.ordersview.edit');
// Route::get('myaccount/ordersview/{id}', [OrdersController::class, 'reviewindex'])->name('myaccount.ordersview.edit');
Route::delete('myaccount/ordersview/{id}', [OrdersController::class, 'ordersViewDelete'])->name('myaccount.ordersview.delete');
Route::put('myaccount/ordersview/{id}', [OrdersController::class, 'ordersViewUpdate'])->name('myaccount.ordersview.update');

Route::post('/review-store', [OrdersController::class, 'reviewstore'])->name('review.store');
Route::get('/reorder/{order_id}', [OrdersController::class, 'reOrder'])->name('myaccount.reorder');

// Route::group(['middleware' => ['guest']], function () {
    Route::resource('myaccount/orderAddress', 'App\Http\Controllers\OrderAddressController', ['except' => ['show'] ] );
    Route::get('myaccount/orderShippingAddress/{id}', [OrderAddressController::class, 'orderShippingAddress'])->name('myaccount.orderShippingAddress.edit');    
    Route::get('myaccount/orderShippingAddupdate/{id}', [OrderAddressController::class, 'orderShippingAddressUpdate'])->name('myaccount.orderShippingAddupdate.update');    

// });
// Route::resource('calendar/fullcalender', 'BookingCalendarTaskController');

Route::get('/menu/cart', [ProductsController::class, 'cart'])->name('cart');
Route::get('/menu/add-to-cart/{id}', [ProductsController::class, 'addToCart'])->name('add.to.cart');
Route::patch('/menu/update-cart', [ProductsController::class, 'productUpdate'])->name('product.update.cart');
Route::delete('/menu/remove-from-cart', [ProductsController::class, 'productRemove'])->name('product.remove.from.cart');

// Route::group(['middleware' => ['auth:user']], function () {
    Route::get('/checkout',  [CheckoutController::class,'getCheckout'])->name('checkout.index');
    Route::post('/checkout/order',[CheckoutController::class,'placeOrder'])->name('checkout.place.order');
    Route::get('/checkout/order/{id}',[CheckoutController::class,'orderConfirmation'])->name('checkout.order.complete');
    Route::get('checkout/payment/complete',[CheckoutController::class,'complete'])->name('checkout.payment.complete');
    Route::get('/success/{id}',[CheckoutController::class,'orderSuccess'])->name('checkout.order.success');
// Route::get('myaccount/ordersview/{id}', [OrdersController::class, 'ordersViewEdit'])->name('myaccount.ordersview.edit');


    // Route::get('/checkout', 'Site\CheckoutController@getCheckout')->name('checkout.index');
    // Route::post('/checkout/order', 'Site\CheckoutController@placeOrder')->name('checkout.place.order');

    // Route::get('checkout/payment/complete', 'Site\CheckoutController@complete')->name('checkout.payment.complete');

// });

Route::get('/send', '\App\Http\Controllers\HomeController@send')->name('home.send');

// Route::get('/login', [LoginController::class,'login'])->name('frontend.auth.login');
// Route::post('/login', 'LoginController@authenticate')->name('frontend.auth.login.confirm');

// Auth::routes();

Route::group(['namespace' => 'App\Http\Controllers'], function()
    {   
        Route::get('/admin/login', 'Auth\LoginController@login')->name('login');
        Route::post('/admin/login', 'Auth\LoginController@authenticate')->name('login.confirm');

        Route::get('/admin/register', 'RegisterController@show')->name('register');
        Route::post('/admin/register', 'RegisterController@register')->name('register.confirm');

        Route::get('/forgot-password', [ForgotPasswordController::class, 'index'])->name('password.request');
        Route::post('/forgot-password', [ForgotPasswordController::class, 'forgotPassword'])->name('password.email');
        Route::get('/reset-password/{token}',[ForgotPasswordController::class, 'resetPasswordIndex'])->name('password.reset');
        Route::post('/reset-password', [ForgotPasswordController::class, 'resetPassword'])->name('password.update');
      
        Route::resource('/admin/users', 'UsersController', ['except' => ['show'] ]);
        Route::resource('/admin/profile', 'ProfileController');
        Route::post('admin/profile', 'ProfileController@updatepassword')->name('admin.profile.password');

        Route::get('dropdown', [DropdownController::class, 'index']);
        Route::post('api/fetch-states', [DropdownController::class, 'fetchState']);
        Route::post('api/fetch-cities', [DropdownController::class, 'fetchCity']);

        Route::get('admin/dropdown', [AdminDropdownController::class, 'index']);
        Route::post('admin/api/fetch-states', [AdminDropdownController::class, 'fetchState']);
        Route::post('admin/api/fetch-cities', [AdminDropdownController::class, 'fetchCity']);

        // Route::resource('/admin/deliveryPartners', 'DeliveryPartnerController', ['except' => ['show']]);

        // Route::get('/admin/deliveryPartners', 'DeliveryPartnerController@index')->name('admin.deliveryPartners.index');
        // // Route::get('/admin/deliveryPartners/{id}', 'DeliveryPartnerController@show')->name('admin.deliveryPartners.show');
        // Route::get('/admin/deliveryPartners/create', 'DeliveryPartnerController@create')->name('admin.deliveryPartners.create');
        // Route::post('/admin/deliveryPartners', 'DeliveryPartnerController@store')->name('admin.deliveryPartners.store');
        // Route::get('/admin/deliveryPartners/{id}/edit', 'DeliveryPartnerController@edit')->name('admin.deliveryPartners.edit');
        // Route::put('/admin/deliveryPartners/{id}', 'DeliveryPartnerController@update')->name('admin.deliveryPartners.update');
        // Route::delete('/admin/deliveryPartners/{id}', 'DeliveryPartnerController@destroy')->name('admin.deliveryPartners.destroy');


        // Route::resource('/admin/users', 'UsersController', ['only' => ['show', 'destroy'] ]);
        Route::get('/admin/users', 'UsersController@index')->name('admin.users.index');
        Route::get('/admin/users/{id}', 'UsersController@show')->name('admin.users.show');
        Route::get('/admin/users/create', 'UsersController@create')->name('admin.users.create');
        Route::post('/admin/users', 'UsersController@store')->name('admin.users.store');
        Route::get('/admin/users/{id}/edit', 'UsersController@edit')->name('admin.users.edit');
        Route::put('/admin/users/{id}', 'UsersController@update')->name('admin.users.update');
        Route::delete('/admin/users/{id}', 'UsersController@destroy')->name('admin.users.destroy');

        Route::get('admin/users/{id}/sales', 								'UserSalesController@index')->name('admin.user.sales');
        Route::post('admin/users/{id}/invoices', 							'UserSalesController@createInvoice')->name('admin.user.sales.store');
        Route::get('admin/users/{id}/invoices/{invoice_id}', 				'UserSalesController@invoice')->name('admin.user.sales.invoice_details');
        Route::delete('admin/users/{id}/invoices/{invoice_id}', 			'UserSalesController@destroy')->name('admin.user.sales.destroy');
        Route::post('admin/users/{id}/invoices/{invoice_id}', 			'UserSalesController@addItem')->name('admin.user.sales.invoices.add_item');
        Route::delete('admin/users/{id}/invoices/{invoice_id}/{item_id}', 'UserSalesController@destroyItem')->name('admin.user.sales.invoices.delete_item');

        // Routes for purchase
        Route::get('admin/users/{id}/purchases', 								'UserPurchasesController@index')->name('admin.user.purchases');
        Route::post('admin/users/{id}/purchases', 							'UserPurchasesController@createInvoice')->name('admin.user.purchases.store');
        Route::get('admin/users/{id}/purchases/{invoice_id}', 				'UserPurchasesController@invoice')->name('admin.user.purchases.invoice_details');
        Route::delete('admin/users/{id}/purchases/{invoice_id}', 				'UserPurchasesController@destroy')->name('admin.user.purchases.destroy');
        Route::post('admin/users/{id}/purchases/{invoice_id}', 				'UserPurchasesController@addItem')->name('admin.user.purchases.add_item');
        Route::delete('admin/users/{id}/purchases/{invoice_id}/{item_id}', 	'UserPurchasesController@destroyItem')->name('admin.user.purchases.delete_item');

        Route::post('admin/users/{id}/payments/{invoice_id?}', 	'UserPaymentsController@store')->name('admin.user.payments.store');
        Route::delete('admin/users/{id}/payments/{payment_id}', 	'UserPaymentsController@destroy')->name('admin.user.payments.destroy');
        Route::get('admin/users/{id}/payments', 					'UserPaymentsController@index')->name('admin.user.payments');

        Route::get('admin/users/{id}/receipts', 					'UserReceiptsController@index')->name('admin.user.receipts');
        Route::post('admin/users/{id}/receipts/{invoice_id?}', 	'UserReceiptsController@store')->name('admin.user.receipts.store');
        Route::delete('admin/users/{id}/receipts/{receipt_id}', 	'UserReceiptsController@destroy')->name('admin.user.receipts.destroy');

        Route::get('admin/product/stocks', 'ProductsStockController@index')->name('admin.products.stocks');

        Route::get('admin/reports/sales', 		'SaleReportController@index')->name('admin.reports.sales');
        Route::get('admin/reports/purchases', 	'PurchaseReportController@index')->name('admin.reports.purchases');

        Route::get('admin/reports/payments', 	'PaymentReportController@index')->name('admin.reports.payments');
        Route::get('admin/reports/receipts', 	'ReceiptReportController@index')->name('admin.reports.receipts');

        Route::get('admin/users/{id}/reports', 	'UserReportsController@reports')->name('admin.user.reports');
        /**
         * Home Routes
         */
        Route::get('/admin', [HomeController::class, 'admin'])->name('admin.index');
        Route::get('/admin/dashboard', 'DashboardController@index')->name('admin.dashboard');

        Route::group(['middleware' => ['guest']], function() {
            /**
             * Register Routes
             */
            Route::get('/register', 'RegisterController@show')->name('register.show');
            Route::post('/register', 'RegisterController@register')->name('register.perform');

            /**
             * Login Routes
             */
            // Route::get('/admin/login', 'LoginController@show')->name('login.show');
            // Route::post('/admin/login', 'LoginController@login')->name('login.perform');

        });

        Route::get('/admin/groups','UserGroupsController@index')->name('groups');
        Route::get('/admin/groups/create','UserGroupsController@create');
        Route::post('/admin/groups','UserGroupsController@store');
        Route::delete('/admin/groups/{id}','UserGroupsController@destroy');

        Route::resource('admin/categories', 'CategoriesController', ['except' => ['show'] ] );
        
        Route::resource('admin/orders', 'OrdersController');
        Route::get('/admin/orders/download_invoice/{id}','OrdersController@download_invoice')->name('admin.orders.download_invoice'); 
        Route::get('/admin/orders/view_invoice/{id}','OrdersController@view_invoice')->name('admin.orders.view_invoice'); 
        Route::delete('admin/orders/orderitem/{orderitemid}', 'OrdersController@destroyorderitem')->name('admin.orders.orderitem.destroy');
        Route::post('admin/orders/orderitem/create', 'OrdersController@createorderitem')->name('admin.orders.orderitem.create');
        Route::resource('admin/products', 'ProductsController' );

        Route::resource('admin/bookingcalendars', 'BookingCalendarAdminController');
        Route::resource('admin/orderstatus', 'OrderStatusController');
        
        Route::resource('admin/country', 'CountryController');
        Route::delete('admin/country/states/{stateid}', 'CountryController@destroystate')->name('admin.country.states.destroy');
        Route::post('admin/country/states/create', 'CountryController@createstate')->name('admin.country.states.create');
        Route::resource('admin/city', 'CityController');

        Route::resource('admin/reviews', 'ReviewController');
        Route::resource('admin/role', 'RoleController');
        Route::resource('admin/deliveryPartners', 'DeliveryPartnerController');
        Route::resource('admin/contactus', 'FrontController');

        // Route::get('admin/bookingcalendar', 'BookingCalendarTaskController@adminindex')->name('bookingcalendar');
        // Route::delete('admin/bookingcalendar/{bookingid}', 'BookingCalendarTaskController@destroybooking')->name('admin.bookingcalendar.destroy');
        // // Route::put('admin/bookingcalendar/{bookingid}', 'BookingCalendarTaskController@editbooking')->name('admin.bookingcalendar.store');
        // Route::get('admin/bookingcalendar/create', 'BookingCalendarTaskController@createbooking')->name('admin.bookingcalendar.create');
        // Route::post('admin/bookingcalendar', 'BookingCalendarTaskController@storeBooking');
        // Route::post('admin/bookingcalendar/{bookingid}', 'BookingCalendarTaskController@editbooking')->name('admin.bookingcalendar.edit');

        Route::get('admin/users/{id}/payments', 	'UserPaymentsController@index')->name('user.payments');
        Route::post('admin/users/{id}/payments', 	'UserPaymentsController@store')->name('user.payments.store');
        Route::delete('admin/users/{id}/payments/{payment_id}', 	'UserPaymentsController@destroy')->name('user.payments.destroy');
        Route::group(['middleware' => ['auth:admin']], function() {
        /**
         * Logout Routes
         */
        Route::get('/admin/logout', 'LogoutController@perform')->name('admin.logout.perform');
    });
});
