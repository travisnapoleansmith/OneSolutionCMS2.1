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
	
	$hold = $_POST['SimpleViewerPage'];
	$hold = explode(' ', $hold);
	$CurrentPageID = $hold[2];
	$SimpleViewerPageID = $hold[0];
	$EnableDisableSimpleViewerPage = $_POST['EnableDisableSimpleViewerPage'];
	
	$PageID = array();
	$PageID['PageID'] = $CurrentPageID;
	$FormOptionObjectID = $SimpleViewerPageID;
	$PageID['EnableDisable'] = $_POST['EnableDisable'];
	$PageID['Status'] = $_POST['Status'];

	$Options = $Tier6Databases->getLayerModuleSetting();
	
	if (!is_null($PageID)) {
		$SimpleViewerPageID = array();
		$SimpleViewerPageID['PageID'] = $CurrentPageID;
		$SimpleViewerPageID['SimpleViewerFlashTableName'] = 'FlashSimpleViewerLookup';
		$SimpleViewerPageID['SimpleViewerFlashObjectName'] = 'flashsimpleviewer';
		$SimpleViewerPageID['Status'] = $_POST['Status'];
		$SimpleViewerPageID['Enable/Disable'] =  $_POST['EnableDisable'];
		
		$SimpleViewerLookupPageID = array();
		$SimpleViewerLookupPageID['PageID'] = $CurrentPageID;
		$SimpleViewerLookupPageID['SimpleViewerTableName'] = 'FlashSimpleViewer';
		$SimpleViewerLookupPageID['Status'] = $_POST['Status'];
		$SimpleViewerLookupPageID['Enable/Disable'] =  $_POST['EnableDisable'];
		
		$Tier6Databases->ModulePass('XhtmlSimpleViewer', 'simpleviewer', 'updateSimpleViewerStatus', $SimpleViewerPageID);
		$Tier6Databases->ModulePass('XhtmlSimpleViewer', 'simpleviewer', 'updateFlashLookupStatus', $SimpleViewerLookupPageID);
		
		$Tier6Databases->ModulePass('XhtmlHeader', 'header', 'updateHeaderStatus', $PageID);
		$Tier6Databases->ModulePass('XhtmlMenu', 'headerpanel1', 'updateMenuStatus', $PageID);
		$Tier6Databases->ModulePass('XhtmlContent', 'content', 'updateContentStatus', $PageID);
		$Tier6Databases->ModulePass('XmlSitemap', 'sitemap', 'updateSitemapItemStatus', $PageID);
		$Tier6Databases->ModulePass('XhtmlContent', 'content', 'updateContentPrintPreviewStatus', $PageID);
		$Tier6Databases->updateContentStatus($PageID, 'ContentLayer');

		$FormOptionID = $Options['XhtmlSimpleViewer']['simpleviewer']['SimpleViewerPageUpdateSelectPage']['SettingAttribute'];
		$PageID = array();
		$PageID['PageID'] = &$FormOptionID;
		$PageID['ObjectID'] = $FormOptionObjectID;
		$PageID['EnableDisable'] = $_POST['EnableDisable'];
		$PageID['Status'] = $_POST['Status'];
		
		$Tier6Databases->ModulePass('XhtmlForm', 'form', 'updateFormOptionStatus', $PageID);
		$Tier6Databases->ModulePass('XhtmlForm', 'form', 'updateFormSelectStatus', $PageID);
		
		$FormOptionID = $Options['XhtmlSimpleViewer']['simpleviewer']['SimpleViewerPageDeleteSelectPage']['SettingAttribute'];
		$Tier6Databases->ModulePass('XhtmlForm', 'form', 'updateFormOptionStatus', $PageID);
		$Tier6Databases->ModulePass('XhtmlForm', 'form', 'updateFormSelectStatus', $PageID);
		
		$EnableDisablePage = $Options['XhtmlSimpleViewer']['simpleviewer']['SimpleViewerPageEnableDisablePage']['SettingAttribute'];
		
		header("Location: $EnableDisablePage");
		
	} else {
		$EnableDisableStatusChangePage = $Options['XhtmlSimpleViewer']['simpleviewer']['SimpleViewerPageEnableDisableSelectPage']['SettingAttribute'];
		header("Location: ../../index.php?PageID=$EnableDisableStatusChangePage");
	}
?>