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

	$sessionname = $Tier6Databases->SessionStart('UpdateSimpleViewerPage');

	$Options = $Tier6Databases->getLayerModuleSetting();
	$SimpleViewerTableName = $Options['XhtmlSimpleViewer']['simpleviewer']['SimpleViewerTableName']['SettingAttribute'];
	
	$hold = $_POST['SimpleViewerPage'];
	$hold = explode(' ', $hold);
	$SelectedPageID = $hold[2];
	$SimpleViewerID = $hold[0];
	
	$_SESSION['POST']['FilteredInput']['PageID'] = $SelectedPageID;
	$_SESSION['POST']['FilteredInput']['FormOptionID'] = $SimpleViewerID;
	
	$PageID = array();
	$PageID['PageID'] = $SelectedPageID;
	$PageID['CurrentVersion'] = 'true';
	
	$SimpleViewerSelectedPageID = array();
	$SimpleViewerSelectedPageID['PageID'] = $SelectedPageID;
	$SimpleViewerSelectedPageID['CurrentVersion'] = 'true';
	
	$SimpleViewerTemp = $Tier6Databases->getRecord($SimpleViewerSelectedPageID, $SimpleViewerTableName, TRUE, array());
	
	$SimpleViewer = array();
	
	foreach ($SimpleViewerTemp as $Key => $Value) {
		if ($Value['SimpleViewerPageID'] != NULL) {
			$SimpleViewer[$Value['SimpleViewerPageID']] = $Value;
		}
	}
	
	$Content = $Tier6Databases->getRecord($PageID, 'Content', TRUE, array());
	$Header = $Tier6Databases->getRecord($PageID, 'PageAttributes', TRUE, array());;
	$ContentLayerVersion = $Tier6Databases->getRecord($PageID, 'ContentLayerVersion', TRUE, array());
	
	$_SESSION['POST']['FilteredInput']['SessionID'] = $sessionname;
	$_SESSION['POST']['FilteredInput']['RevisionID'] = $ContentLayerVersion[0]['RevisionID'];
	//$_SESSION['POST']['FilteredInput']['MenuObjectID'] = $ContentLayerVersion[0]['ContentPageMenuObjectID'];
	//$_SESSION['POST']['FilteredInput']['CreationDateTime'] = $ContentLayerVersion[0]['CreationDateTime'];
	//$_SESSION['POST']['FilteredInput']['Owner'] = $ContentLayerVersion[0]['Owner'];
	//$_SESSION['POST']['FilteredInput']['UserAccessGroup'] = $ContentLayerVersion[0]['UserAccessGroup'];
	
	unset($PageID['CurrentVersion']);
	$HeaderPanel1 = $Tier6Databases->getRecord($PageID, 'HeaderPanel1', TRUE, array());
	
	$Sitemap = $Tier6Databases->getRecord($PageID, 'XMLSitemap', TRUE, array());
	//$ContentPrintPreview = $Tier6Databases->getRecord($PageID, 'ContentPrintPreview', TRUE, array());
	
	$hold = array();
	$hold['PageID'] = 1;
	$hold['ObjectID'] = $SelectedPageID;
	//$MainMenuItemLookup = $Tier6Databases->getRecord($hold, 'MainMenuItemLookup', TRUE, array()); 
	
	$UpdateSelectPage = $Options['XhtmlSimpleViewer']['simpleviewer']['SimpleViewerPageUpdateSelectPage']['SettingAttribute'];
	$hold = array();
	$hold['PageID'] = $UpdateSelectPage;
	//$FormSelect = $Tier6Databases->getRecord($hold, 'AdministratorFormSelect', TRUE, array());
	$FormOptionTemp = $Tier6Databases->getRecord($hold, 'AdministratorFormOption', TRUE, array());
	
	$FormOption = array();
	foreach ($FormOptionTemp as $Key => $Value) {
		if ($Value['ObjectID'] != NULL) {
			$ObjectID = $Value['ObjectID'];
			$FormOption[$ObjectID] = $Value;
		}
	}
	
	$hold = array();
	$hold['Tag'] = 'h1';
	$hold['Content'] = $HeaderPanel1[1]['Div1'];
	$HeaderName = $Tier6Databases->ModulePass('XhtmlMenu', 'headerpanel1', 'removeTag', $hold);
	
	$_SESSION['POST']['FilteredInput']['PageTitle'] = $Header[0]['PageTitle'];
	
	if ($Header[0]['MetaNameContent1']) {
		$_SESSION['POST']['FilteredInput']['Keywords'] = $Header[0]['MetaNameContent1'];
	} else {
		$_SESSION['POST']['FilteredInput']['Keywords'] = 'NULL';
	}
	if ($Header[0]['MetaNameContent2']) {
		$_SESSION['POST']['FilteredInput']['Description'] = $Header[0]['MetaNameContent2'];
	} else {
		$_SESSION['POST']['FilteredInput']['Description'] = 'NULL';
	}
	
	$_SESSION['POST']['FilteredInput']['Header'] = $HeaderName;
	
	$_SESSION['POST']['FilteredInput']['Priority'] = $Sitemap[0]['Priority'];
	$_SESSION['POST']['FilteredInput']['Frequency'] = ucfirst($Sitemap[0]['ChangeFreq']);

	$_SESSION['POST']['FilteredInput']['MenuName'] = $ContentLayerVersion[0]['ContentPageMenuName'];
	$_SESSION['POST']['FilteredInput']['MenuTitle'] = $ContentLayerVersion[0]['ContentPageMenuTitle'];

	$_SESSION['POST']['FilteredInput']['EnableDisable'] = 'Enable';
	$_SESSION['POST']['FilteredInput']['Status'] = 'Approved';
	
	$Post = array();
	
	$i = 0;
	
	$Count = count($Content);
	
	if ($Count > 2) {
		$i = 1;
		$SimpleViewerSetHeading = "SimpleViewer$i" . '_Heading';
		$SimpleViewerSetTopText = "SimpleViewer$i" . '_TopText';
		
		$SimpleViewerSetBottomText = "SimpleViewer$i" . '_BottomText';
		$SimpleViewerSetName = "SimpleViewer$i" . '_Name';
		
		$Count = count($Content);
		$j = 0;
		$Record = $Content[$j];
		if ($Record['Heading'] && $Record['Content'] == NULL) {
			$j++;
		}
		
		for ($j; $j < $Count; $j++) {
			$Record = $Content[$j];
			if ($Record['EndTag'] == '</div>') {
				if ($Record['ContainerObjectType'] == 'XhtmlContent') {
					continue;
				}
			}
			
			if ($Record['Heading'] != NULL) {
				$Post[$SimpleViewerSetHeading] = $Record['Heading'];
			} else if (!isset($Post[$SimpleViewerSetHeading])){
				$Post[$SimpleViewerSetHeading] = 'NULL';
			}
			
			if ($Record['Content'] != NULL) {
				$Post[$SimpleViewerSetTopText] = $Record['Content'];
			} else if (!isset($Post[$SimpleViewerSetTopText])){
				$Post[$SimpleViewerSetTopText] = 'NULL';
			}
			
			if ($Record['Heading'] || $Record['Content']) {
				$j++;
				$Record = $Content[$j];
			}
			
			if ($Record['ContainerObjectType'] == 'XhtmlSimpleViewer') {
				$ObjectID = $Record['ContainerObjectID'];
				
				foreach ($SimpleViewer as $ID => $Value) {
					if ($Value['ObjectID'] == $ObjectID) {
						$SimpleViewerRecord = $Value;
						break;
					}
				}
				
				$SimpleViewerID = $SimpleViewerRecord['SimpleViewerPageID'];
				$Text = $SimpleViewerRecord['SimpleViewerMenuName'];
				$Post[$SimpleViewerSetName] = $SimpleViewerID . ' - ' . $Text;
				
				$j++;
				$OldRecord = $Record;
				$Record = $Content[$j];
			}
			
			if ($Record['Heading'] === NULL & $Record['Content'] !== NULL) {
				$Post[$SimpleViewerSetBottomText] = $Record['Content'];
			} else {
				$Post[$SimpleViewerSetBottomText] = "NULL";
			}
			
			$i++;
			
			if ($OldRecord['ContainerObjectType'] == 'XhtmlSimpleViewer') {
				if ($Post[$SimpleViewerSetBottomText] === "NULL") {
					$j--;
				}
			}
			
			$SimpleViewerSetHeading = "SimpleViewer$i" . '_Heading';
			$SimpleViewerSetTopText = "SimpleViewer$i" . '_TopText';
			
			$SimpleViewerSetBottomText = "SimpleViewer$i" . '_BottomText';
			$SimpleViewerSetName = "SimpleViewer$i" . '_Name';
		}
	}
	
	$SimpleViewerPage = array();
	$TempSimpleViewerPage = array();
	
	if ($Post != NULL) {
		foreach ($Post as $Key => $Value) {
			if (strstr($Key, "SimpleViewer")) {
				$TempSimpleViewerPage[$Key] = $Value;
			}
		}
		
	}
	
	foreach ($TempSimpleViewerPage as $Key => $Value) {
		$NewKey = explode('_', $Key);
		$SimpleViewerName = $NewKey[0];
		$SubKey = $NewKey[1];
		$SimpleViewerPage[$SimpleViewerName][$SubKey] = $Value;
	}

	$FileLocation = 'TEMPFILES/';
	
	$FileName = $FileLocation . $sessionname . '.xml';
	$FileDataForm = $SimpleViewerPage;
	$ElementName = 'SimpleViewer';
	
	$Tier6Databases->ProcessFormXMLFile($FileName, $FileDataForm, $ElementName);
	
	$UpdateSimpleViewerPage = $Options['XhtmlSimpleViewer']['simpleviewer']['SimpleViewerPageUpdatePage']['SettingAttribute'];
	
	header("Location: $UpdateSimpleViewerPage&SessionID=$sessionname");
	exit;
	
?>