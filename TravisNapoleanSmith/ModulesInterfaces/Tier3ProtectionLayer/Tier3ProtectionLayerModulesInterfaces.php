<?php
interface Tier3ProtectionLayerModules
{
	public function setDatabaseAll ($hostname, $user, $password, $databasename, $databasetable);
	public function FetchDatabase ($idnumber);
	public function CreateOutput($space);
	public function getOutput();
	
	public function Verify($function, $functionarguments);
}
?>