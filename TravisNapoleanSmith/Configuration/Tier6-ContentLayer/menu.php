<?php
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
		
		$databases = &$GLOBALS['Tier6Databases'];
		
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
		
		//ob_start();
		$MainMenu->setMenuClassIDAll('TopPanel1', 'main-menu main-menu-down');
		$MainMenu->makeMenuItem(1, 'MenuDatabase');
		$Menu = $MainMenu->getMenu();
		//ob_end_clean();
		//print_r($MainMenu);
		print "$Menu\n";
		/*
		$MenuFile = 'menu.html';
		$file = fopen($MenuFile, 'w');
		if ($file) {
			fwrite($file, $Menu);
			fclose($file);
		}*/
	}
?>