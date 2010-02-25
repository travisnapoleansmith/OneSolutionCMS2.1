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
	$mainmenuidnumber = Array();
	$mainmenuidnumber['PageID'] = 1;
	
	if ($_GET['PageID']){
		$mainmenuidnumber['PageID'] = $_GET['PageID'];
	}
	
	$mainmenudatabase = Array();
	$mainmenudatabase['MainMenuLookupNew'] = 'MainMenuLookupNew';
	$mainmenudatabase['MainMenuNew'] = 'MainMenuNew';
	
	if (strstr($_SERVER['HTTP_USER_AGENT'], 'MSIE 6.0')) {
		$mainmenudatabase['JavaScriptFileName'] = 'Tier7-BehavioralLayer/menu-jquery.js';
		$mainmenudatabase['JavaScriptLibraryName'] = 'Tier7-BehavioralLayer/jquery-1.3.2.min.js';
	}
	
	$databases = &$GLOBALS['Tier4Databases'];
	
	$mainmenu = new XhtmlMainMenu($mainmenudatabase, $databases);
	$mainmenu->setDatabaseAll ($credentaillogonarray[0], $credentaillogonarray[1], $credentaillogonarray[2], $credentaillogonarray[3], 'MainMenuLookupNew');
	$mainmenu->setHttpUserAgent($_SERVER['HTTP_USER_AGENT']);
	$mainmenu->FetchDatabase ($mainmenuidnumber);
	$mainmenu->CreateOutput('    ');
	
	$mainmenuoutput = $mainmenu->getOutput();
	
	print "$mainmenuoutput";
	
?>