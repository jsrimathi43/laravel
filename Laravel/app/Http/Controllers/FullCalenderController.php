<?php
  
namespace App\Http\Controllers;

use App\Models\BookingCalendarTask;
use Illuminate\Http\Request;
use App\Models\Event;
use Illuminate\Http\JsonResponse;

class FullCalenderController extends Controller
{
    /**
     * Write code on Method
     * @param  \Illuminate\Http\Request  $request
     */
    public function index(Request $request)
    {
        
      // if($request->ajax()) {
      //   $data = Event::all();
      //   return response()->json($data);
      // }

      // return view('/home');
    }
 
    /**
     * Write code on Method
     * @param  \Illuminate\Http\Request  $request
     */
    public function fullcalendarajax(Request $request)
    {
        // echo"test<pre>";
        // print_r($request);
        // die;
        // print"<prE>";print_r(Event::with(['booking_calendar_tasks'])->get());die;
        switch ($request->type) {
           case 'add':
              
              $bookingevent = BookingCalendarTask::all();
                $event = Event::create([
                'event_id' => $bookingevent->id,
                'title' => $bookingevent->cal_name,
                'start' => $request->start_date,
                'end' => $request->end_date,
            ]);
              // print"<pre>";print_r($event);die;
              return response()->json($event);
             break;
  
           case 'update':
              $event = Event::find($request->id)->update([
                  'title' => $request->title,
                  'start' => $request->start_date,
                  'end' => $request->end_date,
              ]);
 
              return response()->json($event);
             break;
  
           case 'delete':
              $event = Event::find($request->id)->delete();
  
              return response()->json($event);
             break;
             
           default:
             # code...
             break;
        }
    }
}