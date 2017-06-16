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

	$GalleryID = $_POST['SimpleViewerGallery'];
	$FormOptionObjectID = $GalleryID;
	
	$passarray = array();
	$passarray['PageID'] = $GalleryID;
	$passarray['ObjectID'] = 1;
	$passarray['CurrentVersion'] = 'true';
	$GallerySelected = $Tier6Databases->getRecord($passarray, 'XMLSimpleViewerLookup', TRUE, array());
	
	$Options = $Tier6Databases->getLayerModuleSetting();
	
	if (!is_null($GalleryID)) {
		$Flash = array();
		$Flash['PageID'] = $GalleryID;
		
		$GalleryUrl = "/Modules/Tier6ContentLayer/User/XhtmlSimpleViewer/XmlSimpleViewer.php?PageID=";
		$GalleryUrl .= $NewSimpleViewerGallery;
		$GalleryUrl .= '%26ObjectID=';
		$GalleryUrl .= 1;
		
		$PageID = array();
		$PageID['PageID'] = $GalleryID;
		$PageID['ObjectID'] = 1;
		$PageID['RevisionID'] = 1;
		$PageID['CurrentVersion'] = 'true';
		
		$FlashDatabase = Array();
		$FlashDatabase['Flash'] = 'FlashSimpleViewer';
		
		$DatabaseOptions = Array();
		$DatabaseOptions['FlashVars'] = array();
		$DatabaseOptions['FlashVars']['GalleryUrl']['value']['galleryURL'] = $GalleryUrl;
		
		$FlashObject = new XhtmlFlash($FlashDatabase, $DatabaseOptions, $Tier6Databases);
		$FlashObject->setDatabaseAll($credentaillogonarray[0], $credentaillogonarray[1], $credentaillogonarray[2], $credentaillogonarray[3], 'FlashSimpleViewer');
		$FlashObject->setHttpUserAgent($_SERVER['HTTP_USER_AGENT']);
		$FlashObject->FetchDatabase($PageID);
		
		$Flash['OBJECT'] = $FlashObject;
		
		$Tier6Databases->ModulePass('XhtmlSimpleViewer', 'simpleviewer', 'deleteFlash', $Flash);
		unset($Flash['OBJECT']);
		unset($FlashObject);
		
		$FlashDatabase = Array();
		$FlashDatabase['XMLSimpleViewerLookup'] = 'XMLSimpleViewerLookup';
		
		$DatabaseOptions = Array();
		
		$SimpleViewerObject = new XmlSimpleViewer ($FlashDatabase, $DatabaseOptions, $Tier6Databases);
		$SimpleViewerObject->setDatabaseAll ($credentaillogonarray[0], $credentaillogonarray[1], $credentaillogonarray[2], $credentaillogonarray[3], 'XMLSimpleViewerLookup');
		$SimpleViewerObject->setHttpUserAgent($_SERVER['HTTP_USER_AGENT']);
		
		$SimpleViewerObject->deleteLookupGallery($Flash);
		
		$SimpleViewerObject->FetchDatabase ($PageID);
		//$SimpleViewerObject->CreateOutput('    ');
		
		$SimpleViewerObject->deleteGallery($Flash);
		
		$FormOptionID = $Options['XhtmlSimpleViewer']['simpleviewer']['SimpleViewerGalleyUpdateSelectPage']['SettingAttribute'];
		
		$Tier6Databases->ModulePass('XhtmlForm', 'form', 'deleteFormOption', array('PageID' => $FormOptionID, 'ObjectID' => $FormOptionObjectID));
		$Tier6Databases->ModulePass('XhtmlForm', 'form', 'deleteFormSelect', array('PageID' => $FormOptionID, 'ObjectID' => $FormOptionObjectID));

		$FormOptionID = $Options['XhtmlSimpleViewer']['simpleviewer']['SimpleViewerGalleyDeleteSelectPage']['SettingAttribute'];
		$Tier6Databases->ModulePass('XhtmlForm', 'form', 'deleteFormOption', array('PageID' => $FormOptionID, 'ObjectID' => $FormOptionObjectID));
		$Tier6Databases->ModulePass('XhtmlForm', 'form', 'deleteFormSelect', array('PageID' => $FormOptionID, 'ObjectID' => $FormOptionObjectID));

		$SimpleViewerGalleyDeletePage = $Options['XhtmlSimpleViewer']['simpleviewer']['SimpleViewerGalleyDeletePage']['SettingAttribute'];
		header("Location: $SimpleViewerGalleyDeletePage");
	} else {
		$SimpleViewerGalleyDeleteSelectPage = $Options['XhtmlSimpleViewer']['simpleviewer']['SimpleViewerGalleyDeleteSelectPage']['SettingAttribute'];
		header("Location: ../../index.php?PageID=$SimpleViewerGalleyDeleteSelectPage");
	}

?>