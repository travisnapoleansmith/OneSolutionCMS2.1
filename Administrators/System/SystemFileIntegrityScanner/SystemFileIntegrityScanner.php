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
	require_once ('../../Configuration/includes.php');
	
	set_time_limit(120);
	
	require_once ('../../Configuration/includes.php');
	$FileName = '../../../Modules/Tier3ProtectionLayer/Core/SystemFileIntegrityScanner/SystemFiles.txt';
		
	$IntegrityDatabase = Array();
	$IntegrityDatabase['DatabaseTable1'] = 'SystemFileHashes';

	$DatabaseOptions = array();
	
	$Tier3Databases = new ProtectionLayer();
	
	$Integrity = new SystemFileIntegrityScanner ($IntegrityDatabase, $DatabaseOptions, $Tier3Databases);
	$Integrity->setDatabaseAll ($credentaillogonarray[0], $credentaillogonarray[1], $credentaillogonarray[2], $credentaillogonarray[3], 'SystemFileHashes');
	$Integrity->FetchDatabase (NULL);
	
	$Integrity->createSystemFileTable();
	$Integrity->createFileTable();
	
	$SystemFilesTable = $Integrity->getSystemFilesTable();
	$DatabaseTableArray = $Integrity->getFilesTable();
	$CurrentHashTableArray = $Integrity->scanSystemFiles ($FileName);
	
	$Difference = $Integrity->compareSystemFiles($DatabaseTableArray, $CurrentHashTableArray);
	
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
	$Page->text("One Solution CMS - System File Integrity Scanner");
	$Page->endElement(); //END TITLE

	$Page->endElement(); //Ends HEAD
	// ENDS HEADER

	// STARTS BODY
	$Page->startElement('body');

	$Page->startElement('h1');
	$Page->text('Welcome To One Solution CMS System File Integrity Scanner Utility');
	$Page->endElement(); //ENDS H1

	if ($Difference != NULL) {
		$text = "System File Integrity Scanner has found files that have changed. Please see the list below to see what files they are.";

		$Page->startElement('p');
			$Page->text($text);
		$Page->endElement(); // ENDS P
		
		foreach ($Difference as $Key => $Value) {
			if ($SystemFilesTable[$Key] != NULL) {
				$Hash = $SystemFilesTable[$Key]['Hash'];
				$Timestamp = $SystemFilesTable[$Key]['Timestamp'];
				$FilePath = $SystemFilesTable[$Key]['FilePath'];
				$Date = date("l F m, Y H:i:s e", $Timestamp);
				
				$FilePath = str_replace('../', '', $FilePath);
				
				$text = "FILENAME - $FilePath <br/> HASH - $Hash <br/> DATE OF LAST TIME ADDED TO DATABASE - $Date";
	
				$Page->startElement('p');
					$Page->writeRaw($text);
				$Page->endElement(); // ENDS P
			} else {
				$Hash = $Value;
				$FilePath = $Key;
				$FilePath = str_replace('../', '', $FilePath);
				$text = "This file has been added to the system! <br/> FILENAME = $FilePath <br/> HASH = $Hash";
	
				$Page->startElement('p');
					$Page->writeRaw($text);
				$Page->endElement(); // ENDS P
			}
		}
	} else {
		$text = "System File Integrity Scanner has NOT FOUND ANY FILES THAT HAVE CHANGED. All file hashes match up!";

		$Page->startElement('p');
			$Page->text($text);
		$Page->endElement(); // ENDS P
	}
	
	$text = "To return to the Administrators Panel <a href='../../index.php'>click here</a>!\n";

	$Page->startElement('p');
	$Page->writeRaw($text);
	$Page->endElement(); //End P

	$Page->endElement(); //Ends BODY
	$Page->endElement(); //Ends HTML

	$pageoutput = $Page->flush();
	print $pageoutput;
	
?>