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
	error_reporting(0);
	
	// Includes all files
	require_once ('Configuration/includes.php');
	
	// Fetch idnumber For Current Page
	$idnumber = 1;
	if ($_GET['PageID']){
		$idnumber = $_GET['PageID'];
	}

	$idnumberkeep = $idnumber;
	$printpreview = NULL;

	$Tier6Databases->setDatabaseTableName('ContentLayer');

	if ($_GET['printpreview']) {
		$printpreview = TRUE;
	} else {
		$printpreview = FALSE;
	}

	$Tier6Databases->setPrintPreview($printpreview);
	
	// Fetch Current Page ID - Based On ID Number
	$contentidnumber = Array();
	$contentidnumber['PageID'] = $idnumber;
	$contentidnumber['Enable/Disable'] = 'Enable';
	$contentidnumber['Status'] = 'Approved';

	if (isset($_GET['RevisionID'])){
		$contentidnumber['RevisionID'] = $_GET['RevisionID'];
	} else {
		$contentidnumber['CurrentVersion'] = 'true';
	}
	
	$Tier6Databases->FetchDatabase($contentidnumber);
	$Tier6Databases->CreateOutput(NULL);

	$output = $Writer->flush();
	if ($output) {
		//header ("Content-type: application/xhtml+xml");
		print "$output\n";
	} else {
		header("HTTP/1.0 404 Not Found");
	}

?>
