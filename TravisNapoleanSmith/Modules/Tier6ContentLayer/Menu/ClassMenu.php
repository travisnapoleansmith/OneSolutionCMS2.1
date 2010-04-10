<?php

class Menu
{
	private $MenuDatabase;
	private $MenuLookup;
	private $idnumber;
	private $Menus;
	private $MenuItemList;
	private $MenuMaxDeep;
	private $MenuClass;
	private $MenuID;
	private $JavascriptFileName;
	private $HttpUserAgent;
	private $PageName;
	
	public function __construct($tablenames, $databaseoptions) {
		$this->LayerModule = &$GLOBALS['Tier6Databases'];
		$this->idnumber = current($tablenames);
		$this->MenuDatabase = next($tablenames);
		$this->MenuLookup = next($tablenames);
		$this->MenuItemList = Array();
	}
	
	public function setDynamicDatabase ($name){
		$this->$name = $name;
	}
	
	public function setIdNumber($idnumber){
		$this->idnumber = $idnumber;
	}
	
	public function getIdNumber(){
		return $this->idnumber;
	}
	
	public function setDatabaseData($hostname, $user, $password, $databasename, $databasetable) {
		$this->LayerModule->setDatabaseAll ($hostname, $user, $password, $databasename, $databasetable);
		$this->LayerModule->pass ($databasetable, 'setOrderByAll', array('idnumber' => 'idnumber', 'ASC' => 'ASC'));

	}
	
	public function setDatabaseLookup($hostname, $user, $password, $databasename, $databasetable) {
		$this->LayerModule->setDatabaseAll ($hostname, $user, $password, $databasename, $databasetable);
		$this->LayerModule->pass ($databasetable, 'setOrderByAll', array('idnumber' => 'idnumber', 'ASC' => 'ASC'));
	}

	public function setDynamicDatabaseButtons($hostname, $user, $password, $databasename, $databasetable, $name) {
		$this->LayerModule->setDatabaseAll ($hostname, $user, $password, $databasename, $name);
	}
	
	public function setMenuMaxDeep ($MenuMaxDeep) {
		$this->MenuMaxDeep = $MenuMaxDeep;
	}
	
	public function getMenuMaxDeep (){
		return $this->MenuMaxDeep;
	}
	
	public function setMenuClass ($MenuClass) {
		$this->MenuClass = $MenuClass;
	}
	
	public function getMenuClass (){
		return $this->MenuClass;
	}
	
	public function setMenuID ($MenuID) {
		$this->MenuID = $MenuID;
	}
	
	public function getMenuID (){
		return $this->MenuID;
	}
	
	public function setJavascriptFileName ($JavascriptFileName) {
		$this->JavascriptFileName = $JavascriptFileName;
	}
	
	public function getJavascriptFileName (){
		return $this->JavascriptFileName;
	}
	
	public function setHttpUserAgent ($HttpUserAgent) {
		$this->HttpUserAgent = $HttpUserAgent;
	}
	
	public function getHttpUserAgent() {
		return $this->HttpUserAgent;
	}
	
	public function setPageName ($PageName) {
		$this->PageName = $PageName;
	}
	
	public function getPageName() {
		return $this->PageName;
	}
	
	public function setMenuClassIDAll ($MenuID, $MenuClass) {
		$this->MenuID = $MenuID;
		$this->MenuClass = $MenuClass;
	}

	public function setDatabaseAll($hostname, $user, $password, $databasename) {
		$this->setDatabaseData($hostname, $user, $password, $databasename, $this->MenuDatabase);
		$this->setDatabaseLookup($hostname, $user, $password, $databasename, $this->MenuLookup);
	}
	
	public function FetchAll() {
		$passarray = array();
		$passarray['idnumber'] = $this->idnumber;
		$this->LayerModule->Connect($this->MenuDatabase);
		$this->LayerModule->pass ($this->MenuDatabase, 'setEntireTable', array());
		$this->LayerModule->pass ($this->MenuDatabase, 'setDatabaseField', array('idnumber' => $passarray));
		$this->LayerModule->Disconnect($this->MenuDatabase);
		
		$this->LayerModule->Connect($this->MenuLookup);
		$this->LayerModule->pass ($this->MenuLookup, 'setEntireTable', array());
		$this->LayerModule->pass ($this->MenuLookup, 'setDatabaseField', array('idnumber' => $passarray));
		$this->LayerModule->Disconnect($this->MenuLookup);
	}
	
	public function DynamicFetchAll($name) {
		$this->LayerModule->Connect($name);
		$this->LayerModule->pass ($name, 'setEntireTable', array());
		$this->LayerModule->Disconnect($name);
	}

