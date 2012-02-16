<?php

class FacebookAuthentication extends Tier4AuthenticationLayerModulesAbstract implements Tier4AuthenticationLayerModules
{
	protected $TableNames = array();
	protected $Facebook;
	protected $FacebookSettings;
	protected $FacebookAuthenticationArray = array();
	//protected $LookupTable = array();
	
	public function __construct($tablenames, $databaseoptions, $layermodule) {
		require_once('Libraries/GlobalLayer/FacebookPHP-SDK/src/facebook.php');
		
		$this->LayerModule = &$layermodule;
		
		$hold = current($tablenames);
		$GLOBALS['ErrorMessage']['FacebookAuthentication'][$hold] = NULL;
		$this->ErrorMessage = &$GLOBALS['ErrorMessage']['FacebookAuthentication'][$hold];
		$this->ErrorMessage = array();
		
		if (isset($GLOBALS['FACEBOOKSETTINGS'])) {
			$this->FacebookSettings = &$GLOBALS['FACEBOOKSETTINGS'];
		} else {
			$GLOBALS['FACEBOOKSETTINGS'] = parse_ini_file('Configuration/facebook.ini',FALSE);
			$this->FacebookSettings = &$GLOBALS['FACEBOOKSETTINGS'];
		}
		
		$this->FacebookAuthenticationArray['apiId'] = $this->FacebookSettings['AUTHENTICATION']['APIID'];
		$this->FacebookAuthenticationArray['secret'] = $this->FacebookSettings['AUTHENTICATION']['SECRET'];
		$this->FacebookAuthenticationArray['cookie'] = $this->FacebookSettings['AUTHENTICATION']['COOKIE'];
		$this->FacebookAuthenticationArray['domain'] = $this->FacebookSettings['AUTHENTICATION']['DOMAIN'];
		$this->FacebookAuthenticationArray['fileupload'] = $this->FacebookSettings['AUTHENTICATION']['FILEUPLOAD'];
		
		if (isset($GLOBALS['FACEBOOK'])) {
			$this->Facebook = &$GLOBALS['FACEBOOK'];
		} else {
			$GLOBALS['FACEBOOK'] = new Facebook ($this->FacebookAuthenticationArray);
			$this->Facebook = &$GLOBALS['FACEBOOK'];
		}
		/*if ($databaseoptions['MaxAttempts']) {
			$this->MaxAttempts = $databaseoptions['MaxAttempts'];
		} else {
			$this->MaxAttempts = 5;
		}*/
		
		while (current($tablenames)) {
			$this->TableNames[key($tablenames)] = current($tablenames);
			next($tablenames);
		}
		
	}
	
	public function getUserInfo() {
		return $this->LookupTable;
	}
	
	public function setDatabaseAll ($hostname, $user, $password, $databasename, $databasetable) {
		/*$this->Hostname = $hostname;
		$this->User = $user;
		$this->Password = $password;
		$this->DatabaseName = $databasename;
		$this->DatabaseTable = $databasetable;
		//print get_class($this->LayerModule);
		$this->LayerModule->setDatabaseAll ($hostname, $user, $password, $databasename);
		$this->LayerModule->setDatabasetable ($databasetable);
		*/
	}
	
