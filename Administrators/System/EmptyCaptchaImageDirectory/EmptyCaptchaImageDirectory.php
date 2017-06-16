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

	$Directory = '../../CAPTCHAIMAGE';

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
	$Page->text("One Solution CMS - Empty Captcha Image Directory Utility");
	$Page->endElement(); //END TITLE

	$Page->endElement(); //Ends HEAD
	// ENDS HEADER

	// STARTS BODY
	$Page->startElement('body');

	$Page->startElement('h1');
	$Page->text('Welcome To One Solution CMS Empty Captcha Image Directory Utility');
	$Page->endElement(); //ENDS H1

	$text = "The following is a list of files in this folder. Next to the file name it will list if the file has been removed or not!\n";
	if (is_dir($Directory)) {
		$Page->startElement('p');
			$Page->text($text);
			$Page->startElement('ul');
		if ($Dir = opendir($Directory)) {
			while (($File = readdir($Dir)) !== false) {
				$text = $File . ' - ';
				if ($File != '..' && $File != '.') {
					$text .= 'File Removed';
					unlink($Directory . '/' . $File);
				} else {
					$text .= 'File Not Removed';
				}
				$Page->startElement('li');
					$Page->text($text);
				$Page->endElement(); // End Li
			}
			closedir($Dir);

			$Page->endElement(); //End UL
			$Page->endElement(); //End P

			$text = "Successfully Removed All Files From $Directory!";

			$Page->startElement('p');
				$Page->text($text);
			$Page->endElement(); // END P
		}
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