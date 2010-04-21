<?
	$sessionname = $_GET['SessionID'];
	if ($sessionname) {
		session_name($sessionname);
	} else {
		session_name('random');
	}
	session_start();
	// Includes all files
	require_once ('Configuration/includes.php');
	
	// STARTS HEADER
	$Writer->startDTD('html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd"');
	$Writer->endDTD();
	
	$Writer->startElement('html');
	$Writer->writeAttribute('lang', 'en-US');
	$Writer->writeAttribute('xml:lang', 'en-US');
	$Writer->writeAttribute('xmlns', 'http://www.w3.org/1999/xhtml');
	$Writer->endElement(); //Ends HTML
	
	$Writer->startElement('html');
	$Writer->startElement('head');
	
	$Writer->startElement('meta');
	$Writer->writeAttribute('http-equiv', 'Content-Type');
	$Writer->writeAttribute('content', 'text/html; charset=utf-8');
	$Writer->endElement(); //ENDS META
	
	$Writer->startElement('title');
	$Writer->text("User Authentication - $sitename");
	$Writer->endElement(); //END TITLE
	
	$Writer->endElement(); //Ends HEAD
	// ENDS HEADER
	
	// STARTS BODY
	$Writer->startElement('body');
		require_once 'Configuration/Tier6-ContentLayer/authenticate.php';
	$Writer->endElement(); //Ends BODY
	$Writer->endElement(); //Ends HTML
	
	// ENDS BODY
	
	$Writer->endDocument();
	
	$output = $GLOBALS['Writer']->flush();
	print "$output";
?>



</body>

</html>







