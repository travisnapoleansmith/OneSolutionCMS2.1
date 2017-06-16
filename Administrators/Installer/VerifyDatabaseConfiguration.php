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
	
	
	$ServerName = $_POST['ServerName'];
	$Username = $_POST['Username'];
	$Password = $_POST['Password'];
	$DatabaseName = $_POST['DatabaseName'];
	
	if ($_COOKIE['SessionID']) {
		$SessionName = $_COOKIE['SessionID'];
		if ($SessionName) {
			session_name($SessionName);
			session_start();
			$_SESSION = array();
			if (ini_get('session.use_cookies')) {
				$params = session_get_cookie_params();
				setcookie(session_name(), '', time()-1000,
					$params['path'], $params['domain'],
					$params['secure'], $params['httponly']
				);
			}
			session_destroy();
		}
	}
	
	$SessionName = 'VerifyDatabaseConfiguration' . time();
	setcookie('SessionID', $SessionName, NULL, '/');
	session_name($SessionName);
	session_start();
	
	$_SESSION['ServerName'] = $ServerName;
	$_SESSION['Username'] = $Username;
	$_SESSION['Password'] = $Password;
	$_SESSION['DatabaseName'] = $DatabaseName;
	
	if ($ServerName != NULL & $Username != NULL & $Password != NULL & $DatabaseName != NULL) {
		if (TRUE === TRUE) {
			$_SESSION = array();
			if (ini_get('session.use_cookies')) {
				$params = session_get_cookie_params();
				setcookie(session_name(), '', time()-1000,
					$params['path'], $params['domain'],
					$params['secure'], $params['httponly']
				);
			}
			session_destroy();
			
			$Page = new XMLWriter();
			$Page->openMemory();
		
			$Page->setIndent(4);
			// STARTS HEADER
			$Page->startDTD('html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd"');
			$Page->endDTD();
		
			$Page->startElement('html');
			$Page->writeAttribute('lang', 'en-US');
			$Page->writeAttribute('xml:lang', 'en-US');
			$Page->writeAttribute('xmlns', 'http://www.w3.org/1999/xhtml');
		
			$Page->startElement('head');
		
			$Page->startElement('meta');
			$Page->writeAttribute('http-equiv', 'Content-Type');
			$Page->writeAttribute('content', 'text/html; charset=iso-8859-1');
			$Page->endElement(); //ENDS META
		
			$Page->startElement('title');
			$Page->text("One Solution CMS - Database Configuration");
			$Page->endElement(); //END TITLE
		
			$Page->endElement(); //Ends HEAD
			// ENDS HEADER
		
			// STARTS BODY
			$Page->startElement('body');
		
			$Page->startElement('h1');
			$Page->text('Welcome To One Solution CMS Verify Database Configuration Utility');
			$Page->endElement(); //ENDS H1
		
			$text = "The One Solution CMS System Database Configuration Utility is utility that is included as part of One Solution to verify\n";
			$text .= "     the database information needed for One Solution CMS to your server. The information has been verified.\n";
		
			$Page->startElement('p');
			$Page->text($text);
				$Page->startElement('ul');
					$Page->startElement('li');
						$Page->text('Step 1: Database Configuration - Completed!');
					$Page->endElement(); // End Li
					$Page->startElement('li');
						$Page->text('Step 2: Verify Database Configuration - Completed!');
					$Page->endElement(); // End Li
					$Page->startElement('li');
						$Page->text('Step 3: Write Database Information - You Are Here!');
					$Page->endElement(); // End Li
					$Page->startElement('li');
						$Page->text('Step 4: Upload Database Information');
					$Page->endElement(); // End Li
					$Page->startElement('li');
						$Page->text('Step 5: Configure System Settings');
					$Page->endElement(); // End Li
					$Page->startElement('li');
						$Page->text('Step 6: Create Administrators Account');
					$Page->endElement(); // End Li
					$Page->startElement('li');
						$Page->text('Step 7: Final Preparation');
					$Page->endElement(); // End Li
				$Page->endElement(); //End UL
			$Page->endElement(); //End P
			$Page->writeRaw("\n");
		
			/*$Page->startElement('form');
				$Page->writeAttribute('action', 'VerifyDatabaseConfiguration.php');
				$Page->writeAttribute('method', 'post');
		
				$Page->startElement('fieldset');
					$Page->startElement('legend');
						$Page->text('Database Configuration');
					$Page->endElement(); // END LEGEND
					$Page->startElement('div');
						$Page->startElement('label');
							$Page->text('Server Name');
						$Page->endElement(); // END LABEL
						$Page->startElement('input');
							$Page->writeAttribute('name', 'ServerName');
							$Page->writeAttribute('type', 'text');
							$Page->writeAttribute('size', '60');
							if ($_SESSION['ServerName'] != NULL) {
								$Page->writeAttribute('value', $_SESSION['ServerName']);
							}
						$Page->endElement(); // END INPUT
					$Page->endElement(); // END DIV
					$Page->startElement('div');
						$Page->startElement('label');
							$Page->text('Username');
						$Page->endElement(); // END LABEL
						$Page->startElement('input');
							$Page->writeAttribute('name', 'Username');
							$Page->writeAttribute('type', 'text');
							$Page->writeAttribute('size', '60');
							if ($_SESSION['Username'] != NULL) {
								$Page->writeAttribute('value', $_SESSION['Username']);
							}
						$Page->endElement(); // END INPUT
					$Page->endElement(); // END DIV
					$Page->startElement('div');
						$Page->startElement('label');
							$Page->text('Password');
						$Page->endElement(); // END LABEL
						$Page->startElement('input');
							$Page->writeAttribute('name', 'Password');
							$Page->writeAttribute('type', 'text');
							$Page->writeAttribute('size', '60');
							if ($_SESSION['Password'] != NULL) {
								$Page->writeAttribute('value', $_SESSION['Password']);
							}
						$Page->endElement(); // END INPUT
					$Page->endElement(); // END DIV
					$Page->startElement('div');
						$Page->startElement('label');
							$Page->text('Database Name');
						$Page->endElement(); // END LABEL
						$Page->startElement('input');
							$Page->writeAttribute('name', 'DatabaseName');
							$Page->writeAttribute('type', 'text');
							$Page->writeAttribute('size', '60');
							if ($_SESSION['DatabaseName'] != NULL) {
								$Page->writeAttribute('value', $_SESSION['DatabaseName']);
							}
						$Page->endElement(); // END INPUT
					$Page->endElement(); // END DIV
					$Page->startElement('div');
						$Page->startElement('button');
							$Page->writeAttribute('name', 'Submit');
							$Page->writeAttribute('type', 'submit');
							$Page->text('Step 2: Verify Database Configuration');
						$Page->endElement(); // END BUTTON
					$Page->endElement(); // END DIV
				$Page->endElement(); // END FIELDSET
			$Page->endElement(); // END FORM
			*/
			/*
			$Page->startElement('p');
				$Page->text('To start this process please select ');
				//$Page->startElement('a');
				//$Page->writeAttribute('href', 'UnzipFiles.php');
				$Page->text('Step 2: Verify Database Configuration');
				$Page->endElement(); //Ends A
			$Page->endElement(); //Ends P
			*/
			$Page->endElement(); //Ends BODY
			$Page->endElement(); //Ends HTML
		
			$pageoutput = $Page->flush();
			print $pageoutput;
		} else {
			header("Location: DatabaseConfiguration.php?SessionID=$SessionName");
			exit();
		}
	} else {
		header("Location: DatabaseConfiguration.php?SessionID=$SessionName");
		exit();
	}
	
?>