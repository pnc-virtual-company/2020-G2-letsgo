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
<<<<<<< HEAD
// yourEvent
Route::resource('/yourEvent','YourEventController');
=======
Route::resource('/yourEvent', 'YourEventController');
>>>>>>> 19b92c7af970a1acbe71caa2ea21c30fbe3a61ff


Route::resource('/userProfile', 'userProfileController');
Route::put('/changePasswords', 'userProfileController@changePassword')->name('changePasswords');

route::resource('event','EventController');
// view your event
route::get('yourEvent','EventController@viewyourevent')->name('yourEvent.yourevent');
// create your event
// Route::post('/yourEvent/{id}','EventController@createevent')->name('createEvent');


Route::group(['prefix' => 'manage'],function(){
    //event
    Route::resource('event','EventController');
    //category
    Route::get('/category/index','CategoryController@index')->name('category.index');
    Route::delete('/category/destroy/{id}','CategoryController@destroy');
    Route::put('/category/update/{id}','CategoryController@update');
    Route::post('/category/store/','CategoryController@store')->name('category.store');
    Route::get('/search','CategoryController@search')->name('category.search');
    Route::get('/existCategory','CategoryController@existCategory')->name('category.existCategory');

});




