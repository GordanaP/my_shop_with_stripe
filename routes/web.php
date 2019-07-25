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
 * Checkout
 */
Route::resource('checkouts', 'Checkout\CheckoutController', [
    'only' => ['index', 'store']
]);

/**
 * CheckoutAddress
 */
Route::post('addresses', 'Checkout\CheckoutAddressController')
    ->name('checkouts.addresses.store');

/**
 * Test
 */
Route::post('/test', 'TestController@store')->name('tests.store');
