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

Route::get('/', 'HomeController@index');

Route::get('setlocale/{locale}', function ($locale) {
    if (in_array($locale, \Config::get('app.locales'))) {
        \Cookie::queue('locale', $locale, 60*24*365);
    }
    return redirect()->back();
});

Route::resource('/transport/taxi','TaxiServiceController',['except' => 'show']);
Route::get('/transport/taxi/{slug}', 'TaxiServiceController@show')->name('taxi.show');

Route::resource('/business','OrganisationController',['except' => 'show']);
Route::get('/business/{slug}', 'OrganisationController@show')->name('organisation.show');

/*Route::get('/business', function(){
        return view('layouts.pages.business');
        });
*/

Auth::routes();

Route::get('/home', 'HomeController@home')->name('home');

