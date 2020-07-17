<?php

use Illuminate\Support\Facades\Route;

use App\Http\Middleware\CheckAdmin;

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
Route::get('/story-detail/{activeStory:slug}', 'DashboardController@show')->name('dashboard.show');

Route::get('/email', 'DashboardController@email')->name('dashboard.email');

Route::namespace('Admin')->prefix('admin')->middleware(['auth', Checkadmin::class])->group(function(){
    Route::get('/deleted_story', 'StoryController@index')->name('admin.story.index');
    Route::put('/story/restore/{id}', 'StoryController@restore')->name('admin.story.restore');
    Route::delete('/story/delete/{id}', 'StoryController@delete')->name('admin.story.delete');
});

Route::get('/image', function (){
    $image_path = public_path('storage/r5.jpg');
    $write_path = public_path('storage/thumbnail.jpg');

    $img = Image::make($image_path)->resize(225, 100);
    $img->save($write_path);

    return $img->response('jpg');
});
