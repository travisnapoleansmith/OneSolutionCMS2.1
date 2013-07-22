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
	
	$sessionname = NULL;
	$sessionname = $_COOKIE['SessionID'];
	session_name($sessionname);
	session_start();	
	
	$PageID = array();
	$PageID['PageID'] = $_POST['PageID'];
	$PageID['CurrentVersion'] = 'true';
	$ContentLayerVersion = $Tier6Databases->getRecord($PageID, 'ContentLayerVersion', TRUE, array());
	
	$PageID = $_POST['PageID'];
	$FormOptionObjectID = $_POST['FormOptionID'];
	$RevisionID = $_POST['RevisionID'];
	
	$MenuObjectID = $ContentLayerVersion[0]['ContentPageMenuObjectID'];
	$CreationDateTime = $ContentLayerVersion[0]['CreationDateTime'];
	$Owner = $ContentLayerVersion[0]['Owner'];
	$UserAccessGroup = $ContentLayerVersion[0]['UserAccessGroup'];

	$NewRevisionID = $RevisionID + 1;

	if ($MenuObjectID === NULL) {
		$MenuObjectID = 1;
	}
	
	$_POST['PageID'] = $PageID;
	//$_POST['FormOptionObjectID'] = $FormOptionObjectID;
	$_POST['RevisionID'] = $RevisionID;
	$_POST['CreationDateTime'] = $CreationDateTime;
	$_POST['Owner'] = $Owner;
	$_POST['UserAccessGroup'] = $UserAccessGroup;
	
	$Options = $Tier6Databases->getLayerModuleSetting();
	
	
	$PageTitle = $_POST['PageTitle'];
	$Keywords = $_POST['Keywords'];
	$Description = $_POST['Description'];
	$Header = $_POST['Header'];

	$MenuName = $_POST['MenuName'];
	$MenuTitle = $_POST['MenuTitle'];
	$Priority = $_POST['Priority'];
	$Frequency = $_POST['Frequency'];
	$EnableDisable = $_POST['EnableDisable'];
	$Status = $_POST['Status'];

	$PageName = "../../index.php?PageID=";
	$PageName .= $_POST['UpdateVideoPage'];

	$FileLocation = 'TEMPFILES/';

	$TempVideo = array();
	$Video = array();
	$AddLookupData = array();
	
	foreach ($_POST as $Key => $Value) {
		if ($Key !== 'UpdateVideoPage') {
			if (strstr($Key, "Content")) {
				$TempVideo[$Key] = $Value;
				$AddLookupData[$Key] = $Value;
			}
		}
	}
	
	foreach ($TempVideo as $Key => $Value) {
		$NewKey = explode('_', $Key);
		$VideoName = $NewKey[0];
		$SubKey = $NewKey[1];
		if (strstr($SubKey, 'Video')) {
			$SubSubKey = $NewKey[2];
			if ($SubSubKey === 'NoFlashText') {
				$Value = str_replace("\'", "'", $Value);
				$Value = str_replace('\"', '"', $Value);
				$Video[$VideoName][$SubKey][$SubSubKey] = $Value;
			} else {
				$Video[$VideoName][$SubKey][$SubSubKey] = $Value;
			}
		} else {
			$Video[$VideoName][$SubKey] = $Value;
		}
	}
	
	if (!is_null($PageID) && !is_null($RevisionID) && !is_null($CreationDateTime) && !is_null($Owner) && !is_null($UserAccessGroup)) {
		$hold = $Tier6Databases->FormSubmitValidate('UpdateVideoPage', $PageName, $FileLocation, $Video, 'Data', $AddLookupData);
		
		if ($hold) {
			$_SESSION['POST'] = $_POST;
			$DateTime = date('Y-m-d H:i:s');
			$Date = date('Y-m-d');
			$SiteName = $GLOBALS['sitename'];
			
			$NewPageID = $PageID;

			$NewPage = '../../../index.php?PageID=';
			$NewPage .= $PageID;

			$Location = '../../index.php?PageID=';
			$Location .= $PageID;
			
			// POST Check For NULL Elements
			$temp = $Tier6Databases->PostCheck ('Heading', 'FilteredInput', $hold);
			if (!is_null($temp)) {
				$hold = $temp;
			}
			
			$temp = $Tier6Databases->PostCheck ('Keywords', 'FilteredInput', $hold);
			if (!is_null($temp)) {
				$hold = $temp;
			}
			
			$temp = $Tier6Databases->PostCheck ('Description', 'FilteredInput', $hold);
			if (!is_null($temp)) {
				$hold = $temp;
			}
			
			// Video Page Content - Post Checking For NULL Elements
			$temp = $Tier6Databases->MultiPostCheck('Content', 1, $hold, '_', NULL, 'Heading');
			if ($temp != NULL) {
				$hold = $temp;
			}
			
			$temp = $Tier6Databases->MultiPostCheck('Content', 1, $hold, '_', NULL, 'TopText');
			if ($temp != NULL) {
				$hold = $temp;
			}
			
			$temp = $Tier6Databases->MultiPostCheck('Content', 1, $hold, '_', NULL, 'Video', 1, '_', 1, 'VideoLocation');
			if ($temp != NULL) {
				$hold = $temp;
			}
			
			$temp = $Tier6Databases->MultiPostCheck('Content', 1, $hold, '_', NULL, 'Video', 1, '_', 1, 'FlashVarsText');
			if ($temp != NULL) {
				$hold = $temp;
			}
			
			$temp = $Tier6Databases->MultiPostCheck('Content', 1, $hold, '_', NULL, 'Video', 1, '_', 1, 'NoFlashText');
			if ($temp != NULL) {
				$hold = $temp;
			}
			
			$temp = $Tier6Databases->MultiPostCheck('Content', 1, $hold, '_', NULL, 'BottomText');
			if ($temp != NULL) {
				$hold = $temp;
			}
			
			// Menu Information - Post Checking For NULL Elements
			$temp = $Tier6Databases->PostCheck ('MenuName', 'FilteredInput', $hold);
			if (!is_null($temp)) {
				$hold = $temp;
			}
			
			$temp = $Tier6Databases->PostCheck ('MenuTitle', 'FilteredInput', $hold);
			if (!is_null($temp)) {
				$hold = $temp;
			}
			
			$_SESSION['POST']['Error']['Link'] = '<a href=\'';
			$_SESSION['POST']['Error']['Link'] .= $NewPage;
			$_SESSION['POST']['Error']['Link'] .= '\'>Updated Video Page</a>';
			
			// VIDEOS DATA
			$TempVideo = array();
			$Video = array();
			
			foreach ($_POST as $Key => $Value) {
				if ($Key !== 'UpdateVideoPage') {
					if (strstr($Key, "Content")) {
						$Value = str_replace("\'", "'", $Value);
						$Value = str_replace('\"', '"', $Value);
						$TempVideo[$Key] = $Value;
					}
				}
			}
			
			foreach ($TempVideo as $Key => $Value) {
				$NewKey = explode('_', $Key);
				$VideoName = $NewKey[0];
				$SubKey = $NewKey[1];
				if (strstr($SubKey, 'Video')) {
					$SubSubKey = $NewKey[2];
					if ($SubSubKey === 'NoFlashText') {
						$Value = str_replace("\'", "'", $Value);
						$Value = str_replace('\"', '"', $Value);
						$Video[$VideoName][$SubKey][$SubSubKey] = $Value;
					} else {
						$Video[$VideoName][$SubKey][$SubSubKey] = $Value;
					}
				} else {
					$Video[$VideoName][$SubKey] = $Value;
				}
			}
			
			// General Defines
			define(NewPageID, $NewPageID);
			define(NewRevisionID, $NewRevisionID);
			define(CurrentVersionTrueFalse, 'true');
			define(ContentPageType, 'VideosPage');
	
			define(ContentPageMenuName, $hold['FilteredInput']['MenuName']);
			define(ContentPageMenuTitle, $hold['FilteredInput']['MenuTitle']);
	
			define(UserAccessGroup, 'Guest');
			define(Owner, $_COOKIE['UserName']);
			define(Creator, $_COOKIE['UserName']);
			define(LastChangeUser, $_COOKIE['UserName']);
			define(CreationDateTime, $DateTime);
			define(LastChangeDateTime, $DateTime);
	
			define(PublishDate, NULL);
			define(UnpublishDate, NULL);
	
			define(EnableDisable, $_POST['EnableDisable']);
			define(Status, $_POST['Status']);
	
			// XmlSitemap Defines
			define(Loc, $Location);
			define(Lastmod, $Date);
			define(ChangeFreq, $_POST['Frequency']);
			define(Priority, $_POST['Priority']);
	
			// XhtmlHeader Defines
			define(PageTitle, $hold['FilteredInput']['PageTitle']);
			define(PageIcon, 'favicon.ico');
			define(RSS, 'rss.php');
			define(Keywords, $hold['FilteredInput']['Keywords']);
			define(Description, $hold['FilteredInput']['Description']);
	
			// HeaderPanel1 Defines
			define (SiteName, $GLOBALS['sitename']);
			define (Header, $hold['FilteredInput']['Header']);
			
			$PageID = array();
			$PageID['PageID'] = $NewPageID;
	
			$i = 0;
	
			$Content[$i]['PageID'] = $NewPageID;
			$Content[$i]['ObjectID'] = 0;
			$Content[$i]['ContainerObjectType'] = 'XhtmlContent';
			$Content[$i]['ContainerObjectName'] = 'content';
			$Content[$i]['ContainerObjectID'] = 1;
			$Content[$i]['ContainerObjectPrintPreview'] = 'true';
			$Content[$i]['RevisionID'] = $NewRevisionID;
			$Content[$i]['CurrentVersion'] = 'true';
			$Content[$i]['Empty'] = 'false';
			$Content[$i]['StartTag'] = '<div>';
			$Content[$i]['EndTag'] = NULL;
			$Content[$i]['StartTagID'] = 'main-content-middle';
			$Content[$i]['StartTagStyle'] = NULL;
			$Content[$i]['StartTagClass'] = NULL;
			if ($hold['FilteredInput']['Header'] != NULL) {
				$Content[$i]['Heading'] = $hold['FilteredInput']['Header'];
				$Content[$i]['HeadingStartTag'] = '<h2>';
				$Content[$i]['HeadingEndTag'] = '</h2>';
				$Content[$i]['HeadingStartTagID'] = NULL;
				$Content[$i]['HeadingStartTagStyle'] = NULL;
				$Content[$i]['HeadingStartTagClass'] = 'BodyHeading';
			} else {
				$Content[$i]['Heading'] = NULL;
				$Content[$i]['HeadingStartTag'] = NULL;
				$Content[$i]['HeadingEndTag'] = NULL;
				$Content[$i]['HeadingStartTagID'] = NULL;
				$Content[$i]['HeadingStartTagStyle'] = NULL;
				$Content[$i]['HeadingStartTagClass'] = NULL;
			}
	
			if ($hold['FilteredInput']['TopText'] != NULL) {
				$Content[$i]['Content'] = $hold['FilteredInput']['TopText'];
				$Content[$i]['ContentStartTag'] = '<p>';
				$Content[$i]['ContentEndTag'] = '</p>';
				$Content[$i]['ContentStartTagID'] = NULL;
				$Content[$i]['ContentStartTagStyle'] = NULL;
				$Content[$i]['ContentStartTagClass'] = 'BodyText';
				$Content[$i]['ContentPTagID'] = NULL;
				$Content[$i]['ContentPTagStyle'] = NULL;
				$Content[$i]['ContentPTagClass'] = 'BodyText';
			} else {
				$Content[$i]['Content'] = NULL;
				$Content[$i]['ContentStartTag'] = NULL;
				$Content[$i]['ContentEndTag'] = NULL;
				$Content[$i]['ContentStartTagID'] = NULL;
				$Content[$i]['ContentStartTagStyle'] = NULL;
				$Content[$i]['ContentStartTagClass'] = NULL;
				$Content[$i]['ContentPTagID'] = NULL;
				$Content[$i]['ContentPTagStyle'] = NULL;
				$Content[$i]['ContentPTagClass'] = NULL;
			}
	
			$Content[$i]['Enable/Disable'] = $_POST['EnableDisable'];
			$Content[$i]['Status'] = $_POST['Status'];
			
			$i++;
			
			$k = $i;
			$k++;

			// CONTENT Page
			$VideoID = 1;
			
			$VideoContent = array();
			
			if ($Video !== NULL) {
				foreach($Video as $Key => $Value) {
					if ($Value !== NULL) {
						// Heading and TopText
						if ($Value['Heading'] !== NULL || $Value['TopText'] !== NULL){
							$Content[$i]['PageID'] = $NewPageID;
							$Content[$i]['ObjectID'] = $i;
							$Content[$i]['ContainerObjectType'] = 'XhtmlContent';
							$Content[$i]['ContainerObjectName'] = 'content';
							$Content[$i]['ContainerObjectID'] = $k;
							$Content[$i]['ContainerObjectPrintPreview'] = 'true';
							$Content[$i]['RevisionID'] = $NewRevisionID;
							$Content[$i]['CurrentVersion'] = 'true';
							$Content[$i]['Empty'] = 'false';
							$Content[$i]['StartTag'] = NULL;
							$Content[$i]['EndTag'] = NULL;
							$Content[$i]['StartTagID'] = NULL;
							$Content[$i]['StartTagStyle'] = NULL;
							$Content[$i]['StartTagClass'] = NULL;
							if ($Value['Heading'] !== NULL) {
								$Content[$i]['Heading'] = $Value['Heading'];
								$Content[$i]['HeadingStartTag'] = '<h2>';
								$Content[$i]['HeadingEndTag'] = '</h2>';
								$Content[$i]['HeadingStartTagID'] = NULL;
								$Content[$i]['HeadingStartTagStyle'] = NULL;
								$Content[$i]['HeadingStartTagClass'] = 'BodyHeading';
							} else {
								$Content[$i]['Heading'] = NULL;
								$Content[$i]['HeadingStartTag'] = NULL;
								$Content[$i]['HeadingEndTag'] = NULL;
								$Content[$i]['HeadingStartTagID'] = NULL;
								$Content[$i]['HeadingStartTagStyle'] = NULL;
								$Content[$i]['HeadingStartTagClass'] = NULL;
							}
	
							if ($Value['TopText'] !== NULL) {
								$Content[$i]['Content'] = $Value['TopText'];
								$Content[$i]['ContentStartTag'] = '<p>';
								$Content[$i]['ContentEndTag'] = '</p>';
								$Content[$i]['ContentStartTagID'] = NULL;
								$Content[$i]['ContentStartTagStyle'] = NULL;
								$Content[$i]['ContentStartTagClass'] = 'BodyText';
								$Content[$i]['ContentPTagID'] = NULL;
								$Content[$i]['ContentPTagStyle'] = NULL;
								$Content[$i]['ContentPTagClass'] = 'BodyText';
							} else {
								$Content[$i]['Content'] = NULL;
								$Content[$i]['ContentStartTag'] = NULL;
								$Content[$i]['ContentEndTag'] = NULL;
								$Content[$i]['ContentStartTagID'] = NULL;
								$Content[$i]['ContentStartTagStyle'] = NULL;
								$Content[$i]['ContentStartTagClass'] = NULL;
								$Content[$i]['ContentPTagID'] = NULL;
								$Content[$i]['ContentPTagStyle'] = NULL;
								$Content[$i]['ContentPTagClass'] = NULL;
							}
	
							$Content[$i]['Enable/Disable'] = $_POST['EnableDisable'];
							$Content[$i]['Status'] = $_POST['Status'];
							$i++;
							$k++;
						}
						
						
						// Video Content
						if ($Value['Video1'] != NULL) {
							$j = 1;
							$LookupTemp = 'Video' . $j;
							
							$VideoLocation = $Value[$LookupTemp]['VideoLocation'];
							$NoFlashTest = $Value[$LookupTemp]['NoFlashText'];
							$FlashVarsText = $Value[$LookupTemp]['FlashVarsText'];
							
							$Content[$i]['PageID'] = $NewPageID;
							$Content[$i]['ObjectID'] = $i;
							$Content[$i]['ContainerObjectType'] = 'XhtmlFlash';
							$Content[$i]['ContainerObjectName'] = 'flash';
							$Content[$i]['ContainerObjectID'] = $VideoID;
							$Content[$i]['ContainerObjectPrintPreview'] = 'true';
							$Content[$i]['RevisionID'] = $NewRevisionID;
							$Content[$i]['CurrentVersion'] = 'true';
							$Content[$i]['Empty'] = 'false';
							$Content[$i]['StartTag'] = NULL;
							$Content[$i]['EndTag'] = NULL;
							$Content[$i]['StartTagID'] = NULL;
							$Content[$i]['StartTagStyle'] = NULL;
							$Content[$i]['StartTagClass'] = NULL;
	
							$Content[$i]['Heading'] = NULL;
							$Content[$i]['HeadingStartTag'] = NULL;
							$Content[$i]['HeadingEndTag'] = NULL;
							$Content[$i]['HeadingStartTagID'] = NULL;
							$Content[$i]['HeadingStartTagStyle'] = NULL;
							$Content[$i]['HeadingStartTagClass'] = NULL;
	
							$Content[$i]['Content'] = NULL;
							$Content[$i]['ContentStartTag'] = NULL;
							$Content[$i]['ContentEndTag'] = NULL;
							$Content[$i]['ContentStartTagID'] = NULL;
							$Content[$i]['ContentStartTagStyle'] = NULL;
							$Content[$i]['ContentStartTagClass'] = NULL;
							$Content[$i]['ContentPTagID'] = NULL;
							$Content[$i]['ContentPTagStyle'] = NULL;
							$Content[$i]['ContentPTagClass'] = NULL;
		
							$Content[$i]['Enable/Disable'] = $_POST['EnableDisable'];
							$Content[$i]['Status'] = $_POST['Status'];
								
							$VideoContent[$VideoID]['PageID'] = $NewPageID;
							$VideoContent[$VideoID]['ObjectID'] = $VideoID;
							$VideoContent[$VideoID]['RevisionID'] = $NewRevisionID;
							$VideoContent[$VideoID]['CurrentVersion'] = 'true';
							$VideoContent[$VideoID]['FlashPath'] = $VideoLocation;
							$VideoContent[$VideoID]['Width'] = 480;
							$VideoContent[$VideoID]['Height'] = 390;
							$VideoContent[$VideoID]['Wmode'] = 'opaque';
							$VideoContent[$VideoID]['AllowFullScreen'] = 'true';
							$VideoContent[$VideoID]['AllowScriptAccess'] = 'true';
							$VideoContent[$VideoID]['Quality'] = NULL;
							$VideoContent[$VideoID]['FlashVarsAuthor'] = NULL;
							$VideoContent[$VideoID]['FlashVarsDate'] = NULL;
							$VideoContent[$VideoID]['FlashVarsDescription'] = $FlashVarsText;
							$VideoContent[$VideoID]['FlashVarsDuration'] = NULL;
							$VideoContent[$VideoID]['FlashVarsFile'] = NULL;
							$VideoContent[$VideoID]['FlashVarsImage'] = NULL;
							$VideoContent[$VideoID]['FlashVarsLink'] = NULL;
							$VideoContent[$VideoID]['FlashVarsStart'] = NULL;
							$VideoContent[$VideoID]['FlashVarsStreamer'] = NULL;
							$VideoContent[$VideoID]['FlashVarsTags'] = NULL;
							$VideoContent[$VideoID]['FlashVarsTitle'] = NULL;
							$VideoContent[$VideoID]['FlashVarsType'] = NULL;
							$VideoContent[$VideoID]['FlashVarsBackColor'] = NULL;
							$VideoContent[$VideoID]['FlashVarsControlBar'] = NULL;
							$VideoContent[$VideoID]['FlashVarsDock'] = NULL;
							$VideoContent[$VideoID]['FlashVarsFrontColor'] = NULL;
							$VideoContent[$VideoID]['FlashVarsHeight'] = NULL;
							$VideoContent[$VideoID]['FlashVarsIcons'] = NULL;
							$VideoContent[$VideoID]['FlashVarsLightColor'] = NULL;
							$VideoContent[$VideoID]['FlashVarsLogo'] = NULL;
							$VideoContent[$VideoID]['FlashVarsPlaylist'] = NULL;
							$VideoContent[$VideoID]['FlashVarsPlaylistSize'] = NULL;
							$VideoContent[$VideoID]['FlashVarsSkin'] = NULL;
							$VideoContent[$VideoID]['FlashVarsScreenColor'] = NULL;
							$VideoContent[$VideoID]['FlashVarsWidth'] = NULL;
							$VideoContent[$VideoID]['FlashVarsAutoStart'] = NULL;
							$VideoContent[$VideoID]['FlashVarsBufferLength'] = NULL;
							$VideoContent[$VideoID]['FlashVarsDisplayClick'] = NULL;
							$VideoContent[$VideoID]['FlashVarsDisplayTitle'] = NULL;
							$VideoContent[$VideoID]['FlashVarsFullScreen'] = NULL;
							$VideoContent[$VideoID]['FlashVarsItem'] = NULL;
							$VideoContent[$VideoID]['FlashVarsLinkTarget'] = NULL;
							$VideoContent[$VideoID]['FlashVarsMute'] = NULL;
							$VideoContent[$VideoID]['FlashVarsRepeat'] = NULL;
							$VideoContent[$VideoID]['FlashVarsShuffle'] = NULL;
							$VideoContent[$VideoID]['FlashVarsSmoothing'] = NULL;
							$VideoContent[$VideoID]['FlashVarsState'] = NULL;
							$VideoContent[$VideoID]['FlashVarsStretching'] = NULL;
							$VideoContent[$VideoID]['FlashVarsVolume'] = NULL;
							$VideoContent[$VideoID]['FlashVarsClient'] = NULL;
							$VideoContent[$VideoID]['FlashVarsDebug'] = NULL;
							$VideoContent[$VideoID]['FlashVarsId'] = NULL;
							$VideoContent[$VideoID]['FlashVarsPlugins'] = NULL;
							$VideoContent[$VideoID]['FlashVarsVersion'] = NULL;
							$VideoContent[$VideoID]['FlashVarsConfig'] = NULL;
							$VideoContent[$VideoID]['AltText'] = $NoFlashTest;
							$VideoContent[$VideoID]['FlashID'] = NULL;
							$VideoContent[$VideoID]['FlashStyle'] = NULL;
							$VideoContent[$VideoID]['FlashClass'] = NULL;
							$VideoContent[$VideoID]['StartTag'] = '<div>';
							$VideoContent[$VideoID]['EndTag'] = '</div>';
							$VideoContent[$VideoID]['StartTagId'] = NULL;
							$VideoContent[$VideoID]['StartTagStyle'] = NULL;
							$VideoContent[$VideoID]['StartTagClass'] = 'YouTube1';
							$VideoContent[$VideoID]['Enable/Disable'] = 'Enable';
							$VideoContent[$VideoID]['Status'] = 'Approved';
							
							$j++;
							$LookupTemp = 'Video' . $j;
							$i++;
							$k++;
							$VideoID++;
							
							while ($Value[$LookupTemp] != NULL) {
								$VideoLocation = $Value[$LookupTemp]['VideoLocation'];
								$NoFlashTest = $Value[$LookupTemp]['NoFlashText'];
								$FlashVarsText = $Value[$LookupTemp]['FlashVarsText'];
								
								$Content[$i]['PageID'] = $NewPageID;
								$Content[$i]['ObjectID'] = $i;
								$Content[$i]['ContainerObjectType'] = 'XhtmlFlash';
								$Content[$i]['ContainerObjectName'] = 'flash';
								$Content[$i]['ContainerObjectID'] = $VideoID;
								$Content[$i]['ContainerObjectPrintPreview'] = 'true';
								$Content[$i]['RevisionID'] = $NewRevisionID;
								$Content[$i]['CurrentVersion'] = 'true';
								$Content[$i]['Empty'] = 'false';
								$Content[$i]['StartTag'] = NULL;
								$Content[$i]['EndTag'] = NULL;
								$Content[$i]['StartTagID'] = NULL;
								$Content[$i]['StartTagStyle'] = NULL;
								$Content[$i]['StartTagClass'] = NULL;
		
								$Content[$i]['Heading'] = NULL;
								$Content[$i]['HeadingStartTag'] = NULL;
								$Content[$i]['HeadingEndTag'] = NULL;
								$Content[$i]['HeadingStartTagID'] = NULL;
								$Content[$i]['HeadingStartTagStyle'] = NULL;
								$Content[$i]['HeadingStartTagClass'] = NULL;
		
								$Content[$i]['Content'] = NULL;
								$Content[$i]['ContentStartTag'] = NULL;
								$Content[$i]['ContentEndTag'] = NULL;
								$Content[$i]['ContentStartTagID'] = NULL;
								$Content[$i]['ContentStartTagStyle'] = NULL;
								$Content[$i]['ContentStartTagClass'] = NULL;
								$Content[$i]['ContentPTagID'] = NULL;
								$Content[$i]['ContentPTagStyle'] = NULL;
								$Content[$i]['ContentPTagClass'] = NULL;
		
								$Content[$i]['Enable/Disable'] = $_POST['EnableDisable'];
								$Content[$i]['Status'] = $_POST['Status'];
								
								$VideoContent[$VideoID]['PageID'] = $NewPageID;
								$VideoContent[$VideoID]['ObjectID'] = $VideoID;
								$VideoContent[$VideoID]['RevisionID'] = $NewRevisionID;
								$VideoContent[$VideoID]['CurrentVersion'] = 'true';
								$VideoContent[$VideoID]['FlashPath'] = $VideoLocation;
								$VideoContent[$VideoID]['Width'] = 480;
								$VideoContent[$VideoID]['Height'] = 390;
								$VideoContent[$VideoID]['Wmode'] = 'opaque';
								$VideoContent[$VideoID]['AllowFullScreen'] = 'true';
								$VideoContent[$VideoID]['AllowScriptAccess'] = 'true';
								$VideoContent[$VideoID]['Quality'] = NULL;
								$VideoContent[$VideoID]['FlashVarsAuthor'] = NULL;
								$VideoContent[$VideoID]['FlashVarsDate'] = NULL;
								$VideoContent[$VideoID]['FlashVarsDescription'] = $FlashVarsText;
								$VideoContent[$VideoID]['FlashVarsDuration'] = NULL;
								$VideoContent[$VideoID]['FlashVarsFile'] = NULL;
								$VideoContent[$VideoID]['FlashVarsImage'] = NULL;
								$VideoContent[$VideoID]['FlashVarsLink'] = NULL;
								$VideoContent[$VideoID]['FlashVarsStart'] = NULL;
								$VideoContent[$VideoID]['FlashVarsStreamer'] = NULL;
								$VideoContent[$VideoID]['FlashVarsTags'] = NULL;
								$VideoContent[$VideoID]['FlashVarsTitle'] = NULL;
								$VideoContent[$VideoID]['FlashVarsType'] = NULL;
								$VideoContent[$VideoID]['FlashVarsBackColor'] = NULL;
								$VideoContent[$VideoID]['FlashVarsControlBar'] = NULL;
								$VideoContent[$VideoID]['FlashVarsDock'] = NULL;
								$VideoContent[$VideoID]['FlashVarsFrontColor'] = NULL;
								$VideoContent[$VideoID]['FlashVarsHeight'] = NULL;
								$VideoContent[$VideoID]['FlashVarsIcons'] = NULL;
								$VideoContent[$VideoID]['FlashVarsLightColor'] = NULL;
								$VideoContent[$VideoID]['FlashVarsLogo'] = NULL;
								$VideoContent[$VideoID]['FlashVarsPlaylist'] = NULL;
								$VideoContent[$VideoID]['FlashVarsPlaylistSize'] = NULL;
								$VideoContent[$VideoID]['FlashVarsSkin'] = NULL;
								$VideoContent[$VideoID]['FlashVarsScreenColor'] = NULL;
								$VideoContent[$VideoID]['FlashVarsWidth'] = NULL;
								$VideoContent[$VideoID]['FlashVarsAutoStart'] = NULL;
								$VideoContent[$VideoID]['FlashVarsBufferLength'] = NULL;
								$VideoContent[$VideoID]['FlashVarsDisplayClick'] = NULL;
								$VideoContent[$VideoID]['FlashVarsDisplayTitle'] = NULL;
								$VideoContent[$VideoID]['FlashVarsFullScreen'] = NULL;
								$VideoContent[$VideoID]['FlashVarsItem'] = NULL;
								$VideoContent[$VideoID]['FlashVarsLinkTarget'] = NULL;
								$VideoContent[$VideoID]['FlashVarsMute'] = NULL;
								$VideoContent[$VideoID]['FlashVarsRepeat'] = NULL;
								$VideoContent[$VideoID]['FlashVarsShuffle'] = NULL;
								$VideoContent[$VideoID]['FlashVarsSmoothing'] = NULL;
								$VideoContent[$VideoID]['FlashVarsState'] = NULL;
								$VideoContent[$VideoID]['FlashVarsStretching'] = NULL;
								$VideoContent[$VideoID]['FlashVarsVolume'] = NULL;
								$VideoContent[$VideoID]['FlashVarsClient'] = NULL;
								$VideoContent[$VideoID]['FlashVarsDebug'] = NULL;
								$VideoContent[$VideoID]['FlashVarsId'] = NULL;
								$VideoContent[$VideoID]['FlashVarsPlugins'] = NULL;
								$VideoContent[$VideoID]['FlashVarsVersion'] = NULL;
								$VideoContent[$VideoID]['FlashVarsConfig'] = NULL;
								$VideoContent[$VideoID]['AltText'] = $NoFlashTest;
								$VideoContent[$VideoID]['FlashID'] = NULL;
								$VideoContent[$VideoID]['FlashStyle'] = NULL;
								$VideoContent[$VideoID]['FlashClass'] = NULL;
								$VideoContent[$VideoID]['StartTag'] = '<div>';
								$VideoContent[$VideoID]['EndTag'] = '</div>';
								$VideoContent[$VideoID]['StartTagId'] = NULL;
								$VideoContent[$VideoID]['StartTagStyle'] = NULL;
								$VideoContent[$VideoID]['StartTagClass'] = 'YouTube2';
								$VideoContent[$VideoID]['Enable/Disable'] = 'Enable';
								$VideoContent[$VideoID]['Status'] = 'Approved';
								
								$j++;
								$LookupTemp = 'Video' . $j;
								
								$i++;
								$k++;
								$VideoID++;
							}
						}
								
						// BottomText
						if ($Value['BottomText'] !== NULL) {
							$Content[$i]['PageID'] = $NewPageID;
							$Content[$i]['ObjectID'] = $i;
							$Content[$i]['ContainerObjectType'] = 'XhtmlContent';
							$Content[$i]['ContainerObjectName'] = 'content';
							$Content[$i]['ContainerObjectID'] = $k;
							$Content[$i]['ContainerObjectPrintPreview'] = 'true';
							$Content[$i]['RevisionID'] = $NewRevisionID;
							$Content[$i]['CurrentVersion'] = 'true';
							$Content[$i]['Empty'] = 'false';
							$Content[$i]['StartTag'] = NULL;
							$Content[$i]['EndTag'] = NULL;
							$Content[$i]['StartTagID'] = NULL;
							$Content[$i]['StartTagStyle'] = NULL;
							$Content[$i]['StartTagClass'] = NULL;
	
							$Content[$i]['Heading'] = NULL;
							$Content[$i]['HeadingStartTag'] = NULL;
							$Content[$i]['HeadingEndTag'] = NULL;
							$Content[$i]['HeadingStartTagID'] = NULL;
							$Content[$i]['HeadingStartTagStyle'] = NULL;
							$Content[$i]['HeadingStartTagClass'] = NULL;
		
							$Content[$i]['Content'] = $Value['BottomText'];
							$Content[$i]['ContentStartTag'] = '<p>';
							$Content[$i]['ContentEndTag'] = '</p>';
							$Content[$i]['ContentStartTagID'] = NULL;
							$Content[$i]['ContentStartTagStyle'] = NULL;
							$Content[$i]['ContentStartTagClass'] = 'BodyText';
							$Content[$i]['ContentPTagID'] = NULL;
							$Content[$i]['ContentPTagStyle'] = NULL;
							$Content[$i]['ContentPTagClass'] = 'BodyText';
	
							$Content[$i]['Enable/Disable'] = $_POST['EnableDisable'];
							$Content[$i]['Status'] = $_POST['Status'];
							$i++;
							$k++;
						}
					}
				}
			}
			
			$Content[$i]['PageID'] = $NewPageID;
			$Content[$i]['ObjectID'] = $i;
			$Content[$i]['ContainerObjectType'] = 'XhtmlContent';
			$Content[$i]['ContainerObjectName'] = 'content';
			$Content[$i]['ContainerObjectID'] = $k;
			$Content[$i]['ContainerObjectPrintPreview'] = 'true';
			$Content[$i]['RevisionID'] = $NewRevisionID;
			$Content[$i]['CurrentVersion'] = 'true';
			$Content[$i]['Empty'] = 'false';
			$Content[$i]['StartTag'] = NULL;
			$Content[$i]['EndTag'] = '</div>';
			$Content[$i]['StartTagID'] = NULL;
			$Content[$i]['StartTagStyle'] = NULL;
			$Content[$i]['StartTagClass'] = NULL;
			$Content[$i]['Heading'] = NULL;
			$Content[$i]['HeadingStartTag'] = NULL;
			$Content[$i]['HeadingEndTag'] = NULL;
			$Content[$i]['HeadingStartTagID'] = NULL;
			$Content[$i]['HeadingStartTagStyle'] = NULL;
			$Content[$i]['HeadingStartTagClass'] = NULL;
			$Content[$i]['Content'] = NULL;
			$Content[$i]['ContentStartTag'] = NULL;
			$Content[$i]['ContentEndTag'] = NULL;
			$Content[$i]['ContentStartTagID'] = NULL;
			$Content[$i]['ContentStartTagStyle'] = NULL;
			$Content[$i]['ContentStartTagClass'] = NULL;
			$Content[$i]['ContentPTagID'] = NULL;
			$Content[$i]['ContentPTagStyle'] = NULL;
			$Content[$i]['ContentPTagClass'] = NULL;
			$Content[$i]['Enable/Disable'] = $_POST['EnableDisable'];
			$Content[$i]['Status'] = $_POST['Status'];
			
			$Header = parse_ini_file('../../ModuleSettings/Tier6-ContentLayer/Modules/XhtmlHeader/UpdateXhtmlHeader.ini',FALSE);
			$Header = $Tier6Databases->EmptyStringToNullArray($Header);
	
			$HeaderPanel1 = parse_ini_file('../../ModuleSettings/Tier6-ContentLayer/Modules/XhtmlMenu/UpdateHeaderPanel1.ini',TRUE);
			$HeaderPanel1 = $Tier6Databases->EmptyStringToNullArray($HeaderPanel1);
	
			$ContentLayerVersion = parse_ini_file('../../ModuleSettings/Tier6-ContentLayer/GlobalSettings/UpdateContentLayerVersion.ini',FALSE);
			$ContentLayerVersion = $Tier6Databases->EmptyStringToNullArray($ContentLayerVersion);
	
			//$ContentLayer = parse_ini_file('../../ModuleSettings/Tier6-ContentLayer/GlobalSettings/UpdateContentLayer.ini',TRUE);
			//$ContentLayer = $Tier6Databases->EmptyStringToNullArray($ContentLayer);
	
			$_POST['Priority'] = $_POST['Priority'] / 10;
	
			$Sitemap = parse_ini_file('../../ModuleSettings/Tier6-ContentLayer/Modules/XmlSitemap/UpdateXmlSitemap.ini',FALSE);
			$Sitemap = $Tier6Databases->EmptyStringToNullArray($Sitemap);
	
			$ContentPrintPreview = parse_ini_file('../../ModuleSettings/Tier6-ContentLayer/Modules/XhtmlContent/UpdatePrintPreview.ini',FALSE);
			$ContentPrintPreview = $Tier6Databases->EmptyStringToNullArray($ContentPrintPreview);
	
			//$MainMenuItemLookup = parse_ini_file('../../ModuleSettings/Tier6-ContentLayer/Modules/XhtmlMainMenu/UpdateMainMenuItemLookup.ini',FALSE);
			//$MainMenuItemLookup = $Tier6Databases->EmptyStringToNullArray($MainMenuItemLookup);
			
			$UpdateTablesPageSelect = $Options['XhtmlTable']['table']['TablePageUpdateSelectPage']['SettingAttribute'];
			$FormOptionText = $hold['FilteredInput']['PageTitle'];

			$FormOption = array();
			//$FormOption['PageID'] = $UpdatePhotosPageSelect;
			//$FormOption['ObjectID'] = $NewPhotosPage;
			$FormOption['FormOptionText'] = $FormOptionText;
			//$FormOption['FormOptionTextDynamic'] = 'false';
			//$FormOption['FormOptionTextTableName'] = NULL;
			//$FormOption['FormOptionTextField'] = NULL;
			//$FormOption['FormOptionTextPageID'] = NULL;
			//$FormOption['FormOptionTextObjectID'] = NULL;
			//$FormOption['FormOptionTextRevisionID'] = NULL;
			//$FormOption['FormOptionDisabled'] = NULL;
			//$FormOption['FormOptionLabel'] = NULL;
			//$FormOption['FormOptionLabelDynamic'] = NULL;
			//$FormOption['FormOptionLabelTableName'] = NULL;
			//$FormOption['FormOptionLabelField'] = NULL;
			//$FormOption['FormOptionLabelPageID'] = NULL;
			//$FormOption['FormOptionLabelObjectID'] = NULL;
			//$FormOption['FormOptionLabelRevisionID'] = NULL;
			//$FormOption['FormOptionSelected'] = NULL;
			//$FormOption['FormOptionValue'] = $FormOptionValue;
			//$FormOption['FormOptionValueDynamic'] = NULL;
			//$FormOption['FormOptionValueTableName'] = NULL;
			//$FormOption['FormOptionValueField'] = NULL;
			//$FormOption['FormOptionValuePageID'] = NULL;
			//$FormOption['FormOptionValueObjectID'] = NULL;
			//$FormOption['FormOptionValueRevisionID'] = NULL;
			//$FormOption['FormOptionClass'] = NULL;
			//$FormOption['FormOptionDir'] = 'ltr';
			//$FormOption['FormOptionID'] = NULL;
			//$FormOption['FormOptionLang'] = 'en-us';
			//$FormOption['FormOptionStyle'] = NULL;
			//$FormOption['FormOptionTitle'] = NULL;
			//$FormOption['FormOptionXMLLang'] = 'en-us';
			//$FormOption['Enable/Disable'] = 'Enable';
			//$FormOption['Status'] = 'Approved';
			
			$FormOptionID = $Options['XhtmlContent']['content']['UpdateVideosPageSelect']['SettingAttribute'];
			$Tier6Databases->ModulePass('XhtmlForm', 'form', 'updateFormOption', array('PageID' => array('PageID' => $FormOptionID, 'ObjectID' => $FormOptionObjectID), 'Content' => $FormOption));
			$FormOptionID = $Options['XhtmlContent']['content']['DeleteVideosPage']['SettingAttribute'];
			$Tier6Databases->ModulePass('XhtmlForm', 'form', 'updateFormOption', array('PageID' => array('PageID' => $FormOptionID, 'ObjectID' => $FormOptionObjectID), 'Content' => $FormOption));
			$FormOptionID = $Options['XhtmlContent']['content']['EnableDisableStatusChangeVideosPage']['SettingAttribute'];
			$Tier6Databases->ModulePass('XhtmlForm', 'form', 'updateFormOption', array('PageID' => array('PageID' => $FormOptionID, 'ObjectID' => $FormOptionObjectID), 'Content' => $FormOption));
			$FormOptionID = $Options['XhtmlMainMenu']['mainmenu']['MainMenuSelectPage']['SettingAttribute'];
			$Tier6Databases->ModulePass('XhtmlForm', 'form', 'updateFormOption', array('PageID' => array('PageID' => $FormOptionID, 'ObjectID' => $NewPageID), 'Content' => $FormOption));
			$FormOptionID = $Options['XhtmlMainMenu']['mainmenu']['MainMenuUpdatePage']['SettingAttribute'];
			$Tier6Databases->ModulePass('XhtmlForm', 'form', 'updateFormOption', array('PageID' => array('PageID' => $FormOptionID, 'ObjectID' => $NewPageID), 'Content' => $FormOption));
			
			$Tier6Databases->ModulePass('XhtmlHeader', 'header', 'updateHeader', $PageID);
			$Tier6Databases->ModulePass('XhtmlHeader', 'header', 'createHeader', $Header);

			$Tier6Databases->ModulePass('XhtmlMenu', 'headerpanel1', 'updateMenu', array('PageID' => array('PageID' => $NewPageID, 'ObjectID' => 2), 'Content' => $HeaderPanel1));
			$Tier6Databases->ModulePass('XhtmlContent', 'content', 'updateContentPrintPreview', array('PageID' => $PageID, 'Content' => $ContentPrintPreview));
			$Tier6Databases->ModulePass('XmlSitemap', 'sitemap', 'updateSitemapItem', array('PageID' => $PageID, 'Content' => $Sitemap));

			$Tier6Databases->ModulePass('XhtmlFlash', 'flash', 'updateFlash', $PageID);
			$Tier6Databases->ModulePass('XhtmlContent', 'content', 'updateContent', $PageID);
			$Tier6Databases->updateContentVersion($PageID, 'ContentLayerVersion');
			//$Tier6Databases->updateContent($PageID, 'ContentLayer');
			
			$Tier6Databases->ModulePass('XhtmlFlash', 'flash', 'createFlash', $VideoContent);
			
			$Tier6Databases->ModulePass('XhtmlContent', 'content', 'createContent', $Content);
			
			$Tier6Databases->createContentVersion($ContentLayerVersion, 'ContentLayerVersion');
			//$Tier6Databases->createContent($ContentLayer, 'ContentLayer');

			$Tier6Databases->SessionDestroy($sessionname);
			$sessionname = $Tier6Databases->SessionStart('UpdatedVideoPage');

			$Page = '../../../index.php?PageID=';
			$Page .= $NewPageID;

			$_SESSION['POST']['Error']['Link'] = '<a href=\'';
			$_SESSION['POST']['Error']['Link'] .= $Page;
			$_SESSION['POST']['Error']['Link'] .= '\'>Updated Video Page</a>';
			
			$CreatedUpdateVideosPage = $Options['XhtmlContent']['content']['CreatedUpdateVideosPage']['SettingAttribute'];
			header("Location: $CreatedUpdateVideosPage&SessionID=$sessionname");
			exit;
		}
	} else {
		$Tier6Databases->SessionDestroy($sessionname);
		$Options = $Tier6Databases->getLayerModuleSetting();
		
		$UpdateVideosPageSelect = $Options['XhtmlContent']['content']['UpdateVideosPageSelect']['SettingAttribute'];
		header("Location: ../../index.php?PageID=$UpdateVideosPageSelect");
	}
?>