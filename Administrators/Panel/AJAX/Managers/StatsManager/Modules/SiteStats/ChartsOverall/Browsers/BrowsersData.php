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
				$GoogleBot = 0;
				$IEHits = 0;
				$FirefoxHits = 0;
				$SafariHits = 0;
				$ChromeHits = 0;
				$OperaHits = 0;
				$UnknownHits = 0;
				$Total = 0;
				
				$TrueTotal = 0;
				$IEPercentage = 0.00;
				$FirefoxPercentage = 0.00;
				$SafariPercentage = 0.00;
				$ChromePercentage = 0.00;
				$OperaPercentage = 0.00;
				$UnknownPercentage = 0.00;
				
				foreach($BrowsersStats as $Key => $Value) {
					$Total++;
					// Has Data
					if (isset($Value['Timestamp']) === TRUE) {
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
					} else {
						// Has No Data
						
					}
				}
				
				$TrueTotal = $Total - $GoogleBot;
				$IEPercentage = round(($IEHits / $TrueTotal) * 100, 2);
				$FirefoxPercentage = round(($FirefoxHits / $TrueTotal) * 100, 2);
				$SafariPercentage = round(($SafariHits / $TrueTotal) * 100, 2);
				$ChromePercentage = round(($ChromeHits / $TrueTotal) * 100, 2);
				$OperaPercentage = round(($OperaHits / $TrueTotal) * 100, 2);
				$UnknownPercentage = round(($UnknownHits / $TrueTotal) * 100, 2);
				
				$Page->startElement('item');
				$Page->writeAttribute('id', 1);
					$Page->startElement('Percentage');
						$Page->text($IEPercentage);
					$Page->endElement(); // ENDS PERCENTAGE
					$Page->startElement('Browsers');
						$Page->text('Internet Explorer');
					$Page->endElement(); // ENDS BROWSERS
				$Page->endElement(); // ENDS ITEM
				
				$Page->startElement('item');
				$Page->writeAttribute('id', 2);
					$Page->startElement('Percentage');
						$Page->text($FirefoxPercentage);
					$Page->endElement(); // ENDS PERCENTAGE
					$Page->startElement('Browsers');
						$Page->text('Firefox');
					$Page->endElement(); // ENDS BROWSERS
				$Page->endElement(); // ENDS ITEM
				
				$Page->startElement('item');
				$Page->writeAttribute('id', 3);
					$Page->startElement('Percentage');
						$Page->text($SafariPercentage);
					$Page->endElement(); // ENDS PERCENTAGE
					$Page->startElement('Browsers');
						$Page->text('Safari');
					$Page->endElement(); // ENDS BROWSERS
				$Page->endElement(); // ENDS ITEM
				
				$Page->startElement('item');
				$Page->writeAttribute('id', 4);
					$Page->startElement('Percentage');
						$Page->text($ChromePercentage);
					$Page->endElement(); // ENDS PERCENTAGE
					$Page->startElement('Browsers');
						$Page->text('Chrome');
					$Page->endElement(); // ENDS BROWSERS
				$Page->endElement(); // ENDS ITEM
				
				$Page->startElement('item');
				$Page->writeAttribute('id', 5);
					$Page->startElement('Percentage');
						$Page->text($OperaPercentage);
					$Page->endElement(); // ENDS PERCENTAGE
					$Page->startElement('Browsers');
						$Page->text('Opera');
					$Page->endElement(); // ENDS BROWSERS
				$Page->endElement(); // ENDS ITEM
				
				$Page->startElement('item');
				$Page->writeAttribute('id', 6);
					$Page->startElement('Percentage');
						$Page->text($UnknownPercentage);
					$Page->endElement(); // ENDS PERCENTAGE
					$Page->startElement('Browsers');
						$Page->text('Unknown');
					$Page->endElement(); // ENDS BROWSERS
				$Page->endElement(); // ENDS ITEM
				
			}
		}
	} else {
		header("HTTP/1.0 404 Not Found");
	}
?>