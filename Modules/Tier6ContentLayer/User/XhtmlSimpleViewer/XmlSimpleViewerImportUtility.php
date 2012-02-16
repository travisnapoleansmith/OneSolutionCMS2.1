<?php
	// Includes all files
	require_once ("../../../Configuration/includes.php");
	
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
	$Location['imageURL'] = '../../../../Images/SimpleViewer/images/2011/Plattsburgh/StreetLegalTrucks/';
	$Location['thumbURL'] = '../../../../Images/SimpleViewer/thumbs/2011/Plattsburgh/StreetLegalTrucks/';
	$Location['linkURL'] = '../../../../Images/SimpleViewer/images/2011/Plattsburgh/StreetLegalTrucks/';
	
	$SimpleViewer = new XmlSimpleViewer ($SimpleViewerDatabase, $DatabaseOptions, $Tier6Databases);
	$SimpleViewer->setDatabaseAll ($credentaillogonarray[0], $credentaillogonarray[1], $credentaillogonarray[2], $credentaillogonarray[3], 'XMLSimpleViewerLookup');
	$SimpleViewer->setHttpUserAgent($_SERVER['HTTP_USER_AGENT']);
	$SimpleViewer->FetchDatabase ($SimpleViewerIdNumber);
	
	//$SimpleViewer->importGalleryFile('../../../Images/SimpleViewer/StreetLegalTrucks.xml', $Location);
	
	print "Utility Completed For PageID ";
	print $SimpleViewerIdNumber['PageID'];
	print "\n";
	
?>
