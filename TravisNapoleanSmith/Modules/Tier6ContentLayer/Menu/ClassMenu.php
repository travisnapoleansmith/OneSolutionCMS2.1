<?php
require_once ("Modules/Tier6ContentLayer/Menu/ClassMenuItem.php"); 
require_once ("Modules/Tier6ContentLayer/Menu/ClassMenuItemList.php");
class Menu
{
	private $MenuDatabase;
	private $MenuLookup;
	//private $MenuLookup2;
	private $idnumber;
	private $MenuProtectionLayer;
	private $Menus;
	private $MenuItemList;
	private $MenuMaxDeep;
	private $MenuClass;
	private $MenuID;
	private $JavascriptFileName;
	private $HttpUserAgent;
	private $PageName;
	
	public function Menu($tablenames, $database) {
		$this->MenuProtectionLayer = &$database;
		$this->idnumber = current($tablenames);
		$this->MenuDatabase = next($tablenames);
		$this->MenuLookup = next($tablenames);
		//$this->MenuLookup2 = next($tablenames);
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
		$this->MenuProtectionLayer->setDatabaseAll ($hostname, $user, $password, $databasename, $databasetable);
		$this->MenuProtectionLayer->pass ($databasetable, 'setOrderByAll', array('idnumber' => 'idnumber', 'ASC' => 'ASC'));

	}
	
