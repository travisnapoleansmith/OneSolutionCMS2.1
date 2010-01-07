<?php
	function bottompanel1() {
		// Fetch Current Page ID - Based on filename
		//$pagename = $_SERVER['PHP_SELF'];
		//$directory = dirname($_SERVER['PHP_SELF']);
		//$directory .= '/';
		//$pagename = str_replace($directory, ' ', $pagename);
		//$pagename = trim($pagename);
		//if ($pagename[0] == '/') {
			//$pagename[0] = '';
			//$pagename = trim($pagename);
		//}
		
		// Fetch Current Page ID - Based On ID Number
		$listidnumber = Array();
		$listidnumber['PageID'] = 1;
		
		if ($_GET['PageID']){
			$listidnumber['PageID'] = $_GET['PageID'];
		}
		
		$listidnumber['ObjectID'] = 0;
		
		$listidnumber['ClassReplace'] = 'BottomPanel1Button';
		$listidnumber['ClassClass'] = 'BottomPanel1InUse BottomPanel1Button';
		
		$listdatabase = Array();
		$listdatabase['MenuBottomPanel1'] = 'MenuBottomPanel1';
		
		$databases = &$GLOBALS['Databases'];
		
		$list = new XhtmlMenu($listdatabase, $databases);
		$list->setDatabaseAll ($credentaillogonarray[0], $credentaillogonarray[1], $credentaillogonarray[2], $credentaillogonarray[3], 'MenuBottomPanel1');
		$list->setHttpUserAgent($_SERVER['HTTP_USER_AGENT']);
		$list->FetchDatabase ($listidnumber);
		$list->CreateOutput('   ');
		$listidnumber['ObjectID'] = 1;
	
		$listoutput = $list->getOutput();
		
		$list1 = new XhtmlMenu($listdatabase, $databases);
		$list1->setDatabaseAll ($credentaillogonarray[0], $credentaillogonarray[1], $credentaillogonarray[2], $credentaillogonarray[3], 'MenuBottomPanel1');
		$list1->setHttpUserAgent($_SERVER['HTTP_USER_AGENT']);
		$list1->FetchDatabase ($listidnumber);
		$list1->CreateOutput('   ');
		
		$listidnumber['ObjectID'] = 2;
		
		$listoutput1 = $list1->getOutput();
			
		$list2 = new XhtmlMenu($listdatabase, $databases);
		$list2->setDatabaseAll ($credentaillogonarray[0], $credentaillogonarray[1], $credentaillogonarray[2], $credentaillogonarray[3], 'MenuBottomPanel1');
		$list2->setHttpUserAgent($_SERVER['HTTP_USER_AGENT']);
		$list2->FetchDatabase ($listidnumber);
		$list2->CreateOutput('   ');
		
		$listidnumber['ObjectID'] = 3;
		
		$listoutput2 = $list2->getOutput();
				
		$list3 = new XhtmlMenu($listdatabase, $databases);
		$list3->setDatabaseAll ($credentaillogonarray[0], $credentaillogonarray[1], $credentaillogonarray[2], $credentaillogonarray[3], 'MenuBottomPanel1');
		$list3->setHttpUserAgent($_SERVER['HTTP_USER_AGENT']);
		$list3->FetchDatabase ($listidnumber);
		$list3->CreateOutput('   ');
		
		$listidnumber['ObjectID'] = 4;
		
		$listoutput3 = $list3->getOutput();
		
		$list4 = new XhtmlMenu($listdatabase, $databases);
		$list4->setDatabaseAll ($credentaillogonarray[0], $credentaillogonarray[1], $credentaillogonarray[2], $credentaillogonarray[3], 'MenuBottomPanel1');
		$list4->setHttpUserAgent($_SERVER['HTTP_USER_AGENT']);
		$list4->FetchDatabase ($listidnumber);
		$list4->CreateOutput('   ');
		
		$listidnumber['ObjectID'] = 5;
		
		$listoutput4 = $list4->getOutput();
		
		$list5 = new XhtmlMenu($listdatabase, $databases);
		$list5->setDatabaseAll ($credentaillogonarray[0], $credentaillogonarray[1], $credentaillogonarray[2], $credentaillogonarray[3], 'MenuBottomPanel1');
		$list5->setHttpUserAgent($_SERVER['HTTP_USER_AGENT']);
		$list5->FetchDatabase ($listidnumber);
		$list5->CreateOutput('   ');
		
		$listidnumber['ObjectID'] = 6;
		
		$listoutput5 = $list5->getOutput();
		$output = "<div id=\"BottomPanel1\" class=\"BottomPanel1-1\">\n";
		$output .= "  $listoutput";
		$output .= "  $listoutput1";
		$output .= "  $listoutput2";
		$output .= "  $listoutput3";
		$output .= "  $listoutput4";
		$output .= "  $listoutput5";
		$output .= "</div>\n\n";
		return $output;
	}
	
?>