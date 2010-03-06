<?php
	// MySql Database Tables
	$Tier5Databases = &new ValidationLayer();

	$Tier5Databases->createDatabaseTable('CalendarTable');
	$Tier5Databases->createDatabaseTable('CalendarTable2');
	$Tier5Databases->createDatabaseTable('CalendarAppointments');
	$Tier5Databases->createDatabaseTable('CalendarAppointments2');
	
	$Tier5Databases->createDatabaseTable('Content');
	$Tier5Databases->createDatabaseTable('ContentLayer');
	$Tier5Databases->createDatabaseTable('ContentLayerTheme');
	$Tier5Databases->createDatabaseTable('ContentLayerTables');
	$Tier5Databases->createDatabaseTable('ContentPrintPreview');
	
	$Tier5Databases->createDatabaseTable('Flash');
	$Tier5Databases->createDatabaseTable('List');
	
	$Tier5Databases->createDatabaseTable('MainMenu');
	$Tier5Databases->createDatabaseTable('MainMenuNew');
	$Tier5Databases->createDatabaseTable('MainMenuLookup');
	$Tier5Databases->createDatabaseTable('MainMenuLookupNew');
	$Tier5Databases->createDatabaseTable('MenuBottomPanel1');
	$Tier5Databases->createDatabaseTable('MenuBottomPanel2');
	$Tier5Databases->createDatabaseTable('MenuTopPanel2');
	
	$Tier5Databases->createDatabaseTable('NewsButtons');
	$Tier5Databases->createDatabaseTable('NewsMenuBottomPanel2');
	$Tier5Databases->createDatabaseTable('NewsMenuBottomPanel2YearMonth');
	$Tier5Databases->createDatabaseTable('NewsPageAttributes');
	$Tier5Databases->createDatabaseTable('NewsPageAttributesYearMonth');
	$Tier5Databases->createDatabaseTable('NewsStories');
	$Tier5Databases->createDatabaseTable('NewsStoriesFull');
	$Tier5Databases->createDatabaseTable('NewsStoriesFullYearMonth');
	
	$Tier5Databases->createDatabaseTable('PageAttributes');
	$Tier5Databases->createDatabaseTable('Picture');
	
	$Tier5Databases->createDatabaseTable('XhtmlCalendarTable');
	
	$Tier5Databases->createDatabaseTable('XMLFeeds');
	$Tier5Databases->createDatabaseTable('XMLNewsFeed');
	$Tier5Databases->createDatabaseTable('XMLNewsSitemap');
	$Tier5Databases->createDatabaseTable('XMLNewsYearMonthSitemap');
	$Tier5Databases->createDatabaseTable('XMLSitemap');
	
	$Tier5Databases->buildModules('Modules/Tier5ValidationLayer/');
	
?>