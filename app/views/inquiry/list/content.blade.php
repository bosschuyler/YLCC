@if(count($inquiries) > 0)
    @foreach ($inquiries as $inquiry)
		<div class="clear-after inquiry-row">
			<div class="float-left bold"><a href="{{ URL::Route('inquiry.details', array($inquiry->id)) }}">{{ $inquiry->last_name }}, {{ $inquiry->first_name }}</a></div>
			<div class="float-right timestamp"> <span class="label-italic">Submitted:</span> {{ $inquiry->created_at }} </div>
			<div class="clear"></div>
            @if($inquiry->status != 'Read')
           		<div class="float-right"><div class="btn btn-success update-status" data-status="Read" data-callback="{{ URL::route('inquiry.list') }}" data-url="{{ URL::route('inquiry.update.status') }}" data-id="{{ $inquiry->id }}">Mark Read</div></div>
            @else
            	<span class="float-right" style="color:#3c763d">Read <i class="glyphicon glyphicon-check"></i></span>
            @endif
			<div class="float-left"> 
                <div> {{ $inquiry->email }} </div>
                <div> {{ $inquiry->phone }} </div>
            </div>
            <div class="clear"></div>
			<div class="clear description margin-top"> <span class="label-italic">Comment:</span> {{ $inquiry->comment }} </div>
        </div>
    @endforeach 
    <div >
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
        No Inquiries Found
    </div>
@endif