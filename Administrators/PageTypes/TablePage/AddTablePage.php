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
	
	set_time_limit(120);
	
	$ReferPage = $_SERVER['HTTP_REFERER'];
	$ReferPageIDArray = explode('?', $ReferPage);
	unset($ReferPageIDArray[0]);
	$ReferPageIDArray = implode('', $ReferPageIDArray);
	$ReferPageIDArray = explode('&', $ReferPageIDArray);
	$Key = array_search('PageID', $ReferPageIDArray);
	$ReferPageID = $ReferPageIDArray[$Key];
	
	if ($ReferPageID === 'PageID=210') {
		$LogPage = FALSE;
		
		if ($LogPage === TRUE) {
			$LogFile = "AddTablePage.txt";
			$LogFileHandle = fopen($LogFile, 'a');
			$FileInformation = 'Logging - Add Table Page Script Loading - ' . date("F j, Y, g:i a") . "\n";
			fwrite($LogFileHandle, $FileInformation);
			fwrite($LogFileHandle, print_r($_SERVER['HTTP_REFERER'], TRUE));
			fwrite($LogFileHandle, "\n---------------------------------------------\n\n");
			fclose($LogFileHandle);
		}
	
		$HOME = $_SERVER['SUBDOMAIN_DOCUMENT_ROOT'];
		$ADMINHOME = $HOME . '/Administrators/';
		$GLOBALS['HOME'] = $HOME;
		$GLOBALS['ADMINHOME'] = $ADMINHOME;
	
		require_once ("$ADMINHOME/Configuration/includes.php");
		
		$Options = $Tier6Databases->getLayerModuleSetting();
		
		$XhtmlTableName = $Options['XhtmlTable']['table']['XhtmlTableName']['SettingAttribute'];
		
		$PageTitle = $_POST['PageTitle'];
		$Keywords = $_POST['Keywords'];
		$Description = $_POST['Description'];
		$Header = $_POST['Header'];
	
	
		$MenuName = $_POST['MenuName'];
		$MenuTitle = $_POST['MenuTitle'];
		$Priority = $_POST['Priority'];
		$Frequency = $_POST['Frequency'];
		$EnableDisable = $_POST['EnableDisable'];
		$Status = $_POST['Status'];
	
		$PageName = "../../index.php?PageID=";
		$PageName .= $_POST['AddTablePage'];
	
		$FileLocation = 'TEMPFILES/';
	
		$TempTable = array();
		$Table = array();
		$AddLookupData = array();
		
		foreach ($_POST as $Key => $Value) {
			if ($Key !== 'AddTablePage') {
				if (strstr($Key, "Table")) {
					$TempTable[$Key] = $Value;
					$AddLookupData[$Key] = $Value;
				}
			}
		}
	
		foreach ($TempTable as $Key => $Value) {
			$NewKey = explode('_', $Key);
			$TableName = $NewKey[0];
			$SubKey = $NewKey[1];
			$Table[$TableName][$SubKey] = $Value;
		}
	
		$hold = $Tier6Databases->FormSubmitValidate('AddTablePage', $PageName, $FileLocation, $Table, 'Table', $AddLookupData);
	
		if ($hold) {
			$sessionname = $Tier6Databases->SessionStart('CreateTablesPage');
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
			
			if ($LogPage === TRUE) {
				$LogFile = "AddTablePage.txt";
				$LogFileHandle = fopen($LogFile, 'a');
				$FileInformation = 'Logging - Add Table Page Top Script - ' . $NewPageID . ' - ' . date("F j, Y, g:i a") . "\n";
				fwrite($LogFileHandle, $FileInformation);
				//fwrite($LogFileHandle, print_r($ImageContent, TRUE));
				fwrite($LogFileHandle, "\n---------------------------------------------\n\n");
				fclose($LogFileHandle);
			}
			
			$LastTablesPage = $Options['XhtmlTable']['table']['LastTablesPage']['SettingAttribute'];
			$NewTablesPage = ++$LastTablesPage;
			$Tier6Databases->updateModuleSetting('XhtmlTable', 'table', 'LastTablesPage', $NewTablesPage);
			
			$NewPage = '../../../index.php?PageID=';
			$NewPage .= $NewPageID;
	
			$Location = 'index.php?PageID=';
			$Location .= $NewPageID;
	
			$NewRevisionID = 0;
	
			// POST Check For NULL Elements
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
			
			$temp = $Tier6Databases->MultiPostCheck('Table', 1, $hold, '_', NULL, 'Heading');
			if ($temp != NULL) {
				$hold = $temp;
			}
			
			$temp = $Tier6Databases->MultiPostCheck('Table', 1, $hold, '_', NULL, 'TopText');
			if ($temp != NULL) {
				$hold = $temp;
			}
			
			
			$temp = $Tier6Databases->MultiPostCheck('Table', 1, $hold, '_', NULL, 'Image1Src');
			if ($temp != NULL) {
				$hold = $temp;
			}
			
			$temp = $Tier6Databases->MultiPostCheck('Table', 1, $hold, '_', NULL, 'Image1Text');
			if ($temp != NULL) {
				$hold = $temp;
			}
			
			$temp = $Tier6Databases->MultiPostCheck('Table', 1, $hold, '_', NULL, 'Image1Alt');
			if ($temp != NULL) {
				$hold = $temp;
			}
			
			$temp = $Tier6Databases->MultiPostCheck('Table', 1, $hold, '_', NULL, 'Image2Src');
			if ($temp != NULL) {
				$hold = $temp;
			}
			
			$temp = $Tier6Databases->MultiPostCheck('Table', 1, $hold, '_', NULL, 'Image2Text');
			if ($temp != NULL) {
				$hold = $temp;
			}
			
			$temp = $Tier6Databases->MultiPostCheck('Table', 1, $hold, '_', NULL, 'Image2Alt');
			if ($temp != NULL) {
				$hold = $temp;
			}
			
			$temp = $Tier6Databases->MultiPostCheck('Table', 1, $hold, '_', NULL, 'BottomText');
			if ($temp != NULL) {
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
			
			// Table Data
			$Table = array();
			$TempTable = array();
			
			foreach ($_POST as $Key => $Value) {
				if ($Key !== 'AddTablePage') {
					if (strstr($Key, "Table")) {
						$TempTable[$Key] = $Value;
					}
				}
			}
		
			foreach ($TempTable as $Key => $Value) {
				$NewKey = explode('_', $Key);
				$TableName = $NewKey[0];
				$SubKey = $NewKey[1];
				$Table[$TableName][$SubKey] = $Value;
			}
	
			// General Defines
			define(NewPageID, $NewPageID);
			define(CurrentVersionTrueFalse, 'true');
			define(ContentPageType, 'TablesPage');
	
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
			if ($hold['FilteredInput']['Header'] != NULL) {
				$Content[$i]['Heading'] = $hold['FilteredInput']['Header'];
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
	
			$k = $i;
			$k++;
	
			$PictureID = 1;
			$TableID = 1;
			$Image = array();
			$TableLookup = array();
			
			if ($Table !== NULL) {
				foreach($Table as $Key => $Value) {
					if ($Value !== NULL) {
						// Heading and TopText
						if ($Value['Heading'] !== NULL || $Value['TopText'] !== NULL){
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
							if ($Value['Heading'] !== NULL) {
								$Content[$i]['Heading'] = $Value['Heading'];
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
	
							if ($Value['TopText'] !== NULL) {
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
							$k++;
						}
						
						// Image 1 and 2
						if ($Value['Image1Src'] != NULL | $Value['Image1Alt'] | $Value['Image1Text']) {
							$NewObjectID = 1;
	
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
							
							if ($Value['Image1Src'] != NULL) {
								$Image[$PictureID]['PageID'] = $NewPageID;
								$Image[$PictureID]['ObjectID'] = $PictureID;
								$Image[$PictureID]['RevisionID'] = $NewRevisionID;
								$Image[$PictureID]['CurrentVersion'] = 'true';
								$Image[$PictureID]['StartTag'] = '<div>';
								$Image[$PictureID]['EndTag'] = NULL;
								$Image[$PictureID]['StartTagID'] = NULL;
								$Image[$PictureID]['StartTagStyle'] = NULL;
								
								if ($Value['Image2Src'] != NULL) {
									$Image[$PictureID]['StartTagClass'] = 'PictureLeft';
								} else {
									$Image[$PictureID]['StartTagClass'] = 'PictureCenter';
								}
	
								$Image[$PictureID]['PictureID'] = NULL;
								$Image[$PictureID]['PictureClass'] = NULL;
								$Image[$PictureID]['PictureStyle'] = NULL;
								$Image[$PictureID]['PictureLink'] = $Value['Image1Src'];
								$Image[$PictureID]['PictureAltText'] = $Value['Image1Alt'];
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
							if ($Value['Image1Text'] != NULL) {
								$Content[$i]['Content'] = $Value['Image1Text'];
								$Content[$i]['ContentStartTag'] = '<p>';
								$Content[$i]['ContentEndTag'] = '</p>';
								$Content[$i]['ContentStartTagID'] = NULL;
								$Content[$i]['ContentStartTagStyle'] = NULL;
								if ($Value['Image2Src'] != NULL) {
									$Content[$i]['ContentStartTagClass'] = 'BodyText TextSideLeft';
								} else {
									$Content[$i]['ContentStartTagClass'] = 'BodyText TextSideCenter';
								}
								$Content[$i]['ContentPTagID'] = NULL;
								$Content[$i]['ContentPTagStyle'] = NULL;
								if ($Value['Image2Src'] != NULL) {
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
	
						if ($Value['Image2Src'] != NULL | $Value['Image2Alt'] | $Value['Image2Text']) {
							if ($Value['Image2Src'] != NULL) {
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
								$Image[$PictureID]['PictureLink'] = $Value['Image2Src'];
								$Image[$PictureID]['PictureAltText'] = $Value['Image2Alt'];
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
								if ($Value['Image2Text'] != NULL) {
									$Content[$i]['Content'] = $Value['Image2Text'];
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
	
						if ($Value['Image1Src'] != NULL | $Value['Image1Alt'] | $Value['Image1Text']) {
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
						}
						
						
						// XhtmlTable
							if ($Value['Name'] !== NULL) {
								$LookupID = $Value['Name'];
								$LookupID = explode('-', $LookupID);
								$TableRecordID = $LookupID[0];
								
								$NewObjectID = $TableID;
		
								$Content[$i]['PageID'] = $NewPageID;
								$Content[$i]['ObjectID'] = $i;
								$Content[$i]['ContainerObjectType'] = 'XhtmlTable';
								$Content[$i]['ContainerObjectName'] = 'table';
								$Content[$i]['ContainerObjectID'] = $NewObjectID;
								$Content[$i]['ContainerObjectPrintPreview'] = 'true';
								$Content[$i]['RevisionID'] = $NewRevisionID;
								$Content[$i]['CurrentVersion'] = 'true';
								$Content[$i]['Empty'] = 'false';
								$Content[$i]['StartTag'] = NULL;
								$Content[$i]['EndTag'] = NULL;
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
								
								$TableLookup[$TableID]['PageID'] = $NewPageID;
								$TableLookup[$TableID]['ObjectID'] = $TableID;
								$TableLookup[$TableID]['RevisionID'] = $NewRevisionID;
								$TableLookup[$TableID]['CurrentVersion'] = 'true';
								$TableLookup[$TableID]['XhtmlTableName'] = $XhtmlTableName;
								$TableLookup[$TableID]['TableID'] = $TableRecordID;
								$TableLookup[$TableID]['Enable/Disable'] = 'Enable';
								$TableLookup[$TableID]['Status'] = 'Approved';	
								
								$TableID++;
								$i++;
								$k++;
							}
								
							// BottomText
							if ($Value['BottomText'] !== NULL) {
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
		
								$Content[$i]['Heading'] = NULL;
								$Content[$i]['HeadingStartTag'] = NULL;
								$Content[$i]['HeadingEndTag'] = NULL;
								$Content[$i]['HeadingStartTagID'] = NULL;
								$Content[$i]['HeadingStartTagStyle'] = NULL;
								$Content[$i]['HeadingStartTagClass'] = NULL;
		
								$Content[$i]['Content'] = $Value['BottomText'];
								$Content[$i]['ContentStartTag'] = '<p>';
								$Content[$i]['ContentEndTag'] = '</p>';
								$Content[$i]['ContentStartTagID'] = NULL;
								$Content[$i]['ContentStartTagStyle'] = NULL;
								$Content[$i]['ContentStartTagClass'] = 'BodyText';
								$Content[$i]['ContentPTagID'] = NULL;
								$Content[$i]['ContentPTagStyle'] = NULL;
								$Content[$i]['ContentPTagClass'] = 'BodyText';
		
								$Content[$i]['Enable/Disable'] = $_POST['EnableDisable'];
								$Content[$i]['Status'] = $_POST['Status'];
								$i++;
								$k++;
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
							$Content[$i]['EndTag'] = NULL;
							$Content[$i]['StartTagID'] = NULL;
							$Content[$i]['StartTagStyle'] = NULL;
							$Content[$i]['StartTagClass'] = NULL;
							$Content[$i]['Heading'] = NULL;
							$Content[$i]['HeadingStartTag'] = NULL;
							$Content[$i]['HeadingEndTag'] = NULL;
							$Content[$i]['HeadingStartTagID'] = NULL;
							$Content[$i]['HeadingStartTagStyle'] = NULL;
							$Content[$i]['HeadingStartTagClass'] = NULL;
							$Content[$i]['Content'] = "<br />/n<hr />/n<br />";
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
					}
				}
			}
			
			if ($i != 1) {
				$i--;
				$k--;
				unset($Content[$i]);
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
	
			$Header = parse_ini_file('../../ModuleSettings/Tier6-ContentLayer/Modules/XhtmlHeader/AddXhtmlHeader.ini',FALSE);
			$Header = $Tier6Databases->EmptyStringToNullArray($Header);
	
			$HeaderPanel1 = parse_ini_file('../../ModuleSettings/Tier6-ContentLayer/Modules/XhtmlMenu/AddHeaderPanel1.ini',TRUE);
			$HeaderPanel1 = $Tier6Databases->EmptyStringToNullArray($HeaderPanel1);
	
			$ContentLayerVersion = parse_ini_file('../../ModuleSettings/Tier6-ContentLayer/GlobalSettings/AddContentLayerVersion.ini',FALSE);
			$ContentLayerVersion = $Tier6Databases->EmptyStringToNullArray($ContentLayerVersion);
	
			//$ContentLayer = parse_ini_file('../../ModuleSettings/Tier6-ContentLayer/GlobalSettings/AddContentLayer.ini',TRUE);
			//$ContentLayer = $Tier6Databases->EmptyStringToNullArray($ContentLayer);
	
			$_POST['Priority'] = $_POST['Priority'] / 10;
	
			$Sitemap = parse_ini_file('../../ModuleSettings/Tier6-ContentLayer/Modules/XmlSitemap/AddXmlSitemap.ini',FALSE);
			$Sitemap = $Tier6Databases->EmptyStringToNullArray($Sitemap);
	
			$ContentPrintPreview = parse_ini_file('../../ModuleSettings/Tier6-ContentLayer/Modules/XhtmlContent/AddPrintPreview.ini',FALSE);
			$ContentPrintPreview = $Tier6Databases->EmptyStringToNullArray($ContentPrintPreview);
	
			$MainMenuItemLookup = parse_ini_file('../../ModuleSettings/Tier6-ContentLayer/Modules/XhtmlMainMenu/AddMainMenuItemLookup.ini',FALSE);
			$MainMenuItemLookup = $Tier6Databases->EmptyStringToNullArray($MainMenuItemLookup);
	
			$UpdateTablesPageSelect = $Options['XhtmlTable']['table']['TablePageUpdateSelectPage']['SettingAttribute'];
			$FormSelect = array();
			$FormSelect['PageID'] = $UpdateTablesPageSelect;
			$FormSelect['ObjectID'] = $NewTablesPage;
			$FormSelect['StopObjectID'] = 9999;
			$FormSelect['ContinueObjectID'] = NULL;
			$FormSelect['ContainerObjectType'] = 'Option';
			$FormSelect['ContainerObjectTypeName'] = 'AdministratorFormOption';
			$FormSelect['ContainerObjectID'] = $NewTablesPage;
			$FormSelect['FormSelectDisabled'] = NULL;
			$FormSelect['FormSelectMultiple'] = NULL;
			$FormSelect['FormSelectName'] = 'TablesPage';
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
			$FormSelect['FormSelectStyle'] = 'width: 550px;';
			$FormSelect['FormSelectTabIndex'] = NULL;
			$FormSelect['FormSelectTitle'] = NULL;
			$FormSelect['FormSelectXMLLang'] = 'en-us';
			$FormSelect['Enable/Disable'] = 'Enable';
			$FormSelect['Status'] = 'Approved';
	
			$FormOptionText = $hold['FilteredInput']['PageTitle'];
			$FormOptionValue = $NewTablesPage;
			$FormOptionValue .= ' - ';
			$FormOptionValue .= $NewPageID;
			
			$FormOption = array();
			$FormOption['PageID'] = $UpdateTablesPageSelect;
			$FormOption['ObjectID'] = $NewTablesPage;
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
			
			$FormOptionArray = array();
			$FormSelectionArray = array();
			
			if ($Image != NULL) {
				foreach ($Image as $Key => $Value) {
					$Tier6Databases->ModulePass('XhtmlPicture', 'picture', 'createPicture', $Image[$Key]);
				}
			}
			
			if ($TableLookup != NULL) {
				$Tier6Databases->ModulePass('XhtmlTable', 'table', 'createTable', array('Content' => $TableLookup, 'TableName' => 'XhtmlTableLookup'));
			}
			
			$Tier6Databases->ModulePass('XhtmlContent', 'content', 'createContent', $Content);
			$Tier6Databases->ModulePass('XhtmlHeader', 'header', 'createHeader', $Header);
			$Tier6Databases->ModulePass('XhtmlMenu', 'headerpanel1', 'createMenu', $HeaderPanel1);
			$Tier6Databases->createContentVersion($ContentLayerVersion, 'ContentLayerVersion');
			$Tier6Databases->ModulePass('XhtmlContent', 'content', 'createContentPrintPreview', $ContentPrintPreview);
			////////$Tier6Databases->createContent($ContentLayer, 'ContentLayer');
	
			$Tier6Databases->ModulePass('XhtmlMainMenu', 'mainmenu', 'createMainMenuItemLookup', $MainMenuItemLookup);
	
			$Tier6Databases->ModulePass('XmlSitemap', 'sitemap', 'createSitemapItem', $Sitemap);
			
			$UpdateTablesPageSelect = $Options['XhtmlTable']['table']['TablePageUpdateSelectPage']['SettingAttribute'];
			$FormSelect['PageID'] = $UpdateTablesPageSelect;
			$FormOption['PageID'] = $UpdateTablesPageSelect;
			
			$FormOptionArray[] = $FormOption;
			$FormSelectionArray[] = $FormSelect;
			
			//$Tier6Databases->ModulePass('XhtmlForm', 'form', 'createFormOption', $FormOption);
			//$Tier6Databases->ModulePass('XhtmlForm', 'form', 'createFormSelect', $FormSelect);
			
			$DeleteTablesPage = $Options['XhtmlTable']['table']['TablePageDeleteSelectPage']['SettingAttribute'];
			$FormSelect['PageID'] = $DeleteTablesPage;
			$FormOption['PageID'] = $DeleteTablesPage;
			
			$FormOptionArray[] = $FormOption;
			$FormSelectionArray[] = $FormSelect;
			
			//$Tier6Databases->ModulePass('XhtmlForm', 'form', 'createFormOption', $FormOption);
			//$Tier6Databases->ModulePass('XhtmlForm', 'form', 'createFormSelect', $FormSelect);
			
			$EnableDisableStatusChangeTablesPage = $Options['XhtmlTable']['table']['TablePageEnableDisableSelectPage']['SettingAttribute'];
			$FormSelect['PageID'] = $EnableDisableStatusChangeTablesPage;
			$FormOption['PageID'] = $EnableDisableStatusChangeTablesPage;
			
			$FormOptionArray[] = $FormOption;
			$FormSelectionArray[] = $FormSelect;
			
			//$Tier6Databases->ModulePass('XhtmlForm', 'form', 'createFormOption', $FormOption);
			//$Tier6Databases->ModulePass('XhtmlForm', 'form', 'createFormSelect', $FormSelect);
			
			$FormOptionValue = $NewTablesPage;
			$FormOptionValue .= ' - ';
			$FormOptionValue .= $NewPageID;
			
			require('../../ModuleFormSubmissions/Tier6ContentLayer/Extended/XhtmlMainMenu/AddMainMenu.php');
			
			//$Tier6Databases->ModulePass('XhtmlForm', 'form', 'createFormSelect', $FormSelectionArray);
			//$Tier6Databases->ModulePass('XhtmlForm', 'form', 'createFormOption', $FormOptionArray);
			
			$sessionname = $Tier6Databases->SessionStart('AddedTablesPage');
	
			$Page = '../../../index.php?PageID=';
			$Page .= $NewPageID;
			
			$_SESSION['POST']['Error']['Link'] = '<a href=\'';
			$_SESSION['POST']['Error']['Link'] .= $Page;
			$_SESSION['POST']['Error']['Link'] .= '\'>Added Tables Page</a>';
			
			$TablesPageCreatedPage = $Options['XhtmlTable']['table']['TablePageCreatedPage']['SettingAttribute'];
			
			if ($LogPage === TRUE) {
				$LogFile = "AddTablePage.txt";
				$LogFileHandle = fopen($LogFile, 'a');
				$FileInformation = 'Logging - Add Table Page Bottom Script - ' . $NewPageID . ' - ' . date("F j, Y, g:i a") . "\n";
				fwrite($LogFileHandle, $FileInformation);
				fwrite($LogFileHandle, print_r($TablesPageCreatedPage, TRUE));
				fwrite($LogFileHandle, "\n---------------------------------------------\n\n");
				fclose($LogFileHandle);
			}
			
			header("Location: $TablesPageCreatedPage&SessionID=$sessionname");
			exit;
		} else {
			//print "I DID NOT MAKE IT\n";
		}
	} else {
		header("Location: ../../index.php");
		exit;
	}
?>