<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subcategory extends Model
{
    use HasFactory;
    public $timestamps = true;
    protected $dateFormat = 'Y-m-d H:i:s';
    protected $fillable = ['category_id', 'subcategory_name'];

    public function category(){

        return $this->belongsTo(Category::class);
    }
    
    public function products(){

        return $this->hasMany(Product::class);
    }
}
