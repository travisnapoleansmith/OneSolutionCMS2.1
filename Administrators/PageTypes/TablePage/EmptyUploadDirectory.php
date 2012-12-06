<?php
	$Directory = 'UPLOAD';
	
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
	$Page->text("One Solution CMS - Empty Tables Upload Directory Utility");
	$Page->endElement(); //END TITLE
	
	$Page->endElement(); //Ends HEAD
	// ENDS HEADER
	
	// STARTS BODY
	$Page->startElement('body');
	
	$Page->startElement('h1');
	$Page->text('Welcome To One Solution CMS Empty Tables Upload Directory Utility');
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