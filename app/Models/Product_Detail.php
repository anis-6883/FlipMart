<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product_Detail extends Model
{
    use HasFactory;
    protected $table = 'product_details';
    public $timestamps = true;
    protected $dateFormat = 'Y-m-d H:i:s';
    protected $guarded = ['id'];

    public function product(){
        return $this->belongsTo(Product::class);
    }
}
