<?php	
	$writer = new XMLWriter();
	$writer->openURI('sitemap.xml');
	//$writer->openMemory();

	$writer->startDocument('1.0' , 'UTF-8');
	//$writer->startElement('html');
	$writer->setIndent(4);
	
	$writer->startElement('urlset');
	//$writer->writeAttribute('xmlns:xsi', 'http://www.w3.org/2001/XMLSchema-instance');
	//$writer->writeAttribute('xsi:schemaLocation', 'http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd');
	$writer->writeAttribute('xmlns', 'http://www.sitemaps.org/schemas/sitemap/0.9');
	
	$i = 0;
	while ($i < 5) {
		// Sitemap URL Begining
		$writer->startElement('url');
		
		// Sitemap Begining
		$writer->startElement('loc');
		$writer->text('http://www.travisnapoleansmith.org/');
		$writer->endElement();
		
		$writer->startElement('lastmod');
		$writer->text('2005-01-01');
		$writer->endElement();
		
		$writer->startElement('changefreq');
		$writer->text('daily');
		$writer->endElement();
		
		$writer->startElement('priority');
		$writer->text('0.8');
		$writer->endElement();
		
		// Sitemap Ending URL
		$writer->endElement();
		$i++;
	}
		
	//$writer->endElement();
	
	// Ending URLSET
	$writer->endElement();
	
	$writer->endDocument();
	$writer->flush();
	//$output = $writer->flush();
	
	//print $output;
	
	//header ("content-type: text/xml");
	header("Location: sitemap.xml");
?>