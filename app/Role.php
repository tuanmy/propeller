<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\UuidModel;

class Role extends UuidModel
{
    protected $table = 'role';
    public $incrementing = false;
    public static function boot(){
    	parent::boot();
    }
}
