@extends('admin.layouts.app-master')

@section('content')

	<div class="row clearfix page_header">
		<div class="col-md-6">
			<h2> Delivery Partners Details </h2>		
		</div>
		<div class="col-md-6 text-right">
			<a class="btn btn-info" href="{{ route('deliveryPartners.create') }}"> <i class="fa fa-plus"></i> New delivery partners </a>
		</div>
	</div>

	<!-- DataTales Example -->
	  <div class="card shadow mb-4">
	    <div class="card-header py-3">
	      <h6 class="m-0 font-weight-bold text-primary">Delivery Partners</h6>
	    </div>
	    <div class="card-body">
	      <div class="table-responsive">
	        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
	          <thead>
	            <tr>
	              <th>ID</th>
	              <th>Name</th>
	              <th>Contact number</th>
	              <th>Email</th>
	              <th>Vechicle name</th>
	              <th>Vechicle number</th>
				  <th>Status</th>
	              <th class="text-right">Actions</th>
	            </tr>
	          </thead>
	          <tbody>
	          	@foreach ($deliveryPartners as $deliveryPartner)
		            <tr>
						<td> {{ $deliveryPartner->id }} </td>
						<td> {{ $deliveryPartner->name }} </td>
						<td> {{ $deliveryPartner->contact_number }} </td>
						<td> {{ $deliveryPartner->email }} </td>
						<td> {{ $deliveryPartner->vechicle_name }} </td>
						<td> {{ $deliveryPartner->vechicle_number }} </td>
						<td> {{ $deliveryPartner->available_status }} </td>
						<td class="text-right">
							
							<form method="POST" action=" {{ route('deliveryPartners.destroy', ['deliveryPartner' => $deliveryPartner->id]) }} ">
								<a class="btn btn-primary btn-sm" href="{{ route('deliveryPartners.edit', ['deliveryPartner' => $deliveryPartner->id]) }}"> 
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