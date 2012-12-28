<?php
	$Directory = '../../../SQLTables/Update/';
	$FileName = 'Update.zip';
	
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
	$Page->text('Welcome To One Solution CMS System Update File Remover Tool');
	$Page->endElement(); //ENDS H1
	
	if (is_dir($Directory)) {
		if (file_exists($Directory . '/' . $FileName)) {
			$text = "$FileName Has Been Removed!";
			unlink($Directory . '/' . $FileName);
		} else {
			$text = "$FileName Does Not Exist and Has NOT Been Removed!";
		}
		
		$Page->startElement('p');
			$Page->text($text);
		$Page->endElement(); // ENDS P
		
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
	
?>