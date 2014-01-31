@extends('layouts.main')

@section('title')
	Admin Login
@stop

@section('head')
	<link href="/laravel/css/style.css" rel="stylesheet" type="text/css">
    <link href="/css/twitter-bs.css" rel="stylesheet" type="text/css">
@stop

@section('content')
	<div class="wrapper">
    	<div class="tw-bs" style="width:390px; margin:auto;">
        	<h1>Admin Login</h1>
			<form action="{{ URL::route('login.process') }}" method="post">
            	<div class="">
                	<div class="error-notice">{{ Session::get('LOGIN_RESPONSE'); }}</div>
                    <div class="input-prepend">
                        <span class="add-on label">Username</span>
                        <input name="username" type="text" value="{{ Session::get('USERNAME') }}" />
                    </div>
                    <br />
                    <div class="input-prepend">
                        <span class="add-on label">Password</span>
                        <input name="password" type="password" />
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