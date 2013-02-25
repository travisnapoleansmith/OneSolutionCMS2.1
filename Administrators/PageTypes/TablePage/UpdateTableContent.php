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

	$TableID = $_POST['TableID'];
	$TableName = $_POST['TableName'];
	$TableHeading = $_POST['TableHeading'];
	$EnableDisable = $_POST['EnableDisable'];
	$Status = $_POST['Status'];
	$TableContent = array();
	$TempTable = array();
	$Header = array();
	$Footer = array();


	foreach ($_COOKIE as $Key => $Value) {
		if (strstr($Key, "Header") || strstr($Key, "Footer")) {
			setcookie($Key, '', time()-4800, '/');
		}

		if ($Key == 'TableContent') {
			if (is_array($Value)) {
				foreach ($Value as $ArrayKey => $ArrayValue) {
					if (is_array($ArrayValue)) {
						foreach ($ArrayValue as $SubArrayKey => $SubArrayValue) {
							$CookieKey = "TableContent" . "[$ArrayKey]" . "[$SubArrayKey]";
							$_COOKIE['TableContent'][$ArrayKey][$SubArrayKey] = '';
						}
					}
				}
			}
		}
	}

	foreach ($_POST as $Key => $Value) {
		if (strstr($Key, 'Grid_')) {
			if ($Key == 'Grid_rowsadded' || $Key == 'Grid_rowsdeleted') {

			} else {
				$TempTable[$Key] = $Value;
			}
		}

		if (strstr($Key, "Header")) {
			if ($Value == 'NULL') {
				$Header[$Key] = NULL;
			} else {
				$Header[$Key] = $Value;
			}
		}

		if (strstr($Key, "Footer")) {
			if ($Value == 'NULL') {
				$Footer[$Key] = NULL;
			} else {
				$Footer[$Key] = $Value;
			}
		}

		if (strstr($Key, "Header") || strstr($Key, "Footer")) {
			setcookie($Key, $Value, time()+4800, '/');
		}

	}

	foreach($TempTable as $Key => $Value) {
		$NewKey = str_replace('Grid_', '', $Key);
		$NewKey = explode('_', $NewKey);
		$TableContent[$NewKey[0]][$NewKey[1]] = html_entity_decode($Value);
		$CookieKey = "TableContent" . "[$NewKey[0]]" . "[$NewKey[1]]";
		if ($Value != NULL) {
			////////setcookie($CookieKey, $Value, time()+4800, '/');
		} else {
			//setcookie($CookieKey, "NULL", time()+4800, '/');
		}
	}

	foreach ($TableContent as $Key => $Value) {
		$EMPTY = FALSE;
		if ($Value != NULL) {

		}

		foreach ($Value as $IDKey => $IDValue) {
			if ($IDValue != NULL) {
				$EMPTY = TRUE;
			}
		}

		if ($EMPTY == FALSE) {
			unset($TableContent[$Key]);
		}
	}

	$PageName = "../../index.php?PageID=";
	$PageName .= $_POST['UpdateTableContent'];
	$PageName .= "&TableID=";
	$PageName .= $TableID;
	
	if ($_POST['File']) {
		$PageName .= '&File=' . $_POST['File'];
	}
	
	$hold = $Tier6Databases->FormSubmitValidate('UpdateTableContent', $PageName);

	if ($hold) {
		foreach ($_POST as $Key => $Value) {
			if (strstr($Key, "Header") || strstr($Key, "Footer")) {
				setcookie($Key, $Value, time()-4800, '/');
			}
		}
		/*
		foreach($TempTable as $Key => $Value) {
			$NewKey = str_replace('Grid_', '', $Key);
			$NewKey = explode('_', $NewKey);
			$CookieKey = "TableContent" . "[$NewKey[0]]" . "[$NewKey[1]]";
			if ($Value != NULL) {
				setcookie($CookieKey, $Value, time()-4800, '/');
			}
		}
		*/

		$XhtmlTableIDArray = $Tier6Databases->ModulePass('XhtmlTable', 'table', 'getLastTableID', array('XhtmlTableName' => 'XhtmlTable'));
		//$TableID = $XhtmlTableIDArray['XhtmlTable'];
		//$TableID++;
		$Options = $Tier6Databases->getLayerModuleSetting();
		$ObjectID = 1;
		$TableI = 0;
		$TableContentUpdateSelectPage = $Options['XhtmlTable']['table']['TableContentUpdateSelectPage']['SettingAttribute'];
		/*$FormSelect = array();
		$FormSelect['PageID'] = $TableContentUpdateSelectPage;
		$FormSelect['ObjectID'] = $TableID;
		$FormSelect['StopObjectID'] = NULL;
		$FormSelect['ContinueObjectID'] = NULL;
		$FormSelect['ContainerObjectType'] = 'Option';
		$FormSelect['ContainerObjectTypeName'] = 'AdministratorFormOption';
		$FormSelect['ContainerObjectID'] = $TableID;
		$FormSelect['FormSelectDisabled'] = NULL;
		$FormSelect['FormSelectMultiple'] = NULL;
		$FormSelect['FormSelectName'] = 'TableContent';
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
		$FormSelect['FormSelectStyle'] = NULL;
		$FormSelect['FormSelectTabIndex'] = NULL;
		$FormSelect['FormSelectTitle'] = NULL;
		$FormSelect['FormSelectXMLLang'] = 'en-us';
		$FormSelect['Enable/Disable'] = 'Enable';
		$FormSelect['Status'] = 'Approved';
		*/
		$FormOptionText = $TableID . ' - ' . $TableName;

		$FormOption = array();
		//$FormOption['PageID'] = $TableContentUpdateSelectPage;
		//$FormOption['ObjectID'] = $TableID;
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
		//$FormOption['FormOptionValue'] = $TableID;
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

		$TableLookup = array();
		$TableLookup[0]['PageID'] = 0;
		$TableLookup[0]['ObjectID'] = $TableID;
		$TableLookup[0]['RevisionID'] = 0;
		$TableLookup[0]['CurrentVersion'] = 'true';
		$TableLookup[0]['XhtmlTableName'] = 'XhtmlTable';
		$TableLookup[0]['TableID'] = $TableID;
		$TableLookup[0]['Enable/Disable'] = $EnableDisable;
		$TableLookup[0]['Status'] = $Status;

		$TableListing = array();
		$TableListing[0]['XhtmlTableName'] = 'XhtmlTable';
		$TableListing[0]['XhtmlTableID'] = $TableID;
		$TableListing[0]['TableName'] = $TableName;
		$TableListing[0]['LinkedTable'] = 'False';
		$TableListing[0]['TableBorder'] = NULL;
		$TableListing[0]['TableCellPadding'] = NULL;
		$TableListing[0]['TableCellSpacing'] = NULL;
		$TableListing[0]['TableFrame'] = NULL;
		$TableListing[0]['TableRules'] = 'all';
		$TableListing[0]['TableSummary'] = $TableHeading;
		$TableListing[0]['TableWidth'] = 550;
		$TableListing[0]['TableClass'] = 'TableClass';
		$TableListing[0]['TableDir'] = 'ltr';
		$TableListing[0]['TableID'] = NULL;
		$TableListing[0]['TableLang'] = NULL;
		$TableListing[0]['TableStyle'] = NULL;
		$TableListing[0]['TableTitle'] = $TableHeading;
		$TableListing[0]['TableXMLLang'] = NULL;
		$TableListing[0]['Enable/Disable'] = $EnableDisable;
		$TableListing[0]['Status'] = $Status;

		// Setting Caption For XhtmlTable
		$Table = array();
		$Table[$TableI]['TableID'] = $TableID;
		$Table[$TableI]['ObjectID'] = $ObjectID;
		$Table[$TableI]['StopObjectID'] = NULL;
		$Table[$TableI]['ContainerObjectType'] = 'Caption';
		$Table[$TableI]['ContainerObjectTypeName'] = 'XhtmlTableCaption';
		$Table[$TableI]['ContainerObjectID'] = 1;
		$Table[$TableI]['Enable/Disable'] = $EnableDisable;
		$Table[$TableI]['Status'] = $Status;

		$TableCaption = array();
		$TableCaption[0]['TableID'] = $TableID;
		$TableCaption[0]['ObjectID'] = 1;
		$TableCaption[0]['TableCaptionText'] = $TableHeading;
		$TableCaption[0]['TableCaptionClass'] = NULL;
		$TableCaption[0]['TableCaptionDir'] = NULL;
		$TableCaption[0]['TableCaptionID'] = NULL;
		$TableCaption[0]['TableCaptionLang'] = NULL;
		$TableCaption[0]['TableCaptionStyle'] = NULL;
		$TableCaption[0]['TableCaptionTitle'] = NULL;
		$TableCaption[0]['TableCaptionXMLLang'] = NULL;
		$TableCaption[0]['Enable/Disable'] = $EnableDisable;
		$TableCaption[0]['Status'] = $Status;

		$ObjectID++;
		$TableI++;

		// Table Header
		$TableTHead = array();
		$TableTHeadContent = array();
		$TableTHeadHeader = array();

		$i = 0;
		$HeaderObjectID = 1;

		$Table[$TableI]['TableID'] = $TableID;
		$Table[$TableI]['ObjectID'] = $ObjectID;
		$Table[$TableI]['StopObjectID'] = NULL;
		$Table[$TableI]['ContainerObjectType'] = 'THead';
		$Table[$TableI]['ContainerObjectTypeName'] = 'XhtmlTableTHead';
		$Table[$TableI]['ContainerObjectID'] = 1;
		$Table[$TableI]['Enable/Disable'] = $EnableDisable;
		$Table[$TableI]['Status'] = $Status;

		$ObjectID++;
		$TableI++;

		$TableTHead[$i]['TableID'] = $TableID;
		$TableTHead[$i]['ObjectID'] = $HeaderObjectID;
		$TableTHead[$i]['StopObjectID'] = NULL;
		$TableTHead[$i]['ContainerObjectType'] = 'Header';
		$TableTHead[$i]['ContainerObjectTypeName'] = 'XhtmlTableTHeadContent';
		$TableTHead[$i]['ContainerObjectID'] = $HeaderObjectID;
		$TableTHead[$i]['TableHeaderAlign'] = NULL;
		$TableTHead[$i]['TableHeaderChar'] = NULL;
		$TableTHead[$i]['TableHeaderCharOff'] = NULL;
		$TableTHead[$i]['TableHeaderVAlign'] = NULL;
		$TableTHead[$i]['TableHeaderClass'] = NULL;
		$TableTHead[$i]['TableHeaderDir'] = NULL;
		$TableTHead[$i]['TableHeaderID'] = NULL;
		$TableTHead[$i]['TableHeaderLang'] = NULL;
		$TableTHead[$i]['TableHeaderStyle'] = NULL;
		$TableTHead[$i]['TableHeaderTitle'] = NULL;
		$TableTHead[$i]['TableHeaderXMLLang'] = NULL;
		$TableTHead[$i]['Enable/Disable'] = $EnableDisable;
		$TableTHead[$i]['Status'] = $Status;

		foreach ($Header as $Key => $Data) {
			$TableTHeadContent[$i]['TableID'] = $TableID;
			$TableTHeadContent[$i]['ObjectID'] = $HeaderObjectID;
			$TableTHeadContent[$i]['StopObjectID'] = NULL;
			$TableTHeadContent[$i]['ContainerObjectType'] = 'Header';
			$TableTHeadContent[$i]['ContainerObjectTypeName'] = 'XhtmlTableTHeadHeader';
			$TableTHeadContent[$i]['ContainerObjectID'] = $HeaderObjectID;
			$TableTHeadContent[$i]['TableHeaderAlign'] = 'center';
			$TableTHeadContent[$i]['TableHeaderChar'] = NULL;
			$TableTHeadContent[$i]['TableHeaderCharOff'] = NULL;
			$TableTHeadContent[$i]['TableHeaderVAlign'] = NULL;
			$TableTHeadContent[$i]['TableHeaderClass'] = NULL;
			$TableTHeadContent[$i]['TableHeaderDir'] = NULL;
			$TableTHeadContent[$i]['TableHeaderID'] = NULL;
			$TableTHeadContent[$i]['TableHeaderLang'] = NULL;
			$TableTHeadContent[$i]['TableHeaderStyle'] = NULL;
			$TableTHeadContent[$i]['TableHeaderTitle'] = NULL;
			$TableTHeadContent[$i]['TableHeaderXMLLang'] = NULL;
			$TableTHeadContent[$i]['Enable/Disable'] = $EnableDisable;
			$TableTHeadContent[$i]['Status'] = $Status;

			$TableTHeadHeader[$i]['TableID'] = $TableID;
			$TableTHeadHeader[$i]['ObjectID'] = $HeaderObjectID;
			$TableTHeadHeader[$i]['TableHeaderText'] = $Data;
			$TableTHeadHeader[$i]['TableHeaderAbbr'] = NULL;
			$TableTHeadHeader[$i]['TableHeaderAlign'] = 'center';
			$TableTHeadHeader[$i]['TableHeaderAxis'] = NULL;
			$TableTHeadHeader[$i]['TableHeaderChar'] = NULL;
			$TableTHeadHeader[$i]['TableHeaderCharoff'] = NULL;
			$TableTHeadHeader[$i]['TableHeaderColSpan'] = NULL;
			$TableTHeadHeader[$i]['TableHeaderRowSpan'] = NULL;
			$TableTHeadHeader[$i]['TableHeaderScope'] = NULL;
			$TableTHeadHeader[$i]['TableHeaderVAlign'] = NULL;
			$TableTHeadHeader[$i]['TableHeaderClass'] = NULL;
			$TableTHeadHeader[$i]['TableHeaderDir'] = NULL;
			$TableTHeadHeader[$i]['TableHeaderID'] = NULL;
			$TableTHeadHeader[$i]['TableHeaderLang'] = NULL;
			$TableTHeadHeader[$i]['TableHeaderStyle'] = NULL;
			$TableTHeadHeader[$i]['TableHeaderTitle'] = NULL;
			$TableTHeadHeader[$i]['TableHeaderXMLLang'] = NULL;
			$TableTHeadHeader[$i]['Enable/Disable'] = $EnableDisable;
			$TableTHeadHeader[$i]['Status'] = $Status;

			$i++;
			$HeaderObjectID++;
		}

		// Table Body
		$TableRow = array();
		$TableRowCell = array();
		$i = 0;
		$j = 0;
		$MasterContainerObjectID = 1;
		$StopObjectID = 99;
		foreach ($TableContent as $Key => $Data) {
			if ($Key != 'rowsdeleted') {
				$Table[$TableI]['TableID'] = $TableID;
				$Table[$TableI]['ObjectID'] = $ObjectID;
				$Table[$TableI]['StopObjectID'] = NULL;
				$Table[$TableI]['ContainerObjectType'] = 'TableRow';
				$Table[$TableI]['ContainerObjectTypeName'] = 'XhtmlTableRow';
				$Table[$TableI]['ContainerObjectID'] = $MasterContainerObjectID;
				$Table[$TableI]['Enable/Disable'] = $EnableDisable;
				$Table[$TableI]['Status'] = $Status;

				$ObjectID++;
				$TableI++;
				$ContentObjectID = $MasterContainerObjectID;
				foreach ($Data as $SubKey => $SubData) {
					$TableRow[$i]['TableID'] = $TableID;
					$TableRow[$i]['ObjectID'] = $ContentObjectID;
					$TableRow[$i]['StopObjectID'] = $StopObjectID;
					$TableRow[$i]['ContainerObjectType'] = 'Cell';
					$TableRow[$i]['ContainerObjectTypeName'] = 'XhtmlTableRowCell';
					$TableRow[$i]['ContainerObjectID'] = $ContentObjectID;
					$TableRow[$i]['LinkedTableRow'] = 'False';
					$TableRow[$i]['TableRowAlign'] = NULL;
					$TableRow[$i]['TableRowChar'] = NULL;
					$TableRow[$i]['TableRowCharOff'] = NULL;
					$TableRow[$i]['TableRowVAlign'] = NULL;
					$TableRow[$i]['TableRowClass'] = NULL;
					$TableRow[$i]['TableRowDir'] = NULL;
					$TableRow[$i]['TableRowID'] = NULL;
					$TableRow[$i]['TableRowLang'] = NULL;
					$TableRow[$i]['TableRowStyle'] = NULL;
					$TableRow[$i]['TableRowTitle'] = NULL;
					$TableRow[$i]['TableRowXMLLang'] = NULL;
					$TableRow[$i]['Enable/Disable'] = $EnableDisable;
					$TableRow[$i]['Status'] = $Status;

					$TableRowCell[$j]['TableID'] = $TableID;
					$TableRowCell[$j]['ObjectID'] = $ContentObjectID;
					if (isset($SubData) && strlen($SubData) != 0) {
						$TableRowCell[$j]['TableCellText'] = stripslashes($SubData);
					} else {
						$TableRowCell[$j]['TableCellText'] = NULL;
					}
					$TableRowCell[$j]['TableCellAbbr'] = NULL;
					$TableRowCell[$j]['TableCellAlign'] = NULL;
					$TableRowCell[$j]['TableCellAxis'] = NULL;
					$TableRowCell[$j]['TableCellChar'] = NULL;
					$TableRowCell[$j]['TableCellCharoff'] = NULL;
					$TableRowCell[$j]['TableCellColSpan'] = NULL;
					$TableRowCell[$j]['TableCellHeaders'] = NULL;
					$TableRowCell[$j]['TableCellRowSpan'] = NULL;
					$TableRowCell[$j]['TableCellScope'] = NULL;
					$TableRowCell[$j]['TableCellVAlign'] = NULL;
					$TableRowCell[$j]['TableCellClass'] = NULL;
					$TableRowCell[$j]['TableCellDir'] = NULL;
					$TableRowCell[$j]['TableCellID'] = NULL;
					$TableRowCell[$j]['TableCellLang'] = NULL;
					$TableRowCell[$j]['TableCellStyle'] = NULL;
					$TableRowCell[$j]['TableCellTitle'] = NULL;
					$TableRowCell[$j]['TableCellXMLLang'] = NULL;
					$TableRowCell[$j]['Enable/Disable'] = $EnableDisable;
					$TableRowCell[$j]['Status'] = $Status;

					$i++;
					$j++;
					$ContentObjectID++;
				}

				$TableRow[$i]['TableID'] = $TableID;
				$TableRow[$i]['ObjectID'] = $StopObjectID;
				$TableRow[$i]['StopObjectID'] = $StopObjectID;
				$TableRow[$i]['ContainerObjectType'] = NULL;
				$TableRow[$i]['ContainerObjectTypeName'] = NULL;
				$TableRow[$i]['ContainerObjectID'] = NULL;
				$TableRow[$i]['LinkedTableRow'] = 'False';
				$TableRow[$i]['TableRowAlign'] = NULL;
				$TableRow[$i]['TableRowChar'] = NULL;
				$TableRow[$i]['TableRowCharOff'] = NULL;
				$TableRow[$i]['TableRowVAlign'] = NULL;
				$TableRow[$i]['TableRowClass'] = NULL;
				$TableRow[$i]['TableRowDir'] = NULL;
				$TableRow[$i]['TableRowID'] = NULL;
				$TableRow[$i]['TableRowLang'] = NULL;
				$TableRow[$i]['TableRowStyle'] = NULL;
				$TableRow[$i]['TableRowTitle'] = NULL;
				$TableRow[$i]['TableRowXMLLang'] = NULL;
				$TableRow[$i]['Enable/Disable'] = $EnableDisable;
				$TableRow[$i]['Status'] = $Status;
				$i++;

				if ($MasterContainerObjectID === 1) {
					$MasterContainerObjectID = 0;
				}
				$MasterContainerObjectID = $MasterContainerObjectID + 100;
				$StopObjectID = $StopObjectID + 100;
			}
		}

		// Table Footer
		$TableTFoot = array();
		$TableTFootContent = array();
		$TableTFootCell = array();

		$i = 0;
		$FooterObjectID = 1;

		$FooterIsNull = false;
		foreach ($Footer as $Key => $Data) {
			if (isset($Data) && strlen($Data) != 0) {
				$FooterIsNull = true;
			}
		}

		if ($FooterIsNull == true) {
			$Table[$TableI]['TableID'] = $TableID;
			$Table[$TableI]['ObjectID'] = $ObjectID;
			$Table[$TableI]['StopObjectID'] = NULL;
			$Table[$TableI]['ContainerObjectType'] = 'TFoot';
			$Table[$TableI]['ContainerObjectTypeName'] = 'XhtmlTableTFoot';
			$Table[$TableI]['ContainerObjectID'] = 1;
			$Table[$TableI]['Enable/Disable'] = $EnableDisable;
			$Table[$TableI]['Status'] = $Status;
			$ObjectID++;
			$TableI++;

			$TableTFoot[$i]['TableID'] = $TableID;
			$TableTFoot[$i]['ObjectID'] = $FooterObjectID;
			$TableTFoot[$i]['StopObjectID'] = NULL;
			$TableTFoot[$i]['ContainerObjectType'] = 'Cell';
			$TableTFoot[$i]['ContainerObjectTypeName'] = 'XhtmlTableTFootContent';
			$TableTFoot[$i]['ContainerObjectID'] = $FooterObjectID;
			$TableTFoot[$i]['LinkedTableRow'] = 'False';
			$TableTFoot[$i]['TableRowAlign'] = NULL;
			$TableTFoot[$i]['TableRowChar'] = NULL;
			$TableTFoot[$i]['TableRowCharOff'] = NULL;
			$TableTFoot[$i]['TableRowVAlign'] = NULL;
			$TableTFoot[$i]['TableRowClass'] = NULL;
			$TableTFoot[$i]['TableRowDir'] = NULL;
			$TableTFoot[$i]['TableRowID'] = NULL;
			$TableTFoot[$i]['TableRowLang'] = NULL;
			$TableTFoot[$i]['TableRowStyle'] = NULL;
			$TableTFoot[$i]['TableRowTitle'] = NULL;
			$TableTFoot[$i]['TableRowXMLLang'] = NULL;
			$TableTFoot[$i]['Enable/Disable'] = $EnableDisable;
			$TableTFoot[$i]['Status'] = $Status;

			foreach ($Footer as $Key => $Data) {
				$TableTFootContent[$i]['TableID'] = $TableID;
				$TableTFootContent[$i]['ObjectID'] = $FooterObjectID;
				$TableTFootContent[$i]['StopObjectID'] = NULL;
				$TableTFootContent[$i]['ContainerObjectType'] = 'Cell';
				$TableTFootContent[$i]['ContainerObjectTypeName'] = 'XhtmlTableTFootCell';
				$TableTFootContent[$i]['ContainerObjectID'] = $FooterObjectID;
				$TableTFootContent[$i]['LinkedTableRow'] = 'False';
				$TableTFootContent[$i]['TableRowAlign'] = 'center';
				$TableTFootContent[$i]['TableRowChar'] = NULL;
				$TableTFootContent[$i]['TableRowCharOff'] = NULL;
				$TableTFootContent[$i]['TableRowVAlign'] = NULL;
				$TableTFootContent[$i]['TableRowClass'] = NULL;
				$TableTFootContent[$i]['TableRowDir'] = NULL;
				$TableTFootContent[$i]['TableRowID'] = NULL;
				$TableTFootContent[$i]['TableRowLang'] = NULL;
				$TableTFootContent[$i]['TableRowStyle'] = NULL;
				$TableTFootContent[$i]['TableRowTitle'] = NULL;
				$TableTFootContent[$i]['TableRowXMLLang'] = NULL;
				$TableTFootContent[$i]['Enable/Disable'] = $EnableDisable;
				$TableTFootContent[$i]['Status'] = $Status;

				$TableTFootCell[$i]['TableID'] = $TableID;
				$TableTFootCell[$i]['ObjectID'] = $FooterObjectID;
				if (isset($Data) && strlen($Data) != 0) {
					$TableTFootCell[$i]['TableCellText'] = $Data;
				} else {
					$TableTFootCell[$i]['TableCellText'] = NULL;
				}
				$TableTFootCell[$i]['TableCellAbbr'] = NULL;
				$TableTFootCell[$i]['TableCellAlign'] = NULL;
				$TableTFootCell[$i]['TableCellAxis'] = NULL;
				$TableTFootCell[$i]['TableCellChar'] = NULL;
				$TableTFootCell[$i]['TableCellCharoff'] = NULL;
				$TableTFootCell[$i]['TableCellColSpan'] = NULL;
				$TableTFootCell[$i]['TableCellRows'] = NULL;
				$TableTFootCell[$i]['TableCellRowSpan'] = NULL;
				$TableTFootCell[$i]['TableCellScope'] = NULL;
				$TableTFootCell[$i]['TableCellVAlign'] = NULL;
				$TableTFootCell[$i]['TableCellClass'] = NULL;
				$TableTFootCell[$i]['TableCellDir'] = NULL;
				$TableTFootCell[$i]['TableCellID'] = NULL;
				$TableTFootCell[$i]['TableCellLang'] = NULL;
				$TableTFootCell[$i]['TableCellStyle'] = NULL;
				$TableTFootCell[$i]['TableCellTitle'] = NULL;
				$TableTFootCell[$i]['TableCellXMLLang'] = NULL;
				$TableTFootCell[$i]['Enable/Disable'] = $EnableDisable;
				$TableTFootCell[$i]['Status'] = $Status;

				$i++;
				$FooterObjectID++;
			}
		}

		// SUBMIT FORM DATA
		$Tier6Databases->ModulePass('XhtmlForm', 'form', 'updateFormOption', array('PageID' => array('PageID' => $TableContentUpdateSelectPage, 'ObjectID' => $TableID), 'Content' => $FormOption));

		$TableContentDeleteSelectPage = $Options['XhtmlTable']['table']['TableContentDeleteSelectPage']['SettingAttribute'];

		$Tier6Databases->ModulePass('XhtmlForm', 'form', 'updateFormOption', array('PageID' => array('PageID' => $TableContentDeleteSelectPage, 'ObjectID' => $TableID), 'Content' => $FormOption));

		$TableContentEnableDisableSelectPage = $Options['XhtmlTable']['table']['TableContentEnableDisableSelectPage']['SettingAttribute'];

		$Tier6Databases->ModulePass('XhtmlForm', 'form', 'updateFormOption', array('PageID' => array('PageID' => $TableContentEnableDisableSelectPage, 'ObjectID' => $TableID), 'Content' => $FormOption));

		// SUBMIT TABLE DATA
		$Tier6Databases->ModulePass('XhtmlTable', 'table', 'updateTable', array('Content' => $TableTHead, 'TableName' => 'XhtmlTableTHead'));
		$Tier6Databases->ModulePass('XhtmlTable', 'table', 'updateTable', array('Content' => $TableTHeadContent, 'TableName' => 'XhtmlTableTHeadContent'));
		$Tier6Databases->ModulePass('XhtmlTable', 'table', 'updateTable', array('Content' => $TableTHeadHeader, 'TableName' => 'XhtmlTableTHeadHeader'));

		$Tier6Databases->ModulePass('XhtmlTable', 'table', 'updateTable', array('Content' => $TableTFoot, 'TableName' => 'XhtmlTableTFoot'));
		$Tier6Databases->ModulePass('XhtmlTable', 'table', 'updateTable', array('Content' => $TableTFootContent, 'TableName' => 'XhtmlTableTFootContent'));
		$Tier6Databases->ModulePass('XhtmlTable', 'table', 'updateTable', array('Content' => $TableTFootCell, 'TableName' => 'XhtmlTableTFootCell'));

		$Tier6Databases->ModulePass('XhtmlTable', 'table', 'updateTable', array('Content' => $TableLookup, 'TableName' => 'XhtmlTableLookup', 'TableType' => 'XhtmlTableLookup'));
		$Tier6Databases->ModulePass('XhtmlTable', 'table', 'updateTable', array('Content' => $TableListing, 'TableName' => 'XhtmlTableListing', 'TableType' => 'XhtmlTableListing'));

		$Tier6Databases->ModulePass('XhtmlTable', 'table', 'updateTable', array('Content' => $TableCaption, 'TableName' => 'XhtmlTableCaption'));

		$Tier6Databases->ModulePass('XhtmlTable', 'table', 'updateTable', array('Content' => $Table, 'TableName' => 'XhtmlTable'));

		$Tier6Databases->ModulePass('XhtmlTable', 'table', 'updateTable', array('Content' => $TableRow, 'TableName' => 'XhtmlTableRow'));
		$Tier6Databases->ModulePass('XhtmlTable', 'table', 'updateTable', array('Content' => $TableRowCell, 'TableName' => 'XhtmlTableRowCell'));

		$TableContentCreatedUpdatePage = $Options['XhtmlTable']['table']['TableContentCreatedUpdatePage']['SettingAttribute'];
		$TableContentCreatedUpdatePage = $TableContentCreatedUpdatePage . '&TableID=' . $TableID ;

		header("Location: $TableContentCreatedUpdatePage");
	}
?>