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
	
	// MUST FIX CROSS OVER YEAR ISSUE AND USE PAGE VIEWS AS A GUIDE TO FIX HUMAN VIEWS ISSUE WHEN 0 HUMANS VIEW IT AND IT SHOWS UP AS 1
	
	if ($RefererPage == $ServerLocation . "/Administrators/Panel/Managers/StatsManager/StatsManager.php") {
		//if ($_SERVER['HTTP_X_REQUESTED_WITH'] === 'XMLHttpRequest') {
			set_time_limit(120);
			ini_set("memory_limit","512M");
			
			//error_reporting(0);
			
			$HOME = $_SERVER['SUBDOMAIN_DOCUMENT_ROOT'];
			$ADMINHOME = $HOME . '/Administrators/';
			$GLOBALS['HOME'] = $HOME;
			$GLOBALS['ADMINHOME'] = $ADMINHOME;
			
			$Type = $_GET['Type']; // ADStats, SiteStats
			$Name = $_GET['Name']; // Overall, Browsers, BrowsersVersions, Plugins, OS's, OSVersions, Languagues, Countries, IPAddresses only options
			$AdStatsPanelName = $_GET['AdStatsPanelName']; // ONLY USE FOR AD STATS; This will determine what the ad panel is being used.
			$ID = $_GET['ID']; // For AdStats -> AdvertiserID only
			$Range = $_GET['Range']; // Date Range
			$RangeType = $_GET['RangeType']; // Daily, Weekly, Monthly, Yearly, Range only options
			
			$PageListingsTable = 'ContentLayerVersion';
			$Page = new XMLWriter();
			$Page->openMemory();
		
			$Page->setIndent(4);
			
			// Includes all files
			//require_once ('Configuration/includes.php');
			
			require_once ("$ADMINHOME/Panel/Configuration/includes.php");
			
			$GridStatsDataConfigurationFileName = '../../../Configuration/Managers/StatsManager/ChartsData/Settings.ini';
			if (file_exists($GridStatsDataConfigurationFileName)) {
				$GridStatsDataConfiguration = parse_ini_file($GridStatsDataConfigurationFileName, true);
			} else {
				$GridStatsDataConfiguration = NULL;
			}
			
			$Page->startElement('data');
				$Tier2Databases = new DataAccessLayer();
				$Tier2Databases->setDatabaseAll ($credentaillogonarray[0], $credentaillogonarray[1], $credentaillogonarray[2], $credentaillogonarray[3], NULL);
				$Tier2Databases->buildModules('DataAccessLayerModules', 'DataAccessLayerTables', 'DataAccessLayerModulesSettings');
				
				$PageID = array();
				$PageID['CurrentVersion'] = 'true';
				$Tier2Databases->createDatabaseTable($PageListingsTable);
				$Tier2Databases->Connect($PageListingsTable);
				
				$Tier2Databases->pass ($PageListingsTable, 'setOrderbyname', array('Name' => 'PageID'));
				$Tier2Databases->pass ($PageListingsTable, 'setOrderbytype', array('Type' => 'ASC'));
				
				$Tier2Databases->pass ($PageListingsTable, 'setDatabaseRow', array('idnumber' => $PageID));
				$PageListings = $Tier2Databases->pass ($PageListingsTable, "getMultiRowField", array());
				$Tier2Databases->Disconnect($PageListingsTable);
				
				require_once('ChartsRange.php');
				
				if ($Type == 'AdStats') {
					
				} else if ($Type == 'SiteStats') {
					require_once('Modules/SiteStats/ChartsOverall/ChartsOverall.php');
				}
				
			$Page->fullEndElement(); //ENDS DATA
			
			$PageOutput = $Page->flush();
			header('Content-type: application/xml');
			print $PageOutput;
		
		//} else {
			//header("HTTP/1.0 404 Not Found");
		//}
	} else {
		header("HTTP/1.0 404 Not Found");
	}
?>