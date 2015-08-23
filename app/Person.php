<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\UuidModel;

class Person extends UuidModel
{
    //
    protected $table = 'person';
    public $incrementing = false;
    protected $fillable = ['firstname','middle','lastname','user_id','tenant_id'];

    public static function boot(){
    	parent::boot();
    }
}
