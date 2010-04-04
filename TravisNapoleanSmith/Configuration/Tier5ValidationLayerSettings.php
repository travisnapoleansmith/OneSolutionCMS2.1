<?php
	// MySql Connect Allow and Deny Member Functions For Tier 5 Validation Layer
	$Tier5DatabaseAllow = Array();
	$Tier5DatabaseDeny = Array();
	
	// Must be allowed!
	$Tier5DatabaseAllow['MySqlConnect'] = 'MySqlConnect';
	
	// Setters and Getters
	$Tier5DatabaseAllow['setIdnumber'] = 'setIdnumber';
	$Tier5DatabaseAllow['getIdnumber'] = 'getIdnumber';
	$Tier5DatabaseAllow['setOrderbyname'] = 'setOrderbyname';
	$Tier5DatabaseAllow['getOrderbyname'] = 'getOrderbyname';
	$Tier5DatabaseAllow['setOrderbytype'] = 'setOrderbytype';
	$Tier5DatabaseAllow['getOrderbytype'] = 'getOrderbytype';
	$Tier5DatabaseAllow['setDatabasename'] = 'setDatabasename';
	$Tier5DatabaseAllow['getDatabasename'] = 'getDatabasename';
	$Tier5DatabaseAllow['setUser'] = 'setUser';
	$Tier5DatabaseAllow['getUser'] = 'getUser';
	$Tier5DatabaseAllow['setPassword'] = 'setPassword';
	$Tier5DatabaseAllow['getPassword'] = 'getPassword';
	$Tier5DatabaseAllow['setDatabasetable'] = 'setDatabasetable';
	$Tier5DatabaseAllow['getDatabasetable'] = 'getDatabasetable';
	$Tier5DatabaseAllow['setHostname'] = 'setHostname';
	$Tier5DatabaseAllow['getHostname'] = 'getHostname';
	$Tier5DatabaseAllow['getError'] = 'getError';
	$Tier5DatabaseAllow['getErrorArray'] = 'getErrorArray';
	$Tier5DatabaseAllow['setDatabaseAll'] = 'setDatabaseAll';
	$Tier5DatabaseAllow['setOrderByAll'] = 'setOrderByAll';
	
	// Connecting to database
	$Tier5DatabaseAllow['Connect'] = 'Connect';
	$Tier5DatabaseAllow['Disconnect'] = 'Disconnect';
	
	// Basic checks and verifies
	$Tier5DatabaseDeny['checkDatabaseName'] = 'checkDatabaseName';
	$Tier5DatabaseDeny['checkTableName'] = 'checkTableName';
	$Tier5DatabaseDeny['checkPermissions'] = 'checkPermissions';
	$Tier5DatabaseDeny['checkField'] = 'checkField';
	
	// Basic Setup of Database
	$Tier5DatabaseDeny['createDatabase'] = 'createDatabase';
	$Tier5DatabaseDeny['deleteDatabase'] = 'deleteDatabase';
	
	// Table Methods
	$Tier5DatabaseDeny['createTable'] = 'createTable';
	$Tier5DatabaseDeny['updateTable'] = 'updateTable';
	$Tier5DatabaseDeny['deleteTable'] = 'deleteTable';
	
	// Row Methods
	$Tier5DatabaseDeny['createRow'] = 'createRow';
	$Tier5DatabaseDeny['deleteRow'] = 'deleteRow';
	
	// Field Methods
	$Tier5DatabaseDeny['updateField'] = 'updateField';
	$Tier5DatabaseDeny['deleteField'] = 'deleteField';
	
	// Setting Database Row
	$Tier5DatabaseAllow['setDatabaseRow'] = 'setDatabaseRow';
	
	// Setting Database Fields
	$Tier5DatabaseAllow['setDatabaseField'] = 'setDatabaseField';
	
	// Entire Table Methods
	$Tier5DatabaseAllow['setEntireTable'] = 'setEntireTable';
	$Tier5DatabaseAllow['BuildingEntireTable'] = 'BuildingEntireTable';
	
	// Field Methods
	$Tier5DatabaseAllow['searchFieldNames'] = 'searchFieldNames';
	
	// Entire Table Methods
	$Tier5DatabaseAllow['searchEntireTable'] = 'searchEntireTable';
	$Tier5DatabaseAllow['removeEntryEntireTable'] = 'removeEntryEntireTable';
	$Tier5DatabaseAllow['removeEntireEntireTable'] = 'RemoveEntireEntireTable';
	$Tier5DatabaseAllow['reindexEntireTable'] = 'ReindexEntireTable';
	$Tier5DatabaseAllow['updateEntireTableEntry'] = 'updateEntireTableEntry';
	
	// Row Methods
	$Tier5DatabaseAllow['BuildDatabaseRows'] = 'BuildDatabaseRows';
	
	// Getters 
	$Tier5DatabaseAllow['getRowCount'] = 'getRowCount';
	$Tier5DatabaseAllow['getRowFieldName'] = 'getRowFieldName';
	$Tier5DatabaseAllow['getDatabase'] = 'getDatabase';
	$Tier5DatabaseAllow['getRowField'] = 'getRowField';
	$Tier5DatabaseAllow['getMultiRowField'] = 'getMultiRowField';
	$Tier5DatabaseAllow['getTable'] = 'getTable';
	$Tier5DatabaseAllow['getEntireTable'] = 'getEntireTable';
	$Tier5DatabaseAllow['getSearchResults'] = 'getSearchResults';
	$Tier5DatabaseAllow['getTableNames'] = 'getTableNames';
	
	// Basic Developer Diagnostics
	$Tier5DatabaseAllow['walkarray'] = 'walkarray';
	$Tier5DatabaseAllow['walkfieldname'] = 'walkfieldname';
	$Tier5DatabaseAllow['walktable'] = 'walktable';
	$Tier5DatabaseAllow['walkidsearch'] = 'walkidsearch';
?>