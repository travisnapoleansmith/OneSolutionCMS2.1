<?php

class FormValidation extends Tier5ValidationLayerModulesAbstract implements Tier5ValidationLayerModules
{
	protected $TableNames = array();
	protected $LookupTable = array();
	public function __construct($tablenames, $databaseoptions) {
		$this->LayerModule = &$GLOBALS['Tier5Databases'];
		
		while (current($tablenames)) {
			$this->TableNames[key($tablenames)] = current($tablenames);
			next($tablenames);
		}
	}
	
	public function setDatabaseAll ($hostname, $user, $password, $databasename, $databasetable) {
		$this->Hostname = $hostname;
		$this->User = $user;
		$this->Password = $password;
		$this->DatabaseName = $databasename;
		$this->DatabaseTable = $databasetable;
		
		$this->LayerModule->setDatabaseAll ($hostname, $user, $password, $databasename);
		$this->LayerModule->setDatabasetable ($databasetable);
		
	}
	
	public function FetchDatabase ($PageID) {
		if (!$PageID) {
			$PageID = 1;
		}
		$this->PageID = $PageID;
		
		$passarray = array();
		$passarray['PageID'] = $this->PageID;
		
		reset($this->TableNames);
		while (current($this->TableNames)) {
			$this->LayerModule->Connect(current($this->TableNames));
			if (current($this->TableNames) == 'HtmlTags') {
				$this->LayerModule->pass (current($this->TableNames), 'setEntireTable', array());
				$this->LookupTable[current($this->TableNames)] = $this->LayerModule->pass (current($this->TableNames), 'getEntireTable', array());
			} else if (!(current($this->TableNames) == 'States' || current($this->TableNames) == 'Zipcodes')){
				$this->LayerModule->pass (current($this->TableNames), 'setDatabaseRow', array('PageID' => $passarray));
				$this->LookupTable[current($this->TableNames)] = $this->LayerModule->pass (current($this->TableNames), 'getMultiRowField', array());
			}
			$this->LayerModule->Disconnect(current($this->TableNames));
			next ($this->TableNames);
		}
	}
	
	public function Verify($function, $functionarguments){
		if ($function == 'FORM') {
			$hold = array();
			print_r($functionarguments);
			print_r($this->LookupTable);
			reset ($this->LookupTable['FormValidation']);
			while (current($this->LookupTable['FormValidation'])) {
				if ($this->LookupTable['FormValidation'][key($this->LookupTable['FormValidation'])]['FormFieldAttribute']) {
					$attrib = $this->LookupTable['FormValidation'][key($this->LookupTable['FormValidation'])]['FormFieldAttribute'];
					$key = $this->LookupTable['FormValidation'][key($this->LookupTable['FormValidation'])]['FormFieldName'];
					$minlength = $this->LookupTable['FormValidation'][key($this->LookupTable['FormValidation'])]['FormFieldMinLength'];
					$maxlength = $this->LookupTable['FormValidation'][key($this->LookupTable['FormValidation'])]['FormFieldMaxLength'];
					$minvalue = $this->LookupTable['FormValidation'][key($this->LookupTable['FormValidation'])]['FormFieldMinValue'];
					$maxvalue = $this->LookupTable['FormValidation'][key($this->LookupTable['FormValidation'])]['FormFieldMaxValue'];
					if (isset($functionarguments[$key])) {
						$functionname = 'Process';
						$functionname .= $attrib;
						
						$temp = $this->$functionname($functionarguments[$key], $minlength, $maxlength, $minvalue, $maxvalue);
						if ($temp) {
							$hold[$key] = $temp;
						}
					}
				}
				next ($this->LookupTable['FormValidation']);
			}
			return $hold;
		} else {
			return TRUE;
		}
	}
	
	protected function ProcessNumber($value, $minlength, $maxlength, $minvalue, $maxvalue) {
		if (!$value) {
			return 'Input must be a whole number.';
		}
		
		$options = array();
		$options['options']['min_range'] = $minvalue;
		$options['options']['max_range'] = $maxvalue;
		
		$value = filter_var($value, FILTER_VALIDATE_INT, $options);
		if (!$value) {
			return "Input must be a whole number between $minvalue and $maxvalue!";
		}
	}
	
