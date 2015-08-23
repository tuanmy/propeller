<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Organization extends UuidModel
{
    protected $table = 'organization';
    public $incrementing = false;
     protected $fillable = ['name'];

    public static function boot(){
    	parent::boot();
    }
}
