<?php

use Illuminate\Support\Facades\Route;

//Auth::routes();
Route::get('/', 'HomeController@index')->name('index');
// роуты по поиску
Route::group([
    'prefix' => 'search',
    'as' => 'search.'
], function() {
    Route::post('/artikul', 'SearchController@artikul')->name('artikul');
    Route::post('/car', 'SearchController@findCar')->name('car');
    Route::group([
        'prefix' => 'car',
        'as' => 'car.'
    ], function () {
        Route::post('/categories', 'SearchController@carCategories')->name('categories');
        Route::post('/catalog', 'SearchController@carCatalog')->name('catalog');
        Route::post('/catalog/parts', 'SearchController@carCatalogParts')->name('catalog.parts');
    });


});

// cart
Route::group([
    'prefix' => 'cart',
    'as' => 'cart.',
], function () {
    Route::get('/', 'CartController@index')->name('index');
//    Route::post('/', 'CartController@store')->name('store');
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

Route::group([
    'prefix' => 'myCabinet21',
    'as' => 'admin.',
    'middleware' => 'auth',
    'namespace' => 'Admin',
], function() {
    Route::get('/', 'AdminController@index')->name('index');

    Route::group([
        'prefix' => 'order',
        'as' => 'order.'
    ], function() {
        Route::get('/', 'OrderController@index')->name('index');
        Route::get('/{order}', 'OrderController@show')->name('show');
        Route::post('/{order}', 'OrderController@edit')->name('edit');

        Route::post('/product/status/{cart}', 'CartController@edit')->name('product.status.edit');

        Route::get('/product/create/{cart}', 'ApiOrderController@showCreateOrder')->name('show.create');
        Route::post('/product/create/{cart}', 'ApiOrderController@createOrder')->name('create');
    });
});

