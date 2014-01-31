@extends('layouts.main')

@section('title')
	Pre-Register Requests
@stop

@section('head')
	<link href="/css/bootstrap.min.css" rel="stylesheet" type="text/css">
	<script src="/js/app/registration.js"></script>

	<style>
		.wrapper {
			line-height: 18px;
		}
		.registration-row {
			border-bottom: 2px solid #ECECEC;
			padding:5px;
		}
	</style>
@stop

@section('content')
    <div class="wrapper">
        <div style="margin:auto;">
            <h1>Pre-Registrations</h1>
            <br />
              
           	<div class="input-group search-group"> <span class="input-group-addon">Search</span>
				<input class="form-control" name="search" id="search" type="text" />
			</div>			
            
            <div class="float-left clear-after margin-left-large">
                <div class="float-left group-label">Sort:</div>
                <div class="float-left btn-group">            	
                    <div class="btn btn-default sort-link" data-order-type="asc" data-default="asc" data-order="name">Name</div>
                    <div class="btn btn-default sort-link active" data-order-type="desc" data-default="desc" data-order="created">Created<i class="glyphicon glyphicon-arrow-down"></i></div>
                </div>
			</div>
            
            <div class="float-right clear-after">
                <div class="float-left group-label">Status:</div>
                <div class="float-left btn-group">            	
                    <div class="btn btn-default status-link" data-status="All">All</div>
                    <div class="btn btn-default status-link" data-status="Confirmed">Confirmed</div>
                    <div class="btn btn-default status-link active" data-status="Pending">Pending</div>
                </div>
            </div>
            
            <div class="clear"></div>
            <br />
            
            <div id="list-content" data-url="{{ URL::route('registration.list') }}">
            	{{ $items }}
			</div>
		</div>
    </div>
@stop