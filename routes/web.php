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

//Route::get('/', function () {
//    $mains = \App\Models\Main::All();
//    $result = "";
//    foreach ($mains as $main) {
//        $result = $result . " " . $main->id . " " . $main->question. " " . $main->answer . "\n";
//    }
//});

Route::get('/', 'HomeController@index')
    ->name('home.index');

Route::get('/question/{id}', 'HomeController@question')
    ->name('home.question');

Route::get('/answer/{id}/{type}/{id_calc}', 'HomeController@answer')
    ->name('home.answer');

Route::get('/answer_guessed/{id}', 'HomeController@guessed')
    ->name('home.guessed');

Route::get('/create_answer/{parent_id}/{type}', 'HomeController@create_answer')
    ->name('home.create_answer');

Route::post('/store_answer', 'HomeController@store_answer')
    ->name('home.store_answer');

Route::get('/create_question/{parent_id}/{type}/{answer}', 'HomeController@create_question')
    ->name('home.create_question');

Route::post('/store_question', 'HomeController@store_question')
    ->name('home.store_question');

Route::get('/create_url/{parent_id}/{type}/{answer}/{question}', 'HomeController@create_url')
    ->name('home.create_url');

Route::post('/store_url', 'HomeController@store_url')
    ->name('home.store_url');

Route::post('/store_main', 'HomeController@store_main')
    ->name('home.store_main');





