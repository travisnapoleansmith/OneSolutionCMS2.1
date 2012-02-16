<?php
	$HOME = $_SERVER['SUBDOMAIN_DOCUMENT_ROOT'];
	$ADMIN = $HOME . '/Administrators';
	
	require_once ("$ADMIN/Configuration/includes.php");
	
	$hold = $_POST['BlockquotePage'];
	$hold = explode(' ', $hold);
	$PageID = $hold[2];
	$_POST['PageID'] = $PageID;
	$_POST['FormOptionObjectID'] = $hold[0];
	unset($hold);
	
	$PageID = array();
	$PageID['PageID'] = $_POST['PageID'];
	$PageID['CurrentVersion'] = 'true';
	
	$passarray = array();
	$passarray['PageID'] = $PageID;
	unset($passarray['DatabaseVariableName']);
	$ContentPageVersion = $Tier6Databases->getRecord($PageID, 'ContentLayerVersion');
	$PageVersion = $ContentPageVersion[0]['RevisionID'];
	
	$PageID['RevisionID'] = $PageVersion;
	
	$passarray = array();
	$passarray['PageID'] = $PageID;
	$passarray['DatabaseVariableName'] = 'ContentTableName';
	$ContentPage = $Tier6Databases->ModulePass('XhtmlContent', 'content', 'getRecord', $passarray);
	
	$ContentPageHeader = $Tier6Databases->getRecord($passarray['PageID'], 'PageAttributes');
	
	unset($passarray['PageID']['CurrentVersion']);
	unset($passarray['PageID']['RevisionID']);
	$HeaderPanel1 = $Tier6Databases->getRecord($passarray['PageID'], 'HeaderPanel1');
	
	unset($passarray);
	$passarray = array();
	$passarray['PageID'] = $PageID['PageID'];
	$Sitemap = $Tier6Databases->getRecord($passarray, 'XMLSitemap');
	
	$Sitemap[0]['Priority'] *= 10;
	
	$hold = array();
	$hold['Tag'] = 'h1';
	$hold['Content'] = $HeaderPanel1[1]['Div1'];
	$Header = $Tier6Databases->ModulePass('XhtmlMenu', 'headerpanel1', 'removeTag', $hold);
	
	$sessionname = $Tier6Databases->SessionStart('UpdateBlockquotePage');
    
	$_SESSION['POST']['FilteredInput']['PageID'] = $_POST['PageID'];
	$_SESSION['POST']['FilteredInput']['FormOptionObjectID'] = $_POST['FormOptionObjectID'];
	$_SESSION['POST']['FilteredInput']['RevisionID'] = $ContentPageVersion[0]['RevisionID'];
	$_SESSION['POST']['FilteredInput']['MenuObjectID'] = $ContentPageVersion[0]['ContentPageMenuObjectID'];
	$_SESSION['POST']['FilteredInput']['CreationDateTime'] = $ContentPageVersion[0]['CreationDateTime'];
	$_SESSION['POST']['FilteredInput']['Owner'] = $ContentPageVersion[0]['Owner'];
	$_SESSION['POST']['FilteredInput']['UserAccessGroup'] = $ContentPageVersion[0]['UserAccessGroup'];
	
	$_SESSION['POST']['FilteredInput']['PageTitle'] = $ContentPageHeader[0]['PageTitle'];
	if ($ContentPageHeader[0]['MetaNameContent1']) {
		$_SESSION['POST']['FilteredInput']['Keywords'] = $ContentPageHeader[0]['MetaNameContent1'];
	} else {
		$_SESSION['POST']['FilteredInput']['Keywords'] = 'NULL';
	}
	if ($ContentPageHeader[0]['MetaNameContent2']) {
		$_SESSION['POST']['FilteredInput']['Description'] = $ContentPageHeader[0]['MetaNameContent2'];
	} else {
		$_SESSION['POST']['FilteredInput']['Description'] = 'NULL';
	}
	$_SESSION['POST']['FilteredInput']['Header'] = $Header;
	$_SESSION['POST']['FilteredInput']['Heading'] = $ContentPage[0]['Heading'];
	$_SESSION['POST']['FilteredInput']['Blockquote'] = $ContentPage[0]['Content'];
	
	$_SESSION['POST']['FilteredInput']['Priority'] = $Sitemap[0]['Priority'];
	$_SESSION['POST']['FilteredInput']['Frequency'] = ucfirst($Sitemap[0]['ChangeFreq']);
	
	$_SESSION['POST']['FilteredInput']['MenuName'] = $ContentPageVersion[0]['ContentPageMenuName'];
	$_SESSION['POST']['FilteredInput']['MenuTitle'] = $ContentPageVersion[0]['ContentPageMenuTitle'];
	
	$_SESSION['POST']['FilteredInput']['EnableDisable'] = 'Enable';
	$_SESSION['POST']['FilteredInput']['Status'] = 'Approved';
	
	$Options = $Tier6Databases->getLayerModuleSetting();
	$UpdateBlockquotePage = $Options['XhtmlContent']['content']['UpdateBlockquotePage']['SettingAttribute'];
	
	header("Location: $UpdateBlockquotePage&SessionID=$sessionname");
	
?>