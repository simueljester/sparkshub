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
	Route::post('/delete-book', ['as' => 'delete', 'uses' => 'BookController@delete']);

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
	Route::post('/save-manual', ['as' => 'save-manual', 'uses' => 'UserController@saveManual']);
	Route::get('/edit/{user}', ['as' => 'edit', 'uses' => 'UserController@edit']);
	Route::post('/update', ['as' => 'update', 'uses' => 'UserController@update']);
	Route::post('/archive-user', ['as' => 'archive', 'uses' => 'UserController@archive']);
	Route::get('/active-user/{user}', ['as' => 'set-active', 'uses' => 'UserController@setToActive']);
	Route::get('/profile/{user}', ['as' => 'profile', 'uses' => 'UserController@profile']);
	Route::post('/upload-avatar', ['as' => 'upload-avatar', 'uses' => 'UserController@uploadAvatar']);
});

Route::group(['prefix'=>'library','as'=>'library.'], function(){
	Route::get('/', ['as' => 'index', 'uses' => 'LibraryController@index']);
	Route::get('/books', ['as' => 'books', 'uses' => 'LibraryController@indexBooks']);
	Route::get('/modules', ['as' => 'modules', 'uses' => 'LibraryController@indexModules']);
	Route::get('/show-modules/{module}', ['as' => 'show-modules', 'uses' => 'LibraryController@showModules']);
});

Route::group(['prefix'=>'request-book','as'=>'request-book.'], function(){
	Route::get('/', ['as' => 'index', 'uses' => 'RequestedBookController@index']);
	Route::post('/create', ['as' => 'request', 'uses' => 'RequestedBookController@requestBook']);
	Route::post('/save-request', ['as' => 'save-request', 'uses' => 'RequestedBookController@save']);
	Route::get('/show/{requested_book}', ['as' => 'show', 'uses' => 'RequestedBookController@show']);
	Route::post('/approve', ['as' => 'approve', 'uses' => 'RequestedBookController@approve']);
	Route::post('/returned', ['as' => 'returned', 'uses' => 'RequestedBookController@returned']);
});

Route::group(['prefix'=>'notification','as'=>'notification.'], function(){
	Route::get('/', ['as' => 'index', 'uses' => 'NotificationController@index']);
	Route::get('/{notification}', ['as' => 'read', 'uses' => 'NotificationController@read']);
	Route::post('/send-email-notifications', ['as' => 'send-email', 'uses' => 'NotificationController@sendEmail']);
});

Route::group(['prefix'=>'lost-books','as'=>'lost-books.'], function(){
	Route::get('/', ['as' => 'index', 'uses' => 'LostBookController@index']);
	Route::get('/create/{requested_book}', ['as' => 'create', 'uses' => 'LostBookController@create']);
	Route::post('/save', ['as' => 'save', 'uses' => 'LostBookController@save']);
	Route::get('/show/{lost_book}', ['as' => 'show', 'uses' => 'LostBookController@show']);
	Route::get('/download-attachment/{lost_book}', ['as' => 'download-attachment', 'uses' => 'LostBookController@downloadAttachment']);
	Route::get('/approve/{lost_book}', ['as' => 'approve', 'uses' => 'LostBookController@approve']);
});



Route::group(['prefix'=>'modules','as'=>'modules.'], function(){
	Route::get('/', ['as' => 'index', 'uses' => 'ModuleController@index']);
	Route::get('/create', ['as' => 'create', 'uses' => 'ModuleController@create']);
	Route::post('/save', ['as' => 'save', 'uses' => 'ModuleController@save']);
	Route::get('/edit/{module}', ['as' => 'edit', 'uses' => 'ModuleController@edit']);
	Route::post('/update', ['as' => 'update', 'uses' => 'ModuleController@update']);
	Route::get('/manage/{module}', ['as' => 'manage', 'uses' => 'ModuleController@manage']);
	Route::post('/archive-module', ['as' => 'archive', 'uses' => 'ModuleController@archive']);
	Route::get('/active-module/{module}', ['as' => 'set-active', 'uses' => 'ModuleController@setToActive']);
	Route::get('/approve/{module}', ['as' => 'approve', 'uses' => 'ModuleController@approve']);
	Route::post('/delete-module', ['as' => 'delete', 'uses' => 'ModuleController@delete']);

	Route::group(['prefix'=>'file','as'=>'file.'], function(){
		Route::post('/add-file', ['as' => 'add-file', 'uses' => 'ModuleFileController@addFile']);
		Route::get('/download-content/{file}', ['as' => 'download-content', 'uses' => 'ModuleFileController@downloadContent']);
		Route::get('/remove-file/{file}', ['as' => 'remove-file', 'uses' => 'ModuleFileController@removeFile']);
	});

	Route::group(['prefix'=>'subjects','as'=>'subjects.'], function(){
		Route::get('/', ['as' => 'index', 'uses' => 'SubjectController@index']);
		Route::get('/create', ['as' => 'create', 'uses' => 'SubjectController@create']);
		Route::post('/save', ['as' => 'save', 'uses' => 'SubjectController@save']);
		Route::get('/edit/{subject}', ['as' => 'edit', 'uses' => 'SubjectController@edit']);
		Route::post('/update', ['as' => 'update', 'uses' => 'SubjectController@update']);
	});
});

Route::group(['prefix'=>'reports','as'=>'reports.'], function(){
	Route::get('/', ['as' => 'index', 'uses' => 'ReportController@index']);

	Route::group(['prefix'=>'borrowed-book','as'=>'borrowed-book.'], function(){
		Route::get('/', ['as' => 'index', 'uses' => 'ReportController@indexRequestedBookReports']);
		Route::get('/monthly/{month}/{year}', ['as' => 'index.monthly', 'uses' => 'ReportController@indexRequestedBookReportsMonthly']);
		Route::get('/export', ['as' => 'export', 'uses' => 'ReportController@indexRequestedBookReportsExport']);
	});

	Route::group(['prefix'=>'module','as'=>'module.'], function(){
		Route::get('/', ['as' => 'index', 'uses' => 'ReportController@indexModuleReports']);
		Route::get('/monthly/{month}/{year}', ['as' => 'index.monthly', 'uses' => 'ReportController@indexModuleReportsMonthly']);
		Route::get('/export', ['as' => 'export', 'uses' => 'ReportController@indexModuleReportsExport']);
	});

	Route::group(['prefix'=>'user','as'=>'user.'], function(){
		Route::get('/', ['as' => 'index', 'uses' => 'ReportController@indexUserReports']);
	});
});

 Route::get('/get-session-login', function() {
	  
   	$test = Session::get('login_session_id');
   	echo $test;
});




