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

Route::resource('cards', 'CardController');
Route::resource('categories', 'CategoryController');
Route::resource('practise', 'PractiseController');

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::any('/practise/{categoryId}/{cardId}', 'PractiseController@showPractise')->name('practise.show.practise');
Route::any('/practise/{categoryId}/{cardId}/show-full', 'PractiseController@showFull')->name('practise.show.full');