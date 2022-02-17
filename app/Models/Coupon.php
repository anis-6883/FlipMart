<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $dateFormat = 'Y-m-d H:i:s';
    protected $fillable = [
        'coupon_title', 
        'coupon_code', 
        'discount_amount', 
        'created_at'
    ];
}
