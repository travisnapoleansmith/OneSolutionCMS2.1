<?php

class XhtmlNewsStories extends Tier6ContentLayerModulesAbstract implements Tier6ContentLayerModules {
	protected $NewsStoriesTableName;
	protected $NewsStoriesLookupTableName;
	protected $NewsStoriesDatesTableName;
	protected $NewsStoriesVersionTableName;
	
	protected $ContentLayerTablesName;
	protected $ContentPrintPreviewTableName;
	protected $ContentLayerModulesTableName;
	
	protected $NewsStoriesDatesTable;
	protected $NewsStoriesTable = array();
	
	protected $FormOptionTableName;
	protected $FormOptionTable;
	
	protected $FormSelectTableName;
	protected $FormSelectTable;
	
	protected $ContentLayerModulesTable;
	protected $PrintIdNumberArray;
	
	protected $ContainerObjectType;
	protected $ContainerObjectTypeName;
	protected $ContainerObjectID;
	protected $ContainerObjectPrintPreview;
	protected $RevisionID;
	protected $CurrentVersion;
	protected $Empty;
	
	protected $Heading;
	protected $HeadingStartTag;
	protected $HeadingEndTag;
	protected $HeadingStartTagID;
	protected $HeadingStartTagClass;
	protected $HeadingStartTagStyle;
	
	protected $Content;
	protected $ContentStartTag;
	protected $ContentEndTag;
	protected $ContentStartTagID;
	protected $ContentStartTagClass;
	protected $ContentStartTagStyle;
	protected $ContentPTagID;
	protected $ContentPTagClass;
	protected $ContentPTagStyle;
	
	protected $NewsStoriesLookupPageID;
	protected $NewsStoriesLookupObjectID;
	protected $NewsStoriesLookupNewsStoryPageID;
	protected $NewsStoriesLookupNewsStoryDay;
	protected $NewsStoriesLookupNewsStoryMonth;
	protected $NewsStoriesLookupNewsStoryYear;
	protected $NewsStoriesLookupEnableDisable;
	protected $NewsStoriesLookupStatus;
	
	public function __construct($tablenames, $databaseoptions, $layermodule) {
		$this->LayerModule = &$layermodule;
		
		$hold = current($tablenames);
		$GLOBALS['ErrorMessage']['XhtmlNewsStories'][$hold] = NULL;
		$this->ErrorMessage = &$GLOBALS['ErrorMessage']['XhtmlNewsStories'][$hold];
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
		
		if ($databaseoptions['NoAttributes']) {
			$this->NoAttributes = $databaseoptions['NoAttributes'];
			unset($databaseoptions['NoAttributes']);
		}
		
		$this->NewsStoriesTableName = current($tablenames);
		$this->NewsStoriesLookupTableName = next($tablenames);
		$this->NewsStoriesDatesTableName = next($tablenames);
		$this->NewsStoriesVersionTableName = next($tablenames);
		
		$this->ContentLayerTablesName = next($tablenames);
		$this->ContentPrintPreviewTableName = next($tablenames);
		$this->ContentLayerModulesTableName = next($tablenames);
		
	}
	
	public function setDatabaseAll ($hostname, $user, $password, $databasename, $databasetable) {
		$this->Hostname = $hostname;
		$this->User = $user; 
		$this->Password = $password; 
		$this->DatabaseName = $databasename;
		$this->DatabaseTable = $databasetable;
		
		$this->LayerModule->setDatabaseAll ($hostname, $user, $password, $databasename);
		$this->LayerModule->setDatabasetable ($this->NewsStoriesTableName);
		
		$this->LayerModule->setDatabaseAll ($hostname, $user, $password, $databasename);
		$this->LayerModule->setDatabasetable ($this->NewsStoriesLookupTableName);
		
		$this->LayerModule->setDatabaseAll ($hostname, $user, $password, $databasename);
		$this->LayerModule->setDatabasetable ($this->ContentLayerTablesName);
		
		$this->LayerModule->setDatabaseAll ($hostname, $user, $password, $databasename);
		$this->LayerModule->setDatabasetable ($this->ContentPrintPreviewTableName);
		
		$this->LayerModule->setDatabaseAll ($hostname, $user, $password, $databasename);
		$this->LayerModule->setDatabasetable ($this->ContentLayerModulesTableName);
	}
	
	public function getLayerModule() {
		return $this->LayerModule;
	}
	
	public function getContentLayerTables() {
		return $this->LayerModule;
	}
	
	public function getNewsStoriesTableName() {
		return $this->NewsStoriesTableName;
	}

	public function getContentLayerTablesName() {
		return $this->ContentLayerTablesName;
	}
	
	public function getContentPrintPreviewTable() {
		return $this->LayerModule;
	}
	
	public function getContentPrintPreviewTableName() {
		return $this->ContentPrintPreviewTableName;
	}
	
	public function getContainerObjectType() {
		return $this->ContainerObjectType;
	}
	
	public function getContainerObjectID() {
		return $this->ContainerObjectID;
	}
	
	public function getContainerObjectPrintPreview() {
		return $this->ContainerObjectPrintPreview;
	}
	
	public function getRevisionID() {
		return $this->RevisionID;
	}
	
	public function getCurrentVersion() {
		return $this->CurrentVersion;
	}
	
	public function getHeading() {
		return $this->Heading;
	}
		
	public function getHeadingStartTag() {
		return $this->HeadingStartTag;
	}
	
	public function getHeadingEndTag() {
		return $this->HeadingEndTag;
	}	
	
	public function getHeadingStartTagID() {
		return $this->HeadingStartTagID;
	}
	
	public function getHeadingStartTagClass() {
		return $this->HeadingStartTagClass;
	}
	
	public function getHeadingStartTagStyle() {
		return $this->HeadingStartTagStyle;
	}
	
	public function getContent() {
		return $this->Content;
	}
	
	public function getContentStartTag() {
		return $this->ContentStartTag;
	}
	
