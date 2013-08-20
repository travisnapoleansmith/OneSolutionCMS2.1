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
	
	if ($ReferPageID === 'PageID=220') {
		$LogPage = FALSE;
		
		if ($LogPage === TRUE) {
			$LogFile = "AddSimpleViewerGallery.txt";
			$LogFileHandle = fopen($LogFile, 'a');
			$FileInformation = 'Logging - Add SimpleViewer Gallery Script Loading - ' . date("F j, Y, g:i a") . "\n";
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
		
		$EnableDisable = $_POST['EnableDisable'];
		$Status = $_POST['Status'];
		
		$PageName = "../../index.php?PageID=";
		$PageName .= $_POST['AddSimpleViewerGallery'];
	
		$FileLocation = 'TEMPFILES/';
		
		$TempGallery = array();
		$Gallery = array();
		$AddLookupData = array();
		
		foreach ($_POST as $Key => $Value) {
			if ($Key !== 'AddSimpleViewerGallery') {
				if ($Key !== 'ImageLocation') {
					if (strstr($Key, "Image")) {
						$TempGallery[$Key] = $Value;
						$AddLookupData[$Key] = $Value;
					}
				}
			}
		}

		foreach ($TempGallery as $Key => $Value) {
			$NewKey = explode('_', $Key);
			$ImageName = $NewKey[0];
			$SubKey = $NewKey[1];
			if ($SubKey === 'Caption') {
				$Gallery[$ImageName][$SubKey] = $Value;
			} else {
				switch ($SubKey) {
					case "ImageUrl":
						$Gallery[$ImageName]['Attributes']['imageURL'] = $Value;
						break;
					case "ThumbUrl":
						$Gallery[$ImageName]['Attributes']['thumbURL'] = $Value;
						break;
					case "LinkUrl":
						$Gallery[$ImageName]['Attributes']['linkURL'] = $Value;
						break;
					case "LinkTarget":
						$Gallery[$ImageName]['Attributes']['linkTarget'] = $Value;
						break;
					default:
						$Gallery[$ImageName]['Attributes'][$SubKey] = $Value;
				}
			}
		}
		
		$XMLOptions = array();
		$XMLOptions['RootElementName'] = 'simpleviewergallery';
		$XMLOptions['Skip'] = 'SKIP';
		$XMLOptions['Repeat']['image']['name'] = 'image';
		
		$hold = $Tier6Databases->FormSubmitValidate('AddSimpleViewerGallery', $PageName, $FileLocation, $Gallery, 'image', $AddLookupData, $XMLOptions);
		
		if ($hold) {
			$sessionname = $Tier6Databases->SessionStart('CreateSimpleViewerGallery');
			$_SESSION['POST'] = $_POST;
			$DateTime = date('Y-m-d H:i:s');
			$Date = date('Y-m-d');
			$SiteName = $GLOBALS['sitename'];
			
			$GalleryName = $hold['FilteredInput']['GalleryName'];
			$GalleryHeading = $hold['FilteredInput']['GalleryHeading'];
			$ImageLocation = $hold['FilteredInput']['ImageLocation'];
			$ThumbLocation = $hold['FilteredInput']['ThumbLocation'];
			$LinkLocation = $hold['FilteredInput']['LinkLocation'];
			
			if ($LogPage === TRUE) {
				$LogFile = "AddSimpleViewerGallery.txt";
				$LogFileHandle = fopen($LogFile, 'a');
				$FileInformation = 'Logging - Add SimpleViewer Gallery Top Script - ' . $NewPageID . ' - ' . date("F j, Y, g:i a") . "\n";
				fwrite($LogFileHandle, $FileInformation);
				//fwrite($LogFileHandle, print_r($ImageContent, TRUE));
				fwrite($LogFileHandle, "\n---------------------------------------------\n\n");
				fclose($LogFileHandle);
			}
			
			$LastSimpleViewerGallery = $Options['XhtmlSimpleViewer']['simpleviewer']['LastGallery']['SettingAttribute'];
			$NewSimpleViewerGallery = ++$LastSimpleViewerGallery;
			$Tier6Databases->updateModuleSetting('XhtmlSimpleViewer', 'simpleviewer', 'LastGallery', $NewSimpleViewerGallery);
			
			$NewPage = '../../../index.php?PageID=';
			$NewPage .= $NewPageID;
	
			$Location = 'index.php?PageID=';
			$Location .= $NewPageID;
			
			$NewRevisionID = 1;
			
			
			// POST Check For NULL Elements
			$temp = $Tier6Databases->PostCheck ('GalleryName', 'FilteredInput', $hold);
			if (!is_null($temp)) {
				$hold = $temp;
			}
			
			$temp = $Tier6Databases->PostCheck ('GalleryHeading', 'FilteredInput', $hold);
			if (!is_null($temp)) {
				$hold = $temp;
			}
			
			$temp = $Tier6Databases->PostCheck ('ImageLocation', 'FilteredInput', $hold);
			if (!is_null($temp)) {
				$hold = $temp;
			}
			
			$temp = $Tier6Databases->PostCheck ('ThumbLocation', 'FilteredInput', $hold);
			if (!is_null($temp)) {
				$hold = $temp;
			}
			
			$temp = $Tier6Databases->PostCheck ('LinkLocation', 'FilteredInput', $hold);
			if (!is_null($temp)) {
				$hold = $temp;
			}
			
			// SimpleViewer Gallery - Post Checking For NULL Elements
			$temp = $Tier6Databases->MultiPostCheck('Image', 1, $hold, '_', NULL, 'ImageUrl');
			if ($temp != NULL) {
				$hold = $temp;
			}
			
			$temp = $Tier6Databases->MultiPostCheck('Image', 1, $hold, '_', NULL, 'ThumbUrl');
			if ($temp != NULL) {
				$hold = $temp;
			}
			
			$temp = $Tier6Databases->MultiPostCheck('Image', 1, $hold, '_', NULL, 'LinkUrl');
			if ($temp != NULL) {
				$hold = $temp;
			}
			
			$temp = $Tier6Databases->MultiPostCheck('Image', 1, $hold, '_', NULL, 'LinkTarget');
			if ($temp != NULL) {
				$hold = $temp;
			}
			
			
			$temp = $Tier6Databases->MultiPostCheck('Image', 1, $hold, '_', NULL, 'Caption');
			if ($temp != NULL) {
				$hold = $temp;
			}
			
			// GALLERY DATA
			$TempGallery = array();
			$Gallery = array();
			
			foreach ($_POST as $Key => $Value) {
				if ($Key !== 'AddSimpleViewerGallery') {
					if ($Key !== 'ImageLocation') {
						if (strstr($Key, "Image")) {
							$TempGallery[$Key] = $Value;
							$AddLookupData[$Key] = $Value;
						}
					}
				}
			}
			
			foreach ($TempGallery as $Key => $Value) {
				$NewKey = explode('_', $Key);
				$ImageName = $NewKey[0];
				$SubKey = $NewKey[1];
				
				switch ($SubKey) {
					case "ImageUrl":
						$Gallery[$ImageName][$SubKey] = $ImageLocation . $Value;
						break;
					case "ThumbUrl":
						$Gallery[$ImageName][$SubKey] = $ThumbLocation . $Value;
						break;
					case "LinkUrl":
						$Gallery[$ImageName][$SubKey] = $LinkLocation . $Value;
						break;
					case "Caption":
						if ($Value != NULL) {
							$Gallery[$ImageName][$SubKey] = $Value;
						} else {
							$Gallery[$ImageName][$SubKey] = '<![CDATA[]]>';
						}
						break;
					default:
						$Gallery[$ImageName][$SubKey] = $Value;
						break;
				}
			}
			
			unset($TempGallery);
			
			$SimpleViewerGallery = array();
			$i = 0;
			$ImageID = 1;
			
			if (is_array($Gallery)) {
				foreach ($Gallery as $GalleryImage => $GalleryData) {
					$SimpleViewerGallery[$i]['PageID'] = $NewSimpleViewerGallery;
					$SimpleViewerGallery[$i]['ObjectID'] = $ImageID;
					$SimpleViewerGallery[$i]['RevisionID'] = $NewRevisionID;
					$SimpleViewerGallery[$i]['CurrentVersion'] = 'true';
					$SimpleViewerGallery[$i]['ImageUrl'] = $GalleryData['ImageUrl'];
					$SimpleViewerGallery[$i]['ThumbUrl'] = $GalleryData['ThumbUrl'];
					$SimpleViewerGallery[$i]['LinkUrl'] = $GalleryData['LinkUrl'];
					$SimpleViewerGallery[$i]['LinkTarget'] = $GalleryData['LinkTarget'];
					$SimpleViewerGallery[$i]['Caption'] = $GalleryData['Caption'];
					$SimpleViewerGallery[$i]['Enable/Disable'] = $EnableDisable;
					$SimpleViewerGallery[$i]['Status'] = $Status;
					
					$i++;
					$ImageID++;
				}
			}
						
			$i = 0;
			
			$SimpleViewerGalleryLookup = array();
			$SimpleViewerGalleryLookup[$i]['PageID'] = $NewSimpleViewerGallery;
			$SimpleViewerGalleryLookup[$i]['ObjectID'] = 1;
			$SimpleViewerGalleryLookup[$i]['RevisionID'] = $NewRevisionID;
			$SimpleViewerGalleryLookup[$i]['CurrentVersion'] = 'true';
			$SimpleViewerGalleryLookup[$i]['StopObjectID'] = NULL;
			$SimpleViewerGalleryLookup[$i]['ContinueObjectID'] = NULL;
			$SimpleViewerGalleryLookup[$i]['XMLSimpleViewerTableName'] = 'XMLSimpleViewer';
			$SimpleViewerGalleryLookup[$i]['XMLSimpleViewerObjectID'] = 1;
			$SimpleViewerGalleryLookup[$i]['XMLSimpleViewerGalleryStyle'] = 'MODERN';
			$SimpleViewerGalleryLookup[$i]['XMLSimpleViewerGalleryWidth'] = 50;
			$SimpleViewerGalleryLookup[$i]['XMLSimpleViewerGalleryHeight'] = '100%';
			$SimpleViewerGalleryLookup[$i]['XMLSimpleViewerName'] = $GalleryName;
			$SimpleViewerGalleryLookup[$i]['XMLSimpleViewerTitle'] = $GalleryHeading;
			$SimpleViewerGalleryLookup[$i]['XMLSimpleViewerTextColor'] = 'FFFFFF';
			$SimpleViewerGalleryLookup[$i]['XMLSimpleViewerFrameColor'] = 'FFFFFF';
			$SimpleViewerGalleryLookup[$i]['XMLSimpleViewerFrameWidth'] = 2;
			$SimpleViewerGalleryLookup[$i]['XMLSimpleViewerThumbPosition'] = 'BOTTOM';
			$SimpleViewerGalleryLookup[$i]['XMLSimpleViewerThumbColumns'] = 6;
			$SimpleViewerGalleryLookup[$i]['XMLSimpleViewerThumbRows'] = 1;
			$SimpleViewerGalleryLookup[$i]['XMLSimpleViewerThumbWidth'] = 75;
			$SimpleViewerGalleryLookup[$i]['XMLSimpleViewerThumbHeight'] = 75;
			$SimpleViewerGalleryLookup[$i]['XMLSimpleViewerThumbQuality'] = 90;
			$SimpleViewerGalleryLookup[$i]['XMLSimpleViewerShowOpenButton'] = 'FALSE';
			$SimpleViewerGalleryLookup[$i]['XMLSimpleViewerShowFullscreenButton'] = 'FALSE';
			$SimpleViewerGalleryLookup[$i]['XMLSimpleViewerImageQuality'] = 80;
			$SimpleViewerGalleryLookup[$i]['XMLSimpleViewerMaxImageWidth'] = 500;
			$SimpleViewerGalleryLookup[$i]['XMLSimpleViewerMaxImageHeight'] = 300;
			$SimpleViewerGalleryLookup[$i]['XMLSimpleViewerUseFlickr'] = 'FALSE';
			$SimpleViewerGalleryLookup[$i]['XMLSimpleViewerFlickrUserName'] = NULL;
			$SimpleViewerGalleryLookup[$i]['XMLSimpleViewerFlickrTags'] = NULL;
			$SimpleViewerGalleryLookup[$i]['XMLSimpleViewerLanguageCode'] = NULL;
			$SimpleViewerGalleryLookup[$i]['XMLSimpleViewerLanguageList'] = NULL;
			$SimpleViewerGalleryLookup[$i]['XMLSimpleViewerImagePath'] = NULL;
			$SimpleViewerGalleryLookup[$i]['XMLSimpleViewerThumbPath'] = NULL;
			$SimpleViewerGalleryLookup[$i]['Enable/Disable'] = $EnableDisable;
			$SimpleViewerGalleryLookup[$i]['Status'] = $Status;
			
			$Flash = array();
			
			$Flash[$i]['PageID'] = $NewSimpleViewerGallery;
			$Flash[$i]['ObjectID'] = 1;
			$Flash[$i]['RevisionID'] = $NewRevisionID;
			$Flash[$i]['CurrentVersion'] = 'true';
			$Flash[$i]['FlashPath'] = 'Libraries/Tier6ContentLayer/SimpleViewers/SimpleViewer/svcore/swf/simpleviewer.swf';
			$Flash[$i]['Width'] = '100%';
			$Flash[$i]['Height'] = '90%';
			$Flash[$i]['Wmode'] = 'transparent';
			$Flash[$i]['AllowFullScreen'] = 'true';
			$Flash[$i]['AllowScriptAccess'] = 'true';
			$Flash[$i]['Quality'] = 'high';
			$Flash[$i]['AltText'] = NULL;
			$Flash[$i]['FlashID'] = NULL;
			$Flash[$i]['FlashStyle'] = NULL;
			$Flash[$i]['FlashClass'] = NULL;
			$Flash[$i]['StartTag'] = NULL;
			$Flash[$i]['EndTag'] = NULL;
			$Flash[$i]['StartTagId'] = NULL;
			$Flash[$i]['StartTagStyle'] = NULL;
			$Flash[$i]['StartTagClass'] = NULL;
			$Flash[$i]['Enable/Disable'] = $EnableDisable;
			$Flash[$i]['Status'] = $Status;
			
			// Flash Lookup - Use On SimpleViewer Page.
			/*$SimpleViewer = array();
			$SimpleViewer[$i]['PageID'] = $NewPageID;
			$SimpleViewer[$i]['ObjectID'] = $ImageID;
			$SimpleViewer[$i]['RevisionID'] = $NewRevisionID;
			$SimpleViewer[$i]['CurrentVersion'] = 'true';
			$SimpleViewer[$i]['SimpleViewerFlashTableName'] = 'FlashSimpleViewerLookup';
			$SimpleViewer[$i]['SimpleViewerFlashObjectName'] = 'flashsimpleviewer';
			$SimpleViewer[$i]['StartTag'] = '<div>';
			$SimpleViewer[$i]['EndTag'] = '</div>';
			$SimpleViewer[$i]['StartTagID'] = 'sv-container';
			$SimpleViewer[$i]['StartTagClass'] = NULL;
			$SimpleViewer[$i]['StartTagStyle'] = NULL;
			$SimpleViewer[$i]['Enable/Disable'] = $EnableDisable;
			$SimpleViewer[$i]['Status'] = $Status;
			*/
			
			// Flash Lookup - Use On SimpleViewer Page.
			/*$FlashLookup = array();
			
			$FlashLookup[$i]['PageID'] = $NewPageID;
			$FlashLookup[$i]['ObjectID'] = $ImageID;
			$FlashLookup[$i]['RevisionID'] = $NewRevisionID;
			$FlashLookup[$i]['CurrentVersion'] = 'true';
			$FlashLookup[$i]['SimpleViewerMenuName'] = NULL;
			$FlashLookup[$i]['SimpleViewerTableName'] = 'FlashSimpleViewer';
			$FlashLookup[$i]['SimpleViewerPageID'] = NULL;
			$FlashLookup[$i]['SimpleViewerObjectID'] = NULL;
			$FlashLookup[$i]['SimpleViewerRevisionID'] = NULL;
			$FlashLookup[$i]['SimpleViewerCurrentVersion'] = NULL;
			$FlashLookup[$i]['Enable/Disable'] = $EnableDisable;
			$FlashLookup[$i]['Status'] = $Status;
			*/
			
			$UpdateSimpleViewerGallerySelect = $Options['XhtmlSimpleViewer']['simpleviewer']['SimpleViewerGalleyUpdateSelectPage']['SettingAttribute'];
			$FormSelect = array();
			$FormSelect['PageID'] = $UpdateSimpleViewerGallerySelect;
			$FormSelect['ObjectID'] = $NewSimpleViewerGallery;
			$FormSelect['StopObjectID'] = 999999;
			$FormSelect['ContinueObjectID'] = NULL;
			$FormSelect['ContainerObjectType'] = 'Option';
			$FormSelect['ContainerObjectTypeName'] = 'AdministratorFormOption';
			$FormSelect['ContainerObjectID'] = $NewSimpleViewerGallery;
			$FormSelect['FormSelectDisabled'] = NULL;
			$FormSelect['FormSelectMultiple'] = NULL;
			$FormSelect['FormSelectName'] = 'SimpleViewerGallery';
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
	
			$FormOptionText = $NewSimpleViewerGallery . ' - ' . $hold['FilteredInput']['GalleryName'];
			
			$FormOption = array();
			$FormOption['PageID'] = $UpdateSimpleViewerGallerySelect;
			$FormOption['ObjectID'] = $NewSimpleViewerGallery;
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
			$FormOption['FormOptionValue'] = $NewSimpleViewerGallery;
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
			
			$GalleryUrl = "/Modules/Tier6ContentLayer/User/XhtmlSimpleViewer/XmlSimpleViewer.php?PageID=";
			$GalleryUrl .= $NewSimpleViewerGallery;
			$GalleryUrl .= '%26ObjectID=';
			$GalleryUrl .= 1;
			
			$PageID = array();
			$PageID['PageID'] = $NewSimpleViewerGallery;
			$PageID['ObjectID'] = 1;
			$PageID['RevisionID'] = $NewRevisionID;
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
			
			$Tier6Databases->ModulePass('XhtmlSimpleViewer', 'simpleviewer', 'createFlash', $Flash);
			
			$FlashDatabase = Array();
			$FlashDatabase['XMLSimpleViewerLookup'] = 'XMLSimpleViewerLookup';
			
			$DatabaseOptions = Array();
			
			$SimpleViewerObject = new XmlSimpleViewer ($FlashDatabase, $DatabaseOptions, $Tier6Databases);
			$SimpleViewerObject->setDatabaseAll ($credentaillogonarray[0], $credentaillogonarray[1], $credentaillogonarray[2], $credentaillogonarray[3], 'XMLSimpleViewerLookup');
			$SimpleViewerObject->setHttpUserAgent($_SERVER['HTTP_USER_AGENT']);
			
			$SimpleViewerObject->createLookupGallery($SimpleViewerGalleryLookup);
			
			$SimpleViewerObject->FetchDatabase ($PageID);
			$SimpleViewerObject->CreateOutput('    ');
			
			$SimpleViewerObject->createGallery($SimpleViewerGallery);
			
			$UpdateSimpleViewerGallerySelect = $Options['XhtmlSimpleViewer']['simpleviewer']['SimpleViewerGalleyUpdateSelectPage']['SettingAttribute'];
			$FormSelect['PageID'] = $UpdateSimpleViewerGallerySelect;
			$FormOption['PageID'] = $UpdateSimpleViewerGallerySelect;
			
			$Tier6Databases->ModulePass('XhtmlForm', 'form', 'createFormOption', $FormOption);
			$Tier6Databases->ModulePass('XhtmlForm', 'form', 'createFormSelect', $FormSelect);
			
			$DeleteSimpleViewerGallery = $Options['XhtmlSimpleViewer']['simpleviewer']['SimpleViewerGalleyDeleteSelectPage']['SettingAttribute'];
			$FormSelect['PageID'] = $DeleteSimpleViewerGallery;
			$FormOption['PageID'] = $DeleteSimpleViewerGallery;
			
			$Tier6Databases->ModulePass('XhtmlForm', 'form', 'createFormOption', $FormOption);
			$Tier6Databases->ModulePass('XhtmlForm', 'form', 'createFormSelect', $FormSelect);
			
			$EnableDisableStatusChangeSimpleViewerGallery = $Options['XhtmlSimpleViewer']['simpleviewer']['SimpleViewerGalleyEnableDisableSelectPage']['SettingAttribute'];
			$FormSelect['PageID'] = $EnableDisableStatusChangeSimpleViewerGallery;
			$FormOption['PageID'] = $EnableDisableStatusChangeSimpleViewerGallery;
			
			$Tier6Databases->ModulePass('XhtmlForm', 'form', 'createFormOption', $FormOption);
			$Tier6Databases->ModulePass('XhtmlForm', 'form', 'createFormSelect', $FormSelect);
			
			$SimpleViewerGalleryCreatedPage = $Options['XhtmlSimpleViewer']['simpleviewer']['SimpleViewerGalleyCreatedPage']['SettingAttribute'];
			
			if ($LogPage === TRUE) {
				$LogFile = "AddSimpleViewerGallery.txt";
				$LogFileHandle = fopen($LogFile, 'a');
				$FileInformation = 'Logging - Add SimpleViewer Gallery Bottom Script - ' . $NewSimpleViewerGallery . ' - ' . date("F j, Y, g:i a") . "\n";
				fwrite($LogFileHandle, $FileInformation);
				fwrite($LogFileHandle, print_r($SimpleViewerGallery, TRUE));
				fwrite($LogFileHandle, print_r($SimpleViewerGalleryLookup, TRUE));
				fwrite($LogFileHandle, print_r($Flash, TRUE));
				fwrite($LogFileHandle, "\n---------------------------------------------\n\n");
				fclose($LogFileHandle);
			}
			
			header("Location: $SimpleViewerGalleryCreatedPage&GalleryID=$NewSimpleViewerGallery");
			exit;
		} else {
			//print "I DID NOT MAKE IT\n";
		}
	} else {
		header("Location: ../../index.php");
		exit;
	}
?>