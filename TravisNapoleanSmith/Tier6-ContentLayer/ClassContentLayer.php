<?php

class ContentLayer extends LayerModulesAbstract
{
	protected $Modules;
	
	protected $DatabaseAllow;
	protected $DatabaseDeny;
	
	protected $PrintPreview;
	
	protected $DatabaseTableName;
	protected $ContentLayerDatabase;
	
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
		
		$this->Writer = &$GLOBALS['Writer'];
	}
	
	public function setPrintPreview($PrintPreview) {
		$this->PrintPreview = $PrintPreview;
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
	
	public function setDatabaseTableName ($databasetablename) {
		$this->DatabaseTableName = $databasetablename;
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
	
	public function FetchDatabase($PageID) {
		$this->PageID = $PageID;
		$passarray = array();
		$passarray = $PageID;

		$this->LayerModule->Connect($this->DatabaseTableName);
		$this->LayerModule->pass ($this->DatabaseTableName, 'setOrderbyname', array('OrderName' => 'ObjectID'));
		$this->LayerModule->pass ($this->DatabaseTableName, 'setOrderbytype', array('OrderType' => 'ASC'));
		$this->LayerModule->pass ($this->DatabaseTableName, 'setDatabaseRow', array('idnumber' => $passarray));
		$this->LayerModule->Disconnect($this->DatabaseTableName);
		
		$this->ContentLayerDatabase = $this->LayerModule->pass ($this->DatabaseTableName, 'getMultiRowField', array());
	}
	
	public function CreateOutput($Space) {
		reset($this->ContentLayerDatabase);
		
		while (current($this->ContentLayerDatabase)) {
			$ObjectType = $this->ContentLayerDatabase[key($this->ContentLayerDatabase)]['ObjectType'];
			$ObjectTypeName = $this->ContentLayerDatabase[key($this->ContentLayerDatabase)]['ObjectTypeName'];
			$ObjectTypeLocation = $this->LayerModuleTable[$ObjectType][$ObjectTypeName]['ObjectTypeLocation'];
			$ObjectTypeConfiguration = $this->LayerModuleTable[$ObjectType][$ObjectTypeName]['ObjectTypeConfiguration'];
			$ObjectTypePrintPreview = $this->LayerModuleTable[$ObjectType][$ObjectTypeName]['ObjectTypePrintPreview'];
			
			$StartTag = $this->ContentLayerDatabase[key($this->ContentLayerDatabase)]['StartTag'];
			$EndTag = $this->ContentLayerDatabase[key($this->ContentLayerDatabase)]['EndTag'];
			$StartTagID = $this->ContentLayerDatabase[key($this->ContentLayerDatabase)]['StartTagID'];
			$StartTagStyle = $this->ContentLayerDatabase[key($this->ContentLayerDatabase)]['StartTagStyle'];
			$StartTagClass = $this->ContentLayerDatabase[key($this->ContentLayerDatabase)]['StartTagClass'];
			
			$EnableDisable = $this->LayerModuleTable[$ObjectType][$ObjectTypeName]['Enable/Disable'];
			
			if ($EnableDisable == 'Enable') {
				if ($this->PrintPreview == FALSE || $ObjectTypePrintPreview == 'true') {
					if ($StartTag) {
						$StartTag = str_replace('<','', $StartTag);
						$StartTag = str_replace('>','', $StartTag);
						
						$this->Writer->startElement($StartTag);
						
						if ($StartTagID) {
							$this->Writer->writeAttribute('id', $StartTagID);
						}
						
						if ($StartTagStyle) {
							$this->Writer->writeAttribute('style', $StartTagStyle);
						}
						
						if ($StartTagClass) {
							$this->Writer->writeAttribute('class', $StartTagClass);
						}
						$this->Writer->writeRaw("\n");
					}
					
					if ($ObjectTypeConfiguration) {
						if (strstr($ObjectTypeConfiguration, '.html') || strstr($ObjectTypeConfiguration, '.htm')) {
							$file = file_get_contents($ObjectTypeConfiguration);
							$this->Writer->writeRaw($file);
						} else {
							require ("$ObjectTypeConfiguration");
						}
					} else {
						$idnumber = array();
						$idnumber['PageID'] = $this->PageID['PageID'];
						$idnumber['ObjectID'] = 1;
						
						$this->Modules[$ObjectType][$ObjectTypeName]->setHttpUserAgent($_SERVER['HTTP_USER_AGENT']);
						$this->Modules[$ObjectType][$ObjectTypeName]->FetchDatabase ($idnumber);
						$this->Modules[$ObjectType][$ObjectTypeName]->CreateOutput('    ');
					}
					
					if ($EndTag) {
						$this->Writer->endElement(); // ENDS END TAG
					}
				}
				
				if ($ObjectType == 'XhtmlHeader') {
					$this->Writer->startElement('body');
				}
			}
			next($this->ContentLayerDatabase);
		}
	}
		
}

?>