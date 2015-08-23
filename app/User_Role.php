<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\UuidModel;

class User_Role extends UuidModel
{
    protected $table = 'user_role';
    public $incrementing = false;
    protected $fillable = ['user_id','role_id','org_id','tenant_id'];

    public static function boot(){
    	parent::boot();
    }

}