	public function getTable($idnumber, $rowcolumn){
		return $this->LayerModule->pass ($this->MenuDatabase, 'getTable', array('idnumber' => $idnumber, 'rowcolumn' => $rowcolumn));
	}
	
	public function getTableLookup($idnumber, $rowcolumn){
		return $this->LayerModule->pass($this->MenuLookup, 'getTable', array('idnumber' => $idnumber, 'rowcolumn' => $rowcolumn));
	}

	public function getDynamicTable($idnumber, $rowcolumn, $name){
		return $this->LayerModule->pass($this->$name, 'getTable', array('idnumber' => $idnumber, 'rowcolumn' => $rowcolumn));
	}
	
	public function walkTable() {
		$this->LayerModule->pass ($this->MenuDatabase, 'walktable', array());
	}
	
	public function walkFieldName() {
		$this->LayerModule->pass ($this->MenuDatabase, 'walkfieldname', array());
	}

	public function getFieldName($rownumber) {
		return $this->LayerModule->pass ($this->MenuDatabase, 'getRowFieldName', array('rownumber' => $rownumber));
	}
	
	public function walkDynamicTable($name) {
		$this->LayerModule->pass ($this->$name, 'walktable', array());
	}

	private function fillIdMenuItems ($idnumber2, $idnumber) {
		$idnumber = $this->getTable($idnumber, 'idnumber');
		$name = $this->getTable($idnumber, 'MenuItem0');
		$link = $this->getTable($idnumber, 'MenuItem0Link');
		$title = $this->getTable($idnumber, 'MenuItem0Title');
		$enable = $this->getTable($idnumber, 'Enable/Disable');
		$status = $this->getTable($idnumber, 'Status');
		$this->MenuItemList[$idnumber2]->setAllBase($idnumber, $name, $link, $title, $enable, $status);
		
		$LiIdClass = $this->getTable($idnumber, 'LiIdClass');
		$LiStyle = $this->getTable($idnumber, 'LiStyle');
		$LiClass = $this->getTable($idnumber, 'LiClass');
		$AStyle = $this->getTable($idnumber, 'AStyle');
		$AClass = $this->getTable($idnumber, 'AClass');
		
		$this->MenuItemList[$idnumber2]->setAllClassStyle($LiIdClass, $LiStyle, $LiClass, $AStyle, $AClass);
	}
	
	private function processIdMenuItems ($idnumber) {
		$i = 5;
		$columnname = $this->getFieldName($i);
		$fieldinfo = $this->getTable($idnumber, $columnname);
		$this->MenuItemList[$idnumber] = new MenuItemList;
		while ($fieldinfo) {
			$this->MenuItemList[$idnumber]->setidMenuItems($columnname, $i);
			$i++;
			$columnname = $this->getFieldName($i);
			$fieldinfo = $this->getTable($idnumber, $columnname);
			
		}
	}
	private function createMenuItemListArray($idnumber, $j, $MenuName) {
		$this->processIdMenuItems ($idnumber);
		$this->MenuItemList[$idnumber]->buildMenuItems();
		
		$i = 5;
		$idnumber2 = $idnumber;
		
		while ($this->getTable($idnumber2, $this->getFieldName($i))) {
			$temp = $this->getFieldName($i);
			$idnumber = $this->LayerModule->pass ($this->$MenuName, 'getTable', array('idnumber' => $idnumber2, 'temp' => $temp));
			$InsertInformation = NULL;
			
			$this->MenuItemList[$idnumber2]->setInsertInformation($InsertInformation, $temp);
			$this->fillIdMenuItems($idnumber2, $idnumber);
			$this->MenuItemList[$idnumber2]->createMenuItemsData($temp);
			$i++;
		}
		
		$temp = $this->getFieldName(0);
		$idnumber = $this->LayerModule->pass ($this->$MenuName, 'getTable', array('idnumber' => $idnumber2, 'temp' => $temp));
		$this->fillIdMenuItems($idnumber2, $idnumber);
	}
	
	private function createMenuItemListOutput ($idnumber) {
		$UlClass = $this->getTable($idnumber, 'UlClass');
		$UlStyle = $this->getTable($idnumber, 'UlStyle');
		$UlIdClass = $this->getTable($idnumber, 'UlIdClass');
		$space = NULL;
		if ($this->getTableLookup($idnumber, 'idnumber')) {
			$idnumber2= $this->getTableLookup($idnumber, 'idnumber');
			$this->createRootFlag($idnumber2);
		}
		$this->MenuItemList[$idnumber]->setAllUl($UlIdClass, $UlClass, $UlStyle);
		$this->MenuItemList[$idnumber]->createMenuItemListOutput($space);
	}
	
	private function createRootFlag ($idnumber) {
		$this->MenuItemList[$idnumber]->setRoot(TRUE);
	}
	
