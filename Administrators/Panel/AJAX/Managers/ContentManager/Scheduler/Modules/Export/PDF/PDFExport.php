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
	if ($RefererPage == $ServerLocation . "/Administrators/Panel/Managers/ContentManager/Scheduler/Scheduler.php") {
		// PDF Export
		require_once ("Modules/Export/PDF/pdfGenerator.php");
		require_once ("Modules/Export/PDF/pdfWrapper.php");
		require_once ("Modules/Export/PDF/tcpdf_ext.php");
		
		if (get_magic_quotes_gpc()) {
			$XMLString = stripslashes($_POST['mycoolxmlbody']);
		} else {
			$XMLString = $_POST['mycoolxmlbody'];
		}
		$XMLString = urldecode($XMLString);
		
		$XML = new SimpleXMLElement($XMLString, LIBXML_NOCDATA);
		
		$PDF = new schedulerPDF();
		//$PDF->printScheduler($XML);
		//$PDF->printScheduler($XML, 'I');  // Display In The Browser
		if ($_GET['Print'] === 'TRUE') {
			$PDF->printScheduler($XML, 'I');  // Display In The Browser
		} else {
			$PDF->printScheduler($XML, 'D');	// Download File
		}
	} else {
		header("HTTP/1.0 404 Not Found");
	}
?>