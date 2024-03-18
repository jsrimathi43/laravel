<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = ['date', 'amount', 'note', 'user_id'];
    public function admin()
    {
    	return $this->belongsTo(Admin::class);
    }
}