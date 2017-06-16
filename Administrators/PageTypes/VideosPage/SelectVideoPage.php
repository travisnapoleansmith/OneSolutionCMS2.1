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

	$sessionname = $Tier6Databases->SessionStart('UpdateVideoPage');

	$Options = $Tier6Databases->getLayerModuleSetting();
	
	$hold = $_POST['VideosPage'];
	$hold = explode(' ', $hold);
	$SelectedPageID = $hold[2];
	$VideoID = $hold[0];
	
	$_SESSION['POST']['FilteredInput']['PageID'] = $SelectedPageID;
	$_SESSION['POST']['FilteredInput']['FormOptionID'] = $VideoID;
	
	$PageID = array();
	$PageID['PageID'] = $SelectedPageID;
	$PageID['CurrentVersion'] = 'true';
	
	$Content = $Tier6Databases->getRecord($PageID, 'Content', TRUE, array());
	$Header = $Tier6Databases->getRecord($PageID, 'PageAttributes', TRUE, array());;
	$ContentLayerVersion = $Tier6Databases->getRecord($PageID, 'ContentLayerVersion', TRUE, array());
	
	$_SESSION['POST']['FilteredInput']['SessionID'] = $sessionname;
	$_SESSION['POST']['FilteredInput']['RevisionID'] = $ContentLayerVersion[0]['RevisionID'];
	//$_SESSION['POST']['FilteredInput']['MenuObjectID'] = $ContentLayerVersion[0]['ContentPageMenuObjectID'];
	//$_SESSION['POST']['FilteredInput']['CreationDateTime'] = $ContentLayerVersion[0]['CreationDateTime'];
	//$_SESSION['POST']['FilteredInput']['Owner'] = $ContentLayerVersion[0]['Owner'];
	//$_SESSION['POST']['FilteredInput']['UserAccessGroup'] = $ContentLayerVersion[0]['UserAccessGroup'];
	
	$VideoSelectedPageID = array();
	$VideoSelectedPageID['PageID'] = $SelectedPageID;
	$VideoSelectedPageID['RevisionID'] = $ContentLayerVersion[0]['RevisionID'];
	$VideoSelectedPageID['CurrentVersion'] = 'true';
	
	$Video = $Tier6Databases->getRecord($VideoSelectedPageID, 'Flash', TRUE, array());
	
	
	
	unset($PageID['CurrentVersion']);
	$HeaderPanel1 = $Tier6Databases->getRecord($PageID, 'HeaderPanel1', TRUE, array());
	
	$Sitemap = $Tier6Databases->getRecord($PageID, 'XMLSitemap', TRUE, array());
	//$ContentPrintPreview = $Tier6Databases->getRecord($PageID, 'ContentPrintPreview', TRUE, array());
	
	$hold = array();
	$hold['PageID'] = 1;
	$hold['ObjectID'] = $SelectedPageID;
	
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
	
	$_SESSION['POST']['FilteredInput']['Priority'] = $Sitemap[0]['Priority'] * 10;
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
		$VideoHeading = "Content$i" . '_Heading';
		$VideoTopText = "Content$i" . '_TopText';
		$VideoSource = "Content$i";
		$NoFlashText = "Content$i";
		$FlashVarsText = "Content$i";
		$VideoBottomText = "Content$i" . '_BottomText';
		
		$Count = count($Content);
		$j = NULL;
		$k = 1;
		$j = 1;
		for ($j = 1; $j < $Count; $j++) {
			$Record = $Content[$j];
			if ($Record['EndTag'] == '</div>') {
				$i++;
				$k = 1;
				
				$VideoHeading = "Content$i" . '_Heading';
				$VideoTopText = "Content$i" . '_TopText';
				$VideoSource = "Content$i";
				$NoFlashText = "Content$i";
				$FlashVarsText = "Content$i";
				$VideoBottomText = "Content$i" . '_BottomText';
				continue;
			}
			
			if ($Record['Heading'] != NULL) {
				$Post[$VideoHeading] = $Record['Heading'];
			} else {
				$Post[$VideoHeading] = 'NULL';
			}
			
			if ($Record['Content'] != NULL) {
				$Post[$VideoTopText] = $Record['Content'];
			} else {
				$Post[$VideoTopText] = 'NULL';
			}
			
			if ($Record['Content'] != NULL || $Record['Heading'] != NULL) {
				$j++;
				$Record = $Content[$j];
			}
			
			while ($Record['ContainerObjectType'] == 'XhtmlFlash') {
				$id = $Record['ContainerObjectID'];
				$id--;
				$Flash = $Video[$id];
				$VideoSource = $VideoSource . "_Video" . $k . "_VideoLocation"; 
				$NoFlashText = $NoFlashText . "_Video" . $k . "_NoFlashText";
				$FlashVarsText = $FlashVarsText . "_Video" . $k . "_FlashVarsText";
				if ($Flash['FlashPath'] != NULL) {
					$Post[$VideoSource] = $Flash['FlashPath'];
				} else {
					$Post[$VideoSource] = 'NULL';
				}
				
				if ($Flash['FlashVarsDescription'] != NULL) {
					$Post[$FlashVarsText] = $Flash['FlashVarsDescription'];
				} else {
					$Post[$FlashVarsText] = 'NULL';
				}
				
				if ($Flash['AltText'] != NULL) {
					$Post[$NoFlashText] = $Flash['AltText'];
				} else {
					$Post[$NoFlashText] = 'NULL';
				}
				$k++;
				$j++;
				$VideoSource = "Content$i";
				$NoFlashText = "Content$i";
				$FlashVarsText = "Content$i";
				
				$Record = $Content[$j];
			}
			
			if ($Record['Content'] != NULL) {
				$Post[$VideoBottomText] = $Record['Content'];
			} else {
				$Post[$VideoBottomText] = "NULL";
			}
			
			
			$i++;
			$k = 1;
			
			$VideoHeading = "Content$i" . '_Heading';
			$VideoTopText = "Content$i" . '_TopText';
			$VideoSource = "Content$i";
			$NoFlashText = "Content$i";
			$FlashVarsText = "Content$i";
			$VideoBottomText = "Content$i" . '_BottomText';
		}
	}
	
	$VideoContent = array();
	$TempVideoContent = array();
	
	foreach ($Post as $Key => $Value) {
		if (strstr($Key, "Content")) {
			$TempVideoContent[$Key] = $Value;
		}
	}
	
	foreach ($TempVideoContent as $Key => $Value) {
		$NewKey = explode('_', $Key);
		$VideoName = $NewKey[0];
		$SubKey = $NewKey[1];
		if (strstr($SubKey, 'Video')) {
			$SubSubKey = $NewKey[2];
			if ($SubSubKey === 'NoFlashText') {
				$Value = str_replace("\'", "", $Value);
				$VideoContent[$VideoName][$SubKey][$SubSubKey] = $Value;
			} else {
				$VideoContent[$VideoName][$SubKey][$SubSubKey] = $Value;
			}
		} else {
			$VideoContent[$VideoName][$SubKey] = $Value;
		}
	}
	unset ($TempVideoContent);
	
	$FileLocation = 'TEMPFILES/';
	
	$FileName = $FileLocation . $sessionname . '.xml';
	$FileDataForm = $VideoContent;
	$ElementName = 'Data';
	
	$Tier6Databases->ProcessFormXMLFile($FileName, $FileDataForm, $ElementName);
	
	$UpdateVideosPage = $Options['XhtmlContent']['content']['UpdateVideosPage']['SettingAttribute'];
	
	header("Location: $UpdateVideosPage&SessionID=$sessionname");
	exit;
?>