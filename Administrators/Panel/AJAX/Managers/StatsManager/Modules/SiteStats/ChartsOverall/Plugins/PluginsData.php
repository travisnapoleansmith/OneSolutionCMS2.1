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
				$FileName = $GridStatsDataConfiguration['Tab Configuration Files']['Plugins'];
				if (file_exists($FileName)) {
					$OverallConfiguration = parse_ini_file($FileName, true);
				} else {
					$OverallConfiguration = NULL;
				}
				
				$Plugins = $OverallConfiguration['Plugins'];
				
				$GoogleBot = 0;
				
				$Total = 0;
				
				$TrueTotal = 0;
				
				foreach($BrowsersStats as $Key => $Value) {
					$Total++;
					if (strstr($Value['NavigatorUserAgent'], 'http://www.google.com/bot.html') == TRUE) {
						$GoogleBot++;
					} else {
						if (is_array($Plugins) === TRUE) {
							foreach ($Plugins as $PluginsKey => $PluginsValue) {
								if ($Value[$PluginsValue] != NULL) {
									$$PluginsValue++;
								}
							}
						}
					}
				}
				
				$TrueTotal = $Total - $GoogleBot;
				$Count = 1;
				if (is_array($Plugins) === TRUE) {
					foreach($Plugins as $Key => $Value) {
						$Hits = $$Value;
						$Percentage = round(($Hits / $TrueTotal) * 100, 2);
						$Heading = $Key;
						$Page->startElement('item');
						$Page->writeAttribute('id', $Count);
							$Page->startElement('Percentage');
								$Page->text($Percentage);
							$Page->endElement(); // ENDS PERCENTAGE
							$Page->startElement('Plugins');
								$Page->text($Heading);
							$Page->endElement(); // ENDS BROWSERS
						$Page->endElement(); // ENDS ITEM
						$Count++;
					}
				}
			}
		}
	} else {
		header("HTTP/1.0 404 Not Found");
	}
?>