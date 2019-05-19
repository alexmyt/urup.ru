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

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});

// Route::get('/search', [
//     'as' => 'api.search',
//     'uses' => 'Api\SearchController@search'
// ]);

Route::namespace('Api')->group(function(){

    Route::post('/register', 'AuthController@register');
    Route::post('/login', 'AuthController@login');
    
    Route::middleware('auth:api')->group(function () {
        Route::post('/logout', 'AuthController@logout');
	Route::get('/user', function (Request $request){
	    return new App\Http\Resources\UserResource($request->user());
	});
    });
    
    Route::apiResource('taxiServices','TaxiServiceController');
    Route::apiResource('organisations','OrganisationController');

    Route::get('search','SearchController@search');
});

