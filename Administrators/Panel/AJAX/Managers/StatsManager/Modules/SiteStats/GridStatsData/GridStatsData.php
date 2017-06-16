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
		if ($RangeType != NULL) {
			require_once('Functions/BuildTypeStats.php');
			$GridStatsDataConfigurationFileName = '../../../Configuration/Managers/StatsManager/GridStatsData/Settings.ini';
			if (file_exists($GridStatsDataConfigurationFileName)) {
				$GridStatsDataConfiguration = parse_ini_file($GridStatsDataConfigurationFileName, true);
			} else {
				$GridStatsDataConfiguration = NULL;
			}
			
			$TypeStatsReturn = buildTypeStats($Type, $Tier2Databases, $GridStatsDataConfigurationFileName);
			$SiteStats = $TypeStatsReturn['Data']['Stats'];
			$BrowsersStats = $TypeStatsReturn['Data']['BrowsersStats'];
			$IPAddressBrowsersStats = $TypeStatsReturn['Data']['IPAddressBrowsersStats'];
			
			// START FUNCTION
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
			
			// START FUNCTION
			if (is_array($GridStatsDataConfiguration) === TRUE) {
				// HEADER
				switch ($Name) {
					// Change Switch Statement to look inside of INI file for case and what file to call!
					// CREATE A SPECIAL FUNCTION THAT WILL READ AN INI FILE THAT CONTAINS A LISTING OF TAB NAMES AND FUNCTION CALLS THAT
					// THAT WILL ALLOW THE ADDING A NEW TAB AND NEW FUNCTION AS EASY AS UPDATING THE INI FILE.
					case isset($GridStatsDataConfiguration['Header'][$Name]):
						$FileName = $GridStatsDataConfiguration['Header'][$Name];
						if (file_exists($FileName) === TRUE) {
							require_once($FileName);
						}
						break;
				}
				
				// CONTENT
				if (is_array($PageListings) === TRUE) {
					// Change Switch Statement to look inside of INI file for case and what file to call!
					switch ($Name) {
						case isset($GridStatsDataConfiguration['Content'][$Name]):
							$FileName = $GridStatsDataConfiguration['Content'][$Name];
							if (file_exists($FileName) === TRUE) {
								require_once($FileName);
							}
							break;
						}
					}
				}
		} else {
			header("HTTP/1.0 404 Not Found");
		}
	} else {
		header("HTTP/1.0 404 Not Found");
	}
?>