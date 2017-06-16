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
			$Number = 2; // EXCEL SPREADSHEET FORMAT
			foreach ($PageListings as $Key => $Data) {
				$Information = array();
				$Attributes = array();
				
				$Information[] = $Data['PageID'];
				$Information[] = $Data['ContentPageMenuTitle'];
				
				if (is_array($SiteStats) === TRUE) {
					$Temp = $SiteStats[$Data['PageID']];
					$TotalCount = 0;
					
					if (isset($Temp[0]['Timestamp']) === TRUE) {
						$TotalCount = count($Temp);
					}
					
					$Information[] = $TotalCount;
					
				} else {
					$TotalCount = 0;
					$Information[] = $TotalCount;
				}
				
				if (is_array($BrowsersStats) === TRUE) {
					$Temp = $BrowsersStats[$Data['PageID']];
					$HumanCount = 0;
					
					if (isset($Temp[0]['Timestamp']) === TRUE) {
						$HumanCount = count($Temp);
					}
					
					$Information[] = $HumanCount;
				} else {
					$HumanCount = 0;
					$Information[] = $HumanCount;
				}
				
				$FileName = $GridStatsDataConfiguration['Tab Configuration Files']['Plugins'];
				
				$BuildRowsInformation = array();
				$BuildRowsInformation['Information'] = $Information;
				$BuildRowsInformation['Attributes'] = $Attributes;
				$BuildRowsInformation['Page'] = $Page;
				
				switch ($Format) {
					case 'XML':
						$Page->startElement('row');
						$Page->writeAttribute('id', $Data['PageID']);
							buildPlugins($Data, $BrowsersStats, $BuildRowsInformation, $FileName);
						$Page->endElement(); // ENDS ROW
						break;
					case 'Excel':
						buildPlugins($Data, $BrowsersStats, $BuildRowsInformation, $FileName);
						$Number++;
						break;
					case 'CSV':
						buildPlugins($Data, $BrowsersStats, $BuildRowsInformation, $FileName);
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