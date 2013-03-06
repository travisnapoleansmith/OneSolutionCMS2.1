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

	$sessionname = NULL;
	$sessionname = $_COOKIE['SessionID'];
	session_name($sessionname);
	session_start();

	$Options = $Tier6Databases->getLayerModuleSetting();
	$UpdateCalendarPage = $Options['XhtmlCalendarTable']['calendar']['CalendarPageUpdatePage']['SettingAttribute'];
	$NewUpdateCalendarPage = explode('=', $UpdateCalendarPage);
	$NewUpdateCalendarPage = $NewUpdateCalendarPage[1];

	$PageID = $_SESSION['POST']['FilteredInput']['PageID'];
	$FormOptionObjectID = $_SESSION['POST']['FilteredInput']['FormOptionObjectID'];
	$RevisionID = $_SESSION['POST']['FilteredInput']['RevisionID'];
	$MenuObjectID = $_SESSION['POST']['FilteredInput']['MenuObjectID'];
	$CreationDateTime = $_SESSION['POST']['FilteredInput']['CreationDateTime'];
	$Owner = $_SESSION['POST']['FilteredInput']['Owner'];
	$UserAccessGroup = $_SESSION['POST']['FilteredInput']['UserAccessGroup'];

	$NewRevisionID = $RevisionID + 1;
	$NewPageID = $PageID;
	
	$_POST['PageID'] = $PageID;
	$_POST['FormOptionObjectID'] = $FormOptionObjectID;
	$_POST['RevisionID'] = $RevisionID;
	$_POST['CreationDateTime'] = $CreationDateTime;
	$_POST['Owner'] = $Owner;
	$_POST['UserAccessGroup'] = $UserAccessGroup;
	$_POST['UpdateCalendarPage'] = $NewUpdateCalendarPage;

	
	if (!is_null($PageID) && !is_null($RevisionID) && !is_null($CreationDateTime) && !is_null($Owner) && !is_null($UserAccessGroup)) {
		$PageName = $UpdateCalendarPage;
		$hold = $Tier6Databases->FormSubmitValidate('UpdateCalendarPage', $PageName);
		
		if ($hold) {
			$sessionname = $Tier6Databases->SessionStart('UpdateCalendarPage');

			$DateTime = date('Y-m-d H:i:s');
			$Date = date('Y-m-d');
			$SiteName = $GLOBALS['sitename'];
			
			$DateTime = date('Y-m-d H:i:s');
			$Date = date('Y-m-d');
			$SiteName = $GLOBALS['sitename'];

			$NewPage = '../../../index.php?PageID=';
			$NewPage .= $NewPageID;

			$Location = '../../index.php?PageID=';
			$Location .= $NewPageID;

			$_SESSION['POST']['Error']['Link'] = '<a href=\'';
			$_SESSION['POST']['Error']['Link'] .= $NewPage;
			$_SESSION['POST']['Error']['Link'] .= '\'>Updated Calendar Page</a>';

			if ($_POST['Heading'] == 'Null' | $_POST['Heading'] == 'NULL') {
				$_POST['Heading'] = NULL;
				$hold['FilteredInput']['Heading'] = NULL;
			}
	
			if ($_POST['TopText'] == 'Null' | $_POST['TopText'] == 'NULL') {
				$_POST['TopText'] = NULL;
				$hold['FilteredInput']['TopText'] = NULL;
			}
	
			if ($_POST['CalendarDay'] == 'Null' | $_POST['CalendarDay'] == 'NULL') {
				$_POST['CalendarDay'] = NULL;
				$hold['FilteredInput']['CalendarDay'] = NULL;
			}
	
			if ($_POST['CalendarMonth'] == 'Null' | $_POST['CalendarMonth'] == 'NULL') {
				$_POST['CalendarMonth'] = NULL;
				$hold['FilteredInput']['CalendarMonth'] = NULL;
			}
	
			if ($_POST['CalendarYear'] == 'Null' | $_POST['CalendarYear'] == 'NULL') {
				$_POST['CalendarYear'] = NULL;
				$hold['FilteredInput']['CalendarYear'] = NULL;
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
			define(NewRevisionID, $NewRevisionID);
			define(CurrentVersionTrueFalse, 'true');
			define(ContentPageType, 'CalendarPage');
	
			define(ContentPageMenuName, $hold['FilteredInput']['MenuName']);
			define(ContentPageMenuTitle, $hold['FilteredInput']['MenuTitle']);
			define(MenuObjectID, $MenuObjectID);
			
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
			$Content[1]['ContainerObjectType'] = 'XhtmlCalendarTable';
			$Content[1]['ContainerObjectName'] = 'calendar';
			$Content[1]['ContainerObjectID'] = 1;
			$Content[1]['ContainerObjectPrintPreview'] = 'true';
			$Content[1]['RevisionID'] = $NewRevisionID;
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
			$Content[2]['ContainerObjectID'] = 3;
			$Content[2]['ContainerObjectPrintPreview'] = 'true';
			$Content[2]['RevisionID'] = $NewRevisionID;
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
			//$Content = array_reverse($Content);
			
			$Header = parse_ini_file('../../ModuleSettings/Tier6-ContentLayer/Modules/XhtmlHeader/UpdateXhtmlHeader.ini',FALSE);
			$Header = $Tier6Databases->EmptyStringToNullArray($Header);
			
			$CalendarTable = array();
			$CalendarTable['PageID'] = $NewPageID;
			$CalendarTable['ObjectID'] = 1;
			$CalendarTable['RevisionID'] = $NewRevisionID;
			$CalendarTable['CurrentVersion'] = 'true';
			$CalendarTable['CalendarAppointmentName'] = 'CalendarAppointments';
			$CalendarTable['Day'] = $_POST['CalendarDay'];
			$CalendarTable['Month'] = $_POST['CalendarMonth'];
			$CalendarTable['Year'] = $_POST['CalendarYear'];
			$CalendarTable['HeadingStartTag'] = '<h1>';
			$CalendarTable['HeadingEndTag'] = '</h1>';
			$CalendarTable['HeadingStartTagID'] = NULL;
			$CalendarTable['HeadingStartTagStyle'] = NULL;
			$CalendarTable['HeadingStartTagClass'] = NULL;
			$CalendarTable['CalendarAlign'] = 'left';
			$CalendarTable['CalendarChar'] = NULL;
			$CalendarTable['CalendarCharoff'] = NULL;
			$CalendarTable['CalendarValign'] = NULL;
			$CalendarTable['CalendarClass'] = NULL;
			$CalendarTable['CalendarDir'] = NULL;
			$CalendarTable['CalendarID'] = NULL;
			$CalendarTable['CalendarLang'] = 'en-us';
			$CalendarTable['CalendarStyle'] = NULL;
			$CalendarTable['CalendarTitle'] = NULL;
			$CalendarTable['CalendarXMLLang'] = 'en-us';
			$CalendarTable['Enable/Disable'] = $_POST['EnableDisable'];
			$CalendarTable['Status'] = $_POST['Status'];
			$CalendarTable['TableName'] = 'CalendarTable';
			
			$HeaderPanel1 = parse_ini_file('../../ModuleSettings/Tier6-ContentLayer/Modules/XhtmlMenu/UpdateHeaderPanel1.ini',TRUE);
			$HeaderPanel1 = $Tier6Databases->EmptyStringToNullArray($HeaderPanel1);

			$ContentLayerVersion = parse_ini_file('../../ModuleSettings/Tier6-ContentLayer/GlobalSettings/UpdateContentLayerVersion.ini',FALSE);
			$ContentLayerVersion = $Tier6Databases->EmptyStringToNullArray($ContentLayerVersion);

			//$ContentLayer = parse_ini_file('../../ModuleSettings/Tier6-ContentLayer/GlobalSettings/UpdateContentLayer.ini',TRUE);
			//$ContentLayer = $Tier6Databases->EmptyStringToNullArray($ContentLayer);

			$Sitemap = parse_ini_file('../../ModuleSettings/Tier6-ContentLayer/Modules/XmlSitemap/UpdateXmlSitemap.ini',FALSE);
			$Sitemap = $Tier6Databases->EmptyStringToNullArray($Sitemap);

			$ContentPrintPreview = parse_ini_file('../../ModuleSettings/Tier6-ContentLayer/Modules/XhtmlContent/UpdatePrintPreview.ini',FALSE);
			$ContentPrintPreview = $Tier6Databases->EmptyStringToNullArray($ContentPrintPreview);

			$FormOptionID = $Options['XhtmlCalendarTable']['calendar']['UpdateCalendarPageSelect']['SettingAttribute'];
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
			$FormOptionID = $Options['XhtmlCalendarTable']['calendar']['DeleteCalendarPage']['SettingAttribute'];
			$Tier6Databases->ModulePass('XhtmlForm', 'form', 'updateFormOption', array('PageID' => array('PageID' => $FormOptionID, 'ObjectID' => $FormOptionObjectID), 'Content' => $FormOption));
			$FormOptionID = $Options['XhtmlCalendarTable']['calendar']['EnableDisableStatusChangeCalendarPage']['SettingAttribute'];
			$Tier6Databases->ModulePass('XhtmlForm', 'form', 'updateFormOption', array('PageID' => array('PageID' => $FormOptionID, 'ObjectID' => $FormOptionObjectID), 'Content' => $FormOption));
			
			$FormOptionID = $Options['XhtmlMainMenu']['mainmenu']['MainMenuSelectPage']['SettingAttribute'];
			$Tier6Databases->ModulePass('XhtmlForm', 'form', 'updateFormOption', array('PageID' => array('PageID' => $FormOptionID, 'ObjectID' => $NewPageID), 'Content' => $FormOption));
			$FormOptionID = $Options['XhtmlMainMenu']['mainmenu']['MainMenuUpdatePage']['SettingAttribute'];
			$Tier6Databases->ModulePass('XhtmlForm', 'form', 'updateFormOption', array('PageID' => array('PageID' => $FormOptionID, 'ObjectID' => $NewPageID), 'Content' => $FormOption));
			
			$CalendarTablePageID = array();
			$CalendarTablePageID['PageID'] = $NewPageID;
			$CalendarTablePageID['CalendarAppointmentName'] = 'CalendarAppointments';
			$CalendarTablePageID['TableName'] = 'CalendarTable';
			$Tier6Databases->ModulePass('XhtmlCalendarTable', 'calendar', 'updateCalendar', $CalendarTablePageID);
			$Tier6Databases->ModulePass('XhtmlCalendarTable', 'calendar', 'createCalendar', $CalendarTable);
			
			$Tier6Databases->ModulePass('XhtmlHeader', 'header', 'updateHeader', $PageID);
			$Tier6Databases->ModulePass('XhtmlHeader', 'header', 'createHeader', $Header);
			
			$Tier6Databases->ModulePass('XhtmlMenu', 'headerpanel1', 'updateMenu', array('PageID' => array('PageID' => $NewPageID, 'ObjectID' => 2), 'Content' => $HeaderPanel1));
			$Tier6Databases->ModulePass('XhtmlContent', 'content', 'updateContentPrintPreview', array('PageID' => $PageID, 'Content' => $ContentPrintPreview));
			$Tier6Databases->ModulePass('XmlSitemap', 'sitemap', 'updateSitemapItem', array('PageID' => $PageID, 'Content' => $Sitemap));
			
			$Tier6Databases->ModulePass('XhtmlContent', 'content', 'updateContent', $PageID);
			$Tier6Databases->updateContentVersion($PageID, 'ContentLayerVersion');
			//$Tier6Databases->updateContent($PageID, 'ContentLayer');
			
			$Tier6Databases->ModulePass('XhtmlContent', 'content', 'createContent', $Content);
			
			$Tier6Databases->createContentVersion($ContentLayerVersion, 'ContentLayerVersion');
			//$Tier6Databases->createContent($ContentLayer, 'ContentLayer');
			
			$Tier6Databases->SessionDestroy($sessionname);
			$sessionname = $Tier6Databases->SessionStart('UpdatedNewsPage');

			$Page = '../../../index.php?PageID=';
			$Page .= $NewPageID;

			$_SESSION['POST']['Error']['Link'] = '<a href=\'';
			$_SESSION['POST']['Error']['Link'] .= $Page;
			$_SESSION['POST']['Error']['Link'] .= '\'>Updated Calendar Page</a>';

			$CreatedUpdateCalendarPage = $Options['XhtmlCalendarTable']['calendar']['CalendarPageCreatedUpdatePage']['SettingAttribute'];
			header("Location: $CreatedUpdateCalendarPage&SessionID=$sessionname");
		}
	} else {
		$Tier6Databases->SessionDestroy($sessionname);
		$Options = $Tier6Databases->getLayerModuleSetting();
		$UpdateCalendarPageSelect = $Options['XhtmlCalendarTable']['calendar']['UpdateCalendarPageSelect']['SettingAttribute'];
		header("Location: ../../index.php?PageID=$UpdateCalendarPageSelect");
	}

?>