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

	// Fetch Current Page ID - Based On ID Number
	$contentidnumber = Array();
	$contentidnumber['PageID'] = 1;
	$contentidnumber['ObjectID'] = 0;

	if ($_GET['PageID']){
		$contentidnumber['PageID'] = $_GET['PageID'];
	}

	if (isset($_GET['RevisionID'])){
		$contentidnumber['RevisionID'] = $_GET['RevisionID'];
	} else {
		$contentidnumber['CurrentVersion'] = 'true';
	}

	if ($_GET['CurrentVersion']){
		$contentidnumber['CurrentVersion'] = $_GET['CurrentVersion'];
	}

	if ($_GET['printpreview']) {
		$contentidnumber['printpreview'] = TRUE;
	} else {
		$contentidnumber['printpreview'] = FALSE;
	}

	$contentdatabase = Array();
	$contentdatabase['Content'] = 'Content';
	$contentdatabase['ContentLayerTables'] = 'ContentLayerTables';
	$contentdatabase['ContentPrintPreview'] = 'ContentPrintPreview';
	$contentdatabase['ContentLayerModules'] = 'ContentLayerModules';

	//$databases = &$GLOBALS['Tier6Databases'];
	$databaseoptions = Array();

	$credentaillogonarray = $GLOBALS['credentaillogonarray'];
	$Tier6Databases = $GLOBALS['Tier6Databases'];

	$content = new XhtmlContent($contentdatabase, $databaseoptions, $Tier6Databases);
	$content->setDatabaseAll ($credentaillogonarray[0], $credentaillogonarray[1], $credentaillogonarray[2], $credentaillogonarray[3], 'Content');
	$content->setHttpUserAgent($_SERVER['HTTP_USER_AGENT']);
	$content->FetchDatabase ($contentidnumber);
	//$content->CreateOutput('    ');

	//$contentoutput = $content->getOutput();
	//if ($contentoutput) {
		$Writer->startElement('div');
		$Writer->writeAttribute('id', 'main-content-top');
		$Writer->fullEndElement();

		//$Writer->writeRaw($contentoutput);
		$content->CreateOutput('    ');
		$Writer->startElement('div');
		$Writer->writeAttribute('id', 'main-content-bottom');
		$Writer->fullEndElement();
	//} else {
		/*$Writer->startElement('div');
		$Writer->writeAttribute('id', 'main-content-top');
		$Writer->fullEndElement();

		$Writer->startElement('div');
		$Writer->writeAttribute('id', 'main-content-middle-empty');
		$Writer->fullEndElement();

		$Writer->startElement('div');
		$Writer->writeAttribute('id', 'main-content-bottom-empty');
		$Writer->fullEndElement();
	}*/
	//print "$contentoutput";

?>