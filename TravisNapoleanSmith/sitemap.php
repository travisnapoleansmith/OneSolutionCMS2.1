<?php
	// Includes all files
	require_once ('Configuration/includes.php');
	
	$sitemapidnumber = Array();
	$sitemapidnumber['PageID'] = 1;
	
	$sitemapdatabase = Array();
	$sitemapdatabase['XMLSitemap'] = 'XMLSitemap';
	$sitemapdatabase['XMLNewsYearMonthSitemap'] = 'XMLNewsYearMonthSitemap';
	$sitemapdatabase['XMLNewsSitemap'] = 'XMLNewsSitemap';
	$sitemapdatabase['FileName'] = 'sitemap.xml';
	
	$databases = &$GLOBALS['Tier4Databases'];
	
	$sitemap = new XmlSitemap($sitemapdatabase, $databases);
	$sitemap->setDatabaseAll ($credentaillogonarray[0], $credentaillogonarray[1], $credentaillogonarray[2], $credentaillogonarray[3], 'XMLSitemap');
	$sitemap->setHttpUserAgent($_SERVER['HTTP_USER_AGENT']);
	$sitemap->FetchDatabase ($sitemapidnumber);
	$sitemap->CreateOutput('    ');
	
	$sitemapoutput = $sitemap->getOutput();
	
	// Removing Caching by the browser!
	header("Cache-Control: no-cache, must-revalidate");
	header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");
	
	if ($sitemapoutput) {
		print "$sitemapoutput\n";
	} else {
		header("Location: sitemap.xml");
	}
?>