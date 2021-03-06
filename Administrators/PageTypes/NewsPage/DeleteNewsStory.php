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

	$PageID['PageID'] = $_POST['PageID'];

	$Options = $Tier6Databases->getLayerModuleSetting();
	$hold = $Tier6Databases->ModulePass('XhtmlNewsStories', 'news', 'getNewsStoryVersionRow', array('PageID' => $PageID));
	$XMLFeedPageID = array();
	$XMLFeedPageID['XMLItem'] = $hold[0]['XMLItem'];
	if (!is_null($PageID)) {
		$Tier6Databases->ModulePass('XhtmlNewsStories', 'news', 'deleteNewsStory', array('PageID' => $PageID));
		$Tier6Databases->ModulePass('XhtmlNewsStories', 'news', 'deleteNewsStoryVersion', array('PageID' => $PageID));
		$Tier6Databases->ModulePass('XhtmlNewsStories', 'news', 'deleteNewsStoryDate', array('PageID' => $PageID));
		$Tier6Databases->ModulePass('XhtmlPicture', 'newspicture', 'deletePicture', array('PageID' => $PageID));
		$Tier6Databases->ModulePass('XmlFeed', 'feed', 'deleteStoryFeed', $XMLFeedPageID);

		$NewsArticleUpdateSelectPage = $Options['XhtmlNewsStories']['news']['NewsArticleUpdateSelectPage']['SettingAttribute'];
		$NewsPageID = array();
		$NewsPageID['PageID'] = $NewsArticleUpdateSelectPage;
		$NewsPageID['ObjectID'] = $PageID;
		$Tier6Databases->ModulePass('XhtmlForm', 'form', 'deleteFormOption', $NewsPageID);
		$Tier6Databases->ModulePass('XhtmlForm', 'form', 'deleteFormSelect', $NewsPageID);

		$NewsArticleDeleteSelectPage = $Options['XhtmlNewsStories']['news']['NewsArticleDeleteSelectPage']['SettingAttribute'];
		$NewsPageID['PageID'] = $NewsArticleDeleteSelectPage;
		$Tier6Databases->ModulePass('XhtmlForm', 'form', 'deleteFormOption', $NewsPageID);
		$Tier6Databases->ModulePass('XhtmlForm', 'form', 'deleteFormSelect', $NewsPageID);

		$NewsArticleDeletePage = $Options['XhtmlNewsStories']['news']['NewsArticleDeletePage']['SettingAttribute'];
		header("Location: $NewsArticleDeletePage");
	} else {
		$NewsArticleDeleteSelectPage = $Options['XhtmlNewsStories']['news']['NewsArticleDeleteSelectPage']['SettingAttribute'];
		header("Location: ../../index.php?PageID=$NewsArticleDeleteSelectPage");
	}
?>