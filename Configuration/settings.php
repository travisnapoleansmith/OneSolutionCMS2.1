<?php
	$SETTINGS = parse_ini_file('settings.ini', true);
	
	$servername = $SETTINGS['DATABASE CONNECTION']['SERVERNAME'];
	$username = $SETTINGS['DATABASE CONNECTION']['USERNAME'];
	$password = $SETTINGS['DATABASE CONNECTION']['PASSWORD'];
	$databasename = $SETTINGS['DATABASE CONNECTION']['DATABASENAME'];
	
	$credentaillogonarray = Array ($servername, $username, $password, $databasename);
	
	$sitename = $SETTINGS['SITE SETTINGS']['SITENAME'];
	
	$rsslink = $SETTINGS['SITE SETTINGS']['RSSLINK'];
	$sitelink = $SETTINGS['SITE SETTINGS']['SITELINK'];
	$author = $SETTINGS['SITE SETTINGS']['AUTHOR'];
	
	$Writer = new XMLWriter();
	$Writer->openMemory();
	$Writer->setIndent(4);
	
	$ErrorMessage = array();
?>