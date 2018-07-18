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
Route::post("/user", function(){
    $data = new UserData();
    $data->firstname = Input::get('fname');
    $data->lastname = Input::get('lname');
    $data->email = Input::get('email');
    $data->password = Input::get('pass');
    $data->save();
    return $data;
});

// Fetching User Details
Route::get('/user/{id}', function($id){
    $users = DB::table('login_users')->where('id', $id)->count();
    if($users > 0) {
        $user = UserData::find($id);
    } else {
        return "User doesn't exist.";
    }
    return $user;
});

// Creating User Profile
Route::post('/user/{id}', function($id){
    $users = DB::table('login_users')->where('id', $id)->count();
    
    if($users > 0){
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

// Updating User Profile
Route::put('/profile/{id}', function($id){
    $profile = Profile::find($id);  
    $profile->address = Input::get('address');
    $profile->postal_code = Input::get('postcode');
    $profile->phone = Input::get('phone');
    $profile->save();
    return $profile;
});

// Deleting User Profile
Route::delete('/user/profile/{id}', function($id){
    $profile = Profile::find($id)->delete();
    return "Profile Deleted.";
});

// Fetching User Profile
Route::get('/user/{id}/full', function($id){
    $user = DB::table('login_users')->where('id', $id)->count();

    if($user > 0){
        
        $profile = DB::table('profiles')->where('user_id', $id)->count();
        
        if($profile > 0){
            $user_profile = DB::table('login_users')
                                ->join('profiles', 'login_users.id', '=', 'profiles.user_id')
                                ->select(
                                    'login_users.id', 
                                    'login_users.firstname', 
                                    'login_users.lastname', 
                                    'login_users.email',
                                    'profiles.address',
                                    'profiles.postal_code',
                                    'profiles.phone'
                                )->where('login_users.id', $id)->get();
        } else {
            $user_profile = UserData::find($id);
        }

    } else {
        return "User doesn't exist.";
    }
    
    return $user_profile;
});