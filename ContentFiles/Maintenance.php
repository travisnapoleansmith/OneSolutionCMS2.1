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

	$Page = new XMLWriter();
	$Tier6Databases = $GLOBALS['Tier6Databases'];

	$Options = $Tier6Databases->getLayerModuleSetting();
	$MaintenanceFileName = $Options['NOTICE']['notice']['MaintenanceFileName']['SettingAttribute'];
	$DownDate = $Options['NOTICE']['notice']['MaintenanceDownDate']['SettingAttribute'];
	$DownTime = $Options['NOTICE']['notice']['MaintenanceDownTime']['SettingAttribute'];
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

	$Page->endElement(); //Ends HEAD
	// ENDS HEADER

	// STARTS BODY
	$Page->startElement('body');

	$Page->startElement('h1');
	$Page->text('WEB NOTICE - OUR WEBSITE WILL BE GOING DOWN FOR MAINTENANCE!');
	$Page->endElement(); //ENDS H1

	$text = "On $DownDate our website will be going down for routine maintance. This \n";
	$text .= "      maintance will be happening sometime around $DownTime.\n";

	$Page->startElement('p');
	$Page->writeRaw($text);
		$Page->startElement('br');
		$Page->endElement();// Ends BR
		$Page->startElement('br');
		$Page->endElement();// Ends BR
		$Page->startElement('i');
			$Page->text('Thank You for understanding,');
		$Page->endElement();// Ends I
		$Page->startElement('br');
		$Page->endElement();// Ends BR
		$Page->startElement('br');
		$Page->endElement();// Ends BR
		$Page->startElement('i');
			$Page->text('Web Master');
		$Page->endElement();// Ends I
		$Page->startElement('br');
		$Page->endElement();// Ends BR
	$Page->endElement(); // Ends P
	$Page->writeRaw("\n");

	$Page->startElement('hr');
	$Page->endElement();// Ends HR

	$Page->endElement(); //Ends BODY
	$Page->endElement(); //Ends HTML

	$pageoutput = $Page->flush();
	$File = fopen($MaintenanceFileName, 'w');
	fwrite($File, $pageoutput);
	fclose($File);
	//print $pageoutput;
?>