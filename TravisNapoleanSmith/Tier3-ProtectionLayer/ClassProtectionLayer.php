<?php

class ProtectionLayer
{
	private $modules;
	private $hostname;
	private $user;
	private $password;
	private $databasename; 
	private $databasetable;
	private $errormessage;
	private $moduleslocation;
	private $DatabaseAllow;
	private $DatabaseDeny;
	
	public function ProtectionLayer () {
		$this->modules = Array();
		$this->databasetable = Array();
		$this->errormessage = Array();
		$this->DatabaseAllow = &$GLOBALS['DatabaseAllow'];
		$this->DatabaseDeny = &$GLOBALS['DatabaseDeny'];
	}
	
	public function setModules() {
	
	}
	
	public function getModules($key) {
		return $this->modules[$key];
	}
	
	public function setHostname ($hostname){
		$this->hostname = $hostname;
	}
	
	public function getHostname () {
		return $this->hostname;
	}
	
	public function setUser ($user){
		$this->user = $user;
	}
	
	public function getUser () {
		return $this->user;
	}
	
	public function setPassword ($password){
		$this->password = $password;
	}
	
	public function getPassword () {
		return $this->password;
	}
	
	public function setDatabasename ($databasename){
		$this->databasename = $databasename;
	}
	
	public function getDatabasename () {
		return $this->databasename;
	}

	public function setDatabasetable ($databasetable){
		$this->databasetable[$databasetable] =  new MySqlConnect();
	}
	
	public function getDatabasetable () {
		return $this->databasetable;
	}
	
	public function getError ($idnumber) {
		return $this->errormessage[$idnumber];
	}
	
	public function getErrorArray() {
		return $this->errormessage;
	}
	
	public function setModulesLocation ($moduleslocation){
		$this->moduleslocation = $moduleslocation;
	}
	
	public function getModulesLocation () {
		return $this->moduleslocation;
	}
	
	public function setDatabaseAll ($hostname, $user, $password, $databasename) {
		$this->hostname = $hostname;
		$this->user = $user;
		$this->password = $password;
		$this->databasename = $databasename;
	}
	
	public function ConnectAll () {
		reset($this->databasetable);
		while (current($this->databasetable)){
			$tablename = key($this->databasetable);
			$this->databasetable[key($this->databasetable)]->setDatabaseAll($this->hostname, $this->user, $this->password, $this->databasename, $tablename);
			$this->databasetable[key($this->databasetable)]->Connect();
			
			next($this->databasetable);
		}
	}
	
	public function Connect ($key) {
		$this->databasetable[$key]->setDatabaseAll($this->hostname, $this->user, $this->password, $this->databasename, $key);
		$this->databasetable[$key]->Connect();
	}
	
	public function DisconnectAll () {
		reset($this->databasetable);
		while (current($this->databasetable)){
			$tablename = key($this->databasetable);
			$this->databasetable[key($this->databasetable)]->Disconnect();
			
			next($this->databasetable);
		}
	}
	
	public function Disconnect ($key) {
		$this->databasetable[$key]->Disconnect();
	}
	
	public function buildDatabase() {

	}
	
	public function buildModules() {
		if ($this->moduleslocation) {
			$dir = dir($this->moduleslocation);
			while ($entry = $dir->read()) {
				$filestring = $this->moduleslocation;
				$filestring .= $entry;
				if (!($entry == '.' | $entry == '..')) {
					if (is_dir($filestring)) {
						$modulesfile = $filestring;
						$modulesfile .= '/Class';
						$modulesfile .= $entry;
						$modulesfile .= '.php';
						if (is_file($modulesfile)) {
							require_once($modulesfile);
						} else {
							array_push($this->errormessage,'buildModules: Module file does not exist!');
						}
						$this->createModules($entry);
					}
				}
			}
		} else {
			array_push($this->errormessage,'buildModules: Module Location is not set!');
		}
	}
	
	public function createDatabaseTable($key) {
		$this->databasetable[$key] =  new MySqlConnect();
		
		//$this->Connect($key);
	}
	
	public function createModules($key) {
		$this->modules[$key] = new $key;
	}
	
	public function pass($databasetable, $function, $functionarguments) {
		if (!is_null($functionarguments)) {
			if (is_array($functionarguments)) {
				if (!is_null($function)) {
					if (!is_array($function)) {
						if ($this->DatabaseAllow[$function]) {
							$hold = call_user_func_array(array($this->databasetable["$databasetable"], "$function"), $functionarguments);
							if ($hold) {
								return $hold;
							}
						} else if ($this->DatabaseDeny[$function]) {
						
						} else {
							array_push($this->errormessage,'pass: MySqlConnect Member Does Not Exist!');
						}
					} else {
						array_push($this->errormessage,'pass: MySqlConnect Member Cannot Be An Array!');
					}
				} else {
					array_push($this->errormessage,'pass: MySqlConnect Member Cannot Be Null!');
				}
			} else {
				array_push($this->errormessage,'pass: Function Arguments Must Be An Array!');
			}
		} else {
			array_push($this->errormessage,'pass: Function Arguments Cannot Be Null!');
		}
	}
		
}

?>