	public function getContentEndTag() {
		return $this->ContentEndTag;
	}
	
	public function getContentStartTagID() {
		return $this->ContentStartTagID;
	}
	
	public function getContentStartTagClass() {
		return $this->ContentStartTagClass;
	}
	
	public function getContentStartTagStyle() {
		return $this->ContentStartTagStyle;
	}
	
	public function FetchDatabase ($PageID) {
		$this->PageID = $PageID['PageID'];
		$this->ObjectID = $PageID['ObjectID'];
		$this->PrintPreview = $PageID['PrintPreview'];
		$this->RevisionID = $PageID['RevisionID'];
		$this->CurrentVersion = $PageID['CurrentVersion'];
		unset($PageID['PrintPreview']);
		unset($PageID['RevisionID']);
		unset($PageID['CurrentVersion']);
		
		$passarray = array();
		$passarray = $PageID;

		$this->LayerModule->Connect($this->NewsStoriesLookupTableName);
		
		
		$this->LayerModule->pass ($this->NewsStoriesLookupTableName, 'setDatabaseRow', array('idnumber' => $passarray));
		
		$this->NewsStoriesLookupPageID = $this->LayerModule->pass ($this->NewsStoriesLookupTableName, 'getRowField', array('rowfield' => 'PageID'));
		$this->NewsStoriesLookupObjectID = $this->LayerModule->pass ($this->NewsStoriesLookupTableName, 'getRowField', array('rowfield' => 'ObjectID'));
		$this->NewsStoriesLookupNewsStoryPageID = $this->LayerModule->pass ($this->NewsStoriesLookupTableName, 'getRowField', array('rowfield' => 'NewsStoryPageID'));
		$this->NewsStoriesLookupNewsStoryDay = $this->LayerModule->pass ($this->NewsStoriesLookupTableName, 'getRowField', array('rowfield' => 'NewsStoryDay'));
		$this->NewsStoriesLookupNewsStoryMonth = $this->LayerModule->pass ($this->NewsStoriesLookupTableName, 'getRowField', array('rowfield' => 'NewsStoryMonth'));
		$this->NewsStoriesLookupNewsStoryYear = $this->LayerModule->pass ($this->NewsStoriesLookupTableName, 'getRowField', array('rowfield' => 'NewsStoryYear'));
		$this->NewsStoriesLookupEnableDisable = $this->LayerModule->pass ($this->NewsStoriesLookupTableName, 'getRowField', array('rowfield' => 'Enable/Disable'));
		$this->NewsStoriesLookupStatus = $this->LayerModule->pass ($this->NewsStoriesLookupTableName, 'getRowField', array('rowfield' => 'Status'));
		
		$this->LayerModule->Disconnect($this->NewsStoriesLookupTableName);
		
		if ($this->NewsStoriesLookupNewsStoryPageID || $this->NewsStoriesLookupNewsStoryDay == 'LastStory') {
			$passarray = array();
			if ($_GET['NewsRevisionID']) {
				$passarray['RevisionID'] = $_GET['NewsRevisionID'];
			} else {
				$passarray['CurrentVersion'] = $this->CurrentVersion;
			}
			if ($this->NewsStoriesLookupNewsStoryDay == 'LastStory') {
				if ($_GET['NewNewsPageID']) {
					$passarray['PageID'] = $_GET['NewNewsPageID']; 
				} else if ($_GET['NewsPageID']) {
					$passarray['PageID'] = $_GET['NewsPageID'];
				} else {
					$LastPageID = $this->getLastNewsPageID();
					$passarray['PageID'] = $LastPageID;
				}
			} else {
				$passarray['PageID'] = $this->NewsStoriesLookupNewsStoryPageID;
			}
			
			$this->LayerModule->Connect($this->NewsStoriesTableName);
			
			$this->LayerModule->pass ($this->NewsStoriesTableName, 'setDatabaseRow', array('idnumber' => $passarray));
			$this->LayerModule->Disconnect($this->NewsStoriesTableName);
			array_push($this->NewsStoriesTable, $this->LayerModule->pass ($this->NewsStoriesTableName, 'getMultiRowField', array()));

		} else {
			$newpassarray = array();
			if ($_GET['NewsRevisionID']) {
				$newpassarray['RevisionID'] = $_GET['NewsRevisionID'];
			} else {
				$newpassarray['CurrentVersion'] = $this->CurrentVersion;
			}
			if ($this->NewsStoriesLookupNewsStoryDay) {
				if ($this->NewsStoriesLookupNewsStoryDay == 'Current') {
					$newpassarray['NewsStoryDay'] = date('d');
				} else if ($this->NewsStoriesLookupNewsStoryDay != 'LastStory'){
					$newpassarray['NewsStoryDay'] = $this->NewsStoriesLookupNewsStoryDay;
				}
			}
			
			if ($this->NewsStoriesLookupNewsStoryYear) {
				if ($this->NewsStoriesLookupNewsStoryYear == 'Current') {
					$newpassarray['NewsStoryYear'] = date('Y');
				} else {
					$newpassarray['NewsStoryYear'] = $this->NewsStoriesLookupNewsStoryYear;
				}
			}
			if ($this->NewsStoriesLookupNewsStoryMonth) {
				if ($this->NewsStoriesLookupNewsStoryMonth == 'Current') {
					$newpassarray['NewsStoryMonth'] = date('F');
					
				} else if ($this->NewsStoriesLookupNewsStoryMonth == 'LastMonth') {
					$lastmonthtime = mktime(0, 0, 0, date('m')-1, date('d'), date('Y'));
					$newpassarray['NewsStoryMonth'] = date('F', $lastmonthtime);
					$newpassarray['NewsStoryYear'] = date('Y', $lastmonthtime);
					
				} else if ($this->NewsStoriesLookupNewsStoryMonth == '2MonthsAgo') {
					$lastmonthtime = mktime(0, 0, 0, date('m')-2, date('d'), date('Y'));
					$newpassarray['NewsStoryMonth'] = date('F', $lastmonthtime);
					$newpassarray['NewsStoryYear'] = date('Y', $lastmonthtime);
					
				} else if ($this->NewsStoriesLookupNewsStoryMonth == '3MonthsAgo') {
					$lastmonthtime = mktime(0, 0, 0, date('m')-3, date('d'), date('Y'));
					$newpassarray['NewsStoryMonth'] = date('F', $lastmonthtime);
					$newpassarray['NewsStoryYear'] = date('Y', $lastmonthtime);
					
				} else if ($this->NewsStoriesLookupNewsStoryMonth == '4MonthsAgo') {
					$lastmonthtime = mktime(0, 0, 0, date('m')-4, date('d'), date('Y'));
					$newpassarray['NewsStoryMonth'] = date('F', $lastmonthtime);
					$newpassarray['NewsStoryYear'] = date('Y', $lastmonthtime);
					
				} else if ($this->NewsStoriesLookupNewsStoryMonth == '5MonthsAgo') {
					$lastmonthtime = mktime(0, 0, 0, date('m')-5, date('d'), date('Y'));
					$newpassarray['NewsStoryMonth'] = date('F', $lastmonthtime);
					$newpassarray['NewsStoryYear'] = date('Y', $lastmonthtime);
					
				} else if ($this->NewsStoriesLookupNewsStoryMonth == '6MonthsAgo') {
					$lastmonthtime = mktime(0, 0, 0, date('m')-6, date('d'), date('Y'));
					$newpassarray['NewsStoryMonth'] = date('F', $lastmonthtime);
					$newpassarray['NewsStoryYear'] = date('Y', $lastmonthtime);
					
				} else if ($this->NewsStoriesLookupNewsStoryMonth == '7MonthsAgo') {
					$lastmonthtime = mktime(0, 0, 0, date('m')-7, date('d'), date('Y'));
					$newpassarray['NewsStoryMonth'] = date('F', $lastmonthtime);
					$newpassarray['NewsStoryYear'] = date('Y', $lastmonthtime);
					
				} else if ($this->NewsStoriesLookupNewsStoryMonth == '8MonthsAgo') {
					$lastmonthtime = mktime(0, 0, 0, date('m')-8, date('d'), date('Y'));
					$newpassarray['NewsStoryMonth'] = date('F', $lastmonthtime);
					$newpassarray['NewsStoryYear'] = date('Y', $lastmonthtime);
					
				} else if ($this->NewsStoriesLookupNewsStoryMonth == '9MonthsAgo') {
					$lastmonthtime = mktime(0, 0, 0, date('m')-9, date('d'), date('Y'));
					$newpassarray['NewsStoryMonth'] = date('F', $lastmonthtime);
					$newpassarray['NewsStoryYear'] = date('Y', $lastmonthtime);
					
				} else if ($this->NewsStoriesLookupNewsStoryMonth == '10MonthsAgo') {
					$lastmonthtime = mktime(0, 0, 0, date('m')-10, date('d'), date('Y'));
					$newpassarray['NewsStoryMonth'] = date('F', $lastmonthtime);
					$newpassarray['NewsStoryYear'] = date('Y', $lastmonthtime);
					
				} else if ($this->NewsStoriesLookupNewsStoryMonth == '11MonthsAgo') {
					$lastmonthtime = mktime(0, 0, 0, date('m')-11, date('d'), date('Y'));
					$newpassarray['NewsStoryMonth'] = date('F', $lastmonthtime);
					$newpassarray['NewsStoryYear'] = date('Y', $lastmonthtime);
					
				} else if ($this->NewsStoriesLookupNewsStoryMonth == '1YearAgo') {
					$lastmonthtime = mktime(0, 0, 0, date('m')-12, date('d'), date('Y'));
					$newpassarray['NewsStoryMonth'] = date('F', $lastmonthtime);
					$newpassarray['NewsStoryYear'] = date('Y', $lastmonthtime);
					
				} else if ($this->NewsStoriesLookupNewsStoryMonth == 'Last30Days') {
					$newpassarray['NewsStoryMonth'] = date('F');
					$newpassarray['NewsStoryYear'] = date('Y');
					
				} else if ($this->NewsStoriesLookupNewsStoryMonth == 'Last60Days') {
					$newpassarray['NewsStoryMonth'] = date('F');
					$newpassarray['NewsStoryYear'] = date('Y');
					
				} else if ($this->NewsStoriesLookupNewsStoryMonth == 'Last90Days') {
					$newpassarray['NewsStoryMonth'] = date('F');
					$newpassarray['NewsStoryYear'] = date('Y');
					
				} else if ($this->NewsStoriesLookupNewsStoryMonth == 'Last120Days') {
					$newpassarray['NewsStoryMonth'] = date('F');
					$newpassarray['NewsStoryYear'] = date('Y');
					
				} else {
					$newpassarray['NewsStoryMonth'] = $this->NewsStoriesLookupNewsStoryMonth;
				}
			}
			
			$newpassarray['Enable/Disable'] = 'Enable';
			$newpassarray['Status'] = 'Approved';
			
			$this->LayerModule->Connect($this->NewsStoriesDatesTableName);
			
			$this->LayerModule->pass ($this->NewsStoriesDatesTableName, 'setDatabaseRow', array('idnumber' => $newpassarray));
			$this->NewsStoriesDatesTable = $this->LayerModule->pass ($this->NewsStoriesDatesTableName, 'getMultiRowField', array());
			$this->NewsStoriesDatesTable = array_reverse($this->NewsStoriesDatesTable);
			$this->LayerModule->Disconnect($this->NewsStoriesDatesTableName);
			if ($this->NewsStoriesLookupNewsStoryMonth == 'Last30Days') {
				$this->buildLastDays(2, 30);
			} else if ($this->NewsStoriesLookupNewsStoryMonth == 'Last60Days') {
				$this->buildLastDays(3, 60);
			} else if ($this->NewsStoriesLookupNewsStoryMonth == 'Last90Days') {
				$this->buildLastDays(4, 90);
			} else if ($this->NewsStoriesLookupNewsStoryMonth == 'Last120Days') {
				$this->buildLastDays(5, 120);
			} 
			
			while (current($this->NewsStoriesDatesTable)) {
				$passarray = array();
				$passarray['PageID'] = $this->NewsStoriesDatesTable[key($this->NewsStoriesDatesTable)]['PageID'];
				if ($_GET['NewsRevisionID']) {
					$passarray['RevisionID'] = $_GET['NewsRevisionID'];
				} else {
					$passarray['CurrentVersion'] = $this->CurrentVersion;
				}
				//$passarray['ObjectID'] = $this->NewsStoriesDatesTable[key($this->NewsStoriesDatesTable)]['ObjectID'];
				$this->LayerModule->Connect($this->NewsStoriesTableName);
				
				$this->LayerModule->pass ($this->NewsStoriesTableName, 'setDatabaseRow', array('idnumber' => $passarray));
				$this->LayerModule->Disconnect($this->NewsStoriesTableName);
				array_push($this->NewsStoriesTable, $this->LayerModule->pass ($this->NewsStoriesTableName, 'getMultiRowField', array()));
				
				next($this->NewsStoriesDatesTable);
				
			}
			reset($this->NewsStoriesTable);
		}
	}
	
