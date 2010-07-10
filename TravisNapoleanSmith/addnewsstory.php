<?php
	require_once ('Configuration/includes.php');
	$PageName = 'index.php?PageID=';
	$PageName .= $_POST['AddNewsStory'];
	$hold = $Tier6Databases->FormSubmitValidate('AddNewsStory', $PageName);
	
	if ($hold) {
		$Options = $Tier6Databases->getLayerModuleSetting();
		
		$DateTime = date('Y-m-d H:i:s');
		$FeedDateTime = date('D, d M Y H:i:s T');
		$EmbeddedLink = $Tier6Databases->ModulePass('XmlFeed', 'feed', 'getTag', array('Tag' => 'a', 'Content' => $hold['FilteredInput']['Content']));
		$EmbeddedLink = $EmbeddedLink[0][0];
		$StrippedHeading = $Tier6Databases->ModulePass('XmlFeed', 'feed', 'getStripTagsContent', array('Content' => $hold['FilteredInput']['Heading']));
		$StrippedHeading = $StrippedHeading['Content'];
		$StrippedContent = $Tier6Databases->ModulePass('XmlFeed', 'feed', 'getStripTagsContent', array('Content' => $hold['FilteredInput']['Content']));
		$StrippedContent = $StrippedContent['Content'];
		
		$LastNewsFeedItem = $Tier6Databases->ModulePass('XmlFeed', 'feed', 'getLastStoryFeedItem', array());
		$NewNewsFeedItem = ++$LastNewsFeedItem;
		
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
		$NewsDate['RevisionID'] = 0;
		$NewsDate['CurrentVersion'] = 'true';
		$NewsDate['NewsStoryDay'] = $_POST['NewsDay'];
		$NewsDate['NewsStoryMonth'] = $_POST['NewsMonth'];
		$NewsDate['NewsStoryYear'] = $_POST['NewsYear'];
		$NewsDate['Enable/Disable'] = $_POST['EnableDisable'];
		$NewsDate['Status'] = $_POST['Status'];
		
		$NewsImage = array();
		$NewsImage['PageID'] = $NewPageID;
		$NewsImage['ObjectID'] = 1;
		$NewsImage['RevisionID'] = 0;
		$NewsImage['CurrentVersion'] = 'true';
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
		
		$NewsVersion = array();
		$NewsVersion['PageID'] = $NewPageID;
		$NewsVersion['RevisionID'] = 0;
		$NewsVersion['CurrentVersion'] = 'true';
		$NewsVersion['XMLItem'] = $NewNewsFeedItem;
		$NewsVersion['UserAccessGroup'] = 'Guest';
		$NewsVersion['Owner'] = $_COOKIE['UserName'];
		$NewsVersion['LastChangeUser'] = $_COOKIE['UserName'];
		$NewsVersion['CreationDateTime'] = $DateTime;
		$NewsVersion['LastChangeDateTime'] = $DateTime;
		
		$NewsFeed = array();
		$NewsFeed['XMLItem'] = $NewNewsFeedItem;
		$NewsFeed['FeedItemTitle'] = htmlspecialchars_decode($StrippedHeading, ENT_QUOTES);
		$NewsFeed['FeedItemLink'] = $GLOBALS['sitelink'];
		$NewsFeed['FeedItemDescription'] = htmlspecialchars_decode($StrippedContent, ENT_QUOTES);
		$NewsFeed['FeedItemAuthor'] = $GLOBALS['author'];
		$NewsFeed['FeedItemCategory'] = htmlspecialchars_decode($hold['FilteredInput']['Category'], ENT_QUOTES);
		$NewsFeed['FeedItemComments'] = NULL;
		$NewsFeed['FeedItemEnclosure'] = 'false';
		$NewsFeed['FeedItemEnclosureLength'] = NULL;
		$NewsFeed['FeedItemEnclosureType'] = NULL;
		$NewsFeed['FeedItemEnclosureUrl'] = NULL;
		$NewsFeed['FeedItemGuid'] = $EmbeddedLink;
		$NewsFeed['FeedItemPubDate'] = $FeedDateTime;
		$NewsFeed['FeedItemSource'] = NULL;
		$NewsFeed['Enable/Disable'] = $_POST['EnableDisable'];
		$NewsFeed['Status'] = $_POST['Status'];
		
		$NewsArticleUpdateSelectPage = $Options['XhtmlNewsStories']['news']['NewsArticleUpdateSelectPage']['SettingAttribute'];
		$FormSelect = array();
		$FormSelect['PageID'] = $NewsArticleUpdateSelectPage;
		$FormSelect['ObjectID'] = $NewPageID;
		$FormSelect['StopObjectID'] = NULL;
		$FormSelect['ContainerObjectType'] = 'Option';
		$FormSelect['ContainerObjectTypeName'] = 'FormOption';
		$FormSelect['ContainerObjectID'] = $NewPageID;
		$FormSelect['FormSelectDisabled'] = NULL;
		$FormSelect['FormSelectMultiple'] = NULL;
		$FormSelect['FormSelectName'] = 'NewsStory';
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
		
		$FormOptionValue = $NewPageID;
		$FormOptionText = $_POST['NewsMonth'];
		$FormOptionText .= ' ';
		$FormOptionText .= $_POST['NewsDay'];
		$FormOptionText .= ', ';
		$FormOptionText .= $_POST['NewsYear'];
		$FormOptionText .= ' - ';
		
		$temp = $hold['FilteredInput']['Heading'];
		$temp = explode(' ', $temp);
		if ($temp[0] == 'Men\'s' | $temp[0] == 'Women\'s') {
			$FormOptionText .= addslashes($temp[0]);
			$FormOptionText .= ' ';
			$FormOptionText .= $temp[1];
		} else {
			$FormOptionText .= $temp[0];
			if ($temp[1]) {
				$FormOptionText .= ' ';
				$FormOptionText .= $temp[1];
			}
		}
		unset($temp);
		
		$FormOption = array();
		$FormOption['PageID'] = $NewsArticleUpdateSelectPage;
		$FormOption['ObjectID'] = $NewPageID;
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
		$FormOption['FormOptionValue'] = $FormOptionValue;
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
		
		$Tier6Databases->ModulePass('XhtmlNewsStories', 'news', 'createNewsStory', $NewsStory);
		$Tier6Databases->ModulePass('XhtmlNewsStories', 'news', 'createNewsStoryDate', $NewsDate);
		$Tier6Databases->ModulePass('XhtmlNewsStories', 'news', 'createNewsStoryVersion', $NewsVersion);
		$Tier6Databases->ModulePass('XhtmlPicture', 'newspicture', 'createPicture', $NewsImage);
		$Tier6Databases->ModulePass('XhtmlForm', 'form', 'createFormOption', $FormOption);
		$Tier6Databases->ModulePass('XhtmlForm', 'form', 'createFormSelect', $FormSelect);
		
		$NewsArticleDeleteSelectPage = $Options['XhtmlNewsStories']['news']['NewsArticleDeleteSelectPage']['SettingAttribute'];
		$FormSelect['PageID'] = $NewsArticleDeleteSelectPage;
		$FormOption['PageID'] = $NewsArticleDeleteSelectPage;
		
		$Tier6Databases->ModulePass('XhtmlForm', 'form', 'createFormOption', $FormOption);
		$Tier6Databases->ModulePass('XhtmlForm', 'form', 'createFormSelect', $FormSelect);
		
		$NewsArticleEnableDisableSelectPage = $Options['XhtmlNewsStories']['news']['NewsArticleEnableDisableSelectPage']['SettingAttribute'];
		$FormSelect['PageID'] = $NewsArticleEnableDisableSelectPage;
		$FormOption['PageID'] = $NewsArticleEnableDisableSelectPage;
		
		$Tier6Databases->ModulePass('XhtmlForm', 'form', 'createFormOption', $FormOption);
		$Tier6Databases->ModulePass('XhtmlForm', 'form', 'createFormSelect', $FormSelect);
		
		$Tier6Databases->ModulePass('XmlFeed', 'feed', 'createStoryFeed', $NewsFeed);
		
		$NewsArticleCreatedPage = $Options['XhtmlNewsStories']['news']['NewsArticleCreatedPage']['SettingAttribute'];
		
		header("Location: $NewsArticleCreatedPage&NewNewsPageID=$NewPageID");
		
	}
	
?>