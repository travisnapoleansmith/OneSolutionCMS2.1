<?php
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
		
		$CalendarAppointment = array();
		$CalendarAppointment['TableName'] = 'CalendarAppointments';
		$CalendarAppointment['CalendarID'] = $NewPageID;
		$CalendarAppointment['Day'] = $hold['FilteredInput']['EventDay'];
		$CalendarAppointment['Month'] = $hold['FilteredInput']['EventMonth'];
		$CalendarAppointment['Year'] = $hold['FilteredInput']['EventYear'];
		$CalendarAppointment['StartTime'] = $StartTime;
		$CalendarAppointment['StartTimeAmPm'] = $hold['FilteredInput']['StartAMPM'];
		$CalendarAppointment['StartTimeZone'] = $hold['FilteredInput']['StartTimezone'];
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
		$FormSelect['FormSelectStyle'] = NULL;
		$FormSelect['FormSelectTabIndex'] = NULL;
		$FormSelect['FormSelectTitle'] = NULL;
		$FormSelect['FormSelectXMLLang'] = 'en-us';
		$FormSelect['Enable/Disable'] = 'Enable';
		$FormSelect['Status'] = 'Approved';
		
		//$FormOptionValue = $NewPageID . ' - NULL';
		$Date = date_parse($_POST['EventMonth']);
		if ($Date['month'] < 10) {
			$FormOptionText .= 0 . $Date['month'];
		} else {
			$FormOptionText .= $Date['month'];
		}
		$FormOptionText .= '/';
		if ($_POST['EventDay'] < 10) {
			$FormOptionText .= 0 . $_POST['EventDay'];
		} else {
			$FormOptionText .= $_POST['EventDay'];
		}
		$FormOptionText .= '/';
		$FormOptionText .= $_POST['EventYear'];
		$FormOptionText .= ' - ';
		$FormOptionText .= $StartTime;
		$FormOptionText .= ' ';
		$FormOptionText .= $_POST['StartAMPM'];
		$FormOptionText .= ' - ';
		$FormOptionText .= $EndTime;
		$FormOptionText .= ' ';
		$FormOptionText .= $_POST['EndAMPM'];
		$FormOptionText .= ' - ';
		
		$temp = $hold['FilteredInput']['Event'];
		$temp = explode(' ', $temp);
		
		for ($i = 0; $i < 2; $i++) {
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
		
		header("Location: $CalendarEventCreatedPage");
		
	}
	
?>