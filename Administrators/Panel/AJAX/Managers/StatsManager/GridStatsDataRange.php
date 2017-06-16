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
	$RefererPage = $_SERVER['HTTP_REFERER'];
	$RefererPageArray = explode('?', $RefererPage);
	$RefererPage = $RefererPageArray[0];
	$ServerLocation = "http://" . $_SERVER['SERVER_NAME'];

	unset($RefererPageArray);

	if ($RefererPage == $ServerLocation . "/Administrators/Panel/Managers/StatsManager/StatsManager.php") {
		//if ($_SERVER['HTTP_X_REQUESTED_WITH'] === 'XMLHttpRequest') {
			set_time_limit(120);

			if ($RangeType != NULL) {
				$EndRange = NULL;
				$EndTimeStamp = NULL;
				if ($RangeType == 'Daily') {
					$TimeStamp = strtotime($Range);
				} else if ($RangeType == 'Weekly') {
					$Range = explode(':', $Range);
					$EndRange = $Range[1];
					$Range = $Range[0];
					$TimeStamp = strtotime($Range);
					$EndTimeStamp = strtotime($EndRange);
				} else if ($RangeType == 'Monthly') {
					$StartRange = $Range;
					$Range ='01-' . $StartRange;
					unset($StartRange);

					$EndRange = date("y-m-t", strtotime($Range));
					$TimeStamp = strtotime($Range);
					$LastDay = date("Y-m-t", strtotime($Range));
					$EndTimeStamp = strtotime($EndRange);
				} else if ($RangeType == 'Yearly') {
					$StartRange = '01-01-' . $Range;
					$EndRange = '31-12-' . $Range;
					$Range = $StartRange;
					unset($StartRange);

					$TimeStamp = strtotime($Range);
					$EndTimeStamp = strtotime($EndRange);
				} else if ($RangeType == 'Range') {
					$Range = explode(':', $Range);
					$EndRange = $Range[1];
					$Range = $Range[0];
					$TimeStamp = strtotime($Range);
					$EndTimeStamp = strtotime($EndRange);
				}

				$Year = date('Y', $TimeStamp);
				$Date = date('Y-m-d', $TimeStamp);
				if ($EndTimeStamp != NULL) {
					$EndDate = date('Y-m-d', $EndTimeStamp);
					$EndYear = date('Y', $EndTimeStamp);
				}

				$LookupField = array();
				$Begin = array();
				$End = array();
				$LookupField['Timestamp'] = 'Timestamp';
				if ($RangeType == 'Daily') {
					$Begin['Timestamp'] = $Date . ' 00:00:00';
					$End['Timestamp'] = $Date . ' 23:59:59';
				} else if ($RangeType == 'Weekly') {
					$Begin['Timestamp'] = $Date . ' 00:00:00';
					$End['Timestamp'] = $EndDate . ' 23:59:59';
				} else if ($RangeType == 'Monthly') {
					$Begin['Timestamp'] = $Date . ' 00:00:00';
					$End['Timestamp'] = $EndDate . ' 23:59:59';
				} else if ($RangeType == 'Yearly') {
					$Begin['Timestamp'] = $Date . ' 00:00:00';
					$End['Timestamp'] = $EndDate . ' 23:59:59';
				} else if ($RangeType == 'Range') {
					$Begin['Timestamp'] = $Date . ' 00:00:00';
					$End['Timestamp'] = $EndDate . ' 23:59:59';
				}
			}
		//} else {
			//header("HTTP/1.0 404 Not Found");
		//}
	} else {
		header("HTTP/1.0 404 Not Found");
	}
?>