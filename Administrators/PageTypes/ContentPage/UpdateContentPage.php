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

	$Options = $Tier6Databases->getLayerModuleSetting();
	$UpdateContentPage = $Options['XhtmlContent']['content']['UpdateContentPage']['SettingAttribute'];
	$NewUpdateContentPage = explode('=', $UpdateContentPage);
	$NewUpdateContentPage = $NewUpdateContentPage[1];

	$PageID = $_SESSION['POST']['FilteredInput']['PageID'];
	$FormOptionObjectID = $_SESSION['POST']['FilteredInput']['FormOptionObjectID'];
	$RevisionID = $_SESSION['POST']['FilteredInput']['RevisionID'];
	$MenuObjectID = $_SESSION['POST']['FilteredInput']['MenuObjectID'];
	$CreationDateTime = $_SESSION['POST']['FilteredInput']['CreationDateTime'];
	$Owner = $_SESSION['POST']['FilteredInput']['Owner'];
	$UserAccessGroup = $_SESSION['POST']['FilteredInput']['UserAccessGroup'];

	$NewRevisionID = $RevisionID + 1;

	$_POST['PageID'] = $PageID;
	$_POST['FormOptionObjectID'] = $FormOptionObjectID;
	$_POST['RevisionID'] = $RevisionID;
	$_POST['CreationDateTime'] = $CreationDateTime;
	$_POST['Owner'] = $Owner;
	$_POST['UserAccessGroup'] = $UserAccessGroup;
	$_POST['UpdateNewsPage'] = $NewUpdateNewsPage;

	if (!is_null($PageID) && !is_null($RevisionID) && !is_null($CreationDateTime) && !is_null($Owner) && !is_null($UserAccessGroup)) {
		$PageName = $UpdateContentPage;

		$hold = $Tier6Databases->FormSubmitValidate('UpdateContentPage', $PageName);
		if ($hold) {
			$DateTime = date('Y-m-d H:i:s');
			$Date = date('Y-m-d');
			$SiteName = $GLOBALS['sitename'];

			$NewPage = '../../../index.php?PageID=';
			$NewPage .= $NewPageID;

			$Location = 'index.php?PageID=';
			$Location .= $NewPageID;

			$_SESSION['POST']['Error']['Link'] = '<a href=\'';
			$_SESSION['POST']['Error']['Link'] .= $NewPage;
			$_SESSION['POST']['Error']['Link'] .= '\'>Updated Content Page</a>';



			if ($_POST['Heading'] == 'Null' | $_POST['Heading'] == 'NULL') {
				$_POST['Heading'] = NULL;
				$hold['FilteredInput']['Heading'] = NULL;
			}

			if ($_POST['Keywords'] == 'Null' | $_POST['Keywords'] == 'NULL') {
				$_POST['Keywords'] = NULL;
				$hold['FilteredInput']['Keywords'] = NULL;
			}

			if ($_POST['Description'] == 'Null' | $_POST['Description'] == 'NULL') {
				$_POST['Description'] = NULL;
				$hold['FilteredInput']['Description'] = NULL;
			}

			if ($_POST['Content'] == 'Null' | $_POST['Content'] == 'NULL') {
				$_POST['Content'] = NULL;
				$hold['FilteredInput']['Content'] = NULL;
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
			define(NewPageID, $PageID);
			define(NewRevisionID, $NewRevisionID);
			define(CurrentVersionTrueFalse, 'true');
			define(ContentPageType, 'ContentPage');

			define(ContentPageMenuName, $hold['FilteredInput']['MenuName']);
			define(ContentPageMenuTitle, $hold['FilteredInput']['MenuTitle']);
			define(MenuObjectID, $MenuObjectID);

			define(UserAccessGroup, 'Guest');
			define(Owner, $Owner);
			define(Creator, $_COOKIE['UserName']);
			define(LastChangeUser, $_COOKIE['UserName']);
			define(CreationDateTime, $CreationDateTime);
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

			$Content[0]['PageID'] = $PageID;
			$Content[0]['ObjectID'] = 0;
			$Content[0]['ContainerObjectType'] = 'XhtmlContent';
			$Content[0]['ContainerObjectName'] = 'content';
			$Content[0]['ContainerObjectID'] = 1;
			$Content[0]['ContainerObjectPrintPreview'] = 'true';
			$Content[0]['RevisionID'] = $NewRevisionID;
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
			$Content[0]['Content'] = $hold['FilteredInput']['Content'];

			if ($hold['FilteredInput']['Content'] != NULL) {
				$Content[0]['ContentStartTag'] = '<p>';
				$Content[0]['ContentEndTag'] = '</p>';
			} else {
				$Content[0]['ContentStartTag'] = NULL;
				$Content[0]['ContentEndTag'] = NULL;
			}

			if ($hold['FilteredInput']['RawData'] != NULL) {
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

			$Content[1]['PageID'] = $PageID;
			$Content[1]['ObjectID'] = 1;
			$Content[1]['ContainerObjectType'] = 'XhtmlContent';
			$Content[1]['ContainerObjectName'] = 'content';
			$Content[1]['ContainerObjectID'] = 2;
			$Content[1]['ContainerObjectPrintPreview'] = 'true';
			$Content[1]['RevisionID'] = $NewRevisionID;
			$Content[1]['CurrentVersion'] = 'true';
			$Content[1]['Empty'] = 'false';
			$Content[1]['StartTag'] = NULL;
			$Content[1]['EndTag'] = '</div>';
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
			$Content[1]['ContentStartTag'] = '<p>';
			$Content[1]['ContentEndTag'] = '</p>';
			$Content[1]['ContentStartTagID'] = NULL;
			$Content[1]['ContentStartTagStyle'] = NULL;
			$Content[1]['ContentStartTagClass'] = 'BodyText';
			$Content[1]['ContentPTagID'] = NULL;
			$Content[1]['ContentPTagStyle'] = NULL;
			$Content[1]['ContentPTagClass'] = 'BodyText';
			$Content[1]['Enable/Disable'] = $_POST['EnableDisable'];
			$Content[1]['Status'] = $_POST['Status'];
			//$Content = array_reverse($Content);

			$Header = parse_ini_file('../../ModuleSettings/Tier6-ContentLayer/Modules/XhtmlHeader/UpdateXhtmlHeader.ini',FALSE);
			$Header = $Tier6Databases->EmptyStringToNullArray($Header);

			$HeaderPanel1 = parse_ini_file('../../ModuleSettings/Tier6-ContentLayer/Modules/XhtmlMenu/UpdateHeaderPanel1.ini',TRUE);
			$HeaderPanel1 = $Tier6Databases->EmptyStringToNullArray($HeaderPanel1);

			$ContentLayerVersion = parse_ini_file('../../ModuleSettings/Tier6-ContentLayer/GlobalSettings/UpdateContentLayerVersion.ini',FALSE);
			$ContentLayerVersion = $Tier6Databases->EmptyStringToNullArray($ContentLayerVersion);

			//$ContentLayer = parse_ini_file('ModuleSettings/Tier6-ContentLayer/GlobalSettings/UpdateContentLayer.ini',TRUE);
			//$ContentLayer = $Tier6Databases->EmptyStringToNullArray($ContentLayer);

			$Sitemap = parse_ini_file('../../ModuleSettings/Tier6-ContentLayer/Modules/XmlSitemap/UpdateXmlSitemap.ini',FALSE);
			$Sitemap = $Tier6Databases->EmptyStringToNullArray($Sitemap);

			$ContentPrintPreview = parse_ini_file('../../ModuleSettings/Tier6-ContentLayer/Modules/XhtmlContent/UpdatePrintPreview.ini',FALSE);
			$ContentPrintPreview = $Tier6Databases->EmptyStringToNullArray($ContentPrintPreview);

			$FormOptionID = $Options['XhtmlContent']['content']['UpdateContentPageSelect']['SettingAttribute'];
			$FormOptionText = $hold['FilteredInput']['PageTitle'];
			//$FormOptionValue = $NewNewsPage;
			//$FormOptionValue .= ' - ';
			//$FormOptionValue .= $NewPageID;

			$FormOption = array();
			//$FormOption['PageID'] = $UpdateNewsPage;
			//$FormOption['ObjectID'] = $NewNewsPage;
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

			$Tier6Databases->ModulePass('XhtmlForm', 'form', 'updateFormOption', array('PageID' => array('PageID' => $FormOptionID, 'ObjectID' => $FormOptionObjectID), 'Content' => $FormOption));
			$FormOptionID = $Options['XhtmlContent']['content']['DeleteContentPage']['SettingAttribute'];
			$Tier6Databases->ModulePass('XhtmlForm', 'form', 'updateFormOption', array('PageID' => array('PageID' => $FormOptionID, 'ObjectID' => $FormOptionObjectID), 'Content' => $FormOption));
			$FormOptionID = $Options['XhtmlContent']['content']['EnableDisableStatusChangeContentPage']['SettingAttribute'];
			$Tier6Databases->ModulePass('XhtmlForm', 'form', 'updateFormOption', array('PageID' => array('PageID' => $FormOptionID, 'ObjectID' => $FormOptionObjectID), 'Content' => $FormOption));

			$FormOptionID = $Options['XhtmlMainMenu']['mainmenu']['MainMenuSelectPage']['SettingAttribute'];
			$Tier6Databases->ModulePass('XhtmlForm', 'form', 'updateFormOption', array('PageID' => array('PageID' => $FormOptionID, 'ObjectID' => $PageID), 'Content' => $FormOption));
			$FormOptionID = $Options['XhtmlMainMenu']['mainmenu']['MainMenuUpdatePage']['SettingAttribute'];
			$Tier6Databases->ModulePass('XhtmlForm', 'form', 'updateFormOption', array('PageID' => array('PageID' => $FormOptionID, 'ObjectID' => $PageID), 'Content' => $FormOption));

			$Tier6Databases->ModulePass('XhtmlMenu', 'headerpanel1', 'updateMenu', array('PageID' => array('PageID' => $PageID, 'ObjectID' => 2), 'Content' => $HeaderPanel1));
			$Tier6Databases->ModulePass('XhtmlContent', 'content', 'updateContentPrintPreview', array('PageID' => array('PageID' => $PageID), 'Content' => $ContentPrintPreview));
			$Tier6Databases->ModulePass('XmlSitemap', 'sitemap', 'updateSitemapItem', array('PageID' => array('PageID' => $PageID), 'Content' => $Sitemap));

			$Tier6Databases->ModulePass('XhtmlHeader', 'header', 'updateHeader', array('PageID' => $PageID));
			$Tier6Databases->ModulePass('XhtmlHeader', 'header', 'createHeader', $Header);

			$Tier6Databases->ModulePass('XhtmlContent', 'content', 'updateContent', array('PageID' => $PageID));
			$Tier6Databases->updateContentVersion(array('PageID' => $PageID), 'ContentLayerVersion');
			//$Tier6Databases->updateContent(array('PageID' => $PageID), 'ContentLayer');

			$Tier6Databases->ModulePass('XhtmlContent', 'content', 'createContent', $Content);
			$Tier6Databases->createContentVersion($ContentLayerVersion, 'ContentLayerVersion');
			//$Tier6Databases->createContent($ContentLayer, 'ContentLayer');

			$Tier6Databases->SessionDestroy($sessionname);
			$sessionname = $Tier6Databases->SessionStart('UpdatedContentPage');

			$Page = '../../../index.php?PageID=';
			$Page .= $PageID;

			$_SESSION['POST']['Error']['Link'] = '<a href=\'';
			$_SESSION['POST']['Error']['Link'] .= $Page;
			$_SESSION['POST']['Error']['Link'] .= '\'>Updated Content Page</a>';

			$CreatedUpdateContentPage = $Options['XhtmlContent']['content']['CreatedUpdateContentPage']['SettingAttribute'];
			header("Location: $CreatedUpdateContentPage&SessionID=$sessionname");
		}

	} else {
		$Tier6Databases->SessionDestroy($sessionname);
		$Options = $Tier6Databases->getLayerModuleSetting();
		$UpdateContentPageSelect = $Options['XhtmlContent']['content']['UpdateContentPageSelect']['SettingAttribute'];
		header("Location: ../../index.php?PageID=$UpdateContentPageSelect");
	}

?>