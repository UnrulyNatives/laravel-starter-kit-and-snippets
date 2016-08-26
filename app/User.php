<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;
use Unrulynatives\Helpers\UserExtensions;
use Cmgmyr\Messenger\Traits\Messagable;

class User extends Authenticatable
{
    use Notifiable;
    use HasRoles;
    use UserExtensions;
    use Messagable;

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
    
    
    // public function settings() {
    //     return $this->hasMany('App\Models\Usersetting', 'user_id');
    // }
    

    public function usersettings()
    {

        return $this->belongsToMany('App\Models\Setting', 'user_settings', 'user_id', 'setting_id')->withTimestamps();
    }


    public function activitiesDone()
    {
        // $this->belongsToMany('App\Models\Activity')->withPivot('done_at');

        // return $this->belongsToMany('App\Models\Activity')->withPivot('done_at')->wherePivot('done_at','=', null);
        return $this->belongsToMany('App\Models\Activity')->withPivot('done_at')->whereNotNull('done_at');
        // $this->activities()->wherePivot('done_at','=', null)->get();

    }


}
