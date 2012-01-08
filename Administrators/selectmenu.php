<?php
	require_once ('Configuration/includes.php');
	
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
		$_SESSION['POST']['FilteredInput']['TopMenu'] = 'NULL';
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
	header("Location: index.php?PageID=$MainMenuUpdatePage&SessionID=$sessionname");
?>