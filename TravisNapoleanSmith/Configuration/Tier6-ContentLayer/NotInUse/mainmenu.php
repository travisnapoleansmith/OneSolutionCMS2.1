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
	$mainmenudatabase['MainMenuLookup'] = 'MainMenuLookup';
	$mainmenudatabase['MainMenu'] = 'MainMenu';
	
	$databaseoptions = array();
	if (strstr($_SERVER['HTTP_USER_AGENT'], 'MSIE 6.0')) {
		$databaseoptions['JavaScriptFileName'] = 'Tier7-BehavioralLayer/menu-jquery.js';
		$databaseoptions['JavaScriptLibraryName'] = 'Tier7-BehavioralLayer/jquery-1.3.2.min.js';
	}
	
	/*$mainmenudatabase['MainMenuID'] = 'main-menu';
	$mainmenudatabase['MainMenuClass'] = NULL;
	$mainmenudatabase['MainMenuStyle'] = NULL;
	$mainmenudatabase['MainMenuInsert'] = NULL;
	
	$mainmenudatabase['MainMenuTopID'] = 'main-menu-top';
	$mainmenudatabase['MainMenuTopClass'] = NULL;
	$mainmenudatabase['MainMenuTopStyle'] = NULL;
	$mainmenudatabase['MainMenuTopInsert'] = NULL;
	
	$mainmenudatabase['MainMenuBottomID'] = 'main-menu-bottom';
	$mainmenudatabase['MainMenuBottomClass'] = NULL;
	$mainmenudatabase['MainMenuBottomStyle'] = NULL;
	$mainmenudatabase['MainMenuBottomInsert'] = NULL;
	
	$mainmenudatabase['Insert'] = '<img src="Images/Main-Logo.png" alt="KC Photo and Video Logo" class="main-menu-image"/>';
	*/
	//$databases = &$GLOBALS['Tier6Databases'];
	
	
	$databaseoptions['MainMenuID'] = 'main-menu';
	$databaseoptions['MainMenuClass'] = NULL;
	$databaseoptions['MainMenuStyle'] = NULL;
	$databaseoptions['MainMenuInsert'] = NULL;
	
	$databaseoptions['MainMenuTopID'] = 'main-menu-top';
	$databaseoptions['MainMenuTopClass'] = NULL;
	$databaseoptions['MainMenuTopStyle'] = NULL;
	$databaseoptions['MainMenuTopInsert'] = NULL;
	
	$databaseoptions['MainMenuBottomID'] = 'main-menu-bottom';
	$databaseoptions['MainMenuBottomClass'] = NULL;
	$databaseoptions['MainMenuBottomStyle'] = NULL;
	$databaseoptions['MainMenuBottomInsert'] = NULL;
	
	$databaseoptions['Insert'] = '<img src="Images/Main-Logo.png" alt="KC Photo and Video Logo" class="main-menu-image"/>';
	
	$credentaillogonarray = $GLOBALS['credentaillogonarray'];
	
	$mainmenu = new XhtmlMainMenu($mainmenudatabase, $databaseoptions);
	$mainmenu->setDatabaseAll ($credentaillogonarray[0], $credentaillogonarray[1], $credentaillogonarray[2], $credentaillogonarray[3], 'MainMenuLookupNew');
	$mainmenu->setHttpUserAgent($_SERVER['HTTP_USER_AGENT']);
	$mainmenu->FetchDatabase ($mainmenuidnumber);
	$mainmenu->CreateOutput('    ');
	
	//$mainmenuoutput = $mainmenu->getOutput();
	$mainmenuoutput = $GLOBALS['Writer']->flush();
	print "$flashoutput";
	
	//if ($mainmenuoutput) {
		//$Writer->writeRaw($mainmenuoutput);
		//$Writer->writeRaw("\n");
	//}
	//print "$mainmenuoutput\n";
?>