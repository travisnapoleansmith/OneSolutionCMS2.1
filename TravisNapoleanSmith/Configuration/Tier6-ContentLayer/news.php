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
	$newsidnumber['PageID'] = 6;
	
	$newsidnumber['PageID'] = NULL;
	
	if ($_GET['NewsID']){
		$newsidnumber['PageID'] = $_GET['NewsID'];
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
	$rowcount = $news->getNewsButtonsRowCount();
	
	$newsoutput = $news->getOutput();
	print "$newsoutput";
	
	if ($_GET['printpreview']) {
		while ($rowcount > 1) {
			$rowcount--;
			$newsidnumber['PageID'] = $rowcount;
			$news2 = new XhtmlNews($newsdatabase, $databases);
			$news2->setDatabaseAll ($credentaillogonarray[0], $credentaillogonarray[1], $credentaillogonarray[2], $credentaillogonarray[3], 'NewsStories');
			$news2->setHttpUserAgent($_SERVER['HTTP_USER_AGENT']);
			$news2->FetchDatabase ($newsidnumber);
			$news2->CreateOutput('    ');
			
			$newsoutput2 = $news2->getOutput();
			print "$newsoutput2";
		}
	}
	
?>