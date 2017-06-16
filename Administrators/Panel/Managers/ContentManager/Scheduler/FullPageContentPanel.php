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
	$Page->writeAttribute('id', 'ContentPanel');
		$Page->startElement('div');
		$Page->writeAttribute('id', 'FullPage');
			/*$Page->startElement('div');
			$Page->writeAttribute('class', 'Top');
				$Page->startElement('div');
				$Page->writeAttribute('id', 'Menu');
				$Page->fullEndElement(); //ENDS DIV
			$Page->fullEndElement(); //ENDS DIV
			*/
			$Page->startElement('div');
			$Page->writeAttribute('class', 'Inner Section');
				$Page->startElement('div');
					//$Page->writeAttribute('style', 'width: 100%');
					//$Page->writeAttribute('style', 'height:20px; padding:5px 10px;');
					$Page->writeAttribute('id', 'ExportToolbar');
					//$Page->writeAttribute('style', 'height: 20px; width: 100%');
				$Page->fullEndElement(); // ENDS DIV
				
				$Page->startElement('form');
					$Page->writeAttribute('action', '../../../AJAX/Managers/ContentManager/Scheduler/Events.php');
					$Page->writeAttribute('method', 'post');
					$Page->writeAttribute('target', 'hidden_frame');
					$Page->writeAttribute('accept-charset', 'utf-8');
					
					$Page->startElement('input');
						$Page->writeAttribute('type', 'hidden');
						$Page->writeAttribute('name', 'Format');
						$Page->writeAttribute('value', '');
						$Page->writeAttribute('id', 'Format');
					$Page->endElement(); // ENDS INPUT
					$Page->startElement('input');
						$Page->writeAttribute('type', 'hidden');
						$Page->writeAttribute('name', 'Type');
						$Page->writeAttribute('value', '');
						$Page->writeAttribute('id', 'Type');
					$Page->endElement(); // ENDS INPUT
				$Page->fullEndElement(); // ENDS FORM
				
				$Page->startElement('div');
					$Page->writeAttribute('id', 'ImportBox');
					$Page->writeAttribute('style', 'position: relative; height: 10px; z-index: 50; overflow: visible;');
				$Page->fullEndElement(); //ENDS DIV
				
				$Page->startElement('div');
				$Page->writeAttribute('id', 'Content');
				$Page->writeAttribute('class', 'Content dhx_cal_container');
				$Page->writeAttribute('style', 'height: 750px; width: 100%; top: -50px; margin-bottom: -50px;');
					//$Page->startElement('div');
					//$Page->writeAttribute('id', 'scheduler_here');
					//$Page->writeAttribute('class', 'dhx_cal_container');
					//$Page->writeAttribute('style', 'width:100%; height:100%; padding:10px;');
						
						
						$Page->startElement('div');
						$Page->writeAttribute('class', 'dhx_cal_navline');
							$Page->startElement('div');
							$Page->writeAttribute('class', 'dhx_cal_prev_button');
							$Page->fullEndElement(); //ENDS DIV
							
							$Page->startElement('div');
							$Page->writeAttribute('class', 'dhx_cal_next_button');
							$Page->fullEndElement(); //ENDS DIV
							
							$Page->startElement('div');
							$Page->writeAttribute('class', 'dhx_cal_today_button');
							$Page->fullEndElement(); //ENDS DIV
							
							$Page->startElement('div');
							$Page->writeAttribute('class', 'dhx_cal_date');
							$Page->fullEndElement(); //ENDS DIV
							
							$Page->startElement('div');
							$Page->writeAttribute('class', 'dhx_cal_tab');
							$Page->writeAttribute('name', 'day_tab');
							$Page->writeAttribute('style', 'right:268px;');
							$Page->fullEndElement(); //ENDS DIV
							
							$Page->startElement('div');
							$Page->writeAttribute('class', 'dhx_cal_tab');
							$Page->writeAttribute('name', 'week_tab');
							$Page->writeAttribute('style', 'right:204px;');
							$Page->fullEndElement(); //ENDS DIV
							
							$Page->startElement('div');
							$Page->writeAttribute('class', 'dhx_cal_tab');
							$Page->writeAttribute('name', 'month_tab');
							$Page->writeAttribute('style', 'right:140px;');
							$Page->fullEndElement(); //ENDS DIV
							
							$Page->startElement('div');
							$Page->writeAttribute('class', 'dhx_cal_tab');
							$Page->writeAttribute('name', 'year_tab');
							$Page->writeAttribute('style', 'right:76px;');
							$Page->fullEndElement(); //ENDS DIV
							
							$Page->startElement('div');
							$Page->writeAttribute('class', 'dhx_cal_tab');
							$Page->writeAttribute('name', 'agenda_tab');
							$Page->writeAttribute('style', 'right:344px;');
							$Page->fullEndElement(); //ENDS DIV
						$Page->fullEndElement(); //ENDS DIV
						
						$Page->startElement('div');
						$Page->writeAttribute('class', 'dhx_cal_header');
						$Page->fullEndElement(); //ENDS DIV
						
						$Page->startElement('div');
						$Page->writeAttribute('class', 'dhx_cal_data');
						$Page->fullEndElement(); //ENDS DIV
					//$Page->fullEndElement(); //ENDS DIV
				$Page->fullEndElement(); //ENDS DIV
			$Page->fullEndElement(); //ENDS DIV
		$Page->endElement(); //ENDS DIV
	$Page->endElement(); //ENDS DIV
	
	/*$HeaderConfigurationFileName = '../../Configuration/Displays/Header/Settings.ini';
	if (file_exists($HeaderConfigurationFileName)) {
		$HeaderConfiguration = parse_ini_file($HeaderConfigurationFileName, true);
	} else {
		$HeaderConfiguration = NULL;
	}
	*/
?>