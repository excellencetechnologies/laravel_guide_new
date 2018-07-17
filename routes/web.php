<?php
use App\UserData;
use App\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
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

Route::get('/ping', function(){
    return 'Pong';
});

Route::get('/info/{id}/{page?}', function($id, $page = null){
    if (!$page) {
        return 'This is the page with an id ' . $id;
    } else {
        return 'This is ' . $page . ' page with and id ' . $id;
    }
})->name('infopage');

Route::get('/v1/info', function(){
    return redirect()->route('infopage', ['id' => 1, 'page' => 'login']);
});

Route::get("/user", function(){
    return "hello";
});

Route::post("/user", function(){
    $data = new UserData();
    $data->firstname = Input::get('fname');
    $data->lastname = Input::get('lname');
    $data->email = Input::get('email');
    $data->password = Input::get('pass');
    $data->save();
    return $data;
});

Route::get('/user/{id}', function($id){
    $users = DB::table('login_users')->where('id', $id)->get();
    return $users;
});

Route::post('/user/{id}', function($id){
    $users = DB::table('login_users')->where('id', $id)->get();

    if(count($users) > 0){
        $data = new Profile();
        $data->user_id = $id;
        $data->address = Input::get('address');
        $data->postal_code = Input::get('postcode');
        $data->phone = Input::get('phone');
        $data->save();
        return $data;
        
    } else {
        return "User doesn't exist";
    }
});
