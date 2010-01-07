<?php
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
	
	if ($_GET['StoryYear'] & $_GET['StoryMonth']) {
		$newsidnumber['PageID'] = $_GET['StoryYear'] . $_GET['StoryMonth'];
	} else if ($_GET['StoryYear']) {
		$newsidnumber['PageID'] = $_GET['StoryYear'];
	} else if ($_GET['StoryMonth']) {
		$newsidnumber['PageID'] = $_GET['StoryMonth'];
	}

	$newsidnumber['ObjectID'] = 0;
	$newsdatabase = Array();
	$newsdatabase['NewsButtons'] = 'NewsButtons';
	$newsdatabase['NewsStoriesFull'] = 'NewsStoriesFull';
	$newsdatabase['ContentLayerTables'] = 'ContentLayerTables';

	$databases = &$GLOBALS['Databases'];

	$news = new XhtmlNews($newsdatabase, $databases);
	$news->setDatabaseAll ($credentaillogonarray[0], $credentaillogonarray[1], $credentaillogonarray[2], $credentaillogonarray[3], 'NewsStoriesFull');
	$news->setHttpUserAgent($_SERVER['HTTP_USER_AGENT']);
	$news->FetchDatabase ($newsidnumber);
	$news->CreateOutput('    ');
	
	$newsoutput = $news->getOutput();
	print "  $newsoutput";
	
?>