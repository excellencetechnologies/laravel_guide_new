<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $table = 'profiles';

    public $primaryKey = 'id';

    protected $fillable = [
        'address', 'postal_code', 'phone',
    ];

    public function user(){
        return $this->belongsTo('App\UserData');
    }
}
