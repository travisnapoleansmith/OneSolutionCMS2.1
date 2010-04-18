<?php
	// MySql Database Tables
	$Tier6Databases = &new ContentLayer();
	
	$Tier6Databases->createDatabaseTable('AuthenticationLayerModules');
	$Tier6Databases->createDatabaseTable('AuthenticationLayerModulesSettings');
	$Tier6Databases->createDatabaseTable('AuthenticationLayerTables');
	
	$Tier6Databases->createDatabaseTable('CalendarTable');
	$Tier6Databases->createDatabaseTable('CalendarTable2');
	$Tier6Databases->createDatabaseTable('CalendarAppointments');
	$Tier6Databases->createDatabaseTable('CalendarAppointments2');
	
	$Tier6Databases->createDatabaseTable('Content');
	$Tier6Databases->createDatabaseTable('ContentLayer');
	$Tier6Databases->createDatabaseTable('ContentLayerModules');
	$Tier6Databases->createDatabaseTable('ContentLayerModulesSettings');
	$Tier6Databases->createDatabaseTable('ContentLayerTheme');
	$Tier6Databases->createDatabaseTable('ContentLayerTables');
	$Tier6Databases->createDatabaseTable('ContentPrintPreview');
	
	$Tier6Databases->createDatabaseTable('DataAccessLayerModules');
	$Tier6Databases->createDatabaseTable('DataAccessLayerModulesSettings');
	
	$Tier6Databases->createDatabaseTable('Flash');
	
	$Tier6Databases->createDatabaseTable('Form');
	$Tier6Databases->createDatabaseTable('FormButton');
	$Tier6Databases->createDatabaseTable('FormFieldSet');
	$Tier6Databases->createDatabaseTable('FormInput');
	$Tier6Databases->createDatabaseTable('FormLabel');
	$Tier6Databases->createDatabaseTable('FormLegend');
	$Tier6Databases->createDatabaseTable('FormOption');
	$Tier6Databases->createDatabaseTable('FormOptGroup');
	$Tier6Databases->createDatabaseTable('FormSelect');
	$Tier6Databases->createDatabaseTable('FormTableListing');
	$Tier6Databases->createDatabaseTable('FormTextArea');
	
	$Tier6Databases->createDatabaseTable('FormValidation');
	$Tier6Databases->createDatabaseTable('HtmlTags');
	
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
	
	$Tier6Databases->createDatabaseTable('ProtectionLayerModules');
	$Tier6Databases->createDatabaseTable('ProtectionLayerModulesSettings');
	$Tier6Databases->createDatabaseTable('ProtectionLayerTables');
	
	$Tier6Databases->createDatabaseTable('States');
	
	$Tier6Databases->createDatabaseTable('ValidationLayerModules');
	$Tier6Databases->createDatabaseTable('ValidationLayerModulesSettings');
	$Tier6Databases->createDatabaseTable('ValidationLayerTables');
	
	$Tier6Databases->createDatabaseTable('XhtmlCalendarTable');
	
	$Tier6Databases->createDatabaseTable('XMLFeeds');
	$Tier6Databases->createDatabaseTable('XMLNewsFeed');
	$Tier6Databases->createDatabaseTable('XMLNewsSitemap');
	$Tier6Databases->createDatabaseTable('XMLNewsYearMonthSitemap');
	$Tier6Databases->createDatabaseTable('XMLSitemap');
	
	$Tier6Databases->createDatabaseTable('Zipcodes');
	
	$Tier6Databases->setDatabaseAll ($credentaillogonarray[0], $credentaillogonarray[1], $credentaillogonarray[2], $credentaillogonarray[3], NULL);
	$Tier6Databases->buildModules('ContentLayerModules', 'ContentLayerTables');
	
?>