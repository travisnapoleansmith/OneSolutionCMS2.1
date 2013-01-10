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

	require_once ('Configuration/includes.php');

	$hold = $_POST['MultiHeaderContentPage'];
	$hold = explode(' ', $hold);
	$PageID = $hold[2];
	$_POST['PageID'] = $PageID;
	$_POST['FormOptionObjectID'] = $hold[0];
	unset($hold);

	$PageID = array();
	$PageID['PageID'] = $_POST['PageID'];
	$PageID['CurrentVersion'] = 'true';

	$passarray = array();
	$passarray['PageID'] = $PageID;
	unset($passarray['DatabaseVariableName']);
	$ContentPageVersion = $Tier6Databases->getRecord($PageID, 'ContentLayerVersion');
	$PageVersion = $ContentPageVersion[0]['RevisionID'];

	$PageID['RevisionID'] = $PageVersion;

	$passarray = array();
	$passarray['PageID'] = $PageID;
	$passarray['DatabaseVariableName'] = 'ContentTableName';
	$ContentPage = $Tier6Databases->ModulePass('XhtmlContent', 'content', 'getRecord', $passarray);

	$ContentPageHeader = $Tier6Databases->getRecord($passarray['PageID'], 'PageAttributes');

	unset($passarray['PageID']['CurrentVersion']);
	unset($passarray['PageID']['RevisionID']);
	$HeaderPanel1 = $Tier6Databases->getRecord($passarray['PageID'], 'HeaderPanel1');

	unset($passarray);
	$passarray = array();
	$passarray['PageID'] = $PageID['PageID'];
	$Sitemap = $Tier6Databases->getRecord($passarray, 'XMLSitemap');

	$Sitemap[0]['Priority'] *= 10;

	$hold = array();
	$hold['Tag'] = 'h1';
	$hold['Content'] = $HeaderPanel1[1]['Div1'];
	$Header = $Tier6Databases->ModulePass('XhtmlMenu', 'headerpanel1', 'removeTag', $hold);

	$sessionname = $Tier6Databases->SessionStart('UpdateMultiHeaderPage');

	$_SESSION['POST']['FilteredInput']['PageID'] = $_POST['PageID'];
	$_SESSION['POST']['FilteredInput']['FormOptionObjectID'] = $_POST['FormOptionObjectID'];
	$_SESSION['POST']['FilteredInput']['RevisionID'] = $ContentPageVersion[0]['RevisionID'];
	$_SESSION['POST']['FilteredInput']['MenuObjectID'] = $ContentPageVersion[0]['ContentPageMenuObjectID'];
	$_SESSION['POST']['FilteredInput']['CreationDateTime'] = $ContentPageVersion[0]['CreationDateTime'];
	$_SESSION['POST']['FilteredInput']['Owner'] = $ContentPageVersion[0]['Owner'];
	$_SESSION['POST']['FilteredInput']['UserAccessGroup'] = $ContentPageVersion[0]['UserAccessGroup'];

	$_SESSION['POST']['FilteredInput']['PageTitle'] = $ContentPageHeader[0]['PageTitle'];
	if ($ContentPageHeader[0]['MetaNameContent1']) {
		$_SESSION['POST']['FilteredInput']['Keywords'] = $ContentPageHeader[0]['MetaNameContent1'];
	} else {
		$_SESSION['POST']['FilteredInput']['Keywords'] = 'NULL';
	}
	if ($ContentPageHeader[0]['MetaNameContent2']) {
		$_SESSION['POST']['FilteredInput']['Description'] = $ContentPageHeader[0]['MetaNameContent2'];
	} else {
		$_SESSION['POST']['FilteredInput']['Description'] = 'NULL';
	}
	$_SESSION['POST']['FilteredInput']['Header'] = $Header;
	/*
	$i = 1;
	foreach ($ContentPage as $Key => $Value) {
		//print "$Key\n";

		if ($Value['Heading'] != NULL) {
			//print_r($Value);
			if ($Value['ContentStartTag'] == '<p>') {

			}
			$i++;
		} else {

		}
	}
	//$_SESSION['POST']['FilteredInput']['Heading'] = $ContentPage[0]['Heading'];
	//$_SESSION['POST']['FilteredInput']['Blockquote'] = $ContentPage[0]['Content'];

	$_SESSION['POST']['FilteredInput']['Priority'] = $Sitemap[0]['Priority'];
	$_SESSION['POST']['FilteredInput']['Frequency'] = ucfirst($Sitemap[0]['ChangeFreq']);

	$_SESSION['POST']['FilteredInput']['MenuName'] = $ContentPageVersion[0]['ContentPageMenuName'];
	$_SESSION['POST']['FilteredInput']['MenuTitle'] = $ContentPageVersion[0]['ContentPageMenuTitle'];

	$_SESSION['POST']['FilteredInput']['EnableDisable'] = 'Enable';
	$_SESSION['POST']['FilteredInput']['Status'] = 'Approved';
	//print_r($_SESSION);
	//print_r($ContentPage);
	/*
	$Options = $Tier6Databases->getLayerModuleSetting();
	$UpdateMultiHeaderPage = $Options['XhtmlContent']['content']['UpdateMultiHeaderPage']['SettingAttribute'];
	header("Location: $UpdateMultiHeaderPage&SessionID=$sessionname");
	*/

	print "TESTING\n";
	require_once '../Testcases/Tier6-ContentLayer/Modules/CardCollector/ImportCSVFile/Test1.php';
?>