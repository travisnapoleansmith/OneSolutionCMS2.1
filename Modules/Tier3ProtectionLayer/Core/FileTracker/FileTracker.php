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
	// SANITISE FILE VARIABLE
	$File = $_GET['File'];
	$NoRedirect = $_GET['NoRedirect'];
	//print_r($_POST);
	//print "HERE\n";
	$sessionname = $_GET['SessionID'];

	if ($sessionname) {
		session_name($sessionname);
	}
	session_start();
	
	if (isset($File) === TRUE) {
		require_once ('../../../../Configuration/includes.php');
		
		set_time_limit(120);
		
		if ($_GET['FileTrackerStop'] === 'STOP') {
			$Redirect = NULL;
			$LoadFile = NULL;
			if ($File[strlen($File)-1] == "/") {
				$Redirect = 'http://' . $_SERVER['HTTP_HOST'] . '/' .  $File . $FileName . '?FileTrackerStop=STOP';
			} else {
				$Redirect = 'http://' . $_SERVER['HTTP_HOST'] . '/' .  $File . '?FileTrackerStop=STOP';
			}
			
			header("Location: $Redirect");
		}
		
		if ($File[strlen($File)-1] == "/") {
			$FileName = 'index.php';
		}
		
		$EventArray = array();
		$EventData = array();
		
		$PassArray = array();
		$PassArray['Execute'] = TRUE;
		$PassArray['Method'] = 'createFileTrackerEvent';
		$PassArray['ObjectType'] = 'FileTracker';
		$PassArray['ObjectTypeName'] = 'filetracker';
		
		$PassArrayCreateFileTrackerTable = array();
		$PassArrayCreateFileTrackerTable['Execute'] = TRUE;
		$PassArrayCreateFileTrackerTable['Method'] = 'createFileTrackerTable';
		$PassArrayCreateFileTrackerTable['ObjectType'] = 'FileTracker';
		$PassArrayCreateFileTrackerTable['ObjectTypeName'] = 'filetracker';
		
		$Timestamp = $_SERVER['REQUEST_TIME'];
		$Timestamp = date('Y-m-d H:i:s', $Timestamp);
		
		$EventData['Timestamp'] = $Timestamp;
		
		$EventData['RequestUri'] = $_SERVER['REQUEST_URI'];
		
		if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
			$EventData['IPAddress'] = $_SERVER['HTTP_X_FORWARDED_FOR'];
		} else {
			$EventData['IPAddress'] = $_SERVER['REMOTE_ADDR'];
		}
		
		$EventData['HttpRefer'] = $_SERVER['HTTP_REFERER'];
		$EventData['HttpUserAgentString'] = $_SERVER['HTTP_USER_AGENT'];
		
		$EventData['HttpAccept'] = $_SERVER['HTTP_ACCEPT'];
		$EventData['HttpAcceptLanguage'] = $_SERVER['HTTP_ACCEPT_LANGUAGE'];
		$EventData['HttpAcceptEncoding'] = $_SERVER['HTTP_ACCEPT_ENCODING'];
		$EventData['HttpHost'] = $_SERVER['HTTP_HOST'];
		$EventData['HttpDNT'] = $_SERVER['HTTP_DNT'];
		$EventData['HttpConnection'] = $_SERVER['HTTP_CONNECTION'];
		$EventData['HttpCookie'] = $_SERVER['HTTP_COOKIE'];
		
		if (is_array($_POST)) {
			$PostData = '';
			foreach ($_POST as $Key => $Value) {
				if ($Key == 'Password') {
					$PostData .= $Key . ' => ' . '********' . ";\n";
				} else {
					$PostData .= $Key . ' => ' . $Value . ";\n";
				}
			}
			$EventData['HttpPost'] = $PostData;
		} else {
			$EventData['HttpPost'] = serialize($_POST);
		}
		
		//$EventData['HttpPost'] = serialize($_POST);
		
		$EventData['GatewayInterface'] = $_SERVER['GATEWAY_INTERFACE'];
		$EventData['ServerProtocol'] = $_SERVER['SERVER_PROTOCOL'];
		$EventData['RequestMethod'] = $_SERVER['REQUEST_METHOD'];
		$EventData['QueryString'] = $_SERVER['QUERY_STRING'];
		
		$EventData['File'] = $File;
		//$EventData['FileName'] = $FileName;
		//$EventData['FileLocation'] = $FileLocation;
		
		$Redirect = NULL;
		$LoadFile = NULL;
		if ($File[strlen($File)-1] == "/") {
			$Redirect = 'http://' . $_SERVER['HTTP_HOST'] . '/' .  $File . $FileName;
			$LoadFile = $File . $FileName;
			setcookie ("FileTrackerStop", "STOP", time() + 5, '/');
		} else {
			$Redirect = 'http://' . $_SERVER['HTTP_HOST'] . '/' .  $File;
			$LoadFile = $File;
			setcookie ("FileTrackerStop", "STOP", time() + 5, '/');
		}
		
		$PageQuery = $_SERVER['QUERY_STRING']; 
		$PageQuery = explode('&', $PageQuery);
		foreach ($PageQuery as $Key => $Value) {
			if ($Value === 'File=' . $File) {
				unset($PageQuery[$Key]);
				break;
			}
		}
		$PageQuery = implode('&', $PageQuery);
		
		if ($PageQuery != NULL) {
			$Redirect .= '?' . $PageQuery;
			$LoadFile = '?' . $PageQuery;
		}
		
		$EventData['Redirect'] = $Redirect;
		
		$EventArray['EventData'] = $EventData;
		$DatabaseOptions = array();
		
		$Tier3Databases = new ProtectionLayer();
		$Tier3Databases->createDatabaseTable('FileTracker2014');
		$Tier3Databases->setDatabaseAll ($credentaillogonarray[0], $credentaillogonarray[1], $credentaillogonarray[2], $credentaillogonarray[3], NULL);
		$Tier3Databases->buildModules('ProtectionLayerModules', 'ProtectionLayerTables', 'ProtectionLayerModulesSettings');
		$Tier3Databases->setDatabaseAll ($servername, $username, $password, $databasename);
		
		$Tier3Databases->pass('FileTracker', 'PROTECT', array(), $PassArrayCreateFileTrackerTable);
		$Tier3Databases->pass('FileTracker', 'PROTECT', $EventArray, $PassArray);
		
		if ($NoRedirect != 'TRUE') {
			if ($_SERVER['REQUEST_METHOD'] === 'POST') {
				// MUST MAKE WORK WITH POST
				/*$CH = curl_init();
				
				curl_setopt($CH, CURLOPT_URL, $Redirect);
				curl_setopt($CH, CURLOPT_POST, count($_POST));
				curl_setopt($CH, CURLOPT_POSTFIELDS, $fields_string);
				
				$Results = curl_exec($CH);
				
				curl_close($CH);
				print_r($Results);
				*/
				//$Response = do_post_request($Redirect, http_build_query($_POST));
				//print_r($Response);
			} else {
				header("Location: $Redirect");
			}
		}
		
	} else {
		header("HTTP/1.0 404 Not Found");
	}
	
	/*function do_post_request($url, $data, $optional_headers = null) {
		$params = array('http' => array(
					 'method' => 'POST',
					 'content' => $data
				  ));
		if ($optional_headers !== null) {
		   $params['http']['header'] = $optional_headers;
		}
		$ctx = stream_context_create($params);
		$fp = fopen($url, 'rb', false, $ctx);
		if (!$fp) {
			throw new Exception("Problem with $url, $php_errormsg");
		}
		$response = @stream_get_contents($fp);
		if ($response === false) {
		   throw new Exception("Problem reading data from $url, $php_errormsg");
		}
		return $response;
	}*/

?>