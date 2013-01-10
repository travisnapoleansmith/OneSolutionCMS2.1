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
	$idnumber = Array();
	$idnumber['PageID'] = 1;
	if ($_GET['PageID']){
		$idnumber['PageID'] = $_GET['PageID'];
	}

	if (isset($_GET['RevisionID'])){
		$idnumber['RevisionID'] = $_GET['RevisionID'];
	} else {
		$idnumber['CurrentVersion'] = 'true';
	}

	if ($_GET['Theme']){
		$idnumber['Theme'] = $_GET['Theme'];
	}
	// Fetch PrintPreview Flag
	if ($_GET['printpreview']){
		$printpreview = $_GET['printpreview'];
	} else {
		$printpreview = FALSE;
	}

	// Fetch Userdefined StyleSheet
	if ($_GET['StyleSheet']){
		$stylesheet = $_GET['StyleSheet'];
	} else {
		$stylesheet = FALSE;
	}
	// Prints Out Header Information On Page ID
	$headerdatabase = Array();
	$headerdatabase['PageAttributes'] = 'PageAttributes';
	$headerdatabase['ContentLayerTheme'] = 'ContentLayerTheme';

	$databaseoptions = Array();
	$credentaillogonarray = $GLOBALS['credentaillogonarray'];
	$Tier6Databases = $GLOBALS['Tier6Databases'];

	$header = new XhtmlHeader($headerdatabase, $databaseoptions, $Tier6Databases);
	$header->setDatabaseAll ($credentaillogonarray[0], $credentaillogonarray[1], $credentaillogonarray[2], $credentaillogonarray[3], 'PageAttributes');
	$header->setHttpUserAgent($_SERVER['HTTP_USER_AGENT']);

	$header->FetchDatabase ($idnumber);

	$header->setSiteName($sitename);

	$header->CreateOutput ($printpreview, $stylesheet);

?>