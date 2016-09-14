<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class PackageController
 *
 * @author  The scaffold-interface created at 2016-08-15 08:39:53am
 * @link  https://github.com/amranidev/scaffold-interface
 */
class Package extends Model
{
    public $timestamps = false;

    protected $table = 'packages';
    
    public function importances() {
        return $this->hasMany(\App\Models\Userattitude::class, 'creator_id');
    }
    
    public function attitudes() {
        return $this->hasMany(\App\Models\Userattitude::class, 'creator_id');
    }


    public function user_approach($user)
    {
        return $this->morphMany(\App\Models\Userattitude::class, 'item')->where('creator_id', ($user ? $user->id : NULL))->first();
    }


    public function showAvatar()
    {
        return $this->morphMany(\App\Models\Avatar::class, 'item');
    }



	
}
