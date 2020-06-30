<?php

use Illuminate\Routing\RouteGroup;
use Illuminate\Support\Facades\Route;

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
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

/*User no Auth */
Route::group(['middleware' => 'guest'], function () {
  Route::get('/', function () {
    return view('auth.login');
  });
});

/*Users Auth*/
Route::group(['middleware' => 'auth'], function () {
  //ProvinceController
  Route::get('provinces', 'ProvinceController@index');
  //MunicipalityController
  Route::get('municipalities', 'MunicipalityController@index');
  //TracingController
  Route::get('tracings', 'TracingController@index');
  Route::post('saveTracing', 'TracingController@store');

  //ActivityController
  Route::get('activities', 'ActivityController@index');
  //ProductionLineController
  Route::get('production-lines', 'ProductionLineController@index');
});
