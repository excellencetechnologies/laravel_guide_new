<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserData extends Model
{
    protected $table = 'login_users';

    public $primaryKey = 'id';

    public function profile(){
        return $this->hasMany('App\Profile');
    }
}
