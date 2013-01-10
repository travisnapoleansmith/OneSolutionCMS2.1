<?php
	/*
	**************************************************************************************
	* One Solution CMS
	*
	* Copyright (c) 1999 - 2012 One Solution CMS
	*
	* This content management system is free software; you can redistribute it and/or
	* modify it under the terms of the GNU Lesser General Public
	* License as published by the Free Software Foundation; either
	* version 2.1 of the License, or (at your option) any later version.
	*
	* This library is distributed in the hope that it will be useful,
	* but WITHOUT ANY WARRANTY; without even the implied warranty of
	* MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU
	* Lesser General Public License for more details.
	*
	* You should have received a copy of the GNU Lesser General Public
	* License along with this library; if not, write to the Free Software
	* Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301  USA
	*
	* @copyright  Copyright (c) 1999 - 2013 One Solution CMS (http://www.onesolutioncms.com/)
	* @license    http://www.gnu.org/licenses/old-licenses/lgpl-2.1.txt	LGPL
	* @version    2.1.139, 2012-12-27
	*************************************************************************************
	*/

	///////////$credentaillogonarray = $GLOBALS['credentaillogonarray'];
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

	// Fetch Current Page ID - Based On ID Number

	$PageID = Array();
	$PageID['PageID'] = 1;

	if ($_GET['PageID']){
		$PageID['PageID'] = $_GET['PageID'];
	}

	$Tier6Databases = $GLOBALS['Tier6Databases'];

	$SiteStatPage = array();
	$SiteStatPage['PageID'] = $PageID['PageID'];
	$SiteStatPage['Count'] = 0;

	$Tier6Databases->ModulePass('XhtmlSiteStats','sitestats','FetchDatabase',$PageID);
	$ReturnPageID = $Tier6Databases->ModulePass('XhtmlSiteStats','sitestats','checkSiteStatPage',$PageID);
	if ($ReturnPageID == TRUE) {
		$Tier6Databases->ModulePass('XhtmlSiteStats','sitestats','updateSiteStatPage',$PageID);
	} else {
		$Tier6Databases->ModulePass('XhtmlSiteStats','sitestats','createSiteStatPage',$SiteStatPage);
		$Tier6Databases->ModulePass('XhtmlSiteStats','sitestats','FetchDatabase',$PageID);
		$Tier6Databases->ModulePass('XhtmlSiteStats','sitestats','updateSiteStatPage',$PageID);
	}

	//$Tier6Databases->ModulePass('XhtmlSiteStats','sitestats','deleteSiteStatPage',$PageID);

	$Tier6Databases->ModulePass('XhtmlSiteStats','sitestats','FetchDatabase',$PageID);
	$Tier6Databases->ModulePass('XhtmlSiteStats','sitestats','CreateOutput', array('Space' => NULL));

?>