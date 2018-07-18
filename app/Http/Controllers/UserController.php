<?php

namespace App\Http\Controllers;

use DB;
use App\UserData;
use App\Profile;
use Illuminate\Http\Request;

class UserController extends Controller
{
    // Creating User
    public function createUser(Request $request)
    {
        $data = new UserData();
        $data->firstname = $request->input('fname');
        $data->lastname = $request->input('lname');
        $data->email = $request->input('email');
        $data->password = $request->input('pass');
        $data->save();
        return $data;
    }

    // Fetching User Details
    public function showUser($id)
    {
        $users = DB::table('login_users')->where('id', $id)->count();
        if($users > 0) {
            $user = UserData::find($id);
        } else {
            return "User doesn't exist.";
        }
        return $user;
    }

    // Creating User Profile
    public function createUserProfile(Request $request, $id)
    {
        $users = DB::table('login_users')->where('id', $id)->count();
    
        if($users > 0){
            $data = new Profile();
            $data->user_id = $id;
            $data->address = $request->input('address');
            $data->postal_code = $request->input('postcode');
            $data->phone = $request->input('phone');
            $data->save();
            return $data;
            
        } else {
            return "User doesn't exist";
        }
    }

    // Updating User Profile
    public function updateUserProfile(Request $request, $id)
    {
        $prof = DB::table('profiles')->where('id', $id)->count();

        if($prof > 0){
            $profile = Profile::find($id);  
            $profile->address = $request->input('address');
            $profile->postal_code = $request->input('postcode');
            $profile->phone = $request->input('phone');
            $profile->save();
            return $profile;

        } else {
            return "Profile doesn't exist.";
        }
        
    }

    // Deleting User Profile
    public function deleteUserProfile($id)
    {
        $prof = DB::table('profiles')->where('id', $id)->count();

        if($prof > 0){
            $profile = Profile::find($id)->delete();
            return "Profile Deleted.";  
            
        } else {
            return "Profile doesn't exist.";
        }
        
    }

    // Fetching User Profile
    public function showUserProfile($id)
    {
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
    }

    
}
