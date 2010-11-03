<?php
	// MySql Database Tables
	$Tier2Databases = &new DataAccessLayer();
	
	$Tier2Databases->createDatabaseTable('ContentLayer');
	
	$Tier2Databases->createDatabaseTable('CalendarAppointments');
	$Tier2Databases->createDatabaseTable('CalendarTable');
	
	$Tier2Databases->setDatabaseAll ($credentaillogonarray[0], $credentaillogonarray[1], $credentaillogonarray[2], $credentaillogonarray[3], NULL);
	$Tier2Databases->buildModules('DataAccessLayerModules', 'DataAccessLayerTables', 'DataAccessLayerModulesSettings');
?>