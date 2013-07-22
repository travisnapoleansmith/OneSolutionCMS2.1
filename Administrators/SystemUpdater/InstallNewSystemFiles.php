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
	
	if ($ReferPage === 'RemoveOldSystemFiles.php') {
		$FileName = '../../UPGRADE/SQLTables/Update/SystemFiles.txt';
	
		$Return = installNewSystemFiles($FileName);
	
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
		$Page->text("One Solution CMS - Install New System Files Utility");
		$Page->endElement(); //END TITLE
	
		$Page->endElement(); //Ends HEAD
		// ENDS HEADER
	
		// STARTS BODY
		$Page->startElement('body');
	
		$Page->startElement('h1');
		$Page->text('Welcome To One Solution CMS Install New System Files Utility');
		$Page->endElement(); //ENDS H1
		
		if ($Return === TRUE) {
			$text = "The old system files have been removed.\n";
			$text .= "     You have now completed Step 3 of 4 to upgrading your system.\n";
		
			$Page->startElement('p');
			$Page->text($text);
				$Page->startElement('ul');
					$Page->startElement('li');
						$Page->text('Step 1: Extract System Zip File - DONE');
					$Page->endElement(); // End Li
					$Page->startElement('li');
						$Page->text('Step 2: Remove Old System Files - DONE');
					$Page->endElement(); // End Li
					$Page->startElement('li');
						$Page->text('Step 3: Install New System Files - DONE');
					$Page->endElement(); // End Li
					$Page->startElement('li');
						$Page->text('Step 4: Update Database');
					$Page->endElement(); // End Li
				$Page->endElement(); //End UL
			$Page->endElement(); //End P
			$Page->writeRaw("\n");
		
			$Page->startElement('p');
				$Page->text('To continue this process please select ');
				$Page->startElement('a');
				$Page->writeAttribute('href', 'UpdateDatabase.php');
				$Page->text('Step 4: Update Database');
				$Page->endElement(); //Ends A
			$Page->endElement(); //Ends P
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
				foreach ($Return as $File => $Message) {
					$text = "$Message.\n";
				
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
	
	function installNewSystemFiles($Filename) {
		if (!empty($Filename)) {
			if (file_exists($Filename)) {
				$File = file($Filename);
				$DirectoryListing = array();
				$ReturnArray = array();
				
				if (is_dir('../../UPGRADE/')) {
					foreach ($File as $FileContent) {
						$FileContent = str_replace("\n", '', $FileContent);
						$FileContent = str_replace("\r", '', $FileContent);
						$TempFileContent = str_replace('../../', '../../UPGRADE/', $FileContent);
	
						if (is_file($TempFileContent)) {
							copy($TempFileContent, $FileContent);
						}
	
						if (is_dir($TempFileContent)) {
							if (!is_dir($FileContent)) {
								mkdir($FileContent);
							}
						}
					}
				} else {
					$ReturnArray[] = 'UPGRADE folder does not exist!';
				}
				
				if (empty($ReturnArray)) {
					return TRUE;
				} else {
					return $ReturnArray;
				}
			} else {
				return FALSE;
			}
		} else {
			return FALSE;
		}
	}
?>