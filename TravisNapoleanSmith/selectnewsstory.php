<?php
	require_once ('Configuration/includes.php');
	
	$hold = $_POST['NewsStory'];
	$hold = explode(' ', $hold);
	$PageID = $hold[0];
	$_POST['PageID'] = $PageID;
	unset($hold);
	
	$PageID = array();
	$PageID['PageID'] = $_POST['PageID'];
	$PageID['CurrentVersion'] = 'true';

	$passarray = array();
	$passarray['PageID'] = $PageID;
	$passarray['DatabaseVariableName'] = 'NewsStoriesTableName';
	
	$NewsStory = $Tier6Databases->ModulePass('XhtmlNewsStories', 'news', 'getRecord', $passarray);
	
	$passarray['DatabaseVariableName'] = 'DatabaseTable';
	$NewsPicture = $Tier6Databases->ModulePass('XhtmlPicture', 'newspicture', 'getRecord', $passarray);
	
	unset($passarray['PageID']['CurrentVersion']);
	$passarray['DatabaseVariableName'] = 'NewsStoriesDatesTableName';
	$NewsDate = $Tier6Databases->ModulePass('XhtmlNewsStories', 'news', 'getRecord', $passarray);

	$passarray['DatabaseVariableName'] = 'NewsStoriesVersionTableName';
	$NewsVersion = $Tier6Databases->ModulePass('XhtmlNewsStories', 'news', 'getRecord', $passarray);
	
	$sessionname = $Tier6Databases->SessionStart('UpdateNewsStory');

	$_SESSION['POST']['FilteredInput']['PageID'] = $_POST['PageID'];
	$_SESSION['POST']['FilteredInput']['RevisionID'] = $NewsStory[0]['RevisionID'];
	$_SESSION['POST']['FilteredInput']['CreationDateTime'] = $NewsVersion[0]['CreationDateTime'];
	$_SESSION['POST']['FilteredInput']['Owner'] = $NewsVersion[0]['Owner'];
	$_SESSION['POST']['FilteredInput']['UserAccessGroup'] = $NewsVersion[0]['UserAccessGroup'];
	$_SESSION['POST']['FilteredInput']['Heading'] = $NewsStory[0]['Heading'];
	$_SESSION['POST']['FilteredInput']['ImageSrc'] = $NewsPicture[0]['PictureLink'];
	$_SESSION['POST']['FilteredInput']['ImageAlt'] = $NewsPicture[0]['PictureAltText'];
	$_SESSION['POST']['FilteredInput']['Content'] = $NewsStory[2]['Content'];
	$_SESSION['POST']['FilteredInput']['NewsDay'] = $NewsDate[0]['NewsStoryDay'];
	$_SESSION['POST']['FilteredInput']['NewsMonth'] = $NewsDate[0]['NewsStoryMonth'];
	$_SESSION['POST']['FilteredInput']['NewsYear'] = $NewsDate[0]['NewsStoryYear'];
	$_SESSION['POST']['FilteredInput']['EnableDisable'] = 'Enable';
	$_SESSION['POST']['FilteredInput']['Status'] = 'Approved';
	
	$Options = $Tier6Databases->getLayerModuleSetting();
	$NewsArticleUpdatePage = $Options['XhtmlNewsStories']['news']['NewsArticleUpdatePage']['SettingAttribute'];
	header("Location: $NewsArticleUpdatePage&SessionID=$sessionname");	
?>