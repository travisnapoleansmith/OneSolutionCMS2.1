<?php
interface Tier2DataAccessLayerModules
{
	public function Connect ();
	public function Disconnect ();
	
	public function createDatabase();
	public function deleteDatabase ();
	
	public function createTable ($tablestring);
	public function updateTable ($tablestring);
	public function deleteTable ();
	
	public function createRow ($rowname, $rowvalue);
	public function updateRow ($rowname, $rowvalue, $rownumbername, $rownumber);
	public function deleteRow ($rowname, $rowvalue);
	
	public function createField ($fieldstring, $fieldflag, $fieldflagcolumn);
	public function updateField ($field, $fieldchange);
	public function deleteField ($field);
	
	public function setDatabaseRow ($idnumber);
	public function setEntireTable ();
	
	public function BuildDatabaseRows ();
	
}
?>