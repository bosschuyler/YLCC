@extends('layouts.main')
@section('title')
	Registration
@stop

@section('head')
<script src="/js/app/registration.js"></script>
<link href="/laravel/css/style.css" rel="stylesheet" type="text/css">
<link href="/css/bootstrap.min.css" rel="stylesheet" type="text/css">
@stop

@section('content')
<div class="wrapper">
	<div>
    	
        <div class="clearfix">
        	<div class="float-left">
                <h1 style="margin:0">{{ $registration->first_name }} {{ $registration->last_name }}</h1>        
                <div class="timestamp"><span class="label-italic">Submitted:</span> {{ $registration->created_at }}</div>
                @if($registration->status == 'Confirmed')
                	<div class="timestamp"><span class="label-italic">Confirmed:</span> {{ $registration->confirmed_at }}</div>
            	@else
                	<div class="btn btn-success update-status" data-status="Confirmed" data-id="{{ $registration->id }}" data-url="{{ URL::route('registration.update.status') }}" data-callback="{{ URL::route('registration.details', array($registration->id)) }}"><strong>Confirm</strong></div>
                @endif
                <div class="btn btn-danger delete" data-id="{{ $registration->id }}" data-url="{{ URL::route('registration.delete') }}" data-callback="{{ URL::route('registration.list') }}"><i class="glyphicon glyphicon-remove"></i> Delete</div>
            </div>
		</div>
        <br />
        <div class="clearfix">
            <div class="detail-card float-left">
                <div class="detail-row clearfix">
                    <div class="detail-column"><div class="label label-primary">Email:</div></div>
                    <div class="detail-data">{{ $registration->email }}</div>
                </div>
                
                <div class="detail-row clearfix">
                    <div class="detail-column"><span class="label label-primary">Phone:</span></div>
                    <div class="detail-data">{{ $registration->phone }}</div>
                </div>
                
                <div class="detail-row clearfix">
                    <div class="detail-column"><span class="label label-primary"># of Children:</span></div>
                    <div class="detail-data">{{ $registration->number_of_children }}</div>
                </div>
                
                <div class="detail-row clearfix">
                    <div class="detail-column"><span class="label label-primary">Days Per Week:</span></div>
                    <div class="detail-data">{{ $registration->days_per_week }}</div>
                </div>   
            </div>
            
            <div class="clear"></div>
            <br>
            
	        <div class="float-left text-center panel panel-primary">
                <div class="panel-heading"><strong>Tour Date <i class="glyphicon glyphicon-calendar"></i></strong></div>
                <h4 >{{ $registration->tour_date }}</h4>
            </div>
        </div>
        
			
		
</div>
@stop