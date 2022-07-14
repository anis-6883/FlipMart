<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    public $timestamps = true;
    protected $dateFormat = 'Y-m-d H:i:s';
    protected $guarded = ['id'];

    public function category(){
        return $this->belongsTo(Category::class);
    }
    
    public function subcategory(){
        return $this->belongsTo(Subcategory::class);
    }

    public function sub_subcategory(){
        return $this->belongsTo(Sub_Subcategory::class);
    }

    public function brand(){
        return $this->belongsTo(Brand::class);
    }

    public function product_images(){
        return $this->hasMany(Product_Image::class);
    }

    public function product_detail(){
        return $this->hasOne(Product_Detail::class);
    }

    public function order_items(){
        return $this->hasMany(OrderItem::class);
    }

    public function reviews(){
        return $this->hasMany(Review::class);
    }
}
