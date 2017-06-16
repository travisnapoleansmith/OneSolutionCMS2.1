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
		// REMOVED BECAUSE OF EXPORT CAPABILITIES
		//if ($_SERVER['HTTP_X_REQUESTED_WITH'] === 'XMLHttpRequest') {
			set_time_limit(120);
	
			//error_reporting(0);
			
			// ADD LOGGING TO FILE
			
			$HOME = $_SERVER['SUBDOMAIN_DOCUMENT_ROOT'];
			$ADMINHOME = $HOME . '/Administrators/';
			$GLOBALS['HOME'] = $HOME;
			$GLOBALS['ADMINHOME'] = $ADMINHOME;
	
			$SchedulerConfigurationFileName = '../../../../Configuration/Managers/ContentManager/Scheduler/Settings.ini';
			if (file_exists($SchedulerConfigurationFileName)) {
				$SchedulerConfiguration = parse_ini_file($SchedulerConfigurationFileName, true);
			} else {
				$SchedulerConfiguration = NULL;
			}
			
			$Scheduler = $SchedulerConfiguration['General Configuration']['TableName'];

			$Page = new XMLWriter();
			$Page->openMemory();
	
			$Page->setIndent(4);
	
			// Includes all files
			require_once ("$ADMINHOME/Panel/Configuration/includes.php");
			require_once ("Functions.php");
			
			$Options = $Tier6Databases->getLayerModuleSetting();
			
			if ($_SERVER['REQUEST_METHOD'] === 'POST') {
				if (isset($_POST['mycoolxmlbody']) === TRUE) {
					$_POST['Format'] = 'PDF';
					if (isset($_GET['Type']) === TRUE) {
						$_POST['Type'] = $_GET['Type'];
					}
				}
				
				if (isset($_POST['Format']) === TRUE) {
					if (isset($_POST['Type']) === TRUE) {
						// Export
						$Type = $_POST['Type'];
						switch($_POST['Format']) {
							// File Based Configuration for Different Formats Needed
							case (isset($SchedulerConfiguration[$Type][$_POST['Format']]) === TRUE):
								$Format = $_POST['Format'];
								$FormatFilename = $SchedulerConfiguration[$Type][$Format];
								if (file_exists($FormatFilename)) {
									require_once($FormatFilename);
								} else {
									header("Content-Type: text/json");
									print_r("{state: false, name: '" . $_FILES['file']['name'] . "', extra: {Error: 'Format Filename does not exist!', param: ''}}");
									exit;
									//throw new Exception($Format . ' - Format Filename does not exist!');
								}
								break;
							default:
								//header("HTTP/1.0 404 Not Found - Not Valid Format!");
								header("Content-Type: text/json");
								print_r("{state: false, name: '" . $_FILES['file']['name'] . "', extra: {Error: 'Not Valid File Format!', param: ''}}");
								exit;
								//throw new Exception('Not Valid Format!');
						}
					} else {
						header("Content-Type: text/json");
						print_r("{state: false, name: '" . $_FILES['file']['name'] . "', extra: {Error: 'Not Valid Type Declared!', param: ''}}");
						exit;
						//header("HTTP/1.0 404 Not Found - Not Valid Type Declared!");
					}
				} else if (isset($_GET['Type']) === TRUE) {
					if (isset($_FILES['file']) === TRUE) {
						// Import
						$Type = $_GET['Type'];
						$Format = $_FILES['file']['type'];
						
						$FileName  = $_FILES['file']['name'];
    					$TempLocation   = $_FILES['file']['tmp_name'];
						$TargetPath = 'UPLOAD/';
   						$TargetPath = $TargetPath . $FileName;
    					if (move_uploaded_file($TempLocation, $TargetPath) === FALSE) {
							header("Content-Type: text/json");
							print_r("{state: false, name: '" . $_FILES['file']['name'] . "', extra: {Error: 'Filename does not exist!', param: ''}}");
							exit;
							//throw new Exception('Filename does not exist!');
						}
						
						$File = $TargetPath;
						
						switch($Format) {
							// File Based Configuration for Different Formats Needed
							case (isset($SchedulerConfiguration[$Type][$Format]) === TRUE):
								$FormatFilename = $SchedulerConfiguration[$Type][$Format];
								if (file_exists($FormatFilename)) {
									require_once($FormatFilename);
									//$FileName = $_FILES['file']['tmp_name'] . '/' . $_FILES['file']['name'];
								} else {
									header("Content-Type: text/json");
									print_r("{state: false, name: '" . $_FILES['file']['name'] . "', extra: {Error: 'Format Filename does not exist!', param: ''}}");
									exit;
									//throw new Exception($Format . ' - Format Filename does not exist!');
								}
								break;
							default:
								header("Content-Type: text/json");
								print_r("{state: false, name: '" . $_FILES['file']['name'] . "', extra: {Error: 'Not Valid File Format - " . $Format . "!', param: ''}}");
								exit;
								//throw new Exception($Format . ' - Not Valid Format!');
						}
					}
				} else {
					if ($_SERVER['HTTP_X_REQUESTED_WITH'] === 'XMLHttpRequest') {
						// Validation
						$_POST['Event'] = $_POST['text'];
						
						if ($_POST['!nativeeditor_status'] === 'inserted') {
							$AddContent = $SchedulerConfiguration['General Configuration']['AddContent'];
							if (!isset($AddContent)) {
								header("Content-Type: text/json");
								print_r("{state: false, name: '" . $_FILES['file']['name'] . "', extra: {Error: 'AddContent is not set in Settings.ini file!', param: ''}}");
								exit;
								//throw new Exception('AddContent is not set in Settings.ini file!');
							}
							
							$Validation = $Tier6Databases->FormSubmitValidate('AddCalendarEvent', NULL, $AddContent);
							
							if (isset($Validation) === FALSE || isset($Validation['Error']) === TRUE) {
								header("Content-Type: text/json");
								print_r("{state: false, name: '" . $_FILES['file']['name'] . "', extra: {Error: 'Validation has failed!', param: ''}}");
								exit;
								//throw new Exception('Validation has failed!');
							}
							
						} else if ($_POST['!nativeeditor_status'] === 'updated') {
							$UpdateContent = $SchedulerConfiguration['General Configuration']['UpdateContent'];
							if (!isset($UpdateContent)) {
								header("Content-Type: text/json");
								print_r("{state: false, name: '" . $_FILES['file']['name'] . "', extra: {Error: 'UpdateContent is not set in Settings.ini file!', param: ''}}");
								exit;
								//throw new Exception('UpdateContent is not set in Settings.ini file!');
							}
							
							$Validation = $Tier6Databases->FormSubmitValidate('UpdateCalendarEvent', NULL, $UpdateContent);
							
							if (isset($Validation) === FALSE || isset($Validation['Error']) === TRUE) {
								header("Content-Type: text/json");
								print_r("{state: false, name: '" . $_FILES['file']['name'] . "', extra: {Error: 'Validation has failed!', param: ''}}");
								exit;
								//throw new Exception('Validation has failed! ' . print_r($Validation, TRUE));
							}
							
						} else if ($_POST['!nativeeditor_status'] === 'deleted') {
						
						} else {
							header("Content-Type: text/json");
							print_r("{state: false, name: '" . $_FILES['file']['name'] . "', extra: {Error: 'POST[!nativeeditor_status] is not being sent or is set to anything other than inserted or updated!', param: ''}}");
							exit;
							//throw new Exception('POST[!nativeeditor_status] is not being sent or is set to anything other than inserted or updated!');
						}
						
						// WRITE POST TO FILE
						$LogFile = "PostCalendarEvent.txt";
						$LogFileHandle = fopen($LogFile, 'a');
						$FileInformation = 'Logging - POST Calendar Event Script Loading - ' . date("F j, Y, g:i a") . "\n";
						fwrite($LogFileHandle, $FileInformation);
						fwrite($LogFileHandle, print_r($_POST, TRUE));
						fwrite($LogFileHandle, "\n---------------------------------------------\n\n");
						fclose($LogFileHandle);
						
						$Content = NULL;
						$Content = $SchedulerConfiguration['Content'];
						
						// CAN REMOVE ONCE OLD ADMIN PANEL IS REMOVED
						$FormSelect = NULL;
						$FormSelect = $SchedulerConfiguration['FormSelect'];
						
						// CAN REMOVE ONCE OLD ADMIN PANEL IS REMOVED
						$FormOption = NULL;
						$FormOption = $SchedulerConfiguration['FormOption'];
						
						// CAN REMOVE ONCE OLD ADMIN PANEL IS REMOVED
						$UpdateSelectPage = $Options['XhtmlCalendarTable']['calendar']['CalendarEventUpdateSelectPage']['SettingAttribute'];
						
						// DON'T FORGET TO VALIDATE POST DATA FROM FORM
						
						// Data From POST
						$StartDate = $_POST['start_date'];
						$EndDate = $_POST['end_date'];
						$Text = $_POST['text'];
						$EnableDisable = $_POST['EnableDisable'];
						$Status = $_POST['Status'];
						
						if (!isset($EnableDisable)) {
							if (isset($SchedulerConfiguration['DEFAULT']['Enable/Disable'])) {
								$EnableDisable = $SchedulerConfiguration['DEFAULT']['Enable/Disable'];
							} else {
								header("Content-Type: text/json");
								print_r("{state: false, name: '" . $_FILES['file']['name'] . "', extra: {Error: 'Enable/Disable is not being sent and no default has been set!', param: ''}}");
								exit;
								//throw new Exception('Enable/Disable is not being sent and no default has been set!');
							}
						}
						
						if (!isset($Status)) {
							if (isset($SchedulerConfiguration['DEFAULT']['Status'])) {
								$Status = $SchedulerConfiguration['DEFAULT']['Status'];
							} else {
								header("Content-Type: text/json");
								print_r("{state: false, name: '" . $_FILES['file']['name'] . "', extra: {Error: 'Status is not being sent and no default has been set!', param: ''}}");
								exit;
								//throw new Exception('Status is not being sent and no default has been set!');
							}
						}
						
						$TempStartDate = explode(" ", $StartDate);
						$TempStartDate[0] = explode('-', $TempStartDate[0]);
						
						$TempEndDate = explode(" ", $EndDate);
						$TempEndDate[0] = explode('-', $TempEndDate[0]);
						
						$StartDay = $TempStartDate[0][1];
						$StartMonth = $TempStartDate[0][0];
						$StartYear = $TempStartDate[0][2];
						$StartTime = $TempStartDate[1];
						$StartTimeAmPm = $TempStartDate[2];
						
						$EndDay = $TempEndDate[0][1];
						$EndMonth = $TempEndDate[0][0];
						$EndYear = $TempEndDate[0][2];
						$EndTime = $TempEndDate[1];
						$EndTimeAmPm = $TempEndDate[2];
						
						// CAN REMOVE ONCE OLD ADMIN PANEL IS REMOVED
						$FormOptionText = NULL;
						$FormOptionText = FormOptionText($Text);
						
						// Add / Update Calendar Appointment Data
						$Content['StartDay'] = $StartDay;
						$Content['StartMonth'] = $StartMonth;
						$Content['StartYear'] = $StartYear;
						$Content['StartTime'] = $StartTime;
						$Content['StartTimeAmPm'] = $StartTimeAmPm;
						$Content['EndDay'] = $EndDay;
						$Content['EndMonth'] = $EndMonth;
						$Content['EndYear'] = $EndYear;
						$Content['StartTime'] = $StartTime;
						$Content['EndTime'] = $EndTime;
						$Content['EndTimeAmPm'] = $EndTimeAmPm;
						$Content['Appointment'] = $Text;
						$Content['Enable/Disable'] = $EnableDisable;
						$Content['Status'] = $Status;
						
						// WRITE DATABASE CONTENT TO FILE BEFORE NullCheck- Calendar Appointment Data
						$LogFile = "PostCalendarEvent.txt";
						$LogFileHandle = fopen($LogFile, 'a');
						$FileInformation = 'Logging - POST Content Pre NullCheck - Calendar Event Script Loading - ' . date("F j, Y, g:i a") . "\n";
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
						$FileInformation = 'Logging - POST FormSelect Pre NullCheck - Calendar Event Script Loading - ' . date("F j, Y, g:i a") . "\n";
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
						$FileInformation = 'Logging - POST FormOption Pre NullCheck - Calendar Event Script Loading - ' . date("F j, Y, g:i a") . "\n";
						fwrite($LogFileHandle, $FileInformation);
						fwrite($LogFileHandle, print_r($FormOption, TRUE));
						fwrite($LogFileHandle, "\n---------------------------------------------\n\n");
						fclose($LogFileHandle);
						
						// Assign all NULL values to be truely NULL
						$Content = $Tier6Databases->NullCheck ($Content);
						$FormSelect = $Tier6Databases->NullCheck ($FormSelect);
						$FormOption = $Tier6Databases->NullCheck ($FormOption);
						
						$Page->startElement('data');
							$Page->startElement('action');
								$Page->writeAttribute('type',$_POST['!nativeeditor_status']);
								$Page->writeAttribute('sid',$_POST['id']);
								if ($_POST['!nativeeditor_status'] === 'inserted') {
									CreateRecord($Page, $Tier6Databases, $Options, $FormSelect, $FormOption, $Content);
								}
								
								if ($_POST['!nativeeditor_status'] === 'updated') {
									UpdateRecord($Page, $Tier6Databases, $Options, $FormSelect, $FormOption, $Content, /*CAN REMOVE ONCE OLD ADMIN PANEL IS REMOVED */ $FormOptionText);
								}
								
								if ($_POST['!nativeeditor_status'] === 'deleted') {
									DeleteRecord($Page, $Tier6Databases, $Options, $Content);
								}
							$Page->fullEndElement(); // ENDS ACTION
						
						$Page->fullEndElement(); //ENDS DATA
						
						$PageOutput = $Page->flush();
						header('Content-type: text/xml');
						print $PageOutput;
					} else {
						header("HTTP/1.0 404 Not Found");
					}
				}
			} else if ($_SERVER['REQUEST_METHOD'] === 'GET') {
				if ($_SERVER['HTTP_X_REQUESTED_WITH'] === 'XMLHttpRequest') {
					$LogFile = "PostCalendarEvent.txt";
					$LogFileHandle = fopen($LogFile, 'a');
					$FileInformation = 'Logging - GET Calendar Event Script Loading - ' . date("F j, Y, g:i a") . "\n";
					fwrite($LogFileHandle, $FileInformation);
					fwrite($LogFileHandle, print_r($_GET, TRUE));
					fwrite($LogFileHandle, "\n---------------------------------------------\n\n");
					fclose($LogFileHandle);
					
					$Page = XMLDataOutput($Page, $Scheduler, $credentaillogonarray);
					
					$PageOutput = $Page->flush();
					header('Content-type: text/xml');
					print $PageOutput;
				} else {
					header("HTTP/1.0 404 Not Found");
				}
			} else {
				header("HTTP/1.0 404 Not Found");
			}
		//} else {
			//header("HTTP/1.0 404 Not Found");
		//}
	} else {
		header("HTTP/1.0 404 Not Found");
	}
?>