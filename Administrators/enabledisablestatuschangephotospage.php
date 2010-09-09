<?php
	require_once ('Configuration/includes.php');
	
	$hold = $_POST['PhotosPage'];
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
		$Tier6Databases->ModulePass('XhtmlPicture', 'picture', 'updatePictureStatus', $PageID);
		
		$Tier6Databases->ModulePass('XhtmlHeader', 'header', 'updateHeaderStatus', $PageID);
		$Tier6Databases->ModulePass('XhtmlMenu', 'headerpanel1', 'updateMenuStatus', $PageID);
		$Tier6Databases->ModulePass('XhtmlContent', 'content', 'updateContentStatus', $PageID);
		$Tier6Databases->ModulePass('XmlSitemap', 'sitemap', 'updateSitemapItemStatus', $PageID);
		$Tier6Databases->ModulePass('XhtmlContent', 'content', 'updateContentPrintPreviewStatus', $PageID);
		$Tier6Databases->updateContentStatus($PageID, 'ContentLayer');
		
		$FormOptionID = $Options['XhtmlPicture']['picture']['UpdatePhotosPageSelect']['SettingAttribute'];
		$PhotosPageID = array();
		$PhotosPageID['PageID'] = &$FormOptionID;
		$PhotosPageID['ObjectID'] = $FormOptionObjectID;
		$PhotosPageID['EnableDisable'] = $_POST['EnableDisable'];
		$PhotosPageID['Status'] = $_POST['Status'];
		
		$Tier6Databases->ModulePass('XhtmlForm', 'form', 'updateFormOptionStatus', $PhotosPageID);
		$Tier6Databases->ModulePass('XhtmlForm', 'form', 'updateFormSelectStatus', $PhotosPageID);
		
		$FormOptionID = $Options['XhtmlPicture']['picture']['DeletePhotosPage']['SettingAttribute'];
		$Tier6Databases->ModulePass('XhtmlForm', 'form', 'updateFormOptionStatus', $PhotosPageID);
		$Tier6Databases->ModulePass('XhtmlForm', 'form', 'updateFormSelectStatus', $PhotosPageID);
		
		$EnableDisablePhotosPage = $Options['XhtmlPicture']['picture']['EnableDisablePhotosPage']['SettingAttribute'];
		header("Location: $EnableDisablePhotosPage");
	} else {
		$EnableDisableStatusChangePhotosPage = $Options['XhtmlPicture']['picture']['EnableDisableStatusChangePhotosPage']['SettingAttribute'];
		header("Location: index.php?PageID=$EnableDisableStatusChangePhotosPage");
	}
?>