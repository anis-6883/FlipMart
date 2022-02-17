<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $dateFormat = 'Y-m-d H:i:s';
    protected $fillable = ['category_name'];

    public function category_subcategories(){
        return $this->hasMany(Subcategory::class);
    }
}