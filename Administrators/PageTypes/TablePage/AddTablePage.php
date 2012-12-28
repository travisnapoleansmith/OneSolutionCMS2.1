<?php
	$HOME = $_SERVER['SUBDOMAIN_DOCUMENT_ROOT'];
	$ADMINHOME = $HOME . '/Administrators/';
	$GLOBALS['HOME'] = $HOME;
	$GLOBALS['ADMINHOME'] = $ADMINHOME;

	require_once ("$ADMINHOME/Configuration/includes.php");
	
	$PageTitle = $_POST['PageTitle'];
	$Keywords = $_POST['Keywords'];
	$Description = $_POST['Description'];
	$Header = $_POST['Header'];
	
	
	$MenuName = $_POST['MenuName'];
	$MenuTitle = $_POST['MenuTitle'];
	$Priority = $_POST['Priority'];
	$Frequency = $_POST['Frequency'];
	$EnableDisable = $_POST['EnableDisable'];
	$Status = $_POST['Status'];
	
	$PageName = "../../index.php?PageID=";
	$PageName .= $_POST['AddTablePage'];
	
	$FileLocation = 'TEMPFILES/';
	
	foreach ($_COOKIE as $Key => $Value) {
		//print $Key . "\n";
		//print $Value . "\n";
		//print "-----------------\n";
		if (strstr($Key, "Table")) {
			setcookie($Key, $Value, time()-4800, '/');
		}
	}
	
	$TempTable = array();
	$Table = array();
	
	foreach ($_POST as $Key => $Value) {
		if ($Key !== 'AddTablePage') {
			if (strstr($Key, "Table")) {
				$TempTable[$Key] = $Value;
			}
		}
	}
	
	foreach ($TempTable as $Key => $Value) {
		setcookie($Key, $Value, time()+4800, '/');
		$NewKey = explode('_', $Key);
		$TableName = $NewKey[0];
		$SubKey = $NewKey[1];
		$Table[$TableName][$SubKey] = $Value;
	}
	
	$hold = $Tier6Databases->FormSubmitValidate('AddTablePage', $PageName, $FileLocation, $Table, 'Table');
	
	if ($hold) {
		
		print_r($_POST);
		
		print_r($TempTable);
		
		print_r($Table);
		
		print "I MADE IT\n";
	}
?>