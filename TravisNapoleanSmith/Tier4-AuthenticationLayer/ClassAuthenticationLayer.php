<?php

class AuthenticationLayer extends LayerModulesAbstract
{
	protected $Modules;
	
	protected $DatabaseAllow;
	protected $DatabaseDeny;
	
	public function __construct () {
		$this->Modules = Array();
		$this->DatabaseTable = Array();
		$GLOBALS['ErrorMessage']['AuthenticationLayer'] = array();
		$this->ErrorMessage = &$GLOBALS['ErrorMessage']['AuthenticationLayer'];
		
		$this->DatabaseAllow = &$GLOBALS['Tier4DatabaseAllow'];
		$this->DatabaseDeny = &$GLOBALS['Tier4DatabaseDeny'];
		$this->LayerModule = &$GLOBALS['Tier3Databases'];
		
		$this->PageID = $_GET['PageID'];
		
		$this->SessionName['SessionID'] = $_GET['SessionID'];
		
		$this->Layers['Tier3Databases'] = &$GLOBALS['Tier3Databases'];
		$this->Layers['Tier2Databases'] = &$GLOBALS['Tier2Databases'];
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
		$this->LayerModule->setDatabaseAll ($hostname, $user, $password, $databasename);
	}
	
	public function ConnectAll () {
		$this->LayerModule->ConnectAll();
	}
	
	public function Connect ($key) {
		$this->LayerModule->Connect($key);
	}
	
	public function DisconnectAll () {
		$this->LayerModule->DisconnectAll();
	}
	
	public function Disconnect ($key) {
		$this->LayerModule->Disconnect($key);
	}
	
	public function buildDatabase() {

	}
	
	public function createDatabaseTable($key) {
		$this->LayerModule->createDatabaseTable($key);
	}
	
	protected function checkPass($DatabaseTable, $function, $functionarguments) {
		reset($this->Modules);
		$hold = NULL;
		$args = func_num_args();
		if ($args > 3) {
			$hookargumentsarray = func_get_args();
			$hookarguments = $hookargumentsarray[3];
			if (is_array($hookarguments)) {
				while (current($this->Modules)) {
					$tempobject = current($this->Modules[key($this->Modules)]);
					$databasetables = $tempobject->getTableNames();
					if ($function == 'AUTHENTICATE') {
						$tempobject->FetchDatabase ($functionarguments);
					} else {
						$tempobject->FetchDatabase ($this->PageID);
					}
					//$tempobject->CreateOutput($this->Space);
					//$tempobject->getOutput();
					$hold = $tempobject->Verify($function, $functionarguments, $hookarguments);
					next($this->Modules);
				}
			} else {
				array_push($this->ErrorMessage,'checkPass: Hook Arguments Must Be An Array!');
			}
		} else {
			while (current($this->Modules)) {
				$tempobject = current($this->Modules[key($this->Modules)]);
				$databasetables = $tempobject->getTableNames();
				if ($function == 'AUTHENTICATE') {
					$tempobject->FetchDatabase ($functionarguments);
				} else {
					$tempobject->FetchDatabase ($this->PageID);
				}
				//$tempobject->CreateOutput($this->Space);
				//$tempobject->getOutput();
				$hold = $tempobject->Verify($function, $functionarguments);
				next($this->Modules);
			}
		}
		
		if ($function == 'AUTHENTICATE') {
			if ($hold) {
				return $hold;
			}
		} else {
			$hold2 = $this->LayerModule->pass($DatabaseTable, $function, $functionarguments);
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
						if ($this->DatabaseAllow[$function] || $function == 'PROTECT') {
							$args = func_num_args();
							if ($args > 3) {
								$hookargumentsarray = func_get_args();
								$hookarguments = $hookargumentsarray[3];
								if (is_array($hookarguments)) {
									$hold = $this->LayerModule->pass($databasetable, $function, $functionarguments, $hookarguments);
								} else {
									array_push($this->ErrorMessage,'pass: Hook Arguments Must Be An Array!');
								}
							} else {
								$hold = $this->LayerModule->pass($databasetable, $function, $functionarguments);
							}
							
							if ($hold) {
								return $hold;
							}
						} else if ($this->DatabaseDeny[$function] || $function == 'AUTHENTICATE') {
							$args = func_num_args();
							if ($args > 3) {
								$hookargumentsarray = func_get_args();
								$hookarguments = $hookargumentsarray[3];
								if (is_array($hookarguments)) {
									$hold = $this->checkPass($databasetable, $function, $functionarguments, $hookarguments);
								} else {
									array_push($this->ErrorMessage,'pass: Hook Arguments Must Be An Array!');
								}
							} else {
								$hold = $this->checkPass($databasetable, $function, $functionarguments);
							}
							
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