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
		if ($PageListings != NULL) {
			if (is_array($PageListings) === TRUE) {
				$IPAddressBrowsersStats = $BrowsersStats;
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
				
				$ConfigurationFileName = '../../../Configuration/Managers/StatsManager/GridStatsData/Tabs/IPAddressesSettings.ini';
				require_once('Functions/GridStatsData/Tabs/BuildIPAddressesData.php');
				$IPAddressReturnData = buildIPAddressesData($PageListings, 'IPAddress', $ConfigurationFileName);
				$IPAddressData = $IPAddressReturnData['Data'];
				
				$TotalHumanViews = 0;
				
				foreach ($IPAddressData as $Key => $Data) {
					$TotalHumanViews = $TotalHumanViews + $Data['Human Views'];
				}
				
				$TempTop10Listings = array();
				$TempTop10SortListings = array();
				
				foreach ($IPAddressData as $Key => $Data) {
					$HumanHitsPercentage = round(($Data['Human Views'] / $TotalHumanViews) * 100, 4);
					
					$TempIPAddress = $Data['IP Address'];
					$TempTop10Listings[$TempIPAddress]['IP Address'] = $Data['IP Address'];
					$TempTop10Listings[$TempIPAddress]['Human Views'] = $Data['Human Views'];
					$TempTop10Listings[$TempIPAddress]['Human Hits Percentage'] = $HumanHitsPercentage;
					
					$TempTop10SortListings[$TempIPAddress] = $HumanHitsPercentage;
				}
				
				array_multisort($TempTop10SortListings, SORT_DESC, $TempTop10Listings);
				
				$Top10Listings = array();
				$Top10Listings = array_slice($TempTop10Listings, 0, 10, TRUE);
				
				unset($TempTop10SortListings);
				unset($TempTop10Listings);
				
				$SumPercentage = 0;
				foreach ($Top10Listings as $Key => $Data) {
					if ($Data['Human Hits Percentage'] != 0) {
						$TempTop10Listings[$Key] = $Data;
						$SumPercentage = $SumPercentage + round($Data['Human Hits Percentage'], 4);
					}
				}
				
				$Top10Listings = $TempTop10Listings;
				unset($TempTop10Listings);
				
				$RemainingPagesPercentage = 100 - $SumPercentage;
				$Top10ListingsTemp = array();
				$Top10ListingsTemp['IP Address'] = 'Remaining Pages';
				$Top10ListingsTemp['Human Hits Percentage'] = $RemainingPagesPercentage;
				$Top10Listings[] = $Top10ListingsTemp;
				
				
				$Count = 1;
				foreach ($Top10Listings as $Key => $Data) {
					$Percentage = $Data['Human Hits Percentage'];
					$IPAddress = $Data['IP Address'];
					
					$Page->startElement('item');
					$Page->writeAttribute('id', $Count);
						$Page->startElement('Percentage');
							$Page->text($Percentage);
						$Page->endElement(); // ENDS PERCENTAGE
						$Page->startElement('IPAddresses');
							$Page->text($IPAddress);
						$Page->endElement(); // ENDS IP ADDRESS
					$Page->endElement(); // ENDS ITEM
					$Count++;
				}
				
			}
		}
	} else {
		header("HTTP/1.0 404 Not Found");
	}
?>