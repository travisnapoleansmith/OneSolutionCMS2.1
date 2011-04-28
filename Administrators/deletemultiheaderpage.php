<?php
	require_once ('Configuration/includes.php');
	
	$hold = $_POST['MultiHeaderContentPage'];
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
		
		$FormOptionID = $Options['XhtmlContent']['content']['UpdateMultiHeaderPageSelect']['SettingAttribute'];
		$Tier6Databases->ModulePass('XhtmlForm', 'form', 'deleteFormOption', array('PageID' => $FormOptionID, 'ObjectID' => $FormOptionObjectID));
		$Tier6Databases->ModulePass('XhtmlForm', 'form', 'deleteFormSelect', array('PageID' => $FormOptionID, 'ObjectID' => $FormOptionObjectID));
		
		$FormOptionID = $Options['XhtmlContent']['content']['DeleteMultiHeaderPage']['SettingAttribute'];
		$Tier6Databases->ModulePass('XhtmlForm', 'form', 'deleteFormOption', array('PageID' => $FormOptionID, 'ObjectID' => $FormOptionObjectID));
		$Tier6Databases->ModulePass('XhtmlForm', 'form', 'deleteFormSelect', array('PageID' => $FormOptionID, 'ObjectID' => $FormOptionObjectID));
		
		$DeletedMultiHeaderPage = $Options['XhtmlContent']['content']['DeletedMultiHeaderPage']['SettingAttribute'];
		header("Location: $DeletedMultiHeaderPage");
		
	} else {
		$DeleteMultiHeaderPage = $Options['XhtmlContent']['content']['DeleteMultiHeaderPage']['SettingAttribute'];
		header("Location: index.php?PageID=$DeleteMultiHeaderPage");
	}
?>