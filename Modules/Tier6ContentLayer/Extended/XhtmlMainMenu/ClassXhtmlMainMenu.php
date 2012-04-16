<?php

class XhtmlMainMenu extends Tier6ContentLayerModulesAbstract implements Tier6ContentLayerModules {	
	protected $TableNames = array();
	protected $MainMenuTables = array();
	
	protected $MainMenuLookupTableName;
	protected $MainMenuTableName;
	protected $MainMenuItemLookupTableName;
	
	protected $JavaScriptFileName;
	protected $JavaScriptLibraryName;
	
	protected $MainMenuID;
	protected $MainMenuClass;
	protected $MainMenuStyle;
	protected $MainMenuInsert;
	
	protected $MainMenuTopID;
	protected $MainMenuTopClass;
	protected $MainMenuTopStyle;
	protected $MainMenuTopInsert;
	
	protected $MainMenuBottomID;
	protected $MainMenuBottomClass;
	protected $MainMenuBottomStyle;
	protected $MainMenuBottomInsert;
	
	protected $Insert;
	
	protected $LookupPageID = array();
	protected $LookupObjectID = array();
	protected $LookupMenuItemName = array();
	protected $LookupEnableDisable = array();
	protected $LookupStatus = array();
	
	protected $EnableDisable = array();
	protected $Status = array();
	
	//protected $MainMenu;
	
	/**
	 * Create an instance of XtmlMainMenu
	 *
	 * @param array $TableNames an array of table names to connect to.
	 * @param array $DatabaseOptions an array of option from the database.
	 * @param object $LayerModule a copy of the current layer the module is in - Content Layer
	 * @access public
	*/
	public function __construct(array $TableNames, array $DatabaseOptions, $LayerModule) {
		$this->LayerModule = &$LayerModule;
		
		$hold = current($TableNames);
		$GLOBALS['ErrorMessage']['XhtmlMainMenu'][$hold] = NULL;
		$this->ErrorMessage = &$GLOBALS['ErrorMessage']['XhtmlMainMenu'][$hold];
		$this->ErrorMessage = array();
		
		if ($DatabaseOptions['JavaScriptFileName']) {
			$this->JavaScriptFileName = $DatabaseOptions['JavaScriptFileName'];
			unset($DatabaseOptions['JavaScriptFileName']);
		}
		
		if ($DatabaseOptions['JavaScriptLibraryName']) {
			$this->JavaScriptLibraryName = $DatabaseOptions['JavaScriptLibraryName'];
			unset($DatabaseOptions['JavaScriptLibraryName']);
		}
		
		if ($DatabaseOptions['MainMenuID']) {
			$this->MainMenuID = $DatabaseOptions['MainMenuID'];
			unset($DatabaseOptions['MainMenuID']);
		}
		
		if ($DatabaseOptions['MainMenuClass']) {
			$this->MainMenuClass = $DatabaseOptions['MainMenuClass'];
			unset($DatabaseOptions['MainMenuClass']);
		}
		
		if ($DatabaseOptions['MainMenuStyle']) {
			$this->MainMenuStyle = $DatabaseOptions['MainMenuStyle'];
			unset($DatabaseOptions['MainMenuStyle']);
		}
		
		if ($DatabaseOptions['MainMenuInsert']) {
			$this->MainMenuInsert = $DatabaseOptions['MainMenuInsert'];
			unset($DatabaseOptions['MainMenuInsert']);
		}
		
		if ($DatabaseOptions['MainMenuTopID']) {
			$this->MainMenuTopID = $DatabaseOptions['MainMenuTopID'];
			unset($DatabaseOptions['MainMenuTopID']);
		}
		
		if ($DatabaseOptions['MainMenuTopClass']) {
			$this->MainMenuTopClass = $DatabaseOptions['MainMenuTopClass'];
			unset($DatabaseOptions['MainMenuTopClass']);
		}
		
		if ($DatabaseOptions['MainMenuTopStyle']) {
			$this->MainMenuTopStyle = $DatabaseOptions['MainMenuTopStyle'];
			unset($DatabaseOptions['MainMenuTopStyle']);
		}
		
		if ($DatabaseOptions['MainMenuTopInsert']) {
			$this->MainMenuTopInsert = $DatabaseOptions['MainMenuTopInsert'];
			unset($DatabaseOptions['MainMenuTopInsert']);
		}
		
		if ($DatabaseOptions['MainMenuBottomID']) {
			$this->MainMenuBottomID = $DatabaseOptions['MainMenuBottomID'];
			unset($DatabaseOptions['MainMenuBottomID']);
		}
		
		if ($DatabaseOptions['MainMenuBottomClass']) {
			$this->MainMenuBottomClass = $DatabaseOptions['MainMenuBottomClass'];
			unset($DatabaseOptions['MainMenuBottomClass']);
		}
		
		if ($DatabaseOptions['MainMenuBottomStyle']) {
			$this->MainMenuBottomStyle = $DatabaseOptions['MainMenuBottomStyle'];
			unset($DatabaseOptions['MainMenuBottomStyle']);
		}
		
		if ($DatabaseOptions['MainMenuBottomInsert']) {
			$this->MainMenuBottomInsert = $DatabaseOptions['MainMenuBottomInsert'];
			unset($DatabaseOptions['MainMenuBottomInsert']);
		}
		
		if ($DatabaseOptions['Insert']) {
			$this->Insert = $DatabaseOptions['Insert'];
			unset($DatabaseOptions['Insert']);
		}
		
		if ($DatabaseOptions['FileName']) {
			$this->FileName = $DatabaseOptions['FileName'];
			unset($DatabaseOptions['FileName']);
		}
		
		if ($this->FileName) {
			$this->Writer = new XMLWriter();
			$this->Writer->openURI($this->FileName);
		} else {
			$this->Writer = &$GLOBALS['Writer'];
		}
		
		$this->MainMenuLookupTableName = $TableNames['DatabaseTable1'];
		$this->MainMenuTableName = $TablesNames['DatabaseTable2'];
		$this->MainMenuItemLookupTableName = $TableNames['DatabaseTable3'];
		unset($TableNames['DatabaseTable3']);
		
		while (current($TableNames)) {
			$this->TableNames[key($TableNames)] = current($TableNames);
			next($TableNames);
		}
				
	}
	
