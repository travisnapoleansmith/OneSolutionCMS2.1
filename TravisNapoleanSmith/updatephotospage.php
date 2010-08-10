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
			
			
			if ($_POST['Heading'] == 'Null' | $_POST['Heading'] == 'NULL') {
				$_POST['Heading'] = NULL;
				$hold['FilteredInput']['Heading'] = NULL;
			}
			
			if ($_POST['TopText'] == 'Null' | $_POST['TopText'] == 'NULL') {
				$_POST['TopText'] = NULL;
				$hold['FilteredInput']['TopText'] = NULL;
			}
			
			$i = 1;
			$PhotoSetHeading = "PhotoSet$i" . 'Heading';
			$PhotoSetTopText = "PhotoSet$i" . 'TopText';
			$PhotoSetImage1Src = "PhotoSet$i" . 'Image1Src';
			$PhotoSetImage1Text = "PhotoSet$i" . 'Image1Text';
			$PhotoSetImage1Alt = "PhotoSet$i" . 'Image1Alt';
			$PhotoSetImage2Src = "PhotoSet$i" . 'Image2Src';
			$PhotoSetImage2Text = "PhotoSet$i" . 'Image2Text';
			$PhotoSetImage2Alt = "PhotoSet$i" . 'Image2Alt';
			$PhotoSetBottomText = "PhotoSet$i" . 'BottomText';
			$PhotoSetOrder = "PhotoSet$i" . 'Order';
			while (isset($_POST[$PhotoSetImage1Src])) {
				if ($_POST[$PhotoSetHeading] == 'Null' | $_POST[$PhotoSetHeading] == 'NULL') {
					$_POST[$PhotoSetHeading] = NULL;
					$hold['FilteredInput'][$PhotoSetHeading] = NULL;
				}
				
				if ($_POST[$PhotoSetTopText] == 'Null' | $_POST[$PhotoSetTopText] == 'NULL') {
					$_POST[$PhotoSetTopText] = NULL;
					$hold['FilteredInput'][$PhotoSetTopText] = NULL;
				}
				
				if ($_POST[$PhotoSetImage1Src] == 'Null' | $_POST[$PhotoSetImage1Src] == 'NULL') {
					$_POST[$PhotoSetImage1Src] = NULL;
					$hold['FilteredInput'][$PhotoSetImage1Src] = NULL;
				} else {
					if ($_POST[$PhotoSetImage1Alt] == 'Null' | $_POST[$PhotoSetImage1Alt] == 'NULL') {
						$_SESSION['POST']['Error'][$PhotoSetImage1Alt] = 'Image 1 Alt must be set and cannot be NULL!';
						$_SESSION['POST']['FilteredInput'] = $hold['FilteredInput'];
						$AddPhotosPage = $Options['XhtmlPicture']['picture']['AddPhotosPage']['SettingAttribute'];
						header("Location: index.php?PageID=$AddPhotosPage&SessionID=$sessionname");
						exit;
					}
				}
				
				if ($_POST[$PhotoSetImage1Text] == 'Null' | $_POST[$PhotoSetImage1Text] == 'NULL') {
					$_POST[$PhotoSetImage1Text] = NULL;
					$hold['FilteredInput'][$PhotoSetImage1Text] = NULL;
				}
				
				if ($_POST[$PhotoSetImage1Alt] == 'Null' | $_POST[$PhotoSetImage1Alt] == 'NULL') {
					$_POST[$PhotoSetImage1Alt] = NULL;
					$hold['FilteredInput'][$PhotoSetImage1Alt] = NULL;
				}
				
				if ($_POST[$PhotoSetImage2Src] == 'Null' | $_POST[$PhotoSetImage2Src] == 'NULL') {
					$_POST[$PhotoSetImage2Src] = NULL;
					$hold['FilteredInput'][$PhotoSetImage2Src] = NULL;
				} else {
					if ($_POST[$PhotoSetImage2Alt] == 'Null' | $_POST[$PhotoSetImage2Alt] == 'NULL') {
						$_SESSION['POST']['Error'][$PhotoSetImage2Alt] = 'Image 2 Alt must be set and cannot be NULL!';
						$_SESSION['POST']['FilteredInput'] = $hold['FilteredInput'];
						$AddPhotosPage = $Options['XhtmlPicture']['picture']['AddPhotosPage']['SettingAttribute'];
						header("Location: index.php?PageID=$AddPhotosPage&SessionID=$sessionname");
						exit;
					}
				}
				
				if ($_POST[$PhotoSetImage2Text] == 'Null' | $_POST[$PhotoSetImage2Text] == 'NULL') {
					$_POST[$PhotoSetImage2Text] = NULL;
					$hold['FilteredInput'][$PhotoSetImage2Text] = NULL;
				}
				
				if ($_POST[$PhotoSetImage2Alt] == 'Null' | $_POST[$PhotoSetImage2Alt] == 'NULL') {
					$_POST[$PhotoSetImage2Alt] = NULL;
					$hold['FilteredInput'][$PhotoSetImage2Alt] = NULL;
				}
				
				if ($_POST[$PhotoSetBottomText] == 'Null' | $_POST[$PhotoSetBottomText] == 'NULL') {
					$_POST[$PhotoSetBottomText] = NULL;
					$hold['FilteredInput'][$PhotoSetBottomText] = NULL;
				}
				
				if ($_POST[$PhotoSetOrder] == 'Null' | $_POST[$PhotoSetOrder] == 'NULL') {
					$_POST[$PhotoSetOrder] = NULL;
					$hold['FilteredInput'][$PhotoSetOrder] = NULL;
				}
				
				$i++;
				$PhotoSetHeading = "PhotoSet$i" . 'Heading';
				$PhotoSetTopText = "PhotoSet$i" . 'TopText';
				$PhotoSetImage1Src = "PhotoSet$i" . 'Image1Src';
				$PhotoSetImage1Text = "PhotoSet$i" . 'Image1Text';
				$PhotoSetImage1Alt = "PhotoSet$i" . 'Image1Alt';
				$PhotoSetImage2Src = "PhotoSet$i" . 'Image2Src';
				$PhotoSetImage2Text = "PhotoSet$i" . 'Image2Text';
				$PhotoSetImage2Alt = "PhotoSet$i" . 'Image2Alt';
				$PhotoSetBottomText = "PhotoSet$i" . 'BottomText';
				$PhotoSetOrder = "PhotoSet$i" . 'Order';
				
			}
			
			if ($_POST['BottomText'] == 'Null' | $_POST['BottomText'] == 'NULL') {
				$_POST['BottomText'] = NULL;
				$hold['FilteredInput']['BottomText'] = NULL;
			}
			
			if ($_POST['BottomHeading'] == 'Null' | $_POST['BottomHeading'] == 'NULL') {
				$_POST['BottomHeading'] = NULL;
				$hold['FilteredInput']['BottomHeading'] = NULL;
			}
			
			if ($_POST['MenuName'] == 'Null' | $_POST['MenuName'] == 'NULL') {
				$_POST['MenuName'] = NULL;
				$hold['FilteredInput']['MenuName'] = NULL;
			}
			
			if ($_POST['MenuTitle'] == 'Null' | $_POST['MenuTitle'] == 'NULL') {
				$_POST['MenuTitle'] = NULL;
				$hold['FilteredInput']['MenuTitle'] = NULL;
			}
			
			$_SESSION['POST']['Error']['Link'] = '<a href=\'';
			$_SESSION['POST']['Error']['Link'] .= $NewPage;
			$_SESSION['POST']['Error']['Link'] .= '\'>New Photos Page</a>';
			
			
			$temp = $hold['FilteredInput'];
			
			$i = 1;
			$PhotoSetHeading = "PhotoSet$i" . 'Heading';
			$PhotoSetTopText = "PhotoSet$i" . 'TopText';
			$PhotoSetImage1Src = "PhotoSet$i" . 'Image1Src';
			$PhotoSetImage1Text = "PhotoSet$i" . 'Image1Text';
			$PhotoSetImage1Alt = "PhotoSet$i" . 'Image1Alt';
			$PhotoSetImage2Src = "PhotoSet$i" . 'Image2Src';
			$PhotoSetImage2Text = "PhotoSet$i" . 'Image2Text';
			$PhotoSetImage2Alt = "PhotoSet$i" . 'Image2Alt';
			$PhotoSetBottomText = "PhotoSet$i" . 'BottomText';
			$PhotoSetOrder = "PhotoSet$i" . 'Order';
			
			while (isset($temp[$PhotoSetImage1Src])) {
				$temp[$i][$PhotoSetHeading] = $temp[$PhotoSetHeading];
				$temp[$i][$PhotoSetTopText] = $temp[$PhotoSetTopText];
				$temp[$i][$PhotoSetImage1Src] = $temp[$PhotoSetImage1Src];
				$temp[$i][$PhotoSetImage1Text] = $temp[$PhotoSetImage1Text];
				$temp[$i][$PhotoSetImage1Alt] = $temp[$PhotoSetImage1Alt];
				$temp[$i][$PhotoSetImage2Src] = $temp[$PhotoSetImage2Src];
				$temp[$i][$PhotoSetImage2Text] = $temp[$PhotoSetImage2Text];
				$temp[$i][$PhotoSetImage2Alt] = $temp[$PhotoSetImage2Alt];
				$temp[$i][$PhotoSetBottomText] = $temp[$PhotoSetBottomText];
				$temp[$i][$PhotoSetOrder] = $temp[$PhotoSetOrder];
				
				unset($temp[$PhotoSetHeading]);
				unset($temp[$PhotoSetTopText]);
				unset($temp[$PhotoSetImage1Src]);
				unset($temp[$PhotoSetImage1Text]);
				unset($temp[$PhotoSetImage1Alt]);
				unset($temp[$PhotoSetImage2Src]);
				unset($temp[$PhotoSetImage2Text]);
				unset($temp[$PhotoSetImage2Alt]);
				unset($temp[$PhotoSetBottomText]);
				unset($temp[$PhotoSetOrder]);
				
				$i++;
				$PhotoSetHeading = "PhotoSet$i" . 'Heading';
				$PhotoSetTopText = "PhotoSet$i" . 'TopText';
				$PhotoSetImage1Src = "PhotoSet$i" . 'Image1Src';
				$PhotoSetImage1Text = "PhotoSet$i" . 'Image1Text';
				$PhotoSetImage1Alt = "PhotoSet$i" . 'Image1Alt';
				$PhotoSetImage2Src = "PhotoSet$i" . 'Image2Src';
				$PhotoSetImage2Text = "PhotoSet$i" . 'Image2Text';
				$PhotoSetImage2Alt = "PhotoSet$i" . 'Image2Alt';
				$PhotoSetBottomText = "PhotoSet$i" . 'BottomText';
				$PhotoSetOrder = "PhotoSet$i" . 'Order';
			}
			
			foreach ($temp as $key => $value) {
				if (is_null($value)) {
					unset($temp[$key]);
				}
			}
			
			$newtemp = array();
			
			for ($i = 1; $temp[$i]; $i++) {
				$PhotoSetOrder = "PhotoSet$i" . 'Order';
				if ($temp[$i][$PhotoSetOrder] != $i && $temp[$i][$PhotoSetOrder]) {
					$index = $temp[$i][$PhotoSetOrder];
					while($newtemp[$index]) {
						$index++;
					}
					
					foreach ($temp[$i] as $key => $value) {
						$key = explode($i, $key);
						
						$key[0] .= $index;
						if ($i == 1 & $key[1] == 'Image') {
							$key[1] .= '1';
						}
						
						if ($i == 2 & $key[1] == 'Image') {
							$key[1] .= '2';
						}
						
						$key = implode($key);
						$newtemp[$index][$key] = $value;
					}
					
					unset($temp[$i]);
				} else if ($temp[$i]) {
					$index = $i;
					while($newtemp[$index]) {
						$index++;
					}
					
					foreach ($temp[$i] as $key => $value) {
						$key = explode($i, $key);
						$key[0] .= $index;
						$key = implode($key);
						$newtemp[$index][$key] = $value;
					}
					
					unset($temp[$i]);
				}
			}
			
			ksort($newtemp);
			
			$newtemp = array_combine(range(1, count($newtemp)), array_values($newtemp));
			
			for ($i = 1; $newtemp[$i]; $i++) {
				reset($newtemp[$i]);
				$name = key($newtemp[$i]);
				$name = str_replace('PhotoSet', '', $name);
				$name = str_replace('Heading', '', $name); 
				$number = $name;
				foreach ($newtemp[$i] as $key => $value) {
					if ($number != $i) {
						$key2 = str_replace($number, $i, $key);
						$newtemp[$i][$key2] = $value;
						unset($newtemp[$i][$key]);
					}
				}
			}
			
			for ($i = 1; $newtemp[$i]; $i++) {
				foreach ($newtemp[$i] as $key => $value) {
					$temp[$key] = $value;
				}
			}
			
			foreach ($_POST as $key => $value) {
				if ($value != NULL) {
					$_POST[$key] == NULL;
				}
			}
			
			foreach ($hold['FilteredInput'] as $key => $value) {
				if ($value != NULL) {
					$hold['FilteredInput'][$key] == NULL;
				}
			}
			
			foreach ($temp as $key => $value) {
				$_POST[$key] = $value;
				$hold['FilteredInput'][$key] = $value;
			}
			
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
			
			$Header = array();
			$Header['PageID'] = $NewPageID;
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
			
			$ContentLayerVersion = array();
			$ContentLayerVersion['PageID'] = $NewPageID;
			$ContentLayerVersion['RevisionID'] = $NewRevisionID;
			$ContentLayerVersion['CurrentVersion'] = 'true';
			$ContentLayerVersion['ContentPageType'] = 'PhotosPage';
			$ContentLayerVersion['ContentPageMenuName'] = $hold['FilteredInput']['MenuName'];
			$ContentLayerVersion['ContentPageMenuTitle'] = $hold['FilteredInput']['MenuTitle'];
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
			
			$ContentLayer[1]['PageID'] = $NewPageID;
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
			
			$ContentLayer[2]['PageID'] = $NewPageID;
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
			
			$ContentLayer[3]['PageID'] = $NewPageID;
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
			
			$ContentLayer[4]['PageID'] = $NewPageID;
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
			
			$ContentLayer[5]['PageID'] = $NewPageID;
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
			
			$ContentLayer[6]['PageID'] = $NewPageID;
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
			
			$ContentLayer[7]['PageID'] = $NewPageID;
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
			
			$ContentLayer[8]['PageID'] = $NewPageID;
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
			
			$ContentLayer[9]['PageID'] = $NewPageID;
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
			
			$ContentLayer[10]['PageID'] = $NewPageID;
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
			
			$ContentLayer[11]['PageID'] = $NewPageID;
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
			
			$ContentLayer[12]['PageID'] = $NewPageID;
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
			
			$_POST['Priority'] = $_POST['Priority'] / 10;
			$Sitemap = array();
			//$Sitemap['PageID'] = $NewPageID;
			//$Sitemap['Loc'] = $Location;
			$Sitemap['Lastmod'] = $Date;
			$Sitemap['ChangeFreq'] = $_POST['Frequency'];
			$Sitemap['Priority'] = $_POST['Priority'];
			//$Sitemap['Enable/Disable'] = $_POST['EnableDisable'];
			//$Sitemap['Status'] = $_POST['Status'];
			
			$ContentPrintPreview = array();
			//$ContentPrintPreview['PageID'] = $NewPageID;
			$ContentPrintPreview['PrintPageID1'] = $NewPageID;
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