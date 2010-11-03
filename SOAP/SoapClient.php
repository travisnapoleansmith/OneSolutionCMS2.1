<?php
	$Client = new SoapClient(NULL, array('location' => 'http://kcphotovideoversion1.travisnapoleansmith.com/SOAP/SoapServer.php', 'uri' => 'http://dummy.com', 'soap_version' => SOAP_1_2));
	$return = $Client->getHeader('DUMMYTEXT', 'This is me!');
	//$return->endDocument();
	//$output = $return->flush();
	//print_r ($output);
	var_dump($return);
?>
