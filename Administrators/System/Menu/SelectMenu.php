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

	$PageAttributes = $Tier6Databases->getRecord($passarray, 'PageAttributes', TRUE, array('1' => 'PageID'), 'ASC');
		
	$PageNumber = array();
	foreach ($PageAttributes as $Value) {
		if ($Value['PageID'] != NULL) {
			array_push($PageNumber, $Value['PageID']);
		}
	}
	$PageAttributes = array_combine($PageNumber, array_values($PageAttributes));

	$passarray = array();
	$passarray['PageID'] = 1;
	$passarray['ObjectID'] = $PageID;

	$Menu = $Tier6Databases->getRecord($passarray, 'MainMenuItemLookup');

	$TopMenuName = $PageAttributes[$PageID]['PageTitle'];
	$sessionname = $Tier6Databases->SessionStart('UpdateMenu');

	if ($TopMenuName) {
		$_SESSION['POST']['FilteredInput']['TopMenuHidden'] = $_POST['MenuItem'];
		$_SESSION['POST']['FilteredInput']['TopMenu'] .= $TopMenuName;
	} else {
		if ($_POST['MenuItem'] != NULL) {
			$_SESSION['POST']['FilteredInput']['TopMenuHidden'] = $_POST['MenuItem'];
			$_SESSION['POST']['FilteredInput']['TopMenu'] .= $PageVersion[$PageID]['ContentPageMenuTitle'];
		} else {
			$_SESSION['POST']['FilteredInput']['TopMenu'] = 'NULL';
		}
	}

	for ($i = 1; $i < 16; $i++) {
		$MenuItemName = NULL;
		$MenuItemNameSelect = 'MenuItem';
		$MenuItemNameSelect .= $i;

		$MenuItemNameLookup = 'MenuItemLookup';
		$MenuItemNameLookup .= $i;

		$ChildNameSelect = 'Child';
		$ChildNameSelect .= $i;

		$MenuItemLookup = $Menu[0][$ChildNameSelect];

		if ($MenuItemLookup != NULL){
			$MenuItemName = strip_tags($PageVersion[$MenuItemLookup]['ContentPageMenuTitle']);
		}

		if ($MenuItemName != NULL) {
			$_SESSION['POST']['FilteredInput'][$MenuItemNameSelect] = $MenuItemName;
		} else {
			$_SESSION['POST']['FilteredInput'][$MenuItemNameSelect] = 'NULL';
		}

		if ($MenuItemLookup != NULL) {
			$_SESSION['POST']['FilteredInput'][$MenuItemNameLookup] = $MenuItemLookup;
		} else {
			$_SESSION['POST']['FilteredInput'][$MenuItemNameLookup] = 'NULL';
		}

	}

	$Options = $Tier6Databases->getLayerModuleSetting();
	$MainMenuUpdatePage = $Options['XhtmlMainMenu']['mainmenu']['MainMenuUpdatePage']['SettingAttribute'];
	header("Location: ../../index.php?PageID=$MainMenuUpdatePage&SessionID=$sessionname");
?>