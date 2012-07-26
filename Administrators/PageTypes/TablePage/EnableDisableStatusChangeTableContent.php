<?php
	$HOME = $_SERVER['SUBDOMAIN_DOCUMENT_ROOT'];
	$ADMINHOME = $HOME . '/Administrators/';
	$GLOBALS['HOME'] = $HOME;
	$GLOBALS['ADMINHOME'] = $ADMINHOME;
	
	require_once ("$ADMINHOME/Configuration/includes.php");
	
	$PageID = $_POST['TableContent'];
	
	$passarray = array();
	$passarray['PageID'] = $_POST['EnableDisableTableContent'];
	$passarray['ObjectID'] = $_POST['TableContent'];
	
	$FormOptionSelected = $Tier6Databases->getRecord($passarray, 'AdministratorFormOption', TRUE, array('1' => 'PageID'), 'ASC');
	
	$Options = $Tier6Databases->getLayerModuleSetting();
	
	if (!is_null($PageID)) {
		$TableContentPageID = array();
		$TableContentPageID['XhtmlTableName'] = 'XhtmlTable';
		$TableContentPageID['XhtmlTableID'] = $PageID;
		$TableContentPageID['Enable/Disable'] = $_POST['EnableDisable'];
		$TableContentPageID['Status'] = $_POST['Status'];
		
		$Tier6Databases->ModulePass('XhtmlTable', 'table', 'updateTableStatus', $TableContentPageID);
		
		$TableContentUpdateSelectPage = $Options['XhtmlTable']['table']['TableContentUpdateSelectPage']['SettingAttribute'];
		$TableContentPageID = array();
		$TableContentPageID['PageID'] = $TableContentUpdateSelectPage;
		$TableContentPageID['ObjectID'] = $FormOptionSelected[0]['ObjectID'];
		$TableContentPageID['EnableDisable'] = $_POST['EnableDisable'];
		$TableContentPageID['Status'] = $_POST['Status'];
		
		$Tier6Databases->ModulePass('XhtmlForm', 'form', 'updateFormOptionStatus', $TableContentPageID);
		$Tier6Databases->ModulePass('XhtmlForm', 'form', 'updateFormSelectStatus', $TableContentPageID);
		
		$TableContentEnableDisablePage = $Options['XhtmlTable']['table']['TableContentEnableDisablePage']['SettingAttribute'];
		header("Location: $TableContentEnableDisablePage");
		
	} else {
		$TableContentEnableDisableSelectPage = $Options['XhtmlTable']['table']['TableContentEnableDisableSelectPage']['SettingAttribute'];
		header("Location: ../../index.php?PageID=$TableContentEnableDisableSelectPage");
	}
	
?>