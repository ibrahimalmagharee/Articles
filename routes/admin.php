<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register admin routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "admin" middleware group. Now create something great!
|
*/

    Route::group(['namespace' => 'Dashboard', 'middleware' =>'auth:admin', 'prefix' => 'admin'], function (){

        Route::get('index','DashboardController@index')->name('admin.dashboard');
        Route::get('logout','LoginController@logout')->name('admin.logout');


        ######################### Profile Routes #############################################################

        Route::group(['prefix' => 'profile'], function (){
            Route::get('edit', 'ProfileController@edit')->name('edit.profile');
            Route::put('update', 'ProfileController@update')->name('update.profile');
        });

        ######################### End Profile Routes #############################################################


        ##################  Articles Routes #############################################################

        Route::group(['prefix' => 'articles'], function (){
            Route::get('show', 'ArticleController@index')->name('index.articles');
            Route::get('create', 'ArticleController@create')->name('create.article');
            Route::post('save', 'ArticleController@store')->name('save.article');
            Route::get('edit/{id}', 'ArticleController@edit')->name('edit.article');
            Route::post('update/{id}', 'ArticleController@update')->name('update.article');
            Route::get('delete/{id}', 'ArticleController@destroy')->name('delete.article');

            Route::get('add-article-images/{slug}', 'ArticleController@addArticleImages')->name('add.article.images');
            Route::post('save-images-inFolder', 'ArticleController@saveImagesOfArticleInFolder')->name('save.images.inFolder');
            Route::post('save-images-inDB', 'ArticleController@saveImagesOfArticleInDB')->name('save.images.inDB');
            Route::get('delete-image', 'ArticleController@deleteImagesOfArticle')->name('delete.image');
            Route::post('remove-image', 'ProductController@removeImagesOfProductFromFolder')->name('delete.image.fromFolder');


        });
        ######################### End Articles Routes #############################################################

        ##################  Tag Routes #############################################################

        Route::group(['prefix' => 'tags'], function (){
            Route::get('show', 'TagController@index')->name('index.tags');
            Route::post('save', 'TagController@store')->name('save.tag');
            Route::get('edit/{id}', 'TagController@edit')->name('edit.tag');
            Route::post('update/{id}', 'TagController@update')->name('update.tag');
            Route::get('delete/{id}', 'TagController@destroy')->name('delete.tag');

        });
        ######################### End Tag Routes #############################################################




    });

    Route::group(['namespace' => 'Dashboard', 'middleware' => 'guest:admin', 'prefix' => 'admin'], function(){
        Route::get('/login','LoginController@login')->name('admin.login.page');
        Route::get('/','LoginController@redirectLogin')->name('admin.redirectLogin');
        Route::post('/check-login','LoginController@checkLogin')->name('check.admin.login');
    });

