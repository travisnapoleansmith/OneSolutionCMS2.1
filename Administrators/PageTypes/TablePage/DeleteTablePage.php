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
	
	$hold = $_POST['TablePage'];
	$hold = explode(' ', $hold);
	$PageID = $hold[2];
	$TableID = $hold[0];
	$DeleteTablePage = $_POST['DeleteTablePage'];
	
	$passarray = array();
	$passarray['PageID'] = $PageID;
	
	$FormOptionObjectID = $TableID;
	
	$Options = $Tier6Databases->getLayerModuleSetting();
	
	$XhtmlTableName = $Options['XhtmlTable']['table']['XhtmlTableName']['SettingAttribute'];
	
	if (!is_null($PageID)) {
		$TableContentPageID = array();
		$TableContentPageID['TableName'] = 'XhtmlTableLookup';
		$TableContentPageID['PageID'] = $PageID;
		$TableContentPageID['XhtmlTableName'] = $XhtmlTableName;
		$TableContentPageID['Enable/Disable'] = 'Disable';

		$Tier6Databases->ModulePass('XhtmlTable', 'table', 'deleteTableLookup', $TableContentPageID);
		
		$Tier6Databases->ModulePass('XhtmlPicture', 'picture', 'deletePicture', array('PageID' => $PageID));
		
		$Tier6Databases->ModulePass('XhtmlHeader', 'header', 'deleteHeader', array('PageID' => $PageID));
		$Tier6Databases->ModulePass('XhtmlMenu', 'headerpanel1', 'deleteMenu', array('PageID' => $PageID));
		$Tier6Databases->ModulePass('XhtmlContent', 'content', 'deleteContent', array('PageID' => $PageID));
		$Tier6Databases->ModulePass('XmlSitemap', 'sitemap', 'deleteSitemapItem', array('PageID' => $PageID));
		$Tier6Databases->ModulePass('XhtmlContent', 'content', 'deleteContentPrintPreview', array('PageID' => $PageID));
		$Tier6Databases->deleteContent(array('PageID' => $PageID), 'ContentLayer');
		
		$FormOptionID = $Options['XhtmlTable']['table']['TablePageUpdateSelectPage']['SettingAttribute'];
		$Tier6Databases->ModulePass('XhtmlForm', 'form', 'deleteFormOption', array('PageID' => $FormOptionID, 'ObjectID' => $FormOptionObjectID));
		$Tier6Databases->ModulePass('XhtmlForm', 'form', 'deleteFormSelect', array('PageID' => $FormOptionID, 'ObjectID' => $FormOptionObjectID));

		$FormOptionID = $Options['XhtmlTable']['table']['TablePageDeleteSelectPage']['SettingAttribute'];
		$Tier6Databases->ModulePass('XhtmlForm', 'form', 'deleteFormOption', array('PageID' => $FormOptionID, 'ObjectID' => $FormOptionObjectID));
		$Tier6Databases->ModulePass('XhtmlForm', 'form', 'deleteFormSelect', array('PageID' => $FormOptionID, 'ObjectID' => $FormOptionObjectID));

		$DeletedTablesPage = $Options['XhtmlTable']['table']['TablePageDeletePage']['SettingAttribute'];
		header("Location: $DeletedTablesPage");
		
	} else {
		$DeleteTablesPage = $Options['XhtmlTable']['table']['TablePageDeleteSelectPage']['SettingAttribute'];
		header("Location: ../../index.php?PageID=$DeleteTablesPage");
	}
?>