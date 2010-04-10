<?php	
	//error_reporting('E_ERROR');
	// Includes all files
	require_once ('Configuration/includes.php');
	
	// Fetch idnumber For Current Page
	$idnumber = 1;
	if ($_GET['PageID']){
		$idnumber = $_GET['PageID'];
	}

	$idnumberkeep = $idnumber;

	if ($_GET['printpreview']) {
		$printpreview = TRUE;
	}
	// Creates Header
	require ('Configuration/Tier6-ContentLayer/header.php');
	
	$Writer->startElement('body');
	
	if ($printpreview == FALSE) {
		// Top Panel 2
		$Writer->startElement('div');
			$Writer->writeAttribute('id', 'TopPanel2');
			$Writer->writeAttribute('class', 'TopPanel2');
			require ('Configuration/Tier6-ContentLayer/toppanel2.php');
		$Writer->endElement(); // ENDS DIV
	}
	
	// Main Menu 
	//require ('Configuration/Tier6-ContentLayer/menu.php');
	//require ('Administrators/updateMainMenu.php');
	if ($printpreview == FALSE) {
		$file = file_get_contents('menu.html');
		$Writer->writeRaw($file);
	}
	
	// Contain Container
	$Writer->startElement('div');
		$Writer->writeAttribute('id', 'textlayer1');
		require('Configuration/Tier6-ContentLayer/content.php');
		
		if ($idnumberkeep == 1) {
			// News Container
			require ('Configuration/Tier6-ContentLayer/news.php');
		}
		$Writer->writeRaw("  ");
	$Writer->endElement(); // ENDS DIV
	
	if ($printpreview == FALSE && $idnumberkeep == 1) {
		// Bottom Panel 2
		$Writer->startElement('div');
			$Writer->writeAttribute('id', 'BottomPanel1');
			$Writer->writeAttribute('class', 'BottomPanel1');
			$Writer->writeRaw("\n   ");
			require ('Configuration/Tier6-ContentLayer/bottompanel1news.php');
		$Writer->endElement(); // ENDS DIV
	}
	if ($printpreview == FALSE) {
		$Writer->startElement('div');
			$Writer->writeAttribute('id', 'BottomPanel2');
			$Writer->writeAttribute('class', 'BottomPanel2');
			$Writer->writeRaw("\n   ");
			// Bottom Panel 2
			require ('Configuration/Tier6-ContentLayer/bottompanel2.php');
		$Writer->endElement(); // ENDS DIV
	}
	
	
	// Print Out End Of Body and HTML File
	$Writer->endElement(); // ENDS BODY
	$Writer->endElement(); // ENDS HTML
	$output = $Writer->flush();
	print "$output\n";
?>
