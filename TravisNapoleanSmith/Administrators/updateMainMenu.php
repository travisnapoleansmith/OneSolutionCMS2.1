<?php	
	// Includes all files
	require_once ('includes.php');
	
	// Fetch PrintPreview Flag
	if (!$_GET['printpreview']){
		
		// Fetch Current Page ID - Based on filename
		if ($_GET) {
			$pagename = $_SERVER["REQUEST_URI"];
		} else {
			$pagename = $_SERVER['PHP_SELF'];
		}
		$directory = dirname($_SERVER['PHP_SELF']);
		$directory .= '/';
		$pagename = str_replace($directory, ' ', $pagename);
		$pagename = trim($pagename);
	
		// Fetch Current PAge ID - Based On Id Number
		$menudatabase = Array();
		$menudatabase['idnumber'] = 1;
		if ($_GET['idnumber']){
			$menudatabase['idnumber'] = $_GET['idnumber'];
		}
		$menudatabase['MainMenu'] = 'MainMenu';
		$menudatabase['MainMenuLookup'] = 'MainMenuLookup';
		
		$databases = &$GLOBALS['Databases'];
		
		/*if (strstr($_SERVER['HTTP_USER_AGENT'], 'MSIE 6.0')) {
			print "\n";
			print "<script type=\"text/javascript\" src=\"";
			print "Tier8-BehavioralLayer/jquery-1.3.2.min.js";
			print "\">\n</script>\n\n";
		}*/
	
		// Main Menu	
		$MainMenu = new Menu($menudatabase, $databases);
		
		$MainMenu->setDatabaseAll($credentaillogonarray[0], $credentaillogonarray[1], $credentaillogonarray[2], $credentaillogonarray[3]);
		
		$MainMenu->setPageName($pagename);

		$MainMenu->FetchAll();
				
		$MainMenu->setDynamicDatabase ('NewsButtons');
		$MainMenu->setDynamicDatabaseButtons($credentaillogonarray[0], $credentaillogonarray[1], $credentaillogonarray[2], $credentaillogonarray[3], 'NewsButtons', 'NewsButtons');
		$MainMenu->DynamicFetchAll('NewsButtons');
		
		$MainMenu->setMenuMaxDeep(2);

		$MainMenu->removeMenuItems('NewsButtons', 'News', NULL, 'News Item', 'news.php', 'NewsID');
		
		$MainMenu->setMenuClassIDAll('TopPanel1', 'main-menu main-menu-down');
		$MainMenu->makeMenuItem(1, 'MenuDatabase');
		$Menu = $MainMenu->getMenu();
		
		$MenuFile = 'menu.html';
		$file = fopen($MenuFile, 'w');
		if ($file) {
			fwrite($file, $Menu);
			fclose($file);
			print "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Strict//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd\" >\n";
			print "<html lang=\"en-US\" xml:lang=\"en-US\" xmlns=\"http://www.w3.org/1999/xhtml\"> \n\n";
			print "<html>\n";
			print "<head>\n";
			print "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=iso-8859-1\" />\n";
			print "<title>Administrators Update Main Menu</title>\n";
			print "</head>\n\n";
			
			print "<body>\n";
			print "<h1>Administrators Update Main Menu</h1>\n";
			print "<p>menu.html has been updated!</p>\n";
			print "<p><a href='../index.php' title='Home Page'>Return to Home Page</a></p>\n";
			print "</body>\n\n";
			print "</html>\n";
		}
	}
?>