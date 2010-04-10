<?php
	// Includes all files
	require_once ('Configuration/includes.php');
	
	$sitemapidnumber = Array();
	$sitemapidnumber['PageID'] = 1;
	
	$sitemapdatabase = Array();
	$sitemapdatabase['XMLSitemap'] = 'XMLSitemap';
	$sitemapdatabase['XMLNewsYearMonthSitemap'] = 'XMLNewsYearMonthSitemap';
	$sitemapdatabase['XMLNewsSitemap'] = 'XMLNewsSitemap';
	
	$databaseoptions = NULL;
	$databaseoptions['FileName'] = 'sitemap.xml';
	
	$sitemap = new XmlSitemap($sitemapdatabase, $databaseoptions);
	$sitemap->setDatabaseAll ($credentaillogonarray[0], $credentaillogonarray[1], $credentaillogonarray[2], $credentaillogonarray[3], 'XMLSitemap');
	$sitemap->setHttpUserAgent($_SERVER['HTTP_USER_AGENT']);
	$sitemap->FetchDatabase ($sitemapidnumber);
	$sitemap->CreateOutput('    ');
		
	// Removing Caching by the browser!
	header("Cache-Control: no-cache, must-revalidate");
	header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");
	
	if (!$databaseoptions['FileName']) {
		$sitemapoutput = $GLOBALS['Writer']->flush();
		print "$sitemapoutput";
	} else {
		header("Location: sitemap.xml");
	}
?>