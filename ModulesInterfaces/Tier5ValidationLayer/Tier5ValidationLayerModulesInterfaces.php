<?php
interface Tier5ValidationLayerModules
{
	public function setDatabaseAll ($hostname, $user, $password, $databasename, $databasetable);
	public function FetchDatabase ($idnumber);
	
	public function Verify($function, $functionarguments);
}
?>