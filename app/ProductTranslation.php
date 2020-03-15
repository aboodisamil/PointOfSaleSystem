<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductTranslation extends Model
{

    public $timestamps = false;
    protected $fillable = ['name' , 'description'];

    public function getNameAttribute($value)
    {
        return ucfirst($value);
    }
    //
}
