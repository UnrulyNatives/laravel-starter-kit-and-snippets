<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;
use Unrulynatives\Helpers\UserExtensions;
// use Spatie\Activitylog\Models\Activity; // used for user tranking tool

class User extends Authenticatable
{
    use Notifiable;
    use HasRoles;
    use UserExtensions;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];





    public function getGravatarAttribute() {
        $hash = md5(strtolower(trim($this->attributes['email'])));
        return "http://www.gravatar.com/avatar/$hash";
    }


    public function activity() {
        return $this->hasMany('Activity', 'causer_id');
    }
    
}
