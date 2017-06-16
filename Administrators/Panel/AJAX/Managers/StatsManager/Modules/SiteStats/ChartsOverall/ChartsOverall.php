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
	$RefererPage = $_SERVER['HTTP_REFERER'];
	$RefererPageArray = explode('?', $RefererPage);
	$RefererPage = $RefererPageArray[0];
	$ServerLocation = "http://" . $_SERVER['SERVER_NAME'];

	unset($RefererPageArray);
	if ($RefererPage == $ServerLocation . "/Administrators/Panel/Managers/StatsManager/StatsManager.php") {
		// CREATE FUNCTION THAT WILL WORK WITH ADSTATS AND SITESTATS!
		if ($RangeType != NULL) {
			$BrowserStatsTableName = 'SiteStatsBrowserStats' . $Year;
			$SiteStatsTableName = 'SiteStats' . $Year;
			
			if (isset($EndYear) === TRUE) {
				if ($Year != $EndYear) {
					$BrowserStatsTableNameEndYear = 'SiteStatsBrowserStats' . $EndYear;
					$SiteStatsTableNameEndYear = 'SiteStats' . $EndYear;
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
				
				if (is_array($BrowsersStatsEndYear) === TRUE) {
					foreach ($BrowsersStatsEndYear as $Key => $Value) {
						if (empty($Value) === TRUE) {
							unset($BrowsersStatsEndYear[$Key]);
						}
					}
				}
				
				$BrowsersStats = array_merge($BrowsersStats, $BrowsersStatsEndYear);
			}
			
			$Tier2Databases->createDatabaseTable($SiteStatsTableName);
			$Tier2Databases->Connect($SiteStatsTableName);
			
			$Tier2Databases->pass ($SiteStatsTableName, 'setOrderbyname', array('Name' => 'Timestamp'));
			$Tier2Databases->pass ($SiteStatsTableName, 'setOrderbytype', array('Type' => 'ASC'));
			
			$Tier2Databases->pass ($SiteStatsTableName, 'searchDatabaseRow', array('IDNumber' => $LookupField, 'Begin' => $Begin, 'End' => $End));
			
			$SiteStats = $Tier2Databases->pass ($SiteStatsTableName, "getMultiRowField", array());
			$Tier2Databases->Disconnect($SiteStatsTableName);
			
			if (isset($SiteStatsTableNameEndYear) === TRUE) {
				$Tier2Databases->createDatabaseTable($SiteStatsTableNameEndYear);
				$Tier2Databases->Connect($SiteStatsTableNameEndYear);
				
				$Tier2Databases->pass ($SiteStatsTableNameEndYear, 'setOrderbyname', array('Name' => 'Timestamp'));
				$Tier2Databases->pass ($SiteStatsTableNameEndYear, 'setOrderbytype', array('Type' => 'ASC'));
				
				$Tier2Databases->pass ($SiteStatsTableNameEndYear, 'searchDatabaseRow', array('IDNumber' => $LookupField, 'Begin' => $Begin, 'End' => $End));
				
				$SiteStatsEndYear = $Tier2Databases->pass ($SiteStatsTableNameEndYear, "getMultiRowField", array());
				$Tier2Databases->Disconnect($SiteStatsTableNameEndYear);
				
				$SiteStats = array_merge($SiteStats, $SiteStatsEndYear);
				
			}
		}
		
			// CONTENT
			if (is_array($GridStatsDataConfiguration) === TRUE) {
				switch ($Name) {
					// Change Switch Statement to look inside of INI file for case and what file to call!
					// CREATE A SPECIAL FUNCTION THAT WILL READ AN INI FILE THAT CONTAINS A LISTING OF TAB NAMES AND FUNCTION CALLS THAT
					// THAT WILL ALLOW THE ADDING A NEW TAB AND NEW FUNCTION AS EASY AS UPDATING THE INI FILE.
					// CREATE A COMMON FUNCTION NAME WITH THE SAME DATA BEING PASSED SO IT CAN BE MADE SOME DAY INTO A CLASS
					case isset($GridStatsDataConfiguration['Content'][$Name]):
						$FileName = $GridStatsDataConfiguration['Content'][$Name];
						if (file_exists($FileName) === TRUE) {
							require_once($FileName);
						}
						break;
				}
			}
		/*} else {
			header("HTTP/1.0 404 Not Found");
		}*/
	} else {
		header("HTTP/1.0 404 Not Found");
	}
?>