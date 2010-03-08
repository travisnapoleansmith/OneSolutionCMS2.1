<?php

abstract class LayerModulesAbstract 
{
	protected $LayerModule;
	
	protected $LayerModuleTable;
	protected $LayerModuleTableName;
	
	protected $LayerTable;
	protected $LayerTableName;
	
	protected $PageID;
	protected $ObjectID;
	
	protected $Hostname;
	protected $User;
	protected $Password;
	protected $DatabaseName;
	protected $DatabaseTable;
	
	protected $ModulesLocation;
	
	protected $Modules = array();
	
	protected $Space;
	
	protected $ErrorMessage = array();
	
	public function setPageID($PageID) {
		$this->PageID = $PageID;
	}
	
	public function getPageID() {
		return $this->PageID;
	}
	
	public function setObjectID($ObjectID) {
		$this->ObjectID = $ObjectID;
	}
	
	public function getObjectID() {
		return $this->ObjectID;
	}
	
	public function setHostname ($hostname){
		$this->Hostname = $hostname;
	}
	
	public function getHostname () {
		return $this->Hostname;
	}
	
	public function setUser ($user){
		$this->User = $user;
	}
	
	public function getUser () {
		return $this->User;
	}
	
	public function setPassword ($password){
		$this->Password = $password;
	}
	
	public function getPassword () {
		return $this->Password;
	}
	
	public function setDatabaseName ($databasename){
		$this->DatabaseName = $databasename;
	}
	
	public function getDatabaseName () {
		return $this->DatabaseName;
	}
	
	public function setDatabasetable ($databasetable){
		$this->DatabaseTable[$databasetable] =  new MySqlConnect();
	}
	
	public function getDatabaseTable() {
		return $this->DatabaseTable;
	}
	
	public function getSpace() {
		return $this->Space;
	}	
	
	public function getError ($idnumber) {
		return $this->ErrorMessage[$idnumber];
	}
	
	public function getErrorArray() {
		return $this->ErrorMessage;
	}
	
	public function setModulesLocation ($moduleslocation){
		$this->ModulesLocation = $moduleslocation;
	}
	
	public function getModulesLocation () {
		return $this->ModulesLocation;
	}
	
	public function setDatabaseAll ($hostname, $user, $password, $databasename, $databasetable) {
		/*
		$this->Hostname = $hostname;
		$this->User = $user;
		$this->Password = $password;
		$this->DatabaseName = $databasename;*/
	}

	public function FetchDatabase ($idnumber) {
	
	}
	public function CreateOutput($space) {
	
	}
	public function getOutput() {
	
	}
	
	public function buildModules($LayerModuleTableName, $LayerTableName) {
		$this->LayerModuleTableName = $LayerModuleTableName;
		$this->LayerTableName = $LayerTableName;
		$passarray = array();
		$passarray['Enable/Disable'] = 'Enable';
		
		$this->LayerModule->Connect($this->LayerModuleTableName);
		$this->LayerModule->pass ($this->LayerModuleTableName, 'setDatabaseRow', array('idnumber' => $passarray));
		$this->LayerModule->Disconnect($this->LayerModuleTableName);
		
		$this->LayerModuleTable = $this->LayerModule->pass ($this->LayerModuleTableName, 'getMultiRowField', array());

		$this->LayerModule->Connect($this->LayerTableName);
		$this->LayerModule->pass ($this->LayerTableName, 'setEntireTable', array());
		$this->LayerModule->Disconnect($this->LayerTableName);
		
		$this->LayerTable = $this->LayerModule->pass ($this->LayerTableName, 'getEntireTable', array());
		
		//print_r($this->LayerTable);
		
		if ($LayerModuleTableName && $this->LayerModuleTable && $LayerTableName && $this->LayerTable) {
			while (current($this->LayerModuleTable)) {
				$ObjectType = $this->LayerModuleTable[key($this->LayerModuleTable)]['ObjectType'];
				$ObjectTypeName = $this->LayerModuleTable[key($this->LayerModuleTable)]['ObjectTypeName'];
				$ObjectTypeLocation = $this->LayerModuleTable[key($this->LayerModuleTable)]['ObjectTypeLocation'];
				$ModuleFileName = array();
				$ModuleFileName = $this->buildArray($ModuleFileName, 'ModuleFileName', key($this->LayerModuleTable), $this->LayerModuleTable);
				$EnableDisable = $this->LayerModuleTable[key($this->LayerModuleTable)]['Enable/Disable'];
				
				reset ($this->LayerTable);
				while (current($this->LayerTable)) {
					$NewObjectType = $this->LayerTable[key($this->LayerTable)]['ObjectType'];
					$NewObjectTypeName = $this->LayerTable[key($this->LayerTable)]['ObjectTypeName'];
					$DatabaseTables = array();
					$DatabaseTables = $this->buildArray($DatabaseTables, 'DatabaseTable', key($this->LayerTable), $this->LayerTable);
					
					if ($NewObjectType == $ObjectType && $NewObjectTypeName == $ObjectTypeName) {
						break;
					}
					next($this->LayerTable);
				}
				
				if ($EnableDisable == 'Enable') {
					reset ($ModuleFileName);
					$modulesfile = $ObjectTypeLocation;
					$modulesfile .= '/';
					$modulesfile .= current($ModuleFileName);
					$modulesfile .= '.php';
					
					while (current($ModuleFileName)) {
						if (is_file($modulesfile)) {
							require_once($modulesfile);
						} else {
							array_push($this->ErrorMessage,"buildModules: Module filename - $modulesfile does not exist!");
						}
						next($ModuleFileName);
						$modulesfile = $ObjectTypeLocation;
						$modulesfile .= '/';
						$modulesfile .= current($ModuleFileName);
						$modulesfile .= '.php';
					}
					
				}
				reset ($DatabaseTables);
				$modulesdatabase = array();
				while (current($DatabaseTables)) {
					$modulesdatabase[current($DatabaseTables)] = current($DatabaseTables);
					next($DatabaseTables);
				}
				if ($modulesdatabase) {
					//print "I HAVE DATA\n";
					$this->Modules[$ObjectType][$ObjectTypeName] = new $ObjectType ($modulesdatabase, $this->LayerModule);
				}
				//$this->Modules[$ObjectType][$ObjectTypeName] = $ObjectTypeName;
				//print_r($modulesdatabase);
				
				//var_dump ($this->Modules);
				next($this->LayerModuleTable);
			}
		} else {
			array_push($this->ErrorMessage,'buildModules: Module Tablename is not set!');
		}
	}
	
	protected function buildArray($array, $arrayname, $tablesname, $databasetable) {
		if (is_array($array)) {
			$i = 1;
			$name = $arrayname;
			$name .= $i;
			$hold = $databasetable[$tablesname][$name];
			while (array_key_exists($name, $databasetable[$tablesname])) {
				array_push($array, $hold);
				$i++;
				$name = $arrayname;
				$name .= $i;
				$hold = $databasetable[$tablesname][$name];
			}
			return $array;
		} else {
			return NULL;
		}
	}
	
}
?>
