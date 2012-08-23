<?php
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
