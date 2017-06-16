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
	
	function XMLDataOutput($Page, $Scheduler, $credentaillogonarray) {
		$Page->startElement('data');
		if ($Scheduler != NULL) {
			$Tier2Databases = new DataAccessLayer();
			$Tier2Databases->setDatabaseAll ($credentaillogonarray[0], $credentaillogonarray[1], $credentaillogonarray[2], $credentaillogonarray[3], NULL);
			$Tier2Databases->buildModules('DataAccessLayerModules', 'DataAccessLayerTables', 'DataAccessLayerModulesSettings');
		
			$Tier2Databases->createDatabaseTable($Scheduler);
			$Tier2Databases->Connect($Scheduler);
			$Tier2Databases->pass ($Scheduler, "setEntireTable", array());
			$EventListings= $Tier2Databases->pass ($Scheduler, "getEntireTable", array());
			$Tier2Databases->Disconnect($Scheduler);
			
			if (is_array($EventListings)) {
				foreach ($EventListings as $Key => $Data) {
					$StartDate = $Data['StartMonth'] . '-' . $Data['StartDay'] . '-' . $Data['StartYear'] . ' ' . $Data['StartTime'] . ' ' . $Data['StartTimeAmPm'];
					
					$EndDate = $Data['EndMonth'] . '-' . $Data['EndDay'] . '-' . $Data['EndYear'] . ' ' . $Data['EndTime'] . ' ' . $Data['EndTimeAmPm'];
					
					$CalendarID = $Data['CalendarID'];
					$Text = $Data['Appointment'];
					
					$EnableDisable = $Data['Enable/Disable'];
					$Status = $Data['Status'];
					
					$Page->startElement('event');
					$Page->writeAttribute('id', $CalendarID);
						$Page->startElement('text');
						$Page->writeraw('<![CDATA[' . $Text . ']]>');
						$Page->endElement(); // ENDS TEXT
	
						$Page->startElement('start_date');
						$Page->text($StartDate);
						$Page->endElement(); // ENDS START_DATE
		
						$Page->startElement('end_date');
						$Page->text($EndDate);
						$Page->endElement(); // ENDS END_DATE
						
						$Page->startElement('EnableDisable');
						$Page->text($EnableDisable);
						$Page->endElement(); // ENDS EnableDisable
						
						$Page->startElement('Status');
						$Page->text($Status);
						$Page->endElement(); // ENDS Status
						
						if ($EnableDisable  == 'Disable') {
							$Page->startElement('color');
							if (isset($SchedulerConfiguration['Colors']['DisableBackgroundColor']) === TRUE) {
								$Page->text($SchedulerConfiguration['Colors']['DisableBackgroundColor']);
							} else {
								$Page->text('grey');
							}
							$Page->endElement(); // ENDS color
							
							$Page->startElement('textColor');
							if (isset($SchedulerConfiguration['Colors']['DisableTextColor']) === TRUE) {
								$Page->text($SchedulerConfiguration['Colors']['DisableTextColor']);
							} else {
								$Page->text('white');
							}
							$Page->endElement(); // ENDS color
						}
						
						if ($EnableDisable  == 'Enable') {
							$Page->startElement('color');
							if (isset($SchedulerConfiguration['Colors']['EnableBackgroundColor']) === TRUE) {
								$Page->text($SchedulerConfiguration['Colors']['EnableBackgroundColor']);
							} else {
								$Page->text('red');
							}
							$Page->endElement(); // ENDS color
							
							$Page->startElement('textColor');
							if (isset($SchedulerConfiguration['Colors']['EnableTextColor']) === TRUE) {
								$Page->text($SchedulerConfiguration['Colors']['EnableTextColor']);
							} else {
								$Page->text('white');
							}
							$Page->endElement(); // ENDS color
						}
					$Page->endElement(); // ENDS ITEM
				}
			}
		
		}
		
		$Page->fullEndElement(); //ENDS DATA
		return $Page;
	}
	
	function CreateRecord($Page, $Tier6Databases, $Options, $FormSelect, $FormOption, $Content) {
		// CHECK TO MAKE SURE ALL VARIABLES PASSED HAVE A VALUE ASSIGNED TO THEM.
		if (isset($Content['TableName']) === FALSE) {
			return FALSE;
		}
		
		$LastID = $Options['XhtmlCalendarTable']['calendar']['LastEvent']['SettingAttribute'];
		$NewID = ++$LastID;
		$Tier6Databases->updateModuleSetting('XhtmlCalendarTable', 'calendar', 'LastEvent', $NewID);
		
		// Add Calendar Appointment Data
		$Content['CalendarID'] = $NewID;
		
		// WRITE DATABASE CONTENT TO FILE - Calendar Appointment Data
		$LogFile = "PostCalendarEvent.txt";
		$LogFileHandle = fopen($LogFile, 'a');
		$FileInformation = 'Logging - POST INSERTED Content - Calendar Event Script Loading - ' . date("F j, Y, g:i a") . "\n";
		fwrite($LogFileHandle, $FileInformation);
		fwrite($LogFileHandle, print_r($Content, TRUE));
		fwrite($LogFileHandle, "\n---------------------------------------------\n\n");
		fclose($LogFileHandle);
		
		// CAN REMOVE ONCE OLD ADMIN PANEL IS REMOVED
		// FormSelect Data
		$FormSelect['ObjectID'] = $NewID;
		$FormSelect['ContainerObjectID'] = $NewID;
		
		// CAN REMOVE ONCE OLD ADMIN PANEL IS REMOVED
		// WRITE DATABASE FORM SELECT TO FILE
		$LogFile = "PostCalendarEvent.txt";
		$LogFileHandle = fopen($LogFile, 'a');
		$FileInformation = 'Logging - POST INSERTED FormSelect - Calendar Event Script Loading - ' . date("F j, Y, g:i a") . "\n";
		fwrite($LogFileHandle, $FileInformation);
		fwrite($LogFileHandle, print_r($FormSelect, TRUE));
		fwrite($LogFileHandle, "\n---------------------------------------------\n\n");
		fclose($LogFileHandle);
		
		// CAN REMOVE ONCE OLD ADMIN PANEL IS REMOVED
		// FormOptions Data
		$FormOption['ObjectID'] = $NewID;
		$FormOption['FormOptionValue'] = $NewID;
		
		// CAN REMOVE ONCE OLD ADMIN PANEL IS REMOVED
		// WRITE DATABASE FORM OPTION TO FILE
		$LogFile = "PostCalendarEvent.txt";
		$LogFileHandle = fopen($LogFile, 'a');
		$FileInformation = 'Logging - POST INSERTED FormOption - Calendar Event Script Loading - ' . date("F j, Y, g:i a") . "\n";
		fwrite($LogFileHandle, $FileInformation);
		fwrite($LogFileHandle, print_r($FormOption, TRUE));
		fwrite($LogFileHandle, "\n---------------------------------------------\n\n");
		fclose($LogFileHandle);
		
		// Changes Current ID to New Page ID. This is for DHTMLXSchedulers ID's to match up with the database.
		$Page->writeAttribute('tid', $NewID);
		
		// INSERT NEW DATABASE RECORD
		$Tier6Databases->ModulePass('XhtmlCalendarTable', 'calendar', 'createCalendarAppointment', $Content);
		
		// CAN REMOVE ONCE OLD ADMIN PANEL IS REMOVED
		// INSERT FORM SELECT
		$Tier6Databases->ModulePass('XhtmlForm', 'form', 'createFormOption', $FormOption);
		$Tier6Databases->ModulePass('XhtmlForm', 'form', 'createFormSelect', $FormSelect);
		
		// CAN REMOVE ONCE OLD ADMIN PANEL IS REMOVED
		// CHANGED FORM SELECT FOR DELETED SELECT PAGE
		$DeleteSelectPage = $Options['XhtmlCalendarTable']['calendar']['CalendarEventDeleteSelectPage']['SettingAttribute'];
		$FormSelect['PageID'] = $DeleteSelectPage;
		$FormOption['PageID'] = $DeleteSelectPage;
		
		// CAN REMOVE ONCE OLD ADMIN PANEL IS REMOVED
		// WRITE DATABASE FORM SELECT TO FILE FOR DELETED SELECT PAGE
		$LogFile = "PostCalendarEvent.txt";
		$LogFileHandle = fopen($LogFile, 'a');
		$FileInformation = 'Logging - POST INSERTED FormSelect Deleted Select Page - Calendar Event Script Loading - ' . date("F j, Y, g:i a") . "\n";
		fwrite($LogFileHandle, $FileInformation);
		fwrite($LogFileHandle, print_r($FormSelect, TRUE));
		fwrite($LogFileHandle, "\n---------------------------------------------\n\n");
		fclose($LogFileHandle);
		
		// CAN REMOVE ONCE OLD ADMIN PANEL IS REMOVED
		// WRITE DATABASE FORM OPTION TO FILE FOR DELETED SELECT PAGE
		$LogFile = "PostCalendarEvent.txt";
		$LogFileHandle = fopen($LogFile, 'a');
		$FileInformation = 'Logging - POST INSERTED FormOption Deleted Select Page - Calendar Event Script Loading - ' . date("F j, Y, g:i a") . "\n";
		fwrite($LogFileHandle, $FileInformation);
		fwrite($LogFileHandle, print_r($FormOption, TRUE));
		fwrite($LogFileHandle, "\n---------------------------------------------\n\n");
		fclose($LogFileHandle);
		
		// CAN REMOVE ONCE OLD ADMIN PANEL IS REMOVED
		// INSERT DATABASE FORM FOR DELETED SELECT PAGE
		$Tier6Databases->ModulePass('XhtmlForm', 'form', 'createFormOption', $FormOption);
		$Tier6Databases->ModulePass('XhtmlForm', 'form', 'createFormSelect', $FormSelect);
		
		// CAN REMOVE ONCE OLD ADMIN PANEL IS REMOVED
		// CHANGED FORM SELECT FOR ENABLEDISABLE SELECT PAGE
		$EnableDisableSelectPage = $Options['XhtmlCalendarTable']['calendar']['CalendarEventEnableDisableSelectPage']['SettingAttribute'];
		$FormSelect['PageID'] = $EnableDisableSelectPage;
		$FormOption['PageID'] = $EnableDisableSelectPage;
		
		$FormOption['Enable/Disable'] = 'Enable';
		$FormOption['Status'] = 'Approved';
		
		// CAN REMOVE ONCE OLD ADMIN PANEL IS REMOVED
		// WRITE DATABASE FORM SELECT TO FILE FOR ENABLEDISABLE SELECT PAGE
		$LogFile = "PostCalendarEvent.txt";
		$LogFileHandle = fopen($LogFile, 'a');
		$FileInformation = 'Logging - POST INSERTED FormSelect Enable Disable Select Page - Calendar Event Script Loading - ' . date("F j, Y, g:i a") . "\n";
		fwrite($LogFileHandle, $FileInformation);
		fwrite($LogFileHandle, print_r($FormSelect, TRUE));
		fwrite($LogFileHandle, "\n---------------------------------------------\n\n");
		fclose($LogFileHandle);
		
		// CAN REMOVE ONCE OLD ADMIN PANEL IS REMOVED
		// WRITE DATABASE FORM OPTION TO FILE FOR ENABLEDISABLE SELECT PAGE
		$LogFile = "PostCalendarEvent.txt";
		$LogFileHandle = fopen($LogFile, 'a');
		$FileInformation = 'Logging - POST INSERTED FormOption Enable Disable Select Page - Calendar Event Script Loading - ' . date("F j, Y, g:i a") . "\n";
		fwrite($LogFileHandle, $FileInformation);
		fwrite($LogFileHandle, print_r($FormOption, TRUE));
		fwrite($LogFileHandle, "\n---------------------------------------------\n\n");
		fclose($LogFileHandle);
		
		$Tier6Databases->ModulePass('XhtmlForm', 'form', 'createFormOption', $FormOption);
		$Tier6Databases->ModulePass('XhtmlForm', 'form', 'createFormSelect', $FormSelect);
		
		return TRUE;
	}
	
	function UpdateRecord($Page, $Tier6Databases, $Options, $FormSelect, $FormOption, $Content, /*CAN REMOVE ONCE OLD ADMIN PANEL IS REMOVED */ $FormOptionText) {
		// CHECK TO MAKE SURE ALL VARIABLES PASSED HAVE A VALUE ASSIGNED TO THEM.
		
		if (!isset($_POST['id'])) {
			throw new Exception('ID number is not being sent!');
		}
		
		$ID = $_POST['id'];
		
		// Make Sure ID is Valid before updateing the record
		$passarray = array();
		$passarray['PageID']['CalendarID'] = $ID;
		$passarray['DatabaseTableName'] = 'CalendarAppointments';
		
		$ValidationContent = $Tier6Databases->ModulePass('XhtmlCalendarTable', 'calendar', 'getRecord', $passarray);
		
		if (isset($ValidationContent)) {
			if (!is_array($ValidationContent)) {
				throw new Exception('ID number is an invalid ID number - returned a non-array item!');
			}
		} else {
			throw new Exception('ID number is an invalid ID number! - ID:' . $ID);
		}
		
		// Update Calendar Appointment Data
		$Content['CalendarID'] = $ID;
		
		// WRITE DATABASE CONTENT TO FILE - Calendar Appointment Data
		$LogFile = "PostCalendarEvent.txt";
		$LogFileHandle = fopen($LogFile, 'a');
		$FileInformation = 'Logging - POST UPDATED Content - Calendar Event Script Loading - ' . date("F j, Y, g:i a") . "\n";
		fwrite($LogFileHandle, $FileInformation);
		fwrite($LogFileHandle, print_r($Content, TRUE));
		fwrite($LogFileHandle, "\n---------------------------------------------\n\n");
		fclose($LogFileHandle);
		
		// CAN REMOVE ONCE OLD ADMIN PANEL IS REMOVED
		// FormSelect Data
		unset($FormSelect);
		
		// CAN REMOVE ONCE OLD ADMIN PANEL IS REMOVED
		// FormOptions Data
		$FormOption = array();
		$FormOption['FormOptionText'] = $FormOptionText;
		
		// CAN REMOVE ONCE OLD ADMIN PANEL IS REMOVED
		// WRITE DATABASE FORM OPTION TO FILE
		$LogFile = "PostCalendarEvent.txt";
		$LogFileHandle = fopen($LogFile, 'a');
		$FileInformation = 'Logging - POST UPDATED FormOption Deleted Select Page - Calendar Event Script Loading - ' . date("F j, Y, g:i a") . "\n";
		fwrite($LogFileHandle, $FileInformation);
		fwrite($LogFileHandle, print_r($FormOption, TRUE));
		fwrite($LogFileHandle, "\n---------------------------------------------\n\n");
		fclose($LogFileHandle);
		
		$Page->writeAttribute('tid', $ID);
		$Page->writeAttribute('color', 'pink');
		
		// UPDATE DATABASE RECORD
		$Tier6Databases->ModulePass('XhtmlCalendarTable', 'calendar', 'updateCalendarAppointment', $Content);
		
		$UpdateSelectPage = $Options['XhtmlCalendarTable']['calendar']['CalendarEventUpdateSelectPage']['SettingAttribute'];
		$Tier6Databases->ModulePass('XhtmlForm', 'form', 'updateFormOption', array('PageID' => array('PageID' => $UpdateSelectPage, 'ObjectID' => $ID), 'Content' => $FormOption));
							
		$DeleteSelectPage = $Options['XhtmlCalendarTable']['calendar']['CalendarEventDeleteSelectPage']['SettingAttribute'];
		$Tier6Databases->ModulePass('XhtmlForm', 'form', 'updateFormOption', array('PageID' => array('PageID' => $DeleteSelectPage, 'ObjectID' => $ID), 'Content' => $FormOption));
							
		$EnableDisableSelectPage = $Options['XhtmlCalendarTable']['calendar']['CalendarEventEnableDisableSelectPage']['SettingAttribute'];
		$Tier6Databases->ModulePass('XhtmlForm', 'form', 'updateFormOption', array('PageID' => array('PageID' => $EnableDisableSelectPage, 'ObjectID' => $ID), 'Content' => $FormOption));
		return TRUE;
	}
	
	function DeleteRecord($Page, $Tier6Databases, $Options, $Content) {
		// CHECK TO MAKE SURE ALL VARIABLES PASSED HAVE A VALUE ASSIGNED TO THEM.
		
		if (!isset($_POST['id'])) {
			throw new Exception('ID number is not being sent!');
		}
		
		$ID = $_POST['id'];
		$ContentPageID = array();
		$ContentPageID['CalendarID'] = $ID;
		$ContentPageID['TableName'] = 'CalendarAppointments';
		$ContentPageID['Enable/Disable'] = 'Disable';
							
		$Tier6Databases->ModulePass('XhtmlCalendarTable', 'calendar', 'deleteCalendarAppointment', $ContentPageID);
							
		$UpdateSelectPage = $Options['XhtmlCalendarTable']['calendar']['CalendarEventUpdateSelectPage']['SettingAttribute'];
		$ContentPageID = array();
		$ContentPageID['PageID'] = $UpdateSelectPage;
		$ContentPageID['ObjectID'] = $ID;
							
		$Tier6Databases->ModulePass('XhtmlForm', 'form', 'deleteFormOption', $ContentPageID);
		$Tier6Databases->ModulePass('XhtmlForm', 'form', 'deleteFormSelect', $ContentPageID);
		
		$Page->writeAttribute('tid',$ID);
	}
	
	// CAN REMOVE ONCE OLD ADMIN PANEL IS REMOVED
	function FormOptionText($Text) {
		$StartDate = $_POST['start_date'];
		$EndDate = $_POST['end_date'];
		
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
		
		$FormOptionText = NULL;
		$Date = date_parse($StartMonth);
		if ($Date['month'] < 10) {
			$FormOptionText .= 0 . $Date['month'];
		} else {
			$FormOptionText .= $Date['month'];
		}
		$FormOptionText .= '/';
		$FormOptionText .= $StartDay;
		$FormOptionText .= '/';
		$FormOptionText .= $StartYear;
		$FormOptionText .= ' ';
		$FormOptionText .= $StartTime;
		$FormOptionText .= ' ';
		$FormOptionText .= $StartTimeAmPm;
		$FormOptionText .= ' - ';
		$Date = date_parse($EndMonth);
		if ($Date['month'] < 10) {
			$FormOptionText .= 0 . $Date['month'];
		} else {
			$FormOptionText .= $Date['month'];
		}
		$FormOptionText .= '/';
		$FormOptionText .= $EndDay;
		$FormOptionText .= '/';
		$FormOptionText .= $EndYear;
		$FormOptionText .= ' ';
		$FormOptionText .= $EndTime;
		$FormOptionText .= ' ';
		$FormOptionText .= $EndTimeAmPm;
		$FormOptionText .= ' - ';
		$temp = $Text;
		$temp = explode(' ', $temp);

		for ($i = 0; $i < 5; $i++) {
			$FormOptionText .= $temp[$i];
			$FormOptionText .= ' ';
		}
		unset($temp);
		
		return $FormOptionText;
	}
?>