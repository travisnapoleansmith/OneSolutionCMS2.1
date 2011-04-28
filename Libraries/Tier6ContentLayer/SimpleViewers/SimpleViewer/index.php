<?
	$HOME = $_SERVER['SUBDOMAIN_DOCUMENT_ROOT'];
	//print_r($_SERVER);
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
	$Page->text("KC Photo Video - SimpleViewer Gallery DEMO");
	$Page->endElement(); //END TITLE
	
	$Page->endElement(); //Ends HEAD
	// ENDS HEADER
	
	// STARTS BODY
	$Page->startElement('body');
	$Page->writeAttribute('style', 'background-image: url(../../../../Tier8-PresentationLayer/CaseyRed/TemplateImages/Main-Background.jpg);');
	
	$Page->startElement('div');
	$Page->writeAttribute('id', 'backgroundimage');
	
	$Page->startElement('img');
	$Page->writeAttribute('src', '../../../../Tier8-PresentationLayer/CaseyRed/TemplateImages/Main-Background.jpg');
	$Page->writeAttribute('alt', 'Background Image');
	$Page->writeAttribute('style', 'position: fixed;top: 0; left: 0; height: 100%; width: 100%; z-index: -5;');
	$Page->endElement(); // ENDS IMG
	
	$Page->endElement(); // ENDS DIV
	
	$Page->startElement('div');
	$Page->writeAttribute('id', 'sv-container');
	$Page->writeAttribute('style', 'position: absolute; width: auto; height: auto;');
	
	$Page->startElement('div');
	$Page->writeAttribute('id', 'sv-mobile-flash');
	$Page->writeAttribute('style', 'position: absolute; width: 600px; height: 900px;');
	
	$Page->startElement('object');
	$Page->writeAttribute('width', '100%');
	$Page->writeAttribute('height', '100%');
	$Page->writeAttribute('id', 'sv-mobile-flash-swf');
	$Page->writeAttribute('style', 'position: relative; top: -140px; visibility: visible; margin-left: 25%; margin-right: 25%;');
	
	$HttpUserAgent = $_SERVER['HTTP_USER_AGENT'];
	
	if (strstr($HttpUserAgent, 'MSIE 6.0')) {
		$AllowScriptAccess = TRUE;
		$Page->writeAttribute('classid', 'clsid:D27CDB6E-AE6D-11cf-96B8-444553540000');
		$Page->writeAttribute('id', 'player');
		$Page->writeAttribute('name', 'player');
	} else if (strstr($HttpUserAgent,'MSIE 7.0')) {
		$AllowScriptAccess = TRUE;
		$Page->writeAttribute('classid', 'clsid:D27CDB6E-AE6D-11cf-96B8-444553540000');
		$Page->writeAttribute('id', 'player');
		$Page->writeAttribute('name', 'player');
	} else if (strstr($HttpUserAgent,'MSIE 8.0')) {
		$AllowScriptAccess = TRUE;
		$Page->writeAttribute('classid', 'clsid:D27CDB6E-AE6D-11cf-96B8-444553540000');
		$Page->writeAttribute('id', 'player');
		$Page->writeAttribute('name', 'player');
	} else {
		$Page->writeAttribute('type', 'application/x-shockwave-flash');
		$Page->writeAttribute('data', 'svcore/swf/simpleviewer.swf');
	}
	
	$Page->writeAttribute('width', '550');
	$Page->writeAttribute('height', '400');
	
	if ($AllowScriptAccess == TRUE) {
		$Page->writeAttribute('AllowScriptAccess', 'always');
	}
	
	$Page->startElement('param');
	$Page->writeAttribute('name', 'movie');
	$Page->writeAttribute('value', 'svcore/swf/simpleviewer.swf');
	$Page->endElement();
	
	$Page->startElement('param');
	$Page->writeAttribute('name', 'allowscriptaccess');
	$Page->writeAttribute('value', 'always');
	$Page->endElement();
	
	$Page->startElement('param');
	$Page->writeAttribute('name', 'quality');
	$Page->writeAttribute('value', 'high');
	$Page->endElement();
	
	$Page->startElement('param');
	$Page->writeAttribute('name', 'allowfullscreen');
	$Page->writeAttribute('value', 'true');
	$Page->endElement();
	
	$Page->startElement('param');
	$Page->writeAttribute('name', 'wmode');
	$Page->writeAttribute('value', 'transparent');
	$Page->endElement();
	
	$Page->endElement(); // ENDS OBJECT
	$Page->endElement(); // ENDS DIV
	$Page->endElement(); // ENDS DIV
	
	$Page->endElement(); // ENDS BODY
	$Page->endElement(); // ENDS HTML
	
	$pageoutput = $Page->flush();
	print $pageoutput;
	
	/*
	// Includes all files
	require_once ("$HOME/Configuration/includes.php");
	
	// Fetch idnumber For Current Page
	$idnumber = 1;
	if ($_GET['PageID']){
		$idnumber = $_GET['PageID'];
	}

	$idnumberkeep = $idnumber;
	$printpreview = NULL;

	$Tier6Databases->setDatabaseTableName('ContentLayer');
	
	if ($_GET['printpreview']) {
		$printpreview = TRUE;
	} else {
		$printpreview = FALSE;
	}
	
	$Tier6Databases->setPrintPreview($printpreview);
	
	// Fetch Current Page ID - Based On ID Number
	$contentidnumber = Array();
	$contentidnumber['PageID'] = $idnumber;
	$contentidnumber['Enable/Disable'] = 'Enable';
	$contentidnumber['Status'] = 'Approved';
	
	if (isset($_GET['RevisionID'])){
		$contentidnumber['RevisionID'] = $_GET['RevisionID'];
	} else {
		$contentidnumber['CurrentVersion'] = 'true';
	}
	
	$Tier6Databases->FetchDatabase($contentidnumber);
	$Tier6Databases->CreateOutput(NULL);
		
	$output = $Writer->flush();
	if ($output) {
		print "$output\n";
	} else {
		header("HTTP/1.0 404 Not Found");
	}
	*/
?>