	public function walkMenuItemListArray() {
		print_r($this->MenuItemList);
	}
	
	private function createMenuOutput ($idnumber) {
		$this->Menus .= $this->MenuItemList[$idnumber]->getMenuOutput();
	}
	
	public function getIdFieldNumber ($idnumber, $i) {
		$temp = $this->getFieldName($i);
		$idnumber = $this->LayerModule->pass ($this->MenuDatabase, 'getTable', array('idnumber' => $idnumber, 'temp' => $temp));
		return $idnumber;
	}
	
	private function createInsertInformation ($idnumber, $InsertInformation, $MenuItemListKey) {
		$temp = $this->getFieldName($idnumber);
		$idnumber = $this->LayerModule->pass ($this->MenuDatabase, 'getTable', array('idnumber' => $MenuItemListKey, 'temp' => $temp));
		$this->MenuItemList[$MenuItemListKey]->setInsertInformation($InsertInformation, $temp);
	}
	
	private function buildInsertInformation ($i, $rowcount){
		while ($i <= $rowcount) { 
			$j = 5;
			$fieldrow = $this->getIdFieldNumber ($i, $j);

			if ($fieldrow){
				$hold = $this->MenuItemList[$fieldrow]->getMenuOutput();
				while ($fieldrow) {
					$fieldoutput =  $this->MenuItemList[$fieldrow]->getMenuOutput();
					if ($fieldoutput){
						$this->createInsertInformation($j, $fieldoutput, $i);
					}
					
					$j++;
					$fieldrow = $this->getIdFieldNumber ($i, $j);
				}
			}
			$i++;
		}
	}
	
	private function createDeepMenu ($idnumber, $startnumber, $stopnumber) {
		$fieldrow1 = $this->getIdFieldNumber ($idnumber, $startnumber);
		$fieldrow2 = $this->getIdFieldNumber ($idnumber, $stopnumber); 
		while ($fieldrow2) {
			if ($this->getIdFieldNumber($idnumber, $stopnumber)) {
				$fieldrow2 = $this->getIdFieldNumber ($idnumber, $stopnumber);
				$stopnumber++;
			} else {
				$fieldrow2 = $this->getIdFieldnumber ($idnumber, $stopnumber);
			}
		}
		
		$this->buildInsertInformation ($fieldrow1, $fieldrow2);
		$this->MenuItemList[$fieldrow1]->createMenuItemListOutput('  ');
		$output = $this->MenuItemList[$fieldrow1]->getMenuOutput();
		return $fieldrow1;
	}
	
	public function removeMenuItems($MenuNameDatabase, $search, $search2, $removal, $output, $idname) {
		$menurowcount = $this->LayerModule->pass ($MenuNameDatabase, 'getRowCount', array());
		$this->LayerModule->pass ($this->MenuLookup, 'searchEntireTable', array('search' => $search));
		$menulookupkey = $this->LayerModule->pass ($this->MenuLookup, 'getSearchResults', array('number' => '0', 'idnumber' => 'idnumber'));
		if ($search2){
			$this->LayerModule->pass ($this->MenuDatabase, 'getSearchResults', array('search' => "$search2"));
			$menulookupkey = $this->LayerModule->pass ($this->MenuDatabase, 'getSearchResults', array('number' => '0', 'idnumber' => 'idnumber'));
		}

		$i = 1;
		$idMenuItemName = 'idMenuItem' . $i;
		$j = $menurowcount;
		
		while ($i < 5){
			$menulookupkey2 = $this->getTable($menulookupkey, $idMenuItemName);
			$MenuItem0IdNumber = $this->LayerModule->pass ($MenuNameDatabase, 'getTable', array('j' => "$j", 'idname' => $idname));
			$MenuItem0 = $this->LayerModule->pass($MenuNameDatabase, 'getTable', array('j' => "$j", 'MenuItem' => 'MenuItem'));
			$MenuItem0Link = $output . '?' . $idname . '=' . $MenuItem0IdNumber;
			$MenuItem0Title = $this->LayerModule->pass ($MenuNameDatabase, 'getTable', array('j' => "$j", 'idname' => 'BubbleHeadline'));
			$MenuItem0Year = $this->LayerModule->pass ($MenuNameDatabase, 'getTable', array('j' => "$j", 'idname' => 'StoryYear'));
			$MenuItem0Month = $this->LayerModule->pass ($MenuNameDatabase, 'getTable', array('j' => "$j", 'idname' => 'StoryMonth'));
			$this->updateMenuItem($menulookupkey2, 'MenuItem0', $MenuItem0);
			$this->updateMenuItem($menulookupkey2, 'MenuItem0Link', $MenuItem0Link);
			$this->updateMenuItem($menulookupkey2, 'MenuItem0Title', $MenuItem0Title);
			
			$i++;
			$idMenuItemName = 'idMenuItem' . $i;
			$j--;
		}
	}

