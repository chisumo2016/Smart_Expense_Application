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

Route::get('/', function (){
    if(Auth::guest())
    {
       return Redirect::to('login');
    }
    if(Auth::check())
    {
        return Redirect::to('home');
    }
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//Auth get zone Route
Route::post('/auth/get_zones', 'Auth\RegisterController@get_zones');

//Logout
Route::get('/logout', 'Auth\LoginController@logout')->name('logout');


/**==================Company Routes================================*/

Route::group(['prefix' => '/companies'], function (){

    Route::get('/', 'CompaniesController@index')->name('company.index');
    Route::get('/create','CompaniesController@create')->name('company.create');
    Route::post('/store','CompaniesController@store')->name('company.store');

});