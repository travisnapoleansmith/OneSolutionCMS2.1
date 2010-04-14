<?php

class XhtmlMainMenu extends Tier6ContentLayerModulesAbstract implements Tier6ContentLayerModules {	
	protected $TableNames = array();
	protected $MainMenuTables = array();
	
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
	
	public function __construct($tablenames, $databaseoptions) {
		$this->LayerModule = &$GLOBALS['Tier6Databases'];
		
		//$this->FileName = $tablenames['FileName'];
		//unset($tablenames['FileName']);
		
		if ($databaseoptions['JavaScriptFileName']) {
			$this->JavaScriptFileName = $databaseoptions['JavaScriptFileName'];
			unset($databaseoptions['JavaScriptFileName']);
		}
		
		//$this->JavaScriptFileName = $tablenames['JavaScriptFileName'];
		//unset($tablenames['JavaScriptFileName']);
		
		if ($databaseoptions['JavaScriptLibraryName']) {
			$this->JavaScriptLibraryName = $databaseoptions['JavaScriptLibraryName'];
			unset($databaseoptions['JavaScriptLibraryName']);
		}
		
		//$this->JavaScriptLibraryName = $tablenames['JavaScriptLibraryName'];
		//unset($tablenames['JavaScriptLibraryName']);
		
		if ($databaseoptions['MainMenuID']) {
			$this->MainMenuID = $databaseoptions['MainMenuID'];
			unset($databaseoptions['MainMenuID']);
		}
		
		//$this->MainMenuID = $tablenames['MainMenuID'];
		//unset($tablenames['MainMenuID']);
		
		if ($databaseoptions['MainMenuClass']) {
			$this->MainMenuClass = $databaseoptions['MainMenuClass'];
			unset($databaseoptions['MainMenuClass']);
		}
		
		//$this->MainMenuClass = $tablenames['MainMenuClass'];
		//unset($tablenames['MainMenuClass']);
		
		if ($databaseoptions['MainMenuStyle']) {
			$this->MainMenuStyle = $databaseoptions['MainMenuStyle'];
			unset($databaseoptions['MainMenuStyle']);
		}
		
		//$this->MainMenuStyle = $tablenames['MainMenuStyle'];
		//unset($tablenames['MainMenuStyle']);
		
		if ($databaseoptions['MainMenuInsert']) {
			$this->MainMenuInsert = $databaseoptions['MainMenuInsert'];
			unset($databaseoptions['MainMenuInsert']);
		}
		
		//$this->MainMenuInsert = $tablenames['MainMenuInsert'];
		//unset($tablenames['MainMenuInsert']);
		
		if ($databaseoptions['MainMenuTopID']) {
			$this->MainMenuTopID = $databaseoptions['MainMenuTopID'];
			unset($databaseoptions['MainMenuTopID']);
		}
		
		//$this->MainMenuTopID = $tablenames['MainMenuTopID'];
		//unset($tablenames['MainMenuTopID']);
		
		if ($databaseoptions['MainMenuTopClass']) {
			$this->MainMenuTopClass = $databaseoptions['MainMenuTopClass'];
			unset($databaseoptions['MainMenuTopClass']);
		}
		
		//$this->MainMenuTopClass = $tablenames['MainMenuTopClass'];
		//unset($tablenames['MainMenuTopClass']);
		
		if ($databaseoptions['MainMenuTopStyle']) {
			$this->MainMenuTopStyle = $databaseoptions['MainMenuTopStyle'];
			unset($databaseoptions['MainMenuTopStyle']);
		}
		
		//$this->MainMenuTopStyle = $tablenames['MainMenuTopStyle'];
		//unset($tablenames['MainMenuTopStyle']);
		
		if ($databaseoptions['MainMenuTopInsert']) {
			$this->MainMenuTopInsert = $databaseoptions['MainMenuTopInsert'];
			unset($databaseoptions['MainMenuTopInsert']);
		}
		
		//$this->MainMenuTopInsert = $tablenames['MainMenuTopInsert'];
		//unset($tablenames['MainMenuTopInsert']);
		
		if ($databaseoptions['MainMenuBottomID']) {
			$this->MainMenuBottomID = $databaseoptions['MainMenuBottomID'];
			unset($databaseoptions['MainMenuBottomID']);
		}
		
		//$this->MainMenuBottomID = $tablenames['MainMenuBottomID'];
		//unset($tablenames['MainMenuBottomID']);
		
		if ($databaseoptions['MainMenuBottomClass']) {
			$this->MainMenuBottomClass = $databaseoptions['MainMenuBottomClass'];
			unset($databaseoptions['MainMenuBottomClass']);
		}
		
		//$this->MainMenuBottomClass = $tablenames['MainMenuBottomClass'];
		//unset($tablenames['MainMenuBottomClass']);
		
		if ($databaseoptions['MainMenuBottomStyle']) {
			$this->MainMenuBottomStyle = $databaseoptions['MainMenuBottomStyle'];
			unset($databaseoptions['MainMenuBottomStyle']);
		}
		
		//$this->MainMenuBottomStyle = $tablenames['MainMenuBottomStyle'];
		//unset($tablenames['MainMenuBottomStyle']);
		
		if ($databaseoptions['MainMenuBottomInsert']) {
			$this->MainMenuBottomInsert = $databaseoptions['MainMenuBottomInsert'];
			unset($databaseoptions['MainMenuBottomInsert']);
		}
		
		//$this->MainMenuBottomInsert = $tablenames['MainMenuBottomInsert'];
		//unset($tablenames['MainMenuBottomInsert']);
		
		if ($databaseoptions['Insert']) {
			$this->Insert = $databaseoptions['Insert'];
			unset($databaseoptions['Insert']);
		}
		
		//$this->Insert = $tablenames['Insert'];
		//unset($tablenames['Insert']);
		
		/*$this->GlobalWriter = $tablenames['GlobalWriter'];
		unset($tablenames['GlobalWriter']);
		
		if ($this->GlobalWriter) {
			$this->Writer = $this->GlobalWriter;
		} else {
			$this->Writer = new XMLWriter();
			if ($this->FileName) {
				$this->Writer->openURI($this->FileName);
			} else {
				$this->Writer->openMemory();
			}
			$this->Writer->setIndent(4);
		}
		*/
		
		if ($databaseoptions['FileName']) {
			$this->FileName = $databaseoptions['FileName'];
			unset($databaseoptions['FileName']);
		}
		
		if ($this->FileName) {
			$this->Writer = new XMLWriter();
			$this->Writer->openURI($this->FileName);
		} else {
			$this->Writer = &$GLOBALS['Writer'];
		}
		while (current($tablenames)) {
			$this->TableNames[key($tablenames)] = current($tablenames);
			next($tablenames);
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
			
			$list = new XhtmlUnorderedList($listdatabase, $databaseoptions);
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
}
?>