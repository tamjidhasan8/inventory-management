<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $guarded = [];

    public function images(){
        return $this->hasMany(ProductImage::class);
    }
    public function warehouse(){
        return $this->belongsTo(WareHouse::class, 'warehouse_id','id');
    }

    public function brand(){
        return $this->belongsTo(Brand::class, 'brand_id','id');
    }
}
