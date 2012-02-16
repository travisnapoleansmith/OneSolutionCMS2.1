<?php
	$credentaillogonarray = $GLOBALS['credentaillogonarray'];
	$Writer = $GLOBALS['Writer'];
	
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
				$text = "Copyright &copy; 2009 - ";
				$text .= date("Y");
				$text .= " <a href='index.php'>KC Photo and Video</a>";
				$text .= " &#8211; Created with <a href='http://www.onlineonesolution.com'>One Solution CMS</a>";
				$Writer->writeRaw($text);
				$Writer->endElement();
			$Writer->endElement();
		$Writer->endElement();
		
?>