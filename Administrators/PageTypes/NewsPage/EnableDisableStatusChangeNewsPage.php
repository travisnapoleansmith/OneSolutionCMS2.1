<?php
	$HOME = $_SERVER['SUBDOMAIN_DOCUMENT_ROOT'];
	$ADMINHOME = $HOME . '/Administrators/';
	$GLOBALS['HOME'] = $HOME;
	$GLOBALS['ADMINHOME'] = $ADMINHOME;
	
	require_once ("$ADMINHOME/Configuration/includes.php");
	
	$hold = $_POST['NewsPage'];
	$hold = explode(' ', $hold);
	$PageID = $hold[2];
	$_POST['PageID'] = $PageID;
	$_POST['FormOptionObjectID'] = $hold[0];
	unset($hold);
	
	$PageID = array();
	$PageID['PageID'] = $_POST['PageID'];
	$FormOptionObjectID = $_POST['FormOptionObjectID'];
	$PageID['EnableDisable'] = $_POST['EnableDisable'];
	$PageID['Status'] = $_POST['Status'];
	
	$Options = $Tier6Databases->getLayerModuleSetting();
	
	if (!is_null($PageID)) {
		$Tier6Databases->ModulePass('XhtmlNewsStories', 'news', 'updateNewsStoryLookupStatus', $PageID);
		
		$Tier6Databases->ModulePass('XhtmlHeader', 'header', 'updateHeaderStatus', $PageID);
		$Tier6Databases->ModulePass('XhtmlMenu', 'headerpanel1', 'updateMenuStatus', $PageID);
		$Tier6Databases->ModulePass('XhtmlContent', 'content', 'updateContentStatus', $PageID);
		$Tier6Databases->ModulePass('XmlSitemap', 'sitemap', 'updateSitemapItemStatus', $PageID);
		$Tier6Databases->ModulePass('XhtmlContent', 'content', 'updateContentPrintPreviewStatus', $PageID);
		$Tier6Databases->updateContentStatus($PageID, 'ContentLayer');
		
		$FormOptionID = $Options['XhtmlNewsStories']['news']['UpdateNewsPageSelect']['SettingAttribute'];
		$NewsPageID = array();
		$NewsPageID['PageID'] = &$FormOptionID;
		$NewsPageID['ObjectID'] = $FormOptionObjectID;
		$NewsPageID['EnableDisable'] = $_POST['EnableDisable'];
		$NewsPageID['Status'] = $_POST['Status'];
		
		$Tier6Databases->ModulePass('XhtmlForm', 'form', 'updateFormOptionStatus', $NewsPageID);
		$Tier6Databases->ModulePass('XhtmlForm', 'form', 'updateFormSelectStatus', $NewsPageID);
		
		$EnableDisableNewsPage = $Options['XhtmlNewsStories']['news']['EnableDisableNewsPage']['SettingAttribute'];
		header("Location: $EnableDisableNewsPage");
	} else {
		$EnableDisableStatusChangeNewsPage = $Options['XhtmlNewsStories']['news']['EnableDisableStatusChangeNewsPage']['SettingAttribute'];
		header("Location: ../../index.php?PageID=$EnableDisableStatusChangeNewsPage");
	}
?>