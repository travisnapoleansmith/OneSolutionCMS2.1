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
	require_once ('Configuration/includes.php');

	$sitemapidnumber = Array();
	$sitemapidnumber['PageID'] = 1;

	$sitemapdatabase = Array();
	$sitemapdatabase['XMLSitemap'] = 'XMLSitemap';

	$databaseoptions = array();
	$databaseoptions['Screen'] = TRUE;
	//$databaseoptions['FileName'] = 'sitemap.xml';

	$Tier6Databases = $GLOBALS['Tier6Databases'];

	$sitemap = new XmlSitemap($sitemapdatabase, $databaseoptions, $Tier6Databases);
	$sitemap->setDatabaseAll ($credentaillogonarray[0], $credentaillogonarray[1], $credentaillogonarray[2], $credentaillogonarray[3], 'XMLSitemap');
	$sitemap->setHttpUserAgent($_SERVER['HTTP_USER_AGENT']);
	$sitemap->FetchDatabase ($sitemapidnumber);
	$sitemap->CreateOutput('    ');

	$sitemapoutput = $sitemap->getOutput();

	// Removing Caching by the browser!
	header("Cache-Control: no-cache, must-revalidate");
	header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");

	if ($sitemapoutput) {
		header('Content-type: text/xml');
		print "$sitemapoutput\n";
	} else {
		header("Location: sitemap.xml");
	}
?>