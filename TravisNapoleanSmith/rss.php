<?php
	// Includes all files
	require_once ('Configuration/includes.php');
	
	$feedidnumber = Array();
	$feedidnumber['PageID'] = 1;
	
	$feeddatabase = Array();
	$feeddatabase['XMLFeeds'] = 'XMLFeeds';
	
	$databaseoptions = NULL;
	$databaseoptions['FileName'] = 'rss.xml';
	
	$feed = new XmlFeed($feeddatabase, $databaseoptions);
	$feed->setDatabaseAll ($credentaillogonarray[0], $credentaillogonarray[1], $credentaillogonarray[2], $credentaillogonarray[3], 'XMLFeeds');
	$feed->setHttpUserAgent($_SERVER['HTTP_USER_AGENT']);
	$feed->FetchDatabase ($feedidnumber);
	$feed->CreateOutput('    ');
		
	// Removing Caching by the browser!
	header("Cache-Control: no-cache, must-revalidate");
	header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");
	if (!$databaseoptions['FileName']) {
		$feedoutput = $GLOBALS['Writer']->flush();
		print "$feedoutput\n";
	} else {
		header("Location: rss.xml");
	}
?>