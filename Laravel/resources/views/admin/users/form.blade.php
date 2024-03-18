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
	      	<div class="d-flex">
	  <div class="mr-auto p-2"><h2> {{ $headline }} </h2></div>
	  <div class="p-2">
		<a class="btn btn-primary" href="{{ url('admin/users') }}"> <i class="fa fa-arrow-left" aria-hidden="true"></i>
                Back </a>
	  </div>
	</div>
	    </div>
	    <div class="card-body">
	    	<div class="row justify-content-md-center">
	    		<div class="col-md-8">
	    			@if($mode == 'edit')
	    				{!! Form::model($user, [ 'route' => ['admin.users.update', $user->id], 'method' => 'put' ]) !!}
	    			@else
	    				{!! Form::open([ 'route' => 'admin.users.store', 'method' => 'post' ]) !!}	
	    			@endif
	    			

					  <div class="form-group row">
					    <label for="group_id" class="col-sm-3 col-form-label">User Group <span class="text-danger">*</span> </label>
					    <div class="col-sm-9">
					      {{ Form::select('group_id', $groups, NULL, [ 'class'=>'form-control', 'id' => 'group', 'placeholder' => 'Select Group' ]) }}
					    </div>
					  </div>
					  <div class="form-group row">
						<label for="role_id" class="col-sm-3 col-form-label">Role <span class="text-danger">*</span> </label>
						<div class="col-sm-9">
							<select type="text" name="role_id" id="role_id" class="form-control">
								<option value="">None</option>
								@foreach ($roles as $role)
								<option value="{{$role->id}}" @if(!empty($user)) @if ($user->role_id == $role->id)
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
					    <label for="first_name" class="col-sm-3 col-form-label">First Name <span class="text-danger">*</span> </label>
					    <div class="col-sm-9">
					      {{ Form::text('first_name', NULL, [ 'class'=>'form-control', 'id' => 'first_name', 'placeholder' => 'First Name' ]) }}
					    </div>
					  </div>

					  <div class="form-group row">
					    <label for="last_name" class="col-sm-3 col-form-label">Last Name <span class="text-danger">*</span> </label>
					    <div class="col-sm-9">
					      {{ Form::text('last_name', NULL, [ 'class'=>'form-control', 'id' => 'last_name', 'placeholder' => 'Last Name' ]) }}
					    </div>
					  </div>

					  <div class="form-group row">
					    <label for="phone" class="col-sm-3 col-form-label">Phone <span class="text-danger">*</span>  </label>
					    <div class="col-sm-9">
					      {{ Form::text('phone', NULL, [ 'class'=>'form-control', 'id' => 'phone', 'placeholder' => 'Phone' ]) }}
					    </div>
					  </div>
					  
					  <div class="form-group row">
					    <label for="email" class="col-sm-3 col-form-label">Email</label>
					    <div class="col-sm-9">
					      {{ Form::text('email', NULL, [ 'class'=>'form-control', 'id' => 'email', 'placeholder' => 'Email' ]) }}
					    </div>
					  </div>
					  
					  <div class="form-group row">
					    <label for="address" class="col-sm-3 col-form-label">Address</label>
					    <div class="col-sm-9">
					      {{ Form::text('address', NULL, [ 'class'=>'form-control', 'id' => 'address', 'placeholder' => 'Address' ]) }}
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
					  <div class="mt-4 text-right">
					  	<button type="submit" class="btn btn-primary">Submit</button>	
					  </div>
					{!! Form::close() !!}
	    		</div>
	    	</div>
	    </div>
	</div>
@stop
