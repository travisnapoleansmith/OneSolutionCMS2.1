<?php
	$HOME = $_SERVER['SUBDOMAIN_DOCUMENT_ROOT'];
	$ADMINHOME = $HOME . '/Administrators/';
	$GLOBALS['HOME'] = $HOME;
	$GLOBALS['ADMINHOME'] = $ADMINHOME;
	
	require_once ("$ADMINHOME/Configuration/includes.php");
	
	$PageID = $_POST['TableContent'];
	
	$passarray = array();
	$passarray['PageID'] = $_POST['DeleteTableContent'];
	$passarray['ObjectID'] = $_POST['TableContent'];
	
	$FormOptionSelected = $Tier6Databases->getRecord($passarray, 'AdministratorFormOption', TRUE, array('1' => 'PageID'), 'ASC');
	
	$Options = $Tier6Databases->getLayerModuleSetting();
	
	if (!is_null($PageID)) {
		$TableContentPageID = array();
		$TableContentPageID['XhtmlTableName'] = 'XhtmlTable';
		$TableContentPageID['XhtmlTableID'] = $PageID;
		$TableContentPageID['Enable/Disable'] = 'Disable';

		$Tier6Databases->ModulePass('XhtmlTable', 'table', 'deleteTable', $TableContentPageID);
		
		$TableContentUpdateSelectPage = $Options['XhtmlTable']['table']['TableContentUpdateSelectPage']['SettingAttribute'];
		$TableContentPageID = array();
		$TableContentPageID['PageID'] = $TableContentUpdateSelectPage;
		$TableContentPageID['ObjectID'] = $FormOptionSelected[0]['ObjectID'];
		
		$Tier6Databases->ModulePass('XhtmlForm', 'form', 'deleteFormOption', $TableContentPageID);
		$Tier6Databases->ModulePass('XhtmlForm', 'form', 'deleteFormSelect', $TableContentPageID);
		
		$TableContentDeletePage = $Options['XhtmlTable']['table']['TableContentDeletePage']['SettingAttribute'];
		header("Location: $TableContentDeletePage");
		
	} else {
		$TableContentDeleteSelectPage = $Options['XhtmlTable']['table']['TableContentDeleteSelectPage']['SettingAttribute'];
		header("Location: ../../index.php?PageID=$TableContentDeleteSelectPage");
	}
	
?>