<?php
	// MySql Database Tables
	$Tier5Databases = &new ValidationLayer();
	
	$Tier5Databases->createDatabaseTable('ContentLayer');
	
	$Tier5Databases->createDatabaseTable('CalendarAppointments');
	$Tier5Databases->createDatabaseTable('CalendarTable');
	
	$Tier5Databases->setDatabaseAll ($credentaillogonarray[0], $credentaillogonarray[1], $credentaillogonarray[2], $credentaillogonarray[3], NULL);
	$Tier5Databases->buildModules('ValidationLayerModules', 'ValidationLayerTables', 'ValidationLayerModulesSettings');
	
?>