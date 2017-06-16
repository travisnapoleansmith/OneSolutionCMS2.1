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
	if ($_SERVER['HTTP_REFERER'] != NULL) {
		if ($_SERVER['HTTP_X_REQUESTED_WITH'] === 'XMLHttpRequest') {
			require_once ("../../../../Configuration/includes.php");
			
			$Year = date('Y');
			$SiteStatsBrowserStatsTableName = "SiteStatsBrowserStats" . $Year;
			
			$Tier6Databases->ModulePass('XhtmlSiteStats','sitestats','setSiteStatsBrowserStatTableName',array($SiteStatsBrowserStatsTableName));
			
			$PageID = Array();
			$PageID['PageID'] = 1;
		
			if ($_GET['PageID']){
				$PageID['PageID'] = $_GET['PageID'];
			}
			
			$Tier6Databases = $GLOBALS['Tier6Databases'];
			
			$Tier6Databases->ModulePass('XhtmlSiteStats','sitestats','FetchDatabase',$PageID);
			$SiteStatEntry = $Tier6Databases->ModulePass('XhtmlSiteStats','sitestats','createSiteStatBrowserStatLogEntry',array());
			$Tier6Databases->ModulePass('XhtmlSiteStats','sitestats','createSiteStatBrowserStatLog',$SiteStatEntry);
			
			/////$Tier6Databases->ModulePass('XhtmlSiteStats','sitestats','CreateOutput', array('Space' => NULL));
		} else {
			header("HTTP/1.0 404 Not Found");
		}
	} else {
		header("HTTP/1.0 404 Not Found");
	}
?>