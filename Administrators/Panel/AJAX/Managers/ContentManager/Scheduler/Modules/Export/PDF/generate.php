<?php
// MAKE THIS CODE WORK FOR EVENTS.PHP FILE NEEDS TO INCLUDE FORMAT OPTION IN THE POST
require_once './pdfGenerator.php';
require_once './pdfWrapper.php';
require_once './tcpdf_ext.php';
$debug = false;
$error_handler = set_error_handler("PDFErrorHandler");

if (get_magic_quotes_gpc()) {
	$xmlString = stripslashes($_POST['mycoolxmlbody']);
} else {
	$xmlString = $_POST['mycoolxmlbody'];
}

if ($debug == true) {
	error_log($xmlString, 3, 'debug_'.date("Y_m_d__H_i_s").'.xml');
}
//print_r($_POST);
//print "---------------------\n";
//print_r($xmlString);
$xmlString = urldecode($xmlString);
//print "==================================\n";
//print_r($xmlString);
$xml = new SimpleXMLElement($xmlString, LIBXML_NOCDATA);

$scPDF = new schedulerPDF();
//$scPDF->printScheduler($xml, 'D');
$scPDF->printScheduler($xml, 'I');
function PDFErrorHandler ($errno, $errstr, $errfile, $errline) {
	global $xmlString;
	if ($errno < 1024) {
		echo $errstr."<br>";
		error_log($xmlString, 3, 'error_report_'.date("Y_m_d__H_i_s").'.xml');
		exit(1);
	}
}

?>