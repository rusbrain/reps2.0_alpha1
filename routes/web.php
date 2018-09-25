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

Route::get('/', 'HomeController@index');
Route::post('/login', 'Auth\LoginController@userLogin')->name('login');

//Auth::routes();
Route::get('/password/update', 'Auth\ResetPasswordController@updateOldPassword')->name('post_update_password');
Route::get('/password/new/{token}', 'Auth\ResetPasswordController@viewNewPassword')->name('update_old_password');
Route::post('/password/new/', 'Auth\ResetPasswordController@saveNewPassword')->name('save_new_password');

Route::get('info.php', 'UserController@show');
