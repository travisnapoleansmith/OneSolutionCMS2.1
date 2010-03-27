<?php
	// MySql Database Tables
	$Tier2Databases = &new DataAccessLayer();
	
	$Tier2Databases->createDatabaseTable('AuthenticationLayerModules');
	$Tier2Databases->createDatabaseTable('AuthenticationLayerModulesSettings');
	$Tier2Databases->createDatabaseTable('AuthenticationLayerTables');
	
	$Tier2Databases->createDatabaseTable('CalendarTable');
	$Tier2Databases->createDatabaseTable('CalendarTable2');
	$Tier2Databases->createDatabaseTable('CalendarAppointments');
	$Tier2Databases->createDatabaseTable('CalendarAppointments2');
	
	$Tier2Databases->createDatabaseTable('Content');
	$Tier2Databases->createDatabaseTable('ContentLayer');
	$Tier2Databases->createDatabaseTable('ContentLayerModules');
	$Tier2Databases->createDatabaseTable('ContentLayerModulesSettings');
	$Tier2Databases->createDatabaseTable('ContentLayerTheme');
	$Tier2Databases->createDatabaseTable('ContentLayerTables');
	$Tier2Databases->createDatabaseTable('ContentPrintPreview');
	
	$Tier2Databases->createDatabaseTable('DataAccessLayerModules');
	$Tier2Databases->createDatabaseTable('DataAccessLayerModulesSettings');
	
	$Tier2Databases->createDatabaseTable('Flash');
	
	$Tier2Databases->createDatabaseTable('Form');
	$Tier2Databases->createDatabaseTable('FormButton');
	$Tier2Databases->createDatabaseTable('FormFieldSet');
	$Tier2Databases->createDatabaseTable('FormInput');
	$Tier2Databases->createDatabaseTable('FormLabel');
	$Tier2Databases->createDatabaseTable('FormLegend');
	$Tier2Databases->createDatabaseTable('FormOption');
	$Tier2Databases->createDatabaseTable('FormOptGroup');
	$Tier2Databases->createDatabaseTable('FormSelect');
	$Tier2Databases->createDatabaseTable('FormTableListing');
	$Tier2Databases->createDatabaseTable('FormTextArea');
	
	$Tier2Databases->createDatabaseTable('List');
	
	$Tier2Databases->createDatabaseTable('MainMenu');
	$Tier2Databases->createDatabaseTable('MainMenuNew');
	$Tier2Databases->createDatabaseTable('MainMenuLookup');
	$Tier2Databases->createDatabaseTable('MainMenuLookupNew');
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
	
	$Tier2Databases->createDatabaseTable('ProtectionLayerModules');
	$Tier2Databases->createDatabaseTable('ProtectionLayerModulesSettings');
	$Tier2Databases->createDatabaseTable('ProtectionLayerTables');
	
	$Tier2Databases->createDatabaseTable('ValidationLayerModules');
	$Tier2Databases->createDatabaseTable('ValidationLayerModulesSettings');
	$Tier2Databases->createDatabaseTable('ValidationLayerTables');
	
	$Tier2Databases->createDatabaseTable('XhtmlCalendarTable');
	
	$Tier2Databases->createDatabaseTable('XMLFeeds');
	$Tier2Databases->createDatabaseTable('XMLNewsFeed');
	$Tier2Databases->createDatabaseTable('XMLNewsSitemap');
	$Tier2Databases->createDatabaseTable('XMLNewsYearMonthSitemap');
	$Tier2Databases->createDatabaseTable('XMLSitemap');
	
	//$Tier2Databases->setDatabaseAll ($credentaillogonarray[0], $credentaillogonarray[1], $credentaillogonarray[2], $credentaillogonarray[3], NULL);
	//$Tier2Databases->buildModules('DataAccessLayerModules', 'DataAccessLayerTables');
	//print_r($Tier2Databases);
?>