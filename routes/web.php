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

Route::group(['namespace' => 'Site'], function () {

    Route::get('/', 'ArticleController@index')->name('index');
    Route::get('/article/{slug}', 'ArticleController@articleDetails')->name('articleDetails');
    Route::get('/tag/{slug}', 'ArticleController@articleTags')->name('articleTags');

});
