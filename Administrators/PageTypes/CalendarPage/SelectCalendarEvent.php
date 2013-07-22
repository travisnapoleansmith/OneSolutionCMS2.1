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

	$CalendarEvent = stripslashes($_POST['CalendarEvent']);
	$CalendarEvent = explode(' - ', $CalendarEvent);

	$Event = array();
	$Event['StartDate'] = $CalendarEvent[0];
	$Event['StartTime'] = $CalendarEvent[1];
	$Event['EndTime'] = $CalendarEvent[2];
	$Event['Event'] = $CalendarEvent[3];
	unset($CalendarEvent);

	$Date = NULL;
	$Date = date_parse($Event['StartDate']);

	$StartDay = NULL;
	if ($Date['day'] < 10) {
		$StartDay = 0 . $Date['day'];
	} else {
		$StartDay = $Date['day'];
	}

	$StartMonth = NULL;
	$StartMonth = date("F", mktime(0, 0, 0, $Date['month'], 10));

	$StartYear = NULL;
	if ($Date['year'] < 10) {
		$StartYear = 0 . $Date['year'];
	} else {
		$StartYear = $Date['year'];
	}

	$StartTime = NULL;
	$StartTimeAmPm = NULL;

	$StartTimeTemp = explode(' ', $Event['StartTime']);
	$StartTime = $StartTimeTemp[0];
	$StartTimeAmPm = $StartTimeTemp[1];
	unset($StartTimeTemp);

	$EndTime = NULL;
	$EndTimeAmPm = NULL;

	$EndTimeTemp = explode(' ', $Event['EndTime']);
	$EndTime = $EndTimeTemp[0];
	$EndTimeAmPm = $EndTimeTemp[1];
	unset($EndTimeTemp);

	$passarray = array();
	$passarray['PageID'] = $_POST['UpdateCalendarEvent'];
	$passarray['ObjectID'] = $_POST['CalendarEvent'];
	//$passarray['FormOptionText'] = $_POST['CalendarEvent'];

	$FormOptionSelected = $Tier6Databases->getRecord($passarray, 'AdministratorFormOption', TRUE, array('1' => 'PageID'), 'ASC');
	$PageID = array();
	$PageID['CalendarID'] = $FormOptionSelected[0]['ObjectID'];
	/*$PageID['Day'] = $StartDay;
	$PageID['Month'] = $StartMonth;
	$PageID['Year'] = $StartYear;
	$PageID['StartTime'] = $StartTime;
	$PageID['StartTimeAmPm'] = $StartTimeAmPm;
	$PageID['EndTime'] = $EndTime;
	$PageID['EndTimeAmPm'] = $EndTimeAmPm;
	*/
	$passarray = array();
	$passarray['PageID'] = $PageID;
	$passarray['DatabaseTableName'] = 'CalendarAppointments';

	$CalendarEvent = $Tier6Databases->ModulePass('XhtmlCalendarTable', 'calendar', 'getRecord', $passarray);

	$sessionname = $Tier6Databases->SessionStart('UpdateCalendarEvent');

	$Date = date_parse($CalendarEvent[0]['StartTime']);
	$StartHour = NULL;
	if ($Date['hour'] < 10) {
		$StartHour = 0 . $Date['hour'];
	} else {
		$StartHour = $Date['hour'];
	}

	$StartMinute = NULL;
	if ($Date['minute'] < 10) {
		$StartMinute = 0 . $Date['minute'];
	} else {
		$StartMinute = $Date['minute'];
	}

	$StartSecond = NULL;
	if ($Date['second'] < 10) {
		$StartSecond = 0 . $Date['second'];
	} else {
		$StartSecond = $Date['second'];
	}

	$Date = date_parse($CalendarEvent[0]['EndTime']);
	$EndHour = NULL;
	if ($Date['hour'] < 10) {
		$EndHour = 0 . $Date['hour'];
	} else {
		$EndHour = $Date['hour'];
	}

	$EndMinute = NULL;
	if ($Date['minute'] < 10) {
		$EndMinute = 0 . $Date['minute'];
	} else {
		$EndMinute = $Date['minute'];
	}

	$EndSecond = NULL;
	if ($Date['second'] < 10) {
		$EndSecond = 0 . $Date['second'];
	} else {
		$EndSecond = $Date['second'];
	}

	$_POST['FormOptionSelectedID'] = $FormOptionSelected[0]['ObjectID'];
	$_POST['EventDay'] = $CalendarEvent[0]['Day'];
	$_POST['EventMonth'] = $CalendarEvent[0]['Month'];
	$_POST['EventYear'] = $CalendarEvent[0]['Year'];
	$_POST['StartHour'] = $StartHour;
	$_POST['StartMinute'] = $StartMinute;
	$_POST['StartSecond'] = $StartSecond;
	$_POST['StartAMPM'] = $CalendarEvent[0]['StartTimeAmPm'];
	$_POST['StartTimezone'] = $CalendarEvent[0]['StartTimeZone'];
	$_POST['EndHour'] = $EndHour;
	$_POST['EndMinute'] = $EndMinute;
	$_POST['EndSecond'] = $EndSecond;
	$_POST['EndAMPM'] = $CalendarEvent[0]['EndTimeAmPm'];
	$_POST['EndTimezone'] = $CalendarEvent[0]['EndTimeZone'];
	$_POST['Event'] = $CalendarEvent[0]['Appointment'];
	$_POST['EnableDisable'] = $CalendarEvent[0]['Enable/Disable'];
	$_POST['Status'] = $CalendarEvent[0]['Status'];

	$_SESSION['POST']['FilteredInput']['FormOptionSelectedID'] = $_POST['FormOptionSelectedID'];
	$_SESSION['POST']['FilteredInput']['EventDay'] = $_POST['EventDay'];
	$_SESSION['POST']['FilteredInput']['EventMonth'] = $_POST['EventMonth'];
	$_SESSION['POST']['FilteredInput']['EventYear'] = $_POST['EventYear'];
	$_SESSION['POST']['FilteredInput']['StartHour'] = $_POST['StartHour'];
	$_SESSION['POST']['FilteredInput']['StartMinute'] = $_POST['StartMinute'];
	$_SESSION['POST']['FilteredInput']['StartSecond'] = $_POST['StartSecond'];
	$_SESSION['POST']['FilteredInput']['StartAMPM'] = $_POST['StartAMPM'];
	$_SESSION['POST']['FilteredInput']['StartTimezone'] = $_POST['StartTimezone'];
	$_SESSION['POST']['FilteredInput']['EndHour'] = $_POST['EndHour'];
	$_SESSION['POST']['FilteredInput']['EndMinute'] = $_POST['EndMinute'];
	$_SESSION['POST']['FilteredInput']['EndSecond'] = $_POST['EndSecond'];
	$_SESSION['POST']['FilteredInput']['EndAMPM'] = $_POST['EndAMPM'];
	$_SESSION['POST']['FilteredInput']['EndTimezone'] = $_POST['EndTimezone'];
	$_SESSION['POST']['FilteredInput']['Event'] = $_POST['Event'];
	$_SESSION['POST']['FilteredInput']['EnableDisable'] = $_POST['EnableDisable'];
	$_SESSION['POST']['FilteredInput']['Status'] = $_POST['Status'];

	$Options = $Tier6Databases->getLayerModuleSetting();
	$CalendarEventUpdatePage = $Options['XhtmlCalendarTable']['calendar']['CalendarEventUpdatePage']['SettingAttribute'];
	header("Location: $CalendarEventUpdatePage&SessionID=$sessionname");
?>