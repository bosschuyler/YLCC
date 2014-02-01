<style>
	body {
		font-family:Arial, Helvetica, sans-serif;	
	}
</style>       
<h1>New Inquiry!</h1>
<div style="width:377px; background-color:#f1f4f7; border:1px solid #cbd7e2; padding:5px; border-radius:5px;">
    <table>
        <tr>
            <td>Name:</td><td>{{$inquiry->last_name}}, {{$inquiry->first_name}}</td>
        </tr>
        <tr>
            <td>Email:</td><td>{{$inquiry->email}}</td>
        </tr>
        <tr>
            <td>Phone:</td><td>{{$inquiry->phone}}</td>
        </tr>
        <tr>
            <td colspan="2">Comment: {{$inquiry->comment}}</td>
        </tr>                    
    </table>
</div>

