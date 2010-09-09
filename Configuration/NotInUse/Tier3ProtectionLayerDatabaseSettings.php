<?php
	// MySql Database Tables
	$Tier3Databases = &new ProtectionLayer();
	
	$Tier3Databases->createDatabaseTable('ContentLayer');
	
	$Tier3Databases->setDatabaseAll ($credentaillogonarray[0], $credentaillogonarray[1], $credentaillogonarray[2], $credentaillogonarray[3], NULL);
	$Tier3Databases->buildModules('ProtectionLayerModules', 'ProtectionLayerTables', 'ProtectionLayerModulesSettings');
	
?>