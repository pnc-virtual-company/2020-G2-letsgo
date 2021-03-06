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
Route::get('/carlendar', 'ExploreEventsController@viewByCarlendar')->name('viewByCarlendar');
Route::post('/join/{id}', 'ExploreEventsController@join')->name("join");
Route::delete('/quit/{id}', 'ExploreEventsController@quit')->name("quit");

Route::get('/onlyEventJoin', 'ExploreEventsController@onlyEventJoin')->name("onlyEventJoin");
Route::put('/ifCheck/{data}', 'ExploreEventsController@ifCheck')->name("ifCheck");
Route::put('/ifnotcheck/{data}', 'ExploreEventsController@ifnotcheck')->name("ifnotcheck");

Route::get('/onlyEventUserOnCalendar', 'ExploreEventsController@onlyEventUserOnCalendar')->name('onlyEventUserOnCalendar');
Route::put('/ifcheckOnCalendar/{data}', 'ExploreEventsController@ifcheckOnCalendar')->name('ifcheckOnCalendar');
Route::put('/ifNocheckOnCalendar/{data}', 'ExploreEventsController@ifNocheckOnCalendar')->name('ifNocheckOnCalendar');


Route::resource('/yourEvent', 'YourEventController');
Route::put('yourEvent/update/{id}','YourEventController@update');

Route::resource('/userProfile', 'userProfileController');
Route::put('/changePasswords', 'userProfileController@changePassword')->name('changePasswords');



Route::group(['prefix' => 'manage'],function(){
    //event
    Route::get('/event/index','EventController@index')->name('event.index');
    Route::delete('/event/destroy/{id}','EventController@destroy')->name('event.destroy');
    
    //category
    Route::get('/category/index','CategoryController@index')->name('category.index');
    Route::delete('/category/destroy/{id}','CategoryController@destroy');
    Route::put('/category/update/{id}','CategoryController@update');
    Route::post('/category/store/','CategoryController@store')->name('category.store');
    Route::get('/existCategory','CategoryController@existCategory')->name('category.existCategory');
    Route::get('/updateExistCategory','CategoryController@updateExistCategory')->name('updateExistCategory');

});



