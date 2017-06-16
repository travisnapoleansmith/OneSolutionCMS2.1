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
	
	if ($_SERVER['SUBDOMAIN_DOCUMENT_ROOT'] != NULL) {
		$HOME = $_SERVER['SUBDOMAIN_DOCUMENT_ROOT'];
	} else {
		if ($_SERVER['REAL_DOCUMENT_ROOT'] != NULL) {
			$_SERVER['SUBDOMAIN_DOCUMENT_ROOT'] = $_SERVER['REAL_DOCUMENT_ROOT'];
			$HOME = $_SERVER['SUBDOMAIN_DOCUMENT_ROOT'];
		} else {
			$HOME = NULL;
		}
	}
	
	$HOME = $_SERVER['SUBDOMAIN_DOCUMENT_ROOT'];
	$ADMINHOME = $HOME . '/Administrators/';
	$GLOBALS['HOME'] = $HOME;
	$GLOBALS['ADMINHOME'] = $ADMINHOME;

	require_once ("$ADMINHOME/Configuration/includes.php");

	$sessionname = $Tier6Databases->SessionStart('UpdateTablePage');

	$Options = $Tier6Databases->getLayerModuleSetting();

	$XhtmlTableName = $Options['XhtmlTable']['table']['XhtmlTableName']['SettingAttribute'];
	
	$hold = $_POST['TablesPage'];
	$hold = explode(' ', $hold);
	$SelectedPageID = $hold[2];
	$TableID = $hold[0];
	
	$_SESSION['POST']['FilteredInput']['PageID'] = $SelectedPageID;
	$_SESSION['POST']['FilteredInput']['FormOptionID'] = $TableID;
	
	$PageID = array();
	$PageID['PageID'] = $SelectedPageID;
	$PageID['CurrentVersion'] = 'true';
	
	$TableSelectedPageID = array();
	$TableSelectedPageID['PageID'] = $SelectedPageID;
	$TableSelectedPageID['XhtmlTableName'] = $XhtmlTableName;
	$TableSelectedPageID['CurrentVersion'] = 'true';
		
	$TableTemp = $Tier6Databases->getRecord($TableSelectedPageID, 'XhtmlTableLookup', TRUE, array());
	
	$Table = array();

	foreach ($TableTemp as $Key => $Value) {
		if ($Value['ObjectID'] != NULL) {
			$Table[$Value['ObjectID']] = $Value;
		}
	}
	
	$Image = $Tier6Databases->getRecord($PageID, 'Picture', TRUE, array());
	$Content = $Tier6Databases->getRecord($PageID, 'Content', TRUE, array());
	$Header = $Tier6Databases->getRecord($PageID, 'PageAttributes', TRUE, array());;
	$ContentLayerVersion = $Tier6Databases->getRecord($PageID, 'ContentLayerVersion', TRUE, array());
	
	$_SESSION['POST']['FilteredInput']['SessionID'] = $sessionname;
	$_SESSION['POST']['FilteredInput']['RevisionID'] = $ContentLayerVersion[0]['RevisionID'];
	//$_SESSION['POST']['FilteredInput']['MenuObjectID'] = $ContentLayerVersion[0]['ContentPageMenuObjectID'];
	//$_SESSION['POST']['FilteredInput']['CreationDateTime'] = $ContentLayerVersion[0]['CreationDateTime'];
	//$_SESSION['POST']['FilteredInput']['Owner'] = $ContentLayerVersion[0]['Owner'];
	//$_SESSION['POST']['FilteredInput']['UserAccessGroup'] = $ContentLayerVersion[0]['UserAccessGroup'];
	
	unset($PageID['CurrentVersion']);
	$HeaderPanel1 = $Tier6Databases->getRecord($PageID, 'HeaderPanel1', TRUE, array());
	
	$Sitemap = $Tier6Databases->getRecord($PageID, 'XMLSitemap', TRUE, array());
	//$ContentPrintPreview = $Tier6Databases->getRecord($PageID, 'ContentPrintPreview', TRUE, array());
	
	$hold = array();
	$hold['PageID'] = 1;
	$hold['ObjectID'] = $SelectedPageID;
	//$MainMenuItemLookup = $Tier6Databases->getRecord($hold, 'MainMenuItemLookup', TRUE, array()); 
	
	$UpdateTablesPageSelect = $Options['XhtmlTable']['table']['TableContentUpdateSelectPage']['SettingAttribute'];
	$hold = array();
	$hold['PageID'] = $UpdateTablesPageSelect;
	//$FormSelect = $Tier6Databases->getRecord($hold, 'AdministratorFormSelect', TRUE, array());
	$FormOptionTemp = $Tier6Databases->getRecord($hold, 'AdministratorFormOption', TRUE, array());
	
	$FormOption = array();
	foreach ($FormOptionTemp as $Key => $Value) {
		if ($Value['ObjectID'] != NULL) {
			$ObjectID = $Value['ObjectID'];
			$FormOption[$ObjectID] = $Value;
		}
	}
	
	$hold = array();
	$hold['Tag'] = 'h1';
	$hold['Content'] = $HeaderPanel1[1]['Div1'];
	$HeaderName = $Tier6Databases->ModulePass('XhtmlMenu', 'headerpanel1', 'removeTag', $hold);
	
	$_SESSION['POST']['FilteredInput']['PageTitle'] = $Header[0]['PageTitle'];
	
	if ($Header[0]['MetaNameContent1']) {
		$_SESSION['POST']['FilteredInput']['Keywords'] = $Header[0]['MetaNameContent1'];
	} else {
		$_SESSION['POST']['FilteredInput']['Keywords'] = 'NULL';
	}
	if ($Header[0]['MetaNameContent2']) {
		$_SESSION['POST']['FilteredInput']['Description'] = $Header[0]['MetaNameContent2'];
	} else {
		$_SESSION['POST']['FilteredInput']['Description'] = 'NULL';
	}
	
	$_SESSION['POST']['FilteredInput']['Header'] = $HeaderName;
	
	$_SESSION['POST']['FilteredInput']['Priority'] = $Sitemap[0]['Priority'];
	$_SESSION['POST']['FilteredInput']['Frequency'] = ucfirst($Sitemap[0]['ChangeFreq']);

	$_SESSION['POST']['FilteredInput']['MenuName'] = $ContentLayerVersion[0]['ContentPageMenuName'];
	$_SESSION['POST']['FilteredInput']['MenuTitle'] = $ContentLayerVersion[0]['ContentPageMenuTitle'];

	$_SESSION['POST']['FilteredInput']['EnableDisable'] = 'Enable';
	$_SESSION['POST']['FilteredInput']['Status'] = 'Approved';
	
	$Post = array();
	
	$i = 0;
	
	$Count = count($Content);
	
	if ($Count > 2) {
		$i = 1;
		$TableSetHeading = "Table$i" . '_Heading';
		$TableSetTopText = "Table$i" . '_TopText';
		$TableSetImage1Src = "Table$i" . '_Image1Src';
		$TableSetImage1Text = "Table$i" . '_Image1Text';
		$TableSetImage1Alt = "Table$i" . '_Image1Alt';
		$TableSetImage2Src = "Table$i" . '_Image2Src';
		$TableSetImage2Text = "Table$i" . '_Image2Text';
		$TableSetImage2Alt = "Table$i" . '_Image2Alt';
		$TableSetBottomText = "Table$i" . '_BottomText';
		$TableSetTableName = "Table$i" . '_Name';
		
		$Count = count($Content);
		$j = NULL;
		for ($j = 1; $j < $Count; $j++) {
			$Record = $Content[$j];
			if ($Record['Heading'] != NULL) {
				$Post[$TableSetHeading] = $Record['Heading'];
			} else {
				$Post[$TableSetHeading] = 'NULL';
			}
			
			if ($Record['Content'] != NULL) {
				if ($Record['Content'] !== "<br />/n<hr />/n<br />") {
					$Post[$TableSetTopText] = $Record['Content'];
				} else {
					continue;
				}
			} else {
				$Post[$TableSetTopText] = 'NULL';
			}
			
			if ($Record['Heading'] || $Record['Content']) {
				if ($Record['Content'] !== "<br />/n<hr />/n<br />") {
					$j++;
					$Record = $Content[$j];
				} else {
					continue;
				}
			}
			
			if ($Record['StartTag'] == '<div>') {
				$j++;
				$Record = $Content[$j];
			}
			
			if ($Record['ContainerObjectType'] == 'XhtmlPicture') {
				$id = $Record['ContainerObjectID'];
				$id--;
				$Picture = $Image[$id];
	
				if ($Picture['PictureLink'] != NULL) {
					$Post[$TableSetImage1Src] = $Picture['PictureLink'];
				} else {
					$Post[$TableSetImage1Src] = 'NULL';
				}
	
				if ($Picture['PictureAltText'] != NULL) {
					$Post[$TableSetImage1Alt] = $Picture['PictureAltText'];
				} else {
					$Post[$TableSetImage1Alt] = 'NULL';
				}
	
				$j++;
				$Record = $Content[$j];
	
				if ($Record['Content'] != NULL) {
					if ($Record['Content'] !== "<br />/n<hr />/n<br />") {
						$Post[$TableSetImage1Text] = $Record['Content'];
					} else {
						continue;
					}
				} else {
					$Post[$TableSetImage1Text] = 'NULL';
				}
				$j++;
				$Record = $Content[$j];
			}
			
			if ($Record['ContainerObjectType'] == 'XhtmlPicture') {
				$id = $Record['ContainerObjectID'];
				$id--;
				$Picture = $Image[$id];
				if ($Picture['PictureLink'] != NULL) {
					$Post[$TableSetImage2Src] = $Picture['PictureLink'];
				} else {
					$Post[$TableSetImage2Src] = 'NULL';
				}
	
				if ($Picture['PictureAltText'] != NULL) {
					$Post[$TableSetImage2Alt] = $Picture['PictureAltText'];
				} else {
					$Post[$TableSetImage2Alt] = 'NULL';
				}
	
				$j++;
				$Record = $Content[$j];
	
				if ($Record['Content'] != NULL) {
					if ($Record['Content'] !== "<br />/n<hr />/n<br />") {
						$Post[$TableSetImage2Text] = $Record['Content'];
					} else {
						continue;
					}
				} else {
					$Post[$TableSetImage2Text] = 'NULL';
				}
				$j++;
				$Record = $Content[$j];
			}
			
			if ($Record['EndTag'] == '</div>') {
				if ($Record['ContainerObjectType'] == 'XhtmlContent') {
					if ($Record['Content'] != NULL) {
						if ($Record['Content'] !== "<br />/n<hr />/n<br />") {
							$Post[$TableSetBottomText] = $Record['Content'];
						} else {
							continue;
						}
					} else {
						$Post[$TableSetBottomText] = 'NULL';
					}
				}
				$j++;
				$Record = $Content[$j];
			}
						
			if ($Record['ContainerObjectType'] == 'XhtmlTable') {
				$ObjectID = $Record['ContainerObjectID'];
				
				$TableRecord = $Table[$ObjectID];
				
				$TableID = $TableRecord['TableID'];
				
				$Text = $FormOption[$TableID]['FormOptionText'];
				$Post[$TableSetTableName] = $Text;
				$j++;
				$Record = $Content[$j];
				$i++;
				
			}
			if ($Record['Heading'] === NULL & $Record['Content'] !== NULL) {
				if ($Record['Content'] !== "<br />/n<hr />/n<br />") {
					$Post[$TableSetBottomText] = $Record['Content'];
				}
			} else {
				$Post[$TableSetBottomText] = "NULL";
			}
			$TableSetHeading = "Table$i" . '_Heading';
			$TableSetTopText = "Table$i" . '_TopText';
			$TableSetImage1Src = "Table$i" . '_Image1Src';
			$TableSetImage1Text = "Table$i" . '_Image1Text';
			$TableSetImage1Alt = "Table$i" . '_Image1Alt';
			$TableSetImage2Src = "Table$i" . '_Image2Src';
			$TableSetImage2Text = "Table$i" . '_Image2Text';
			$TableSetImage2Alt = "Table$i" . '_Image2Alt';
			$TableSetBottomText = "Table$i" . '_BottomText';
			$TableSetTableName = "Table$i" . '_Name';
		}
	}
	
	$Table = array();
	$TempTable = array();
	
	if ($Post != NULL) {
		foreach ($Post as $Key => $Value) {
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
	
	$FileLocation = 'TEMPFILES/';
	
	$FileName = $FileLocation . $sessionname . '.xml';
	$FileDataForm = $Table;
	$ElementName = 'Table';
	
	$Tier6Databases->ProcessFormXMLFile($FileName, $FileDataForm, $ElementName);
	
	$UpdateTablesPage = $Options['XhtmlTable']['table']['TablePageUpdatePage']['SettingAttribute'];
	
	header("Location: $UpdateTablesPage&SessionID=$sessionname");
	exit;
?>