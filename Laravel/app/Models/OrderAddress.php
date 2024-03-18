<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderAddress extends Model
{
    use HasFactory;
    protected $fillable = [
        'delivery_collection_time','order_id','billing_country_id','billing_state_id','billing_city_id','billing_street','shipping_street','billing_zip_code',
        'shipping_zip_code','billing_phone_number','shipping_phone_number','shipping_country_id','shipping_state_id','shipping_city_id','email_id','delivery_time',
        'billing_first_name','billing_last_name', 'shipping_first_name','shipping_last_name','notes'
    ];
}
