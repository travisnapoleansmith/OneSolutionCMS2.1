<?php

abstract class Tier2DataAccessLayerModulesAbstract extends LayerModulesAbstract
{
	protected $idnumber;
	protected $orderbyname;
	protected $orderbytype;
	protected $limit;
	protected $databasename;
	protected $user;
	protected $password;
	protected $databasetable;
	protected $hostname;
	protected $link;
	protected $rowquery;
	protected $rowresult;
	protected $rowfield;
	protected $multirowfield = array();
	protected $rowfieldnames;
	protected $tablenamequery;
	protected $tablenames;
	protected $tablequery;
	protected $tableresult;
	protected $rownumber;
	protected $entiretable;
	protected $entiretableresult;
	protected $database;
	protected $i;
	protected $idsearch;
	
	abstract protected function checkDatabaseName ();
	abstract protected function checkTableName ();
	abstract protected function checkPermissions ($permission);
	abstract protected function checkField ($field);
	abstract protected function BuildingEntireTable();
	
	public function setIdnumber ($IdNumber) {
		$this->idnumber = $IdNumber;
	}
	
	public function getIdnumber () {
		return $this->idnumber;
	}
	
	public function setOrderbyname ($OrderByName) {
		$this->orderbyname = $OrderByName;
	}
	
	public function getOrderbyname () {
		return $this->orderbyname;
	}
	
	public function setOrderbytype ($OrderByType) {
		$this->orderbytype = $OrderByType;
	}
	
	public function getOrderbytype () {
		return $this->orderbytype;
	}
	
	public function setLimit ($Limit) {
		$this->limit = $Limit;
	}
	
	public function getLimit () {
		return $this->limit;
	}
	
	public function setDatabasename ($DatabaseName){
		$this->databasename = $DatabaseName;
	}
	
	public function getDatabasename () {
		return $this->databasename;
	}
	
	public function setUser ($User){
		$this->user = $User;
	}
	
	public function getUser () {
		return $this->user;
	}
	
	public function setPassword ($Password){
		$this->password = $Password;
	}
	
	public function getPassword () {
		return $this->password;
	}
	
	public function setDatabasetable ($DatabaseTable){
		$this->databasetable = $DatabaseTable;
	}
	
	public function getDatabasetable () {
		return $this->databasetable;
	}
	
	public function setHostname ($HostName){
		$this->hostname = $HostName;
	}
	
	public function getHostname () {
		return $this->hostname;
	}
	
	public function setDatabaseAll ($hostname, $user, $password, $databasename, $databasetable) {
		$this->hostname = $hostname;
		$this->user = $user;
		$this->password = $password;
		$this->databasename = $databasename;
		$this->databasetable = $databasetable;
	}
	
	public function setOrderByAll ($orderbyname, $orderbytype) {
		$this->orderbyname = $orderbyname;
		$this->orderbytype = $orderbytype;
	}
	
	public function setDatabaseField ($IdNumber) {
		$this->idnumber = $IdNumber;
		$this->BuildDatabaseRows();
		$this->rowfieldnames = Array ();
		if (is_array($this->database)) {
			$this->rowfieldnames = array_keys($this->database);
		}
	}
	
	public function searchFieldNames($Search) {
		if (is_array($this->rowfieldnames)) {
			if (array_search($Search, $this->rowfieldnames)) {
				return TRUE;
			} else {
				return FALSE;
			}
		}
	}
	
	public function searchEntireTable($Search){
		$arguments = func_get_args();
		$search2 = $arguments[1];
		
		if ($this->idsearch) {
			unset ($this->idsearch);
		}
		
		if ($search2) {
			$this->i = 0;
			$j = 0;
			while ($this->i <= $this->rownumber) {
				if (in_array($Search, $this->entiretable[$this->i]) && in_array($search2, $this->entiretable[$this->i])){
					$this->idsearch[$j]["idnumber"] = $this->entiretable[$this->i]["idnumber"];
					$this->idsearch[$j]["keyname"] = array_search($Search, $this->entiretable[$this->i]);
					$j++;
				}
				$this->i++;
			}
		} else {
			$this->i = 0;
			$j = 0;
			while ($this->i <= $this->rownumber) {
				if (is_array($this->entiretable[$this->i])) {
					if (in_array($Search, $this->entiretable[$this->i])){
						$this->idsearch[$j]["idnumber"] = $this->entiretable[$this->i]["idnumber"];
						$this->idsearch[$j]["keyname"] = array_search($Search, $this->entiretable[$this->i]);
						$j++;
					}
				}
				$this->i++;
			}
		}
	}
	
	public function removeEntryEntireTable($rownumber, $rowcolumn){
		unset($this->entiretable[$rownumber][$rowcolumn]);
	}
	
	public function removeEntireEntireTable($rownumber) {
		unset($this->entiretable[$rownumber]);
	}
	
	public function reindexEntireTable(){
		$this->entiretable = array_merge($this->entiretable);
	}
	
	public function updateEntireTableEntry ($rownumber, $rowcolumn, $information) {
		$this->entiretable[$rownumber][$rowcolumn] = $information;
	}
	
	public function getRowCount (){
		return $this->rownumber;
	}
	
	public function getRowFieldName ($rownumber) {
		return $this->rowfieldnames[$rownumber];
	}
	
	public function getRowFieldNames() {
		return $this->rowfieldnames;
	}
	
	public function getDatabase ($rownumber) {
		return $this->database[$rownumber];
	}
	
	public function getRowField ($rownumber) {
		return $this->rowfield[$rownumber];
	}
	
	public function getEntireRow(){
		return $this->rowfield;
	}
	
	public function getMultiRowField() {
		return $this->multirowfield;
	}
	
	public function getTable ($rownumber, $rowcolumn) {
		return $this->entiretable[$rownumber][$rowcolumn];
	}
	
	public function getEntireTable () {
		return $this->entiretable;
	}
	
	public function getSearchResults($idnumber, $key) {
		return $this->idsearch[$idnumber][$key];
	}
	
	public function getSearchResultsArray() {
		return $this->idsearch;
	}
	
	public function getTableNames() {
		return $this->tablenames;
	}
	
	public function walkarray () {
		print_r($this->database);
	}
	
	public function walkfieldname () {
		print_r($this->rowfieldnames);
	}
	
	public function walktable () {
		print_r($this->entiretable);
	}
	
	public function walkidsearch () {
		print_r($this->idsearch);
	}
	
}
?>
