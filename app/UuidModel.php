<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Uuid;

class UuidModel extends Model
{
    //

    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {

            $model->{$model->getKeyName()} = Uuid::generate(4);

        });
    }
}
