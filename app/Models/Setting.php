<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class SettingController
 *
 * @author  The scaffold-interface created at 2016-08-25 01:07:35am
 * @link  https://github.com/amranidev/scaffold-interface
 */
class Setting extends Model
{
	
	use SoftDeletes;

	protected $dates = ['deleted_at'];
    
	
    protected $table = 'settings';

	
}
