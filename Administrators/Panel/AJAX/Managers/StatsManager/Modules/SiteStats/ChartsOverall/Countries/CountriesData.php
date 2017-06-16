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
		if ($BrowsersStats != NULL) {
			if (is_array($BrowsersStats) === TRUE) {
				$FileName = $GridStatsDataConfiguration['Tab Configuration Files']['Countries'];
				if (file_exists($FileName)) {
					$CountriesConfiguration = parse_ini_file($FileName, true);
				} else {
					$CountriesConfiguration = NULL;
				}
				
				$Total = 0;
				//print_r($BrowsersStats);
				/*foreach($BrowsersStats as $Key => $Value) {
					if (strstr($Value['NavigatorUserAgent'], 'http://www.google.com/bot.html') == FALSE) {
						$Total++;
					}
				}*/
				
				// Putting Browser Stats in the correct format for the buildLanguages function. 
				$TempBrowserStats = array();
			
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
				
				$BrowsersStats = $TempBrowsersStats;
				unset($TempBrowsersStats);
				
				require_once('Functions/BuildCountries.php');
				$ReturnData = buildCountries($BrowsersStats, $CountriesConfiguration);
				
				// Walks ReturnData['Data'] to combine up all the pages Countries totals.
				$CountriesData = array();
				if (is_array($ReturnData['Data'])) {
					foreach ($ReturnData['Data'] as $PageIndex => $CountriesArray) {
						if (is_array($CountriesArray)) {
							foreach($CountriesArray as $Key => $Value) {
								//if ($Key != 'Google Bot Views') {
								$Total = $Total + $Value;
								if (in_array($Key, $CountriesConfiguration['Columns Names']['ColumnNames']) === FALSE) {
									if (isset($CountriesData[$Key]) === TRUE) {
										$CountriesData[$Key] = $CountriesData[$Key] + $Value;
									} else {
										$CountriesData[$Key] = $Value;
									}
								}
								//}
							}
						}
					}
				}
				
				//Walks CountriesData to figure out percentages.
				$ID = 1;
				
				if (is_array($CountriesData) === TRUE) {
					foreach($CountriesData as $Countries => $Hits) {
						if (empty($Countries) == TRUE) {
							$Countries = "Unknown";
						}
						
						$Percentage = round(($Hits / $Total) * 100, 2);
						
						$Page->startElement('item');
						$Page->writeAttribute('id', $ID);
							$Page->startElement('Percentage');
								$Page->text($Percentage);
							$Page->endElement(); // ENDS PERCENTAGE
							$Page->startElement('Countries');
								$Page->text($Countries);
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