	public function setDatabaseLookup($hostname, $user, $password, $databasename, $databasetable) {
		$this->MenuProtectionLayer->setDatabaseAll ($hostname, $user, $password, $databasename, $databasetable);
		$this->MenuProtectionLayer->pass ($databasetable, 'setOrderByAll', array('idnumber' => 'idnumber', 'ASC' => 'ASC'));
	}
	/*
	public function setDatabaseLookup2($hostname, $user, $password, $databasename, $databasetable) {
		$this->MenuProtectionLayer->setDatabaseAll ($hostname, $user, $password, $databasename, $databasetable);
		//$passarray = array();
		//$passarray['idnumber'] = 'idnumber';
		//$passarray['ASC'] = 'ASC';
		print_r($databasetable);
		$this->MenuProtectionLayer->pass ($databasetable, 'setOrderByAll', array('idnumber' => 'idnumber', 'ASC' => 'ASC'));
		//$this->MenuProtectionLayer->setOrderByAll ('idnumber', 'ASC');
	}
	*/
	public function setDynamicDatabaseButtons($hostname, $user, $password, $databasename, $databasetable, $name) {
		$this->MenuProtectionLayer->setDatabaseAll ($hostname, $user, $password, $databasename, $name);
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
	/*
	public function FetchMenuLookup2() {
		$this->MenuProtectionLayer->Connect($this->MenuLookup2);
		$this->MenuProtectionLayer->pass ($this->MenuLookup2, 'setEntireTable', array());
		$this->MenuProtectionLayer->pass ($this->MenuLookup2, 'setDatabaseField', array('idnumber' => "$this->idnumber"));
		$this->MenuProtectionLayer->Disconnect($this->MenuLookup2);
	}
	*/
	public function setDatabaseAll($hostname, $user, $password, $databasename) {
		$this->setDatabaseData($hostname, $user, $password, $databasename, $this->MenuDatabase);
		$this->setDatabaseLookup($hostname, $user, $password, $databasename, $this->MenuLookup);
		//$this->setDatabaseLookup2($hostname, $user, $password, $databasename, $this->MenuLookup2);
	}
	
	public function FetchAll() {
		$this->MenuProtectionLayer->Connect($this->MenuDatabase);
		$this->MenuProtectionLayer->pass ($this->MenuDatabase, 'setEntireTable', array());
		$this->MenuProtectionLayer->pass ($this->MenuDatabase, 'setDatabaseField', array('idnumber' => "$this->idnumber"));
		$this->MenuProtectionLayer->Disconnect($this->MenuDatabase);
		
		$this->MenuProtectionLayer->Connect($this->MenuLookup);
		$this->MenuProtectionLayer->pass ($this->MenuLookup, 'setEntireTable', array());
		$this->MenuProtectionLayer->pass ($this->MenuLookup, 'setDatabaseField', array('idnumber' => "$this->idnumber"));
		$this->MenuProtectionLayer->Disconnect($this->MenuLookup);
	}
	
	public function DynamicFetchAll($name) {
		$this->MenuProtectionLayer->Connect($name);
		$this->MenuProtectionLayer->pass ($name, 'setEntireTable', array());
		$this->MenuProtectionLayer->Disconnect($name);
	}

	public function getTable($idnumber, $rowcolumn){
		$hold = $this->MenuProtectionLayer->pass ($this->MenuDatabase, 'getTable', array('idnumber' => $idnumber, 'rowcolumn' => $rowcolumn));
		print "$hold\n";
		//return $this->MenuProtectionLayer->pass ($this->MenuDatabase, 'getTable', array('idnumber' => $idnumber, 'rowcolumn' => $rowcolumn));
		//return $this->MenuDatabase->getTable($idnumber, $rowcolumn);
	}
	
	public function getTableLookup($idnumber, $rowcolumn){
		return $this->MenuProtectionLayer->pass($this->MenuLookup, 'getTable', array('idnumber' => "$idnumber", 'rowcolumn' => "$rowcolumn"));
		//return $this->MenuLookup->getTable($idnumber, $rowcolumn);
	}
	/*
	public function getTableLookup2($idnumber, $rowcolumn){
		return $this->MenuProtectionLayer->pass($this->MenuLookup2, 'getTable', array('idnumber' => "$idnumber", 'rowcolumn' => "$rowcolumn"));
		//return $this->MenuLookup2->getTable($idnumber, $rowcolumn);
	}
	*/
	public function getDynamicTable($idnumber, $rowcolumn, $name){
		return $this->MenuProtectionLayer->pass($this->$name, 'getTable', array('idnumber' => "$idnumber", 'rowcolumn' => "$rowcolumn"));
		//return $this->$name->getTable($idnumber, $rowcolumn);
	}
	
	public function walkTable() {
		$this->MenuProtectionLayer->pass ($this->MenuDatabase, 'walktable', array());
		//$this->MenuDatabase->walktable();
	}
	
	public function walkFieldName() {
		$this->MenuProtectionLayer->pass ($this->MenuDatabase, 'walkfieldname', array());
		//$this->MenuDatabase->walkfieldname();
	}
	/*
	public function walkLookup2() {
		$this->MenuProtectionLayer->pass ($this->MenuLookup2, 'walktable', array());
		//$this->MenuLookup2->walktable();
	}
	*/

	public function getFieldName($rownumber) {
		return $this->MenuProtectionLayer->pass ($this->MenuDatabase, 'getRowFieldName', array('rownumber' => "$rownumber"));
		//return $this->MenuDatabase->getRowFieldName($rownumber);
	}
	
	public function walkDynamicTable($name) {
		$this->MenuProtectionLayer->pass ($this->$name, 'walktable', array());
		//$this->$name->walktable();
	}

	private function fillIdMenuItems ($idnumber2, $idnumber) {
		$idnumber = $this->getTable($idnumber, 'idnumber');
		$name = $this->getTable($idnumber, 'MenuItem0');
		$link = $this->getTable($idnumber, 'MenuItem0Link');
		$title = $this->getTable($idnumber, 'MenuItem0Title');
		$enable = $this->getTable($idnumber, 'Enable/Disable');
		$status = $this->getTable($idnumber, 'Status');
		print_r($name);
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
			$idnumber = $this->MenuProtectionLayer->pass ($this->$MenuName, 'getTable', array('idnumber' => "$idnumber2", 'temp' => "$temp"));
			$InsertInformation = NULL;
			
			$this->MenuItemList[$idnumber2]->setInsertInformation($InsertInformation, $temp);
			$this->fillIdMenuItems($idnumber2, $idnumber);
			$this->MenuItemList[$idnumber2]->createMenuItemsData($temp);
			$i++;
		}
		
		$temp = $this->getFieldName(0);
		$idnumber = $this->MenuProtectionLayer->pass ($this->$MenuName, 'getTable', array('idnumber' => "$idnumber2", 'temp' => "$temp"));
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
		print_r($this->MenuItemList[$idnumber]);
		$this->Menus .= $this->MenuItemList[$idnumber]->getMenuOutput();
	}
	
	public function getIdFieldNumber ($idnumber, $i) {
		$temp = $this->getFieldName($i);
		$idnumber = $this->MenuProtectionLayer->pass ($this->MenuDatabase, 'getTable', array('idnumber' => "$idnumber", 'temp' => "$temp"));
		//$idnumber = $this->MenuDatabase->getTable($idnumber, $temp);
		return $idnumber;
	}
	
