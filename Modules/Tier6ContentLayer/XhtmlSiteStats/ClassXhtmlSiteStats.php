<?php

/* Class Xhtml Site Stats
 * 
 * Class XhtmlSiteStats is designed to keep track of the sites stats including page hits and other stat information
 * about each page
 *
 * @author Travis Napolean Smith
 * @copyright Copyright (c) 1999 - 2011 One Solution CMS
 * @copyright PHP - Copyright (c) 2005 - 2011 One Solution CMS
 * @copyright C++ - Copyright (c) 1999 - 2005 One Solution CMS
 * @version PHP - 2.0
 * @version C++ - Unknown
 */ 
 
class XhtmlSiteStats extends Tier6ContentLayerModulesAbstract implements Tier6ContentLayerModules {
	/*
	 * Current Page Count - retrieved from the database table. The name of the database table is set 
	 * in ContentLayerModule Table under XhtmlSiteStats - DatabaseTable1.
	 * 
	 * @var string
	 */
	protected $Count;
	
	/*
	 * Class Name - retrieved from the ContentLayerModulesSettings table. The setting is from XhtmlSiteStats 
	 * Class Settings.
	 * 
	 * @var string
	 */
	protected $Class;
	/*
	 * ID Name - retrieved from the ContentLayerModulesSettings table. The setting is from XhtmlSiteStats 
	 * ID Settings.
	 * 
	 * @var string
	 */
	protected $ID;
	/*
	 * Style Name - retrieved from the ContentLayerModulesSettings table. The setting is from XhtmlSiteStats 
	 * Style Settings.
	 * 
	 * @var string
	 */
	protected $Style;
	
	/*
	 * Begin Message - retrieved from the ContentLayerModulesSettings table. The setting is from XhtmlSiteStats 
	 * BeginMessage Settings.  Used for setting a message before the counter is displayed.
	 * 
	 * @var string
	 */
	protected $BeginMessage;
	/*
	 * End Message - retrieved from the ContentLayerModulesSettings table. The setting is from XhtmlSiteStats 
	 * EndMessage Settings. Used for setting a message after the counter is displayed.
	 * 
	 * @var string
	 */
	protected $EndMessage;
	
	/*
	 * Start Tag - retrieved from the ContentLayerModulesSettings table. The setting is from XhtmlSiteStats 
	 * StartTag Settings. Used for setting what tag you want to for the counter to be displayed.
	 * 
	 * @var string
	 */
	protected $StartTag;
	/*
	 * No Output - retrieved from the ContentLayerModulesSettings table. The setting is from XhtmlSiteStats 
	 * NoOutput Settings. Used to turn on or off the output.  FALSE is for output to be displayed. TRUE is
	 * for output not to be displayed.
	 * 
	 * @var bool
	 */
	protected $NoOutput;
	
	/* Constructor for XhtmlSiteStats
	 * 
	 * Sets the tablesnames, databaseoptions and layermodule for XhtmlSiteStats.
	 * 
	 * @param array $tablenames = Array of all the tables needed
	 * @param array $databaseoptions = Array of all the database options
	 * @param ValidationLayer $layermodule = Tier 5 Validation Layer to use
	 * 
	 */
	public function __construct(array $tablenames, array $databaseoptions, $layermodule) {
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
	
	/* setDatabaseAll
	 * 
	 * Sets the hostname, user, password, databasename and databasetable for XhtmlSiteStats.
	 * 
	 * @param string $hostname = Database Host Name
	 * @param string $user = Database User
	 * @param string $password = Database User's Password
	 * @param string $databasename = Database Name
	 * @param string $databasetable = Database Table
	 * 
	 */
	public function setDatabaseAll ($hostname, $user, $password, $databasename, $databasetable) {
		$this->Hostname = $hostname;
		$this->User = $user;
		$this->Password = $password;
		$this->DatabaseName = $databasename;
		$this->DatabaseTable = $databasetable;
		
		$this->LayerModule->setDatabaseAll ($hostname, $user, $password, $databasename);
		$this->LayerModule->setDatabasetable ($databasetable);
		
	}
	
	/* FetchDatabase
	 * 
	 * Retrieved the database based on the PageID.
	 * 
	 * @param array $PageID = A Database lookup or key array for the database
	 * 
	 */
	public function FetchDatabase ($PageID) {
		$this->PageID = $PageID['PageID'];
		unset ($PageID['PrintPreview']);
		
		$this->LayerModule->Connect($this->DatabaseTable);
		$passarray = array();
		$passarray = $PageID;
		
		$this->LayerModule->pass ($this->DatabaseTable, 'setDatabaseRow', array('idnumber' => $passarray));
		
		$this->Count = $this->LayerModule->pass ($this->DatabaseTable, 'getRowField', array('rowfield' => 'Count'));
		
		$this->LayerModule->Disconnect($this->DatabaseTable);
	}
	
	/* CreateOutput
	 * 
	 * Creates Output based on what the database entried have in them with space being the indentation of each line.
	 * 
	 * @param string $space = Indentation for each new line
	 * 
	 */
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
				$this->Writer->startElement($this->StartTag);
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
	
	/* checkSiteStatPage
	 * 
	 * Checks to see if the page exists in the Site Stat database table.
	 * 
	 * @return bool TRUE if page exists
	 * @return bool FALSE if page doesn't exists
	 * 
	 */
	public function checkSiteStatPage () {
		if ($this->LayerModule->pass ($this->DatabaseTable, 'getRowField', array('rowfield' => 'PageID'))) {
			return TRUE;
		} else {
			return FALSE;
		}
	}
	
	/* createSiteStatPage
	 * 
	 * Creates a site stat page in the database.
	 * 
	 * @param array $SiteStatPage = An array with the contents of the new site stat page to be created.
	 * 
	 */
	public function createSiteStatPage(array $SiteStatPage) {
		if ($SiteStatPage != NULL) {
			$this->LayerModule->pass ($this->DatabaseTable, 'BuildFieldNames', array('TableName' => $this->DatabaseTable));
			$Keys = $this->LayerModule->pass ($this->DatabaseTable, 'getRowFieldNames', array());
			$this->addModuleContent($Keys, $SiteStatPage, $this->DatabaseTable);
		} else {
			array_push($this->ErrorMessage,'createSiteStatPage: SiteStatPage cannot be NULL!');
		}
	}
	
	/* updateSiteStatPage
	 * 
	 * Updates a site stat page counter and month counter.
	 * 
	 * @param array $PageID = An array with the lookup page id of the site stat page to be updated.
	 * 
	 */
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
	
	/* deleteSiteStatPage
	 * 
	 * Deletes a site stat page from the database.  This is not undoable!
	 * 
	 * @param array $PageID = An array with the lookup page id of the site stat page to be deleted.
	 * 
	 */
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