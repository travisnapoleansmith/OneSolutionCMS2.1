<?php
	// Includes all files
	require_once ("../../../Configuration/includes.php");

	$TableIdNumber = Array();
	if (is_numeric($_GET['TableID'])) {
		$TableIdNumber['TableID'] = $_GET['TableID'];
	} else {
		$TableIdNumber['TableID'] = 0;
	}

	$TableDatabase = Array();
	$TableDatabase['DatabaseTable1'] = 'XhtmlTableLookup';
	$TableDatabase['DatabaseTable2'] = 'XhtmlTableListing';

	$DatabaseOptions = array();
	$DatabaseOptions['DHtmlXGrid'] = TRUE;
	//$DatabaseOptions['FileName'] = 'sitemap.xml';

	$Tier6Databases = $GLOBALS['Tier6Databases'];

	$Table = new XhtmlTable ($TableDatabase, $DatabaseOptions, $Tier6Databases);
	$Table->setDatabaseAll ($credentaillogonarray[0], $credentaillogonarray[1], $credentaillogonarray[2], $credentaillogonarray[3], 'XhtmlTableLookup');
	$Table->setHttpUserAgent($_SERVER['HTTP_USER_AGENT']);
	$Table->FetchDatabase ($TableIdNumber);
	$Table->CreateOutput('    ');

	$pageoutput = $Writer->flush();

	// Removing Caching by the browser!
	header('Content-type: text/xml');
	header("Cache-Control: no-cache, must-revalidate");
	header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");
	if ($pageoutput) {
		print "$pageoutput\n";
	} else {
		header("Location: XmlDHtmlXGridTable.xml");
	}
?>