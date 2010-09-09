<?php
	// MySql Database Tables
	$Tier6Databases = &new ContentLayer();
	
	$Tier6Databases->createDatabaseTable('AdministratorContentLayer');
	$Tier6Databases->createDatabaseTable('AdministratorContentLayerVersion');
	
	$Tier6Databases->createDatabaseTable('CalendarAppointments');
	$Tier6Databases->createDatabaseTable('CalendarTable');
	
	$Tier6Databases->setDatabaseAll ($credentaillogonarray[0], $credentaillogonarray[1], $credentaillogonarray[2], $credentaillogonarray[3], NULL);
	$Tier6Databases->buildModules('AdministratorContentLayerModules', 'AdministratorContentLayerTables', 'AdministratorContentLayerModulesSettings');
	$Tier6Databases->setVersionTable('AdministratorContentLayerVersion');
	
?>