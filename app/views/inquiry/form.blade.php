@section('title')
	Contact - Young Life Child Care Services
@stop

@section('head')

<link href="/css/index/contact.css" rel="stylesheet" type="text/css">
<script src="/js/app/inquiry/form.js"></script> 
@stop

@section('content')
<div class="wrapper row text-center">
	<div class="col-sm-6 col-sm-offset-3 col-xs-12">
    	<div class="row">
			<h1 class="text-left">Contact Us</h1>
        </div>
        <div class="row">
            <div class="col-xs-12 notice-area-blue margin-bottom-large text-left">Want more information? Fill this out and send us your questions. We'll get back to you as soon as we can.</div>
            @if (Session::has('process-error'))
                <div class="col-xs-12 notice-area-error margin-bottom-large">{{ Session::get('process-error') }}</div>
            @endif
		</div>
        <div class="custom-form row">
            <form id="contact-form" action="{{ URL::route('inquiry.process') }}" method="post">
				<div class="input-group"> <span class="input-group-addon">First Name</span>
                    <input class="required form-control" name="first_name" type="text" value="{{ $form->first_name }}" />
                </div>                    
                <div class="input-group"> <span class="input-group-addon">Last Name</span>
                    <input class="required form-control" name="last_name" type="text" value="{{ $form->last_name }}" />
                </div>                    
                <div class="input-group"> <span class="input-group-addon">Email Address</span>
                    <input class="required email form-control" name="email" type="text" value="{{ $form->email }}" />
                </div>                    
                <div class="input-group"> <span class="input-group-addon">Phone</span>
                    <input class="required phoneUS form-control" name="phone" type="text" value="{{ $form->phone }}" />
                </div>                
                <div class="input-group col-xs-12">
                    <div class="top-label">Question/Comment</div>
                    <textarea class="form-control" name="comment" id="inquery-comment" >{{ $form->comment }}</textarea>
                </div>                
                <div class="text-center">
                    <button class="btn btn-primary btn-large" type="submit">Submit</button>
                </div>
            </form>
		</div>
	</div>
</div>
@stop