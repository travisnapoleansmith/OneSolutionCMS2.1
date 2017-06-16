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
	
	function buildEntranceExitPageViewsData($IPAddressData, $IPAddressBrowsersStats, $BrowsersStats, $PageListings, $ConfigurationFileName) {
		/*if ($ConfigurationFileName == NULL) {
			return FALSE;
		}
		
		if (is_array($ConfigurationFileName) === TRUE) {
			return FALSE;
		}
		*/
		// MUST PASS A CONFIGURATION FILE NAME
		if ($PageListings != NULL) {
			if (is_array($PageListings) === TRUE) {
				$EntranceExitPageViewsData = array();
				foreach ($PageListings as $Key => $Data) {
					if ($IPAddressBrowsersStats != NULL) {
						if (is_array($IPAddressBrowsersStats) === TRUE) {
							if (file_exists($ConfigurationFileName) === TRUE) {
								$Configuration = parse_ini_file($ConfigurationFileName, true);
							} else {
								$Configuration = NULL;
							}
							
							$IPAddressArray = array();
							
							$HumanCount = 0;
							$ExitPageViews = 0;
							$ExitPagePercentage = 0;
							$EntrancePageViews = 0;
							$EntrancePagePercentage = 0;
							$BouncePageViews = 0;
							$BounceRatePercentage = 0;
							$GoogleBot = 0;
							
							$CurrentTimestamp = NULL;
							$FirstTimestamp = NULL;
							$LastTimestamp = NULL;
							$FutureTimestamp = NULL;
							$Exit = NULL;
							
							$BounceRateCount = 0;
							
							$IPAddressArray = $IPAddressData[$Data['PageID']];
							$GoogleBot = $IPAddressArray['GoogleBot'];
							
							if (is_array($BrowsersStats) === TRUE) {
								$Temp = $BrowsersStats[$Data['PageID']];
								$HumanCount = 0;
								
								if (isset($Temp[0]['Timestamp']) === TRUE) {
									$HumanCount = count($Temp);
								}
								
							} else {
								$HumanCount = 0;
							}
							
							foreach ($IPAddressBrowsersStats as $Key => $Value) {
								if (is_array($Value) === TRUE) {
									foreach ($Value as $SubKey => $SubValue) {
										if (strstr($SubValue['NavigatorUserAgent'], 'http://www.google.com/bot.html') == TRUE) {
											
										} else {
											// IF RECORDS EXISTS
											if (empty($SubValue) === FALSE) {
												$CurrentTimestamp = $SubValue['Timestamp'];
												$TempTimestamp = new DateTime($CurrentTimestamp); 
												$CurrentTimestamp = $TempTimestamp->format('U');
												//$CurrentTimestamp = strtotime($CurrentTimestamp);
												
												// Find a way to speed this up!
												if ($FirstTimestamp != NULL) {
													$TimeSpent = abs($CurrentTimestamp - $FirstTimestamp) / 60;
													if ($TimeSpent < 60) {
														$BounceRateCount++;
														$Exit = FALSE;
													} else {
														$FirstTimestamp = $CurrentTimestamp;
														$FutureTimestamp = new DateTime('@' . $FirstTimestamp);
														$FutureTimestamp->modify('+1 hour');
														$FutureTimestamp = $FutureTimestamp->format('U');
														$CurrentPageID = explode('?', $SubValue['RequestUri']);
														foreach ($CurrentPageID as $TempValue) {
															$Position = strpos($TempValue, 'PageID');
															if ($Position !== FALSE) {
																$CurrentPageID = str_replace('PageID=', '', $TempValue);
															}
														}
														
														if (is_array($CurrentPageID) === TRUE) {
															$CurrentPageID = 1;
														}
														
														if ($CurrentPageID == $Data['PageID']) {
															$EntrancePageViews++;
															if ($Exit === FALSE) {
																$Exit = TRUE;
															} else {
																$Exit = NULL;
															}
															
															if ($BounceRateCount == 1) {
																$BouncePageViews++;
															}
															
															$BounceRateCount = 1;
														} else {
															$Exit = NULL;
														}
													}
												} else {
													$FirstTimestamp = $CurrentTimestamp;
													$FutureTimestamp = new DateTime('@' . $FirstTimestamp);
													$FutureTimestamp->modify('+1 hour');
													$FutureTimestamp = $FutureTimestamp->format('U');
													
													$CurrentPageID = explode('?', $SubValue['RequestUri']);
													foreach ($CurrentPageID as $TempValue) {
														$Position = strpos($TempValue, 'PageID');
														if ($Position !== FALSE) {
															$CurrentPageID = str_replace('PageID=', '', $TempValue);
														}
													}
													
													if (is_array($CurrentPageID) === TRUE) {
														$CurrentPageID = 1;
													}
													
													if ($CurrentPageID == $Data['PageID']) {
														$EntrancePageViews++;
														
														if ($BounceRateCount == 1) {
															$BouncePageViews++;
														}
														
														$BounceRateCount = 1;
													}
												}
												
												if ($Exit === TRUE) {
													$ExitPageViews++;
												} else if ($Exit === FALSE) {
												
												} else if ($Exit === NULL) {
												
												}
											} else {
												// IF NO RECORDS EXISTS
											}
										}
									}
									
									if ($HumanCount != 0 && $GoogleBot != 0 && ($HumanCount - $GoogleBot) != 0) {
										$EntrancePagePercentage = $EntrancePageViews /($HumanCount - $GoogleBot);
										$EntrancePagePercentage = $EntrancePagePercentage * 100;
										$EntrancePagePercentage = round($EntrancePagePercentage, 4);
										
										$ExitPagePercentage = $ExitPageViews / ($HumanCount - $GoogleBot);
										$ExitPagePercentage = $ExitPagePercentage * 100;
										$ExitPagePercentage = round($ExitPagePercentage, 4);
										
										$BounceRatePercentage = $BouncePageViews / ($HumanCount - $GoogleBot);
										$BounceRatePercentage = $BounceRatePercentage * 100;
										$BounceRatePercentage = round($BounceRatePercentage, 4);
									} else if ($HumanCount != 0) {
										$EntrancePagePercentage = $EntrancePageViews / $HumanCount;
										$EntrancePagePercentage = $EntrancePagePercentage * 100;
										$EntrancePagePercentage = round($EntrancePagePercentage, 4);
										
										$BounceRatePercentage = $BouncePageViews / $HumanCount;
										$BounceRatePercentage = $BounceRatePercentage * 100;
										$BounceRatePercentage = round($BounceRatePercentage, 4);
									}
									
									$EntrancePagePercentage = number_format($EntrancePagePercentage, 4);
									$EntrancePagePercentage .= '%';
									
									$ExitPagePercentage = number_format($ExitPagePercentage, 4);
									$ExitPagePercentage .= '%';
									
									$BounceRatePercentage = number_format($BounceRatePercentage, 4);
									$BounceRatePercentage .= '%';
								
								}
								
							}
							
							$EntranceExitPageViewsData[$Data['PageID']]['ExitPageViews'] = $ExitPageViews;
							$EntranceExitPageViewsData[$Data['PageID']]['ExitPagePercentage'] = $ExitPagePercentage;
							$EntranceExitPageViewsData[$Data['PageID']]['EntrancePageViews'] = $EntrancePageViews;
							$EntranceExitPageViewsData[$Data['PageID']]['EntrancePagePercentage'] = $EntrancePagePercentage;
							$EntranceExitPageViewsData[$Data['PageID']]['BouncePageViews'] = $BouncePageViews;
							$EntranceExitPageViewsData[$Data['PageID']]['BounceRatePercentage'] = $BounceRatePercentage;
						} else {
							return FALSE;
						}
					} else {
						return FALSE;
					}
				}
				
				// RETURN DATA HERE
				$ReturnData = array();
				$ReturnData['Data'] = $EntranceExitPageViewsData;
				return $ReturnData;
			} else {
				return FALSE;
			}
		} else {
			return FALSE;
		}
	}
?>