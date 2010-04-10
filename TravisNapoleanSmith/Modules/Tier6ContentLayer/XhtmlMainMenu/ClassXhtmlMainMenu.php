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
	
	protected $MainMenu;
	
	public function __construct($tablenames, $databaseoptions) {
		$this->LayerModule = &$GLOBALS['Tier6Databases'];
		
		$this->FileName = $tablenames['FileName'];
		unset($tablenames['FileName']);
		
		$this->JavaScriptFileName = $tablenames['JavaScriptFileName'];
		unset($tablenames['JavaScriptFileName']);
		
		$this->JavaScriptLibraryName = $tablenames['JavaScriptLibraryName'];
		unset($tablenames['JavaScriptLibraryName']);
		
		$this->MainMenuID = $tablenames['MainMenuID'];
		unset($tablenames['MainMenuID']);
		
		$this->MainMenuClass = $tablenames['MainMenuClass'];
		unset($tablenames['MainMenuClass']);
		
		$this->MainMenuStyle = $tablenames['MainMenuStyle'];
		unset($tablenames['MainMenuStyle']);
		
		$this->MainMenuInsert = $tablenames['MainMenuInsert'];
		unset($tablenames['MainMenuInsert']);
		
		$this->MainMenuTopID = $tablenames['MainMenuTopID'];
		unset($tablenames['MainMenuTopID']);
		
		$this->MainMenuTopClass = $tablenames['MainMenuTopClass'];
		unset($tablenames['MainMenuTopClass']);
		
		$this->MainMenuTopStyle = $tablenames['MainMenuTopStyle'];
		unset($tablenames['MainMenuTopStyle']);
		
		$this->MainMenuTopInsert = $tablenames['MainMenuTopInsert'];
		unset($tablenames['MainMenuTopInsert']);
		
		$this->MainMenuBottomID = $tablenames['MainMenuBottomID'];
		unset($tablenames['MainMenuBottomID']);
		
		$this->MainMenuBottomClass = $tablenames['MainMenuBottomClass'];
		unset($tablenames['MainMenuBottomClass']);
		
		$this->MainMenuBottomStyle = $tablenames['MainMenuBottomStyle'];
		unset($tablenames['MainMenuBottomStyle']);
		
		$this->MainMenuBottomInsert = $tablenames['MainMenuBottomInsert'];
		unset($tablenames['MainMenuBottomInsert']);
		
		$this->Insert = $tablenames['Insert'];
		unset($tablenames['Insert']);
		
		$this->GlobalWriter = $tablenames['GlobalWriter'];
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
			
			if ($this->Insert) {
				$listdatabase['Insert'] = $this->Insert;
			}
			
			$databases = &$this->LayerModule;
			
			$list = new XhtmlUnorderedList($listdatabase, $databases);
			
			$list->setDatabaseAll ($this->Hostname, $this->User, $this->Password, $this->DatabaseName, current($this->TableNames));
			$list->setHttpUserAgent($_SERVER['HTTP_USER_AGENT']);
			$list->FetchDatabase ($listidnumber);
			$list->CreateOutput('    ');
			
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
			$Output = $this->MainMenuTables[current($this->TableNames)]->getOutput();
			
			if ($LookupEnableDisable == 'Enable' & $LookupStatus == 'Approved') {
				$this->Writer->writeRaw("\n");
				$this->Writer->writeRaw($Output);
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
			$this->Writer->writeRaw("\n");
			$this->Writer->fullEndElement();
		}
		
		if ($this->JavaScriptFileName) {
			$this->Writer->startElement('script');
			$this->Writer->writeAttribute('type', 'text/javascript');
			$this->Writer->writeAttribute('src', $this->JavaScriptFileName);
			$this->Writer->fullEndElement();
		}
		$this->Writer->endDocument();
		
		if ($this->FileName) {
			$this->Writer->flush();
		} else {
			$this->MainMenu = $this->Writer->flush();
		}
		
	}
	
	public function getOutput() {
		return $this->MainMenu;
	}
}
?>