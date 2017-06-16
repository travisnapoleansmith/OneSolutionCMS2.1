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
	
	if ($SubManager === TRUE) {
		$MainMenuConfigurationFileName = '../../../Configuration/Displays/MainMenu/SubManagerSettings.ini';
	} else {
		$MainMenuConfigurationFileName = '../../Configuration/Displays/MainMenu/Settings.ini';
	}
	if (file_exists($MainMenuConfigurationFileName)) {
		$MainMenuConfiguration = parse_ini_file($MainMenuConfigurationFileName, true);
	} else {
		$MainMenuConfiguration = NULL;
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
	
	$Page->startElement('div');
	$Page->writeAttribute('id', 'MenusWrapper');
		$Page->startElement('div');
		$Page->writeAttribute('id', 'MainMenu');
			if ($MainMenuConfiguration != NULL) {
				if ($MainMenuConfiguration['Menu Items Text']['ItemText'] != NULL & is_array($MainMenuConfiguration['Menu Items Text']['ItemText'])) { 
					$Page->startElement('ul');
						foreach ($MainMenuConfiguration['Menu Items Text']['ItemText'] as $Key => $Text) {
							$Link = $MainMenuConfiguration['Menu Items Link']['ItemLink'][$Key];
							$Page->startElement('li');
								if ($Link != NULL) {
									$Page->startElement('a');
									$Page->writeAttribute('href', $Link);
										if ($Text == $AdminPageConfiguration['General Configuration']['MenuTitle']) {
											$Page->writeAttribute('class', 'Selected');	
										}
										$Page->startElement('span');
											$Page->startElement('span');
												$Page->text($Text);
											$Page->fullEndElement(); //ENDS SPAN
										$Page->fullEndElement(); //ENDS SPAN
									$Page->endElement(); //ENDS A
								} else {
									$Page->startElement('a');
									$Page->writeAttribute('href', '#');
										if ($Text == $AdminPageConfiguration['General Configuration']['MenuTitle']) {
											$Page->writeAttribute('class', 'Selected');	
										}
										$Page->startElement('span');
											$Page->startElement('span');
												$Page->text($Text);
											$Page->fullEndElement(); //ENDS SPAN
										$Page->fullEndElement(); //ENDS SPAN
									$Page->endElement(); //ENDS A
								}
							$Page->endElement(); //ENDS LI
						}
					$Page->endElement(); //ENDS UL
				}
			}
		$Page->endElement(); //ENDS DIV
	$Page->endElement(); //ENDS DIV
?>