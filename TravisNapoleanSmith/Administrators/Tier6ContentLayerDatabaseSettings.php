<?php
	// MySql Database Tables
	$Tier6Databases = &new ContentLayer();
	
	$Tier6Databases->createDatabaseTable('CalendarTable');
	$Tier6Databases->createDatabaseTable('CalendarTable2');
	$Tier6Databases->createDatabaseTable('CalendarAppointments');
	$Tier6Databases->createDatabaseTable('CalendarAppointments2');
	
	$Tier6Databases->createDatabaseTable('Content');
	$Tier6Databases->createDatabaseTable('ContentLayer');
	$Tier6Databases->createDatabaseTable('ContentLayerTables');
	$Tier6Databases->createDatabaseTable('ContentPrintPreview');
	
	$Tier6Databases->createDatabaseTable('Flash');
	$Tier6Databases->createDatabaseTable('List');
	
	$Tier6Databases->createDatabaseTable('MainMenu');
	$Tier6Databases->createDatabaseTable('MainMenuNew');
	$Tier6Databases->createDatabaseTable('MainMenuLookup');
	$Tier6Databases->createDatabaseTable('MainMenuLookupNew');
	$Tier6Databases->createDatabaseTable('MenuBottomPanel1');
	$Tier6Databases->createDatabaseTable('MenuBottomPanel2');
	$Tier6Databases->createDatabaseTable('MenuTopPanel2');
	
	$Tier6Databases->createDatabaseTable('NewsButtons');
	$Tier6Databases->createDatabaseTable('NewsMenuBottomPanel2');
	$Tier6Databases->createDatabaseTable('NewsMenuBottomPanel2YearMonth');
	$Tier6Databases->createDatabaseTable('NewsPageAttributes');
	$Tier6Databases->createDatabaseTable('NewsPageAttributesYearMonth');
	$Tier6Databases->createDatabaseTable('NewsStories');
	$Tier6Databases->createDatabaseTable('NewsStoriesFull');
	$Tier6Databases->createDatabaseTable('NewsStoriesFullYearMonth');
	
	$Tier6Databases->createDatabaseTable('PageAttributes');
	$Tier6Databases->createDatabaseTable('Picture');
	
	$Tier6Databases->createDatabaseTable('XhtmlCalendarTable');
	
	$Tier6Databases->createDatabaseTable('XMLFeeds');
	$Tier6Databases->createDatabaseTable('XMLNewsFeed');
	$Tier6Databases->createDatabaseTable('XMLNewsSitemap');
	$Tier6Databases->createDatabaseTable('XMLNewsYearMonthSitemap');
	$Tier6Databases->createDatabaseTable('XMLSitemap');
	
	$Tier6Databases->buildModules('../Modules/Tier6ContentLayer/', TRUE);
	
?>