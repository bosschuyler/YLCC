<?php



class ContactInquiry extends Eloquent {
	protected $fillable = array('first_name', 'last_name', 'phone', 'email', 'comment');

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */

	protected $valid_status = array('New','Read');
	
	protected $table = 'contact_inquiry';
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
			$this->error = "Email Address is empty";
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
				
		return true;
	}
	
	public function error() {
		return $this->error;
	}
	
	public function setStatusAttribute($value) {
		if(in_array($value, $this->valid_status)) {
			$this->attributes['status'] = $value;
			if($value == 'Read') {
				$this->read_at = new DateTime;
			}
		}
	}
	
	public function getCreatedAtAttribute($value) {
		if(!empty($value) && ($timestamp = strtotime($value)) != false) {
			return date('m/d/Y g:i a', $timestamp);
		} else {
			return '';
		}		
	}
	
	public function getReadAtAttribute($value) {
		if(!empty($value) && ($timestamp = strtotime($value)) != false) {
			return date('m/d/Y g:i a', $timestamp);
		} else {
			return 'N/A';
		}		
	}

}