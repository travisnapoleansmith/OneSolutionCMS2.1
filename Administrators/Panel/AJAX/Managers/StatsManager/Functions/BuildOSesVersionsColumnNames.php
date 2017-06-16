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
	
	function buildOSesVersionsColumnNames($PageListings, $BrowsersStats, $ConfigurationFileName) {
		if ($PageListings != NULL) {
			if (is_array($PageListings) === TRUE) {
				
				if (file_exists($ConfigurationFileName) === TRUE) {
					$Configuration = parse_ini_file($ConfigurationFileName, true);
				} else {
					$Configuration = NULL;
				}
				
				$VersionsData = array();
				foreach ($PageListings as $Key => $Data) {
					if (is_array($BrowsersStats) === TRUE) {
						$OSes = array();
						$OSesData = array();
						foreach($BrowsersStats as $Key => $Value) {
							if (is_array($Value) === TRUE) {
								foreach ($Value as $SubKey => $SubValue) {
									// Has Data
									if (isset($SubValue['Timestamp']) === TRUE) {
										$TempPageID = $SubValue['PageID'];
										$OSType = $SubValue['OS'];
										$OSVersionType = $SubValue['OSVersion'];
										$OSVersion = NULL;
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
											if (empty($OSVersionType) == TRUE) {
												$OSVersion = $OSType;
											} else {
												$OSVersion = $OSType . ' ' . $OSVersionType;
											}
										} else {
											$OSVersion = $OSType;
										}
										
										if (isset($OSesData[$TempPageID][$OSVersion]) === TRUE) {
											$OSesData[$TempPageID][$OSVersion]++;
										} else {
											$OSesData[$TempPageID][$OSVersion] = 1;
										}
										
										if (!isset($OSes[$OSVersion])) {
											$OSes[$OSVersion] = $OSVersion;
										}
									} else {
										// Has No Data
										$TempPageID = $Data['PageID'];
										$OSType = 'Unknown';
										if (isset($OSes[$OSType]) === FALSE) {
											$OSes[$OSType] = $OSType;
										}
										if (isset($OSesData[$TempPageID][$OSType]) === FALSE) {
											$OSesData[$TempPageID][$OSType] = 0;
										}
									}
								}
							}
						}
					}
				}
				
				unset($OSes['Google Bot Views']);
				
				ksort($OSes, SORT_STRING);
			
				$ReturnData = array();
				$ReturnData['Types'] = $OSes;
				$ReturnData['Data'] = $OSesData;
				
				return ($ReturnData);
				
			} else {
				return FALSE;
			}
		} else {
			return FALSE;
		}
	}
?>