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

	// Fetch Current Page ID - Based on filename
	//$pagename = $_SERVER['PHP_SELF'];
	//$directory = dirname($_SERVER['PHP_SELF']);
	//$directory .= '/';
	//$pagename = str_replace($directory, ' ', $pagename);
	//$pagename = trim($pagename);
	//if ($pagename[0] == '/') {
		//$pagename[0] = '';
		//$pagename = trim($pagename);
	//}

	// Fetch Current Page ID - Based On ID Number
	$formidnumber = Array();
	$formidnumber['PageID'] = 1;
	$formidnumber['ObjectID'] = 1;

	if ($_GET['PageID']){
		$formidnumber['PageID'] = $_GET['PageID'];
	}

	$formdatabase = Array();
	$formdatabase['Form'] = 'Form';
	$formdatabase['FormButton'] = 'FormButton';
	$formdatabase['FormFieldSet'] = 'FormFieldSet';
	$formdatabase['FormInput'] = 'FormInput';
	$formdatabase['FormLabel'] = 'FormLabel';
	$formdatabase['FormLegend'] = 'FormLegend';
	$formdatabase['FormOption'] = 'FormOption';
	$formdatabase['FormOptGroup'] = 'FormOptGroup';
	$formdatabase['FormSelect'] = 'FormSelect';
	$formdatabase['FormTableListing'] = 'FormTableListing';
	$formdatabase['FormTextArea'] = 'FormTextArea';

	if ($_SESSION['POST']['Error']) {
		$errormessagearray = $_SESSION['POST']['Error'];
		reset($errormessagearray);
		while (current($errormessagearray)) {
			$Writer->startElement('p');
			$Writer->text(key($errormessagearray));
			$Writer->writeRaw(":\n   <br /> \n    ");
			$Writer->text(current($errormessagearray));
			$Writer->writeRaw("\n  ");
			$Writer->endElement();
			next ($errormessagearray);
		}

	}


	$databaseoptions = array();
	$databaseoptions['FormSession'] = $_SESSION['POST']['FilteredInput'];

	$credentaillogonarray = $GLOBALS['credentaillogonarray'];
	$Tier6Databases = $GLOBALS['Tier6Databases'];

	$form = new XhtmlForm($formdatabase, $databaseoptions, $Tier6Databases);
	$form->setDatabaseAll ($credentaillogonarray[0], $credentaillogonarray[1], $credentaillogonarray[2], $credentaillogonarray[3], 'Form');
	$form->setHttpUserAgent($_SERVER['HTTP_USER_AGENT']);
	$form->FetchDatabase ($formidnumber);
	$form->CreateOutput(NULL);

	//$output = $GLOBALS['Writer']->flush();
	//print "$output";
?>