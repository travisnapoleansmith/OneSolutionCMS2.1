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