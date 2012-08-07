<?php
	$HOME = $_SERVER['SUBDOMAIN_DOCUMENT_ROOT'];
	$ADMINHOME = $HOME . '/Administrators/';
	$GLOBALS['HOME'] = $HOME;
	$GLOBALS['ADMINHOME'] = $ADMINHOME;
	
	require_once ("$ADMINHOME/Configuration/includes.php");
	
	$hold = $_POST['NewsStory'];
	$hold = explode(' ', $hold);
	$PageID = $hold[0];
	$_POST['PageID'] = $PageID;
	unset($hold);
	
	$PageID = array();
	$PageID['PageID'] = $_POST['PageID'];
	
	$hold = $Tier6Databases->ModulePass('XhtmlNewsStories', 'news', 'getNewsStoryVersionRow', $PageID);
	$XMLFeedPageID = array();
	$XMLFeedPageID['XMLItem'] = $hold[0]['XMLItem'];
	$XMLFeedPageID['EnableDisable'] = $_POST['EnableDisable'];
	$XMLFeedPageID['Status'] = $_POST['Status'];

	$PageID['EnableDisable'] = $_POST['EnableDisable'];
	$PageID['Status'] = $_POST['Status'];
	$Options = $Tier6Databases->getLayerModuleSetting();
	
	if (!is_null($PageID)) {
		$Tier6Databases->ModulePass('XhtmlNewsStories', 'news', 'updateNewsStoryStatus', $PageID);
		$Tier6Databases->ModulePass('XhtmlNewsStories', 'news', 'updateNewsStoryVersionStatus', $PageID);
		$Tier6Databases->ModulePass('XhtmlNewsStories', 'news', 'updateNewsStoryDateStatus', $PageID);
		$Tier6Databases->ModulePass('XhtmlPicture', 'newspicture', 'updatePictureStatus', $PageID);
		$Tier6Databases->ModulePass('XmlFeed', 'feed', 'updateStoryFeedStatus', $XMLFeedPageID);
		
		$NewsArticleUpdateSelectPage = $Options['XhtmlNewsStories']['news']['NewsArticleUpdateSelectPage']['SettingAttribute'];
		$NewsPageID = array();
		$NewsPageID['PageID'] = $NewsArticleUpdateSelectPage;
		$NewsPageID['ObjectID'] = $_POST['PageID'];
		$NewsPageID['EnableDisable'] = $_POST['EnableDisable'];
		$NewsPageID['Status'] = $_POST['Status'];
		
		$Tier6Databases->ModulePass('XhtmlForm', 'form', 'updateFormOptionStatus', $NewsPageID);
		$Tier6Databases->ModulePass('XhtmlForm', 'form', 'updateFormSelectStatus', $NewsPageID);
		
		$NewsArticleEnableDisablePage = $Options['XhtmlNewsStories']['news']['NewsArticleEnableDisablePage']['SettingAttribute'];
		header("Location: $NewsArticleEnableDisablePage");
	} else {
		$NewsArticleEnableDisableSelectPage = $Options['XhtmlNewsStories']['news']['NewsArticleEnableDisableSelectPage']['SettingAttribute'];
		header("Location: ../../index.php?PageID=$NewsArticleEnableDisableSelectPage");
	}
?>