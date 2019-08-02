<?php

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

/**
 * User
 */
Route::resource('users', 'User\UserController');

/**
 * Customer
 */
Route::resource('customers', 'Customer\CustomerController');

/**
 * UserCustomer
 */
Route::resource('users.customers', 'User\UserCustomerController', [
    'only' => ['create', 'store']
]);

/**
 * Shipping
 */
Route::resource('shippings', 'Shipping\ShippingController');

/**
 * UserShipping
 */
Route::patch('users/{user}/shippings/{shipping?}', 'User\UserShippingController@update')
->name('users.shippings.update');
Route::get('users/{user}/select-delivery-address',  'User\UserShippingController@index')
    ->name('users.select.delivery');

Route::resource('users.shippings', 'User\UserShippingController', [
    'only' => ['index', 'create', 'store']
]);


/**
 * UserCheckout
 */
Route::get('user-checkout/{user?}', 'Checkout\CheckoutController@index')
    ->name('users.checkouts.index');
Route::post('user-checkout/{user?}', 'Checkout\CheckoutController@store')
    ->name('users.checkouts.store');
Route::get('user-checkout/{user}/select-delivery-address/{shipping?}', 'Checkout\CheckoutAddressController@show')
    ->name('checkouts.addresses.show');

/**
 * CheckoutAddress
 */
Route::post('checkouts/addresses', 'Checkout\CheckoutAddressController@store')
    ->name('checkouts.addresses.store');

/**
 * CheckoutSuccess
 */
Route::get('/checkout/success', 'Checkout\CheckoutSuccessController')
    ->name('checkouts.success');

/**
 * CheckoutError
 */
Route::get('/checkout/error', 'Checkout\CheckoutErrorController')
    ->name('checkouts.error');

/**
 * Product
 */
Route::resource('products', 'Product\ProductController');


/**
 * Test
 */
Route::post('/test', 'TestController@store')->name('tests.store');

