<?php
	// MySql Connect Allow and Deny Member Functions For Tier 3 Protection Layer
	$DatabaseAllow = Array();
	$DatabaseDeny = Array();
	
	// Must be allowed!
	$DatabaseAllow['MySqlConnect'] = 'MySqlConnect';
	
	// Setters and Getters
	$DatabaseAllow['setIdnumber'] = 'setIdnumber';
	$DatabaseAllow['getIdnumber'] = 'getIdnumber';
	$DatabaseAllow['setOrderbyname'] = 'setOrderbyname';
	$DatabaseAllow['getOrderbyname'] = 'getOrderbyname';
	$DatabaseAllow['setOrderbytype'] = 'setOrderbytype';
	$DatabaseAllow['getOrderbytype'] = 'getOrderbytype';
	$DatabaseAllow['setDatabasename'] = 'setDatabasename';
	$DatabaseAllow['getDatabasename'] = 'getDatabasename';
	$DatabaseAllow['setUser'] = 'setUser';
	$DatabaseAllow['getUser'] = 'getUser';
	$DatabaseAllow['setPassword'] = 'setPassword';
	$DatabaseAllow['getPassword'] = 'getPassword';
	$DatabaseAllow['setDatabasetable'] = 'setDatabasetable';
	$DatabaseAllow['getDatabasetable'] = 'getDatabasetable';
	$DatabaseAllow['setHostname'] = 'setHostname';
	$DatabaseAllow['getHostname'] = 'getHostname';
	$DatabaseAllow['getError'] = 'getError';
	$DatabaseAllow['getErrorArray'] = 'getErrorArray';
	$DatabaseAllow['setDatabaseAll'] = 'setDatabaseAll';
	$DatabaseAllow['setOrderByAll'] = 'setOrderByAll';
	
	// Connecting to database
	$DatabaseAllow['Connect'] = 'Connect';
	$DatabaseAllow['Disconnect'] = 'Disconnect';
	
	// Basic checks and verifies
	$DatabaseAllow['checkDatabaseName'] = 'checkDatabaseName';
	$DatabaseAllow['checkTableName'] = 'checkTableName';
	$DatabaseAllow['checkPermissions'] = 'checkPermissions';
	$DatabaseAllow['checkField'] = 'checkField';
	
	// Basic Setup of Database
	$DatabaseDeny['createDatabase'] = 'createDatabase';
	$DatabaseDeny['deleteDatabase'] = 'deleteDatabase';
	
	// Table Methods
	$DatabaseDeny['createTable'] = 'createTable';
	$DatabaseDeny['updateTable'] = 'updateTable';
	$DatabaseDeny['deleteTable'] = 'deleteTable';
	
	// Row Methods
	$DatabaseDeny['createRow'] = 'createRow';
	$DatabaseDeny['deleteRow'] = 'deleteRow';
	
	// Field Methods
	$DatabaseDeny['updateField'] = 'updateField';
	$DatabaseDeny['deleteField'] = 'deleteField';
	
	// Setting Database Row
	$DatabaseAllow['setDatabaseRow'] = 'setDatabaseRow';
	
	// Setting Database Fields
	$DatabaseAllow['setDatabaseField'] = 'setDatabaseField';
	
	// Entire Table Methods
	$DatabaseAllow['setEntireTable'] = 'setEntireTable';
	$DatabaseAllow['BuildingEntireTable'] = 'BuildingEntireTable';
	
	// Field Methods
	$DatabaseAllow['searchFieldNames'] = 'searchFieldNames';
	
	// Entire Table Methods
	$DatabaseAllow['searchEntireTable'] = 'searchEntireTable';
	$DatabaseAllow['removeEntryEntireTable'] = 'removeEntryEntireTable';
	$DatabaseAllow['removeEntireEntireTable'] = 'RemoveEntireEntireTable';
	$DatabaseAllow['reindexEntireTable'] = 'ReindexEntireTable';
	$DatabaseAllow['updateEntireTableEntry'] = 'updateEntireTableEntry';
	
	// Row Methods
	$DatabaseAllow['BuildDatabaseRows'] = 'BuildDatabaseRows';
	
	// Getters 
	$DatabaseAllow['getRowCount'] = 'getRowCount';
	$DatabaseAllow['getRowFieldName'] = 'getRowFieldName';
	$DatabaseAllow['getDatabase'] = 'getDatabase';
	$DatabaseAllow['getRowField'] = 'getRowField';
	$DatabaseAllow['getTable'] = 'getTable';
	$DatabaseAllow['getSearchResults'] = 'getSearchResults';
	$DatabaseAllow['getTableNames'] = 'getTableNames';
	
	// Basic Developer Diagnostics
	$DatabaseAllow['walkarray'] = 'walkarray';
	$DatabaseAllow['walkfieldname'] = 'walkfieldname';
	$DatabaseAllow['walktable'] = 'walktable';
	$DatabaseAllow['walkidsearch'] = 'walkidsearch';
?>