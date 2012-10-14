<?php

class ProtectionLayer extends LayerModulesAbstract
{
	//protected $Uri;
	//protected $Location;
	//protected $Client;
	
	protected $Modules;
	
	protected $DatabaseAllow;
	protected $DatabaseDeny;
	
	public function __construct () {
		$this->Modules = Array();
		$this->DatabaseTable = Array();
		$GLOBALS['ErrorMessage']['ProtectionLayer'] = array();
		$this->ErrorMessage = &$GLOBALS['ErrorMessage']['ProtectionLayer'];
		
		$this->DatabaseAllow = &$GLOBALS['Tier3DatabaseAllow'];
		$this->DatabaseDeny = &$GLOBALS['Tier3DatabaseDeny'];
		
		$credentaillogonarray = $GLOBALS['credentaillogonarray'];
		
		$this->LayerModule = &new DataAccessLayer();
		//$this->LayerModule->setPriorLayerModule($this);
		$this->LayerModule->createDatabaseTable('ContentLayer');
		$this->LayerModule->setDatabaseAll ($credentaillogonarray[0], $credentaillogonarray[1], $credentaillogonarray[2], $credentaillogonarray[3], NULL);
		$this->LayerModule->buildModules('DataAccessLayerModules', 'DataAccessLayerTables', 'DataAccessLayerModulesSettings');
		
		$this->PageID = $_GET['PageID'];
		
		$this->SessionName['SessionID'] = $_GET['SessionID'];
		
		//$this->Location = &$GLOBALS['SETTINGS']['TIER CONFIGURATION']['TIER2DATAACCESSLAYERSOAPLOCATION'];
		//$this->Uri = &$GLOBALS['SETTINGS']['SITE SETTINGS']['SITELINK'];
		//$this->Client = new SoapClient(NULL, array('location' => $this->Location, 'uri' => $this->Uri, 'soap_version' => SOAP_1_2));
		//$this->Client->createDatabaseTable('ContentLayer');
		//$this->Client->setDatabaseAll ($credentaillogonarray[0], $credentaillogonarray[1], $credentaillogonarray[2], $credentaillogonarray[3], NULL);
		//$this->Client->buildModules('DataAccessLayerModules', 'DataAccessLayerTables', 'DataAccessLayerModulesSettings');
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
		//$this->Client->setDatabaseAll ($hostname, $user, $password, $databasename);
	}
	
	public function ConnectAll () {
		$this->LayerModule->ConnectAll();
		//$this->Client->ConnectAll();
	}
	
	public function Connect ($key) {
		$this->LayerModule->Connect($key);
		//$this->Client->Connect($key);
	}
	
	public function DisconnectAll () {
		$this->LayerModule->DisconnectAll();
		//$this->Client->DisconnectAll();
	}
	
	public function Disconnect ($key) {
		$this->LayerModule->Disconnect($key);
		//$this->Client->Disconnect($key);
	}
	
	public function buildDatabase() {

	}
	
	public function createDatabaseTable($key) {
		$this->LayerModule->createDatabaseTable($key);
		//$this->Client->createDatabaseTable($key);
	}
	
	public function checkPass($DatabaseTable, $function, $functionarguments) {
		reset($this->Modules);
		$hold = NULL;
		$args = func_num_args();
		if ($args > 3) {
			$hookargumentsarray = func_get_args();
			$hookarguments = $hookargumentsarray[3];
			if (is_array($hookarguments)) {
				while (current($this->Modules)) {
					$tempobject = current($this->Modules[key($this->Modules)]);
					//$databasetables = $tempobject->getTableNames();
					if ($function == 'PROTECT') {
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
				//$databasetables = $tempobject->getTableNames();
				if ($function == 'PROTECT') {
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
		/*
		while (current($this->Modules)) {
			$tempobject = current($this->Modules[key($this->Modules)]);
			//$databasetables = $tempobject->getTableNames();
			if ($function == 'PROTECT') {
				$tempobject->FetchDatabase ($functionarguments);
			} else {
				$tempobject->FetchDatabase ($this->PageID);
			}
			//$tempobject->CreateOutput($this->Space);
			//$tempobject->getOutput();
			$hold = $tempobject->Verify($function, $functionarguments);
			next($this->Modules);
		}*/
		
		if ($function == 'PROTECT') {
			if ($hold) {
				return $hold;
			}
		} else {
			$hold2 = $this->LayerModule->pass($DatabaseTable, $function, $functionarguments);
			//$hold2 = $this->Client->pass($DatabaseTable, $function, $functionarguments);
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
							$args = func_num_args();
							if ($args > 3) {
								$hookargumentsarray = func_get_args();
								$hookarguments = $hookargumentsarray[3];
								if (is_array($hookarguments)) {
									$hold = $this->LayerModule->pass($databasetable, $function, $functionarguments, $hookarguments);
									//$hold = $this->Client->pass($databasetable, $function, $functionarguments, $hookarguments);
								} else {
									array_push($this->ErrorMessage,'pass: Hook Arguments Must Be An Array!');
								}
							} else {
								$hold = $this->LayerModule->pass($databasetable, $function, $functionarguments);
								//$hold = $this->Client->pass($databasetable, $function, $functionarguments);
							}
							
							if ($hold) {
								return $hold;
							}
						} else if ($this->DatabaseDeny[$function] || $function = 'PROTECT') {
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