	public function setDatabaseAll ($hostname, $user, $password, $databasename, $databasetable) {
		$this->Hostname = $hostname;
		$this->User = $user;
		$this->Password = $password;
		$this->DatabaseName = $databasename;
		$this->DatabaseTable = $databasetable;
		
		$this->LayerModule->setDatabaseAll ($hostname, $user, $password, $databasename);
		
		reset($this->TableNames);
		while (current($this->TableNames)) {
			$this->LayerModule->setDatabasetable (current($this->TableNames));
			next($this->TableNames);
		}
	}
	
	public function FetchDatabase ($PageID) {
		unset ($PageID['PrintPreview']);
		$passarray = array();
		$passarray = &$PageID;
		reset($this->TableNames);
		
		$this->LayerModule->Connect(current($this->TableNames));
		$this->LayerModule->pass (current($this->TableNames), 'setEntireTable', array());
		$this->LayerModule->Disconnect(current($this->TableNames));
		$this->MainMenuTables[current($this->TableNames)] = $this->LayerModule->pass (current($this->TableNames), 'getEntireTable', array());
		$i = 1;
		$key = current($this->TableNames);
		while ($this->MainMenuTables[current($this->TableNames)][$i]['PageID']) {
			array_push($this->LookupPageID, $this->MainMenuTables[current($this->TableNames)][$i]['PageID']);
			array_push($this->LookupObjectID, $this->MainMenuTables[current($this->TableNames)][$i]['ObjectID']);
			array_push($this->LookupMenuItemName, $this->MainMenuTables[current($this->TableNames)][$i]['MenuItemName']);
			array_push($this->LookupEnableDisable, $this->MainMenuTables[current($this->TableNames)][$i]['Enable/Disable']);
			array_push($this->LookupStatus, $this->MainMenuTables[current($this->TableNames)][$i]['Status']);
			
			$i++;
		}
		next ($this->TableNames);
		$i = 0;
		
		while ($this->LookupPageID[$i]) {
			$listidnumber['PageID'] = $this->LookupPageID[$i];
			$listidnumber['ObjectID'] = $this->LookupObjectID[$i];
						
			$listdatabase = Array();
			$listdatabase[current($this->TableNames)] = current($this->TableNames);
			
			$databaseoptions = array();
			if ($this->Insert) {
				$databaseoptions['Insert'] = $this->Insert;
			}

			//$databases = &$this->LayerModule;
			//$databaseoptions['NoGlobal'] = 'NoGlobal';
			
			$list = new XhtmlUnorderedList($listdatabase, $databaseoptions, $this->LayerModule);
			$list->setDatabaseAll ($this->Hostname, $this->User, $this->Password, $this->DatabaseName, current($this->TableNames));
			$list->setHttpUserAgent($_SERVER['HTTP_USER_AGENT']);
			$list->FetchDatabase ($listidnumber);
			//$list->CreateOutput('    ');
			//$objectoutput = $object->getOutput();
			$this->MainMenuTables[current($this->TableNames)] = $list;
			$i++;
			
		}
			
	}
	
