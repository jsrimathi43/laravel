@extends('admin.layouts.app-master')

@section('content')

	<div class="row clearfix page_header">
		<div class="col-md-6">
			<h2> Users </h2>		
		</div>
		<div class="col-md-6 text-right">
			<a class="btn btn-info" href="{{ url('admin/users/create') }}"> <i class="fa fa-plus"></i> New user </a>
		</div>
	</div>

	<!-- DataTales Example -->
	<div class="card shadow mb-4">
		<div class="card-header py-3">
		<h6 class="m-0 font-weight-bold text-primary">Users</h6>
		</div>
		<div class="card-body">
		<div class="table-responsive">
			<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
			<thead>
				<tr>
				<th>Role</th>
				<th>Group</th>
				<th>First Name</th>
				<th>Last Name</th>
				<th>Email</th>
				<th>Phone</th>
				<th>Address</th>
				<th class="text-right">Actions</th>
				</tr>
			</thead>
			<tbody>
				@foreach ($users as $user)
					<tr>
					<td> {{ $user->role_name }} </td>
					{{-- <td> {{ optional($user->group)->title }} </td> --}}
					<td> {{ $user->group_id }} </td>
					<td> {{ $user->first_name }} </td>
					<td> {{ $user->last_name }} </td>
					<td> {{ $user->email }} </td>
					<td> {{ $user->phone }} </td>
					<td> {{ $user->address }} </td>
					<td class="text-right">
						
						<form method="POST" action=" {{ route('admin.users.destroy', ['id' => $user->id]) }} ">
							<a class="btn btn-primary btn-sm" href="{{ route('admin.users.show', ['id' => $user->id]) }}"> 
								<i class="fa fa-eye"></i> 
							</a>
							<a class="btn btn-primary btn-sm" href="{{ route('admin.users.edit', ['id' => $user->id]) }}"> 
								<i class="fa fa-edit"></i> 
							</a>
							{{-- @if(
								$user->sales()->count() == 0 
								&& $user->purchases()->count() == 0
								&& $user->receipts()->count() == 0
								&& $user->payments()->count() == 0
							) --}}
								@csrf
								@method('DELETE')
								<button onclick="return confirm('Are you sure?')" type="submit" class="btn btn-danger btn-sm"> 
									<i class="fa fa-trash"></i>  
								</button>	
							{{-- @endif --}}
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
