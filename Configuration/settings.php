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

	ini_set('upload_max_filesize', '64M');
	$SETTINGS = parse_ini_file('settings.ini', true);
	$HOME = $_SERVER['SUBDOMAIN_DOCUMENT_ROOT'];

	$servername = $SETTINGS['DATABASE CONNECTION']['SERVERNAME'];
	$username = $SETTINGS['DATABASE CONNECTION']['USERNAME'];
	$password = $SETTINGS['DATABASE CONNECTION']['PASSWORD'];
	$databasename = $SETTINGS['DATABASE CONNECTION']['DATABASENAME'];

	$credentaillogonarray = Array ($servername, $username, $password, $databasename);

	$sitename = $SETTINGS['SITE SETTINGS']['SITENAME'];

	$rsslink = $SETTINGS['SITE SETTINGS']['RSSLINK'];
	$sitelink = $SETTINGS['SITE SETTINGS']['SITELINK'];
	$author = $SETTINGS['SITE SETTINGS']['AUTHOR'];
	$copyright = $SETTINGS['SITE SETTINGS']['COPYRIGHT'];

	$cmsversion = '2.1.140';

	$Writer = new XMLWriter();
	$Writer->openMemory();
	$Writer->setIndent(4);

	$ErrorMessage = array();
?>