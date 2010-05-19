<?php

class UserAccounts extends Tier4AuthenticationLayerModulesAbstract implements Tier4AuthenticationLayerModules
{
	protected $TableNames = array();
	protected $LookupTable = array();
	protected $Attempts;
	protected $MaxAttempts;
	protected $NewUserSalt;
	
	public function __construct($tablenames, $databaseoptions) {
		$this->LayerModule = &$GLOBALS['Tier4Databases'];
		
		$hold = current($tablenames);
		$GLOBALS['ErrorMessage']['UserAccounts'][$hold] = NULL;
		$this->ErrorMessage = &$GLOBALS['ErrorMessage']['UserAccounts'][$hold];
		$this->ErrorMessage = array();
		
		if ($databaseoptions['MaxAttempts']) {
			$this->MaxAttempts = $databaseoptions['MaxAttempts'];
		} else {
			$this->MaxAttempts = 5;
		}
		
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
		$passarray = array();
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
				
	}
	
	public function Verify($function, $functionarguments){
		if ($function == 'AUTHENTICATE') {
			$args = func_num_args();
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
							$hold[$functionname] = call_user_func_array(array($this, $functionname), $hooks);
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
			}
		} else {
			return TRUE;
		}
	}
	
	protected function processEncryption ($string, $salt) {
		if ($salt) {
			$string .= $salt;
			$hold = hash('SHA256', $string);
			return $hold;
		} else {
			$hold = hash('SHA256', $string);
			return $hold;
		}
	}
	
	protected function createSalt ($string) {
		$string .= time();
		$temp = hash('SHA256', $string);

		$i = 0;
		$max = strlen($temp);		
		while ($i < $max) {
			$rand = rand($i, $max);
			$salt[$i] = $temp[$rand];
			$i++;
		}
		$salt = implode($salt);
		return $salt;
		
	}
	
	protected function createPassword ($password) {
		$salt = $this->createSalt($password);
		
		$password .= $salt;
		$hold = hash('SHA256', $password);
		return $hold;
	}
	
	protected function checkUserName($username) {
		$passarray = array();
		$passarray['UserName'] = $username;
		$this->LayerModule->Connect('UserAccounts');
		$this->LayerModule->pass ('UserAccounts', 'setDatabaseRow', array('PageID' => $passarray));
		$this->LayerModule->Disconnect('UserAccounts');
		
		$results = $this->LayerModule->pass ('UserAccounts', 'getMultiRowField', array());
		if ($results[0]) {
			return TRUE;
		} else {
			return FALSE;
		}
	}
	
	protected function createUserAccount($username, $emailaddress) {
		$this->NewUserSalt = $this->createSalt(' ');
		if ($username && $emailaddress) {
			$passarray = array();
			$passarray1 = array();
			$passarray2 = array();
			$passarray1[0] = 'UserName';
			$passarray1[1] = 'Password';
			$passarray1[2] = 'Salt';
			$passarray1[3] = 'EmailAccount';
			$passarray1[4] = 'Attempts';
			$passarray1[5] = 'NewUser';
			$passarray1[6] = 'Reset';
			$passarray1[7] = 'Administrator';
			$passarray1[8] = 'ContentCreator';
			$passarray1[9] = 'Editor';
			$passarray1[10] = 'User';
			$passarray1[11] = 'Guest';
			$passarray1[12] = 'Enable/Disable';
			
			$passarray2[0] = $username;
			$passarray2[1] = '';
			$passarray2[2] = $this->NewUserSalt;
			$passarray2[3] = $emailaddress;
			$passarray2[4] = 500;
			$passarray2[5] = 'Yes';
			$passarray2[6] = 'No';
			$passarray2[7] = 'No';
			$passarray2[8] = 'No';
			$passarray2[9] = 'No';
			$passarray2[10] = 'Yes';
			$passarray2[11] = 'No';
			$passarray2[12] = 'Enable';
			
			$passarray['rowname'] = $passarray1;
			$passarray['rowvalue'] = $passarray2;
			
			$this->LayerModule->Connect('UserAccounts');
			$this->LayerModule->pass ('UserAccounts', 'createRow', $passarray);
			$this->LayerModule->Disconnect('UserAccounts');
		} else {
		
		}
	}
	
	protected function generateNewUserEmail($emailaccount, $location) {
		$sitename = $GLOBALS['sitename'];
		$location .= '&NewUserCode=';
		$location .= $this->NewUserSalt;
		
		$message = "Welcome to $sitename! To activate your account you have to click the link ";
		$message .= 'below and enter your email address and a new password.';
		$message .= "\n $location";
		
		mail($emailaccount, "New User Registration - $sitename", $message);
	}
	
	public function getTableNames() {
		return $this->TableNames;
	}
}


?>
