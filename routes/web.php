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


Route::get('/admin','AdminController@index');
Route::get('/admin/create','AdminController@create');
Route::post('/admin/store','AdminController@store');
Route::get('/admin/albums/?{albumId}', 'AdminController@showalbums');
Route::get('/admin/artists/?{artistId}', 'AdminController@showartists');

Route::get('/artists','ArtistController@index');
Route::get('/artists/create','ArtistController@create');
Route::post('/artists','ArtistController@store');
Route::get('/artists/{id}','ArtistController@show');
Route::get('/artists/{id}/edit','ArtistController@edit');
Route::put('/artists/{id}','ArtistController@update');
Route::delete('/artists/{id}','ArtistController@destroy');

Route::get('/albums','AlbumController@index');
Route::get('/albums/create/{id}','AlbumController@create');
Route::post('/albums','AlbumController@store');
Route::get('/albums/{id}','AlbumController@show');
Route::get('/albums/{id}/edit','AlbumController@edit');
Route::put('/albums/{id}','AlbumController@update');
Route::patch('/albums/{id}/{number}','AlbumController@updateSong');
Route::delete('/albums/{id}','AlbumController@destroy');
Route::delete('/albums/song/{id}','AlbumController@destroySong');

Route::get('/search', function(){
    return view('search');
});
Route::post('/search/{key}', 'SearchController@show');

Route::get('/searchtest/{key}', 'SearchController@show');

Route::post('/upload/albumpic/{id}', 'UploadController@storeAlbumPic');
Route::post('/upload/artistpic/{id}', 'UploadController@storeArtistPic');
Route::post('/upload/songs/{id}', 'UploadController@storeSongs');

Route::get('/upload/test','UploadController@storeTest');

Route::get('/mylib', function(){
    return view('yourlib');
});
Route::get('/yourlib', 'YourLibController@index');
Route::get('/playlists/{id}','YourLibController@show');
Route::post('/playlists','YourLibController@store');
Route::post('/playlists/element','YourLibController@storeElemtent');
Route::put('/playlists/{id}','YourLibController@update');
Route::delete('/playlists/{id}','YourLibController@destroy');
Route::delete('/playlists/element/{id}','YourLibController@destroyElement');

Route::get('/profile/me', 'UserController@me');
Route::get('/profile/{id}','UserController@show');
Route::patch('/profile','UserController@changePassword');
Route::delete('/profile/me','UserController@destroyMe');
Route::delete('/profile/{id}','UserController@destroy');

