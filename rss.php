<?php
	/*
	**************************************************************************************
	* One Solution CMS
	*
	* Copyright (c) 1999 - 2012 One Solution CMS
	*
	* This content management system is free software; you can redistribute it and/or
	* modify it under the terms of the GNU Lesser General Public
	* License as published by the Free Software Foundation; either
	* version 2.1 of the License, or (at your option) any later version.
	*
	* This library is distributed in the hope that it will be useful,
	* but WITHOUT ANY WARRANTY; without even the implied warranty of
	* MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU
	* Lesser General Public License for more details.
	*
	* You should have received a copy of the GNU Lesser General Public
	* License along with this library; if not, write to the Free Software
	* Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301  USA
	*
	* @copyright  Copyright (c) 1999 - 2013 One Solution CMS (http://www.onesolutioncms.com/)
	* @license    http://www.gnu.org/licenses/old-licenses/lgpl-2.1.txt	LGPL
	* @version    2.1.139, 2012-12-27
	*************************************************************************************
	*/

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