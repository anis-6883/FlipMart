<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    public $timestamps = true;
    protected $dateFormat = 'Y-m-d H:i:s';
    protected $guarded = ['id'];

    public function order_items(){
        return $this->hasMany(OrderItem::class);
    }

    public function coupon(){
        return $this->hasOne(Coupon::class);
    }

    public function order_detail(){
        return $this->hasOne(Order_Detail::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

}
