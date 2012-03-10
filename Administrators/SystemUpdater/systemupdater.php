<?php
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
	$Page->text("One Solution CMS - System Updater");
	$Page->endElement(); //END TITLE
	
	$Page->endElement(); //Ends HEAD
	// ENDS HEADER
	
	// STARTS BODY
	$Page->startElement('body');
	
	$Page->startElement('h1');
	$Page->text('Welcome To One Solution CMS System Updater');
	$Page->endElement(); //ENDS H1
	
	$text = "The One Solution CMS System Updater is utility that is included as part of One Solution to upgrade\n";
	$text .= "     your current system to the latest edition. For this to take place you have to do 4 different steps.\n";

	$Page->startElement('p');
	$Page->text($text);
		$Page->startElement('ul');
			$Page->startElement('li');
				$Page->text('Step 1: Extract System Zip File');
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
		$Page->text('To start this process please select ');
		$Page->startElement('a');
		$Page->writeAttribute('href', 'UnzipFiles.php');
		$Page->text('Step 1: Extract Zip File');
		$Page->endElement(); //Ends A
	$Page->endElement(); //Ends P
	$Page->endElement(); //Ends BODY
	$Page->endElement(); //Ends HTML
	
	$pageoutput = $Page->flush();
	print $pageoutput;
?>