	protected function buildLastDays($MonthNumber, $Days) {
		$i = 1;
		while ($i < $MonthNumber) {
			$lastmonthtime = mktime(0, 0, 0, date('m')-$i, date('d'), date('Y'));
			$newpassarray['NewsStoryMonth'] = date('F', $lastmonthtime);
			$newpassarray['NewsStoryYear'] = date('Y', $lastmonthtime);
			$newpassarray['CurrentVersion'] = $this->CurrentVersion;
			$this->LayerModule->Connect($this->NewsStoriesDatesTableName);
			$this->LayerModule->pass ($this->NewsStoriesDatesTableName, 'setDatabaseRow', array('idnumber' => $newpassarray));
			$this->LayerModule->Disconnect($this->NewsStoriesDatesTableName);
			
			$hold = $this->LayerModule->pass ($this->NewsStoriesDatesTableName, 'getMultiRowField', array());
			$hold = array_reverse($hold);
			if ($this->NewsStoriesDatesTable[0] == NULL) {
				$this->NewsStoriesDatesTable = $hold;
			} else {
				$this->NewsStoriesDatesTable = array_merge($this->NewsStoriesDatesTable, $hold);
			}
			$i++;
		}
		$lastmonthtime = mktime(0, 0, 0, date('m'), date('d')-$Days, date('Y'));
		$earlydate = date('j', $lastmonthtime);
		$earlymonth = date('F', $lastmonthtime);
		$earlyyear = date('Y', $lastmonthtime);
		
		$i = 0;
		while ($this->NewsStoriesDatesTable[$i]) {
			if ($this->NewsStoriesDatesTable[$i]['NewsStoryYear'] == $earlyyear) {
				if ($this->NewsStoriesDatesTable[$i]['NewsStoryMonth'] == $earlymonth) {
					if ($this->NewsStoriesDatesTable[$i]['NewsStoryDay'] <= $earlydate) {
						unset($this->NewsStoriesDatesTable[$i]);
					}
				}
			}
			$i++;
		}
		$this->NewsStoriesDatesTable = array_merge($this->NewsStoriesDatesTable);
		reset($this->NewsStoriesDatesTable);
	}
	
