<?php
interface Tier6ContentLayerModules
{
	public function setDatabaseAll ($hostname, $user, $password, $databasename, $databasetable);
	public function setHttpUserAgent ($HttpUserAgent);
	public function FetchDatabase ($idnumber);
	public function CreateOutput($space);
}
?>