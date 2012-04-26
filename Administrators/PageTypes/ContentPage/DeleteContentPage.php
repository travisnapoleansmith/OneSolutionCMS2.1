<?php
	$HOME = $_SERVER['SUBDOMAIN_DOCUMENT_ROOT'];
	$ADMINHOME = $HOME . '/Administrators/';
	$GLOBALS['HOME'] = $HOME;
	$GLOBALS['ADMINHOME'] = $ADMINHOME;
	
	require_once ("$ADMINHOME/Configuration/includes.php");
	
	$hold = $_POST['ContentPage'];
	$hold = explode(' ', $hold);
	$PageID = $hold[2];
	$_POST['PageID'] = $PageID;
	$_POST['FormOptionObjectID'] = $hold[0];
	unset($hold);
	
	$PageID['PageID'] = $_POST['PageID'];
	$FormOptionObjectID = $_POST['FormOptionObjectID'];
	
	$Options = $Tier6Databases->getLayerModuleSetting();
	
	if (!is_null($PageID)) {		
		$Tier6Databases->ModulePass('XhtmlHeader', 'header', 'deleteHeader', array('PageID' => $PageID));
		$Tier6Databases->ModulePass('XhtmlMenu', 'headerpanel1', 'deleteMenu', array('PageID' => $PageID));
		$Tier6Databases->ModulePass('XhtmlContent', 'content', 'deleteContent', array('PageID' => $PageID));
		$Tier6Databases->ModulePass('XmlSitemap', 'sitemap', 'deleteSitemapItem', array('PageID' => $PageID));
		$Tier6Databases->ModulePass('XhtmlContent', 'content', 'deleteContentPrintPreview', array('PageID' => $PageID));
		$Tier6Databases->deleteContent(array('PageID' => $PageID), 'ContentLayer');
		
		$FormOptionID = $Options['XhtmlContent']['content']['UpdateContentPageSelect']['SettingAttribute'];
		$Tier6Databases->ModulePass('XhtmlForm', 'form', 'deleteFormOption', array('PageID' => $FormOptionID, 'ObjectID' => $FormOptionObjectID));
		$Tier6Databases->ModulePass('XhtmlForm', 'form', 'deleteFormSelect', array('PageID' => $FormOptionID, 'ObjectID' => $FormOptionObjectID));
		
		$FormOptionID = $Options['XhtmlContent']['content']['DeleteContentPage']['SettingAttribute'];
		$Tier6Databases->ModulePass('XhtmlForm', 'form', 'deleteFormOption', array('PageID' => $FormOptionID, 'ObjectID' => $FormOptionObjectID));
		$Tier6Databases->ModulePass('XhtmlForm', 'form', 'deleteFormSelect', array('PageID' => $FormOptionID, 'ObjectID' => $FormOptionObjectID));
		
		$DeletedContentPage = $Options['XhtmlContent']['content']['DeletedContentPage']['SettingAttribute'];
		header("Location: $DeletedContentPage");
		
	} else {
		$DeleteContentPage = $Options['XhtmlContent']['content']['DeleteContentPage']['SettingAttribute'];
		header("Location: ../../index.php?PageID=$DeleteContentPage");
	}
?>