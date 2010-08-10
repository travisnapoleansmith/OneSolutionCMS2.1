<?php
	require_once ('Configuration/includes.php');
	
	$sessionname = NULL;
	$sessionname = $_COOKIE['SessionID'];
	session_name($sessionname);
	session_start();
	
	$Options = $Tier6Databases->getLayerModuleSetting();
	$UpdateNewsPage = $Options['XhtmlNewsStories']['news']['UpdateNewsPage']['SettingAttribute'];
	$NewUpdateNewsPage = explode('=', $UpdateNewsPage);
	$NewUpdateNewsPage = $NewUpdateNewsPage[1];
	
	$PageID = $_SESSION['POST']['FilteredInput']['PageID'];
	$FormOptionObjectID = $_SESSION['POST']['FilteredInput']['FormOptionObjectID'];
	$RevisionID = $_SESSION['POST']['FilteredInput']['RevisionID'];
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
		$PageName = $UpdateNewsPage;

		$hold = $Tier6Databases->FormSubmitValidate('UpdateNewsPage', $PageName);
		if ($hold) {
			$DateTime = date('Y-m-d H:i:s');
			$Date = date('Y-m-d');
			$SiteName = $GLOBALS['sitename'];
			
			$NewPage = '../index.php?PageID=';
			$NewPage .= $NewPageID;
			
			$Location = 'index.php?PageID=';
			$Location .= $NewPageID;
			
			$_SESSION['POST']['Error']['Link'] = '<a href=\'';
			$_SESSION['POST']['Error']['Link'] .= $NewPage;
			$_SESSION['POST']['Error']['Link'] .= '\'>Updated News Page</a>';
			
			
			
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
			
			$Content[1]['PageID'] = $PageID;
			$Content[1]['ObjectID'] = 1;
			$Content[1]['ContainerObjectType'] = 'XhtmlNewsStories';
			$Content[1]['ContainerObjectName'] = 'news';
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
			
			$Content[2]['PageID'] = $PageID;
			$Content[2]['ObjectID'] = 2;
			$Content[2]['ContainerObjectType'] = 'XhtmlContent';
			$Content[2]['ContainerObjectName'] = 'content';
			$Content[2]['ContainerObjectID'] = 4;
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
			
			$Header = array();
			$Header['PageID'] = $PageID;
			$Header['RevisionID'] = $NewRevisionID;
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
			
			$NewsStoryLookup = array();
			//$NewsStoryLookup['PageID'] = $PageID;
			//$NewsStoryLookup['ObjectID'] = 1;
			//$NewsStoryLookup['NewsStoryPageID'] = NULL;
			$NewsStoryLookup['NewsStoryDay'] = $_POST['NewsDay'];
			$NewsStoryLookup['NewsStoryMonth'] = str_replace(' ', '', $_POST['NewsMonth']);
			$NewsStoryLookup['NewsStoryYear'] = $_POST['NewsYear'];
			//$NewsStoryLookup['Enable/Disable'] = $_POST['EnableDisable'];
			//$NewsStoryLookup['Status'] = $_POST['Status'];
			
			
			$HeaderPanel1 = array();
			//$HeaderPanel1[0]['PageID'] = $PageID;
			//$HeaderPanel1[0]['ObjectID'] = 1;
			//$HeaderPanel1[0]['StartTag'] = NULL;
			//$HeaderPanel1[0]['EndTag'] = NULL;
			//$HeaderPanel1[0]['StartTagID'] = NULL;
			//$HeaderPanel1[0]['StartTagStyle'] = NULL;
			//$HeaderPanel1[0]['StartTagClass'] = NULL;
			//$HeaderPanel1[0]['Div'] = NULL;
			//$HeaderPanel1[0]['DivID'] = 'header-sitename';
			//$HeaderPanel1[0]['DivClass'] = NULL;
			//$HeaderPanel1[0]['DivStyle'] = NULL;
			//$HeaderPanel1[0]['Div1'] = "<h1 class=\"MainHeading\">$SiteName</h1>";
			//$HeaderPanel1[0]['Div1Title'] = NULL;
			//$HeaderPanel1[0]['Div1ID'] = NULL;
			//$HeaderPanel1[0]['Div1Class'] = NULL;
			//$HeaderPanel1[0]['Div1Style'] = NULL;
			//$HeaderPanel1[0]['Enable/Disable'] = $_POST['EnableDisable'];;
			//$HeaderPanel1[0]['Status'] = $_POST['Status'];
			
			$header = $hold['FilteredInput']['Header'];
			
			//$HeaderPanel1[1]['PageID'] = $PageID;
			//$HeaderPanel1[1]['ObjectID'] = 2;
			//$HeaderPanel1[1]['StartTag'] = NULL;
			//$HeaderPanel1[1]['EndTag'] = NULL;
			//$HeaderPanel1[1]['StartTagID'] = NULL;
			//$HeaderPanel1[1]['StartTagStyle'] = NULL;
			//$HeaderPanel1[1]['StartTagClass'] = NULL;
			//$HeaderPanel1[1]['Div'] = NULL;
			//$HeaderPanel1[1]['DivID'] = 'header-pagename';
			//$HeaderPanel1[1]['DivClass'] = NULL;
			//$HeaderPanel1[1]['DivStyle'] = NULL;
			$HeaderPanel1[1]['Div1'] = "<h1 class=\"SecondaryHeading\">$header</h1>";
			//$HeaderPanel1[1]['Div1Title'] = NULL;
			//$HeaderPanel1[1]['Div1ID'] = NULL;
			//$HeaderPanel1[1]['Div1Class'] = NULL;
			//$HeaderPanel1[1]['Div1Style'] = NULL;
			//$HeaderPanel1[1]['Enable/Disable'] = $_POST['EnableDisable'];
			//$HeaderPanel1[1]['Status'] = $_POST['Status'];
			
			
			$ContentLayerVersion = array();
			$ContentLayerVersion['PageID'] = $PageID;
			$ContentLayerVersion['RevisionID'] = $NewRevisionID;
			$ContentLayerVersion['CurrentVersion'] = 'true';
			$ContentLayerVersion['ContentPageType'] = 'NewsPage';
			$ContentLayerVersion['ContentPageMenuName'] = $hold['FilteredInput']['MenuName'];
			$ContentLayerVersion['ContentPageMenuTitle'] = $hold['FilteredInput']['MenuTitle'];
			$ContentLayerVersion['UserAccessGroup'] = 'Guest';
			$ContentLayerVersion['Owner'] = $Owner;
			$ContentLayerVersion['Creator'] =  $_COOKIE['UserName'];
			$ContentLayerVersion['LastChangeUser'] = $_COOKIE['UserName'];
			$ContentLayerVersion['CreationDateTime'] = $CreationDateTime;
			$ContentLayerVersion['LastChangeDateTime'] = $DateTime;
			
			$ContentLayer = array();
			$ContentLayer[0]['PageID'] = $PageID;
			$ContentLayer[0]['ObjectID'] = 0;
			$ContentLayer[0]['ObjectType'] = 'XhtmlHeader';
			$ContentLayer[0]['ObjectTypeName'] = 'header';
			$ContentLayer[0]['ContainerObjectID'] = 0;
			$ContentLayer[0]['RevisionID'] = $NewRevisionID;
			$ContentLayer[0]['CurrentVersion'] = 'true';
			$ContentLayer[0]['Authenticate'] = 'false';
			$ContentLayer[0]['StartTag'] = NULL;
			$ContentLayer[0]['EndTag'] = NULL;
			$ContentLayer[0]['StartTagID'] = NULL;
			$ContentLayer[0]['StartTagStyle'] = NULL;
			$ContentLayer[0]['StartTagClass'] = NULL;
			$ContentLayer[0]['Enable/Disable'] = $_POST['EnableDisable'];
			$ContentLayer[0]['Status'] = $_POST['Status'];
			
			$ContentLayer[1]['PageID'] = $PageID;
			$ContentLayer[1]['ObjectID'] = 1;
			$ContentLayer[1]['ObjectType'] = 'BACKGROUND';
			$ContentLayer[1]['ObjectTypeName'] = 'background';
			$ContentLayer[1]['ContainerObjectID'] = 0;
			$ContentLayer[1]['RevisionID'] = $NewRevisionID;
			$ContentLayer[1]['CurrentVersion'] = 'true';
			$ContentLayer[1]['Authenticate'] = 'false';
			$ContentLayer[1]['StartTag'] = NULL;
			$ContentLayer[1]['EndTag'] = NULL;
			$ContentLayer[1]['StartTagID'] = NULL;
			$ContentLayer[1]['StartTagStyle'] = NULL;
			$ContentLayer[1]['StartTagClass'] = NULL;
			$ContentLayer[1]['Enable/Disable'] = $_POST['EnableDisable'];
			$ContentLayer[1]['Status'] = $_POST['Status'];
			
			$ContentLayer[2]['PageID'] = $PageID;
			$ContentLayer[2]['ObjectID'] = 2;
			$ContentLayer[2]['ObjectType'] = 'CONTENT';
			$ContentLayer[2]['ObjectTypeName'] = 'contentdummy';
			$ContentLayer[2]['ContainerObjectID'] = 0;
			$ContentLayer[2]['RevisionID'] = $NewRevisionID;
			$ContentLayer[2]['CurrentVersion'] = 'true';
			$ContentLayer[2]['Authenticate'] = 'false';
			$ContentLayer[2]['StartTag'] = '<div>';
			$ContentLayer[2]['EndTag'] = NULL;
			$ContentLayer[2]['StartTagID'] = 'content';
			$ContentLayer[2]['StartTagStyle'] = NULL;
			$ContentLayer[2]['StartTagClass'] = NULL;
			$ContentLayer[2]['Enable/Disable'] = $_POST['EnableDisable'];
			$ContentLayer[2]['Status'] = $_POST['Status'];
			
			$ContentLayer[3]['PageID'] = $PageID;
			$ContentLayer[3]['ObjectID'] = 3;
			$ContentLayer[3]['ObjectType'] = 'CONTENT';
			$ContentLayer[3]['ObjectTypeName'] = 'contentdummy';
			$ContentLayer[3]['ContainerObjectID'] = 0;
			$ContentLayer[3]['RevisionID'] = $NewRevisionID;
			$ContentLayer[3]['CurrentVersion'] = 'true';
			$ContentLayer[3]['Authenticate'] = 'false';
			$ContentLayer[3]['StartTag'] = '<div>';
			$ContentLayer[3]['EndTag'] = NULL;
			$ContentLayer[3]['StartTagID'] = 'container-box';
			$ContentLayer[3]['StartTagStyle'] = NULL;
			$ContentLayer[3]['StartTagClass'] = NULL;
			$ContentLayer[3]['Enable/Disable'] = $_POST['EnableDisable'];
			$ContentLayer[3]['Status'] = $_POST['Status'];
			
			$ContentLayer[4]['PageID'] = $PageID;
			$ContentLayer[4]['ObjectID'] = 4;
			$ContentLayer[4]['ObjectType'] = 'CONTENT';
			$ContentLayer[4]['ObjectTypeName'] = 'contentdummy';
			$ContentLayer[4]['ContainerObjectID'] = 0;
			$ContentLayer[4]['RevisionID'] = $NewRevisionID;
			$ContentLayer[4]['CurrentVersion'] = 'true';
			$ContentLayer[4]['Authenticate'] = 'false';
			$ContentLayer[4]['StartTag'] = '<div>';
			$ContentLayer[4]['EndTag'] = NULL;
			$ContentLayer[4]['StartTagID'] = 'content-side';
			$ContentLayer[4]['StartTagStyle'] = NULL;
			$ContentLayer[4]['StartTagClass'] = NULL;
			$ContentLayer[4]['Enable/Disable'] = $_POST['EnableDisable'];
			$ContentLayer[4]['Status'] = $_POST['Status'];
			
			$ContentLayer[5]['PageID'] = $PageID;
			$ContentLayer[5]['ObjectID'] = 5;
			$ContentLayer[5]['ObjectType'] = 'XhtmlMenu';
			$ContentLayer[5]['ObjectTypeName'] = 'headerpanel1';
			$ContentLayer[5]['ContainerObjectID'] = 0;
			$ContentLayer[5]['RevisionID'] = $NewRevisionID;
			$ContentLayer[5]['CurrentVersion'] = 'true';
			$ContentLayer[5]['Authenticate'] = 'false';
			$ContentLayer[5]['StartTag'] = NULL;
			$ContentLayer[5]['EndTag'] = NULL;
			$ContentLayer[5]['StartTagID'] = NULL;
			$ContentLayer[5]['StartTagStyle'] = NULL;
			$ContentLayer[5]['StartTagClass'] = NULL;
			$ContentLayer[5]['Enable/Disable'] = $_POST['EnableDisable'];
			$ContentLayer[5]['Status'] = $_POST['Status'];
			
			$ContentLayer[6]['PageID'] = $PageID;
			$ContentLayer[6]['ObjectID'] = 6;
			$ContentLayer[6]['ObjectType'] = 'XhtmlMainMenu';
			$ContentLayer[6]['ObjectTypeName'] = 'mainmenu';
			$ContentLayer[6]['ContainerObjectID'] = 0;
			$ContentLayer[6]['RevisionID'] = $NewRevisionID;
			$ContentLayer[6]['CurrentVersion'] = 'true';
			$ContentLayer[6]['Authenticate'] = 'false';
			$ContentLayer[6]['StartTag'] = NULL;
			$ContentLayer[6]['EndTag'] = NULL;
			$ContentLayer[6]['StartTagID'] = NULL;
			$ContentLayer[6]['StartTagStyle'] = NULL;
			$ContentLayer[6]['StartTagClass'] = NULL;
			$ContentLayer[6]['Enable/Disable'] = $_POST['EnableDisable'];
			$ContentLayer[6]['Status'] = $_POST['Status'];
			
			$ContentLayer[7]['PageID'] = $PageID;
			$ContentLayer[7]['ObjectID'] = 7;
			$ContentLayer[7]['ObjectType'] = 'XhtmlContent';
			$ContentLayer[7]['ObjectTypeName'] = 'content';
			$ContentLayer[7]['ContainerObjectID'] = 0;
			$ContentLayer[7]['RevisionID'] = $NewRevisionID;
			$ContentLayer[7]['CurrentVersion'] = 'true';
			$ContentLayer[7]['Authenticate'] = 'false';
			$ContentLayer[7]['StartTag'] = '<div>';
			$ContentLayer[7]['EndTag'] = '</div>';
			$ContentLayer[7]['StartTagID'] = 'main-content';
			$ContentLayer[7]['StartTagStyle'] = NULL;
			$ContentLayer[7]['StartTagClass'] = NULL;
			$ContentLayer[7]['Enable/Disable'] = $_POST['EnableDisable'];
			$ContentLayer[7]['Status'] = $_POST['Status'];
			
			$ContentLayer[8]['PageID'] = $PageID;
			$ContentLayer[8]['ObjectID'] = 8;
			$ContentLayer[8]['ObjectType'] = 'CONTENT';
			$ContentLayer[8]['ObjectTypeName'] = 'contentdummy';
			$ContentLayer[8]['ContainerObjectID'] = 0;
			$ContentLayer[8]['RevisionID'] = $NewRevisionID;
			$ContentLayer[8]['CurrentVersion'] = 'true';
			$ContentLayer[8]['Authenticate'] = 'false';
			$ContentLayer[8]['StartTag'] = NULL;
			$ContentLayer[8]['EndTag'] = '</div>';
			$ContentLayer[8]['StartTagID'] = NULL;
			$ContentLayer[8]['StartTagStyle'] = NULL;
			$ContentLayer[8]['StartTagClass'] = NULL;
			$ContentLayer[8]['Enable/Disable'] = $_POST['EnableDisable'];
			$ContentLayer[8]['Status'] = $_POST['Status'];
			
			$ContentLayer[9]['PageID'] = $PageID;
			$ContentLayer[9]['ObjectID'] = 9;
			$ContentLayer[9]['ObjectType'] = 'XhtmlContent';
			$ContentLayer[9]['ObjectTypeName'] = 'adpanel1';
			$ContentLayer[9]['ContainerObjectID'] = 0;
			$ContentLayer[9]['RevisionID'] = $NewRevisionID;
			$ContentLayer[9]['CurrentVersion'] = 'true';
			$ContentLayer[9]['Authenticate'] = 'false';
			$ContentLayer[9]['StartTag'] = NULL;
			$ContentLayer[9]['EndTag'] = NULL;
			$ContentLayer[9]['StartTagID'] = NULL;
			$ContentLayer[9]['StartTagStyle'] = NULL;
			$ContentLayer[9]['StartTagClass'] = NULL;
			$ContentLayer[9]['Enable/Disable'] = $_POST['EnableDisable'];
			$ContentLayer[9]['Status'] = $_POST['Status'];
			
			$ContentLayer[10]['PageID'] = $PageID;
			$ContentLayer[10]['ObjectID'] = 10;
			$ContentLayer[10]['ObjectType'] = 'FOOTER';
			$ContentLayer[10]['ObjectTypeName'] = 'footer';
			$ContentLayer[10]['ContainerObjectID'] = 0;
			$ContentLayer[10]['RevisionID'] = $NewRevisionID;
			$ContentLayer[10]['CurrentVersion'] = 'true';
			$ContentLayer[10]['Authenticate'] = 'false';
			$ContentLayer[10]['StartTag'] = NULL;
			$ContentLayer[10]['EndTag'] = NULL;
			$ContentLayer[10]['StartTagID'] = NULL;
			$ContentLayer[10]['StartTagStyle'] = NULL;
			$ContentLayer[10]['StartTagClass'] = NULL;
			$ContentLayer[10]['Enable/Disable'] = $_POST['EnableDisable'];
			$ContentLayer[10]['Status'] = $_POST['Status'];
			
			$ContentLayer[11]['PageID'] = $PageID;
			$ContentLayer[11]['ObjectID'] = 11;
			$ContentLayer[11]['ObjectType'] = 'CONTENT';
			$ContentLayer[11]['ObjectTypeName'] = 'contentdummy';
			$ContentLayer[11]['ContainerObjectID'] = 0;
			$ContentLayer[11]['RevisionID'] = $NewRevisionID;
			$ContentLayer[11]['CurrentVersion'] = 'true';
			$ContentLayer[11]['Authenticate'] = 'false';
			$ContentLayer[11]['StartTag'] = NULL;
			$ContentLayer[11]['EndTag'] = '</div>';
			$ContentLayer[11]['StartTagID'] = NULL;
			$ContentLayer[11]['StartTagStyle'] = NULL;
			$ContentLayer[11]['StartTagClass'] = NULL;
			$ContentLayer[11]['Enable/Disable'] = $_POST['EnableDisable'];
			$ContentLayer[11]['Status'] = $_POST['Status'];
			
			$ContentLayer[12]['PageID'] = $PageID;
			$ContentLayer[12]['ObjectID'] = 12;
			$ContentLayer[12]['ObjectType'] = 'CONTENT';
			$ContentLayer[12]['ObjectTypeName'] = 'contentdummy';
			$ContentLayer[12]['ContainerObjectID'] = 0;
			$ContentLayer[12]['RevisionID'] = $NewRevisionID;
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
			//$Sitemap['PageID'] = $PageID;
			//$Sitemap['Loc'] = $Location;
			$Sitemap['Lastmod'] = $Date;
			$Sitemap['ChangeFreq'] = $_POST['Frequency'];
			$Sitemap['Priority'] = $_POST['Priority'];
			//$Sitemap['Enable/Disable'] = $_POST['EnableDisable'];
			//$Sitemap['Status'] = $_POST['Status'];
			
			$ContentPrintPreview = array();
			//$ContentPrintPreview['PageID'] = $PageID;
			$ContentPrintPreview['PrintPageID1'] = $PageID;
			//$ContentPrintPreview['PrintPageID2'] = NULL;
			//$ContentPrintPreview['PrintPageID3'] = NULL;
			//$ContentPrintPreview['PrintPageID4'] = NULL;
			//$ContentPrintPreview['PrintPageID5'] = NULL;
			//$ContentPrintPreview['PrintPageID6'] = NULL;
			//$ContentPrintPreview['PrintPageID7'] = NULL;
			//$ContentPrintPreview['PrintPageID8'] = NULL;
			//$ContentPrintPreview['PrintPageID9'] = NULL;
			//$ContentPrintPreview['PrintPageID10'] = NULL;
			//$ContentPrintPreview['PrintPageID11'] = NULL;
			//$ContentPrintPreview['PrintPageID12'] = NULL;
			//$ContentPrintPreview['PrintPageID13'] = NULL;
			//$ContentPrintPreview['PrintPageID14'] = NULL;
			//$ContentPrintPreview['PrintPageID15'] = NULL;
			//$ContentPrintPreview['PrintPageID16'] = NULL;
			//$ContentPrintPreview['PrintPageID17'] = NULL;
			//$ContentPrintPreview['PrintPageID18'] = NULL;
			//$ContentPrintPreview['PrintPageID19'] = NULL;
			//$ContentPrintPreview['PrintPageID20'] = NULL;
			//$ContentPrintPreview['Enable/Disable'] = $_POST['EnableDisable'];
			//$ContentPrintPreview['Status'] = $_POST['Status'];
			
			$FormOptionID = $Options['XhtmlNewsStories']['news']['UpdateNewsPageSelect']['SettingAttribute'];
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
			$FormOptionID = $Options['XhtmlNewsStories']['news']['DeleteNewsPage']['SettingAttribute'];
			$Tier6Databases->ModulePass('XhtmlForm', 'form', 'updateFormOption', array('PageID' => array('PageID' => $FormOptionID, 'ObjectID' => $FormOptionObjectID), 'Content' => $FormOption));
			$FormOptionID = $Options['XhtmlNewsStories']['news']['EnableDisableStatusChangeNewsPage']['SettingAttribute'];
			$Tier6Databases->ModulePass('XhtmlForm', 'form', 'updateFormOption', array('PageID' => array('PageID' => $FormOptionID, 'ObjectID' => $FormOptionObjectID), 'Content' => $FormOption));
			
			$FormOptionID = $Options['XhtmlMainMenu']['mainmenu']['MainMenuSelectPage']['SettingAttribute'];
			$Tier6Databases->ModulePass('XhtmlForm', 'form', 'updateFormOption', array('PageID' => array('PageID' => $FormOptionID, 'ObjectID' => $PageID), 'Content' => $FormOption));
			$FormOptionID = $Options['XhtmlMainMenu']['mainmenu']['MainMenuUpdatePage']['SettingAttribute'];
			$Tier6Databases->ModulePass('XhtmlForm', 'form', 'updateFormOption', array('PageID' => array('PageID' => $FormOptionID, 'ObjectID' => $PageID), 'Content' => $FormOption));
			
			$Tier6Databases->ModulePass('XhtmlNewsStories', 'news', 'updateNewsStoryLookup', array('PageID' => array('PageID' => $PageID, 'ObjectID' => 1), 'Content' => $NewsStoryLookup));
			$Tier6Databases->ModulePass('XhtmlMenu', 'headerpanel1', 'updateMenu', array('PageID' => array('PageID' => $PageID, 'ObjectID' => 2), 'Content' => $HeaderPanel1));
			$Tier6Databases->ModulePass('XhtmlContent', 'content', 'updateContentPrintPreview', array('PageID' => array('PageID' => $PageID), 'Content' => $ContentPrintPreview));
			$Tier6Databases->ModulePass('XmlSitemap', 'sitemap', 'updateSitemapItem', array('PageID' => array('PageID' => $PageID), 'Content' => $Sitemap));
			
			$Tier6Databases->ModulePass('XhtmlHeader', 'header', 'updateHeader', array('PageID' => $PageID));
			$Tier6Databases->ModulePass('XhtmlHeader', 'header', 'createHeader', $Header);
			
			$Tier6Databases->ModulePass('XhtmlContent', 'content', 'updateContent', array('PageID' => $PageID));
			$Tier6Databases->updateContentVersion(array('PageID' => $PageID), 'ContentLayerVersion');
			$Tier6Databases->updateContent(array('PageID' => $PageID), 'ContentLayer');
			
			$Tier6Databases->ModulePass('XhtmlContent', 'content', 'createContent', $Content);
			$Tier6Databases->createContentVersion($ContentLayerVersion, 'ContentLayerVersion');
			$Tier6Databases->createContent($ContentLayer, 'ContentLayer');
			
			$Tier6Databases->SessionDestroy($sessionname);
			$sessionname = $Tier6Databases->SessionStart('UpdatedNewsPage');
			
			$Page = '../index.php?PageID=';
			$Page .= $PageID;
		
			$_SESSION['POST']['Error']['Link'] = '<a href=\'';
			$_SESSION['POST']['Error']['Link'] .= $Page;
			$_SESSION['POST']['Error']['Link'] .= '\'>Updated News Page</a>';
			
			$CreatedUpdateNewsPage = $Options['XhtmlNewsStories']['news']['CreatedUpdateNewsPage']['SettingAttribute'];
			header("Location: $CreatedUpdateNewsPage&SessionID=$sessionname");
		}
		
	} else {
		$Tier6Databases->SessionDestroy($sessionname);
		$Options = $Tier6Databases->getLayerModuleSetting();
		$UpdateNewsPageSelect = $Options['XhtmlNewsStories']['news']['UpdateNewsPageSelect']['SettingAttribute'];
		header("Location: index.php?PageID=$UpdateNewsPageSelect");
	}
	
?>