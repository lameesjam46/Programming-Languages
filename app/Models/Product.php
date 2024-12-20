<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Product extends Model
{
    use HasFactory, Notifiable;
    protected $guarded=[];
    public function product_color_size()
    {
        return $this->hasMany(product_color_size::class);
    }
    public function store(){
        return $this->belongsTo(Store::class);
    }
    public function cart(){
        return $this->hasMany(cart::class);
    }
}
