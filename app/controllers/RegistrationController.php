<?php
class RegistrationController extends BaseController {
	
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
		//**Note** Registration class validates the status before setting.
		$registration = Registration::find(Input::get('id'));
		$registration->status = Input::get('status');		
		$registration->save();		
		
		//return
		return Response::json(array('success' =>true));
	}
		
	public function getList() {		
		//check if user is authenticated, otherwise kick to login page
        if(Auth::check()) {
            $user = Auth::user();
        } else {
            return Redirect::route('login.form');
        }
		
		//allows for sending sort parameters.
		//default to ascending, if descending is sent override the default
		$order_type = Input::get('order_type', 'desc');
		$order = Input::get('order', 'created');	
		switch($order) {
			case "name":
				$query = Registration::orderBy('last_name', $order_type)->orderBy('first_name', $order_type);
			break;
			case "created":
			default:
				$query = Registration::orderBy('created_at', $order_type);
			break;
		}
				
		//check for parameter for search, locates if the phrase is found in first or last name.
		if(Input::has('search')) {
			$query->where(function($query) {
				$query->where('first_name', 'LIKE', '%'.Input::get('search').'%');
				$query->orWhere('last_name', 'LIKE', '%'.Input::get('search').'%');
			});
		}
		
		//check for status filter, trims down the result based on status
		$status = Input::get('status', 'Pending');
		switch($status) {
			case 'Pending':
			case 'Confirmed':
				$query->where('status', $status);
			break;
			case 'All':
			break;
		} 
		
		//set default of how many items to show per page, retrieves all records and calculates the total pages.
		$itemsPerPage = 10;
		$totalRecords = $query->count();
		$totalPages = ceil($totalRecords / $itemsPerPage);
		
		//check for page number, you can't navigate past the final page
		//if passed parameter is higher than max, set to the max
		//if passed parameter is lower than 1, set to page 1.
		//if nothing is sent, set to page 1.
		$page = Input::get('page', 1);		
		if($page > $totalPages) {
			$page = $totalPages;	
		}
		if($page <= 0) {
			$page = 1;	
		}		
		
		//calculate the skip records.
		$skip = ($page-1)*$itemsPerPage;
		
		//retrieve the set of records, send the skip and items per page
		$registrations = $query->skip($skip)->take($itemsPerPage)->get();
		
		//set the parameters for the inner list view
		//this view holds the actual list data.
		$items = View::make('registration.list.content');		
		$items->registrations = $registrations;
		$items->page = $page;
		$items->totalPages = $totalPages;
		
		//wrapping view, contains all the setup for the list.
		$view = View::make('registration.list');
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
			$registration = new Registration(Session::get('form-data'));
		} else {
			$registration = new Registration();
		}
		$view_data['form'] = $registration;
		return View::make('registration.form', $view_data);
	}
	
	public function postSave(){
		$registration = new Registration($_REQUEST);
		if($registration->isValid()) {
			$registration->save();
			return View::make('registration.save');
		} else {
			Session::flash('loginError', $registration->error());	
			Session::flash('form-data', $registration->toArray());
			return Redirect::route('registration.form');
		}
	}
	
	public function getDetails($id) {
		$registration = Registration::find($id);
		if($registration != null) {
			$view = View::make('registration.details');	
			$view->registration = $registration;
			return $view;
		} else {
			return Redirect::route('registration.list');	
		}
	}
		
}