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
	
	set_time_limit(120);
	
	$HOME = $_SERVER['SUBDOMAIN_DOCUMENT_ROOT'];
	$ADMINHOME = $HOME . '/Administrators/';
	$GLOBALS['HOME'] = $HOME;
	$GLOBALS['ADMINHOME'] = $ADMINHOME;
		
	// Includes all files
	//require_once ('Configuration/includes.php');
	
	require_once ("$ADMINHOME/Panel/Configuration/includes.php");
	
	$SubManager = $GLOBALS['SUBMANAGER'];
	
	$UserAccountsTableName = 'UserAccounts';
	$UserAccountsLogonHistoryTableName = 'UserAccountsLogonHistory';
	
	$Tier2Databases = new DataAccessLayer();
	$Tier2Databases->setDatabaseAll ($credentaillogonarray[0], $credentaillogonarray[1], $credentaillogonarray[2], $credentaillogonarray[3], NULL);
	$Tier2Databases->buildModules('DataAccessLayerModules', 'DataAccessLayerTables', 'DataAccessLayerModulesSettings');
	
	// User Details
	$UserDetailsLookup = array();
	$UserDetailsLookup['UserName'] = $_COOKIE['UserName'];

	$Tier2Databases->createDatabaseTable($UserAccountsTableName);
	$Tier2Databases->Connect($UserAccountsTableName);
	
	$Tier2Databases->pass ($UserAccountsTableName, 'setDatabaseRow', array('idnumber' => $UserDetailsLookup));
	$UserDetails = $Tier2Databases->pass ($UserAccountsTableName, "getMultiRowField", array());
	$Tier2Databases->Disconnect($UserAccountsTableName);
	
	// Logon History
	$UserDetailsLookup['LogonType'] = 'GoodLogonAttempt';
	
	$Tier2Databases->createDatabaseTable($UserAccountsLogonHistoryTableName);
	$Tier2Databases->Connect($UserAccountsLogonHistoryTableName);
			
	$Tier2Databases->pass ($UserAccountsLogonHistoryTableName, 'setOrderbyname', array('Name' => 'Timestamp'));
	$Tier2Databases->pass ($UserAccountsLogonHistoryTableName, 'setOrderbytype', array('Type' => 'DESC'));
	
	$Tier2Databases->pass ($UserAccountsLogonHistoryTableName, 'setDatabaseRow', array('idnumber' => $UserDetailsLookup));
	$UserLogonHistory = $Tier2Databases->pass ($UserAccountsLogonHistoryTableName, "getMultiRowField", array());
	
	$Tier2Databases->Disconnect($UserAccountsLogonHistoryTableName);
	
	unset($UserDetailsLookup['LogonType']);
	
	$UserName = $UserDetails[0]['UserName'];
	$LastLoggedInIPAddress = $UserLogonHistory[1]['IPAddress'];
	$LastLoggedDate = date('m-d-Y h:i:s A T', $UserLogonHistory[1]['Timestamp']);
	$ServerTime = date("m-d-Y h:i:s A T");
	$NumberNewMessages = 0;
	
	$Page->startElement('div');
	$Page->writeAttribute('id', 'UserDetails');
		$Page->startElement('ul');
		$Page->writeAttribute('id', 'UserDetailsMenu');
			$Page->startElement('li');
			
			$Text = 'Welcome ' . $UserName;
			$Page->text($Text);
			$Page->endElement(); //ENDS LI
			
			$Page->startElement('li');
				$Page->startElement('ul');
				$Page->writeAttribute('id', 'UserAccessControls');
					$Page->startElement('li');
					$Page->writeAttribute('class', 'First');
						$Page->startElement('a');
						if ($SubManager === TRUE) {
							$Page->writeAttribute('href', "../../../../Panel/Managers/UserManager/MyAccount.php?UserName=" . $UserName . '&Type=My_Account');
						} else {
							$Page->writeAttribute('href', "../../../Panel/Managers/UserManager/MyAccount.php?UserName=" . $UserName . '&Type=My_Account');
						}
						$Text = 'My Account';
						$Page->text($Text);
						$Page->endElement(); //ENDS A
					$Page->endElement(); //ENDS LI
					
					$Page->startElement('li');
					$Page->writeAttribute('class', 'Last');
						$Page->startElement('a');
						if ($SubManager === TRUE) {
							$Page->writeAttribute('href', "../../../../logoff.php");
						} else {
							$Page->writeAttribute('href', "../../../logoff.php");
						}
						$Text = 'Log Out';
						$Page->text($Text);
						$Page->endElement(); //ENDS A
					$Page->endElement(); //ENDS LI
				$Page->endElement(); //ENDS UL
			$Page->endElement(); //ENDS LI
			
			$Page->startElement('li');
				$Page->startElement('a');
				$Page->writeAttribute('class', 'UserDetailsNewMessages');
				if ($SubManager === TRUE) {
					$Page->writeAttribute('href', "../../../../Panel/Managers/UserManager/Messages.php?UserName=" . $UserName . '&Type=Messages');
				} else {
					$Page->writeAttribute('href', "../../../Panel/Managers/UserManager/Messages.php?UserName=" . $UserName . '&Type=Messages');
				}
				$Text = $NumberNewMessages . ' new messages';
				$Page->text($Text);
				$Page->endElement(); //ENDS A
			$Page->endElement(); //ENDS LI
		$Page->endElement(); //ENDS UL
		
		// SERVER DETAILS
		$Page->startElement('div');
		$Page->writeAttribute('id', 'ServerDetails');
			$Page->startElement('dl');
				$Page->startElement('dt');
				$Text = 'Server time :';
				$Page->text($Text);
				$Page->endElement(); //ENDS DT
				
				$Page->startElement('dd');
				$Text = $ServerTime;
				$Page->text($Text);
				$Page->endElement(); //ENDS DD
			$Page->endElement(); //ENDS DL
			
			$Page->startElement('dl');
				$Page->startElement('dt');
				$Text = 'Last Login IP :';
				$Page->text($Text);
				$Page->endElement(); //ENDS DT
				
				$Page->startElement('dd');
				$Text = $LastLoggedInIPAddress;
				$Page->text($Text);
				$Page->endElement(); //ENDS DD
			$Page->endElement(); //ENDS DL
			$Page->startElement('dl');
				$Page->startElement('dt');
				$Text = 'Last Login Date:';
				$Page->text($Text);
				$Page->endElement(); //ENDS DT
				
				$Page->startElement('dd');
				$Text = $LastLoggedDate;
				$Page->text($Text);
				$Page->endElement(); //ENDS DD
			$Page->endElement(); //ENDS DL
		$Page->endElement(); //ENDS DIV
	$Page->endElement(); //ENDS DIV
	
	/*$HeaderConfigurationFileName = '../../Configuration/Displays/Header/Settings.ini';
	if (file_exists($HeaderConfigurationFileName)) {
		$HeaderConfiguration = parse_ini_file($HeaderConfigurationFileName, true);
	} else {
		$HeaderConfiguration = NULL;
	}
	*/
?>