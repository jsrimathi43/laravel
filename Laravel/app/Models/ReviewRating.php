<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReviewRating extends Model
{
    use HasFactory;
    protected $fillable = [
        'order_id','comments','star_rating','status'
    ];
    public function orders()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }
}
