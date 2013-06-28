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
	$PageName .= $_POST['UpdateMenuItem'];
	
	$hold = $_POST['MenuItemHidden'];
	$hold = explode(' ', $hold);
	$PageID = $hold[0];
	$NewMenuItem = $hold[2];
	
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
	
	$temp = $Tier6Databases->PostCheck ('MenuItemHidden', NULL, $_POST);
	if (!is_null($temp)) {
		$_POST = $temp;
	}
	
	$hold = $Tier6Databases->FormSubmitValidate('UpdateMenuItem', $PageName);
		
	if ($hold) {
		$sessionname = $Tier6Databases->SessionStart('UpdateMenuItem');
		
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
		
		$temp = $Tier6Databases->PostCheck ('MenuItemHidden', 'FilteredInput', $hold);
		if (!is_null($temp)) {
			$hold = $temp;
		}
		
		$MenuItemHidden = $_POST['MenuItemHidden'];
		$MenuName = $_POST['MenuName'];
		$MenuTitle = $_POST['MenuTitle'];
		$MenuLink = $_POST['MenuLink'];
		$EnableDisable = $_POST['EnableDisable'];
		$Status = $_POST['Status'];
			
		$_SESSION['POST'] = $_POST;
		$DateTime = date('Y-m-d H:i:s');
		$Date = date('Y-m-d');
		$SiteName = $GLOBALS['sitename'];
		
		if (isset($LastMenuItem)) {
			$StartPageID = $Options['XhtmlMainMenu']['mainmenu']['StartPageID']['SettingAttribute'];
			$LastPageID = $StartPageID + $LastMenuItem - 1;
		}
		
		if (isset($PageID)) {
			$NewPageID = $PageID;
		}
			
		$NewPage = '../../../index.php?PageID=';
		$NewPage .= $NewPageID;

		$Location = 'index.php?PageID=';
		$Location .= $NewPageID;

		$NewRevisionID = 0;
		
		// General Defines
		define(NewPageID, $NewPageID);
		define(NewRevisionID, $NewRevisionID);
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
		$PageID['RevisionID'] = $NewRevisionID;
		
		$ContentLayerVersion = parse_ini_file('../../ModuleSettings/Tier6-ContentLayer/GlobalSettings/UpdateContentLayerVersion.ini',FALSE);
		$ContentLayerVersion = $Tier6Databases->EmptyStringToNullArray($ContentLayerVersion);

		$MainMenuItemLookup = array();
		$MainMenuItemLookup['PageID'] = 1;
		$MainMenuItemLookup['ObjectID'] = $NewPageID;
		$MainMenuItemLookup['VersionID'] = 1;
		$MainMenuItemLookup['RevisionID'] = 1;
		if ($MenuLink != NULL) {
			$MainMenuItemLookup['PageLocation'] = $MenuLink;
		} else {
			$MainMenuItemLookup['PageLocation'] = NULL;
		}
		
		$UpdateMenuItemSelect = $Options['XhtmlMainMenu']['mainmenu']['UpdateMenuItemSelect']['SettingAttribute'];
		$FormSelect = array();
		//$FormSelect['PageID'] = $UpdateMenuItemSelect;
		//$FormSelect['ObjectID'] = $NewMenuItem;
		//$FormSelect['StopObjectID'] = NULL;
		//$FormSelect['ContinueObjectID'] = NULL;
		//$FormSelect['ContainerObjectType'] = 'Option';
		//$FormSelect['ContainerObjectTypeName'] = 'AdministratorFormOption';
		//$FormSelect['ContainerObjectID'] = $NewMenuItem;
		//$FormSelect['FormSelectDisabled'] = NULL;
		//$FormSelect['FormSelectMultiple'] = NULL;
		//$FormSelect['FormSelectName'] = 'MenuItem';
		//$FormSelect['FormSelectNameDynamic'] = NULL;
		//$FormSelect['FormSelectNameTableName'] = NULL;
		//$FormSelect['FormSelectNameField'] = NULL;
		//$FormSelect['FormSelectNamePageID'] = NULL;
		//$FormSelect['FormSelectNameObjectID'] = NULL;
		//$FormSelect['FormSelectNameRevisionID'] = NULL;
		//$FormSelect['FormSelectSize'] = NULL;
		//$FormSelect['FormSelectClass'] = 'ShortForm';
		//$FormSelect['FormSelectDir'] = 'ltr';
		//$FormSelect['FormSelectID'] = NULL;
		//$FormSelect['FormSelectLang'] = 'en-us';
		//$FormSelect['FormSelectStyle'] = 'width: 550px;';
		//$FormSelect['FormSelectTabIndex'] = NULL;
		//$FormSelect['FormSelectTitle'] = NULL;
		//$FormSelect['FormSelectXMLLang'] = 'en-us';
		$FormSelect['Enable/Disable'] = 'Enable';
		$FormSelect['Status'] = 'Approved';

		$FormOptionText = $hold['FilteredInput']['MenuTitle'];
		$FormOptionValue = $NewPageID;
		$FormOptionValue .= ' - ';
		$FormOptionValue .= $NewMenuItem;
		$FormOptionValue .= ' - ';
		$FormOptionValue .= $MenuLink;
		
		$FormOption = array();
		//$FormOption['PageID'] = $UpdateMenuItemSelect;
		//$FormOption['ObjectID'] = $NewMenuItem;
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
		$FormOption['FormOptionValue'] = &$FormOptionValue;
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
		$FormOption['Enable/Disable'] = 'Enable';
		$FormOption['Status'] = 'Approved';
		
		$FormOptionObjectID = $NewMenuItem;//$NewPageID;
		$FormOptionID = $Options['XhtmlMainMenu']['mainmenu']['UpdateMenuItemSelect']['SettingAttribute'];
		$Tier6Databases->ModulePass('XhtmlForm', 'form', 'updateFormOption', array('PageID' => array('PageID' => $FormOptionID, 'ObjectID' => $FormOptionObjectID), 'Content' => $FormOption));
		
		$FormSelect['Enable/Disable'] = $EnableDisable;
		$FormSelect['Status'] = $Status;
		
		$FormOption['Enable/Disable'] = $EnableDisable;
		$FormOption['Status'] = $Status;
		
		$FormOptionValue = $NewPageID;
		$FormOptionValue .= ' - ';
		$FormOptionValue .= 'NULL';
		$FormOptionValue .= ' - ';
		$FormOptionValue .= $MenuLink;
		
		$FormOptionID = $Options['XhtmlMainMenu']['mainmenu']['MainMenuSelectPage']['SettingAttribute'];
		$Tier6Databases->ModulePass('XhtmlForm', 'form', 'updateFormOption', array('PageID' => array('PageID' => $FormOptionID, 'ObjectID' => $NewPageID), 'Content' => $FormOption));
		$FormOptionID = $Options['XhtmlMainMenu']['mainmenu']['MainMenuUpdatePage']['SettingAttribute'];
		$Tier6Databases->ModulePass('XhtmlForm', 'form', 'updateFormOption', array('PageID' => array('PageID' => $FormOptionID, 'ObjectID' => $NewPageID), 'Content' => $FormOption));

		$Tier6Databases->updateContentVersion($PageID, 'ContentLayerVersion', $ContentLayerVersion);
		
		$Tier6Databases->ModulePass('XhtmlMainMenu', 'mainmenu', 'updateMainMenuItemLookup', $MainMenuItemLookup);
		
		$Page = '../../../index.php?PageID=';
		$Page .= $NewPageID;
		
		$MenuItemCreatedPage = $Options['XhtmlMainMenu']['mainmenu']['CreatedUpdateMenuItem']['SettingAttribute'];
		
		header("Location: $MenuItemCreatedPage");
		exit;
		
	} else {
		//print "I DID NOT MAKE IT\n";
	}
?>