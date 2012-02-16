<?php
	require_once ('Configuration/includes.php');
	$databasefilename ='../SQLTables/Update/UpdateTableFiles.txt';
	$systemfilename ='../SQLTables/Update/UpdateSystemFiles.txt';
	
	print "UPDATE DATABASE\n";
	
	$Tier6Databases->upgradeSystem($databasefilename, $systemfilename);
	// NEED TO MAKE UPGRADESYSTEM UPDATE THE SYSTEM FILES AND THE DATABASE
?>