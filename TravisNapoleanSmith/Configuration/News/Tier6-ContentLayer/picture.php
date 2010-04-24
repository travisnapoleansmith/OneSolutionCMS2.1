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
	$pictureidnumber = Array();
	$pictureidnumber['PageID'] = 1200;
	
	if ($_GET['PageID']){
		$pictureidnumber['PageID'] = $_GET['PageID'];
	}
	
	if ($_GET['printpreview']) {
		$printpreview = TRUE;
	}
	if ($printpreview == FALSE) {
		$pictureidnumber['ObjectID'] = 1;
		$picturedatabase = Array();

		$picturedatabase['Picture'] = 'Picture';
		
		$databaseoptions = NULL;
		
		$picture = new XhtmlPicture($picturedatabase, $databaseoptions);
		$picture->setDatabaseAll ($credentaillogonarray[0], $credentaillogonarray[1], $credentaillogonarray[2], $credentaillogonarray[3], 'Picture');
		$picture->setHttpUserAgent($_SERVER['HTTP_USER_AGENT']);
		$picture->FetchDatabase ($pictureidnumber);
		$picture->CreateOutput('    ');
		
		$pictureoutput = $picture->getOutput();
	
		print "  $pictureoutput";
	}

	
?>