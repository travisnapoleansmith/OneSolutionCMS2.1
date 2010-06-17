<?php
	require_once ('Configuration/includes.php');
	
	$hold = $_POST['NewsStory'];
	$hold = explode(' ', $hold);
	$PageID = $hold[0];
	$_POST['PageID'] = $PageID;
	unset($hold);
	
	$PageID['PageID'] = $_POST['PageID'];
	
	$Options = $Tier6Databases->getLayerModuleSetting();
	
	if (!is_null($PageID)) {
		$Tier6Databases->ModulePass('XhtmlNewsStories', 'news', 'deleteNewsStory', array('PageID' => $PageID));
		$Tier6Databases->ModulePass('XhtmlNewsStories', 'news', 'deleteNewsStoryVersion', array('PageID' => $PageID));
		$Tier6Databases->ModulePass('XhtmlNewsStories', 'news', 'deleteNewsStoryDate', array('PageID' => $PageID));
		$Tier6Databases->ModulePass('XhtmlPicture', 'newspicture', 'deletePicture', array('PageID' => $PageID));
		
		$NewsArticleUpdateSelectPage = $Options['XhtmlNewsStories']['news']['NewsArticleUpdateSelectPage']['SettingAttribute'];
		$NewsPageID = array();
		$NewsPageID['PageID'] = $NewsArticleUpdateSelectPage;
		$NewsPageID['ObjectID'] = $PageID;
		$Tier6Databases->ModulePass('XhtmlNewsStories', 'news', 'deleteNewsStoryFormOption', $NewsPageID);
		$Tier6Databases->ModulePass('XhtmlNewsStories', 'news', 'deleteNewsStoryFormSelect', $NewsPageID);
		
		$NewsArticleDeleteSelectPage = $Options['XhtmlNewsStories']['news']['NewsArticleDeleteSelectPage']['SettingAttribute'];
		$NewsPageID['PageID'] = $NewsArticleDeleteSelectPage;
		$Tier6Databases->ModulePass('XhtmlNewsStories', 'news', 'deleteNewsStoryFormOption', $NewsPageID);
		$Tier6Databases->ModulePass('XhtmlNewsStories', 'news', 'deleteNewsStoryFormSelect', $NewsPageID);
		
		$NewsArticleDeletePage = $Options['XhtmlNewsStories']['news']['NewsArticleDeletePage']['SettingAttribute'];
		header("Location: $NewsArticleDeletePage");
	} else {
		$NewsArticleDeleteSelectPage = $Options['XhtmlNewsStories']['news']['NewsArticleDeleteSelectPage']['SettingAttribute'];
		header("Location: index.php?PageID=$NewsArticleDeleteSelectPage");
	}
?>