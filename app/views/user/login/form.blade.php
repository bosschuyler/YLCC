@extends('layouts.main')

@section('title')
	Admin Login
@stop

@section('head')
 
	<link href="/laravel/css/style.css" rel="stylesheet" type="text/css">
   
@stop

@section('content')
	<div class="wrapper row">
    	<div class="col-sm-6 col-sm-offset-3 col-xs-12">
        	<h1>Admin Login</h1>
			<form class="custom-form" action="{{ URL::route('login.process') }}" method="post">
                @if( Session::has('LOGIN_RESPONSE') )
                	<div class="notice-area-error margin-bottom">{{ Session::get('LOGIN_RESPONSE'); }}</div>
                @endif
                <div class="input-group">
                    <span class="input-group-addon">Username</span>
                    <input class="form-control" name="username" type="text" value="{{ Session::get('USERNAME') }}" />
                </div>
                <div class="input-group">
                    <span class="input-group-addon">Password</span>
                    <input class="form-control" name="password" type="password" />
                </div>
                
            	<div class="text-center">
          			<button class="btn btn-primary btn-large" type="submit">Submit</button>
                </div>
            </form>     
		</div>
    </div>
@stop