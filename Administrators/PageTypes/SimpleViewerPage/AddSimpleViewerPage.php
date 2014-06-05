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
	
	if ($ReferPageID === 'PageID=230') {
		$LogPage = FALSE;
		
		if ($LogPage === TRUE) {
			$LogFile = "AddSimpleViewerPage.txt";
			$LogFileHandle = fopen($LogFile, 'a');
			$FileInformation = 'Logging - Add SimpleViewer Page Script Loading - ' . date("F j, Y, g:i a") . "\n";
			fwrite($LogFileHandle, $FileInformation);
			fwrite($LogFileHandle, print_r($_SERVER['HTTP_REFERER'], TRUE));
			fwrite($LogFileHandle, "\n---------------------------------------------\n\n");
			fclose($LogFileHandle);
		}
		
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
		
		$Options = $Tier6Databases->getLayerModuleSetting();
		
		//$XhtmlTableName = $Options['XhtmlTable']['table']['XhtmlTableName']['SettingAttribute'];
		
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
		$PageName .= $_POST['AddSimpleViewerPage'];
	
		$FileLocation = 'TEMPFILES/';
	
		$TempGallery = array();
		$Gallery = array();
		$AddLookupData = array();
		
		foreach ($_POST as $Key => $Value) {
			if ($Key !== 'AddSimpleViewerPage') {
				if (strstr($Key, "SimpleViewer")) {
					$TempGallery[$Key] = $Value;
					$AddLookupData[$Key] = $Value;
				}
			}
		}
	
		foreach ($TempGallery as $Key => $Value) {
			$NewKey = explode('_', $Key);
			$GalleryName = $NewKey[0];
			$SubKey = $NewKey[1];
			$Gallery[$GalleryName][$SubKey] = $Value;
		}
		
		$hold = $Tier6Databases->FormSubmitValidate('AddSimpleViewerPage', $PageName, $FileLocation, $Gallery, 'SimpleViewer', $AddLookupData);

		if ($hold) {
			$sessionname = $Tier6Databases->SessionStart('CreateTablesPage');
			$_SESSION['POST'] = $_POST;
			$DateTime = date('Y-m-d H:i:s');
			$Date = date('Y-m-d');
			$SiteName = $GLOBALS['sitename'];
	
			$LastPageID = $Tier6Databases->ModulePass('XhtmlContent', 'content', 'getLastContentPageID', array());
			if (isset($LastPageID)) {
				$NewPageID = ++$LastPageID;
			} else {
				$NewPageID = 1;
			}
			
			if ($LogPage === TRUE) {
				$LogFile = "AddSimpleViewerPage.txt";
				$LogFileHandle = fopen($LogFile, 'a');
				$FileInformation = 'Logging - Add Simple Viewer Page Top Script - ' . $NewPageID . ' - ' . date("F j, Y, g:i a") . "\n";
				fwrite($LogFileHandle, $FileInformation);
				//fwrite($LogFileHandle, print_r($ImageContent, TRUE));
				fwrite($LogFileHandle, "\n---------------------------------------------\n\n");
				fclose($LogFileHandle);
			}
			
			$LastSimpleViewerPage = $Options['XhtmlSimpleViewer']['simpleviewer']['LastSimpleViewerPage']['SettingAttribute'];
			$NewSimpleViewerPage = ++$LastSimpleViewerPage;
			$Tier6Databases->updateModuleSetting('XhtmlSimpleViewer', 'simpleviewer', 'LastSimpleViewerPage', $NewSimpleViewerPage);
			
			$NewPage = '../../../index.php?PageID=';
			$NewPage .= $NewPageID;
	
			$Location = 'index.php?PageID=';
			$Location .= $NewPageID;
	
			$NewRevisionID = 0;
	
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
			
			$temp = $Tier6Databases->MultiPostCheck('SimpleViewer', 1, $hold, '_', NULL, 'Heading');
			if ($temp != NULL) {
				$hold = $temp;
			}
			
			$temp = $Tier6Databases->MultiPostCheck('SimpleViewer', 1, $hold, '_', NULL, 'TopText');
			if ($temp != NULL) {
				$hold = $temp;
			}
			
			$temp = $Tier6Databases->MultiPostCheck('SimpleViewer', 1, $hold, '_', NULL, 'BottomText');
			if ($temp != NULL) {
				$hold = $temp;
			}
			
			$temp = $Tier6Databases->MultiPostCheck('SimpleViewer', 1, $hold, '_', NULL, 'Order');
			if ($temp != NULL) {
				$hold = $temp;
			}
			
			$temp = $Tier6Databases->PostCheck ('MenuName', 'FilteredInput', $hold);
			if (!is_null($temp)) {
				$hold = $temp;
			}
			
			$temp = $Tier6Databases->PostCheck ('MenuTitle', 'FilteredInput', $hold);
			if (!is_null($temp)) {
				$hold = $temp;
			}
			
			// Gallery Data
			$TempGallery = array();
			$Gallery = array();
			
			foreach ($hold['FilteredInput'] as $Key => $Value) {
				if ($Key !== 'AddSimpleViewerPage') {
					if (strstr($Key, "SimpleViewer")) {
						$TempGallery[$Key] = $Value;
					}
				}
			}
		
			foreach ($TempGallery as $Key => $Value) {
				$NewKey = explode('_', $Key);
				$GalleryName = $NewKey[0];
				$SubKey = $NewKey[1];
				$Gallery[$GalleryName][$SubKey] = $Value;
			}
			
			
			// General Defines
			define(NewPageID, $NewPageID);
			define(CurrentVersionTrueFalse, 'true');
			define(ContentPageType, 'SimpleViewerPage');
	
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
			
			$TempGallery = $Gallery;
			unset($Gallery);
			$Gallery = array();
			foreach ($TempGallery as $Key => $Value) {
				$Gallery[] = $Value;
			}
			
			// START SORT GALLERY
			$GalleryContentNew = array();
			$GalleryContentNoOrder = array();
			$GalleryContentMove = array();

			$PopKey = array();
			foreach ($Gallery as $Key => $Content) {
				if ($Key == $Content['Order']) {
					$GalleryContentNew[$Key] = $Content;
					array_push($PopKey, $Key);
				} else if ($Content['Order'] == NULL) {
					$GalleryContentNoOrder[$Key] = $Content;
					array_push($PopKey, $Key);
				} else {
					$GalleryContentMove[$Key] = $Content;
					array_push($PopKey, $Key);
				}

			}
			foreach ($PopKey as $Value) {
				if ($Value != NULL) {
					unset($Gallery[$Value]);
				}
			}
			
			$Gallery = $GalleryContentNew;
			unset($GalleryContentNew);
			
			foreach ($GalleryContentMove as $Key => $Content) {
				$Order = $Content['Order'];
				if (isset($Content[$Order])) {
					array_push($Gallery, $Content);
				} else {
					$Gallery[$Order] = $Content;
				}
			}
			unset($GalleryContentMove);

			foreach($GalleryContentNoOrder as $Content) {
				array_push($Gallery, $Content);
			}
			unset($GalleryContentNoOrder);
			
			if ($LogImageContent === TRUE) {
				$LogFile = "SimpleViewerPageLog.txt";
				$LogFileHandle = fopen($LogFile, 'a');
				$FileInformation = 'Logging - Adding Simple Viewer Gallery Page Content Unchanged - ' . $PageID . ' - ' . date("F j, Y, g:i a") . "\n";
				fwrite($LogFileHandle, $FileInformation);
				fwrite($LogFileHandle, print_r($Gallery, TRUE));
				fwrite($LogFileHandle, "\n---------------------------------------------\n\n");
				fclose($LogFileHandle);
			}
			
			ksort($Gallery);

			if ($LogImageContent === TRUE) {
				$LogFile = "SimpleViewerPageLog.txt";
				$LogFileHandle = fopen($LogFile, 'a');
				$FileInformation = 'Logging - Adding Simple Viewer Gallery Page Content Changed - ' . $PageID . ' - ' . date("F j, Y, g:i a") . "\n";
				fwrite($LogFileHandle, $FileInformation);
				fwrite($LogFileHandle, print_r($Gallery, TRUE));
				fwrite($LogFileHandle, "\n---------------------------------------------\n\n");
				fclose($LogFileHandle);
			}
			// END SORT GALLERY
			
			// START Walk Gallery to rename keys as simpleviewer1, 2 etc.
			$TempGallery = array();
			$i = 1;
			foreach ($Gallery as $Key => $Value) {
				$NewKeyName = 'SimpleViewer' . $i;
				$TempGallery[$NewKeyName] = $Value;
				$i++;
			}
			
			$Gallery = $TempGallery;
			unset($TempGallery);
			// END Walk Gallery to rename keys as simpleviewer1, 2 etc.
			
			$PageID = array();
			$PageID['PageID'] = $NewPageID;
	
			$i = 0;
			
			// USE CONTENTLAYERPAGETYPESDEFINES TABLE HERE. MAKE THIS USE A METHOD FROM CONTENT MODULE TO WALK!
			// Method must pass page type to it! SimpleViewerPage
			$Content = array();
			
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
	
			$GalleryID = 1;
			$GalleryLookup = array();
			$SimpleViewer = array();
			
			if ($Gallery !== NULL) {
				foreach($Gallery as $Key => $Value) {
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
						
						// XhtmlSimpleViewer
							if ($Value['Name'] !== NULL) {
								$LookupID = $Value['Name'];
								$LookupID = explode('-', $LookupID);
								$GalleryRecordID = $LookupID[0];
								$GalleryName = trim($LookupID[1]);
								
								$NewObjectID = $GalleryID;
		
								$Content[$i]['PageID'] = $NewPageID;
								$Content[$i]['ObjectID'] = $i;
								$Content[$i]['ContainerObjectType'] = 'XhtmlSimpleViewer';
								$Content[$i]['ContainerObjectName'] = 'simpleviewer';
								$Content[$i]['ContainerObjectID'] = $NewObjectID;
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
								
								//SimpleViewer[$GalleryID];
								// SIMPLEVIEWER MODULE WILL HAVE TO HAVE A COMMON PROCESS METHOD TO PROCESS ITS OWN DATABASE TYPE! STARTS HERE
								$GalleryLookup[$GalleryID]['PageID'] = $NewPageID;
								$GalleryLookup[$GalleryID]['ObjectID'] = $GalleryID;
								$GalleryLookup[$GalleryID]['RevisionID'] = $NewRevisionID;
								$GalleryLookup[$GalleryID]['CurrentVersion'] = 'true';
								$GalleryLookup[$GalleryID]['SimpleViewerMenuName'] = $GalleryName;
								$GalleryLookup[$GalleryID]['SimpleViewerTableName'] = 'FlashSimpleViewer';
								$GalleryLookup[$GalleryID]['SimpleViewerPageID'] = $GalleryRecordID;
								$GalleryLookup[$GalleryID]['SimpleViewerObjectID'] = 1;
								$GalleryLookup[$GalleryID]['Enable/Disable'] = 'Enable';
								$GalleryLookup[$GalleryID]['Status'] = 'Approved';	
								
								$SimpleViewer[$GalleryID]['PageID'] = $NewPageID;
								$SimpleViewer[$GalleryID]['ObjectID'] = $GalleryID;
								$SimpleViewer[$GalleryID]['RevisionID'] = $NewRevisionID;
								$SimpleViewer[$GalleryID]['CurrentVersion'] = 'true';
								$SimpleViewer[$GalleryID]['SimpleViewerFlashTableName'] = 'FlashSimpleViewerLookup';
								$SimpleViewer[$GalleryID]['SimpleViewerFlashObjectName'] = 'flashsimpleviewer';
								$SimpleViewer[$GalleryID]['StartTag'] = '<div>';
								$SimpleViewer[$GalleryID]['EndTag'] = '</div>';
								$SimpleViewer[$GalleryID]['StartTagID'] = 'sv-container';
								$SimpleViewer[$GalleryID]['StartTagClass'] = NULL;
								$SimpleViewer[$GalleryID]['StartTagStyle'] = NULL;
								$SimpleViewer[$GalleryID]['Enable/Disable'] = 'Enable';
								$SimpleViewer[$GalleryID]['Status'] = 'Approved';	
								// ENDS HERE!
								
								$GalleryID++;
								$i++;
								$k++;
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
							
							/*$Content[$i]['PageID'] = $NewPageID;
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
							$Content[$i]['Content'] = "<br />/n<hr />/n<br />";
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
							$i++;
							$k++;
							*/
					}
				}
			}
			
			/*if ($i != 1) {
				$i--;
				$k--;
				unset($Content[$i]);
			}*/
			
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
	
			$Header = parse_ini_file('../../ModuleSettings/Tier6-ContentLayer/Modules/XhtmlHeader/AddXhtmlHeader.ini',FALSE);
			$Header = $Tier6Databases->EmptyStringToNullArray($Header);
	
			$HeaderPanel1 = parse_ini_file('../../ModuleSettings/Tier6-ContentLayer/Modules/XhtmlMenu/AddHeaderPanel1.ini',TRUE);
			$HeaderPanel1 = $Tier6Databases->EmptyStringToNullArray($HeaderPanel1);
	
			$ContentLayerVersion = parse_ini_file('../../ModuleSettings/Tier6-ContentLayer/GlobalSettings/AddContentLayerVersion.ini',FALSE);
			$ContentLayerVersion = $Tier6Databases->EmptyStringToNullArray($ContentLayerVersion);
	
			//$ContentLayer = parse_ini_file('../../ModuleSettings/Tier6-ContentLayer/GlobalSettings/AddContentLayer.ini',TRUE);
			//$ContentLayer = $Tier6Databases->EmptyStringToNullArray($ContentLayer);
	
			$_POST['Priority'] = $_POST['Priority'] / 10;
	
			$Sitemap = parse_ini_file('../../ModuleSettings/Tier6-ContentLayer/Modules/XmlSitemap/AddXmlSitemap.ini',FALSE);
			$Sitemap = $Tier6Databases->EmptyStringToNullArray($Sitemap);
	
			$ContentPrintPreview = parse_ini_file('../../ModuleSettings/Tier6-ContentLayer/Modules/XhtmlContent/AddPrintPreview.ini',FALSE);
			$ContentPrintPreview = $Tier6Databases->EmptyStringToNullArray($ContentPrintPreview);
	
			$MainMenuItemLookup = parse_ini_file('../../ModuleSettings/Tier6-ContentLayer/Modules/XhtmlMainMenu/AddMainMenuItemLookup.ini',FALSE);
			$MainMenuItemLookup = $Tier6Databases->EmptyStringToNullArray($MainMenuItemLookup);
	
			$UpdatePageSelect = $Options['XhtmlSimpleViewer']['simpleviewer']['SimpleViewerPageUpdateSelectPage']['SettingAttribute'];
			$FormSelect = array();
			$FormSelect['PageID'] = $UpdatePageSelect;
			$FormSelect['ObjectID'] = $NewSimpleViewerPage;
			$FormSelect['StopObjectID'] = 9999;
			$FormSelect['ContinueObjectID'] = NULL;
			$FormSelect['ContainerObjectType'] = 'Option';
			$FormSelect['ContainerObjectTypeName'] = 'AdministratorFormOption';
			$FormSelect['ContainerObjectID'] = $NewSimpleViewerPage;
			$FormSelect['FormSelectDisabled'] = NULL;
			$FormSelect['FormSelectMultiple'] = NULL;
			$FormSelect['FormSelectName'] = 'SimpleViewerPage';
			$FormSelect['FormSelectNameDynamic'] = NULL;
			$FormSelect['FormSelectNameTableName'] = NULL;
			$FormSelect['FormSelectNameField'] = NULL;
			$FormSelect['FormSelectNamePageID'] = NULL;
			$FormSelect['FormSelectNameObjectID'] = NULL;
			$FormSelect['FormSelectNameRevisionID'] = NULL;
			$FormSelect['FormSelectSize'] = NULL;
			$FormSelect['FormSelectClass'] = 'ShortForm';
			$FormSelect['FormSelectDir'] = 'ltr';
			$FormSelect['FormSelectID'] = NULL;
			$FormSelect['FormSelectLang'] = 'en-us';
			$FormSelect['FormSelectStyle'] = 'width: 550px;';
			$FormSelect['FormSelectTabIndex'] = NULL;
			$FormSelect['FormSelectTitle'] = NULL;
			$FormSelect['FormSelectXMLLang'] = 'en-us';
			$FormSelect['Enable/Disable'] = 'Enable';
			$FormSelect['Status'] = 'Approved';
	
			$FormOptionText = $hold['FilteredInput']['PageTitle'];
			$FormOptionValue = $NewSimpleViewerPage;
			$FormOptionValue .= ' - ';
			$FormOptionValue .= $NewPageID;
			
			$FormOption = array();
			$FormOption['PageID'] = $UpdatePageSelect;
			$FormOption['ObjectID'] = $NewSimpleViewerPage;
			$FormOption['FormOptionText'] = $FormOptionText;
			$FormOption['FormOptionTextDynamic'] = 'false';
			$FormOption['FormOptionTextTableName'] = NULL;
			$FormOption['FormOptionTextField'] = NULL;
			$FormOption['FormOptionTextPageID'] = NULL;
			$FormOption['FormOptionTextObjectID'] = NULL;
			$FormOption['FormOptionTextRevisionID'] = NULL;
			$FormOption['FormOptionDisabled'] = NULL;
			$FormOption['FormOptionLabel'] = NULL;
			$FormOption['FormOptionLabelDynamic'] = NULL;
			$FormOption['FormOptionLabelTableName'] = NULL;
			$FormOption['FormOptionLabelField'] = NULL;
			$FormOption['FormOptionLabelPageID'] = NULL;
			$FormOption['FormOptionLabelObjectID'] = NULL;
			$FormOption['FormOptionLabelRevisionID'] = NULL;
			$FormOption['FormOptionSelected'] = NULL;
			$FormOption['FormOptionValue'] = &$FormOptionValue;
			$FormOption['FormOptionValueDynamic'] = NULL;
			$FormOption['FormOptionValueTableName'] = NULL;
			$FormOption['FormOptionValueField'] = NULL;
			$FormOption['FormOptionValuePageID'] = NULL;
			$FormOption['FormOptionValueObjectID'] = NULL;
			$FormOption['FormOptionValueRevisionID'] = NULL;
			$FormOption['FormOptionClass'] = NULL;
			$FormOption['FormOptionDir'] = 'ltr';
			$FormOption['FormOptionID'] = NULL;
			$FormOption['FormOptionLang'] = 'en-us';
			$FormOption['FormOptionStyle'] = NULL;
			$FormOption['FormOptionTitle'] = NULL;
			$FormOption['FormOptionXMLLang'] = 'en-us';
			$FormOption['Enable/Disable'] = 'Enable';
			$FormOption['Status'] = 'Approved';
			
			$FormOptionArray = array();
			$FormSelectionArray = array();
			
			if ($GalleryLookup != NULL) {
				$Tier6Databases->ModulePass('XhtmlSimpleViewer', 'simpleviewer', 'createFlashLookup', $GalleryLookup);
			}
			
			if ($SimpleViewer != NULL) {
				$Tier6Databases->ModulePass('XhtmlSimpleViewer', 'simpleviewer', 'createSimpleViewer', $SimpleViewer);
			}
			
			$Tier6Databases->ModulePass('XhtmlContent', 'content', 'createContent', $Content);
			$Tier6Databases->ModulePass('XhtmlHeader', 'header', 'createHeader', $Header);
			$Tier6Databases->ModulePass('XhtmlMenu', 'headerpanel1', 'createMenu', $HeaderPanel1);
			$Tier6Databases->createContentVersion($ContentLayerVersion, 'ContentLayerVersion');
			$Tier6Databases->ModulePass('XhtmlContent', 'content', 'createContentPrintPreview', $ContentPrintPreview);
			////////$Tier6Databases->createContent($ContentLayer, 'ContentLayer');
			
			$Tier6Databases->ModulePass('XhtmlMainMenu', 'mainmenu', 'createMainMenuItemLookup', $MainMenuItemLookup);
	
			$Tier6Databases->ModulePass('XmlSitemap', 'sitemap', 'createSitemapItem', $Sitemap);
			
			$UpdateSimpleViewerPageSelect = $Options['XhtmlSimpleViewer']['simpleviewer']['SimpleViewerPageUpdateSelectPage']['SettingAttribute'];
			$FormSelect['PageID'] = $UpdateSimpleViewerPageSelect;
			$FormOption['PageID'] = $UpdateSimpleViewerPageSelect;
			
			/////$FormOptionArray[] = $FormOption;
			/////$FormSelectionArray[] = $FormSelect;
			
			$Tier6Databases->ModulePass('XhtmlForm', 'form', 'createFormOption', $FormOption);
			$Tier6Databases->ModulePass('XhtmlForm', 'form', 'createFormSelect', $FormSelect);
			
			$DeleteSimpleViewerPage = $Options['XhtmlSimpleViewer']['simpleviewer']['SimpleViewerPageDeleteSelectPage']['SettingAttribute'];
			$FormSelect['PageID'] = $DeleteSimpleViewerPage;
			$FormOption['PageID'] = $DeleteSimpleViewerPage;
			
			////$FormOptionArray[] = $FormOption;
			////$FormSelectionArray[] = $FormSelect;
			
			$Tier6Databases->ModulePass('XhtmlForm', 'form', 'createFormOption', $FormOption);
			$Tier6Databases->ModulePass('XhtmlForm', 'form', 'createFormSelect', $FormSelect);
			
			$EnableDisableStatusChangeSimpleViewerPage = $Options['XhtmlSimpleViewer']['simpleviewer']['SimpleViewerPageEnableDisableSelectPage']['SettingAttribute'];
			$FormSelect['PageID'] = $EnableDisableStatusChangeSimpleViewerPage;
			$FormOption['PageID'] = $EnableDisableStatusChangeSimpleViewerPage;
			
			////$FormOptionArray[] = $FormOption;
			////$FormSelectionArray[] = $FormSelect;
			
			$Tier6Databases->ModulePass('XhtmlForm', 'form', 'createFormOption', $FormOption);
			$Tier6Databases->ModulePass('XhtmlForm', 'form', 'createFormSelect', $FormSelect);
			
			$FormOptionValue = $NewPageID;
			$FormOptionValue .= ' - ';
			$FormOptionValue .= 'NULL';
			
			require('../../ModuleFormSubmissions/Tier6ContentLayer/Extended/XhtmlMainMenu/AddMainMenu.php');
			
			////$Tier6Databases->ModulePass('XhtmlForm', 'form', 'createFormSelect', $FormSelectionArray);
			////$Tier6Databases->ModulePass('XhtmlForm', 'form', 'createFormOption', $FormOptionArray);
			
			$sessionname = $Tier6Databases->SessionStart('AddedSimpleViewerPage');
	
			$Page = '../../../index.php?PageID=';
			$Page .= $NewPageID;
			
			$_SESSION['POST']['Error']['Link'] = '<a href=\'';
			$_SESSION['POST']['Error']['Link'] .= $Page;
			$_SESSION['POST']['Error']['Link'] .= '\'>Added SimpleViewer Page</a>';
			
			$SimpleViewerPageCreatedPage = $Options['XhtmlSimpleViewer']['simpleviewer']['SimpleViewerPageCreatedPage']['SettingAttribute'];
			
			if ($LogPage === TRUE) {
				$LogFile = "AddSimpleViewerPage.txt";
				$LogFileHandle = fopen($LogFile, 'a');
				$FileInformation = 'Logging - Add Simple Viewer Page Bottom Script - ' . $NewPageID . ' - ' . date("F j, Y, g:i a") . "\n";
				fwrite($LogFileHandle, $FileInformation);
				fwrite($LogFileHandle, print_r($SimpleViewerPageCreatedPage, TRUE));
				fwrite($LogFileHandle, "\n---------------------------------------------\n\n");
				fclose($LogFileHandle);
			}
			
			header("Location: $SimpleViewerPageCreatedPage&SessionID=$sessionname");
			exit;
		} else {
			//print "I DID NOT MAKE IT\n";
		}
		
	} else {
		header("Location: ../../index.php");
		exit;
	}
?>