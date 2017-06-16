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
	//require_once('Functions/BuildRows.php');
	
	function buildTypeStats($Type, $Tier2Databases, $ConfigurationFileName) {
		if ($ConfigurationFileName === NULL) {
			return FALSE;
		}
		
		if (is_array($ConfigurationFileName) === TRUE) {
			return FALSE;
		}
		
		if ($Tier2Databases === NULL) {
			return FALSE;
		}
		
		if ($Tier2Databases instanceof DataAccessLayer === FALSE) {
			return FALSE;
		}
		
		$RangeType = $GLOBALS['RangeType'];
		$Year = $GLOBALS['Year'];
		$EndYear = $GLOBALS['EndYear'];
		$LookupField = $GLOBALS['LookupField'];
		$Begin = $GLOBALS['Begin'];
		$End = $GLOBALS['End'];
		
		if ($RangeType === NULL) {
			return FALSE;
		}
		
		if (is_array($RangeType) === TRUE) {
			return FALSE;
		}
		
		if ($Year === NULL) {
			return FALSE;
		}
		
		if (is_array($Year) === TRUE) {
			return FALSE;
		}
		
		if ($EndYear === NULL) {
			//return FALSE;
		}
		
		if (is_array($EndYear) === TRUE) {
			//return FALSE;
		}
		
		if ($LookupField === NULL) {
			return FALSE;
		}
		
		if (is_array($LookupField) === FALSE) {
			return FALSE;
		}
		
		if ($Begin === NULL) {
			return FALSE;
		}
		
		if (is_array($Begin) === FALSE) {
			return FALSE;
		}
		
		if ($End === NULL) {
			return FALSE;
		}
		
		if (is_array($End) === FALSE) {
			return FALSE;
		}
		
		if (file_exists($ConfigurationFileName) === TRUE) {
			$Configuration = parse_ini_file($ConfigurationFileName, true);
		} else {
			return FALSE;
		}
		
		$BrowserStatsTableName = $Configuration[$Type]['BrowserStatsTableName'] . $Year;
		$StatsTableName = $Configuration[$Type]['StatsTableName'] . $Year;
		
		if (isset($EndYear) === TRUE) {
			if ($Year != $EndYear) {
				$BrowserStatsTableNameEndYear = $Configuration[$Type]['BrowserStatsTableName'] . $EndYear;
				$StatsTableNameEndYear = $Configuration[$Type]['StatsTableName'] . $EndYear;
			}
		}
		
		$Tier2Databases->createDatabaseTable($BrowserStatsTableName);
		$Tier2Databases->Connect($BrowserStatsTableName);
		
		$Tier2Databases->pass ($BrowserStatsTableName, 'setOrderbyname', array('Name' => 'Timestamp'));
		$Tier2Databases->pass ($BrowserStatsTableName, 'setOrderbytype', array('Type' => 'ASC'));
		
		$Tier2Databases->pass ($BrowserStatsTableName, 'searchDatabaseRow', array('IDNumber' => $LookupField, 'Begin' => $Begin, 'End' => $End));
		
		$BrowsersStats = $Tier2Databases->pass ($BrowserStatsTableName, "getMultiRowField", array());
		$Tier2Databases->Disconnect($BrowserStatsTableName);
		
		if (isset($BrowserStatsTableNameEndYear) === TRUE) {
			
			$Tier2Databases->createDatabaseTable($BrowserStatsTableNameEndYear);
			$Tier2Databases->Connect($BrowserStatsTableNameEndYear);
			
			$Tier2Databases->pass ($BrowserStatsTableNameEndYear, 'setOrderbyname', array('Name' => 'Timestamp'));
			$Tier2Databases->pass ($BrowserStatsTableNameEndYear, 'setOrderbytype', array('Type' => 'ASC'));
			
			$Tier2Databases->pass ($BrowserStatsTableNameEndYear, 'searchDatabaseRow', array('IDNumber' => $LookupField, 'Begin' => $Begin, 'End' => $End));
			
			$BrowsersStatsEndYear = $Tier2Databases->pass ($BrowserStatsTableNameEndYear, "getMultiRowField", array());
			$Tier2Databases->Disconnect($BrowserStatsTableNameEndYear);
			
			if (is_array($BrowsersStatsEndYear)) {
				foreach ($BrowsersStatsEndYear as $Key => $Value) {
					if (empty($Value) === TRUE) {
						unset($BrowsersStatsEndYear[$Key]);
					}
				}
			}
			
			$BrowsersStats = array_merge($BrowsersStats, $BrowsersStatsEndYear);
		}
		
		$IPAddressBrowsersStats = $BrowsersStats;
		
		$TempBrowserStats = array();
		if (is_array($BrowsersStats) === TRUE) {
			foreach ($BrowsersStats as $Key => $Value) {
				$CurrentPageID = explode('?', $Value['HttpRefer']);
				foreach ($CurrentPageID as $TempValue) {
					$Position = strpos($TempValue, 'PageID');
					if ($Position !== FALSE) {
						$CurrentPageID = str_replace('PageID=', '', $TempValue);
					}
				}
				
				if (is_array($CurrentPageID) === TRUE) {
					$CurrentPageID = 1;
				}
				$Value['PageID'] = $CurrentPageID;
				$TempBrowsersStats[$CurrentPageID][] = $Value;
				
			}
			
			ksort($TempBrowsersStats);
		}
		$BrowsersStats = $TempBrowsersStats;
		unset($TempBrowsersStats);
			
		$Tier2Databases->createDatabaseTable($StatsTableName);
		$Tier2Databases->Connect($StatsTableName);
		
		$Tier2Databases->pass ($StatsTableName, 'setOrderbyname', array('Name' => 'Timestamp'));
		$Tier2Databases->pass ($StatsTableName, 'setOrderbytype', array('Type' => 'ASC'));
		
		$Tier2Databases->pass ($StatsTableName, 'searchDatabaseRow', array('IDNumber' => $LookupField, 'Begin' => $Begin, 'End' => $End));
		
		$Stats = $Tier2Databases->pass ($StatsTableName, "getMultiRowField", array());
		$Tier2Databases->Disconnect($StatsTableName);
		
		if (isset($StatsTableNameEndYear) === TRUE) {
			$Tier2Databases->createDatabaseTable($StatsTableNameEndYear);
			$Tier2Databases->Connect($StatsTableNameEndYear);
			
			$Tier2Databases->pass ($StatsTableNameEndYear, 'setOrderbyname', array('Name' => 'Timestamp'));
			$Tier2Databases->pass ($StatsTableNameEndYear, 'setOrderbytype', array('Type' => 'ASC'));
			
			$Tier2Databases->pass ($StatsTableNameEndYear, 'searchDatabaseRow', array('IDNumber' => $LookupField, 'Begin' => $Begin, 'End' => $End));
			
			$SiteStatsEndYear = $Tier2Databases->pass ($StatsTableNameEndYear, "getMultiRowField", array());
			$Tier2Databases->Disconnect($StatsTableNameEndYear);
			
			$Stats = array_merge($Stats, $SiteStatsEndYear);
			
		}
		
		$TempStats = array();
		if (is_array($Stats) === TRUE) {
			foreach ($Stats as $Key => $Value) {
				$CurrentPageID = explode('?', $Value['RequestUri']);
				foreach ($CurrentPageID as $TempValue) {
					$Position = strpos($TempValue, 'PageID');
					if ($Position !== FALSE) {
						$CurrentPageID = str_replace('PageID=', '', $TempValue);
					}
				}
				
				if (is_array($CurrentPageID) === TRUE) {
					$CurrentPageID = 1;
				}
				$Value['PageID'] = $CurrentPageID;
				$TempStats[$CurrentPageID][] = $Value;
				
			}
			
			ksort($TempStats);
		}
		$Stats = $TempStats;
		unset($TempStats);
		
		$TempIPAddressBrowserStats = array();
		if (is_array($IPAddressBrowsersStats)) {
			foreach ($IPAddressBrowsersStats as $Key => $Value) {
				$IPAddress = $Value['IPAddress'];
				$TempIPAddressBrowserStats['IPAddress'][] = $Value;
			}
			
			ksort($TempIPAddressBrowserStats);
		}
		
		$IPAddressBrowsersStats = $TempIPAddressBrowserStats;
		unset($TempIPAddressBrowserStats);
		
		// RETURN DATA HERE
		$ReturnData = array();
		$ReturnData['Data']['Stats'] = $Stats;
		$ReturnData['Data']['BrowsersStats'] = $BrowsersStats;
		$ReturnData['Data']['IPAddressBrowsersStats'] = $IPAddressBrowsersStats;
		return $ReturnData;
	}
?>