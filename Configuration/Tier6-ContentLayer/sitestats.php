<?php
	///////////$credentaillogonarray = $GLOBALS['credentaillogonarray'];
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
	
	$PageID = Array();
	$PageID['PageID'] = 1;
	
	if ($_GET['PageID']){
		$PageID['PageID'] = $_GET['PageID'];
	}
	
	$Tier6Databases = $GLOBALS['Tier6Databases'];
	
	$SiteStatPage = array();
	$SiteStatPage['PageID'] = $PageID['PageID'];
	$SiteStatPage['Count'] = 0;
	
	$Tier6Databases->ModulePass('XhtmlSiteStats','sitestats','FetchDatabase',$PageID);
	$ReturnPageID = $Tier6Databases->ModulePass('XhtmlSiteStats','sitestats','checkSiteStatPage',$PageID);
	if ($ReturnPageID == TRUE) {
		$Tier6Databases->ModulePass('XhtmlSiteStats','sitestats','updateSiteStatPage',$PageID);
	} else {
		$Tier6Databases->ModulePass('XhtmlSiteStats','sitestats','createSiteStatPage',$SiteStatPage);
		$Tier6Databases->ModulePass('XhtmlSiteStats','sitestats','FetchDatabase',$PageID);
		$Tier6Databases->ModulePass('XhtmlSiteStats','sitestats','updateSiteStatPage',$PageID);
	}
	
	//$Tier6Databases->ModulePass('XhtmlSiteStats','sitestats','deleteSiteStatPage',$PageID);
	
	$Tier6Databases->ModulePass('XhtmlSiteStats','sitestats','FetchDatabase',$PageID);
	$Tier6Databases->ModulePass('XhtmlSiteStats','sitestats','CreateOutput', array('Space' => NULL));
	
?>