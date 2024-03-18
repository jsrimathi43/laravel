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
        <h6 class="m-0 font-weight-bold text-primary">{{ $headline }}</h6>
        </div>
        <div class="col-md-6 text-right">
            <a class="btn btn-primary" href="{{ url('admin/reviews') }}"> <i class="fa fa-arrow-left" aria-hidden="true"></i>
                Back </a>
        </div>
    </div>
		
	</div>
	<div class="card-body">
		<div class="row justify-content-md-center">
			<div class="col-md-8">
				@if($mode == 'edit')
				{!! Form::model($review, [ 'route' => ['reviews.update', $review->id], 'method' => 'put',"enctype" => "multipart/form-data" ]) !!}
				@else
				{!! Form::open([ 'route' => 'reviews.store', 'method' => 'post', "enctype" => "multipart/form-data" ]) !!}
				@endif
				<div class="form-group row">
					<label for="comments" class="col-sm-3 col-form-label">Comments <span class="text-danger">*</span> </label>
					<div class="col-sm-9">
						{{ Form::textarea('comments', NULL, [ 'class'=>'form-control', 'id' => 'comments', 'placeholder' => 'Enter comments' ]) }}
					</div>
				</div>
				<div class="form-group row">
					<label for="star_rating" class="col-sm-3 col-form-label">Rating<span class="text-danger">*</span> </label>
					<div class="col-sm-9">
						<select type="text" name="star_rating" id="star_rating" class="form-control">
							<option value="">None</option>
							@foreach ($ratings as $rating)
							<option value="{{$rating['id']}}" @if(!empty($review)) @if ($review->star_rating == $rating['id'])
								{{'selected="selected"'}}
								@endif
								@endif
								>
								{{ $rating['value'] }}
							</option>
							@endforeach
						</select>
					</div>
				</div>
				@if($mode == 'create')
				<div class="form-group row">
					<label for="order_id" class="col-sm-3 col-form-label">Order Number<span class="text-danger">*</span> </label>
					<div class="col-sm-9">
						<select type="text" name="order_id" id="order_id" class="form-control">
							<option value="">None</option>
							@foreach ($orderIds as $orderid)
							<option value="{{$orderid->id}}">
								{{ $orderid->order_number }}
							</option>
							@endforeach
						</select>
					</div>
				</div>
				@endif
				<div class="mt-4 text-right"><button type="submit" class="btn btn-primary">Submit</button></div>
				{!! Form::close() !!}
			</div>
		</div>
	</div>
</div>
@stop
