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
		<div class="row clearfix page_header">
			<div class="col-md-6">
				<h2> {{ $headline }} </h2>
			</div>
			<div class="col-md-6 text-right">
				<a class="btn btn-primary" href="{{ url('admin/contactus') }}"> <i class="fa fa-arrow-left" aria-hidden="true"></i>
					Back </a>
			</div>
		</div>
	</div>
	<div class="card-body">
		<div class="row justify-content-md-center">
			<div class="col-md-8">
				{!! Form::model($contacts, [ 'route' => ['contactus.update', $contacts->id], 'method' => 'put',"enctype" => "multipart/form-data" ]) !!}
				<div class="form-group row">
					<label for="response" class="col-sm-3 col-form-label">Response <span class="text-danger">*</span> </label>
					<div class="col-sm-9">
						{{ Form::textarea('response', NULL, [ 'class'=>'form-control', 'id' => 'response', 'placeholder' => 'Enter Response' ]) }}
					</div>
				</div>
				<div class="mt-4 text-right"><button type="submit" class="btn btn-primary">Submit</button></div>
				{!! Form::close() !!}
			</div>
		</div>
	</div>
</div>
@stop