<?php
	// MySql Connect Allow and Deny Member Functions For Tier 3 Protection Layer
	$Tier3DatabaseAllow = Array();
	$Tier3DatabaseDeny = Array();
	
	// Must be allowed!
	$Tier3DatabaseAllow['MySqlConnect'] = 'MySqlConnect';
	
	// Setters and Getters
	$Tier3DatabaseAllow['setIdnumber'] = 'setIdnumber';
	$Tier3DatabaseAllow['getIdnumber'] = 'getIdnumber';
	$Tier3DatabaseAllow['setOrderbyname'] = 'setOrderbyname';
	$Tier3DatabaseAllow['getOrderbyname'] = 'getOrderbyname';
	$Tier3DatabaseAllow['setOrderbytype'] = 'setOrderbytype';
	$Tier3DatabaseAllow['getOrderbytype'] = 'getOrderbytype';
	$Tier3DatabaseAllow['setDatabasename'] = 'setDatabasename';
	$Tier3DatabaseAllow['getDatabasename'] = 'getDatabasename';
	$Tier3DatabaseAllow['setUser'] = 'setUser';
	$Tier3DatabaseAllow['getUser'] = 'getUser';
	$Tier3DatabaseAllow['setPassword'] = 'setPassword';
	$Tier3DatabaseAllow['getPassword'] = 'getPassword';
	$Tier3DatabaseAllow['setDatabasetable'] = 'setDatabasetable';
	$Tier3DatabaseAllow['getDatabasetable'] = 'getDatabasetable';
	$Tier3DatabaseAllow['setHostname'] = 'setHostname';
	$Tier3DatabaseAllow['getHostname'] = 'getHostname';
	$Tier3DatabaseAllow['getError'] = 'getError';
	$Tier3DatabaseAllow['getErrorArray'] = 'getErrorArray';
	$Tier3DatabaseAllow['setDatabaseAll'] = 'setDatabaseAll';
	$Tier3DatabaseAllow['setOrderByAll'] = 'setOrderByAll';
	
	// Connecting to database
	$Tier3DatabaseAllow['Connect'] = 'Connect';
	$Tier3DatabaseAllow['Disconnect'] = 'Disconnect';
	
	// Basic checks and verifies
	$Tier3DatabaseAllow['checkDatabaseName'] = 'checkDatabaseName';
	$Tier3DatabaseAllow['checkTableName'] = 'checkTableName';
	$Tier3DatabaseAllow['checkPermissions'] = 'checkPermissions';
	$Tier3DatabaseAllow['checkField'] = 'checkField';
	
	// Basic Setup of Database
	$Tier3DatabaseDeny['createDatabase'] = 'createDatabase';
	$Tier3DatabaseDeny['deleteDatabase'] = 'deleteDatabase';
	
	// Table Methods
	$Tier3DatabaseDeny['createTable'] = 'createTable';
	$Tier3DatabaseDeny['updateTable'] = 'updateTable';
	$Tier3DatabaseDeny['deleteTable'] = 'deleteTable';
	
	// Row Methods
	$Tier3DatabaseDeny['createRow'] = 'createRow';
	$Tier3DatabaseDeny['updateRow'] = 'updateRow';
	$Tier3DatabaseDeny['deleteRow'] = 'deleteRow';
	
	// Field Methods
	$Tier3DatabaseDeny['updateField'] = 'updateField';
	$Tier3DatabaseDeny['deleteField'] = 'deleteField';
	
	// Setting Database Row
	$Tier3DatabaseAllow['setDatabaseRow'] = 'setDatabaseRow';
	
	// Setting Database Fields
	$Tier3DatabaseAllow['setDatabaseField'] = 'setDatabaseField';
	
	// Entire Table Methods
	$Tier3DatabaseAllow['setEntireTable'] = 'setEntireTable';
	$Tier3DatabaseAllow['BuildingEntireTable'] = 'BuildingEntireTable';
	
	// Field Methods
	$Tier3DatabaseAllow['searchFieldNames'] = 'searchFieldNames';
	
	// Entire Table Methods
	$Tier3DatabaseAllow['searchEntireTable'] = 'searchEntireTable';
	$Tier3DatabaseAllow['removeEntryEntireTable'] = 'removeEntryEntireTable';
	$Tier3DatabaseAllow['removeEntireEntireTable'] = 'RemoveEntireEntireTable';
	$Tier3DatabaseAllow['reindexEntireTable'] = 'ReindexEntireTable';
	$Tier3DatabaseAllow['updateEntireTableEntry'] = 'updateEntireTableEntry';
	
	// Row Methods
	$Tier3DatabaseAllow['BuildDatabaseRows'] = 'BuildDatabaseRows';
	
	// Getters 
	$Tier3DatabaseAllow['getRowCount'] = 'getRowCount';
	$Tier3DatabaseAllow['getRowFieldName'] = 'getRowFieldName';
	$Tier3DatabaseAllow['getDatabase'] = 'getDatabase';
	$Tier3DatabaseAllow['getRowField'] = 'getRowField';
	$Tier3DatabaseAllow['getMultiRowField'] = 'getMultiRowField';
	$Tier3DatabaseAllow['getTable'] = 'getTable';
	$Tier3DatabaseAllow['getEntireTable'] = 'getEntireTable';
	$Tier3DatabaseAllow['getSearchResults'] = 'getSearchResults';
	$Tier3DatabaseAllow['getTableNames'] = 'getTableNames';
	
	// Basic Developer Diagnostics
	$Tier3DatabaseAllow['walkarray'] = 'walkarray';
	$Tier3DatabaseAllow['walkfieldname'] = 'walkfieldname';
	$Tier3DatabaseAllow['walktable'] = 'walktable';
	$Tier3DatabaseAllow['walkidsearch'] = 'walkidsearch';
	
?>