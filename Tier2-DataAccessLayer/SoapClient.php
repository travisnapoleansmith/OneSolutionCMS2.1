<?php
	$Location = "http://atpaversion3.travisnapoleansmith.com/Tier2-DataAccessLayer/SoapServerDataAccessLayer.php?Token=ABC123";
	$Uri = 'http://atpaversion3.travisnapoleansmith.com/';
	$Client = new SoapClient(NULL, array('location' => $Location, 
										'uri' => $Uri, 
										'soap_version' => SOAP_1_2));
	
	//$Authentication = array('UserName' => 'USERNAME', 'Password' => 'PASSWORD', 'Token' => 'TOKEN');
	//$Header = new SoapHeader('http://atpaversion3.travisnapoleansmith.com/Tier2-DataAccessLayer/', 'Authentication', $Authentication);
	//$_POST['Token'] = 'DOG';
	
	//$Client->__setSoapHeaders($Header);
	
	//$return = $Client->TESTING('DUMMYTEXT');
	
	//print_r($return);
	
	$return = $Client->setDatabaseAll('MySqlConnect', 'TESTING', 'TEST', 'TESTMEOUT');
	$return = $Client->getHostname();
	print_r($return);
	print "HERE\n";
?>
