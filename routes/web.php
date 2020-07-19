<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');

/** Home */
Route::get('/', 'HomeController@index')->name('home.index');

/** Users */
Route::prefix('/users')->group(function () {
    Route::middleware('auth')->group(function () {
        Route::get('/{user}/edit', 'UserController@edit')->name('users.edit');
        Route::put('/{user}', 'UserController@update')->name('users.update');
        Route::delete('/{user}', 'UserController@destroy')->name('users.destroy');
        Route::get('/', 'UserController@index')->name('users.index');
        Route::get('/{user}', 'UserController@show')->name('users.show');
    });
});

/** Articles */
Route::prefix('/articles')->group(function () {
    Route::middleware('auth')->group(function () {
        Route::get('/create', 'ArticleController@create')->name('articles.create');
        Route::get('/{article}/edit', 'ArticleController@edit')->name('articles.edit');
        Route::post('/', 'ArticleController@store')->name('articles.store');
        Route::put('/{article}', 'ArticleController@update')->name('articles.update');
        Route::delete('/{article}', 'ArticleController@destroy')->name('articles.destroy');
    });

    Route::get('/', 'ArticleController@index')->name('articles.index');
    Route::get('/{article}', 'ArticleController@show')->name('articles.show');
});

/** Categories */
Route::prefix('/categories')->group(function () {
    Route::middleware('auth')->group(function () {
        Route::get('/create', 'CategoryController@create')->name('categories.create');
        Route::get('/{category}/edit', 'CategoryController@edit')->name('categories.edit');
        Route::post('/', 'CategoryController@store')->name('categories.store');
        Route::put('/{category}', 'CategoryController@update')->name('categories.update');
        Route::delete('/{category}', 'CategoryController@destroy')->name('categories.destroy');
    });

    Route::get('/', 'CategoryController@index')->name('categories.index');
    Route::get('/{category}', 'CategoryController@show')->name('categories.show');
});

/** Mail */
Route::get('/send/mail/{user}', 'MailController@sendMail');

