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

Route::get('/test','TestController@index');

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


Route::get('/admin','AdminController@index');
Route::get('/admin/create','AdminController@create');
Route::post('/admin/store','AdminController@store');
Route::get('/admin/albums/?{albumId}', 'AdminController@showalbums');
Route::get('/admin/artists/?{artistId}', 'AdminController@showartists');

Route::get('/albums/show/{id}','AlbumController@show');
Route::get('/artists/show/{id}', 'ArtistController@show');