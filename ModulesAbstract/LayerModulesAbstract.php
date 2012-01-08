<?php

abstract class LayerModulesAbstract 
{
	protected $Writer;
	
	protected $Layers = array();
	
	protected $LayerModule;
	protected $PriorLayerModule;
	
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
	
	protected static $OneSolutionCMSVersion;
	
	protected $ModulesLocation;
	
	protected $Modules = array();
	
	protected $Space;
	
	protected $ErrorMessage = array();
	
	public function setPriorLayerModule(self &$PriorLayerModule) {
		$this->PriorLayerModule = &$PriorLayerModule;
	}
	
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
	
	final public function getOneSolutionCMSVersion() {
		return $this->OneSolutionCMSVersion;
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
	
	public function getLayerModuleSetting () {
		return $this->LayerModuleSetting;
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
		
			//reset($this->Layers);
			//while (current($this->Layers)) {
				//$this->Layers[key($this->Layers)]->createDatabaseTable('Sessions');
				//next($this->Layers);
			//}
			$this->LayerModule->createDatabaseTable('Sessions');
			
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
		
		$this->LayerModule->createDatabaseTable($this->LayerModuleTableNameSetting);
		$this->LayerModule->createDatabaseTable($this->LayerModuleTableName);
		$this->LayerModule->createDatabaseTable($this->LayerTableName);
		
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
				
		$this->LayerModule->Connect($this->LayerModuleTableNameSetting);
		$this->LayerModule->pass ($this->LayerModuleTableNameSetting, 'setEntireTable', array());
		$this->LayerModule->Disconnect($this->LayerModuleTableNameSetting);
		
		$LayerModuleSetting = $this->LayerModule->pass ($this->LayerModuleTableNameSetting, 'getEntireTable', array());
		$ModuleSetting = array();
		$InnerKey = array();
		$InnerKey['ObjectTypeName'] = 'ObjectTypeName';
		$InnerKey['Setting'] = 'Setting';
		$this->LayerModuleSetting = $this->buildArray($ModuleSetting, $InnerKey, 'ObjectType', $LayerModuleSetting);
				
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
				$ModuleFileName = $this->buildArray($ModuleFileName, 'ModuleFileName', $keymoduletable, $LayerModuleTable, 'Numerical');
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
					foreach ($ModuleFileName as $FileName) {
						$ModulesFile = $_SERVER['SUBDOMAIN_DOCUMENT_ROOT'];
						$ModulesFile .= '/';
						$ModulesFile .= $ObjectTypeLocation;
						$ModulesFile .= '/';
						$ModulesFile .= $FileName;
						$ModulesFile .= '.php';
						
						if (is_file($ModulesFile)) {
							require_once($ModulesFile);
						} else {
							array_push($this->ErrorMessage,"buildModules: Module filename - $modulesfile does not exist!");
						}
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
						$DatabaseTables = $this->buildArray($DatabaseTables, 'DatabaseTable', $keylayertable, $this->LayerTable, 'Numerical');
						reset($DatabaseTables);
						while (current($DatabaseTables)) {
							$this->createDatabaseTable(current($DatabaseTables));
							next ($DatabaseTables);
						}
						$DatabaseOptions = array();
						if ($this->SessionTypeName['SessionTypeName'] == $ObjectTypeName) {
							$DatabaseOptionsName = $ObjectType;
							$DatabaseOptionsName .= 'Session';
							
							$DatabaseOptions[$DatabaseOptionsName] = $_SESSION['POST'][$this->SessionTypeName['SessionValue']];
						}
						
						if ($this->LayerModuleSetting[$ObjectType][$ObjectTypeName]) {
							reset($this->LayerModuleSetting[$ObjectType][$ObjectTypeName]);
							while (current($this->LayerModuleSetting[$ObjectType][$ObjectTypeName])) {
								$temp = current($this->LayerModuleSetting[$ObjectType][$ObjectTypeName]);
								$Setting = $temp['Setting'];
								$SettingAttribute = $temp['SettingAttribute'];
								$DatabaseOptions[$Setting] = $SettingAttribute;
								next($this->LayerModuleSetting[$ObjectType][$ObjectTypeName]);
							}
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
		$this->Modules[$ObjectType][$ObjectTypeName] = new $ObjectType ($DatabaseTables, $DatabaseOptions, $this->LayerModule);
		
		reset($DatabaseTables);
		$this->Modules[$ObjectType][$ObjectTypeName]->setDatabaseAll ($this->Hostname, $this->User, $this->Password, $this->DatabaseName, current($DatabaseTables));
		
	}
	
	protected function buildArray($array, $innerkey, $outerkey, $databasetable) {
		if (is_array($array)) {
			$numargs = func_num_args();
			$numerical = NULL;
			if ($numargs == 5) {
				$args = func_get_args();
				$numberical = $args[4];
			}

			if ($numberical == 'Numerical') {
				$i = 1;
				$name = $innerkey;
				$name .= $i;
				$hold = $databasetable[$outerkey][$name];
				while (array_key_exists($name, $databasetable[$outerkey])) {
					$array[$name] = $hold;
					$i++;
					$name = $innerkey;
					$name .= $i;
					$hold = $databasetable[$outerkey][$name];
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
			} else {
				if (is_array($databasetable)) {
					reset($databasetable);
					if (is_array($innerkey)) {
						while (current($databasetable)) {
							$key1 = $databasetable[key($databasetable)][$outerkey];
							
							reset($innerkey);
							$key2 = $databasetable[key($databasetable)][current($innerkey)];
							next($innerkey);
							
							while (current($innerkey)) {
								$key3 = $databasetable[key($databasetable)][current($innerkey)];
								$array[$key1][$key2][$key3] = $databasetable[key($databasetable)];
								next($innerkey);
							}
							
							next($databasetable);
						}
					} else {
						while (current($databasetable)) {
							$key1 = $databasetable[key($databasetable)][$outerkey];
							$key2 = $databasetable[key($databasetable)][$innerkey];
							$array[$key1][$key2] = $databasetable[key($databasetable)];
							next($databasetable);
						}
					}
				}
			}
			
			return $array;
		} else {
			return NULL;
		}
	}
	
	protected function addModuleContent(array $Keys, array $Content, $DatabaseTableName) {
		if ($Keys != NULL && $Content != NULL && $DatabaseTableName) {
			$passarray = array();
			$passarray1 = array();
			$passarray2 = array();
			$i = 0;
			reset($Keys);
			while (current($Keys)) {
				$passarray1[$i] = current($Keys);
				$i++;
				next($Keys);
			}
			
			if (count($Content) == count($Content, COUNT_RECURSIVE)) {
				$i = 0;
				reset($Content);
				while (key($Content)) {
					$passarray2[$i] = $Content[$passarray1[$i]];
					$i++;
					next($Content);
				}
				
				$passarray['rowname'] = $passarray1;
				$passarray['rowvalue'] = $passarray2;
				
				$this->LayerModule->Connect($DatabaseTableName);
				$this->LayerModule->pass ($DatabaseTableName, 'createRow', $passarray);
				$this->LayerModule->Disconnect($DatabaseTableName);
			} else {
				$i = 0;
				reset($Content);
				while ($Content[key($Content)]) {
					$j = 0;
					$hold = $Content[key($Content)];
					reset($hold);
					while (key($hold)) {
						$passarray2[$j] = current($hold);
						next($hold);
						$j++;
					}
					$passarray['rowname'] = $passarray1;
					$passarray['rowvalue'] = $passarray2;

					$this->LayerModule->Connect($DatabaseTableName);
					$this->LayerModule->pass ($DatabaseTableName, 'createRow', $passarray);
					$this->LayerModule->Disconnect($DatabaseTableName);
					$i++;
					next($Content);
				}
			}
			
			if (in_array('ObjectID', $Keys)) {
				$SortOrder = array();
				$SortOrder['ObjectID'] = 'ObjectID';
				$this->sortTable($SortOrder, $DatabaseTableName);
			}
			
			if (in_array('RevisionID', $Keys)) {
				$SortOrder = array();
				$SortOrder['RevisionID'] = 'RevisionID';
				$this->sortTable($SortOrder, $DatabaseTableName);
			}
			
			if (in_array('PageID', $Keys)) {
				$SortOrder = array();
				$SortOrder['PageID'] = 'PageID';
				$this->sortTable($SortOrder, $DatabaseTableName);
			}
			
			if (in_array('XMLFeedName', $Keys)) {
				$SortOrder = array();
				$SortOrder['XMLFeedName'] = 'XMLFeedName';
				$this->sortTable($SortOrder, $DatabaseTableName);
			}
			
			if (in_array('XMLItem', $Keys)) {
				$SortOrder = array();
				$SortOrder['XMLItem'] = 'XMLItem';
				$this->sortTable($SortOrder, $DatabaseTableName);
			}
		} else {
			array_push($this->ErrorMessage,'addModuleContent: Keys, Content or Database Table Name cannot be NULL!');
		}
	}
	
	protected function updateModuleContent(array $PageID, $DatabaseTableName) {
		$arguments = func_get_args();
		$Data = $arguments[2];
		if ($PageID != NULL && $DatabaseTableName != NULL) {
			$passarray = array();
			$passarray1 = array();
			$passarray2 = array();
			$passarray3 = array();
			$passarray4 = array();
			if ($Data != NULL) {
				$passarray1 = array_keys($Data);
				$passarray2 = array_values($Data);
				
				$i = 0;
				foreach ($Data as $Key => $Value) {
					$passarray3[$i] = array_keys($PageID);
					$passarray4[$i] = array_values($PageID);
					
					$i++;
				}
			} else {
				if ($PageID['PageID']) {
					$passarray1[0] = 'CurrentVersion';
					$passarray2[0] = 'false';
				} 
				
				if ($PageID['XMLItem']) {
					$passarray1[0][0] = 'XMLItem';
					$passarray2[0][0] = $PageID['XMLItem'];
					
					if ($PageID['FeedItemTitle']) {
						$passarray1[0] = 'FeedItemTitle';
						$passarray2[0] = $PageID['FeedItemTitle'];
					}
					
					if ($PageID['FeedItemDescription']) {
						$passarray1[1] = 'FeedItemDescription';
						$passarray2[1] = $PageID['FeedItemDescription'];
					}
					
					if ($PageID['FeedItemAuthor']) {
						$passarray1[2] = 'FeedItemAuthor';
						$passarray2[2] = $PageID['FeedItemAuthor'];
					}
					
					if ($PageID['FeedItemCategory']) {
						$passarray1[3] = 'FeedItemCategory';
						$passarray2[3] = $PageID['FeedItemCategory'];
					}
					
					if ($PageID['FeedItemGuid']) {
						$passarray1[4] = 'FeedItemGuid';
						$passarray2[4] = $PageID['FeedItemGuid'];
					}
					
					if ($PageID['FeedItemPubDate']) {
						$passarray1[5] = 'FeedItemPubDate';
						$passarray2[5] = $PageID['FeedItemPubDate'];
					}
				}
				
				if ($PageID['PageID']) {
					$passarray3[0][0] = 'PageID';
					$passarray4[0][0] = $PageID['PageID'];
					
					$passarray3[0][1] = 'CurrentVersion';
					$passarray4[0][1] = 'true';
					
				} 
				
				if ($PageID['XMLItem']) {
					$passarray3[0] = 'XMLItem';
					$passarray4[0] = $PageID['XMLItem'];
					
					$passarray3[1] = 'XMLItem';
					$passarray4[1] = $PageID['XMLItem'];
					
					$passarray3[2] = 'XMLItem';
					$passarray4[2] = $PageID['XMLItem'];
					
					$passarray3[3] = 'XMLItem';
					$passarray4[3] = $PageID['XMLItem'];
					
					$passarray3[4] = 'XMLItem';
					$passarray4[4] = $PageID['XMLItem'];
					
					$passarray3[5] = 'XMLItem';
					$passarray4[5] = $PageID['XMLItem'];
				}
			}
			
			$passarray['rowname'] = $passarray1;
			$passarray['rowvalue'] = $passarray2;
			$passarray['rownumbername'] = $passarray3;
			$passarray['rownumber'] = $passarray4;
			
			$this->LayerModule->Connect($DatabaseTableName);
			$this->LayerModule->pass ($DatabaseTableName, 'updateRow', $passarray);
			
			$this->LayerModule->Disconnect($DatabaseTableName);
			
		} else {
			array_push($this->ErrorMessage,'updateModuleContent: PageID and DatabaseTableName cannot be NULL!');
		}
	}
	
	protected function deleteModuleContent(array $PageID, $DatabaseTableName) {
		if ($PageID != NULL && $DatabaseTableName != NULL) {
			$passarray = array();
			$passarray1 = array();
			$passarray2 = array();
			$passarray3 = array();
			$passarray4 = array();
			
			$passarray1[0] = 'Enable/Disable';
			
			$passarray2[0] = 'Disable';
			
			if ($PageID['PageID']) {
				$passarray3[0][0] = 'PageID';
				
				$passarray4[0][0] = $PageID['PageID'];
			} else if ($PageID['XMLItem']) {
				$passarray3[0][0] = 'XMLItem';
				
				$passarray4[0][0] = $PageID['XMLItem'];
			}
			
			if ($PageID['ObjectID']) {
				$passarray3[0][1] = 'ObjectID';
				$passarray4[0][1] = $PageID['ObjectID'];
			}
			
			$passarray['rowname'] = $passarray1;
			$passarray['rowvalue'] = $passarray2;
			$passarray['rownumbername'] = $passarray3;
			$passarray['rownumber'] = $passarray4;
			
			$this->LayerModule->Connect($DatabaseTableName);
			$this->LayerModule->pass ($DatabaseTableName, 'updateRow', $passarray);
			$this->LayerModule->Disconnect($DatabaseTableName);
		} else {
			array_push($this->ErrorMessage,'deleteModuleContent: PageID and DatabaseTableName cannot be NULL!');
		}
	}
	
	protected function enableModuleContent(array $PageID, $DatabaseTableName) {
		if ($PageID != NULL && $DatabaseTableName != NULL) {
			$passarray = array();
			$passarray1 = array();
			$passarray2 = array();
			$passarray3 = array();
			$passarray4 = array();
			
			$passarray1[0] = 'Enable/Disable';
			$passarray2[0] = 'Enable';
			if ($PageID['PageID']) {
				$passarray3[0][0] = 'PageID';
				$passarray4[0][0] = $PageID['PageID'];
			} else if ($PageID['XMLItem']) {
				$passarray3[0][0] = 'XMLItem';
				
				$passarray4[0][0] = $PageID['XMLItem'];
			}
			
			if ($PageID['ObjectID']) {
				$passarray3[0][1] = 'ObjectID';
				$passarray4[0][1] = $PageID['ObjectID'];
			}
			
			$passarray['rowname'] = $passarray1;
			$passarray['rowvalue'] = $passarray2;
			$passarray['rownumbername'] = $passarray3;
			$passarray['rownumber'] = $passarray4;
			
			$this->LayerModule->Connect($DatabaseTableName);
			$this->LayerModule->pass ($DatabaseTableName, 'updateRow', $passarray);
			$this->LayerModule->Disconnect($DatabaseTableName);
		} else {
			array_push($this->ErrorMessage,'enableModuleContent: PageID and DatabaseTableName cannot be NULL!');
		}
	}
	
	protected function disableModuleContent(array $PageID, $DatabaseTableName) {
		if ($PageID != NULL && $DatabaseTableName != NULL) {
			$passarray = array();
			$passarray1 = array();
			$passarray2 = array();
			$passarray3 = array();
			$passarray4 = array();
			
			$passarray1[0] = 'Enable/Disable';
			
			$passarray2[0] = 'Disable';
			
			if ($PageID['PageID']) {
				$passarray3[0][0] = 'PageID';
				
				$passarray4[0][0] = $PageID['PageID'];
			} else if ($PageID['XMLItem']) {
				$passarray3[0][0] = 'XMLItem';
				
				$passarray4[0][0] = $PageID['XMLItem'];
			}
			
			if ($PageID['ObjectID']) {
				$passarray3[0][1] = 'ObjectID';
				$passarray4[0][1] = $PageID['ObjectID'];
			}
			
			$passarray['rowname'] = $passarray1;
			$passarray['rowvalue'] = $passarray2;
			$passarray['rownumbername'] = $passarray3;
			$passarray['rownumber'] = $passarray4;
			
			$this->LayerModule->Connect($DatabaseTableName);
			$this->LayerModule->pass ($DatabaseTableName, 'updateRow', $passarray);
			$this->LayerModule->Disconnect($DatabaseTableName);
		} else {
			array_push($this->ErrorMessage,'disableModuleContent: PageID and DatabaseTableName cannot be NULL!');
		}
	}
	
	protected function approvedModuleContent(array $PageID, $DatabaseTableName) {
		if ($PageID != NULL && $DatabaseTableName != NULL) {
			$passarray = array();
			$passarray1 = array();
			$passarray2 = array();
			$passarray3 = array();
			$passarray4 = array();
			
			$passarray1[0] = 'Status';
			
			$passarray2[0] = 'Approved';
			
			if ($PageID['PageID']) {
				$passarray3[0][0] = 'PageID';
				
				$passarray4[0][0] = $PageID['PageID'];
			} else if ($PageID['XMLItem']) {
				$passarray3[0][0] = 'XMLItem';
				
				$passarray4[0][0] = $PageID['XMLItem'];
			}
			
			if ($PageID['ObjectID']) {
				$passarray3[0][1] = 'ObjectID';
				$passarray4[0][1] = $PageID['ObjectID'];
			}
			
			$passarray['rowname'] = $passarray1;
			$passarray['rowvalue'] = $passarray2;
			$passarray['rownumbername'] = $passarray3;
			$passarray['rownumber'] = $passarray4;
			
			$this->LayerModule->Connect($DatabaseTableName);
			$this->LayerModule->pass ($DatabaseTableName, 'updateRow', $passarray);
			$this->LayerModule->Disconnect($DatabaseTableName);
		} else {
			array_push($this->ErrorMessage,'approvedModuleContent: PageID and DatabaseTableName cannot be NULL!');
		}
	}
	
	protected function notApprovedModuleContent(array $PageID, $DatabaseTableName) {
		if ($PageID != NULL && $DatabaseTableName != NULL) {
			$passarray = array();
			$passarray1 = array();
			$passarray2 = array();
			$passarray3 = array();
			$passarray4 = array();
			
			$passarray1[0] = 'Status';
			
			$passarray2[0] = 'Not-Approved';
			
			if ($PageID['PageID']) {
				$passarray3[0][0] = 'PageID';
				
				$passarray4[0][0] = $PageID['PageID'];
			} else if ($PageID['XMLItem']) {
				$passarray3[0][0] = 'XMLItem';
				
				$passarray4[0][0] = $PageID['XMLItem'];
			}
			
			if ($PageID['ObjectID']) {
				$passarray3[0][1] = 'ObjectID';
				$passarray4[0][1] = $PageID['ObjectID'];
			}
			
			$passarray['rowname'] = $passarray1;
			$passarray['rowvalue'] = $passarray2;
			$passarray['rownumbername'] = $passarray3;
			$passarray['rownumber'] = $passarray4;
			
			$this->LayerModule->Connect($DatabaseTableName);
			$this->LayerModule->pass ($DatabaseTableName, 'updateRow', $passarray);
			$this->LayerModule->Disconnect($DatabaseTableName);
		} else {
			array_push($this->ErrorMessage,'notApprovedModuleContent: PageID and DatabaseTableName cannot be NULL!');
		}
	}
	
	protected function spamModuleContent(array $PageID, $DatabaseTableName) {
		if ($PageID != NULL && $DatabaseTableName != NULL) {
			$passarray = array();
			$passarray1 = array();
			$passarray2 = array();
			$passarray3 = array();
			$passarray4 = array();
			
			$passarray1[0] = 'Status';
			
			$passarray2[0] = 'Spam';
			
			if ($PageID['PageID']) {
				$passarray3[0][0] = 'PageID';
				
				$passarray4[0][0] = $PageID['PageID'];
			} else if ($PageID['XMLItem']) {
				$passarray3[0][0] = 'XMLItem';
				
				$passarray4[0][0] = $PageID['XMLItem'];
			}
			
			if ($PageID['ObjectID']) {
				$passarray3[0][1] = 'ObjectID';
				$passarray4[0][1] = $PageID['ObjectID'];
			}
			
			$passarray['rowname'] = $passarray1;
			$passarray['rowvalue'] = $passarray2;
			$passarray['rownumbername'] = $passarray3;
			$passarray['rownumber'] = $passarray4;
			
			$this->LayerModule->Connect($DatabaseTableName);
			$this->LayerModule->pass ($DatabaseTableName, 'updateRow', $passarray);
			$this->LayerModule->Disconnect($DatabaseTableName);
		} else {
			array_push($this->ErrorMessage,'spamModuleContent: PageID and DatabaseTableName cannot be NULL!');
		}
	}
	
	protected function pendingModuleContent(array $PageID, $DatabaseTableName) {
		if ($PageID != NULL && $DatabaseTableName != NULL) {
			$passarray = array();
			$passarray1 = array();
			$passarray2 = array();
			$passarray3 = array();
			$passarray4 = array();
			
			$passarray1[0] = 'Status';
			
			$passarray2[0] = 'Pending';
			
			if ($PageID['PageID']) {
				$passarray3[0][0] = 'PageID';
				
				$passarray4[0][0] = $PageID['PageID'];
			} else if ($PageID['XMLItem']) {
				$passarray3[0][0] = 'XMLItem';
				
				$passarray4[0][0] = $PageID['XMLItem'];
			}
			
			if ($PageID['ObjectID']) {
				$passarray3[0][1] = 'ObjectID';
				$passarray4[0][1] = $PageID['ObjectID'];
			}
			
			$passarray['rowname'] = $passarray1;
			$passarray['rowvalue'] = $passarray2;
			$passarray['rownumbername'] = $passarray3;
			$passarray['rownumber'] = $passarray4;
			
			$this->LayerModule->Connect($DatabaseTableName);
			$this->LayerModule->pass ($DatabaseTableName, 'updateRow', $passarray);
			$this->LayerModule->Disconnect($DatabaseTableName);
		} else {
			array_push($this->ErrorMessage,'pendingModuleContent: PageID and DatabaseTableName cannot be NULL!');
		}
	}
	
	protected function installModule($ModuleType, $ModuleName, $ModuleInstallFile) {
		
	}
	
	protected function upgradeModule($ModuleType, $ModuleName, $ModuleUpgradeFile) {
		
	}
	
	protected function deleteModule($ModuleType, $ModuleName, $ModuleDeleteFile) {
		
	}
	
	protected function enableModule($ModuleType, $ModuleName) {
		
	}
	
	protected function disableModule($ModuleType, $ModuleName) {
		
	}
	
	public function getTable($TableName) {
		if (is_string($TableName)) {
			$this->LayerModule->createDatabaseTable($TableName);
			$this->LayerModule->Connect($TableName);
			$this->LayerModule->pass ($TableName, 'setEntireTable', array());
			$this->LayerModule->Disconnect($TableName);
			
			$hold = $this->LayerModule->pass ($TableName, 'getEntireTable', array());
			
			return $hold;
		}
	}
	
	public function getRecord($PageID) {
		$passarray = array();
		$passarray = $PageID['PageID'];
		
		$args = func_get_args();
		if ($args[1]) {
			
			$DatabaseName = $args[1];
			$this->LayerModule->createDatabaseTable($DatabaseName);
			if (is_array($PageID)) {
				$passarray = $PageID;
			}
			$this->LayerModule->Connect($DatabaseName);
			if ($args[2]) {
				$hold = NULL;
				$trip = FALSE;
				foreach ($args[3] as $key => $value) {
					if ($value != NULL) {
						if ($trip) {
							$hold .= '`, `';
							$hold .= $value;
						} else {
							$hold .= $value;
							$trip = TRUE;
						}
					}
				}
				
				if ($hold) {
					$this->LayerModule->pass ($DatabaseName, 'setOrderbyname', array('orderbyname' => $hold));
				}

				if ($args[4] == 'ASC' | $args[4] == 'DESC') {
					$this->LayerModule->pass ($DatabaseName, 'setOrderbytype', array('orderbytype' => $args[4]));
				} else if ($args[3]){
					$this->LayerModule->pass ($DatabaseName, 'setOrderbytype', array('orderbytype' => 'ASC'));
				}
			}
			$this->LayerModule->pass ($DatabaseName, 'setDatabaseRow', array('idnumber' => $passarray));
			$this->LayerModule->Disconnect($DatabaseName);
			
			$hold = $this->LayerModule->pass ($DatabaseName, 'getMultiRowField', array());
		} else {
			$DatabaseVariableName = $PageID['DatabaseVariableName'];
			
			$this->LayerModule->Connect($this->$DatabaseVariableName);
			$this->LayerModule->pass ($this->$DatabaseVariableName, 'setDatabaseRow', array('idnumber' => $passarray));
			$this->LayerModule->Disconnect($this->$DatabaseVariableName);

			$hold = $this->LayerModule->pass ($this->$DatabaseVariableName, 'getMultiRowField', array());
		}
		

		return $hold;
	}
	
	protected function updateRecord(array $PageID, array $Content, $DatabaseTableName) {
		if ($PageID != NULL && $Content != NULL && $DatabaseTableName != NULL) {
			$passarray = array();
			$passarray1 = array();
			$passarray2 = array();
			$passarray3 = array();
			$passarray4 = array();
			
			$j = 0;
			while (key($PageID)) {
				$passarray3[0][$j] = key($PageID);
				$passarray4[0][$j] = current($PageID);
				$j++;
				next ($PageID);
			}
			
			$flag = FALSE;
			reset ($Content);
			$i = 0;
			while (key($Content)) {
				if (is_array($Content[key($Content)])) {
					$hold = $Content[key($Content)];
					reset($hold);
					$j = 0;
					while (key($hold)) {
						$passarray1[$j] = key($hold);
						$passarray2[$j] = current($hold);
						next($hold);
						$j++;
					}
					
					$passarray['rowname'] = $passarray1;
					$passarray['rowvalue'] = $passarray2;
					$passarray['rownumbername'] = $passarray3;
					$passarray['rownumber'] = $passarray4;
					
					$this->LayerModule->Connect($DatabaseTableName);
					$this->LayerModule->pass ($DatabaseTableName, 'updateRow', $passarray);
					$this->LayerModule->Disconnect($DatabaseTableName);
					
				} else {
					$passarray1[$i] = key($Content);
					$passarray2[$i] = current($Content);
					$flag = TRUE;
				}
				reset ($PageID);
				
				$i++;
				next ($Content);
			}
			if ($flag) {
				$passarray['rowname'] = $passarray1;
				$passarray['rowvalue'] = $passarray2;
				$passarray['rownumbername'] = $passarray3;
				$passarray['rownumber'] = $passarray4;
				
				$this->LayerModule->Connect($DatabaseTableName);
				$this->LayerModule->pass ($DatabaseTableName, 'updateRow', $passarray);
				$this->LayerModule->Disconnect($DatabaseTableName);
			}
		} else {
			array_push($this->ErrorMessage,'updateRecord: PageID, Content and DatabaseTableName cannot be NULL!');
		}
	}
	
	public function updateModuleSetting($ObjectType, $ObjectTypeName, $ModuleSetting, $ModuleSettingAttribute) {
		if ($ModuleSetting != NULL && $ModuleSettingAttribute != NULL && $ObjectType != NULL && $ObjectTypeName != NULL) {
			$passarray = array();
			$passarray1 = array();
			$passarray2 = array();
			$passarray3 = array();
			$passarray4 = array();
			
			$passarray1[0] = 'SettingAttribute';
			
			$passarray2[0] = $ModuleSettingAttribute;
			
			
			$passarray3[0][0] = 'ObjectType';
			$passarray3[0][1] = 'ObjectTypeName';
			$passarray3[0][2] = 'Setting';
				
			$passarray4[0][0] = $ObjectType;
			$passarray4[0][1] = $ObjectTypeName;
			$passarray4[0][2] = $ModuleSetting;
			
			$passarray['rowname'] = $passarray1;
			$passarray['rowvalue'] = $passarray2;
			$passarray['rownumbername'] = $passarray3;
			$passarray['rownumber'] = $passarray4;
			
			$this->LayerModule->Connect($this->LayerModuleTableNameSetting);
			$this->LayerModule->pass ($this->LayerModuleTableNameSetting, 'updateRow', $passarray);
			$this->LayerModule->Disconnect($this->LayerModuleTableNameSetting);
		} else {
			array_push($this->ErrorMessage,'updateModuleSetting: ObjectType, ObjectTypeName, ModuleSetting and ModuleSettingAttribute cannot be NULL!');
		}
	}
	
	public function sortTable(array $SortOrder, $DatabaseTableName) {
		if ($DatabaseTableName != NULL) {
			$this->LayerModule->createDatabaseTable($DatabaseTableName);
			$this->LayerModule->Connect($DatabaseTableName);
			$this->LayerModule->pass ($DatabaseTableName, 'sortTable', array('SortOrder'=> $SortOrder));
			$this->LayerModule->Disconnect($DatabaseTableName);
		} else {
			array_push($this->ErrorMessage,'sortTable: SortOrder cannot be NULL!');
		}
	}
	
}
?>