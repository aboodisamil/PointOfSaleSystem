<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $guarded=[];
    public function user()
    {
        return $this->belongsTo(User::classs);
    }
    public  function  products()
    {
        return $this->belongsToMany(Product::class , 'product_orders');

    }
}
