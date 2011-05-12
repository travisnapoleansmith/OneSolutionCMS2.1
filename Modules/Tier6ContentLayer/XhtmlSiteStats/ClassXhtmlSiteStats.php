<?php

class XhtmlSiteStats extends Tier6ContentLayerModulesAbstract implements Tier6ContentLayerModules {
	protected $Count;
	
	protected $Class;
	protected $ID;
	protected $Style;
	
	protected $BeginMessage;
	protected $EndMessage;
	
	protected $StartTag;
	protected $NoOutput;
	
	public function __construct($tablenames, $databaseoptions, $layermodule) {
		$this->LayerModule = &$layermodule;
		
		$hold = current($tablenames);
		$GLOBALS['ErrorMessage']['XhtmlSiteStats'][$hold] = NULL;
		$this->ErrorMessage = &$GLOBALS['ErrorMessage']['XhtmlSiteStats'][$hold];
		$this->ErrorMessage = array();
		
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
		
		if ($databaseoptions['Class']) {
			$this->Class = $databaseoptions['Class'];
		}
		
		if ($databaseoptions['ID']) {
			$this->ID = $databaseoptions['ID'];
		}
		
		if ($databaseoptions['Style']) {
			$this->Style = $databaseoptions['Style'];
		}
		
		if ($databaseoptions['BeginMessage']) {
			$this->BeginMessage = $databaseoptions['BeginMessage'];
		}
		
		if ($databaseoptions['EndMessage']) {
			$this->EndMessage = $databaseoptions['EndMessage'];
		}
		
		if ($databaseoptions['StartTag']) {
			$this->StartTag = $databaseoptions['StartTag'];
		}
		
		if ($databaseoptions['NoOutput']) {
			$this->StartTag = $databaseoptions['NoOutput'];
		}
	}
	
	public function setDatabaseAll ($hostname, $user, $password, $databasename, $databasetable) {
		$this->Hostname = $hostname;
		$this->User = $user;
		$this->Password = $password;
		$this->DatabaseName = $databasename;
		$this->DatabaseTable = $databasetable;
		
		$this->LayerModule->setDatabaseAll ($hostname, $user, $password, $databasename);
		$this->LayerModule->setDatabasetable ($databasetable);
		
	}

	public function FetchDatabase ($PageID) {
		$this->PageID = $PageID['PageID'];
		unset ($PageID['PrintPreview']);
		
		$this->LayerModule->Connect($this->DatabaseTable);
		$passarray = array();
		$passarray = $PageID;
		
		$this->LayerModule->pass ($this->DatabaseTable, 'setDatabaseField', array('idnumber' => $passarray));
		$this->LayerModule->pass ($this->DatabaseTable, 'setDatabaseRow', array('idnumber' => $passarray));
		
		$this->Count = $this->LayerModule->pass ($this->DatabaseTable, 'getRowField', array('rowfield' => 'Count'));
		
		$this->LayerModule->Disconnect($this->DatabaseTable);
	}
	
	public function CreateOutput($space) {
		$Message = '';
		if ($this->BeginMessage != NULL) {
			$Message = $this->BeginMessage;
		}
		$Message .= $this->Count;
		if ($this->EndMessage != NULL) {
			$Message .= $this->EndMessage;
		}
		
		if ($Message != '' & isset($this->Count)) {
			if ($this->StartTag != NULL) {
				$this->Space = $space;
				$this->Writer->startElement('p');
				$this->ProcessStandardAttribute('');
				
				$this->Writer->text($Message);
				$this->Writer->endElement();
			} else if ($this->NoOutput == TRUE) {
				return FALSE;
			} else {
				$this->Writer->writeRaw($Message);
			}
		}
		
		if ($this->FileName) {
			$this->Writer->flush();
		}
	}
	
	public function checkSiteStatPage () {
		if ($this->LayerModule->pass ($this->DatabaseTable, 'getRowField', array('rowfield' => 'PageID'))) {
			return TRUE;
		} else {
			return FALSE;
		}
	}
	
	public function createSiteStatPage(array $SiteStatPage) {
		if ($SiteStatPage != NULL) {
			$this->LayerModule->pass ($this->DatabaseTable, 'BuildFieldNames', array('TableName' => $this->DatabaseTable));
			$Keys = $this->LayerModule->pass ($this->DatabaseTable, 'getRowFieldNames', array());
			$this->addModuleContent($Keys, $SiteStatPage, $this->DatabaseTable);
		} else {
			array_push($this->ErrorMessage,'createSiteStatPage: SiteStatPage cannot be NULL!');
		}
	}
	
	public function updateSiteStatPage(array $PageID) {
		if ($PageID != NULL) {
			$NewCount = $this->Count;
			$NewCount++;
			$Content = array('Count' => $NewCount);
			$CurrentMonthYear = date('FY');
			$passarray = array('TableName' => $this->DatabaseTable);
			
			$this->LayerModule->pass ($this->DatabaseTable, 'BuildFieldNames', $passarray);
			$RowFieldName = $this->LayerModule->pass ($this->DatabaseTable, 'getRowFieldNames', array());
			$Key = array_search($CurrentMonthYear, $RowFieldName);
			if ($Key) {
				$CurrentMonthYearCount = $this->LayerModule->pass ($this->DatabaseTable, 'getRowField', array('rowfield' => $CurrentMonthYear));
				$CurrentMonthYearCount++;
				$Content[$CurrentMonthYear] = $CurrentMonthYearCount;
			} else {
				$passarray = array('fieldstring' => "`$CurrentMonthYear` INT NOT NULL DEFAULT '0'", 'fieldflag' => '', 'fieldflagcolumn' => '');
				$this->LayerModule->pass ($this->DatabaseTable, 'createField', $passarray);
				$CurrentMonthYearCount = $this->LayerModule->pass ($this->DatabaseTable, 'getRowField', array('rowfield' => $CurrentMonthYear));
				$CurrentMonthYearCount++;
				$Content[$CurrentMonthYear] = $CurrentMonthYearCount;
			}
			
			$this->updateModuleContent($PageID, $this->DatabaseTable, $Content);
		} else {
			array_push($this->ErrorMessage,'updateSiteStatPage: PageID cannot be NULL!');
		}
	}
	
	public function deleteSiteStatPage(array $PageID) {
		if ($PageID != NULL) {
			$passarray = array('rowname' => 'PageID', 'rowvalue' => $PageID['PageID']);
			$this->LayerModule->pass ($this->DatabaseTable, 'deleteRow', $passarray);
		} else {
			array_push($this->ErrorMessage,'deleteSiteStatPage: PageID cannot be NULL!');
		}
	}
}
?>