<?php

class Audit extends Tier3ProtectionLayerModulesAbstract implements Tier3ProtectionLayerModules
{
	
	public function __construct($tablenames, $databaseoptions, $layermodule) {
		$this->LayerModule = &$layermodule;
		
		$hold = current($tablenames);
		$GLOBALS['ErrorMessage']['Audit'][$hold] = NULL;
		$this->ErrorMessage = &$GLOBALS['ErrorMessage']['Audit'][$hold];
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