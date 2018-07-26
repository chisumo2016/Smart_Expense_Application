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

Route::get('/home',             'HomeController@index')->name('home');

//Auth get zone Route
Route::post('/auth/get_zones',  'Auth\RegisterController@get_zones');

//Logout
Route::get('/logout',           'Auth\LoginController@logout')->name('logout');


/**======================Company Routes==========================================*/

Route::group(['prefix' => '/companies'], function (){

    Route::get('/',                 'CompaniesController@index')->name('company.index');
    Route::get('/create',           'CompaniesController@create')->name('company.create');
    Route::post('/store',           'CompaniesController@store')->name('company.store');
    Route::get('/active/{company}', 'CompaniesController@active')->name('company.active');
    Route::get('/active/',          'CompaniesController@active')->name('company.active');

});


/**========================Categories-Periods  Route=================================*/

Route::get('categories-period',       'CategoriesPeriodsController@index')->name('categories-periods.index');


/**========================Categories Routes=======================================**/

Route::group(['prefix' => '/categories'], function (){


    Route::get('/create',           'CategoriesController@create')->name('category.create');
    Route::post('/store',           'CategoriesController@store')->name('category.store');
    Route::get('/edit/{id}',        'CategoriesController@edit')->name('category.edit');
    Route::post('/update/{id}',     'CategoriesController@update')->name('category.update');
    Route::get('/delete/{id}',      'CategoriesController@delete')->name('category.delete');


});


/**=========================Periods Routes============================================*/

Route::group(['prefix' => '/periods'], function (){


    Route::get('/create',           'PeriodsController@create')->name('period.create');
    Route::post('/store',           'PeriodsController@store')->name('period.store');
    Route::get('/edit/{id}',        'PeriodsController@edit')->name('period.edit');
    Route::post('/update/{id}',     'PeriodsController@update')->name('period.update');
    Route::get('/delete/{id}',      'PeriodsController@delete')->name('period.delete');


});


/**==========================Users Routes================================*/

Route::group(['prefix' => '/users'], function (){


    Route::get('/',                 'UsersController@index')->name('user.index');
    Route::get('/create',           'UsersController@create')->name('user.create');
    Route::post('/store',           'UsersController@store')->name('user.store');
    Route::get('/edit/{id}',        'UsersController@edit')->name('user.edit');
    Route::post('/update/{id}',     'UsersController@update')->name('user.update');
    Route::get('/delete/{id}',      'UsersController@delete')->name('user.delete');

});


/**==========================Budgets Routes================================*/

Route::group(['prefix' => '/budgets'], function (){


    Route::get('/',                 'BudgetsController@index')->name('budget.index');
    Route::get('/create',           'BudgetsController@create')->name('budget.create');
    Route::post('/store',           'BudgetsController@store')->name('budget.store');
    Route::get('/edit/{id}',        'BudgetsController@edit')->name('budget.edit');
    Route::post('/update/{id}',     'BudgetsController@update')->name('budget.update');
    Route::get('/delete/{id}',      'BudgetsController@delete')->name('budget.delete');

});


/**==============================Expenses Routes==================================*/

Route::group(['prefix' => '/expenses'], function (){


    Route::get('/',                 'ExpensesController@index')->name('expense.index');
    Route::get('/create',           'ExpensesController@create')->name('expense.create');
    Route::post('/store',           'ExpensesController@store')->name('expense.store');
    Route::get('/edit/{id}',        'ExpensesController@edit')->name('expense.edit');
    Route::post('/update/{id}',     'ExpensesController@update')->name('expense.update');
    Route::get('/delete/{id}',      'ExpensesController@delete')->name('expense.delete');
    Route::get('/show/{id}',        'ExpensesController@show')->name('expense.show');



    Route::post('/updatestatus',    'ExpensesController@updatestatus')->name('expense.updatestatus');

    Route::post('editstatus', 'ExpensesController@editstatus')->name('expense.editstatus');

});






















