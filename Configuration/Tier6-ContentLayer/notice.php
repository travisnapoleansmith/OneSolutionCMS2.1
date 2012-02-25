<?php
	if (!isset($_GET['printpreview'])){
		$Writer = &$GLOBALS['Writer'];
		
		$Tier6Databases = $GLOBALS['Tier6Databases'];
		
		if (file_exists('ContentFiles/WebNotice.htm')) {
			$Tier6Databases->processHTMLFile('ContentFiles/WebNotice.htm');
		}
	}
?>