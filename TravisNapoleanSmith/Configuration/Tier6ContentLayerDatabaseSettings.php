<?php
	// MySql Database Tables
	$Tier6Databases = &new ContentLayer();
	
	$Tier6Databases->createDatabaseTable('ContentLayer');
	
	$Tier6Databases->setDatabaseAll ($credentaillogonarray[0], $credentaillogonarray[1], $credentaillogonarray[2], $credentaillogonarray[3], NULL);
	$Tier6Databases->buildModules('ContentLayerModules', 'ContentLayerTables', 'ContentLayerModulesSettings');
	
?>