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
	
	/*
		THIS FILE MAY HAVE BEEN REPLACED WITH GRIDSTATSDATA.PH INSIDE OF GRIDSTATSDATA FOLDER
	*/
	
	
	$RefererPage = $_SERVER['HTTP_REFERER'];
	$RefererPageArray = explode('?', $RefererPage);
	$RefererPage = $RefererPageArray[0];
	$ServerLocation = "http://" . $_SERVER['SERVER_NAME'];
	
	unset($RefererPageArray);
	
	//if ($RefererPage == $ServerLocation . "/Administrators/Panel/Managers/StatsManager/StatsManager.php") {
		//if ($_SERVER['HTTP_X_REQUESTED_WITH'] === 'XMLHttpRequest') {
			set_time_limit(120);
			ini_set("memory_limit","256M");
			
			///error_reporting(0);
			
			$HOME = $_SERVER['SUBDOMAIN_DOCUMENT_ROOT'];
			$ADMINHOME = $HOME . '/Administrators/';
			$GLOBALS['HOME'] = $HOME;
			$GLOBALS['ADMINHOME'] = $ADMINHOME;
			
			$Type = $_GET['Type']; // ADStats, SiteStats
			$Name = $_GET['Name']; // Overall, Browsers, BrowsersVersions, Plugins, OS\'s, OSVersions, Languagues, Countries, IPAddresses only options
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
			// CREATE AN INI FILE FOR ALL FUNCTION FILES NEEDED
			require_once('Functions/BuildColumns.php');
			require_once('Functions/BuildRows.php');
			
			require_once('Functions/BuildColumnTemplate.php');
			require_once('Functions/BuildColumnNames.php');
			
			require_once('Functions/GridStatsData/Tabs/BuildBrowsers.php');
			require_once('Functions/GridStatsData/Tabs/BuildBrowsersVersions.php');
			require_once('Functions/GridStatsData/Tabs/BuildPlugins.php');
			
			$GridStatsDataConfigurationFileName = '../../../Configuration/Managers/StatsManager/GridStatsData/Settings.ini';
			if (file_exists($GridStatsDataConfigurationFileName)) {
				$GridStatsDataConfiguration = parse_ini_file($GridStatsDataConfigurationFileName, true);
			} else {
				$GridStatsDataConfiguration = NULL;
			}
			
			// SiteStats Function Starts Here
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
				
				$IPAddressBrowsersStats = $BrowsersStats;
				
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
			}
		}
		
		// Header Information
		$Elements = array();
		
		if ($Name !== 'IPAddresses' & isset($Name)) {
			$DefaultColumnsArray = $GridStatsDataConfiguration['Default Columns'];
		} else if ($Name === 'IPAddresses') {
			$DefaultColumnsArray = $GridStatsDataConfiguration['IP Address Columns'];
		}
		
		if ($DefaultColumnsArray != NULL) {
			if ($DefaultColumnsArray != NULL & is_array($DefaultColumnsArray) === TRUE) {
				foreach ($DefaultColumnsArray as $DefaultColumnsElementsKey => $DefaultColumnsElements) {
					if (is_array($DefaultColumnsElements) === TRUE) {
						foreach ($DefaultColumnsElements as $DefaultColumnsDataKey => $DefaultColumnsData) {
							if (empty($DefaultColumnsData) === FALSE) {
								$Elements[$DefaultColumnsDataKey][$DefaultColumnsElementsKey] = $DefaultColumnsData;
							}
						}
					}
				}
			}
		}
		
		switch ($Name) {
			// CREATE A SPECIAL FUNCTION THAT WILL READ AN INI FILE THAT CONTAINS A LISTING OF TAB NAMES AND FUNCTION CALLS THAT
			// THAT WILL ALLOW THE ADDING A NEW TAB AND NEW FUNCTION AS EASY AS UPDATING THE INI FILE.
			case "Overall":
				$FileName = $GridStatsDataConfiguration['Tab Configuration Files']['Overall'];
				if (file_exists($FileName)) {
					$OverallConfiguration = parse_ini_file($FileName, true);
				} else {
					$OverallConfiguration = NULL;
				}
				
				$ColumnNames = array();
				buildColumnTemplate($OverallConfiguration, $Elements);
				buildColumnNames($OverallConfiguration, $ColumnNames);
				
				$Page->startElement('head');
					buildColumns($Elements, $ColumnNames, $Page);
				$Page->fullEndElement(); // ENDS HEAD
				
				break;
			case "Browsers":
				$FileName = $GridStatsDataConfiguration['Tab Configuration Files']['Browsers'];
				if (file_exists($FileName)) {
					$BrowsersConfiguration = parse_ini_file($FileName, true);
				} else {
					$BrowsersConfiguration = NULL;
				}
				
				$ColumnNames = array();
				buildColumnTemplate($BrowsersConfiguration, $Elements);
				buildColumnNames($BrowsersConfiguration, $ColumnNames);
				
				$Page->startElement('head');
					buildColumns($Elements, $ColumnNames, $Page);
				$Page->fullEndElement(); // ENDS HEAD
				break;
			case "BrowsersVersions":
				// ->>>>>>>>>>>>>>> FUNCTION NEEDED
				if (is_array($PageListings)) {
					require_once('Functions/BuildBrowsersVersionsColumnNames.php');
					
					$FileName = $GridStatsDataConfiguration['Tab Configuration Files']['BrowsersVersions'];
					if (file_exists($FileName)) {
						$BrowsersVersionsConfiguration = parse_ini_file($FileName, true);
					} else {
						$BrowsersVersionsConfiguration = NULL;
					}
					
					$ReturnData = buildBrowsersVersionsColumnNames($PageListings, $BrowsersStats, $FileName);
					
					if (is_array($ReturnData)) {
						$IEVersions = $ReturnData['Versions']['IEVersions'];
						$FirefoxVersions = $ReturnData['Versions']['FirefoxVersions'];
						$SafariVersions = $ReturnData['Versions']['SafariVersions'];
						$ChromeVersions = $ReturnData['Versions']['ChromeVersions'];
						$OperaVersions = $ReturnData['Versions']['OperaVersions'];
						
						$VersionsData = $ReturnData['VersionsData'];
					}
					
					$ColumnNames = array();
					buildColumnTemplate($BrowsersVersionsConfiguration, $Elements);
					buildColumnNames($BrowsersVersionsConfiguration, $ColumnNames);
				
					$Page->startElement('head');
						if (is_array($IEVersions)) {
							foreach ($IEVersions as $Key => $Value) {
								$ColumnNames[] = 'IE ' . $Value;
							}
						}
						
						if (is_array($FirefoxVersions)) {
							foreach ($FirefoxVersions as $Key => $Value) {
								$ColumnNames[] = 'Firefox ' . $Value;
							}
						}
						
						if (is_array($SafariVersions)) {
							foreach ($SafariVersions as $Key => $Value) {
								$ColumnNames[] = 'Safari ' . $Value;
							}
						}
						
						if (is_array($ChromeVersions)) {
							foreach ($ChromeVersions as $Key => $Value) {
								$ColumnNames[] = 'Chrome ' . $Value;
							}
						}
						
						if (is_array($OperaVersions)) {
							foreach ($OperaVersions as $Key => $Value) {
								$ColumnNames[] = 'Opera ' . $Value;
							}
						}
						
						buildColumns($Elements, $ColumnNames, $Page);
					$Page->fullEndElement(); // ENDS HEAD
					// END FUNCTION
				}
				break;
			case "Plugins":
				$FileName = $GridStatsDataConfiguration['Tab Configuration Files']['Plugins'];
				if (file_exists($FileName)) {
					$PluginsConfiguration = parse_ini_file($FileName, true);
				} else {
					$PluginsConfiguration = NULL;
				}
				
				$ColumnNames = array();
				buildColumnTemplate($PluginsConfiguration, $Elements);
				buildColumnNames($PluginsConfiguration, $ColumnNames);
				
				$Page->startElement('head');
					buildColumns($Elements, $ColumnNames, $Page);
				$Page->fullEndElement(); // ENDS HEAD
				break;
			case "OS\'s":
				if (is_array($PageListings)) {
					$FileName = $GridStatsDataConfiguration['Tab Configuration Files']['OSs'];
					if (file_exists($FileName)) {
						$OSsConfiguration = parse_ini_file($FileName, true);
					} else {
						$OSsConfiguration = NULL;
					}
					
					$ColumnNames = array();
					buildColumnTemplate($OSsConfiguration, $Elements);
					buildColumnNames($OSsConfiguration, $ColumnNames);
					
					require_once('Functions/BuildOSes.php');
					$ReturnData = buildOSes($BrowsersStats);
					
					$OSes = $ReturnData['Types'];
					$OSesData = $ReturnData['Data'];
					
					foreach ($OSes as $OSKey => $OSValue) {
						if ($OSValue != NULL) {
							$ColumnNames[] = $OSValue;
						}
					}
					
					$Page->startElement('head');
						buildColumns($Elements, $ColumnNames, $Page);
					$Page->fullEndElement(); // ENDS HEAD
				}
				break;
			case "OSVersions":
				if (is_array($PageListings)) {
					$FileName = $GridStatsDataConfiguration['Tab Configuration Files']['OSVersions'];
					if (file_exists($FileName)) {
						$OSVersionssConfiguration = parse_ini_file($FileName, true);
					} else {
						$OSVersionssConfiguration = NULL;
					}
					
					$ColumnNames = array();
					buildColumnTemplate($OSVersionssConfiguration, $Elements);
					buildColumnNames($OSVersionssConfiguration, $ColumnNames);
					
					require_once('Functions/BuildOSesVersionsColumnNames.php');
					$ReturnData = buildOSesVersionsColumnNames($PageListings, $BrowsersStats, $FileName);
					$OSes = $ReturnData['Types'];
					$OSesData = $ReturnData['Data'];
					
					foreach ($OSes as $OSKey => $OSValue) {
						if ($OSValue != NULL) {
							$ColumnNames[] = $OSValue;
						}
					}
					
					$Page->startElement('head');
						buildColumns($Elements, $ColumnNames, $Page);
					$Page->fullEndElement(); // ENDS HEAD
				}
				break;
			case "Languages":
				if (is_array($PageListings)) {
					$FileName = $GridStatsDataConfiguration['Tab Configuration Files']['Languages'];
					if (file_exists($FileName)) {
						$LanguagesConfiguration = parse_ini_file($FileName, true);
					} else {
						$LanguagesConfiguration = NULL;
					}
					
					$ColumnNames = array();
					buildColumnTemplate($LanguagesConfiguration, $Elements);
					buildColumnNames($LanguagesConfiguration, $ColumnNames);
					
					require_once('Functions/BuildLanguages.php');
					$ReturnData = buildLanguages($BrowsersStats, $LanguagesConfiguration);
					
					$Languages = $ReturnData['Types'];
					$LanguagesData = $ReturnData['Data'];
					
					foreach ($Languages as $LanguagesKey => $LanguagesValue) {
						if ($LanguagesValue != NULL) {
							$ColumnNames[] = $LanguagesValue;
						}
					}

					$Page->startElement('head');
						buildColumns($Elements, $ColumnNames, $Page);
					$Page->fullEndElement(); // ENDS HEAD
				}
				break;
			case "Countries":
				/*if (is_array($PageListings)) {
					$FileName = $GridStatsDataConfiguration['Tab Configuration Files']['Countries'];
					if (file_exists($FileName)) {
						$CountryConfiguration = parse_ini_file($FileName, true);
					} else {
						$CountryConfiguration = NULL;
					}
					
					$ColumnNames = array();
					buildColumnTemplate($CountryConfiguration, $Elements);
					buildColumnNames($CountryConfiguration, $ColumnNames);
					
					require_once('Functions/BuildCountries.php');
					$ReturnData = buildCountries($BrowsersStats, $CountryConfiguration);
					
					$Countries = $ReturnData['Types'];
					$CountriesData = $ReturnData['Data'];
					
					foreach ($Countries as $CountriesKey => $CountriesValue) {
						if ($CountriesValue != NULL) {
							$ColumnNames[] = $CountriesValue;
						}
					}
					
					$Page->startElement('head');
						buildColumns($Elements, $ColumnNames, $Page);
					$Page->fullEndElement(); // ENDS HEAD
				}
				break;*/
			case "IPAddresses":

				break;
		}
		
		if (is_array($PageListings)) {
			foreach ($PageListings as $Key => $Data) {
				if ($Name != 'IPAddresses') {
					$Information = array();
					$Attributes = array();
					
					$Page->startElement('row');
					$Page->writeAttribute('id', $Data['PageID']);
						$Information[] = $Data['PageID'];
						$Information[] = $Data['ContentPageMenuTitle'];
						
						if (is_array($SiteStats)) {
							$Temp = $SiteStats[$Data['PageID']];
							$TotalCount = 0;
							
							if ($Temp != NULL) {
								$TotalCount = count($Temp);
							}
							
							$Information[] = $TotalCount;
							
						}
						
						if (is_array($BrowsersStats)) {
							$Temp = $BrowsersStats[$Data['PageID']];
							$HumanCount = 0;
							
							if ($Temp != NULL) {
								$HumanCount = count($Temp);
							}
							
							$Information[] = $HumanCount;
						}
						
						if ($Name == 'Overall') {
							// ->>>>>>>>>>>>>>> FUNCTION NEEDED
							// OVERALL STATS
							// MOVE TO A FUNCTION WITH CONFIGURATION FROM INI FILE
							if (is_array($BrowsersStats)) {
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
								
								$IPAddressArray = array();
								$IPAddress = NULL;
								$IPAddressHit = NULL;
								
								$ReferrersArray = array();
								$ReferrersAddress = NULL;
								$ReferrersHit = NULL;
								
								// Creates an IP Address based array for each page on the site.
								if (is_array($Temp)) {
									foreach ($Temp as $Key => $Value) {
										$IPAddress = $Value['IPAddress'];
										if ($IPAddress != NULL) {
											if ($IPAddressArray[$IPAddress] != NULL) {
												$IPAddressArray[$IPAddress]['Data'][] = $Value;
												$IPAddressHit = $IPAddressArray[$IPAddress]['Hits'];
												$IPAddressHit++; 
												$IPAddressArray[$IPAddress]['Hits'] = $IPAddressHit;
											} else {
												$IPAddressArray[$IPAddress]['Hits'] = 1;
												$IPAddressArray[$IPAddress]['Data'][] = $Value;
											}
										}
										
										if (strstr($Value['NavigatorUserAgent'], 'http://www.google.com/bot.html') == TRUE) {
											$GoogleBot++;
										}
									}
									
									$TripsToSite = 0;
									$CurrentTimestamp = NULL;
									$FirstTimestamp = NULL;
									$LastTimestamp = NULL;
									$FutureTimestamp = NULL;
									
									$TimeSpent = NULL;
									$TotalTimeSpent = 0;
									
									// Trips To Site
									if (is_array($IPAddressArray)) {
										foreach($IPAddressArray as $Key => $Value) {
											$IPAddressArray[$Key]['TripsToSite'] = 0;
											if (is_array($Value)) {
												if (is_array($Value['Data'])) {
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
											
											$TripsToSite = 0;
										}
									}
								}
								
								$Temp = $SiteStats[$Data['PageID']];
								
								// Figures out refereals hits
								if (is_array($Temp)) {
									foreach ($Temp as $Key => $Value) {
										$ReferrersAddress = $Value['HttpRefer'];
										
										if ($ReferrersAddress != NULL) {
											if ($ReferrersArray[$ReferrersAddress] != NULL) {
												$ReferrersArray[$ReferrersAddress]['Data'][] = $Value;
												$ReferrersHit = $ReferrersArray[$ReferrersAddress]['Hits'];
												$ReferrersHit++; 
												$ReferrersArray[$ReferrersAddress]['Hits'] = $ReferrersHit;
											} else {
												$ReferrersArray[$ReferrersAddress]['Hits'] = 1;
												$ReferrersArray[$ReferrersAddress]['Data'][] = $Value;
											}
										}
									}
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
								
								// Entrance and Exit Page Views
								$CurrentTimestamp = NULL;
								$FirstTimestamp = NULL;
								$LastTimestamp = NULL;
								$FutureTimestamp = NULL;
								$Exit = NULL;
								
								$BounceRateCount = 0;
								
								foreach ($IPAddressBrowsersStats as $Key => $Value) {
									if (is_array($Value) === TRUE) {
										foreach ($Value as $SubKey => $SubValue) {
											if (strstr($SubValue['NavigatorUserAgent'], 'http://www.google.com/bot.html') == TRUE) {
												
											} else {
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
														
														if (is_array($CurrentPageID)) {
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
													
													if (is_array($CurrentPageID)) {
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
								
								buildRows($Information, $Attributes, $Page);
							}
							// END FUNCTION
						}
						
						if ($Name == 'Browsers') {
							$FileName = $GridStatsDataConfiguration['Tab Configuration Files']['Browsers'];
							
							$BuildRowsInformation = array();
							$BuildRowsInformation['Information'] = $Information;
							$BuildRowsInformation['Attributes'] = $Attributes;
							$BuildRowsInformation['Page'] = $Page;
							
							buildBrowsers($Data, $BrowsersStats, $BuildRowsInformation, $FileName);
							
						} else if ($Name == 'BrowsersVersions') {
							$FileName = $GridStatsDataConfiguration['Tab Configuration Files']['BrowsersVersions'];
							
							$BuildRowsInformation = array();
							$BuildRowsInformation['Information'] = $Information;
							$BuildRowsInformation['Attributes'] = $Attributes;
							$BuildRowsInformation['Page'] = $Page;
							$BuildRowsInformation['ColumnNames'] = $ColumnNames;
							
							buildBrowsersVersions($Data, $VersionsData, $BuildRowsInformation, $FileName);
							
						} else if ($Name == 'Plugins') {
							$FileName = $GridStatsDataConfiguration['Tab Configuration Files']['Plugins'];
							
							$BuildRowsInformation = array();
							$BuildRowsInformation['Information'] = $Information;
							$BuildRowsInformation['Attributes'] = $Attributes;
							$BuildRowsInformation['Page'] = $Page;
							
							buildPlugins($Data, $BrowsersStats, $BuildRowsInformation, $FileName);
							
						} else if ($Name == "OS\'s") {
							// ->>>>>>>>>>>>>>> FUNCTION NEEDED
							if (is_array($BrowsersStats)) {
								$TempPageID = $Data['PageID'];
								
								if (isset($OSesData[$TempPageID]['Google Bot Views'])) {
									$Information[] = $OSesData[$TempPageID]['Google Bot Views'];
								} else {
									$Information[] = 0;
								}
								
								foreach ($OSes as $OSKey => $OSValue) {
									if (isset($OSesData[$TempPageID][$OSValue])) {
										$Information[] = $OSesData[$TempPageID][$OSValue];
									} else {
										$Information[] = 0;
									}
								}
							}
							
							buildRows($Information, $Attributes, $Page);
							
						} else if ($Name == 'OSVersions') {
							if (is_array($BrowsersStats)) {
								$TempPageID = $Data['PageID'];
								
								if (isset($OSesData[$TempPageID]['Google Bot Views'])) {
									$Information[] = $OSesData[$TempPageID]['Google Bot Views'];
								} else {
									$Information[] = 0;
								}
								
								foreach ($OSes as $OSKey => $OSValue) {
									if (isset($OSesData[$TempPageID][$OSValue])) {
										$Information[] = $OSesData[$TempPageID][$OSValue];
									} else {
										$Information[] = 0;
									}
								}
							}
							
							buildRows($Information, $Attributes, $Page);
							
						} else if ($Name == 'Languages') {
							if (is_array($BrowsersStats)) {
								$TempPageID = $Data['PageID'];
								
								if (isset($LanguagesData[$TempPageID]['Google Bot Views'])) {
									$Information[] = $LanguagesData[$TempPageID]['Google Bot Views'];
								} else {
									$Information[] = 0;
								}
								
								foreach ($Languages as $LanguageKey => $LanguageValue) {
									if (isset($LanguagesData[$TempPageID][$LanguageValue])) {
										$Information[] = $LanguagesData[$TempPageID][$LanguageValue];
									} else {
										$Information[] = 0;
									}
								}
							}
							
							buildRows($Information, $Attributes, $Page);
						} else if ($Name == 'Countries') {
							/*if (is_array($BrowsersStats)) {
								$TempPageID = $Data['PageID'];
								
								if (isset($CountriesData[$TempPageID]['Google Bot Views'])) {
									$Information[] = $CountriesData[$TempPageID]['Google Bot Views'];
								} else {
									$Information[] = 0;
								}
								
								foreach ($Countries as $CountriesKey => $CountriesValue) {
									if (isset($CountriesData[$TempPageID][$CountriesValue])) {
										$Information[] = $CountriesData[$TempPageID][$CountriesValue];
									} else {
										$Information[] = 0;
									}
								}
							}
							
							buildRows($Information, $Attributes, $Page);
							*/
						}
					$Page->endElement(); // ENDS ROW
				} else {
					// FOR IP ADDRESSES
				}
			}
			// SiteStats Function Ends Here
		
		//} else {
			//header("HTTP/1.0 404 Not Found");
		//}
	//} else {
		//header("HTTP/1.0 404 Not Found");
	//}
?>