<?php
/*
**************************************************************************************
* One Solution CMS
*
* Copyright (c) 1999 - 2013 One Solution CMS
* This content management system is free software: you can redistribute it and/or modify
* it under the terms of the GNU General Public License as published by
* the Free Software Foundation, either version 2 of the License, or
* (at your option) any later version.
*
* This content management system is distributed in the hope that it will be useful,
* but WITHOUT ANY WARRANTY; without even the implied warranty of
* MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
* GNU General Public License for more details.
*
* You should have received a copy of the GNU General Public License
* along with this program.  If not, see <http://www.gnu.org/licenses/>.
*
* @copyright  Copyright (c) 1999 - 2013 One Solution CMS (http://www.onesolutioncms.com/)
* @license    http://www.gnu.org/licenses/gpl-2.0.txt
* @version    2.1.141, 2013-01-14
*************************************************************************************
*/

/**
 * Class XhtmlSiteStats
 *
 * Class XhtmlSiteStats is designed to keep track of the sites stats including page hits and other stat information
 * about each page
 *
 * @author Travis Napolean Smith
 * @copyright Copyright (c) 1999 - 2013 One Solution CMS
 * @copyright PHP - Copyright (c) 2005 - 2013 One Solution CMS
 * @copyright C++ - Copyright (c) 1999 - 2005 One Solution CMS
 * @version PHP - 2.1.140
 * @version C++ - Unknown
 */

class XhtmlSiteStats extends Tier6ContentLayerModulesAbstract implements Tier6ContentLayerModules {
	/**
	 * Current Page Count - retrieved from the database table. The name of the database table is set
	 * in ContentLayerModule Table under XhtmlSiteStats - DatabaseTable1.
	 *
	 * @var string
	 */
	protected $Count;
	
	/**
	 * Current Day Page Count - retrieved from the database table. The name of the database table is set
	 * in ContentLayerModule Table under XhtmlSiteStats - DatabaseTable2.
	 *
	 * @var string
	 */
	protected $DayCount;
	
	/**
	 * Current IP Address Page Count - retrieved from the database table. The name of the database table is set
	 * in ContentLayerModule Table under XhtmlSiteStats - DatabaseTable3.
	 *
	 * @var string
	 */
	protected $IPAddressCount;
	
	/**
	 * Current Day IP Address Page Count - retrieved from the database table. The name of the database table is set
	 * in ContentLayerModule Table under XhtmlSiteStats - DatabaseTable4.
	 *
	 * @var string
	 */
	protected $IPAddressDayCount;

	/**
	 * Class Name - retrieved from the ContentLayerModulesSettings table. The setting is from XhtmlSiteStats
	 * Class Settings.
	 *
	 * @var string
	 */
	protected $Class;

	/**
	 * ID Name - retrieved from the ContentLayerModulesSettings table. The setting is from XhtmlSiteStats
	 * ID Settings.
	 *
	 * @var string
	 */
	protected $ID;

	/**
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

	/**
	 * End Message - retrieved from the ContentLayerModulesSettings table. The setting is from XhtmlSiteStats
	 * EndMessage Settings. Used for setting a message after the counter is displayed.
	 *
	 * @var string
	 */
	protected $EndMessage;

	/**
	 * Start Tag - retrieved from the ContentLayerModulesSettings table. The setting is from XhtmlSiteStats
	 * StartTag Settings. Used for setting what tag you want to for the counter to be displayed.
	 *
	 * @var string
	 */
	protected $StartTag;

	/**
	 * No Output - retrieved from the ContentLayerModulesSettings table. The setting is from XhtmlSiteStats
	 * NoOutput Settings. Used to turn on or off the output.  FALSE is for output to be displayed. TRUE is
	 * for output not to be displayed.
	 *
	 * @var bool
	 */
	protected $NoOutput;
	
	/**
	 * Database Table Name for Daily Site Stats.
	 *
	 * @var string
	 */
	protected $DailySiteStatsTableName;
	
