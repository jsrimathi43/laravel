@extends('admin.layouts.app-master')

@section('content')

	<div class="row clearfix page_header">
		<div class="col-md-6">
			<h2> Order Status </h2>		
		</div>
		<div class="col-md-6 text-right">
			<a class="btn btn-info" href="{{ route('orderstatus.create') }}"> <i class="fa fa-plus"></i> New Order Status </a>
		</div>
	</div>

	<!-- DataTales Example -->
	  <div class="card shadow mb-4">
	    <div class="card-header py-3">
	      <h6 class="m-0 font-weight-bold text-primary">Order Status</h6>
	    </div>
	    <div class="card-body">
	      <div class="table-responsive">
	        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
	          <thead>
	            <tr>
	              <th>Status Name</th>
				  <th>Created Date</th>
	              <th class="text-center">Actions</th>
	            </tr>
	          </thead>
	          <tbody>
	          	@foreach ($orderstatus as $status)
		            <tr>
						<td> {{ $status->status_name }} </td>
						<td> {{ $status->created_at }} </td>
						<td class="text-center">
							
							<form method="POST" action=" {{ route('orderstatus.destroy', ['orderstatus' => $status->id]) }} ">
								<a class="btn btn-primary btn-sm" href="{{ route('orderstatus.edit', ['orderstatus' => $status->id]) }}"> 
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