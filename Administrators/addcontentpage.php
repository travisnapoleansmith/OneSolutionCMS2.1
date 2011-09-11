<?php
	require_once ('Configuration/includes.php');
	$Options = $Tier6Databases->getLayerModuleSetting();
	$PageName = 'index.php?PageID=';
	if ($_POST['AddContentPage']) {
		$PageName .= $_POST['AddContentPage'];
	} else {
		$_POST['AddContentPage'] = $Options['XhtmlContent']['content']['AddContentPage']['SettingAttribute'];
		$PageName .= $_POST['AddContentPage'];
	}
	
	$hold = $Tier6Databases->FormSubmitValidate('AddContentPage', $PageName);
	
	if ($hold) {
		$sessionname = $Tier6Databases->SessionStart('CreateContentPage');
		
		$DateTime = date('Y-m-d H:i:s');
		$Date = date('Y-m-d');
		$SiteName = $GLOBALS['sitename'];
		
		$LastPageID = $Tier6Databases->ModulePass('XhtmlContent', 'content', 'getLastContentPageID', array());
		if (isset($LastPageID)) {
			$NewPageID = ++$LastPageID;
		} else {
			$NewPageID = 1;
		}
		
		$LastContentPage = $Options['XhtmlContent']['content']['LastContentPage']['SettingAttribute'];
		$NewContentPage = ++$LastContentPage;
		$Tier6Databases->updateModuleSetting('XhtmlContent', 'content', 'LastContentPage', $NewContentPage);
		
		$NewPage = '../index.php?PageID=';
		$NewPage .= $NewPageID;
		
		$Location = 'index.php?PageID=';
		$Location .= $NewPageID;
		
		$_SESSION['POST']['Error']['Link'] = '<a href=\'';
		$_SESSION['POST']['Error']['Link'] .= $NewPage;
		$_SESSION['POST']['Error']['Link'] .= '\'>New Content Page</a>';
		
		
		
		if ($_POST['Heading'] == 'Null' | $_POST['Heading'] == 'NULL') {
			$_POST['Heading'] = NULL;
			$hold['FilteredInput']['Heading'] = NULL;
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
		define(NewPageID, $NewPageID);
		define(CurrentVersionTrueFalse, 'true');
		define(ContentPageType, 'ContentPage');
		
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
		$Content[0]['Content'] = $hold['FilteredInput']['Content'];
		
		if ($hold['FilteredInput']['Content'] != NULL) {
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
		$Content[1]['ContainerObjectType'] = 'XhtmlContent';
		$Content[1]['ContainerObjectName'] = 'content';
		$Content[1]['ContainerObjectID'] = 2;
		$Content[1]['ContainerObjectPrintPreview'] = 'true';
		$Content[1]['RevisionID'] = 0;
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
		
		$Header = parse_ini_file('ModuleSettings/Tier6-ContentLayer/Modules/XhtmlHeader/AddXhtmlHeader.ini',FALSE);
		$Header = $Tier6Databases->EmptyStringToNullArray($Header);
		
		$HeaderPanel1 = array();
		$HeaderPanel1[0]['PageID'] = $NewPageID;
		$HeaderPanel1[0]['ObjectID'] = 1;
		$HeaderPanel1[0]['StartTag'] = NULL;
		$HeaderPanel1[0]['EndTag'] = NULL;
		$HeaderPanel1[0]['StartTagID'] = NULL;
		$HeaderPanel1[0]['StartTagStyle'] = NULL;
		$HeaderPanel1[0]['StartTagClass'] = NULL;
		$HeaderPanel1[0]['Div'] = NULL;
		$HeaderPanel1[0]['DivID'] = 'header-sitename';
		$HeaderPanel1[0]['DivClass'] = NULL;
		$HeaderPanel1[0]['DivStyle'] = NULL;
		$HeaderPanel1[0]['Div1'] = "<h1 class=\"MainHeading\">$SiteName</h1>";
		$HeaderPanel1[0]['Div1Title'] = NULL;
		$HeaderPanel1[0]['Div1ID'] = NULL;
		$HeaderPanel1[0]['Div1Class'] = NULL;
		$HeaderPanel1[0]['Div1Style'] = NULL;
		$HeaderPanel1[0]['Enable/Disable'] = $_POST['EnableDisable'];;
		$HeaderPanel1[0]['Status'] = $_POST['Status'];
		
		$header = $hold['FilteredInput']['Header'];
		
		$HeaderPanel1[1]['PageID'] = $NewPageID;
		$HeaderPanel1[1]['ObjectID'] = 2;
		$HeaderPanel1[1]['StartTag'] = NULL;
		$HeaderPanel1[1]['EndTag'] = NULL;
		$HeaderPanel1[1]['StartTagID'] = NULL;
		$HeaderPanel1[1]['StartTagStyle'] = NULL;
		$HeaderPanel1[1]['StartTagClass'] = NULL;
		$HeaderPanel1[1]['Div'] = NULL;
		$HeaderPanel1[1]['DivID'] = 'header-pagename';
		$HeaderPanel1[1]['DivClass'] = NULL;
		$HeaderPanel1[1]['DivStyle'] = NULL;
		$HeaderPanel1[1]['Div1'] = "<h1 class=\"SecondaryHeading\">$header</h1>";
		$HeaderPanel1[1]['Div1Title'] = NULL;
		$HeaderPanel1[1]['Div1ID'] = NULL;
		$HeaderPanel1[1]['Div1Class'] = NULL;
		$HeaderPanel1[1]['Div1Style'] = NULL;
		$HeaderPanel1[1]['Enable/Disable'] = $_POST['EnableDisable'];
		$HeaderPanel1[1]['Status'] = $_POST['Status'];
		
		$ContentLayerVersion = parse_ini_file('ModuleSettings/Tier6-ContentLayer/GlobalSettings/AddContentLayerVersion.ini',FALSE);
		$ContentLayerVersion = $Tier6Databases->EmptyStringToNullArray($ContentLayerVersion);
		
		$ContentLayer = parse_ini_file('ModuleSettings/Tier6-ContentLayer/GlobalSettings/AddContentLayer.ini',TRUE);
		$ContentLayer = $Tier6Databases->EmptyStringToNullArray($ContentLayer);
		
		$Sitemap = parse_ini_file('ModuleSettings/Tier6-ContentLayer/Modules/XmlSitemap/AddXmlSitemap.ini',FALSE);
		$Sitemap = $Tier6Databases->EmptyStringToNullArray($Sitemap);
		
		$ContentPrintPreview = parse_ini_file('ModuleSettings/Tier6-ContentLayer/Modules/XhtmlContent/AddPrintPreview.ini',FALSE);
		$ContentPrintPreview = $Tier6Databases->EmptyStringToNullArray($ContentPrintPreview);
		
		$MainMenuItemLookup = parse_ini_file('ModuleSettings/Tier6-ContentLayer/Modules/XhtmlMainMenu/AddMainMenuItemLookup.ini',FALSE);
		$MainMenuItemLookup = $Tier6Databases->EmptyStringToNullArray($MainMenuItemLookup);
		
		$UpdateContentPageSelect = $Options['XhtmlContent']['content']['UpdateContentPageSelect']['SettingAttribute'];
		$FormSelect = array();
		$FormSelect['PageID'] = $UpdateContentPageSelect;
		$FormSelect['ObjectID'] = $NewContentPage;
		$FormSelect['StopObjectID'] = 9999;
		$FormSelect['ContinueObjectID'] = NULL;
		$FormSelect['ContainerObjectType'] = 'Option';
		$FormSelect['ContainerObjectTypeName'] = 'AdministratorFormOption';
		$FormSelect['ContainerObjectID'] = $NewContentPage;
		$FormSelect['FormSelectDisabled'] = NULL;
		$FormSelect['FormSelectMultiple'] = NULL;
		$FormSelect['FormSelectName'] = 'ContentPage';
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
		$FormSelect['FormSelectStyle'] = 'width: 245px;';
		$FormSelect['FormSelectTabIndex'] = NULL;
		$FormSelect['FormSelectTitle'] = NULL;
		$FormSelect['FormSelectXMLLang'] = 'en-us';
		$FormSelect['Enable/Disable'] = 'Enable';
		$FormSelect['Status'] = 'Approved';
		
		$FormOptionText = $hold['FilteredInput']['PageTitle'];
		$FormOptionValue = $NewContentPage;
		$FormOptionValue .= ' - ';
		$FormOptionValue .= $NewPageID;
		
		$FormOption = array();
		$FormOption['PageID'] = $UpdateContentPageSelect;
		$FormOption['ObjectID'] = $NewContentPage;
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
		$Tier6Databases->ModulePass('XhtmlMenu', 'headerpanel1', 'createMenu', $HeaderPanel1);
		$Tier6Databases->createContentVersion($ContentLayerVersion, 'ContentLayerVersion');
		$Tier6Databases->ModulePass('XhtmlContent', 'content', 'createContentPrintPreview', $ContentPrintPreview);
		$Tier6Databases->createContent($ContentLayer, 'ContentLayer');
		
		$Tier6Databases->ModulePass('XhtmlMainMenu', 'mainmenu', 'createMainMenuItemLookup', $MainMenuItemLookup);
		
		$Tier6Databases->ModulePass('XmlSitemap', 'sitemap', 'createSitemapItem', $Sitemap);

		$UpdateContentPageSelect = $Options['XhtmlContent']['content']['UpdateContentPageSelect']['SettingAttribute'];
		$FormSelect['PageID'] = $UpdateContentPageSelect;
		$FormOption['PageID'] = $UpdateContentPageSelect;
		
		$Tier6Databases->ModulePass('XhtmlForm', 'form', 'createFormOption', $FormOption);
		$Tier6Databases->ModulePass('XhtmlForm', 'form', 'createFormSelect', $FormSelect);
		
		$DeleteContentPage = $Options['XhtmlContent']['content']['DeleteContentPage']['SettingAttribute'];
		$FormSelect['PageID'] = $DeleteContentPage;
		$FormOption['PageID'] = $DeleteContentPage;
		
		$Tier6Databases->ModulePass('XhtmlForm', 'form', 'createFormOption', $FormOption);
		$Tier6Databases->ModulePass('XhtmlForm', 'form', 'createFormSelect', $FormSelect);
		
		$EnableDisableStatusChangeContentPage = $Options['XhtmlContent']['content']['EnableDisableStatusChangeContentPage']['SettingAttribute'];
		$FormSelect['PageID'] = $EnableDisableStatusChangeContentPage;
		$FormOption['PageID'] = $EnableDisableStatusChangeContentPage;
		
		$Tier6Databases->ModulePass('XhtmlForm', 'form', 'createFormOption', $FormOption);
		$Tier6Databases->ModulePass('XhtmlForm', 'form', 'createFormSelect', $FormSelect);
		
		$FormOptionValue = $NewPageID;
		$FormOptionValue .= ' - ';
		$FormOptionValue .= 'NULL';
		
		$MainMenuSelectPage = $Options['XhtmlMainMenu']['mainmenu']['MainMenuSelectPage']['SettingAttribute'];
		$FormSelect['PageID'] = $MainMenuSelectPage;
		$FormSelect['ObjectID'] = $NewPageID;
		$FormSelect['ContainerObjectID'] = $NewPageID;
		$FormSelect['FormSelectName'] = 'MenuItem1';
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
		
		$ContentPageCreatedPage = $Options['XhtmlContent']['content']['ContentPageCreatedPage']['SettingAttribute'];
		
		header("Location: $ContentPageCreatedPage&SessionID=$sessionname");
		exit;
	}
	
?>