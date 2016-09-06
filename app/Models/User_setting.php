<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class User_settingController
 *
 * @author  The scaffold-interface created at 2016-08-25 01:06:16am
 * @link  https://github.com/amranidev/scaffold-interface
 */
class User_setting extends Model
{
	
	use SoftDeletes;

	protected $dates = ['deleted_at'];
    
	
    protected $table = 'user_settings';

    public function user()
    {
        return $this->belongsTo(\App\User::class, 'user_id');
    }
	
}