	public function CreateOutput($space) {
		reset($this->TableNames);
		next($this->TableNames);
		$i = 0;
		if ($this->JavaScriptLibraryName) {
			$this->Writer->startElement('script');
			$this->Writer->writeAttribute('type', 'text/javascript');
			$this->Writer->writeAttribute('src', $this->JavaScriptLibraryName);
			$this->Writer->fullEndElement();
		}
		
		if ($this->MainMenuID || $this->MainMenuClass || $this->MainMenuStyle || $this->MainMenuInsert) {
			$this->Writer->startElement('div');
			
			$this->ProcessStandardAttribute('MainMenu');
			if ($this->MainMenuInsert) {
				$this->Writer->writeRaw("\n");
				$this->Writer->writeRaw($this->MainMenuInsert);
				$this->Writer->writeRaw("\n");
			}
		}
		
		if ($this->MainMenuTopID || $this->MainMenuTopClass || $this->MainMenuTopStyle || $this->MainMenuTopInsert) {
			$this->Writer->startElement('div');
			
			$this->ProcessStandardAttribute('MainMenuTop');
			
			if ($this->MainMenuTopInsert) {
				$this->Writer->writeRaw("\n");
				$this->Writer->writeRaw($this->MainMenuTopInsert);
				$this->Writer->writeRaw("\n");
			}
			$this->Writer->fullEndElement();
		}
		
		while ($this->LookupPageID[$i]) {
			$LookupPageID = $this->LookupPageID[$i];
			$LookupObjectID = $this->LookupObjectID[$i];
			$LookupMenuItemName = $this->LookupMenuItemName[$i];
			$LookupEnableDisable = $this->LookupEnableDisable[$i];
			$LookupStatus = $this->LookupStatus[$i];
			//$Output = $this->MainMenuTables[current($this->TableNames)]->getOutput();
			
			if ($LookupEnableDisable == 'Enable' & $LookupStatus == 'Approved') {
				$this->Writer->writeRaw("\n");
				$this->MainMenuTables[current($this->TableNames)]->CreateOutput('    ');
				//$this->Writer->writeRaw("\n      ");
				//$this->Writer->writeRaw($Output);
			}
			$i++;
		}
		
		if ($this->MainMenuBottomID || $this->MainMenuBottomClass || $this->MainMenuBottomStyle || $this->MainMenuBottomInsert) {
			$this->Writer->startElement('div');
			
			$this->ProcessStandardAttribute('MainMenuBottom');
			
			if ($this->MainMenuBottomInsert) {
				$this->Writer->writeRaw("\n");
				$this->Writer->writeRaw($this->MainMenuBottomInsert);
				$this->Writer->writeRaw("\n");
			}
			$this->Writer->fullEndElement();
		}
		
		if ($this->MainMenuID || $this->MainMenuClass || $this->MainMenuStyle || $this->MainMenuInsert) {
			$this->Writer->writeRaw("\n     ");
			$this->Writer->fullEndElement();
		}
		
		if ($this->JavaScriptFileName) {
			$this->Writer->startElement('script');
			$this->Writer->writeAttribute('type', 'text/javascript');
			$this->Writer->writeAttribute('src', $this->JavaScriptFileName);
			$this->Writer->fullEndElement();
		}
		$this->Writer->writeRaw("\n");
		/*$this->Writer->endDocument();
		
		if ($this->FileName) {
			$this->Writer->flush();
		} else {
			$this->MainMenu = $this->Writer->flush();
		}*/
		if ($this->FileName) {
			$this->Writer->flush();
		}
		
	}
	/*
	public function getOutput() {
		return $this->MainMenu;
	}*/
	
	public function createMainMenuItemLookup (array $MenuItemLookup) {
		if ($MenuItemLookup != NULL) {
			$this->LayerModule->pass ($this->MainMenuItemLookupTableName, 'BuildFieldNames', array('TableName' => $this->MainMenuItemLookupTableName));
			$Keys = $this->LayerModule->pass ($this->MainMenuItemLookupTableName, 'getRowFieldNames', array());
			$this->addModuleContent($Keys, $MenuItemLookup, $this->MainMenuItemLookupTableName);
		} else {
			array_push($this->ErrorMessage,'createMainMenuItemLookup: MenuItemLookup cannot be NULL!');
		}
	}
	
	public function updateMainMenuItemLookup(array $PageID) {
		if ($PageID != NULL) {
			$Data = $PageID;
			$PageID = array();
			$PageID['PageID'] = $Data['PageID'];
			unset($Data['PageID']);
			$PageID['ObjectID'] = $Data['ObjectID'];
			unset($Data['ObjectID']);
			$PageID['VersionID'] = $Data['VersionID'];
			unset($Data['VersionID']);
			$PageID['RevisionID'] = $Data['RevisionID'];
			unset($Data['RevisionID']);
			
			$this->FetchDatabase($PageID);
			$this->updateModuleContent($PageID, $this->MainMenuItemLookupTableName, $Data);
			$this->updateModuleContent($PageID, $this->MainMenuItemLookupTableName);
		} else {
			array_push($this->ErrorMessage,'updateMainMenuItemLookup: PageID cannot be NULL!');
		}
	}
	
