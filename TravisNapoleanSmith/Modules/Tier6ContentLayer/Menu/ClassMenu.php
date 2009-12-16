<?php
require_once ("Tier2-DataAccessLayer/ClassMySqlConnect.php"); 
require_once ("Modules/Tier6ContentLayer/Menu/ClassMenuItem.php"); 
require_once ("Modules/Tier6ContentLayer/Menu/ClassMenuItemList.php");
class Menu
{
	var $MenuDatabase;
	var $MenuLookup;
	var $MenuLookup2;
	var $idnumber;
	var $Menus;
	var $MenuItemList;
	var $MenuMaxDeep;
	var $MenuClass;
	var $MenuID;
	var $JavascriptFileName;
	var $HttpUserAgent;
	var $PageName;
	
	function Menu() {
		$this->MenuDatabase = new MySqlConnect;
		$this->MenuLookup = new MySqlConnect;
		$this->MenuLookup2 = new MySqlConnect;
		$this->MenuItemList = Array();
	}
	
	function setDynamicDatabase ($name){
		$this->$name = new MySqlConnect;
	}
	
	function setIdNumber($idnumber){
		$this->idnumber = $idnumber;
	}
	
	function getIdNumber(){
		return $this->idnumber;
	}
	
	function setDatabaseData($hostname, $user, $password, $databasename, $databasetable) {
		$this->MenuDatabase->setDatabaseAll ($hostname, $user, $password, $databasename, $databasetable);
		$this->MenuDatabase->setOrderByAll ('idnumber', 'ASC');
	}
	
	function setDatabaseLookup($hostname, $user, $password, $databasename, $databasetable) {
		$this->MenuLookup->setDatabaseAll ($hostname, $user, $password, $databasename, $databasetable);
		$this->MenuLookup->setOrderByAll ('idnumber', 'ASC');
	}
	
	function setDatabaseLookup2($hostname, $user, $password, $databasename, $databasetable) {
		$this->MenuLookup2->setDatabaseAll ($hostname, $user, $password, $databasename, $databasetable);
		$this->MenuLookup2->setOrderByAll ('idnumber', 'ASC');
	}
	
	function setDynamicDatabaseButtons($hostname, $user, $password, $databasename, $databasetable, $name) {
		$this->$name->setDatabaseAll ($hostname, $user, $password, $databasename, $databasetable);
	}
	
	function setMenuMaxDeep ($MenuMaxDeep) {
		$this->MenuMaxDeep = $MenuMaxDeep;
	}
	
	function getMenuMaxDeep (){
		return $this->MenuMaxDeep;
	}
	
	function setMenuClass ($MenuClass) {
		$this->MenuClass = $MenuClass;
	}
	
	function getMenuClass (){
		return $this->MenuClass;
	}
	
	function setMenuID ($MenuID) {
		$this->MenuID = $MenuID;
	}
	
	function getMenuID (){
		return $this->MenuID;
	}
	
	function setJavascriptFileName ($JavascriptFileName) {
		$this->JavascriptFileName = $JavascriptFileName;
	}
	
	function getJavascriptFileName (){
		return $this->JavascriptFileName;
	}
	
	function setHttpUserAgent ($HttpUserAgent) {
		$this->HttpUserAgent = $HttpUserAgent;
	}
	
	function getHttpUserAgent() {
		return $this->HttpUserAgent;
	}
	
	function setPageName ($PageName) {
		$this->PageName = $PageName;
	}
	
	function getPageName() {
		return $this->PageName;
	}
	
	function setMenuClassIDAll ($MenuID, $MenuClass) {
		$this->MenuID = $MenuID;
		$this->MenuClass = $MenuClass;
	}
	
	function FetchMenuLookup2() {
		$this->MenuLookup2->Connect();
		$this->MenuLookup2->setEntireTable();
		$this->MenuLookup2->setDatabaseField($this->idnumber);
		$this->MenuLookup2->Disconnect();
	}
	
