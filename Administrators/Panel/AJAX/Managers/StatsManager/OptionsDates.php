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
		if ($_SERVER['HTTP_X_REQUESTED_WITH'] === 'XMLHttpRequest') {
			set_time_limit(120);
			
			//error_reporting(0);
			
			$HOME = $_SERVER['SUBDOMAIN_DOCUMENT_ROOT'];
			$ADMINHOME = $HOME . '/Administrators/';
			$GLOBALS['HOME'] = $HOME;
			$GLOBALS['ADMINHOME'] = $ADMINHOME;
			
			$Range = $_GET['Range'];
			
			$InitialYear = 2014;
			
			$CurrentYear = date('Y');
			
			$Page = new XMLWriter();
			$Page->openMemory();
		
			$Page->setIndent(4);
			
			// Includes all files
			//require_once ('Configuration/includes.php');
			
			require_once ("$ADMINHOME/Panel/Configuration/includes.php");
			
			$Page->startElement('data');
				$Page->startElement('item');
				$Page->writeAttribute('value', '');
				$Page->writeAttribute('label', '');
				$Page->endElement(); // ENDS ITEM
				
				if ($Range != NULL) {
					if ($Range == 'Yearly') {
						$YearlyArray = array();
						for ($TempCurrentYear = $InitialYear; $TempCurrentYear <= $CurrentYear; $TempCurrentYear++) {
							$YearlyArray[] = $TempCurrentYear;
						}
						
						$YearlyArray = array_reverse($YearlyArray);
						
						if (is_array($YearlyArray)) {
							foreach ($YearlyArray as $Key => $Data) {
								$Value = $Data;
								$Label = $Data;
								$Page->startElement('item');
								$Page->writeAttribute('value', $Value);
								$Page->writeAttribute('label', $Label);
								$Page->endElement(); // ENDS ITEM
							}
						}
					}
					
					if ($Range == 'Monthly') {
						$CurrentMonth = date('m');
						
						$MonthlyArray = array();
						
						for ($TempCurrentYear = $InitialYear; $TempCurrentYear < $CurrentYear; $TempCurrentYear++) {
							for ($TempCurrentMonth = 1; $TempCurrentMonth <= 12; $TempCurrentMonth++) {
								$TempMonth = date("F", mktime(0, 0, 0, $TempCurrentMonth, 10)) . ' ' . $TempCurrentYear;  
							
								$MonthlyArray[] = $TempMonth;
							}
						}
						
						for ($TempCurrentMonth = 1; $TempCurrentMonth <= $CurrentMonth; $TempCurrentMonth++) {
							$TempMonth = date("F", mktime(0, 0, 0, $TempCurrentMonth, 10)) . ' ' . $CurrentYear;  
							
							$MonthlyArray[] = $TempMonth;
						}
						
						$MonthlyArray = array_reverse($MonthlyArray);
						
						if (is_array($MonthlyArray)) {
							foreach ($MonthlyArray as $Key => $Data) {
								$TimeStamp = strtotime($Data);
								$Value = date('m-Y', $TimeStamp);
								$Label = $Data;
								$Page->startElement('item');
								$Page->writeAttribute('value', $Value);
								$Page->writeAttribute('label', $Label);
								$Page->endElement(); // ENDS ITEM
							}
						}
					}
					
					if ($Range == 'Weekly') {
						$Date = new DateTime();
						$CurrentWeekNumber = date("W");
						
						$TempCurrentWeekNumber = 1;
						$TempCurrentYear = $InitialYear;
						$Date->setISODate($TempCurrentYear, $TempCurrentWeekNumber);
						$STOP = TRUE;
						if ($TempCurrentWeekNumber == 1 && $TempCurrentYear == $InitialYear) {
							$WeekStart = "January 1, " . $InitialYear;
							$Date->modify('+1 week');
							$Date->modify('-2 day');
							$WeekEnd = $Date->format('F d, Y');
							$Date->modify('+1 day');
							$WeeklyArray[] = $WeekStart . ' - ' . $WeekEnd;
						}
						
						do {
							$WeekStart = $Date->format('F d, Y');
							$Date->modify('+1 week');
							$Date->modify('-1 day');
							$WeekEnd = $Date->format('F d, Y');
							$Date->modify('+1 day');
							
							$TempCurrentYear = $Date->format('Y');
							$TempCurrentWeekNumber = $Date->format('W');
							
							$WeeklyArray[] = $WeekStart . ' - ' . $WeekEnd;
							
							if ($TempCurrentYear == $CurrentYear && $TempCurrentWeekNumber == $CurrentWeekNumber) {
								$STOP = FALSE;
							}
						} while ($STOP);
						
						$WeeklyArray = array_reverse($WeeklyArray);
						
						if (is_array($WeeklyArray)) {
							foreach ($WeeklyArray as $Key => $Data) {
								$DateArray = explode(' - ', $Data);
								$TimeStamp = strtotime($DateArray[0]);
								$Value = date('d-m-Y', $TimeStamp) . ':';
								$TimeStamp = strtotime($DateArray[1]);
								$Value .= date('d-m-Y', $TimeStamp);
								
								$Label = $Data;
								$Page->startElement('item');
								$Page->writeAttribute('value', $Value);
								$Page->writeAttribute('label', $Label);
								$Page->endElement(); // ENDS ITEM
							}
						}
					}
			}
			
			$Page->fullEndElement(); //ENDS BODY
			
			$PageOutput = $Page->flush();
			header('Content-type: text/xml');
			print $PageOutput;
		
		} else {
			header("HTTP/1.0 404 Not Found");
		}
	} else {
		header("HTTP/1.0 404 Not Found");
	}
?>