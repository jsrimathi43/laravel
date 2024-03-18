<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookingCalendarTask extends Model
{
    use HasFactory;
    protected $fillable = ['cal_name', 'cal_email', 'cal_contact','cal_from_time','cal_to_time','cal_guest','cal_message','booking_number','email_verified','booking_status'];

}
