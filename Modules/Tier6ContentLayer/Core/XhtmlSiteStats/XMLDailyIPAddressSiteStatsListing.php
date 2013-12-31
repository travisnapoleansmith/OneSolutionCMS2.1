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
	
	// WILL REPLACE AFTER 2013
	
	require_once ("../../../../Configuration/includes.php");

	$Format = NULL;
	if ($_GET['Format'] != NULL) {
		$Format = $_GET['Format'];
	} else {
		$Format = 'XML';
	}

	$PageID = array();
	$PageID['CurrentVersion'] = 'true';

	$SiteStatsDatabase = Array();
	//$SiteStatsDatabase['DatabaseTable1'] = 'SiteStats';
	$SiteStatsDatabase['DatabaseTable2'] = 'SiteStatsIPAddressDailyCurrent';

	$DatabaseOptions = array();
	//$DatabaseOptions['FileName'] = 'sitemap.xml';

	$Tier6Databases = $GLOBALS['Tier6Databases'];

	$SiteStats = new XhtmlSiteStats ($SiteStatsDatabase, $DatabaseOptions, $Tier6Databases);

	$SiteStats->setDatabaseAll ($credentaillogonarray[0], $credentaillogonarray[1], $credentaillogonarray[2], $credentaillogonarray[3], 'SiteStatsIPAddressDailyCurrent');
	$EntireDatabaseTable = $SiteStats->FetchDatabaseAll(TRUE);
	$Temp = $Tier6Databases->getContentVersionRow($PageID, 'ContentLayerVersion');
	$EntireDatabaseTablePageNames = array();
	$LeftOver = array();
	foreach ($Temp as $Key => $Value) {
		if ($Value['PageID'] != NULL) {
			if ($EntireDatabaseTablePageNames[$Value['PageID']] === NULL) {
				$EntireDatabaseTablePageNames[$Value['PageID']] = $Value['ContentPageMenuTitle'];
			} else {
				array_push($LeftOver, $Value);
			}
		}
	}

	if ($Format === 'XML') {
		$Writer = new XMLWriter();
		$Writer->openMemory();
		$Writer->setIndent(4);

		$Writer->startDocument('1.0', 'utf-8');
		$Writer->startElement('SiteStats');

		foreach ($EntireDatabaseTable as $Key => $Value) {
			$Writer->startElement('PageData');
			$PageName = NULL;
			$PageName = $EntireDatabaseTablePageNames[$Value['PageID']];
			if ($PageName !== NULL) {
				$Writer->startElement('PageName');
				$Writer->text($PageName);
				$Writer->endElement(); // ENDS PAGE NAME
			} else {
				$Writer->startElement('PageName');
				$Writer->text('No Page Name Set');
				$Writer->endElement(); // ENDS PAGE NAME
			}
			foreach ($Value as $SubKey => $SubValue) {
				$Writer->startElement($SubKey);
				$Writer->text($SubValue);
				$Writer->endElement(); // ENDS SUB VALUE
			}
			$Writer->endElement(); // ENDS PAGE DATA
		}

		$Writer->endElement(); // END SITESTATS
		$Writer->endDocument();
		$pageoutput = $Writer->flush();

		// Removing Caching by the browser!
		header('Content-type: text/xml');
		header("Cache-Control: no-cache, must-revalidate");
		header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");
		if ($pageoutput) {
			print "$pageoutput\n";
		} else {
			//header("Location: XmlTable.xml");
		}
	}

	if ($Format === 'CSV') {
		header('Content-Type: text/csv; charset=utf-8');
		header('Content-Disposition: attachment; filename=DailySiteStats.csv');

		$Output = fopen('php://output', 'w');

		$Content = array();

		$Content[] = 'Page Name';

		$Record = $EntireDatabaseTable[1];
		foreach ($Record as $Key => $Value) {
			$Content[] = $Key;
		}

		fputcsv($Output, $Content);

		foreach ($EntireDatabaseTable as $Key => $Value) {
			$Content = array();
			$PageName = NULL;
			$PageName = $EntireDatabaseTablePageNames[$Value['PageID']];
			if ($PageName !== NULL) {
				$Content[] = $PageName;
			} else {
				$Content[] = 'No Page Name Set';
			}

			foreach ($Value as $SubKey => $SubValue) {
				$Content[] = $SubValue;
			}
			fputcsv($Output, $Content);
		}

		fclose($Output);
	}

?>