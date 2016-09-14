<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class FeatureController
 *
 * @author  The scaffold-interface created at 2016-08-15 09:55:54am
 * @link  https://github.com/amranidev/scaffold-interface
 */
class Feature extends Model
{
    public $timestamps = false;

    protected $table = 'features';



    public function importances() {
        return $this->hasMany(\App\Models\Userattitude::class, 'creator_id');
    }

    public function attitudes() {
        return $this->hasMany(\App\Models\Userattitude::class, 'creator_id');
    }


	
}
