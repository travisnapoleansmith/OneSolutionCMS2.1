<?php
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
	$flashidnumber = Array();
	$flashidnumber['PageID'] = 1;
	
	if ($_GET['flashidnumber']){
		$flashidnumber['PageID'] = $_GET['flashidnumber'];
	}
	$flashidnumber['ObjectID'] = 1;
	
	$flashdatabase = Array();
	$flashdatabase['Flash'] = 'Flash';
	
	$databases = &$GLOBALS['Tier4Databases'];
	
	$flash = new XhtmlFlash($flashdatabase, $databases);
	$flash->setDatabaseAll ($credentaillogonarray[0], $credentaillogonarray[1], $credentaillogonarray[2], $credentaillogonarray[3], 'Flash');
	$flash->setHttpUserAgent($_SERVER['HTTP_USER_AGENT']);
	$flash->FetchDatabase ($flashidnumber);
	//$flash->BuildFlashVarsText();
	$flash->CreateOutput('    ');
	
	//print_r($flash);
	$flashoutput = $flash->getOutput();
	//print "<div id=\"textlayer1\">\n";
	print "  $flashoutput";
	///print "\n";
	//print "</div>\n";
	
/*
  <div id="textlayer1">
    <div id="bodyitem2" style="margin-left: auto; margin-right: auto; top: 90px; " class="Paragraph">
	  <object width="500" height="380" type="application/x-shockwave-flash" data="player.swf">
      	<param name="movie" value="player.swf" />
       	<param name="wmode" value="opaque" />
       	<param name="allowfullscreen" value="true" />
       	<param name="allowscriptaccess" value="true" />
       	<param name="flashvars" value="file=http://www.travisnapoleansmith.com/Multimedia/Flash/PlattsburghStateWomensBasketballOpening2006-2007Season.flv&amp;fullscreen=true&amp;controlbar=bottom" />
    		 2006-2007 Womens Basketball Opening - <a href="http://get.adobe.com/flashplayer/">Adobe Flash </a> is needed to view these pictures
      </object>
	</div>
  </div>
  */
?>