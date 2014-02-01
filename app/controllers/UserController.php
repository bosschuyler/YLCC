<?php

class UserController extends BaseController {
    protected $layout = 'layouts.main';

    public function logout() {
        Auth::logout();
        return Redirect::to('login');
    }

	public function getLogin() {
		return View::make('user.login.form');
	}
    
	public function processLogin() {
        $login['username'] = $_REQUEST['username'];
        $login['password'] = $_REQUEST['password'];
    
        if (Auth::attempt($login)) {
			if(Session::has('attempted-route')) {
				$route = Session::get('attempted-route');
				Session::forget('attempted-route');
				return Redirect::to($route);	
			}
			
            return Redirect::route('inquiry.list');
        }
		
		Session::flash('LOGIN_RESPONSE', 'Failed to log-in successfully');
        Session::flash('USERNAME', $login['username']);
        return Redirect::to('login');
	}
	
	public function makeHash($password) {
		echo Hash::make($password);
		exit;
	}
	
}