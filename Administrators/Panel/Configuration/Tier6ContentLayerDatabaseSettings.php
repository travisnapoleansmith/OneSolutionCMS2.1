<?php
	/*
	**************************************************************************************
	* One Solution CMS
	*
	* Copyright (c) 1999 - 2013 One Solution CMS
	* This content management system is free software: you can redistribute it and/or modify
	* it under the terms of the GNU General Public License as published by
	* the Free Software Foundation, either version 2 of the License, or
	* (at your option) any later version.
	*
	* This content management system is distributed in the hope that it will be useful,
	* but WITHOUT ANY WARRANTY; without even the implied warranty of
	* MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
	* GNU General Public License for more details.
	*
	* You should have received a copy of the GNU General Public License
	* along with this program.  If not, see <http://www.gnu.org/licenses/>.
	*
	* @copyright  Copyright (c) 1999 - 2013 One Solution CMS (http://www.onesolutioncms.com/)
	* @license    http://www.gnu.org/licenses/gpl-2.0.txt
	* @version    2.1.141, 2013-01-14
	*************************************************************************************
	*/

	// MySql Database Tables
	$Tier6Databases = new ContentLayer();

	$Tier6Databases->createDatabaseTable('AdministratorContentLayer');
	$Tier6Databases->createDatabaseTable('AdministratorContentLayerVersion');

	$Tier6Databases->createDatabaseTable('CalendarAppointments');
	$Tier6Databases->createDatabaseTable('CalendarTable');

	$Tier6Databases->setDatabaseAll ($credentaillogonarray[0], $credentaillogonarray[1], $credentaillogonarray[2], $credentaillogonarray[3], NULL);
	$Tier6Databases->buildModules('AdministratorContentLayerModules', 'AdministratorContentLayerTables', 'AdministratorContentLayerModulesSettings');
	$Tier6Databases->setVersionTable('AdministratorContentLayerVersion');
	$Tier6Databases->setThemeTableName('AdministratorContentLayerTheme');
	$Tier6Databases->setThemeGlobalLayerTable('AdministratorContentLayerThemeGlobalLayer');
	$Tier6Databases->buildThemeGlobalLayerTable();

?>