	protected function buildObject($PageID, $ObjectID, $ContainerObjectType, $ContainerObjectTypeName, $print) {
		$modulesidnumber = Array();
		$modulesidnumber['PageID'] = $PageID;
		if ($this->CurrentVersion) {
			$modulesidnumber['CurrentVersion'] = $this->CurrentVersion;
			
		} else {
			$temp = $this->getNewsStoryVersionRow($modulesidnumber);
			$temp = array_reverse($temp);
			$modulesidnumber['RevisionID'] = $temp[0]['RevisionID'];
			
		}
		
		$modulesidnumber['ObjectID'] = $ObjectID;
		$modulesidnumber['PrintPreview'] = $this->PrintPreview;
		
		$ContentLayerTableArray = Array();
		$ContentLayerTableArray['ObjectType'] = $ContainerObjectType;
		$ContentLayerTableArray['ObjectTypeName'] = $ContainerObjectTypeName;
		
		$this->LayerModule->setDatabaseAll ($this->Hostname, $this->User, $this->Password, $this->DatabaseName);
		$this->LayerModule->setDatabaseTable ($this->ContentLayerTablesName);
		$this->LayerModule->Connect($this->ContentLayerTablesName);
		
		$this->LayerModule->pass ($this->ContentLayerTablesName, 'setDatabaseRow', array('idnumber' => $ContentLayerTableArray));
		$this->LayerModule->Disconnect($this->ContentLayerTablesName);
		
		$hold = 'DatabaseTable';
		$i = 1;
		$databasetablename = Array();
		$hold .= $i;
		
		while ($this->LayerModule->pass ($this->ContentLayerTablesName, 'getRowField', array('rowfield' => $hold))) {
			array_push($databasetablename, $this->LayerModule->pass ($this->ContentLayerTablesName, 'getRowField', array('rowfield' => $hold)));
			$i++;
			$hold = 'DatabaseTable';
			$hold .= $i;
		}
			
		$modulesdatabase = Array();
		while (current($databasetablename)) {
			$modulesdatabase[current($databasetablename)] = current($databasetablename);
			next($databasetablename);
		}
		$temp = &$GLOBALS['Tier6Databases'];
		$module = &$temp->getModules($ContainerObjectType, $ContainerObjectTypeName);
		reset($databasetablename);

		$module->setDatabaseAll ($this->Hostname, $this->User, $this->Password, $this->DatabaseName, current($databasetablename));
		$module->setHttpUserAgent($this->HttpUserAgent);
		$module->FetchDatabase($modulesidnumber);
		$module->CreateOutput('    ');
		
		if ($print == TRUE) {
			if ($module->getOutput()) {
				$this->Writer->writeRaw("\t");
				$this->Writer->writeRaw($module->getOutput());
				$this->Writer->writeRaw("\n");
			}
		} else {
			return $module;
		}
	}
	
