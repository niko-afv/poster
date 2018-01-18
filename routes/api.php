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

Route::post('/authenticate', function(Request $request){
    /*
    $user = \App\User::where('id',$request->user_id)
        ->where('token', $request->token)
        ->first()
    ;
    */
    $user = \App\User::count();
    /*
    DB::enableQueryLog();
    $user = DB::table("users")->where('id',$request->user_id)
        ->where('token', $request->token)->get();
    $query = DB::getQueryLog();
    $query = end($query);
    print_r($query);
    */


    return response()->json([
        'success' => (! is_null($user))?true:false,
        'data' => $user,
        'message' => (is_null($user))?'No user with auth data':'login succeed'
    ]);
});

Route::resource('users', 'UsersController');
Route::resource('users.pages', 'UsersPagesController');
Route::resource('posts', 'PostsController');
Route::resource('pages', 'PagesController');
Route::resource('photos', 'PhotosController');
Route::resource('accounttypes', 'AccountTypesController');
Route::get('fanpages', 'FanPagesController@index');



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