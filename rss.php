<?php
	// Includes all files
	require_once ('Configuration/includes.php');
	
	$feedidnumber = Array();
	$feedidnumber['PageID'] = 1;
	
	$feeddatabase = Array();
	$feeddatabase['XMLFeeds'] = 'XMLFeeds';
	
	$databaseoptions = array();
	$databaseoptions['Screen'] = TRUE;
	//$databaseoptions['FileName'] = 'rss.xml';
	
	$Tier6Databases = $GLOBALS['Tier6Databases'];
	
	$feed = new XmlFeed($feeddatabase, $databaseoptions, $Tier6Databases);
	$feed->setDatabaseAll ($credentaillogonarray[0], $credentaillogonarray[1], $credentaillogonarray[2], $credentaillogonarray[3], 'XMLFeeds');
	$feed->setHttpUserAgent($_SERVER['HTTP_USER_AGENT']);
	$feed->FetchDatabase ($feedidnumber);
	$feed->CreateOutput('    ');
	
	$feedoutput = $feed->getOutput();
	
	// Removing Caching by the browser!
	header("Cache-Control: no-cache, must-revalidate");
	header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");
	if ($feedoutput) {
		header('Content-type: text/xml');
		print "$feedoutput\n";
	} else {
		header("Location: rss.xml");
	}
?>