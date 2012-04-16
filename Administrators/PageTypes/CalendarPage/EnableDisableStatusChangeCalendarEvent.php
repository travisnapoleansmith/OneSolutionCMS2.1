<?php
	$HOME = $_SERVER['SUBDOMAIN_DOCUMENT_ROOT'];
	$ADMINHOME = $HOME . '/Administrators/';
	$GLOBALS['HOME'] = $HOME;
	$GLOBALS['ADMINHOME'] = $ADMINHOME;
	
	require_once ("$ADMINHOME/Configuration/includes.php");
	
	$PageID = $_POST['CalendarEvent'];
	
	$passarray = array();
	$passarray['PageID'] = $_POST['EnableDisableCalendarEvent'];
	$passarray['ObjectID'] = $_POST['CalendarEvent'];
	
	$FormOptionSelected = $Tier6Databases->getRecord($passarray, 'AdministratorFormOption', TRUE, array('1' => 'PageID'), 'ASC');
	
	$Options = $Tier6Databases->getLayerModuleSetting();

	if (!is_null($PageID)) {
		$CalendarPageID = array();
		$CalendarPageID['CalendarID'] = $PageID;
		$CalendarPageID['TableName'] = 'CalendarAppointments';
		$CalendarPageID['Enable/Disable'] = $_POST['EnableDisable'];
		$CalendarPageID['Status'] = $_POST['Status'];
		
		$Tier6Databases->ModulePass('XhtmlCalendarTable', 'calendar', 'updateCalendarAppointmentStatus', $CalendarPageID);
		
		$CalendarEventUpdateSelectPage = $Options['XhtmlCalendarTable']['calendar']['CalendarEventUpdateSelectPage']['SettingAttribute'];
		$CalendarPageID = array();
		$CalendarPageID['PageID'] = $CalendarEventUpdateSelectPage;
		$CalendarPageID['ObjectID'] = $FormOptionSelected[0]['ObjectID'];
		$CalendarPageID['EnableDisable'] = $_POST['EnableDisable'];
		$CalendarPageID['Status'] = $_POST['Status'];
		
		$Tier6Databases->ModulePass('XhtmlForm', 'form', 'updateFormOptionStatus', $CalendarPageID);
		$Tier6Databases->ModulePass('XhtmlForm', 'form', 'updateFormSelectStatus', $CalendarPageID);
		
		$CalendarEventEnableDisablePage = $Options['XhtmlCalendarTable']['calendar']['CalendarEventEnableDisablePage']['SettingAttribute'];
		header("Location: $CalendarEventEnableDisablePage");
		
	} else {
		$CalendarEnableDisableSelectPage = $Options['XhtmlCalendarTable']['calendar']['CalendarEventEnableDisableSelectPage']['SettingAttribute'];
		header("Location: ../../index.php?PageID=$CalendarEventEnableDisableSelectPage");
	}
?>