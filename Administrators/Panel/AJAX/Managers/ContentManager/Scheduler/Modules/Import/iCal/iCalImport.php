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
	
	$FAILURE = NULL;
	if ($RefererPage == $ServerLocation . "/Administrators/Panel/Managers/ContentManager/Scheduler/Scheduler.php") {
		// iCal IMPORT
		if ($Scheduler != NULL) {
			if (file_exists($File) === TRUE) {
				if (strstr($File, '.ics') == TRUE) { // RETURNS SEARCH STRING NOT TRUE
					$Handle = fopen($File, 'r');
					
					if ($Handle === FALSE) {
						header("Content-Type: text/json");
						print_r("{state: false, name: '" . $_FILES['file']['name'] . "', extra: {Error: 'Filename does not exist!', param: ''}}");
						exit;
						//throw new Exception('Filename does not exist!');
					}
					
					$iCalFile = file_get_contents($File);
					require_once("Modules/Import/iCal/class.php");
					
					$iCalExport = new ICalExporter();
					$iCalEvents = $iCalExport->toHash($iCalFile);
					
					$FormatValidationError = FALSE;
					$FormatOptionalValidationError = FALSE;
					
					$ImportFields = $SchedulerConfiguration['iCalImportFields'];
					$Data = array();
					
					foreach ($iCalEvents as $iCalEventsKeys => $iCalEventsData) {
						if (is_array($iCalEventsData) === TRUE) {
							foreach($iCalEventsData as $iCalEventsDataKey => $iCalEventsDataValue) {
								if (isset($ImportFields[$iCalEventsDataKey]) === FALSE) {
									$FormatValidationError = TRUE;
									break 2;
								}
							}
							
							// Assign iCalEventsDataValue to new array for importing
							$StartDate = $iCalEventsData['start_date'];
							$EndDate = $iCalEventsData['end_date'];
							$Text = $iCalEventsData['text'];
							$EnableDisable = $SchedulerConfiguration['DEFAULT']['Enable/Disable'];
							$Status = $SchedulerConfiguration['DEFAULT']['Status'];
							
							$StartDateTimestamp = strtotime($StartDate);
							$EndDateTimestamp = strtotime($EndDate);
							
							$StartDay = date('d', $StartDateTimestamp);
							$StartMonth = date('F', $StartDateTimestamp);
							$StartYear = date('Y', $StartDateTimestamp);
							$StartTime = date('h:i:s', $StartDateTimestamp);
							$StartTimeAmPm = date('A', $StartDateTimestamp);
							$StartTimeZone = $SchedulerConfiguration['Content']['StartTimeZone'];
							
							$EndDay = date('d', $EndDateTimestamp);
							$EndMonth = date('F', $EndDateTimestamp);
							$EndYear = date('Y', $EndDateTimestamp);
							$EndTime = date('h:i:s', $EndDateTimestamp);
							$EndTimeAmPm = date('A', $EndDateTimestamp);
							$EndTimeZone = $SchedulerConfiguration['Content']['EndTimeZone'];
							
							// Add / Update Calendar Appointment Data
							$Data[$iCalEventsKeys]['StartDay'] = $StartDay;
							$Data[$iCalEventsKeys]['StartMonth'] = $StartMonth;
							$Data[$iCalEventsKeys]['StartYear'] = $StartYear;
							$Data[$iCalEventsKeys]['StartTime'] = $StartTime;
							$Data[$iCalEventsKeys]['StartTimeAmPm'] = $StartTimeAmPm;
							$Data[$iCalEventsKeys]['StartTimeZone'] = $StartTimeZone;
							$Data[$iCalEventsKeys]['EndDay'] = $EndDay;
							$Data[$iCalEventsKeys]['EndMonth'] = $EndMonth;
							$Data[$iCalEventsKeys]['EndYear'] = $EndYear;
							$Data[$iCalEventsKeys]['StartTime'] = $StartTime;
							$Data[$iCalEventsKeys]['EndTime'] = $EndTime;
							$Data[$iCalEventsKeys]['EndTimeAmPm'] = $EndTimeAmPm;
							$Data[$iCalEventsKeys]['EndTimeZone'] = $EndTimeZone;
							$Data[$iCalEventsKeys]['Appointment'] = $Text;
							$Data[$iCalEventsKeys]['Enable/Disable'] = $EnableDisable;
							$Data[$iCalEventsKeys]['Status'] = $Status;
						} else {
							$FormatValidationError = TRUE;
							break;
						}
					}
					
					$ColumnNames = $SchedulerConfiguration['ImportFormat'];
					
					// IF TRUE PERFORMS THE IMPORT IF FALSE THROWS AN ERROR
					if ($FormatValidationError === FALSE & $FormatOptionalValidationError === FALSE) {
						// WALK DATA ARRAY TO LOOK FOR EMPTY RECORDS
						$TempData = $Data;
						$Data = array();
						if (is_array($TempData) === TRUE) {
							foreach ($TempData as $Key => $Value) {
								if (is_null($Value) === FALSE) {
									$Data[$Key] = $Value;
								} else if (empty($Value) === FALSE) {
									$Data[$Key] = $Value;
								}
							}
						}
						
						// WALK DATA ARRAY TO CREATE DATABASE RECORD
						$Content = NULL;
						$Content = $SchedulerConfiguration['Content'];
						
						if (is_array($Data) === TRUE) {
							foreach ($Data as $Key => $Value) {
								if ($Key != 0) {
									// WRITE DATA CONTENT TO FILE BEFORE ANYTHING ELSE IS DONE - Calendar Appointment Data
									$LogFile = "PostCalendarEvent.txt";
									$LogFileHandle = fopen($LogFile, 'a');
									$FileInformation = 'Logging - Current DATA Pre NullCheck - Calendar Event CSV Import Script Loading - ' . date("F j, Y, g:i a") . "\n";
									fwrite($LogFileHandle, $FileInformation);
									fwrite($LogFileHandle, print_r($Key, TRUE));
									fwrite($LogFileHandle, "\n");
									fwrite($LogFileHandle, print_r($Value, TRUE));
									fwrite($LogFileHandle, "\n---------------------------------------------\n\n");
									fclose($LogFileHandle);
									
									$TempContent = array();
									foreach ($ColumnNames as $ColumnNameKey => $ColumnNameValue) {
										$TempContent[$ColumnNameValue] = $Value[$ColumnNameKey];
									}
									if ($TempContent['CalendarID'] !== NULL) {
										$TempContent['CalendarID'] = NULL;
									}
									
									if (isset($TempContent['TableName']) === FALSE) {
										$TempContent['TableName'] = $Content['TableName'];
									}

									// CAN REMOVE ONCE OLD ADMIN PANEL IS REMOVED
									$FormSelect = NULL;
									$FormSelect = $SchedulerConfiguration['FormSelect'];
									
									// CAN REMOVE ONCE OLD ADMIN PANEL IS REMOVED
									$FormOption = NULL;
									$FormOption = $SchedulerConfiguration['FormOption'];
									
									// CAN REMOVE ONCE OLD ADMIN PANEL IS REMOVED
									$UpdateSelectPage = $Options['XhtmlCalendarTable']['calendar']['CalendarEventUpdateSelectPage']['SettingAttribute'];
									
									// CAN REMOVE ONCE OLD ADMIN PANEL IS REMOVED
									$Text = $TempContent['Appointment'];
									$FormOptionText = NULL;
									
									$Date = date_parse($TempContent['StartMonth']);
									if ($Date['month'] < 10) {
										$FormOptionText .= 0 . $Date['month'];
									} else {
										$FormOptionText .= $Date['month'];
									}
									$FormOptionText .= '/' . $TempContent['StartDay'] . '/' . $TempContent['StartYear'] . ' ';
									$FormOptionText .= $TempContent['StartTime'] . ' ' . $TempContent['StartTimeAmPm'] . ' - ';
									
									$Date = date_parse($TempContent['EndMonth']);
									if ($Date['month'] < 10) {
										$FormOptionText .= 0 . $Date['month'];
									} else {
										$FormOptionText .= $Date['month'];
									}
									$FormOptionText .= '/' . $TempContent['EndDay'] . '/' . $TempContent['EndYear'] . ' ';
									$FormOptionText .= $TempContent['EndTime'] . ' ' . $TempContent['EndTimeAmPm'] . ' - ';
									
									$temp = $Text;
									$temp = explode(' ', $temp);
							
									for ($i = 0; $i < 5; $i++) {
										$FormOptionText .= $temp[$i];
										$FormOptionText .= ' ';
									}
									unset($temp);
		
									$EnableDisable = $SchedulerConfiguration['DEFAULT']['Enable/Disable'];
									$Status = $SchedulerConfiguration['DEFAULT']['Status'];
									// END REMOVE ONCE OLD ADMIN PANEL IS REMOVED
									
									// WRITE DATABASE CONTENT TO FILE BEFORE NullCheck- Calendar Appointment Data
									$LogFile = "PostCalendarEvent.txt";
									$LogFileHandle = fopen($LogFile, 'a');
									$FileInformation = 'Logging - POST Content Pre NullCheck - Calendar Event CSV Import Script Loading - ' . date("F j, Y, g:i a") . "\n";
									fwrite($LogFileHandle, $FileInformation);
									fwrite($LogFileHandle, print_r($Content, TRUE));
									fwrite($LogFileHandle, "\n---------------------------------------------\n\n");
									fclose($LogFileHandle);
									
									// HAVE TO MAKE SURE NULL IS TRUELY NULL AND NOT AN EMPTY STRING
									
									// CAN REMOVE ONCE OLD ADMIN PANEL IS REMOVED
									// FormSelect Data
									$FormSelect['PageID'] = $UpdateSelectPage;
									$FormSelect['Enable/Disable'] = $EnableDisable;
									$FormSelect['Status'] = $Status;
									
									// CAN REMOVE ONCE OLD ADMIN PANEL IS REMOVED
									// WRITE DATABASE FORMSELECT TO FILE BEFORE NullCheck- Calendar Appointment Data
									$LogFile = "PostCalendarEvent.txt";
									$LogFileHandle = fopen($LogFile, 'a');
									$FileInformation = 'Logging - POST FormSelect Pre NullCheck - Calendar Event CSV Import Script Loading - ' . date("F j, Y, g:i a") . "\n";
									fwrite($LogFileHandle, $FileInformation);
									fwrite($LogFileHandle, print_r($FormSelect, TRUE));
									fwrite($LogFileHandle, "\n---------------------------------------------\n\n");
									fclose($LogFileHandle);
									
									// CAN REMOVE ONCE OLD ADMIN PANEL IS REMOVED
									// FormOption Data
									$FormOption['PageID'] = $UpdateSelectPage;
									$FormOption['FormOptionText'] = $FormOptionText;
									$FormOption['Enable/Disable'] = $EnableDisable;
									$FormOption['Status'] = $Status;
									
									// CAN REMOVE ONCE OLD ADMIN PANEL IS REMOVED
									// WRITE DATABASE FORMOPTION TO FILE BEFORE NullCheck- Calendar Appointment Data
									$LogFile = "PostCalendarEvent.txt";
									$LogFileHandle = fopen($LogFile, 'a');
									$FileInformation = 'Logging - POST FormOption Pre NullCheck - Calendar Event CSV Import Script Loading - ' . date("F j, Y, g:i a") . "\n";
									fwrite($LogFileHandle, $FileInformation);
									fwrite($LogFileHandle, print_r($FormOption, TRUE));
									fwrite($LogFileHandle, "\n---------------------------------------------\n\n");
									fclose($LogFileHandle);
									
									// Assign all NULL values to be truely NULL
									$TempContent = $Tier6Databases->NullCheck ($TempContent);
									$FormSelect = $Tier6Databases->NullCheck ($FormSelect);
									$FormOption = $Tier6Databases->NullCheck ($FormOption);
									
									//CAN REMOVE ONCE OLD ADMIN PANEL IS REMOVED - FORMOPTION AND FORMSELECT
									$ReturnData = CreateRecord($Page, $Tier6Databases, $Options, $FormSelect, $FormOption, $TempContent);
									
									if ($ReturnData === FALSE) {
										$FAILURE = TRUE;
									} else if ($ReturnData === TRUE) {
										$Options['XhtmlCalendarTable']['calendar']['LastEvent']['SettingAttribute']++;
									}
								}
							}
						}
						$FAILURE = FALSE;
					} else {
						$FAILURE = TRUE;
					}
					
				} else {
					// FAILED TO BE AN ICS FILE
					$FAILURE = FALSE;
				}
				
				if (unlink($File) === FALSE) {
					header("Content-Type: text/json");
					print_r("{state: false, name: '" . $_FILES['file']['name'] . "', extra: {Error: 'Filename can not be deleted!', param: ''}}");
					exit;
					//throw new Exception('Filename can not be deleted!');
				} else {
					header("Content-Type: text/json");
					if ($FAILURE === FALSE) {
						print_r("{state: true, name: '" . $_FILES['file']['name'] . "', extra: {Message: 'File has imported!', param: ''}}");
						exit;
					} else if ($FAILURE === TRUE) {
						print_r("{state: false, name: '" . $_FILES['file']['name'] . "', extra: {Error: 'Incorrect Format!', param: ''}}");
						exit;
					} else if ($FAILURE === NULL) {
						print_r("{state: true, name: '" . $_FILES['file']['name'] . "', extra: {Message: '', param: ''}}");
						exit;
					}
				}
			} else {
				header("Content-Type: text/json");
				print_r("{state: false, name: '" . $_FILES['file']['name'] . "', extra: {Error: 'File does not exists!', param: ''}}");
				exit;
			}
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