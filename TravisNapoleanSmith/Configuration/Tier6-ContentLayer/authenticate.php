<?php
	// Fetch Current Page ID - Based on filename
	//$pagename = $_SERVER['PHP_SELF'];
	//$directory = dirname($_SERVER['PHP_SELF']);
	//$directory .= '/';
	//$pagename = str_replace($directory, ' ', $pagename);
	//$pagename = trim($pagename);
	//if ($pagename[0] == '/') {
		//$pagename[0] = '';
		//$pagename = trim($pagename);
	//}
	
	// Fetch Current Page ID - Based On ID Number
	$formidnumber = Array();
	$formidnumber['PageID'] = 2;
	$formidnumber['ObjectID'] = 1;
	
	if ($_GET['PageID']){
		$formidnumber['PageID'] = $_GET['PageID'];
	}
	
	$formdatabase = Array();
	$formdatabase['Form'] = 'Form';
	$formdatabase['FormButton'] = 'FormButton';
	$formdatabase['FormFieldSet'] = 'FormFieldSet';
	$formdatabase['FormInput'] = 'FormInput';
	$formdatabase['FormLabel'] = 'FormLabel';
	$formdatabase['FormLegend'] = 'FormLegend';
	$formdatabase['FormOption'] = 'FormOption';
	$formdatabase['FormOptGroup'] = 'FormOptGroup';
	$formdatabase['FormSelect'] = 'FormSelect';
	$formdatabase['FormTableListing'] = 'FormTableListing';
	$formdatabase['FormTextArea'] = 'FormTextArea';
	
	if ($_SESSION['POST']['Error']) {
		print "HERE\n";
		$errormessagearray = $_SESSION['POST']['Error'];
		reset($errormessagearray);
		while (current($errormessagearray)) {
			$Writer->startElement('p');
			$Writer->text(key($errormessagearray));
			$Writer->writeRaw(":\n   <br /> \n    ");
			$Writer->text(current($errormessagearray));
			$Writer->writeRaw("\n  ");
			$Writer->endElement();
			next ($errormessagearray);
		}
		
	} else if ($_SESSION['POST']['UserAccounts']['Error']) {
		print "ERROR\n";
	}
	
	
	$databaseoptions = array();
	$databaseoptions['XhtmlFormSession'] = $_SESSION['POST']['FilteredInput'];
	
	$form = new XhtmlForm($formdatabase, $databaseoptions);
	$form->setDatabaseAll ($credentaillogonarray[0], $credentaillogonarray[1], $credentaillogonarray[2], $credentaillogonarray[3], 'Form');
	$form->setHttpUserAgent($_SERVER['HTTP_USER_AGENT']);
	$form->FetchDatabase ($formidnumber);
	$form->CreateOutput(NULL);
	
	//$output = $GLOBALS['Writer']->flush();
	//print "$output";
?>