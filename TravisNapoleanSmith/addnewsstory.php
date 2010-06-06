<?php
	require_once ('Configuration/includes.php');
	$PageName = 'index.php?PageID=';
	$PageName .= $_POST['AddNewsStory'];
	$hold = $Tier6Databases->FormSubmitValidate('AddNewsStory', $PageName);
	
	if ($hold) {
		$LastPageID = $Tier6Databases->ModulePass('XhtmlNewsStories', 'news', 'getLastNewsPageID', array());
		$NewPageID = ++$LastPageID;
		$NewsStory = array();
		
		$PageID = array();
		$PageID['PageID'] = $NewPageID;
		
		$NewsStory[0]['PageID'] = $NewPageID;
		$NewsStory[0]['ObjectID'] = 1;
		$NewsStory[0]['ContainerObjectType'] = 'XhtmlNewsStories';
		$NewsStory[0]['ContainerObjectName'] = 'news';
		$NewsStory[0]['ContainerObjectID'] = 2;
		$NewsStory[0]['ContainerObjectPrintPreview'] = 'true';
		$NewsStory[0]['RevisionID'] = 0;
		$NewsStory[0]['CurrentVersion'] = 'true';
		$NewsStory[0]['Empty'] = 'false';
		$NewsStory[0]['StartTag'] = NULL;
		$NewsStory[0]['EndTag'] = NULL;
		$NewsStory[0]['StartTagID'] = NULL;
		$NewsStory[0]['StartTagStyle'] = NULL;
		$NewsStory[0]['StartTagClass'] = NULL;
		$NewsStory[0]['Heading'] = $hold['FilteredInput']['Heading'];
		$NewsStory[0]['HeadingStartTag'] = '<h2>';
		$NewsStory[0]['HeadingEndTag'] = '</h2>';
		$NewsStory[0]['HeadingStartTagID'] = NULL;
		$NewsStory[0]['HeadingStartTagStyle'] = NULL;
		$NewsStory[0]['HeadingStartTagClass'] = 'BodyHeading';
		$NewsStory[0]['Content'] = NULL;
		$NewsStory[0]['ContentStartTag'] = NULL;
		$NewsStory[0]['ContentEndTag'] = NULL;
		$NewsStory[0]['ContentStartTagID'] = NULL;
		$NewsStory[0]['ContentStartTagStyle'] = NULL;
		$NewsStory[0]['ContentStartTagClass'] = NULL;
		$NewsStory[0]['Enable/Disable'] = $_POST['EnableDisable'];
		$NewsStory[0]['Status'] = $_POST['Status'];
		
		$NewsStory[1]['PageID'] = $NewPageID;
		$NewsStory[1]['ObjectID'] = 2;
		$NewsStory[1]['ContainerObjectType'] = 'XhtmlPicture';
		$NewsStory[1]['ContainerObjectName'] = 'newspicture';
		$NewsStory[1]['ContainerObjectID'] = 1;
		$NewsStory[1]['ContainerObjectPrintPreview'] = 'true';
		$NewsStory[1]['RevisionID'] = 0;
		$NewsStory[1]['CurrentVersion'] = 'true';
		$NewsStory[1]['Empty'] = 'false';
		$NewsStory[1]['StartTag'] = NULL;
		$NewsStory[1]['EndTag'] = NULL;
		$NewsStory[1]['StartTagID'] = NULL;
		$NewsStory[1]['StartTagStyle'] = NULL;
		$NewsStory[1]['StartTagClass'] = NULL;
		$NewsStory[1]['Heading'] = NULL;
		$NewsStory[1]['HeadingStartTag'] = NULL;
		$NewsStory[1]['HeadingEndTag'] = NULL;
		$NewsStory[1]['HeadingStartTagID'] = NULL;
		$NewsStory[1]['HeadingStartTagStyle'] = NULL;
		$NewsStory[1]['HeadingStartTagClass'] = NULL;
		$NewsStory[1]['Content'] = NULL;
		$NewsStory[1]['ContentStartTag'] = NULL;
		$NewsStory[1]['ContentEndTag'] = NULL;
		$NewsStory[1]['ContentStartTagID'] = NULL;
		$NewsStory[1]['ContentStartTagStyle'] = NULL;
		$NewsStory[1]['ContentStartTagClass'] = NULL;
		$NewsStory[1]['Enable/Disable'] = $_POST['EnableDisable'];
		$NewsStory[1]['Status'] = $_POST['Status'];
		
		$NewsStory[2]['PageID'] = $NewPageID;
		$NewsStory[2]['ObjectID'] = 3;
		$NewsStory[2]['ContainerObjectType'] = 'XhtmlNewsStories';
		$NewsStory[2]['ContainerObjectName'] = 'news';
		$NewsStory[2]['ContainerObjectID'] = 4;
		$NewsStory[2]['ContainerObjectPrintPreview'] = 'true';
		$NewsStory[2]['RevisionID'] = 0;
		$NewsStory[2]['CurrentVersion'] = 'true';
		$NewsStory[2]['Empty'] = 'false';
		$NewsStory[2]['StartTag'] = NULL;
		$NewsStory[2]['EndTag'] = NULL;
		$NewsStory[2]['StartTagID'] = NULL;
		$NewsStory[2]['StartTagStyle'] = NULL;
		$NewsStory[2]['StartTagClass'] = NULL;
		$NewsStory[2]['Heading'] = NULL;
		$NewsStory[2]['HeadingStartTag'] = NULL;
		$NewsStory[2]['HeadingEndTag'] = NULL;
		$NewsStory[2]['HeadingStartTagID'] = NULL;
		$NewsStory[2]['HeadingStartTagStyle'] = NULL;
		$NewsStory[2]['HeadingStartTagClass'] = NULL;
		$NewsStory[2]['Content'] = $hold['FilteredInput']['Content'];
		$NewsStory[2]['ContentStartTag'] = '<p>';
		$NewsStory[2]['ContentEndTag'] = '</p>';
		$NewsStory[2]['ContentStartTagID'] = NULL;
		$NewsStory[2]['ContentStartTagStyle'] = NULL;
		$NewsStory[2]['ContentStartTagClass'] = 'BodyText';
		$NewsStory[2]['Enable/Disable'] = $_POST['EnableDisable'];
		$NewsStory[2]['Status'] = $_POST['Status'];
		
		//$NewsStory = array_reverse($NewsStory);
		
		$NewsDate = array();
		$NewsDate['PageID'] = $NewPageID;
		$NewsDate['ObjectID'] = 1;
		$NewsDate['NewsStoryDay'] = $_POST['NewsDay'];
		$NewsDate['NewsStoryMonth'] = $_POST['NewsMonth'];
		$NewsDate['NewsStoryYear'] = $_POST['NewsYear'];
		$NewsDate['Enable/Disable'] = $_POST['EnableDisable'];
		$NewsDate['Status'] = $_POST['Status'];
		
		$NewsImage = array();
		$NewsImage['PageID'] = $NewPageID;
		$NewsImage['ObjectID'] = 1;
		$NewsImage['StartTag'] = NULL;
		$NewsImage['EndTag'] = NULL;
		$NewsImage['StartTagID'] = NULL;
		$NewsImage['StartTagStyle'] = NULL;
		$NewsImage['StartTagClass'] = NULL;
		$NewsImage['PictureID'] = NULL;
		$NewsImage['PictureClass'] = 'image';
		$NewsImage['PictureStyle'] = NULL;
		$NewsImage['PictureLink'] = $hold['FilteredInput']['ImageSrc'];
		$NewsImage['PictureAltText'] = $hold['FilteredInput']['ImageAlt'];
		$NewsImage['Width'] = NULL;
		$NewsImage['Height'] = NULL;
		$NewsImage['Enable/Disable'] = $_POST['EnableDisable'];
		$NewsImage['Status'] = $_POST['Status'];
		
		$Tier6Databases->ModulePass('XhtmlNewsStories', 'news', 'createNewsStory', $NewsStory);
		$Tier6Databases->ModulePass('XhtmlNewsStories', 'news', 'createNewsStoryDate', $NewsDate);
		$Tier6Databases->ModulePass('XhtmlPicture', 'newspicture', 'createPicture', $NewsImage);

		$Options = $Tier6Databases->getLayerModuleSetting();
		$NewsArticleCreatedPage = $Options['XhtmlNewsStories']['news']['NewsArticleCreatedPage']['SettingAttribute'];
		header("Location: $NewsArticleCreatedPage&NewNewsPageID=$NewPageID");
	}
	
?>