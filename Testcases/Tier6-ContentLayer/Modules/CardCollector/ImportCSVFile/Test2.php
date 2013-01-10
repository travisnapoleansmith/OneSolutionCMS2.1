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

	// Creates a new file from an existing file.  The new file will have all " replaced with \"
	// for CSV files.

	$i = 1;
	$FileName = "TestFile$i.csv";
	$NewFileName = "C:\TestFile$i.csv";

	$OldFile = file($FileName, FILE_USE_INCLUDE_PATH);
	$NewFile = fopen($NewFileName, 'w', TRUE);

	foreach ($OldFile as $Fields) {
		$Record = array();
		$hold = $Fields;
		if ($hold[0] == '"') {
			$hold = substr($hold, 1);
		}

		$hold = trim($hold);

		if ($hold[strlen($hold)-1] == '"') {
			$hold = rtrim($hold, "\"");
		}
		$hold = explode('","', $hold);
		foreach ($hold as $NewKey => $NewFields) {
			$NewFields = str_replace('"', '\"', $NewFields);
			$NewFields = preg_replace('/  +/', '', $NewFields);
			$hold[$NewKey] = $NewFields;
		}

		$temp = $hold[0];
		$hold[0] = '"' . $temp;

		$key = count($hold) - 1;
		$temp = $hold[$key];
		$hold[$key] = $temp . '"';
		$hold = implode('","' , $hold);
		$hold .= "\n";

		fwrite($NewFile, $hold);
	}
	fclose($NewFile);

	print "Task Completed for TestFile$i.csv!\n";
?>