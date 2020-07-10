<?php

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

//Route::get('/', function () {
//    return view('welcome');
//});

Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');

//Route::get('/', 'Auth\LoginController@showLoginForm');

Route::middleware(['auth'])->group(function(){
    //Route::get('/story', 'StoryController@index')->name("story.index");
    //Route::get('/story/{story}', 'StoryController@show')->name('story.show');
    Route::resource('story', 'StoryController');
});

Route::get('/', 'DashboardController@index')->name('dashboard.index');
Route::get('/story-detail/{activeStory}', 'DashboardController@show')->name('dashboard.show');
