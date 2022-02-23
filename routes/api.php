<?php

use App\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::namespace('Api')->group(function() {
    //Post Archive
    Route::get('/posts', 'PostController@index');
    
    //single post detail
    Route::get('/posts/{slug}', 'PostController@show');

    // Contact
    Route::get('/contacts', 'ContactController@index');
    Route::post('/contacts', 'ContactController@store');
});
