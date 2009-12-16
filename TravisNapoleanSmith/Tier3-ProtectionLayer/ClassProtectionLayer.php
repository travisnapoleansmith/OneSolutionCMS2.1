<?php
require_once("Tier2-DataAccessLayer/ClassMySqlConnect.php");
require_once("Configuration/Tier3ProtectionLayerSettings.php");

class ProtectionLayer
{
	var $modules;
	var $hostname;
	var $user;
	var $password;
	var $databasename; 
	var $databasetable;
	var $errormessage;
	var $moduleslocation;
	var $DatabaseAllow;
	var $DatabaseDeny;
	
	function ProtectionLayer () {
		$this->modules = Array();
		$this->databasetable = Array();
		$this->errormessage = Array();
		$this->DatabaseAllow = &$GLOBALS['DatabaseAllow'];
		$this->DatabaseDeny = &$GLOBALS['DatabaseDeny'];
	}
	
	function setModules() {
	
	}
	
	function getModules($key) {
		return $this->modules[$key];
	}
	
	function setHostname ($hostname){
		$this->hostname = $hostname;
	}
	
	function getHostname () {
		return $this->hostname;
	}
	
	function setUser ($user){
		$this->user = $user;
	}
	
	function getUser () {
		return $this->user;
	}
	
	function setPassword ($password){
		$this->password = $password;
	}
	
	function getPassword () {
		return $this->password;
	}
	
	function setDatabasename ($databasename){
		$this->databasename = $databasename;
	}
	
	function getDatabasename () {
		return $this->databasename;
	}

	function setDatabasetable ($databasetable){
		$this->databasetable[$databasetable] =  new MySqlConnect();
	}
	
	function getDatabasetable () {
		return $this->databasetable;
	}
	
	function getError ($idnumber) {
		return $this->errormessage[$idnumber];
	}
	
	function getErrorArray() {
		return $this->errormessage;
	}
	
	function setModulesLocation ($moduleslocation){
		$this->moduleslocation = $moduleslocation;
	}
	
	function getModulesLocation () {
		return $this->moduleslocation;
	}
	
	function setDatabaseAll ($hostname, $user, $password, $databasename) {
		$this->hostname = $hostname;
		$this->user = $user;
		$this->password = $password;
		$this->databasename = $databasename;
	}
	
	function ConnectAll () {
		reset($this->databasetable);
		while (current($this->databasetable)){
			$tablename = key($this->databasetable);
			$this->databasetable[key($this->databasetable)]->setDatabaseAll($this->hostname, $this->user, $this->password, $this->databasename, $tablename);
			$this->databasetable[key($this->databasetable)]->Connect();
			
			next($this->databasetable);
		}
	}
	
	function Connect ($key) {
		$this->databasetable[$key]->setDatabaseAll($this->hostname, $this->user, $this->password, $this->databasename, $key);
		$this->databasetable[$key]->Connect();
	}
	
	function DisconnectAll () {
		reset($this->databasetable);
		while (current($this->databasetable)){
			$tablename = key($this->databasetable);
			$this->databasetable[key($this->databasetable)]->Disconnect();
			
			next($this->databasetable);
		}
	}
	
	function Disconnect ($key) {
		$this->databasetable[$key]->Disconnect();
	}
	
	function buildDatabase() {

	}
	
	function buildModules() {
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
	
	function createDatabaseTable($key) {
		$this->databasetable[$key] =  new MySqlConnect();
		
		//$this->Connect($key);
	}
	
	function createModules($key) {
		$this->modules[$key] = new $key;
	}
	
	function pass($databasetable, $function, $functionarguments) {
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
	
	function setPass() {
	
	}
	
	function getPass() {
	
	}
		
}

?>