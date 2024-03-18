@extends('layouts.app')

@section('content')
    <section class="orderView account-detail-section">
        <div class="container">
            <div class="row account-containers">
                @include('myaccount.sidemenu')
                <div class = "details-container-section">
                <div class="col-lg-8  " id="content-accountdetails">
                    <div class="table-responsive">
                        @if (Session::has('fail'))
                            <div class="alert alert-danger">
                                {{ Session::get('fail') }}
                            </div>
                        @endif
                        @if (Session::has('success'))
                            <div class="alert alert-success">
                                {{ Session::get('success') }}
                            </div>
                        @endif
                        @if (Auth::check())
                            {!! Form::model($accountdetails, [
                                'route' => ['myaccount.accountdetailsupdate', $accountdetails[0]->id],
                                'method' => 'post',
                                'enctype' => 'multipart/form-data',
                            ]) !!}
                            <div class="form-group row">
                                <label for="first_name" class="col-sm-3 col-form-label">First name <span class="text-danger">*</span></label>
                                <div class="col-sm-9">
                                    {{ Form::text('first_name', old('first_name', $accountdetails[0]->first_name), ['class' => 'form-control', 'id' => 'first_name', 'placeholder' => 'Enter your first name','required']) }}
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="last_name" class="col-sm-3 col-form-label">Last name </label>
                                <div class="col-sm-9">
                                    {{ Form::text('last_name', old('last_name', $accountdetails[0]->last_name), ['class' => 'form-control', 'id' => 'last_name', 'placeholder' => 'Enter your last name']) }}
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="email" class="col-sm-3 col-form-label">Mail <span class="text-danger">*</span></label>
                                <div class="col-sm-9">
                                    {{ Form::text('email', old('mail', $accountdetails[0]->email), ['class' => 'form-control', 'id' => 'email', 'placeholder' => 'Enter Mail ID','required']) }}
                                </div>
                            </div>
                            <h5> Change Password </h5>
                            <div class="form-group row">
                                <label for="current_password" class="col-sm-3 col-form-label">Current Password </label>
                                <div class="col-sm-9">
                                    {{ Form::text('current_password', null, ['class' => 'form-control', 'id' => 'current_password', 'placeholder' => 'Enter current password']) }}
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="new_password" class="col-sm-3 col-form-label">New Password </label>
                                <div class="col-sm-9">
                                    {{ Form::text('new_password', null, ['class' => 'form-control', 'id' => 'new_password', 'placeholder' => 'Enter new password']) }}
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="confirm_new_password" class="col-sm-3 col-form-label">Confirm new password
                                </label>
                                <div class="col-sm-9">
                                    {{ Form::text('confirm_new_password', null, ['class' => 'form-control', 'id' => 'confirm_new_password', 'placeholder' => 'Enter Confirm new password']) }}
                                </div>
                            </div>
                            <div class="mt-4 text-right form-group"><button type="submit" class="btn btn-primary">Update</button>
                            </div>
                            {!! Form::close() !!}
                        @endif
                    </div>
                </div></div>
            </div>
        </div>
    </section>

    @include('layouts.footer')
@endsection
