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

	// Fetch Current Page ID - Based on filename
	//$pagename = $_SERVER['PHP_SELF'];
	//$directory = dirname($_SERVER['PHP_SELF']);
	//$directory .= '/';
	//$pagename = str_replace($directory, ' ', $pagename);
	//$pagename = trim($pagename);
	//if ($pagename[0] == '/') {
		//$pagename[0] = '';
		//$pagename = trim($pagename);
	//}
	
	$ThemeLocation = $GLOBALS['ThemeLocation'];
	
	// Fetch Current Page ID - Based On ID Number
	$mainmenuidnumber = Array();
	$mainmenuidnumber['PageID'] = 1;

	if ($_GET['PageID']){
		$mainmenuidnumber['PageID'] = $_GET['PageID'];
	}

	$mainmenudatabase = array();
	$mainmenudatabase['MainMenuLookup'] = 'MainMenuLookup';
	$mainmenudatabase['MainMenu'] = 'MainMenu';

	$SiteName = $GLOBALS['sitename'];

	$databaseoptions = NULL;
	if (strstr($_SERVER['HTTP_USER_AGENT'], 'MSIE 6.0')) {
		if (empty($ThemeLocation)) {
			$databaseoptions['JavaScriptFileName'] = 'Tier7-BehavioralLayer/$ThemeName/menu-jquery.js';
		} else {
			$databaseoptions['JavaScriptFileName'] = "$ThemeLocation/Tier7-BehavioralLayer/$ThemeName/menu-jquery.js";
		}
		$databaseoptions['JavaScriptLibraryName'] = 'Libraries/Tier7BehavioralLayer/jQuery/jquery-1.3.2.min.js';
	}

	$databaseoptions['MainMenuID'] = 'main-menu';
	$databaseoptions['MainMenuClass'] = NULL;
	$databaseoptions['MainMenuStyle'] = NULL;
	$databaseoptions['MainMenuInsert'] = NULL;

	$databaseoptions['MainMenuTopID'] = 'main-menu-top';
	$databaseoptions['MainMenuTopClass'] = NULL;
	$databaseoptions['MainMenuTopStyle'] = NULL;
	$databaseoptions['MainMenuTopInsert'] = NULL;

	$databaseoptions['MainMenuBottomID'] = 'main-menu-bottom';
	$databaseoptions['MainMenuBottomClass'] = NULL;
	$databaseoptions['MainMenuBottomStyle'] = NULL;
	$databaseoptions['MainMenuBottomInsert'] = NULL;

	if ($GLOBALS['ThemeName']) {
		$ThemeName = $GLOBALS['ThemeName'];
		if (empty($ThemeLocation)) {
			$Insert = "$HOME/Tier8-PresentationLayer/$ThemeName/TemplateImages/Main-Logo.png";
		} else {
			$Insert = "$HOME/$ThemeLocation/Tier8-PresentationLayer/$ThemeName/TemplateImages/Main-Logo.png";
		}
		
		$databaseoptions['Insert'] = "<img src=\"$Insert\" alt=\"";
		$databaseoptions['Insert'] .= $SiteName;
		$databaseoptions['Insert'] .= '" class="main-menu-image"/>';
	} else {
		$databaseoptions['Insert'] = '<img src="Images/Main-Logo.png"alt="';
		$databaseoptions['Insert'] .= $SiteName;
		$databaseoptions['Insert'] .= '" class="main-menu-image"/>';
	}

	$credentaillogonarray = $GLOBALS['credentaillogonarray'];
	$Writer = $GLOBALS['Writer'];
	$Tier6Databases = $GLOBALS['Tier6Databases'];

	if (strstr($_SERVER['HTTP_USER_AGENT'], 'MSIE 6.0')) {
		$Writer->startElement('script');
		$Writer->writeAttribute('type', 'text/javascript');
		$Writer->writeAttribute('src', 'Libraries/Tier7BehavioralLayer/IEPngFix/iepngfix_tilebg.js');
		$Writer->fullEndElement();
		$Writer->writeRaw("\n");
	}

	$mainmenu = new XhtmlMainMenu($mainmenudatabase, $databaseoptions, $Tier6Databases);
	$mainmenu->setDatabaseAll ($credentaillogonarray[0], $credentaillogonarray[1], $credentaillogonarray[2], $credentaillogonarray[3], 'MainMenuLookupNew');
	$mainmenu->setHttpUserAgent($_SERVER['HTTP_USER_AGENT']);
	$mainmenu->FetchDatabase ($mainmenuidnumber);
	$mainmenu->CreateOutput('    ');
?>