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
            <a class="btn btn-primary" href="{{ url('admin/products') }}"> <i class="fa fa-arrow-left" aria-hidden="true"></i>
                Back </a>
        </div>
    </div>
        </div>
        <div class="card-body">
            <div class="row justify-content-md-center">
                <div class="col-md-12">
                    @if ($mode == 'edit')
                        {!! Form::model($product, ['route' => ['products.update', $product->id], 'method' => 'put',"enctype" => "multipart/form-data"]) !!}
                    @else
                        {!! Form::open(['route' => 'products.store', 'method' => 'post',"enctype" => "multipart/form-data"]) !!}
                    @endif

                    <div class="form-group row">
                        <label for="title" class="col-sm-3 text-right col-form-label">Title <span
                                class="text-danger">*</span> </label>
                        <div class="col-sm-9">
                            {{ Form::text('title', null, ['class' => 'form-control', 'id' => 'title', 'placeholder' => 'Title']) }}
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="description" class="col-sm-3 text-right col-form-label">Description <span
                                class="text-danger">*</span> </label>
                        <div class="col-sm-9">
                            {{ Form::textarea('description', null, ['class' => 'form-control', 'id' => 'description', 'placeholder' => 'Description']) }}
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="name" class="col-sm-3 text-right col-form-label">Category <span
                                class="text-danger">*</span> </label>
                        <div class="col-sm-9">
                            {{ Form::select('category_id', $categories, null, ['class' => 'form-control', 'id' => 'group', 'placeholder' => 'Select Category']) }}
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="cost_price" class="col-sm-3 text-right col-form-label">Cost Price</label>
                        <div class="col-sm-9">
                            {{ Form::text('cost_price', null, ['class' => 'form-control', 'id' => 'cost_price', 'placeholder' => 'Cost Price']) }}
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="price" class="col-sm-3 text-right col-form-label">Sale Price</label>
                        <div class="col-sm-9">
                            {{ Form::text('price', null, ['class' => 'form-control', 'id' => 'price', 'placeholder' => 'Sale Price']) }}
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="name" class="col-sm-3 text-right col-form-label">Has Stock </label>
                        <div class="col-sm-9">
                            {{ Form::select('has_stock', ['1' => 'Yes', '0' => 'No'], null, ['class' => 'form-control', 'id' => 'group']) }}
                        </div>
                    </div>
                    <div class="form-group row">
						<label for="image" class="col-sm-3 text-right col-form-label">Choose product image <span class="text-danger">*</span> </label>
						<div class="col-sm-9">
							<input type="file" name="image" class="form-control" placeholder="image">
						</div>
					</div>
                    <div class="form-group row mt-4">
                        <label for="price" class="col-sm-3 text-right col-form-label"></label>
                        <div class="col-sm-9">
                            <button type="submit" class="btn btn-primary btn-lg"> <i class="fa fa-save"></i>
                                Submit</button>
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@stop
