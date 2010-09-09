<?php
	$credentaillogonarray = $GLOBALS['credentaillogonarray'];
	$Writer = $GLOBALS['Writer'];
	
	$Writer->startElement('div');
		$Writer->writeAttribute('id','backgroundimage');
			if ($GLOBALS['ThemeName']) {
				$ThemeName = $GLOBALS['ThemeName'];
				$Writer->startElement('img');
				$Writer->writeAttribute('src', "../Tier8-PresentationLayer/$ThemeName/TemplateImages/Main-Background.jpg");
				$Writer->writeAttribute('alt', 'Background Image');
				$Writer->writeAttribute('id', 'background');
				$Writer->endElement();
			}
		$Writer->endElement();
?>