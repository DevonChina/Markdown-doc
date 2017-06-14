<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', function () {
    $articles = App\Article::all();
    return view('home', compact('articles'));
})->name('home');

//文章路由
Route::resource('articles','ArticlesController');
//Markwodn 解析
Route::post('markdown', 'ArticlesController@markdown')->name('markdown');