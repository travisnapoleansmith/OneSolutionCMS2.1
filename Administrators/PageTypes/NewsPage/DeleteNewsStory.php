<?php
	/*
	**************************************************************************************
	* One Solution CMS
	*
	* Copyright (c) 1999 - 2012 One Solution CMS
	*
	* This content management system is free software; you can redistribute it and/or
	* modify it under the terms of the GNU Lesser General Public
	* License as published by the Free Software Foundation; either
	* version 2.1 of the License, or (at your option) any later version.
	*
	* This library is distributed in the hope that it will be useful,
	* but WITHOUT ANY WARRANTY; without even the implied warranty of
	* MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU
	* Lesser General Public License for more details.
	*
	* You should have received a copy of the GNU Lesser General Public
	* License along with this library; if not, write to the Free Software
	* Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301  USA
	*
	* @copyright  Copyright (c) 1999 - 2013 One Solution CMS (http://www.onesolutioncms.com/)
	* @license    http://www.gnu.org/licenses/old-licenses/lgpl-2.1.txt	LGPL
	* @version    2.1.139, 2012-12-27
	*************************************************************************************
	*/

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