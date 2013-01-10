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

class Revisions extends Tier3ProtectionLayerModulesAbstract implements Tier3ProtectionLayerModules
{

	public function __construct($tablenames, $databaseoptions, $layermodule) {
		$this->LayerModule = &$layermodule;

		$hold = current($tablenames);
		$GLOBALS['ErrorMessage']['Revisions'][$hold] = NULL;
		$this->ErrorMessage = &$GLOBALS['ErrorMessage']['Revisions'][$hold];
		$this->ErrorMessage = array();

	}

	public function setDatabaseAll ($hostname, $user, $password, $databasename, $databasetable) {

	}

	public function FetchDatabase ($PageID) {

	}

	public function CreateOutput($space){

	}

	public function Verify($function, $functionarguments){
		return TRUE;
	}

	public function getOutput() {

	}
}


?>