	public function updateMenuMenuItemLookupChildsParentObjectID(array $PageID) {
		if ($PageID != NULL) {
			$Data['ParentObjectID'] = $PageID['ParentID'];
			
			$ID = array();
			$ID['PageID'] = $PageID['PageID'];
			$ID['ObjectID'] = $PageID['ObjectID'];
			
			$this->updateModuleContent($ID, $this->MainMenuItemLookupTableName, $Data);
		} else {
			array_push($this->ErrorMessage,'updateMenuMenuItemLookupChildsParentObjectID: PageID cannot be NULL!');
		}
	}
	
	public function updateMenuMenuItemLookupChildsParentObjectIDName(array $PageID) {
		if ($PageID != NULL) {
			$Data['ParentIDName'] = $PageID['ParentIDName'];
			
			$ID = array();
			$ID['PageID'] = $PageID['PageID'];
			$ID['ObjectID'] = $PageID['ObjectID'];
			
			$this->updateModuleContent($ID, $this->MainMenuItemLookupTableName, $Data);
		} else {
			array_push($this->ErrorMessage,'updateMenuMenuItemLookupChildsParentObjectID: PageID cannot be NULL!');
		}
	}
	
	public function createMenuItem(array $MenuItem) {
		if ($MenuItem != NULL) {
			$PageID = array();
			$PageID['PageID'] = $MenuItem['PageID'];
			$PageID['ObjectID'] = $MenuItem['ObjectID'];
			$this->FetchDatabase($PageID);
			$this->MainMenuTables['MainMenu']->createUnorderedList($MenuItem);
		} else {
			array_push($this->ErrorMessage,'createMenuItem: MenuItem cannot be NULL!');
		}
	}
	
	public function updateMenuItem(array $PageID) {
		if ($PageID != NULL) {
			if ($this->MainMenuTables['MainMenu'] == NULL) {
				$pageid = array();
				$pageid['PageID'] = $PageID['PageID'];
				$pageid['ObjectID'] = $PageID['ObjectID'];
				$this->FetchDatabase($pageid);
			}
			$this->MainMenuTables['MainMenu']->updateUnorderedList($PageID);
		} else {
			array_push($this->ErrorMessage,'updateMenuItem: PageID cannot be NULL!');
		}
	}
	
	public function deleteMenuItem(array $PageID) {
		if ($PageID != NULL) {
			$this->MainMenuTables['MainMenu']->deleteUnorderedList($PageID);
		} else {
			array_push($this->ErrorMessage,'deleteMenuItem: PageID cannot be NULL!');
		}
	}
	
	public function updateMenuItemStatus(array $PageID) {
		if ($PageID != NULL) {
			$this->MainMenuTables['MainMenu']->updateUnorderedListStatus($PageID);
			/*$PassID = array();
			$PassID['PageID'] = $PageID['PageID'];
			
			if ($PageID['EnableDisable'] == 'Enable') {
				$this->MainMenuTables['MainMenu']->enableUnorderedList($PassID);
				//$this->enableModuleContent($PassID, $this->DatabaseTable);
			} else if ($PageID['EnableDisable'] == 'Disable') {
				$this->MainMenuTables['MainMenu']->disableUnorderedList($PassID);
				//$this->disableModuleContent($PassID, $this->DatabaseTable);
			}
			
			if ($PageID['Status'] == 'Approved') {
				//$this->approvedModuleContent($PassID, $this->DatabaseTable);
			} else if ($PageID['Status'] == 'Not-Approved') {
				//$this->notApprovedModuleContent($PassID, $this->DatabaseTable);
			} else if ($PageID['Status'] == 'Pending') {
				//$this->pendingModuleContent($PassID, $this->DatabaseTable);
			} else if ($PageID['Status'] == 'Spam') {
				//$this->spamModuleContent($PassID, $this->DatabaseTable);
			}*/
		} else {
			array_push($this->ErrorMessage,'updateMenuItemStatus: PageID cannot be NULL!');
		}
	}
	
	public function updateMainMenu(array $PageID) {
		if ($PageID != NULL) {
			$DatabaseTableName = $this->TableNames['DatabaseTable2'];
			$this->LayerModule->Connect($DatabaseTableName);
			$this->LayerModule->pass ($DatabaseTableName, 'emptyTable', array());
			$this->LayerModule->Disconnect($DatabaseTableName);
			
			foreach($PageID as $MenuItem) {
				$this->createMenuItem($MenuItem);
			}
		} else {
			array_push($this->ErrorMessage,'updateMainMenu: PageID cannot be NULL!');
		}
	}
}
?>