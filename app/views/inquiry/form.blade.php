@section('title')
	Contact - Young Life Child Care Services
@stop

@section('head')
<link href="/css/twitter-bs.css" rel="stylesheet" type="text/css">
<link href="/css/index/contact.css" rel="stylesheet" type="text/css">
<script src="/js/app/inquiry/form.js"></script> 
@stop

@section('content')
<div class="wrapper">
	<div class="tw-bs" style="width:390px; margin:auto;">
		<h1>Contact Us</h1>
		<div class="notice-area-blue margin-bottom-large" style="width:377px;">Want more information? Fill this out and send us your questions. We'll get back to you as soon as we can.</div>
		@if (Session::has('process-error'))
			<div class="notice-area-error margin-bottom-large">{{ Session::get('process-error') }}</div>
		@endif
		<form id="contact-form" action="{{ URL::route('inquiry.process') }}" method="post">
			<div>
				<div class="input-prepend"> <span class="add-on label">First Name</span>
					<input class="required" name="first_name" type="text" value="{{ $form->first_name }}" />
				</div>
				<br />
				<div class="input-prepend"> <span class="add-on label">Last Name</span>
					<input class="required" name="last_name" type="text" value="{{ $form->last_name }}" />
				</div>
				<br />
				<div class="input-prepend"> <span class="add-on label">Email Address</span>
					<input class="required email" name="email" type="text" value="{{ $form->email }}" />
				</div>
				<br />
				<div class="input-prepend"> <span class="add-on label">Phone</span>
					<input class="required phoneUS" name="phone" type="text" value="{{ $form->phone }}" />
				</div>
			</div>
			<div>
				<div class="input-prepend">
					<div class="top-label">Question/Comment</div>
					<textarea name="comment" id="inquery-comment" >{{ $form->comment }}</textarea>
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