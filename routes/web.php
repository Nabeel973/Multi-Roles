<?php

auth()->loginUsingId(5);


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
})->middleware('can:edit_form');
Route::get('/reports', function () {
    return 'Secret Reports';
})->middleware('can:view_reports');