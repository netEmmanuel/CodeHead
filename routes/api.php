<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
//list blog posts
Route::get('blogposts', 'BlogpostController@index');

//list single blog post
Route::get('blogpost/{id}', 'BlogpostController@show');

//create blog post
Route::post('blogpost', 'BlogpostController@store');

//update blog post
Route::put('blogpost', 'BlogpostController@store');

//delete blog post
Route::delete('blogpost/{id}', 'BlogpostController@destroy');