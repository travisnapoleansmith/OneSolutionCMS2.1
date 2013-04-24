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

	set_time_limit(60);
	$HOME = $_SERVER['SUBDOMAIN_DOCUMENT_ROOT'];
	$ADMINHOME = $HOME . '/Administrators/';
	$GLOBALS['HOME'] = $HOME;
	$GLOBALS['ADMINHOME'] = $ADMINHOME;
	
	require_once ("$ADMINHOME/Configuration/includes.php");
	$Options = $Tier6Databases->getLayerModuleSetting();

	$passarray = array();
	$passarray['CurrentVersion'] = 'true';

	$PageVersion = $Tier6Databases->getRecord($passarray, 'ContentLayerVersion', TRUE, array('1' => 'PageID'), 'ASC');

	$PageNumber = array();
	foreach ($PageVersion as $Value) {
		if ($Value['PageID'] != NULL) {
			array_push($PageNumber, $Value['PageID']);
		}
	}
	$PageVersion = array_combine($PageNumber, array_values($PageVersion));

	$passarray = array();
	$passarray['PageID'] = 1;

	$Menu = $Tier6Databases->getRecord($passarray, 'MainMenuItemLookup');

	$PageNumber = array();
	foreach ($Menu as $Value) {
		if ($Value['PageID'] != NULL) {
			array_push($PageNumber, $Value['ObjectID']);
		}
	}
	$Menu = array_combine($PageNumber, array_values($Menu));

	$hold = $_POST['TopMenuHidden'];
	$hold = explode(' ', $hold);
	$PageID = $hold[0];
	$LiParentID = $hold[2];
	$PageLocation = $hold[4];
	$LiPageID = $PageVersion[$PageID]['ContentPageMenuObjectID'];


	$CurrentMenu = $Menu[$PageID];
	$ParentPageID = $CurrentMenu['ParentObjectID'];

	$ParentMenu = $Menu [$ParentPageID];
	if ($ParentPageID == 1) {
		$search = array_search($PageID, $ParentMenu);
		$search = str_replace('Child','',$search);
		$CurrentIDName = 'MenuItem' . $search;
	} else if (!is_null($ParentPageID)) {
		$CurrentIDName = $CurrentMenu['ParentIDName'];
		$searcharray = explode('-', $CurrentIDName);
		$search = array_search($PageID, $ParentMenu);
		$search = str_replace('Child','',$search);
		array_pop($searcharray);
		array_push($searcharray, $search);

		$CurrentIDName = implode('-',$searcharray);
	} else {
		$CurrentIDName = NULL;
	}

	$CurrentMenu['ParentIDName'] = $CurrentIDName;

	$_POST['TopMenu'] = $PageVersion[$PageID]['ContentPageMenuTitle'];
	foreach ($_POST as $Key => $Value) {
		if (strstr($Key, 'MenuItem')) {
			$Temp = explode(' ', $Value);
			$Temp = $Temp[0];
			$NewKey = 'MenuItemLookup' . str_replace('MenuItem','', $Key);
			$_POST[$NewKey] = $Temp;
			$TempName = $PageVersion[$Temp]['ContentPageMenuTitle'];
			$_POST[$Key] = $TempName;
		}
	}

	$CurrentIDName = 'MenuItem';

	$ParentObjectID = $CurrentMenu['ParentObjectID'];
	$ChildChanges = array();
	foreach ($_POST as $ChangesKey => $ChangesValue) {
		if (strstr($ChangesKey, 'MenuItemLookup')) {
			$ChangesKey = str_replace('MenuItemLookup', 'Child', $ChangesKey);
			if ($ChangesValue == 'NULL') {
				$ChildChanges[$ChangesKey] = NULL;
			} else {
				$ChildChanges[$ChangesKey] = $ChangesValue;
			}
		}
	}

	$PageName = 'index.php?PageID=';
	$PageName .= $Options['XhtmlMainMenu']['mainmenu']['MainMenuUpdatePage']['SettingAttribute'];

	$returnvalue = $Tier6Databases->FormSubmitValidate('UpdateMenu', $PageName);

	$GlobalUpdateRecord = array();
	recursiveWalk($CurrentMenu, $ChildChanges, $CurrentIDName, $ParentObjectID, $Menu);

	if ($GlobalUpdateRecord != NULL) {
		foreach ($GlobalUpdateRecord as $UpdateRecord) {
			if (isset($UpdateRecord['ObjectID'])) {
				$CurrentDatabaseRecord = $Menu[$UpdateRecord['ObjectID']];
				$Difference = array_diff_assoc($CurrentDatabaseRecord, $UpdateRecord);
				if (!empty($Difference)) {
					foreach ($Difference as $Key => $Value) {
						if (strstr($Key, 'Child')) {
							if (!is_null($Value)) {
								$ModifyRecord = array();
								$ModifyRecord['PageID'] = 1;
								$ModifyRecord['ObjectID'] = $Value;
								$ModifyRecord['VersionID'] = 1;
								$ModifyRecord['RevisionID'] = 1;
								$ModifyRecord['ParentObjectID'] = NULL;
								$ModifyRecord['ParentIDName'] = NULL;
								$Tier6Databases->ModulePass('XhtmlMainMenu', 'mainmenu', 'updateMainMenuItemLookup', $ModifyRecord);
							} else if (!is_null($UpdateRecord[$Key])){
								$ModifyRecord = array();
								$ModifyRecord['PageID'] = 1;
								$ModifyRecord['ObjectID'] = $UpdateRecord[$Key];
								$ModifyRecord['VersionID'] = 1;
								$ModifyRecord['RevisionID'] = 1;
								$ModifyRecord['ParentObjectID'] = $UpdateRecord['ObjectID'];
								$ModifyRecord['ParentIDName'] = $UpdateRecord['ParentIDName'] . '-' . str_replace('Child', '', $Key);
								$Tier6Databases->ModulePass('XhtmlMainMenu', 'mainmenu', 'updateMainMenuItemLookup', $ModifyRecord);
							}
						}
					}
					$Tier6Databases->ModulePass('XhtmlMainMenu', 'mainmenu', 'updateMainMenuItemLookup', $UpdateRecord);

				}
			}
		}
	}

	$UlLiMenu = $Tier6Databases->getRecord($passarray, 'MainMenu');
	$StartTagIDParent = 'main-menu-middle';
	$UlClassParent = 'main-menu';
	$LiClassParent = 'menuparent MenuText MenuLi';

	$UlClassChild = 'mainmenuul';
	$UlID = 'submenu';
	$LiClassChild = 'menuparent MenuTextSub MenuLiSub MenuLiSubRoot';
	$LiClassLastChild = 'menuparent MenuTextSub MenuLiSub MenuLiSubRoot MenuLiSubFinal';

	$MenuChange = array();
	$MenuChange[1]['PageID'] = 1;
	$MenuChange[1]['ObjectID'] = 1;
	$MenuChange[1]['StartTag'] = '<div>';
	$MenuChange[1]['EndTag'] = '</div>';
	$MenuChange[1]['StartTagID'] = $StartTagIDParent;
	$MenuChange[1]['StartTagStyle'] = NULL;
	$MenuChange[1]['StartTagClass'] = NULL;
	$MenuChange[1]['Ul'] = NULL;
	$MenuChange[1]['UlClass'] = $UlClassParent;
	$MenuChange[1]['UlDir'] = NULL;
	$MenuChange[1]['UlID'] = 'menu';
	$MenuChange[1]['UlLang'] = NULL;
	$MenuChange[1]['UlStyle'] = NULL;
	$MenuChange[1]['UlTitle'] = NULL;
	$MenuChange[1]['UlXMLLang'] = NULL;

	$passarray = array();
	$passarray['PageID'] = 1;
	$Menu = $Tier6Databases->getRecord($passarray, 'MainMenuItemLookup');

	$PageNumber = array();
	foreach ($Menu as $Value) {
		if ($Value['PageID'] != NULL) {
			array_push($PageNumber, $Value['ObjectID']);
		}
	}
	$Menu = array_combine($PageNumber, array_values($Menu));

	$StartMenu = $Menu[1];

	$i = 2;
	if ($StartMenu != NULL) {
		foreach ($StartMenu as $Key => $Value) {
			if (strstr($Key, 'Child')) {
				$LiNumber = str_replace('Child', '', $Key);
				if (!is_null($Value)) {
					$MenuChange[1]['Li' . $LiNumber] = "<a href='index.php?PageID=" . $Value . "'>" . $PageVersion[$Value]['ContentPageMenuName'] . '</a>';
				} else {
					$MenuChange[1]['Li' . $LiNumber] = NULL;
				}

				$MenuChange[1]['Li' . $LiNumber . 'Class'] = $LiClassParent;
				$MenuChange[1]['Li' . $LiNumber . 'Dir'] = NULL;
				$MenuChange[1]['Li' . $LiNumber . 'ChildID'] = NULL;
				$MenuChange[1]['Li' . $LiNumber . 'ID'] = NULL;
				//$MenuChange[1]['Li' . $LiNumber . 'ID'] = 'MenuItem' . $LiNumber;
				$MenuChange[1]['Li' . $LiNumber . 'Lang'] = NULL;
				$MenuChange[1]['Li' . $LiNumber . 'Style'] = NULL;
				$MenuChange[1]['Li' . $LiNumber . 'Title'] = $PageVersion[$Value]['ContentPageMenuTitle'];
				$MenuChange[1]['Li' . $LiNumber . 'XMLLang'] = NULL;
				$MenuChange[1]['Li' . $LiNumber . 'Enable/Disable'] = 'Enable';
				
				if (!is_null($Value)) {
					if ($Key !== 'Child1') {
						$CurrentMenu = $Menu[$Value];
						if ($CurrentMenu['PageLocation'] != NULL) {
							$MenuChange[1]['Li' . $LiNumber] = "<a href='" . $CurrentMenu['PageLocation'] . "'>" . $PageVersion[$Value]['ContentPageMenuName'] . '</a>';
						}
						$ReturnValue = recursiveWalkUnorderedList($CurrentMenu, $Menu, $PageVersion, $i, $Value);
						if (!is_null($ReturnValue)) {
							if ($i != $ReturnValue) {
								$MenuChange[1]['Li' . $LiNumber . 'ChildID'] = $i;
								$i = $ReturnValue;
							}
						} else {
							$i++;
						}
					}
				}
			}
		}
	}
	$MenuChange[1]['Enable/Disable'] = 'Enable';
	$MenuChange[1]['Status'] = 'Approved';
	
	$Tier6Databases->ModulePass('XhtmlMainMenu', 'mainmenu', 'updateMainMenu', $MenuChange);
	$UpdateMainMenu = $Options['XhtmlMainMenu']['mainmenu']['CreatedMainMenuUpdatedPage']['SettingAttribute'];

	header("Location: ../../index.php?PageID=$UpdateMainMenu");

	function recursiveWalkUnorderedList(array $CurrentMenu, array $Menu, array $PageVersion, $NextIDNumber, $CurrentIDNumber) {
		$MenuChange = &$GLOBALS['MenuChange'];

		$UlClassChild = 'mainmenuul';
		$UlID = 'submenu';
		$hold = str_replace('MenuItem','', $Menu[$CurrentIDNumber]['ParentIDName']);
		$hold = explode('-', $hold);
		$hold[0]--;
		$hold = implode('-', $hold);
		$UlID .= $hold;
		$LiClassChild = 'menuparent MenuTextSub MenuLiSub MenuLiSubRoot';
		$LiClassLastChild = 'menuparent MenuTextSub MenuLiSub MenuLiSubRoot MenuLiSubFinal';

		$TRIP = FALSE;

		$MenuChange[$NextIDNumber]['PageID'] = 1;
		$MenuChange[$NextIDNumber]['ObjectID'] = $NextIDNumber;
		$MenuChange[$NextIDNumber]['StartTag'] = NULL;
		$MenuChange[$NextIDNumber]['EndTag'] = NULL;
		$MenuChange[$NextIDNumber]['StartTagID'] = NULL;
		$MenuChange[$NextIDNumber]['StartTagStyle'] = NULL;
		$MenuChange[$NextIDNumber]['StartTagClass'] = NULL;
		$MenuChange[$NextIDNumber]['Ul'] = NULL;
		$MenuChange[$NextIDNumber]['UlClass'] = $UlClassChild;
		$MenuChange[$NextIDNumber]['UlDir'] = NULL;
		$MenuChange[$NextIDNumber]['UlID'] = $UlID;
		$MenuChange[$NextIDNumber]['UlLang'] = NULL;
		$MenuChange[$NextIDNumber]['UlStyle'] = NULL;
		$MenuChange[$NextIDNumber]['UlTitle'] = NULL;
		$MenuChange[$NextIDNumber]['UlXMLLang'] = NULL;

		$NextIDNumberChild = $NextIDNumber;
		$NextIDNumberChild++;

		$LiLastChildName = NULL;
		
		if ($CurrentMenu != NULL) {
			if ($CurrentMenu['Child1'] != NULL) {
				foreach ($CurrentMenu as $Key => $Value) {
					if (strstr($Key, 'Child')) {
						$LiNumber = str_replace('Child', '', $Key);
						if (!is_null($Value)) {
							$MenuChange[$NextIDNumber]['Li' . $LiNumber] = "<a href='index.php?PageID=" . $Value . "'>" . $PageVersion[$Value]['ContentPageMenuName'] . '</a>';
							$TRIP = TRUE;
						} else {
							$MenuChange[$NextIDNumber]['Li' . $LiNumber] = NULL;
						}
		
						$MenuChange[$NextIDNumber]['Li' . $LiNumber . 'Class'] = $LiClassChild;
						$MenuChange[$NextIDNumber]['Li' . $LiNumber . 'Dir'] = NULL;
						$MenuChange[$NextIDNumber]['Li' . $LiNumber . 'ChildID'] = NULL;
						if (!is_null($Value)) {
							$MenuChange[$NextIDNumber]['Li' . $LiNumber . 'ID'] = NULL;
						} else {
							$MenuChange[$NextIDNumber]['Li' . $LiNumber . 'ID'] = NULL;
						}
						$MenuChange[$NextIDNumber]['Li' . $LiNumber . 'Lang'] = NULL;
						$MenuChange[$NextIDNumber]['Li' . $LiNumber . 'Style'] = NULL;
						$MenuChange[$NextIDNumber]['Li' . $LiNumber . 'Title'] = $PageVersion[$Value]['ContentPageMenuTitle'];
						$MenuChange[$NextIDNumber]['Li' . $LiNumber . 'XMLLang'] = NULL;
						$MenuChange[$NextIDNumber]['Li' . $LiNumber . 'Enable/Disable'] = 'Enable';
		
						if (!is_null($Value)) {
							$LiLastChildName = 'Li' . $LiNumber . 'Class';
							$CurrentMenu = $Menu[$Value];
							if ($CurrentMenu['PageLocation'] != NULL) {
								$MenuChange[$NextIDNumber]['Li' . $LiNumber] = "<a href='" . $CurrentMenu['PageLocation'] . "'>" . $PageVersion[$Value]['ContentPageMenuName'] . '</a>';
							}
							
							$MenuChange[$NextIDNumber]['Li' . $LiNumber . 'ChildID'] = $NextIDNumberChild;
							
							$ReturnValue = recursiveWalkUnorderedList($CurrentMenu, $Menu, $PageVersion, $NextIDNumberChild, $Value);
							
							$TRIP = 'CHANGE';
							
							if (!is_null($ReturnValue)) {
								if ($NextIDNumberChild != $ReturnValue) {
									$NextIDNumberChild = $ReturnValue;
								} else {
									$MenuChange[$NextIDNumber]['Li' . $LiNumber . 'ChildID'] = NULL;
								}
							} else {
								$MenuChange[$NextIDNumber]['Li' . $LiNumber . 'ChildID'] = NULL;
								$NextIDNumberChild++;
							}							
						}
					}
				}
			} else {
				$TRIP = FALSE;
			}
		}
		$MenuChange[$NextIDNumber][$LiLastChildName] = $LiClassLastChild;
		$MenuChange[$NextIDNumber]['Enable/Disable'] = 'Enable';
		$MenuChange[$NextIDNumber]['Status'] = 'Approved';

		$i = 1;
		$Temp = 'Li' . $i;
		$Hold = NULL;
		while (isset($MenuChange[$NextIDNumber][$Temp])) {
			if (!is_null($MenuChange[$NextIDNumber][$Temp])) {
				$Hold = $Temp;

			}
			$i++;
			$Temp = 'Li' . $i;
		}
		$Hold .= 'ID';
		$MenuChange[$NextIDNumber][$Hold] = NULL;
		//$MenuChange[$NextIDNumber][$Hold] = $LiClassLastChild;

		if ($TRIP === FALSE) {
			unset($MenuChange[$NextIDNumber]);
			return $NextIDNumber;
		}

		if($TRIP === 'CHANGE') {
			return $NextIDNumberChild;
		}
	}

	function recursiveWalk($CurrentMenu, $Changes, $ParentIDName, $ParentObjectID, $Menu) {
		$Tier6Databases = &$GLOBALS['Tier6Databases'];
		$GlobalUpdateRecord = &$GLOBALS['GlobalUpdateRecord'];

		$UpdateRecord = array();
		$UpdateRecord['PageID'] = 1;
		$UpdateRecord['ObjectID'] = $CurrentMenu['ObjectID'];
		$UpdateRecord['VersionID'] = 1;
		$UpdateRecord['RevisionID'] = 1;

		$UpdateRecord['PageLocation'] = $CurrentMenu['PageLocation'];

		$UpdateRecord['ParentObjectID'] = $ParentObjectID;
		if ($ParentIDName == 'MenuItem') {
			$UpdateRecord['ParentIDName'] = NULL;
		} else {
			$UpdateRecord['ParentIDName'] = $ParentIDName;
		}

		$UpdateRecord = $UpdateRecord + $Changes;
		array_push($GlobalUpdateRecord, $UpdateRecord);

		$ChildObjectID = $CurrentMenu['ObjectID'];
		if ($CurrentMenu != NULL) {
			foreach ($CurrentMenu as $Key => $Value) {
				if (strstr($Key, 'Child')) {
					if (!is_null($Value)) {
						if ($Value != $CurrentMenu['ObjectID']) {
							$ChildChanges = array();
							$ChildMenu = $Menu[$Value];
							foreach ($ChildMenu as $ChangesKey => $ChangesValue) {
								if (strstr($ChangesKey, 'Child')) {
									if ($ChangesValue == NULL) {
										$ChildChanges[$ChangesKey] = NULL;
									} else {
										$ChildChanges[$ChangesKey] = $ChangesValue;
									}
								}
							}

							if ($ParentIDName == 'MenuItem') {
								$ChildIDName = 'MenuItem' . str_replace('Child','', $Key);
							} else {
								$ChildIDName = $ParentIDName . '-' . str_replace('Child','', $Key);
							}
							recursiveWalk($ChildMenu, $ChildChanges, $ChildIDName, $ChildObjectID, $Menu);
						}
					}
				}

			}
		}
	}

?>