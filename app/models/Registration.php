<?php



class Registration extends Eloquent {
	protected $fillable = array('first_name', 'last_name', 'phone', 'email', 'number_of_children', 'days_per_week', 'tour_date');

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */

	protected $valid_status = array('Confirmed','Pending');

	protected $table = 'registration';
	protected $error = '';
	public function isValid() {		
		if(empty($this->first_name)) {
			$this->error = 'First Name is empty';
			return false;
		}
		
		if(empty($this->last_name)) {
			$this->error = 'Last Name is empty';
			return false;
		}
		
		if(empty($this->email)) {
			$this->error = "Email address is empty";
			return false;		
		} else {
			$email_validator = new EmailValidator($this->email);
			if(!$email_validator->isValid()) {
				$this->error = $email_validator->error();
				return false;	
			}
		}
		
		if(empty($this->phone)) {
			$this->error = 'Phone is empty';
			return false;
		}
		
		//create a validation for a number in order to simplify this validation checking process.
		if(empty($this->number_of_children)) {
			$this->error = 'Number of Children is empty';
			return false;	
		} else {
			if(!is_numeric($this->number_of_children)) {
				$this->error = 'Number of Children is not a number';
				return false;
			}
		}
		
		//create a validation for a number in order to simplify this validation checking process.
		if(empty($this->days_per_week)) {
			$this->error = 'Number of Days per Week is empty';
			return false;	
		} else {
			if(!is_numeric($this->days_per_week)) {
				$this->error = 'Number of Days per Week is not a number';
				return false;
			}
		}
		
		//create a validation for the date to simplify process.
		if(empty($this->tour_date)) {
			$this->error = 'Tour Date is not set';
			return false;	
		}
				
		return true;
	}
	
	public function setStatusAttribute($value) {
		if(in_array($value, $this->valid_status)) {
			$this->attributes['status'] = $value;
			if($value == 'Confirmed') {
				$this->confirmed_at = new DateTime;
			}
		}
	}
	
	public function setTourDateAttribute($value) {
		$tour_date = '';
		if(!empty($value) && ($timestamp = strtotime($value)) != false) {
			$tour_date = date('Y-m-d', strtotime($value));
		}
		$this->attributes['tour_date'] = $tour_date;
	}
	
	public function getTourDateAttribute($value) {
		if(!empty($value) && ($timestamp = strtotime($value)) != false) {
			return date('m/d/Y', $timestamp);
		} else {
			return '';
		}		
	}
	
	public function getCreatedAtAttribute($value) {
		if(!empty($value) && ($timestamp = strtotime($value)) != false) {
			return date('m/d/Y g:i a', $timestamp);
		} else {
			return '';
		}		
	}
	
	public function getConfirmedAtAttribute($value) {
		if(!empty($value) && ($timestamp = strtotime($value)) != false) {
			return date('m/d/Y g:i a', $timestamp);
		} else {
			return 'N/A';
		}		
	}
	
	public function error() {
		return $this->error;
	}

}