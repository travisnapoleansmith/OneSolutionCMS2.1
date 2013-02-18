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

	$SimpleViewerIdNumber = Array();
	if (is_numeric($_GET['PageID'])) {
		$SimpleViewerIdNumber['PageID'] = $_GET['PageID'];
	} else {
		$SimpleViewerIdNumber['PageID'] = 1;
	}
	$SimpleViewerIdNumber['ObjectID'] = 1;
	$SimpleViewerIdNumber['RevisionID'] = 1;
	$SimpleViewerIdNumber['CurrentVersion'] = 'true';

	$SimpleViewerDatabase = Array();
	$SimpleViewerDatabase['XMLSimpleViewerLookup'] = 'XMLSimpleViewerLookup';

	$DatabaseOptions = array();
	//$DatabaseOptions['FileName'] = 'sitemap.xml';

	$Tier6Databases = $GLOBALS['Tier6Databases'];

	$Location = array();
	$Location['imageURL'] = '../../../../UserData/Images/SimpleViewer/images/2012/Highgate/WorkStockTrucks/';
	$Location['thumbURL'] = '../../../../UserData/Images/SimpleViewer/thumbs/2012/Highgate/WorkStockTrucks/';
	$Location['linkURL'] = '../../../../UserData/Images/SimpleViewer/images/2012/Highgate/WorkStockTrucks/';

	$SimpleViewer = new XmlSimpleViewer ($SimpleViewerDatabase, $DatabaseOptions, $Tier6Databases);
	$SimpleViewer->setDatabaseAll ($credentaillogonarray[0], $credentaillogonarray[1], $credentaillogonarray[2], $credentaillogonarray[3], 'XMLSimpleViewerLookup');
	$SimpleViewer->setHttpUserAgent($_SERVER['HTTP_USER_AGENT']);
	$SimpleViewer->FetchDatabase ($SimpleViewerIdNumber);

	//$SimpleViewer->importGalleryFile('../../../../UserData/Images/SimpleViewer/2012HighgateWorkStockTrucks.xml', $Location);

	print "Utility Completed For PageID ";
	print $SimpleViewerIdNumber['PageID'];
	print "\n";

	//$filename = '../../../../UserData/Images/SimpleViewer/2012Plattsburgh4x4Trucks.xml';

	//if (file_exists($filename)) {
	    //print "The file $filename exists";
	//} else {
	    //print "The file $filename does not exist";
	//}

	//print_r($ErrorMessage);
?>
