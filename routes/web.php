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
// Route::get('router', function () {
//     return view('router');
// });

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/router', 'RouterController@index')->name('router');

Route::post('/create', 'RouterController@store')->name('create');
Route::delete('/delete/{id}', 'RouterController@destroy')->name('delete');
Route::get('/edit/{id}', 'RouterController@edit')->name('edit');
Route::put('/update/{id}', 'RouterController@update')->name('update');

// Route::delete('/delete-company/{id}', 'CompanyController@destroy')->name('delete-company');

