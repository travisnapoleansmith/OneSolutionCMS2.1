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
	
	$Tier6Databases->ModulePass('XhtmlAd','ad','FetchDatabase',$PageID);
	/*$ReturnPageID = $Tier6Databases->ModulePass('XhtmlAd','ad','checkSiteStatPage',$PageID);
	
	if ($ReturnPageID == TRUE) {
		print "TRUE\n";
		//$Tier6Databases->ModulePass('XhtmlAd','ad','updateSiteStatPage',$PageID);
	} else {
		print "FALSE\n";
		//$Tier6Databases->ModulePass('XhtmlAd','ad','createSiteStatPage',$SiteStatPage);
		//$Tier6Databases->ModulePass('XhtmlAd','ad','FetchDatabase',$PageID);
		//$Tier6Databases->ModulePass('XhtmlAd','ad','updateSiteStatPage',$PageID);
	}*/
	
	//$Tier6Databases->ModulePass('XhtmlAd','ad','deleteSiteStatPage',$PageID);
	
	//$Tier6Databases->ModulePass('XhtmlAd','ad','FetchDatabase',$PageID);
	$Tier6Databases->ModulePass('XhtmlAd','ad','CreateOutput', array('Space' => NULL));
?>