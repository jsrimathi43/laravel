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
            <a class="btn btn-primary" href="{{ url('admin/categories') }}"> <i class="fa fa-arrow-left" aria-hidden="true"></i>
                Back </a>
        </div>
    </div>
	    </div>
	    <div class="card-body">
	    	<div class="row justify-content-md-center">
	    		<div class="col-md-8">
	    			@if($mode == 'edit')
	    				{!! Form::model($category, [ 'route' => ['categories.update', $category->id], 'method' => 'put',"enctype" => "multipart/form-data" ]) !!}
	    			@else
	    				{!! Form::open([ 'route' => 'categories.store', 'method' => 'post', "enctype" => "multipart/form-data" ]) !!}	
	    			@endif
					<div class="form-group row">
						<label for="title" class="col-sm-3 col-form-label">Title <span class="text-danger">*</span> </label>
						<div class="col-sm-9">
							{{ Form::text('title', NULL, [ 'class'=>'form-control', 'id' => 'title', 'placeholder' => 'Title' ]) }}
						</div>
					</div>
					<div class="form-group row">
						<label for="route" class="col-sm-3 col-form-label">Route <span class="text-danger">*</span> </label>
						<div class="col-sm-9">
							{{ Form::text('route', NULL, [ 'class'=>'form-control', 'id' => 'route', 'placeholder' => 'Route' ]) }}
						</div>
					</div>
					<div class="form-group row">
						<label for="parent_id" class="col-sm-3 col-form-label">Select parent category <span class="text-danger">*</span> </label>
						<div class="col-sm-9">
							{{-- <select type="text" name="parent_id" id="parent_id" class="form-control">
								<option value="">None</option>
								@if($categories)
									@foreach($categories as $category)
								
										<option value="{{$category->id}}">{{$category->title}}</option>
									 {{-- @if(count($category->subcategory))
											@include('subCategoryList-option',['subcategories' => $category->subcategory])
										@endif  
									@endforeach
								@endif
							</select> --}}
							<select type="text" name="parent_id" id="parent_id" class="form-control">
								<option value="">None</option>
								@if($categories)
									@foreach ($categories as $categorie)
									<option value="{{$categorie->id}}" @if(!empty($category)) @if ($category->parent_id == $categorie->id)
										{{'selected="selected"'}}
										@endif
										@endif
										>
										{{ $categorie->title }}
									</option>
									@endforeach
								@endif
							</select>
						</div>
					</div>
					{{-- <div class="form-group row">
						<label for="image" class="col-sm-3 col-form-label">Choose category image <span class="text-danger">*</span> </label>
						<div class="col-sm-9">
							{{ Form::file('image', NULL, [ 'class'=>'form-control', 'id' => 'image', 'placeholder' => 'image' ]) }}
							
						</div>
					</div> --}}
					<div class="form-group row">
						<label for="" class="col-sm-3 col-form-label">Choose category image <span class="text-danger">*</span> </label>
						<input type="file" name="image" id= "image" class = ''/>
						@if($category)
							@if ("/images/{{ $category->image }}")
								<img src="/images/{{ $category->image }}"  width="50px">
							@else
								<p>No image found</p>
							@endif
						@endif 
					</div>
					<div class="mt-4 text-right"><button type="submit" class="btn btn-primary">Submit</button></div>
					  
					{!! Form::close() !!}
	    		</div>
	    	</div>
	    </div>
	</div>
@stop
