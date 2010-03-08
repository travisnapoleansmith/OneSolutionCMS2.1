<?php
	// MySql Database Tables
	$Tier4Databases = &new AuthenticationLayer();
	
	$Tier4Databases->createDatabaseTable('AuthenticationLayerModules');
	$Tier4Databases->createDatabaseTable('AuthenticationLayerModulesSettings');
	$Tier4Databases->createDatabaseTable('AuthenticationLayerTables');
	
	$Tier4Databases->createDatabaseTable('CalendarTable');
	$Tier4Databases->createDatabaseTable('CalendarTable2');
	$Tier4Databases->createDatabaseTable('CalendarAppointments');
	$Tier4Databases->createDatabaseTable('CalendarAppointments2');
	
	$Tier4Databases->createDatabaseTable('Content');
	$Tier4Databases->createDatabaseTable('ContentLayer');
	$Tier4Databases->createDatabaseTable('ContentLayerModules');
	$Tier4Databases->createDatabaseTable('ContentLayerModulesSettings');
	$Tier4Databases->createDatabaseTable('ContentLayerTheme');
	$Tier4Databases->createDatabaseTable('ContentLayerTables');
	$Tier4Databases->createDatabaseTable('ContentPrintPreview');
	
	$Tier4Databases->createDatabaseTable('DataAccessLayerModules');
	$Tier4Databases->createDatabaseTable('DataAccessLayerModulesSettings');
	
	$Tier4Databases->createDatabaseTable('Flash');
	$Tier4Databases->createDatabaseTable('List');
	
	$Tier4Databases->createDatabaseTable('MainMenu');
	$Tier4Databases->createDatabaseTable('MainMenuNew');
	$Tier4Databases->createDatabaseTable('MainMenuLookup');
	$Tier4Databases->createDatabaseTable('MainMenuLookupNew');
	$Tier4Databases->createDatabaseTable('MenuBottomPanel1');
	$Tier4Databases->createDatabaseTable('MenuBottomPanel2');
	$Tier4Databases->createDatabaseTable('MenuTopPanel2');
	
	$Tier4Databases->createDatabaseTable('NewsButtons');
	$Tier4Databases->createDatabaseTable('NewsMenuBottomPanel2');
	$Tier4Databases->createDatabaseTable('NewsMenuBottomPanel2YearMonth');
	$Tier4Databases->createDatabaseTable('NewsPageAttributes');
	$Tier4Databases->createDatabaseTable('NewsPageAttributesYearMonth');
	$Tier4Databases->createDatabaseTable('NewsStories');
	$Tier4Databases->createDatabaseTable('NewsStoriesFull');
	$Tier4Databases->createDatabaseTable('NewsStoriesFullYearMonth');
	
	$Tier4Databases->createDatabaseTable('PageAttributes');
	$Tier4Databases->createDatabaseTable('Picture');
	
	$Tier4Databases->createDatabaseTable('ProtectionLayerModules');
	$Tier4Databases->createDatabaseTable('ProtectionLayerModulesSettings');
	$Tier4Databases->createDatabaseTable('ProtectionLayerTables');
	
	$Tier4Databases->createDatabaseTable('ValidationLayerModules');
	$Tier4Databases->createDatabaseTable('ValidationLayerModulesSettings');
	$Tier4Databases->createDatabaseTable('ValidationLayerTables');
	
	$Tier4Databases->createDatabaseTable('XhtmlCalendarTable');
	
	$Tier4Databases->createDatabaseTable('XMLFeeds');
	$Tier4Databases->createDatabaseTable('XMLNewsFeed');
	$Tier4Databases->createDatabaseTable('XMLNewsSitemap');
	$Tier4Databases->createDatabaseTable('XMLNewsYearMonthSitemap');
	$Tier4Databases->createDatabaseTable('XMLSitemap');
	
	$Tier4Databases->setDatabaseAll ($credentaillogonarray[0], $credentaillogonarray[1], $credentaillogonarray[2], $credentaillogonarray[3], NULL);
	$Tier4Databases->buildModules('AuthenticationLayerModules');
	
?>