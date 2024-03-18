@extends('admin.layouts.app-master')

@section('content')

	<div class="row clearfix page_header">
		<div class="col-md-6">
			<h2> Country </h2>		
		</div>
		<div class="col-md-6 text-right">
			<a class="btn btn-info" href="{{ route('country.create') }}"> <i class="fa fa-plus"></i> New Country </a>
		</div>
	</div>

	<!-- DataTales Example -->
	  <div class="card shadow mb-4">
	    <div class="card-header py-3">
	      <h6 class="m-0 font-weight-bold text-primary">Country</h6>
	    </div>
	    <div class="card-body">
	      <div class="table-responsive">
	        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
	          <thead>
	            <tr>
	              <th>Country Name</th>
	              <th>Iso2</th>
	              <th>Phone Code</th>
	              <th>Iso3</th>
	              <th class="text-center">Actions</th>
	            </tr>
	          </thead>
	          <tbody>
	          	@foreach ($country as $country_detail)
		            <tr>
						<td> {{ $country_detail->name }} </td>
						<td> {{ $country_detail->iso2 }} </td>
						<td> {{ $country_detail->phone_code }} </td>
						<td> {{ $country_detail->iso3 }} </td>
						<td class="text-center">
							
							<form method="POST" action=" {{ route('country.destroy', ['country' => $country_detail->id]) }} ">
								<a class="btn btn-primary btn-sm" href="{{ route('country.edit', ['country' => $country_detail->id]) }}"> 
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