<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Usersetting extends Model
{
    protected $dates = ['deleted_at'];
    protected $table = 'user_settings';
    protected $fillable = [];

    public function user()
    {
        return $this->belongsTo(\App\User::class, 'user_id');
    }



}