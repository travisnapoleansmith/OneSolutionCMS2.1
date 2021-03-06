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
	$RefererPage = $_SERVER['HTTP_REFERER'];
	$RefererPageArray = explode('?', $RefererPage);
	$RefererPage = $RefererPageArray[0];
	$ServerLocation = "http://" . $_SERVER['SERVER_NAME'];

	unset($RefererPageArray);
	if ($RefererPage == $ServerLocation . "/Administrators/Panel/Managers/StatsManager/StatsManager.php") {
		$Page = new XMLWriter();
		$Page->openMemory();
		
		$Page->setIndent(4);
		
		$Page->startElement('toolbar');
			$Page->startElement('item');
				$Page->writeAttribute('id', 'SiteStatsRangeToolbar1ExportLabel1');
				$Page->writeAttribute('type', 'text');
				$Page->writeAttribute('text', 'Export Data Format');
			$Page->fullEndElement(); // ENDS ITEM
			
			$Page->startElement('item');
				$Page->writeAttribute('id', 'SiteStatsRangeToolbar1ExportButton1');
				$Page->writeAttribute('type', 'button');
				$Page->writeAttribute('text', 'Excel');
				$Page->writeAttribute('img', 'MicrosoftExcelIcon24.png');
			$Page->fullEndElement(); // ENDS ITEM
			
			$Page->startElement('item');
				$Page->writeAttribute('id', 'SiteStatsRangeToolbar1ExportButton2');
				$Page->writeAttribute('type', 'button');
				$Page->writeAttribute('text', 'CSV');
				$Page->writeAttribute('img', 'CSVIcon24.png');
			$Page->fullEndElement(); // ENDS ITEM
			
			$Page->startElement('item');
				$Page->writeAttribute('id', 'SiteStatsRangeToolbar1ExportButton3');
				$Page->writeAttribute('type', 'button');
				$Page->writeAttribute('text', 'XML');
				$Page->writeAttribute('img', 'XMLIcon24.png');
			$Page->fullEndElement(); // ENDS ITEM
		$Page->fullEndElement(); // ENDS TOOLBAR
		
		$PageOutput = $Page->flush();
		header('Content-type: application/xml');
		print $PageOutput;
	} else {
		header("HTTP/1.0 404 Not Found");
	}
?>