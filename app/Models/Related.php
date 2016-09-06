<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use Slynova\Commentable\Traits\Commentable;
// use Watson\Rememberable\Rememberable;

class Related extends Model
{

    use Commentable;

    // use Rememberable;
    use SoftDeletes;

    protected $dates = ['deleted_at'];





    protected $connection = "niepozwalam";
    protected $table = "related";
    // protected $morphClass = 'related';
    protected $null_empty_attrs = ['name'];
    protected $fillable = [];



    public static $rules = array(
    'URL' => 'required|between:1,180|url'
    );

    public static $messages = array(
    'URL.required' => 'required!',
    'URL.between' => 'za długi URL!',
    'URL.url' => 'To nie jest URL!'

    );





    public function createdBy()
    {
            return $this->belongsTo (App\User::class, 'creator_id');
    }


}