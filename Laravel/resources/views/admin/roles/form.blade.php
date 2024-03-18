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
            <a class="btn btn-primary" href="{{ url('admin/role') }}"> <i class="fa fa-arrow-left" aria-hidden="true"></i>
                Back </a>
        </div>
    </div>
	</div>
	<div class="card-body">
		<div class="row justify-content-md-center">
			<div class="col-md-8">
				@if($mode == 'edit')
				{!! Form::model($roles, [ 'route' => ['role.update', $roles->id], 'method' => 'put',"enctype" => "multipart/form-data" ]) !!}
				@else
				{!! Form::open([ 'route' => 'role.store', 'method' => 'post', "enctype" => "multipart/form-data" ]) !!}
				@endif
				<div class="form-group row">
					<label for="role_name" class="col-sm-3 col-form-label">Role Name <span class="text-danger">*</span> </label>
					<div class="col-sm-9">
						{{ Form::text('role_name', NULL, [ 'class'=>'form-control', 'id' => 'role_name', 'placeholder' => 'Enter role name' ]) }}
					</div>
				</div>
				<div class="mt-4 text-right"><button type="submit" class="btn btn-primary">Submit</button></div>
				{!! Form::close() !!}
			</div>
		</div>
	</div>
</div>
@stop
