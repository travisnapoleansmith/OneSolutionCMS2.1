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
	
	$HOME = $_SERVER['SUBDOMAIN_DOCUMENT_ROOT'];
	$ADMINHOME = $HOME . '/Administrators/';
	$GLOBALS['HOME'] = $HOME;
	$GLOBALS['ADMINHOME'] = $ADMINHOME;
		
	// Includes all files
	//require_once ('Configuration/includes.php');
	
	require_once ("$ADMINHOME/Panel/Configuration/includes.php");
	
	$SubManager = $GLOBALS['SUBMANAGER'];
	
	$Page->startElement('div');
	$Page->writeAttribute('id', 'BackgroundImage');
		$Page->startElement('img');
		$Page->writeAttribute('id', 'Background');
		$Page->writeAttribute('alt', 'Background Image');
		if ($SubManager === TRUE) {
			$Page->writeAttribute('src', '../../../../../Tier8-PresentationLayer/AdministratorsPanel/Images/Main-Background.jpg');
		} else {
			$Page->writeAttribute('src', '../../../../Tier8-PresentationLayer/AdministratorsPanel/Images/Main-Background.jpg');
		}
		$Page->endElement(); //ENDS IMG
	$Page->endElement(); //ENDS DIV
	
	/*$HeaderConfigurationFileName = '../../Configuration/Displays/Header/Settings.ini';
	if (file_exists($HeaderConfigurationFileName)) {
		$HeaderConfiguration = parse_ini_file($HeaderConfigurationFileName, true);
	} else {
		$HeaderConfiguration = NULL;
	}
	*/
?>