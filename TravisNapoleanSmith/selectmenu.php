<?php
	require_once ('Configuration/includes.php');
	
	$hold = $_POST['MenuItem'];
	$hold = explode(' ', $hold);
	$PageID = $hold[0];
	$MenuID = $hold[2];
	unset($hold);
	
	if ($MenuID == 'NULL') {
		$sessionname = $Tier6Databases->SessionStart('UpdateMenu');
		$_SESSION['POST']['Error']['Menu Selection'] = 'The item that was selected doesn\'t have a submenu. <br /> ';
		$_SESSION['POST']['Error']['Menu Selection'] .= 'Please select an item that has a submenu!';
		$SelectMenu = $_POST['SelectMenu'];
		header("Location: index.php?PageID=$SelectMenu&SessionID=$sessionname");
		exit();
	} else {
		$_POST['PageID'] = $PageID;
		$_POST['UlMenuID'] = $MenuID;
	}
	
	$passarray = array();
	$passarray['PageID'] = 1;
	$passarray['ObjectID'] = $MenuID;
	$Menu = $Tier6Databases->getRecord($passarray, 'MainMenu');
	
	unset($passarray);
	$PageAttributes = $Tier6Databases->getTable('PageAttributes');
	$TopMenuName = $PageAttributes[$PageID]['PageTitle'];
	$sessionname = $Tier6Databases->SessionStart('UpdateMenu');
    
	if ($TopMenuName) {
		$_SESSION['POST']['FilteredInput']['TopMenuHidden'] = $_POST['MenuItem'];
		$_SESSION['POST']['FilteredInput']['TopMenu'] .= $TopMenuName;
	} else {
		$_SESSION['POST']['FilteredInput']['TopMenu'] = 'NULL';
	}
	
	for ($i = 1; $i < 16; $i++) {
		$MenuItemNameSelect = 'MenuItem';
		$MenuItemNameSelect .= $i;
		
		$LiNameSelect = 'Li';
		$LiNameSelect .= $i;
		
		$MenuItemName = $Menu[0][$LiNameSelect];
		if (strstr($MenuItemName, 'index.php">')) {
			$MenuItemName = 1;
		} else {
			$ReplaceMenuItemName = str_replace('<a href="index.php?PageID=', '', $MenuItemName);
			$MenuItemName = strip_tags($MenuItemName);
			$ReplaceMenuItemName = str_replace('">' . "$MenuItemName", '', $ReplaceMenuItemName);
			$ReplaceMenuItemName = strip_tags($ReplaceMenuItemName);
			$MenuItemName = $ReplaceMenuItemName;
			unset($ReplaceMenuItemName);
		}
		
		if ($MenuItemName) {
			$MenuItemName = $PageAttributes[$MenuItemName]['PageTitle'];
			$_SESSION['POST']['FilteredInput'][$MenuItemNameSelect] = $MenuItemName;
		} else {
			$_SESSION['POST']['FilteredInput'][$MenuItemNameSelect] = 'NULL';
		}
	}
	
	$Options = $Tier6Databases->getLayerModuleSetting();
	$MainMenuUpdatePage = $Options['XhtmlMainMenu']['mainmenu']['MainMenuUpdatePage']['SettingAttribute'];
	header("Location: index.php?PageID=$MainMenuUpdatePage&SessionID=$sessionname");
?>