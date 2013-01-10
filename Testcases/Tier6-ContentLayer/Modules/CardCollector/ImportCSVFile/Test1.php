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

	// TEST CASE 1 for Method ImportCSVFile
	// $Tier6Databases -> ModulePass('CardCollector', 'cardcollection', array $Options);
	// Tests out sending a CSVFile to be imported into the collection.
	// Should return true.

	//set_include_path('../Testcases/Tier6-ContentLayer/Modules/CardCollector/ImportCSVFile/');
	// NEEDS TO BE A METHOD
	// REMOVES THE TWO LINES FOR EACH ROW TO BE UPDATED IN THE DATABASE

	$MAXFIELDS = 12;
	$FileNumber = 1;

	$FileName = "TestFile$FileNumber.csv";
	$File = file($FileName, FILE_USE_INCLUDE_PATH);
	$FileNew = array();

    //print "DEMO\n";
	$File = implode(',' , $File);
	$File = str_replace("\r\n", '', $File);
	$File = explode('","', $File);

	$i = 1;
	$hold = '';
	foreach ($File as $Key => $Value) {
		if ($i == 1 && $Value[0] == '"') {
			$Value = substr($Value, 1);
		}

		if ($i < $MAXFIELDS) {
			$hold .= '","';
			$hold .= $Value;
			$i++;
		}

		if ($i == $MAXFIELDS) {
			$hold .= '"';
			if ($hold[0] == '"' && $hold[1] == ',' && $hold[2] == '"') {
				$hold = substr($hold, 1);
				$hold = substr($hold, 1);
			}
			array_push($FileNew, $hold);
			$i = 1;
			$hold = '';
		}
	}


	// NEEDS TO BE A METHOD
	// WRITES A FILE WITH THE TWO LINES FOR EACH ROW BEING CONDENSED TO ONE ROW
	$FileName = "c:\TestFile$FileNumber.csv";
	$NewFile = fopen($FileName, 'w', TRUE);
	foreach ($FileNew as $Fields) {
		$Fields = $Fields . "\n";
		fwrite($NewFile, $Fields);
	}
	fclose($NewFile);

	$NewFile = file($FileName, FILE_USE_INCLUDE_PATH);

	// CREATES FIELDS FROM 1ST ELEMENT IN THE ARRAY
	/*$Fields = array();
	$hold = $NewFile[0];
	$hold = explode('","', $hold);
	$hold[0] = str_replace('"', '', $hold[0]);
	$Last = end($hold);
	$LastKey = key($hold);
	reset($hold);
	$hold[$LastKey] = trim(str_replace('"', '', $hold[$LastKey]));
	$Fields = $hold;
	print_r($Fields);
	unset($hold);
	*/
	/*
	// TESTING IF QUOTES INSIDE OF A FIELD WILL CAUSE ANY PROBLEMS
	$Record = array();
	$hold = $NewFile[81];
	$hold = explode('","', $hold);
	$hold[0] = str_replace('"', '', $hold[0]);
	$Last = end($hold);
	$LastKey = key($hold);
	reset($hold);
	$hold[$LastKey] = trim(str_replace('"', '', $hold[$LastKey]));
	$Record = $hold;
	//print_r($Record);
	*/


	// NEEDS TO BE A METHOD
	// CREATES THE TABLE ARRAY SO THAT EACH ELEMENT CAN BE UPDATED IN THE DATABASE

	$Table = array();
	$i = 0;
	foreach ($NewFile as $Key => $Value) {
		if ($Key == 0) {
			// CREATES FIELDS FROM 1ST ELEMENT IN THE FILE ARRAY
			$Fields = array();
			$hold = $NewFile[0];
			$hold = explode('","', $hold);
			$hold[0] = trim(str_replace('"', '', $hold[0]));
			$Last = end($hold);
			$LastKey = key($hold);
			reset($hold);
			$hold[$LastKey] = trim(str_replace('"', '', $hold[$LastKey]));
			$Fields = $hold;
			unset($hold);
		} else {
			// CREATES ROWS FOR EACH ELEMENT IN THE FILE ARRAY
			if ($Value != NULL) {
				$Record = array();
				$hold = $Value;
				$hold = explode('","', $hold);
				$hold[0] = trim(str_replace('"', '', $hold[0]));
				$Last = end($hold);
				$LastKey = key($hold);
				reset($hold);
				$hold[$LastKey] = trim(str_replace('"', '', $hold[$LastKey]));
				$Record = $hold;

				foreach ($Record as $RecordKey => $RecordValue) {
					$Table[$i][$Fields[$RecordKey]] = $RecordValue;
				}
				unset($Record);
			}
		}

		$i++;
	}

	//print_r($Table);
	print "Task Completed for TestFile$FileNumber.csv!\n";

?>