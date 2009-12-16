<?php
	// Updates all news articles - can be run as a regularily scheduled job
	require_once ("Tier2-DataAccessLayer/ClassMySqlConnect.php");
	require ("Configuration/updatesettings.php");
	
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
	print "Update Completed!";
?>