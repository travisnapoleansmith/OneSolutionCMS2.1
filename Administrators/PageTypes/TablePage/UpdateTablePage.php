<?php
	print_r($_POST);
	$TempTable = array();
	$Table = array();
	foreach ($_POST as $Key => $Value) {
		if ($Key !== 'AddTablePage') {
			if (strstr($Key, "Table")) {
				$TempTable[$Key] = $Value;
			}
		}
	}
	print_r($TempTable);
	
	foreach ($TempTable as $Key => $Value) {
		$NewKey = explode('_', $Key);
		$TableName = $NewKey[0];
		$SubKey = $NewKey[1];
		$Table[$TableName][$SubKey] = $Value;
	}
	
	print_r($Table);
?>