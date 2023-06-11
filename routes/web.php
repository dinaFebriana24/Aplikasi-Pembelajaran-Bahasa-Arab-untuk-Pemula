<?php

use Illuminate\Support\Facades\Route;

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



Auth::routes();

Route::get('/', function () {
    return redirect(route('login'));
});

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/account/profile', 'HomeController@profile')->name('profile');
Route::post('/account/profile/edit', 'HomeController@storeProfile')->name('profile-edit');
Route::post('/account/change-password', 'HomeController@changePassword')->name('change-password');


// MainKategori - Admin
Route::get('/admin/mainkategori', 'Admin\MainCategoriesController@index')->middleware('checkRole');
Route::post('/admin/mainkategori', 'Admin\MainCategoriesController@store')->middleware('checkRole');
Route::put('/admin/mainkategori/{name}', 'Admin\MainCategoriesController@update')->middleware('checkRole');
Route::delete('/admin/mainkategori/{name}', 'Admin\MainCategoriesController@destroy')->middleware('checkRole');

// Kategori - Admin
Route::get('/admin/kategori', 'Admin\CategoriesController@index')->middleware('checkRole');
Route::post('/admin/kategori', 'Admin\CategoriesController@store')->middleware('checkRole');
Route::put('/admin/kategori/{name}', 'Admin\CategoriesController@update')->middleware('checkRole');
Route::delete('/admin/kategori/{name}', 'Admin\CategoriesController@destroy')->middleware('checkRole');

// Materi - Admin
Route::get('/admin/materi', 'Admin\TheoriesController@index')->middleware('checkRole');
Route::post('/admin/materi', 'Admin\TheoriesController@store')->middleware('checkRole');
Route::put('/admin/materi/{id}', 'Admin\TheoriesController@update')->middleware('checkRole');
Route::delete('/admin/materi/{id}', 'Admin\TheoriesController@destroy')->middleware('checkRole');

// Kuis - Admin
Route::get('/admin/kuis', 'Admin\QuizController@index')->middleware('checkRole');
Route::post('/admin/kuis', 'Admin\QuizController@store')->middleware('checkRole');
Route::put('/admin/kuis/{id}', 'Admin\QuizController@update')->middleware('checkRole');
Route::delete('/admin/kuis/{id}', 'Admin\QuizController@destroy')->middleware('checkRole');

// User
Route::get('/{kategori}', 'User\PageController@materi');
Route::get('/{kategori}/quiz', 'User\PageController@quiz');
Route::post('/{kategori}/quiz/score', 'User\PageController@storeQuiz');
Route::get('/{kategori}/{materi}', 'User\PageController@materiDenganGambar');






