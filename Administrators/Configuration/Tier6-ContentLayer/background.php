<?php
	/*
	**************************************************************************************
	* One Solution CMS
	*
	* Copyright (c) 1999 - 2012 One Solution CMS
	*
	* This content management system is free software; you can redistribute it and/or
	* modify it under the terms of the GNU Lesser General Public
	* License as published by the Free Software Foundation; either
	* version 2.1 of the License, or (at your option) any later version.
	*
	* This library is distributed in the hope that it will be useful,
	* but WITHOUT ANY WARRANTY; without even the implied warranty of
	* MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU
	* Lesser General Public License for more details.
	*
	* You should have received a copy of the GNU Lesser General Public
	* License along with this library; if not, write to the Free Software
	* Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301  USA
	*
	* @copyright  Copyright (c) 1999 - 2013 One Solution CMS (http://www.onesolutioncms.com/)
	* @license    http://www.gnu.org/licenses/old-licenses/lgpl-2.1.txt	LGPL
	* @version    2.1.139, 2012-12-27
	*************************************************************************************
	*/

	$credentaillogonarray = $GLOBALS['credentaillogonarray'];
	$Writer = $GLOBALS['Writer'];

	$Writer->startElement('div');
		$Writer->writeAttribute('id','backgroundimage');
			if ($GLOBALS['ThemeName']) {
				$ThemeName = $GLOBALS['ThemeName'];
				$Writer->startElement('img');
				$Writer->writeAttribute('src', "$HOME/Tier8-PresentationLayer/$ThemeName/TemplateImages/Main-Background.jpg");
				$Writer->writeAttribute('alt', 'Background Image');
				$Writer->writeAttribute('id', 'background');
				$Writer->endElement();
			}
		$Writer->endElement();
?>