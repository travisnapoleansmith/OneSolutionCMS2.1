<?php
	$FileName = '../../UPGRADE/SQLTables/Update/SystemFiles.txt';

	installNewSystemFiles($FileName);
	
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
	$Page->text("One Solution CMS - Install New System Files Utility");
	$Page->endElement(); //END TITLE
	
	$Page->endElement(); //Ends HEAD
	// ENDS HEADER
	
	// STARTS BODY
	$Page->startElement('body');
	
	$Page->startElement('h1');
	$Page->text('Welcome To One Solution CMS Install New System Files Utility');
	$Page->endElement(); //ENDS H1
	
	$text = "The old system files have been removed.\n";
	$text .= "     You have now completed Step 3 of 4 to upgrading your system.\n";

	$Page->startElement('p');
	$Page->text($text);
		$Page->startElement('ul');
			$Page->startElement('li');
				$Page->text('Step 1: Extract System Zip File - DONE');
			$Page->endElement(); // End Li
			$Page->startElement('li');
				$Page->text('Step 2: Remove Old System Files - DONE');
			$Page->endElement(); // End Li
			$Page->startElement('li');
				$Page->text('Step 3: Install New System Files - DONE');
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
		$Page->writeAttribute('href', 'updatedatabase.php');
		$Page->text('Step 4: Update Database');
		$Page->endElement(); //Ends A
	$Page->endElement(); //Ends P
	
	$Page->endElement(); //Ends BODY
	$Page->endElement(); //Ends HTML
	
	$pageoutput = $Page->flush();
	print $pageoutput;
	
	function installNewSystemFiles($Filename) {
		if (!empty($Filename)) {
			if (file_exists($Filename)) {
				$File = file($Filename);
				$DirectoryListing = array();
				foreach ($File as $FileContent) {
					$FileContent = str_replace("\n", '', $FileContent);
					$FileContent = str_replace("\r", '', $FileContent);
					$TempFileContent = str_replace('../../', '../../UPGRADE/', $FileContent);
					
					if (is_file($TempFileContent)) {
						copy($TempFileContent, $FileContent);
					}
					
					if (is_dir($TempFileContent)) {
						if (!is_dir($FileContent)) {
							mkdir($FileContent);
						}
					}
				}
			}
		}
	}
?>