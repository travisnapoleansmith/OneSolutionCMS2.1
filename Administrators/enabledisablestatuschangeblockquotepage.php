<?php
	require_once ('Configuration/includes.php');
	
	$hold = $_POST['BlockquotePage'];
	$hold = explode(' ', $hold);
	$PageID = $hold[2];
	$_POST['PageID'] = $PageID;
	$_POST['FormOptionObjectID'] = $hold[0];
	unset($hold);
	
	$PageID = array();
	$PageID['PageID'] = $_POST['PageID'];
	$FormOptionObjectID = $_POST['FormOptionObjectID'];
	$PageID['EnableDisable'] = $_POST['EnableDisable'];
	$PageID['Status'] = $_POST['Status'];
	
	$Options = $Tier6Databases->getLayerModuleSetting();
	
	if (!is_null($PageID)) {
		$Tier6Databases->ModulePass('XhtmlHeader', 'header', 'updateHeaderStatus', $PageID);
		$Tier6Databases->ModulePass('XhtmlMenu', 'headerpanel1', 'updateMenuStatus', $PageID);
		$Tier6Databases->ModulePass('XhtmlContent', 'content', 'updateContentStatus', $PageID);
		$Tier6Databases->ModulePass('XmlSitemap', 'sitemap', 'updateSitemapItemStatus', $PageID);
		$Tier6Databases->ModulePass('XhtmlContent', 'content', 'updateContentPrintPreviewStatus', $PageID);
		$Tier6Databases->updateContentStatus($PageID, 'ContentLayer');
		
		$FormOptionID = $Options['XhtmlContent']['content']['UpdateBlockquotePageSelect']['SettingAttribute'];
		$ContentPageID = array();
		$ContentPageID['PageID'] = &$FormOptionID;
		$ContentPageID['ObjectID'] = $FormOptionObjectID;
		$ContentPageID['EnableDisable'] = $_POST['EnableDisable'];
		$ContentPageID['Status'] = $_POST['Status'];
		
		$Tier6Databases->ModulePass('XhtmlForm', 'form', 'updateFormOptionStatus', $ContentPageID);
		$Tier6Databases->ModulePass('XhtmlForm', 'form', 'updateFormSelectStatus', $ContentPageID);
		
		$FormOptionID = $Options['XhtmlContent']['content']['DeleteContentPage']['SettingAttribute'];
		$Tier6Databases->ModulePass('XhtmlForm', 'form', 'updateFormOptionStatus', $ContentPageID);
		$Tier6Databases->ModulePass('XhtmlForm', 'form', 'updateFormSelectStatus', $ContentPageID);
		
		$EnableDisableBlockquotePage = $Options['XhtmlContent']['content']['EnableDisableBlockquotePage']['SettingAttribute'];
		header("Location: $EnableDisableBlockquotePage");
	} else {
		$EnableDisableStatusChangeBlockquotePage = $Options['XhtmlContent']['content']['EnableDisableStatusChangeBlockquotePage']['SettingAttribute'];
		header("Location: index.php?PageID=$EnableDisableStatusChangeBlockquotePage");
	}
?>