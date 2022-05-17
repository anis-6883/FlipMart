<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sub_Subcategory extends Model
{
    use HasFactory;
    protected $table = 'sub_subcategories';
    public $timestamps = true;
    protected $dateFormat = 'Y-m-d H:i:s';
    protected $fillable = ['category_id', 'subcategory_id', 'sub_subcategory_name'];

    public function category(){
        return $this->belongsTo(Category::class);
    }
    
    public function subcategory(){
        return $this->belongsTo(Subcategory::class);
    }

    public function products(){
        return $this->hasMany(Product::class);
    }
}
