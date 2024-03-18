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
            <a class="btn btn-primary" href="{{ url('admin/country') }}"> <i class="fa fa-arrow-left" aria-hidden="true"></i>
                Back </a>
        </div>
    </div>
	</div>
	<div class="card-body">
		<div class="row justify-content-md-center">
			<div class="col-md-8">
				@if($mode == 'edit')
				{!! Form::model($country, [ 'route' => ['country.update', $country->id], 'method' => 'put',"enctype" => "multipart/form-data" ]) !!}
				@else
				{!! Form::open([ 'route' => 'country.store', 'method' => 'post', "enctype" => "multipart/form-data" ]) !!}
				@endif
				<div class="form-group row">
					<label for="name" class="col-sm-3 col-form-label">Country Name <span class="text-danger">*</span> </label>
					<div class="col-sm-9">
						{{ Form::text('name', NULL, [ 'class'=>'form-control', 'id' => 'name', 'placeholder' => 'Enter Country name' ]) }}
					</div>
				</div>
				<div class="form-group row">
					<label for="iso2" class="col-sm-3 col-form-label">Iso2 <span class="text-danger">*</span> </label>
					<div class="col-sm-9">
						{{ Form::text('iso2', NULL, [ 'class'=>'form-control', 'id' => 'iso2', 'placeholder' => 'Enter iso2' ]) }}
					</div>
				</div>
				<div class="form-group row">
					<label for="phone_code" class="col-sm-3 col-form-label">Phone Code <span class="text-danger">*</span> </label>
					<div class="col-sm-9">
						{{ Form::text('phone_code', NULL, [ 'class'=>'form-control', 'id' => 'phone_code', 'placeholder' => 'Enter phone code' ]) }}
					</div>
				</div>
				<div class="form-group row">
					<label for="iso3" class="col-sm-3 col-form-label">Iso3 <span class="text-danger">*</span> </label>
					<div class="col-sm-9">
						{{ Form::text('iso3', NULL, [ 'class'=>'form-control', 'id' => 'iso3', 'placeholder' => 'Enter iso3' ]) }}
					</div>
				</div>
				<div class="mt-4 text-right"><button type="submit" class="btn btn-primary">Submit</button></div>
				{!! Form::close() !!}
			</div>
		</div>
	</div>
</div>
@if (!empty($state))
<div class="row clearfix page_header">
	<div class="col-md-6">
		<h2> States </h2>
	</div>
	<div class="col-md-6 text-right">
		<button type="button" class="btn btn-primary mt-3" data-toggle="modal" data-target="#exampleModal"><i class="fa fa-plus"></i> Add New State</button>
	</div>
</div>

<div class="card shadow mb-4">
	<div class="card-header py-3">
		<h6 class="m-0 font-weight-bold text-primary">State</h6>
	</div>
	<div class="card-body">
		<div class="table-responsive">
			<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
				<thead>
					<tr>
						<th>State Name</th>
						<th class="text-center">Actions</th>
					</tr>
				</thead>
				<tbody>
					@foreach ($state as $state_details)
					<tr>
						<td> {{ $state_details->name }} </td>
						<td class="text-center">
							<form method="POST" action=" {{ route('admin.country.states.destroy', ['stateid' => $state_details->id]) }} ">
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
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<form class="w-px-500 p-3 p-md-3 needs-validation" action="{{ route('admin.country.states.create') }}" method="post" role="form" novalidate>
				@csrf
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Add New State</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true"><i class="fa fa-close"></i></span>
					</button>
				</div>
				<div class="modal-body">
					<div class="card-body">
						<div class="row mb-3 form-group">
							<label class="col-sm-3 col-form-label">State Name</label>
							<div class="col-sm-9">
								<input type="text" class="form-control" name="name" placeholder="Enter State Name" required>
								<input type="hidden" class="form-control" name="country_id" value="{{$country->id}}">
							</div>
						</div>
						<div class="row mb-3 form-group">
							<label class="col-sm-3 col-form-label">Country Code</label>
							<div class="col-sm-9">
								<input type="text" class="form-control" name="country_code" placeholder="Enter country code" required>
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-primary">Save changes</button>
				</div>
			</form>
		</div>
	</div>
</div>
@endif
@stop
