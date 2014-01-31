@extends('layouts.main')

@section('title')
	Pre-Register - Child Care Services
@stop

@section('head')
<link href="/css/twitter-bs.css" rel="stylesheet" type="text/css">
<link href="/css/index/pre-register.css" rel="stylesheet" type="text/css">
<script src="/js/app/registration/form.js"></script> 
<script src="/js/jquery/ui-1.10.3.custom.min.js"></script>
<link href="/css/ui-lightness/ui-1.10.3.custom.min.css" rel="stylesheet" type="text/css">
@stop

@section('content')
<div class="wrapper">
	<div class="tw-bs" style="width:390px; margin:auto;">
		<h1>Pre-Register</h1>
		<div class="notice-area-blue margin-bottom-large" style="width:377px;">Want to sign-up your child? Just fill out the following information to get this process going!</div>
		@if (Session::has('loginError'))
			<div class="notice-area-error margin-bottom-large">{{ Session::get('loginError') }}</div>
		@endif
		<form action="{{ URL::Route('registration.process') }}" id="pre-register-form" method="post">
			<div class="">
				<div class="input-prepend"> <span class="add-on label">First Name</span>
					<input class="required" name="first_name" value="{{ $form->first_name }}" type="text" />
				</div>
				<br />
				<div class="input-prepend"> <span class="add-on label">Last Name</span>
					<input class="required" name="last_name" value="{{ $form->last_name }}" type="text" />
				</div>
				<br />
				<div class="input-prepend"> <span class="add-on label">Email Address</span>
					<input class="required email" name="email" value="{{ $form->email }}" type="text" />
				</div>
				<br />
				<div class="input-prepend"> <span class="add-on label">Phone</span>
					<input class="required phoneUS" name="phone" value="{{ $form->phone }}" type="text" />
				</div>
			</div>
			<div class="">
				<div class="input-prepend">
					<div class="top-label"># of Children</div>
					<input class="required number" name="number_of_children" value="{{ $form->number_of_children }}" type="text" />
				</div>
			</div>
			<div class="">
				<div class="input-prepend">
					<div class="top-label" id="days-per-week">Days Per Week (Attendence)</div>
					<input class="required number" name="days_per_week" value="{{ $form->days_per_week }}" type="text" />
				</div>
			</div>
			<div class="">
				<div class="input-prepend">
					<div class="top-label">Tour Date</div>
					<input class="required" name="tour_date" id="tour-date" value="{{ $form->tour_date }}" type="text" />
				</div>
			</div>
			<div class="clear"></div>
			<div style="text-align:center;">
				<button class="btn btn-primary btn-large" type="submit">Submit</button>
			</div>
		</form>
	</div>
</div>
@stop