	protected function buildOutput ($Space) {
		$this->Space = $Space;
		if ($this->EnableDisable == 'Enable' & $this->Status == 'Approved' & (($this->PrintPreview & $this->ContainerObjectPrintPreview == 'true') | !$this->PrintPreview)) {
			if ($this->StartTag){
				$this->StartTag = str_replace('<','', $this->StartTag);
				$this->StartTag = str_replace('>','', $this->StartTag);
				$this->Writer->writeRaw("\n");
				$this->Writer->startElement($this->StartTag);
					$this->ProcessStandardAttribute('StartTag');
			}
			
			if ($this->HeadingStartTag){
				$this->HeadingStartTag = str_replace('<','', $this->HeadingStartTag);
				$this->HeadingStartTag = str_replace('>','', $this->HeadingStartTag);
				$this->Writer->startElement($this->HeadingStartTag);
					$this->ProcessStandardAttribute('HeadingStartTag');
					$this->Writer->writeRaw($this->Heading);
			}
			
			if ($this->HeadingEndTag) {
				$this->Writer->endElement();
			}
			
			if ($this->ContentStartTag == '<p>'){
				$this->ContentStartTag = str_replace('<','', $this->ContentStartTag);
				$this->ContentStartTag = str_replace('>','', $this->ContentStartTag);
				
				$this->Writer->writeRaw(" ");
				$this->Writer->startElement($this->ContentStartTag);
					$this->ProcessStandardAttribute('ContentStartTag');
					$this->Content = trim($this->Content);
					if (strpos($this->Content, "\n\r") | strpos($this->Content, "\n\n") ) {
						if (strpos($this->Content, "\n\n")) {
							$this->Content = explode("\n\n", $this->Content);
						} else {
							$this->Content = explode("\n\r", $this->Content);
						}
						$i = 0;
						$count = count($this->Content);
						$count--;
						while (current($this->Content)) {
							$this->Content[key($this->Content)] = trim(current($this->Content));
							$this->Content[key($this->Content)] = $this->CreateWordWrap(current($this->Content));
							$this->Writer->writeRaw("\n\t");
							$this->Writer->writeRaw(current($this->Content));
							$this->Writer->writeRaw("\n  ");
							$this->Writer->endElement();
							next($this->Content);
							if (current($this->Content)) {
								$this->ContentEndTag = NULL;
								$this->Writer->writeRaw("  ");
								$this->Writer->startElement('p');
								$this->ProcessStandardAttribute('ContentPTag');
							}
							$i++;
						}
					} else {
						$this->Content = $this->CreateWordWrap($this->Content, "\t  ");
						$this->Content .= "\n  ";
						$this->Writer->writeRaw("\n\t  ");
						$this->Writer->writeRaw($this->Content);
					}
			} else if ($this->ContentStartTag){
				$this->ContentStartTag = str_replace('<','', $this->ContentStartTag);
				$this->ContentStartTag = str_replace('>','', $this->ContentStartTag);
				$this->Writer->startElement($this->ContentStartTag);
					$this->ProcessStandardAttribute('ContentStartTag');
					
				$this->Content = trim($this->Content);
				if (strpos($this->Content, "\n\r")) {
					$this->Content = explode("\n\r", $this->Content);
					
					while (current($this->Content)) {
						$this->Writer->startElement('p');
							$this->ProcessStandardAttribute('ContentPTag');
							$this->Writer->writeRaw("\n    ");
							$this->Writer->writeRaw(current($this->Content));
							$this->Writer->writeRaw("\n  ");
						$this->Writer->endElement();
						next($this->Content);
					}
				} else {
					
					$this->Writer->startElement('p');
					$this->ProcessStandardAttribute('ContentPTag');
					$this->Writer->writeRaw("\n    ");
					$this->Writer->writeRaw($this->Content);
					$this->Writer->writeRaw("\n  ");
					$this->Writer->endElement();
				}
			}
			
			if ($this->ContentEndTag) {
				$this->Writer->writeRaw("      ");
				$this->Writer->endElement();
			}
			
			if ($this->EndTag) {
				$this->Writer->writeRaw("   ");
				$this->Writer->endElement();
			}
		}
	}
	
	protected function buildObjectType() {
		if ($this->ContainerObjectType && $this->EnableDisable == 'Enable' && $this->Status == 'Approved') {
			$temp = $this->ObjectID;
			$temp++;
			if ($this->ContainerObjectType) {
				$containertype = $this->ContainerObjectType;
				
				if ($containertype ==  'XhtmlNewsStories') {
					if ($this->ContainerObjectID) {
						if ($this->ContainerObjectPrintPreview == 'true' | ($this->ContainerObjectPrintPreview == 'false' && !$this->PrintPreview)) {
							$this->buildOutput($this->Space);
						}
					}
				} else if ($containertype == 'XhtmlMenu') {
					if (($this->PrintPreview & $this->ContainerObjectPrintPreview) | !$this->PrintPreview) {
						$filename = 'Configuration/Tier6-ContentLayer/' . $this->ContainerObjectTypeName .'.php';
						require($filename);
						$hold = bottompanel1();
						$this->Writer->writeRaw($hold);
						$this->Writer->writeRaw("\n");
					}
				} else {
					if (!is_null($this->ContainerObjectID) | $this->ContainerObjectID == 0) {
						if ($this->ContainerObjectPrintPreview == 'true' | ($this->ContainerObjectPrintPreview == 'false' && !$this->PrintPreview)) {
							$this->buildObject($this->PageID, $this->ContainerObjectID, $this->ContainerObjectType, $this->ContainerObjectTypeName, TRUE);
						}
					}
				}
			}
			$temp++;
		}
	}
	
