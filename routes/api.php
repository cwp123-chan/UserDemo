<?php

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/users', function (Request $request) {
    $response = factory(User::class,20)->create();
    return $response;
});
Route::get('/login','UserController@user');
Route::get('/articles','ArticlesController@articles');
Route::post('/articles/create','ArticlesController@create');
Route::post('/articles/update','ArticlesController@up');
Route::post('/articles/delete','ArticlesController@delete');



