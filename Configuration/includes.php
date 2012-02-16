<?php
	$HOME = $_SERVER['SUBDOMAIN_DOCUMENT_ROOT'];
	// General Settings
	require_once "$HOME/Configuration/settings.php";
	
	// All Tier Abstract
	require_once "$HOME/ModulesAbstract/LayerModulesAbstract.php";
	
	// Tiers Modules Abstract
	require_once "$HOME/ModulesAbstract/Tier6ContentLayer/Tier6ContentLayerModulesAbstract.php";
	require_once "$HOME/ModulesAbstract/Tier5ValidationLayer/Tier5ValidationLayerModulesAbstract.php";
	require_once "$HOME/ModulesAbstract/Tier4AuthenticationLayer/Tier4AuthenticationLayerModulesAbstract.php";
	require_once "$HOME/ModulesAbstract/Tier3ProtectionLayer/Tier3ProtectionLayerModulesAbstract.php";
	require_once "$HOME/ModulesAbstract/Tier2DataAccessLayer/Tier2DataAccessLayerModulesAbstract.php";
	
	// Tiers Interface Includes
	require_once "$HOME/ModulesInterfaces/Tier6ContentLayer/Tier6ContentLayerModulesInterfaces.php";
	require_once "$HOME/ModulesInterfaces/Tier5ValidationLayer/Tier5ValidationLayerModulesInterfaces.php";
	require_once "$HOME/ModulesInterfaces/Tier4AuthenticationLayer/Tier4AuthenticationLayerModulesInterfaces.php";
	require_once "$HOME/ModulesInterfaces/Tier3ProtectionLayer/Tier3ProtectionLayerModulesInterfaces.php";
	require_once "$HOME/ModulesInterfaces/Tier2DataAccessLayer/Tier2DataAccessLayerModulesInterfaces.php";
	
	// Tiers Includes
	require_once "$HOME/Tier2-DataAccessLayer/ClassDataAccessLayer.php";
	require_once "$HOME/Tier3-ProtectionLayer/ClassProtectionLayer.php";
	require_once "$HOME/Tier4-AuthenticationLayer/ClassAuthenticationLayer.php";
	require_once "$HOME/Tier5-ValidationLayer/ClassValidationLayer.php";
	require_once "$HOME/Tier6-ContentLayer/ClassContentLayer.php";
	
	// Tier 2 Modules
	require_once "$HOME/Modules/Tier2DataAccessLayer/Core/MySqlConnect/ClassMySqlConnect.php";
	
	// Tier 3 Modules
	
	// Tier 4 Modules
	
	// Tier 5 Modules
	
	// Tier 6 Modules
	
	// Tier 2 Data Access Layer Settings
	require_once "$HOME/Configuration/Tier2DataAccessLayerSettings.php";
	
	// Tier 3 Protection Layer Settings
	require_once "$HOME/Configuration/Tier3ProtectionLayerSettings.php";
	
	// Tier 4 Authentication Layer Settings
	require_once "$HOME/Configuration/Tier4AuthenticationLayerSettings.php";
	
	// Tier 5 Validation Layer Settings
	require_once "$HOME/Configuration/Tier5ValidationLayerSettings.php";
	
	// Tier 6 Content Layer Settings
	require_once "$HOME/Configuration/Tier6ContentLayerDatabaseSettings.php";
	require_once "$HOME/Configuration/Tier6ContentLayerSettings.php";
	
?>