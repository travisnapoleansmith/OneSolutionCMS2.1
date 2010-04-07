<?php

class FormValidation extends Tier5ValidationLayerModulesAbstract implements Tier5ValidationLayerModules
{
	protected $XhtmlFormValidationProtectionLayer;
	
	protected $TableNames = array();
	protected $LookupTable = array();
	public function __construct($tablenames, $database) {
		$this->XhtmlFormValidationProtectionLayer = &$database;
		
		while (current($tablenames)) {
			$this->TableNames[key($tablenames)] = current($tablenames);
			next($tablenames);
		}
	}
	
	public function setDatabaseAll ($hostname, $user, $password, $databasename, $databasetable) {
		$this->Hostname = $hostname;
		$this->User = $user;
		$this->Password = $password;
		$this->DatabaseName = $databasename;
		$this->DatabaseTable = $databasetable;
		
		$this->XhtmlFormValidationProtectionLayer->setDatabaseAll ($hostname, $user, $password, $databasename);
		$this->XhtmlFormValidationProtectionLayer->setDatabasetable ($databasetable);
		
	}
	
	public function FetchDatabase ($PageID) {
		if (!$PageID) {
			$PageID = 2;
		}
		$this->PageID = $PageID;
		
		$passarray = array();
		$passarray['PageID'] = $this->PageID;
		
		reset($this->TableNames);
		while (current($this->TableNames)) {
			$this->XhtmlFormValidationProtectionLayer->Connect(current($this->TableNames));
			if (current($this->TableNames) == 'HtmlTags') {
				$this->XhtmlFormValidationProtectionLayer->pass (current($this->TableNames), 'setEntireTable', array());
				$this->LookupTable[current($this->TableNames)] = $this->XhtmlFormValidationProtectionLayer->pass (current($this->TableNames), 'getEntireTable', array());
			} else {
				$this->XhtmlFormValidationProtectionLayer->pass (current($this->TableNames), 'setDatabaseRow', array('PageID' => $passarray));
				$this->LookupTable[current($this->TableNames)] = $this->XhtmlFormValidationProtectionLayer->pass (current($this->TableNames), 'getMultiRowField', array());
			}
			//$this->XhtmlFormValidationProtectionLayer->Disconnect(current($this->TableNames));
			next ($this->TableNames);
		}
		//print_r($this->LookupTable);
	}
	
	/*public function CreateOutput($space){ 
	
	}
	*/
	public function Verify($function, $functionarguments){
		if ($function == 'FORM') {
			
		} else {
			return TRUE;
		}
	}
	/*
	public function getOutput() {
		
	}
	*/
	public function getTableNames() {
		return $this->TableNames;
	}
}


?>
