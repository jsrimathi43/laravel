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
            <a class="btn btn-primary" href="{{ url('admin/deliveryPartners') }}"> <i class="fa fa-arrow-left" aria-hidden="true"></i>
                Back </a>
        </div>
    </div>
	    </div>
	    <div class="card-body">
	    	<div class="row justify-content-md-center">
	    		<div class="col-md-8">
	    			@if($mode == 'edit')
	    				{!! Form::model($deliveryPartners, [ 'route' => ['deliveryPartners.update', $deliveryPartners->id], 'method' => 'put',"enctype" => "multipart/form-data" ]) !!}
	    			@else
	    				{!! Form::open([ 'route' => 'deliveryPartners.store', 'method' => 'post', "enctype" => "multipart/form-data" ]) !!}	
	    			@endif
					<div class="form-group row">
						<label for="name" class="col-sm-3 col-form-label">Name <span class="text-danger">*</span> </label>
						<div class="col-sm-9">
							{{ Form::text('name', NULL, [ 'class'=>'form-control', 'id' => 'name', 'placeholder' => 'Enter delivery partner name' ]) }}
						</div>
					</div>
					<div class="form-group row">
						<label for="role_id" class="col-sm-3 col-form-label">Role <span class="text-danger">*</span> </label>
						<div class="col-sm-9">
							<select type="text" name="role_id" id="role_id" class="form-control">
								<option value="">None</option>
								@foreach ($roles as $role)
								<option value="{{$role->id}}" @if(!empty($deliveryPartners)) @if ($deliveryPartners->role_id == $role->id)
									{{'selected="selected"'}}
									@endif
									@endif
									>
									{{ $role->role_name }}
								</option>
								@endforeach
							</select>
						</div>
					</div>
					<div class="form-group row">
						<label for="contact_number" class="col-sm-3 col-form-label">Contact number <span class="text-danger">*</span> </label>
						<div class="col-sm-9">
							{{ Form::number('contact_number', NULL, [ 'class'=>'form-control', 'id' => 'contact_number', 'placeholder' => 'Enter contact number' ]) }}
						</div>
					</div>
					<div class="form-group row">
						<label for="email" class="col-sm-3 col-form-label">Email <span class="text-danger">*</span> </label>
						<div class="col-sm-9">
							{{ Form::email('email', NULL, [ 'class'=>'form-control', 'id' => 'email', 'placeholder' => 'Enter email id' ]) }}
						</div>
					</div>
					@if($mode == 'create')
					  <div class="form-group row">
						<label for="password" class="col-sm-3 col-form-label">Password<span class="text-danger">*</span></label>
						<div class="col-sm-9">
							{{ Form::text('password', NULL, [ 'class'=>'form-control', 'id' => 'password', 'placeholder' => 'password' ]) }}
					    </div>
					  </div>
					  @else
					  <div class="form-group row">
						<label for="new_password" class="col-sm-3 col-form-label">New Password</label>
						<div class="col-sm-9">
							{{ Form::text('new_password', NULL, [ 'class'=>'form-control', 'id' => 'new_password', 'placeholder' => 'New Password' ]) }}
					    </div>
					  </div>
					  @endif
					<div class="form-group row">
						<label for="vechicle_name" class="col-sm-3 col-form-label">Vechicle name <span class="text-danger">*</span> </label>
						<div class="col-sm-9">
							{{ Form::text('vechicle_name', NULL, [ 'class'=>'form-control', 'id' => 'vechicle_name', 'placeholder' => 'Enter vechicle name' ]) }}
						</div>
					</div>
					<div class="form-group row">
						<label for="vechicle_number" class="col-sm-3 col-form-label">Vechicle number <span class="text-danger">*</span> </label>
						<div class="col-sm-9">
							{{ Form::text('vechicle_number', NULL, [ 'class'=>'form-control', 'id' => 'vechicle_number', 'placeholder' => 'Enter vechicle number' ]) }}
						</div>
					</div>
					<div class="form-group row">
						<label for="available_status" class="col-sm-3 col-form-label">Available <span class="text-danger">*</span> </label>
						<div class="col-sm-9">
							<select type="text" name="available_status" id="available_status" class="form-control">
								<option value="">None</option>
								@foreach ($available as $status)
								<option value="{{$status['id']}}" @if(!empty($deliveryPartners)) @if ($deliveryPartners->available_status == $status['id'])
									{{'selected="selected"'}}
									@endif
									@endif
									>
									{{ $status['available_status_name'] }}
								</option>
								@endforeach
							</select>
						</div>
					</div>

					<div class="mt-4 text-right"><button type="submit" class="btn btn-primary">Submit</button></div>
					{!! Form::close() !!}
	    		</div>
	    	</div>
	    </div>
	</div>
@stop
