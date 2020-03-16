<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use \Dimsav\Translatable\Translatable;
    protected $guarded = [];
    public $translatedAttributes = ['name' , 'description'];
    protected $appends=['profit_percent'];

    public  function  getProfitPercentAttribute()
    {
        $profit=$this->sale_price - $this->purchase_price;
        $profit_percent=$profit*100 / $this->purchase_price;
//        return $profit_percent;
return number_format($profit_percent ,2);
    }
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public  function getImageAttribute($image)
    {
        return asset($image) ;

    }

    public  function  orders()
    {
        return $this->belongsToMany(Order::class , 'product_orders');
    }
}
