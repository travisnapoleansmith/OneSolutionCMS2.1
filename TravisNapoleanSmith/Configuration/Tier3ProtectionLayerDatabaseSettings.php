<?php
	// MySql Database Tables
	$Databases = &new ProtectionLayer();
	$Databases->createDatabaseTable('Content');
	$Databases->createDatabaseTable('ContentLayer');
	$Databases->createDatabaseTable('ContentLayerTables');
	$Databases->createDatabaseTable('ContentPrintPreview');
	
	$Databases->createDatabaseTable('Flash');
	$Databases->createDatabaseTable('List');
	
	$Databases->createDatabaseTable('MainMenu');
	$Databases->createDatabaseTable('MainMenuLookup');
	$Databases->createDatabaseTable('MenuBottomPanel1');
	$Databases->createDatabaseTable('MenuBottomPanel2');
	$Databases->createDatabaseTable('MenuTopPanel2');
	
	$Databases->createDatabaseTable('NewsButtons');
	$Databases->createDatabaseTable('NewsMenuBottomPanel2');
	$Databases->createDatabaseTable('NewsMenuBottomPanel2YearMonth');
	$Databases->createDatabaseTable('NewsPageAttributes');
	$Databases->createDatabaseTable('NewsPageAttributesYearMonth');
	$Databases->createDatabaseTable('NewsStories');
	$Databases->createDatabaseTable('NewsStoriesFull');
	$Databases->createDatabaseTable('NewsStoriesFullYearMonth');
	
	$Databases->createDatabaseTable('PageAttributes');
	$Databases->createDatabaseTable('Picture');
	
	$Databases->createDatabaseTable('XMLFeeds');
	$Databases->createDatabaseTable('XMLNewsFeed');
	$Databases->createDatabaseTable('XMLSitemap');
	
?>