<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Http\Requests\BookingCalendarTaskRequest;
use App\Http\Requests\OrderItemRequest;
use App\Models\Auth\User;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use App\Models\BookingCalendarTask;
use App\Models\Event;

class BookingCalendarAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */
    public function index()
    {
        $this->data['bookingdetails'] = DB::table('booking_calendar_tasks as t1')->select('t2.start', 't2.end', 't1.*')->Join('events AS t2', 't2.event_id', '=', 't1.id')->get();
        return view('admin.bookingcalendar.booking', $this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     */
    public function create()
    {
        $this->data['headline'] = "Add New Booking";
        $this->data['mode']         = 'create';
        return view('admin.bookingcalendar.form', $this->data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BookingCalendarTaskRequest $request)
    {
        $formData = $request->all();
        $formData['booking_number'] = "RES-" . rand(1, 999);
        $formData['email_verified'] = 1;
        $formData['booking_status'] = 1;

        if ($bookingDetails = BookingCalendarTask::create($formData)) {
            $date = date("Y-m-d", strtotime('+1 day', strtotime($formData['start'])));
            Event::create([
                'event_id' => $bookingDetails->id,
                'title' => $bookingDetails->cal_name,
                'start' => $formData['start'],
                'end' => $date
            ]);
            Session::flash('message', $formData['booking_number'] . ' Added Successfully');
        }

        return redirect()->to('admin/bookingcalendars');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     */
    public function edit($id)
    {
        $this->data['mode']         = 'edit';
        $this->data['headline']     = 'Update Booking';
        $this->data['bookingdetails']        = BookingCalendarTask::findOrFail($id);
        $eventDetails = DB::table('events')->select('*')->where('event_id', '=', $id)->get();
        $this->data['bookingdetails']['start']        = $eventDetails[0]->start;
        $this->data['bookingdetails']->cal_from_time = date("H:i", strtotime($this->data['bookingdetails']->cal_from_time));
        $this->data['bookingdetails']->cal_to_time = date("H:i", strtotime($this->data['bookingdetails']->cal_to_time));
        return view('admin.bookingcalendar.form', $this->data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(BookingCalendarTaskRequest $request, $id)
    {
        $bookingDetails         = BookingCalendarTask::find($id);
        $updateBooking  = DB::table('booking_calendar_tasks')->where('id', $id)->update(array('cal_name' => $request->get('cal_name'), 'cal_email' => $request->get('cal_email'), 'cal_contact' => $request->get('cal_contact'), 'cal_guest' => $request->get('cal_guest'), 'cal_from_time' => $request->get('cal_from_time'), 'cal_to_time' => $request->get('cal_to_time'), 'cal_message' => $request->get('cal_message')));
        $end_date = date("Y-m-d", strtotime('+1 day', strtotime($request->get('start'))));
        $updateEvents  = DB::table('events')->where('event_id', $id)->update(array('start' => $request->get('start'), 'title' => $request->get('cal_name'), 'end' => $end_date));

        if ($updateBooking && $updateEvents) {
            Session::flash('message', $bookingDetails->booking_number . ' Updated Successfully');
        }

        return redirect()->to('admin/bookingcalendars');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (BookingCalendarTask::find($id)->delete()) {
            if (!empty($id)) {
                $eventDetails = DB::table('events')->select('id')->where('event_id', '=', $id)->get();
                foreach ($eventDetails as $event) {
                    Event::find($event->id)->delete();
                }
            }
            Session::flash('message', 'Booking Details Deleted Successfully');
        }
        return redirect()->to('admin/bookingcalendars');
    }
}
