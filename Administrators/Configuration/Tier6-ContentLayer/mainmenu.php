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
	$mainmenudatabase['MainMenuLookup'] = 'AdministratorMainMenuLookup';
	$mainmenudatabase['MainMenu'] = 'AdministratorMainMenu';
	
	$databaseoptions = NULL;
	if (strstr($_SERVER['HTTP_USER_AGENT'], 'MSIE 6.0')) {
		$databaseoptions['JavaScriptFileName'] = '../Tier7-BehavioralLayer/AdminPanel/menu-jquery.js';
		$databaseoptions['JavaScriptLibraryName'] = '../Tier7-BehavioralLayer/AdminPanel/jquery-1.3.2.min.js';
	}
	
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
	
	$databaseoptions['Insert'] = '<img src="../Tier8-PresentationLayer/AdminTheme/TemplateImages/Main-Logo.png" alt="One Solution CMS Logo" class="main-menu-image"/>';
		
	$Writer = $GLOBALS['Writer'];
	$Tier6Databases = $GLOBALS['Tier6Databases'];
	
	if (strstr($_SERVER['HTTP_USER_AGENT'], 'MSIE 6.0')) {
		$Writer->startElement('script');
		$Writer->writeAttribute('type', 'text/javascript');
		$Writer->writeAttribute('src', 'Libraries/Tier7BehavioralLayer/IEPngFix/iepngfix_tilebg.js');
		$Writer->fullEndElement();
		$Writer->writeRaw("\n");
	}
	
	$credentaillogonarray = $GLOBALS['credentaillogonarray'];
	
	$mainmenu = new XhtmlMainMenu($mainmenudatabase, $databaseoptions, $Tier6Databases);
	$mainmenu->setDatabaseAll ($credentaillogonarray[0], $credentaillogonarray[1], $credentaillogonarray[2], $credentaillogonarray[3], 'MainMenuLookup');
	$mainmenu->setHttpUserAgent($_SERVER['HTTP_USER_AGENT']);
	$mainmenu->FetchDatabase ($mainmenuidnumber);
	$mainmenu->CreateOutput('    ');
	
?>