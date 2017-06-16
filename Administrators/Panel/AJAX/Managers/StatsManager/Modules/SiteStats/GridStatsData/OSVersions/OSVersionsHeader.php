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
			if (is_array($PageListings) === TRUE) {
				$FileName = $GridStatsDataConfiguration['Tab Configuration Files']['OSVersions'];
				if (file_exists($FileName) === TRUE) {
					$OSVersionssConfiguration = parse_ini_file($FileName, true);
				} else {
					$OSVersionssConfiguration = NULL;
				}
				
				$ColumnNames = array();
				buildColumnTemplate($OSVersionssConfiguration, $Elements);
				buildColumnNames($OSVersionssConfiguration, $ColumnNames);
				
				require_once('Functions/BuildOSesVersionsColumnNames.php');
				$ReturnData = buildOSesVersionsColumnNames($PageListings, $BrowsersStats, $FileName);
				$OSes = $ReturnData['Types'];
				$OSesData = $ReturnData['Data'];
				
				if (is_array($OSes) === TRUE) {
					foreach ($OSes as $OSKey => $OSValue) {
						if ($OSValue != NULL) {
							$ColumnNames[] = $OSValue;
						} else {
							$ColumnNames[] = 'Unknown';
						}
					}
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
						$Output = $GLOBALS['Output'];
						if (is_null($Output) === TRUE) {
							header("HTTP/1.0 404 Not Found");
						} else if (isset($Output) === FALSE){
							header("HTTP/1.0 404 Not Found");
						} else {
							$Headings = array();
							foreach ($Elements as $Key => $Value) {
								if ($Key !== 'TEMPLATE') {
									$Headings[] = $Value['text'];
								}
							}
							$Headings = array_merge($Headings, $ColumnNames);
							
							fputcsv($Output, $Headings);
						}
						break;
					default:
						header("HTTP/1.0 404 Not Found");
				}
			}
		}
	} else {
		header("HTTP/1.0 404 Not Found");
	}		
?>