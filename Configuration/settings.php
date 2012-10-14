<?php
	$SETTINGS = parse_ini_file('settings.ini', true);
	$HOME = $_SERVER['SUBDOMAIN_DOCUMENT_ROOT'];

	$servername = $SETTINGS['DATABASE CONNECTION']['SERVERNAME'];
	$username = $SETTINGS['DATABASE CONNECTION']['USERNAME'];
	$password = $SETTINGS['DATABASE CONNECTION']['PASSWORD'];
	$databasename = $SETTINGS['DATABASE CONNECTION']['DATABASENAME'];

	$credentaillogonarray = Array ($servername, $username, $password, $databasename);

	$sitename = $SETTINGS['SITE SETTINGS']['SITENAME'];

	$rsslink = $SETTINGS['SITE SETTINGS']['RSSLINK'];
	$sitelink = $SETTINGS['SITE SETTINGS']['SITELINK'];
	$author = $SETTINGS['SITE SETTINGS']['AUTHOR'];
	$copyright = $SETTINGS['SITE SETTINGS']['COPYRIGHT'];

	$cmsversion = '2.1.135';

	$Writer = new XMLWriter();
	$Writer->openMemory();
	$Writer->setIndent(4);

	$ErrorMessage = array();
?>