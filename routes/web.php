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
 * CartItem
 */
Route::get('carts', 'Cart\CartItemController@index')->name('carts.index');
Route::delete('carts', 'Cart\CartItemController@empty')->name('carts.empty');
Route::post('carts/{product}', 'Cart\CartItemController@store')->name('carts.store');
Route::patch('carts/{product}', 'Cart\CartItemController@update')->name('carts.update');
Route::delete('carts/{product}', 'Cart\CartItemController@destroy')->name('carts.destroy');

/**
 * UserCheckout
 */
// Route::post('checkout/registered-user/{user}/{shipping?}', 'Checkout\CheckoutRegisteredUserController@store')
//     ->name('checkout.registered.users.store');
// Route::post('checkout/guest', 'Checkout\CheckoutController@store')
//     ->name('checkout.guests.store');
Route::get('user-checkout/{user}/select-delivery-address/{shipping?}', 'Checkout\CheckoutAddressController@show')
    ->name('checkouts.addresses.show');

// Route::post('user-checkout', 'Checkout\CheckoutController@store')
//     ->name('users.checkouts.store');
// Route::post('user-checkout/{user}/select-delivery-address/{shipping?}', 'Checkout\CheckoutController@store')
//     ->name('auth.users.checkouts.store');
// Route::get('user-checkout/{user?}', 'Checkout\CheckoutController@index')
//     ->name('users.checkouts.index');

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


/**
 * Checkout
 */
Route::get('checkout/registered-user/{user}/{shipping?}', 'Checkout\CheckoutRegisteredUserController@index')
    ->name('checkout.registered.users.index');

Route::get('checkout/guest', 'Checkout\CheckoutGuestController@index')
    ->name('checkout.guests.index');

Route::post('checkout/registered-user/{user}/{shipping?}', 'Checkout\CheckoutRegisteredUserController@store')
    ->name('checkout.registered.users.store');

Route::post('checkout/guest', 'Checkout\CheckoutGuestController@store')
    ->name('checkout.guests.store');
