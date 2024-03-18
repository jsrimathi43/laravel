<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

      protected $fillable = [

        'event_id','title', 'start', 'end','task_date'

    ];
    public function bookingCalendarTask()
    {
        return $this->belongsTo(BookingCalendarTask::class);
    }

}