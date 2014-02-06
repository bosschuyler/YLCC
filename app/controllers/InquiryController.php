<?php
class InquiryController extends BaseController {

	public $layout = 'layouts.main';
	
	public function postUpdateStatus() {
		//check if this is a valid user
		//else return the login route to the calling JS
		if(Auth::check()) {
            $user = Auth::user();
        } else {
			return Response::json(array('success' =>false, 'location' => URL::route('login.form')) );
        }
		
		//Retrieve the inquiry by the ID, set the passed status
		//and save the DB
		//**Note** ContactInquiry class validates the status before setting.
		$inquiry = ContactInquiry::find(Input::get('id'));
		$inquiry->status = Input::get('status');
		$inquiry->save();
		
		//return the redirection JSON route to the JS function.
		return Response::json(array('success' =>true, 'location' => URL::route('inquiry.list')) );
	}
	
	public function postDelete() {
		//check if this is a valid user
		//else return the login route to the calling JS
		if(Auth::check()) {
            $user = Auth::user();
        } else {
			return Response::json(array('success' =>false, 'location' => URL::route('login.form')) );
        }
		
		//Retrieve the inquiry by the ID, set the passed status
		//and remove
		$inquiry = ContactInquiry::find(Input::get('id'));
		$inquiry->delete();
		
		//return
		return Response::json(array('success' =>true));
	}
	
	public function getList() {
		//check if this is a valid user.
        if(Auth::check()) {
            $user = Auth::user();
        } else {
            return Redirect::route('login.form');
        }
        
		//allows for sending sort parameters.
		//default to ascending, if descending is sent override the default    	
		//only certain parameters are sortable, created timestamp is default.	
		if(Input::has('order')) {
			$order_type = 'asc';
			if(Input::has('order_type')) {
				if( (Input::get('order_type')) == 'desc'){
					$order_type = Input::get('order_type');
				}
			}			
						
			$order = Input::get('order');
			switch($order) {
				case "name":
					$query = ContactInquiry::orderBy('last_name', $order_type)
						->orderBy('first_name', $order_type);
				break;
				case "created":
				default:
					$query = ContactInquiry::orderBy('created_at', $order_type);
				break;
			}
		} else {
			$query = ContactInquiry::orderBy('created_at', 'desc');	
		}		
		
		//check for parameter for search, locates if the phrase is found in first or last name.
		if(Input::has('search')) {
			$query->where(function($query) {
				$query->where('first_name', 'LIKE', '%'.Input::get('search').'%');
				$query->orWhere('last_name', 'LIKE', '%'.Input::get('search').'%');
			}); 
		}
		
		//check for status filter, trims down the result based on status
		if(Input::has('status')) {
			$status = Input::get('status');
			switch($status) {
				case 'New':
				case 'Read':
					$query->where('status', $status);
				break;
				case 'All':
				break;
			}
		} else {
			$query->where('status', 'New');	
		}
		
		//set default of how many items to show per page, retrieves all records and calculates the total pages.
		$itemsPerPage = 10;
		$totalRecords = $query->count();
		$totalPages = ceil($totalRecords / $itemsPerPage);
		
		//check for page number, you can't navigate past the final page
		//if passed parameter is higher than max, set to the max
		//if passed parameter is lower than 1, set to page 1.
		//if nothing is sent, set to page 1.
		if(Input::has('page')) {
			$page = Input::get('page');
			if($page > $totalPages) {
				$page = $totalPages;	
			}
			if($page <= 0) {
				$page = 1;	
			}		
		} else {
			$page = 1;
		}
		//calculate the skip records.
		$skip = ($page-1)*$itemsPerPage;
		
		//retrieve the set of records, send the skip and items per page
		$inquiries = $query->skip($skip)->take($itemsPerPage)->get();
		
		//set the parameters for the inner list view
		//this view holds the actual list data.
		$items = View::make('inquiry.list.content');
		$items->inquiries = $inquiries;
		$items->page = $page;
		$items->totalPages = $totalPages;
		
		//wrapping view, contains all the setup for the list.
		$view = View::make('inquiry.list');
		$view->items = $items;
		
		//in an ajax call the wrapper is already there
		//just need to swap out the inner content
		if(Request::ajax()) {
			return $items;
		}
		return $view;
    }
	
	public function getForm() {
		$view_data = array();		
		if(Session::has('form-data')) {
			$contact_inquiry = new ContactInquiry(Session::get('form-data'));
		} else {
			$contact_inquiry = new ContactInquiry();
		}
		$view_data['form'] = $contact_inquiry;
		$this->layout->content = View::make('inquiry.form', $view_data);

	}

	public function postSave(){
		$contact_inquiry = new ContactInquiry($_REQUEST);
		if($contact_inquiry->isValid()) {
			$contact_inquiry->save();
			
			//ADMIN NOTIFY
			$view = View::make('emails.inquiry.notify');
			$view->inquiry = $contact_inquiry;
			
			$mail = App::make('mail');
			$mail->addTo('schuyler.bos@gmail.com', 'Schuyler Bos');
			$mail->subject("New Inquiry");
			$mail->html($view);
			$mail->send();
			
			//USER NOTIFY
			$user_view = View::make('emails.inquiry.user-notify');
			$user_view->inquiry = $contact_inquiry;
			
			$user_mail = App::make('mail');
			$user_mail->addTo('schuyler.bos@gmail.com', 'Schuyler Bos');
			$user_mail->subject("Request Received!");
			$user_mail->html($user_view);
			$user_mail->send();
			
			return View::make('inquiry.save');
		} else {
			Session::flash('process-error', $contact_inquiry->error());	
			Session::flash('form-data', $contact_inquiry->toArray());
			return Redirect::route('inquiry.form');
		}
	}
	
	public function getDetails($id) {
		//check if this is a valid user.
        if(Auth::check()) {
            $user = Auth::user();
        } else {
			Session::put('attempted-route', Request::url());
            return Redirect::route('login.form');
        }
		
		//grab the inquiry by the id sent in the URI.
		//if it exists return the details view populated with data.
		//else return to the inquiry list page
		$inquiry = ContactInquiry::find($id);
		if($inquiry != null) {
			$view = View::make('inquiry.details');
			$view->inquiry = $inquiry;	
			return $view;
		} else {
			return Redirect::route('inquiry.list');	
		}
	}
}