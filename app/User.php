<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

use Spatie\Permission\Traits\HasRoles;
use Cmgmyr\Messenger\Traits\Messagable;
use Unrulynatives\Helpers\UserExtensions; // various extension such as gravatar
// use Unrulynatives\Helpers\ModelExtensions; // not ready yet
// use Unrulynatives\Attitudes\UserAttitudes; // upvoting system in separate package

class User extends Authenticatable
{
    use Notifiable;
    use HasRoles;
    use UserExtensions;
    // use UserAttitudes;
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
}
