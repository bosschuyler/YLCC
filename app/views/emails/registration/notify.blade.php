<style>
	body {
		font-family:Arial, Helvetica, sans-serif;	
	}
</style>       
<h1>New Registration!</h1>
<div style="width:377px; background-color:#f1f4f7; border:1px solid #cbd7e2; padding:5px; border-radius:5px;">
    <table>
        <tr>
            <td>Name:</td><td>{{$registration->last_name}}, {{$registration->first_name}}</td>
        </tr>
        <tr>
            <td>Email:</td><td>{{$registration->email}}</td>
        </tr>
        <tr>
            <td>Phone:</td><td>{{$registration->phone}}</td>
        </tr>
        <tr>
            <td>Days Per Week:</td><td>{{$registration->days_per_week}}</td>
        </tr>
        <tr>
            <td># of Children:</td><td>{{$registration->number_of_children}}</td>
        </tr>
        <tr>
            <td>Tour Date:</td><td>{{$registration->tour_date}}</td>
        </tr>                    
    </table>
</div>
<h3><a href="{{ URL::route('registration.details', array($registration->id)) }}">View Registration</a></h3>

