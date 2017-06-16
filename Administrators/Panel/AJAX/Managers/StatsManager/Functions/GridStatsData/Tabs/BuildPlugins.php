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
	require_once('Functions/BuildRows.php');
	
	function buildPlugins($CurrentRecord, $BrowsersStats, $BuildRowsInformation, $ConfigurationFileName) {
		$Format = $GLOBALS['Format'];
		
		if (is_null($Format) === TRUE) {
			return FALSE;
		} else if (isset($Format) === FALSE){
			return FALSE;
		} else {
			if ($BuildRowsInformation == NULL) {
				return FALSE;
			}
			
			if (is_array($BuildRowsInformation) === FALSE) {
				return FALSE;
			}
			
			if (is_array($BuildRowsInformation['Information']) === FALSE) {
				return FALSE;
			}
			
			if ($BuildRowsInformation['Information'] != NULL) {
				$Information = $BuildRowsInformation['Information'];
			} else {
				$Information = array();
			}
			
			if ($BuildRowsInformation['Attributes'] != NULL) {
				$Attributes = $BuildRowsInformation['Attributes'];
			} else {
				$Attributes = array();
			}
			
			if ($BuildRowsInformation['Page'] != NULL) {
				$Page = $BuildRowsInformation['Page'];
			} else {
				$Page = array();
			}
			
			if ($BrowsersStats != NULL) {
				if (is_array($BrowsersStats) === TRUE) {
					if (file_exists($ConfigurationFileName) === TRUE) {
						$Configuration = parse_ini_file($ConfigurationFileName, true);
					} else {
						$Configuration = NULL;
					}
					
					$Plugins = $Configuration['Types'];
									
					$GoogleBot = 0;
									
					//$Total = 0;
									
					//$TrueTotal = 0;
					
					$Temp = $BrowsersStats[$CurrentRecord['PageID']];
					
					if (is_array($Temp) === TRUE) {
						foreach($Temp as $Key => $Value) {
							// ADD IN CONFIGURATION TO SCAN FOR BOTS
							//$Total++;
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
					}
					
					if (is_array($Plugins) === TRUE) {
						foreach ($Plugins as $PluginsKey => $PluginsValue) {
							if ($$PluginsValue != NULL) {
								$Information[] = $$PluginsValue;
							} else {
								$Information[] = 0;
							}
						}
					}
					
					switch ($Format) {
						case 'XML':
							buildRows($Information, $Attributes, $Page);
							break;
						case 'Excel':
							$PHPExcel = $GLOBALS['PHPExcel'];
							$Number = $GLOBALS['Number'];
							if (is_null($PHPExcel) === TRUE) {
								return FALSE;
							} else if (isset($PHPExcel) === FALSE){
								return FALSE;
							} else {
								if (is_null($Number) === TRUE) {
									return FALSE;
								} else if (isset($Number) === FALSE){
									return FALSE;
								} else {
									$Letter = 'A';
									
									foreach ($Information as $Key => $Value) {
										$PHPExcel->setActiveSheetIndex(0)->setCellValue($Letter . $Number, $Value);
										
										$Letter++;
									}
								}
							}
							break;
						case 'CSV':
							$Output = $GLOBALS['Output'];
							if (is_null($Output) === TRUE) {
								return FALSE;
							} else if (isset($Output) === FALSE){
								return FALSE;
							} else {
								fputcsv($Output, $Information);
							}
							break;
						default:
							return FALSE;
					}
					
				} else {
					return FALSE;
				}
			} else {
				return FALSE;
			}
		}
	}
?>