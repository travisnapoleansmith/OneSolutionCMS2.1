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
	
	// Sorts by Page Listing or IPAddress
	// Sort can ether be 'Page' for Page Sorting or 'IPAddress' for IPAddress Sorting
	function buildIPAddressesData($PageListings, $Sort, $ConfigurationFileName) {
		$HOME = $GLOBALS['HOME'];
		/*if ($ConfigurationFileName == NULL) {
			return FALSE;
		}
		
		if (is_array($ConfigurationFileName) === TRUE) {
			return FALSE;
		}
		*/
		// MUST PASS A CONFIGURATION FILE NAME
		
		if ($Sort == NULL) {
			return FALSE;
		}
		
		if (is_array($Sort) === TRUE) {
			return FALSE;
		}
		
		if ($PageListings != NULL) {
			if (is_array($PageListings) === TRUE) {
				$IPAddressData = array();
				switch ($Sort) {
					case 'Page':
						$BrowsersStats = $GLOBALS['BrowsersStats'];
						foreach ($PageListings as $Key => $Data) {
							if ($BrowsersStats != NULL) {
								if (is_array($BrowsersStats) === TRUE) {
									if (file_exists($ConfigurationFileName) === TRUE) {
										$Configuration = parse_ini_file($ConfigurationFileName, true);
									} else {
										$Configuration = NULL;
									}
									
									$Temp = $BrowsersStats[$Data['PageID']];
									
									$IPAddressArray = array();
									$IPAddress = NULL;
									$IPAddressHit = NULL;
									$GoogleBot = 0;
									
									if (is_array($Temp) === TRUE) {
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
										$IPAddressArray['GoogleBot'] = $GoogleBot;
									}
									$IPAddressData[$Data['PageID']] = $IPAddressArray;
								} else {
									return FALSE;
								}
							} else {
								return FALSE;
							}
						}
						break;
					case 'IPAddress':
						require_once ("$HOME/Libraries/GlobalLayer/Geoiploc/geoiploc.php");
						
						$IPAddressBrowsersStats = $GLOBALS['IPAddressBrowsersStats'];
						$TempIPAddressBrowserStats = $IPAddressBrowsersStats['IPAddress'];
						
						$CurrentTimestamp = NULL;
						$FirstTimestamp = NULL;
						$LastTimestamp = NULL;
						$FutureTimestamp = NULL;
						
						if ($TempIPAddressBrowserStats != NULL) {
							if (is_array($TempIPAddressBrowserStats) === TRUE) {
								$PageData = array();
								foreach ($PageListings as $Key => $Data) {
									$PageID = $Data['PageID'];
									if (isset($PageData[$PageID]) === FALSE) {
										$PageData[$PageID] = $Data;
									} else {
										$PageData['REPEATS'][] = $Data;
									}
								}
								
								foreach ($TempIPAddressBrowserStats as $Key => $Data) {
									$CurrentIPAddress = $Data['IPAddress'];
									
									if (strstr($Data['NavigatorUserAgent'], 'http://www.google.com/bot.html') == TRUE) {
										if (isset($IPAddressData['Google Bot Views'][$CurrentIPAddress]) === TRUE) {
											$IPAddressData['Google Bot Views'][$CurrentIPAddress]['IPAddress Hits']++;
										} else {
											$IPAddressData['Google Bot Views'][$CurrentIPAddress]['IPAddress Hits'] = 1;
										}
										$IPAddressData['Google Bot Views'][$CurrentIPAddress]['IP Address'] = $CurrentIPAddress;
										$IPAddressData['Google Bot Views'][$CurrentIPAddress]['Raw Record'][] = $Data;
									} else {
										$CurrentTimestamp = $Data['Timestamp'];
										$TempTimestamp = new DateTime($CurrentTimestamp);
										$TempCurrentTimestamp = $TempTimestamp->format('U');
										
										$CountryName = getCountryFromIP($CurrentIPAddress, " NamE ");
										$CountryName = trim($CountryName);
										
										// Start Check OS Version Type Function
										$OSType = $Data['OS'];
										$OSVersion = $Data['OSVersion'];
										
										if (empty($OSVersion) === TRUE) {
											$OSVersion = 'Unknown';
										}
										
										if ($OSType != NULL) {
											if ($OSType == 'Linux') {
												if (strstr($Data['NavigatorUserAgent'], 'Android') == TRUE) {
													$OSType = 'Android';
												}
											} else if ($OSType == '100') {
												if (strstr($Data['NavigatorUserAgent'], 'Android') == TRUE) {
													$OSType = 'Android';
												} else if (strstr($Data['NavigatorUserAgent'], 'BlackBerry') == TRUE) {
													$OSType = 'BlackBerry OS';
												} else if (strstr($Data['NavigatorUserAgent'], 'iPhone') == TRUE) {
													$OSType = 'iPhone';
												} else if (strstr($Data['NavigatorUserAgent'], 'J2ME/MIDP') == TRUE) {
													$OSType = 'J2ME/MIDP Phone';
												} else if (strstr($Data['NavigatorUserAgent'], 'J2ME') == TRUE) {
													$OSType = 'J2ME Phone';
												} else {
													$OSType = 'Unknown Phone';
												}
											}
										} else {
											$OSType = 'Unknown';
										}
										
										$OSType = trim($OSType);
										$OSVersion = trim($OSVersion);
										// END Check OS Version Type Function
										
										// Start Check Browser Version Function
										$Browser = NULL;
										$BrowserVersion = NULL;
										if ($Data['IEVersion'] != NULL || $Data['IETrueVersion'] != NULL || $Data['IEDocMode'] != NULL || strstr($Data['NavigatorUserAgent'], 'MSIE') == TRUE) {
											$Browser = 'Internet Explorer';
											$BrowserVersion = $Data['IEVersion'];
										} else if ($Data['GeckoVersion'] != NULL || strstr($Data['NavigatorUserAgent'], 'Firefox') == TRUE) {
											$Browser = 'Firefox';
											$TempVersion = strstr($Data['NavigatorUserAgent'], 'Firefox');
											$TempVersion = str_replace("Firefox/", '', $TempVersion);
											$TempVersion = explode(' ', $TempVersion);
											$BrowserVersion = $TempVersion[0];
										} else if ($Data['SafariVersion'] != NULL || (strstr($Data['NavigatorUserAgent'], 'Safari') == TRUE && strstr($Data['NavigatorUserAgent'], 'Chrome') == FALSE)) {
											$Browser = 'Safari';
											$BrowserVersion = str_replace(',', '.', $Data['SafariVersion']);
										} else if ($Data['ChromeVersion'] != NULL || strstr($Data['NavigatorUserAgent'], 'Chrome') == TRUE) {
											$Browser = 'Chrome';
											$BrowserVersion = str_replace(',', '.', $Data['ChromeVersion']);
										} else if ($Data['OperaVersion'] != NULL || strstr($Data['NavigatorUserAgent'], 'Opera') == TRUE) {
											$Browser = 'Opera';
											$BrowserVersion = str_replace(',', '.', $Data['OperaVersions']);
										} else {
											$Browser = "Unknown";
											$BrowserVersion = "Unknown";
										}
										
										if (empty($BrowserVersion) || $BrowserVersion === NULL) {
											$BrowserVersion = "Unknown";
										}
										
										$Browser = trim($Browser);
										$BrowserVersion = trim($BrowserVersion);
										
										// END Check Browser Function
										
										$ISPName = 'Unknown';
										//$ISPName = gethostbyaddr($CurrentIPAddress);
										//$ISPName = trim($ISPName);
										
										$CurrentPageID = explode('?', $Data['RequestUri']);
										foreach ($CurrentPageID as $TempValue) {
											$Position = strpos($TempValue, 'PageID');
											if ($Position !== FALSE) {
												$CurrentPageID = str_replace('PageID=', '', $TempValue);
											}
										}
										
										if (is_array($CurrentPageID) === TRUE) {
											$CurrentPageID = 1;
										}
										
										if (isset($IPAddressData[$CurrentIPAddress]) === TRUE) {
											// IF RECORDS EXISTS
											$IPAddressData[$CurrentIPAddress]['Human Views']++;
											$IPAddressData[$CurrentIPAddress]['Raw Record'][] = $Data;
											
											$FirstTimestamp = $IPAddressData[$CurrentIPAddress]['First Accessed'];
											$TempTimestamp = new DateTime($FirstTimestamp);
											$TempFirstTimestamp = $TempTimestamp->format('U');
											
											if ($TempCurrentTimestamp >= $TempFirstTimestamp) {
												$IPAddressData[$CurrentIPAddress]['Last Accessed'] = $CurrentTimestamp;
											} else {
												$IPAddressData[$CurrentIPAddress]['Last Accessed'] = $FirstTimestamp;
											}
											
											$IPAddressData[$CurrentIPAddress]['Last Page Viewed'] = $PageData[$CurrentPageID]['ContentPageMenuTitle'];
											$IPAddressData[$CurrentIPAddress]['Last Country Used'] = $CountryName;
											$IPAddressData[$CurrentIPAddress]['Last OS Used'] = $OSType;
											$IPAddressData[$CurrentIPAddress]['Last OS Version Used'] = $OSVersion;
											$IPAddressData[$CurrentIPAddress]['Last Browser Used'] = $Browser;
											$IPAddressData[$CurrentIPAddress]['Last Browser Version Used'] = $BrowserVersion;
											$IPAddressData[$CurrentIPAddress]['Last ISP Used'] = $ISPName;
										} else {
											// IF RECORD DOES NOT EXIST
											$IPAddressData[$CurrentIPAddress]['Human Views'] = 1;
											$IPAddressData[$CurrentIPAddress]['IP Address'] = $CurrentIPAddress;
											$IPAddressData[$CurrentIPAddress]['Raw Record'][] = $Data;
											$IPAddressData[$CurrentIPAddress]['First Accessed'] = $CurrentTimestamp;
											$IPAddressData[$CurrentIPAddress]['Last Accessed'] = $CurrentTimestamp;
											$IPAddressData[$CurrentIPAddress]['First Page Viewed'] = $PageData[$CurrentPageID]['ContentPageMenuTitle'];
											$IPAddressData[$CurrentIPAddress]['Last Page Viewed'] = $PageData[$CurrentPageID]['ContentPageMenuTitle'];
											$IPAddressData[$CurrentIPAddress]['First Country Used'] = $CountryName;
											$IPAddressData[$CurrentIPAddress]['Last Country Used'] = $CountryName;
											$IPAddressData[$CurrentIPAddress]['First OS Used'] = $OSType;
											$IPAddressData[$CurrentIPAddress]['Last OS Used'] = $OSType;
											$IPAddressData[$CurrentIPAddress]['First OS Version Used'] = $OSVersion;
											$IPAddressData[$CurrentIPAddress]['Last OS Version Used'] = $OSVersion;
											$IPAddressData[$CurrentIPAddress]['First Browser Used'] = $Browser;
											$IPAddressData[$CurrentIPAddress]['Last Browser Used'] = $Browser;
											$IPAddressData[$CurrentIPAddress]['First Browser Version Used'] = $BrowserVersion;
											$IPAddressData[$CurrentIPAddress]['Last Browser Version Used'] = $BrowserVersion;
											$IPAddressData[$CurrentIPAddress]['First ISP Used'] = $ISPName;
											$IPAddressData[$CurrentIPAddress]['Last ISP Used'] = $ISPName;
										}
										
										if (isset($IPAddressData[$CurrentIPAddress]['PageID Human Views'][$CurrentPageID]) === TRUE) {
											$IPAddressData[$CurrentIPAddress]['PageID Human Views'][$CurrentPageID]['Human Views']++;
											$IPAddressData[$CurrentIPAddress]['PageID Human Views'][$CurrentPageID]['Records'][] = $Data;
											
											$FirstTimestamp = $IPAddressData[$CurrentIPAddress]['PageID Human Views'][$CurrentPageID]['First Accessed'];
											$TempTimestamp = new DateTime($FirstTimestamp);
											$TempFirstTimestamp = $TempTimestamp->format('U');
											
											if ($TempCurrentTimestamp >= $TempFirstTimestamp) {
												$IPAddressData[$CurrentIPAddress]['PageID Human Views'][$CurrentPageID]['Last Accessed'] = $CurrentTimestamp;
											} else {
												$IPAddressData[$CurrentIPAddress]['PageID Human Views'][$CurrentPageID]['Last Accessed'] = $FirstTimestamp;
											}
											
											$IPAddressData[$CurrentIPAddress]['PageID Human Views'][$CurrentPageID]['Last Country Used'] = $CountryName;
											$IPAddressData[$CurrentIPAddress]['PageID Human Views'][$CurrentPageID]['Last OS Used'] = $OSType;
											$IPAddressData[$CurrentIPAddress]['PageID Human Views'][$CurrentPageID]['Last OS Version Used'] = $OSVersion;
											$IPAddressData[$CurrentIPAddress]['PageID Human Views'][$CurrentPageID]['Last Browser Used'] = $Browser;
											$IPAddressData[$CurrentIPAddress]['PageID Human Views'][$CurrentPageID]['Last Browser Version Used'] = $BrowserVersion;
											$IPAddressData[$CurrentIPAddress]['PageID Human Views'][$CurrentPageID]['Last ISP Used'] = $ISPName;
										} else {
											$IPAddressData[$CurrentIPAddress]['PageID Human Views'][$CurrentPageID]['Human Views'] = 1;
											$IPAddressData[$CurrentIPAddress]['PageID Human Views'][$CurrentPageID]['Records'][] = $Data;
											$IPAddressData[$CurrentIPAddress]['PageID Human Views'][$CurrentPageID]['Page Name'] = $PageData[$CurrentPageID]['ContentPageMenuTitle'];
											$IPAddressData[$CurrentIPAddress]['PageID Human Views'][$CurrentPageID]['First Accessed'] = $CurrentTimestamp;
											$IPAddressData[$CurrentIPAddress]['PageID Human Views'][$CurrentPageID]['Last Accessed'] = $CurrentTimestamp;
											$IPAddressData[$CurrentIPAddress]['PageID Human Views'][$CurrentPageID]['First Country Used'] = $CountryName;
											$IPAddressData[$CurrentIPAddress]['PageID Human Views'][$CurrentPageID]['Last Country Used'] = $CountryName;
											$IPAddressData[$CurrentIPAddress]['PageID Human Views'][$CurrentPageID]['First OS Used'] = $OSType;
											$IPAddressData[$CurrentIPAddress]['PageID Human Views'][$CurrentPageID]['Last OS Used'] = $OSType;
											$IPAddressData[$CurrentIPAddress]['PageID Human Views'][$CurrentPageID]['First OS Version Used'] = $OSVersion;
											$IPAddressData[$CurrentIPAddress]['PageID Human Views'][$CurrentPageID]['Last OS Version Used'] = $OSVersion;
											$IPAddressData[$CurrentIPAddress]['PageID Human Views'][$CurrentPageID]['First Browser Used'] = $Browser;
											$IPAddressData[$CurrentIPAddress]['PageID Human Views'][$CurrentPageID]['Last Browser Used'] = $Browser;
											$IPAddressData[$CurrentIPAddress]['PageID Human Views'][$CurrentPageID]['First Browser Version Used'] = $BrowserVersion;
											$IPAddressData[$CurrentIPAddress]['PageID Human Views'][$CurrentPageID]['Last Browser Version Used'] = $BrowserVersion;
											$IPAddressData[$CurrentIPAddress]['PageID Human Views'][$CurrentPageID]['First ISP Used'] = $ISPName;
											$IPAddressData[$CurrentIPAddress]['PageID Human Views'][$CurrentPageID]['Last ISP Used'] = $ISPName;
										}
										
										ksort($IPAddressData[$CurrentIPAddress]['PageID Human Views']);
										ksort($IPAddressData[$CurrentIPAddress]);
									}
								}
								
								ksort($IPAddressData);
							} else {
								return FALSE;
							}
						} else {
							return FALSE;
						}
						break;
					default:
						return FALSE;
				}
				
				// RETURN DATA HERE
				$ReturnData = array();
				$ReturnData['Data'] = $IPAddressData;
				return $ReturnData;
			} else {
				return FALSE;
			}
		} else {
			return FALSE;
		}
	}
?>