	/**
	 * Database Table Name for IP Address Site Stats.
	 *
	 * @var string
	 */
	protected $IPAddressSiteStatsTableName;
	
	/**
	 * Database Table Name for Daily IP Address Site Stats.
	 *
	 * @var string
	 */
	protected $DailyIPAddressSiteStatsTableName;
	
	/**
	 * Database Table Name for Timestamp Log Site Stats.
	 *
	 * @var string
	 */
	protected $TimestampLogSiteStatsTableName;

	/**
	 * Create an instance of XtmlSiteStats
	 *
	 * @param array $TableNames an array of table names to connect to.
	 * @param array $DatabaseOptions an array of option from the database.
	 * @param object $LayerModule a copy of the current layer the module is in - Content Layer
	 * @access public
	*/
	public function __construct(array $TableNames, array $DatabaseOptions, $LayerModule) {
		$this->LayerModule = &$LayerModule;

		$hold = current($TableNames);
		$GLOBALS['ErrorMessage']['XhtmlSiteStats'][$hold] = NULL;
		$this->ErrorMessage = &$GLOBALS['ErrorMessage']['XhtmlSiteStats'][$hold];
		$this->ErrorMessage = array();
		
		if ($TableNames['DatabaseTable2']) {
			$this->DailySiteStatsTableName = $TableNames['DatabaseTable2'];
		}
		
		if ($TableNames['DatabaseTable3']) {
			$this->IPAddressSiteStatsTableName = $TableNames['DatabaseTable3'];
		}
		
		if ($TableNames['DatabaseTable4']) {
			$this->DailyIPAddressSiteStatsTableName = $TableNames['DatabaseTable4'];
		}
		
		if ($TableNames['DatabaseTable5']) {
			$this->TimestampLogSiteStatsTableName = $TableNames['DatabaseTable5'];
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

		if ($DatabaseOptions['Class']) {
			$this->Class = $DatabaseOptions['Class'];
		}

		if ($DatabaseOptions['ID']) {
			$this->ID = $DatabaseOptions['ID'];
		}

		if ($DatabaseOptions['Style']) {
			$this->Style = $DatabaseOptions['Style'];
		}

		if ($DatabaseOptions['BeginMessage']) {
			$this->BeginMessage = $DatabaseOptions['BeginMessage'];
		}

		if ($DatabaseOptions['EndMessage']) {
			$this->EndMessage = $DatabaseOptions['EndMessage'];
		}

		if ($DatabaseOptions['StartTag']) {
			$this->StartTag = $DatabaseOptions['StartTag'];
		}

		if ($DatabaseOptions['NoOutput']) {
			$this->NoOutput = $DatabaseOptions['NoOutput'];
		}
	}

	/**
	 * setDatabaseAll
	 *
	 * Sets the hostname, user, password, databasename and databasetable.
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

	/**
	 * FetchDatabase
	 *
	 * Retrieved the database based on the PageID.
	 *
	 * @param array $PageID = A Database lookup or key array for the database
	 *
	 */
	public function FetchDatabase ($PageID) {
		if ($PageID != NULL) {
			$this->PageID = $PageID['PageID'];
			unset ($PageID['PrintPreview']);
			
			$Args = func_get_args();
			$IPAddressPageID = $Args[1];
			
			$this->LayerModule->Connect($this->DatabaseTable);
			$passarray = array();
			$passarray = $PageID;
	
			$this->LayerModule->pass ($this->DatabaseTable, 'setDatabaseRow', array('idnumber' => $passarray));
	
			$this->Count = $this->LayerModule->pass ($this->DatabaseTable, 'getRowField', array('rowfield' => 'Count'));
	
			$this->LayerModule->Disconnect($this->DatabaseTable);
			
			if ($this->DailySiteStatsTableName != NULL) {
				$this->LayerModule->Connect($this->DailySiteStatsTableName);
				
				$this->LayerModule->pass ($this->DailySiteStatsTableName, 'setDatabaseRow', array('idnumber' => $passarray));
		
				$this->DayCount = $this->LayerModule->pass ($this->DailySiteStatsTableName, 'getRowField', array('rowfield' => 'Count'));
		
				$this->LayerModule->Disconnect($this->DailySiteStatsTableName);
			}
			
			if ($IPAddressPageID != NULL) {
				if ($this->IPAddressSiteStatsTableName != NULL) {
					$this->LayerModule->Connect($this->IPAddressSiteStatsTableName);

					$this->LayerModule->pass ($this->IPAddressSiteStatsTableName, 'setDatabaseRow', array('idnumber' => $IPAddressPageID));
			
					$this->IPAddressCount = $this->LayerModule->pass ($this->IPAddressSiteStatsTableName, 'getRowField', array('rowfield' => 'Count'));
					
					$this->LayerModule->Disconnect($this->IPAddressSiteStatsTableName);
				}
				
				if ($this->DailyIPAddressSiteStatsTableName != NULL) {
					$this->LayerModule->Connect($this->DailyIPAddressSiteStatsTableName);
					
					$this->LayerModule->pass ($this->DailyIPAddressSiteStatsTableName, 'setDatabaseRow', array('idnumber' => $IPAddressPageID));
			
					$this->IPAddressDayCount = $this->LayerModule->pass ($this->DailyIPAddressSiteStatsTableName, 'getRowField', array('rowfield' => 'Count'));
					
					$this->LayerModule->Disconnect($this->DailyIPAddressSiteStatsTableName);
				}
			}
		}
	}

	/**
	 * FetchDatabaseAll
	 *
	 * Retrieved the entire database table.
	 *
	 * @return array Entire Database Table
	 */
	public function FetchDatabaseAll () {
		$Args = func_get_args();
		$DatabaseTable2Use = $Args[0];
		
		if (isset($DatabaseTable2Use)) {
			$this->LayerModule->Connect($this->DailySiteStatsTableName);
	
			$this->LayerModule->pass ($this->DailySiteStatsTableName, 'setEntireTable', array());
			$EntireDatabaseTable = $this->LayerModule->pass ($this->DailySiteStatsTableName, 'getEntireTable', array());
	
			$this->LayerModule->Disconnect($this->DailySiteStatsTableName);
		} else {
			$this->LayerModule->Connect($this->DatabaseTable);
	
			$this->LayerModule->pass ($this->DatabaseTable, 'setEntireTable', array());
			$EntireDatabaseTable = $this->LayerModule->pass ($this->DatabaseTable, 'getEntireTable', array());
	
			$this->LayerModule->Disconnect($this->DatabaseTable);
		}
		
		return $EntireDatabaseTable;
	}

	/**
	 * CreateOutput
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
			if ($this->NoOutput == TRUE) {
				return FALSE;
			} else if ($this->StartTag != NULL) {
				$this->Space = $space;
				$this->Writer->startElement($this->StartTag);
				$this->ProcessStandardAttribute('');

				$this->Writer->text($Message);
				$this->Writer->endElement();
			} else {
				$this->Writer->writeRaw($Message);
			}
		}

		if ($this->FileName) {
			$this->Writer->flush();
		}
	}
	
	/**
	 * checkDailySiteStatsPage
	 *
	 * Checks to see if the page exists in the Daily Site Stat database table.
	 *
	 * @return bool TRUE if page exists
	 * @return bool FALSE if page doesn't exists
	 *
	 */
	public function checkDailySiteStatPage () {
		if ($this->LayerModule->pass ($this->DailySiteStatsTableName, 'getRowField', array('rowfield' => 'PageID'))) {
			return TRUE;
		} else {
			return FALSE;
		}
	}
	
	/**
	 * checkSiteStatPage
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
	
	/**
	 * checkDailyIPAddressSiteStatsPage
	 *
	 * Checks to see if the page exists in the Daily IP Address Site Stat database table.
	 *
	 * @return bool TRUE if page exists
	 * @return bool FALSE if page doesn't exists
	 *
	 */
	public function checkDailyIPAddressSiteStatPage () {
		if ($this->LayerModule->pass ($this->DailyIPAddressSiteStatsTableName, 'getRowField', array('rowfield' => 'PageID'))) {
			return TRUE;
		} else {
			return FALSE;
		}
	}
	
	/**
	 * checkIPAddressSiteStatPage
	 *
	 * Checks to see if the page exists in the IP Address Site Stat database table.
	 *
	 * @return bool TRUE if page exists
	 * @return bool FALSE if page doesn't exists
	 *
	 */
	public function checkIPAddressSiteStatPage () {
		if ($this->LayerModule->pass ($this->IPAddressSiteStatsTableName, 'getRowField', array('rowfield' => 'PageID'))) {
			return TRUE;
		} else {
			return FALSE;
		}
	}

	/**
	 * createTimestampLog
	 *
	 * Creates a timestamp log in the database.
	 *
	 * @param array $SiteStatPage = An array with the contents of the new site stat page to be created.
	 *
	 */
	public function createTimestampLog(array $SiteStatPage) {
		if ($SiteStatPage != NULL) {
			if ($this->TimestampLogSiteStatsTableName != NULL ) {
				$this->LayerModule->pass ($this->TimestampLogSiteStatsTableName, 'BuildFieldNames', array('TableName' => $this->TimestampLogSiteStatsTableName));
				$Keys = $this->LayerModule->pass ($this->TimestampLogSiteStatsTableName, 'getRowFieldNames', array());
				$this->addModuleContent($Keys, $SiteStatPage, $this->TimestampLogSiteStatsTableName);
			} else {
				array_push($this->ErrorMessage,'createTimestampLog: TimestampLogSiteStatsTableName cannot be NULL!');
			}
		} else {
			array_push($this->ErrorMessage,'createTimestampLog: SiteStatPage cannot be NULL!');
		}
	}
	
	/**
	 * createTimestampLogEntry
	 *
	 * Creates a timestamp log in the database.
	 *
	 * @return array $SiteStatPage = An array with the contents of the new site stat page to be created.
	 *
	 */
	public function createTimestampLogEntry() {
		if ($this->TimestampLogSiteStatsTableName != NULL ) {
			$SiteStatPage = array();
			$passarray = array('TableName' => $this->TimestampLogSiteStatsTableName);
			
			$this->LayerModule->Connect($this->TimestampLogSiteStatsTableName);
			$this->LayerModule->pass ($this->TimestampLogSiteStatsTableName, 'BuildFieldNames', $passarray);
			$RowFieldName = $this->LayerModule->pass ($this->TimestampLogSiteStatsTableName, 'getRowFieldNames', array());
			$this->LayerModule->Disconnect($this->TimestampLogSiteStatsTableName);
			
			foreach ($RowFieldName as $Value) {
				$SiteStatPage[$Value] = NULL;
			}
			$Timestamp = $_SERVER['REQUEST_TIME'];
			$Timestamp = date('Y-m-d H:i:s', $Timestamp);
			$SiteStatPage['Timestamp'] = $Timestamp;
			
			$SiteStatPage['PageID'] = $_SERVER['REQUEST_URI'];
			
			$SiteStatPage['IPAddress'] = $_SERVER['REMOTE_ADDR'];
			$SiteStatPage['ReferPageID'] = $_SERVER['HTTP_REFERER'];
			$SiteStatPage['UserAgentString'] = $_SERVER['HTTP_USER_AGENT'];
			return $SiteStatPage;
			
		}
	}
	
	/**
	 * createSiteStatPage
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
	
	/**
	 * createDailySiteStatPage
	 *
	 * Creates a daily site stat page in the database.
	 *
	 * @param array $SiteStatPage = An array with the contents of the new site stat page to be created.
	 *
	 */
	public function createDailySiteStatPage(array $SiteStatPage) {
		if ($SiteStatPage != NULL) {
			$this->LayerModule->pass ($this->DailySiteStatsTableName, 'BuildFieldNames', array('TableName' => $this->DailySiteStatsTableName));
			$Keys = $this->LayerModule->pass ($this->DailySiteStatsTableName, 'getRowFieldNames', array());
			$this->addModuleContent($Keys, $SiteStatPage, $this->DailySiteStatsTableName);
		} else {
			array_push($this->ErrorMessage,'createSiteStatPage: SiteStatPage cannot be NULL!');
		}
	}
	
	/**
	 * createIPAddressSiteStatPage
	 *
	 * Creates a ip address site stat page in the database.
	 *
	 * @param array $SiteStatPage = An array with the contents of the new site stat page to be created.
	 *
	 */
	public function createIPAddressSiteStatPage(array $SiteStatPage) {
		if ($SiteStatPage != NULL) {
			$this->LayerModule->pass ($this->IPAddressSiteStatsTableName, 'BuildFieldNames', array('TableName' => $this->IPAddressSiteStatsTableName));
			$Keys = $this->LayerModule->pass ($this->IPAddressSiteStatsTableName, 'getRowFieldNames', array());
			$this->addModuleContent($Keys, $SiteStatPage, $this->IPAddressSiteStatsTableName);
		} else {
			array_push($this->ErrorMessage,'createIPAddressSiteStatPage: SiteStatPage cannot be NULL!');
		}
	}
	
	/**
	 * createDailyIPAddressSiteStatPage
	 *
	 * Creates a daily ip address site stat page in the database.
	 *
	 * @param array $SiteStatPage = An array with the contents of the new site stat page to be created.
	 *
	 */
	public function createDailyIPAddressSiteStatPage(array $SiteStatPage) {
		if ($SiteStatPage != NULL) {
			$this->LayerModule->pass ($this->DailyIPAddressSiteStatsTableName, 'BuildFieldNames', array('TableName' => $this->DailyIPAddressSiteStatsTableName));
			$Keys = $this->LayerModule->pass ($this->DailyIPAddressSiteStatsTableName, 'getRowFieldNames', array());
			$this->addModuleContent($Keys, $SiteStatPage, $this->DailyIPAddressSiteStatsTableName);
		} else {
			array_push($this->ErrorMessage,'createDailyIPAddressSiteStatPage: SiteStatPage cannot be NULL!');
		}
	}

	/*
	 * updateSiteStatPage
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
			
			if ($this->DailySiteStatsTableName != NULL) {
				$NewCount = $this->DayCount;
				$NewCount++;
				$Content = array('Count' => $NewCount);
				$CurrentDayMonthYear = date('F-d-Y');
				$passarray = array('TableName' => $this->DailySiteStatsTableName);
				
				$this->LayerModule->pass ($this->DailySiteStatsTableName, 'BuildFieldNames', $passarray);
				$RowFieldName = $this->LayerModule->pass ($this->DailySiteStatsTableName, 'getRowFieldNames', array());
				$Key = array_search($CurrentDayMonthYear, $RowFieldName);
				if ($Key) {
					$CurrentDayCount = $this->LayerModule->pass ($this->DailySiteStatsTableName, 'getRowField', array('rowfield' => $CurrentDayMonthYear));
					$CurrentDayCount++;
					$Content[$CurrentDayMonthYear] = $CurrentDayCount;
				} else {
					$passarray = array('fieldstring' => "`$CurrentDayMonthYear` INT NOT NULL DEFAULT '0'", 'fieldflag' => '', 'fieldflagcolumn' => '');
					$this->LayerModule->pass ($this->DailySiteStatsTableName, 'createField', $passarray);
					$CurrentDayCount = $this->LayerModule->pass ($this->DailySiteStatsTableName, 'getRowField', array('rowfield' => $CurrentDayMonthYear));
					$CurrentDayCount++;
					$Content[$CurrentDayMonthYear] = $CurrentDayCount;
				}
				
				$this->updateModuleContent($PageID, $this->DailySiteStatsTableName, $Content);
			}
		} else {
			array_push($this->ErrorMessage,'updateSiteStatPage: PageID cannot be NULL!');
		}
	}
	
	/*
	 * updateIPAddressSiteStatPage
	 *
	 * Updates a ip address site stat page counter and month counter.
	 *
	 * @param array $PageID = An array with the lookup page id of the site stat page to be updated.
	 *
	 */
	public function updateIPAddressSiteStatPage(array $PageID) {
		if ($PageID != NULL) {
			if ($this->IPAddressSiteStatsTableName != NULL) {
				$NewCount = $this->IPAddressCount;
				$NewCount++;
				$Content = array('Count' => $NewCount);
				$CurrentMonthYear = date('FY');
				if ($this->IPAddressSiteStatsTableName != NULL) {
					$passarray = array('TableName' => $this->IPAddressSiteStatsTableName);
					
					$this->LayerModule->pass ($this->IPAddressSiteStatsTableName, 'BuildFieldNames', $passarray);
					$RowFieldName = $this->LayerModule->pass ($this->IPAddressSiteStatsTableName, 'getRowFieldNames', array());
					$Key = array_search($CurrentMonthYear, $RowFieldName);
					if ($Key) {
						$CurrentMonthYearCount = $this->LayerModule->pass ($this->IPAddressSiteStatsTableName, 'getRowField', array('rowfield' => $CurrentMonthYear));
						$CurrentMonthYearCount++;
						$Content[$CurrentMonthYear] = $CurrentMonthYearCount;
					} else {
						$passarray = array('fieldstring' => "`$CurrentMonthYear` INT NOT NULL DEFAULT '0'", 'fieldflag' => '', 'fieldflagcolumn' => '');
						$this->LayerModule->pass ($this->IPAddressSiteStatsTableName, 'createField', $passarray);
						$CurrentMonthYearCount = $this->LayerModule->pass ($this->IPAddressSiteStatsTableName, 'getRowField', array('rowfield' => $CurrentMonthYear));
						$CurrentMonthYearCount++;
						$Content[$CurrentMonthYear] = $CurrentMonthYearCount;
					}
		
					$this->updateModuleContent($PageID, $this->IPAddressSiteStatsTableName, $Content);
				}
			}
			if ($this->DailyIPAddressSiteStatsTableName != NULL) {
				$NewCount = $this->IPAddressDayCount;
				$NewCount++;
				$Content = array('Count' => $NewCount);
				$CurrentDayMonthYear = date('F-d-Y');
				$passarray = array('TableName' => $this->DailyIPAddressSiteStatsTableName);
				
				$this->LayerModule->pass ($this->DailyIPAddressSiteStatsTableName, 'BuildFieldNames', $passarray);
				$RowFieldName = $this->LayerModule->pass ($this->DailyIPAddressSiteStatsTableName, 'getRowFieldNames', array());
				$Key = array_search($CurrentDayMonthYear, $RowFieldName);
				if ($Key) {
					$CurrentDayCount = $this->LayerModule->pass ($this->DailyIPAddressSiteStatsTableName, 'getRowField', array('rowfield' => $CurrentDayMonthYear));
					$CurrentDayCount++;
					$Content[$CurrentDayMonthYear] = $CurrentDayCount;
				} else {
					$passarray = array('fieldstring' => "`$CurrentDayMonthYear` INT NOT NULL DEFAULT '0'", 'fieldflag' => '', 'fieldflagcolumn' => '');
					$this->LayerModule->pass ($this->DailyIPAddressSiteStatsTableName, 'createField', $passarray);
					$CurrentDayCount = $this->LayerModule->pass ($this->DailyIPAddressSiteStatsTableName, 'getRowField', array('rowfield' => $CurrentDayMonthYear));
					$CurrentDayCount++;
					$Content[$CurrentDayMonthYear] = $CurrentDayCount;
				}
				
				$this->updateModuleContent($PageID, $this->DailyIPAddressSiteStatsTableName, $Content);
			}
		} else {
			array_push($this->ErrorMessage,'updateSiteStatPage: PageID cannot be NULL!');
		}
	}

	/**
	 * deleteSiteStatPage
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