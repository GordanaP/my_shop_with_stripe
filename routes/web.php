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
// Route::resource('users.customers', 'User\UserCustomerController', [
//     'only' => ['create','store']
// ]);

Route::post('users-customers/{user?}', 'User\UserCustomerController@store')
    ->name('users.customers.store');
Route::get('users-customers/create/{user?}', 'User\UserCustomerController@create')
    ->name('users.customers.create');
