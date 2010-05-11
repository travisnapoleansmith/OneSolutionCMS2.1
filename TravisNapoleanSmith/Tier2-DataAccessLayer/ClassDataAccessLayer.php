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
		
		$this->SessionName['SessionID'] = $_GET['SessionID'];
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
			//$tempobject = current($this->Modules[key($this->Modules)]);
			//$databasetables = $tempobject->getTableNames();
			//$tempobject->FetchDatabase ($this->PageID);
			//$tempobject->CreateOutput($this->Space);
			//$tempobject->getOutput();
			//$hold = $tempobject->Verify($function, $functionarguments);
			next($this->Modules);
		}
		
		$hold2 = call_user_func_array(array($this->DatabaseTable["$DatabaseTable"], "$function"), $functionarguments);
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
	
	public function buildModules($LayerModuleTableName, $LayerTableName, $LayerModuleTableNameSetting) {
		if ($this->SessionName) {
			$passarray = array();
			$passarray['SessionName'] = $this->SessionName;
			
			$this->createDatabaseTable('Sessions');
		
			reset($this->Layers);
			while (current($this->Layers)) {
				$this->Layers[key($this->Layers)]->createDatabaseTable('Sessions');
				next($this->Layers);
			}
			
			$this->Connect('Sessions');
			$this->pass ('Sessions', 'setDatabaseRow', array('idnumber' => $passarray));
			$this->Disconnect('Sessions');
			
			$this->SessionTypeName = $this->pass ('Sessions', 'getMultiRowField', array());
			$this->SessionTypeName = $this->SessionTypeName[0];
		}
		$this->LayerModuleTableNameSetting = $LayerModuleTableNameSetting;
		$this->LayerModuleTableName = $LayerModuleTableName;
		$this->LayerTableName = $LayerTableName;
		
		$this->createDatabaseTable($this->LayerModuleTableNameSetting);
		$this->createDatabaseTable($this->LayerModuleTableName);
		$this->createDatabaseTable($this->LayerTableName);
		
		$passarray = array();
		$passarray['Enable/Disable'] = 'Enable';
		
		$this->Connect($this->LayerModuleTableName);
		$this->pass ($this->LayerModuleTableName, 'setDatabaseRow', array('idnumber' => $passarray));
		$this->Disconnect($this->LayerModuleTableName);
		
		$this->LayerModuleTable = $this->pass ($this->LayerModuleTableName, 'getMultiRowField', array());

		$this->Connect($this->LayerTableName);
		$this->pass ($this->LayerTableName, 'setEntireTable', array());
		$this->Disconnect($this->LayerTableName);
		
		$this->LayerTable = $this->pass ($this->LayerTableName, 'getEntireTable', array());
				
		if ($LayerModuleTableName && $this->LayerModuleTable && $LayerTableName && $this->LayerTable) {
			$moduletable = current($this->LayerModuleTable);
			$keymoduletable = key($this->LayerModuleTable);
			while ($moduletable) {
				$ObjectType = $this->LayerModuleTable[$keymoduletable]['ObjectType'];
				$ObjectTypeName = $this->LayerModuleTable[$keymoduletable]['ObjectTypeName'];
				$ObjectTypeLocation = $this->LayerModuleTable[$keymoduletable]['ObjectTypeLocation'];
				$ModuleFileName = array();
				$ModuleFileName = $this->buildArray($ModuleFileName, 'ModuleFileName', $keymoduletable, $this->LayerModuleTable);
				$EnableDisable = $this->LayerModuleTable[$keymoduletable]['Enable/Disable'];
				
				reset ($this->LayerTable);
				$layertable = current($this->LayerTable);
				$keylayertable = key($this->LayerTable);
				while ($layertable) {
					$NewObjectType = $this->LayerTable[$keylayertable]['ObjectType'];
					$NewObjectTypeName = $this->LayerTable[$keylayertable]['ObjectTypeName'];
					
					if ($NewObjectType == $ObjectType && $NewObjectTypeName == $ObjectTypeName) {
						break;
					}
					next($this->LayerTable);
					$layertable = current($this->LayerTable);
					$keylayertable = key($this->LayerTable);
				}
				
				if ($EnableDisable == 'Enable') {
					reset ($ModuleFileName);
					$modulesfile = $ObjectTypeLocation;
					$modulesfile .= '/';
					$modulesfile .= current($ModuleFileName);
					$modulesfile .= '.php';
					
					$filename = current($ModuleFileName);
					while ($filename) {
						if (is_file($modulesfile)) {
							require_once($modulesfile);
						} else {
							array_push($this->ErrorMessage,"buildModules: Module filename - $modulesfile does not exist!");
						}
						next($ModuleFileName);
						$modulesfile = $ObjectTypeLocation;
						$modulesfile .= '/';
						$modulesfile .= $filename;
						$modulesfile .= '.php';
						$filename = current($ModuleFileName);
					}
					
				}
				
				if (is_array($layertable)) {
					if (in_array($this->LayerTable[$keylayertable]['ObjectType'], $layertable) && in_array($this->LayerTable[$keylayertable]['ObjectTypeName'], $layertable)) {
						$DatabaseTables = array();
						$DatabaseTables = $this->buildArray($DatabaseTables, 'DatabaseTable', $keylayertable, $this->LayerTable);
						reset($DatabaseTables);
						while (current($DatabaseTables)) {
							$this->createDatabaseTable(current($DatabaseTables));
							reset($this->Layers);
							while (current($this->Layers)) {
								$this->Layers[key($this->Layers)]->createDatabaseTable(current($DatabaseTables));
								next($this->Layers);
							}
							next ($DatabaseTables);
						}
						$DatabaseOptions = array();
						if ($this->SessionTypeName['SessionTypeName'] == $ObjectTypeName) {
							$DatabaseOptionsName = $ObjectType;
							$DatabaseOptionsName .= 'Session';
							
							$DatabaseOptions[$DatabaseOptionsName] = $_SESSION['POST'][$this->SessionTypeName['SessionValue']];
						}
						$this->createModules($ObjectType, $ObjectTypeName, $DatabaseTables, $DatabaseOptions);
					}
				}
				
				next($this->LayerModuleTable);
				$moduletable = current($this->LayerModuleTable);
				$keymoduletable = key($this->LayerModuleTable);
			}
		} else {
			array_push($this->ErrorMessage,'buildModules: Module Tablename is not set!');
		}
	}
		
}

?>