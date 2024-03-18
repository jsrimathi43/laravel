@extends('admin.layouts.app-master')

@section('content')

	<div class="row clearfix page_header">
		<div class="col-md-6">
			<h2> City </h2>		
		</div>
		<div class="col-md-6 text-right">
			<a class="btn btn-info" href="{{ route('city.create') }}"> <i class="fa fa-plus"></i> New City </a>
		</div>
	</div>

	<!-- DataTales Example -->
	  <div class="card shadow mb-4">
	    <div class="card-header py-3">
	      <h6 class="m-0 font-weight-bold text-primary">City</h6>
	    </div>
	    <div class="card-body">
	      <div class="table-responsive">
	        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
	          <thead>
	            <tr>
	              <th>State Name</th>
	              <th>City Name</th>
				  <th>Created Date</th>
	              <th class="text-center">Actions</th>
	            </tr>
	          </thead>
	          <tbody>
	          	@foreach ($city as $city_detail)
		            <tr>
						<td> {{ $city_detail->State_name }} </td>
						<td> {{ $city_detail->name }} </td>
						<td> {{ $city_detail->created_at }} </td>
						<td class="text-center">
							
							<form method="POST" action=" {{ route('city.destroy', ['city' => $city_detail->id]) }} ">
								<a class="btn btn-primary btn-sm" href="{{ route('city.edit', ['city' => $city_detail->id]) }}"> 
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