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
		if (is_array($PageListings) === TRUE) {
			require_once('Functions/BuildBrowsersVersionsColumnNames.php');
	
			$FileName = $GridStatsDataConfiguration['Tab Configuration Files']['BrowsersVersions'];
			if (file_exists($FileName)) {
				$BrowsersVersionsConfiguration = parse_ini_file($FileName, true);
			} else {
				$BrowsersVersionsConfiguration = NULL;
			}
			
			$TempBrowserStats = array();
			if (is_array($BrowsersStats)) {
				foreach ($BrowsersStats as $Key => $Value) {
					$CurrentPageID = explode('?', $Value['HttpRefer']);
					foreach ($CurrentPageID as $TempValue) {
						$Position = strpos($TempValue, 'PageID');
						if ($Position !== FALSE) {
							$CurrentPageID = str_replace('PageID=', '', $TempValue);
						}
					}
					
					if (is_array($CurrentPageID)) {
						$CurrentPageID = 1;
					}
					$Value['PageID'] = $CurrentPageID;
					$TempBrowsersStats[$CurrentPageID][] = $Value;
					
				}
				
				ksort($TempBrowsersStats);
			}
			$BrowsersStats = $TempBrowsersStats;
			unset($TempBrowsersStats);
			
			$ReturnData = buildBrowsersVersionsColumnNames($PageListings, $BrowsersStats, $FileName);
			
			if (is_array($ReturnData) === TRUE) {
				$VersionsData = $ReturnData['VersionsData'];
			}
			
			$Versions = array();
			$Versions['Total'] = 0;
			
			if (is_array($ReturnData['Versions']) === TRUE) {
				foreach ($ReturnData['Versions'] as $BrowserTypeKey => $BrowserTypeValue) {
					if (is_array($BrowserTypeValue) === TRUE) {
						$BrowserType = str_replace('Versions', '', $BrowserTypeKey);
						foreach ($BrowserTypeValue as $BrowserTypeVersionKey => $BrowserTypeVersionValue) {
							$BrowserTypeVersion = $BrowserType . ' ' .  $BrowserTypeVersionKey;
							$Versions[$BrowserTypeVersion] = 0;
						}
					}
				}
			}
			
			if (is_array($VersionsData) === TRUE) {
				foreach ($VersionsData as $Key => $Value) {
					if (is_array($Value) === TRUE) {
						foreach ($Value as $SubKey => $SubValue) {
							$Versions['Total'] = $Versions['Total'] + $SubValue;
							if (isset($Versions[$SubKey]) === TRUE) {
								$Versions[$SubKey] = $Versions[$SubKey] + $SubValue;
							} else {
								$Versions[$SubKey] = $SubValue;
							}
						}
					}
				}
			}
			
			$ID = 1;
			$GoogleBotViews = $Versions['Google Bot Views'];
			$Total = $Versions['Total'];
			if (is_array($Versions) === TRUE) {
				foreach($Versions as $BrowserVersionKey => $BrowserVersionHits) {
					if (($BrowserVersionKey == 'Total' || $BrowserVersionKey == 'Google Bot Views') === FALSE) {
						$TrueTotal = $Total - $GoogleBotViews;
						$Percentage = round(($BrowserVersionHits / $TrueTotal) * 100, 2);
						
						$Page->startElement('item');
							$Page->writeAttribute('id', $ID);
							$Page->startElement('Percentage');
								$Page->text($Percentage);
							$Page->endElement(); // ENDS PERCENTAGE
							$Page->startElement('BrowsersVersions');
								$Page->text($BrowserVersionKey);
							$Page->endElement(); // ENDS BROWSERS
						$Page->endElement(); // ENDS ITEM
						
						$ID++;
					}
				}
			}
		}
	} else {
		header("HTTP/1.0 404 Not Found");
	}
?>