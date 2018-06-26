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
	return view('home');
});

Auth::routes();

// Categories
Route::resource('categories', 'CategoryController');
// Only for logged in users
Route::get('categories/create', 'CategoryController@create')->name('categories.create')->middleware('auth');
Route::post('categories/store', 'CategoryController@store')->name('categories.store')->middleware('auth');
Route::get('categories', 'CategoryController@index')->name('categories.index')->middleware('auth');

// Practise
Route::get('/practise', 'PractiseController@index')->name('practise.index');
Route::post('/practise', 'PractiseController@store')->name('practise.store');
Route::get('/practise/{categoryId}', 'PractiseController@show')->name('practise.show');
// Additional
Route::get('/practise/{categoryId}/{cardId}', 'PractiseController@showPractise')->name('practise.show.practise');
Route::get('/practise/{categoryId}/{cardId}/show-full', 'PractiseController@showFull')->name('practise.show.full');
Route::post('/practise/save', 'PractiseController@save')->name('practise.save');


