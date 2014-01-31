@extends('layouts.main')

@section('title')
	Admin Login
@stop

@section('head')
	<link href="/laravel/css/style.css" rel="stylesheet" type="text/css">
    <link href="/css/bootstrap.min.css" rel="stylesheet" type="text/css">
@stop

@section('content')
	<div class="wrapper">
    	<div class="tw-bs text-center" style="width:380px; margin:auto;">
        	<h1>Admin Login</h1>
			<form action="{{ URL::route('login.process') }}" method="post">
                @if( Session::has('LOGIN_RESPONSE') )
                	<div class="alert alert-danger">{{ Session::get('LOGIN_RESPONSE'); }}</div>
                @endif
                <div class="input-group">
                    <span class="input-group-addon">Username</span>
                    <input class="form-control" name="username" type="text" value="{{ Session::get('USERNAME') }}" />
                </div>
                <br />
                <div class="input-group">
                    <span class="input-group-addon">Password</span>
                    <input class="form-control" name="password" type="password" />
                </div>
                <div class="clear"></div><br />
            	<div style="text-align:center;">
          			<button class="btn btn-primary btn-large" type="submit">Submit</button>
                </div>
            </form>     
		</div>
    </div>
@stop