<?php

use Illuminate\Http\Request;

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
Route::prefix('v1')->group(function () {

    Route::namespace('Auth')->group(function () {
        Route::post('login', 'AuthController@login')->name('login');
        Route::post('register', 'AuthController@register')->name(
            'register'
        );


        Route::group(['middleware' => ['auth:api']], function () {
            Route::get('user', 'AuthController@user')->name('user');
            Route::post('logout', 'AuthController@logout')->name('logout');
        });
    });

    Route::group(['middleware' => ['auth:api']], function () {
        Route::prefix('persons')->name('persons.')->group(function () {
            Route::post('/create', 'PersonsController@create')->name('create');
            Route::post('/search', 'PersonsController@search')->name('search');
            Route::put('/update/{id}', 'PersonsController@update')->name('update');
            Route::delete('/delete/{id}', 'PersonsController@delete')->name('delete');
            Route::get('/show/{id}', 'PersonsController@item')->name('item');
            Route::get('/{offset?}/{columns?}', 'PersonsController@index')->name('list');
        });
    });
});
