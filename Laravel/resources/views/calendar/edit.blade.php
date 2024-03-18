<form class="clnd d-none" action="{{route('calendar.fullcalender.store')}}" id="calendarSubmit">
    <div class="row mb-3">
      <label for="name" class="col-sm-4 form-label">Name</label>
      <div class="col-sm-8">
        <input type="text" class="form-control" id="name">
      </div>
    </div>
    <div class="row mb-3">
        <label for="email" class="col-sm-4 form-label">Email</label>
        <div class="col-sm-8">
          <input type="email" class="form-control" id="email">
        </div>
    </div>
    <div class="row mb-3">
        <label for="conatct" class="col-sm-4 form-label">Contact number</label>
        <div class="col-sm-8">
            <input type="text" class="form-control" id="conatct">
        </div>
    </div>
    <div class="row mb-3">
        <label for="date" class="col-sm-4 form-label">Date</label>
        <div class="col-sm-8">
            <input type="date" class="form-control" id="date">
        </div>
    </div>
    <div class="row mb-3">
        <label for="from_to_time" class="col-sm-4 form-label">Time</label>
        <div class="col-sm-8">
            <input type="text" class="form-control" id="from_to_time">
        </div>
    </div>
    <div class="row mb-3">
        <label for="guest" class="col-sm-4 form-label">Total guest</label>
        <div class="col-sm-8">
            <input type="number" class="form-control" id="guest">
        </div>
    </div>
    <div class="row mb-3">
        <label for="additional_data" class="col-sm-4 form-label">Additional information</label>
        <div class="col-sm-8">
            <input type="text" class="form-control" id="additional_data">
        </div>
    </div>
    <div class="col-12 calendar-form-btn">
        <div class="row clndr-rw">
            <div class="col-lg-6 confirm_btn">
                <button type="submit" id="confirm_btn" class="btn btn-dark w-100 fw-bold " disabled="disabled" >Confirm Booking</button>
            </div>
            <div class="col-lg-6 confirm_btn_1">
              <button type="submit" id="confirm_btn_1" class="btn btn-dark w-100 fw-bold" >Request Cancellation</button>
            </div>
        </div>
    </div>
</form>