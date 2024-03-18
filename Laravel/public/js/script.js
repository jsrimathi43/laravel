$(document).ready(function () {

    /*------------------------------------------
    --------------------------------------------
    Get Site URL
    --------------------------------------------
    --------------------------------------------*/
    var SITEURL = "https://localhost:8000";

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
        minDate: new Date(),
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
        selectAllow: function (selectInfo) {
            return moment().diff(selectInfo.start) < 0
        },
        selectHelper: true,
        // form: $("#calendarForm :input").not('.btnTwo, :hidden').prop("disabled", true),
        select: function (start, end, allDay) {
            // var form = $("#calendarForm :input").not('.btnTwo, :hidden').prop("disabled", false);
            // var title = $(".cal_name").val();
            // var button = $("#booktBtn").prop('disabled', true);
            var start = $.fullCalendar.formatDate(start, "Y-MM-DD");
            var end = $.fullCalendar.formatDate(end, "Y-MM-DD");
            // var cal_name = $("input[name='cal_name']").val();
            // $("#name").val(cal_name);
            $("#start_date").val(start);
            $("#end_date").val(end);
            // $("#calendarSubmit").css("display","none");
            $("#booktBtn").on("click", function () {
                // $("#calendarSubmit").css("display","block");
                if ($("input[name='cal_name']").val() != "" &&
                    $("input[name='cal_email").val() != "" &&
                    $("input[name='cal_contact").val() != "" &&
                    $("input[name='cal_from_time").val() != "" &&
                    $("input[name='cal_to_time").val() != "" &&
                    $("input[name='cal_guest").val() != "" &&
                    $("input[name='cal_message']").val() != "") {
                    e.preventDefault();
                    $.ajax({
                        url: SITEURL + "/fullcalenderAjax",
                        data: {
                            title: $("input[name='cal_name']").val(),
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
                                    title: $("input[name='cal_name']").val(),
                                    start: start,
                                    end: end,
                                    allDay: allDay
                                }, true);

                            calendar.fullCalendar('unselect');
                        },
                        error: function (jqXhr, data, errorThrown) {
                            var errors = jqXhr.responseJSON;
                            var errorsHtml = '';
                            $.each(errors, function (key, value) {
                                errorsHtml += '<li>' + value[0] + '</li>';
                            });
                            toastr.error(errorsHtml, "Error " + jqXhr.status + ': ' + errorThrown);
                        }
                    });
                }
            });
        },
        eventDrop: function (event, delta) {
            var start = $("#start_date").val();
            var end = $("#end_date").val();

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

    // $(document).ready(function() {
    $("#btnTwo").click(function() {
        $(".container_slideUp").addClass("show");
    });
    
    $("#confirmCancel").click(function(e) {
        $(".container_slideUp").removeClass("show");
        e.preventDefault();
    });
    // });

});