	private function updateMenuItem($idnumber, $rowname, $information){
		$this->LayerModule->pass ($this->MenuDatabase, 'updateEntireTableEntry', array('idnumber' => $idnumber, 'rowname' => $rowname, 'information' => $information));
	}
	
	private function removeMenuItem($idnumber){
		$this->LayerModule->pass ($this->MenuDatabase, 'removeEntireEntireTable', array('idnumber' => $idnumber));
	}
	
	private function transverseMenu($k, $MenuName){
		$i = $k;
		while ($this->getTable($i, 'idnumber')) {
			$j = 1;
			$tempholder = 'idMenuItem';
			$tempholder .= "$j";
			while ($this->getTable($i, $tempholder)) {
				
				$this->buildInsertInformation($j, $i+$j);
				$this->MenuItemList[$j]->createMenuItemListOutput(NULL);
				$j++;
				$tempholder = 'idMenuItem';
				$tempholder .= "$j";
			}
			$this->buildInsertInformation ($i, $i+$j);
			$this->MenuItemList[$i]->createMenuItemListOutput(NULL);
			$i++;
		}
		$i = 1;
		$rowcount = $this->LayerModule->pass ($this->MenuDatabase, 'getRowCount', array());
		while ($i <= $rowcount){
			$this->MenuItemList[$i]->createMenuItemListOutput(NULL);
			$i++;
		}
		
	}
	
	private function makeMenuSingle() {
		$rowcount = $this->LayerModule->pass ($this->MenuDatabase, 'getRowCount', array());
		$this->menuLoop($rowcount);
		
		// Output of Menu
		$this->makeMenuOutput($rowcount);
	}
	
	public function makeMenuOutput($max) {
		$i = 1;
		if ($this->MenuID) {
			$this->Menus .= "<div id=\"";
			$this->Menus .= $this->MenuID;
			$this->Menus .= "\">\n";
		} else {
			$this->Menus .= "<div>\n";
		}
		
		if ($this->MenuClass) {
			$this->Menus .= "  <ul id=\"Main-Menu\" class=\"";
			$this->Menus .= $this->MenuClass;
			$this->Menus .= "\">\n";
		} else {
			$this->Menus .= "  <ul>\n";
		}
		
		while ($i <= $max) {
			$idnumber = $this->LayerModule->pass ($this->MenuLookup, 'getTable', array('i' => "$i", 'idnumber' => 'idnumber'));
			$status = $this->LayerModule->pass ($this->MenuLookup, 'getTable', array('i' => "$i", 'idnumber' => 'Status'));
			if ($status == 'Approved') {
				$this->createMenuOutput($idnumber);
			}
			$i++;
		}
		$this->Menus .= "  </ul>\n";
		$this->Menus .= "</div>\n";

		// IF IE6 is detected then use Javascript
		if (strstr($this->HttpUserAgent, 'MSIE 6.0')) {
			if ($this->JavascriptFileName) {
				$this->Menus .= "<script type=\"text/javascript\" src=\"";
				$this->Menus .= $this->JavascriptFileName;
				$this->Menus .= "\">\n</script>\n";
			}
		}
		
	}
	
	private function menuLoop ($rowcount, $j, $MenuName) {
		$i = 1;
		while ($i <= $rowcount) {
			$this->createMenuItemListArray($i, $j, $MenuName);
			$this->MenuItemList[$i]->removeUnusedMenuItems();
			
			$i++;
		}
		$i = 1;
		while ($i <= $rowcount) {
			$this->createMenuItemListOutput($i);
			$i++;
		}
	}
	
	public function makeMenuItem($j, $MenuName) {
		if ($this->PageName){
			$this->LayerModule->pass ($this->MenuDatabase, 'searchEntireTable', array('PageName' => $this->PageName));
			$remove = $this->LayerModule->pass ($this->MenuDatabase, 'getSearchResultsArray', array());
			$this->updateMenuItem($remove[0]['idnumber'], $remove[0]['keyname'], NULL);
		}
		
		$rowcount = $this->LayerModule->pass ($this->MenuDatabase, 'getRowCount', array());
		$max = $this->LayerModule->pass ($this->MenuLookup, 'getRowCount', array());
		
		$this->menuLoop($rowcount, $j, $MenuName);
		
		$this->buildInsertInformation (1, $rowcount);
		
		$i = $j;
		while ($i <= $this->MenuMaxDeep) {
			$this->transverseMenu($j, $MenuName);
			$i++;
		}
		
		// Output of Menu
		$this->makeMenuOutput($max);
	}
	
	public function getMenu() {
		return $this->Menus;
	}
}

?>