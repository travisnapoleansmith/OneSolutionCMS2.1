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

	$FileName ='../../SQLTables/Update/UpdateSystemFiles.txt';
	$UpgradeLocation = '../../UPGRADE';

	unzipFiles($FileName, $UpgradeLocation);

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
	$Page->text("One Solution CMS - Extract System Zip File Utility");
	$Page->endElement(); //END TITLE

	$Page->endElement(); //Ends HEAD
	// ENDS HEADER

	// STARTS BODY
	$Page->startElement('body');

	$Page->startElement('h1');
	$Page->text('Welcome To One Solution CMS Extract System Zip File Utility');
	$Page->endElement(); //ENDS H1

	$text = "The files have been unzipped, they are located in UPGRADE folder.\n";
	$text .= "     You have now completed Step 1 of 4 to upgrading your system.\n";

	$Page->startElement('p');
	$Page->text($text);
		$Page->startElement('ul');
			$Page->startElement('li');
				$Page->text('Step 1: Extract Zip File - DONE');
			$Page->endElement(); // End Li
			$Page->startElement('li');
				$Page->text('Step 2: Remove Old System Files');
			$Page->endElement(); // End Li
			$Page->startElement('li');
				$Page->text('Step 3: Install New System Files');
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
		$Page->writeAttribute('href', 'RemoveOldSystemFiles.php');
		$Page->text('Step 2: Remove Old System Files');
		$Page->endElement(); //Ends A
	$Page->endElement(); //Ends P

	$Page->endElement(); //Ends BODY
	$Page->endElement(); //Ends HTML

	$pageoutput = $Page->flush();
	print $pageoutput;

	function unzipFiles($Filename, $UpgradeLocation) {
		if (!empty($Filename)) {
			if (!empty($UpgradeLocation)){
				if (file_exists($Filename)) {
					if (is_dir($UpgradeLocation)) {
						$Command = 'rm -r ' . $UpgradeLocation;
						exec($Command);
					}
					$File = file($Filename);
					foreach ($File as $FileContent) {
						$FileContent = str_replace("\n", '', $FileContent);
						$FileContent = str_replace("\r", '', $FileContent);
						$ZipArchiveFile = new ZipArchive();
						$Resource = $ZipArchiveFile->open($FileContent);
						if ($Resource === TRUE) {
							$ZipArchiveFile->extractTo($UpgradeLocation);
							$ZipArchiveFile->close();
						}
					}
				}
			}
		}
	}
?>