	protected function ProcessAlpha($value, $minlength, $maxlength, $minvalue, $maxvalue) {
		if (!$value) {
			return 'Input must contain characters only no numbers or symbols like - or ;.';
		}
		
		$value = filter_var($value, FILTER_SANITIZE_STRING);
		$this->LookupTable['FormValidation'][key($this->LookupTable['FormValidation'])]['FormFieldName'] = $value;
		
		if (preg_match('#[0-9]#', $value)) {
			return "Input must be contain characters only no numbers are allowed and must be between $minlength characters and $maxlength characters long!";
		}
		
		$length = strlen($value);
		
		if ($length < $minlength) {
			return "Input is too short must be $minlength characters!";
		}
		
		if ($length > $maxlength) {
			return "Input is too long must be no longer than $maxlength characters!";
		}
	}
	
	protected function ProcessAlphaNum($value, $minlength, $maxlength, $minvalue, $maxvalue) {
		if (!$value) {
			return 'Input must contain at least one character.';
		}
		
		$value = filter_var($value, FILTER_SANITIZE_STRING);
		$this->LookupTable['FormValidation'][key($this->LookupTable['FormValidation'])]['FormFieldName'] = $value;
		
		$length = strlen($value);
		if ($length < $minlength) {
			return "Input is too short must be $minlength characters!";
		}
		
		if ($length > $maxlength) {
			return "Input is too long must be no longer than $maxlength characters!";
		}
	}
	
	protected function ProcessEmailAddress($value, $minlength, $maxlength, $minvalue, $maxvalue) {
		if (!$value) {
			return 'Input must be contain an email address.';
		}
		
		$value = filter_var($value, FILTER_SANITIZE_EMAIL);
		$this->LookupTable['FormValidation'][key($this->LookupTable['FormValidation'])]['FormFieldName'] = $value;
		
		$value = filter_var($value, FILTER_VALIDATE_EMAIL);
		if (!$value) {
			return "Input is not a valid email address. Valid email addresses look something like this: example@example.com !";
		}
	}
	
	protected function ProcessUrlAddress($value, $minlength, $maxlength, $minvalue, $maxvalue) {
		if (!$value) {
			return 'Input must be contain a url address such as http://www.example.com/.';
		}
		
		$value = filter_var($value, FILTER_SANITIZE_URL);
		$this->LookupTable['FormValidation'][key($this->LookupTable['FormValidation'])]['FormFieldName'] = $value;
		
		$value = filter_var($value, FILTER_VALIDATE_URL);
		if (!$value) {
			return "Input is not a valid url address. Valid url addresses look something like this: http://www.example.com !";
		}
	}
	
	protected function ProcessIPAddress($value, $minlength, $maxlength, $minvalue, $maxvalue) {
		if (!$value) {
			return 'Input must be contain an ip address. Valid ip address look something like this: 192.168.100.1 .';
		}
		
		$value = filter_var($value, FILTER_VALIDATE_IP);
		if (!$value) {
			return "Input is not a valid ip address. Valid ip addresses look something like this: 192.168.100.1 !";
		}
	}
	
	protected function ProcessZipcode($value, $minlength, $maxlength, $minvalue, $maxvalue) {
		if (!$value) {
			return 'Input must be a zipcode.';
		}
		
		$passarray = array();
		$passarray['Zipcode'] = $value;
		$this->LayerModule->pass ('Zipcodes', 'setDatabaseRow', array('PageID' => $passarray));
		$this->LookupTable['Zipcodes'] = $this->LayerModule->pass ('Zipcodes', 'getMultiRowField', array());
		if (!$this->LookupTable['Zipcodes'][0]) {
			return "$value is not a valid zipcode, please try again!";
		}
	}
	
	protected function ProcessState($value, $minlength, $maxlength, $minvalue, $maxvalue) {
		if (!$value) {
			return 'Input must be a state. Please use the states abbreviation.  For example use NY for New York';
		}
		
		$passarray = array();
		$passarray['State'] = $value;
		$this->LayerModule->pass ('States', 'setDatabaseRow', array('PageID' => $passarray));
		$this->LookupTable['States'] = $this->LayerModule->pass ('States', 'getMultiRowField', array());
		if (!$this->LookupTable['States'][0]) {
			return "$value is not a valid state, please try again! Please use the states abbreviation.  For example use NY for New York";
		}
	}
	
	protected function ProcessHtmlTag($value, $minlength, $maxlength, $minvalue, $maxvalue) {
		print "$value\n";
		print "$minlength\n";
		print "$maxlength\n";
		print "$minvalue\n";
		print "$maxvalue\n";
	}
	
	public function getTableNames() {
		return $this->TableNames;
	}
}


?>
