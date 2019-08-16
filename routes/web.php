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
Route::patch('users/shippings/{user}/{shipping?}', 'User\UserShippingController@update')
    ->name('users.shippings.update');
Route::get('users/{user}/select-delivery-address',  'User\UserShippingController@index')
    ->name('users.select.delivery');
Route::resource('users.shippings', 'User\UserShippingController', [
    'only' => ['index', 'create', 'store']
]);

/**
 * CartItem
 */
Route::get('carts/{user?}', 'Cart\CartItemController@index')->name('carts.index');
Route::delete('carts', 'Cart\CartItemController@empty')->name('carts.empty');
Route::post('carts/{product}', 'Cart\CartItemController@store')->name('carts.store');
Route::patch('carts/{product}', 'Cart\CartItemController@update')->name('carts.update');
Route::delete('carts/{product}', 'Cart\CartItemController@destroy')->name('carts.destroy');

/**
 * Checkout User
 */
Route::get('checkout/users/{user}', 'Checkout\User\CheckoutUserController@index')
    ->name('checkout.users.index');
Route::post('checkout/users/{user}', 'Checkout\User\CheckoutUserController@store')
    ->name('checkout.users.store');
Route::get('checkout/users/select-delivery-address/{user}/{shipping?}', 'Checkout\User\CheckoutUserShippingController@index')
    ->name('checkout.users.shippings.index');

/**
 * Checkout Guest
 */
Route::get('checkout/guest', 'Checkout\Guest\CheckoutGuestController@index')
    ->name('checkout.guests.index');
Route::post('checkout/guest', 'Checkout\Guest\CheckoutGuestController@store')
    ->name('checkout.guests.store');

/**
 * CheckoutAddress
 */
Route::post('checkouts/addresses', 'Checkout\CheckoutAddressController@store')
    ->name('checkouts.addresses.store');

/**
 * CheckoutConfirmation
 */
Route::get('/checkout/success', 'Checkout\Confirmation\CheckoutSuccessController')
    ->name('checkouts.success');
Route::get('/checkout/error', 'Checkout\Confirmation\CheckoutErrorController')
    ->name('checkouts.error');

/**
 * Product
 */
Route::resource('products', 'Product\ProductController');


/**
 * Test
 */
Route::post('/test', 'TestController@store')->name('tests.store');
