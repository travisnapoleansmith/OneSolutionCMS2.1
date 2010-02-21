<?php
	
	// Includes all files
	require_once ('Configuration/includes.php');
	
	// Fetch idnumber For Current Page
	$idnumber = 1;
	if ($_GET['NewsID']){
		$idnumber = $_GET['NewsID'];
	}

	$idnumberkeep = $idnumber;

	if ($_GET['printpreview']) {
		$printpreview = TRUE;
	}
	// Creates Header
	require_once ('Configuration/News/Tier6-ContentLayer/header.php');

	print "<body>\n";
	
	if ($printpreview == FALSE) {
		// Top Panel 2
		print "\n<div id=\"TopPanel2\" class=\"TopPanel2\">\n";
		require ('Configuration/News/Tier6-ContentLayer/toppanel2.php');
		print "</div>\n\n";
		
	}
	
	// Main Menu
	if ($printpreview == FALSE) {
		require_once('menu.html');
	}
	
	// Contain Container
	print "<div id=\"textlayer1\">\n";
	
	// News Container
	require_once ('Configuration/News/Tier6-ContentLayer/news.php');
	
	// Picture Container
	require_once ('Configuration/News/Tier6-ContentLayer/picture.php');
	
	print "</div>\n\n";
	
	if ($printpreview == FALSE) {
		print "<div id=\"BottomPanel2\" class=\"BottomPanel2\">\n";
		// Bottom Panel 2
		require ('Configuration/News/Tier6-ContentLayer/bottompanel2.php');
		print "</div>\n\n";
	}
?>