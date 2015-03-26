<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', 'HomeController@index');

Route::resource('location', 'LocationController');

Route::group(['prefix' => 'api', 'namespace' => 'Api'], function()
{
    Route::group(['prefix' => 'v1'], function()
    {
        Route::resource('locations', 'LocationsController', ['except' => ['create','edit']]);
        Route::get('locations/common/{id1}/{id2}', 'LocationsController@common');
    });
});

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);
