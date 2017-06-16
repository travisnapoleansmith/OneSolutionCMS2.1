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
		$Format = $GLOBALS['Format'];
		
		if (is_null($Format) === TRUE) {
			header("HTTP/1.0 404 Not Found");
		} else if (isset($Format) === FALSE){
			header("HTTP/1.0 404 Not Found");
		} else {
			// ->>>>>>>>>>>>>>> FUNCTION NEEDED
			if (is_array($PageListings) === TRUE) {
				require_once('Functions/BuildBrowsersVersionsColumnNames.php');
				
				$FileName = $GridStatsDataConfiguration['Tab Configuration Files']['BrowsersVersions'];
				if (file_exists($FileName) === TRUE) {
					$BrowsersVersionsConfiguration = parse_ini_file($FileName, true);
				} else {
					$BrowsersVersionsConfiguration = NULL;
				}
				
				$ReturnData = buildBrowsersVersionsColumnNames($PageListings, $BrowsersStats, $FileName);
		
				if (is_array($ReturnData) === TRUE) {
					$IEVersions = $ReturnData['Versions']['IEVersions'];
					$FirefoxVersions = $ReturnData['Versions']['FirefoxVersions'];
					$SafariVersions = $ReturnData['Versions']['SafariVersions'];
					$ChromeVersions = $ReturnData['Versions']['ChromeVersions'];
					$OperaVersions = $ReturnData['Versions']['OperaVersions'];
					$UnknownVersions = $ReturnData['Versions']['UnknownVersions'];
					
					$VersionsData = $ReturnData['VersionsData'];
				}
				
				$ColumnNames = array();
				buildColumnTemplate($BrowsersVersionsConfiguration, $Elements);
				buildColumnNames($BrowsersVersionsConfiguration, $ColumnNames);
				
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
				
				if (!is_array($UnknownVersions)) {
					$ColumnNames[] = 'Unknown';
				}
							
				switch ($Format) {
					case 'XML':
						$Page->startElement('head');
							buildColumns($Elements, $ColumnNames, $Page);
						$Page->fullEndElement(); // ENDS HEAD
						break;
					case 'Excel':
						$PHPExcel = $GLOBALS['PHPExcel'];
						if (is_null($PHPExcel) === TRUE) {
							header("HTTP/1.0 404 Not Found");
						} else if (isset($PHPExcel) === FALSE){
							header("HTTP/1.0 404 Not Found");
						} else {
							$Headings = array();
							foreach ($Elements as $Key => $Value) {
								if ($Key !== 'TEMPLATE') {
									$Headings[] = $Value['text'];
								}
							}
							$Headings = array_merge($Headings, $ColumnNames);
							
							$Letter = 'A';
							$Number = 1;
							foreach ($Headings as $Key => $Value) {
								$PHPExcel->setActiveSheetIndex(0)->setCellValue($Letter . $Number, $Value);
								$Letter++;
							}
						}
						break;
					case 'CSV':
						$Headings = array();
						foreach ($Elements as $Key => $Value) {
							if ($Key !== 'TEMPLATE') {
								$Headings[] = $Value['text'];
							}
						}
						$Headings = array_merge($Headings, $ColumnNames);
						
						fputcsv($Output, $Headings);
						break;
					default:
						header("HTTP/1.0 404 Not Found");
				}
			}
			// END FUNCTION
		}
	} else {
		header("HTTP/1.0 404 Not Found");
	}		
?>