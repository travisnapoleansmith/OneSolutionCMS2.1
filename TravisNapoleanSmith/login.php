<?php
	
	//print_r($_POST);
	if (isset($_POST['Login'])) {
		print "I AM Logged In\n";
	} else {
		header('HTTP/1.1 401 Unauthorized');
		header('WWW-Authenticate: Basic realm="PHP Secured"');
		exit('Unauthorized!');
	}
?>