<?php
	require_once ("Tier3-ProtectionLayer/ClassProtectionLayer.php");
	
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
	$Databases->createDatabaseTable('NewsStories');
	$Databases->createDatabaseTable('PageAttributes');
	$Databases->createDatabaseTable('Picture');
	
?>