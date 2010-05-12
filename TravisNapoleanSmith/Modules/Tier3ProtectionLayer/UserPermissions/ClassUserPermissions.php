<?php

class UserPermissions extends Tier3ProtectionLayerModulesAbstract implements Tier3ProtectionLayerModules
{
	
	public function __construct($tablenames, $databaseoptions) {
		$this->LayerModule =&$GLOBALS['Tier3Databases'];
		
		$hold = current($tablenames);
		$GLOBALS['ErrorMessage']['UserPermissions'][$hold] = NULL;
		$this->ErrorMessage = &$GLOBALS['ErrorMessage']['UserPermissions'][$hold];
		$this->ErrorMessage = array();
		
	}
	
	public function setDatabaseAll ($hostname, $user, $password, $databasename, $databasetable) {
	
	}
	
	public function FetchDatabase ($PageID) {
	
	}
	
	public function CreateOutput($space){ 
	
	}
	
	public function Verify($function, $functionarguments){
		return TRUE;
	}
	
	public function getOutput() {
	
	}
}


?>
