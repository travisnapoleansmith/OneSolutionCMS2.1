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
		// XLS IMPORT
		if ($Scheduler != NULL) {
			if (file_exists($File) === TRUE) {
				if (strstr($File, '.xls') == TRUE) { // RETURNS SEARCH STRING NOT TRUE
					require_once ("$HOME/Libraries/GlobalLayer/GooglePHPExcelReader/excel_reader2.php");
					$Data = new Spreadsheet_Excel_Reader($File);
					
					$RowCount = $Data->rowcount();
					$ColumnCount = $Data->colcount();
					$Column1 = $Data->colindexes[1];
					$Row = 1;
					$Col = 1;
					$Sheet = 0;
					$Cells = $Data->sheets[$Sheet]['cells'];
					$ColumnNames = array();
					
					if (is_array($Cells[1]) === TRUE) {
						$ColumnNames = $Cells[1];
					}
					
					$Format = array();
					$FormatOptional = array();
					
					$Format = $SchedulerConfiguration['ImportFormat'];
					$FormatOptional = $SchedulerConfiguration['ImportFormatOptional'];
					
					$FormatValidationError = FALSE;
					$FormatOptionalValidationError = FALSE;
					foreach($ColumnNames as $ColumnNamesKey => $ColumnNamesValue) {
						if ($ColumnNamesValue !== 'CalendarID') {
							if (isset($Format[$ColumnNamesValue]) === FALSE) {
								$FormatValidationError = TRUE;
							}
						}
						if (isset($FormatOptional[$ColumnNamesValue]) === FALSE) {
							$FormatOptionalValidationError = TRUE;
						}
					}
					
					// IF TRUE PERFORMS THE IMPORT IF FALSE THROWS AN ERROR
					if ($FormatValidationError === FALSE & $FormatOptionalValidationError === FALSE) {
						// WALK CELLS ARRAY TO LOOK FOR EMPTY RECORDS
						$TempCells = $Cells;
						$Cells = array();
						if (is_array($TempCells) === TRUE) {
							foreach ($TempCells as $Key => $Value) {
								if (is_null($Value) === FALSE) {
									$Cells[$Key] = $Value;
								} else if (empty($Value) === FALSE) {
									$Cells[$Key] = $Value;
								}
							}
						}
						
						// WALK CELLS ARRAY TO CREATE DATABASE RECORD
						$Content = NULL;
						$Content = $SchedulerConfiguration['Content'];
						
						if (is_array($Cells) === TRUE) {
							foreach ($Cells as $Key => $Value) {
								if ($Key != 1) {
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
									$FileInformation = 'Logging - POST Content Pre NullCheck - Calendar Event XLS Import Script Loading - ' . date("F j, Y, g:i a") . "\n";
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
									$FileInformation = 'Logging - POST FormSelect Pre NullCheck - Calendar Event XLS Import Script Loading - ' . date("F j, Y, g:i a") . "\n";
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
									$FileInformation = 'Logging - POST FormOption Pre NullCheck - Calendar Event XLS Import Script Loading - ' . date("F j, Y, g:i a") . "\n";
									fwrite($LogFileHandle, $FileInformation);
									fwrite($LogFileHandle, print_r($FormOption, TRUE));
									fwrite($LogFileHandle, "\n---------------------------------------------\n\n");
									fclose($LogFileHandle);
									
									// Assign all NULL values to be truely NULL
									$TempContent = $Tier6Databases->NullCheck ($TempContent);
									$FormSelect = $Tier6Databases->NullCheck ($FormSelect);
									$FormOption = $Tier6Databases->NullCheck ($FormOption);
									
									/*CAN REMOVE ONCE OLD ADMIN PANEL IS REMOVED - FORMOPTION AND FORMSELECT*/
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
					
				} else if (strstr($File, '.csv') == TRUE) {
					$SchedulerConfiguration = $GLOBALS['SchedulerConfiguration'];
					if (isset($SchedulerConfiguration[$Type][$Format]) === TRUE){
						$FormatFilename = $SchedulerConfiguration['Import']['CSV'];
						if (file_exists($FormatFilename)) {
							require_once($FormatFilename);
							//$FileName = $_FILES['file']['tmp_name'] . '/' . $_FILES['file']['name'];
						} else {
							header("Content-Type: text/json");
							print_r("{state: false, name: '" . $_FILES['file']['name'] . "', extra: {Error: 'Format Filename does not exist!', param: ''}}");
							exit;
							//throw new Exception($Format . ' - Format Filename does not exist!');
						}
					} else {
						header("Content-Type: text/json");
						print_r("{state: false, name: '" . $_FILES['file']['name'] . "', extra: {Error: 'CSV file is not set in configuration or the file does not exist!', param: ''}}");
						exit;
					}
				} else {
					// FAILED TO BE AN EXCEL FILE
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
						print_r("{state: false, name: '" . $_FILES['file']['name'] . "', extra: {Error: 'Incorrect Format - Records Columns Are Incorrect!', param: ''}}");
						exit;
					} else if ($FAILURE === NULL) {
						print_r("{state: true, name: '" . $_FILES['file']['name'] . "', extra: {Message: '', param: ''}}");
						exit;
					}
				}
			} else {
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