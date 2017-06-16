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
	
	function buildTripsToSiteData($IPAddressData, $BrowsersStats, $PageListings, $ConfigurationFileName) {
		/*if ($ConfigurationFileName == NULL) {
			return FALSE;
		}
		
		if (is_array($ConfigurationFileName) === FALSE) {
			return FALSE;
		}
		*/
		// MUST PASS A CONFIGURATION FILE NAME
		
		if ($PageListings != NULL) {
			if (is_array($PageListings) === TRUE) {
				$TripsToSiteData = array();
				foreach ($PageListings as $Key => $Data) {
					if ($BrowsersStats != NULL) {
						if (is_array($BrowsersStats) === TRUE) {
							if (file_exists($ConfigurationFileName) === TRUE) {
								$Configuration = parse_ini_file($ConfigurationFileName, true);
							} else {
								$Configuration = NULL;
							}
							$RepeatVisitors = 0;
							
							$TripsToSite = 0;
							$CurrentTimestamp = NULL;
							$FirstTimestamp = NULL;
							$LastTimestamp = NULL;
							$FutureTimestamp = NULL;
							
							$TimeSpent = NULL;
							
							$IPAddressArray = &$IPAddressData[$Data['PageID']];
							$Temp = $BrowsersStats[$Data['PageID']];
							
							if (is_array($Temp) === TRUE) {
								$TripsToSite = 0;
								$CurrentTimestamp = NULL;
								$FirstTimestamp = NULL;
								$LastTimestamp = NULL;
								$FutureTimestamp = NULL;
								
								$TimeSpent = NULL;
								$TotalTimeSpent = 0;
								
								if (is_array($IPAddressArray) === TRUE) {
									foreach($IPAddressArray as $Key => $Value) {
										// FILTER_VAR ONLY RETURNS FALSE OR THE ARRAY VALUE - IT WILL NOT RETURN BOOLEAN TRUE
										if (filter_var($Key, FILTER_VALIDATE_IP) == TRUE) {
											$IPAddressArray[$Key]['TripsToSite'] = 0;
											if (is_array($Value) === TRUE) {
												if (is_array($Value['Data']) === TRUE) {
													foreach($Value['Data'] as $SubKey => $SubValue) {
														$CurrentTimestamp = $SubValue['Timestamp'];
														//$CurrentTimestamp = $SubValue['Timestamp'];
														$TempTimestamp = new DateTime($CurrentTimestamp);
														$CurrentTimestamp = $TempTimestamp->format('U');
														//$CurrentTimestamp = strtotime($CurrentTimestamp);
														if ($FirstTimestamp != NULL) {
															if ($CurrentTimestamp > $FutureTimestamp) {
																if ($LastTimestamp != NULL) {
																	$TimeSpent = abs($FirstTimestamp - $LastTimestamp) / 60;
																	$TotalTimeSpent = $TotalTimeSpent + $TimeSpent;
																}
																
																$FirstTimestamp = $CurrentTimestamp;
																$FutureTimestamp = new DateTime('@' . $FirstTimestamp);
																$FutureTimestamp->modify('+1 hour');
																$FutureTimestamp = $FutureTimestamp->format('U');
																$LastTimestamp = NULL;
																$TripsToSite++;
															} else {
																$LastTimestamp = $CurrentTimestamp;
															}
														} else {
															$FirstTimestamp = $CurrentTimestamp;
															$FutureTimestamp = new DateTime('@' . $FirstTimestamp);
															$FutureTimestamp->modify('+1 hour');
															$FutureTimestamp = $FutureTimestamp->format('U');
															$TripsToSite++;
														}
														$IPAddressArray[$Key]['TripsToSite'] = $TripsToSite;
														if ($TripsToSite >= 2) {
															$RepeatVisitors++;
														}
													}
												}
											}
										}
										$TripsToSite = 0;
									}
									
									$TripsToSiteData[$Data['PageID']]['RepeatVisitors'] = $RepeatVisitors;
									$TripsToSiteData[$Data['PageID']]['TimeSpent'] = $TimeSpent;
									$TripsToSiteData[$Data['PageID']]['TotalTimeSpent'] = $TotalTimeSpent;
								}
							}
						} else {
							return FALSE;
						}
					} else {
						return FALSE;
					}
				}
				
				$TripsToSiteData['IPAddressData'] = $IPAddressData;
				
				// RETURN DATA HERE
				$ReturnData = array();
				$ReturnData['Data'] = $TripsToSiteData;
				return $ReturnData;
			} else {
				return FALSE;
			}
		} else {
			return FALSE;
		}
	}
?>