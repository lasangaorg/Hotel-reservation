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
