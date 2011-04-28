<?php
	require_once ('Configuration/includes.php');
	
	$sessionname = NULL;
	$sessionname = $_COOKIE['SessionID'];
	session_name($sessionname);
	session_start();
	
	$Options = $Tier6Databases->getLayerModuleSetting();
	$UpdatePhotosPage = $Options['XhtmlPicture']['picture']['UpdatePhotosPage']['SettingAttribute'];
	$NewUpdatePhotosPage = explode('=', $UpdatePhotosPage);
	$NewUpdatePhotosPage = $NewUpdatePhotosPage[1];
	
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
	$_POST['UpdatePhotosPage'] = $NewUpdatePhotosPage;
		
	if (!is_null($PageID) && !is_null($RevisionID) && !is_null($CreationDateTime) && !is_null($Owner) && !is_null($UserAccessGroup)) {
		$PageName = $UpdatePhotosPage;
		
		$hold = $Tier6Databases->FormSubmitValidate('UpdatePhotosPage', $PageName);

		if ($hold) {
			$sessionname = $Tier6Databases->SessionStart('UpdatePhotosPage');
			$_SESSION['POST'] = $_POST;
			$DateTime = date('Y-m-d H:i:s');
			$Date = date('Y-m-d');
			$SiteName = $GLOBALS['sitename'];
			
			$NewPageID = $PageID;
			
			$NewPage = '../index.php?PageID=';
			$NewPage .= $PageID;
			
			$Location = 'index.php?PageID=';
			$Location .= $PageID;
			
			
			$temp = $Tier6Databases->PostCheck ('Heading', 'FilteredInput', $hold);
			if (!is_null($temp)) {
				$hold = $temp;
			}
			
			$temp = $Tier6Databases->PostCheck ('Keywords', 'FilteredInput', $hold);
			if (!is_null($temp)) {
				$hold = $temp;
			}
			
			$temp = $Tier6Databases->PostCheck ('Description', 'FilteredInput', $hold);
			if (!is_null($temp)) {
				$hold = $temp;
			}
			
			$temp = $Tier6Databases->PostCheck ('TopText', 'FilteredInput', $hold);
			if (!is_null($temp)) {
				$hold = $temp;
			}
			
			$temp = $Tier6Databases->MultiPostCheck('PhotoSet', 1, $hold, NULL, NULL, 'Heading');
			if ($temp != NULL) {
				$hold = $temp;
			}
			
			$temp = $Tier6Databases->MultiPostCheck('PhotoSet', 1, $hold, NULL, NULL, 'TopText');
			if ($temp != NULL) {
				$hold = $temp;
			}
			
			$temp = $Tier6Databases->MultiPostCheck('PhotoSet', 1, $hold, NULL, NULL, 'Image1Src');
			if ($temp != NULL) {
				$hold = $temp;
			}
			
			$temp = $Tier6Databases->MultiPostCheck('PhotoSet', 1, $hold, NULL, NULL, 'Image1Text');
			if ($temp != NULL) {
				$hold = $temp;
			}
			
			$temp = $Tier6Databases->MultiPostCheck('PhotoSet', 1, $hold, NULL, NULL, 'Image1Alt');
			if ($temp != NULL) {
				$hold = $temp;
			}
			
			$temp = $Tier6Databases->MultiPostCheck('PhotoSet', 1, $hold, NULL, NULL, 'Image2Src');
			if ($temp != NULL) {
				$hold = $temp;
			}
			
			$temp = $Tier6Databases->MultiPostCheck('PhotoSet', 1, $hold, NULL, NULL, 'Image2Text');
			if ($temp != NULL) {
				$hold = $temp;
			}
			
			$temp = $Tier6Databases->MultiPostCheck('PhotoSet', 1, $hold, NULL, NULL, 'Image2Alt');
			if ($temp != NULL) {
				$hold = $temp;
			}
			
			$temp = $Tier6Databases->MultiPostCheck('PhotoSet', 1, $hold, NULL, NULL, 'BottomText');
			if ($temp != NULL) {
				$hold = $temp;
			}
			
			$temp = $Tier6Databases->MultiPostCheck('PhotoSet', 1, $hold, NULL, NULL, 'Order');
			if ($temp != NULL) {
				$hold = $temp;
			}
			
			$temp = $Tier6Databases->PostCheck ('BottomText', 'FilteredInput', $hold);
			if (!is_null($temp)) {
				$hold = $temp;
			}
			
			$temp = $Tier6Databases->PostCheck ('BottomHeading', 'FilteredInput', $hold);
			if (!is_null($temp)) {
				$hold = $temp;
			}
			
			$temp = $Tier6Databases->PostCheck ('MenuName', 'FilteredInput', $hold);
			if (!is_null($temp)) {
				$hold = $temp;
			}
			
			$temp = $Tier6Databases->PostCheck ('MenuTitle', 'FilteredInput', $hold);
			if (!is_null($temp)) {
				$hold = $temp;
			}
			
			$_SESSION['POST']['Error']['Link'] = '<a href=\'';
			$_SESSION['POST']['Error']['Link'] .= $NewPage;
			$_SESSION['POST']['Error']['Link'] .= '\'>Updated Photos Page</a>';
			
			
			$temp = $hold['FilteredInput'];
			
				
			$Start = array();
			$Start ['Heading'] = 'Heading';
			$Start ['TopText'] = 'TopText';
			$Start ['Image1Src'] = 'Image1Src';
			$Start ['Image1Text'] = 'Image1Text';
			$Start ['Image1Alt'] = 'Image1Alt';
			$Start ['Image2Src'] = 'Image2Src';
			$Start ['Image2Text'] = 'Image2Text';
			$Start ['Image2Alt'] = 'Image2Alt';
			$Start ['BottomText'] = 'BottomText';
			$Start ['Order'] = 'Order';
			
			$StartKey = 'PhotoSet';
			$ConditionKey = 'Image1Src';
			$StartNumber = 1;
			$Sort = 'Order';
			$temp = $Tier6Databases->MultiArrayBuild($Start, $StartKey, $ConditionKey, $StartNumber, $hold['FilteredInput'], $Sort);
			
			for ($i = 1; $temp[$i]; $i++) {
				foreach ($temp[$i] as $key => $value) {
					$temp[$key] = $value;
				}
				
				unset ($temp[$i]);
			}
			
			$hold['FilteredInput'] = $temp;
			
			// General Defines
			define(NewPageID, $NewPageID);
			define(NewRevisionID, $NewRevisionID);
			define(CurrentVersionTrueFalse, 'true');
			define(ContentPageType, 'PhotosPage');
			
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
		
			$Content = array();
			
			$PageID = array();
			$PageID['PageID'] = $NewPageID;
			
			$i = 0;
			
			$Content[$i]['PageID'] = $NewPageID;
			$Content[$i]['ObjectID'] = 0;
			$Content[$i]['ContainerObjectType'] = 'XhtmlContent';
			$Content[$i]['ContainerObjectName'] = 'content';
			$Content[$i]['ContainerObjectID'] = 1;
			$Content[$i]['ContainerObjectPrintPreview'] = 'true';
			$Content[$i]['RevisionID'] = $NewRevisionID;
			$Content[$i]['CurrentVersion'] = 'true';
			$Content[$i]['Empty'] = 'false';
			$Content[$i]['StartTag'] = '<div>';
			$Content[$i]['EndTag'] = NULL;
			$Content[$i]['StartTagID'] = 'main-content-middle';
			$Content[$i]['StartTagStyle'] = NULL;
			$Content[$i]['StartTagClass'] = NULL;
			if ($hold['FilteredInput']['Heading'] != NULL) {
				$Content[$i]['Heading'] = $hold['FilteredInput']['Heading'];
				$Content[$i]['HeadingStartTag'] = '<h2>';
				$Content[$i]['HeadingEndTag'] = '</h2>';
				$Content[$i]['HeadingStartTagID'] = NULL;
				$Content[$i]['HeadingStartTagStyle'] = NULL;
				$Content[$i]['HeadingStartTagClass'] = 'BodyHeading';
			} else {
				$Content[$i]['Heading'] = NULL;
				$Content[$i]['HeadingStartTag'] = NULL;
				$Content[$i]['HeadingEndTag'] = NULL;
				$Content[$i]['HeadingStartTagID'] = NULL;
				$Content[$i]['HeadingStartTagStyle'] = NULL;
				$Content[$i]['HeadingStartTagClass'] = NULL;
			}
			
			if ($hold['FilteredInput']['TopText'] != NULL) {
				$Content[$i]['Content'] = $hold['FilteredInput']['TopText'];
				$Content[$i]['ContentStartTag'] = '<p>';
				$Content[$i]['ContentEndTag'] = '</p>';
				$Content[$i]['ContentStartTagID'] = NULL;
				$Content[$i]['ContentStartTagStyle'] = NULL;
				$Content[$i]['ContentStartTagClass'] = 'BodyText';
				$Content[$i]['ContentPTagID'] = NULL;
				$Content[$i]['ContentPTagStyle'] = NULL;
				$Content[$i]['ContentPTagClass'] = 'BodyText';
			} else {
				$Content[$i]['Content'] = NULL;
				$Content[$i]['ContentStartTag'] = NULL;
				$Content[$i]['ContentEndTag'] = NULL;
				$Content[$i]['ContentStartTagID'] = NULL;
				$Content[$i]['ContentStartTagStyle'] = NULL;
				$Content[$i]['ContentStartTagClass'] = NULL;
				$Content[$i]['ContentPTagID'] = NULL;
				$Content[$i]['ContentPTagStyle'] = NULL;
				$Content[$i]['ContentPTagClass'] = NULL;
			}
			
			$Content[$i]['Enable/Disable'] = $_POST['EnableDisable'];
			$Content[$i]['Status'] = $_POST['Status'];
			
			$i++;
			$j = 1;
			$k = $i;
			$k++;
			$PictureID = 1;
			$PhotoSetHeading = "PhotoSet$j" . 'Heading';
			$PhotoSetTopText = "PhotoSet$j" . 'TopText';
			$PhotoSetImage1Src = "PhotoSet$j" . 'Image1Src';
			$PhotoSetImage1Text = "PhotoSet$j" . 'Image1Text';
			$PhotoSetImage1Alt = "PhotoSet$j" . 'Image1Alt';
			$PhotoSetImage2Src = "PhotoSet$j" . 'Image2Src';
			$PhotoSetImage2Text = "PhotoSet$j" . 'Image2Text';
			$PhotoSetImage2Alt = "PhotoSet$j" . 'Image2Alt';
			$PhotoSetBottomText = "PhotoSet$j" . 'BottomText';
			
			$Image = array();
			while ($hold['FilteredInput'][$PhotoSetImage1Src] != NULL | $hold['FilteredInput'][$PhotoSetHeading] != NULL | $hold['FilteredInput'][$PhotoSetTopText] != NULL ) {
				if ($hold['FilteredInput'][$PhotoSetHeading] != NULL | $hold['FilteredInput'][$PhotoSetTopText] != NULL) {
					$Content[$i]['PageID'] = $NewPageID;
					$Content[$i]['ObjectID'] = $i;
					$Content[$i]['ContainerObjectType'] = 'XhtmlContent';
					$Content[$i]['ContainerObjectName'] = 'content';
					$Content[$i]['ContainerObjectID'] = $k;
					$Content[$i]['ContainerObjectPrintPreview'] = 'true';
					$Content[$i]['RevisionID'] = $NewRevisionID;
					$Content[$i]['CurrentVersion'] = 'true';
					$Content[$i]['Empty'] = 'false';
					$Content[$i]['StartTag'] = NULL;
					$Content[$i]['EndTag'] = NULL;
					$Content[$i]['StartTagID'] = NULL;
					$Content[$i]['StartTagStyle'] = NULL;
					$Content[$i]['StartTagClass'] = NULL;
					if ($hold['FilteredInput'][$PhotoSetHeading] != NULL) {
						$Content[$i]['Heading'] = $hold['FilteredInput'][$PhotoSetHeading];
						$Content[$i]['HeadingStartTag'] = '<h2>';
						$Content[$i]['HeadingEndTag'] = '</h2>';
						$Content[$i]['HeadingStartTagID'] = NULL;
						$Content[$i]['HeadingStartTagStyle'] = NULL;
						$Content[$i]['HeadingStartTagClass'] = 'BodyHeading';
					} else {
						$Content[$i]['Heading'] = NULL;
						$Content[$i]['HeadingStartTag'] = NULL;
						$Content[$i]['HeadingEndTag'] = NULL;
						$Content[$i]['HeadingStartTagID'] = NULL;
						$Content[$i]['HeadingStartTagStyle'] = NULL;
						$Content[$i]['HeadingStartTagClass'] = NULL;
					}
					
					if ($hold['FilteredInput'][$PhotoSetTopText] != NULL) {
						$Content[$i]['Content'] = $hold['FilteredInput'][$PhotoSetTopText];
						$Content[$i]['ContentStartTag'] = '<p>';
						$Content[$i]['ContentEndTag'] = '</p>';
						$Content[$i]['ContentStartTagID'] = NULL;
						$Content[$i]['ContentStartTagStyle'] = NULL;
						$Content[$i]['ContentStartTagClass'] = 'BodyText';
						$Content[$i]['ContentPTagID'] = NULL;
						$Content[$i]['ContentPTagStyle'] = NULL;
						$Content[$i]['ContentPTagClass'] = 'BodyText';
					} else {
						$Content[$i]['Content'] = NULL;
						$Content[$i]['ContentStartTag'] = NULL;
						$Content[$i]['ContentEndTag'] = NULL;
						$Content[$i]['ContentStartTagID'] = NULL;
						$Content[$i]['ContentStartTagStyle'] = NULL;
						$Content[$i]['ContentStartTagClass'] = NULL;
						$Content[$i]['ContentPTagID'] = NULL;
						$Content[$i]['ContentPTagStyle'] = NULL;
						$Content[$i]['ContentPTagClass'] = NULL;
					}
				
					$Content[$i]['Enable/Disable'] = $_POST['EnableDisable'];
					$Content[$i]['Status'] = $_POST['Status'];
				} else {
					$i--;
				}
				
				if ($hold['FilteredInput'][$PhotoSetImage1Src] != NULL) {
					$i++;
					$k++;
					$Content[$i]['PageID'] = $NewPageID;
					$Content[$i]['ObjectID'] = $i;
					$Content[$i]['ContainerObjectType'] = 'XhtmlContent';
					$Content[$i]['ContainerObjectName'] = 'content';
					$Content[$i]['ContainerObjectID'] = $k;
					$Content[$i]['ContainerObjectPrintPreview'] = 'true';
					$Content[$i]['RevisionID'] = $NewRevisionID;
					$Content[$i]['CurrentVersion'] = 'true';
					$Content[$i]['Empty'] = 'false';
					$Content[$i]['StartTag'] = '<div>';
					$Content[$i]['EndTag'] = NULL;
					$Content[$i]['StartTagID'] = NULL;
					$Content[$i]['StartTagStyle'] = NULL;
					$Content[$i]['StartTagClass'] = 'Picture1';
					$Content[$i]['Heading'] = NULL;
					$Content[$i]['HeadingStartTag'] = NULL;
					$Content[$i]['HeadingEndTag'] = NULL;
					$Content[$i]['HeadingStartTagID'] = NULL;
					$Content[$i]['HeadingStartTagStyle'] = NULL;
					$Content[$i]['HeadingStartTagClass'] = NULL;
					$Content[$i]['Content'] = NULL;
					$Content[$i]['ContentStartTag'] = NULL;
					$Content[$i]['ContentEndTag'] = NULL;
					$Content[$i]['ContentStartTagID'] = NULL;
					$Content[$i]['ContentStartTagStyle'] = NULL;
					$Content[$i]['ContentStartTagClass'] = NULL;
					$Content[$i]['ContentPTagID'] = NULL;
					$Content[$i]['ContentPTagStyle'] = NULL;
					$Content[$i]['ContentPTagClass'] = NULL;
					$Content[$i]['Enable/Disable'] = $_POST['EnableDisable'];
					$Content[$i]['Status'] = $_POST['Status'];
					
					$i++;
					$k++;
					
					$Image[$PictureID]['PageID'] = $NewPageID;
					$Image[$PictureID]['ObjectID'] = $PictureID;
					$Image[$PictureID]['RevisionID'] = $NewRevisionID;
					$Image[$PictureID]['CurrentVersion'] = 'true';
					$Image[$PictureID]['StartTag'] = '<div>';
					$Image[$PictureID]['EndTag'] = NULL;
					$Image[$PictureID]['StartTagID'] = NULL;
					$Image[$PictureID]['StartTagStyle'] = NULL;
					if ($hold['FilteredInput'][$PhotoSetImage2Src] != NULL) {
						$Image[$PictureID]['StartTagClass'] = 'PictureLeft';
					} else {
						$Image[$PictureID]['StartTagClass'] = 'PictureCenter';
					}
					$Image[$PictureID]['PictureID'] = NULL;
					$Image[$PictureID]['PictureClass'] = NULL;
					$Image[$PictureID]['PictureStyle'] = NULL;
					$Image[$PictureID]['PictureLink'] = $hold['FilteredInput'][$PhotoSetImage1Src];
					$Image[$PictureID]['PictureAltText'] = $hold['FilteredInput'][$PhotoSetImage1Alt];
					$Image[$PictureID]['Width'] = NULL;
					$Image[$PictureID]['Height'] = NULL;
					$Image[$PictureID]['Enable/Disable'] = $_POST['EnableDisable'];
					$Image[$PictureID]['Status'] = $_POST['Status'];
					
					$Content[$i]['PageID'] = $NewPageID;
					$Content[$i]['ObjectID'] = $i;
					$Content[$i]['ContainerObjectType'] = 'XhtmlPicture';
					$Content[$i]['ContainerObjectName'] = 'picture';
					$Content[$i]['ContainerObjectID'] = $PictureID;
					$Content[$i]['ContainerObjectPrintPreview'] = 'true';
					$Content[$i]['RevisionID'] = $NewRevisionID;
					$Content[$i]['CurrentVersion'] = 'true';
					$Content[$i]['Empty'] = 'false';
					$Content[$i]['StartTag'] = NULL;
					$Content[$i]['EndTag'] = NULL;
					$Content[$i]['StartTagID'] = NULL;
					$Content[$i]['StartTagStyle'] = NULL;
					$Content[$i]['StartTagClass'] = 'Picture1';
					$Content[$i]['Heading'] = NULL;
					$Content[$i]['HeadingStartTag'] = NULL;
					$Content[$i]['HeadingEndTag'] = NULL;
					$Content[$i]['HeadingStartTagID'] = NULL;
					$Content[$i]['HeadingStartTagStyle'] = NULL;
					$Content[$i]['HeadingStartTagClass'] = NULL;
					$Content[$i]['Content'] = NULL;
					$Content[$i]['ContentStartTag'] = NULL;
					$Content[$i]['ContentEndTag'] = NULL;
					$Content[$i]['ContentStartTagID'] = NULL;
					$Content[$i]['ContentStartTagStyle'] = NULL;
					$Content[$i]['ContentStartTagClass'] = NULL;
					$Content[$i]['ContentPTagID'] = NULL;
					$Content[$i]['ContentPTagStyle'] = NULL;
					$Content[$i]['ContentPTagClass'] = NULL;
					$Content[$i]['Enable/Disable'] = $_POST['EnableDisable'];
					$Content[$i]['Status'] = $_POST['Status'];
					
					$i++;
					$k++;
					
					$Content[$i]['PageID'] = $NewPageID;
					$Content[$i]['ObjectID'] = $i;
					$Content[$i]['ContainerObjectType'] = 'XhtmlContent';
					$Content[$i]['ContainerObjectName'] = 'content';
					$Content[$i]['ContainerObjectID'] = $k;
					$Content[$i]['ContainerObjectPrintPreview'] = 'true';
					$Content[$i]['RevisionID'] = $NewRevisionID;
					$Content[$i]['CurrentVersion'] = 'true';
					$Content[$i]['Empty'] = 'false';
					$Content[$i]['StartTag'] = NULL;
					$Content[$i]['EndTag'] = '</div>';
					$Content[$i]['StartTagID'] = NULL;
					$Content[$i]['StartTagStyle'] = NULL;
					$Content[$i]['StartTagClass'] = NULL;
					$Content[$i]['Heading'] = NULL;
					$Content[$i]['HeadingStartTag'] = NULL;
					$Content[$i]['HeadingEndTag'] = NULL;
					$Content[$i]['HeadingStartTagID'] = NULL;
					$Content[$i]['HeadingStartTagStyle'] = NULL;
					$Content[$i]['HeadingStartTagClass'] = NULL;
					if ($hold['FilteredInput'][$PhotoSetImage1Text] != NULL) {
						$Content[$i]['Content'] = $hold['FilteredInput'][$PhotoSetImage1Text];
						$Content[$i]['ContentStartTag'] = '<p>';
						$Content[$i]['ContentEndTag'] = '</p>';
						$Content[$i]['ContentStartTagID'] = NULL;
						$Content[$i]['ContentStartTagStyle'] = NULL;
						if ($hold['FilteredInput'][$PhotoSetImage2Src] != NULL) {
							$Content[$i]['ContentStartTagClass'] = 'BodyText TextSideLeft';
						} else {
							$Content[$i]['ContentStartTagClass'] = 'BodyText TextSideCenter';
						}
						$Content[$i]['ContentPTagID'] = NULL;
						$Content[$i]['ContentPTagStyle'] = NULL;
						if ($hold['FilteredInput'][$PhotoSetImage2Src] != NULL) {
							$Content[$i]['ContentPTagClass'] = 'BodyText TextSideLeft';
						} else {
							$Content[$i]['ContentPTagClass'] = 'BodyText TextSideCenter';
						}
						
					} else {
						$Content[$i]['Content'] = NULL;
						$Content[$i]['ContentStartTag'] = NULL;
						$Content[$i]['ContentEndTag'] = NULL;
						$Content[$i]['ContentStartTagID'] = NULL;
						$Content[$i]['ContentStartTagStyle'] = NULL;
						$Content[$i]['ContentStartTagClass'] = NULL;
						$Content[$i]['ContentPTagID'] = NULL;
						$Content[$i]['ContentPTagStyle'] = NULL;
						$Content[$i]['ContentPTagClass'] = NULL;
					}
					$Content[$i]['Enable/Disable'] = $_POST['EnableDisable'];
					$Content[$i]['Status'] = $_POST['Status'];
					
					if ($hold['FilteredInput'][$PhotoSetImage2Src] != NULL) {
						$i++;
						$k++;
						$PictureID++;
						
						$Image[$PictureID]['PageID'] = $NewPageID;
						$Image[$PictureID]['ObjectID'] = $PictureID;
						$Image[$PictureID]['RevisionID'] = $NewRevisionID;
						$Image[$PictureID]['CurrentVersion'] = 'true';
						$Image[$PictureID]['StartTag'] = '<div>';
						$Image[$PictureID]['EndTag'] = NULL;
						$Image[$PictureID]['StartTagID'] = NULL;
						$Image[$PictureID]['StartTagStyle'] = NULL;
						$Image[$PictureID]['StartTagClass'] = 'PictureRight';
						$Image[$PictureID]['PictureID'] = NULL;
						$Image[$PictureID]['PictureClass'] = NULL;
						$Image[$PictureID]['PictureStyle'] = NULL;
						$Image[$PictureID]['PictureLink'] = $hold['FilteredInput'][$PhotoSetImage2Src];
						$Image[$PictureID]['PictureAltText'] = $hold['FilteredInput'][$PhotoSetImage2Alt];
						$Image[$PictureID]['Width'] = NULL;
						$Image[$PictureID]['Height'] = NULL;
						$Image[$PictureID]['Enable/Disable'] = $_POST['EnableDisable'];
						$Image[$PictureID]['Status'] = $_POST['Status'];						
						
						$Content[$i]['PageID'] = $NewPageID;
						$Content[$i]['ObjectID'] = $i;
						$Content[$i]['ContainerObjectType'] = 'XhtmlPicture';
						$Content[$i]['ContainerObjectName'] = 'picture';
						$Content[$i]['ContainerObjectID'] = $PictureID;
						$Content[$i]['ContainerObjectPrintPreview'] = 'true';
						$Content[$i]['RevisionID'] = $NewRevisionID;
						$Content[$i]['CurrentVersion'] = 'true';
						$Content[$i]['Empty'] = 'false';
						$Content[$i]['StartTag'] = NULL;
						$Content[$i]['EndTag'] = NULL;
						$Content[$i]['StartTagID'] = NULL;
						$Content[$i]['StartTagStyle'] = NULL;
						$Content[$i]['StartTagClass'] = 'Picture1';
						$Content[$i]['Heading'] = NULL;
						$Content[$i]['HeadingStartTag'] = NULL;
						$Content[$i]['HeadingEndTag'] = NULL;
						$Content[$i]['HeadingStartTagID'] = NULL;
						$Content[$i]['HeadingStartTagStyle'] = NULL;
						$Content[$i]['HeadingStartTagClass'] = NULL;
						$Content[$i]['Content'] = NULL;
						$Content[$i]['ContentStartTag'] = NULL;
						$Content[$i]['ContentEndTag'] = NULL;
						$Content[$i]['ContentStartTagID'] = NULL;
						$Content[$i]['ContentStartTagStyle'] = NULL;
						$Content[$i]['ContentStartTagClass'] = NULL;
						$Content[$i]['ContentPTagID'] = NULL;
						$Content[$i]['ContentPTagStyle'] = NULL;
						$Content[$i]['ContentPTagClass'] = NULL;
						$Content[$i]['Enable/Disable'] = $_POST['EnableDisable'];
						$Content[$i]['Status'] = $_POST['Status'];
						
						$i++;
						$k++;
						$PictureID++;
						
						$Content[$i]['PageID'] = $NewPageID;
						$Content[$i]['ObjectID'] = $i;
						$Content[$i]['ContainerObjectType'] = 'XhtmlContent';
						$Content[$i]['ContainerObjectName'] = 'content';
						$Content[$i]['ContainerObjectID'] = $k;
						$Content[$i]['ContainerObjectPrintPreview'] = 'true';
						$Content[$i]['RevisionID'] = $NewRevisionID;
						$Content[$i]['CurrentVersion'] = 'true';
						$Content[$i]['Empty'] = 'false';
						$Content[$i]['StartTag'] = NULL;
						$Content[$i]['EndTag'] = '</div>';
						$Content[$i]['StartTagID'] = NULL;
						$Content[$i]['StartTagStyle'] = NULL;
						$Content[$i]['StartTagClass'] = NULL;
						$Content[$i]['Heading'] = NULL;
						$Content[$i]['HeadingStartTag'] = NULL;
						$Content[$i]['HeadingEndTag'] = NULL;
						$Content[$i]['HeadingStartTagID'] = NULL;
						$Content[$i]['HeadingStartTagStyle'] = NULL;
						$Content[$i]['HeadingStartTagClass'] = NULL;
						if ($hold['FilteredInput'][$PhotoSetImage2Text] != NULL) {
							$Content[$i]['Content'] = $hold['FilteredInput'][$PhotoSetImage2Text];
							$Content[$i]['ContentStartTag'] = '<p>';
							$Content[$i]['ContentEndTag'] = '</p>';
							$Content[$i]['ContentStartTagID'] = NULL;
							$Content[$i]['ContentStartTagStyle'] = NULL;
							$Content[$i]['ContentStartTagClass'] = 'BodyText TextSideRight';
							$Content[$i]['ContentPTagID'] = NULL;
							$Content[$i]['ContentPTagStyle'] = NULL;
							$Content[$i]['ContentPTagClass'] = 'BodyText TextSideRight';
							
						} else {
							$Content[$i]['Content'] = NULL;
							$Content[$i]['ContentStartTag'] = NULL;
							$Content[$i]['ContentEndTag'] = NULL;
							$Content[$i]['ContentStartTagID'] = NULL;
							$Content[$i]['ContentStartTagStyle'] = NULL;
							$Content[$i]['ContentStartTagClass'] = NULL;
							$Content[$i]['ContentPTagID'] = NULL;
							$Content[$i]['ContentPTagStyle'] = NULL;
							$Content[$i]['ContentPTagClass'] = NULL;
						}
						$Content[$i]['Enable/Disable'] = $_POST['EnableDisable'];
						$Content[$i]['Status'] = $_POST['Status'];
					}
					
					$i++;
					$k++;
					$Content[$i]['PageID'] = $NewPageID;
					$Content[$i]['ObjectID'] = $i;
					$Content[$i]['ContainerObjectType'] = 'XhtmlContent';
					$Content[$i]['ContainerObjectName'] = 'content';
					$Content[$i]['ContainerObjectID'] = $k;
					$Content[$i]['ContainerObjectPrintPreview'] = 'true';
					$Content[$i]['RevisionID'] = $NewRevisionID;
					$Content[$i]['CurrentVersion'] = 'true';
					$Content[$i]['Empty'] = 'false';
					$Content[$i]['StartTag'] = NULL;
					$Content[$i]['EndTag'] = '</div>';
					$Content[$i]['StartTagID'] = NULL;
					$Content[$i]['StartTagStyle'] = NULL;
					$Content[$i]['StartTagClass'] = NULL;
					$Content[$i]['Heading'] = NULL;
					$Content[$i]['HeadingStartTag'] = NULL;
					$Content[$i]['HeadingEndTag'] = NULL;
					$Content[$i]['HeadingStartTagID'] = NULL;
					$Content[$i]['HeadingStartTagStyle'] = NULL;
					$Content[$i]['HeadingStartTagClass'] = NULL;
					$Content[$i]['Content'] = NULL;
					$Content[$i]['ContentStartTag'] = NULL;
					$Content[$i]['ContentEndTag'] = NULL;
					$Content[$i]['ContentStartTagID'] = NULL;
					$Content[$i]['ContentStartTagStyle'] = NULL;
					$Content[$i]['ContentStartTagClass'] = NULL;
					$Content[$i]['ContentPTagID'] = NULL;
					$Content[$i]['ContentPTagStyle'] = NULL;
					$Content[$i]['ContentPTagClass'] = NULL;
					$Content[$i]['Enable/Disable'] = $_POST['EnableDisable'];
					$Content[$i]['Status'] = $_POST['Status'];
					
				} 
				$j++;
				$i++;
				$k++;
				$PhotoSetHeading = "PhotoSet$j" . 'Heading';
				$PhotoSetTopText = "PhotoSet$j" . 'TopText';
				$PhotoSetImage1Src = "PhotoSet$j" . 'Image1Src';
				$PhotoSetImage1Text = "PhotoSet$j" . 'Image1Text';
				$PhotoSetImage1Alt = "PhotoSet$j" . 'Image1Alt';
				$PhotoSetImage2Src = "PhotoSet$j" . 'Image2Src';
				$PhotoSetImage2Text = "PhotoSet$j" . 'Image2Text';
				$PhotoSetImage2Alt = "PhotoSet$j" . 'Image2Alt';
				$PhotoSetBottomText = "PhotoSet$j" . 'BottomText';
				
			}
			$Content[$i]['PageID'] = $NewPageID;
			$Content[$i]['ObjectID'] = $i;
			$Content[$i]['ContainerObjectType'] = 'XhtmlContent';
			$Content[$i]['ContainerObjectName'] = 'content';
			$Content[$i]['ContainerObjectID'] = $k;
			$Content[$i]['ContainerObjectPrintPreview'] = 'true';
			$Content[$i]['RevisionID'] = $NewRevisionID;
			$Content[$i]['CurrentVersion'] = 'true';
			$Content[$i]['Empty'] = 'false';
			$Content[$i]['StartTag'] = NULL;
			$Content[$i]['EndTag'] = '</div>';
			$Content[$i]['StartTagID'] = NULL;
			$Content[$i]['StartTagStyle'] = NULL;
			$Content[$i]['StartTagClass'] = NULL;
			
			if ($hold['FilteredInput']['BottomHeading'] != NULL) {
				$Content[$i]['Heading'] = $hold['FilteredInput']['BottomHeading'];
				$Content[$i]['HeadingStartTag'] = '<h2>';
				$Content[$i]['HeadingEndTag'] = '</h2>';
				$Content[$i]['HeadingStartTagID'] = NULL;
				$Content[$i]['HeadingStartTagStyle'] = NULL;
				$Content[$i]['HeadingStartTagClass'] = 'BodyHeading';
			} else {
				$Content[$i]['Heading'] = NULL;
				$Content[$i]['HeadingStartTag'] = NULL;
				$Content[$i]['HeadingEndTag'] = NULL;
				$Content[$i]['HeadingStartTagID'] = NULL;
				$Content[$i]['HeadingStartTagStyle'] = NULL;
				$Content[$i]['HeadingStartTagClass'] = NULL;
			}
			
			if ($hold['FilteredInput']['BottomText'] != NULL) {
				$Content[$i]['Content'] = $hold['FilteredInput']['BottomText'];
				$Content[$i]['ContentStartTag'] = '<p>';
				$Content[$i]['ContentEndTag'] = '</p>';
				$Content[$i]['ContentStartTagID'] = NULL;
				$Content[$i]['ContentStartTagStyle'] = NULL;
				$Content[$i]['ContentStartTagClass'] = 'BodyText';
				$Content[$i]['ContentPTagID'] = NULL;
				$Content[$i]['ContentPTagStyle'] = NULL;
				$Content[$i]['ContentPTagClass'] = 'BodyText';
			} else {
				$Content[$i]['Content'] = NULL;
				$Content[$i]['ContentStartTag'] = NULL;
				$Content[$i]['ContentEndTag'] = NULL;
				$Content[$i]['ContentStartTagID'] = NULL;
				$Content[$i]['ContentStartTagStyle'] = NULL;
				$Content[$i]['ContentStartTagClass'] = NULL;
				$Content[$i]['ContentPTagID'] = NULL;
				$Content[$i]['ContentPTagStyle'] = NULL;
				$Content[$i]['ContentPTagClass'] = NULL;
			}
			$Content[$i]['Enable/Disable'] = $_POST['EnableDisable'];
			$Content[$i]['Status'] = $_POST['Status'];		
			//$Content = array_reverse($Content);
			
			$Header = parse_ini_file('ModuleSettings/Tier6-ContentLayer/Modules/XhtmlHeader/UpdateXhtmlHeader.ini',FALSE);
			$Header = $Tier6Databases->EmptyStringToNullArray($Header);
			
			$HeaderPanel1 = array();
			//$HeaderPanel1[0]['PageID'] = $NewPageID;
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
			
			//$HeaderPanel1[1]['PageID'] = $NewPageID;
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
			
			$ContentLayerVersion = parse_ini_file('ModuleSettings/Tier6-ContentLayer/GlobalSettings/UpdateContentLayerVersion.ini',FALSE);
			$ContentLayerVersion = $Tier6Databases->EmptyStringToNullArray($ContentLayerVersion);
			
			$ContentLayer = parse_ini_file('ModuleSettings/Tier6-ContentLayer/GlobalSettings/UpdateContentLayer.ini',TRUE);
			$ContentLayer = $Tier6Databases->EmptyStringToNullArray($ContentLayer);
			
			$_POST['Priority'] = $_POST['Priority'] / 10;
			
			$Sitemap = parse_ini_file('ModuleSettings/Tier6-ContentLayer/Modules/XmlSitemap/UpdateXmlSitemap.ini',FALSE);
			$Sitemap = $Tier6Databases->EmptyStringToNullArray($Sitemap);
			
			$ContentPrintPreview = parse_ini_file('ModuleSettings/Tier6-ContentLayer/Modules/XhtmlContent/UpdatePrintPreview.ini',FALSE);
			$ContentPrintPreview = $Tier6Databases->EmptyStringToNullArray($ContentPrintPreview);
			
			$UpdatePhotosPageSelect = $Options['XhtmlPictures']['picture']['UpdatePhotosPageSelect']['SettingAttribute'];
			
			$FormOptionText = $hold['FilteredInput']['PageTitle'];
			//$FormOptionValue = $NewPhotosPage;
			//$FormOptionValue .= ' - ';
			//$FormOptionValue .= $NewPageID;
			
			$FormOption = array();
			//$FormOption['PageID'] = $UpdatePhotosPageSelect;
			//$FormOption['ObjectID'] = $NewPhotosPage;
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
			
			$FormOptionID = $Options['XhtmlPicture']['picture']['UpdatePhotosPageSelect']['SettingAttribute'];
			$Tier6Databases->ModulePass('XhtmlForm', 'form', 'updateFormOption', array('PageID' => array('PageID' => $FormOptionID, 'ObjectID' => $FormOptionObjectID), 'Content' => $FormOption));
			$FormOptionID = $Options['XhtmlPicture']['picture']['DeletePhotosPage']['SettingAttribute'];
			$Tier6Databases->ModulePass('XhtmlForm', 'form', 'updateFormOption', array('PageID' => array('PageID' => $FormOptionID, 'ObjectID' => $FormOptionObjectID), 'Content' => $FormOption));
			$FormOptionID = $Options['XhtmlPicture']['picture']['EnableDisableStatusChangePhotosPage']['SettingAttribute'];
			$Tier6Databases->ModulePass('XhtmlForm', 'form', 'updateFormOption', array('PageID' => array('PageID' => $FormOptionID, 'ObjectID' => $FormOptionObjectID), 'Content' => $FormOption));
			$FormOptionID = $Options['XhtmlMainMenu']['mainmenu']['MainMenuSelectPage']['SettingAttribute'];
			$Tier6Databases->ModulePass('XhtmlForm', 'form', 'updateFormOption', array('PageID' => array('PageID' => $FormOptionID, 'ObjectID' => $NewPageID), 'Content' => $FormOption));
			$FormOptionID = $Options['XhtmlMainMenu']['mainmenu']['MainMenuUpdatePage']['SettingAttribute'];
			$Tier6Databases->ModulePass('XhtmlForm', 'form', 'updateFormOption', array('PageID' => array('PageID' => $FormOptionID, 'ObjectID' => $NewPageID), 'Content' => $FormOption));
			
			$Tier6Databases->ModulePass('XhtmlHeader', 'header', 'updateHeader', $PageID);
			$Tier6Databases->ModulePass('XhtmlHeader', 'header', 'createHeader', $Header);
			
			$Tier6Databases->ModulePass('XhtmlMenu', 'headerpanel1', 'updateMenu', array('PageID' => array('PageID' => $NewPageID, 'ObjectID' => 2), 'Content' => $HeaderPanel1));
			$Tier6Databases->ModulePass('XhtmlContent', 'content', 'updateContentPrintPreview', array('PageID' => $PageID, 'Content' => $ContentPrintPreview));
			$Tier6Databases->ModulePass('XmlSitemap', 'sitemap', 'updateSitemapItem', array('PageID' => $PageID, 'Content' => $Sitemap));
			
			$Tier6Databases->ModulePass('XhtmlPicture', 'picture', 'updatePicture', $PageID);
			$Tier6Databases->ModulePass('XhtmlContent', 'content', 'updateContent', $PageID);
			$Tier6Databases->updateContentVersion($PageID, 'ContentLayerVersion');
			$Tier6Databases->updateContent($PageID, 'ContentLayer');
			
			reset($Image);
			while (current($Image)) {
				$Tier6Databases->ModulePass('XhtmlPicture', 'picture', 'createPicture', $Image[key($Image)]);
				next($Image);
			}
			$Tier6Databases->ModulePass('XhtmlContent', 'content', 'createContent', $Content);
			$Tier6Databases->createContentVersion($ContentLayerVersion, 'ContentLayerVersion');
			$Tier6Databases->createContent($ContentLayer, 'ContentLayer');
			
			$Tier6Databases->SessionDestroy($sessionname);
			$sessionname = $Tier6Databases->SessionStart('UpdatedPhotosPage');
			
			$Page = '../index.php?PageID=';
			$Page .= $NewPageID;
		
			$_SESSION['POST']['Error']['Link'] = '<a href=\'';
			$_SESSION['POST']['Error']['Link'] .= $Page;
			$_SESSION['POST']['Error']['Link'] .= '\'>Updated Photos Page</a>';
			
			$CreatedUpdatePhotosPage = $Options['XhtmlPicture']['picture']['CreatedUpdatePhotosPage']['SettingAttribute'];
			header("Location: $CreatedUpdatePhotosPage&SessionID=$sessionname");
			exit;
		}
	} else {
		$Tier6Databases->SessionDestroy($sessionname);
		$Options = $Tier6Databases->getLayerModuleSetting();
		$UpdatePhotosPageSelect = $Options['XhtmlPicture']['picture']['UpdatePhotosPageSelect']['SettingAttribute'];
		header("Location: index.php?PageID=$UpdatePhotosPageSelect");
	}
	
?>