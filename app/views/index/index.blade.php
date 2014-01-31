@section('title')
    Grand Haven Child Care Services
@stop



@section('head')

<link href="/laravel/css/style.css" rel="stylesheet" type="text/css">


<link href="/js/nivo/nivo-slider.css" rel="stylesheet" type="text/css">
<link href="/js/nivo/themes/default/default.css" rel="stylesheet" type="text/css">
<script src="http://code.jquery.com/jquery-1.9.1.min.js"></script> 
<script src="/js/nivo/jquery.nivo.slider.pack.js"></script> 
@stop



@section('content')
<div class="wrapper">
    <div role="main" class="main">
        <div class="columns"> 
        	<div class="row">
            	<div class="col-sm-6 margin-top"><img src="/img/slider/any6.jpg" style="width:100%" /></div>
                <div class="col-sm-6 margin-top">
                    <div class="notice-area-blue"> <span style="font-weight:bold; margin-right:5px;">Proverbs 22:6</span><span style="font-style:italic">(New King James Version)</span><br />
                        6 Train up a child in the way he should go,<br />
                        And when he is old he will not depart from it.<br />
                    </div>
                </div>
        </div>
        <div class="clear"></div>
        <div id='homepage-content'>
            <h2>What We Do</h2>
            <div class="well well-sm">
                <p>YLCC accommodates children 6 weeks to 12 years of age</p>
                <p>We are a curriculum based facility.  We utilize ZooPhonics and Handwriting Without tears in order to ensure younger children will have an easy transition into school age programs.</p>
                <p>We have three activity rooms separate from your child's normal classroom so that they get plenty of exposure to new and exciting things through out the day.  We have the sensory room for exploring the senses, the zoom room that has everything wheels, and job junction to learn about different careers and use imagination.</p>
            </div>
            <h2>Hours</h2>
            <div class="well well-sm">
                <p>Monday-Friday 6:45am first drop off to 6:00pm last pick up</p>
                <p style="font-style:italic">Young Life ChildCare Center has available drop off hours for pre-registered children during business hours.</p>
        	</div>
        </div>
        <div >
            <div class="slider-wrapper theme-default">
                <div id="slider" class="nivoSlider"> <img src="/img/slider/any6.jpg" height="250" alt="" /> </div>
            </div>
        </div>
    </div>
</div>
@stop 