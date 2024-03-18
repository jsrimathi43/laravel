@extends('admin.layouts.app-master')

@section('content')

	<!-- DataTales Example -->
	  <div class="card shadow mb-4">
	    <div class="card-header py-3">
			<div class="row clearfix page_header">
        <div class="col-md-6">
            <h2> {{ $product->title }} </h2>
        </div>
        <div class="col-md-6 text-right">
            <a class="btn btn-primary" href="{{ url('admin/products') }}"> <i class="fa fa-arrow-left" aria-hidden="true"></i>
                Back </a>
        </div>
    </div>
	      
	    </div>
	    <div class="card-body">

	    	<div class="row clearfix justify-content-md-center">
	    		<div class="col-md-12">
	    			<table class="table table-borderless table-striped">
			      	<tr>
			      		<th class="text-right">Category :</th>
			      		<td> {{ $product->category->title }} </td>
			      	</tr>
			      	<tr>
			      		<th class="text-right">Title : </th>
			      		<td> {{ $product->title }} </td>
			      	</tr>
			      	<tr>
			      		<th class="text-right">Description: </th>
			      		<td> {{ $product->description }} </td>
			      	</tr>
			      	<tr>
			      		<th class="text-right">Cost Price : </th>
			      		<td> {{ $product->cost_price }} </td>
			      	</tr>
			      	<tr>
			      		<th class="text-right">Sale Price : </th>
			      		<td> {{ $product->price }} </td>
			      	</tr>
					<tr>
						<th class="text-right">Stock : </th>
						<td> {{ $product->has_stock }} </td>
					</tr>
				     </table>
	    		</div>
	    	</div>

	    </div>
	  </div>

@stop
