<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\UuidModel;

class Tenant extends UuidModel
{
    //
    protected $table = 'tenant';
    public $incrementing = false;
    protected $fillable = ['org_name','subscription','org_id','billing_method'];

    public static function boot(){
    	parent::boot();
    }
}