	public function CreateOutput($space) {
		$arguments = func_get_args();
		$NoPrintPreview = $arguments[1];
		
		if ($NoPrintPreview) {
			$PrintPreview = TRUE;
		} else if ($this->PrintPreview){
			$PrintPreview = $this->PrintPreview;
		} else {
			$PrintPreview = TRUE;
		}
		
		while (current($this->NewsStoriesTable)) {
			$i = 0;
			while ($this->NewsStoriesTable[key($this->NewsStoriesTable)][$i]) {
				$this->PageID = $this->NewsStoriesTable[key($this->NewsStoriesTable)][$i]['PageID'];
				$this->ObjectID = $this->NewsStoriesTable[key($this->NewsStoriesTable)][$i]['ObjectID'];
				
				$this->ContainerObjectType = $this->NewsStoriesTable[key($this->NewsStoriesTable)][$i]['ContainerObjectType'];
	   			$this->ContainerObjectTypeName = $this->NewsStoriesTable[key($this->NewsStoriesTable)][$i]['ContainerObjectTypeName'];
				$this->ContainerObjectID = $this->NewsStoriesTable[key($this->NewsStoriesTable)][$i]['ContainerObjectID'];
				$this->ContainerObjectPrintPreview = $this->NewsStoriesTable[key($this->NewsStoriesTable)][$i]['ContainerObjectPrintPreview'];
	   			$this->Empty = $this->NewsStoriesTable[key($this->NewsStoriesTable)][$i]['Empty'];
				
				$this->StartTag = $this->NewsStoriesTable[key($this->NewsStoriesTable)][$i]['StartTag'];
				$this->EndTag = $this->NewsStoriesTable[key($this->NewsStoriesTable)][$i]['EndTag'];
				$this->StartTagID = $this->NewsStoriesTable[key($this->NewsStoriesTable)][$i]['StartTagID'];
				$this->StartTagStyle = $this->NewsStoriesTable[key($this->NewsStoriesTable)][$i]['StartTagStyle'];
				$this->StartTagClass = $this->NewsStoriesTable[key($this->NewsStoriesTable)][$i]['StartTagClass'];
				
				$this->Heading = $this->NewsStoriesTable[key($this->NewsStoriesTable)][$i]['Heading'];
				$this->HeadingStartTag = $this->NewsStoriesTable[key($this->NewsStoriesTable)][$i]['HeadingStartTag'];
				$this->HeadingEndTag = $this->NewsStoriesTable[key($this->NewsStoriesTable)][$i]['HeadingEndTag'];
				$this->HeadingStartTagID = $this->NewsStoriesTable[key($this->NewsStoriesTable)][$i]['HeadingStartTagID'];
				$this->HeadingStartTagClass = $this->NewsStoriesTable[key($this->NewsStoriesTable)][$i]['HeadingStartTagClass'];
				$this->HeadingStartTagStyle = $this->NewsStoriesTable[key($this->NewsStoriesTable)][$i]['HeadingStartTagStyle'];
				
				$this->Content = $this->NewsStoriesTable[key($this->NewsStoriesTable)][$i]['Content'];
				$this->ContentStartTag = $this->NewsStoriesTable[key($this->NewsStoriesTable)][$i]['ContentStartTag'];
				$this->ContentEndTag = $this->NewsStoriesTable[key($this->NewsStoriesTable)][$i]['ContentEndTag'];
				$this->ContentStartTagID = $this->NewsStoriesTable[key($this->NewsStoriesTable)][$i]['ContentStartTagID'];
				$this->ContentStartTagClass = $this->NewsStoriesTable[key($this->NewsStoriesTable)][$i]['ContentStartTagClass'];
				$this->ContentStartTagStyle = $this->NewsStoriesTable[key($this->NewsStoriesTable)][$i]['ContentStartTagStyle'];
				
				$this->ContentPTagID = $this->NewsStoriesTable[key($this->NewsStoriesTable)][$i]['ContentPTagID'];
				$this->ContentPTagClass = $this->NewsStoriesTable[key($this->NewsStoriesTable)][$i]['ContentPTagClass'];
				$this->ContentPTagStyle = $this->NewsStoriesTable[key($this->NewsStoriesTable)][$i]['ContentPTagStyle'];
				
				$this->EnableDisable = $this->NewsStoriesTable[key($this->NewsStoriesTable)][$i]['Enable/Disable'];
				$this->Status = $this->NewsStoriesTable[key($this->NewsStoriesTable)][$i]['Status'];
				
				$this->buildObjectType();
				$i++;
				
			}
			next($this->NewsStoriesTable);
			if (current($this->NewsStoriesTable)) {
				$this->Writer->writeRaw("\n");
			}
			
		}
		
		if ($this->FileName) {
			$this->Writer->flush();
		}
	}
	
	public function getLastNewsPageID() {
		$this->LayerModule->Connect($this->NewsStoriesDatesTableName);
		$this->LayerModule->pass ($this->NewsStoriesDatesTableName, 'setEntireTable', array());
		$this->LayerModule->Disconnect($this->NewsStoriesDatesTableName);
		
		$hold = $this->LayerModule->pass ($this->NewsStoriesDatesTableName, 'getEntireTable', array());
		$count = count($hold);
		$hold2 = $hold[$count]['PageID'];
		return $hold2;
	}
	
