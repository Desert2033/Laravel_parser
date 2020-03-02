<?php

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');

//Add_index
Route::get('/add', 'NewsController@addNews')->name('add');
Route::post('/add/submit', 'NewsController@addNewsSubmit')->name('add-form');
//

//Edit
Route::get('/edit/{id}', 'NewsController@editNews')->name('edit');
Route::post('/edit/{id}', 'NewsController@editNewsSubmit')->name('edit-form');
//
//Send to email
Route::post('/sendToEmail', 'NewsController@sendToEmail')->name('send-to-email');
//
//Search
Route::post('/search', 'NewsController@searchNews')->name('search-news');
//
//Change email
Route::get('/changeEmail', 'EmailController@changeEmail')->name('change-email');
Route::post('/changeEmail/submit', 'EmailController@changeEmailSubmit')->name('change-email-form');
//

Route::post('/delete', 'NewsController@deleteNews')->name('delete-form');
Route::get('/parse', 'NewsController@StartParseNews')->name('parse-news');
Route::get('/updateAll', 'NewsController@updateAllNews')->name('update-all-news');
