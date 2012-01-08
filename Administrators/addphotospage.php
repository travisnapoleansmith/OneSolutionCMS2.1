<?php
	require_once ('Configuration/includes.php');
	$Options = $Tier6Databases->getLayerModuleSetting();
	$PageName = 'index.php?PageID=';
	if ($_POST['AddPhotosPage']) {
		$PageName .= $_POST['AddPhotosPage'];
	} else {
		$_POST['AddPhotosPage'] = $Options['XhtmlPicture']['picture']['AddPhotosPage']['SettingAttribute'];
		$PageName .= $_POST['AddPhotosPage'];
	}
	
	$hold = $Tier6Databases->FormSubmitValidate('AddPhotosPage', $PageName);
	
	if ($hold) {
		$sessionname = $Tier6Databases->SessionStart('CreatePhotosPage');
		$_SESSION['POST'] = $_POST;
		$DateTime = date('Y-m-d H:i:s');
		$Date = date('Y-m-d');
		$SiteName = $GLOBALS['sitename'];
		
		$LastPageID = $Tier6Databases->ModulePass('XhtmlContent', 'content', 'getLastContentPageID', array());
		if (isset($LastPageID)) {
			$NewPageID = ++$LastPageID;
		} else {
			$NewPageID = 1;
		}
		
		$LastPhotosPage = $Options['XhtmlPicture']['picture']['LastPhotosPage']['SettingAttribute'];
		$NewPhotosPage = ++$LastPhotosPage;
		$Tier6Databases->updateModuleSetting('XhtmlPicture', 'picture', 'LastPhotosPage', $NewPhotosPage);
		
		$NewPage = '../index.php?PageID=';
		$NewPage .= $NewPageID;
		
		$Location = 'index.php?PageID=';
		$Location .= $NewPageID;
		
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
		$_SESSION['POST']['Error']['Link'] .= '\'>New Photos Page</a>';
		
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
		define(CurrentVersionTrueFalse, 'true');
		define(ContentPageType, 'PhotosPage');
		
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
		
		$i = 0;
		
		$Content[$i]['PageID'] = $NewPageID;
		$Content[$i]['ObjectID'] = 0;
		$Content[$i]['ContainerObjectType'] = 'XhtmlContent';
		$Content[$i]['ContainerObjectName'] = 'content';
		$Content[$i]['ContainerObjectID'] = 1;
		$Content[$i]['ContainerObjectPrintPreview'] = 'true';
		$Content[$i]['RevisionID'] = 0;
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
				$Content[$i]['RevisionID'] = 0;
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
				$Content[$i]['RevisionID'] = 0;
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
				$Image[$PictureID]['RevisionID'] = 0;
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
				$Content[$i]['RevisionID'] = 0;
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
				$Content[$i]['RevisionID'] = 0;
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
					$Image[$PictureID]['RevisionID'] = 0;
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
					$Content[$i]['RevisionID'] = 0;
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
					$Content[$i]['RevisionID'] = 0;
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
				$Content[$i]['RevisionID'] = 0;
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
				
				if ($hold['FilteredInput'][$PhotoSetBottomText] != NULL) {
					$Content[$i]['Content'] = $hold['FilteredInput'][$PhotoSetBottomText];
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
				/*
				$Content[$i]['Content'] = NULL;
				$Content[$i]['ContentStartTag'] = NULL;
				$Content[$i]['ContentEndTag'] = NULL;
				$Content[$i]['ContentStartTagID'] = NULL;
				$Content[$i]['ContentStartTagStyle'] = NULL;
				$Content[$i]['ContentStartTagClass'] = NULL;
				$Content[$i]['ContentPTagID'] = NULL;
				$Content[$i]['ContentPTagStyle'] = NULL;
				$Content[$i]['ContentPTagClass'] = NULL;
				*/
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
		$Content[$i]['RevisionID'] = 0;
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
		
		$Header = parse_ini_file('ModuleSettings/Tier6-ContentLayer/Modules/XhtmlHeader/AddXhtmlHeader.ini',FALSE);
		$Header = $Tier6Databases->EmptyStringToNullArray($Header);
		
		$HeaderPanel1 = parse_ini_file('ModuleSettings/Tier6-ContentLayer/Modules/XhtmlMenu/AddHeaderPanel1.ini',TRUE);
		$HeaderPanel1 = $Tier6Databases->EmptyStringToNullArray($HeaderPanel1);
		
		$ContentLayerVersion = parse_ini_file('ModuleSettings/Tier6-ContentLayer/GlobalSettings/AddContentLayerVersion.ini',FALSE);
		$ContentLayerVersion = $Tier6Databases->EmptyStringToNullArray($ContentLayerVersion);
		
		$ContentLayer = parse_ini_file('ModuleSettings/Tier6-ContentLayer/GlobalSettings/AddContentLayer.ini',TRUE);
		$ContentLayer = $Tier6Databases->EmptyStringToNullArray($ContentLayer);
		
		$_POST['Priority'] = $_POST['Priority'] / 10;
		
		$Sitemap = parse_ini_file('ModuleSettings/Tier6-ContentLayer/Modules/XmlSitemap/AddXmlSitemap.ini',FALSE);
		$Sitemap = $Tier6Databases->EmptyStringToNullArray($Sitemap);
		
		$ContentPrintPreview = parse_ini_file('ModuleSettings/Tier6-ContentLayer/Modules/XhtmlContent/AddPrintPreview.ini',FALSE);
		$ContentPrintPreview = $Tier6Databases->EmptyStringToNullArray($ContentPrintPreview);
		
		$MainMenuItemLookup = parse_ini_file('ModuleSettings/Tier6-ContentLayer/Modules/XhtmlMainMenu/AddMainMenuItemLookup.ini',FALSE);
		$MainMenuItemLookup = $Tier6Databases->EmptyStringToNullArray($MainMenuItemLookup);
		
		$UpdatePhotosPageSelect = $Options['XhtmlPictures']['picture']['UpdatePhotosPageSelect']['SettingAttribute'];
		$FormSelect = array();
		$FormSelect['PageID'] = $UpdatePhotosPageSelect;
		$FormSelect['ObjectID'] = $NewPhotosPage;
		$FormSelect['StopObjectID'] = 9999;
		$FormSelect['ContinueObjectID'] = NULL;
		$FormSelect['ContainerObjectType'] = 'Option';
		$FormSelect['ContainerObjectTypeName'] = 'AdministratorFormOption';
		$FormSelect['ContainerObjectID'] = $NewPhotosPage;
		$FormSelect['FormSelectDisabled'] = NULL;
		$FormSelect['FormSelectMultiple'] = NULL;
		$FormSelect['FormSelectName'] = 'PhotosPage';
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
		$FormOptionValue = $NewPhotosPage;
		$FormOptionValue .= ' - ';
		$FormOptionValue .= $NewPageID;
		
		$FormOption = array();
		$FormOption['PageID'] = $UpdatePhotosPageSelect;
		$FormOption['ObjectID'] = $NewPhotosPage;
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
		
		reset($Image);
		while (current($Image)) {
			$Tier6Databases->ModulePass('XhtmlPicture', 'picture', 'createPicture', $Image[key($Image)]);
			next($Image);
		}
		$Tier6Databases->ModulePass('XhtmlContent', 'content', 'createContent', $Content);
		$Tier6Databases->ModulePass('XhtmlHeader', 'header', 'createHeader', $Header);
		$Tier6Databases->ModulePass('XhtmlMenu', 'headerpanel1', 'createMenu', $HeaderPanel1);
		$Tier6Databases->createContentVersion($ContentLayerVersion, 'ContentLayerVersion');
		$Tier6Databases->ModulePass('XhtmlContent', 'content', 'createContentPrintPreview', $ContentPrintPreview);
		$Tier6Databases->createContent($ContentLayer, 'ContentLayer');
		
		$Tier6Databases->ModulePass('XhtmlMainMenu', 'mainmenu', 'createMainMenuItemLookup', $MainMenuItemLookup);
		
		$Tier6Databases->ModulePass('XmlSitemap', 'sitemap', 'createSitemapItem', $Sitemap);

		$UpdatePhotosPageSelect = $Options['XhtmlPicture']['picture']['UpdatePhotosPageSelect']['SettingAttribute'];
		$FormSelect['PageID'] = $UpdatePhotosPageSelect;
		$FormOption['PageID'] = $UpdatePhotosPageSelect;
		
		$Tier6Databases->ModulePass('XhtmlForm', 'form', 'createFormOption', $FormOption);
		$Tier6Databases->ModulePass('XhtmlForm', 'form', 'createFormSelect', $FormSelect);
		
		$DeletePhotosPage = $Options['XhtmlPicture']['picture']['DeletePhotosPage']['SettingAttribute'];
		$FormSelect['PageID'] = $DeletePhotosPage;
		$FormOption['PageID'] = $DeletePhotosPage;
		
		$Tier6Databases->ModulePass('XhtmlForm', 'form', 'createFormOption', $FormOption);
		$Tier6Databases->ModulePass('XhtmlForm', 'form', 'createFormSelect', $FormSelect);
		
		$EnableDisableStatusChangePhotosPage = $Options['XhtmlPicture']['picture']['EnableDisableStatusChangePhotosPage']['SettingAttribute'];
		$FormSelect['PageID'] = $EnableDisableStatusChangePhotosPage;
		$FormOption['PageID'] = $EnableDisableStatusChangePhotosPage;
		
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
		$PhotosPageCreatedPage = $Options['XhtmlPicture']['picture']['PhotosPageCreatedPage']['SettingAttribute'];
		
		header("Location: $PhotosPageCreatedPage&SessionID=$sessionname");
		exit;
		
	}
	
?>