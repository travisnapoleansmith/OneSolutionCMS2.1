<?php
	// MySql Connect Allow and Deny Member Functions For Tier 2 Data Access Layer
	$Tier2DatabaseAllow = Array();
	$Tier2DatabaseDeny = Array();
	
	// Must be allowed!
	$Tier2DatabaseAllow['MySqlConnect'] = 'MySqlConnect';
	
	// Setters and Getters
	$Tier2DatabaseAllow['setIdnumber'] = 'setIdnumber';
	$Tier2DatabaseAllow['getIdnumber'] = 'getIdnumber';
	$Tier2DatabaseAllow['setOrderbyname'] = 'setOrderbyname';
	$Tier2DatabaseAllow['getOrderbyname'] = 'getOrderbyname';
	$Tier2DatabaseAllow['setOrderbytype'] = 'setOrderbytype';
	$Tier2DatabaseAllow['getOrderbytype'] = 'getOrderbytype';
	$Tier2DatabaseAllow['setLimit'] = 'setLimit';
	$Tier2DatabaseAllow['getLimit'] = 'getLimit';
	$Tier2DatabaseAllow['setDatabasename'] = 'setDatabasename';
	$Tier2DatabaseAllow['getDatabasename'] = 'getDatabasename';
	$Tier2DatabaseAllow['setUser'] = 'setUser';
	$Tier2DatabaseAllow['getUser'] = 'getUser';
	$Tier2DatabaseAllow['setPassword'] = 'setPassword';
	$Tier2DatabaseAllow['getPassword'] = 'getPassword';
	$Tier2DatabaseAllow['setDatabasetable'] = 'setDatabasetable';
	$Tier2DatabaseAllow['getDatabasetable'] = 'getDatabasetable';
	$Tier2DatabaseAllow['setHostname'] = 'setHostname';
	$Tier2DatabaseAllow['getHostname'] = 'getHostname';
	$Tier2DatabaseAllow['getError'] = 'getError';
	$Tier2DatabaseAllow['getErrorArray'] = 'getErrorArray';
	$Tier2DatabaseAllow['setDatabaseAll'] = 'setDatabaseAll';
	$Tier2DatabaseAllow['setOrderByAll'] = 'setOrderByAll';
	
	// Connecting to database
	$Tier2DatabaseAllow['Connect'] = 'Connect';
	$Tier2DatabaseAllow['Disconnect'] = 'Disconnect';
	
	// Basic checks and verifies
	$Tier2DatabaseAllow['checkDatabaseName'] = 'checkDatabaseName';
	$Tier2DatabaseAllow['checkTableName'] = 'checkTableName';
	$Tier2DatabaseAllow['checkPermissions'] = 'checkPermissions';
	$Tier2DatabaseAllow['checkField'] = 'checkField';
	
	// Basic Setup of Database
	$Tier2DatabaseDeny['createDatabase'] = 'createDatabase';
	$Tier2DatabaseDeny['deleteDatabase'] = 'deleteDatabase';
	
	// Table Methods
	$Tier2DatabaseDeny['createTable'] = 'createTable';
	$Tier2DatabaseDeny['updateTable'] = 'updateTable';
	$Tier2DatabaseDeny['deleteTable'] = 'deleteTable';
	
	// Row Methods
	$Tier2DatabaseDeny['createRow'] = 'createRow';
	$Tier2DatabaseDeny['updateRow'] = 'updateRow';
	$Tier2DatabaseDeny['deleteRow'] = 'deleteRow';
	
	// Field Methods
	$Tier2DatabaseDeny['createField'] = 'createField';
	$Tier2DatabaseDeny['updateField'] = 'updateField';
	$Tier2DatabaseDeny['deleteField'] = 'deleteField';
	
	// Maintenance Methods
	$Tier2DatabaseDeny['sortTable'] = 'sortTable';
	
	// Setting Database Row
	$Tier2DatabaseAllow['setDatabaseRow'] = 'setDatabaseRow';
	
	// Setting Database Fields
	$Tier2DatabaseAllow['setDatabaseField'] = 'setDatabaseField';
	
	// Entire Table Methods
	$Tier2DatabaseAllow['setEntireTable'] = 'setEntireTable';
	$Tier2DatabaseAllow['BuildingEntireTable'] = 'BuildingEntireTable';
	
	// Field Methods
	$Tier2DatabaseAllow['searchFieldNames'] = 'searchFieldNames';
	$Tier2DatabaseAllow['BuildFieldNames'] = 'BuildFieldNames';
	
	// Entire Table Methods
	$Tier2DatabaseAllow['searchEntireTable'] = 'searchEntireTable';
	$Tier2DatabaseAllow['removeEntryEntireTable'] = 'removeEntryEntireTable';
	$Tier2DatabaseAllow['removeEntireEntireTable'] = 'RemoveEntireEntireTable';
	$Tier2DatabaseAllow['reindexEntireTable'] = 'ReindexEntireTable';
	$Tier2DatabaseAllow['updateEntireTableEntry'] = 'updateEntireTableEntry';
	
	// Row Methods
	$Tier2DatabaseAllow['BuildDatabaseRows'] = 'BuildDatabaseRows';
	
	// Getters 
	$Tier2DatabaseAllow['getRowCount'] = 'getRowCount';
	$Tier2DatabaseAllow['getRowFieldName'] = 'getRowFieldName';
	$Tier2DatabaseAllow['getRowFieldNames'] = 'getRowFieldNames';
	$Tier2DatabaseAllow['getDatabase'] = 'getDatabase';
	$Tier2DatabaseAllow['getRowField'] = 'getRowField';
	$Tier2DatabaseAllow['getMultiRowField'] = 'getMultiRowField';
	$Tier2DatabaseAllow['getTable'] = 'getTable';
	$Tier2DatabaseAllow['getEntireTable'] = 'getEntireTable';
	$Tier2DatabaseAllow['getSearchResults'] = 'getSearchResults';
	$Tier2DatabaseAllow['getTableNames'] = 'getTableNames';
	
	// Basic Developer Diagnostics
	$Tier2DatabaseAllow['walkarray'] = 'walkarray';
	$Tier2DatabaseAllow['walkfieldname'] = 'walkfieldname';
	$Tier2DatabaseAllow['walktable'] = 'walktable';
	$Tier2DatabaseAllow['walkidsearch'] = 'walkidsearch';
?>