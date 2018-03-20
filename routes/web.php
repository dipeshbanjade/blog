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

/*Route::get('/', function () {
    return view('welcome');
});*/
Auth::routes();
Route::get('/', 'BlogController@index');
Route::get('/home', 'HomeController@index')->name('home');
Route::post('/blog/save', 'BlogController@store')->name('saveBlog');
Route::get('/blog/delete/{id}', 'BlogController@destroy')->name('blogDelete');
Route::get('/userBlog', 'BlogController@userBlog')->name('userBlog');
Route::get('/userBlog/edit/{id}', 'BlogController@edit')->name('editBlog');
Route::post('/userBlog/update', 'BlogController@update')->name('updateBlog');
// Route::resource('/blog','BlogController');
