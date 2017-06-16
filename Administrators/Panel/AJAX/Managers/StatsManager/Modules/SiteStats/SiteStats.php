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

	// CREATE FUNCTION THAT WILL WORK WITH ADSTATS AND SITESTATS!
	if ($RefererPage == $ServerLocation . "/Administrators/Panel/Managers/StatsManager/StatsManager.php") {
		if ($_SERVER['HTTP_X_REQUESTED_WITH'] === 'XMLHttpRequest') {
			set_time_limit(120);

			if ($RangeType != NULL) {
				/*$BrowserStatsTableName = 'SiteStatsBrowserStats' . $Year;
				$SiteStatsTableName = 'SiteStats' . $Year;

				if (isset($EndYear) === TRUE) {
					if ($Year != $EndYear) {
						$BrowserStatsTableNameEndYear = 'SiteStatsBrowserStats' . $EndYear;
						$SiteStatsTableNameEndYear = 'SiteStats' . $EndYear;
					}
				}

				$Tier2Databases->createDatabaseTable($BrowserStatsTableName);
				$Tier2Databases->Connect($BrowserStatsTableName);

				$Tier2Databases->pass ($BrowserStatsTableName, 'setOrderbyname', array('Name' => 'Timestamp'));
				$Tier2Databases->pass ($BrowserStatsTableName, 'setOrderbytype', array('Type' => 'ASC'));

				$Tier2Databases->pass ($BrowserStatsTableName, 'searchDatabaseRow', array('IDNumber' => $LookupField, 'Begin' => $Begin, 'End' => $End));

				$BrowsersStats = $Tier2Databases->pass ($BrowserStatsTableName, "getMultiRowField", array());
				$Tier2Databases->Disconnect($BrowserStatsTableName);

				/*if (is_array($BrowsersStats)) {
					foreach ($BrowsersStats as $Key => $Value) {
						if (empty($Value) === TRUE) {
							unset($BrowsersStats[$Key]);
						}
					}
				}*/

				/*if (isset($BrowserStatsTableNameEndYear) === TRUE) {
					$Tier2Databases->createDatabaseTable($BrowserStatsTableNameEndYear);
					$Tier2Databases->Connect($BrowserStatsTableNameEndYear);

					$Tier2Databases->pass ($BrowserStatsTableNameEndYear, 'setOrderbyname', array('Name' => 'Timestamp'));
					$Tier2Databases->pass ($BrowserStatsTableNameEndYear, 'setOrderbytype', array('Type' => 'ASC'));

					$Tier2Databases->pass ($BrowserStatsTableNameEndYear, 'searchDatabaseRow', array('IDNumber' => $LookupField, 'Begin' => $Begin, 'End' => $End));

					$BrowsersStatsEndYear = $Tier2Databases->pass ($BrowserStatsTableNameEndYear, "getMultiRowField", array());
					$Tier2Databases->Disconnect($BrowserStatsTableNameEndYear);

					if (is_array($BrowsersStatsEndYear)) {
						foreach ($BrowsersStatsEndYear as $Key => $Value) {
							if (empty($Value) === TRUE) {
								unset($BrowsersStatsEndYear[$Key]);
							}
						}
					}

					$BrowsersStats = array_merge($BrowsersStats, $BrowsersStatsEndYear);
				}

				//if (empty($BrowsersStats) === TRUE) {
					//unset($BrowsersStats);
				//}

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

				if (isset($SiteStatsTableNameEndYear) === TRUE) {
					$Tier2Databases->createDatabaseTable($SiteStatsTableNameEndYear);
					$Tier2Databases->Connect($SiteStatsTableNameEndYear);

					$Tier2Databases->pass ($SiteStatsTableNameEndYear, 'setOrderbyname', array('Name' => 'Timestamp'));
					$Tier2Databases->pass ($SiteStatsTableNameEndYear, 'setOrderbytype', array('Type' => 'ASC'));

					$Tier2Databases->pass ($SiteStatsTableNameEndYear, 'searchDatabaseRow', array('IDNumber' => $LookupField, 'Begin' => $Begin, 'End' => $End));

					$SiteStatsEndYear = $Tier2Databases->pass ($SiteStatsTableNameEndYear, "getMultiRowField", array());
					$Tier2Databases->Disconnect($SiteStatsTableNameEndYear);

					$SiteStats = array_merge($SiteStats, $SiteStatsEndYear);

				}

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
			// END FUNCTION

			switch ($Name) {
				// Change Switch Statement to look inside of INI file for case and what file to call!
				// CREATE A SPECIAL FUNCTION THAT WILL READ AN INI FILE THAT CONTAINS A LISTING OF TAB NAMES AND FUNCTION CALLS THAT
				// THAT WILL ALLOW THE ADDING A NEW TAB AND NEW FUNCTION AS EASY AS UPDATING THE INI FILE.
				case "Overall":
					require_once('Modules/SiteStats/GridStats/Overall/OverallHeader.php');
					break;
				case "Browsers":
					require_once('Modules/SiteStats/GridStats/Browsers/BrowsersHeader.php');
					break;
				case "BrowsersVersions":
					require_once('Modules/SiteStats/GridStats/BrowsersVersions/BrowsersVersionsHeader.php');
					break;
				case "Plugins":
					require_once('Modules/SiteStats/GridStats/Plugins/PluginsHeader.php');
					break;
				case "OS\'s":
					require_once('Modules/SiteStats/GridStats/OSes/OSesHeader.php');
					break;
				case "OSVersions":
					require_once('Modules/SiteStats/GridStats/OSVersions/OSVersionsHeader.php');
					break;
				case "Languages":
					require_once('Modules/SiteStats/GridStats/Languages/LanguagesHeader.php');
					break;
				case "Countries":
					//require_once('Modules/SiteStats/GridStats/Countries/CountriesHeader.php');
					break;
				case "IPAddresses":
					//require_once('Modules/SiteStats/GridStats/IPAddresses/IPAddressesHeader.php');
					break;
			}

			// CONTENT
			if (is_array($PageListings)) {
				// Change Switch Statement to look inside of INI file for case and what file to call!
				switch ($Name) {
					case "Overall":
						require_once('Modules/SiteStats/GridStats/Overall/OverallData.php');
						break;
					case "Browsers":
						require_once('Modules/SiteStats/GridStats/Browsers/BrowsersData.php');
						break;
					case "BrowsersVersions":
						require_once('Modules/SiteStats/GridStats/BrowsersVersions/BrowsersVersionsData.php');
						break;
					case "Plugins":
						require_once('Modules/SiteStats/GridStats/Plugins/PluginsData.php');
						break;
					case "OS\'s":
						require_once('Modules/SiteStats/GridStats/OSes/OSesData.php');
						break;
					case "OSVersions":
						require_once('Modules/SiteStats/GridStats/OSVersions/OSVersionsData.php');
						break;
					case "Languages":
						require_once('Modules/SiteStats/GridStats/Languages/LanguagesData.php');
						break;
					case "Countries":
						//require_once('Modules/SiteStats/GridStats/Countries/CountriesData.php');
						break;
					case "IPAddresses":
						//require_once('Modules/SiteStats/GridStats/IPAddresses/IPAddressesData.php');
						break;
				}*/
			}
		} else {
			header("HTTP/1.0 404 Not Found");
		}
	} else {
		header("HTTP/1.0 404 Not Found");
	}
?>