	public function FetchDatabase ($PageID) {
		/*$passarray = array();
		if ($PageID['UserName'] && $PageID['Password']) {
			$passarray['UserName'] = $PageID['UserName'];
			$this->LayerModule->Connect('UserAccounts');
			$this->LayerModule->pass ('UserAccounts', 'setDatabaseRow', array('PageID' => $passarray));
			$this->LayerModule->Disconnect('UserAccounts');
			
			$salt = $this->LayerModule->pass (current($this->TableNames), 'getMultiRowField', array());
			$this->Attempts = $salt[0]['Attempts'];
			$salt = $salt[0]['Salt'];
			$passarray['Password'] = $this->processEncryption ($PageID['Password'], $salt);
			
			$Attempts = $this->Attempts;
			$Attempts++;
			$UserName = $passarray['UserName'];
			
			$pass = NULL;
			$pass = "`Attempts` = \"$Attempts\" WHERE `UserName` = \"$UserName\"";
			$this->LayerModule->Connect('UserAccounts');
			$this->LayerModule->pass ('UserAccounts', 'updateTable', array('PageID' => $pass));
			$this->LayerModule->Disconnect('UserAccounts');
			
		} else {
			$passarray['PageID'] = $PageID;
		}
		$passarray['Reset'] = 'No';
		$passarray['Enable/Disable'] = 'Enable';
		
		reset($this->TableNames);
		while (current($this->TableNames)) {
			$this->LayerModule->Connect(current($this->TableNames));
			if (current($this->TableNames) == 'UserAccounts') {
				$this->LayerModule->pass (current($this->TableNames), 'setDatabaseRow', array('PageID' => $passarray));
				$this->LookupTable['UserAccounts'] = $this->LayerModule->pass (current($this->TableNames), 'getMultiRowField', array());
			}
			$this->LayerModule->Disconnect(current($this->TableNames));
			next ($this->TableNames);
		}
		*/
	}
	
	public function Verify($function, $functionarguments){
		//if ($function == 'FACEBOOKAUTHENTICATE') {
			/*$args = func_num_args();
			$hold = array();
			if ($args > 2) {
				$hold['FilteredInput'] = $functionarguments;
				$hookargumentsarray = func_get_args();
				$hookarguments = $hookargumentsarray[2];
				
				if (is_array($hookarguments)) {
					reset($hookarguments);
					while (current($hookarguments)) {
						$functionname = key($hookarguments);
						if (is_array(current($hookarguments))) {
							$hooks = current($hookarguments);
							$temp = call_user_func_array(array($this, $functionname), $hooks);
							if ($temp['Error']) {
								$hold['Error'] = $temp['Error'];
							} 
							
							$hold[$functionname] = $temp;
						
						} else {
							$functionparameters = current($hookarguments);
							$hold[$functionname] = $this->$functionname($functionparameters);
						}
						next($hookarguments);
					}
				} else {
					array_push($this->ErrorMessage,'Verify: Hook Arguments Must Be An Array!');
					$hold['Error']['Hook'] = "System Error - Verify: Hook Arguments Must Be An Array!";
					return $hold;
				}
				return $hold;
			} else {
				if ($this->LookupTable['UserAccounts'][0]) {
					if ($this->LookupTable['UserAccounts'][0]['Attempts'] > $this->MaxAttempts) {
						$hold['Error']['Attempts'] = "You account has been locked because of too many attempts.  <br /> The maximum number of tries is $this->MaxAttempts.";
						reset($functionarguments);
						while (current($functionarguments)) {
							$key = key($functionarguments);
							$hold['FilteredInput'][$key] = current($functionarguments);
							next($functionarguments);
						}
						return $hold;
					} else {
						$UserName = $this->LookupTable['UserAccounts'][0]['UserName'];
						$pass = NULL;
						$pass = "`Attempts` = \"0\" WHERE `UserName` = \"$UserName\"";
						$this->LayerModule->Connect('UserAccounts');
						$this->LayerModule->pass ('UserAccounts', 'updateTable', array('PageID' => $pass));
						$this->LayerModule->Disconnect('UserAccounts');
						return TRUE;
					}
				} else {
					$hold['Error']['User Account / Password'] = 'Either the user account does not exist <br /> or the password is not correct, please try again!';
					reset($functionarguments);
					while (current($functionarguments)) {
						$key = key($functionarguments);
						$hold['FilteredInput'][$key] = current($functionarguments);
						next($functionarguments);
					}
					return $hold;
				}
			}*/
		//} else {
			//return TRUE;
		//}
	}
	
	public function getTableNames() {
		return $this->TableNames;
	}
}


?>
