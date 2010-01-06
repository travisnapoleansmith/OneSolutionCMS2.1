<?php
	// Updates all news articles - can be run as a regularily scheduled job
	
	error_reporting(E_ERROR);
	// Includes all files
	require_once ('includes.php');
	
	$newsdatabaseupdate = &new MySqlConnect();
	$newsdatabaseupdate2 = &new MySqlConnect();
	$newsdatabaseupdate->setDatabaseAll ($credentaillogonarray[0], $credentaillogonarray[1], $credentaillogonarray[2], $credentaillogonarray[3], 'NewsButtons');
	$newsdatabaseupdate2->setDatabaseAll ($credentaillogonarray[0], $credentaillogonarray[1], $credentaillogonarray[2], $credentaillogonarray[3], 'MenuBottomPanel1');
	$newsdatabaseupdate->Connect();
	$newsdatabaseupdate2->Connect();
	$newsdatabaseupdate->setEntireTable();
	$newsdatabaseupdate2->setEntireTable();
	$rowcount = $newsdatabaseupdate->getRowCount();
	$i = 0;
	while ($i < 6) {
		$Div1Title = $newsdatabaseupdate->getTable($rowcount, 'BubbleHeadline');
		$Div1 = $newsdatabaseupdate->getTable($rowcount, 'ButtonHeadline');
		$Div1 = "<a href='index.php?PageID=1&amp;NewsID=$rowcount'>$Div1</a>";
		
		$tablestring[0] = "`Div1Title` = \"$Div1Title\" WHERE PageID=1 AND ObjectID=$i";
		$tablestring[1] = "`Div1` = \"$Div1\" WHERE PageID=1 AND ObjectID=$i";
		$newsdatabaseupdate2->updateTable ($tablestring);
		$i++;
		$rowcount--;
	}

	print "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Strict//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd\" >\n";
	print "<html lang=\"en-US\" xml:lang=\"en-US\" xmlns=\"http://www.w3.org/1999/xhtml\"> \n\n";
	print "<html>\n";
	print "<head>\n";
	print "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=iso-8859-1\" />\n";
	print "<title>Administrators Update News Menu</title>\n";
	print "</head>\n\n";
			
	print "<body>\n";
	print "<h1>Administrators Update News Menu</h1>\n";
	print "<p>News Menu has been updated!</p>\n";
	print "<p><a href='../index.php' title='Home Page'>Return to Home Page</a></p>\n";
	print "</body>\n\n";
	print "</html>\n";
?>