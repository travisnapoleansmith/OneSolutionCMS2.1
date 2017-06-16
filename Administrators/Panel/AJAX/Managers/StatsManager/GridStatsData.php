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
		//if ($_SERVER['HTTP_X_REQUESTED_WITH'] === 'XMLHttpRequest') {
			set_time_limit(120);
			ini_set("memory_limit","512M");
			
			///error_reporting(0);
			
			$HOME = $_SERVER['SUBDOMAIN_DOCUMENT_ROOT'];
			$ADMINHOME = $HOME . '/Administrators/';
			$GLOBALS['HOME'] = $HOME;
			$GLOBALS['ADMINHOME'] = $ADMINHOME;
			
			$Type = $_GET['Type']; // ADStats, SiteStats
			$Name = $_GET['Name']; // Overall, Browsers, BrowsersVersions, Plugins, OS\'s, OSVersions, Languagues, Countries, IPAddresses only options
			$AdStatsPanelName = $_GET['AdStatsPanelName']; // ONLY USE FOR AD STATS; This will determine what the ad panel is being used.
			$ID = $_GET['ID']; // For AdStats -> AdvertiserID only
			$Range = $_GET['Range']; // Date Range
			$RangeType = $_GET['RangeType']; // Daily, Weekly, Monthly, Yearly, Range only options
			$Format = $_GET['Format']; // XML, Excel, CSV - Output Format
			$File = $_GET['File']; // TRUE means to output to a file and send back to user
			
			if (is_null($Format) === TRUE) {
				header("HTTP/1.0 404 Not Found");
			} else if (isset($Format) === FALSE){
				header("HTTP/1.0 404 Not Found");
			} else {
				$PageListingsTable = 'ContentLayerVersion';
				
				// Includes all files
				//require_once ('Configuration/includes.php');
				
				require_once ("$ADMINHOME/Panel/Configuration/includes.php");
				// CREATE AN INI FILE FOR ALL FUNCTION FILES NEEDED
				require_once('Functions/BuildColumns.php');
				require_once('Functions/BuildRows.php');
				
				require_once('Functions/BuildColumnTemplate.php');
				require_once('Functions/BuildColumnNames.php');
				
				require_once('Functions/GridStatsData/Tabs/BuildBrowsers.php');
				require_once('Functions/GridStatsData/Tabs/BuildBrowsersVersions.php');
				require_once('Functions/GridStatsData/Tabs/BuildPlugins.php');
				
				$GridStatsDataConfigurationFileName = '../../../Configuration/Managers/StatsManager/GridStatsData/Settings.ini';
				if (file_exists($GridStatsDataConfigurationFileName)) {
					$GridStatsDataConfiguration = parse_ini_file($GridStatsDataConfigurationFileName, true);
				} else {
					$GridStatsDataConfiguration = NULL;
				}
				
				$Tier2Databases = new DataAccessLayer();
				$Tier2Databases->setDatabaseAll ($credentaillogonarray[0], $credentaillogonarray[1], $credentaillogonarray[2], $credentaillogonarray[3], NULL);
				$Tier2Databases->buildModules('DataAccessLayerModules', 'DataAccessLayerTables', 'DataAccessLayerModulesSettings');
				
				$PageID = array();
				$PageID['CurrentVersion'] = 'true';
				$Tier2Databases->createDatabaseTable($PageListingsTable);
				$Tier2Databases->Connect($PageListingsTable);
				
				$Tier2Databases->pass ($PageListingsTable, 'setOrderbyname', array('Name' => 'PageID'));
				$Tier2Databases->pass ($PageListingsTable, 'setOrderbytype', array('Type' => 'ASC'));
				
				$Tier2Databases->pass ($PageListingsTable, 'setDatabaseRow', array('idnumber' => $PageID));
				$PageListings = $Tier2Databases->pass ($PageListingsTable, "getMultiRowField", array());
				$Tier2Databases->Disconnect($PageListingsTable);
				
				require_once('GridStatsDataRange.php');
				
				switch ($Format) {
					case 'XML':
						$Page = new XMLWriter();
						$Page->openMemory();
					
						$Page->setIndent(4);
						
						$Page->startElement('rows');
							require_once('GridStatsDataRange.php');
							
							// LOAD FROM INI FILE
							if ($Type == 'AdStats') {
								
							} else if ($Type == 'SiteStats') {
								require_once('Modules/SiteStats/GridStatsData/GridStatsData.php');
							}
							
						$Page->fullEndElement(); //ENDS ROWS
						
						$PageOutput = $Page->flush();
						header('Content-type: application/xml');
						
						if ($File == 'TRUE') {
							$FileName = $Type . $Name . $RangeType . '.xml';
							header('Content-Disposition: attachment; filename=' . $FileName);
						}
						
						print $PageOutput;
						break;
					case 'Excel':
						header('Content-Type: application/vnd.ms-excel');
						if ($File == 'TRUE') {
							$FileName = $Type . $Name . $RangeType . '.xls';
							header('Content-Disposition: attachment; filename=' . $FileName);
						}
						
						require_once('Modules/Export/XLS/PHPExcel.php');
						$PHPExcel = new PHPExcel();
						
						$PHPExcel->setActiveSheetIndex(0);
						
						require_once('GridStatsDataRange.php');
						require_once('Modules/SiteStats/GridStatsData/GridStatsData.php');
						
						$Title = 'Stats';
						if ($Range !== NULL) {
							if ($EndRange !== NULL) {
								if ($RangeType == 'Weekly') {
									$EndRangeDayMonthYear = $EndRange;
								} else {
									$EndRangeDayMonthYear = date("t-m-Y", strtotime($EndRange));
								}
								$Title .= " " . $Range . ' - ' . $EndRangeDayMonthYear;
							} else {
								$Title .= " " . $Range;
							}
						}
						
						$PHPExcel->getActiveSheet()->setTitle($Title);
						
						$Writer = PHPExcel_IOFactory::createWriter($PHPExcel, 'Excel5');
						$Writer->save('php://output');
						break;
					case 'CSV':
						$Headers = array();
						if ($Type !== NULL) {
							$Headers[] = 'Type = ' . $Type;
						}
						
						if ($Name !== NULL) {
							$Headers[] = 'Name = ' . $Name;
						}
						
						if ($RangeType !== NULL) {
							$Headers[] = 'Range Type = ' . $RangeType;
						}
						
						if ($Range !== NULL) {
							if ($EndRange !== NULL) {
								if ($RangeType == 'Weekly') {
									$EndRangeDayMonthYear = $EndRange;
								} else {
									$EndRangeDayMonthYear = date("t-m-Y", strtotime($EndRange));
								}
								$Headers[] = 'Range (Day - Month - Year) = ' . $Range . ' - ' . $EndRangeDayMonthYear;
							} else {
								$Headers[] = 'Range (Day - Month - Year) = ' . $Range;
							}
						}
						
						header('Content-Type: text/csv; charset=utf-8');
						
						if ($File == 'TRUE') {
							$FileName = $Type . $Name . $RangeType . '.csv';
							header('Content-Disposition: attachment; filename=' . $FileName);
						}
					
						$Output = fopen('php://output', 'w');
						fputcsv($Output, $Headers);
						
						require_once('GridStatsDataRange.php');
						require_once('Modules/SiteStats/GridStatsData/GridStatsData.php');
						
						fclose($Output);
						break;
					default:
						header("HTTP/1.0 404 Not Found");
				}
			}	
		//} else {
			//header("HTTP/1.0 404 Not Found");
		//}
	} else {
		header("HTTP/1.0 404 Not Found");
	}
?>