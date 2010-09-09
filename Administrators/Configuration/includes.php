<?php
	// General Settings
	require_once '../Configuration/settings.php';
	
	// Allow and Deny Settings 
	require_once '../Configuration/Tier2DataAccessLayerSettings.php';
	require_once '../Configuration/Tier3ProtectionLayerSettings.php';
	require_once '../Configuration/Tier4AuthenticationLayerSettings.php';
	require_once '../Configuration/Tier5ValidationLayerSettings.php';
	require_once '../Configuration/Tier6ContentLayerSettings.php';
	
	// All Tier Abstract
	require_once '../ModulesAbstract/LayerModulesAbstract.php';
	
	// Tiers Modules Abstract
	require_once '../ModulesAbstract/Tier6ContentLayer/Tier6ContentLayerModulesAbstract.php';
	require_once '../ModulesAbstract/Tier5ValidationLayer/Tier5ValidationLayerModulesAbstract.php';
	require_once '../ModulesAbstract/Tier4AuthenticationLayer/Tier4AuthenticationLayerModulesAbstract.php';
	require_once '../ModulesAbstract/Tier3ProtectionLayer/Tier3ProtectionLayerModulesAbstract.php';
	require_once '../ModulesAbstract/Tier2DataAccessLayer/Tier2DataAccessLayerModulesAbstract.php';
	
	// Tiers Interface Includes
	require_once '../ModulesInterfaces/Tier6ContentLayer/Tier6ContentLayerModulesInterfaces.php';
	require_once '../ModulesInterfaces/Tier5ValidationLayer/Tier5ValidationLayerModulesInterfaces.php';
	require_once '../ModulesInterfaces/Tier4AuthenticationLayer/Tier4AuthenticationLayerModulesInterfaces.php';
	require_once '../ModulesInterfaces/Tier3ProtectionLayer/Tier3ProtectionLayerModulesInterfaces.php';
	require_once '../ModulesInterfaces/Tier2DataAccessLayer/Tier2DataAccessLayerModulesInterfaces.php';
	
	// Tiers Includes
	require_once '../Tier2-DataAccessLayer/ClassDataAccessLayer.php';
	require_once '../Tier3-ProtectionLayer/ClassProtectionLayer.php';
	require_once '../Tier4-AuthenticationLayer/ClassAuthenticationLayer.php';
	require_once '../Tier5-ValidationLayer/ClassValidationLayer.php';
	require_once '../Tier6-ContentLayer/ClassContentLayer.php';
	
	// Tier 2 Modules
	require_once '../Modules/Tier2DataAccessLayer/MySqlConnect/ClassMySqlConnect.php';
	
	// Tier 3 Modules
	require_once '../Modules/Tier3ProtectionLayer/Audit/ClassAudit.php';
	require_once '../Modules/Tier3ProtectionLayer/Revisions/ClassRevisions.php';
	require_once '../Modules/Tier3ProtectionLayer/SpamFilter/ClassSpamFilter.php';
	require_once '../Modules/Tier3ProtectionLayer/SqlInjection/ClassSqlInjection.php';
	require_once '../Modules/Tier3ProtectionLayer/UserPermissions/ClassUserPermissions.php';
	
	// Tier 4 Modules
	require_once '../Modules/Tier4AuthenticationLayer/UserAccounts/ClassUserAccounts.php';
	
	// Tier 5 Modules
	require_once '../Modules/Tier5ValidationLayer/FormValidation/ClassFormValidation.php';
	
	// Tier 6 Modules
	
	// Tier 6 Content Layer Settings
	require_once 'Configuration/Tier6ContentLayerDatabaseSettings.php';
	
?>