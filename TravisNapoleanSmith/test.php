<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html lang="en-US" xml:lang="en-US" xmlns="http://www.w3.org/1999/xhtml">

<head>
 <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"/>
 <title>PHP Test</title>

</head>

<body>



<?
	// Includes all files
	require_once ('Configuration/includes.php');
	
	//$credentaillogonarray = Array ('mysql', 'yroot', 'gmt461z020414', 'Test');
	//$credentaillogonarray = Array ('mysql', 'yroot', 'gmt461z020414', 'TravisNapoleanSmithVersion2');
	//$testdatabase = new MySqlConnect();
	//$testdatabase->setDatabaseAll ($credentaillogonarray[0], $credentaillogonarray[1], $credentaillogonarray[2], $credentaillogonarray[3], 'Demo');
	//$testdatabase->setDatabaseAll ($credentaillogonarray[0], $credentaillogonarray[1], $credentaillogonarray[2], $credentaillogonarray[3], 'Flash');
	//$testdatabase->checkTableName();
	//$tablenames = $testdatabase->getTableNames();
	//print_r($tablenames);
	//$testdatabase->createDatabase();
	//$testdatabase->deleteDatabase();
	//$tablestring = 'id INT NOT NULL AUTO_INCREMENT PRIMARY KEY, joketext TEXT, jokedate DATE NOT NULL';
	//$testdatabase->createTable($tablestring);
	//$testdatabase->deleteTable();
	/*
	$rowname[0] = 'id';
	$rowname[1] = 'joketext';
	$rowname[2] = 'jokedate';
	$rowvalue[0] = '1';
	$rowvalue[1] = 'THIS IS A TEST';
	$rowvalue[2] = '0000-00-00';
	$testdatabase->createRow ($rowname, $rowvalue);
	
	$rowname[0] = 'id';
	$rowname[1] = 'joketext';
	$rowname[2] = 'jokedate';
	$rowvalue[0] = '2';
	$rowvalue[1] = 'THIS IS Another TEST';
	$rowvalue[2] = '0000-00-00';
	$testdatabase->createRow ($rowname, $rowvalue);
	*/
	//$testdatabase->deleterow ('id', '1');
	//$testdatabase->deleterow (NULL, NULL);
	/*
	$rowname[0] = 'joketext';
	$rowvalue[0] = 'HELLO WORLD';
	$rownumbername[0] = 'id';
	$rownumber[0] = 1;
	
	$rowname[1] = 'joketext';
	$rowvalue[1] = 'HI MY NAME IS TRAVIS SMITH';
	$rownumbername[1] = 'id';
	$rownumber[1] = 2;
	*/
	//$testdatabase->updateRow($rowname, $rowvalue, $rownumbername, $rownumber);
	
	//$testdatabase->updateRow ('joketext', 'HELLO WORLD', 'id', '1');
	
	//$fieldstring = '`DUMMYTEST` TEXT NOT NULL';
	//$testdatabase->createField($fieldstring, 'AFTER', 'joketext');
	
	//$testdatabase->deleteField ('DUMMYTEXT');
	
	//$tablestring2[0] = '`jokedate` = "1994-04-01" WHERE id=1';
	//$tablestring2[1] = '`jokedate` = "1999-04-01" WHERE id=2';
	//$tablestring2[2] = '`jokedate` = "2009-04-01" WHERE id=3';
	//$testdatabase->updateTable($tablestring2);
		
	//$updatefield1 = 'jokedate';
	//$updatefield2 = 'jokedate';
	
	//$testdatabase->updateField($updatefield1, $updatefield2);
	/*
	$test[0][0] = 'DOG';
	$test[0][1] = 'CAT';
	$test[0][2] = 5;
	$test[1][0] = 'WHAT';
	$test[1][1] = 'EVER!';
	$test[1][2] = 6;
	
	print_r($test);
	
	if (is_array($test[0])) {
		print "THIS IS AN ARRAY\n";
		print_r($test[0]);
		print current($test[0]);
		print "\n";
		print next($test[0]);
		print "\n";
	}
	*/
	/*
	$rowname[0] = 'id';
	$rowname[1] = 'joketext';
	$rowname[2] = 'jokedate';
	$rowvalue[0] = '1';
	$rowvalue[1] = 'THIS IS A TEST';
	$rowvalue[2] = '0000-00-00';
	$testdatabase->createRow ($rowname, $rowvalue);
	*/
	/*
	$rowname[0][0] = 'id';
	$rowname[0][1] = 'joketext';
	$rowname[0][2] = 'jokedate';
	$rowvalue[0][0] = '1';
	$rowvalue[0][1] = 'THIS IS A TEST';
	$rowvalue[0][2] = '0000-00-00';
	
	$rowname[1][0] = 'id';
	$rowname[1][1] = 'joketext';
	$rowname[1][2] = 'jokedate';
	$rowvalue[1][0] = '2';
	$rowvalue[1][1] = 'THIS IS Another TEST';
	$rowvalue[1][2] = '0000-00-00';
	$testdatabase->createRow ($rowname, $rowvalue);
	*/
	//print_r($rowname);
	//print_r($rowvalue);
	
	/*
	$deleterowname[0] = 'id';
	$deleterowname[1] = 'id';
	$deleterowvalue[0] = '1';
	$deleterowvalue[1] = '2';	
	$testdatabase->deleterow ($deleterowname, $deleterowvalue);
	*/
	//$testdatabase->deleterow ('id', '1');
	/*
	$deletefield[0] = 'joketext';
	$deletefield[1] = 'jokedate';
	$testdatabase->deleteField ($deletefield);
	*/
	/*
	$fieldstring[0] = '`DUMMYTEST` TEXT NOT NULL';
	$fieldstring[1] = '`DUMMYTEST2` TEXT NOT NULL';
	$fieldafterflag[0] = 'AFTER';
	$fieldafterflag[1] = 'AFTER';
	$fieldafter[0] = 'joketext';
	$fieldafter[1] = 'jokedate';
	$testdatabase->createField($fieldstring, $fieldafterflag, $fieldafter);
	*/
	/*
	$updatefield1[0] = 'jokedate2';
	$updatefield1[1] = 'joketext2';
	
	$updatefield2[0] = 'jokedate';
	$updatefield2[1] = 'joketext';
	
	$testdatabase->updateField($updatefield1, $updatefield2);
	*/
	/*
	$testprotectionlayer = new ProtectionLayer();
	$testprotectionlayer->setModulesLocation('Modules/Tier3ProtectionLayer/');
	$testprotectionlayer->setDatabaseAll ($credentaillogonarray[0], $credentaillogonarray[1], $credentaillogonarray[2], $credentaillogonarray[3]);
	
	$testprotectionlayer->setDatabasetable('Flash');
	//$testprotectionlayer->ConnectAll();
	$testprotectionlayer->Connect('Flash');
	
	$flashidnumber = Array();
	$flashidnumber['idnumber'] = 1;
	$flashidnumber['idnumber1'] = 1;
	
	$functionarguments = Array();
	$functionarguments['idnumber'] = $flashidnumber;
	$testprotectionlayer->pass('Flash', 'setDatabaseField', $functionarguments);
	$testprotectionlayer->pass('Flash', 'setDatabaseRow', $functionarguments);
	*/
	////////////include('Configuration/Tier6-ContentLayer/flashimage.php');
	////////////include ('Configuration/Tier6-ContentLayer/list.php');
	//include ('Configuration/Tier6-ContentLayer/bottompanel1news.php');
	//include ('Configuration/Tier6-ContentLayer/bottompanel2.php');
	//include ('Configuration/Tier6-ContentLayer/bottompanel1.php');
	//include ('Configuration/Tier6-ContentLayer/toppanel2.php');
	//////////////include ('Configuration/Tier6-ContentLayer/picture.php');
	////////////////include ('Configuration/Tier6-ContentLayer/news.php');
	//$testprotectionlayer->buildModules();
	//print "DOG\n";
	//print_r($testprotectionlayer);
	
	//$test = $testdatabase->getError(0);
	//$test2 = $testdatabase->getErrorArray();
	//print "$test\n";
	//print_r ($test2);
	/*require_once 'Modules/Tier6ContentLayer/XhtmlCalendarTable/ClassXhtmlCalendarTable.php';
	$calendartable = new XhtmlCalendarTable(NULL, NULL);
	$calendartable->CreateOutput(NULL);
	$output = $calendartable->getOutput();
	print "$output\n";
	*/
	//////////////////require_once 'Configuration/Tier6-ContentLayer/calendar.php';
	require_once 'Configuration/Tier6-ContentLayer/mainmenu.php';
	//print_r($Tier4Databases);
	//print_r($calendartable);
	
/*phpinfo();



print "PHP Version is \n";

$temp = phpversion();

print "$temp\n";
*/


?>



</body>

</html>







