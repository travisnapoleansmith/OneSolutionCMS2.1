<?php
	// Tiers Includes
	require_once 'Tier3-ProtectionLayer/ClassProtectionLayer.php';
	require_once 'Tier2-DataAccessLayer/ClassMySqlConnect.php';

	// Tiers Interface Includes
	require_once 'ModulesInterfaces/Tier6ContentLayer/Tier6ContentLayerModulesInterfaces.php';
	
	// Tier 3 Protection Layer Settings
	require_once 'Configuration/Tier3ProtectionLayerDatabaseSettings.php';
	require_once 'Configuration/Tier3ProtectionLayerSettings.php';
	
	// General Settings
	require_once 'Configuration/settings.php';
	
	// Tier 6 Modules
	require_once 'Modules/Tier6ContentLayer/XhtmlContent/ClassXhtmlContent.php';
	require_once 'Modules/Tier6ContentLayer/XhtmlFlash/ClassXhtmlFlash.php';
	require_once 'Modules/Tier6ContentLayer/XhtmlHeader/ClassXhtmlHeader.php';
	require_once 'Modules/Tier6ContentLayer/XhtmlList/ClassXhtmlList.php';
	require_once 'Modules/Tier6ContentLayer/XhtmlMenu/ClassXhtmlMenu.php';
	require_once 'Modules/Tier6ContentLayer/XhtmlNews/ClassXhtmlNews.php';
	require_once 'Modules/Tier6ContentLayer/XhtmlPicture/ClassXhtmlPicture.php';
	
	require_once 'Modules/Tier6ContentLayer/Menu/ClassMenuItem.php'; 
	require_once 'Modules/Tier6ContentLayer/Menu/ClassMenuItemList.php';
	require_once 'Modules/Tier6ContentLayer/Menu/ClassMenu.php';
?>