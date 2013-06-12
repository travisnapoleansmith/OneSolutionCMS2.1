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
	
	if ($ReferPageID === 'PageID=27') {
		$LogPage = FALSE;
		
		if ($LogPage === TRUE) {
			$LogFile = "AddMenuItem.txt";
			$LogFileHandle = fopen($LogFile, 'a');
			$FileInformation = 'Logging - Add Menu Item Script Loading - ' . date("F j, Y, g:i a") . "\n";
			fwrite($LogFileHandle, $FileInformation);
			fwrite($LogFileHandle, print_r($_SERVER['HTTP_REFERER'], TRUE));
			fwrite($LogFileHandle, "\n---------------------------------------------\n\n");
			fclose($LogFileHandle);
		}
	
		$HOME = $_SERVER['SUBDOMAIN_DOCUMENT_ROOT'];
		$ADMINHOME = $HOME . '/Administrators/';
		$GLOBALS['HOME'] = $HOME;
		$GLOBALS['ADMINHOME'] = $ADMINHOME;
	
		require_once ("$ADMINHOME/Configuration/includes.php");
		
		$Options = $Tier6Databases->getLayerModuleSetting();
		
		$MenuName = $_POST['MenuName'];
		$MenuTitle = $_POST['MenuTitle'];
		$MenuLink = $_POST['MenuLink'];
		$EnableDisable = $_POST['EnableDisable'];
		$Status = $_POST['Status'];
		
		$PageName = "../../index.php?PageID=";
		$PageName .= $_POST['AddMenuItem'];
		
		// Menu Information - Post Checking For NULL Elements
		$temp = $Tier6Databases->PostCheck ('MenuName', NULL, $_POST);
		if (!is_null($temp)) {
			$_POST = $temp;
		}
		
		$temp = $Tier6Databases->PostCheck ('MenuTitle', NULL, $_POST);
		if (!is_null($temp)) {
			$_POST = $temp;
		}

		$temp = $Tier6Databases->PostCheck ('MenuLink', NULL, $_POST);
		if (!is_null($temp)) {
			$_POST = $temp;
		}
		
		$hold = $Tier6Databases->FormSubmitValidate('AddMenuItem', $PageName);
		
		if ($hold) {
			$sessionname = $Tier6Databases->SessionStart('CreateMenuItem');
			print_r($_POST);
			print_r($hold);
			// Menu Information - Post Checking For NULL Elements
			$temp = $Tier6Databases->PostCheck ('MenuName', 'FilteredInput', $hold);
			if (!is_null($temp)) {
				$hold = $temp;
			}
			
			$temp = $Tier6Databases->PostCheck ('MenuTitle', 'FilteredInput', $hold);
			if (!is_null($temp)) {
				$hold = $temp;
			}
			
			$temp = $Tier6Databases->PostCheck ('MenuLink', 'FilteredInput', $hold);
			if (!is_null($temp)) {
				$hold = $temp;
			}
			
			$MenuName = $_POST['MenuName'];
			$MenuTitle = $_POST['MenuTitle'];
			$MenuLink = $_POST['MenuLink'];
			$EnableDisable = $_POST['EnableDisable'];
			$Status = $_POST['Status'];
			
			$_SESSION['POST'] = $_POST;
			$DateTime = date('Y-m-d H:i:s');
			$Date = date('Y-m-d');
			$SiteName = $GLOBALS['sitename'];
			
			$LastMenuItem = $Options['XhtmlMainMenu']['mainmenu']['LastMenuItem']['SettingAttribute'];
			$NewMenuItem = ++$LastMenuItem;
			//$Tier6Databases->updateModuleSetting('XhtmlMainMenu', 'mainmenu', 'LastMenuItem', $NewMenuItem);
			
			if (isset($LastMenuItem)) {
				$StartPageID = $Options['XhtmlMainMenu']['mainmenu']['StartPageID']['SettingAttribute'];
				$LastPageID = $StartPageID + $LastMenuItem - 1;
			}
			
			if (isset($LastPageID)) {
				$NewPageID = $LastPageID;
			} else {
				$NewPageID = $StartPageID;
			}
			
			if ($LogPage === TRUE) {
				$LogFile = "AddMenuItem.txt";
				$LogFileHandle = fopen($LogFile, 'a');
				$FileInformation = 'Logging - Add Menu Item Top Script - ' . $NewPageID . ' - ' . date("F j, Y, g:i a") . "\n";
				fwrite($LogFileHandle, $FileInformation);
				//fwrite($LogFileHandle, print_r($ImageContent, TRUE));
				fwrite($LogFileHandle, "\n---------------------------------------------\n\n");
				fclose($LogFileHandle);
			}
			
			$NewPage = '../../../index.php?PageID=';
			$NewPage .= $NewPageID;
	
			$Location = 'index.php?PageID=';
			$Location .= $NewPageID;
	
			$NewRevisionID = 0;
			
			// General Defines
			define(NewPageID, $NewPageID);
			define(CurrentVersionTrueFalse, 'true');
			define(ContentPageType, 'MenuItem');
	
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
			
			$PageID = array();
			$PageID['PageID'] = $NewPageID;
	
			$ContentLayerVersion = parse_ini_file('../../ModuleSettings/Tier6-ContentLayer/GlobalSettings/AddContentLayerVersion.ini',FALSE);
			$ContentLayerVersion = $Tier6Databases->EmptyStringToNullArray($ContentLayerVersion);
	
			$MainMenuItemLookup = parse_ini_file('../../ModuleSettings/Tier6-ContentLayer/Modules/XhtmlMainMenu/AddMainMenuItemLookup.ini',FALSE);
			$MainMenuItemLookup = $Tier6Databases->EmptyStringToNullArray($MainMenuItemLookup);
			
			$UpdateMenuItemSelect = $Options['XhtmlMainMenu']['mainmenu']['UpdateMenuItemSelect']['SettingAttribute'];
			$FormSelect = array();
			$FormSelect['PageID'] = $UpdateMenuItemSelect;
			$FormSelect['ObjectID'] = $NewMenuItem;
			$FormSelect['StopObjectID'] = NULL;
			$FormSelect['ContinueObjectID'] = NULL;
			$FormSelect['ContainerObjectType'] = 'Option';
			$FormSelect['ContainerObjectTypeName'] = 'AdministratorFormOption';
			$FormSelect['ContainerObjectID'] = $NewMenuItem;
			$FormSelect['FormSelectDisabled'] = NULL;
			$FormSelect['FormSelectMultiple'] = NULL;
			$FormSelect['FormSelectName'] = 'MenuItem';
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
			$FormOptionValue = $LastPageID;
			$FormOptionValue .= ' - ';
			$FormOptionValue .= $NewMenuItem;
			$FormOptionValue .= ' - ';
			$FormOptionValue .= $MenuLink;
			
			$FormOption = array();
			$FormOption['PageID'] = $UpdateMenuItemSelect;
			$FormOption['ObjectID'] = $NewMenuItem;
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
			
			print_r($ContentLayerVersion);
			print_r($MainMenuItemLookup);
			print_r($FormSelect);
			print_r($FormOption);
			/*			
			$Tier6Databases->createContentVersion($ContentLayerVersion, 'ContentLayerVersion');
			
			$Tier6Databases->ModulePass('XhtmlMainMenu', 'mainmenu', 'createMainMenuItemLookup', $MainMenuItemLookup);
				
			$UpdateVideosPageSelect = $Options['XhtmlContent']['content']['UpdateVideosPageSelect']['SettingAttribute'];
			$FormSelect['PageID'] = $UpdateVideosPageSelect;
			$FormOption['PageID'] = $UpdateVideosPageSelect;
			
			//$FormOptionArray[] = $FormOption;
			//$FormSelectionArray[] = $FormSelect;
			
			$Tier6Databases->ModulePass('XhtmlForm', 'form', 'createFormOption', $FormOption);
			$Tier6Databases->ModulePass('XhtmlForm', 'form', 'createFormSelect', $FormSelect);
			
			$DeleteVideosPage = $Options['XhtmlContent']['content']['DeleteVideosPage']['SettingAttribute'];
			$FormSelect['PageID'] = $DeleteVideosPage;
			$FormOption['PageID'] = $DeleteVideosPage;
			
			//$FormOptionArray[] = $FormOption;
			//$FormSelectionArray[] = $FormSelect;
			
			$Tier6Databases->ModulePass('XhtmlForm', 'form', 'createFormOption', $FormOption);
			$Tier6Databases->ModulePass('XhtmlForm', 'form', 'createFormSelect', $FormSelect);
			
			$EnableDisableStatusChangeVideosPage = $Options['XhtmlContent']['content']['EnableDisableStatusChangeVideosPage']['SettingAttribute'];
			$FormSelect['PageID'] = $EnableDisableStatusChangeVideosPage;
			$FormOption['PageID'] = $EnableDisableStatusChangeVideosPage;
			
			//$FormOptionArray[] = $FormOption;
			//$FormSelectionArray[] = $FormSelect;
			
			$Tier6Databases->ModulePass('XhtmlForm', 'form', 'createFormOption', $FormOption);
			$Tier6Databases->ModulePass('XhtmlForm', 'form', 'createFormSelect', $FormSelect);
			
			$FormOptionValue = $NewPageID;
			$FormOptionValue .= ' - ';
			$FormOptionValue .= 'NULL';
			
			require('../../ModuleFormSubmissions/Tier6ContentLayer/Extended/XhtmlMainMenu/AddMainMenu.php');
			
			//$Tier6Databases->ModulePass('XhtmlForm', 'form', 'createFormSelect', $FormSelectionArray);
			//$Tier6Databases->ModulePass('XhtmlForm', 'form', 'createFormOption', $FormOptionArray);
			
			$sessionname = $Tier6Databases->SessionStart('AddedVideosPage');
	
			$Page = '../../../index.php?PageID=';
			$Page .= $NewPageID;
			
			$_SESSION['POST']['Error']['Link'] = '<a href=\'';
			$_SESSION['POST']['Error']['Link'] .= $Page;
			$_SESSION['POST']['Error']['Link'] .= '\'>Added Videos Page</a>';
			
			$VideosPageCreatedPage = $Options['XhtmlContent']['content']['VideosPageCreatedPage']['SettingAttribute'];
			
			if ($LogPage === TRUE) {
				$LogFile = "AddMenuItem.txt";
				$LogFileHandle = fopen($LogFile, 'a');
				$FileInformation = 'Logging - Add Menu Item Bottom Script - ' . $NewPageID . ' - ' . date("F j, Y, g:i a") . "\n";
				fwrite($LogFileHandle, $FileInformation);
				fwrite($LogFileHandle, print_r($VideosPageCreatedPage, TRUE));
				fwrite($LogFileHandle, "\n---------------------------------------------\n\n");
				fclose($LogFileHandle);
			}
			
			header("Location: $VideosPageCreatedPage&SessionID=$sessionname");
			exit;
			*/
		} else {
			//print "I DID NOT MAKE IT\n";
		}
	} else {
		header("Location: ../../index.php");
		exit;
	}
?>