<?php
	$credentaillogonarray = $GLOBALS['credentaillogonarray'];
	$Writer = $GLOBALS['Writer'];

	$Copyright = $GLOBALS['copyright'];
	$Copyright .= date('Y');
	$CMSVersion = $GLOBALS['cmsversion'];
	
	$Writer->startElement('div');
		$Writer->writeAttribute('id', 'footer');
			$Writer->startElement('div');
			$Writer->writeAttribute('id', 'footer-copyright');
				if ($printpreview == NULL) {
					$Writer->startElement('h1');
				} else {
					$Writer->startElement('h4');
				}
				$Writer->writeAttribute('class', 'CopyrightHeading');
				$text = $Copyright;
				$text .= " &#8211; Created with <a href='http://www.onesolutioncms.com'>One Solution CMS</a> ";
				$text .= $CMSVersion;
				$Writer->writeRaw($text);
				$Writer->endElement();
			$Writer->endElement();
		$Writer->endElement();

		require('sitestats.php');
?>