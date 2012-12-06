<?php
	$HOME = $_SERVER['SUBDOMAIN_DOCUMENT_ROOT'];
	$ADMINHOME = $HOME . '/Administrators/';
	$GLOBALS['HOME'] = $HOME;
	$GLOBALS['ADMINHOME'] = $ADMINHOME;
	
	require_once ("$ADMINHOME/Configuration/includes.php");
	
	$sessionname = NULL;
	$sessionname = $_COOKIE['SessionID'];
	session_name($sessionname);
	session_start();
	
	$PageID = $_SESSION['POST']['FilteredInput']['PageID'];
	$RevisionID = $_SESSION['POST']['FilteredInput']['RevisionID'];
	$CreationDateTime = $_SESSION['POST']['FilteredInput']['CreationDateTime'];
	$Owner = $_SESSION['POST']['FilteredInput']['Owner'];
	$UserAccessGroup = $_SESSION['POST']['FilteredInput']['UserAccessGroup'];
	
	$Options = $Tier6Databases->getLayerModuleSetting();
	$NewRevisionID = $RevisionID + 1;
	
	$_POST['PageID'] = $PageID;
	$_POST['RevisionID'] = $RevisionID;
	$_POST['CreationDateTime'] = $CreationDateTime;
	$_POST['Owner'] = $Owner;
	$_POST['UserAccessGroup'] = $UserAccessGroup;
	
	if (!is_null($PageID) && !is_null($RevisionID) && !is_null($CreationDateTime) && !is_null($Owner) && !is_null($UserAccessGroup)) {
		$PageName = '../../index.php?PageID=';
		$PageName .= $_POST['UpdateNewsStory'];
		$hold = $Tier6Databases->FormSubmitValidate('UpdateNewsStory', $PageName);
		
		if ($hold) {
			
			$DateTime = date('Y-m-d H:i:s');
			$FeedDateTime = date('D, d m Y H:i:s T');
			$EmbeddedLink = $Tier6Databases->ModulePass('XmlFeed', 'feed', 'getTag', array('Tag' => 'a', 'Content' => $hold['FilteredInput']['Content']));
			$EmbeddedLink = $EmbeddedLink[0][0];
			$StrippedHeading = $Tier6Databases->ModulePass('XmlFeed', 'feed', 'getStripTagsContent', array('Content' => $hold['FilteredInput']['Heading']));
			$StrippedHeading = $StrippedHeading['Content'];
			$StrippedContent = $Tier6Databases->ModulePass('XmlFeed', 'feed', 'getStripTagsContent', array('Content' => $hold['FilteredInput']['Content']));
			$StrippedContent = $StrippedContent['Content'];
			
			//$LastNewsFeedItem = $Tier6Databases->ModulePass('XmlFeed', 'feed', 'getLastStoryFeedItem', array());
			
			if ($_POST['MenuName'] == 'Null' | $_POST['MenuName'] == 'NULL') {
				$_POST['MenuName'] = NULL;
				$hold['FilteredInput']['MenuName'] = NULL;
			}
			
			if ($_POST['ImageSrc'] == 'Null' | $_POST['ImageSrc'] == 'NULL') {
				$_POST['ImageSrc'] = NULL;
				$hold['FilteredInput']['ImageSrc'] = NULL;
				$_POST['ImageAlt'] = NULL;
				$hold['FilteredInput']['ImageAlt'] = NULL;
			}
			
			$NewsStory = array();
			
			$NewsStory[0]['PageID'] = $PageID;
			$NewsStory[0]['ObjectID'] = 1;
			$NewsStory[0]['ContainerObjectType'] = 'XhtmlNewsStories';
			$NewsStory[0]['ContainerObjectName'] = 'news';
			$NewsStory[0]['ContainerObjectID'] = 2;
			$NewsStory[0]['ContainerObjectPrintPreview'] = 'true';
			$NewsStory[0]['RevisionID'] = $NewRevisionID;
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
			$NewsStory[0]['ContentPTagID'] = NULL;
			$NewsStory[0]['ContentPTagStyle'] = NULL;
			$NewsStory[0]['ContentPTagClass'] = NULL;
			$NewsStory[0]['Enable/Disable'] = $_POST['EnableDisable'];
			$NewsStory[0]['Status'] = $_POST['Status'];
			
			if ($hold['FilteredInput']['ImageSrc'] != NULL) {
				$NewsStory[1]['PageID'] = $PageID;
				$NewsStory[1]['ObjectID'] = 2;
				$NewsStory[1]['ContainerObjectType'] = 'XhtmlPicture';
				$NewsStory[1]['ContainerObjectName'] = 'newspicture';
				$NewsStory[1]['ContainerObjectID'] = 1;
				$NewsStory[1]['ContainerObjectPrintPreview'] = 'true';
				$NewsStory[1]['RevisionID'] = $NewRevisionID;
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
				$NewsStory[1]['ContentPTagID'] = NULL;
				$NewsStory[1]['ContentPTagStyle'] = NULL;
				$NewsStory[1]['ContentPTagClass'] = NULL;
				$NewsStory[1]['Enable/Disable'] = $_POST['EnableDisable'];
				$NewsStory[1]['Status'] = $_POST['Status'];
				
				$NewsStory[2]['PageID'] = $PageID;
				$NewsStory[2]['ObjectID'] = 3;
				$NewsStory[2]['ContainerObjectType'] = 'XhtmlNewsStories';
				$NewsStory[2]['ContainerObjectName'] = 'news';
				$NewsStory[2]['ContainerObjectID'] = 4;
				$NewsStory[2]['ContainerObjectPrintPreview'] = 'true';
				$NewsStory[2]['RevisionID'] = $NewRevisionID;
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
				$NewsStory[2]['ContentPTagID'] = NULL;
				$NewsStory[2]['ContentPTagStyle'] = NULL;
				$NewsStory[2]['ContentPTagClass'] = 'BodyText';
				$NewsStory[2]['Enable/Disable'] = $_POST['EnableDisable'];
				$NewsStory[2]['Status'] = $_POST['Status'];
			} else {
				$NewsStory[1]['PageID'] = $PageID;
				$NewsStory[1]['ObjectID'] = 2;
				$NewsStory[1]['ContainerObjectType'] = 'XhtmlNewsStories';
				$NewsStory[1]['ContainerObjectName'] = 'news';
				$NewsStory[1]['ContainerObjectID'] = 3;
				$NewsStory[1]['ContainerObjectPrintPreview'] = 'true';
				$NewsStory[1]['RevisionID'] = $NewRevisionID;
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
				$NewsStory[1]['Content'] = $hold['FilteredInput']['Content'];
				$NewsStory[1]['ContentStartTag'] = '<p>';
				$NewsStory[1]['ContentEndTag'] = '</p>';
				$NewsStory[1]['ContentStartTagID'] = NULL;
				$NewsStory[1]['ContentStartTagStyle'] = NULL;
				$NewsStory[1]['ContentStartTagClass'] = 'BodyText';
				$NewsStory[1]['ContentPTagID'] = NULL;
				$NewsStory[1]['ContentPTagStyle'] = NULL;
				$NewsStory[1]['ContentPTagClass'] = 'BodyText';
				$NewsStory[1]['Enable/Disable'] = $_POST['EnableDisable'];
				$NewsStory[1]['Status'] = $_POST['Status'];
			}
			//$NewsStory = array_reverse($NewsStory);
			
			$NewsDate = array();
			$NewsDate['PageID'] = $PageID;
			$NewsDate['ObjectID'] = 1;
			$NewsDate['RevisionID'] = $NewRevisionID;
			$NewsDate['CurrentVersion'] = 'true';
			$NewsDate['NewsStoryDay'] = $_POST['NewsDay'];
			$NewsDate['NewsStoryMonth'] = $_POST['NewsMonth'];
			$NewsDate['NewsStoryYear'] = $_POST['NewsYear'];
			$NewsDate['Enable/Disable'] = $_POST['EnableDisable'];
			$NewsDate['Status'] = $_POST['Status'];
			
			if ($hold['FilteredInput']['ImageSrc'] != NULL) { 
				$NewsImage = array();
				$NewsImage['PageID'] = $PageID;
				$NewsImage['ObjectID'] = 1;
				$NewsImage['RevisionID'] = $NewRevisionID;
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
			}
			$NewsVersion['PageID'] = $PageID;
			$NewsVersion['RevisionID'] = $NewRevisionID;
			$NewsVersion['CurrentVersion'] = 'true';
			$NewsVersion['XMLItem'] = $LastNewsFeedItem;
			$NewsVersion['StoryMenuName'] = $hold['FilteredInput']['MenuName'];
			$NewsVersion['StoryMenuTitle'] = $hold['FilteredInput']['MenuTitle'];
			$NewsVersion['UserAccessGroup'] = $UserAccessGroup;
			$NewsVersion['Owner'] = $Owner;
			$NewsVersion['Creator'] = $_COOKIE['UserName'];
			$NewsVersion['LastChangeUser'] = $_COOKIE['UserName'];
			$NewsVersion['CreationDateTime'] = $CreationDateTime;
			$NewsVersion['LastChangeDateTime'] = $DateTime;
			$NewsVersion['PublishDate'] = NULL;
			$NewsVersion['UnpublishDate'] = NULL;
			
			$NewsFeed = array();
			$NewsFeed['XMLItem'] = $PageID;
			$NewsFeed['FeedItemTitle'] = $StrippedHeading;
			//$NewsFeed['FeedItemLink'] = $GLOBALS['sitelink'];
			$NewsFeed['FeedItemDescription'] = $StrippedContent;
			$NewsFeed['FeedItemAuthor'] = $GLOBALS['author'];
			$NewsFeed['FeedItemCategory'] = htmlspecialchars_decode($hold['FilteredInput']['Category'], ENT_QUOTES);
			//$NewsFeed['FeedItemComments'] = NULL;
			//$NewsFeed['FeedItemEnclosure'] = 'false';
			//$NewsFeed['FeedItemEnclosureLength'] = NULL;
			//$NewsFeed['FeedItemEnclosureType'] = NULL;
			//$NewsFeed['FeedItemEnclosureUrl'] = NULL;
			$NewsFeed['FeedItemGuid'] = $EmbeddedLink;
			$NewsFeed['FeedItemPubDate'] = $FeedDateTime;
			//$NewsFeed['FeedItemSource'] = NULL;
			//$NewsFeed['Enable/Disable'] = $_POST['EnableDisable'];
			//$NewsFeed['Status'] = $_POST['Status'];
			
			$FormOptionID = $Options['XhtmlNewsStories']['news']['NewsArticleUpdateSelectPage']['SettingAttribute'];
			
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
			//$FormOption['PageID'] = $NewsArticleUpdateSelectPage;
			//$FormOption['ObjectID'] = $NewPageID;
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
			
			$Tier6Databases->ModulePass('XhtmlForm', 'form', 'updateFormOption', array('PageID' => array('PageID' => $FormOptionID, 'ObjectID' => $PageID), 'Content' => $FormOption));
			$FormOptionID = $Options['XhtmlNewsStories']['news']['NewsArticleDeleteSelectPage']['SettingAttribute'];
			$Tier6Databases->ModulePass('XhtmlForm', 'form', 'updateFormOption', array('PageID' => array('PageID' => $FormOptionID, 'ObjectID' => $PageID), 'Content' => $FormOption));
			$FormOptionID = $Options['XhtmlNewsStories']['news']['NewsArticleEnableDisableSelectPage']['SettingAttribute'];
			$Tier6Databases->ModulePass('XhtmlForm', 'form', 'updateFormOption', array('PageID' => array('PageID' => $FormOptionID, 'ObjectID' => $PageID), 'Content' => $FormOption));
			
			$Tier6Databases->ModulePass('XhtmlNewsStories', 'news', 'updateNewsStory', array('PageID' => $PageID));
			$Tier6Databases->ModulePass('XhtmlNewsStories', 'news', 'updateNewsStoryVersion', array('PageID' => $PageID));
			$Tier6Databases->ModulePass('XhtmlNewsStories', 'news', 'updateNewsStoryDate', array('PageID' => $PageID));
			$Tier6Databases->ModulePass('XhtmlPicture', 'newspicture', 'updatePicture', array('PageID' => $PageID));
			
			$Tier6Databases->ModulePass('XhtmlNewsStories', 'news', 'createNewsStory', $NewsStory);
			$Tier6Databases->ModulePass('XhtmlNewsStories', 'news', 'createNewsStoryDate', $NewsDate);
			$Tier6Databases->ModulePass('XhtmlNewsStories', 'news', 'createNewsStoryVersion', $NewsVersion);
			
			if ($hold['FilteredInput']['ImageSrc'] != NULL) { 
				$Tier6Databases->ModulePass('XhtmlPicture', 'newspicture', 'createPicture', $NewsImage);
			}
			
			$Tier6Databases->ModulePass('XmlFeed', 'feed', 'updateStoryFeed', $NewsFeed);

			$Tier6Databases->SessionDestroy($sessionname);
			$Options = $Tier6Databases->getLayerModuleSetting();
			$NewsArticleCreatedUpdatePage = $Options['XhtmlNewsStories']['news']['NewsArticleCreatedUpdatePage']['SettingAttribute'];
			header("Location: $NewsArticleCreatedUpdatePage&NewsPageID=$PageID");

		}
		
	} else {
		$Tier6Databases->SessionDestroy($sessionname);
		$Options = $Tier6Databases->getLayerModuleSetting();
		$NewsArticleUpdateSelectPage = $Options['XhtmlNewsStories']['news']['NewsArticleUpdateSelectPage']['SettingAttribute'];
		header("Location: ../../index.php?PageID=$NewsArticleUpdateSelectPage");
	}
	
?>