<?php
	$HOME = $_SERVER['SUBDOMAIN_DOCUMENT_ROOT'];
	$ADMINHOME = $HOME . '/Administrators/';
	$GLOBALS['HOME'] = $HOME;
	$GLOBALS['ADMINHOME'] = $ADMINHOME;
	
	require_once ("$ADMINHOME/Configuration/includes.php");
	
	$PageID = $_POST['CalendarEvent'];
	
	$passarray = array();
	$passarray['PageID'] = $_POST['DeleteCalendarEvent'];
	$passarray['ObjectID'] = $_POST['CalendarEvent'];
	
	$FormOptionSelected = $Tier6Databases->getRecord($passarray, 'AdministratorFormOption', TRUE, array('1' => 'PageID'), 'ASC');
	
	$Options = $Tier6Databases->getLayerModuleSetting();

	if (!is_null($PageID)) {
		$CalendarPageID = array();
		$CalendarPageID['CalendarID'] = $PageID;
		$CalendarPageID['TableName'] = 'CalendarAppointments';
		$CalendarPageID['Enable/Disable'] = 'Disable';

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