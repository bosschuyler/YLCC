@extends('layouts.main')

@section('title')
	Contact - Youth Life Child Care Center
@stop

@section('head')
	<link href="/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <script src="/js/app/inquiry.js"></script>
<style>
		.wrapper {
			line-height: 18px;	
		}
		.inquiry-row {
			border-bottom: 2px solid #EEE;
			padding:5px;
		}
		.description {
			font-size:12px;
		}
		.margin-top {
			margin-top: 10px;
		}
		
		.label-italic {
			font-style:italic;
			margin-right:5px;
		}
		.timestamp {
			color: #999;
		}
	</style>
@stop

@section('content')
	<div class="wrapper">
        <div style="margin:auto;">
            <h1>Inquiries</h1>
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
                    <div class="btn btn-default status-link active" data-status="New">New</div>
                    <div class="btn btn-default status-link" data-status="Read">Read</div>
                </div>
            </div>
            
            <div class="clear"></div>
            <br />
            
            <div id="list-content" data-url="{{ URL::route('inquiry.list') }}">
            	{{ $items }}
			</div>
		</div>
    </div>
@stop