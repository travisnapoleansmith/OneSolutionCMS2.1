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
	
	$Page = new XMLWriter();
	$Page->openMemory();

	$Page->setIndent(4);
	
	// Includes all files
	//require_once ('Configuration/includes.php');
	
	require_once ("$ADMINHOME/Panel/Configuration/includes.php");
	
	require_once ("$ADMINHOME/Panel/Displays/Header/Header.php");
	
	$Page->startElement('body');
	$Page->writeAttribute('onload', 'afterLoad();');
	
	// CALL ALL MODULES
	require_once ("$ADMINHOME/Panel/Displays/Background/Background.php");
	require_once ("$ADMINHOME/Panel/Displays/TopPanel/TopPanel.php");
	require_once ("$ADMINHOME/Panel/Displays/MainMenu/MainMenu.php");
	require_once ("$ADMINHOME/Panel/Managers/ContentManager/Scheduler/FullPageContentPanel.php");
	require_once ("$ADMINHOME/Panel/Displays/BottomPanel/BottomPanelFooter.php");
	
	$Page->fullEndElement(); //ENDS BODY
	
	$PageOutput = $Page->flush();
	print $PageOutput;
?>