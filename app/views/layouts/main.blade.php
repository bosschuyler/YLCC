<!doctype html>

<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<title>@yield('title')</title>
	<meta name="viewport" content="width=device-width">
    <link href="/css/bootstrap.min.css" rel="stylesheet" type="text/css">
	<link href="/css/layout/global.css" rel="stylesheet" type="text/css">
	<link href="/css/layout/main.css" rel="stylesheet" type="text/css">
	<link href="/laravel/css/style.css" rel="stylesheet" type="text/css">
	<script src="/js/jquery-1.9.1.min.js"></script>
	<script src="/js/jquery/validate-1.11.1.min.js"></script>
	<script src="/js/jquery/validate-additions-1.11.1.min.js"></script>
    <script src="/js/app/layout/general.js"></script>
	@yield('head')
</head>

<body>
<div class="bg-fader"></div>
<div class="main-wrapper">
	<div class="header-wrapper">
		<img src="/img/main/logo.png">
	</div>
	<div class="body-wrapper shadow">
    	
    	@if(Auth::check())
			<div class="menu-bar clearfix"> 
            	<div class="visible-xs menu-toggle menu-link menu-link-active">
                	<div class="float-left">Menu <i class="glyphicon glyphicon-list"></i></div>
                    <div class="float-right"><i class="toggle-icon glyphicon glyphicon-plus"></i></div>
				</div>  
                <div class="hidden-xs toggleable">
                    <a href=" {{ URL::route('home') }}">
                    <div class="menu-link {{ (Route::currentRouteName() == 'home') ? 'menu-link-active' : '' }}">Home</div>
                    </a> <a href="{{ URL::route('registration.list') }}">
                    <div class="menu-link {{ (Route::currentRouteName() == 'registration.list') ? 'menu-link-active' : '' }}">Registrations</div>
                    </a> <a href="{{ URL::route('inquiry.list') }}">
                    <div class="menu-link {{ (Route::currentRouteName() == 'inquiry.list') ? 'menu-link-active' : '' }}">Contact Inquiries</div>
                    </a> <a href="{{ URL::route('logout') }}">
                    <div class="menu-link {{ (Route::currentRouteName() == 'logout') ? 'menu-link-active' : '' }}">Log-out</div>
                    </a> 
                </div>
			</div>
		@else
			<div class="menu-bar clearfix"> 
            	<div class="visible-xs menu-toggle menu-link menu-link-active">
                	<div class="float-left">Menu <i class="glyphicon glyphicon-list"></i></div>
                    <div class="float-right"><i class="toggle-icon glyphicon glyphicon-plus"></i></div>
				</div> 
                <div class="hidden-xs toggleable">
                    <a href="{{ URL::route('home') }}"> 
                    <div class="menu-link {{ (Route::currentRouteName() == 'home') ? 'menu-link-active' : '' }}">Home</div>
                    </a> <a href="{{ URL::route('menu') }}">
                    <div class="menu-link {{ (Route::currentRouteName() == 'menu') ? 'menu-link-active' : '' }}">Menu</div>
                    </a> <a href="{{ URL::route('activity') }}">
                    <div class="menu-link {{ (Route::currentRouteName() == 'activity') ? 'menu-link-active' : '' }}">Activity Schedule</div>
                    </a> <a href="{{ URL::route('facility') }}">
                    <div class="menu-link {{ (Route::currentRouteName() == 'facility') ? 'menu-link-active' : '' }}">Our Facility</div>
                    </a> <a href="{{ URL::route('inquiry.form') }}">
                    <div class="menu-link {{ (Route::currentRouteName() == 'inquiry.form') ? 'menu-link-active' : '' }}">Contact Us</div>
                    </a> <a href="{{ URL::route('registration.form') }}">
                    <div class="menu-link {{ (Route::currentRouteName() == 'registration.form') ? 'menu-link-active' : '' }}">Pre-Register</div>
                    </a> <a href="{{ URL::route('about') }}">
                    <div class="menu-link {{ (Route::currentRouteName() == 'about') ? 'menu-link-active' : '' }}">About Us</div>
                    </a> <a href="{{ URL::route('login.form') }}">
                    <div class="menu-link {{ (Route::currentRouteName() == 'login.form') ? 'menu-link-active' : '' }}">Login</div>
                    </a> 
                </div>
			</div>
		@endif
		@yield('content') 
	</div>
</div>
</body>
</html>
