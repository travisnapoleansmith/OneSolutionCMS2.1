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

	print "<body>\n";

	if ($printpreview == FALSE) {
		// Top Panel 2
		print "\n<div id=\"TopPanel2\" class=\"TopPanel2\">\n";
		require ('Configuration/Tier6-ContentLayer/toppanel2.php');
		print "</div>\n\n";
		
	}
	// Main Menu 
	//require ('Configuration/Tier6-ContentLayer/menu.php');
	//require ('Administrators/updateMainMenu.php');
	if ($printpreview == FALSE) {
		require('menu.html');
	}
	
	// Contain Container
	print "<div id=\"textlayer1\">\n";

	require('Configuration/Tier6-ContentLayer/content.php');
	
	if ($idnumberkeep == 1) {
		// News Container
		require ('Configuration/Tier6-ContentLayer/news.php');
	}
	
	print "</div>\n\n";
	
	if ($printpreview == FALSE && $idnumberkeep == 1) {
		// Bottom Panel 2
		print "<div id=\"BottomPanel1\" class=\"BottomPanel1\">\n";
		require ('Configuration/Tier6-ContentLayer/bottompanel1news.php');
		print "</div>\n\n";
	}
	if ($printpreview == FALSE) {
		print "<div id=\"BottomPanel2\" class=\"BottomPanel2\">\n";
		// Bottom Panel 2
		require ('Configuration/Tier6-ContentLayer/bottompanel2.php');
		print "</div>\n\n";
	}

	// Print Out End Of Body and HTML File
	print "</body>\n";
	print "</html>\n";
?>
