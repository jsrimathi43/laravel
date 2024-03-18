<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeliveryPartner extends Model
{
    use HasFactory;
    protected $fillable = [
        'name','available_status','contact_number', 'role_id', 'email','vechicle_name','vechicle_number','password'
    ];
}
