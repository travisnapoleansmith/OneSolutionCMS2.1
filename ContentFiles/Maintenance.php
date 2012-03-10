<?php
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