	function FetchAll() {
		$this->MenuDatabase->Connect();
		$this->MenuDatabase->setEntireTable();
		$this->MenuDatabase->setDatabaseField($this->idnumber);
		$this->MenuDatabase->Disconnect();
		
		$this->MenuLookup->Connect();
		$this->MenuLookup->setEntireTable();
		$this->MenuLookup->setDatabaseField($this->idnumber);
		$this->MenuLookup->Disconnect();
	}
	
	function DynamicFetchAll($name) {
		$this->$name->Connect();
		$this->$name->setEntireTable();
		$this->$name->Disconnect();
	}
	
	function getTable($idnumber, $rowcolumn){
		return $this->MenuDatabase->getTable($idnumber, $rowcolumn);
	}
	
	function getTableLookup($idnumber, $rowcolumn){
		return $this->MenuLookup->getTable($idnumber, $rowcolumn);
	}
	
	function getTableLookup2($idnumber, $rowcolumn){
		return $this->MenuLookup2->getTable($idnumber, $rowcolumn);
	}
	
	function getDynamicTable($idnumber, $rowcolumn, $name){
		return $this->$name->getTable($idnumber, $rowcolumn);
	}
	
	function walkTable() {
		$this->MenuDatabase->walktable();
	}
	
	function walkFieldName() {
		$this->MenuDatabase->walkfieldname();
	}
	
	function walkLookup2() {
		$this->MenuLookup2->walktable();
	}
	
	function getFieldName($rownumber) {
		return $this->MenuDatabase->getRowFieldName($rownumber);
	}
	
	function walkDynamicTable($name) {
		$this->$name->walktable();
	}
	
