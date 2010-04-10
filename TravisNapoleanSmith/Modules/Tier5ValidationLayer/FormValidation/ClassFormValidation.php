<?php

class FormValidation extends Tier5ValidationLayerModulesAbstract implements Tier5ValidationLayerModules
{
	protected $TableNames = array();
	protected $LookupTable = array();
	public function __construct($tablenames, $databaseoptions) {
		$this->LayerModule = &$GLOBALS['Tier5Databases'];
		
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
		
		$this->LayerModule->setDatabaseAll ($hostname, $user, $password, $databasename);
		$this->LayerModule->setDatabasetable ($databasetable);
		
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
			$this->LayerModule->Connect(current($this->TableNames));
			if (current($this->TableNames) == 'HtmlTags') {
				$this->LayerModule->pass (current($this->TableNames), 'setEntireTable', array());
				$this->LookupTable[current($this->TableNames)] = $this->LayerModule->pass (current($this->TableNames), 'getEntireTable', array());
			} else {
				$this->LayerModule->pass (current($this->TableNames), 'setDatabaseRow', array('PageID' => $passarray));
				$this->LookupTable[current($this->TableNames)] = $this->LayerModule->pass (current($this->TableNames), 'getMultiRowField', array());
			}
			//$this->LayerModule->Disconnect(current($this->TableNames));
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
