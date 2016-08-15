<?php

namespace UnrulyNatives\Helpers;


// use Illuminate\Auth\Authenticatable;
// use Illuminate\Auth\Passwords\CanResetPassword;
// use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
// use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
// use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
// use Illuminate\Database\Eloquent\Model;
// use Illuminate\Foundation\Auth\Access\Authorizable;
// use App\Role;
// use Laraveldaily\Quickadmin\Observers\UserActionsObserver;
// use Laraveldaily\Quickadmin\Traits\AdminPermissionsTrait;
// use Spatie\Permission\Traits\HasRoles;

trait UserExtensions  

{
    // use Authenticatable, Authorizable, CanResetPassword, AdminPermissionsTrait, HasRoles;


    /**
     * The database table used by the model.
     *
     * @var string
     */
    // protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    // protected $fillable = ['name', 'email', 'password', 'role_id'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    // protected $hidden = ['password', 'remember_token'];

    public static function boot()
    {
        parent::boot();

        // User::observe(new UserActionsObserver);
    }

    public function getGravatarnewAttribute() {
        $hash = md5(strtolower(trim($this->attributes['email'])));
        return "http://www.gravatar.com/avatar/$hash";
    }


}

