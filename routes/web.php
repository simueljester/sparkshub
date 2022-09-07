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

Route::get('/', function () {
    return view('welcome');
});


Route::get('/home', 'HomeController@index')->name('home');
Route::get('/dashboard', 'HomeController@dashboard')->name('dashboard');
Auth::routes();

Route::group(['middleware' => 'auth'], function () {
	Route::resource('user', 'UserController', ['except' => ['show']]);
	Route::get('profile', ['as' => 'profile.edit', 'uses' => 'ProfileController@edit']);
	Route::put('profile', ['as' => 'profile.update', 'uses' => 'ProfileController@update']);
	Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'ProfileController@password']);
});

Route::group(['prefix'=>'books','as'=>'books.'], function(){
    Route::get('/', ['as' => 'index', 'uses' => 'BookController@index']);
	Route::get('/add-book', ['as' => 'create', 'uses' => 'BookController@create']);

	Route::group(['prefix'=>'categories','as'=>'categories.'], function(){
    	Route::get('/', ['as' => 'index', 'uses' => 'BookCategoryController@index']);
		Route::get('/add-category', ['as' => 'create', 'uses' => 'BookCategoryController@create']);
		Route::post('/save-category', ['as' => 'save', 'uses' => 'BookCategoryController@save']);
		Route::get('/edit-category/{book_category}', ['as' => 'edit', 'uses' => 'BookCategoryController@edit']);
		Route::post('/update-category', ['as' => 'update', 'uses' => 'BookCategoryController@update']);
		Route::post('/remove-category', ['as' => 'remove', 'uses' => 'BookCategoryController@remove']);
	});
});

