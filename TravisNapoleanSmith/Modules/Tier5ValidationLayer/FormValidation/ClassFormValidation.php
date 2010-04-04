<?php

class FormValidation extends Tier5ValidationLayerModulesAbstract implements Tier5ValidationLayerModules
{
	protected $XhtmlFormValidationProtectionLayer;
	protected $TableNames = array();
	
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
		//print_r($this->TableNames);
		
		//print "\n";
		//print_r($this->DatabaseTable);
		//print_r($this->PageID);
		if (!$PageID) {
			$PageID = 2;
		}
		$this->PageID = $PageID;
		
		//print_r($PageID);
		$passarray = array();
		$passarray['PageID'] = $this->PageID;
		$this->XhtmlFormValidationProtectionLayer->Connect($this->DatabaseTable);
		$this->XhtmlFormValidationProtectionLayer->pass ($this->DatabaseTable, 'setDatabaseRow', array('PageID' => $passarray));
		$temp =$this->XhtmlFormValidationProtectionLayer->pass ($this->DatabaseTable, 'getMultiRowField', array());
		//$this->XhtmlFormValidationProtectionLayer->Disconnect($this->DatabaseTable);
		
		//print_r($temp);
	}
	
	public function CreateOutput($space){ 
	
	}
	
	public function Verify($function, $functionarguments){
		return TRUE;
	}
	
	public function getOutput() {
	
	}
	
	public function getTableNames() {
		return $this->TableNames;
	}
}


?>
