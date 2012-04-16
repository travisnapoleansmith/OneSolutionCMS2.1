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
	
	/**
	 * Create an instance of XtmlNewsStories
	 *
	 * @param array $TableNames an array of table names to connect to.
	 * @param array $DatabaseOptions an array of option from the database.
	 * @param object $LayerModule a copy of the current layer the module is in - Content Layer
	 * @access public
	*/
	public function __construct(array $TableNames, array $DatabaseOptions, $LayerModule) {
		$this->LayerModule = &$LayerModule;
		
		$hold = current($TableNames);
		$GLOBALS['ErrorMessage']['XhtmlNewsStories'][$hold] = NULL;
		$this->ErrorMessage = &$GLOBALS['ErrorMessage']['XhtmlNewsStories'][$hold];
		$this->ErrorMessage = array();
		
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
		
		if ($DatabaseOptions['NoAttributes']) {
			$this->NoAttributes = $DatabaseOptions['NoAttributes'];
			unset($DatabaseOptions['NoAttributes']);
		}
		
		$this->NewsStoriesTableName = current($TableNames);
		$this->NewsStoriesLookupTableName = next($TableNames);
		$this->NewsStoriesDatesTableName = next($TableNames);
		$this->NewsStoriesVersionTableName = next($TableNames);
		
		$this->ContentLayerTablesName = next($TableNames);
		$this->ContentPrintPreviewTableName = next($TableNames);
		$this->ContentLayerModulesTableName = next($TableNames);
		
		$this->ContentTableName = 'NewsStoriesTable';
		$this->ContentObjectName = 'XhtmlNewsStories';
		$this->VersionRowMethodName = 'getNewsStoryVersionRow';
		
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
			$this->LayerModule->pass ($this->NewsStoriesDatesTableName, 'setOrderbyname', array('orderbyname' => 'PageID`, `NewsStoryDay`, `NewsStoryMonth`, `NewsStoryYear'));
			$this->LayerModule->pass ($this->NewsStoriesDatesTableName, 'setOrderbytype', array('orderbytype' => 'ASC'));
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
			
			$this->sortNewsStories('DSC');
			
			reset($this->NewsStoriesDatesTable);
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
	
	protected function sortNewsStories($ASCDSC) {
		foreach ($this->NewsStoriesDatesTable as $Key => $Value) {
			$DateString = $Value['NewsStoryMonth'] . ' ';
			$DateString .= $Value['NewsStoryDay'] . ', ';
			$DateString .= $Value['NewsStoryYear'];
			$Date = strtotime($DateString);
			$SortArray[$Key] = $Date;
		}
		if (!is_null($SortArray)) {
			if ($ASCDSC == 'DSC') {
				array_multisort($SortArray, SORT_DESC, $this->NewsStoriesDatesTable);
			} else if ($ASCDSC == 'ASC') {
				array_multisort($SortArray, SORT_ASC, $this->NewsStoriesDatesTable);
			}
		}
		unset($SortArray);
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
			$this->LayerModule->pass ($this->NewsStoriesTableName, 'BuildFieldNames', array('TableName' => $this->NewsStoriesTableName));
			$Keys = $this->LayerModule->pass ($this->NewsStoriesTableName, 'getRowFieldNames', array());
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
			$this->LayerModule->pass ($this->NewsStoriesDatesTableName, 'BuildFieldNames', array('TableName' => $this->NewsStoriesDatesTableName));
			$Keys = $this->LayerModule->pass ($this->NewsStoriesDatesTableName, 'getRowFieldNames', array());
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
			$this->LayerModule->pass ($this->NewsStoriesVersionTableName, 'BuildFieldNames', array('TableName' => $this->NewsStoriesVersionTableName));
			$Keys = $this->LayerModule->pass ($this->NewsStoriesVersionTableName, 'getRowFieldNames', array());
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
			$this->LayerModule->pass ($this->NewsStoriesLookupTableName, 'BuildFieldNames', array('TableName' => $this->NewsStoriesLookupTableName));
			$Keys = $this->LayerModule->pass ($this->NewsStoriesLookupTableName, 'getRowFieldNames', array());
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