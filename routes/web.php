<?php

use Illuminate\Routing\RouteGroup;
use Illuminate\Support\Facades\Route;
use Symfony\Component\Routing\Loader\Configurator\Traits\PrefixTrait;

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
    return view('auth.login');
});

Auth::routes();

Route::resource('/exploreEvents', 'ExploreEventsController');
Route::resource('/yourEvent', 'YourEventControll');

Route::group(['prefix' => 'manage'],function(){
    Route::resource('/event', 'EventController');
    Route::resource('/category', 'CategoryController');
    Route::delete('/category/destroy/{id}','CategoryController@destroy');
});


