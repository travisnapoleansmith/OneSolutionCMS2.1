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
		//if ($_SERVER['HTTP_X_REQUESTED_WITH'] === 'XMLHttpRequest') {
			set_time_limit(120);
			ini_set("memory_limit","256M");
			
			//error_reporting(0);
			
			$HOME = $_SERVER['SUBDOMAIN_DOCUMENT_ROOT'];
			$ADMINHOME = $HOME . '/Administrators/';
			$GLOBALS['HOME'] = $HOME;
			$GLOBALS['ADMINHOME'] = $ADMINHOME;
			
			$Type = $_GET['Type']; // ADStats, SiteStats
			//$Name = $_GET['Name']; // Browsers, BrowsersVersions, Plugins, OS's, OSVersions, Languagues, Countries, IPAddresses only options
			$AdStatsPanelName = $_GET['AdStatsPanelName']; // ONLY USE FOR AD STATS; This will determine what the ad panel is being used.
			$ID = $_GET['ID']; // For AdStats -> AdvertiserID only
			$Range = $_GET['Range']; // Date Range
			$RangeType = $_GET['RangeType']; // Daily, Weekly, Monthly, Yearly, Range only options
			
			$PageListingsTable = 'ContentLayerVersion';
			$Page = new XMLWriter();
			$Page->openMemory();
		
			$Page->setIndent(4);
			
			// Includes all files
			//require_once ('Configuration/includes.php');
			
			require_once ("$ADMINHOME/Panel/Configuration/includes.php");
			
			$Page->startElement('data');
			//if ($AdPanel != NULL) {
				$Tier2Databases = new DataAccessLayer();
				$Tier2Databases->setDatabaseAll ($credentaillogonarray[0], $credentaillogonarray[1], $credentaillogonarray[2], $credentaillogonarray[3], NULL);
				$Tier2Databases->buildModules('DataAccessLayerModules', 'DataAccessLayerTables', 'DataAccessLayerModulesSettings');
				
				$PageID = array();
				$PageID['CurrentVersion'] = 'true';
				$Tier2Databases->createDatabaseTable($PageListingsTable);
				$Tier2Databases->Connect($PageListingsTable);
				
				$Tier2Databases->pass ($PageListingsTable, 'setOrderbyname', array('Name' => 'PageID'));
				$Tier2Databases->pass ($PageListingsTable, 'setOrderbytype', array('Type' => 'ASC'));
				
				$Tier2Databases->pass ($PageListingsTable, 'setDatabaseRow', array('idnumber' => $PageID));
				$PageListings = $Tier2Databases->pass ($PageListingsTable, "getMultiRowField", array());
				$Tier2Databases->Disconnect($PageListingsTable);
				
				if ($Type == 'AdStats') {
					
				} else if ($Type == 'SiteStats') {
					if ($RangeType != NULL) {
						$EndRange = NULL;
						$EndTimeStamp = NULL;
						if ($RangeType == 'Daily') {
							$TimeStamp = strtotime($Range);
						} else if ($RangeType == 'Weekly') {
							$Range = explode(':', $Range);
							$EndRange = $Range[1];
							$Range = $Range[0];
							$TimeStamp = strtotime($Range);
							$EndTimeStamp = strtotime($EndRange);
						} else if ($RangeType == 'Monthly') {
							$StartRange = $Range;
							$Range ='01-' . $StartRange;
							unset($StartRange);
							
							$EndRange = date("y-m-t", strtotime($Range));
							$TimeStamp = strtotime($Range);
							$LastDay = date("Y-m-t", strtotime($Range));
							$EndTimeStamp = strtotime($EndRange);
						} else if ($RangeType == 'Yearly') {
							$StartRange = '01-01-' . $Range;
							$EndRange = '31-12-' . $Range;
							$Range = $StartRange;
							unset($StartRange);
							
							$TimeStamp = strtotime($Range);
							$EndTimeStamp = strtotime($EndRange);
						} else if ($RangeType == 'Range') {
							$Range = explode(':', $Range);
							$EndRange = $Range[1];
							$Range = $Range[0];
							$TimeStamp = strtotime($Range);
							$EndTimeStamp = strtotime($EndRange);
						}
						
						$Year = date('Y', $TimeStamp);
						$Date = date('Y-m-d', $TimeStamp);
						if ($EndTimeStamp != NULL) {
							$EndDate = date('Y-m-d', $EndTimeStamp);
						}
						
						$BrowserStatsTableName = 'SiteStatsBrowserStats' . $Year;
						$SiteStatsTableName = 'SiteStats' . $Year;
						
						$LookupField = array();
						$Begin = array();
						$End = array();
						$LookupField['Timestamp'] = 'Timestamp';
						if ($RangeType == 'Daily') {
							$Begin['Timestamp'] = $Date . ' 00:00:00';
							$End['Timestamp'] = $Date . ' 23:59:59';
						} else if ($RangeType == 'Weekly') {
							$Begin['Timestamp'] = $Date . ' 00:00:00';
							$End['Timestamp'] = $EndDate . ' 23:59:59';
						} else if ($RangeType == 'Monthly') {
							$Begin['Timestamp'] = $Date . ' 00:00:00';
							$End['Timestamp'] = $EndDate . ' 23:59:59';
						} else if ($RangeType == 'Yearly') {
							$Begin['Timestamp'] = $Date . ' 00:00:00';
							$End['Timestamp'] = $EndDate . ' 23:59:59';
						} else if ($RangeType == 'Range') {
							$Begin['Timestamp'] = $Date . ' 00:00:00';
							$End['Timestamp'] = $EndDate . ' 23:59:59';
						}
						
						$Tier2Databases->createDatabaseTable($BrowserStatsTableName);
						$Tier2Databases->Connect($BrowserStatsTableName);
						
						$Tier2Databases->pass ($BrowserStatsTableName, 'setOrderbyname', array('Name' => 'Timestamp'));
						$Tier2Databases->pass ($BrowserStatsTableName, 'setOrderbytype', array('Type' => 'ASC'));
						
						$Tier2Databases->pass ($BrowserStatsTableName, 'searchDatabaseRow', array('IDNumber' => $LookupField, 'Begin' => $Begin, 'End' => $End));
						
						$BrowsersStats = $Tier2Databases->pass ($BrowserStatsTableName, "getMultiRowField", array());
						$Tier2Databases->Disconnect($BrowserStatsTableName);
						
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
							
						$Tier2Databases->createDatabaseTable($SiteStatsTableName);
						$Tier2Databases->Connect($SiteStatsTableName);
						
						$Tier2Databases->pass ($SiteStatsTableName, 'setOrderbyname', array('Name' => 'Timestamp'));
						$Tier2Databases->pass ($SiteStatsTableName, 'setOrderbytype', array('Type' => 'ASC'));
						
						$Tier2Databases->pass ($SiteStatsTableName, 'searchDatabaseRow', array('IDNumber' => $LookupField, 'Begin' => $Begin, 'End' => $End));
						
						$SiteStats = $Tier2Databases->pass ($SiteStatsTableName, "getMultiRowField", array());
						$Tier2Databases->Disconnect($SiteStatsTableName);
						
						$TempSiteStats = array();
						if (is_array($SiteStats)) {
							foreach ($SiteStats as $Key => $Value) {
								$CurrentPageID = explode('?', $Value['RequestUri']);
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
								$TempSiteStats[$CurrentPageID][] = $Value;
								
							}
							
							ksort($TempSiteStats);
						}
						$SiteStats = $TempSiteStats;
						unset($TempSiteStats);
					}
				}
				
				$TempTop10Listings = array();
				$TempTop10SortListings = array();
				if (is_array($PageListings)) {
					foreach ($PageListings as $Key => $Data) {
						//$Value = $Data['PageID'] . ' - ' . $Data['ContentPageMenuTitle'];
						$Value = $Data['ContentPageMenuTitle'];
						if (is_array($SiteStats)) {
							$Temp = $SiteStats[$Data['PageID']];
							$TotalCount = 0;
							if ($Temp != NULL) {
								$TotalCount = count($Temp);
							}
						}
						
						if (is_array($BrowsersStats)) {
							$Temp = $BrowsersStats[$Data['PageID']];
							$HumanCount = 0;
							if ($Temp != NULL) {
								$HumanCount = count($Temp);
							}
						}
						$TempPageID = $Data['PageID'];
						$TempTop10Listings[$TempPageID]['PageID'] = $Data['PageID'];
						$TempTop10Listings[$TempPageID]['PageName'] = $Value;
						$TempTop10Listings[$TempPageID]['TotalViews'] = $TotalCount;
						$TempTop10Listings[$TempPageID]['HumanViews'] = $HumanCount;
						
						$TempTop10SortListings[$TempPageID] = $HumanCount;
					}
				}
				
				array_multisort($TempTop10SortListings, SORT_DESC, $TempTop10Listings);
				
				$Top10Listings = array();
				$Top10Listings = array_slice($TempTop10Listings, 0, 9, TRUE);
				
				unset($TempTop10SortListings);
				unset($TempTop10Listings);
				
				foreach ($Top10Listings as $Key => $Value) {
					$Page->startElement('item');
					$Page->writeAttribute('id', $Key);
						$Page->startElement('TotalViews');
						$Page->text($Value['TotalViews']);
						$Page->endElement(); // ENDS TOTAL HITS
						
						$Page->startElement('HumanViews');
						$Page->text($Value['HumanViews']);
						$Page->endElement(); // ENDS Human HITS
						
						$Page->startElement('PageName');
						$Page->text($Value['PageName']);
						$Page->endElement(); // ENDS PAGENAME
					$Page->endElement(); // ENDS ITEM
				}
				
			//}
			
			$Page->fullEndElement(); //ENDS DATA
			
			$PageOutput = $Page->flush();
			header('Content-type: application/xml');
			print $PageOutput;
		
		//} else {
			//header("HTTP/1.0 404 Not Found");
		//}
	} else {
		header("HTTP/1.0 404 Not Found");
	}
?>