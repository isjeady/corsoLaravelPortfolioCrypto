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
    if(Auth::check()){
        return redirect()->route('dashboardAlias');
    }else{
        return view('welcome');
    }
});

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => 'auth'],function(){
    //Dashboard
    Route::get('/dashboard', ['as' => 'dashboardAlias','uses' => 'DashboardController@index']);

    Route::group(['prefix' => 'cryptocurrencies'],function(){

        //CryptoCurrencies New
        Route::get('/new', ['as' => 'cryptocurrenciesRoute.new','uses' => 'CryptoCurrenciesController@new']);
        Route::get('/edit/{id}', ['as' => 'cryptocurrenciesRoute.edit','uses' => 'CryptoCurrenciesController@edit']); //->where('id' ,'[0-9]+');
        Route::get('/edit', function () {return \Redirect::route('cryptocurrenciesRoute');});

        //CryptoCurrencies
        Route::get('/', ['as' => 'cryptocurrenciesRoute','uses' => 'CryptoCurrenciesController@view']);
        Route::post('/', ['as' => 'cryptocurrenciesRoute.save','uses' => 'CryptoCurrenciesController@save']);

        Route::get('/{id}', ['as' => 'cryptocurrenciesRoute.get','uses' => 'CryptoCurrenciesController@get']);
        Route::delete('/{id}',['as' => 'cryptocurrenciesRoute.delete','uses' => 'CryptoCurrenciesController@delete']);

    });
});


Auth::routes();

Route::match(['get', 'post'], 'register', function(){
    return redirect('/');
});




