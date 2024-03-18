@extends('admin.layouts.app-master')

@section('content')

	<div class="row clearfix page_header">
		<div class="col-md-6">
			<h2> Booking Details</h2>		
		</div>
		<div class="col-md-6 text-right">
			<a class="btn btn-info" href="{{ route('bookingcalendars.create') }}"> <i class="fa fa-plus"></i> New Booking </a>
		</div>
	</div>

	<!-- DataTales Example -->
	  <div class="card shadow mb-4">
	    <div class="card-header py-3">
	      <h6 class="m-0 font-weight-bold text-primary">Booking Details</h6>
	    </div>
	    <div class="card-body">
	      <div class="table-responsive">
	        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
	          <thead>
	            <tr>
				  <th>Booking Number</th>
	              <th>Customer Name</th>
	              <th>Mail id</th>
	              <th>Contact Number</th>
	              <th>Booking Start Date</th>
	              <th>Booking Start Time</th>
	              <th>Booking End Date</th>
	              <th>Booking End Time</th>
	              <th>Person Count</th>
	              <th>Customer Coments</th>
	              <th>Mail Sent</th>
				  <th>Booking Status</th>
	              <th class="text-right">Actions</th>
	            </tr>
	          </thead>
	          <tbody>
	          	@foreach ($bookingdetails as $details)
		            <tr>
						<td> {{ $details->booking_number }} </td>
						<td> {{ $details->cal_name }} </td>
						<td> {{ $details->cal_email }} </td>
						<td> {{ $details->cal_contact }} </td>
						<td> {{ $details->start }} </td>
						<td> {{ $details->cal_from_time }} </td>
						<td> {{ $details->end }} </td>
						<td> {{ $details->cal_to_time }} </td>
						<td> {{ $details->cal_guest }} </td>
						<td> {{ $details->cal_message }} </td>
						<td> {{ $details->email_verified }} </td>
						<td> {{ $details->booking_status }} </td>
						<td class="text-right">
							<form method="POST" action=" {{ route('bookingcalendars.destroy', ['bookingcalendar' => $details->id]) }} ">
								<a class="btn btn-primary btn-sm" href="{{ route('bookingcalendars.edit', ['bookingcalendar' => $details->id]) }}"> 
									<i class="fa fa-edit"></i> 
								</a>
								@csrf
								@method('DELETE')
								<button onclick="return confirm('Are you sure?')" type="submit" class="btn btn-danger btn-sm"> 
									<i class="fa fa-trash"></i>  
								</button>	
							</form>
						</td>
		            </tr>
	            @endforeach
	          </tbody>
	        </table>
	      </div>
	    </div>
	  </div>
@stop