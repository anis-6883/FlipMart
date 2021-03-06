<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    public $timestamps = true;
    protected $dateFormat = 'Y-m-d H:i:s';
    protected $guarded = ['id'];

    public function subcategories(){
        return $this->hasMany(Subcategory::class);
    }

    public function sub_subcategories(){
        return $this->hasMany(Sub_Subcategory::class);
    }

    public function products(){
        return $this->hasMany(Product::class);
    }
}
