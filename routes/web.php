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
// yourEvent
Route::get('/yourEvent','YourEventControll@index')->name('yourEvent.index');
Route::get('/read','YourEventControll@read')->name('event.read');

Route::resource('/userProfile', 'userProfileController');

Route::group(['prefix' => 'manage'],function(){
    //event
    Route::get('event/index','EventController@index')->name('event.index');
    
    //category
    Route::get('/category/index','CategoryController@index')->name('category.index');
    Route::delete('/category/destroy/{id}','CategoryController@destroy');
    Route::put('/category/update/{id}','CategoryController@update');
    Route::post('/category/store/','CategoryController@store')->name('category.store');
    Route::get('/search','CategoryController@search')->name('category.search');
    Route::get('/existCategory','CategoryController@existCategory')->name('category.existCategory');

});


