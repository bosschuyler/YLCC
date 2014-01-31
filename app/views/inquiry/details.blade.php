@extends('layouts.main')
@section('title')
	Registration
@stop

@section('head')
<script src="/js/app/inquiry.js"></script>
<link href="/laravel/css/style.css" rel="stylesheet" type="text/css">
<link href="/css/bootstrap.min.css" rel="stylesheet" type="text/css">
@stop

@section('content')
<div class="wrapper">
	<div>    	
        <div class="clearfix">
        	<div class="float-left">
                <h1 style="margin:0">{{ $inquiry->first_name }} {{ $inquiry->last_name }}</h1>        
                <div class="timestamp"><span class="label-italic">Submitted:</span> {{ $inquiry->created_at }}</div>
                @if($inquiry->status == 'Read')
                	<div class="timestamp"><span class="label-italic">Read At:</span> {{ $inquiry->read_at }}</div>
            	@else
                	<div class="btn btn-success update-status" data-status="Read" data-id="{{ $inquiry->id }}" data-url="{{ URL::route('inquiry.update.status') }}" data-callback="{{ URL::route('inquiry.details', array($inquiry->id)) }}"><strong>Mark Read</strong></div>
                @endif
            </div>
		</div>
        <br />
        <div class="clearfix">
            <div class="detail-card float-left">
                <div class="detail-row clearfix">
                    <div class="detail-column"><div class="label label-primary">Email:</div></div>
                    <div class="detail-data">{{ $inquiry->email }}</div>
                </div>
                
                <div class="detail-row clearfix">
                    <div class="detail-column"><span class="label label-primary">Phone:</span></div>
                    <div class="detail-data">{{ $inquiry->phone }}</div>
                </div>
            </div>
            
            <div class="clear"></div>
            <br>
            
	        <div class="float-left text-center panel panel-primary" style="width:300px;">
                <div class="panel-heading"><strong>Comment</strong></div>
                <div class="text-left well-sm" >{{ $inquiry->comment }}</div>
            </div>
        </div>
        
			
		
</div>
@stop