<?php

class ValidationLayer extends LayerModulesAbstract
{
	protected $Modules;
	
	protected $Tier4AuthenticationTier;
	protected $DatabaseAllow;
	protected $DatabaseDeny;
	
	public function __construct () {
		$this->Modules = Array();
		$this->DatabaseTable = Array();
		$this->ErrorMessage = Array();
		$this->DatabaseAllow = &$GLOBALS['Tier5DatabaseAllow'];
		$this->DatabaseDeny = &$GLOBALS['Tier5DatabaseDeny'];
		$this->Tier4AuthenticationTier = &$GLOBALS['Tier4Databases'];
	}
	
	public function setModules() {
	
	}
	
	public function getModules($key) {
		return $this->Modules[$key];
	}
	
	public function setDatabaseAll ($hostname, $user, $password, $databasename) {
		$this->Hostname = $hostname;
		$this->User = $user;
		$this->Password = $password;
		$this->DatabaseName = $databasename;
		$this->Tier4AuthenticationTier->setDatabaseAll ($hostname, $user, $password, $databasename);
	}
	
	public function ConnectAll () {
		$this->Tier4AuthenticationTier->ConnectAll();
	}
	
	public function Connect ($key) {
		$this->Tier4AuthenticationTier->Connect($key);
	}
	
	public function DisconnectAll () {
		$this->Tier4AuthenticationTier->DisconnectAll();
	}
	
	public function Disconnect ($key) {
		$this->Tier4AuthenticationTier->Disconnect($key);
	}
	
	public function buildDatabase() {

	}
	
	public function createDatabaseTable($key) {
		$this->Tier4AuthenticationTier->createDatabaseTable($key);
	}
	
	public function createModules($key) {
		$this->Modules[$key] = new $key;
		$this->Modules[$key]->setDatabaseAll ($this->Hostname, $this->User, $this->Password, $this->DatabaseName, $this->DatabaseTable);
		
	}
	
	protected function checkPass($DatabaseTable, $function, $functionarguments) {
		reset($this->Modules);
		$hold = NULL;
		while (current($this->Modules)) {
			$this->Modules[key($this->Modules)]->FetchDatabase ($DatabaseTable);
			$this->Modules[key($this->Modules)]->CreateOutput($this->Space);
			$this->Modules[key($this->Modules)]->getOutput();
			$hold = $this->Modules[key($this->Modules)]->Verify($function, $functionarguments);
			next($this->Modules);
		}
		
		if ($hold) {
			$hold2 = $this->Tier4AuthenticationTier->pass($DatabaseTable, $function, $functionarguments);
			if ($hold2) {
				return $hold2;
			} else {
				return FALSE;
			}
		}
	}
	
	public function pass($databasetable, $function, $functionarguments) {
		if (!is_null($functionarguments)) {
			if (is_array($functionarguments)) {
				if (!is_null($function)) {
					if (!is_array($function)) {
						if ($this->DatabaseAllow[$function]) {
							$hold = $this->Tier4AuthenticationTier->pass($databasetable, $function, $functionarguments);
							if ($hold) {
								return $hold;
							}
						} else if ($this->DatabaseDeny[$function]) {
							$hold = $this->checkPass($databasetable, $function, $functionarguments);
							if ($hold) {
								return $hold;
							} else {
								return FALSE;
							}
						} else {
							array_push($this->ErrorMessage,'pass: MySqlConnect Member Does Not Exist!');
						}
					} else {
						array_push($this->ErrorMessage,'pass: MySqlConnect Member Cannot Be An Array!');
					}
				} else {
					array_push($this->ErrorMessage,'pass: MySqlConnect Member Cannot Be Null!');
				}
			} else {
				array_push($this->ErrorMessage,'pass: Function Arguments Must Be An Array!');
			}
		} else {
			array_push($this->ErrorMessage,'pass: Function Arguments Cannot Be Null!');
		}
	}
		
}

?>