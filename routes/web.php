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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::prefix('admin')->group(function () {
    Route::group(['middleware' => ['auth:admin']], function () {
        Route::get('/', 'Admin\AdminController@index')->name('admin.dashboard');
        Route::get('/dashboard', 'Admin\AdminController@index')->name('admin.dashboard');
        Route::post('logout', 'Auth\Admin\LoginController@logout')->name('admin.auth.logout');
        Route::resource('author', 'Admin\AuthorController');
        Route::resource('trash', 'Admin\TrashController');
        Route::resource('trashbook', 'Admin\TrashBookController');
        Route::post('trash/restore/{id}' , 'Admin\TrashController@restore')->name('admin.trash.restore');
        Route::post('trashbook/restore/{id}' , 'Admin\TrashBookController@restore')->name('admin.trashbook.restore');
        Route::post('trash/forcedelete/{id}' , 'Admin\TrashController@forceDelete')->name('admin.trash.forcedelete');
        Route::post('trashbook/forcedelete/{id}' , 'Admin\TrashBookController@forceDelete')->name('admin.trashbook.forcedelete');
        Route::resource('root', 'Admin\RootController');
        Route::resource('book', 'Admin\BookController');
        Route::post('book/edit', 'Admin\BookController@editBook')->name('admin.book.edit');
        Route::post('root/edit', 'Admin\RootController@editAdmin')->name('admin.root.edit');
        Route::post('author/ajax', 'Admin\AuthorController@changeAjaxAuthor')->name('admin.author.ajax');
    });
    Route::get('register', 'Admin\AdminController@create')->name('admin.register');
    Route::post('register', 'Admin\AdminController@store')->name('admin.register.store');
    Route::get('login', 'Auth\Admin\LoginController@login')->name('admin.auth.login');
    Route::post('login', 'Auth\Admin\LoginController@loginAdmin')->name('admin.auth.loginAdmin');
});

Route::group(['middleware' => ['auth']], function () {
    Route::resource('borrow', 'BorrowController');
});