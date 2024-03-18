<?php

namespace App\Http\Controllers;

use App\Http\Requests\BookingCalendarTaskRequest;
use App\Models\BookingCalendarTask;
use App\Models\Event;
use Notification;
use Illuminate\Http\Request;
use App\Notifications\EmailNotification;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Events;

class BookingCalendarTaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tasks = BookingCalendarTask::all();
        return view('home', compact('tasks'));
    }

    public function create()
    {
        return view('calender.fullcalender');
    }

    public function store(BookingCalendarTaskRequest $request)
    {
        //Generate Random Number
        do {
            $booking_number = "RES-" . rand(1, 999);
        } while (!empty(BookingCalendarTask::where('booking_number', $booking_number)->first()));


        // var_dump(empty($request->start_date && $request->end_date));
        // echo"test";die;
        if (
            ($request->start_date != NULL && $request->end_date != NULL) &&
            !empty(($request->start_date && $request->end_date) &&
                ($request->cal_from_time != $request->cal_to_time))
        ) {
            //Insert Query
            $bookingevent = new BookingCalendarTask;
            $bookingevent->cal_name = $request->cal_name;
            $bookingevent->cal_email = $request->cal_email;
            $bookingevent->cal_contact = $request->cal_contact;
            $bookingevent->cal_from_time = $request->cal_from_time;
            $bookingevent->cal_to_time = $request->cal_to_time;
            $bookingevent->cal_guest = $request->cal_guest;
            $bookingevent->cal_message = $request->cal_message;
            $bookingevent->booking_number = $booking_number;
            $bookingevent->email_verified = 0;
            $bookingevent->booking_status = 1;
            $bookingevent->save();
            $event = Event::create([
                'event_id' => $bookingevent->id,
                'title' => $bookingevent->cal_name,
                'start' => $request->start_date,
                'end' => $request->end_date,
            ]);

            if ($bookingevent->id && $event->id) {
                $data = [
                    "id" => $bookingevent->id,
                    "email" => $bookingevent->cal_email,
                    "name" => $bookingevent->cal_name,
                    "mobile" => $bookingevent->cal_contact,
                    "date" => $event->start,
                    "fromTime" => $bookingevent->cal_from_time,
                    "toTime" => $bookingevent->cal_to_time,
                    "persons" => $bookingevent->cal_guest,
                    "bookingNumber" => $bookingevent->booking_number,
                    "comments" => $bookingevent->cal_message
                ];
                $this->send($data);
                DB::table('booking_calendar_tasks')
                    ->where('id', $bookingevent->id)
                    ->update(['email_verified' => "1"]);
                return redirect()->route('home');
            }
        } else {
            if ($request->cal_from_time == $request->cal_to_time) {
                return redirect('/#reservation')->withErrors(["Choose a different from and to time"])->withInput();
            } else {
                return redirect('/#reservation')->withErrors(["Choose a date"])->withInput();
            }
        }
    }
    public function send($data)
    {
        $user = $data['email'];

        $project = [
            'subject' => 'Thank you for your reservation',
            'greeting' => 'Hi ' . $data['name'] . ',',
            'body' => 'We are pleased to inform you that your booking <span>' . $data['bookingNumber'] . ' </span> is confirmed.</br>
            <div class="h5" style="padding:10px" ><b>Reservation details : </b></div></br>
            <div class="h5" style="padding-left: 10px;">Date : ' . $data['date'] . '</div></br>
            <div class="h5" style="padding-left: 10px;">Your check-in : ' . $data['fromTime'] . '</div></br>
            <div class="h5" style="padding-left: 10px;">Your check-out : ' . $data['toTime'] . '</div></br>
            <div class="h5" style="padding-left: 10px;">Your contact number : ' . $data['mobile'] . '</div></br>
            <div class="h5" style="padding-left: 10px;">Number of people : ' . $data['persons'] . '</div></br>
            <div class="h5" style="padding-left: 10px;">Comments : ' . $data['comments'] . '</div></br>',
            'thanks' => 'Thank you',
            'actionText' => 'View Booking',
            'actionURL' => url('/'),
            'id' => $data['id']
        ];
        Notification::route('mail', $user)->notify(new EmailNotification($project));
        // Notification::send($user, new EmailNotification($project));

        // dd('Notification sent!');
    }
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $bookingevent = BookingCalendarTask::findOrFail($id);
        return view('calendar.edit', compact('bookingevent'));
        // print"<prE>";print_r($bookingevent);die;
        // return redirect()->to('home');
        // $bookingevent = BookingCalendarTask::create($request->all());
        // $event = Event::create([
        //     'event_id' => $bookingevent->id,
        //     'title' => $bookingevent->cal_name,
        //     'start' => $request->start_date,
        //     'end' => $request->end_date,
        // ]);
        // return redirect()->route('home');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $bookingeventDetails = DB::table('booking_calendar_tasks')->select('*')->where('booking_number', '=', $request->get('booking_number'))->get();
        $id = $bookingeventDetails[0]->id;
        $bookingevent = DB::table('booking_calendar_tasks')
            ->where('id', $id)
            ->update(['booking_status' => "0", "email_verified" => "2"]);
        $user = $request->get('booking_email');
        $date = date('Y-m-d H:i:s');
        $project = [
            'subject' => 'Cancel for your reservation',
            'greeting' => 'Hi ' . $bookingeventDetails[0]->cal_name . ',',
            'body' => 'We are pleased to inform you that your booking <span>' . $request->get('booking_number') . ' </span> is confirmed.</br>
            <div class="h5" style="padding:10px" ><b>Reservation details : </b></div></br>
            <div class="h5" style="padding-left: 10px;">Date : ' . $date . '</div></br>
            <div class="h5" style="padding-left: 10px;">Your contact number : ' . $request->get('booking_contact') . '</div></br>
            <div class="h5" style="padding-left: 10px;">Comments : ' . $request->get('cancel_message') . '</div></br>',
            'thanks' => 'Thank you',
            'actionText' => 'View Booking',
            'actionURL' => url('/'),
            'id' => $id
        ];
        Notification::route('mail', $user)->notify(new EmailNotification($project));

        if ($bookingevent) {
            Session::flash('message', 'Updated Successfully');
        }

        return redirect()->route('home');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }


    /**
     * Display a listing of the resource.
     *
     */
    public function adminindex()
    {
        $this->data['bookingdetails'] = DB::table('booking_calendar_tasks as t1')->select('t2.start', 't2.end', 't1.*')->Join('events AS t2', 't2.event_id', '=', 't1.id')->get();
        // echo"<pre>";print_r($this->data['bookingdetails']);die;
        return view('admin.bookingcalendar.booking', $this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     */
    public function createbooking()
    {
        $this->data['headline'] = "Add New Booking";
        $this->data['mode']         = 'create';
        // $this->data['orders'] = Order::get();
        // $this->data['users'] = User::get();
        // $this->data['order'] = '';
        return view('admin.bookingcalendar.form', $this->data);
    }


    public function destroybooking($id)
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
        return redirect()->to('admin/bookingcalendar');
    }

     /**
     * Show the form for editing the specified resource.
     */
    public function editbooking(string $id)
    {
        $this->data['bookingdetails']        = BookingCalendarTask::findOrFail($id);
        return view('admin.bookingcalendar.form', $this->data);

        // $bookingevent = BookingCalendarTask::findOrFail($id);
        // return view('calendar.edit', compact('bookingevent'));
        // print"<prE>";print_r($bookingevent);die;
        // return redirect()->to('home');
        // $bookingevent = BookingCalendarTask::create($request->all());
        // $event = Event::create([
        //     'event_id' => $bookingevent->id,
        //     'title' => $bookingevent->cal_name,
        //     'start' => $request->start_date,
        //     'end' => $request->end_date,
        // ]);
        // return redirect()->route('home');
    }

     /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updatebooking(BookingCalendarTaskRequest $request, $id)
    {
        $bookingDetails         = BookingCalendarTask::find($id);
        // $order->address    = $request->get('address');
        // $order->city    = $request->get('city');
        // $order->country    = $request->get('country');
        // $order->post_code    = $request->get('post_code');
        // $order->phone_number    = $request->get('phone_number');
        // $order->notes    = $request->get('notes');
        // $order->status    = $request->get('status');
        // $order->user_id    = $request->get('user_id');
        $updateBooking  = DB::table('booking_calendar_tasks')->where('id', $id)->update(array('address' => $request->get('address'), 'city' => $request->get('city'), 'country' => $request->get('country'), 'post_code' => $request->get('post_code'), 'phone_number' => $request->get('phone_number'), 'notes' => $request->get('notes'), 'user_id' => $request->get('user_id'), 'status' => $request->get('status')));

        if ($updateBooking) {
            Session::flash('message', $bookingDetails->booking_number . ' Updated Successfully');
        }

        return redirect()->to('admin/bookingcalendar');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storebooking(BookingCalendarTaskRequest $request)
    {
        $formData = $request->all();
        // $formData['order_number'] = 'ORD-' . strtoupper(uniqid());
        // $formData['grand_total'] = 0;
        // $formData['item_count'] = 0;
        // $userDetails = User::find($formData['user_id']);
        // $formData['first_name'] = $userDetails->first_name;
        // $formData['last_name'] = $userDetails->last_name;
        if (BookingCalendarTask::create($formData)) {
            Session::flash('message', $formData['booking_number'] . ' Added Successfully');
        }

        return redirect()->to('admin/bookingcalendar');
    }
    
}
