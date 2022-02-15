<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $dateFormat = 'Y-m-d H:i:s';
    protected $fillable = [
        'category_id',
        'subcategory_id',
        'product_status',
        'product_name',
        'product_summary',
        'product_description',
        'product_regular_price',
        'product_quantity',
        'created_at'
    ];
}
