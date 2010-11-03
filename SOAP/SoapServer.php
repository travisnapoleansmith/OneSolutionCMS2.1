<?php
	function getHeader($something, $somewhere) {
		$writer = new XMLWriter();
		$writer->openMemory();
		$writer->startDocument('1.0' , 'UTF-8');
		$writer->setIndent(4);
		
		$writer->startElement('lastmod');
		$writer->text('2005-01-01');
		$writer->endElement();
		
		$writer->startElement('something');
		$writer->text($something);
		$writer->endElement();
		//$something .= ' ';
		//$something .= $somewhere;
		return $writer;
	}
	$Server = new SoapServer(NULL, array('uri' => 'http://dummy.com', 'soap_version' => 'SOAP_1_2'));
	$Server->addFunction('getHeader');
	$Server->handle();
	//print "TESTING\n";
	//print_r($Server);
	//print_r(get_class_methods($Server));
?>