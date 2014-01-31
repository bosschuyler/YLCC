<?php

    class EmailValidator {

		public $email;
		public $local;
		public $domain;

		public $error;

		public function __construct($email) {
			$this->email = $email;
		}

		// Might be smart to put in a validator class.
		public function error() {
			return $this->error;
		}

		public function local($local) {
			$this->local = $local;
		}

		public function domain($domain) {
			$this->domain = $domain;
		}

		/**
         * Check email address validity
         * @param   this->email     Email address to be checked
         * @return  True if email is valid, false if not
         */
		public function isValid() {
			if(!empty($this->email)) {
				// If magic quotes is "on", email addresses with quote marks will
				// fail validation because of added escape characters. Uncommenting
				// the next three lines will allow for this issue.
				//if (get_magic_quotes_gpc()) {
				//    $this->email = stripslashes($this->email);
				//}

				// Control characters are not allowed
				if (preg_match('/[\x00-\x1F\x7F-\xFF]/', $this->email)) {
					$this->error = 'Email contains illegal characters.';
					return false;
				}

				// Check email length - min 3 (a@a), max 256
				if (!$this->check_text_length($this->email, 3, 256)) {
					$this->error = 'Email length is not valid.';
					return false;
				}

				// Split it into sections using last instance of "@"
				$intAtSymbol = strrpos($this->email, '@');
				if ($intAtSymbol === false) {
					$this->error = 'Email address is missing an @ symbol.';
					// No "@" symbol in email.
					return false;
				}
				$arrEmailAddress[0] = substr($this->email, 0, $intAtSymbol);
				$arrEmailAddress[1] = substr($this->email, $intAtSymbol + 1);

				// Count the "@" symbols. Only one is allowed, except where
				// contained in quote marks in the local part. Quickest way to
				// check this is to remove anything in quotes. We also remove
				// characters escaped with backslash, and the backslash
				// character.
				$arrTempAddress[0] = preg_replace('/\./'
												 ,''
												 ,$arrEmailAddress[0]);
				$arrTempAddress[0] = preg_replace('/"[^"]+"/'
												 ,''
												 ,$arrTempAddress[0]);
				$arrTempAddress[1] = $arrEmailAddress[1];
				$strTempAddress = $arrTempAddress[0] . $arrTempAddress[1];
				// Then check - should be no "@" symbols.
				if (strrpos($strTempAddress, '@') !== false) {
					$this->error = 'There are multiple @ symbols in this email.';
					// "@" symbol found
					return false;
				}

				// Check local portion
				$this->local($arrEmailAddress[0]);
				if (!$this->check_local_portion()) {
					$this->error = 'This mailbox name is not valid.';
					return false;
				}

				$this->domain($arrEmailAddress[1]);

				// Check domain portion
				if (!$this->check_domain_portion()) {
					$this->error = 'This emails domain is an invalid format.';
					return false;
				}

				if(!$this->check_mx_record()) {
					$this->error = 'No DNS was located for this email address.';
					return false;
				}

				// If we're still here, all checks above passed. Email is valid.
				return true;
			}
			return false;
		}

        protected function check_mx_record() {
			$record = 'MX';
			$parts = explode('@', $this->email);
 			return checkdnsrr($parts[1], $record);
		}


        /**
         * Checks email section before "@" symbol for validity
         * @param   this->local     Text to be checked
         * @return  True if local portion is valid, false if not
         */
        protected function check_local_portion() {
            // Local portion can only be from 1 to 64 characters, inclusive.
            // Please note that servers are encouraged to accept longer local
            // parts than 64 characters.
            if (!$this->check_text_length($this->local, 1, 64)) {
                return false;
            }
            // Local portion must be:
            // 1) a dot-atom (strings separated by periods)
            // 2) a quoted string
            // 3) an obsolete format string (combination of the above)
            $arrLocalPortion = explode('.', $this->local);
            for ($i = 0, $max = sizeof($arrLocalPortion); $i < $max; $i++) {
                 if (!preg_match('.^('
                                .    '([A-Za-z0-9!#$%&\'*+/=?^_`{|}~-]'
                                .    '[A-Za-z0-9!#$%&\'*+/=?^_`{|}~-]{0,63})'
                                .'|'
                                .    '("[^\\\"]{0,62}")'
                                .')$.'
                                ,$arrLocalPortion[$i])) {
                    return false;
                }
            }
            return true;
        }

        /**
         * Checks email section after "@" symbol for validity
         * @param   this->domain     Text to be checked
         * @return  True if domain portion is valid, false if not
         */
        protected function check_domain_portion() {
            // Total domain can only be from 1 to 255 characters, inclusive
            if (!$this->check_text_length($this->domain, 1, 255)) {
                return false;
            }
            // Check if domain is IP, possibly enclosed in square brackets.
            if (preg_match('/^(25[0-5]|2[0-4][0-9]|1[0-9][0-9]|[1-9]?[0-9])'
               .'(\.(25[0-5]|2[0-4][0-9]|1[0-9][0-9]|[1-9]?[0-9])){3}$/'
               ,$this->domain) ||
                preg_match('/^\[(25[0-5]|2[0-4][0-9]|1[0-9][0-9]|[1-9]?[0-9])'
               .'(\.(25[0-5]|2[0-4][0-9]|1[0-9][0-9]|[1-9]?[0-9])){3}\]$/'
               ,$this->domain)) {
                return true;
            } else {
                $arrDomainPortion = explode('.', $this->domain);
                if (sizeof($arrDomainPortion) < 2) {
                    return false; // Not enough parts to domain
                }
                for ($i = 0, $max = sizeof($arrDomainPortion); $i < $max; $i++) {
                    // Each portion must be between 1 and 63 characters, inclusive
                    if (!$this->check_text_length($arrDomainPortion[$i], 1, 63)) {
                        return false;
                    }
                    if (!preg_match('/^(([A-Za-z0-9][A-Za-z0-9-]{0,61}[A-Za-z0-9])|'
                       .'([A-Za-z0-9]+))$/', $arrDomainPortion[$i])) {
                        return false;
                    }
                    if ($i == $max - 1) { // TLD cannot be only numbers
                        if (strlen(preg_replace('/[0-9]/', '', $arrDomainPortion[$i])) <= 0) {
                            return false;
                        }
                    }
                }
            }
            return true;
        }

        /**
         * Check given text length is between defined bounds
         * @param   strText     Text to be checked
         * @param   intMinimum  Minimum acceptable length
         * @param   intMaximum  Maximum acceptable length
         * @return  True if string is within bounds (inclusive), false if not
         */
        protected function check_text_length($strText, $intMinimum, $intMaximum) {
            // Minimum and maximum are both inclusive
            $intTextLength = strlen($strText);
            if (($intTextLength < $intMinimum) || ($intTextLength > $intMaximum)) {
                return false;
            } else {
                return true;
            }
        }

    }

?>