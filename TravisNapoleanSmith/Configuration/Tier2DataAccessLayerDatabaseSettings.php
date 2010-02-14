<?php
	// MySql Database Tables
	$Tier2Databases = &new DataAccessLayer();
	
	$Tier2Databases->createDatabaseTable('CalendarTable');
	$Tier2Databases->createDatabaseTable('CalendarTable2');
	$Tier2Databases->createDatabaseTable('CalendarAppointments');
	$Tier2Databases->createDatabaseTable('CalendarAppointments2');
	
	$Tier2Databases->createDatabaseTable('Content');
	$Tier2Databases->createDatabaseTable('ContentLayer');
	$Tier2Databases->createDatabaseTable('ContentLayerTables');
	$Tier2Databases->createDatabaseTable('ContentPrintPreview');
	
	$Tier2Databases->createDatabaseTable('Flash');
	$Tier2Databases->createDatabaseTable('List');
	
	$Tier2Databases->createDatabaseTable('MainMenu');
	$Tier2Databases->createDatabaseTable('MainMenuLookup');
	$Tier2Databases->createDatabaseTable('MenuBottomPanel1');
	$Tier2Databases->createDatabaseTable('MenuBottomPanel2');
	$Tier2Databases->createDatabaseTable('MenuTopPanel2');
	
	$Tier2Databases->createDatabaseTable('NewsButtons');
	$Tier2Databases->createDatabaseTable('NewsMenuBottomPanel2');
	$Tier2Databases->createDatabaseTable('NewsMenuBottomPanel2YearMonth');
	$Tier2Databases->createDatabaseTable('NewsPageAttributes');
	$Tier2Databases->createDatabaseTable('NewsPageAttributesYearMonth');
	$Tier2Databases->createDatabaseTable('NewsStories');
	$Tier2Databases->createDatabaseTable('NewsStoriesFull');
	$Tier2Databases->createDatabaseTable('NewsStoriesFullYearMonth');
	
	$Tier2Databases->createDatabaseTable('PageAttributes');
	$Tier2Databases->createDatabaseTable('Picture');
	
	$Tier2Databases->createDatabaseTable('XhtmlCalendarTable');
	
	$Tier2Databases->createDatabaseTable('XMLFeeds');
	$Tier2Databases->createDatabaseTable('XMLNewsFeed');
	$Tier2Databases->createDatabaseTable('XMLSitemap');
	
	$Tier2Databases->buildModules('Modules/Tier2DataAccessLayer/');
	//print_r($Tier2Databases);
?>