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

	$HOME = $_SERVER['SUBDOMAIN_DOCUMENT_ROOT'];
	$ADMINHOME = $HOME . '/Administrators/';
	$GLOBALS['HOME'] = $HOME;
	$GLOBALS['ADMINHOME'] = $ADMINHOME;

	require_once ("$ADMINHOME/Configuration/includes.php");
	$Options = $Tier6Databases->getLayerModuleSetting();
	$PageName = '../../index.php?PageID=';
	if ($_POST['AddNewsPage']) {
		$PageName .= $_POST['AddNewsPage'];
	} else {
		$_POST['AddNewsPage'] = $Options['XhtmlNewsStories']['news']['AddNewsPage']['SettingAttribute'];
		$PageName .= $_POST['AddNewsPage'];
	}

	$hold = $Tier6Databases->FormSubmitValidate('AddNewsPage', $PageName);

	$_POST['NewsDay'] = str_replace(' ','', $_POST['NewsDay']);
	$_POST['NewsMonth'] = str_replace(' ','', $_POST['NewsMonth']);
	$_POST['NewsYear'] = str_replace(' ','', $_POST['NewsYear']);
	$hold['FilteredInput']['NewsDay'] = $_POST['NewsDay'];
	$hold['FilteredInput']['NewsMonth'] = $_POST['NewsMonth'];
	$hold['FilteredInput']['NewsYear'] = $_POST['NewsYear'];

	if ($hold) {
		$sessionname = $Tier6Databases->SessionStart('CreateNewsPage');

		$DateTime = date('Y-m-d H:i:s');
		$Date = date('Y-m-d');
		$SiteName = $GLOBALS['sitename'];

		$LastPageID = $Tier6Databases->ModulePass('XhtmlContent', 'content', 'getLastContentPageID', array());
		if (isset($LastPageID)) {
			$NewPageID = ++$LastPageID;
		} else {
			$NewPageID = 1;
		}
		$LastNewsPage = $Options['XhtmlNewsStories']['news']['LastNewsPage']['SettingAttribute'];
		$NewNewsPage = ++$LastNewsPage;
		$Tier6Databases->updateModuleSetting('XhtmlNewsStories', 'news', 'LastNewsPage', $NewNewsPage);

		$NewPage = '../../index.php?PageID=';
		$NewPage .= $NewPageID;

		$Location = 'index.php?PageID=';
		$Location .= $NewPageID;

		$_SESSION['POST']['Error']['Link'] = '<a href=\'';
		$_SESSION['POST']['Error']['Link'] .= $NewPage;
		$_SESSION['POST']['Error']['Link'] .= '\'>New News Page</a>';



		if ($_POST['Heading'] == 'Null' | $_POST['Heading'] == 'NULL') {
			$_POST['Heading'] = NULL;
			$hold['FilteredInput']['Heading'] = NULL;
		}

		if ($_POST['TopText'] == 'Null' | $_POST['TopText'] == 'NULL') {
			$_POST['TopText'] = NULL;
			$hold['FilteredInput']['TopText'] = NULL;
		}

		if ($_POST['NewsDay'] == 'Null' | $_POST['NewsDay'] == 'NULL') {
			$_POST['NewsDay'] = NULL;
			$hold['FilteredInput']['NewsDay'] = NULL;
		}

		if ($_POST['NewsMonth'] == 'Null' | $_POST['NewsMonth'] == 'NULL') {
			$_POST['NewsMonth'] = NULL;
			$hold['FilteredInput']['NewsMonth'] = NULL;
		}

		if ($_POST['NewsYear'] == 'Null' | $_POST['NewsYear'] == 'NULL') {
			$_POST['NewsYear'] = NULL;
			$hold['FilteredInput']['NewsYear'] = NULL;
		}

		if ($_POST['BottomText'] == 'Null' | $_POST['BottomText'] == 'NULL') {
			$_POST['BottomText'] = NULL;
			$hold['FilteredInput']['BottomText'] = NULL;
		}

		if ($_POST['MenuName'] == 'Null' | $_POST['MenuName'] == 'NULL') {
			$_POST['MenuName'] = NULL;
			$hold['FilteredInput']['MenuName'] = NULL;
		}

		if ($_POST['MenuTitle'] == 'Null' | $_POST['MenuTitle'] == 'NULL') {
			$_POST['MenuTitle'] = NULL;
			$hold['FilteredInput']['MenuTitle'] = NULL;
		}

		// General Defines
		define(NewPageID, $NewPageID);
		define(CurrentVersionTrueFalse, 'true');
		define(ContentPageType, 'NewsPage');

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

		$Content = array();

		$PageID = array();
		$PageID['PageID'] = $NewPageID;

		$Content[0]['PageID'] = $NewPageID;
		$Content[0]['ObjectID'] = 0;
		$Content[0]['ContainerObjectType'] = 'XhtmlContent';
		$Content[0]['ContainerObjectName'] = 'content';
		$Content[0]['ContainerObjectID'] = 1;
		$Content[0]['ContainerObjectPrintPreview'] = 'true';
		$Content[0]['RevisionID'] = 0;
		$Content[0]['CurrentVersion'] = 'true';
		$Content[0]['Empty'] = 'false';
		$Content[0]['StartTag'] = '<div>';
		$Content[0]['EndTag'] = NULL;
		$Content[0]['StartTagID'] = 'main-content-middle';
		$Content[0]['StartTagStyle'] = NULL;
		$Content[0]['StartTagClass'] = NULL;
		$Content[0]['Heading'] = $hold['FilteredInput']['Heading'];
		$Content[0]['HeadingStartTag'] = '<h2>';
		$Content[0]['HeadingEndTag'] = '</h2>';
		$Content[0]['HeadingStartTagID'] = NULL;
		$Content[0]['HeadingStartTagStyle'] = NULL;
		$Content[0]['HeadingStartTagClass'] = 'BodyHeading';
		$Content[0]['Content'] = $hold['FilteredInput']['TopText'];

		if ($hold['FilteredInput']['TopText'] != NULL) {
			$Content[0]['ContentStartTag'] = '<p>';
			$Content[0]['ContentEndTag'] = '</p>';
		} else {
			$Content[0]['ContentStartTag'] = NULL;
			$Content[0]['ContentEndTag'] = NULL;
		}
		$Content[0]['ContentStartTagID'] = NULL;
		$Content[0]['ContentStartTagStyle'] = NULL;
		$Content[0]['ContentStartTagClass'] = 'BodyText';
		$Content[0]['ContentPTagID'] = NULL;
		$Content[0]['ContentPTagStyle'] = NULL;
		$Content[0]['ContentPTagClass'] = 'BodyText';
		$Content[0]['Enable/Disable'] = $_POST['EnableDisable'];
		$Content[0]['Status'] = $_POST['Status'];

		$Content[1]['PageID'] = $NewPageID;
		$Content[1]['ObjectID'] = 1;
		$Content[1]['ContainerObjectType'] = 'XhtmlNewsStories';
		$Content[1]['ContainerObjectName'] = 'news';
		$Content[1]['ContainerObjectID'] = 1;
		$Content[1]['ContainerObjectPrintPreview'] = 'true';
		$Content[1]['RevisionID'] = 0;
		$Content[1]['CurrentVersion'] = 'true';
		$Content[1]['Empty'] = 'false';
		$Content[1]['StartTag'] = NULL;
		$Content[1]['EndTag'] = NULL;
		$Content[1]['StartTagID'] = NULL;
		$Content[1]['StartTagStyle'] = NULL;
		$Content[1]['StartTagClass'] = NULL;
		$Content[1]['Heading'] = NULL;
		$Content[1]['HeadingStartTag'] = NULL;
		$Content[1]['HeadingEndTag'] = NULL;
		$Content[1]['HeadingStartTagID'] = NULL;
		$Content[1]['HeadingStartTagStyle'] = NULL;
		$Content[1]['HeadingStartTagClass'] = NULL;
		$Content[1]['Content'] = NULL;
		$Content[1]['ContentStartTag'] = NULL;
		$Content[1]['ContentEndTag'] = NULL;
		$Content[1]['ContentStartTagID'] = NULL;
		$Content[1]['ContentStartTagStyle'] = NULL;
		$Content[1]['ContentStartTagClass'] = NULL;
		$Content[1]['ContentPTagID'] = NULL;
		$Content[1]['ContentPTagStyle'] = NULL;
		$Content[1]['ContentPTagClass'] = NULL;
		$Content[1]['Enable/Disable'] = $_POST['EnableDisable'];
		$Content[1]['Status'] = $_POST['Status'];

		$Content[2]['PageID'] = $NewPageID;
		$Content[2]['ObjectID'] = 2;
		$Content[2]['ContainerObjectType'] = 'XhtmlContent';
		$Content[2]['ContainerObjectName'] = 'content';
		$Content[2]['ContainerObjectID'] = 4;
		$Content[2]['ContainerObjectPrintPreview'] = 'true';
		$Content[2]['RevisionID'] = 0;
		$Content[2]['CurrentVersion'] = 'true';
		$Content[2]['Empty'] = 'false';
		$Content[2]['StartTag'] = NULL;
		$Content[2]['EndTag'] = '</div>';
		$Content[2]['StartTagID'] = NULL;
		$Content[2]['StartTagStyle'] = NULL;
		$Content[2]['StartTagClass'] = NULL;
		$Content[2]['Heading'] = NULL;
		$Content[2]['HeadingStartTag'] = NULL;
		$Content[2]['HeadingEndTag'] = NULL;
		$Content[2]['HeadingStartTagID'] = NULL;
		$Content[2]['HeadingStartTagStyle'] = NULL;
		$Content[2]['HeadingStartTagClass'] = NULL;
		$Content[2]['Content'] = $hold['FilteredInput']['BottomText'];
		$Content[2]['ContentStartTag'] = '<p>';
		$Content[2]['ContentEndTag'] = '</p>';
		$Content[2]['ContentStartTagID'] = NULL;
		$Content[2]['ContentStartTagStyle'] = NULL;
		$Content[2]['ContentStartTagClass'] = 'BodyText';
		$Content[2]['ContentPTagID'] = NULL;
		$Content[2]['ContentPTagStyle'] = NULL;
		$Content[2]['ContentPTagClass'] = 'BodyText';
		$Content[2]['Enable/Disable'] = $_POST['EnableDisable'];
		$Content[2]['Status'] = $_POST['Status'];
		//$NewsStory = array_reverse($NewsStory);

		$Header = parse_ini_file('../../ModuleSettings/Tier6-ContentLayer/Modules/XhtmlHeader/AddXhtmlHeader.ini',FALSE);
		$Header = $Tier6Databases->EmptyStringToNullArray($Header);

		$NewsStoryLookup = array();
		$NewsStoryLookup['PageID'] = $NewPageID;
		$NewsStoryLookup['ObjectID'] = 1;
		$NewsStoryLookup['NewsStoryPageID'] = NULL;
		$NewsStoryLookup['NewsStoryDay'] = $_POST['NewsDay'];
		$NewsStoryLookup['NewsStoryMonth'] = $_POST['NewsMonth'];
		$NewsStoryLookup['NewsStoryYear'] = $_POST['NewsYear'];
		$NewsStoryLookup['Enable/Disable'] = $_POST['EnableDisable'];
		$NewsStoryLookup['Status'] = $_POST['Status'];

		$HeaderPanel1 = parse_ini_file('../../ModuleSettings/Tier6-ContentLayer/Modules/XhtmlMenu/AddHeaderPanel1.ini',TRUE);
		$HeaderPanel1 = $Tier6Databases->EmptyStringToNullArray($HeaderPanel1);

		$ContentLayerVersion = parse_ini_file('../../ModuleSettings/Tier6-ContentLayer/GlobalSettings/AddContentLayerVersion.ini',FALSE);
		$ContentLayerVersion = $Tier6Databases->EmptyStringToNullArray($ContentLayerVersion);

		//$ContentLayer = parse_ini_file('../../ModuleSettings/Tier6-ContentLayer/GlobalSettings/AddContentLayer.ini',TRUE);
		//$ContentLayer = $Tier6Databases->EmptyStringToNullArray($ContentLayer);

		$Sitemap = parse_ini_file('../../ModuleSettings/Tier6-ContentLayer/Modules/XmlSitemap/AddXmlSitemap.ini',FALSE);
		$Sitemap = $Tier6Databases->EmptyStringToNullArray($Sitemap);

		$ContentPrintPreview = parse_ini_file('../../ModuleSettings/Tier6-ContentLayer/Modules/XhtmlContent/AddPrintPreview.ini',FALSE);
		$ContentPrintPreview = $Tier6Databases->EmptyStringToNullArray($ContentPrintPreview);

		$MainMenuItemLookup = parse_ini_file('../../ModuleSettings/Tier6-ContentLayer/Modules/XhtmlMainMenu/AddMainMenuItemLookup.ini',FALSE);
		$MainMenuItemLookup = $Tier6Databases->EmptyStringToNullArray($MainMenuItemLookup);

		$UpdateNewsPageSelect = $Options['XhtmlNewsStories']['news']['UpdateNewsPageSelect']['SettingAttribute'];
		$FormSelect = array();
		$FormSelect['PageID'] = $UpdateNewsPageSelect;
		$FormSelect['ObjectID'] = $NewNewsPage;
		$FormSelect['StopObjectID'] = 9999;
		$FormSelect['ContinueObjectID'] = NULL;
		$FormSelect['ContainerObjectType'] = 'Option';
		$FormSelect['ContainerObjectTypeName'] = 'AdministratorFormOption';
		$FormSelect['ContainerObjectID'] = $NewNewsPage;
		$FormSelect['FormSelectDisabled'] = NULL;
		$FormSelect['FormSelectMultiple'] = NULL;
		$FormSelect['FormSelectName'] = 'NewsPage';
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
		$FormOptionValue = $NewNewsPage;
		$FormOptionValue .= ' - ';
		$FormOptionValue .= $NewPageID;

		$FormOption = array();
		$FormOption['PageID'] = $UpdateNewsPageSelect;
		$FormOption['ObjectID'] = $NewNewsPage;
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

		$Tier6Databases->ModulePass('XhtmlContent', 'content', 'createContent', $Content);
		$Tier6Databases->ModulePass('XhtmlHeader', 'header', 'createHeader', $Header);
		$Tier6Databases->ModulePass('XhtmlNewsStories', 'news', 'createNewsStoryLookup', $NewsStoryLookup);
		$Tier6Databases->ModulePass('XhtmlMenu', 'headerpanel1', 'createMenu', $HeaderPanel1);
		$Tier6Databases->createContentVersion($ContentLayerVersion, 'ContentLayerVersion');
		$Tier6Databases->ModulePass('XhtmlContent', 'content', 'createContentPrintPreview', $ContentPrintPreview);
		//$Tier6Databases->createContent($ContentLayer, 'ContentLayer');

		$Tier6Databases->ModulePass('XhtmlMainMenu', 'mainmenu', 'createMainMenuItemLookup', $MainMenuItemLookup);

		$Tier6Databases->ModulePass('XmlSitemap', 'sitemap', 'createSitemapItem', $Sitemap);

		$UpdateNewsPageSelect = $Options['XhtmlNewsStories']['news']['UpdateNewsPageSelect']['SettingAttribute'];
		$FormSelect['PageID'] = $UpdateNewsPageSelect;
		$FormOption['PageID'] = $UpdateNewsPageSelect;

		$Tier6Databases->ModulePass('XhtmlForm', 'form', 'createFormOption', $FormOption);
		$Tier6Databases->ModulePass('XhtmlForm', 'form', 'createFormSelect', $FormSelect);

		$DeleteNewsPage = $Options['XhtmlNewsStories']['news']['DeleteNewsPage']['SettingAttribute'];
		$FormSelect['PageID'] = $DeleteNewsPage;
		$FormOption['PageID'] = $DeleteNewsPage;

		$Tier6Databases->ModulePass('XhtmlForm', 'form', 'createFormOption', $FormOption);
		$Tier6Databases->ModulePass('XhtmlForm', 'form', 'createFormSelect', $FormSelect);

		$EnableDisableStatusChangeNewsPage = $Options['XhtmlNewsStories']['news']['EnableDisableStatusChangeNewsPage']['SettingAttribute'];
		$FormSelect['PageID'] = $EnableDisableStatusChangeNewsPage;
		$FormOption['PageID'] = $EnableDisableStatusChangeNewsPage;

		$Tier6Databases->ModulePass('XhtmlForm', 'form', 'createFormOption', $FormOption);
		$Tier6Databases->ModulePass('XhtmlForm', 'form', 'createFormSelect', $FormSelect);

		$FormOptionValue = $NewPageID;
		$FormOptionValue .= ' - ';
		$FormOptionValue .= 'NULL';

		$MainMenuSelectPage = $Options['XhtmlMainMenu']['mainmenu']['MainMenuSelectPage']['SettingAttribute'];
		$FormSelect['PageID'] = $MainMenuSelectPage;
		$FormSelect['ObjectID'] = $NewPageID;
		$FormSelect['ContainerObjectID'] = $NewPageID;
		$FormSelect['FormSelectName'] = 'MenuItem';
		$FormSelect['StopObjectID'] = NULL;
		$FormSelect['FormSelectStyle'] = NULL;
		$FormOption['PageID'] = $MainMenuSelectPage;
		$FormOption['ObjectID'] = $NewPageID;
		$Tier6Databases->ModulePass('XhtmlForm', 'form', 'createFormOption', $FormOption);
		$Tier6Databases->ModulePass('XhtmlForm', 'form', 'createFormSelect', $FormSelect);

		$MainMenuUpdatePage = $Options['XhtmlMainMenu']['mainmenu']['MainMenuUpdatePage']['SettingAttribute'];
		$FormSelect['PageID'] = $MainMenuUpdatePage;
		$FormOption['PageID'] = $MainMenuUpdatePage;
		$Tier6Databases->ModulePass('XhtmlForm', 'form', 'createFormOption', $FormOption);
		$Tier6Databases->ModulePass('XhtmlForm', 'form', 'createFormSelect', $FormSelect);

		$j = $NewPageID;
		for ($i = 2; $i < 16; $i++) {
			$j += 10000;
			$FormSelect['ObjectID'] = $j;
			$FormSelect['FormSelectName'] = 'MenuItem';
			$FormSelect['FormSelectName'] .= $i;
			$Tier6Databases->ModulePass('XhtmlForm', 'form', 'createFormSelect', $FormSelect);
		}

		$j += 10000;
		$FormSelect['ObjectID'] = $j;
		$FormSelect['FormSelectName'] = 'TopMenu';
		$Tier6Databases->ModulePass('XhtmlForm', 'form', 'createFormSelect', $FormSelect);

		$NewsPageCreatedPage = $Options['XhtmlNewsStories']['news']['NewsPageCreatedPage']['SettingAttribute'];

		header("Location: $NewsPageCreatedPage&SessionID=$sessionname");
		exit;

	}

?>