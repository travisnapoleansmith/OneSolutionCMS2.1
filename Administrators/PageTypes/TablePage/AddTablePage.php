<?php
	/*
	**************************************************************************************
	* One Solution CMS
	*
	* Copyright (c) 1999 - 2012 One Solution CMS
	*
	* This content management system is free software; you can redistribute it and/or
	* modify it under the terms of the GNU Lesser General Public
	* License as published by the Free Software Foundation; either
	* version 2.1 of the License, or (at your option) any later version.
	*
	* This library is distributed in the hope that it will be useful,
	* but WITHOUT ANY WARRANTY; without even the implied warranty of
	* MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU
	* Lesser General Public License for more details.
	*
	* You should have received a copy of the GNU Lesser General Public
	* License along with this library; if not, write to the Free Software
	* Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301  USA
	*
	* @copyright  Copyright (c) 1999 - 2013 One Solution CMS (http://www.onesolutioncms.com/)
	* @license    http://www.gnu.org/licenses/old-licenses/lgpl-2.1.txt	LGPL
	* @version    2.1.139, 2012-12-27
	*************************************************************************************
	*/

	$HOME = $_SERVER['SUBDOMAIN_DOCUMENT_ROOT'];
	$ADMINHOME = $HOME . '/Administrators/';
	$GLOBALS['HOME'] = $HOME;
	$GLOBALS['ADMINHOME'] = $ADMINHOME;

	require_once ("$ADMINHOME/Configuration/includes.php");

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

	foreach ($_COOKIE as $Key => $Value) {
		//print $Key . "\n";
		//print $Value . "\n";
		//print "-----------------\n";
		if (strstr($Key, "Table")) {
			setcookie($Key, $Value, time()-4800, '/');
		}
	}

	$TempTable = array();
	$Table = array();

	foreach ($_POST as $Key => $Value) {
		if ($Key !== 'AddTablePage') {
			if (strstr($Key, "Table")) {
				$TempTable[$Key] = $Value;
			}
		}
	}

	foreach ($TempTable as $Key => $Value) {
		setcookie($Key, $Value, time()+4800, '/');
		$NewKey = explode('_', $Key);
		$TableName = $NewKey[0];
		$SubKey = $NewKey[1];
		$Table[$TableName][$SubKey] = $Value;
	}
	
	$AddLookupData = array('TEST' => 1);
	
	print "TEST\n";
	
	$hold = $Tier6Databases->FormSubmitValidate('AddTablePage', $PageName, $FileLocation, $Table, 'Table', $AddLookupData);

	//if ($hold) {
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

		print "$NewPageID\n";

		$LastTablesPage = $Options['XhtmlTable']['table']['LastTablesPage']['SettingAttribute'];
		$NewTablesPage = ++$LastPhotosPage;
		/////$Tier6Databases->updateModuleSetting('XhtmlTable', 'table', 'LastTablesPage', $NewTablesPage);

		print "$LastTablesPage\n";
		print "$NewTablesPage\n";

		$NewPage = '../../../index.php?PageID=';
		$NewPage .= $NewPageID;

		$Location = 'index.php?PageID=';
		$Location .= $NewPageID;

		$NewRevisionID = 0;
		
		///var_dump($hold);
		
		/*
		// PUT POST CHECK IN HERE
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
		print "-----------------------\n";
		print_r($hold);
		print "=========================\n";
		*/
		
		// General Defines
		define(NewPageID, $NewPageID);
		define(CurrentVersionTrueFalse, 'true');
		define(ContentPageType, 'TablePage');

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

		$k = $i;
		$k++;
		
		$PictureID = 1;
		
		$Image = array();
		
		//print_r($Table);
		
		//print "----------------\n";
		
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
					}

					// Image 1 and 2
					if ($Value['Image1Src'] != NULL | $Value['Image1Alt'] | $Value['Image1Text']) {
						$i++;
						$k++;
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
							if ($Value['Image2']['Image2Src'] != NULL) {
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
						$k++;
					}
					

					// XhtmlTable
					if ($Value['Name'] !== NULL) {
						//$i++;
						//$k++;
						$hold = $Value['Name'];
						$hold = explode(' ', $hold);
						$NewObjectID = $hold[0];

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
						
						$i++;
						//$k++;
					}

					// BottomText
					if ($Value['BottomText'] !== NULL) {
						//$i++;
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
					}
					$i++;
					$k++;
				}
			}
		}
		//$i++;

		//$k = $i;
		//$k++;

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
		$Content[$i]['Content'] = NULL;
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


		$UpdateTablesPageSelect = $Options['XhtmlTables']['table']['UpdateTablesPageSelect']['SettingAttribute'];
		$FormSelect = array();
		$FormSelect['PageID'] = $UpdateTablesPageSelect;
		$FormSelect['ObjectID'] = $NewTablesPage;
		$FormSelect['StopObjectID'] = 9999;
		$FormSelect['ContinueObjectID'] = NULL;
		$FormSelect['ContainerObjectType'] = 'Option';
		$FormSelect['ContainerObjectTypeName'] = 'AdministratorFormOption';
		$FormSelect['ContainerObjectID'] = $NewPhotosPage;
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
		$FormSelect['FormSelectStyle'] = 'width: 245px;';
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

		//print_r($Header);
		//print_r($HeaderPanel1);
		//print_r($ContentLayerVersion);
		//print_r($Sitemap);
		//print_r($ContentPrintPreview);
		//print_r($MainMenuItemLookup);
		//print_r($FormSelect);
		//print_r($FormOption);
		
		//print_r($Image);
		///print_r($Content);
		////print_r($_POST);

		////print_r($TempTable);

		////print_r($Table);

		////print "I MADE IT\n";
	//} else {
		//print "I DID NOT MAKE IT\n";
	//}
?>