	private function createInsertInformation ($idnumber, $InsertInformation, $MenuItemListKey) {
		$temp = $this->getFieldName($idnumber);
		$idnumber = $this->MenuDatabase->getTable($MenuItemListKey, $temp);
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
		$menurowcount = $this->MenuProtectionLayer->pass ($MenuNameDatabase, 'getRowCount', array());
		$this->MenuProtectionLayer->pass ($MenuNameDatabase, 'searchEntireTable', array('search' => "$search"));
		$menulookupkey = $this->MenuProtectionLayer->pass ($this->MenuLookup, 'getSearchResults', array('number' => '0', 'idnumber' => 'idnumber'));
		if ($search2){
			$this->MenuProtectionLayer->pass ($this->MenuDatabase, 'getSearchResults', array('search' => "$search2"));
			$menulookupkey = $this->MenuProtectionLayer->pass ($this->MenuDatabase, 'getSearchResults', array('number' => '0', 'idnumber' => 'idnumber'));
		}

		$i = 1;
		$idMenuItemName = 'idMenuItem' . $i;
		$j = $menurowcount;
		
		while ($i < 5){
			$menulookupkey2 = $this->getTable($menulookupkey, $idMenuItemName);
			$MenuItem0IdNumber = $this->MenuProtectionLayer->pass ($MenuNameDatabase, 'getTable', array('j' => "$j", 'idname' => "$idname"));
			$MenuItem0 = $this->MenuProtectionLayer->pass($MenuNameDatabase, 'getTable', array('j' => "$j", 'MenuItem' => 'MenuItem'));
			$MenuItem0Link = $output . '?' . $idname . '=' . $MenuItem0IdNumber;
			$MenuItem0Title = $this->MenuProtectionLayer->pass ($MenuNameDatabase, 'getTable', array('j' => "$j", 'idname' => 'BubbleHeadline'));
			$MenuItem0Year = $this->MenuProtectionLayer->pass ($MenuNameDatabase, 'getTable', array('j' => "$j", 'idname' => 'StoryYear'));
			$MenuItem0Month = $this->MenuProtectionLayer->pass ($MenuNameDatabase, 'getTable', array('j' => "$j", 'idname' => 'StoryMonth'));
			
			$this->updateMenuItem($menulookupkey2, 'MenuItem0', $MenuItem0);
			$this->updateMenuItem($menulookupkey2, 'MenuItem0Link', $MenuItem0Link);
			$this->updateMenuItem($menulookupkey2, 'MenuItem0Title', $MenuItem0Title);
			
			$i++;
			$idMenuItemName = 'idMenuItem' . $i;
			$j--;
		}
	}

	private function updateMenuItem($idnumber, $rowname, $information){
		$this->MenuProtectionLayer->pass ($this->MenuDatabase, 'updateEntireTableEntry', array('idnumber' => "$idnumber", 'rowname' => "$rowname", 'information' => "information"));
		//$this->MenuDatabase->updateEntireTableEntry($idnumber, $rowname, $information);
	}
	
	private function removeMenuItem($idnumber){
		$this->MenuProtectionLayer->pass ($this->MenuDatabase, 'removeEntireEntireTable', array('idnumber' => "$idnumber"));
		//$this->MenuProtectionLayer->pass ('MenuLookup2', 'removeEntireEntireTable', array('idnumber' => "$idnumber"));
		//$this->MenuProtectionLayer->pass ('MenuLookup2', 'reindexEntireTable', array());
		//$this->MenuDatabase->removeEntireEntireTable($idnumber);
		//$this->MenuLookup2->removeEntireEntireTable($idnumber);
		//$this->MenuLookup2->reindexEntireTable();
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
		$rowcount = $this->MenuProtectionLayer->pass ($this->MenuDatabase, 'getRowCount', array());
		while ($i <= $rowcount){
			$this->MenuItemList[$i]->createMenuItemListOutput(NULL);
			$i++;
		}
		
	}
	
	private function makeMenuSingle() {
		$rowcount = $this->MenuProtectionLayer->pass ($this->MenuDatabase, 'getRowCount', array());
		//$rowcount = $this->MenuDatabase->getRowCount();
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
			$idnumber = $this->MenuProtectionLayer->pass ($this->MenuLookup, 'getTable', array('i' => "$i", 'idnumber' => 'idnumber'));
			$status = $this->MenuProtectionLayer->pass ($this->MenuLookup, 'getTable', array('i' => "$i", 'idnumber' => 'Status'));
			if ($status == 'Approved') {
				$this->createMenuOutput($idnumber);
			}
			$i++;
		}
		$this->Menus .= "  </ul>\n";
		$this->Menus .= "</div>\n";
		print_r($this->Menus);
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
			
			$this->MenuProtectionLayer->pass ($this->MenuDatabase, 'searchEntireTable', array('PageName' => "$this->PageName"));
			$remove = $this->MenuProtectionLayer->pass ($this->MenuDatabase, 'getSearchResultsArray', array());
			$this->updateMenuItem($remove[0]['idnumber'], $remove[0]['keyname'], NULL);
		}
		
		$rowcount = $this->MenuProtectionLayer->pass ($this->MenuDatabase, 'getRowCount', array());
		$max = $this->MenuProtectionLayer->pass ($this->MenuLookup, 'getRowCount', array());
		
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