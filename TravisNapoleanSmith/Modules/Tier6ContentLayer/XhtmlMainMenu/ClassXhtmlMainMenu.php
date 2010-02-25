<?php

class XhtmlMainMenu extends Tier6ContentLayerModulesAbstract implements Tier6ContentLayerModules {
	protected $XhtmlMainMenuProtectionLayer;
	
	protected $TableNames = array();
	protected $MainMenuTables = array();
	
	protected $Writer;
	protected $FileName;
	protected $JavaScriptFileName;
	protected $JavaScriptLibraryName;
	
	protected $LookupPageID = array();
	protected $LookupObjectID = array();
	protected $LookupMenuItemName = array();
	protected $LookupEnableDisable = array();
	protected $LookupStatus = array();
	
	protected $EnableDisable = array();
	protected $Status = array();
	
	protected $MainMenu;
	
	public function __construct($tablenames, $database) {
		
		$this->XhtmlMainMenuProtectionLayer = &$database;
		
		$this->FileName = $tablenames['FileName'];
		unset($tablenames['FileName']);
		
		$this->JavaScriptFileName = $tablenames['JavaScriptFileName'];
		unset($tablenames['JavaScriptFileName']);
		
		$this->JavaScriptLibraryName = $tablenames['JavaScriptLibraryName'];
		unset($tablenames['JavaScriptLibraryName']);
		
		$this->Writer = new XMLWriter();
		if ($this->FileName) {
			$this->Writer->openURI($this->FileName);
		} else {
			$this->Writer->openMemory();
		}
		
		while (current($tablenames)) {
			$this->TableNames[key($tablenames)] = current($tablenames);
			next($tablenames);
		}
				
		$this->Writer->setIndent(4);
	}
	
	public function setDatabaseAll ($hostname, $user, $password, $databasename, $databasetable) {
		$this->Hostname = $hostname;
		$this->User = $user;
		$this->Password = $password;
		$this->DatabaseName = $databasename;
		$this->DatabaseTable = $databasetable;
		
		$this->XhtmlMainMenuProtectionLayer->setDatabaseAll ($hostname, $user, $password, $databasename);
		
		reset($this->TableNames);
		while (current($this->TableNames)) {
			$this->XhtmlMainMenuProtectionLayer->setDatabasetable (current($this->TableNames));
			next($this->TableNames);
		}
	}
	
	public function FetchDatabase ($PageID) {
		
		unset ($PageID['PrintPreview']);
		$passarray = array();
		$passarray = &$PageID;
		reset($this->TableNames);
		
		$this->XhtmlMainMenuProtectionLayer->Connect(current($this->TableNames));
		$this->XhtmlMainMenuProtectionLayer->pass (current($this->TableNames), 'setEntireTable', array());
		$this->XhtmlMainMenuProtectionLayer->Disconnect(current($this->TableNames));
		$this->MainMenuTables[current($this->TableNames)] = $this->XhtmlMainMenuProtectionLayer->pass (current($this->TableNames), 'getEntireTable', array());
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
			
			$databases = &$this->XhtmlMainMenuProtectionLayer;
			
			$list = new XhtmlList($listdatabase, $databases);
		
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