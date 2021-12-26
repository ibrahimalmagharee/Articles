<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::group(['namespace' => 'Site', 'middleware' => ['api']], function () {

    Route::get('articles', 'ArticleController@getArticles');
    Route::get('/article/{slug}', 'ArticleController@articleDetails');
    Route::get('articles/tag/{slug}', 'ArticleController@articleTags')->name('articleTags');


});


Route::group(['namespace' => 'API', 'middleware' => ['api']], function () {

    Route::post('register', 'AuthController@register');
    Route::post('login', 'AuthController@login');


});
