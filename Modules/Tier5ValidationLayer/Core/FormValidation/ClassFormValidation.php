<?php
/*
**************************************************************************************
* One Solution CMS
*
* Copyright (c) 1999 - 2013 One Solution CMS
* This content management system is free software: you can redistribute it and/or modify
* it under the terms of the GNU General Public License as published by
* the Free Software Foundation, either version 2 of the License, or
* (at your option) any later version.
*
* This content management system is distributed in the hope that it will be useful,
* but WITHOUT ANY WARRANTY; without even the implied warranty of
* MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
* GNU General Public License for more details.
*
* You should have received a copy of the GNU General Public License
* along with this program.  If not, see <http://www.gnu.org/licenses/>.
*
* @copyright  Copyright (c) 1999 - 2013 One Solution CMS (http://www.onesolutioncms.com/)
* @license    http://www.gnu.org/licenses/gpl-2.0.txt
* @version    2.1.141, 2013-01-14
*************************************************************************************
*/

class FormValidation extends Tier5ValidationLayerModulesAbstract implements Tier5ValidationLayerModules
{
	protected $TableNames = array();
	protected $LookupTable = array();
	public function __construct($tablenames, $databaseoptions, $layermodule) {
		$this->LayerModule = &$layermodule;

		$hold = current($tablenames);
		$GLOBALS['ErrorMessage']['FormValidation'][$hold] = NULL;
		$this->ErrorMessage = &$GLOBALS['ErrorMessage']['FormValidation'][$hold];
		$this->ErrorMessage = array();

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
			} else if (key($this->TableNames) == 'DatabaseTable1'){
				$this->LayerModule->pass (current($this->TableNames), 'setDatabaseRow', array('PageID' => $passarray));
				$this->LookupTable['FormValidation'] = $this->LayerModule->pass (current($this->TableNames), 'getMultiRowField', array());
			}
			$this->LayerModule->Disconnect(current($this->TableNames));
			next ($this->TableNames);
		}
	}

	public function Verify($function, $functionarguments){
		if ($function == 'FORM') {
			$hold = array();
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
						$functionarguments[$key] = stripslashes($functionarguments[$key]);
						$temp = $this->$functionname($functionarguments[$key], $minlength, $maxlength, $minvalue, $maxvalue);
						if ($temp) {
							$hold['Error'][$key] = $temp;
						}

						$hold['FilteredInput'][$key] = $functionarguments[$key];
					}
				} else {
					$key = $this->LookupTable['FormValidation'][key($this->LookupTable['FormValidation'])]['FormFieldName'];
					$hold['FilteredInput'][$key] = $functionarguments[$key];
				}

				next ($this->LookupTable['FormValidation']);
			}

			if ($hold) {
				return $hold;
			} else {
				return NULL;
			}
		} else {
			return TRUE;
		}
	}

	public function AddLookupTableElement(array $AddLookupTable) {
		if ($AddLookupTable != NULL) {
			foreach ($AddLookupTable as $Key => $Value) {
				$FormFieldName = $Key;
				$FormFieldAttribute = NULL;
				$FormFieldMinLength = NULL;
				$FormFieldMaxLength = NULL;
				$FormFieldMinValue = NULL;
				$FormFieldMaxValue = NULL;
				
				$PushArray = array();
				$PushArray['PageID'] = $this->PageID;
				$PushArray['FormFieldName'] = $FormFieldName;
				$PushArray['FormFieldAttribute'] = $FormFieldAttribute;
				$PushArray['FormFieldMinLength'] = $FormFieldMinLength;
				$PushArray['FormFieldMaxLength'] = $FormFieldMaxLength;
				$PushArray['FormFieldMinValue'] = $FormFieldMinValue;
				$PushArray['FormFieldMaxValue'] = $FormFieldMaxValue;
				
				array_push($this->LookupTable['FormValidation'], $PushArray);
			}
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

	protected function ProcessAlpha(&$value, $minlength, $maxlength, $minvalue, $maxvalue) {
		if (!$value) {
			return 'Input must contain characters only no numbers or symbols like - or ;.';
		}

		$value = filter_var($value, FILTER_SANITIZE_STRING);

		if (preg_match('#[0-9]#', $value)) {
			return "Input must be contain characters only no numbers are allowed.<br /> They must be between $minlength characters and $maxlength characters long!";
		}

		$length = strlen($value);
		if ($minlength) {
			if ($length < $minlength) {
				return "Input is too short must be $minlength characters!";
			}
		}

		if ($maxlength) {
			if ($length > $maxlength) {
				return "Input is too long must be no longer than $maxlength characters!";
			}
		}
	}

	protected function ProcessAlphaNum(&$value, $minlength, $maxlength, $minvalue, $maxvalue) {
		if (!$value) {
			return 'Input must contain at least one character.';
		}

		$value = filter_var($value, FILTER_SANITIZE_STRING);

		$length = strlen($value);
		if ($minlength) {
			if ($length < $minlength) {
				return "Input is too short must be $minlength characters!";
			}
		}
		if ($maxlength) {
			if ($length > $maxlength) {
				return "Input is too long must be no longer than $maxlength characters!";
			}
		}
	}

	protected function ProcessEmailAddress(&$value, $minlength, $maxlength, $minvalue, $maxvalue) {
		if (!$value) {
			return 'Input must be contain an email address.';
		}

		$value = filter_var($value, FILTER_SANITIZE_EMAIL);

		$value2 = filter_var($value, FILTER_VALIDATE_EMAIL);
		if (!$value2) {
			return "Input is not a valid email address. <br /> Valid email addresses look something like this: example@example.com !";
		} else {
			list($UserName, $MailDomain) = split('@', $value2);
			if (!checkdnsrr($MailDomain, 'MX')) {
				return "Input is not a valid email address. <br /> Valid email addresses look something like this: example@example.com ! <br /> The email address entered is on a non-exisitng domain! ";
			}
		}
	}

	protected function ProcessUrlAddress(&$value, $minlength, $maxlength, $minvalue, $maxvalue) {
		if (!$value) {
			return 'Input must be contain a url address such as http://www.example.com/.';
		}

		$value = filter_var($value, FILTER_SANITIZE_URL);

		$value2 = filter_var($value, FILTER_VALIDATE_URL);
		if (!$value2) {
			return "Input is not a valid url address. <br /> Valid url addresses look something like this: http://www.example.com !";
		}
	}

	protected function ProcessIPAddress($value, $minlength, $maxlength, $minvalue, $maxvalue) {
		if (!$value) {
			return 'Input must be contain an ip address. <br /> Valid ip address look something like this: 192.168.100.1 .';
		}

		$value = filter_var($value, FILTER_VALIDATE_IP);
		if (!$value) {
			return "Input is not a valid ip address. <br /> Valid ip addresses look something like this: 192.168.100.1 !";
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
			return "$value is not a valid state, please try again! <br /> Please use the states abbreviation.  <br /> For example use NY for New York";
		}
	}

	protected function ProcessHtmlTag(&$value, $minlength, $maxlength, $minvalue, $maxvalue) {
		$length = strlen($value);
		if ($minlength) {
			if ($length < $minlength) {
				return "Input is too short must be $minlength characters!";
			}
		}

		if ($maxlength) {
			if ($length > $maxlength) {
				return "Input is too long must be no longer than $maxlength characters!";
			}
		}

		if (!$value) {
			return 'Input must contain at least one character.';
		}

		$HOME = $_SERVER['SUBDOMAIN_DOCUMENT_ROOT'];
		if (file_exists("$HOME/Libraries/Tier5ValidationLayer/HtmlPurifier/library/HTMLPurifier.auto.php")) {
			require_once "$HOME/Libraries/Tier5ValidationLayer/HtmlPurifier/library/HTMLPurifier.auto.php";
		}

		$config = HTMLPurifier_Config::createDefault();
		$config->set('Core.Encoding', 'UTF-8');
		$config->set('HTML.Doctype', 'XHTML 1.0 Strict');

		$allowed = array();
		$deny = array();

		reset ($this->LookupTable['HtmlTags']);
		while (current($this->LookupTable['HtmlTags'])) {
			if ($this->LookupTable['HtmlTags'][key($this->LookupTable['HtmlTags'])]['Permit'] == 'Allow') {
				$allowed = $this->LookupTable['HtmlTags'][key($this->LookupTable['HtmlTags'])];
				next($this->LookupTable['HtmlTags']);
			} else if ($this->LookupTable['HtmlTags'][key($this->LookupTable['HtmlTags'])]['Permit'] == 'Deny') {
				$deny = $this->LookupTable['HtmlTags'][key($this->LookupTable['HtmlTags'])];
				next($this->LookupTable['HtmlTags']);
			} else {
				next ($this->LookupTable['HtmlTags']);
			}
		}
		unset($allowed['Permit']);
		$allowed = array_filter($allowed);
		$allowed = implode(',', $allowed);
		$allowed = explode(',', $allowed);

		unset($deny['Permit']);
		$deny = array_filter($deny);
		$deny = implode(',', $deny);
		$deny = explode(',', $deny);

		$config->set('HTML.AllowedElements', $allowed);
		$config->set('HTML.ForbiddenElements', $deny);
		$purifier = new HTMLPurifier($config);
		$purehtml = $purifier->purify($value);

		$value = $purehtml;
		if (!$value) {
			return 'Input has invalid XHTML tag';
		}
	}

	protected function ProcessCaptcha(&$value, $minlength, $maxlength, $minvalue, $maxvalue) {
		$captchaimage = $_COOKIE['CaptchaImage'];
		setcookie('CaptchaImage', ' ', NULL, '/');
		//setcookie('CaptchaImage', ' ');

		$HOME = $_SERVER['SUBDOMAIN_DOCUMENT_ROOT'];

		if (is_file("CAPTCHAIMAGE/$captchaimage")) {
			unlink("CAPTCHAIMAGE/$captchaimage");
		}

		if (!$value) {
			return 'Input must be contain the two words in the image with a space between them!';
		}

		$captchakey = $_COOKIE['CaptchaKey'];
		$captchavalue = md5($value);
		$captchavalue = sha1($captchavalue);

		setcookie('CaptchaKey', ' ', NULL, '/');
		//setcookie('CaptchaKey', ' ');

		if ($captchakey != $captchavalue) {
			return 'Input does not match with the two words in the image, please try again!';
		}

	}

	protected function ProcessMenuRepeat(&$value, $minlength, $maxlength, $minvalue, $maxvalue) {
		$ObjectID = $_POST['TopMenuHidden'];
		$ObjectID = explode(' ', $ObjectID);
		$ObjectID = $ObjectID[0];

		$CurrentValue = explode(' ', $value);
		$CurrentValue = $CurrentValue[0];

		$RepeatValues = array();
		foreach ($_POST as $Key => $Value) {
			if (strstr($Key, 'MenuItemLookup')) {
				if ($Value == 'NULL') {
					$RepeatValues[$Key] = NULL;
				} else {
					$Value = explode(' ', $Value);
					$RepeatValues[$Key] = $Value[0];
				}
			}
		}

		$passarray = array();
		$passarray['PageID'] = 1;

		$Menu = $this->getRecord($passarray, 'MainMenuItemLookup');

		$Once = FALSE;

		foreach ($RepeatValues as $Value) {
			if ($Once == FALSE) {
				if ($Value == $CurrentValue) {
					$Once = TRUE;
				}
			} else {
				if ($Value == $CurrentValue) {
					return 'Input has been used more than once on this form, please select an item that has not been used!';
				}
			}
		}

		$PageNumber = array();
		foreach ($Menu as $Value) {
			if ($Value['PageID'] != NULL) {
				array_push($PageNumber, $Value['ObjectID']);
			}
		}
		$Menu = array_combine($PageNumber, array_values($Menu));

		$OldMenuItem = $Menu[$CurrentValue];
		if (!is_null($OldMenuItem['ParentObjectID'])) {
			if ($OldMenuItem['ParentObjectID'] != $ObjectID) {
				return 'Input has been used in another menu, please select and item that has not been used!';
			}
		}
	}

	public function getTableNames() {
		return $this->TableNames;
	}
}


?>
