<?php
	$HOME = $_SERVER['SUBDOMAIN_DOCUMENT_ROOT'];
	$ADMINHOME = $HOME . '/Administrators/';
	$GLOBALS['HOME'] = $HOME;
	$GLOBALS['ADMINHOME'] = $ADMINHOME;
	
	require_once ("$ADMINHOME/Configuration/includes.php");
	
	$sessionname = $Tier6Databases->SessionStart('UpdateTableContent');
	
	$Options = $Tier6Databases->getLayerModuleSetting();
	
	$XhtmlTableName = $Options['XhtmlTable']['table']['XhtmlTableName']['SettingAttribute'];
	
	$TableID = $_POST['TableContent'];
	$passarray = array();
	$passarray['XhtmlTableID'] = $TableID;
	$passarray['XhtmlTableName'] = $XhtmlTableName;
	
	$TableSelected = $Tier6Databases->getRecord($passarray, 'XhtmlTableListing', TRUE, array());
	
	$TableName = $TableSelected[0]['TableName'];
	$TableHeading = $TableSelected[0]['TableTitle'];
	$EnableDisable = $TableSelected[0]['Enable/Disable'];
	$Status = $TableSelected[0]['Status'];
	
	$_SESSION['POST']['FilteredInput']['TableName'] = $TableName;
	$_SESSION['POST']['FilteredInput']['TableHeading'] = $TableHeading;
	$_SESSION['POST']['FilteredInput']['EnableDisable'] = $EnableDisable;
	$_SESSION['POST']['FilteredInput']['Status'] = $Status;
	$_SESSION['POST']['FilteredInput']['TableID'] = $TableID;
	
	$_POST['TableID'] = $TableID;
	$_POST['TableName'] = $TableName;
	$_POST['TableHeading'] = $TableHeading;
	$_POST['EnableDisable'] = $EnableDisable;
	$_POST['Status'] = $Status;
	
	$UpdateSelectPage = $Options['XhtmlTable']['table']['TableContentUpdatePage']['SettingAttribute'];
	
	header("Location: $UpdateSelectPage&SessionID=$sessionname&TableID=$TableID");
?>