<?php
	// MySql Connect Allow and Deny Member Functions For Tier 6 Content Layer
	$Tier6DatabaseAllow = Array();
	$Tier6DatabaseDeny = Array();
	
	// Must be allowed!
	$Tier6DatabaseAllow['MySqlConnect'] = 'MySqlConnect';
	
	// Setters and Getters
	$Tier6DatabaseAllow['setIdnumber'] = 'setIdnumber';
	$Tier6DatabaseAllow['getIdnumber'] = 'getIdnumber';
	$Tier6DatabaseAllow['setOrderbyname'] = 'setOrderbyname';
	$Tier6DatabaseAllow['getOrderbyname'] = 'getOrderbyname';
	$Tier6DatabaseAllow['setOrderbytype'] = 'setOrderbytype';
	$Tier6DatabaseAllow['getOrderbytype'] = 'getOrderbytype';
	$Tier6DatabaseAllow['setLimit'] = 'setLimit';
	$Tier6DatabaseAllow['getLimit'] = 'getLimit';
	$Tier6DatabaseAllow['setDatabasename'] = 'setDatabasename';
	$Tier6DatabaseAllow['getDatabasename'] = 'getDatabasename';
	$Tier6DatabaseAllow['setUser'] = 'setUser';
	$Tier6DatabaseAllow['getUser'] = 'getUser';
	$Tier6DatabaseAllow['setPassword'] = 'setPassword';
	$Tier6DatabaseAllow['getPassword'] = 'getPassword';
	$Tier6DatabaseAllow['setDatabasetable'] = 'setDatabasetable';
	$Tier6DatabaseAllow['getDatabasetable'] = 'getDatabasetable';
	$Tier6DatabaseAllow['setHostname'] = 'setHostname';
	$Tier6DatabaseAllow['getHostname'] = 'getHostname';
	$Tier6DatabaseAllow['getError'] = 'getError';
	$Tier6DatabaseAllow['getErrorArray'] = 'getErrorArray';
	$Tier6DatabaseAllow['setDatabaseAll'] = 'setDatabaseAll';
	$Tier6DatabaseAllow['setOrderByAll'] = 'setOrderByAll';
	
	// Connecting to database
	$Tier6DatabaseAllow['Connect'] = 'Connect';
	$Tier6DatabaseAllow['Disconnect'] = 'Disconnect';
	
	// Basic checks and verifies
	$Tier6DatabaseAllow['checkDatabaseName'] = 'checkDatabaseName';
	$Tier6DatabaseAllow['checkTableName'] = 'checkTableName';
	$Tier6DatabaseAllow['checkPermissions'] = 'checkPermissions';
	$Tier6DatabaseAllow['checkField'] = 'checkField';
	
	// Basic Setup of Database
	$Tier6DatabaseDeny['createDatabase'] = 'createDatabase';
	$Tier6DatabaseDeny['deleteDatabase'] = 'deleteDatabase';
	
	// Table Methods
	$Tier6DatabaseDeny['createTable'] = 'createTable';
	$Tier6DatabaseDeny['updateTable'] = 'updateTable';
	$Tier6DatabaseDeny['deleteTable'] = 'deleteTable';
	
	// Row Methods
	$Tier6DatabaseDeny['createRow'] = 'createRow';
	$Tier6DatabaseDeny['updateRow'] = 'updateRow';
	$Tier6DatabaseDeny['deleteRow'] = 'deleteRow';
	
	// Field Methods
	$Tier6DatabaseDeny['createField'] = 'createField';
	$Tier6DatabaseDeny['updateField'] = 'updateField';
	$Tier6DatabaseDeny['deleteField'] = 'deleteField';
	
	// General SQL Command
	$Tier6DatabaseAllow['executeSQlCommand'] = 'executeSQlCommand';
	
	// Empty Table Methods
	$Tier6DatabaseAllow['emptyTable'] = 'emptyTable';
	
	// Setting Database Row
	$Tier6DatabaseAllow['setDatabaseRow'] = 'setDatabaseRow';
	
	// Setting Database Fields
	$Tier6DatabaseAllow['setDatabaseField'] = 'setDatabaseField';
	
	// Entire Table Methods
	$Tier6DatabaseAllow['setEntireTable'] = 'setEntireTable';
	$Tier6DatabaseAllow['BuildingEntireTable'] = 'BuildingEntireTable';
	
	// Field Methods
	$Tier6DatabaseAllow['searchFieldNames'] = 'searchFieldNames';
	$Tier6DatabaseAllow['BuildFieldNames'] = 'BuildFieldNames';
	
	// Entire Table Methods
	$Tier6DatabaseAllow['searchEntireTable'] = 'searchEntireTable';
	$Tier6DatabaseAllow['removeEntryEntireTable'] = 'removeEntryEntireTable';
	$Tier6DatabaseAllow['removeEntireEntireTable'] = 'RemoveEntireEntireTable';
	$Tier6DatabaseAllow['reindexEntireTable'] = 'ReindexEntireTable';
	$Tier6DatabaseAllow['updateEntireTableEntry'] = 'updateEntireTableEntry';
	
	// Row Methods
	$Tier6DatabaseAllow['BuildDatabaseRows'] = 'BuildDatabaseRows';
	
	// Getters 
	$Tier6DatabaseAllow['getRowCount'] = 'getRowCount';
	$Tier6DatabaseAllow['getRowFieldName'] = 'getRowFieldName';
	$Tier6DatabaseAllow['getRowFieldNames'] = 'getRowFieldNames';
	$Tier6DatabaseAllow['getDatabase'] = 'getDatabase';
	$Tier6DatabaseAllow['getRowField'] = 'getRowField';
	$Tier6DatabaseAllow['getMultiRowField'] = 'getMultiRowField';
	$Tier6DatabaseAllow['getTable'] = 'getTable';
	$Tier6DatabaseAllow['getEntireTable'] = 'getEntireTable';
	$Tier6DatabaseAllow['getSearchResults'] = 'getSearchResults';
	$Tier6DatabaseAllow['getTableNames'] = 'getTableNames';
	
	// Basic Developer Diagnostics
	$Tier6DatabaseAllow['walkarray'] = 'walkarray';
	$Tier6DatabaseAllow['walkfieldname'] = 'walkfieldname';
	$Tier6DatabaseAllow['walktable'] = 'walktable';
	$Tier6DatabaseAllow['walkidsearch'] = 'walkidsearch';
?>