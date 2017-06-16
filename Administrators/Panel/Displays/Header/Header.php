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
	
	//error_reporting(0);
	
	$HOME = $_SERVER['SUBDOMAIN_DOCUMENT_ROOT'];
	$ADMINHOME = $HOME . '/Administrators/';
	$GLOBALS['HOME'] = $HOME;
	$GLOBALS['ADMINHOME'] = $ADMINHOME;
		
	// Includes all files
	//require_once ('Configuration/includes.php');
	
	require_once ("$ADMINHOME/Panel/Configuration/includes.php");
	
	$SubManager = $GLOBALS['SUBMANAGER'];
	if ($SubManager === TRUE) {
		$HeaderConfigurationFileName = '../../../Configuration/Displays/Header/SubManagerSettings.ini';
	} else {
		$HeaderConfigurationFileName = '../../Configuration/Displays/Header/Settings.ini';
	}
	
	if (file_exists($HeaderConfigurationFileName)) {
		$HeaderConfiguration = parse_ini_file($HeaderConfigurationFileName, true);
	} else {
		$HeaderConfiguration = NULL;
	}
	
	$AdminPage = $GLOBALS['ADMINPAGE'];
	if ($SubManager === TRUE) {
		$SubAdminPage = $GLOBALS['SUBADMINPAGE'];
	}
	
	if ($AdminPage != NULL) {
		if ($SubManager === TRUE) {
			$AdminPageConfigurationFileName = '../../../Configuration/Managers/' . $AdminPage . '/' . $SubAdminPage . '/Settings.ini';
		} else {
			$AdminPageConfigurationFileName = '../../Configuration/Managers/' . $AdminPage . '/Settings.ini';
		}
		if (file_exists($AdminPageConfigurationFileName)) {
			$AdminPageConfiguration = parse_ini_file($AdminPageConfigurationFileName, true);
		} else {
			$AdminPageConfigurationFileName = NULL;
			$AdminPageConfiguration = NULL;
		}
	} else {
		$AdminPageConfigurationFileName = NULL;
		$AdminPageConfiguration = NULL;
	}
	
	$DisplayTitle = $AdminPageConfiguration['General Configuration']['DisplayTitle'];
	
	$Page->startDTD('html');
	$Page->endDTD();

	$Page->startElement('html');

	$Page->startElement('head');

	$Page->startElement('meta');
	$Page->writeAttribute('http-equiv', 'Content-Type');
	$Page->writeAttribute('content', 'text/html; charset=utf-8');
	$Page->endElement(); //ENDS META

	$Page->startElement('title');
	$Page->text($DisplayTitle . " - One Solution CMS");
	$Page->endElement(); //END TITLE
	
	$Page->writeRaw("\n");
	
	// CSS INCLUDES
	$HrefFileArray = $HeaderConfiguration['CSS']['FileName'];
	if ($HrefFileArray != NULL & is_array($HrefFileArray) === TRUE) {
		foreach ($HrefFileArray as $HrefFile) {
			$Page->startElement('link');
			$Page->writeAttribute('rel', 'stylesheet');
			$Page->writeAttribute('type', 'text/css');
			$Page->writeAttribute('href', $HrefFile);
			$Page->endElement(); //ENDS LINK
		}
	
		$Page->writeRaw("\n");
	}
	
	// JAVASCRIPT INCLUDES
	$JavascriptFileArray = $HeaderConfiguration['JAVASCRIPT']['FileName'];
	if ($JavascriptFileArray != NULL & is_array($JavascriptFileArray) === TRUE) {
		foreach ($JavascriptFileArray as $JavascriptFile) {
			$Page->startElement('script');
			$Page->writeAttribute('type', 'text/javascript');
			$Page->writeAttribute('src', $JavascriptFile);
			$Page->fullEndElement(); //ENDS SCRIPT
		}
		
		$Page->writeRaw("\n");
	}
	
	// Check ADMINPAGE for what javascript and css files need to be included.
	$AdminPage = $GLOBALS['ADMINPAGE'];
	
	// CSS INCLUDES FOR CURRENT ADMIN PAGE
	$AdminPageHrefFileArray = $AdminPageConfiguration['CSS']['FileName'];
	if ($AdminPageHrefFileArray != NULL & is_array($AdminPageHrefFileArray) === TRUE) {
		foreach ($AdminPageHrefFileArray as $AdminPageHrefFile) {
			$Page->startElement('link');
			$Page->writeAttribute('rel', 'stylesheet');
			$Page->writeAttribute('type', 'text/css');
			$Page->writeAttribute('href', $AdminPageHrefFile);
			$Page->endElement(); //ENDS LINK
		}
	
		$Page->writeRaw("\n");
	}
	
	// JAVASCRIPT INCLUDES FOR CURRENT ADMIN PAGE
	$AdminPageJavascriptFileArray = $AdminPageConfiguration['JAVASCRIPT']['FileName'];
	if ($AdminPageJavascriptFileArray != NULL & is_array($AdminPageJavascriptFileArray) === TRUE) {
		foreach ($AdminPageJavascriptFileArray as $AdminPageJavascriptFile) {
			$Page->startElement('script');
			$Page->writeAttribute('type', 'text/javascript');
			$Page->writeAttribute('src', $AdminPageJavascriptFile);
			$Page->fullEndElement(); //ENDS SCRIPT
		}
		
		$Page->writeRaw("\n");
	}
	
	$Page->endElement(); //ENDS HEAD
?>