@extends('layouts.main')

@section('title')
	Pre-Register - Child Care Services
@stop

@section('head')
<link href="/css/index/pre-register.css" rel="stylesheet" type="text/css">
<script src="/js/app/registration/form.js"></script> 
<script src="/js/jquery/ui-1.10.3.custom.min.js"></script>
<link href="/css/ui-lightness/ui-1.10.3.custom.min.css" rel="stylesheet" type="text/css">
@stop

@section('content')
<div class="wrapper row text-center">
	<div class="col-sm-6 col-sm-offset-3 col-xs-12">
		<h1 class="text-center">Pre-Register</h1>
        <div class="row">
            <div class="col-xs-12 notice-area-blue margin-bottom-large text-left">Want to sign-up your child? Just fill out the following information to get this process going!</div>
            @if (Session::has('loginError'))
                <div class="col-xs-12 notice-area-error margin-bottom-large">{{ Session::get('loginError') }}</div>
            @endif
		</div>
        
        <div class="custom-form row">
            <form action="{{ URL::Route('registration.process') }}" id="pre-register-form" method="post">
               
                <div class="input-group"> <span class="input-group-addon">First Name</span>
                    <input class="required form-control" name="first_name" value="{{ $form->first_name }}" type="text" />
                </div>
                <div class="input-group"> <span class="input-group-addon">Last Name</span>
                    <input class="required form-control" name="last_name" value="{{ $form->last_name }}" type="text" />
                </div>
                <div class="input-group"> <span class="input-group-addon">Email Address</span>
                    <input class="required email form-control" name="email" value="{{ $form->email }}" type="text" />
                </div>
                <div class="input-group"> <span class="input-group-addon">Phone</span>
                    <input class="required phoneUS form-control" name="phone" value="{{ $form->phone }}" type="text" />
                </div>
            
                <div class="input-prepend">
                    <div class="top-label"># of Children</div>
                    <input class="required number form-control" name="number_of_children" value="{{ $form->number_of_children }}" type="text" />
                </div>
            
                <div class="input-prepend">
                    <div class="top-label" id="days-per-week">Days Per Week (Attendence)</div>
                    <input class="required number form-control" name="days_per_week" value="{{ $form->days_per_week }}" type="text" />
                </div>
            
                <div class="input-prepend">
                    <div class="top-label">Tour Date</div>
                    <input class="required form-control" name="tour_date" id="tour-date" value="{{ $form->tour_date }}" type="text" />
                </div>
              
                <div class="text-center">
                    <button class="btn btn-primary btn-large" type="submit">Submit</button>
                </div>
            </form>
		</div>
	</div>
</div>
@stop