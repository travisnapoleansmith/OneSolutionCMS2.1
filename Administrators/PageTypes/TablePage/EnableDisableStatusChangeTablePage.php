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
	
	$HOME = $_SERVER['SUBDOMAIN_DOCUMENT_ROOT'];
	$ADMINHOME = $HOME . '/Administrators/';
	$GLOBALS['HOME'] = $HOME;
	$GLOBALS['ADMINHOME'] = $ADMINHOME;

	require_once ("$ADMINHOME/Configuration/includes.php");
	
	$hold = $_POST['TablePage'];
	$hold = explode(' ', $hold);
	$CurrentPageID = $hold[2];
	$TableID = $hold[0];
	$EnableDisableTablePage = $_POST['EnableDisableTablePage'];
	
	$PageID = array();
	$PageID['PageID'] = $CurrentPageID;
	$FormOptionObjectID = $TableID;
	$PageID['EnableDisable'] = $_POST['EnableDisable'];
	$PageID['Status'] = $_POST['Status'];

	$Options = $Tier6Databases->getLayerModuleSetting();
	
	$XhtmlTableName = $Options['XhtmlTable']['table']['XhtmlTableName']['SettingAttribute'];
	
	if (!is_null($PageID)) {
		$TableContentPageID = array();
		$TableContentPageID['TableName'] = 'XhtmlTableLookup';
		$TableContentPageID['PageID'] = $CurrentPageID;
		$TableContentPageID['XhtmlTableName'] = $XhtmlTableName;
		$TableContentPageID['Status'] = $_POST['Status'];
		$TableContentPageID['Enable/Disable'] =  $_POST['EnableDisable'];
		
		$Tier6Databases->ModulePass('XhtmlTable', 'table', 'updateTableLookup', $TableContentPageID);
		
		$Tier6Databases->ModulePass('XhtmlPicture', 'picture', 'updatePictureStatus', $PageID);
		
		$Tier6Databases->ModulePass('XhtmlHeader', 'header', 'updateHeaderStatus', $PageID);
		$Tier6Databases->ModulePass('XhtmlMenu', 'headerpanel1', 'updateMenuStatus', $PageID);
		$Tier6Databases->ModulePass('XhtmlContent', 'content', 'updateContentStatus', $PageID);
		$Tier6Databases->ModulePass('XmlSitemap', 'sitemap', 'updateSitemapItemStatus', $PageID);
		$Tier6Databases->ModulePass('XhtmlContent', 'content', 'updateContentPrintPreviewStatus', $PageID);
		$Tier6Databases->updateContentStatus($PageID, 'ContentLayer');

		$FormOptionID = $Options['XhtmlTable']['table']['TablePageUpdateSelectPage']['SettingAttribute'];
		$PageID = array();
		$PageID['PageID'] = &$FormOptionID;
		$PageID['ObjectID'] = $FormOptionObjectID;
		$PageID['EnableDisable'] = $_POST['EnableDisable'];
		$PageID['Status'] = $_POST['Status'];

		$Tier6Databases->ModulePass('XhtmlForm', 'form', 'updateFormOptionStatus', $PageID);
		$Tier6Databases->ModulePass('XhtmlForm', 'form', 'updateFormSelectStatus', $PageID);
		
		$FormOptionID = $Options['XhtmlTable']['table']['TablePageDeleteSelectPage']['SettingAttribute'];
		$Tier6Databases->ModulePass('XhtmlForm', 'form', 'updateFormOptionStatus', $PageID);
		$Tier6Databases->ModulePass('XhtmlForm', 'form', 'updateFormSelectStatus', $PageID);
		
		$EnableDisableTablesPage = $Options['XhtmlTable']['table']['TablePageEnableDisablePage']['SettingAttribute'];
		
		header("Location: $EnableDisableTablesPage");
	} else {
		$EnableDisableStatusChangeTablesPage = $Options['XhtmlTable']['table']['TablePageEnableDisableSelectPage']['SettingAttribute'];
		header("Location: ../../index.php?PageID=$EnableDisableStatusChangeTablesPage");
	}
?>