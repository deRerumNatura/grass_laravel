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


use Illuminate\Support\Facades\DB;

//\Debugbar::disable();

Route::get('/', function () {
    return view('welcome');
});

//Route::resource('template', 'TemplateController');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
////////////////////////////////////////////////////////
Route::group(['middleware' => 'auth'], function (){
    Route::resource('template', 'TemplateController');
    Route::resource('bunch', 'BunchController');
    Route::resource('subscriber', 'SubscriberController');
    Route::resource('campaign', 'CampaignController');
/////////////////////////////////////////////////////////////////////////////////////////////
    Route::get('campaign/send/{campaign}', 'CampaignController@send')->name('send');
    Route::get('campaign/preview/{campaign}', 'CampaignController@preview')->name('preview');
//////////////////////////////////////////////////////////////////////////////////////////////
     Route::prefix('bunch/{bunch}')->group(function () {
        Route::get('subscriber/{subscriber}', 'SubscriberController@show')->name('showOne');
    });
 /////////////////////////////////////////////////////////////////////////////////////////////
});




