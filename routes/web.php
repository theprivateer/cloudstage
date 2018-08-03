<?php

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

Route::get('/', function () {
    return view('welcome');
});

//Auth::routes();

Route::group(['middleware' => 'auth'], function() {
    Route::get('home', function() {
        return redirect()->route('site.index');
    });

    Route::get('sites', [
        'uses'  => 'SiteController@index',
        'as'    => 'site.index'
    ]);

    Route::get('site/create', [
        'uses'  => 'SiteController@create',
        'as'    => 'site.create'
    ]);

    Route::post('site/create', [
        'uses'  => 'SiteController@store',
        'as'    => 'site.create'
    ]);

    Route::get('site/{uuid}/edit', [
        'uses'  => 'SiteController@edit',
        'as'    => 'site.edit'
    ]);

    Route::post('site/{uuid}/edit', [
        'uses'  => 'SiteController@update',
        'as'    => 'site.edit'
    ]);

    Route::delete('site', [
        'uses'  => 'SiteController@destroy',
        'as'    => 'site.destroy'
    ]);

    Route::get('user', [
        'uses'  => 'UserController@edit',
        'as'    => 'user.edit'
    ]);

    Route::post('user', [
        'uses'  => 'UserController@update',
        'as'    => 'user.edit'
    ]);
});
