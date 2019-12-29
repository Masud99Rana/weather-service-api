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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::group(['prefix' => 'v1'], function(){
	Route::get('/', 'ServerController@index');

	// System Status
	Route::get('/ping', 'ServerController@ping');
	Route::get('/version', 'ServerController@version');

	// Auth Routes
	Route::group(['prefix' => 'auth'], function(){
		Route::post('login', 'AuthController@login');
		Route::get('logout', 'AuthController@logout');
		Route::patch('refresh', 'AuthController@refreshToken');
		Route::post('register', 'AuthController@register');
		Route::get('me', 'AuthController@me');
	});


	// Weather API
	Route::group(['prefix' => 'weather',"middleware"=>'auth:api'], function(){
		Route::get('/cities', 'QueryController@index');
		Route::get('/{city}', 'QueryController@current');
		Route::get('/{city}/{date}', 'QueryController@date')
                // http://html5pattern.com/Dates
                // Format: YYYY-MM-DD
                ->where('date', '[0-9]{4}-(0[1-9]|1[012])-(0[1-9]|1[0-9]|2[0-9]|3[01])');

	});

});