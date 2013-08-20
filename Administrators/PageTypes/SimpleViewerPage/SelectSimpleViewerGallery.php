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
	
	set_time_limit(120);
	
	$ReferPage = $_SERVER['HTTP_REFERER'];
	$ReferPageIDArray = explode('?', $ReferPage);
	unset($ReferPageIDArray[0]);
	$ReferPageIDArray = implode('', $ReferPageIDArray);
	$ReferPageIDArray = explode('&', $ReferPageIDArray);
	$Key = array_search('PageID', $ReferPageIDArray);
	$ReferPageID = $ReferPageIDArray[$Key];
	
	if ($ReferPageID === 'PageID=222') {
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
	
		$sessionname = $Tier6Databases->SessionStart('UpdateSimpleViewerGallery');
	
		$Options = $Tier6Databases->getLayerModuleSetting();
		
		$GalleryID = $_POST['SimpleViewerGallery'];
		
		$passarray = array();
		$passarray['PageID'] = $GalleryID;
		$passarray['ObjectID'] = 1;
		$passarray['CurrentVersion'] = 'true';
		$GallerySelected = $Tier6Databases->getRecord($passarray, 'XMLSimpleViewerLookup', TRUE, array());
		
		$RevisionID = $GallerySelected[0]['RevisionID'];
		$GalleryName = $GallerySelected[0]['XMLSimpleViewerName'];
		$GalleryHeading = $GallerySelected[0]['XMLSimpleViewerTitle'];
		$EnableDisable = $GallerySelected[0]['Enable/Disable'];
		$Status = $GallerySelected[0]['Status'];
		
		$_SESSION['POST']['FilteredInput']['GalleryID'] = $GalleryID . ' - ' . $RevisionID;
		$_POST['GalleryID'] = $GalleryID . ' - ' . $RevisionID;
		
		$_SESSION['POST']['FilteredInput']['GalleryName'] = $GalleryName;
		$_POST['GalleryName'] = $GalleryName;
		
		$_SESSION['POST']['FilteredInput']['GalleryHeading'] = $GalleryHeading;
		$_POST['GalleryHeading'] = $GalleryHeading;
		
		$_SESSION['POST']['FilteredInput']['EnableDisable'] = $EnableDisable;
		$_POST['EnableDisable'] = $EnableDisable;
		
		$_SESSION['POST']['FilteredInput']['Status'] = $Status;
		$_POST['Status'] = $Status;
		
		/*$XhtmlTableName = $Options['XhtmlTable']['table']['XhtmlTableName']['SettingAttribute'];
	
		$TableID = $_POST['TableContent'];
		$passarray = array();
		$passarray['XhtmlTableID'] = $TableID;
		$passarray['XhtmlTableName'] = $XhtmlTableName;
	
		$TableSelected = $Tier6Databases->getRecord($passarray, 'XhtmlTableListing', TRUE, array());
	
		$TableName = $TableSelected[0]['TableName'];
		$TableHeading = $TableSelected[0]['TableTitle'];
		$EnableDisable = $TableSelected[0]['Enable/Disable'];
		$Status = $TableSelected[0]['Status'];
	
		$_SESSION['POST']['FilteredInput']['TableName'] = $TableName;
		$_SESSION['POST']['FilteredInput']['TableHeading'] = $TableHeading;
		$_SESSION['POST']['FilteredInput']['EnableDisable'] = $EnableDisable;
		$_SESSION['POST']['FilteredInput']['Status'] = $Status;
		$_SESSION['POST']['FilteredInput']['TableID'] = $TableID;
	
		$_POST['TableID'] = $TableID;
		$_POST['TableName'] = $TableName;
		$_POST['TableHeading'] = $TableHeading;
		$_POST['EnableDisable'] = $EnableDisable;
		$_POST['Status'] = $Status;
		*/
		$SimpleViewerGalleyUpdatePage = $Options['XhtmlSimpleViewer']['simpleviewer']['SimpleViewerGalleyUpdatePage']['SettingAttribute'];
	
		header("Location: $SimpleViewerGalleyUpdatePage&SessionID=$sessionname&GalleryID=$GalleryID");
		
		print_r($_POST);
	}
?>