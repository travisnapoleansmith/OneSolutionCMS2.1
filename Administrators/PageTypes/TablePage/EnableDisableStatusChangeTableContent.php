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

	$PageID = $_POST['TableContent'];

	$passarray = array();
	$passarray['PageID'] = $_POST['EnableDisableTableContent'];
	$passarray['ObjectID'] = $_POST['TableContent'];

	$FormOptionSelected = $Tier6Databases->getRecord($passarray, 'AdministratorFormOption', TRUE, array('1' => 'PageID'), 'ASC');

	$Options = $Tier6Databases->getLayerModuleSetting();

	if (!is_null($PageID)) {
		$TableContentPageID = array();
		$TableContentPageID['XhtmlTableName'] = 'XhtmlTable';
		$TableContentPageID['XhtmlTableID'] = $PageID;
		$TableContentPageID['Enable/Disable'] = $_POST['EnableDisable'];
		$TableContentPageID['Status'] = $_POST['Status'];

		$Tier6Databases->ModulePass('XhtmlTable', 'table', 'updateTableStatus', $TableContentPageID);

		$TableContentUpdateSelectPage = $Options['XhtmlTable']['table']['TableContentUpdateSelectPage']['SettingAttribute'];
		$TableContentPageID = array();
		$TableContentPageID['PageID'] = $TableContentUpdateSelectPage;
		$TableContentPageID['ObjectID'] = $FormOptionSelected[0]['ObjectID'];
		$TableContentPageID['EnableDisable'] = $_POST['EnableDisable'];
		$TableContentPageID['Status'] = $_POST['Status'];

		$Tier6Databases->ModulePass('XhtmlForm', 'form', 'updateFormOptionStatus', $TableContentPageID);
		$Tier6Databases->ModulePass('XhtmlForm', 'form', 'updateFormSelectStatus', $TableContentPageID);

		$TableContentEnableDisablePage = $Options['XhtmlTable']['table']['TableContentEnableDisablePage']['SettingAttribute'];
		header("Location: $TableContentEnableDisablePage");

	} else {
		$TableContentEnableDisableSelectPage = $Options['XhtmlTable']['table']['TableContentEnableDisableSelectPage']['SettingAttribute'];
		header("Location: ../../index.php?PageID=$TableContentEnableDisableSelectPage");
	}

?>