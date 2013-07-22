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

	$hold = $_POST['NewsPage'];
	$hold = explode(' ', $hold);
	$PageID = $hold[2];
	$_POST['PageID'] = $PageID;
	$_POST['FormOptionObjectID'] = $hold[0];
	unset($hold);

	$PageID = array();
	$PageID['PageID'] = $_POST['PageID'];
	$PageID['CurrentVersion'] = 'true';

	$passarray = array();
	$passarray['PageID'] = $PageID;
	unset($passarray['DatabaseVariableName']);
	$NewsPageVersion = $Tier6Databases->getRecord($PageID, 'ContentLayerVersion');
	$PageVersion = $NewsPageVersion[0]['RevisionID'];

	$PageID['RevisionID'] = $PageVersion;

	$passarray = array();
	$passarray['PageID'] = $PageID;
	$passarray['DatabaseVariableName'] = 'ContentTableName';
	$NewsPage = $Tier6Databases->ModulePass('XhtmlContent', 'content', 'getRecord', $passarray);

	//$passarray['DatabaseVariableName'] = 'NewsStoriesLookupTableName';

	unset($passarray);
	$passarray = array();
	$passarray['PageID'] = $PageID['PageID'];
	$NewsStoriesLookupTable = $Tier6Databases->getRecord($passarray, 'NewsStoriesLookup');

	$NewsDay = $NewsStoriesLookupTable[0]['NewsStoryDay'];
	if (is_null($NewsDay)) {
		$NewsDay = 'Null';
	} else if (!is_int($NewsDay)) {
		$hold = array();
		$hold['Content'] = $NewsStoriesLookupTable[0]['NewsStoryDay'];
		$NewsDay = $Tier6Databases->ModulePass('XhtmlNewsStories', 'news', 'addWordSpace', $hold);
	}

	$NewsMonth = $NewsStoriesLookupTable[0]['NewsStoryMonth'];
	if (is_null($NewsMonth)) {
		$NewsMonth = 'Null';
	} else {
		$hold = array();
		$hold['Content'] = $NewsMonth;
		$NewsMonth = $Tier6Databases->ModulePass('XhtmlNewsStories', 'news', 'addWordSpace', $hold);
	}
	$NewsYear = $NewsStoriesLookupTable[0]['NewsStoryYear'];
	if (is_null($NewsYear)) {
		$NewsYear = 'Null';
	} else if (!is_int($NewsYear)) {
		$hold = array();
		$hold['Content'] = $NewsStoriesLookupTable[0]['NewsStoryYear'];
		$NewsYear = $Tier6Databases->ModulePass('XhtmlNewsStories', 'news', 'addWordSpace', $hold);
	}

	$HeaderPanel1 = $Tier6Databases->getRecord($passarray, 'HeaderPanel1');

	$NewsPageHeader = $Tier6Databases->getRecord($passarray, 'PageAttributes');

	unset($passarray);
	$passarray = array();
	$passarray['PageID'] = $PageID['PageID'];
	$Sitemap = $Tier6Databases->getRecord($passarray, 'XMLSitemap');

	$Sitemap[0]['Priority'] *= 10;

	$hold = array();
	$hold['Tag'] = 'h1';
	$hold['Content'] = $HeaderPanel1[1]['Div1'];
	$Header = $Tier6Databases->ModulePass('XhtmlMenu', 'headerpanel1', 'removeTag', $hold);

	$sessionname = $Tier6Databases->SessionStart('UpdateNewsPage');

	$_SESSION['POST']['FilteredInput']['PageID'] = $_POST['PageID'];
	$_SESSION['POST']['FilteredInput']['FormOptionObjectID'] = $_POST['FormOptionObjectID'];
	$_SESSION['POST']['FilteredInput']['RevisionID'] = $NewsPageVersion[0]['RevisionID'];
	$_SESSION['POST']['FilteredInput']['MenuObjectID'] = $NewsPageVersion[0]['ContentPageMenuObjectID'];
	$_SESSION['POST']['FilteredInput']['CreationDateTime'] = $NewsPageVersion[0]['CreationDateTime'];
	$_SESSION['POST']['FilteredInput']['Owner'] = $NewsPageVersion[0]['Owner'];
	$_SESSION['POST']['FilteredInput']['UserAccessGroup'] = $NewsPageVersion[0]['UserAccessGroup'];

	$_SESSION['POST']['FilteredInput']['PageTitle'] = $NewsPageHeader[0]['PageTitle'];
	if ($NewsPageHeader[0]['MetaNameContent1']) {
		$_SESSION['POST']['FilteredInput']['Keywords'] = $NewsPageHeader[0]['MetaNameContent1'];
	} else {
		$_SESSION['POST']['FilteredInput']['Keywords'] = 'NULL';
	}
	if ($NewsPageHeader[0]['MetaNameContent2']) {
		$_SESSION['POST']['FilteredInput']['Description'] = $NewsPageHeader[0]['MetaNameContent2'];
	} else {
		$_SESSION['POST']['FilteredInput']['Description'] = 'NULL';
	}
	$_SESSION['POST']['FilteredInput']['Header'] = $Header;
	$_SESSION['POST']['FilteredInput']['Heading'] = $NewsPage[0]['Heading'];
	$_SESSION['POST']['FilteredInput']['TopText'] = $NewsPage[0]['Content'];
	$_SESSION['POST']['FilteredInput']['NewsDay'] = $NewsDay;
	$_SESSION['POST']['FilteredInput']['NewsMonth'] = $NewsMonth;
	$_SESSION['POST']['FilteredInput']['NewsYear'] = $NewsYear;
	$_SESSION['POST']['FilteredInput']['BottomText'] = $NewsPage[2]['Content'];
	$_SESSION['POST']['FilteredInput']['Priority'] = $Sitemap[0]['Priority'];
	$_SESSION['POST']['FilteredInput']['Frequency'] = ucfirst($Sitemap[0]['ChangeFreq']);

	$_SESSION['POST']['FilteredInput']['MenuName'] = $NewsPageVersion[0]['ContentPageMenuName'];
	$_SESSION['POST']['FilteredInput']['MenuTitle'] = $NewsPageVersion[0]['ContentPageMenuTitle'];

	$_SESSION['POST']['FilteredInput']['EnableDisable'] = 'Enable';
	$_SESSION['POST']['FilteredInput']['Status'] = 'Approved';

	$Options = $Tier6Databases->getLayerModuleSetting();
	$UpdateNewsPage = $Options['XhtmlNewsStories']['news']['UpdateNewsPage']['SettingAttribute'];

	header("Location: $UpdateNewsPage&SessionID=$sessionname");

?>