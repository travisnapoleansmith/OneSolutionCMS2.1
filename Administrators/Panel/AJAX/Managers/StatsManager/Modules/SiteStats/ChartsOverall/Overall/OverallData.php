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
				// SORT STATS OUT
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
				
				// END SORTING STATS OUT
				
				
				
				require_once('Functions/GridStatsData/Tabs/BuildIPAddressesData.php');
				require_once('Functions/GridStatsData/Tabs/BuildEntranceExitPageViewsData.php');
				
				$IPAddressReturnData = buildIPAddressesData($PageListings, 'Page', $ConfigurationFileName);
				$IPAddressData = $IPAddressReturnData['Data'];
				
				$EntranceExitPageViewsReturnData = buildEntranceExitPageViewsData($IPAddressData, $IPAddressBrowsersStats, $BrowsersStats, $PageListings, $ConfigurationFileName);
				$EntranceExitPageViewsData = $EntranceExitPageViewsReturnData['Data'];
				
				$TempTop10Listings = array();
				$TempTop10SortListings = array();
				
				if (is_array($IPAddressReturnData) === TRUE) {
					if (isset($IPAddressReturnData['Data']) === TRUE) {
						if (is_array($IPAddressReturnData['Data']) === TRUE) {
							foreach ($PageListings as $Key => $Data) {
								$BounceRatePercentage = $EntranceExitPageViewsData[$Data['PageID']]['BounceRatePercentage'];
								
								$TempPageID = $Data['PageID'];
								$TempTop10Listings[$TempPageID]['PageID'] = $Data['PageID'];
								$TempTop10Listings[$TempPageID]['PageName'] = $Data['ContentPageMenuTitle'];
								$TempTop10Listings[$TempPageID]['BounceRatePercentage'] = $BounceRatePercentage;
								
								$TempTop10SortListings[$TempPageID] = $BounceRatePercentage;
							}
							
							array_multisort($TempTop10SortListings, SORT_DESC, $TempTop10Listings);
							
							$Top10Listings = array();
							$Top10Listings = array_slice($TempTop10Listings, 0, 10, TRUE);
							
							unset($TempTop10SortListings);
							unset($TempTop10Listings);
							$TempTop10Listings = array();
							
							$SumPercentage = 0;
							foreach ($Top10Listings as $Key => $Data) {
								if ($Data['BounceRatePercentage'] != 0) {
									$TempTop10Listings[$Key] = $Data;
									$SumPercentage = $SumPercentage + round($Data['BounceRatePercentage'], 4);
								}
							}
							
							$Top10Listings = $TempTop10Listings;
							unset($TempTop10Listings);
							
							$RemainingPagesPercentage = 100 - $SumPercentage;
							$Top10ListingsTemp = array();
							$Top10ListingsTemp['PageName'] = 'Remaining Pages';
							$Top10ListingsTemp['BounceRatePercentage'] = $RemainingPagesPercentage;
							$Top10Listings[] = $Top10ListingsTemp;
							
							$Count = 1;
							foreach ($Top10Listings as $Key => $Data) {
								$Percentage =  round($Data['BounceRatePercentage'], 4);
								$Heading = $Data['PageName'];
								
								$Page->startElement('item');
								$Page->writeAttribute('id', $Count);
									$Page->startElement('Percentage');
										$Page->text($Percentage);
									$Page->endElement(); // ENDS PERCENTAGE
									$Page->startElement('Overall');
										$Page->text($Heading);
									$Page->endElement(); // ENDS BOUNCE RATE
								$Page->endElement(); // ENDS ITEM
								$Count++;
							}
						}
					}
				}
			}
		}
	} else {
		header("HTTP/1.0 404 Not Found");
	}
?>