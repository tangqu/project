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

Route::get('/test',function () {
	return 'this is a test';
});
Route::get('/test3',function () {
	return 'this is a test3333333333';
});
Route::get('/test444',function () {
	return 'this is a test5555555
});Route::get('/test5555',function () {
	return 'this is a test5553';
});Route::get('/test666',function () {
	return 'this is a test36666';
});