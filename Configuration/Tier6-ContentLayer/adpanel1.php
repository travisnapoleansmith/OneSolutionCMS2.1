<?php
	$credentaillogonarray = $GLOBALS['credentaillogonarray'];
	// Fetch Current Page ID - Based on filename
	//$pagename = $_SERVER['PHP_SELF'];
	//$directory = dirname($_SERVER['PHP_SELF']);
	//$directory .= '/';
	//$pagename = str_replace($directory, ' ', $pagename);
	//$pagename = trim($pagename);
	//if ($pagename[0] == '/') {
		//$pagename[0] = '';
		//$pagename = trim($pagename);
	//}
		
	// Fetch Current Page ID - Based On ID Number
	$contentidnumber = Array();
	$contentidnumber['PageID'] = 1;
	$contentidnumber['ObjectID'] = 0;
	$contentidnumber['RevisionID'] = 0;
	$contentidnumber['CurrentVersion'] = 'true';
	
	if ($_GET['PageID']){
		$contentidnumber['PageID'] = $_GET['PageID'];
	}
	
	/*if (isset($_GET['RevisionID'])){
		$contentidnumber['RevisionID'] = $_GET['RevisionID'];
		unset($contentidnumber['CurrentVersion']);
	}*/
	
	if ($_GET['CurrentVersion']){
		$contentidnumber['CurrentVersion'] = $_GET['CurrentVersion'];
	}
	
	if ($_GET['printpreview']) {
		$contentidnumber['printpreview'] = TRUE;
	} else {
		$contentidnumber['printpreview'] = FALSE;
	}
	$contentdatabase = Array();
	$contentdatabase['Content'] = 'AdPanel1';
	$contentdatabase['ContentLayerTables'] = 'ContentLayerTables';
	$contentdatabase['ContentPrintPreview'] = NULL;
	$contentdatabase['ContentLayerModules'] = NULL;
	
	$databaseoptions = Array();
	$Tier6Databases = $GLOBALS['Tier6Databases'];
	
	$ad = new XhtmlContent($contentdatabase, $databaseoptions, $Tier6Databases);
	$ad->setDatabaseAll ($credentaillogonarray[0], $credentaillogonarray[1], $credentaillogonarray[2], $credentaillogonarray[3], 'AdPanel1');
	$ad->setHttpUserAgent($_SERVER['HTTP_USER_AGENT']);
	$ad->FetchDatabase ($contentidnumber);

	$Writer->startElement('div');
	$Writer->writeAttribute('id', 'ad-side');
		$Writer->startElement('div');
		$Writer->writeAttribute('id', 'side-ad');
			$Writer->startElement('div');
			$Writer->writeAttribute('id', 'side-ad-top');
			$Writer->fullEndElement();
			$Writer->writeRaw("\n");
			
			$Writer->startElement('div');
			$Writer->writeAttribute('id', 'side-ad-middle');
				$Writer->startElement('h1');
				$Writer->writeAttribute('class', 'SponsorsHeading');
				$Writer->text('Sponsors');
				$Writer->endElement();
				
				// PUT OUTPUT OF AD's IN HERE!!!!
				$hold = $ad->CreateOutput('    ');
				
				// PUT OUTPUT FOR ADVERTISE WITH US HERE!
				$contentidnumber['PageID'] = 0;
				if ($hold) {
					$Writer->startElement('hr');
					$Writer->writeAttribute('class', 'SponsorsRule');
					$Writer->endElement();
					
					$Writer->startElement('h2');
					$Writer->writeAttribute('class', 'SponsorsName');
					$Writer->text('Want to Advertised with us!');
					$Writer->endElement();
				}
				$ad = new XhtmlContent($contentdatabase, $databaseoptions, $Tier6Databases);
				$ad->setDatabaseAll ($credentaillogonarray[0], $credentaillogonarray[1], $credentaillogonarray[2], $credentaillogonarray[3], 'AdPanel1');
				$ad->setHttpUserAgent($_SERVER['HTTP_USER_AGENT']);
				$ad->FetchDatabase ($contentidnumber);
				
				$ad->CreateOutput('    ');
			$Writer->endElement();
		
			$Writer->startElement('div');
			$Writer->writeAttribute('id', 'side-ad-bottom');
			$Writer->fullEndElement();
			$Writer->writeRaw("\n    ");
		$Writer->endElement();
	$Writer->endElement();
	
?>