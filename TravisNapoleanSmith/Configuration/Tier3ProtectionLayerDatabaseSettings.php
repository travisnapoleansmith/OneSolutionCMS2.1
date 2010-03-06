<?php
	// MySql Database Tables
	$Tier3Databases = &new ProtectionLayer();
	
	$Tier3Databases->createDatabaseTable('CalendarTable');
	$Tier3Databases->createDatabaseTable('CalendarTable2');
	$Tier3Databases->createDatabaseTable('CalendarAppointments');
	$Tier3Databases->createDatabaseTable('CalendarAppointments2');
	
	$Tier3Databases->createDatabaseTable('Content');
	$Tier3Databases->createDatabaseTable('ContentLayer');
	$Tier3Databases->createDatabaseTable('ContentLayerTheme');
	$Tier3Databases->createDatabaseTable('ContentLayerTables');
	$Tier3Databases->createDatabaseTable('ContentPrintPreview');
	
	$Tier3Databases->createDatabaseTable('Flash');
	$Tier3Databases->createDatabaseTable('List');
	
	$Tier3Databases->createDatabaseTable('MainMenu');
	$Tier3Databases->createDatabaseTable('MainMenuNew');
	$Tier3Databases->createDatabaseTable('MainMenuLookup');
	$Tier3Databases->createDatabaseTable('MainMenuLookupNew');
	$Tier3Databases->createDatabaseTable('MenuBottomPanel1');
	$Tier3Databases->createDatabaseTable('MenuBottomPanel2');
	$Tier3Databases->createDatabaseTable('MenuTopPanel2');
	
	$Tier3Databases->createDatabaseTable('NewsButtons');
	$Tier3Databases->createDatabaseTable('NewsMenuBottomPanel2');
	$Tier3Databases->createDatabaseTable('NewsMenuBottomPanel2YearMonth');
	$Tier3Databases->createDatabaseTable('NewsPageAttributes');
	$Tier3Databases->createDatabaseTable('NewsPageAttributesYearMonth');
	$Tier3Databases->createDatabaseTable('NewsStories');
	$Tier3Databases->createDatabaseTable('NewsStoriesFull');
	$Tier3Databases->createDatabaseTable('NewsStoriesFullYearMonth');
	
	$Tier3Databases->createDatabaseTable('PageAttributes');
	$Tier3Databases->createDatabaseTable('Picture');
	
	$Tier3Databases->createDatabaseTable('XhtmlCalendarTable');
	
	$Tier3Databases->createDatabaseTable('XMLFeeds');
	$Tier3Databases->createDatabaseTable('XMLNewsFeed');
	$Tier3Databases->createDatabaseTable('XMLNewsSitemap');
	$Tier3Databases->createDatabaseTable('XMLNewsYearMonthSitemap');
	$Tier3Databases->createDatabaseTable('XMLSitemap');
	
	$Tier3Databases->buildModules('Modules/Tier3ProtectionLayer/');
	
?>