<?php

class UserAccounts extends Tier4AuthenticationLayerModulesAbstract implements Tier4AuthenticationLayerModules
{
	protected $TableNames = array();
	protected $LookupTable = array();
	protected $Attempts;
	protected $MaxAttempts;
	
	public function __construct($tablenames, $databaseoptions) {
		$this->LayerModule = &$GLOBALS['Tier4Databases'];
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
			$passarray['Password'] = $this->ProcessEncryption ($PageID['Password'], $salt);
			
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
			$hold = array();
			if ($this->LookupTable['UserAccounts'][0]) {
				if ($this->LookupTable['UserAccounts'][0]['Attempts'] > $this->MaxAttempts) {
					$hold['Error']['Attempts'] = "You account has been locked because of too many attempts.  The maximum number of tries is $this->MaxAttempts.";
					reset($functionarguments);
					while (current($functionarguments)) {
						$key = key($functionargments);
						$hold['FilteredInput'][$key] = current($functionalarguments);
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
		} else {
			return TRUE;
		}
	}
	
	protected function ProcessEncryption ($string, $salt) {
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
	
	public function getTableNames() {
		return $this->TableNames;
	}
}


?>
