<?php
	/*
	**************************************************************************************
	* One Solution CMS
	*
	* Copyright (c) 1999 - 2013 One Solution CMS
	* This content management system is free software: you can redistribute it and/or modify
	* it under the terms of the GNU General Public License as published by
	* the Free Software Foundation, either version 2 of the License, or
	* (at your option) any later version.
	*
	* This content management system is distributed in the hope that it will be useful,
	* but WITHOUT ANY WARRANTY; without even the implied warranty of
	* MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
	* GNU General Public License for more details.
	*
	* You should have received a copy of the GNU General Public License
	* along with this program.  If not, see <http://www.gnu.org/licenses/>.
	*
	* @copyright  Copyright (c) 1999 - 2013 One Solution CMS (http://www.onesolutioncms.com/)
	* @license    http://www.gnu.org/licenses/gpl-2.0.txt
	* @version    2.1.141, 2013-01-14
	*************************************************************************************
	*/
	
	if ($_SERVER['SUBDOMAIN_DOCUMENT_ROOT'] != NULL) {
		$HOME = $_SERVER['SUBDOMAIN_DOCUMENT_ROOT'];
	} else {
		if ($_SERVER['REAL_DOCUMENT_ROOT'] != NULL) {
			$_SERVER['SUBDOMAIN_DOCUMENT_ROOT'] = $_SERVER['REAL_DOCUMENT_ROOT'];
			$HOME = $_SERVER['SUBDOMAIN_DOCUMENT_ROOT'];
		} else {
			$HOME = NULL;
		}
	}
	
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
	$PageID['CurrentVersion'] = 'true';
	
	$ContentLayerVersion = $Tier6Databases->getRecord($PageID, 'NewsStoriesVersion', TRUE, array());
	
	$passarray = array();
	$passarray['PageID'] = $PageID;
	$passarray['DatabaseVariableName'] = 'NewsStoriesTableName';

	$NewsStory = $Tier6Databases->ModulePass('XhtmlNewsStories', 'news', 'getRecord', $passarray);

	$passarray['DatabaseVariableName'] = 'DatabaseTable';
	$NewsPicture = $Tier6Databases->ModulePass('XhtmlPicture', 'newspicture', 'getRecord', $passarray);
	
	$VideoSelectedPageID = array();
	$VideoSelectedPageID['PageID'] = $_POST['PageID'];
	$VideoSelectedPageID['RevisionID'] = $ContentLayerVersion[0]['RevisionID'];
	$VideoSelectedPageID['CurrentVersion'] = 'true';
	
	$Video = $Tier6Databases->getRecord($VideoSelectedPageID, 'NewsStoriesFlash', TRUE, array());
	
	//unset($passarray['PageID']['CurrentVersion']);
	$passarray['DatabaseVariableName'] = 'NewsStoriesDatesTableName';
	$NewsDate = $Tier6Databases->ModulePass('XhtmlNewsStories', 'news', 'getRecord', $passarray);

	$passarray['DatabaseVariableName'] = 'NewsStoriesVersionTableName';
	$NewsVersion = $Tier6Databases->ModulePass('XhtmlNewsStories', 'news', 'getRecord', $passarray);

	$passarray['DatabaseVariableName'] = 'DatabaseTableName';
	unset($passarray);
	$passarray = array();
	$passarray['XMLItem'] = $PageID['PageID'];

	$NewsFeed = $Tier6Databases->getRecord($passarray, 'XMLNewsFeed');

	$sessionname = $Tier6Databases->SessionStart('UpdateNewsStory');
	$LastNewsVersion = end($NewsVersion);
	
	if ($NewsStory[1]['ContainerObjectType'] == 'XhtmlPicture') {
		$_SESSION['POST']['FilteredInput']['PageID'] = $_POST['PageID'];
		$_SESSION['POST']['FilteredInput']['RevisionID'] = $NewsStory[0]['RevisionID'];
		$_SESSION['POST']['FilteredInput']['CreationDateTime'] = $NewsVersion[0]['CreationDateTime'];
		$_SESSION['POST']['FilteredInput']['Owner'] = $NewsVersion[0]['Owner'];
		$_SESSION['POST']['FilteredInput']['UserAccessGroup'] = $NewsVersion[0]['UserAccessGroup'];
		$_SESSION['POST']['FilteredInput']['Heading'] = $NewsStory[0]['Heading'];
		$_SESSION['POST']['FilteredInput']['ImageSrc'] = $NewsPicture[0]['PictureLink'];
		$_SESSION['POST']['FilteredInput']['ImageAlt'] = $NewsPicture[0]['PictureAltText'];
		
		if ($NewsStory[1]['ContainerObjectType'] == 'XhtmlFlash' | $NewsStory[2]['ContainerObjectType'] == 'XhtmlFlash') {
			$_SESSION['POST']['FilteredInput']['VideoLocation'] = $Video[0]['FlashPath'];
			$_SESSION['POST']['FilteredInput']['NoFlashText'] = $Video[0]['AltText'];
			$_SESSION['POST']['FilteredInput']['FlashVarsText'] = $Video[0]['FlashVarsDescription'];
			
			if ($NewsStory[1]['ContainerObjectType'] == 'XhtmlFlash') {
				$_SESSION['POST']['FilteredInput']['Content'] = $NewsStory[2]['Content'];
			} else {
				$_SESSION['POST']['FilteredInput']['Content'] = $NewsStory[3]['Content'];
			}
		} else {
			$_SESSION['POST']['FilteredInput']['VideoLocation'] = 'NULL';
			$_SESSION['POST']['FilteredInput']['NoFlashText'] = 'NULL';
			$_SESSION['POST']['FilteredInput']['FlashVarsText'] = 'NULL';
			$_SESSION['POST']['FilteredInput']['Content'] = $NewsStory[2]['Content'];
		}
		
		$_SESSION['POST']['FilteredInput']['NewsDay'] = $NewsDate[0]['NewsStoryDay'];
		$_SESSION['POST']['FilteredInput']['NewsMonth'] = $NewsDate[0]['NewsStoryMonth'];
		$_SESSION['POST']['FilteredInput']['NewsYear'] = $NewsDate[0]['NewsStoryYear'];
		$_SESSION['POST']['FilteredInput']['Category'] = $NewsFeed[0]['FeedItemCategory'];
		$_SESSION['POST']['FilteredInput']['MenuName'] = $LastNewsVersion['StoryMenuName'];
		$_SESSION['POST']['FilteredInput']['MenuTitle'] = $LastNewsVersion['StoryMenuTitle'];
		$_SESSION['POST']['FilteredInput']['EnableDisable'] = 'Enable';
		$_SESSION['POST']['FilteredInput']['Status'] = 'Approved';
	} else if ($NewsStory[1]['ContainerObjectType'] == 'XhtmlFlash' | $NewsStory[2]['ContainerObjectType'] == 'XhtmlFlash') {
		$_SESSION['POST']['FilteredInput']['PageID'] = $_POST['PageID'];
		$_SESSION['POST']['FilteredInput']['RevisionID'] = $NewsStory[0]['RevisionID'];
		$_SESSION['POST']['FilteredInput']['CreationDateTime'] = $NewsVersion[0]['CreationDateTime'];
		$_SESSION['POST']['FilteredInput']['Owner'] = $NewsVersion[0]['Owner'];
		$_SESSION['POST']['FilteredInput']['UserAccessGroup'] = $NewsVersion[0]['UserAccessGroup'];
		$_SESSION['POST']['FilteredInput']['Heading'] = $NewsStory[0]['Heading'];
		$_SESSION['POST']['FilteredInput']['ImageSrc'] = 'NULL';
		$_SESSION['POST']['FilteredInput']['ImageAlt'] = 'NULL';
		$_SESSION['POST']['FilteredInput']['VideoLocation'] = $Video[0]['FlashPath'];
		$_SESSION['POST']['FilteredInput']['NoFlashText'] = $Video[0]['AltText'];
		$_SESSION['POST']['FilteredInput']['FlashVarsText'] = $Video[0]['FlashVarsDescription'];
		
		if ($NewsStory[1]['ContainerObjectType'] == 'XhtmlFlash') {
			$_SESSION['POST']['FilteredInput']['Content'] = $NewsStory[2]['Content'];
		} else {
			$_SESSION['POST']['FilteredInput']['Content'] = $NewsStory[3]['Content'];
		}
		
		$_SESSION['POST']['FilteredInput']['NewsDay'] = $NewsDate[0]['NewsStoryDay'];
		$_SESSION['POST']['FilteredInput']['NewsMonth'] = $NewsDate[0]['NewsStoryMonth'];
		$_SESSION['POST']['FilteredInput']['NewsYear'] = $NewsDate[0]['NewsStoryYear'];
		$_SESSION['POST']['FilteredInput']['Category'] = $NewsFeed[0]['FeedItemCategory'];
		$_SESSION['POST']['FilteredInput']['MenuName'] = $LastNewsVersion['StoryMenuName'];
		$_SESSION['POST']['FilteredInput']['MenuTitle'] = $LastNewsVersion['StoryMenuTitle'];
		$_SESSION['POST']['FilteredInput']['EnableDisable'] = 'Enable';
		$_SESSION['POST']['FilteredInput']['Status'] = 'Approved';
	} else {
		$_SESSION['POST']['FilteredInput']['PageID'] = $_POST['PageID'];
		$_SESSION['POST']['FilteredInput']['RevisionID'] = $NewsStory[0]['RevisionID'];
		$_SESSION['POST']['FilteredInput']['CreationDateTime'] = $NewsVersion[0]['CreationDateTime'];
		$_SESSION['POST']['FilteredInput']['Owner'] = $NewsVersion[0]['Owner'];
		$_SESSION['POST']['FilteredInput']['UserAccessGroup'] = $NewsVersion[0]['UserAccessGroup'];
		$_SESSION['POST']['FilteredInput']['Heading'] = $NewsStory[0]['Heading'];
		$_SESSION['POST']['FilteredInput']['ImageSrc'] = 'NULL';
		$_SESSION['POST']['FilteredInput']['ImageAlt'] = 'NULL';
		$_SESSION['POST']['FilteredInput']['VideoLocation'] = 'NULL';
		$_SESSION['POST']['FilteredInput']['NoFlashText'] = 'NULL';
		$_SESSION['POST']['FilteredInput']['FlashVarsText'] = 'NULL';
		$_SESSION['POST']['FilteredInput']['Content'] = $NewsStory[1]['Content'];
		$_SESSION['POST']['FilteredInput']['NewsDay'] = $NewsDate[0]['NewsStoryDay'];
		$_SESSION['POST']['FilteredInput']['NewsMonth'] = $NewsDate[0]['NewsStoryMonth'];
		$_SESSION['POST']['FilteredInput']['NewsYear'] = $NewsDate[0]['NewsStoryYear'];
		$_SESSION['POST']['FilteredInput']['Category'] = $NewsFeed[0]['FeedItemCategory'];
		$_SESSION['POST']['FilteredInput']['MenuName'] = $LastNewsVersion['StoryMenuName'];
		$_SESSION['POST']['FilteredInput']['MenuTitle'] = $LastNewsVersion['StoryMenuTitle'];
		$_SESSION['POST']['FilteredInput']['EnableDisable'] = 'Enable';
		$_SESSION['POST']['FilteredInput']['Status'] = 'Approved';
	}
	
	$Options = $Tier6Databases->getLayerModuleSetting();
	$NewsArticleUpdatePage = $Options['XhtmlNewsStories']['news']['NewsArticleUpdatePage']['SettingAttribute'];
	header("Location: $NewsArticleUpdatePage&SessionID=$sessionname");
?>