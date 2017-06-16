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
	$RefererPage = $_SERVER['HTTP_REFERER'];
	$RefererPageArray = explode('?', $RefererPage);
	$RefererPage = $RefererPageArray[0];
	$ServerLocation = "http://" . $_SERVER['SERVER_NAME'];
	
	unset($RefererPageArray);
	
	if ($RefererPage == $ServerLocation . "/Administrators/Panel/Managers/StatsManager/StatsManager.php") {
		if ($_SERVER['HTTP_X_REQUESTED_WITH'] === 'XMLHttpRequest') {
			set_time_limit(120);
			
			//error_reporting(0);
			
			$HOME = $_SERVER['SUBDOMAIN_DOCUMENT_ROOT'];
			$ADMINHOME = $HOME . '/Administrators/';
			$GLOBALS['HOME'] = $HOME;
			$GLOBALS['ADMINHOME'] = $ADMINHOME;
			
			$TableDatabase = Array();
			$TableDatabase['DatabaseTable1'] = 'AdPanelLookup';
		
			$DatabaseOptions = array();
			//$DatabaseOptions['FileName'] = 'sitemap.xml';
		
			$Page = new XMLWriter();
			$Page->openMemory();
		
			$Page->setIndent(4);
			
			// Includes all files
			//require_once ('Configuration/includes.php');
			
			require_once ("$ADMINHOME/Panel/Configuration/includes.php");
			
			$Tier2Databases = new DataAccessLayer();
			$Tier2Databases->setDatabaseAll ($credentaillogonarray[0], $credentaillogonarray[1], $credentaillogonarray[2], $credentaillogonarray[3], NULL);
			$Tier2Databases->buildModules('DataAccessLayerModules', 'DataAccessLayerTables', 'DataAccessLayerModulesSettings');
			
			$Tier2Databases->createDatabaseTable("AdPanelLookup");
			$Tier2Databases->Connect("AdPanelLookup");
			$Tier2Databases->pass ("AdPanelLookup", "setEntireTable", array());
			$AdPanelListings= $Tier2Databases->pass ("AdPanelLookup", "getEntireTable", array());
			$Tier2Databases->Disconnect("AdPanelLookup");
			
			$Page->startElement('data');
				$Page->startElement('item');
				$Page->writeAttribute('value', '');
				$Page->writeAttribute('label', '');
				$Page->endElement(); // ENDS ITEM
				
				if (is_array($AdPanelListings)) {
					foreach ($AdPanelListings as $Key => $Data) {
						$Value = $Data['AdvertisingTableName'];
						$Label = $Data['AdPanelName'];
						$Page->startElement('item');
						$Page->writeAttribute('value', $Value);
						$Page->writeAttribute('label', $Label);
						$Page->endElement(); // ENDS ITEM
					}
				}
			
			$Page->fullEndElement(); //ENDS BODY
			
			$PageOutput = $Page->flush();
			header('Content-type: text/xml');
			print $PageOutput;
		
		} else {
			header("HTTP/1.0 404 Not Found");
		}
	} else {
		header("HTTP/1.0 404 Not Found");
	}
?>