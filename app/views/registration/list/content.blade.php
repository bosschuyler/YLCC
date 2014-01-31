@if(!$registrations->isEmpty())
    @foreach ($registrations as $registration)
        <div class="clear-after registration-row ">
            <div class="float-left bold"> <a href="{{ URL::Route('registration.details', array($registration->id)) }}">{{ $registration->last_name }}, {{ $registration->first_name }}</a> </div>
            <div class="float-right timestamp"> <span class="label-italic">Submitted:</span> {{ $registration->created_at }} </div>
            <div class="clear"></div>
            @if($registration->status != 'Confirmed')
				<div class="float-right"><div class="btn btn-success update-status" data-status="Confirmed" data-callback="{{ URL::route('registration.list') }}" data-url="{{ URL::route('registration.update.status') }}" data-id="{{ $registration->id }}">Confirm</div></div>
            @else
            	<span class="float-right" style="color:#3c763d">Confirmed <i class="glyphicon glyphicon-check"></i></span>
            @endif
            <div class="float-left"> 
                <div> {{ $registration->email }} </div>
                <div> {{ $registration->phone }} </div>
            </div>
            <div class="clear"></div>            
        </div>
    @endforeach
	<div>
        <ul class="pagination">
          	<li class="{{ ($page > 1) ? '' : 'disabled' }} "><a class="pagination-link" data-page="{{ $page-1 }}" href="#">Prev</a></li>
	       	<li class="{{ ($page < $totalPages) ? '' : 'disabled' }} "(><a class="pagination-link" data-page="{{ $page+1 }}" href="#">Next</a></li>
        </ul>
        <ul class="pagination">
        	<li class="active"><a href="#">Page {{ $page }} of {{ $totalPages }}</a></li>
        </ul>
	</div>
@else
    <div class="notice-area-error bold">
        No Registrations Found
    </div>
@endif