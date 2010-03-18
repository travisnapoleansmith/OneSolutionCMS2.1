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
	$formidnumber['PageID'] = 1;
	$formidnumber['ObjectID'] = 1;
	
	if ($_GET['PageID']){
		$formidnumber['PageID'] = $_GET['PageID'];
	}
	
	$formdatabase = Array();
	$formdatabase['Form'] = 'Form';
	$formdatabase['FormFieldSet'] = 'FormFieldSet';
	$formdatabase['FormInput'] = 'FormInput';
	$formdatabase['FormLabel'] = 'FormLabel';
	$formdatabase['FormLegend'] = 'FormLegend';
	$formdatabase['FormTableListing'] = 'FormTableListing';
	$formdatabase['FormTextArea'] = 'FormTextArea';
	
	$databases = &$GLOBALS['Tier6Databases'];
	
	$form = new XhtmlForm($formdatabase, $databases);
	$form->setDatabaseAll ($credentaillogonarray[0], $credentaillogonarray[1], $credentaillogonarray[2], $credentaillogonarray[3], 'Form');
	$form->setHttpUserAgent($_SERVER['HTTP_USER_AGENT']);
	$form->FetchDatabase ($formidnumber);
	$form->CreateOutput(NULL);
	$output = $form->getOutput();
	
	/*$formidnumber['PageID'] = 2;
	$form2 = new Xhtmlform($formdatabase, $databases);
	$form2->setDatabaseAll ($credentaillogonarray[0], $credentaillogonarray[1], $credentaillogonarray[2], $credentaillogonarray[3], 'Xhtmlform');
	$form2->setHttpUserAgent($_SERVER['HTTP_USER_AGENT']);
	$form2->FetchDatabase ($formidnumber);
	$form2->CreateOutput(NULL);
	$output2 = $form2->getOutput();*/
	//////print_r($form);
	print "$output\n";
	//print "$output2\n";
?>