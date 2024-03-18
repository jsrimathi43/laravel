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
            <a class="btn btn-primary" href="{{ url('admin/city') }}"> <i class="fa fa-arrow-left" aria-hidden="true"></i>
                Back </a>
        </div>
    </div>
	</div>
	<div class="card-body">
		<div class="row justify-content-md-center">
			<div class="col-md-8">
				@if($mode == 'edit')
				{!! Form::model($city, [ 'route' => ['city.update', $city->id], 'method' => 'put',"enctype" => "multipart/form-data" ]) !!}
				@else
				{!! Form::open([ 'route' => 'city.store', 'method' => 'post', "enctype" => "multipart/form-data" ]) !!}
				@endif
				<div class="form-group row">
					<label for="state_id" class="col-sm-3 col-form-label">State <span class="text-danger">*</span> </label>
					<div class="col-sm-9">
						<select type="text" name="state_id" id="state_id" class="form-control">
							<option value="">None</option>
							@foreach ($states as $state)
							<option value="{{$state->id}}" @if(!empty($city)) @if ($city->state_id == $state->id)
								{{'selected="selected"'}}
								@endif
								@endif
								>
								{{ $state->name }}
							</option>
							@endforeach
						</select>
					</div>
				</div>
				<div class="form-group row">
					<label for="name" class="col-sm-3 col-form-label">City Name <span class="text-danger">*</span> </label>
					<div class="col-sm-9">
						{{ Form::text('name', NULL, [ 'class'=>'form-control', 'id' => 'name', 'placeholder' => 'Enter City name' ]) }}
					</div>
				</div>
				<div class="mt-4 text-right"><button type="submit" class="btn btn-primary">Submit</button></div>
				{!! Form::close() !!}
			</div>
		</div>
	</div>
</div>
@stop
