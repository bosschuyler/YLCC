<?php
	namespace Bos\Mail;
	
	use Mailgun\Mailgun;
	use Illuminate\Support\Facades\Config;
	use Illuminate\View\Environment;
    class Mail {
		
		protected $from = array();
		protected $to = array();
		
		protected $subject = '';
		protected $htmlBody = '';
		protected $textBody = '';
		
		protected $domain = '';
		protected $senderObject = null;
		protected $view = null;

		public function __construct() {
			$from = Config::get('mail::mail.from');
			$this->setDomain(Config::get('mail::mail.domain'));
			$this->senderObject = new Mailgun(Config::get('mail::mail.auth_key'));	
			$this->addFrom($from['email'], $from['name']);
		}
		
		public function setDomain($value) {
			$this->domain = $value;
		}
		
		public function subject($value) {
			$this->subject = $value;	
		}
		
		public function getSubject() {
			return $this->subject;	
		}
		
		public function setText($value) {
			$this->textBody = $value;	
		}
		
		public function getText() {
			return $this->textBody;	
		}
		
		public function html($value) {
			$this->htmlBody = $value;	
		}
		
		public function getHtml() {
			return $this->htmlBody;	
		}
		
		public function setView(Environment $view) {
			$this->view = $view;
		}
		
		public function addTo($email, $name="") {
			$to = '';
			if(!empty($name)) {
				$to = $name.'<'.$email.'>';
			}else{
				$to = $email;	
			}
			$this->to[] = $to;
		}
		
		public function getTo() {
			$temp = '';
			foreach($this->to as $data) {
				$temp .= $data.';';
			}
			$temp = rtrim($temp, ';');
			return $temp;
		}
		
		public function addFrom($email, $name="") {
			$from = '';
			if(!empty($name)) {
				$from = $name.'<'.$email.'>';
			}else{
				$from = $email;	
			}
			$this->from[] = $from;
		}
		
		public function getFrom(){
			$temp = '';
			foreach($this->from as $data) {
				$temp .= $data.';';
			}
			$temp = rtrim($temp, ';');
			return $temp;
		}
		
		public function send() {
			
			$this->senderObject->sendMessage($this->domain, array(
				'from'    => $this->getFrom(),
				'to'      => $this->getTo(),
				'subject' => $this->getSubject(),
				'text'    => $this->getText(),
				'html'    => $this->getHtml(),
			));
		}
		
    }

?>