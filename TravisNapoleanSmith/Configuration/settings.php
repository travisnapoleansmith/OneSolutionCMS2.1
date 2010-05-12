<?php
	$servername = 'tnscurrent.db.4823674.hostedresource.com';
	$username = 'tnscurrent';
	$password = 'GMT461z020414';
	$databasename = 'tnscurrent';
	
	$credentaillogonarray = Array ($servername, $username, $password, $databasename);
	
	$sitename = 'Travis Napolean Smith.com';
	
	$rsslink = 'http://beta.travisnapoleansmith.com/rss.php';
	
	$Writer = new XMLWriter();
	$Writer->openMemory();
	$Writer->setIndent(4);
	
	$ErrorMessage = array();
?>