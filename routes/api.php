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

Route::get('/{user_id}/{token}', function ($user_id, $token){
    return response()->json([
        'success' => true,
        'message' => 'Login With Facebook Succeed',
        'data' => [
            'access_token' => $token,
            'user_id' =>$user_id
        ]
    ]);
});

Route::resource('posts', 'PostsController');
Route::resource('pages', 'PagesController');
Route::resource('photos', 'PhotosController');
Route::resource('accounttypes', 'AccountTypesController');
Route::get('fanpages/{token}', 'FanPagesController@index');
