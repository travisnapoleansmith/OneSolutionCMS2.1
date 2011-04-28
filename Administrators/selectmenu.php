<?php
	require_once ('Configuration/includes.php');
	
	$hold = $_POST['MenuItem'];
	$hold = explode(' ', $hold);
	$PageID = $hold[0];
	//$MenuID = $hold[2];
	unset($hold);
	
	$_POST['PageID'] = $PageID;
	$_POST['UlMenuID'] = $MenuID;
	
	unset($passarray);
	$passarray = array();
	$passarray['CurrentVersion'] = 'true';
	$PageAttributes = $Tier6Databases->getRecord($passarray, 'PageAttributes', TRUE, array('1' => 'PageID'), 'ASC');
	$PageAttributes = array_combine(range(1, count($PageAttributes)), array_values($PageAttributes));
	
	$PageVersion = $Tier6Databases->getRecord($passarray, 'ContentLayerVersion', TRUE, array('1' => 'PageID'), 'ASC');
	$PageVersion = array_combine(range(1, count($PageVersion)), array_values($PageVersion));
	$MenuID = $PageVersion[$PageID]['ContentPageMenuObjectID'];
	
	if ($MenuID != NULL) {
		$passarray = array();
		$passarray['PageID'] = 1;
		$passarray['ObjectID'] = $MenuID;
		
		$Menu = $Tier6Databases->getRecord($passarray, 'MainMenu');
	} else {
		$Menu = NULL;
	}
	
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
		} else if (strstr($MenuItemName, 'index.php')) {
			$ReplaceMenuItemName = str_replace('<a href="index.php?PageID=', '', $MenuItemName);
			$MenuItemName = strip_tags($MenuItemName);
			$ReplaceMenuItemName = str_replace('">' . "$MenuItemName", '', $ReplaceMenuItemName);
			$ReplaceMenuItemName = strip_tags($ReplaceMenuItemName);
			$MenuItemName = $ReplaceMenuItemName;
			unset($ReplaceMenuItemName);
		} else {
			$MenuName = strip_tags($MenuItemName, 'br');
		}
		
		if ($MenuName) {
			$_SESSION['POST']['FilteredInput'][$MenuItemNameSelect] = $MenuName;
		} else if ($MenuItemName) {
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