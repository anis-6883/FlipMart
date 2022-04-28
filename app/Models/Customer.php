<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    public $timestamps = true;
    protected $dateFormat = 'Y-m-d H:i:s';
    protected $fillable = ['customer_name', 'customer_email', 'password', 'customer_status'];
    // protected $guarded = ['id'];
    
}