	public function getNewsStoryVersionRow($PageID) {
		$this->LayerModule->Connect($this->NewsStoriesVersionTableName);
		$this->LayerModule->pass ($this->NewsStoriesVersionTableName, 'setDatabaseRow', array('idnumber' => $PageID));
		$this->LayerModule->Disconnect($this->NewsStoriesVersionTableName);
		
		$hold = $this->LayerModule->pass ($this->NewsStoriesVersionTableName, 'getMultiRowField', array());
		return $hold;
	}
	
	public function createNewsStory(array $NewsStory) {
		if ($NewsStory != NULL) {
			$Keys = array();
			$Keys[0] = 'PageID';
			$Keys[1] = 'ObjectID';
			$Keys[2] = 'ContainerObjectType';
			$Keys[3] = 'ContainerObjectTypeName';
			$Keys[4] = 'ContainerObjectID';
			$Keys[5] = 'ContainerObjectPrintPreview';
			$Keys[6] = 'RevisionID';
			$Keys[7] = 'CurrentVersion';
			$Keys[8] = 'Empty';
			$Keys[9] = 'StartTag';
			$Keys[10] = 'EndTag';
			$Keys[11] = 'StartTagID';
			$Keys[12] = 'StartTagStyle';
			$Keys[13] = 'StartTagClass';
			$Keys[14] = 'Heading';
			$Keys[15] = 'HeadingStartTag';
			$Keys[16] = 'HeadingEndTag';
			$Keys[17] = 'HeadingStartTagID';
			$Keys[18] = 'HeadingStartTagStyle';
			$Keys[19] = 'HeadingStartTagClass';
			$Keys[20] = 'Content';
			$Keys[21] = 'ContentStartTag';
			$Keys[22] = 'ContentEndTag';
			$Keys[23] = 'ContentStartTagID';
			$Keys[24] = 'ContentStartTagStyle';
			$Keys[25] = 'ContentStartTagClass';
			$Keys[26] = 'Enable/Disable';
			$Keys[27] = 'Status';
			
			$this->addModuleContent($Keys, $NewsStory, $this->NewsStoriesTableName);
		} else {
			array_push($this->ErrorMessage,'createNewsStory: News Story cannot be NULL!');
		}
	}
	
	public function updateNewsStory(array $PageID) {
		if ($PageID != NULL) {
			$this->updateModuleContent($PageID, $this->NewsStoriesTableName);
		} else {
			array_push($this->ErrorMessage,'updateNewsStory: PageID cannot be NULL!');
		}
	}
	
	public function updateNewsStoryStatus(array $PageID) {
		if ($PageID != NULL) {
			$PassID = array();
			$PassID['PageID'] = $PageID['PageID'];
			
			if ($PageID['EnableDisable'] == 'Enable') {
				$this->enableModuleContent($PassID, $this->NewsStoriesTableName);
			} else if ($PageID['EnableDisable'] == 'Disable') {
				$this->disableModuleContent($PassID, $this->NewsStoriesTableName);
			}
			
			if ($PageID['Status'] == 'Approved') {
				$this->approvedModuleContent($PassID, $this->NewsStoriesTableName);
			} else if ($PageID['Status'] == 'Not-Approved') {
				$this->notApprovedModuleContent($PassID, $this->NewsStoriesTableName);
			} else if ($PageID['Status'] == 'Pending') {
				$this->pendingModuleContent($PassID, $this->NewsStoriesTableName);
			} else if ($PageID['Status'] == 'Spam') {
				$this->spamModuleContent($PassID, $this->NewsStoriesTableName);
			}
		} else {
			array_push($this->ErrorMessage,'updateNewsStoryStatus: PageID cannot be NULL!');
		}
	}
	
	public function deleteNewsStory(array $PageID) {
		if ($PageID != NULL) {
			$this->deleteModuleContent($PageID, $this->NewsStoriesTableName);
		} else {
			array_push($this->ErrorMessage,'deleteNewsStory: PageID cannot be NULL!');
		}
	}
	
	public function createNewsStoryDate(array $NewsStory) {
		if ($NewsStory != NULL) {
			$Keys = array();
			$Keys[0] = 'PageID';
			$Keys[1] = 'ObjectID';
			$Keys[2] = 'RevisionID';
			$Keys[3] = 'CurrentVersion';
			$Keys[4] = 'NewsStoryDay';
			$Keys[5] = 'NewsStoryMonth';
			$Keys[6] = 'NewsStoryYear';
			$Keys[7] = 'Enable/Disable';
			$Keys[8] = 'Status';
			
			$this->addModuleContent($Keys, $NewsStory, $this->NewsStoriesDatesTableName);
		} else {
			array_push($this->ErrorMessage,'createNewsStoryDate: News Story Date cannot be NULL!');
		}
	}
	
	public function updateNewsStoryDate(array $PageID) {
		if ($PageID != NULL) {
			$this->updateModuleContent($PageID, $this->NewsStoriesDatesTableName);
		} else {
			array_push($this->ErrorMessage,'updateNewsStoryDate: PageID cannot be NULL!');
		}
	}
	
	public function updateNewsStoryDateStatus(array $PageID) {
		if ($PageID != NULL) {
			$PassID = array();
			$PassID['PageID'] = $PageID['PageID'];
			
			if ($PageID['EnableDisable'] == 'Enable') {
				$this->enableModuleContent($PassID, $this->NewsStoriesDatesTableName);
			} else if ($PageID['EnableDisable'] == 'Disable') {
				$this->disableModuleContent($PassID, $this->NewsStoriesDatesTableName);
			}
			
			if ($PageID['Status'] == 'Approved') {
				$this->approvedModuleContent($PassID, $this->NewsStoriesDatesTableName);
			} else if ($PageID['Status'] == 'Not-Approved') {
				$this->notApprovedModuleContent($PassID, $this->NewsStoriesDatesTableName);
			} else if ($PageID['Status'] == 'Pending') {
				$this->pendingModuleContent($PassID, $this->NewsStoriesDatesTableName);
			} else if ($PageID['Status'] == 'Spam') {
				$this->spamModuleContent($PassID, $this->NewsStoriesDatesTableName);
			}
		} else {
			array_push($this->ErrorMessage,'updateNewsStoryDateStatus: PageID cannot be NULL!');
		}
	}
	
