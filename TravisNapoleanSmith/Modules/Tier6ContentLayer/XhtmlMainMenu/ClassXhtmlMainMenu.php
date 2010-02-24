<?php

class XhtmlMainMenu extends Tier6ContentLayerModulesAbstract implements Tier6ContentLayerModules {
	protected $XhtmlMainMenuProtectionLayer;
	
	protected $TableNames = array();
	protected $MainMenuTables = array();
	
	protected $Writer;
	protected $FileName;
	
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
			//print_r($list->getOutput());
			$i++;
		}
			
	}
	
	public function CreateOutput($space) {
		/*reset($this->PageID);
		while (current($this->PageID)) {
			$PageId = current($this->PageID);
			$Loc = current($this->Loc);
			$Lastmod = current($this->Lastmod);
			$ChangeFreq = current($this->ChangeFreq);
			$Priority = current($this->Priority);
			$EnableDisable = current($this->EnableDisable);
			$Status = current($this->Status);
			
			if ($EnableDisable == 'Enable' & $Status == 'Approved') {
				$this->Writer->startElement('url');
				if ($Loc) {
					$this->Writer->startElement('loc');
					$this->Writer->text($Loc);
					$this->Writer->endElement();
				}
				
				if ($Lastmod) {
					$this->Writer->startElement('lastmod');
					$this->Writer->text($Lastmod);
					$this->Writer->endElement();
				}
				
				if ($ChangeFreq) {
					$this->Writer->startElement('changefreq');
					$this->Writer->text($ChangeFreq);
					$this->Writer->endElement();
				}
				
				if ($Priority) {
					$this->Writer->startElement('priority');
					$this->Writer->text($Priority);
					$this->Writer->endElement();
				}
				
				$this->Writer->endElement();
			}
			next($this->PageID);
			next($this->Loc);
			next($this->Lastmod);
			next($this->ChangeFreq);
			next($this->Priority);
			next($this->EnableDisable);
			next($this->Status);
		}
		$this->Writer->endElement();
		$this->Writer->endDocument();
		if ($this->FileName) {
			$this->Writer->flush();
		} else {
			$this->MainMenu = $this->Writer->flush();
		}
		*/
	}
	
	public function getOutput() {
		return $this->MainMenu;
	}
}
?>