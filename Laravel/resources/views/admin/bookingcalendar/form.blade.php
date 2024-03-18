@extends('admin.layouts.app-master')
@section('content')

@if ($errors->any())
<div class="alert alert-danger">
	<ul>
		@foreach ($errors->all() as $error)
		<li>{{ $error }}</li>
		@endforeach
	</ul>
</div>
@endif

<div class="card shadow mb-4">
	<div class="card-header py-3">
		<div class="card-header py-3">
		<div class="row clearfix page_header">
        <div class="col-md-6">
        <h6 class="m-0 font-weight-bold text-primary">{{ $headline }}</h6>
        </div>
        <div class="col-md-6 text-right">
            <a class="btn btn-primary" href="{{ url('admin/bookingcalendars') }}"> <i class="fa fa-arrow-left" aria-hidden="true"></i>
                Back </a>
        </div>
    </div>
	</div>
	<div class="card-body">
		<div class="row justify-content-md-center">
			<div class="col-md-8">
				@if($mode == 'edit')
				{!! Form::model($bookingdetails, [ 'route' => ['bookingcalendars.update', $bookingdetails->id], 'method' => 'put',"enctype" => "multipart/form-data" ]) !!}
				@else
				{!! Form::open([ 'route' => 'bookingcalendars.store', 'method' => 'post', "enctype" => "multipart/form-data" ]) !!}
				@endif
				<div class="form-group row">
					<label for="cal_name" class="col-sm-3 col-form-label">Customer Name <span class="text-danger">*</span> </label>
					<div class="col-sm-9">
						{{ Form::text('cal_name', NULL, [ 'class'=>'form-control', 'id' => 'cal_name', 'placeholder' => 'Customer Name' ]) }}
					</div>
				</div>
				<div class="form-group row">
					<label for="cal_email" class="col-sm-3 col-form-label">Customer Email <span class="text-danger">*</span> </label>
					<div class="col-sm-9">
						{{ Form::email('cal_email', NULL, [ 'class'=>'form-control', 'id' => 'cal_email', 'placeholder' => 'Customer mail id' ]) }}
					</div>
				</div>
				<div class="form-group row">
					<label for="cal_contact" class="col-sm-3 col-form-label">Contact Number <span class="text-danger">*</span> </label>
					<div class="col-sm-9">
						{{ Form::tel('cal_contact', NULL, [ 'class'=>'form-control', 'id' => 'cal_contact', 'placeholder' => 'Contact number' ]) }}
					</div>
				</div>
				<div class="form-group row">
					<label for="cal_guest" class="col-sm-3 col-form-label">Person Count <span class="text-danger">*</span> </label>
					<div class="col-sm-9">
						{{ Form::number('cal_guest', NULL, [ 'class'=>'form-control', 'id' => 'cal_guest', 'placeholder' => 'No of person' ]) }}
					</div>
				</div>
				<div class="form-group row">
					<label for="start" class="col-sm-3 col-form-label">Start Date <span class="text-danger">*</span> </label>
					<div class="col-sm-9">
						{{ Form::date('start', NULL, ['class' => 'form-control', 'id' => 'date', 'placeholder' => 'Start Date']) }}
					</div>
				</div>
				<div class="form-group row">
					<label for="cal_from_time" class="col-sm-3 col-form-label">Start Time <span class="text-danger">*</span> </label>
					<div class="col-sm-9">
						{{ Form::time('cal_from_time', NULL, ['class' => 'form-control', 'id' => 'cal_from_time', 'placeholder' => 'Start Time']) }}
					</div>
				</div>
				<div class="form-group row">
					<label for="cal_to_time" class="col-sm-3 col-form-label">End Time <span class="text-danger">*</span> </label>
					<div class="col-sm-9">
						{{ Form::time('cal_to_time', NULL, ['class' => 'form-control', 'id' => 'cal_to_time', 'placeholder' => 'End Time']) }}
					</div>
				</div>
				<div class="form-group row">
					<label for="cal_message" class="col-sm-3 col-form-label">Additional Information <span class="text-danger">*</span> </label>
					<div class="col-sm-9">
						{{ Form::textarea('cal_message', NULL, [ 'class'=>'form-control', 'id' => 'cal_message', 'placeholder' => 'Enter your message here' ]) }}
					</div>
				</div>
				<div class="mt-4 text-right"><button type="submit" class="btn btn-primary">Submit</button></div>
				{!! Form::close() !!}
			</div>
		</div>
	</div>
</div>

@stop
