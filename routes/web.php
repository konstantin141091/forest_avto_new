<?php

use Illuminate\Support\Facades\Route;

//Auth::routes();
Route::get('/', 'HomeController@index')->name('index');
Route::post('/search', 'SearchController@index')->name('search.index');
// cart
Route::group([
    'prefix' => 'cart',
    'as' => 'cart.',
], function () {
    Route::get('/', 'CartController@index')->name('index');
    Route::post('/', 'CartController@store')->name('store');
});
// order
Route::group([
    'prefix' => 'order',
    'as' => 'order.',
], function () {
    Route::get('/', 'OrderController@index')->name('index');
    Route::post('/', 'OrderController@store')->name('store');
});
// admin
Route::group([
    'namespace' => 'Auth',
], function() {
    Route::get('/myLogin21', 'LoginController@showLoginForm')->name('login');
    Route::post('/myLogin21', 'LoginController@login');
    Route::post('/logout', 'LoginController@logout')->name('logout');
});

