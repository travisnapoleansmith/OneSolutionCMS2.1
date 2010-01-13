<?php
	//print "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Strict//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd\" >\n";
	//print "<html lang=\"en-US\" xml:lang=\"en-US\" xmlns=\"http://www.w3.org/1999/xhtml\"> \n\n";
	//print "<html>\n";
	//print "<head>\n";
	//print "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=iso-8859-1\" />\n";
	//print "<title>Administrators Page</title>\n";
	//print "</head>\n\n";
	
	// Includes all files
	require_once ('includes.php');
	
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
	$Page->endElement(); //Ends HTML
	
	$Page->startElement('html');
	$Page->startElement('head');
	
	$Page->startElement('meta');
	$Page->writeAttribute('http-equiv', 'Content-Type');
	$Page->writeAttribute('content', 'text/html; charset=iso-8859-1');
	$Page->endElement(); //ENDS META
	
	$Page->startElement('title');
	$Page->text("Administrators Page - $sitename");
	$Page->endElement(); //END TITLE
	
	$Page->endElement(); //Ends HEAD
	// ENDS HEADER
	
	// STARTS BODY
	$Page->startElement('body');
	
	$Page->startElement('h1');
	$Page->text('Welcome To The Administrators Page');
	$Page->endElement(); //ENDS H1
	
	$text = "Welcome to the Administrators page.  This page contains all the \n";
	$text .= "     links to forms as well as other stuff to update the site of the \n";
	$text .= "     site for $sitename.";
	$Page->startElement('p');
	$Page->text($text);
	$Page->endElement(); //End P
	$Page->writeRaw("\n");
	
	$Page->startElement('h2');
	$Page->text('Update Menus');
	$Page->endElement(); //ENDS H1
	
	$Page->startElement('p');
	$Page->startElement('a');
	$Page->writeAttribute('href', 'updateNewsMenu.php');
	$Page->text('News Menu');
	$Page->endElement(); //Ends A
	$Page->endElement(); //Ends P
	
	$Page->startElement('p');
	$Page->startElement('a');
	$Page->writeAttribute('href', 'updateMainMenu.php');
	$Page->text('Main Menu');
	$Page->endElement(); //Ends A
	$Page->endElement(); //Ends P
	$Page->writeRaw("\n");
	
	$Page->startElement('h2');
	$Page->text('Return to Home Page');
	$Page->endElement(); //ENDS H1
	
	$Page->startElement('p');
	$Page->startElement('a');
	$Page->writeAttribute('href', '../index.php');
	$Page->text('Return to Home Page');
	$Page->endElement(); //Ends A
	$Page->endElement(); //Ends P
	
	$Page->endElement(); //Ends BODY
	$Page->endElement(); //Ends HTML
	//ENDS BODY
	
	$Page->endDocument();
	$pageoutput = $Page->flush();
	print $pageoutput;
	
?>