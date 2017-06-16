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
		$Format = $GLOBALS['Format'];
		
		if (is_null($Format) === TRUE) {
			header("HTTP/1.0 404 Not Found");
		} else if (isset($Format) === FALSE){
			header("HTTP/1.0 404 Not Found");
		} else {
			require_once('Functions/GridStatsData/Tabs/BuildIPAddressesData.php');
			require_once('Functions/GridStatsData/Tabs/BuildReferrersHitsData.php');
			require_once('Functions/GridStatsData/Tabs/BuildTripsToSiteData.php');
			require_once('Functions/GridStatsData/Tabs/BuildEntranceExitPageViewsData.php');
			
			$IPAddressReturnData = buildIPAddressesData($PageListings, 'Page', $ConfigurationFileName);
			$IPAddressData = $IPAddressReturnData['Data'];
			
			$ReferrersReturnData = buildReferrersHitsData($SiteStats, $PageListings, $ConfigurationFileName);
			$ReferrersData = $ReferrersReturnData['Data'];
			
			$TripsToSiteReturnData = buildTripsToSiteData($IPAddressData, $SiteStats, $PageListings, $ConfigurationFileName);
			$TripsToSiteData = $TripsToSiteReturnData['Data'];
			
			$EntranceExitPageViewsReturnData = buildEntranceExitPageViewsData($IPAddressData, $IPAddressBrowsersStats, $BrowsersStats, $PageListings, $ConfigurationFileName);
			$EntranceExitPageViewsData = $EntranceExitPageViewsReturnData['Data'];
			
			if (is_array($IPAddressReturnData) === TRUE) {
				if (isset($IPAddressReturnData['Data']) === TRUE) {
					if (is_array($IPAddressReturnData['Data']) === TRUE) {
						$Number = 2; // EXCEL SPREADSHEET FORMAT
						foreach ($PageListings as $Key => $Data) {
							$Information = array();
							$Attributes = array();
						
							$Information[] = $Data['PageID'];
							$Information[] = $Data['ContentPageMenuTitle'];
							
							if (is_array($SiteStats) === TRUE) {
								$Temp = $SiteStats[$Data['PageID']];
								$TotalCount = 0;
								
								if (isset($Temp[0]['Timestamp']) === TRUE) {
									$TotalCount = count($Temp);
								}
								
								$Information[] = $TotalCount;
							} else {
								$TotalCount = 0;
								$Information[] = $TotalCount;
							}
							
							if (is_array($BrowsersStats) === TRUE) {
								$Temp = $BrowsersStats[$Data['PageID']];
								$HumanCount = 0;
								
								if (isset($Temp[0]['Timestamp']) === TRUE) {
									$HumanCount = count($Temp);
								}
								
								$Information[] = $HumanCount;
							} else {
								$HumanCount = 0;
								$Information[] = $HumanCount;
							}
							
							// ->>>>>>>>>>>>>>> FUNCTION NEEDED
							// OVERALL STATS
							// MOVE TO A FUNCTION WITH CONFIGURATION FROM INI FILE
							if (is_array($BrowsersStats) === TRUE) {
								$Temp = $BrowsersStats[$Data['PageID']];
									
								$GoogleBot = 0;
								$UniqueVisitors = 0;
								$Referrers = 0;
								$AverageTimeSpent = 0;
								$ExitPageViews = 0;
								$ExitPagePercentage = 0;
								$EntrancePageViews = 0;
								$EntrancePagePercentage = 0;
								$BouncePageViews = 0;
								$BounceRatePercentage = 0;
								$RepeatVisitors = 0;
								$RepeatVisitorsPercentage = 0;
								//$PageVisitsPerVisit = 0; // Put In IP ADDRESS TAB
								
								$TripsToSite = 0;
								$CurrentTimestamp = NULL;
								$FirstTimestamp = NULL;
								$LastTimestamp = NULL;
								$FutureTimestamp = NULL;
								
								$TimeSpent = NULL;
								$TotalTimeSpent = 0;
								
								// BuildIPAddressesData function builds the IPAddressData array and Computes GoogleBot Views
								$IPAddressArray = $IPAddressData[$Data['PageID']];
								$GoogleBot = $IPAddressArray['GoogleBot'];
								
								// BuildReferrersHitsData function builds the RefferersData array for Refferers
								$ReferrersArray = $ReferrersData[$Data['PageID']];
								
								// BuildTripsToSiteData function builds the TripsToSiteData array for Trips To Site
								$RepeatVisitors = $TripsToSiteData[$Data['PageID']]['RepeatVisitors'];
								$TimeSpent = $TripsToSiteData[$Data['PageID']]['TimeSpent'];
								$TotalTimeSpent = $TripsToSiteData[$Data['PageID']]['TotalTimeSpent'];
								
								if (is_array($TripsToSiteData['Data']['IPAddressData']) === TRUE) {
									$IPAddressArray = $TripsToSiteData['Data']['IPAddressData'][$Data['PageID']];
								}
								
								$UniqueVisitors = count($IPAddressArray);
								$Referrers = count($ReferrersArray);
								
								if ($HumanCount != 0 && $GoogleBot != 0 && ($HumanCount - $GoogleBot) != 0) {
									$RepeatVisitorsPercentage = $RepeatVisitors / ($HumanCount - $GoogleBot);
									$RepeatVisitorsPercentage = $RepeatVisitorsPercentage * 100;
									$RepeatVisitorsPercentage = round($RepeatVisitorsPercentage, 4);
									
								} else if ($HumanCount != 0) {
									$RepeatVisitorsPercentage = $RepeatVisitors / $HumanCount;
									$RepeatVisitorsPercentage = $RepeatVisitorsPercentage * 100;
									$RepeatVisitorsPercentage = round($RepeatVisitorsPercentage, 4);
								}
								
								if ($TotalCount != 0) {
									$AverageTimeSpent = $TotalTimeSpent / $TotalCount;
									$AverageTimeSpent = round($AverageTimeSpent, 4);
								}
								
								$RepeatVisitorsPercentage = number_format($RepeatVisitorsPercentage, 4);
								$RepeatVisitorsPercentage .= '%';
								
								$AverageTimeSpent = number_format($AverageTimeSpent, 4);
								
								// BuildEntranceExitPageViewsData function builds the EntranceExitPageViewsData array for Entrance, Exit and Bounce Rate
								$ExitPageViews = $EntranceExitPageViewsData[$Data['PageID']]['ExitPageViews'];
								$ExitPagePercentage = $EntranceExitPageViewsData[$Data['PageID']]['ExitPagePercentage'];
								$EntrancePageViews = $EntranceExitPageViewsData[$Data['PageID']]['EntrancePageViews'];
								$EntrancePagePercentage = $EntranceExitPageViewsData[$Data['PageID']]['EntrancePagePercentage'];
								$BouncePageViews = $EntranceExitPageViewsData[$Data['PageID']]['BouncePageViews'];
								$BounceRatePercentage = $EntranceExitPageViewsData[$Data['PageID']]['BounceRatePercentage'];
								
								if (is_numeric($GoogleBot) === FALSE) {
									$GoogleBot = 0;
								}
								
								if (is_numeric($RepeatVisitors) === FALSE) {
									$RepeatVisitors = 0;
								}
								
								if (is_numeric($TimeSpent) === FALSE) {
									$TimeSpent = 0;
								}
								
								if (is_numeric($TotalTimeSpent) === FALSE) {
									$TotalTimeSpent = 0;
								}
								
								$Information[] = $GoogleBot;
								$Information[] = $UniqueVisitors;
								$Information[] = $Referrers;
								$Information[] = $AverageTimeSpent;
								$Information[] = $ExitPageViews;
								$Information[] = $ExitPagePercentage;
								$Information[] = $EntrancePageViews;
								$Information[] = $EntrancePagePercentage;
								$Information[] = $BouncePageViews;
								$Information[] = $BounceRatePercentage;
								$Information[] = $RepeatVisitors;
								$Information[] = $RepeatVisitorsPercentage;
								$Information[] = $PageVisitsPerVisit;
							}
							
							switch ($Format) {
								case 'XML':
									$Page->startElement('row');
									$Page->writeAttribute('id', $Data['PageID']);
										if (is_array($BrowsersStats) === TRUE) {
											buildRows($Information, $Attributes, $Page);
										}
										// END FUNCTION
									$Page->endElement(); // ENDS ROW
									break;
								case 'Excel':
									$PHPExcel = $GLOBALS['PHPExcel'];
									if (is_null($PHPExcel) === TRUE) {
										return FALSE;
									} else if (isset($PHPExcel) === FALSE){
										return FALSE;
									} else {
										$Letter = 'A';
										
										foreach ($Information as $Key => $Value) {
											$PHPExcel->setActiveSheetIndex(0)->setCellValue($Letter . $Number, $Value);
											
											$Letter++;
										}
										$Number++;
									}
									break;
								case 'CSV':
									$Output = $GLOBALS['Output'];
									if (is_null($Output) === TRUE) {
										header("HTTP/1.0 404 Not Found");
									} else if (isset($Output) === FALSE){
										header("HTTP/1.0 404 Not Found");
									} else {
										fputcsv($Output, $Information);
									}
									break;
								default:
									header("HTTP/1.0 404 Not Found");
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