	public function deleteNewsStoryDate(array $PageID) {
		if ($PageID != NULL) {
			$this->deleteModuleContent($PageID, $this->NewsStoriesDatesTableName);
		} else {
			array_push($this->ErrorMessage,'deleteNewsStoryDate: PageID cannot be NULL!');
		}
	}
	
	public function createNewsStoryVersion(array $NewsStory) {
		if ($NewsStory != NULL) {
			$Keys = array();
			$Keys[0] = 'PageID';
			$Keys[1] = 'RevisionID';
			$Keys[2] = 'CurrentVersion';
			$Keys[3] = 'XMLItem';
			$Keys[4] = 'UserAccessGroup';
			$Keys[5] = 'Owner';
			$Keys[6] = 'LastChangeUser';
			$Keys[7] = 'CreationDateTime';
			$Keys[8] = 'LastChangeDateTime';
			
			$this->addModuleContent($Keys, $NewsStory, $this->NewsStoriesVersionTableName);
		} else {
			array_push($this->ErrorMessage,'createNewsStoryVersion: News Story Version cannot be NULL!');
		}
	}
	
	public function updateNewsStoryVersion(array $PageID) {
		if ($PageID != NULL) {
			$this->updateModuleContent($PageID, $this->NewsStoriesVersionTableName);
		} else {
			array_push($this->ErrorMessage,'updateNewsStoryVersion: PageID cannot be NULL!');
		}
	}
	
	public function updateNewsStoryVersionStatus(array $PageID) {
		if ($PageID != NULL) {
			$PassID = array();
			$PassID['PageID'] = $PageID['PageID'];
			
			if ($PageID['EnableDisable'] == 'Enable') {
				$this->enableModuleContent($PassID, $this->NewsStoriesVersionTableName);
			} else if ($PageID['EnableDisable'] == 'Disable') {
				$this->disableModuleContent($PassID, $this->NewsStoriesVersionTableName);
			}
			
			if ($PageID['Status'] == 'Approved') {
				$this->approvedModuleContent($PassID, $this->NewsStoriesVersionTableName);
			} else if ($PageID['Status'] == 'Not-Approved') {
				$this->notApprovedModuleContent($PassID, $this->NewsStoriesVersionTableName);
			} else if ($PageID['Status'] == 'Pending') {
				$this->pendingModuleContent($PassID, $this->NewsStoriesVersionTableName);
			} else if ($PageID['Status'] == 'Spam') {
				$this->spamModuleContent($PassID, $this->NewsStoriesVersionTableName);
			}
		} else {
			array_push($this->ErrorMessage,'updateNewsStoryVersionStatus: PageID cannot be NULL!');
		}
	}
	
	public function deleteNewsStoryVersion(array $PageID) {
		if ($PageID != NULL) {
			$this->deleteModuleContent($PageID, $this->NewsStoriesVersionTableName);
		} else {
			array_push($this->ErrorMessage,'deleteNewsStoryVersion: PageID cannot be NULL!');
		}
	}
	
	public function createNewsStoryLookup(array $NewsStory) {
		if ($NewsStory != NULL) {
			$Keys = array();
			$Keys[0] = 'PageID';
			$Keys[1] = 'ObjectID';
			$Keys[2] = 'NewsStoryPageID';
			$Keys[3] = 'NewsStoryDay';
			$Keys[4] = 'NewsStoryMonth';
			$Keys[5] = 'NewsStoryYear';
			$Keys[6] = 'Enable/Disable';
			$Keys[7] = 'Status';
			
			$this->addModuleContent($Keys, $NewsStory, $this->NewsStoriesLookupTableName);
		} else {
			array_push($this->ErrorMessage,'createNewsStoryLookup: News Story Version cannot be NULL!');
		}
	}
	
	public function updateNewsStoryLookup(array $PageID) {
		if ($PageID != NULL) {
			$this->updateRecord($PageID['PageID'], $PageID['Content'], $this->NewsStoriesLookupTableName);
		} else {
			array_push($this->ErrorMessage,'updateNewsStoryLookup: PageID cannot be NULL!');
		}
	}
	
	public function updateNewsStoryLookupStatus(array $PageID) {
		if ($PageID != NULL) {
			$PassID = array();
			$PassID['PageID'] = $PageID['PageID'];
			$PassID['ObjectID'] = $PageID['ObjectID'];
			
			if ($PageID['EnableDisable'] == 'Enable') {
				$this->enableModuleContent($PassID, $this->NewsStoriesLookupTableName);
			} else if ($PageID['EnableDisable'] == 'Disable') {
				$this->disableModuleContent($PassID, $this->NewsStoriesLookupTableName);
			}
			
			if ($PageID['Status'] == 'Approved') {
				$this->approvedModuleContent($PassID, $this->NewsStoriesLookupTableName);
			} else if ($PageID['Status'] == 'Not-Approved') {
				$this->notApprovedModuleContent($PassID, $this->NewsStoriesLookupTableName);
			} else if ($PageID['Status'] == 'Pending') {
				$this->pendingModuleContent($PassID, $this->NewsStoriesLookupTableName);
			} else if ($PageID['Status'] == 'Spam') {
				$this->spamModuleContent($PassID, $this->NewsStoriesLookupTableName);
			}
		} else {
			array_push($this->ErrorMessage,'updateNewsStoryLookup: PageID cannot be NULL!');
		}
	}
	
	public function deleteNewsStoryLookup(array $PageID) {
		if ($PageID != NULL) {
			$this->deleteModuleContent($PageID, $this->NewsStoriesLookupTableName);
		} else {
			array_push($this->ErrorMessage,'deleteNewsStoryLookup: PageID cannot be NULL!');
		}
	}
}
?>