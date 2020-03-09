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

Route::get('/', 'WelcomeController@index');

Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')->name('home');

Route::view('/register', 'auth.register')->middleware('guest')->name('register');
Route::post('/register', 'RegisterController@register')->name('register');

Route::view('/login', 'auth.login')->middleware('guest')->name('login');
Route::post('/logout', function () { Auth::logout(); \Illuminate\Support\Facades\Cookie::forget('username'); return redirect('/'); })->name('logout');
Route::post('/authenticate', 'LoginController@authenticate')->name('authenticate');

Route::get('/verify/{userid}', 'VerificationController@index')->middleware('guest')->name('verify');
Route::post('/verifyTwoFactor', 'VerificationController@verify')->middleware('guest')->name('verifyTwoFactor');
Route::get('/resend/{userid}', 'VerificationController@resend')->middleware('guest')->name('resend');

Route::get('/post', 'PostController@index')->name('post');
Route::get('/post/show/{post}', 'PostController@show')->name('show');
Route::get('/post/create', 'PostController@create')->name('create');
Route::post('/post/create', 'PostController@store')->name('create');
Route::get('/post/edit/{post}', 'PostController@edit')->name('showEdit');
Route::put('/post/edit{post}', 'PostController@update')->name('edit');
Route::delete('/post/delete/{post}', 'PostController@destroy')->name('delete');
Route::get('/post/addImage/{post}', 'PostController@showAddImage')->name('showAddImage');
Route::post('/post/addImage/{post}', 'PostController@addImage')->name('addImage');
Route::delete('/post/delete/image/{postImage}', 'PostController@deleteImage')->name('deleteImage');

Route::post('/search', 'WelcomeController@search')->name('search');
