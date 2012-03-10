<?php
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
	
	$PageID = array();
	$PageID['Day'] = $StartDay;
	$PageID['Month'] = $StartMonth;
	$PageID['Year'] = $StartYear;
	$PageID['StartTime'] = $StartTime;
	$PageID['StartTimeAmPm'] = $StartTimeAmPm;
	$PageID['EndTime'] = $EndTime;
	$PageID['EndTimeAmPm'] = $EndTimeAmPm;
	
	$passarray = array();
	$passarray['PageID'] = $_POST['DeleteCalendarEvent'];
	$passarray['FormOptionText'] = $_POST['CalendarEvent'];
	
	$FormOptionSelected = $Tier6Databases->getRecord($passarray, 'AdministratorFormOption', TRUE, array('1' => 'PageID'), 'ASC');
	
	$Options = $Tier6Databases->getLayerModuleSetting();

	if (!is_null($PageID)) {
		$CalendarPageID = array();
		$CalendarPageID['PageID'] = $PageID;
		$CalendarPageID['TableName'] = 'CalendarAppointments';
		
		$Tier6Databases->ModulePass('XhtmlCalendarTable', 'calendar', 'deleteCalendarAppointment', $CalendarPageID);
		
		$CalendarEventUpdateSelectPage = $Options['XhtmlCalendarTable']['calendar']['CalendarEventUpdateSelectPage']['SettingAttribute'];
		$CalendarPageID = array();
		$CalendarPageID['PageID'] = $CalendarEventUpdateSelectPage;
		$CalendarPageID['ObjectID'] = $FormOptionSelected[0]['ObjectID'];
		
		$Tier6Databases->ModulePass('XhtmlForm', 'form', 'deleteFormOption', $CalendarPageID);
		$Tier6Databases->ModulePass('XhtmlForm', 'form', 'deleteFormSelect', $CalendarPageID);
		
		$CalendarEventDeletePage = $Options['XhtmlCalendarTable']['calendar']['CalendarEventDeletePage']['SettingAttribute'];
		header("Location: $CalendarEventDeletePage");
	} else {
		$CalendarEventDeleteSelectPage = $Options['XhtmlCalendarTable']['calendar']['CalendarEventDeleteSelectPage']['SettingAttribute'];
		header("Location: ../../index.php?PageID=$CalendarEventDeleteSelectPage");
	}
?>