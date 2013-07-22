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
	$ReferPage = $_SERVER['HTTP_REFERER'];
	$ReferPageIDArray = explode('/', $ReferPage);
	$ReferPage = end($ReferPageIDArray);
	
	if ($ReferPage === 'InstallNewSystemFiles.php') {
		require_once ('../Configuration/includes.php');
		$databasefilename ='../../SQLTables/Update/UpdateTableFiles.txt';
	
		$Return = $Tier6Databases->upgradeDatabase($databasefilename);
	
		$Page = new XMLWriter();
		$Page->openMemory();
	
		$Page->setIndent(4);
		// STARTS HEADER
		$Page->startDTD('html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd"');
		$Page->endDTD();
	
		$Page->startElement('html');
		$Page->writeAttribute('lang', 'en-US');
		$Page->writeAttribute('xml:lang', 'en-US');
		$Page->writeAttribute('xmlns', 'http://www.w3.org/1999/xhtml');
	
		$Page->startElement('head');
	
		$Page->startElement('meta');
		$Page->writeAttribute('http-equiv', 'Content-Type');
		$Page->writeAttribute('content', 'text/html; charset=iso-8859-1');
		$Page->endElement(); //ENDS META
	
		$Page->startElement('title');
		$Page->text("One Solution CMS - Database Updater");
		$Page->endElement(); //END TITLE
	
		$Page->endElement(); //Ends HEAD
		// ENDS HEADER
	
		// STARTS BODY
		$Page->startElement('body');
	
		$Page->startElement('h1');
		$Page->text('Welcome To One Solution CMS Database Updater');
		$Page->endElement(); //ENDS H1
		if ($Return === TRUE) {
			$text = "The current database has been successfully upgraded! You may now use\n";
			$text .= "     the latest edition of One Solution CMS. The Administrators Panel \n";
			$text .= "     is available <a href='../index.php'>here</a>!\n";
		
			$Page->startElement('p');
			$Page->writeRaw($text);
			$Page->endElement(); //End P
			$Page->writeRaw("\n");
		} else if ($Return === FALSE) {
			$text = "The process has failed.";
				
			$Page->startElement('p');
				$Page->text($text);
			$Page->endElement(); //End P
			
			$Page->startElement('p');
				$Page->text('To go back to the Admin Panel please select ');
				$Page->startElement('a');
				$Page->writeAttribute('href', '../index.php');
				$Page->text('Administrators Panel');
				$Page->endElement(); //Ends A
			$Page->endElement(); //Ends P
		} else {
			if (is_array($Return)) {
				$text = "The process has failed.";
				
				$Page->startElement('p');
					$Page->text($text);
				$Page->endElement(); //End P
			
				foreach ($Return as $File => $Message) {
					$text = "Command Message: $Message.\n";
				
					$Page->startElement('p');
						$Page->text($text);
					$Page->endElement(); //End P
				}
				
				$Page->startElement('p');
					$Page->text('To go back to the Admin Panel please select ');
					$Page->startElement('a');
					$Page->writeAttribute('href', '../index.php');
					$Page->text('Administrators Panel');
					$Page->endElement(); //Ends A
				$Page->endElement(); //Ends P
			}
		}
		
		$Page->endElement(); //Ends BODY
		$Page->endElement(); //Ends HTML
	
		$pageoutput = $Page->flush();
		print $pageoutput;
	} else {
		header ("Status: 403");
		exit ("Access Denied");
	}
?>