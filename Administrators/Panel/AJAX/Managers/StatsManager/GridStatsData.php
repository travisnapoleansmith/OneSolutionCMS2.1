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
		if ($_SERVER['HTTP_X_REQUESTED_WITH'] === 'XMLHttpRequest') {
			set_time_limit(120);
			ini_set("memory_limit","256M");
			
			//error_reporting(0);
			
			$HOME = $_SERVER['SUBDOMAIN_DOCUMENT_ROOT'];
			$ADMINHOME = $HOME . '/Administrators/';
			$GLOBALS['HOME'] = $HOME;
			$GLOBALS['ADMINHOME'] = $ADMINHOME;
			
			$Type = $_GET['Type']; // ADStats, SiteStats
			$Name = $_GET['Name']; // Browsers, BrowsersVersions, Plugins, OS\'s, OSVersions, Languagues, Countries, IPAddresses only options
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
			require_once('Functions/BuildColumns.php');
			require_once('Functions/BuildRows.php');
			
			$Page->startElement('rows');
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
				/*$Tier2Databases->createDatabaseTable($PageListingsTable);
				$Tier2Databases->Connect($PageListingsTable);
				$Tier2Databases->pass ($PageListingsTable, "setEntireTable", array());
				$PageListings= $Tier2Databases->pass ($PageListingsTable, "getEntireTable", array());
				$Tier2Databases->Disconnect($PageListingsTable);*/
				
				// Header Information
				if ($Name !== 'IPAddresses' & isset($Name)) {
					$Elements = array();
					$Elements[0]['text'] = 'PageID';
					$Elements[0]['width'] = 75;
					$Elements[0]['align'] = 'left';
					$Elements[0]['type'] = 'ro';
					$Elements[0]['sort'] = 'int';
					
					$Elements[1]['text'] = 'Page Name';
					$Elements[1]['width'] = 325;
					$Elements[1]['align'] = 'left';
					$Elements[1]['type'] = 'ro';
					$Elements[1]['sort'] = 'str';
					
					$Elements[2]['text'] = 'Total Views';
					$Elements[2]['width'] = 80;
					$Elements[2]['align'] = 'left';
					$Elements[2]['type'] = 'ro';
					$Elements[2]['sort'] = 'int';
					
					$Elements[3]['text'] = 'Human Views';
					$Elements[3]['width'] = 80;
					$Elements[3]['align'] = 'left';
					$Elements[3]['type'] = 'ro';
					$Elements[3]['sort'] = 'int';
				} else if ($Name === 'IPAddresses') {
				
				}
				
				switch ($Name) {
					case "Browsers":
						// MAKE ALL ELEMENTS IN ARRAY - MOVE TO INI FILE
						$Elements['TEMPLATE']['width'] = 95;
						$Elements['TEMPLATE']['align'] = 'left';
						$Elements['TEMPLATE']['type'] = 'ro';
						$Elements['TEMPLATE']['sort'] = 'int';
						
						$ColumnNames = array();
						$ColumnNames[] = 'Google Bot Views';
						$ColumnNames[] = 'IE Views';
						$ColumnNames[] = 'Firefox Views';
						$ColumnNames[] = 'Safari Views';
						$ColumnNames[] = 'Chrome Views';
						$ColumnNames[] = 'Opera Views';
						$ColumnNames[] = 'Unknown Views';
						
						$Page->startElement('head');
							buildColumns($Elements, $ColumnNames, $Page);
						$Page->fullEndElement(); // ENDS HEAD
						break;
					case "BrowsersVersions":
						if (is_array($PageListings)) {
							require_once('Functions/BuildBrowsersVersions.php');
							$ReturnData = buildBrowsersVersions($PageListings, $BrowsersStats);
							if (is_array($ReturnData)) {
								$IEVersions = $ReturnData['Versions']['IEVersions'];
								$FirefoxVersions = $ReturnData['Versions']['FirefoxVersions'];
								$SafariVersions = $ReturnData['Versions']['SafariVersions'];
								$ChromeVersions = $ReturnData['Versions']['ChromeVersions'];
								$OperaVersions = $ReturnData['Versions']['OperaVersions'];
								
								$VersionsData = $ReturnData['VersionsData'];
							}
							
							$Elements[4]['text'] = 'Google Bot Views';
							$Elements[4]['width'] = 95;
							$Elements[4]['align'] = 'left';
							$Elements[4]['type'] = 'ro';
							$Elements[4]['sort'] = 'int';
							
							$Elements['TEMPLATE']['width'] = 90;
							$Elements['TEMPLATE']['align'] = 'left';
							$Elements['TEMPLATE']['type'] = 'ro';
							$Elements['TEMPLATE']['sort'] = 'int';
							
							$ColumnNames = array();
							
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
						}
						break;
					case "Plugins":
						$Elements['TEMPLATE']['width'] = 75;
						$Elements['TEMPLATE']['align'] = 'left';
						$Elements['TEMPLATE']['type'] = 'ro';
						$Elements['TEMPLATE']['sort'] = 'int';
						
						$ColumnNames = array();
						$ColumnNames[] = 'Adobe Reader';
						$ColumnNames[] = 'Devalvr';
						$ColumnNames[] = 'Flash';
						$ColumnNames[] = 'PDFJS';
						$ColumnNames[] = 'PDF';
						$ColumnNames[] = 'Quicktime';
						$ColumnNames[] = 'Real Media Player';
						$ColumnNames[] = 'Shockwave';
						$ColumnNames[] = 'Silverlight';
						$ColumnNames[] = 'VLC';
						$ColumnNames[] = 'Windows Media Player';
						
						$Page->startElement('head');
							buildColumns($Elements, $ColumnNames, $Page);
						$Page->fullEndElement(); // ENDS HEAD
						break;
					case "OS\'s":
						if (is_array($PageListings)) {
							$Elements['TEMPLATE']['width'] = 95;
							$Elements['TEMPLATE']['align'] = 'left';
							$Elements['TEMPLATE']['type'] = 'ro';
							$Elements['TEMPLATE']['sort'] = 'int';
							
							$ColumnNames = array();
							$ColumnNames[] = 'Google Bot Views';
							
							// MAKE THIS INTO A FUNCTION
							$OSes = array();
							$OSesData = array();
							foreach($BrowsersStats as $Key => $Value) {
								foreach ($Value as $SubKey => $SubValue) {
									$TempPageID = $SubValue['PageID'];
									$OSType = $SubValue['OS'];
									if (strstr($SubValue['NavigatorUserAgent'], 'http://www.google.com/bot.html') == TRUE) {
										$OSType = 'Google Bot Views';
									} else {
										if ($OSType != NULL) {
											if ($OSType == 'Linux') {
												if (strstr($SubValue['NavigatorUserAgent'], 'Android') == TRUE) {
													$OSType = 'Android';
												}
											} else if ($OSType == '100') {
												if (strstr($SubValue['NavigatorUserAgent'], 'Android') == TRUE) {
													$OSType = 'Android';
												} else if (strstr($SubValue['NavigatorUserAgent'], 'BlackBerry') == TRUE) {
													$OSType = 'BlackBerry OS';
												} else if (strstr($SubValue['NavigatorUserAgent'], 'iPhone') == TRUE) {
													$OSType = 'iPhone';
												} else if (strstr($SubValue['NavigatorUserAgent'], 'J2ME/MIDP') == TRUE) {
													$OSType = 'J2ME/MIDP Phone';
												} else if (strstr($SubValue['NavigatorUserAgent'], 'J2ME') == TRUE) {
													$OSType = 'J2ME Phone';
												} else {
													$OSType = 'Unknown Phone';
												}
											}
										} else {
											$OSType = 'Unknown';
										}
									}
									
									if ($OSType !== 'Google Bot Views') {
										$OSes[$OSType] = $OSType;
									}
									
									if (isset($OSesData[$TempPageID][$OSType])) {
										$OSesData[$TempPageID][$OSType]++;
									} else {
										$OSesData[$TempPageID][$OSType] = 1;
									}
								}
							}
							
							ksort($OSes, SORT_STRING);
							// END FUNCTION
							
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
						
						break;
					case "Languagues":
						
						break;
					case "Countries":
						
						break;
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
								
								if ($Name == 'Browsers') {
									if (is_array($BrowsersStats)) {
										$Temp = $BrowsersStats[$Data['PageID']];
										
										$GoogleBot = 0;
										$IEHits = 0;
										$FirefoxHits = 0;
										$SafariHits = 0;
										$ChromeHits = 0;
										$OperaHits = 0;
										$UnknownHits = 0;
										
										if (is_array($Temp)) {
											foreach ($Temp as $Key => $Value) {
												if (strstr($Value['NavigatorUserAgent'], 'http://www.google.com/bot.html') == TRUE) {
													$GoogleBot++;
												} else if ($Value['IEVersion'] != NULL || $Value['IETrueVersion'] != NULL || $Value['IEDocMode'] != NULL || strstr($Value['NavigatorUserAgent'], 'MSIE') == TRUE) {
													$IEHits++;
												} else if ($Value['GeckoVersion'] != NULL || strstr($Value['NavigatorUserAgent'], 'Firefox') == TRUE) {
													$FirefoxHits++;
												} else if ($Value['SafariVersion'] != NULL || (strstr($Value['NavigatorUserAgent'], 'Safari') == TRUE && strstr($Value['NavigatorUserAgent'], 'Chrome') == FALSE)) {
													$SafariHits++;
												} else if ($Value['ChromeVersion'] != NULL || strstr($Value['NavigatorUserAgent'], 'Chrome') == TRUE) {
													$ChromeHits++;
												} else if ($Value['OperaVersion'] != NULL || strstr($Value['NavigatorUserAgent'], 'Opera') == TRUE) {
													$OperaHits++;
												} else {
													$UnknownHits++;
												}
											}
										}
										
										$Information[] = $GoogleBot;
										$Information[] = $IEHits;
										$Information[] = $FirefoxHits;
										$Information[] = $SafariHits;
										$Information[] = $ChromeHits;
										$Information[] = $OperaHits;
										$Information[] = $UnknownHits;
										
										buildRows($Information, $Attributes, $Page);
									}
								} else if ($Name == 'BrowsersVersions') {
									$TempPageID = $Data['PageID'];
									if (is_array($BrowsersStats)) {
										$Temp = $BrowsersStats[$Data['PageID']];
										
										$GoogleBot = 0;
										
										if (is_array($Temp)) {
											foreach ($Temp as $Key => $Value) {
												if (strstr($Value['NavigatorUserAgent'], 'http://www.google.com/bot.html') == TRUE) {
													$GoogleBot++;
												}
											}
										}
										
										$Information[] = $GoogleBot;
									}
									
									foreach ($IEVersions as $VersionsKey => $VersionsValue) {
										if (isset($VersionsData[$TempPageID]['IEVersion'][$VersionsValue])) {
											$Information[] = $VersionsData[$TempPageID]['IEVersion'][$VersionsValue];
										} else {
											$Information[] = 0;
										}
									}
									
									foreach ($FirefoxVersions as $VersionsKey => $VersionsValue) {
										if ($VersionsData[$TempPageID]['FirefoxVersion'][$VersionsValue] != NULL) {
											$Information[] = $VersionsData[$TempPageID]['FirefoxVersion'][$VersionsValue];
										} else {
											$Information[] = 0;
										}
									}
									
									foreach ($SafariVersions as $VersionsKey => $VersionsValue) {
										if ($VersionsData[$TempPageID]['SafariVersion'][$VersionsValue] != NULL) {
											$Information[] = $VersionsData[$TempPageID]['SafariVersion'][$VersionsValue];
										} else {
											$Information[] = 0;
										}
									}
									
									foreach ($ChromeVersions as $VersionsKey => $VersionsValue) {
										if ($VersionsData[$TempPageID]['ChromeVersion'][$VersionsValue] != NULL) {
											$Information[] = $VersionsData[$TempPageID]['ChromeVersion'][$VersionsValue];
										} else {
											$Information[] = 0;
										}
									}
									
									foreach ($OperaVersions as $VersionsKey => $VersionsValue) {
										if ($VersionsData[$TempPageID]['OperaVersion'][$VersionsValue] != NULL) {
											$Information[] = $VersionsData[$TempPageID]['OperaVersion'][$VersionsValue];
										} else {
											$Information[] = 0;
										}
									}
									buildRows($Information, $Attributes, $Page);
								} else if ($Name == 'Plugins') {
									if (is_array($BrowsersStats)) {
										$Temp = $BrowsersStats[$Data['PageID']];
										
										$AdobeReaderHits = 0;
										$DevalvrHits = 0;
										$FlashHits = 0;
										$PDFJSHits = 0;
										$PDFHits = 0;
										$QuicktimeHits = 0;
										$RealPlayerHits = 0;
										$ShockwaveHits = 0;
										$SilverlightHits = 0;
										$VLCHits = 0;
										$WindowsMediaPlayerHits = 0;
										
										if (is_array($Temp)) {
											foreach ($Temp as $Key => $Value) {
												if ($Value['AdobeReaderVersion'] != NULL) {
													$AdobeReaderHits++;
												}
												
												if ($Value['DevalvrVersion'] != NULL) {
													$DevalvrHits++;
												}
												
												if ($Value['FlashVersion'] != NULL) {
													$FlashHits++;
												}
												
												if ($Value['PDFJSVersion'] != NULL) {
													$PDFJSHits++;
												}
												
												if ($Value['PDFReaderVersion'] != NULL) {
													$PDFHits++;
												}
												
												if ($Value['QuicktimeVersion'] != NULL) {
													$QuicktimeHits++;
												}
												
												if ($Value['RealPlayerVersion'] != NULL) {
													$RealPlayerHits++;
												}
												
												if ($Value['ShockWaveVersion'] != NULL) {
													$ShockwaveHits++;
												}
												
												if ($Value['SilverlightVersion'] != NULL) {
													$SilverlightHits++;
												}
												
												if ($Value['VLCVersion'] != NULL) {
													$VLCHits++;
												}
												
												if ($Value['WindowsMediaPlayerVersion'] != NULL) {
													$WindowsMediaPlayerHits++;
												}
												
											}
										}
										
										$Information[] = $AdobeReaderHits;
										$Information[] = $DevalvrHits;
										$Information[] = $FlashHits;
										$Information[] = $PDFJSHits;
										$Information[] = $PDFHits;
										$Information[] = $QuicktimeHits;
										$Information[] = $RealPlayerHits;
										$Information[] = $ShockwaveHits;
										$Information[] = $SilverlightHits;
										$Information[] = $VLCHits;
										$Information[] = $WindowsMediaPlayerHits;
									}
									
									buildRows($Information, $Attributes, $Page);
								} else if ($Name == "OS\'s") {
									if (is_array($BrowsersStats)) {
										$TempPageID = $Data['PageID'];
										
										if (isset($OSesData[$TempPageID]['Google Bot Hits'])) {
											$Information[] = $OSesData[$TempPageID]['Google Bot Hits'];
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
								
								} else if ($Name == 'Languages') {
								
								} else if ($Name == 'Countries') {
								
								}
							$Page->endElement(); // ENDS ROW
						} else {
							// FOR IP ADDRESSES
						}
					}
				}
				
				
			//}
			
			$Page->fullEndElement(); //ENDS ROWS
			
			$PageOutput = $Page->flush();
			header('Content-type: application/xml');
			print $PageOutput;
		
		} else {
			header("HTTP/1.0 404 Not Found");
		}
	} else {
		header("HTTP/1.0 404 Not Found");
	}
?>