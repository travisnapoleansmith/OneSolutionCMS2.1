<?
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
	$Writer->writeAttribute('id', 'sv-container');
	$Writer->writeAttribute('style', 'position: relative; width: 600px; height: 800px; margin-bottom: -100px');

	//$Writer->startElement('div');
	//$Writer->writeAttribute('id', 'sv-mobile-flash');
	//$Writer->writeAttribute('style', 'position: absolute; width: 600px; height: 900px;');

	$Writer->startElement('object');
	$Writer->writeAttribute('width', '100%');
	$Writer->writeAttribute('height', '100%');
	$Writer->writeAttribute('id', 'sv-mobile-flash-swf');
	//$Writer->writeAttribute('style', 'position: relative; top: -140px; visibility: visible; margin-left: 25%; margin-right: 25%;');
	$Writer->writeAttribute('style', 'position: absolute; top: -100px; left: -10px; visibility: visible;');
	$HttpUserAgent = $_SERVER['HTTP_USER_AGENT'];

	if (strstr($HttpUserAgent, 'MSIE 6.0')) {
		$AllowScriptAccess = TRUE;
		$Writer->writeAttribute('classid', 'clsid:D27CDB6E-AE6D-11cf-96B8-444553540000');
		$Writer->writeAttribute('id', 'player');
		$Writer->writeAttribute('name', 'player');
	} else if (strstr($HttpUserAgent,'MSIE 7.0')) {
		$AllowScriptAccess = TRUE;
		$Writer->writeAttribute('classid', 'clsid:D27CDB6E-AE6D-11cf-96B8-444553540000');
		$Writer->writeAttribute('id', 'player');
		$Writer->writeAttribute('name', 'player');
	} else if (strstr($HttpUserAgent,'MSIE 8.0')) {
		$AllowScriptAccess = TRUE;
		$Writer->writeAttribute('classid', 'clsid:D27CDB6E-AE6D-11cf-96B8-444553540000');
		$Writer->writeAttribute('id', 'player');
		$Writer->writeAttribute('name', 'player');
	} else {
		$Writer->writeAttribute('type', 'application/x-shockwave-flash');
		$Writer->writeAttribute('data', '../Libraries/Tier6ContentLayer/SimpleViewers/SimpleViewer/svcore/swf/simpleviewer.swf');
	}

	//$Writer->writeAttribute('width', '550');
	//$Writer->writeAttribute('height', '400');

	if ($AllowScriptAccess == TRUE) {
		$Writer->writeAttribute('AllowScriptAccess', 'always');
	}

	$Writer->startElement('param');
	$Writer->writeAttribute('name', 'movie');
	$Writer->writeAttribute('value', '../Libraries/Tier6ContentLayer/SimpleViewers/SimpleViewer/svcore/swf/simpleviewer.swf');
	$Writer->endElement();

	$Writer->startElement('param');
	$Writer->writeAttribute('name', 'allowscriptaccess');
	$Writer->writeAttribute('value', 'always');
	$Writer->endElement();

	$Writer->startElement('param');
	$Writer->writeAttribute('name', 'quality');
	$Writer->writeAttribute('value', 'high');
	$Writer->endElement();

	$Writer->startElement('param');
	$Writer->writeAttribute('name', 'allowfullscreen');
	$Writer->writeAttribute('value', 'true');
	$Writer->endElement();

	$Writer->startElement('param');
	$Writer->writeAttribute('name', 'wmode');
	$Writer->writeAttribute('value', 'transparent');
	$Writer->endElement();

	$Writer->startElement('param');
	$Writer->writeAttribute('name', 'flashvars');
	//$Writer->writeAttribute('value', "galleryURL=../Libraries/Tier6ContentLayer/SimpleViewers/SimpleViewer/gallery.xml");
	$Writer->writeAttribute('value', "galleryURL=../Modules/Tier6ContentLayer/XhtmlSimpleViewer/XmlSimpleViewer.php?PageID=1000");
	$Writer->endElement();

	//$Writer->startElement('param');
	//$Writer->writeAttribute('value', "galleryURL=../Libraries/Tier6ContentLayer/SimpleViewers/SimpleViewer/gallery.xml");
	//$Writer->writeAttribute('value', "baseURL=images.kcphotovideo.com/");
	//$Writer->endElement();

	$Writer->endElement(); // ENDS OBJECT
	//$Writer->endElement(); // ENDS DIV
	$Writer->endElement(); // ENDS DIV

?>