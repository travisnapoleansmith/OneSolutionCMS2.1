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
	
	function buildCountries($BrowsersStats, $CountriesConfiguration) {
		$HOME = $GLOBALS['HOME'];
		require_once ("$HOME/Libraries/GlobalLayer/Geoiploc/geoiploc.php");
		if (is_array($BrowsersStats) === TRUE) {
			if (is_array($CountriesConfiguration) === TRUE) {
				$Countries = array();
				$CountriesData = array();
				foreach($BrowsersStats as $Key => $Value) {
					foreach ($Value as $SubKey => $SubValue) {
						// Has Data
						if (isset($SubValue['Timestamp']) === TRUE) {
							$TempPageID = $SubValue['PageID'];
							$IPAddress = $SubValue['IPAddress'];
							$CountryName = getCountryFromIP($IPAddress, "code");
							
							if ($CountryName === "NO") {
								$CountryName = "Norway";
							}
							
							if (isset($CountriesConfiguration['Countries'][$CountryName]) === TRUE) {
								$CountryName = $CountriesConfiguration['Countries'][$CountryName];
							} else {
								$CountriesTemp = str_replace(array(';', ','), '-|-', $CountriesType);
								$CountriesTemp = array_filter(explode('-|-', $CountriesTemp));
								if (!empty($CountriesTemp)) {
									foreach ($CountriesTemp as $Key => $Value) {
										$Value = trim($Value);
										$CountriesTemp[$Key] = $Value;
										if (strpos($Value, 'q=') !== FALSE) {
											unset($CountriesTemp[$Key]);
										} else {
											if (isset($CountriesConfiguration['Countries'][$Value])) {
												$Value = $CountriesConfiguration['Countries'][$Value];
												$CountriesTemp[$Key] = $Value;
											}
										}
									}
									
									$CountriesName = $CountriesTemp;
									
								} else {
								
								}
							}
							if (strstr($SubValue['NavigatorUserAgent'], 'http://www.google.com/bot.html') == TRUE) {
								$CountriesName = 'Google Bot Views';
							}
							
							if (is_array($CountryName) === TRUE) {
								foreach ($CountryName as $CountryNameKey => $CountryNameValue) {
									if ($CountryNameValue !== 'Google Bot Views') {
										$Countries[$CountryNameValue] = $CountryNameValue;
									}
									
									if (isset($CountriesData[$TempPageID][$CountryNameValue]) === TRUE) {
										$CountriesData[$TempPageID][$CountryNameValue]++;
									} else {
										$CountriesData[$TempPageID][$CountryNameValue] = 1;
									}
									
									if (!isset($Countries[$CountryNameValue])) {
										$Countries[$CountryNameValue] = $CountryNameValue;
									}
								}
							} else {
								if ($CountryName !== 'Google Bot Views') {
									$Countries[$CountryName] = $CountryName;
								}
								
								if (isset($CountriesData[$TempPageID][$CountryName]) === TRUE) {
									$CountriesData[$TempPageID][$CountryName]++;
								} else {
									$CountriesData[$TempPageID][$CountryName] = 1;
								}
								
								if (!isset($Countries[$CountryName])) {
									$Countries[$CountryName] = $CountryName;
								}
							}
						} else {
							// Has No Data
							$TempPageID = $Data['PageID'];
							$CountriesType = 'Unknown';
							if (isset($Countries[$CountryName]) === FALSE) {
								$Countries[$CountryName] = $CountryName;
							}
							if (isset($CountriesData[$TempPageID][$CountryName]) === FALSE) {
								$CountriesData[$TempPageID][$CountryName] = 0;
							}
						}
					}
				}
				
				unset($Countries['Google Bot Views']);
				
				ksort($Countries, SORT_STRING);
				
				$ReturnData = array();
				$ReturnData['Types'] = $Countries;
				$ReturnData['Data'] = $CountriesData;
				
				return ($ReturnData);
			} else {
				return FALSE;
			}
		} else {
			return FALSE;
		}
	}
?>