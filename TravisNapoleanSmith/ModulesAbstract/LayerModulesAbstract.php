<?php

abstract class LayerModulesAbstract 
{
	protected $Writer;
	
	protected $Layers = array();
	
	protected $LayerModule;
	
	protected $LayerModuleTable;
	protected $LayerModuleTableName;
	protected $LayerModuleTableNameSetting;
	
	protected $LayerModuleSetting = array();
	
	protected $LayerTable;
	protected $LayerTableName;
	
	protected $PageID;
	protected $ObjectID;
	
	protected $SessionName = array();
	protected $SessionTypeName;
	
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
	
	public function getLayerModuleTable (){
		return $this->LayerModuleTable;
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
	
	public function buildModules($LayerModuleTableName, $LayerTableName, $LayerModuleTableNameSetting) {
		if ($this->SessionName) {
			reset($this->SessionName);
			$passarray = array();
			$passarray['SessionName'] = key($this->SessionName);
			$this->createDatabaseTable('Sessions');
		
			reset($this->Layers);
			while (current($this->Layers)) {
				$this->Layers[key($this->Layers)]->createDatabaseTable('Sessions');
				next($this->Layers);
			}
			
			$this->LayerModule->Connect('Sessions');
			$this->LayerModule->pass ('Sessions', 'setDatabaseRow', array('idnumber' => $passarray));
			$this->LayerModule->Disconnect('Sessions');
			
			$this->SessionTypeName = $this->LayerModule->pass ('Sessions', 'getMultiRowField', array());
			$this->SessionTypeName = $this->SessionTypeName[0];
		}
		$this->LayerModuleTableNameSetting = $LayerModuleTableNameSetting;
		$this->LayerModuleTableName = $LayerModuleTableName;
		$this->LayerTableName = $LayerTableName;
		
		$this->createDatabaseTable($this->LayerModuleTableNameSetting);
		$this->createDatabaseTable($this->LayerModuleTableName);
		$this->createDatabaseTable($this->LayerTableName);
		
		reset($this->Layers);
		while (current($this->Layers)) {
			$this->Layers[key($this->Layers)]->createDatabaseTable($this->LayerModuleTableNameSetting);
			$this->Layers[key($this->Layers)]->createDatabaseTable($this->LayerModuleTableName);
			$this->Layers[key($this->Layers)]->createDatabaseTable($this->LayerTableName);
			next($this->Layers);
		}
		
		$passarray = array();
		$passarray['Enable/Disable'] = 'Enable';
		
		$this->LayerModule->Connect($this->LayerModuleTableName);
		$this->LayerModule->pass ($this->LayerModuleTableName, 'setDatabaseRow', array('idnumber' => $passarray));
		$this->LayerModule->Disconnect($this->LayerModuleTableName);
		
		$LayerModuleTable = $this->LayerModule->pass ($this->LayerModuleTableName, 'getMultiRowField', array());

		$this->LayerModule->Connect($this->LayerTableName);
		$this->LayerModule->pass ($this->LayerTableName, 'setEntireTable', array());
		$this->LayerModule->Disconnect($this->LayerTableName);
		
		$this->LayerTable = $this->LayerModule->pass ($this->LayerTableName, 'getEntireTable', array());
				
		if ($LayerModuleTableName && $LayerModuleTable && $LayerTableName && $this->LayerTable) {
			$moduletable = current($LayerModuleTable);
			$keymoduletable = key($LayerModuleTable);
			while ($moduletable) {
				$ObjectType = $LayerModuleTable[$keymoduletable]['ObjectType'];
				$ObjectTypeName = $LayerModuleTable[$keymoduletable]['ObjectTypeName'];
				$ObjectTypeLocation = $LayerModuleTable[$keymoduletable]['ObjectTypeLocation'];
				$ObjectTypeConfiguration = $LayerModuleTable[$keymoduletable]['ObjectTypeConfiguration'];
				$ObjectTypePrintPreview = $LayerModuleTable[$keymoduletable]['ObjectTypePrintPreview'];
				$ModuleFileName = array();
				$ModuleFileName = $this->buildArray($ModuleFileName, 'ModuleFileName', $keymoduletable, $LayerModuleTable);
				$EnableDisable = $LayerModuleTable[$keymoduletable]['Enable/Disable'];
				
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
					
					$this->LayerModuleTable[$ObjectType][$ObjectTypeName]['ObjectTypeLocation'] = $ObjectTypeLocation;
					$this->LayerModuleTable[$ObjectType][$ObjectTypeName]['ObjectTypeConfiguration'] = $ObjectTypeConfiguration;
					$this->LayerModuleTable[$ObjectType][$ObjectTypeName]['ObjectTypePrintPreview'] = $ObjectTypePrintPreview;
					$this->LayerModuleTable[$ObjectType][$ObjectTypeName] += $ModuleFileName;
					$this->LayerModuleTable[$ObjectType][$ObjectTypeName]['Enable/Disable'] = $EnableDisable;
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
				
				next($LayerModuleTable);
				$moduletable = current($LayerModuleTable);
				$keymoduletable = key($LayerModuleTable);
			}
		} else {
			array_push($this->ErrorMessage,'buildModules: Module Tablename is not set!');
		}
	}
	
	protected function createModules($ObjectType, $ObjectTypeName, $DatabaseTables, $DatabaseOptions) {
		$this->Modules[$ObjectType][$ObjectTypeName] = new $ObjectType ($DatabaseTables, $DatabaseOptions);
		
		reset($DatabaseTables);
		$this->Modules[$ObjectType][$ObjectTypeName]->setDatabaseAll ($this->Hostname, $this->User, $this->Password, $this->DatabaseName, current($DatabaseTables));
		
	}
	
	protected function buildArray($array, $arrayname, $tablesname, $databasetable) {
		if (is_array($array)) {
			$i = 1;
			$name = $arrayname;
			$name .= $i;
			$hold = $databasetable[$tablesname][$name];
			while (array_key_exists($name, $databasetable[$tablesname])) {
				$array[$name] = $hold;
				$i++;
				$name = $arrayname;
				$name .= $i;
				$hold = $databasetable[$tablesname][$name];
			}
			reset ($array);
			
			$temp2 = NULL;
			while (array_key_exists(key($array), $array)) {
				if (!current($array)) {
					$temp = key($array);
					next($array);
					unset($array[$temp]);
				} else {
					next($array);
				}
			}
			
			return $array;
		} else {
			return NULL;
		}
	}
	
}
?>
