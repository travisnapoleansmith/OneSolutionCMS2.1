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
		$NewPageID = ++$LastPageID;
		
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
		
		$Header = array();
		$Header['PageID'] = $NewPageID;
		$Header['RevisionID'] = 0;
		$Header['CurrentVersion'] = 'true';
		$Header['PageTitle'] = $hold['FilteredInput']['PageTitle'];
		$Header['PageIcon'] = 'favicon.ico';
		$Header['Rss2.0'] = 'rss.php';
		$Header['Rss0.92'] = NULL;
		$Header['Atom0.3'] = NULL;
		$Header['BaseHref'] = NULL;
		$Header['MetaName1'] = 'keywords';
		$Header['MetaName2'] = 'description';
		$Header['MetaName3'] = NULL;
		$Header['MetaName4'] = NULL;
		$Header['MetaName5'] = NULL;
		$Header['MetaNameContent1'] = $hold['FilteredInput']['Keywords'];
		$Header['MetaNameContent2'] = $hold['FilteredInput']['Description'];
		$Header['MetaNameContent3'] = NULL;
		$Header['MetaNameContent4'] = NULL;
		$Header['MetaNameContent5'] = NULL;
		$Header['HttpEquivType1'] = NULL;
		$Header['HttpEquivType2'] = NULL;
		$Header['HttpEquivType3'] = NULL;
		$Header['HttpEquivType4'] = NULL;
		$Header['HttpEquivType5'] = NULL;
		$Header['HttpEquivTypeContent1'] = NULL;
		$Header['HttpEquivTypeContent2'] = NULL;
		$Header['HttpEquivTypeContent3'] = NULL;
		$Header['HttpEquivTypeContent4'] = NULL;
		$Header['HttpEquivTypeContent5'] = NULL;
		$Header['LinkCharset1'] = NULL;
		$Header['LinkCharset2'] = NULL;
		$Header['LinkCharset3'] = NULL;
		$Header['LinkCharset4'] = NULL;
		$Header['LinkCharset5'] = NULL;
		$Header['LinkHref1'] = NULL;
		$Header['LinkHref2'] = NULL;
		$Header['LinkHref3'] = NULL;
		$Header['LinkHref4'] = NULL;
		$Header['LinkHref5'] = NULL;
		$Header['LinkHreflang1'] = NULL;
		$Header['LinkHreflang2'] = NULL;
		$Header['LinkHreflang3'] = NULL;
		$Header['LinkHreflang4'] = NULL;
		$Header['LinkHreflang5'] = NULL;
		$Header['LinkMedia1'] = NULL;
		$Header['LinkMedia2'] = NULL;
		$Header['LinkMedia3'] = NULL;
		$Header['LinkMedia4'] = NULL;
		$Header['LinkMedia5'] = NULL;
		$Header['LinkRel1'] = NULL;
		$Header['LinkRel2'] = NULL;
		$Header['LinkRel3'] = NULL;
		$Header['LinkRel4'] = NULL;
		$Header['LinkRel5'] = NULL;
		$Header['LinkRev1'] = NULL;
		$Header['LinkRev2'] = NULL;
		$Header['LinkRev3'] = NULL;
		$Header['LinkRev4'] = NULL;
		$Header['LinkRev5'] = NULL;
		$Header['LinkType1'] = NULL;
		$Header['LinkType2'] = NULL;
		$Header['LinkType3'] = NULL;
		$Header['LinkType4'] = NULL;
		$Header['LinkType5'] = NULL;
		$Header['Enable/Disable'] = $_POST['EnableDisable'];
		$Header['Status'] = $_POST['Status'];
		
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
		
		$ContentLayerVersion = array();
		$ContentLayerVersion['PageID'] = $NewPageID;
		$ContentLayerVersion['RevisionID'] = 0;
		$ContentLayerVersion['CurrentVersion'] = 'true';
		$ContentLayerVersion['ContentPageType'] = 'ContentPage';
		$ContentLayerVersion['ContentPageMenuName'] = $hold['FilteredInput']['MenuName'];
		$ContentLayerVersion['ContentPageMenuTitle'] = $hold['FilteredInput']['MenuTitle'];
		$ContentLayerVersion['ContentPageMenuParentObjectID'] = NULL;
		$ContentLayerVersion['UserAccessGroup'] = 'Guest';
		$ContentLayerVersion['Owner'] = $_COOKIE['UserName'];
		$ContentLayerVersion['Creator'] = $_COOKIE['UserName'];
		$ContentLayerVersion['LastChangeUser'] = $_COOKIE['UserName'];
		$ContentLayerVersion['CreationDateTime'] = $DateTime;
		$ContentLayerVersion['LastChangeDateTime'] = $DateTime;
		
		$ContentLayer = array();
		$ContentLayer[0]['PageID'] = $NewPageID;
		$ContentLayer[0]['ObjectID'] = 0;
		$ContentLayer[0]['ObjectType'] = 'XhtmlHeader';
		$ContentLayer[0]['ObjectTypeName'] = 'header';
		$ContentLayer[0]['ContainerObjectID'] = 0;
		$ContentLayer[0]['RevisionID'] = 0;
		$ContentLayer[0]['CurrentVersion'] = 'true';
		$ContentLayer[0]['Authenticate'] = 'false';
		$ContentLayer[0]['StartTag'] = NULL;
		$ContentLayer[0]['EndTag'] = NULL;
		$ContentLayer[0]['StartTagID'] = NULL;
		$ContentLayer[0]['StartTagStyle'] = NULL;
		$ContentLayer[0]['StartTagClass'] = NULL;
		$ContentLayer[0]['Enable/Disable'] = $_POST['EnableDisable'];
		$ContentLayer[0]['Status'] = $_POST['Status'];
		
		$ContentLayer[1]['PageID'] = $NewPageID;
		$ContentLayer[1]['ObjectID'] = 1;
		$ContentLayer[1]['ObjectType'] = 'BACKGROUND';
		$ContentLayer[1]['ObjectTypeName'] = 'background';
		$ContentLayer[1]['ContainerObjectID'] = 0;
		$ContentLayer[1]['RevisionID'] = 0;
		$ContentLayer[1]['CurrentVersion'] = 'true';
		$ContentLayer[1]['Authenticate'] = 'false';
		$ContentLayer[1]['StartTag'] = NULL;
		$ContentLayer[1]['EndTag'] = NULL;
		$ContentLayer[1]['StartTagID'] = NULL;
		$ContentLayer[1]['StartTagStyle'] = NULL;
		$ContentLayer[1]['StartTagClass'] = NULL;
		$ContentLayer[1]['Enable/Disable'] = $_POST['EnableDisable'];
		$ContentLayer[1]['Status'] = $_POST['Status'];
		
		$ContentLayer[2]['PageID'] = $NewPageID;
		$ContentLayer[2]['ObjectID'] = 2;
		$ContentLayer[2]['ObjectType'] = 'CONTENT';
		$ContentLayer[2]['ObjectTypeName'] = 'contentdummy';
		$ContentLayer[2]['ContainerObjectID'] = 0;
		$ContentLayer[2]['RevisionID'] = 0;
		$ContentLayer[2]['CurrentVersion'] = 'true';
		$ContentLayer[2]['Authenticate'] = 'false';
		$ContentLayer[2]['StartTag'] = '<div>';
		$ContentLayer[2]['EndTag'] = NULL;
		$ContentLayer[2]['StartTagID'] = 'content';
		$ContentLayer[2]['StartTagStyle'] = NULL;
		$ContentLayer[2]['StartTagClass'] = NULL;
		$ContentLayer[2]['Enable/Disable'] = $_POST['EnableDisable'];
		$ContentLayer[2]['Status'] = $_POST['Status'];
		
		$ContentLayer[3]['PageID'] = $NewPageID;
		$ContentLayer[3]['ObjectID'] = 3;
		$ContentLayer[3]['ObjectType'] = 'CONTENT';
		$ContentLayer[3]['ObjectTypeName'] = 'contentdummy';
		$ContentLayer[3]['ContainerObjectID'] = 0;
		$ContentLayer[3]['RevisionID'] = 0;
		$ContentLayer[3]['CurrentVersion'] = 'true';
		$ContentLayer[3]['Authenticate'] = 'false';
		$ContentLayer[3]['StartTag'] = '<div>';
		$ContentLayer[3]['EndTag'] = NULL;
		$ContentLayer[3]['StartTagID'] = 'container-box';
		$ContentLayer[3]['StartTagStyle'] = NULL;
		$ContentLayer[3]['StartTagClass'] = NULL;
		$ContentLayer[3]['Enable/Disable'] = $_POST['EnableDisable'];
		$ContentLayer[3]['Status'] = $_POST['Status'];
		
		$ContentLayer[4]['PageID'] = $NewPageID;
		$ContentLayer[4]['ObjectID'] = 4;
		$ContentLayer[4]['ObjectType'] = 'CONTENT';
		$ContentLayer[4]['ObjectTypeName'] = 'contentdummy';
		$ContentLayer[4]['ContainerObjectID'] = 0;
		$ContentLayer[4]['RevisionID'] = 0;
		$ContentLayer[4]['CurrentVersion'] = 'true';
		$ContentLayer[4]['Authenticate'] = 'false';
		$ContentLayer[4]['StartTag'] = '<div>';
		$ContentLayer[4]['EndTag'] = NULL;
		$ContentLayer[4]['StartTagID'] = 'content-side';
		$ContentLayer[4]['StartTagStyle'] = NULL;
		$ContentLayer[4]['StartTagClass'] = NULL;
		$ContentLayer[4]['Enable/Disable'] = $_POST['EnableDisable'];
		$ContentLayer[4]['Status'] = $_POST['Status'];
		
		$ContentLayer[5]['PageID'] = $NewPageID;
		$ContentLayer[5]['ObjectID'] = 5;
		$ContentLayer[5]['ObjectType'] = 'XhtmlMenu';
		$ContentLayer[5]['ObjectTypeName'] = 'headerpanel1';
		$ContentLayer[5]['ContainerObjectID'] = 0;
		$ContentLayer[5]['RevisionID'] = 0;
		$ContentLayer[5]['CurrentVersion'] = 'true';
		$ContentLayer[5]['Authenticate'] = 'false';
		$ContentLayer[5]['StartTag'] = NULL;
		$ContentLayer[5]['EndTag'] = NULL;
		$ContentLayer[5]['StartTagID'] = NULL;
		$ContentLayer[5]['StartTagStyle'] = NULL;
		$ContentLayer[5]['StartTagClass'] = NULL;
		$ContentLayer[5]['Enable/Disable'] = $_POST['EnableDisable'];
		$ContentLayer[5]['Status'] = $_POST['Status'];
		
		$ContentLayer[6]['PageID'] = $NewPageID;
		$ContentLayer[6]['ObjectID'] = 6;
		$ContentLayer[6]['ObjectType'] = 'XhtmlMainMenu';
		$ContentLayer[6]['ObjectTypeName'] = 'mainmenu';
		$ContentLayer[6]['ContainerObjectID'] = 0;
		$ContentLayer[6]['RevisionID'] = 0;
		$ContentLayer[6]['CurrentVersion'] = 'true';
		$ContentLayer[6]['Authenticate'] = 'false';
		$ContentLayer[6]['StartTag'] = NULL;
		$ContentLayer[6]['EndTag'] = NULL;
		$ContentLayer[6]['StartTagID'] = NULL;
		$ContentLayer[6]['StartTagStyle'] = NULL;
		$ContentLayer[6]['StartTagClass'] = NULL;
		$ContentLayer[6]['Enable/Disable'] = $_POST['EnableDisable'];
		$ContentLayer[6]['Status'] = $_POST['Status'];
		
		$ContentLayer[7]['PageID'] = $NewPageID;
		$ContentLayer[7]['ObjectID'] = 7;
		$ContentLayer[7]['ObjectType'] = 'XhtmlContent';
		$ContentLayer[7]['ObjectTypeName'] = 'content';
		$ContentLayer[7]['ContainerObjectID'] = 0;
		$ContentLayer[7]['RevisionID'] = 0;
		$ContentLayer[7]['CurrentVersion'] = 'true';
		$ContentLayer[7]['Authenticate'] = 'false';
		$ContentLayer[7]['StartTag'] = '<div>';
		$ContentLayer[7]['EndTag'] = '</div>';
		$ContentLayer[7]['StartTagID'] = 'main-content';
		$ContentLayer[7]['StartTagStyle'] = NULL;
		$ContentLayer[7]['StartTagClass'] = NULL;
		$ContentLayer[7]['Enable/Disable'] = $_POST['EnableDisable'];
		$ContentLayer[7]['Status'] = $_POST['Status'];
		
		$ContentLayer[8]['PageID'] = $NewPageID;
		$ContentLayer[8]['ObjectID'] = 8;
		$ContentLayer[8]['ObjectType'] = 'CONTENT';
		$ContentLayer[8]['ObjectTypeName'] = 'contentdummy';
		$ContentLayer[8]['ContainerObjectID'] = 0;
		$ContentLayer[8]['RevisionID'] = 0;
		$ContentLayer[8]['CurrentVersion'] = 'true';
		$ContentLayer[8]['Authenticate'] = 'false';
		$ContentLayer[8]['StartTag'] = NULL;
		$ContentLayer[8]['EndTag'] = '</div>';
		$ContentLayer[8]['StartTagID'] = NULL;
		$ContentLayer[8]['StartTagStyle'] = NULL;
		$ContentLayer[8]['StartTagClass'] = NULL;
		$ContentLayer[8]['Enable/Disable'] = $_POST['EnableDisable'];
		$ContentLayer[8]['Status'] = $_POST['Status'];
		
		$ContentLayer[9]['PageID'] = $NewPageID;
		$ContentLayer[9]['ObjectID'] = 9;
		$ContentLayer[9]['ObjectType'] = 'XhtmlContent';
		$ContentLayer[9]['ObjectTypeName'] = 'adpanel1';
		$ContentLayer[9]['ContainerObjectID'] = 0;
		$ContentLayer[9]['RevisionID'] = 0;
		$ContentLayer[9]['CurrentVersion'] = 'true';
		$ContentLayer[9]['Authenticate'] = 'false';
		$ContentLayer[9]['StartTag'] = NULL;
		$ContentLayer[9]['EndTag'] = NULL;
		$ContentLayer[9]['StartTagID'] = NULL;
		$ContentLayer[9]['StartTagStyle'] = NULL;
		$ContentLayer[9]['StartTagClass'] = NULL;
		$ContentLayer[9]['Enable/Disable'] = $_POST['EnableDisable'];
		$ContentLayer[9]['Status'] = $_POST['Status'];
		
		$ContentLayer[10]['PageID'] = $NewPageID;
		$ContentLayer[10]['ObjectID'] = 10;
		$ContentLayer[10]['ObjectType'] = 'FOOTER';
		$ContentLayer[10]['ObjectTypeName'] = 'footer';
		$ContentLayer[10]['ContainerObjectID'] = 0;
		$ContentLayer[10]['RevisionID'] = 0;
		$ContentLayer[10]['CurrentVersion'] = 'true';
		$ContentLayer[10]['Authenticate'] = 'false';
		$ContentLayer[10]['StartTag'] = NULL;
		$ContentLayer[10]['EndTag'] = NULL;
		$ContentLayer[10]['StartTagID'] = NULL;
		$ContentLayer[10]['StartTagStyle'] = NULL;
		$ContentLayer[10]['StartTagClass'] = NULL;
		$ContentLayer[10]['Enable/Disable'] = $_POST['EnableDisable'];
		$ContentLayer[10]['Status'] = $_POST['Status'];
		
		$ContentLayer[11]['PageID'] = $NewPageID;
		$ContentLayer[11]['ObjectID'] = 11;
		$ContentLayer[11]['ObjectType'] = 'CONTENT';
		$ContentLayer[11]['ObjectTypeName'] = 'contentdummy';
		$ContentLayer[11]['ContainerObjectID'] = 0;
		$ContentLayer[11]['RevisionID'] = 0;
		$ContentLayer[11]['CurrentVersion'] = 'true';
		$ContentLayer[11]['Authenticate'] = 'false';
		$ContentLayer[11]['StartTag'] = NULL;
		$ContentLayer[11]['EndTag'] = '</div>';
		$ContentLayer[11]['StartTagID'] = NULL;
		$ContentLayer[11]['StartTagStyle'] = NULL;
		$ContentLayer[11]['StartTagClass'] = NULL;
		$ContentLayer[11]['Enable/Disable'] = $_POST['EnableDisable'];
		$ContentLayer[11]['Status'] = $_POST['Status'];
		
		$ContentLayer[12]['PageID'] = $NewPageID;
		$ContentLayer[12]['ObjectID'] = 12;
		$ContentLayer[12]['ObjectType'] = 'CONTENT';
		$ContentLayer[12]['ObjectTypeName'] = 'contentdummy';
		$ContentLayer[12]['ContainerObjectID'] = 0;
		$ContentLayer[12]['RevisionID'] = 0;
		$ContentLayer[12]['CurrentVersion'] = 'true';
		$ContentLayer[12]['Authenticate'] = 'false';
		$ContentLayer[12]['StartTag'] = NULL;
		$ContentLayer[12]['EndTag'] = '</div>';
		$ContentLayer[12]['StartTagID'] = NULL;
		$ContentLayer[12]['StartTagStyle'] = NULL;
		$ContentLayer[12]['StartTagClass'] = NULL;
		$ContentLayer[12]['Enable/Disable'] = $_POST['EnableDisable'];
		$ContentLayer[12]['Status'] = $_POST['Status'];
		
		
		$Sitemap = array();
		$Sitemap['PageID'] = $NewPageID;
		$Sitemap['Loc'] = $Location;
		$Sitemap['Lastmod'] = $Date;
		$Sitemap['ChangeFreq'] = $_POST['Frequency'];
		$Sitemap['Priority'] = $_POST['Priority'];
		$Sitemap['Enable/Disable'] = $_POST['EnableDisable'];
		$Sitemap['Status'] = $_POST['Status'];
		
		$ContentPrintPreview = array();
		$ContentPrintPreview['PageID'] = $NewPageID;
		$ContentPrintPreview['PrintPageID1'] = $NewPageID;
		$ContentPrintPreview['PrintPageID2'] = NULL;
		$ContentPrintPreview['PrintPageID3'] = NULL;
		$ContentPrintPreview['PrintPageID4'] = NULL;
		$ContentPrintPreview['PrintPageID5'] = NULL;
		$ContentPrintPreview['PrintPageID6'] = NULL;
		$ContentPrintPreview['PrintPageID7'] = NULL;
		$ContentPrintPreview['PrintPageID8'] = NULL;
		$ContentPrintPreview['PrintPageID9'] = NULL;
		$ContentPrintPreview['PrintPageID10'] = NULL;
		$ContentPrintPreview['PrintPageID11'] = NULL;
		$ContentPrintPreview['PrintPageID12'] = NULL;
		$ContentPrintPreview['PrintPageID13'] = NULL;
		$ContentPrintPreview['PrintPageID14'] = NULL;
		$ContentPrintPreview['PrintPageID15'] = NULL;
		$ContentPrintPreview['PrintPageID16'] = NULL;
		$ContentPrintPreview['PrintPageID17'] = NULL;
		$ContentPrintPreview['PrintPageID18'] = NULL;
		$ContentPrintPreview['PrintPageID19'] = NULL;
		$ContentPrintPreview['PrintPageID20'] = NULL;
		$ContentPrintPreview['Enable/Disable'] = $_POST['EnableDisable'];
		$ContentPrintPreview['Status'] = $_POST['Status'];
		
		$UpdateContentPageSelect = $Options['XhtmlContent']['content']['UpdateContentPageSelect']['SettingAttribute'];
		$FormSelect = array();
		$FormSelect['PageID'] = $UpdateContentPageSelect;
		$FormSelect['ObjectID'] = $NewContentPage;
		$FormSelect['StopObjectID'] = 9999;
		$FormSelect['ContinueObjectID'] = NULL;
		$FormSelect['ContainerObjectType'] = 'Option';
		$FormSelect['ContainerObjectTypeName'] = 'FormOption';
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