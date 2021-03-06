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
	
	// Fix this to read the INI file for column headings.
	// Combine up the main program that sends information into this function!
	
	function buildBrowsersVersionsColumnNames($PageListings, $BrowsersStats, $ConfigurationFileName) {
		if ($PageListings != NULL) {
			if (is_array($PageListings) === TRUE) {
				
				if (file_exists($ConfigurationFileName) === TRUE) {
					$Configuration = parse_ini_file($ConfigurationFileName, true);
				} else {
					$Configuration = NULL;
				}
				
				$BrowserTypes = $Configuration['Types'];
				
				$IEVersions = array();
				$FirefoxVersions = array();
				$SafariVersions = array();
				$ChromeVersions = array();
				$OperaVersions = array();
				
				$VersionsData = array();
				foreach ($PageListings as $Key => $Data) {
					if (is_array($BrowsersStats) === TRUE) {
						$Temp = $BrowsersStats[$Data['PageID']];
						
						if (is_array($Temp) === TRUE) {
							foreach ($Temp as $Key => $Value) {
								$TempPageID = $Data['PageID'];
								
								// USE NEW CHECK OS VERSION FUNCTION AND USE THAT DATA TO DO CALCULATIONS
								
								if (strstr($Value['NavigatorUserAgent'], 'http://www.google.com/bot.html') == TRUE) {
									if ($VersionsData[$TempPageID]['Google Bot Views']!= NULL) {
										$VersionsData[$TempPageID]['Google Bot Views']++;
									} else {
										$VersionsData[$TempPageID]['Google Bot Views'] = 1;
									}
								} else if ($Value['IEVersion'] != NULL || $Value['IETrueVersion'] != NULL || $Value['IEDocMode'] != NULL || strstr($Value['NavigatorUserAgent'], 'MSIE') == TRUE) {
									$TempKey = $Value['IEVersion'];
									$IEVersions[$TempKey] = $TempKey;
									//$CurrentBrowserStats[$NewTempBrowserStatsKey . ' ' . $TempBrowserStatsDataKey] = $TempBrowserStatsDataData;
									if ($VersionsData[$TempPageID]['IEVersion'][$TempKey]!= NULL) {
										$VersionsData[$TempPageID]['IEVersion'][$TempKey]++;
									} else {
										$VersionsData[$TempPageID]['IEVersion'][$TempKey] = 1;
									}
									
								} else if ($Value['GeckoVersion'] != NULL || strstr($Value['NavigatorUserAgent'], 'Firefox') == TRUE) {
									$TempFirefoxVersion = strstr($Value['NavigatorUserAgent'], 'Firefox');
									$TempFirefoxVersion = str_replace("Firefox/", '', $TempFirefoxVersion);
									$TempFirefoxVersion = explode(' ', $TempFirefoxVersion);
									$TempFirefoxVersion = $TempFirefoxVersion[0];
									$FirefoxVersions[$TempFirefoxVersion] = $TempFirefoxVersion;
									
									$Versions[$TempKey] = $TempFirefoxVersion;
									if ($VersionsData[$TempPageID]['FirefoxVersion'][$TempFirefoxVersion] != NULL) {
										$VersionsData[$TempPageID]['FirefoxVersion'][$TempFirefoxVersion]++;
									} else {
										$VersionsData[$TempPageID]['FirefoxVersion'][$TempFirefoxVersion] = 1;
									}
								} else if ($Value['SafariVersion'] != NULL || (strstr($Value['NavigatorUserAgent'], 'Safari') == TRUE && strstr($Value['NavigatorUserAgent'], 'Chrome') == FALSE)) {
									$TempKey = str_replace(',', '.', $Value['SafariVersion']);
									$SafariVersions[$TempKey] = $TempKey;
									
									$Versions[$TempKey] = $TempKey;
									if ($VersionsData[$TempPageID]['SafariVersion'][$TempKey] != NULL) {
										$VersionsData[$TempPageID]['SafariVersion'][$TempKey]++;
									} else {
										$VersionsData[$TempPageID]['SafariVersion'][$TempKey] = 1;
									}
								} else if ($Value['ChromeVersion'] != NULL || strstr($Value['NavigatorUserAgent'], 'Chrome') == TRUE) {
									$TempKey = str_replace(',', '.', $Value['ChromeVersion']);
									$ChromeVersions[$TempKey] = $TempKey;
									
									$Versions[$TempKey] = $TempKey;
									if ($VersionsData[$TempPageID]['ChromeVersion'][$TempKey] != NULL) {
										$VersionsData[$TempPageID]['ChromeVersion'][$TempKey]++;
									} else {
										$VersionsData[$TempPageID]['ChromeVersion'][$TempKey] = 1;
									}
								} else if ($Value['OperaVersion'] != NULL || strstr($Value['NavigatorUserAgent'], 'Opera') == TRUE) {
									$TempKey = str_replace(',', '.', $Value['OperaVersions']);
									$OperaVersions[$TempKey] = $TempKey;
									
									$Versions[$TempKey] = $TempKey;
									if ($VersionsData[$TempPageID]['OperaVersion'][$TempKey] != NULL) {
										$VersionsData[$TempPageID]['OperaVersion'][$TempKey]++;
									} else {
										$VersionsData[$TempPageID]['OperaVersion'][$TempKey] = 1;
									}
								}
							}
							unset($VersionsData[$Key]['IEVersion']['']);
							unset($VersionsData[$Key]['FirefoxVersion']['']);
							unset($VersionsData[$Key]['SafariVersion']['']);
							unset($VersionsData[$Key]['ChromeVersion']['']);
							unset($VersionsData[$Key]['OperaVersion']['']);
							
							if (is_array($VersionsData[$Key]['IEVersion']) === TRUE) {
								ksort($VersionsData[$Key]['IEVersion'], SORT_NUMERIC);
							}
							
							if (is_array($VersionsData[$Key]['FirefoxVersion']) === TRUE) {
								ksort($VersionsData[$Key]['FirefoxVersion'], SORT_NUMERIC);
							}
							
							if (is_array($VersionsData[$Key]['SafariVersion']) === TRUE) {
								ksort($VersionsData[$Key]['SafariVersion'], SORT_NUMERIC);
							}
							
							if (is_array($VersionsData[$Key]['ChromeVersion']) === TRUE) {
								ksort($VersionsData[$Key]['ChromeVersion'], SORT_NUMERIC);
							}
							
							if (is_array($VersionsData[$Key]['OperaVersion']) === TRUE) {
								ksort($VersionsData[$Key]['OperaVersion'], SORT_NUMERIC);
							}
						}
					}
				}
				
				unset($IEVersions['']);
				unset($FirefoxVersions['']);
				unset($SafariVersions['']);
				unset($ChromeVersions['']);
				unset($OperaVersions['']);
				
				ksort($IEVersions, SORT_NUMERIC);
				ksort($FirefoxVersions, SORT_NUMERIC);
				ksort($SafariVersions, SORT_NUMERIC);
				ksort($ChromeVersions, SORT_NUMERIC);
				ksort($OperaVersions, SORT_NUMERIC);

				$TempVersionsData = array();
				if (is_array($VersionsData) === TRUE) {
					foreach ($VersionsData as $Key => $Value) {
						if (is_array($Value) === TRUE) { 
							foreach ($Value as $VersionsDataKey => $VersionsDataData) {
								$NewTempVersionsDataKey = str_replace('Version', '', $VersionsDataKey);
								if (is_array($VersionsDataData) === TRUE) {
									foreach ($VersionsDataData as $VersionsDataDataKey => $VersionsDataDataData) {
										$TempVersionsData[$Key][$NewTempVersionsDataKey . ' ' . $VersionsDataDataKey] = $VersionsDataDataData;
									}
								} else {
									if ($VersionsDataData != NULL) {
										$TempVersionsData[$Key][$NewTempVersionsDataKey] = $VersionsDataData;
									}
								}
							}
						}
					}
				} else {
				
				}
				
				$VersionsData = $TempVersionsData;
				unset($TempVersionsData);
				
				$ReturnData = array();
				$ReturnData['Versions']['IEVersions'] = $IEVersions;
				$ReturnData['Versions']['FirefoxVersions'] = $FirefoxVersions;
				$ReturnData['Versions']['SafariVersions'] = $SafariVersions;
				$ReturnData['Versions']['ChromeVersions'] = $ChromeVersions;
				$ReturnData['Versions']['OperaVersions'] = $OperaVersions;
				
				$ReturnData['VersionsData'] = $VersionsData;
				
				return ($ReturnData);
			} else {
				return FALSE;
			}
		} else {
			return FALSE;
		}
	}
?>