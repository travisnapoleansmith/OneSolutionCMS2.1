<?php
	// Includes all files
	require_once ("../../../Configuration/includes.php");
	
	$SimpleViewerIdNumber = Array();
	if (is_numeric($_GET['PageID'])) {
		$SimpleViewerIdNumber['PageID'] = $_GET['PageID'];
	} else {
		$SimpleViewerIdNumber['PageID'] = 1;
	}
	if (is_numeric($_GET['ObjectID'])) {
		$SimpleViewerIdNumber['ObjectID'] = $_GET['ObjectID'];
	} else if (is_numeric($_GET['amp;ObjectID'])){
		$SimpleViewerIdNumber['ObjectID'] = $_GET['amp;ObjectID'];
	} else {
		$SimpleViewerIdNumber['ObjectID'] = 1;
	}
	$SimpleViewerIdNumber['RevisionID'] = 1;
	$SimpleViewerIdNumber['CurrentVersion'] = 'true';
	
	$SimpleViewerDatabase = Array();
	$SimpleViewerDatabase['XMLSimpleViewerLookup'] = 'XMLSimpleViewerLookup';
	
	$DatabaseOptions = array();
	//$DatabaseOptions['FileName'] = 'sitemap.xml';
	
	$Tier6Databases = $GLOBALS['Tier6Databases'];
	
	$SimpleViewer = new XmlSimpleViewer ($SimpleViewerDatabase, $DatabaseOptions, $Tier6Databases);
	$SimpleViewer->setDatabaseAll ($credentaillogonarray[0], $credentaillogonarray[1], $credentaillogonarray[2], $credentaillogonarray[3], 'XMLSimpleViewerLookup');
	$SimpleViewer->setHttpUserAgent($_SERVER['HTTP_USER_AGENT']);
	$SimpleViewer->FetchDatabase ($SimpleViewerIdNumber);
	$SimpleViewer->CreateOutput('    ');
	
	$pageoutput = $Writer->flush();
	
	// Removing Caching by the browser!
	header('Content-type: text/xml');
	header("Cache-Control: no-cache, must-revalidate");
	header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");
	if ($pageoutput) {
		print "$pageoutput\n";
	} else {
		header("Location: XmlSimpleViewer.xml");
	}
?>