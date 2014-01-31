@extends('layouts.main')
@section('title')
	Registration
@stop



@section('head')
<link href="/laravel/css/style.css" rel="stylesheet" type="text/css">
<link href="/css/twitter-bs.css" rel="stylesheet" type="text/css">
<style>
        .tw-bs .input-append .add-on, .tw-bs .input-prepend .label {
            width: 100px;
            text-align:left;
        }
        .tw-bs .input-append .add-on, .tw-bs .input-prepend input {
            width: 263px;
            text-align:left;
        }
        .rounded-label {
            width:150px;
            height: 20px;
            min-width: 16px;
            padding: 4px 5px;
            font-size: 14px;
            font-weight: 400;
            line-height: 20px;
            text-align: center;
            text-shadow: 0 1px 0 #fff;
            background-color: #eee;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        .top-label {
            width:150px;
            height: 20px;
            min-width: 16px;
            padding: 4px 5px;
            font-size: 14px;
            font-weight: 400;
            line-height: 20px;
            text-align: center;
            text-shadow: 0 1px 0 #fff;
            background-color: #eee;
            border: 1px solid #ccc;
            border-radius: 4px 4px 0px 0px;
            border-bottom:0px;
	        text-align:left;
        }
        .comment-field {
            height:100px;
        }        
    </style>
@stop

@section('content')
    <div class="wrapper">
        <div class="tw-bs" style="width:390px; margin:auto;">
            <h1>Thanks!</h1>
            <div class="notice-area-blue margin-bottom-large" style="width:377px;">We are glad you are interested in our child care center.  You should hear from us very soon.</div>
        </div>
    </div>
@stop