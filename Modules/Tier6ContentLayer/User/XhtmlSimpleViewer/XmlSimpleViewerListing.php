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

	// Includes all files
	require_once ("../../../../Configuration/includes.php");

	/*$TableIdNumber = Array();
	if (is_numeric($_GET['TableID'])) {
		$TableIdNumber['TableID'] = $_GET['TableID'];
	} else {
		$TableIdNumber['TableID'] = 0;
	}*/

	$TableDatabase = Array();
	$TableDatabase['DatabaseTable1'] = 'XMLSimpleViewerLookup';

	$DatabaseOptions = array();
	$DatabaseOptions['NoOutput'] = TRUE;

	$Tier6Databases = $GLOBALS['Tier6Databases'];

	$SimpleViewer = new XMLSimpleViewer ($TableDatabase, $DatabaseOptions, $Tier6Databases);
	$SimpleViewer->setDatabaseAll ($credentaillogonarray[0], $credentaillogonarray[1], $credentaillogonarray[2], $credentaillogonarray[3], 'XMLSimpleViewerLookup');
	$SimpleViewer->setHttpUserAgent($_SERVER['HTTP_USER_AGENT']);
	$SimpleViewer->FetchXMLSimpleViewerGalleryListing('XMLSimpleViewerLookup');
	
	$XMLTables = $SimpleViewer->getXMLSimpleViewerGalleryListing();

	$OutputXMLTables = array();
	
	foreach($XMLTables as $Key => $Data) {
		if ($Data['PageID'] != NULL) {
			$OutputXMLTables[$Data['PageID']] = array();
			$OutputXMLTables[$Data['PageID']]['GalleryID'] = $Data['PageID'];
			$OutputXMLTables[$Data['PageID']]['GalleryName'] = $Data['XMLSimpleViewerName'];
		}
	}
	
	$Writer->startDocument('1.0', 'utf-8');
	$Writer->startElement('SimpleViewerListings');
	foreach ($OutputXMLTables as $Key => $Data) {
		$Writer->startElement('Item');
			$Writer->startElement('GalleryID');
				$Writer->text($Data['GalleryID']);
			$Writer->endElement(); // ENDS GALLERYID

			$Writer->startElement('GalleryName');
				$Writer->text($Data['GalleryName']);
			$Writer->endElement(); // ENDS GALLERYNAME
		$Writer->endElement(); // ENDS ITEM;
	}
	$Writer->endElement(); // ENDS SIMPLEVIEWERLISTINGS
	$pageoutput = $Writer->flush();

	// Removing Caching by the browser!
	header('Content-type: text/xml');
	header("Cache-Control: no-cache, must-revalidate");
	header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");
	if ($pageoutput) {
		print "$pageoutput\n";
	} else {
		//header("Location: XmlTable.xml");
	}
?>