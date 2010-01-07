<?php
	// Includes all files
	/*require_once ('Configuration/includes.php');
	
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
	$newsidnumber = Array();
	// MUST LOOK AT FIXING P PROBLEM WITH LINKS!
	//$newsidnumber['PageID'] = 6;
	
	//$newsidnumber['PageID'] = NULL;
	
	if ($_GET['NewsID']){
		$newsidnumber['PageID'] = $_GET['NewsID'];
	} else {
		$newsidnumber['PageID'] = 1;
	}
	$newsidnumber['ObjectID'] = 0;
	$newsdatabase = Array();
	$newsdatabase['NewsButtons'] = 'NewsButtons';
	$newsdatabase['NewsStories'] = 'NewsStories';
	$newsdatabase['ContentLayerTables'] = 'ContentLayerTables';
	
	$databases = &$GLOBALS['Databases'];

	$news = new XhtmlNews($newsdatabase, $databases);
	$news->setDatabaseAll ($credentaillogonarray[0], $credentaillogonarray[1], $credentaillogonarray[2], $credentaillogonarray[3], 'NewsStories');
	$news->setHttpUserAgent($_SERVER['HTTP_USER_AGENT']);
	$news->FetchDatabase ($newsidnumber);
	$news->CreateOutput('    ');
	
	$newsoutput = $news->getOutput();
	print "  $newsoutput";
	*/
	
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