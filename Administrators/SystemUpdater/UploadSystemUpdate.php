<?php
	$FileUpload == FALSE;
	$UploadArray = $_FILES['SystemUpdateFile'];
	$TargetPath = '../../SQLTables/Update/';
	if ($UploadArray['type'] == 'application/x-zip-compressed') {
		if (move_uploaded_file($UploadArray['tmp_name'], $TargetPath . 'Update.zip')) {
			$FileUpload = TRUE;
		} else {
			$FileUpload = FALSE;
		}
	}
	
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
	$Page->text("One Solution CMS - Upload System Update");
	$Page->endElement(); //END TITLE
	
	$Page->endElement(); //Ends HEAD
	// ENDS HEADER
	
	// STARTS BODY
	$Page->startElement('body');
	
	$Page->startElement('h1');
	$Page->text('Welcome To One Solution CMS Upload System Update');
	$Page->endElement(); //ENDS H1
	
	if ($FileUpload === TRUE) {
		$text = "The One Solution CMS Upload System Update has uploaded the file to SQLTables/Update folder.\n";
		$text .= "     The file has been renamed Update.zip. You can now update your system using the System Updater.\n";
	} else {
		$text = "The One Solution CMS Upload System Update has NOT uploaded the file please try again.\n";
	}
	
	$Page->startElement('p');
	$Page->text($text);
	$Page->endElement(); //End P
	$Page->writeRaw("\n");
	if ($FileUpload === TRUE) {
		$Page->startElement('p');
			$Page->text('To start this process please select');
			$Page->startElement('a');
			$Page->writeAttribute('href', 'SystemUpdater.php');
			$Page->text('System Updater');
			$Page->endElement(); //Ends A
		$Page->endElement(); //Ends P
	} else {
		$Page->startElement('p');
			$Page->text('To return to Upload System Update, please select');
			$Page->startElement('a');
			$Page->writeAttribute('href', '../index.php?PageID=23');
			$Page->text('Upload System Update');
			$Page->endElement(); //Ends A
		$Page->endElement(); //Ends P
	}
	$Page->endElement(); //Ends BODY
	$Page->endElement(); //Ends HTML
	
	$pageoutput = $Page->flush();
	print $pageoutput;
?>