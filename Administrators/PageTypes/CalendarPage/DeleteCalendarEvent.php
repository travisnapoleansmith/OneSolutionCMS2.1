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