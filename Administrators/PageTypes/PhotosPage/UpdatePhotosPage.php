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

	$LogContentLayerVersion = TRUE;
	$LogImageContent = TRUE;

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

	if ($MenuObjectID === NULL) {
		$MenuObjectID = 1;
	}

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

			$NewPage = '../../../index.php?PageID=';
			$NewPage .= $PageID;

			$Location = '../../index.php?PageID=';
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

			// HeaderPanel1 Defines
			define (SiteName, $GLOBALS['sitename']);
			define (Header, $hold['FilteredInput']['Header']);

			$Image = array();

			$ImageContent = array();

			foreach ($hold['FilteredInput'] as $Key => $Value) {
				if (strstr($Key, "PhotoSet")) {
					$NewKey = str_replace('PhotoSet', '', $Key);
					$NewKey = str_replace('Heading', '', $NewKey);
					$NewKey = str_replace('TopText', '', $NewKey);
					$NewKey = str_replace('Image1Src', '', $NewKey);
					$NewKey = str_replace('Image1Text', '', $NewKey);
					$NewKey = str_replace('Image1Alt', '', $NewKey);
					$NewKey = str_replace('Image2Src', '', $NewKey);
					$NewKey = str_replace('Image2Text', '', $NewKey);
					$NewKey = str_replace('Image2Alt', '', $NewKey);
					$NewKey = str_replace('BottomText', '', $NewKey);
					$NewKey = str_replace('Order', '', $NewKey);

					$SecondKey = $Key;
					$SecondKey = str_replace('PhotoSet' . $NewKey, '', $SecondKey);

					if (strstr($Key, "Image1")) {
						$ImageContent[$NewKey]['Image1'][$SecondKey] = html_entity_decode($Value);
					} else if (strstr($Key, "Image2")) {
						$ImageContent[$NewKey]['Image2'][$SecondKey] = html_entity_decode($Value);
					} else {
						$ImageContent[$NewKey][$SecondKey] = html_entity_decode($Value);
					}
				}
			}

			$RemoveKeys = array();
			foreach ($ImageContent as $Key => $Content) {
				$Set = FALSE;
				foreach ($Content as $SubKey => $SubValue) {
					if ($SubKey == 'Image1' | $SubKey == 'Image2') {
						foreach ($SubValue as $SubSubKey => $SubSubValue) {
							if ($SubSubValue != NULL) {
								$Set = TRUE;
							}
						}
					} else if ($SubValue != NULL) {
						$Set = TRUE;
					}
				}

				if ($Set === FALSE) {
					array_push($RemoveKeys, $Key);
				}
			}

			//print_r($ImageContent);

			foreach ($RemoveKeys as $Key => $Value) {
				unset($ImageContent[$Value]);
			}

			ksort($ImageContent);

			$ImageContentNew = array();
			$ImageContentNoOrder = array();
			$ImageContentMove = array();

			$PopKey = array();
			foreach ($ImageContent as $Key => $Content) {
				if ($Key == $Content['Order']) {
					$ImageContentNew[$Key] = $Content;
					array_push($PopKey, $Key);
				} else if ($Content['Order'] == NULL) {
					$ImageContentNoOrder[$Key] = $Content;
					array_push($PopKey, $Key);
				} else {
					$ImageContentMove[$Key] = $Content;
					array_push($PopKey, $Key);
				}

			}
			foreach ($PopKey as $Value) {
				if ($Value != NULL) {
					unset($ImageContent[$Value]);
				}
			}

			$ImageContent = $ImageContentNew;
			unset($ImageContentNew);
			foreach ($ImageContentMove as $Key => $Content) {
				$Order = $Content['Order'];
				if (isset($ImageContent[$Order])) {
					array_push($ImageContent, $Content);
				} else {
					$ImageContent[$Order] = $Content;
				}
			}
			unset($ImageContentMove);

			foreach($ImageContentNoOrder as $Content) {
				array_push($ImageContent, $Content);
			}
			unset($ImageContentNoOrder);

			if ($LogImageContent === TRUE) {
				$LogFile = "ImageContentLog.txt";
				$LogFileHandle = fopen($LogFile, 'a');
				$FileInformation = 'Logging - Image Content Unchanged - ' . $PageID . ' - ' . date("F j, Y, g:i a") . "\n";
				fwrite($LogFileHandle, $FileInformation);
				fwrite($LogFileHandle, print_r($ImageContent, TRUE));
				fwrite($LogFileHandle, "\n---------------------------------------------\n\n");
				fclose($LogFileHandle);
			}

			ksort($ImageContent);

			if ($LogImageContent === TRUE) {
				$LogFile = "ImageContentLog.txt";
				$LogFileHandle = fopen($LogFile, 'a');
				$FileInformation = 'Logging - Image Content Changed - ' . $PageID . ' - ' . date("F j, Y, g:i a") . "\n";
				fwrite($LogFileHandle, $FileInformation);
				fwrite($LogFileHandle, print_r($ImageContent, TRUE));
				fwrite($LogFileHandle, "\n---------------------------------------------\n\n");
				fclose($LogFileHandle);
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

			foreach($ImageContent as $Key => $Value) {
				foreach ($Value as $SubKey => $SubValue) {
					if ($SubValue != NULL) {
						if ($SubKey == "Heading") {
							$k = $i;
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
							$Content[$i]['EndTag'] = NULL;
							$Content[$i]['StartTagID'] = NULL;
							$Content[$i]['StartTagStyle'] = NULL;
							$Content[$i]['StartTagClass'] = NULL;
							if ($SubValue != NULL) {
								$Content[$i]['Heading'] = $SubValue;
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

							if ($Value['TopText'] != NULL) {
								$Content[$i]['Content'] = $Value['TopText'];
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
						}

						if ($SubKey == 'Image1' & ($SubValue['Image1Src'] != NULL | $SubValue['Image1Alt'] | $SubValue['Image1Text'])) {
							$k = $i;
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
							if ($SubValue['Image1Src'] != NULL) {
								$Image[$PictureID]['PageID'] = $NewPageID;
								$Image[$PictureID]['ObjectID'] = $PictureID;
								$Image[$PictureID]['RevisionID'] = $NewRevisionID;
								$Image[$PictureID]['CurrentVersion'] = 'true';
								$Image[$PictureID]['StartTag'] = '<div>';
								$Image[$PictureID]['EndTag'] = NULL;
								$Image[$PictureID]['StartTagID'] = NULL;
								$Image[$PictureID]['StartTagStyle'] = NULL;
								if ($Value['Image2']['Image2Src'] != NULL) {
									$Image[$PictureID]['StartTagClass'] = 'PictureLeft';
								} else {
									$Image[$PictureID]['StartTagClass'] = 'PictureCenter';
								}

								$Image[$PictureID]['PictureID'] = NULL;
								$Image[$PictureID]['PictureClass'] = NULL;
								$Image[$PictureID]['PictureStyle'] = NULL;
								$Image[$PictureID]['PictureLink'] = $SubValue['Image1Src'];
								$Image[$PictureID]['PictureAltText'] = $SubValue['Image1Alt'];
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

								$PictureID++;
								$i++;
							}

							$k = $i;
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
							if ($SubValue['Image1Text'] != NULL) {
								$Content[$i]['Content'] = $SubValue['Image1Text'];
								$Content[$i]['ContentStartTag'] = '<p>';
								$Content[$i]['ContentEndTag'] = '</p>';
								$Content[$i]['ContentStartTagID'] = NULL;
								$Content[$i]['ContentStartTagStyle'] = NULL;
								if ($Value['Image2']['Image2Src'] != NULL) {
									$Content[$i]['ContentStartTagClass'] = 'BodyText TextSideLeft';
								} else {
									$Content[$i]['ContentStartTagClass'] = 'BodyText TextSideCenter';
								}
								$Content[$i]['ContentPTagID'] = NULL;
								$Content[$i]['ContentPTagStyle'] = NULL;
								if ($Value['Image2']['Image2Src'] != NULL) {
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

							$i++;
						}

						if ($SubKey == 'Image2') {
							if ($SubValue['Image2Src'] != NULL) {
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
								$Image[$PictureID]['PictureLink'] = $SubValue['Image2Src'];
								$Image[$PictureID]['PictureAltText'] = $SubValue['Image2Alt'];
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
								$PictureID++;

								$k = $i;
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
								if ($SubValue['Image2Text'] != NULL) {
									$Content[$i]['Content'] = $SubValue['Image2Text'];
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
								$i++;
							}
						}

					}

				}

				if ($Value['Image1']['Image1Src'] != NULL | $Value['Image1']['Image1Alt'] | $Value['Image1']['Image1Text']) {
					$k = $i;
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

					if ($Value['BottomText'] != NULL) {
						$Content[$i]['Content'] = $Value['BottomText'];
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
				}

			}

			$k = $i;
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

			$Header = parse_ini_file('../../ModuleSettings/Tier6-ContentLayer/Modules/XhtmlHeader/UpdateXhtmlHeader.ini',FALSE);
			$Header = $Tier6Databases->EmptyStringToNullArray($Header);

			$HeaderPanel1 = parse_ini_file('../../ModuleSettings/Tier6-ContentLayer/Modules/XhtmlMenu/UpdateHeaderPanel1.ini',TRUE);
			$HeaderPanel1 = $Tier6Databases->EmptyStringToNullArray($HeaderPanel1);

			$ContentLayerVersion = parse_ini_file('../../ModuleSettings/Tier6-ContentLayer/GlobalSettings/UpdateContentLayerVersion.ini',FALSE);
			$ContentLayerVersion = $Tier6Databases->EmptyStringToNullArray($ContentLayerVersion);

			//$ContentLayer = parse_ini_file('../../ModuleSettings/Tier6-ContentLayer/GlobalSettings/UpdateContentLayer.ini',TRUE);
			//$ContentLayer = $Tier6Databases->EmptyStringToNullArray($ContentLayer);

			$_POST['Priority'] = $_POST['Priority'] / 10;

			$Sitemap = parse_ini_file('../../ModuleSettings/Tier6-ContentLayer/Modules/XmlSitemap/UpdateXmlSitemap.ini',FALSE);
			$Sitemap = $Tier6Databases->EmptyStringToNullArray($Sitemap);

			$ContentPrintPreview = parse_ini_file('../../ModuleSettings/Tier6-ContentLayer/Modules/XhtmlContent/UpdatePrintPreview.ini',FALSE);
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
			//$Tier6Databases->updateContent($PageID, 'ContentLayer');

			reset($Image);
			while (current($Image)) {
				$Tier6Databases->ModulePass('XhtmlPicture', 'picture', 'createPicture', $Image[key($Image)]);
				next($Image);
			}
			$Tier6Databases->ModulePass('XhtmlContent', 'content', 'createContent', $Content);

			if ($LogContentLayerVersion === TRUE) {
				$LogFile = "ContentVersionLog.txt";
				$LogFileHandle = fopen($LogFile, 'a');
				$FileInformation = 'Logging - Content Layer Version - ' . date("F j, Y, g:i a") . "\n";
				//print_r($ContentLayerVersion, $FileContent);
				fwrite($LogFileHandle, $FileInformation);
				fwrite($LogFileHandle, print_r($ContentLayerVersion, TRUE));
				fwrite($LogFileHandle, "\n---------------------------------------------\n\n");
				fclose($LogFileHandle);
			}
			$Tier6Databases->createContentVersion($ContentLayerVersion, 'ContentLayerVersion');
			//$Tier6Databases->createContent($ContentLayer, 'ContentLayer');

			$Tier6Databases->SessionDestroy($sessionname);
			$sessionname = $Tier6Databases->SessionStart('UpdatedPhotosPage');

			$Page = '../../../index.php?PageID=';
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
		header("Location: ../../index.php?PageID=$UpdatePhotosPageSelect");
	}

?>