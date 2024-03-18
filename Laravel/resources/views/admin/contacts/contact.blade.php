@extends('admin.layouts.app-master')

@section('content')

	<div class="row clearfix page_header">
		<div class="col-md-6">
			<h2> Contacts </h2>		
		</div>
		{{-- <div class="col-md-6 text-right">
			<a class="btn btn-info" href="{{ route('role.create') }}"> <i class="fa fa-plus"></i> New Roles </a>
		</div> --}}
	</div>

	<!-- DataTales Example -->
	  <div class="card shadow mb-4">
	    <div class="card-header py-3">
	      <h6 class="m-0 font-weight-bold text-primary">Contacts</h6>
	    </div>
	    <div class="card-body">
	      <div class="table-responsive">
	        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
	          <thead>
	            <tr>
	              <th>Name</th>
	              <th>Mail</th>
	              <th>Phone</th>
	              <th>Message</th>
	              <th>Response</th>
				  <th>Created Date</th>
	              <th class="text-center">Actions</th>
	            </tr>
	          </thead>
	          <tbody>
	          	@foreach ($contacts as $contact)
		            <tr>
						<td> {{ $contact->name }} </td>
						<td> {{ $contact->email }} </td>
						<td> {{ $contact->phone }} </td>
						<td> {{ $contact->message }} </td>
						<td> {{ $contact->response }} </td>
						<td> {{ $contact->created_at }} </td>
						<td class="text-center">
							
							<form method="POST" action=" {{ route('contactus.destroy', ['contactu' => $contact->id]) }} ">
								<a class="btn btn-primary btn-sm" href="{{ route('contactus.edit', ['contactu' => $contact->id]) }}"> 
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