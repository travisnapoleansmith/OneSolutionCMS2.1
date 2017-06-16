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
	
	set_time_limit(120);
	
	$ReferPage = $_SERVER['HTTP_REFERER'];
	$ReferPageIDArray = explode('?', $ReferPage);
	unset($ReferPageIDArray[0]);
	$ReferPageIDArray = implode('', $ReferPageIDArray);
	$ReferPageIDArray = explode('&', $ReferPageIDArray);
	$Key = array_search('PageID', $ReferPageIDArray);
	$ReferPageID = $ReferPageIDArray[$Key];
	
	if ($ReferPageID === 'PageID=120') {
		$LogPage = FALSE;
		
		if ($LogPage === TRUE) {
			$LogFile = "AddCalendarEvent.txt";
			$LogFileHandle = fopen($LogFile, 'a');
			$FileInformation = 'Logging - Add Calendar Event Script Loading - ' . date("F j, Y, g:i a") . "\n";
			fwrite($LogFileHandle, $FileInformation);
			fwrite($LogFileHandle, print_r($_SERVER['HTTP_REFERER'], TRUE));
			fwrite($LogFileHandle, "\n---------------------------------------------\n\n");
			fclose($LogFileHandle);
		}
		
		if ($_SERVER['SUBDOMAIN_DOCUMENT_ROOT'] != NULL) {
			$HOME = $_SERVER['SUBDOMAIN_DOCUMENT_ROOT'];
		} else {
			if ($_SERVER['REAL_DOCUMENT_ROOT'] != NULL) {
				$_SERVER['SUBDOMAIN_DOCUMENT_ROOT'] = $_SERVER['REAL_DOCUMENT_ROOT'];
				$HOME = $_SERVER['SUBDOMAIN_DOCUMENT_ROOT'];
			} else {
				$HOME = NULL;
			}
		}
		
		$HOME = $_SERVER['SUBDOMAIN_DOCUMENT_ROOT'];
		$ADMINHOME = $HOME . '/Administrators/';
		$GLOBALS['HOME'] = $HOME;
		$GLOBALS['ADMINHOME'] = $ADMINHOME;
	
		require_once ("$ADMINHOME/Configuration/includes.php");
		$PageName = "../../index.php?PageID=";
		$PageName .= $_POST['AddCalendarEvent'];
		$hold = $Tier6Databases->FormSubmitValidate('AddCalendarEvent', $PageName);
	
		if ($hold) {
			$Options = $Tier6Databases->getLayerModuleSetting();
			$LastPageID = $Options['XhtmlCalendarTable']['calendar']['LastEvent']['SettingAttribute'];
			$NewPageID = ++$LastPageID;
			$Tier6Databases->updateModuleSetting('XhtmlCalendarTable', 'calendar', 'LastEvent', $NewPageID);
			
			if ($LogPage === TRUE) {
				$LogFile = "AddCalendarEvent.txt";
				$LogFileHandle = fopen($LogFile, 'a');
				$FileInformation = 'Logging - Add Calendar Event Top Script - ' . $NewPageID . ' - ' . date("F j, Y, g:i a") . "\n";
				fwrite($LogFileHandle, $FileInformation);
				//fwrite($LogFileHandle, print_r($ImageContent, TRUE));
				fwrite($LogFileHandle, "\n---------------------------------------------\n\n");
				fclose($LogFileHandle);
			}
			
			$StartTime = NULL;
			$EndTime = NULL;
	
			if ($hold['FilteredInput']['StartHour'] < 10) {
				$temp = $hold['FilteredInput']['StartHour'];
				$hold['FilteredInput']['StartHour'] = 0 . $temp;
			}
	
			if ($hold['FilteredInput']['EndHour'] < 10) {
				$temp = $hold['FilteredInput']['EndHour'];
				$hold['FilteredInput']['EndHour'] = 0 . $temp;
			}
	
			$StartTime = $hold['FilteredInput']['StartHour'] . ':' . $hold['FilteredInput']['StartMinute'] . ':' . $hold['FilteredInput']['StartSecond'];
			$EndTime = $hold['FilteredInput']['EndHour'] . ':' . $hold['FilteredInput']['EndMinute'] . ':' . $hold['FilteredInput']['EndSecond'];
			
			// NEED TO UPDATE DATABASE TO INCLUDE AN END DATE
			$CalendarAppointment = array();
			$CalendarAppointment['TableName'] = 'CalendarAppointments';
			$CalendarAppointment['CalendarID'] = $NewPageID;
			$CalendarAppointment['StartDay'] = $hold['FilteredInput']['StartDay'];
			$CalendarAppointment['StartMonth'] = $hold['FilteredInput']['StartMonth'];
			$CalendarAppointment['StartYear'] = $hold['FilteredInput']['StartYear'];
			$CalendarAppointment['StartTime'] = $StartTime;
			$CalendarAppointment['StartTimeAmPm'] = $hold['FilteredInput']['StartAMPM'];
			$CalendarAppointment['StartTimeZone'] = $hold['FilteredInput']['StartTimezone'];
			$CalendarAppointment['EndDay'] = $hold['FilteredInput']['EndDay'];
			$CalendarAppointment['EndMonth'] = $hold['FilteredInput']['EndMonth'];
			$CalendarAppointment['EndYear'] = $hold['FilteredInput']['EndYear'];
			$CalendarAppointment['EndTime'] = $EndTime;
			$CalendarAppointment['EndTimeAmPm'] = $hold['FilteredInput']['EndAMPM'];
			$CalendarAppointment['EndTimeZone'] = $hold['FilteredInput']['EndTimezone'];
			$CalendarAppointment['Appointment'] = $hold['FilteredInput']['Event'];
			$CalendarAppointment['AppointmentAbbr'] = NULL;
			$CalendarAppointment['AppointmentAlign'] = 'left';
			$CalendarAppointment['AppointmentAxis'] = NULL;
			$CalendarAppointment['AppointmentChar'] = NULL;
			$CalendarAppointment['AppointmentCharoff'] = NULL;
			$CalendarAppointment['AppointmentColSpan'] = NULL;
			$CalendarAppointment['AppointmentHeaders'] = NULL;
			$CalendarAppointment['AppointmentRowSpan'] = NULL;
			$CalendarAppointment['AppointmentScope'] = NULL;
			$CalendarAppointment['AppointmentValign'] = NULL;
			$CalendarAppointment['AppointmentClass'] = NULL;
			$CalendarAppointment['AppointmentDir'] = 'ltr';
			$CalendarAppointment['AppointmentID'] = NULL;
			$CalendarAppointment['AppointmentLang'] = 'en-us';
			$CalendarAppointment['AppointmentStyle'] = NULL;
			$CalendarAppointment['AppointmentTitle'] = NULL;
			$CalendarAppointment['AppointmentXMLLang'] = 'en-us';
			$CalendarAppointment['Enable/Disable'] = $hold['FilteredInput']['EnableDisable'];
			$CalendarAppointment['Status'] = $hold['FilteredInput']['Status'];
	
			$CalendarEventUpdateSelectPage = $Options['XhtmlCalendarTable']['calendar']['CalendarEventUpdateSelectPage']['SettingAttribute'];
			$FormSelect = array();
			$FormSelect['PageID'] = $CalendarEventUpdateSelectPage;
			$FormSelect['ObjectID'] = $NewPageID;
			$FormSelect['StopObjectID'] = NULL;
			$FormSelect['ContinueObjectID'] = NULL;
			$FormSelect['ContainerObjectType'] = 'Option';
			$FormSelect['ContainerObjectTypeName'] = 'AdministratorFormOption';
			$FormSelect['ContainerObjectID'] = $NewPageID;
			$FormSelect['FormSelectDisabled'] = NULL;
			$FormSelect['FormSelectMultiple'] = NULL;
			$FormSelect['FormSelectName'] = 'CalendarEvent';
			$FormSelect['FormSelectNameDynamic'] = NULL;
			$FormSelect['FormSelectNameTableName'] = NULL;
			$FormSelect['FormSelectNameField'] = NULL;
			$FormSelect['FormSelectNamePageID'] = NULL;
			$FormSelect['FormSelectNameObjectID'] = NULL;
			$FormSelect['FormSelectNameRevisionID'] = NULL;
			$FormSelect['FormSelectSize'] = NULL;
			$FormSelect['FormSelectClass'] = 'ShortForm';
			$FormSelect['FormSelectDir'] = 'ltr';
			$FormSelect['FormSelectID'] = NULL;
			$FormSelect['FormSelectLang'] = 'en-us';
			$FormSelect['FormSelectStyle'] = 'width: 550px;';
			$FormSelect['FormSelectTabIndex'] = NULL;
			$FormSelect['FormSelectTitle'] = NULL;
			$FormSelect['FormSelectXMLLang'] = 'en-us';
			$FormSelect['Enable/Disable'] = 'Enable';
			$FormSelect['Status'] = 'Approved';
	
			//$FormOptionValue = $NewPageID . ' - NULL';
			$Date = date_parse($_POST['StartMonth']);
			if ($Date['month'] < 10) {
				$FormOptionText .= 0 . $Date['month'];
			} else {
				$FormOptionText .= $Date['month'];
			}
			$FormOptionText .= '/';
			if ($_POST['StartDay'] < 10) {
				$FormOptionText .= 0 . $_POST['StartDay'];
			} else {
				$FormOptionText .= $_POST['StartDay'];
			}
			$FormOptionText .= '/';
			$FormOptionText .= $_POST['StartYear'];
			$FormOptionText .= ' ';
			$FormOptionText .= $StartTime;
			$FormOptionText .= ' ';
			$FormOptionText .= $_POST['StartAMPM'];
			$FormOptionText .= ' - ';
			
			$Date = date_parse($_POST['EndMonth']);
			if ($Date['month'] < 10) {
				$FormOptionText .= 0 . $Date['month'];
			} else {
				$FormOptionText .= $Date['month'];
			}
			$FormOptionText .= '/';
			if ($_POST['EndDay'] < 10) {
				$FormOptionText .= 0 . $_POST['EndDay'];
			} else {
				$FormOptionText .= $_POST['EndDay'];
			}
			$FormOptionText .= '/';
			$FormOptionText .= $_POST['EndYear'];
			$FormOptionText .= ' ';
			$FormOptionText .= $EndTime;
			$FormOptionText .= ' ';
			$FormOptionText .= $_POST['EndAMPM'];
			$FormOptionText .= ' - ';
	
			$temp = $hold['FilteredInput']['Event'];
			$temp = explode(' ', $temp);
	
			for ($i = 0; $i < 5; $i++) {
				$FormOptionText .= $temp[$i];
				$FormOptionText .= ' ';
			}
	
			unset($temp);
	
			$FormOption = array();
			$FormOption['PageID'] = $CalendarEventUpdateSelectPage;
			$FormOption['ObjectID'] = $NewPageID;
			$FormOption['FormOptionText'] = $FormOptionText;
			$FormOption['FormOptionTextDynamic'] = 'false';
			$FormOption['FormOptionTextTableName'] = NULL;
			$FormOption['FormOptionTextField'] = NULL;
			$FormOption['FormOptionTextPageID'] = NULL;
			$FormOption['FormOptionTextObjectID'] = NULL;
			$FormOption['FormOptionTextRevisionID'] = NULL;
			$FormOption['FormOptionDisabled'] = NULL;
			$FormOption['FormOptionLabel'] = NULL;
			$FormOption['FormOptionLabelDynamic'] = NULL;
			$FormOption['FormOptionLabelTableName'] = NULL;
			$FormOption['FormOptionLabelField'] = NULL;
			$FormOption['FormOptionLabelPageID'] = NULL;
			$FormOption['FormOptionLabelObjectID'] = NULL;
			$FormOption['FormOptionLabelRevisionID'] = NULL;
			$FormOption['FormOptionSelected'] = NULL;
			$FormOption['FormOptionValue'] = $NewPageID;
			$FormOption['FormOptionValueDynamic'] = NULL;
			$FormOption['FormOptionValueTableName'] = NULL;
			$FormOption['FormOptionValueField'] = NULL;
			$FormOption['FormOptionValuePageID'] = NULL;
			$FormOption['FormOptionValueObjectID'] = NULL;
			$FormOption['FormOptionValueRevisionID'] = NULL;
			$FormOption['FormOptionClass'] = NULL;
			$FormOption['FormOptionDir'] = 'ltr';
			$FormOption['FormOptionID'] = NULL;
			$FormOption['FormOptionLang'] = 'en-us';
			$FormOption['FormOptionStyle'] = NULL;
			$FormOption['FormOptionTitle'] = NULL;
			$FormOption['FormOptionXMLLang'] = 'en-us';
			$FormOption['Enable/Disable'] = 'Enable';
			$FormOption['Status'] = 'Approved';
	
	
			$Tier6Databases->ModulePass('XhtmlCalendarTable', 'calendar', 'createCalendarAppointment', $CalendarAppointment);
			$Tier6Databases->ModulePass('XhtmlForm', 'form', 'createFormOption', $FormOption);
			$Tier6Databases->ModulePass('XhtmlForm', 'form', 'createFormSelect', $FormSelect);
	
			$CalendarEventDeleteSelectPage = $Options['XhtmlCalendarTable']['calendar']['CalendarEventDeleteSelectPage']['SettingAttribute'];
			$FormSelect['PageID'] = $CalendarEventDeleteSelectPage;
			$FormOption['PageID'] = $CalendarEventDeleteSelectPage;
	
			$Tier6Databases->ModulePass('XhtmlForm', 'form', 'createFormOption', $FormOption);
			$Tier6Databases->ModulePass('XhtmlForm', 'form', 'createFormSelect', $FormSelect);
	
			$CalendarEventEnableDisableSelectPage = $Options['XhtmlCalendarTable']['calendar']['CalendarEventEnableDisableSelectPage']['SettingAttribute'];
			$FormSelect['PageID'] = $CalendarEventEnableDisableSelectPage;
			$FormOption['PageID'] = $CalendarEventEnableDisableSelectPage;
			$FormSelect['StopObjectID'] = 9999;
			$Tier6Databases->ModulePass('XhtmlForm', 'form', 'createFormOption', $FormOption);
			$Tier6Databases->ModulePass('XhtmlForm', 'form', 'createFormSelect', $FormSelect);
	
			$CalendarEventCreatedPage = $Options['XhtmlCalendarTable']['calendar']['CalendarEventCreatedPage']['SettingAttribute'];
			
			if ($LogPage === TRUE) {
				$LogFile = "AddCalendarEvent.txt";
				$LogFileHandle = fopen($LogFile, 'a');
				$FileInformation = 'Logging - Add Calendar Event Bottom Script - ' . $NewPageID . ' - ' . date("F j, Y, g:i a") . "\n";
				fwrite($LogFileHandle, $FileInformation);
				fwrite($LogFileHandle, print_r($CalendarEventCreatedPage, TRUE));
				fwrite($LogFileHandle, "\n---------------------------------------------\n\n");
				fclose($LogFileHandle);
			}
			
			header("Location: $CalendarEventCreatedPage");
			exit;
		}
	} else {
		header("Location: ../../index.php");
		exit;
	}
?>