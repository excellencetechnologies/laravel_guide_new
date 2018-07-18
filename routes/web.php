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

Route::get('/', function () {
    return view('welcome');
});

// Ping Pong
Route::get('/ping', function(){
    return 'Pong';
});

// Named Route with optional parameters
Route::get('/info/{id}/{page?}', function($id, $page = null){
    if (!$page) {
        return 'This is the page with an id ' . $id;
    } else {
        return 'This is ' . $page . ' page with and id ' . $id;
    }
})->name('infopage');

// Redirect to named route
Route::get('/v1/info', function(){
    return redirect()->route('infopage', ['id' => 1, 'page' => 'login']);
});

Route::get("/user", function(){
    return "hello";
});

// Creating User
Route::post("/user", 'UserController@createUser');

// Fetching User Details
Route::get('/user/{id}', 'UserController@showUser');

// Creating User Profile
Route::post('/user/{id}', 'UserController@createUserProfile');

// Updating User Profile
Route::put('/profile/{id}', 'UserController@updateUserProfile');

// Deleting User Profile
Route::delete('/user/profile/{id}', 'UserController@deleteUserProfile');

// Fetching User Profile
Route::get('/user/{id}/full', 'UserController@showUserProfile');