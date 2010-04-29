<?php

class ContentLayer extends LayerModulesAbstract
{
	protected $Modules;
	
	protected $DatabaseAllow;
	protected $DatabaseDeny;
	
	public function __construct () {
		$this->Modules = Array();
		$this->DatabaseTable = Array();
		$this->ErrorMessage = Array();
		$this->DatabaseAllow = &$GLOBALS['Tier6DatabaseAllow'];
		$this->DatabaseDeny = &$GLOBALS['Tier6DatabaseDeny'];
		$this->LayerModule = &$GLOBALS['Tier5Databases'];
		
		$this->Layers['Tier5Databases'] = &$GLOBALS['Tier5Databases'];
		$this->Layers['Tier4Databases'] = &$GLOBALS['Tier4Databases'];
		$this->Layers['Tier3Databases'] = &$GLOBALS['Tier3Databases'];
		$this->Layers['Tier2Databases'] = &$GLOBALS['Tier2Databases'];
		
		$this->PageID = $_GET['PageID'];
		
		$this->SessionName['SessionID'] = $_GET['SessionID'];
	}
	
	public function setModules() {
		
	}
	
	public function getModules($key, $key1) {
		return $this->Modules[$key][$key1];
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
		while (current($this->Modules)) {
			$tempobject = current($this->Modules[key($this->Modules)]);
			$databasetables = $tempobject->getTableNames();
			$tempobject->FetchDatabase ($this->PageID);
			$tempobject->CreateOutput($this->Space);
			$tempobject->getOutput();
			$hold = $tempobject->Verify($function, $functionarguments);
			next($this->Modules);
		}
		
		$hold2 = $this->LayerModule->pass($DatabaseTable, $function, $functionarguments);
		if ($hold2) {
			return $hold2;
		} else {
			return FALSE;
		}
	}
	
	public function pass($databasetable, $function, $functionarguments) {
		if (!is_null($functionarguments)) {
			if (is_array($functionarguments)) {
				if (!is_null($function)) {
					if (!is_array($function)) {
						if ($this->DatabaseAllow[$function]) {
							$hold = $this->LayerModule->pass($databasetable, $function, $functionarguments);
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