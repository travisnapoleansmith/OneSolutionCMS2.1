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

	$hold = $_POST['PhotosPage'];
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
	$PhotosPageVersion = $Tier6Databases->getRecord($PageID, 'ContentLayerVersion');
	$PageVersion = $PhotosPageVersion[0]['RevisionID'];

	$PageID['RevisionID'] = $PageVersion;

	$passarray = array();
	$passarray['PageID'] = $PageID;
	$passarray['DatabaseVariableName'] = 'ContentTableName';
	$PhotosPage = $Tier6Databases->ModulePass('XhtmlContent', 'content', 'getRecord', $passarray);

	$passarray['DatabaseVariableName'] = 'DatabaseTable';
	$PhotosLookupTable = $Tier6Databases->ModulePass('XhtmlPicture', 'picture', 'getRecord', $passarray);

	unset($passarray);
	$passarray = array();
	$passarray['PageID'] = $PageID['PageID'];
	$passarray['CurrentVersion'] = $PageID['CurrentVersion'];
	$PhotosPageHeader = $Tier6Databases->getRecord($passarray, 'PageAttributes');

	unset($passarray);
	$passarray = array();
	$passarray['PageID'] = $PageID['PageID'];
	$HeaderPanel1 = $Tier6Databases->getRecord($passarray, 'HeaderPanel1');

	$Sitemap = $Tier6Databases->getRecord($passarray, 'XMLSitemap');

	$Sitemap[0]['Priority'] *= 10;

	$hold = array();
	$hold['Tag'] = 'h1';
	$hold['Content'] = $HeaderPanel1[1]['Div1'];
	$Header = $Tier6Databases->ModulePass('XhtmlMenu', 'headerpanel1', 'removeTag', $hold);

	$sessionname = $Tier6Databases->SessionStart('UpdatePhotosPage');

	$_SESSION['POST']['FilteredInput']['PageID'] = $_POST['PageID'];
	$_SESSION['POST']['FilteredInput']['FormOptionObjectID'] = $_POST['FormOptionObjectID'];
	$_SESSION['POST']['FilteredInput']['RevisionID'] = $PhotosPageVersion[0]['RevisionID'];
	$_SESSION['POST']['FilteredInput']['MenuObjectID'] = $PhotosPageVersion[0]['ContentPageMenuObjectID'];
	$_SESSION['POST']['FilteredInput']['CreationDateTime'] = $PhotosPageVersion[0]['CreationDateTime'];
	$_SESSION['POST']['FilteredInput']['Owner'] = $PhotosPageVersion[0]['Owner'];
	$_SESSION['POST']['FilteredInput']['UserAccessGroup'] = $PhotosPageVersion[0]['UserAccessGroup'];


	$_SESSION['POST']['FilteredInput']['PageTitle'] = $PhotosPageHeader[0]['PageTitle'];
	if ($PhotosPageHeader[0]['MetaNameContent1']) {
		$_SESSION['POST']['FilteredInput']['Keywords'] = $PhotosPageHeader[0]['MetaNameContent1'];
	} else {
		$_SESSION['POST']['FilteredInput']['Keywords'] = 'NULL';
	}
	if ($PhotosPageHeader[0]['MetaNameContent2']) {
		$_SESSION['POST']['FilteredInput']['Description'] = $PhotosPageHeader[0]['MetaNameContent2'];
	} else {
		$_SESSION['POST']['FilteredInput']['Description'] = 'NULL';
	}

	$_SESSION['POST']['FilteredInput']['Header'] = $Header;

	if ($PhotosPage[0]['Heading'] != NULL) {
		$_SESSION['POST']['FilteredInput']['Heading'] = $PhotosPage[0]['Heading'];
	} else {
		$_SESSION['POST']['FilteredInput']['Heading'] = 'NULL';
	}

	if ($PhotoPage[0]['Content'] != NULL) {
		$_SESSION['POST']['FilteredInput']['TopText'] = $PhotosPage[0]['Content'];
	} else {
		$_SESSION['POST']['FilteredInput']['TopText'] = 'NULL';
	}

	reset($PhotosPage);
	next($PhotosPage);
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

	while (current($PhotosPage) != NULL) {
		$Record = current($PhotosPage);

		if ($Record['Heading'] != NULL) {
			$_SESSION['POST']['FilteredInput'][$PhotoSetHeading] = $Record['Heading'];
		}

		if ($Record['Content'] != NULL) {
			$_SESSION['POST']['FilteredInput'][$PhotoSetTopText] = $Record['Content'];
		}

		$i++;
		next($PhotosPage);
		$Record = current($PhotosPage);

		if ($Record['StartTag'] == '<div>') {
			next($PhotosPage);
			$Record = current($PhotosPage);
		}
		if ($Record['ContainerObjectType'] == 'XhtmlPicture') {
			$id = $Record['ContainerObjectID'];
			$id--;
			$Picture = $PhotosLookupTable[$id];

			if ($Picture['PictureLink'] != NULL) {
				$_SESSION['POST']['FilteredInput'][$PhotoSetImage1Src] = $Picture['PictureLink'];
			}

			if ($Picture['PictureAltText'] != NULL) {
				$_SESSION['POST']['FilteredInput'][$PhotoSetImage1Alt] = $Picture['PictureAltText'];
			}

			next($PhotosPage);
			$Record = current($PhotosPage);

			if ($Record['Content'] != NULL) {
				$_SESSION['POST']['FilteredInput'][$PhotoSetImage1Text] = $Record['Content'];
			}
			next($PhotosPage);
			$Record = current($PhotosPage);
		}

		if ($Record['ContainerObjectType'] == 'XhtmlPicture') {
			$id = $Record['ContainerObjectID'];
			$id--;
			$Picture = $PhotosLookupTable[$id];
			if ($Picture['PictureLink'] != NULL) {
				$_SESSION['POST']['FilteredInput'][$PhotoSetImage2Src] = $Picture['PictureLink'];
			}

			if ($Picture['PictureAltText'] != NULL) {
				$_SESSION['POST']['FilteredInput'][$PhotoSetImage2Alt] = $Picture['PictureAltText'];
			}

			next($PhotosPage);
			$Record = current($PhotosPage);

			if ($Record['Content'] != NULL) {
				$_SESSION['POST']['FilteredInput'][$PhotoSetImage2Text] = $Record['Content'];
			}
			next($PhotosPage);
			$Record = current($PhotosPage);
		}

		if ($Record['ContainerObjectType'] == 'XhtmlContent') {
			if ($Record['Content'] != NULL) {
				$_SESSION['POST']['FilteredInput'][$PhotoSetBottomText] = $Record['Content'];
			}
		}
		next($PhotosPage);
		$PhotoSetHeading = "PhotoSet$i" . 'Heading';
		$PhotoSetTopText = "PhotoSet$i" . 'TopText';
		$PhotoSetImage1Src = "PhotoSet$i" . 'Image1Src';
		$PhotoSetImage1Text = "PhotoSet$i" . 'Image1Text';
		$PhotoSetImage1Alt = "PhotoSet$i" . 'Image1Alt';
		$PhotoSetImage2Src = "PhotoSet$i" . 'Image2Src';
		$PhotoSetImage2Text = "PhotoSet$i" . 'Image2Text';
		$PhotoSetImage2Alt = "PhotoSet$i" . 'Image2Alt';
		$PhotoSetBottomText = "PhotoSet$i" . 'BottomText';

	}
	end($PhotosPage);
	//prev($PhotosPage);
	$count = count($PhotosPage);
	if ($count <= 2) {
		$Record = array();
	} else {
		$Record = current($PhotosPage);
	}
	if ($Record['Heading'] != NULL) {
		$_SESSION['POST']['FilteredInput']['BottomHeading'] = $Record['Heading'];
	} else {
		$_SESSION['POST']['FilteredInput']['BottomHeading'] = 'NULL';
	}

	if ($Record['Content'] != NULL) {
		$_SESSION['POST']['FilteredInput']['BottomText'] = $Record['Content'];
	} else {
		$_SESSION['POST']['FilteredInput']['BottomText'] = 'NULL';
	}

	$_SESSION['POST']['FilteredInput']['Priority'] = $Sitemap[0]['Priority'];
	$_SESSION['POST']['FilteredInput']['Frequency'] = ucfirst($Sitemap[0]['ChangeFreq']);

	$_SESSION['POST']['FilteredInput']['MenuName'] = $PhotosPageVersion[0]['ContentPageMenuName'];
	$_SESSION['POST']['FilteredInput']['MenuTitle'] = $PhotosPageVersion[0]['ContentPageMenuTitle'];

	$_SESSION['POST']['FilteredInput']['EnableDisable'] = 'Enable';
	$_SESSION['POST']['FilteredInput']['Status'] = 'Approved';

	$Options = $Tier6Databases->getLayerModuleSetting();
	$UpdatePhotosPage = $Options['XhtmlPicture']['picture']['UpdatePhotosPage']['SettingAttribute'];
	header("Location: $UpdatePhotosPage&SessionID=$sessionname");
	exit;

?>