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
		if ($BrowsersStats != NULL) {
			if (is_array($BrowsersStats) === TRUE) {
				$Total = 0;
				$TrueTotal = 0;
				$OSes = array();
				$OSesData = array();
				
				foreach($BrowsersStats as $Key => $Value) {
					$OSType = $Value['OS'];
					$Total++;
					// Has Data
					if (isset($Value['Timestamp']) === TRUE) {
						if (strstr($Value['NavigatorUserAgent'], 'http://www.google.com/bot.html') == TRUE) {
							$OSType = 'Google Bot Views';
						} else {
							if ($OSType != NULL) {
								if ($OSType == 'Linux') {
									if (strstr($Value['NavigatorUserAgent'], 'Android') == TRUE) {
										$OSType = 'Android';
									}
								} else if ($OSType == '100') {
									if (strstr($Value['NavigatorUserAgent'], 'Android') == TRUE) {
										$OSType = 'Android';
									} else if (strstr($Value['NavigatorUserAgent'], 'BlackBerry') == TRUE) {
										$OSType = 'BlackBerry OS';
									} else if (strstr($Value['NavigatorUserAgent'], 'iPhone') == TRUE) {
										$OSType = 'iPhone';
									} else if (strstr($Value['NavigatorUserAgent'], 'J2ME/MIDP') == TRUE) {
										$OSType = 'J2ME/MIDP Phone';
									} else if (strstr($Value['NavigatorUserAgent'], 'J2ME') == TRUE) {
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
						
						if (isset($OSesData[$OSType])) {
							$OSesData[$OSType]++;
						} else {
							$OSesData[$OSType] = 1;
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
				
				ksort($OSes, SORT_STRING);
				
				$TrueTotal = $Total - $GoogleBot;
				$Count = 1;
				foreach($OSes as $Key => $Value) {
					$Hits = $OSesData[$Key];
					$Percentage = round(($Hits / $TrueTotal) * 100, 2);
					$Heading = $Key;
					$Page->startElement('item');
					$Page->writeAttribute('id', $Count);
						$Page->startElement('Percentage');
							$Page->text($Percentage);
						$Page->endElement(); // ENDS PERCENTAGE
						$Page->startElement('OSs');
							$Page->text($Heading);
						$Page->endElement(); // ENDS BROWSERS
					$Page->endElement(); // ENDS ITEM
					$Count++;
				}
			}
		}
	} else {
		header("HTTP/1.0 404 Not Found");
	}
?>