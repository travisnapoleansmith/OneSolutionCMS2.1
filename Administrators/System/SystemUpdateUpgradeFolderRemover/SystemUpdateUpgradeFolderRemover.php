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

	$Directory = '../../../UPGRADE';

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
	$Page->text("One Solution CMS - System Update File Remover");
	$Page->endElement(); //END TITLE

	$Page->endElement(); //Ends HEAD
	// ENDS HEADER

	// STARTS BODY
	$Page->startElement('body');

	$Page->startElement('h1');
	$Page->text('Welcome To One Solution CMS System Update Folder Remover');
	$Page->endElement(); //ENDS H1

	$text = 'The Following Is A List Of Files and Folders Removed!';

	$Page->startElement('p');
		$Page->text($text);
	$Page->endElement(); // ENDS P

	if (is_dir($Directory)) {
		RecursiveRemoveFiles($Directory);
		rmdir($Directory);

	} else {
		$text = "The Directory - $Directory - Does Not Exist and NO FILES HAVE BEEN REMOVED!";
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

	function RecursiveRemoveFiles($DirectoryName) {
		$Page = &$GLOBALS['Page'];
		if (is_dir($DirectoryName)) {
			$FileList = scandir($DirectoryName);

			if (isset($FileList[2])) {
				foreach ($FileList as $Key => $Value) {
					if ($Value !== '.' && $Value !== '..') {
						if (is_dir($DirectoryName . '/' . $Value)) {
							RecursiveRemoveFiles($DirectoryName . '/' . $Value);
							$NewDirectoryName = $DirectoryName . '/' . $Value;
							if (is_dir($NewDirectoryName)) {
								$SecondaryFileList = scandir($NewDirectoryName);
								if (!isset($SecondaryFileList[2])) {
									rmdir($NewDirectoryName);
									$text = "$DirectoryName Has Been Removed!";
									$Page->startElement('p');
										$Page->text($text);
									$Page->endElement(); // ENDS P
								}
							}
						} else if (is_file($DirectoryName . '/' . $Value)) {
							unlink($DirectoryName . '/' . $Value);
							$text = $DirectoryName . '/' . $Value;
							$text .= " Has Been Removed!";
							$Page->startElement('p');
								$Page->text($text);
							$Page->endElement(); // ENDS P
						}
					}
				}
			}

			if (!isset($FileList[2])) {
				rmdir($DirectoryName);
				$text = "$DirectoryName Has Been Removed!";
				$Page->startElement('p');
					$Page->text($text);
				$Page->endElement(); // ENDS P
			}
		} else {
			return FALSE;
		}
	}
?>