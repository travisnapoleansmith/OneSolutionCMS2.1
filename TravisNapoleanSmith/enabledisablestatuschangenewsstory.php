<?php
	require_once ('Configuration/includes.php');
	
	$hold = $_POST['NewsStory'];
	$hold = explode(' ', $hold);
	$PageID = $hold[0];
	$_POST['PageID'] = $PageID;
	unset($hold);
	
	$PageID = array();
	$PageID['PageID'] = $_POST['PageID'];
	$PageID['EnableDisable'] = $_POST['EnableDisable'];
	$PageID['Status'] = $_POST['Status'];
	$Options = $Tier6Databases->getLayerModuleSetting();
	
	if (!is_null($PageID)) {
		$Tier6Databases->ModulePass('XhtmlNewsStories', 'news', 'updateNewsStoryStatus', $PageID);
		$Tier6Databases->ModulePass('XhtmlNewsStories', 'news', 'updateNewsStoryVersionStatus', $PageID);
		$Tier6Databases->ModulePass('XhtmlNewsStories', 'news', 'updateNewsStoryDateStatus', $PageID);
		$Tier6Databases->ModulePass('XhtmlPicture', 'newspicture', 'updatePictureStatus', $PageID);
		
		$NewsArticleUpdateSelectPage = $Options['XhtmlNewsStories']['news']['NewsArticleUpdateSelectPage']['SettingAttribute'];
		$NewsPageID = array();
		$NewsPageID['PageID'] = $NewsArticleUpdateSelectPage;
		$NewsPageID['ObjectID'] = $_POST['PageID'];
		$NewsPageID['EnableDisable'] = $_POST['EnableDisable'];
		$NewsPageID['Status'] = $_POST['Status'];
		
		$Tier6Databases->ModulePass('XhtmlNewsStories', 'news', 'updateNewsStoryFormOptionStatus', $NewsPageID);
		$Tier6Databases->ModulePass('XhtmlNewsStories', 'news', 'updateNewsStoryFormSelectStatus', $NewsPageID);
		
		$NewsArticleDeleteSelectPage = $Options['XhtmlNewsStories']['news']['NewsArticleDeleteSelectPage']['SettingAttribute'];
		$NewsPageID['PageID'] = $NewsArticleDeleteSelectPage;
		$Tier6Databases->ModulePass('XhtmlNewsStories', 'news', 'updateNewsStoryFormOptionStatus', $NewsPageID);
		$Tier6Databases->ModulePass('XhtmlNewsStories', 'news', 'updateNewsStoryFormSelectStatus', $NewsPageID);
		
		$NewsArticleEnableDisablePage = $Options['XhtmlNewsStories']['news']['NewsArticleEnableDisablePage']['SettingAttribute'];
		header("Location: $NewsArticleEnableDisablePage");*/
	} else {
		$NewsArticleEnableDisableSelectPage = $Options['XhtmlNewsStories']['news']['NewsArticleEnableDisableSelectPage']['SettingAttribute'];
		header("Location: index.php?PageID=$NewsArticleEnableDisableSelectPage");
	}
?>