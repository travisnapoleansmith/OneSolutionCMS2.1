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
	
	$newsidnumber['PageID'] = NULL;
	$newsidnumber['ObjectID'] = 0;
	
	$newsdatabase = Array();
	
	if ($_GET['NewsID']){
		$newsidnumber['PageID'] = $_GET['NewsID'];
		$newsdatabase['NewsButtons'] = 'NewsButtons';
		$newsdatabase['NewsStoriesFull'] = 'NewsStoriesFull';
		$newsdatabase['ContentLayerTables'] = 'ContentLayerTables';
		$newsname = 'NewsStoriesFull';
	} else {
		$newsidnumber['PageID'] = 1;
		$newsdatabase['NewsButtons'] = 'NewsButtons';
		$newsdatabase['NewsStoriesFullYearMonth'] = 'NewsStoriesFullYearMonth';
		$newsdatabase['ContentLayerTables'] = 'ContentLayerTables';
		$newsname = 'NewsStoriesFullYearMonth';
	}
	
	if ($_GET['StoryYear'] & $_GET['StoryMonth']) {
		$newsidnumber['PageID'] = $_GET['StoryYear'] . $_GET['StoryMonth'];
	} else if ($_GET['StoryYear']) {
		$newsidnumber['PageID'] = $_GET['StoryYear'];
	} else if ($_GET['StoryMonth']) {
		$newsidnumber['PageID'] = $_GET['StoryMonth'];
	}

	$databases = &$GLOBALS['Tier6Databases'];
	
	$news = new XhtmlNews($newsdatabase, $databases);
	$news->setDatabaseAll ($credentaillogonarray[0], $credentaillogonarray[1], $credentaillogonarray[2], $credentaillogonarray[3], $newsname);
	$news->setHttpUserAgent($_SERVER['HTTP_USER_AGENT']);
	$news->FetchDatabase ($newsidnumber);
	$news->CreateOutput('    ');
	
	$newsoutput = $news->getOutput();
	print "  $newsoutput";
	
?>