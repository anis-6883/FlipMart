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

    public function product_image(){
        return $this->hasMany(Product_Image::class);
    }
}
