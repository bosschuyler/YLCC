<?php
	use Mailgun\Mailgun;

    class MailSender {
		
		protected $from = array();
		protected $to = array();
		
		protected $subject = '';
		protected $htmlBody = '';
		protected $textBody = '';
		
		protected $domain = 'younglifecc.com';
		protected $auth_key = 'key-56c3cbn9rwxl75pvd3u5bp02iaxp10c0';
		protected $senderObject = null;

		public function __construct() {
			$this->senderObject = new Mailgun($this->auth_key);	
			$this->addFrom("no-reply@younglifecc.com", "Young Life Childcare Center");
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
		
		public function setHtml($value) {
			$this->htmlBody = $value;	
		}
		
		public function getHtml() {
			return $this->htmlBody;	
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