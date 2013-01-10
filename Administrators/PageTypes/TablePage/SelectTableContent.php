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

	$sessionname = $Tier6Databases->SessionStart('UpdateTableContent');

	$Options = $Tier6Databases->getLayerModuleSetting();

	$XhtmlTableName = $Options['XhtmlTable']['table']['XhtmlTableName']['SettingAttribute'];

	$TableID = $_POST['TableContent'];
	$passarray = array();
	$passarray['XhtmlTableID'] = $TableID;
	$passarray['XhtmlTableName'] = $XhtmlTableName;

	$TableSelected = $Tier6Databases->getRecord($passarray, 'XhtmlTableListing', TRUE, array());

	$TableName = $TableSelected[0]['TableName'];
	$TableHeading = $TableSelected[0]['TableTitle'];
	$EnableDisable = $TableSelected[0]['Enable/Disable'];
	$Status = $TableSelected[0]['Status'];

	$_SESSION['POST']['FilteredInput']['TableName'] = $TableName;
	$_SESSION['POST']['FilteredInput']['TableHeading'] = $TableHeading;
	$_SESSION['POST']['FilteredInput']['EnableDisable'] = $EnableDisable;
	$_SESSION['POST']['FilteredInput']['Status'] = $Status;
	$_SESSION['POST']['FilteredInput']['TableID'] = $TableID;

	$_POST['TableID'] = $TableID;
	$_POST['TableName'] = $TableName;
	$_POST['TableHeading'] = $TableHeading;
	$_POST['EnableDisable'] = $EnableDisable;
	$_POST['Status'] = $Status;

	$UpdateSelectPage = $Options['XhtmlTable']['table']['TableContentUpdatePage']['SettingAttribute'];

	header("Location: $UpdateSelectPage&SessionID=$sessionname&TableID=$TableID");
?>