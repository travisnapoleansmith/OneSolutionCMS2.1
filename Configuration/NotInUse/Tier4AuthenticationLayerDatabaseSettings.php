<?php
	// MySql Database Tables
	$Tier4Databases = &new AuthenticationLayer();
	
	$Tier4Databases->createDatabaseTable('ContentLayer');
	
	$Tier4Databases->createDatabaseTable('CalendarAppointments');
	$Tier4Databases->createDatabaseTable('CalendarTable');
	
	$Tier4Databases->setDatabaseAll ($credentaillogonarray[0], $credentaillogonarray[1], $credentaillogonarray[2], $credentaillogonarray[3], NULL);
	$Tier4Databases->buildModules('AuthenticationLayerModules', 'AuthenticationLayerTables', 'AuthenticationLayerModulesSettings');
	
?>