	function fillIdMenuItems ($idnumber2, $idnumber) {
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
	
	function processIdMenuItems ($idnumber) {
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
	function createMenuItemListArray($idnumber, $j, $MenuName) {
		$this->processIdMenuItems ($idnumber);
		$this->MenuItemList[$idnumber]->buildMenuItems();
		
		$i = 5;
		$idnumber2 = $idnumber;
		
		while ($this->getTable($idnumber2, $this->getFieldName($i))) {
			$temp = $this->getFieldName($i);
			$idnumber = $this->$MenuName->getTable($idnumber2, $temp);
			$InsertInformation = NULL;
			
			$this->MenuItemList[$idnumber2]->setInsertInformation($InsertInformation, $temp);
			$this->fillIdMenuItems($idnumber2, $idnumber);
			$this->MenuItemList[$idnumber2]->createMenuItemsData($temp);
			$i++;
		}
		
		$temp = $this->getFieldName(0);
		$idnumber = $this->$MenuName->getTable($idnumber2, $temp);
		$this->fillIdMenuItems($idnumber2, $idnumber);
	}
	
	function createMenuItemListOutput ($idnumber) {
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
	
	function createRootFlag ($idnumber) {
		$this->MenuItemList[$idnumber]->setRoot(TRUE);
	}
	
	function walkMenuItemListArray() {
		print_r($this->MenuItemList);
	}
	
	function createMenuOutput ($idnumber) {
		$this->Menus .= $this->MenuItemList[$idnumber]->getMenuOutput();
	}
	
	function getIdFieldNumber ($idnumber, $i) {
		$temp = $this->getFieldName($i);
		$idnumber = $this->MenuDatabase->getTable($idnumber, $temp);
		return $idnumber;
	}
	
	function createInsertInformation ($idnumber, $InsertInformation, $MenuItemListKey) {
		$temp = $this->getFieldName($idnumber);
		$idnumber = $this->MenuDatabase->getTable($MenuItemListKey, $temp);
		$this->MenuItemList[$MenuItemListKey]->setInsertInformation($InsertInformation, $temp);
	}
	
	function buildInsertInformation ($i, $rowcount){
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
	
	function createDeepMenu ($idnumber, $startnumber, $stopnumber) {
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
	
	function removeMenuItems($MenuNameDatabase, $search, $search2, $removal, $output, $idname) {
		$menurowcount = $this->$MenuNameDatabase->getRowCount();
		$this->MenuLookup->searchEntireTable($search, NULL);
		$menulookupkey = $this->MenuLookup->getSearchResults(0, 'idnumber');
		if ($search2){
			$this->MenuDatabase->searchEntireTable($search2);
			$menulookupkey = $this->MenuDatabase->getSearchResults(0, 'idnumber');
		}
		//print "TESTING\n";
		//print "$menulookupkey3\n";
		//print "END TESTING\n";
		//var_dump($this->$MenuNameDatabase);
		$i = 1;
		$idMenuItemName = 'idMenuItem' . $i;
		$j = $menurowcount;

		while ($i < 5){
			$menulookupkey2 = $this->getTable($menulookupkey, $idMenuItemName);
			$MenuItem0IdNumber = $this->$MenuNameDatabase->getTable($j, $idname);
			$MenuItem0 = $this->$MenuNameDatabase->getTable($j, 'MenuItem');
			$MenuItem0Link = $output . '?' . $idname . '=' . $MenuItem0IdNumber;
			$MenuItem0Title = $this->$MenuNameDatabase->getTable($j, 'BubbleHeadline');
			$MenuItem0Year = $this->$MenuNameDatabase->getTable($j, 'StoryYear');
			$MenuItem0Month = $this->$MenuNameDatabase->getTable($j, 'StoryMonth');

			$this->updateMenuItem($menulookupkey2, 'MenuItem0', $MenuItem0);
			$this->updateMenuItem($menulookupkey2, 'MenuItem0Link', $MenuItem0Link);
			$this->updateMenuItem($menulookupkey2, 'MenuItem0Title', $MenuItem0Title);
			
			$i++;
			$idMenuItemName = 'idMenuItem' . $i;
			$j--;
		}
		//$i = 5;
		/*$idMenuItemName = 'idMenuItem' . $i;
		$menulookupkey2 = $this->getTable($menulookupkey, $idMenuItemName);
		$currentyear = date('Y');
		$yearhold = $this->FindYearMonth ($menulookupkey2, $currentyear, NULL, $idMenuItemName, $MenuNameDatabase);
		
		while ($yearhold) {
			// USE THIS FUNCTION TO APPEND MENU ITEM NAME
			//$this->AppendMenuItemListing ($yearhold, 'MenuDatabase', 'MenuItem0', ' ->');
			$this->ProcessMonth ($menulookupkey2, $yearhold, $currentyear, $idMenuItemName, $MenuNameDatabase, $output);
			$currentyear--;
			$yearhold = $this->FindYearMonth ($menulookupkey2, $currentyear, NULL, $idMenuItemName, $MenuNameDatabase);
			
		}*/
	}
	/*
	function FindYearMonth ($idnumber, $year, $month, $idMenuItemName, $MenuNameDatabase){
		if ($month){
			$this->$MenuNameDatabase->searchEntireTable($year, $month);
		} else {
			$this->$MenuNameDatabase->searchEntireTable($year);
		}
		$i = 0;
		$yearmonthhold = $this->$MenuNameDatabase-> getSearchResultsArray();
		return $yearmonthhold;
	}
	*/
	/*
	function ProcessMonth ($idnumber, $yearhold, $year, $idMenuItemName, $MenuNameDatabase, $output) {
		//$i = 0;
		$j = 0;
		$months = Array(
			'January', 
			'February', 
			'March', 
			'April', 
			'May', 
			'June', 
			'July', 
			'August', 
			'September', 
			'October', 
			'November', 
			'December'
			);
		while ($months[$j]) {
			$this->FindMonth ($idnumber, $months[$j], $year, $idMenuItemName, $yearhold, $MenuNameDatabase, $output);
			$j++;
		}
		$j = 0;
		//$i++;
	}
	*/
	/*
	function FindMonth ($idnumber, $month, $year, $idMenuItemName, $yearhold, $MenuNameDatabase, $output) {
		$monthhold = $this->FindYearMonth ($idnumber, $month, $year, $idMenuItemName, $MenuNameDatabase);
		if ($monthhold == NULL) {
			//$this->RemoveChildren($idnumber, $year, $month);
		} else {
			$idnumbers = $this->GetIdNumbers ($idnumber);
			$yearidnumber = $this->FindInDatabase($idnumbers, $year);
			
			if ($yearidnumber){
				$idnumbers = NULL;
				$idnumbers = $this->GetIdNumbers($yearidnumber);
				$monthidnumber = $this->FindInDatabase($idnumbers, $month);
				$idnumbers = NULL;
				$idnumbers = $this->GetIdNumbers($monthidnumber);
			}
			
			$this->UpdateMenuItemListing ($idnumbers, $year, $month, $yearhold, $MenuNameDatabase, $output);
		}
	}
	*/
	/*
	function FindInDatabase ($idnumbers, $find) {
		$j = 0;
		$idnumber = NULL;
		while ($idnumbers[$j]){
			$indatabase = $this->MenuDatabase->getTable($idnumbers[$j], 'MenuItem0');
			if ($indatabase == $find){
				$idnumber = $idnumbers[$j];
				break;
			}
			$j++;
		}
		
		if ($idnumber){
			return $idnumber;
		} else {
			return NULL;
		}
	}
	*/
	/*
	function GetIdNumbers ($idnumber) {
		$idnumbers = Array();
		$i = 1;
		$j = 0;
		$idMenuItem = 'idMenuItem' . $i;
		$menulookupkey = $this->MenuDatabase->getTable($idnumber, $idMenuItem);
		while ($menulookupkey){
			$idnumbers[$j] = $menulookupkey;
			$i++;
			$j++;
			$idMenuItem = 'idMenuItem' . $i;
			$menulookupkey = $this->MenuDatabase->getTable($idnumber, $idMenuItem);
		}
		
		return $idnumbers;
	}
	*/
	/*
	function AppendMenuItemListing ($idnumber, $MenuNameDatabase, $menuItem, $appendItem) {
		$MenuItemAppend = $this->$MenuNameDatabase->getTable($idnumber, $menuItem);
		$MenuItemAppend .= $appendItem;
		
		$this->updateMenuItem($idnumber, $menuItem, $MenuItemAppend);
	}
	*/
	/*
	function UpdateMenuItemListing ($idnumbers, $year, $month, $hold, $MenuNameDatabase, $output) {
		$i = 0;
		while ($idnumbers[$i]) {
			if ($this->$MenuNameDatabase->getTable($hold[$i]['idnumber'], 'StoryMonth') != $month) {
				unset($hold[$i]);
			}
			if ($hold[$i]) {
				$MenuItem0IdNumber = $hold[$i]['idnumber'];
				$MenuItem0 = $this->$MenuNameDatabase->getTable($MenuItem0IdNumber, 'MenuItem');
				
				$MenuItem0Link = $output . '?' . $idname . '=' . $MenuItem0IdNumber;
				$MenuItem0Title = $this->$MenuNameDatabase->getTable($MenuItem0IdNumber, 'BubbleHeadline');
				$MenuItem0Year = $this->$MenuNameDatabase->getTable($MenuItem0IdNumber, 'StoryYear');
				$MenuItem0Month = $this->$MenuNameDatabase->getTable($MenuItem0IdNumber, 'StoryMonth');
				
				$this->updateMenuItem($idnumbers[$i], 'MenuItem0', $MenuItem0);
				$this->updateMenuItem($idnumbers[$i], 'MenuItem0Link', $MenuItem0Link);
				$this->updateMenuItem($idnumbers[$i], 'MenuItem0Title', $MenuItem0Title);
				
			} else {
				//print "TESTING\n";
				//print "$idnumbers[$i]\n";
				//print "END TESTINGS\n";
				//$hold = $idnumbers[$i];
				$this->removeMenuItem($idnumbers[$i]);
			}
			$i++;
		}
		//print "---------------------------------\n";
		//var_dump($this->MenuDatabase);		
		//$this->walkLookup2();
	}
	*/
	/*
	function RemoveChildren($idnumber, $year, $month){
		$i = 1;
		$idMenuItem = 'idMenuItem' . $i;
		$hold = $this->MenuDatabase->getTable($idnumber, $idMenuItem);
		
		while ($hold) {
			$hold2 = $this->MenuDatabase->getTable($hold, 'MenuItem0');
			if ($hold2 == $year) { 
				$j = 1;
				$idMenuItem2 = 'idMenuItem' . $j;
				$holdid = $this->MenuDatabase->getTable($hold, $idMenuItem2);
				$holdcolumn = $this->MenuDatabase->getTable($holdid, 'MenuItem0');
				
				while ($holdcolumn != $month){
					$j++;
					$idMenuItem2 = 'idMenuItem' . $j;
					$holdid = $this->MenuDatabase->getTable($hold, $idMenuItem2);
					$holdcolumn = $this->MenuDatabase->getTable($holdid, 'MenuItem0');
				}
				
				$j = 1;
				$idMenuItem2 = 'idMenuItem' . $j;
				$holdid2 = $this->MenuDatabase->getTable($holdid, $idMenuItem2);
				while ($holdid2) {
					$this->removeMenuItem($holdid2);
					$j++;
					$idMenuItem2 = 'idMenuItem' . $j;
					$holdid2 = $this->MenuDatabase->getTable($holdid, $idMenuItem2);
				}
				$this->removeMenuItem($holdid);
				
			}
			$i++;
			$idMenuItem = 'idMenuItem' . $i;
			$hold = $this->MenuDatabase->getTable($idnumber, $idMenuItem);
		}
	}
	*/
	function updateMenuItem($idnumber, $rowname, $information){
		$this->MenuDatabase->updateEntireTableEntry($idnumber, $rowname, $information);
	}
	
	function removeMenuItem($idnumber){
		$this->MenuDatabase->removeEntireEntireTable($idnumber);
		$this->MenuLookup2->removeEntireEntireTable($idnumber);
		$this->MenuLookup2->reindexEntireTable();
	}
	
	function transverseMenu($k, $MenuName){
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
		$rowcount = $this->MenuDatabase->getRowCount();
		while ($i <= $rowcount){
			$this->MenuItemList[$i]->createMenuItemListOutput(NULL);
			$i++;
		}
		
	}
	
	function makeMenuSingle() {
		$rowcount = $this->MenuDatabase->getRowCount();
		$this->menuLoop($rowcount);
		
		//$this->buildInsertInformation (1, $rowcount);
		
		// Output of Menu
		$this->makeMenuOutput($rowcount);
	}
	
	function makeMenuOutput($max) {
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
			$idnumber = $this->MenuLookup->getTable($i, 'idnumber');
			$status = $this->MenuLookup->getTable($i, 'Status');
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
	
	function menuLoop ($rowcount, $j, $MenuName) {
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
	
	function makeMenuItem($j, $MenuName) {
		if ($this->PageName){
			$this->MenuDatabase->searchEntireTable($this->PageName, NULL);
			$remove = $this->MenuDatabase->getSearchResultsArray();
			$this->updateMenuItem($remove[0]['idnumber'], $remove[0]['keyname'], NULL);
		}
		
		$rowcount = $this->MenuDatabase->getRowCount();
		$max = $this->MenuLookup->getRowCount();
		
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
	
	function getMenu() {
		return $this->Menus;
	}
}

?>