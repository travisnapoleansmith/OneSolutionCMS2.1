<?php

class DataAccessLayer extends LayerModulesAbstract
{
	protected $Modules;
	
	protected $DatabaseAllow;
	protected $DatabaseDeny;
	
	public function __construct () {
		$this->Modules = Array();
		$this->DatabaseTable = Array();
		$this->ErrorMessage = Array();
		$this->DatabaseAllow = &$GLOBALS['Tier2DatabaseAllow'];
		$this->DatabaseDeny = &$GLOBALS['Tier2DatabaseDeny'];
		
		$this->PageID = $_GET['PageID'];
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
	}
	
	public function ConnectAll () {
		reset($this->DatabaseTable);
		while (current($this->DatabaseTable)){
			$tablename = key($this->DatabaseTable);
			$this->DatabaseTable[key($this->DatabaseTable)]->setDatabaseAll($this->Hostname, $this->User, $this->Password, $this->DatabaseName, $tablename);
			$this->DatabaseTable[key($this->DatabaseTable)]->Connect();
			
			next($this->DatabaseTable);
		}
	}
	
	public function Connect ($key) {
		$this->DatabaseTable[$key]->setDatabaseAll($this->Hostname, $this->User, $this->Password, $this->DatabaseName, $key);
		$this->DatabaseTable[$key]->Connect();
	}
	
	public function DisconnectAll () {
		reset($this->DatabaseTable);
		while (current($this->DatabaseTable)){
			$tablename = key($this->DatabaseTable);
			$this->DatabaseTable[key($this->DatabaseTable)]->Disconnect();
			
			next($this->DatabaseTable);
		}
	}
	
	public function Disconnect ($key) {
		$this->DatabaseTable[$key]->Disconnect();
	}
	
	public function buildDatabase() {

	}
	
	public function createDatabaseTable($key) {
		$this->DatabaseTable[$key] =  new MySqlConnect();
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
		
		if ($hold) {
			$hold2 = call_user_func_array(array($this->DatabaseTable["$DatabaseTable"], "$function"), $functionarguments);
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
							$hold = call_user_func_array(array($this->DatabaseTable["$databasetable"], "$function"), $functionarguments);
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