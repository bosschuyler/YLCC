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
	</style>
@stop

@section('content')
	<div class="wrapper">
    	<div class="row">
			<div class="col-sm-12">
           		<h1>Inquiries</h1>
            </div>
        </div>
		<div class="row">
           	<div class="col-sm-4 margin-bottom">
                <div class="input-group"> <span class="input-group-addon">Search</span>
                    <input class="form-control" name="search" id="search" type="text" />
                </div>			
            </div>
           
           	<div class="col-sm-4 margin-bottom">
                <div class="row">
                    <div class="col-xs-3 col-sm-2 group-label">Sort:</div>
                    <div class="col-xs-9 col-sm-10">       
                    	<div class="btn-group">     	
                            <div class="btn btn-default sort-link" data-default="asc" data-order="name">Name</div>
                            <div class="btn btn-default sort-link active" data-default="desc" data-order="created">Created<i class="glyphicon glyphicon-arrow-down"></i></div>
                        </div>
                    </div>
                </div>
			</div>
            
            <div class="col-sm-4 margin-bottom">
                <div class="row">
                    <div class="col-xs-3 col-sm-3 group-label">Status:</div>
                    <div class="col-xs-9 col-sm-9">
                        <div class="btn-group">            	
                            <div class="btn btn-default status-link" data-status="All">All</div>
                            <div class="btn btn-default status-link active" data-status="New">New</div>
                            <div class="btn btn-default status-link" data-status="Read">Read</div>
                        </div>
					</div>
                </div>
            </div>
		</div>
        <div class="row">
        	<div class="col-sm-12 margin-bottom">            
                <div id="list-content" data-url="{{ URL::route('inquiry.list') }}">
                    {{ $items }}
                </div>
            </div>
		</div>
    
    </div>
@stop