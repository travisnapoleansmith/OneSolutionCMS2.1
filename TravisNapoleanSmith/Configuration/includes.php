<?php
	// General Settings
	require_once 'Configuration/settings.php';
	
	// All Tier Abstract
	require_once 'ModulesAbstract/LayerModulesAbstract.php';
	
	// Tiers Modules Abstract
	require_once 'ModulesAbstract/Tier6ContentLayer/Tier6ContentLayerModulesAbstract.php';
	require_once 'ModulesAbstract/Tier5ValidationLayer/Tier5ValidationLayerModulesAbstract.php';
	require_once 'ModulesAbstract/Tier4AuthenticationLayer/Tier4AuthenticationLayerModulesAbstract.php';
	require_once 'ModulesAbstract/Tier3ProtectionLayer/Tier3ProtectionLayerModulesAbstract.php';
	require_once 'ModulesAbstract/Tier2DataAccessLayer/Tier2DataAccessLayerModulesAbstract.php';
	
	// Tiers Interface Includes
	require_once 'ModulesInterfaces/Tier6ContentLayer/Tier6ContentLayerModulesInterfaces.php';
	require_once 'ModulesInterfaces/Tier5ValidationLayer/Tier5ValidationLayerModulesInterfaces.php';
	require_once 'ModulesInterfaces/Tier4AuthenticationLayer/Tier4AuthenticationLayerModulesInterfaces.php';
	require_once 'ModulesInterfaces/Tier3ProtectionLayer/Tier3ProtectionLayerModulesInterfaces.php';
	require_once 'ModulesInterfaces/Tier2DataAccessLayer/Tier2DataAccessLayerModulesInterfaces.php';
	
	// Tiers Includes
	require_once 'Tier2-DataAccessLayer/ClassDataAccessLayer.php';
	require_once 'Tier3-ProtectionLayer/ClassProtectionLayer.php';
	require_once 'Tier4-AuthenticationLayer/ClassAuthenticationLayer.php';
	require_once 'Tier5-ValidationLayer/ClassValidationLayer.php';
	require_once 'Tier6-ContentLayer/ClassContentLayer.php';
	
	// Tier 2 Modules
	require_once 'Modules/Tier2DataAccessLayer/MySqlConnect/ClassMySqlConnect.php';
	
	// Tier 3 Modules
	/*require_once 'Modules/Tier3ProtectionLayer/Audit/ClassAudit.php';
	require_once 'Modules/Tier3ProtectionLayer/Revisions/ClassRevisions.php';
	require_once 'Modules/Tier3ProtectionLayer/SpamFilter/ClassSpamFilter.php';
	require_once 'Modules/Tier3ProtectionLayer/SqlInjection/ClassSqlInjection.php';
	require_once 'Modules/Tier3ProtectionLayer/UserPermissions/ClassUserPermissions.php';*/
	
	// Tier 4 Modules
	
	// Tier 5 Modules
	
	// Tier 6 Modules
	/*require_once 'Modules/Tier6ContentLayer/XhtmlCalendarTable/ClassXhtmlCalendarTable.php';
	require_once 'Modules/Tier6ContentLayer/XhtmlContent/ClassXhtmlContent.php';
	require_once 'Modules/Tier6ContentLayer/XhtmlFlash/ClassXhtmlFlash.php';
	require_once 'Modules/Tier6ContentLayer/XhtmlHeader/ClassXhtmlHeader.php';
	require_once 'Modules/Tier6ContentLayer/XhtmlList/ClassXhtmlList.php';
	require_once 'Modules/Tier6ContentLayer/XhtmlMainMenu/ClassXhtmlMainMenu.php';
	require_once 'Modules/Tier6ContentLayer/XhtmlMenu/ClassXhtmlMenu.php';
	require_once 'Modules/Tier6ContentLayer/XhtmlNews/ClassXhtmlNews.php';
	require_once 'Modules/Tier6ContentLayer/XhtmlPicture/ClassXhtmlPicture.php';
	
	require_once 'Modules/Tier6ContentLayer/Menu/ClassMenuItem.php'; 
	require_once 'Modules/Tier6ContentLayer/Menu/ClassMenuItemList.php';
	require_once 'Modules/Tier6ContentLayer/Menu/ClassMenu.php';
	
	require_once 'Modules/Tier6ContentLayer/XmlFeed/ClassXmlFeed.php';
	require_once 'Modules/Tier6ContentLayer/XmlSitemap/ClassXmlSitemap.php';*/
	
	
	// Tier 2 Data Access Layer Settings
	require_once 'Configuration/Tier2DataAccessLayerSettings.php';
	require_once 'Configuration/Tier2DataAccessLayerDatabaseSettings.php';
	
	// Tier 3 Protection Layer Settings
	require_once 'Configuration/Tier3ProtectionLayerSettings.php';
	require_once 'Configuration/Tier3ProtectionLayerDatabaseSettings.php';
	
	// Tier 4 Authentication Layer Settings
	require_once 'Configuration/Tier4AuthenticationLayerSettings.php';
	require_once 'Configuration/Tier4AuthenticationLayerDatabaseSettings.php';
	
	// Tier 5 Validation Layer Settings
	require_once 'Configuration/Tier5ValidationLayerSettings.php';
	require_once 'Configuration/Tier5ValidationLayerDatabaseSettings.php';
	
	// Tier 6 Content Layer Settings
	require_once 'Configuration/Tier6ContentLayerSettings.php';
	require_once 'Configuration/Tier6ContentLayerDatabaseSettings.php';
	
?>