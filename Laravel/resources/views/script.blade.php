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
        
        if($request->ajax()) {
       
             $data = Event::with('BookingCalendarTask')
                        ->whereDate('created_at', '>=', $request->start)
                       ->whereDate('end',   '<=', $request->end)
                       ->whereDate('title',   '=', $request->cal_name)
                       ->get();
             return response()->json($data);
        }
  
        return view('/home');
    }
    public function store(Request $request)
    {
        $bookingevent = BookingCalendarTask::create([
            'cal_name' => $request->cal_name,
            'cal_email' => $request->cal_email,
            'cal_contact' => $request->cal_contact,
            'cal_from_time' => $request->cal_from_time,
            'cal_to_time' => $request->cal_to_time,
            'cal_guest' => $request->cal_guest,
            'cal_message' => $request->cal_message,
        ]);
        Event::create([
            'event_id' => $bookingevent->id,
            'title' => $bookingevent->cal_name,
            'start' => $request->start,
            'end' => $request->end,
        ]);
        return redirect()->route('home');
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
              
              $bookingevent = BookingCalendarTask::create([
                'cal_name' => $request->cal_name,
                'cal_email' => $request->cal_email,
                'cal_contact' => $request->cal_contact,
                'cal_from_time' => $request->cal_from_time,
                'cal_to_time' => $request->cal_to_time,
                'cal_guest' => $request->cal_guest,
                'cal_message' => $request->cal_message,
            ]);
            $event = Event::create([
                'event_id' => $bookingevent->id,
                'title' => $bookingevent->cal_name,
                'start' => $request->start,
                'end' => $request->end,
            ]);
 
              return response()->json($event);
             break;
  
           case 'update':
              $event = Event::find($request->id)->update([
                  'title' => $request->title,
                  'start' => $request->start,
                  'end' => $request->end,
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





























$(document).ready(function () {

  /*------------------------------------------
  --------------------------------------------
  Get Site URL
  --------------------------------------------
  --------------------------------------------*/
  var SITEURL = "https://restaurant-laravel.brandcrock.com";

  /*------------------------------------------
  --------------------------------------------
  CSRF Token Setup
  --------------------------------------------
  --------------------------------------------*/
  $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
  });

  /*------------------------------------------
  --------------------------------------------
  FullCalender JS Code
  --------------------------------------------
  --------------------------------------------*/
  var calendar = $('#calendar').fullCalendar({
      editable: true,
      events: SITEURL + "/fullcalender",
      displayEventTime: false,
      // editable: true,
      // minDate: 0,
      eventRender: function (event, element, view) {
          // console.log(event);
          if (event.allDay === 'true') {
              event.allDay = true;
          } else {
              event.allDay = false;
          }
      },
      header: {
          left: 'prev,next',
          center: 'title',
          right: 'month,agendaWeek,agendaDay'
      },
      selectable: true,
      selectAllow: function(selectInfo) {
          return moment().diff(selectInfo.start) < 0
      },
      selectHelper: true,
      form: $("#calendarForm :input").prop("disabled", true),
      select: function (start, end, allDay) {
          var form = $("#calendarForm :input").prop("disabled", false);
          var title = $(".cal_name").val();
          var button = $("#btnOne").prop('disabled',true);
          // console.log(button);
          $("#btnOne").on("click", function(){
              if ($("input[name='cal_name']").val() != "" && 
                  $("input[name='cal_email").val() != "" && 
                  $("input[name='cal_contact").val() != "" && 
                  $("input[name='cal_from_time").val() != "" && 
                  $("input[name='cal_to_time").val() != "" && 
                  $("input[name='cal_guest").val() != "" && 
                  $("input[name='cal_message']").val() != "") {
                  var start = $.fullCalendar.formatDate(start, "Y-MM-DD");
                  var end = $.fullCalendar.formatDate(end, "Y-MM-DD");
                  // $("#btnOne").prompt("tests");
                  console.log(this);
                  $.ajax({
                      url: SITEURL + "/fullcalenderAjax",
                      data: {
                          title: $(".cal_name").val(),
                          start: start,
                          end: end,
                          type: 'add'
                      },
                      type: "POST",
                      success: function (data) {
                          displayMessage("Event Created Successfully");

                          calendar.fullCalendar('renderEvent',
                              {
                                  id: data.id,
                                  title: $(".cal_name").val(),
                                  start: start,
                                  end: end,
                                  allDay: allDay
                              }, true);

                          calendar.fullCalendar('unselect');
                      }
                  });
              }
          });
      },
      eventDrop: function (event, delta) {
          var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD");
          var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD");

          $.ajax({
              url: SITEURL + '/fullcalenderAjax',
              data: {
                  title: event.title,
                  start: start,
                  end: end,
                  id: event.id,
                  type: 'update'
              },
              type: "POST",
              success: function (response) {
                  displayMessage("Event Updated Successfully");
              }
          });
      },
      eventClick: function (event) {
          var deleteMsg = confirm("Do you really want to delete?");
          if (deleteMsg) {
              $.ajax({
                  type: "POST",
                  url: SITEURL + '/fullcalenderAjax',
                  data: {
                      id: event.id,
                      type: 'delete'
                  },
                  success: function (response) {
                      calendar.fullCalendar('removeEvents', event.id);
                      displayMessage("Event Deleted Successfully");
                  }
              });
          }
      }

  });
  function displayMessage(message) {
      toastr.success(message, 'Event');
  }
  var coll = document.getElementsByClassName("collapsible");
  var i;

  for (i = 0; i < coll.length; i++) {
      coll[i].addEventListener("click", function () {
          this.classList.toggle("active");
          var content = this.nextElementSibling;
          if (content.style.maxHeight) {
              content.style.maxHeight = null;
          } else {
              content.style.maxHeight = content.scrollHeight + "px";
          }
      });
  }

  // home calendar form

  $("#calendarForm").on("change", function(){
      // console.log("test");
      if(
      $("input[name='cal_name']").val() != "" && 
      $("input[name='cal_email").val() != "" && 
      $("input[name='cal_contact").val() != "" && 
      $("input[name='cal_from_time").val() != "" && 
      $("input[name='cal_to_time").val() != "" && 
      $("input[name='cal_guest").val() != "" && 
      $("input[name='cal_message']").val() != "")
      {
          $("#btnOne").removeAttr("disabled");
      }
  });

});

