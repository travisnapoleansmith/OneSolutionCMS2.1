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

	$hold = $_POST['MenuItem'];
	$hold = explode(' ', $hold);
	$PageID = $hold[0];
	$MenuLink = $hold[4];
	unset($hold);

	$_POST['PageID'] = $PageID;
	$_POST['UlMenuID'] = $MenuID;

	unset($passarray);
	$passarray = array();
	$passarray['CurrentVersion'] = 'true';

	$PageVersion = $Tier6Databases->getRecord($passarray, 'ContentLayerVersion', TRUE, array('1' => 'PageID'), 'ASC');

	$PageNumber = array();
	foreach ($PageVersion as $Value) {
		if ($Value['PageID'] != NULL) {
			array_push($PageNumber, $Value['PageID']);
		}
	}

	$PageVersion = array_combine($PageNumber, array_values($PageVersion));
	
	$passarray = array();
	$passarray['PageID'] = 20;
	$passarray['ObjectID'] = $PageID;

	$MenuFormOption = $Tier6Databases->getRecord($passarray, 'AdministratorFormOption');
	
	$EnableDisable = $MenuFormOption[0]['Enable/Disable'];
	$Status = $MenuFormOption[0]['Status'];
	
	$MenuTitle = $PageVersion[$PageID]['ContentPageMenuTitle'];
	$MenuName = $PageVersion[$PageID]['ContentPageMenuName'];
	
	$sessionname = $Tier6Databases->SessionStart('UpdateMenuItem');

	if ($MenuTitle != NULL) {
		$_SESSION['POST']['FilteredInput']['MenuItemHidden'] = $_POST['MenuItem'];
		$_SESSION['POST']['FilteredInput']['MenuTitle'] = $MenuTitle;
	} else {
		if ($_POST['MenuTitle'] != NULL) {
			$_SESSION['POST']['FilteredInput']['MenuItemHidden'] = $_POST['MenuItem'];
			$_SESSION['POST']['FilteredInput']['MenuTitle'] .= $PageVersion[$PageID]['ContentPageMenuTitle'];
		} else {
			$_SESSION['POST']['FilteredInput']['MenuItemHidden'] = 'NULL';
		}
	}
	
	if ($MenuName != NULL) {
		$_SESSION['POST']['FilteredInput']['MenuName'] = $MenuName;
	} else {
		$_SESSION['POST']['FilteredInput']['MenuName'] = 'NULL';
	}
	
	if ($MenuLink != NULL) {
		$_SESSION['POST']['FilteredInput']['MenuLink'] = $MenuLink;
	} else {
		$_SESSION['POST']['FilteredInput']['MenuLink'] = 'NULL';
	}
	
	if ($EnableDisable != NULL) {
		$_SESSION['POST']['FilteredInput']['EnableDisable'] = $EnableDisable;
	} else {
		$_SESSION['POST']['FilteredInput']['EnableDisable'] = 'Enable';
	}
	
	if ($Status != NULL) {
		$_SESSION['POST']['FilteredInput']['Status'] = $Status;
	} else {
		$_SESSION['POST']['FilteredInput']['Status'] = 'Approved';
	}

	$Options = $Tier6Databases->getLayerModuleSetting();
	
	$MainMenuItemUpdatePage = $Options['XhtmlMainMenu']['mainmenu']['UpdateMenuItem']['SettingAttribute'];
	header("Location: $MainMenuItemUpdatePage&SessionID=$sessionname");
	exit;
?>