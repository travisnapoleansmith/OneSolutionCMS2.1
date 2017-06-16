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
	if ($RefererPage == $ServerLocation . "/Administrators/Panel/Managers/ContentManager/Scheduler/Scheduler.php") {
		// XLS Export
		if ($Scheduler != NULL) {
			$Tier2Databases = new DataAccessLayer();
			$Tier2Databases->setDatabaseAll ($credentaillogonarray[0], $credentaillogonarray[1], $credentaillogonarray[2], $credentaillogonarray[3], NULL);
			$Tier2Databases->buildModules('DataAccessLayerModules', 'DataAccessLayerTables', 'DataAccessLayerModulesSettings');
			
			$Tier2Databases->createDatabaseTable($Scheduler);
			$Tier2Databases->Connect($Scheduler);
			$Tier2Databases->pass ($Scheduler, "setEntireTable", array());
			$EventListings= $Tier2Databases->pass ($Scheduler, "getEntireTable", array());
			$Tier2Databases->Disconnect($Scheduler);
			
			header('Content-Type: application/vnd.ms-excel');
			header('Content-Disposition: attachment; filename=CalendarEvents.xls');
			
			require_once('Modules/Export/XLS/PHPExcel.php');
			$PHPExcel = new PHPExcel();
			
			$PHPExcel->setActiveSheetIndex(0);
           
			// Header Row
			$Record = $EventListings[1];
			$Letter = 'A';
			$Number = 1;
			foreach ($Record as $Key => $Value) {
				$PHPExcel->setActiveSheetIndex(0)->setCellValue($Letter . $Number, $Key);
				$Letter++;
			}
			
			// Data Rows
			$Letter = 'A';
			$Number = 2;
			foreach ($EventListings as $EventKey => $EventValue) {
				$Letter = 'A';
				foreach ($EventValue as $Key => $Value) {
					if (empty($Value) === TRUE) {
						$PHPExcel->setActiveSheetIndex(0)->setCellValue($Letter . $Number, 'NULL');
					} else {
						$PHPExcel->setActiveSheetIndex(0)->setCellValue($Letter . $Number, $Value);
					}
					$Letter++;
				}
				$Number++;
			}
			
			$PHPExcel->getActiveSheet()->setTitle('Calendar Events');
			
			$Writer = PHPExcel_IOFactory::createWriter($PHPExcel, 'Excel5');
			$Writer->save('php://output');
			
		} else {
			header("Content-Type: text/json");
			print_r("{state: false, name: '" . $_FILES['file']['name'] . "', extra: {Error: 'Scheduler is not set!', param: ''}}");
			exit;
			//header("HTTP/1.0 404 Not Found - Scheduler is not set!");
		}
	} else {
		header("HTTP/1.0 404 Not Found");
	}
?>