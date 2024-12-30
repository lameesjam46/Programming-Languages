<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $guarded=[];
    public function product_color_size(){
        return $this->belongsTo(product_color_size::class,'cartToOrder');
    }
}
