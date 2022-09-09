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

// Route::group(['middleware' => 'auth'], function () {
// 	Route::resource('user', 'UserController', ['except' => ['show']]);
// 	Route::get('profile', ['as' => 'profile.edit', 'uses' => 'ProfileController@edit']);
// 	Route::put('profile', ['as' => 'profile.update', 'uses' => 'ProfileController@update']);
// 	Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'ProfileController@password']);
// });

Route::group(['prefix'=>'books','as'=>'books.'], function(){
    Route::get('/', ['as' => 'index', 'uses' => 'BookController@index']);
	Route::get('/add-book', ['as' => 'create', 'uses' => 'BookController@create']);
	Route::post('/save-book', ['as' => 'save', 'uses' => 'BookController@save']);
	Route::get('/edit-book/{book}', ['as' => 'edit', 'uses' => 'BookController@edit']);
	Route::post('/update-book', ['as' => 'update', 'uses' => 'BookController@update']);
	Route::post('/remove-book', ['as' => 'remove', 'uses' => 'BookController@remove']);
	Route::get('/active-book/{book_id}', ['as' => 'set-active', 'uses' => 'BookController@setToActive']);

	Route::group(['prefix'=>'categories','as'=>'categories.'], function(){
    	Route::get('/', ['as' => 'index', 'uses' => 'BookCategoryController@index']);
		Route::get('/add-category', ['as' => 'create', 'uses' => 'BookCategoryController@create']);
		Route::post('/save-category', ['as' => 'save', 'uses' => 'BookCategoryController@save']);
		Route::get('/edit-category/{book_category}', ['as' => 'edit', 'uses' => 'BookCategoryController@edit']);
		Route::post('/update-category', ['as' => 'update', 'uses' => 'BookCategoryController@update']);
		Route::post('/remove-category', ['as' => 'remove', 'uses' => 'BookCategoryController@remove']);
	});
});

Route::group(['prefix'=>'users','as'=>'users.'], function(){
	Route::get('/', ['as' => 'index', 'uses' => 'UserController@index']);
	Route::get('/create', ['as' => 'create', 'uses' => 'UserController@create']);
	Route::get('/download-template', ['as' => 'download-template', 'uses' => 'UserController@downloadTemplate']);
	Route::post('/upload', ['as' => 'upload', 'uses' => 'UserController@upload']);
	Route::post('/save-upload', ['as' => 'save-upload', 'uses' => 'UserController@saveUpload']);
	Route::get('/edit/{user}', ['as' => 'edit', 'uses' => 'UserController@edit']);
	Route::post('/update', ['as' => 'update', 'uses' => 'UserController@update']);
	Route::post('/archive-user', ['as' => 'archive', 'uses' => 'UserController@archive']);
	Route::get('/active-user/{user}', ['as' => 'set-active', 'uses' => 'UserController@setToActive']);
});

Route::group(['prefix'=>'library','as'=>'library.'], function(){
	Route::get('/', ['as' => 'index', 'uses' => 'LibraryController@index']);
});

