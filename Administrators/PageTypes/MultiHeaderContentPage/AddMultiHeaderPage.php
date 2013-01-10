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

	require_once ('Configuration/includes.php');
	$Options = $Tier6Databases->getLayerModuleSetting();
	$PageName = 'index.php?PageID=';

	if ($_POST['AddMultiHeaderPage']) {
		$PageName .= $_POST['AddMultiHeaderPage'];
	} else {
		$_POST['AddMultiHeaderPage'] = $Options['XhtmlContent']['content']['AddMultiHeaderPage']['SettingAttribute'];
		$PageName .= $_POST['AddMultiHeaderPage'];
	}

	$hold = $Tier6Databases->FormSubmitValidate('AddMultiHeaderPage', $PageName);

	if ($hold) {
		$sessionname = $Tier6Databases->SessionStart('CreateMultiHeaderPage');

		$DateTime = date('Y-m-d H:i:s');
		$Date = date('Y-m-d');
		$SiteName = $GLOBALS['sitename'];

		$LastPageID = $Tier6Databases->ModulePass('XhtmlContent', 'content', 'getLastContentPageID', array());
		if (isset($LastPageID)) {
			$NewPageID = ++$LastPageID;
		} else {
			$NewPageID = 1;
		}

		$LastMultiHeaderPage = $Options['XhtmlContent']['content']['LastMultiHeaderPage']['SettingAttribute'];
		$NewMultiHeaderPage = ++$LastMultiHeaderPage;
		$Tier6Databases->updateModuleSetting('XhtmlContent', 'content', 'LastMultiHeaderPage', $NewMultiHeaderPage);

		$NewPage = '../index.php?PageID=';
		$NewPage .= $NewPageID;

		$Location = 'index.php?PageID=';
		$Location .= $NewPageID;

		$_SESSION['POST']['Error']['Link'] = '<a href=\'';
		$_SESSION['POST']['Error']['Link'] .= $NewPage;
		$_SESSION['POST']['Error']['Link'] .= '\'>New MultiHeader Page</a>';


		$temp = $Tier6Databases->PostCheck ('Heading', 'FilteredInput', $hold);
		if (!is_null($temp)) {
			$hold = $temp;
		}

		$temp = $Tier6Databases->PostCheck ('TopText', 'FilteredInput', $hold);
		if (!is_null($temp)) {
			$hold = $temp;
		}

		$temp = $Tier6Databases->PostCheck ('BottomText', 'FilteredInput', $hold);
		if (!is_null($temp)) {
			$hold = $temp;
		}

		$temp = $Tier6Databases->PostCheck ('FooterHeading', 'FilteredInput', $hold);
		if (!is_null($temp)) {
			$hold = $temp;
		}

		$temp = $Tier6Databases->PostCheck ('MenuName', 'FilteredInput', $hold);
		if (!is_null($temp)) {
			$hold = $temp;
		}

		$temp = $Tier6Databases->PostCheck ('MenuTitle', 'FilteredInput', $hold);
		if (!is_null($temp)) {
			$hold = $temp;
		}

		$temp = $Tier6Databases->MultiPostCheck('MultiHeader', 1, $hold, NULL, NULL, 'Order');
		if ($temp != NULL) {
			$hold = $temp;
		}

		$temp = $Tier6Databases->MultiPostCheck('MultiHeader', 1, $hold, NULL, NULL, 'BlockquoteOrder', 1);
		if ($temp != NULL) {
			$hold = $temp;
		}

		$temp = $Tier6Databases->MultiPostCheck('MultiHeader', 1, $hold, NULL, NULL, 'Blockquote', 1);
		if ($temp != NULL) {
			$hold = $temp;
		}

		$temp = $Tier6Databases->MultiPostCheck('MultiHeader', 1, $hold, NULL, NULL, 'BlockquoteBottomText', 1);
		if ($temp != NULL) {
			$hold = $temp;
		}

		$temp = $Tier6Databases->MultiPostCheck('MultiHeader', 1, $hold, NULL, NULL, 'BlockquoteTopText', 1);
		if ($temp != NULL) {
			$hold = $temp;
		}

		$temp = $Tier6Databases->MultiPostCheck('MultiHeader', 1, $hold, NULL, NULL, 'Header');
		if ($temp != NULL) {
			$hold = $temp;
		}

		$temp = $Tier6Databases->MultiPostCheck('MultiHeader', 1, $hold, NULL, NULL, 'ParagraphContent');
		if ($temp != NULL) {
			$hold = $temp;
		}

		// General Defines
		define(NewPageID, $NewPageID);
		define(CurrentVersionTrueFalse, 'true');
		define(ContentPageType, 'MultiHeaderContentPage');

		define(ContentPageMenuName, $hold['FilteredInput']['MenuName']);
		define(ContentPageMenuTitle, $hold['FilteredInput']['MenuTitle']);

		define(UserAccessGroup, 'Guest');
		define(Owner, $_COOKIE['UserName']);
		define(Creator, $_COOKIE['UserName']);
		define(LastChangeUser, $_COOKIE['UserName']);
		define(CreationDateTime, $DateTime);
		define(LastChangeDateTime, $DateTime);

		define(PublishDate, NULL);
		define(UnpublishDate, NULL);

		define(EnableDisable, $_POST['EnableDisable']);
		define(Status, $_POST['Status']);

		// XmlSitemap Defines
		define(Loc, $Location);
		define(Lastmod, $Date);
		define(ChangeFreq, $_POST['Frequency']);
		define(Priority, $_POST['Priority']);

		// XhtmlHeader Defines
		define(PageTitle, $hold['FilteredInput']['PageTitle']);
		define(PageIcon, 'favicon.ico');
		define(RSS, 'rss.php');
		define(Keywords, $hold['FilteredInput']['Keywords']);
		define(Description, $hold['FilteredInput']['Description']);

		// HeaderPanel1 Defines
		define (SiteName, $GLOBALS['sitename']);
		define (Header, $hold['FilteredInput']['Header']);

		$Start = array();
		$Start ['Blockquote1'] = 'Blockquote1';
		$Start ['Blockquote2'] = 'Blockquote2';
		$Start ['Blockquote3'] = 'Blockquote3';
		$Start ['Blockquote4'] = 'Blockquote4';
		$Start ['Blockquote5'] = 'Blockquote5';
		$Start ['BlockquoteBottomText1'] = 'BlockquoteBottomText1';
		$Start ['BlockquoteBottomText2'] = 'BlockquoteBottomText2';
		$Start ['BlockquoteBottomText3'] = 'BlockquoteBottomText3';
		$Start ['BlockquoteBottomText4'] = 'BlockquoteBottomText4';
		$Start ['BlockquoteBottomText5'] = 'BlockquoteBottomText5';
		$Start ['BlockquoteTopText1'] = 'BlockquoteTopText1';
		$Start ['BlockquoteTopText2'] = 'BlockquoteTopText2';
		$Start ['BlockquoteTopText3'] = 'BlockquoteTopText3';
		$Start ['BlockquoteTopText4'] = 'BlockquoteTopText4';
		$Start ['BlockquoteTopText5'] = 'BlockquoteTopText5';
		$Start ['BlockquoteOrder1'] = 'BlockquoteOrder1';
		$Start ['BlockquoteOrder2'] = 'BlockquoteOrder2';
		$Start ['BlockquoteOrder3'] = 'BlockquoteOrder3';
		$Start ['BlockquoteOrder4'] = 'BlockquoteOrder4';
		$Start ['BlockquoteOrder5'] = 'BlockquoteOrder5';
		$Start ['Header'] = 'Header';
		$Start ['ParagraphContent'] = 'ParagraphContent';
		$Start ['Order'] = 'Order';

		$StartKey = 'MultiHeader';
		$ConditionKey = 'HeaderHidden';
		$StartNumber = 1;
		$Sort = 'Order';
		$temp = $Tier6Databases->MultiArrayBuild($Start, $StartKey, $ConditionKey, $StartNumber, $hold['FilteredInput'], $Sort);


		for ($i = 1; isset($temp[$i]); $i++) {
			$Start = array();
			$Start['BlockquoteTopText'] = 'BlockquoteTopText';
			$Start['Blockquote'] = 'Blockquote';
			$Start['BlockquoteBottomText'] = 'BlockquoteBottomText';
			$Start['BlockquoteOrder'] = 'BlockquoteOrder';

			$StartKey = "MultiHeader$i";
			$ConditionKey = 'Blockquote';
			$StartNumber = 1;
			$Sort = 'BlockquoteOrder';
			$temp[$i] = $Tier6Databases->MultiArrayBuild($Start, $StartKey, $ConditionKey, $StartNumber, $temp[$i], $Sort, TRUE);
		}

		$hold['FilteredInput'] = $temp;
		unset($temp);
		unset($Start);
		unset($StartKey);
		unset($ConditionKey);
		unset($StartNumber);
		unset($Sort);

		$Content = array();

		$PageID = array();
		$PageID['PageID'] = $NewPageID;

		$Content[0]['PageID'] = $NewPageID;
		$Content[0]['ObjectID'] = 0;
		$Content[0]['ContainerObjectType'] = 'XhtmlContent';
		$Content[0]['ContainerObjectName'] = 'content';
		$Content[0]['ContainerObjectID'] = 1;
		$Content[0]['ContainerObjectPrintPreview'] = 'true';
		$Content[0]['RevisionID'] = 0;
		$Content[0]['CurrentVersion'] = 'true';
		$Content[0]['Empty'] = 'false';
		$Content[0]['StartTag'] = '<div>';
		$Content[0]['EndTag'] = NULL;
		$Content[0]['StartTagID'] = 'main-content-middle';
		$Content[0]['StartTagStyle'] = NULL;
		$Content[0]['StartTagClass'] = NULL;

		if ($hold['FilteredInput']['Heading']) {
			$Content[0]['Heading'] = $hold['FilteredInput']['Heading'];
			$Content[0]['HeadingStartTag'] = '<h2>';
			$Content[0]['HeadingEndTag'] = '</h2>';
		} else {
			$Content[0]['Heading'] = NULL;
			$Content[0]['HeadingStartTag'] = NULL;
			$Content[0]['HeadingEndTag'] = NULL;
		}

		$Content[0]['HeadingStartTagID'] = NULL;
		$Content[0]['HeadingStartTagStyle'] = NULL;
		$Content[0]['HeadingStartTagClass'] = 'BodyHeading';
		$Content[0]['Content'] = $hold['FilteredInput']['TopText'];

		if ($hold['FilteredInput']['TopText'] != NULL) {
			$Content[0]['ContentStartTag'] = '<p>';
			$Content[0]['ContentEndTag'] = '</p>';
		} else {
			$Content[0]['ContentStartTag'] = NULL;
			$Content[0]['ContentEndTag'] = NULL;
		}

		$Content[0]['ContentStartTagID'] = NULL;
		$Content[0]['ContentStartTagStyle'] = NULL;
		$Content[0]['ContentStartTagClass'] = 'BodyText';
		$Content[0]['ContentPTagID'] = NULL;
		$Content[0]['ContentPTagStyle'] = NULL;
		$Content[0]['ContentPTagClass'] = 'BodyText';
		$Content[0]['Enable/Disable'] = $_POST['EnableDisable'];
		$Content[0]['Status'] = $_POST['Status'];

		$j = 2;
		$k = 1;
		$l = 1;
		$i = 1;
		for ($m = 1; isset($hold['FilteredInput'][$m]); $m++) {
			$MultiHeaderHeaderName = NULL;
			$MultiHeaderParagraphContentName = NULL;
			$MultiHeaderBlockquoteTopTextName = NULL;
			$MultiHeaderBlockquoteName = NULL;
			$MultiHeaderBlockquoteBottomTextName = NULL;

			$MultiHeaderHeaderName = 'MultiHeader';
			$MultiHeaderHeaderName .= $k;
			$MultiHeaderHeaderName .= 'Header';

			$MultiHeaderParagraphContentName = 'MultiHeader';
			$MultiHeaderParagraphContentName .= $k;
			$MultiHeaderParagraphContentName .= 'ParagraphContent';

			$MultiHeaderBlockquoteTopTextName = 'MultiHeader';
			$MultiHeaderBlockquoteTopTextName .= $k;
			$MultiHeaderBlockquoteTopTextName .= 'BlockquoteTopText';
			$MultiHeaderBlockquoteTopTextName .= $l;

			$MultiHeaderBlockquoteName = 'MultiHeader';
			$MultiHeaderBlockquoteName .= $k;
			$MultiHeaderBlockquoteName .= 'Blockquote';
			$MultiHeaderBlockquoteName .= $l;

			$MultiHeaderBlockquoteBottomTextName = 'MultiHeader';
			$MultiHeaderBlockquoteBottomTextName .= $k;
			$MultiHeaderBlockquoteBottomTextName .= 'BlockquoteBottomText';
			$MultiHeaderBlockquoteBottomTextName .= $l;

			$Content[$i]['PageID'] = $NewPageID;
			$Content[$i]['ObjectID'] = $i;
			$Content[$i]['ContainerObjectType'] = 'XhtmlContent';
			$Content[$i]['ContainerObjectName'] = 'content';
			$Content[$i]['ContainerObjectID'] = $j;
			$Content[$i]['ContainerObjectPrintPreview'] = 'true';
			$Content[$i]['RevisionID'] = 0;
			$Content[$i]['CurrentVersion'] = 'true';
			$Content[$i]['Empty'] = 'false';
			$Content[$i]['StartTag'] = NULL;
			$Content[$i]['EndTag'] = NULL;
			$Content[$i]['StartTagID'] = NULL;
			$Content[$i]['StartTagStyle'] = NULL;
			$Content[$i]['StartTagClass'] = NULL;

			if ($hold['FilteredInput'][$m][$MultiHeaderHeaderName]) {
				$Content[$i]['Heading'] = $hold['FilteredInput'][$m][$MultiHeaderHeaderName];
				$Content[$i]['HeadingStartTag'] = '<h2>';
				$Content[$i]['HeadingEndTag'] = '</h2>';
				$Content[$i]['HeadingStartTagID'] = NULL;
				$Content[$i]['HeadingStartTagStyle'] = NULL;
				$Content[$i]['HeadingStartTagClass'] = 'BodyHeading';
			} else {
				$Content[$i]['Heading'] = NULL;
				$Content[$i]['HeadingStartTag'] = NULL;
				$Content[$i]['HeadingEndTag'] = NULL;
				$Content[$i]['HeadingStartTagID'] = NULL;
				$Content[$i]['HeadingStartTagStyle'] = NULL;
				$Content[$i]['HeadingStartTagClass'] = NULL;
			}
			if ($hold['FilteredInput'][$m][$MultiHeaderParagraphContentName] != NULL & ($hold['FilteredInput'][$m][$MultiHeaderBlockquoteTopTextName] != NULL | $hold['FilteredInput'][$m][$MultiHeaderBlockquoteName] != NULL | $hold['FilteredInput'][$m][$MultiHeaderBlockquoteBottomTextName] != NULL)) {
				$temp = $Tier6Databases->MultiArrayCombine(1, $hold['FilteredInput']);
				if ($temp) {
					$hold['FilteredInput'] = $temp;
				}
				unset($_SESSION['POST']['Error']['Link']);
				$name = 'MultiHeader ';
				$name .= $k;
				$_SESSION['POST']['Error'][$name] = 'Paragraph Content and Blockquote Content <br />';
				$_SESSION['POST']['Error'][$name] .= 'CANNOT BE BOTH FILLED IN! <br />';
				$_SESSION['POST']['Error'][$name] .= 'Please correct this error and try again.';

				$_SESSION['POST'] = $_SESSION['POST'] + $hold;
				header("Location: $PageName&SessionID=$sessionname");
				exit;
			} else if (!isset($hold['FilteredInput'][$m][$MultiHeaderBlockquoteName]) & ($hold['FilteredInput'][$m][$MultiHeaderBlockquoteTopTextName]!= NULL | $hold['FilteredInput'][$m][$MultiHeaderBlockquoteBottomTextName] != NULL)) {
				$temp = $Tier6Databases->MultiArrayCombine(1, $hold['FilteredInput']);
				if ($temp) {
					$hold['FilteredInput'] = $temp;
				}
				unset($_SESSION['POST']['Error']['Link']);
				$name = 'MultiHeader ';
				$name .= $k;
				$_SESSION['POST']['Error'][$name] = 'Top Text or Bottom Text are filled in so <br />';
				$_SESSION['POST']['Error'][$name] .= 'Blockquote Content <br />';
				$_SESSION['POST']['Error'][$name] .= 'CANNOT BE NULL! <br />';
				$_SESSION['POST']['Error'][$name] .= 'Please correct this error and try again.';

				$_SESSION['POST'] = $_SESSION['POST'] + $hold;
				header("Location: $PageName&SessionID=$sessionname");

				exit;
			} else {
				$flag = FALSE;
				if ($hold['FilteredInput'][$m][$MultiHeaderParagraphContentName]) {
					$Content[$i]['Content'] = $hold['FilteredInput'][$m][$MultiHeaderParagraphContentName];
					$Content[$i]['ContentStartTag'] = '<p>';
					$Content[$i]['ContentEndTag'] = '</p>';
					$Content[$i]['ContentStartTagID'] = NULL;
					$Content[$i]['ContentStartTagStyle'] = NULL;
					$Content[$i]['ContentStartTagClass'] = 'BodyText';
					$Content[$i]['ContentPTagID'] = NULL;
					$Content[$i]['ContentPTagStyle'] = NULL;
					$Content[$i]['ContentPTagClass'] = 'BodyText';
				} else if ($hold['FilteredInput'][$m][$l][$MultiHeaderBlockquoteTopTextName] | $hold['FilteredInput'][$m][$l][$MultiHeaderBlockquoteName] | $hold['FilteredInput'][$m][$l][$MultiHeaderBlockquoteBottomTextName]) {
					$l = 1;
					if ($hold['FilteredInput'][$m][$l][$MultiHeaderBlockquoteTopTextName]) {
						$Content[$i]['Content'] = $hold['FilteredInput'][$m][$l][$MultiHeaderBlockquoteTopTextName];
						$Content[$i]['ContentStartTag'] = '<p>';
						$Content[$i]['ContentEndTag'] = '</p>';
						$Content[$i]['ContentStartTagID'] = NULL;
						$Content[$i]['ContentStartTagStyle'] = NULL;
						$Content[$i]['ContentStartTagClass'] = 'BodyText';
						$Content[$i]['ContentPTagID'] = NULL;
						$Content[$i]['ContentPTagStyle'] = NULL;
						$Content[$i]['ContentPTagClass'] = 'BodyText';
						$Content[$i]['Enable/Disable'] = $_POST['EnableDisable'];
						$Content[$i]['Status'] = $_POST['Status'];
						$flag = TRUE;

					} else if ($hold['FilteredInput'][$m][$l][$MultiHeaderBlockquoteName]) {
						$Content[$i]['Content'] = $hold['FilteredInput'][$m][$l][$MultiHeaderBlockquoteName];
						$Content[$i]['ContentStartTag'] = '<blockquote>';
						$Content[$i]['ContentEndTag'] = '</blockquote>';
						$Content[$i]['ContentStartTagID'] = NULL;
						$Content[$i]['ContentStartTagStyle'] = NULL;
						$Content[$i]['ContentStartTagClass'] = 'BodyText';
						$Content[$i]['ContentPTagID'] = NULL;
						$Content[$i]['ContentPTagStyle'] = NULL;
						$Content[$i]['ContentPTagClass'] = 'BodyText';
						$Content[$i]['Enable/Disable'] = $_POST['EnableDisable'];
						$Content[$i]['Status'] = $_POST['Status'];

					} else {
						$Content[$i]['Enable/Disable'] = $_POST['EnableDisable'];
						$Content[$i]['Status'] = $_POST['Status'];

					}

					$j++;
					$i++;
					for ($l = 1; isset($hold['FilteredInput'][$m][$l]); $l++) {
						$MultiHeaderBlockquoteTopTextName = 'MultiHeader';
						$MultiHeaderBlockquoteTopTextName .= $k;
						$MultiHeaderBlockquoteTopTextName .= 'BlockquoteTopText';
						$MultiHeaderBlockquoteTopTextName .= $l;

						$MultiHeaderBlockquoteName = 'MultiHeader';
						$MultiHeaderBlockquoteName .= $k;
						$MultiHeaderBlockquoteName .= 'Blockquote';
						$MultiHeaderBlockquoteName .= $l;

						$MultiHeaderBlockquoteBottomTextName = 'MultiHeader';
						$MultiHeaderBlockquoteBottomTextName .= $k;
						$MultiHeaderBlockquoteBottomTextName .= 'BlockquoteBottomText';
						$MultiHeaderBlockquoteBottomTextName .= $l;

						if ($flag == FALSE) {
							$Content[$i]['PageID'] = $NewPageID;
							$Content[$i]['ObjectID'] = $i;
							$Content[$i]['ContainerObjectType'] = 'XhtmlContent';
							$Content[$i]['ContainerObjectName'] = 'content';
							$Content[$i]['ContainerObjectID'] = $j;
							$Content[$i]['ContainerObjectPrintPreview'] = 'true';
							$Content[$i]['RevisionID'] = 0;
							$Content[$i]['CurrentVersion'] = 'true';
							$Content[$i]['Empty'] = 'false';
							$Content[$i]['StartTag'] = NULL;
							$Content[$i]['EndTag'] = NULL;
							$Content[$i]['StartTagID'] = NULL;
							$Content[$i]['StartTagStyle'] = NULL;
							$Content[$i]['StartTagClass'] = NULL;

							$Content[$i]['Heading'] = NULL;
							$Content[$i]['HeadingStartTag'] = '<h2>';
							$Content[$i]['HeadingEndTag'] = '</h2>';
							$Content[$i]['HeadingStartTagID'] = NULL;
							$Content[$i]['HeadingStartTagStyle'] = NULL;
							$Content[$i]['HeadingStartTagClass'] = 'BodyHeading';
						}

						if ($hold['FilteredInput'][$m][$l][$MultiHeaderBlockquoteTopTextName]) {
							if ($flag == FALSE) {
								$Content[$i]['Content'] = $hold['FilteredInput'][$m][$l][$MultiHeaderBlockquoteTopTextName];
								$Content[$i]['ContentStartTag'] = '<p>';
								$Content[$i]['ContentEndTag'] = '</p>';
								$Content[$i]['ContentStartTagID'] = NULL;
								$Content[$i]['ContentStartTagStyle'] = NULL;
								$Content[$i]['ContentStartTagClass'] = 'BodyText';
								$Content[$i]['ContentPTagID'] = NULL;
								$Content[$i]['ContentPTagStyle'] = NULL;
								$Content[$i]['ContentPTagClass'] = 'BodyText';

								$Content[$i]['Enable/Disable'] = $_POST['EnableDisable'];
								$Content[$i]['Status'] = $_POST['Status'];
							}
						}

						if ($hold['FilteredInput'][$m][$l][$MultiHeaderBlockquoteName]) {
							if ($hold['FilteredInput'][$m][$l][$MultiHeaderBlockquoteTopTextName]) {
								if ($flag == FALSE) {
									$i++;
									$j++;
								}
								$Content[$i]['PageID'] = $NewPageID;
								$Content[$i]['ObjectID'] = $i;
								$Content[$i]['ContainerObjectType'] = 'XhtmlContent';
								$Content[$i]['ContainerObjectName'] = 'content';
								$Content[$i]['ContainerObjectID'] = $j;
								$Content[$i]['ContainerObjectPrintPreview'] = 'true';
								$Content[$i]['RevisionID'] = 0;
								$Content[$i]['CurrentVersion'] = 'true';
								$Content[$i]['Empty'] = 'false';
								$Content[$i]['StartTag'] = NULL;
								$Content[$i]['EndTag'] = NULL;
								$Content[$i]['StartTagID'] = NULL;
								$Content[$i]['StartTagStyle'] = NULL;
								$Content[$i]['StartTagClass'] = NULL;

								$Content[$i]['Heading'] = NULL;
								$Content[$i]['HeadingStartTag'] = '<h2>';
								$Content[$i]['HeadingEndTag'] = '</h2>';
								$Content[$i]['HeadingStartTagID'] = NULL;
								$Content[$i]['HeadingStartTagStyle'] = NULL;
								$Content[$i]['HeadingStartTagClass'] = 'BodyHeading';

								$Content[$i]['Content'] = $hold['FilteredInput'][$m][$l][$MultiHeaderBlockquoteName];
								$Content[$i]['ContentStartTag'] = '<blockquote>';
								$Content[$i]['ContentEndTag'] = '</blockquote>';
								$Content[$i]['ContentStartTagID'] = NULL;
								$Content[$i]['ContentStartTagStyle'] = NULL;
								$Content[$i]['ContentStartTagClass'] = 'BodyText';
								$Content[$i]['ContentPTagID'] = NULL;
								$Content[$i]['ContentPTagStyle'] = NULL;
								$Content[$i]['ContentPTagClass'] = 'BodyText';

								$Content[$i]['Enable/Disable'] = $_POST['EnableDisable'];
								$Content[$i]['Status'] = $_POST['Status'];

							} else {
								$Content[$i]['Content'] = $hold['FilteredInput'][$m][$l][$MultiHeaderBlockquoteName];
								$Content[$i]['ContentStartTag'] = '<blockquote>';
								$Content[$i]['ContentEndTag'] = '</blockquote>';
								$Content[$i]['ContentStartTagID'] = NULL;
								$Content[$i]['ContentStartTagStyle'] = NULL;
								$Content[$i]['ContentStartTagClass'] = 'BodyText';
								$Content[$i]['ContentPTagID'] = NULL;
								$Content[$i]['ContentPTagStyle'] = NULL;
								$Content[$i]['ContentPTagClass'] = 'BodyText';

								$Content[$i]['Enable/Disable'] = $_POST['EnableDisable'];
								$Content[$i]['Status'] = $_POST['Status'];
							}
						}

						if ($hold['FilteredInput'][$m][$l][$MultiHeaderBlockquoteBottomTextName]) {
							if ($hold['FilteredInput'][$m][$l][$MultiHeaderBlockquoteTopTextName] & $hold['FilteredInput'][$m][$l][$MultiHeaderBlockquoteName]) {
								$i++;
								$j++;

								$Content[$i]['PageID'] = $NewPageID;
								$Content[$i]['ObjectID'] = $i;
								$Content[$i]['ContainerObjectType'] = 'XhtmlContent';
								$Content[$i]['ContainerObjectName'] = 'content';
								$Content[$i]['ContainerObjectID'] = $j;
								$Content[$i]['ContainerObjectPrintPreview'] = 'true';
								$Content[$i]['RevisionID'] = 0;
								$Content[$i]['CurrentVersion'] = 'true';
								$Content[$i]['Empty'] = 'false';
								$Content[$i]['StartTag'] = NULL;
								$Content[$i]['EndTag'] = NULL;
								$Content[$i]['StartTagID'] = NULL;
								$Content[$i]['StartTagStyle'] = NULL;
								$Content[$i]['StartTagClass'] = NULL;

								$Content[$i]['Heading'] = NULL;
								$Content[$i]['HeadingStartTag'] = '<h2>';
								$Content[$i]['HeadingEndTag'] = '</h2>';
								$Content[$i]['HeadingStartTagID'] = NULL;
								$Content[$i]['HeadingStartTagStyle'] = NULL;
								$Content[$i]['HeadingStartTagClass'] = 'BodyHeading';

								$Content[$i]['Content'] = $hold['FilteredInput'][$m][$l][$MultiHeaderBlockquoteBottomTextName];
								$Content[$i]['ContentStartTag'] = '<p>';
								$Content[$i]['ContentEndTag'] = '</p>';
								$Content[$i]['ContentStartTagID'] = NULL;
								$Content[$i]['ContentStartTagStyle'] = NULL;
								$Content[$i]['ContentStartTagClass'] = 'BodyText';
								$Content[$i]['ContentPTagID'] = NULL;
								$Content[$i]['ContentPTagStyle'] = NULL;
								$Content[$i]['ContentPTagClass'] = 'BodyText';

								$Content[$i]['Enable/Disable'] = $_POST['EnableDisable'];
								$Content[$i]['Status'] = $_POST['Status'];
							} else if ($hold['FilteredInput'][$m][$l][$MultiHeaderBlockquoteTopTextName]){
								$i++;
								$j++;
							} else if ($hold['FilteredInput'][$m][$l][$MultiHeaderBlockquoteName]) {
								$i++;
								$j++;

								$Content[$i]['PageID'] = $NewPageID;
								$Content[$i]['ObjectID'] = $i;
								$Content[$i]['ContainerObjectType'] = 'XhtmlContent';
								$Content[$i]['ContainerObjectName'] = 'content';
								$Content[$i]['ContainerObjectID'] = $j;
								$Content[$i]['ContainerObjectPrintPreview'] = 'true';
								$Content[$i]['RevisionID'] = 0;
								$Content[$i]['CurrentVersion'] = 'true';
								$Content[$i]['Empty'] = 'false';
								$Content[$i]['StartTag'] = NULL;
								$Content[$i]['EndTag'] = NULL;
								$Content[$i]['StartTagID'] = NULL;
								$Content[$i]['StartTagStyle'] = NULL;
								$Content[$i]['StartTagClass'] = NULL;

								$Content[$i]['Heading'] = NULL;
								$Content[$i]['HeadingStartTag'] = '<h2>';
								$Content[$i]['HeadingEndTag'] = '</h2>';
								$Content[$i]['HeadingStartTagID'] = NULL;
								$Content[$i]['HeadingStartTagStyle'] = NULL;
								$Content[$i]['HeadingStartTagClass'] = 'BodyHeading';

								$Content[$i]['Content'] = $hold['FilteredInput'][$m][$l][$MultiHeaderBlockquoteBottomTextName];
								$Content[$i]['ContentStartTag'] = '<p>';
								$Content[$i]['ContentEndTag'] = '</p>';
								$Content[$i]['ContentStartTagID'] = NULL;
								$Content[$i]['ContentStartTagStyle'] = NULL;
								$Content[$i]['ContentStartTagClass'] = 'BodyText';
								$Content[$i]['ContentPTagID'] = NULL;
								$Content[$i]['ContentPTagStyle'] = NULL;
								$Content[$i]['ContentPTagClass'] = 'BodyText';

								$Content[$i]['Enable/Disable'] = $_POST['EnableDisable'];
								$Content[$i]['Status'] = $_POST['Status'];
							}
						}
						$j++;
						$i++;
						$flag = FALSE;
					}

					if (!isset($hold['FilteredInput'][$m][$l])) {
						$i--;
					}
				} else {
					$Content[$i]['Content'] = $hold['FilteredInput'][$m][$l][$MultiHeaderBlockquoteName];
					$Content[$i]['ContentStartTag'] = '<blockquote>';
					$Content[$i]['ContentEndTag'] = '</blockquote>';
					$Content[$i]['ContentStartTagID'] = NULL;
					$Content[$i]['ContentStartTagStyle'] = NULL;
					$Content[$i]['ContentStartTagClass'] = 'BodyText';
					$Content[$i]['ContentPTagID'] = NULL;
					$Content[$i]['ContentPTagStyle'] = NULL;
					$Content[$i]['ContentPTagClass'] = 'BodyText';

					$Content[$i]['Enable/Disable'] = $_POST['EnableDisable'];
					$Content[$i]['Status'] = $_POST['Status'];

				}

				if ($hold['FilteredInput'][$m][$MultiHeaderParagraphContentName]) {
					$Content[$i]['Enable/Disable'] = $_POST['EnableDisable'];
					$Content[$i]['Status'] = $_POST['Status'];
					$j++;
				}
			}
			$i++;
			$k++;
			$l = 1;
		}

		$Content[$i]['PageID'] = $NewPageID;
		$Content[$i]['ObjectID'] = $i;
		$Content[$i]['ContainerObjectType'] = 'XhtmlContent';
		$Content[$i]['ContainerObjectName'] = 'content';
		$Content[$i]['ContainerObjectID'] = $j;
		$Content[$i]['ContainerObjectPrintPreview'] = 'true';
		$Content[$i]['RevisionID'] = 0;
		$Content[$i]['CurrentVersion'] = 'true';
		$Content[$i]['Empty'] = 'false';
		$Content[$i]['StartTag'] = NULL;
		$Content[$i]['EndTag'] = '</div>';
		$Content[$i]['StartTagID'] = NULL;
		$Content[$i]['StartTagStyle'] = NULL;
		$Content[$i]['StartTagClass'] = NULL;
		$Content[$i]['Heading'] = NULL;
		$Content[$i]['HeadingStartTag'] = NULL;
		$Content[$i]['HeadingEndTag'] = NULL;
		$Content[$i]['HeadingStartTagID'] = NULL;
		$Content[$i]['HeadingStartTagStyle'] = NULL;
		$Content[$i]['HeadingStartTagClass'] = NULL;
		$Content[$i]['Content'] = NULL;
		$Content[$i]['ContentStartTag'] = '<p>';
		$Content[$i]['ContentEndTag'] = '</p>';
		$Content[$i]['ContentStartTagID'] = NULL;
		$Content[$i]['ContentStartTagStyle'] = NULL;
		$Content[$i]['ContentStartTagClass'] = 'BodyText';
		$Content[$i]['ContentPTagID'] = NULL;
		$Content[$i]['ContentPTagStyle'] = NULL;
		$Content[$i]['ContentPTagClass'] = 'BodyText';
		$Content[$i]['Enable/Disable'] = $_POST['EnableDisable'];
		$Content[$i]['Status'] = $_POST['Status'];

		//print_r($hold['FilteredInput']);

		$Header = parse_ini_file('ModuleSettings/Tier6-ContentLayer/Modules/XhtmlHeader/AddXhtmlHeader.ini',FALSE);
		$Header = $Tier6Databases->EmptyStringToNullArray($Header);

		/*
		$HeaderPanel1 = array();
		$HeaderPanel1[0]['PageID'] = $NewPageID;
		$HeaderPanel1[0]['ObjectID'] = 1;
		$HeaderPanel1[0]['StartTag'] = NULL;
		$HeaderPanel1[0]['EndTag'] = NULL;
		$HeaderPanel1[0]['StartTagID'] = NULL;
		$HeaderPanel1[0]['StartTagStyle'] = NULL;
		$HeaderPanel1[0]['StartTagClass'] = NULL;
		$HeaderPanel1[0]['Div'] = NULL;
		$HeaderPanel1[0]['DivID'] = 'header-sitename';
		$HeaderPanel1[0]['DivClass'] = NULL;
		$HeaderPanel1[0]['DivStyle'] = NULL;
		$HeaderPanel1[0]['Div1'] = "<h1 class=\"MainHeading\">$SiteName</h1>";
		$HeaderPanel1[0]['Div1Title'] = NULL;
		$HeaderPanel1[0]['Div1ID'] = NULL;
		$HeaderPanel1[0]['Div1Class'] = NULL;
		$HeaderPanel1[0]['Div1Style'] = NULL;
		$HeaderPanel1[0]['Enable/Disable'] = $_POST['EnableDisable'];;
		$HeaderPanel1[0]['Status'] = $_POST['Status'];

		$header = $hold['FilteredInput']['Header'];

		$HeaderPanel1[1]['PageID'] = $NewPageID;
		$HeaderPanel1[1]['ObjectID'] = 2;
		$HeaderPanel1[1]['StartTag'] = NULL;
		$HeaderPanel1[1]['EndTag'] = NULL;
		$HeaderPanel1[1]['StartTagID'] = NULL;
		$HeaderPanel1[1]['StartTagStyle'] = NULL;
		$HeaderPanel1[1]['StartTagClass'] = NULL;
		$HeaderPanel1[1]['Div'] = NULL;
		$HeaderPanel1[1]['DivID'] = 'header-pagename';
		$HeaderPanel1[1]['DivClass'] = NULL;
		$HeaderPanel1[1]['DivStyle'] = NULL;
		$HeaderPanel1[1]['Div1'] = "<h1 class=\"SecondaryHeading\">$header</h1>";
		$HeaderPanel1[1]['Div1Title'] = NULL;
		$HeaderPanel1[1]['Div1ID'] = NULL;
		$HeaderPanel1[1]['Div1Class'] = NULL;
		$HeaderPanel1[1]['Div1Style'] = NULL;
		$HeaderPanel1[1]['Enable/Disable'] = $_POST['EnableDisable'];
		$HeaderPanel1[1]['Status'] = $_POST['Status'];
		*/

		$HeaderPanel1 = parse_ini_file('ModuleSettings/Tier6-ContentLayer/Modules/XhtmlMenu/AddHeaderPanel1.ini',TRUE);
		$HeaderPanel1 = $Tier6Databases->EmptyStringToNullArray($HeaderPanel1);

		$ContentLayerVersion = parse_ini_file('ModuleSettings/Tier6-ContentLayer/GlobalSettings/AddContentLayerVersion.ini',FALSE);
		$ContentLayerVersion = $Tier6Databases->EmptyStringToNullArray($ContentLayerVersion);

		//$ContentLayer = parse_ini_file('ModuleSettings/Tier6-ContentLayer/GlobalSettings/AddContentLayer.ini',TRUE);
		//$ContentLayer = $Tier6Databases->EmptyStringToNullArray($ContentLayer);

		$Sitemap = parse_ini_file('ModuleSettings/Tier6-ContentLayer/Modules/XmlSitemap/AddXmlSitemap.ini',FALSE);
		$Sitemap = $Tier6Databases->EmptyStringToNullArray($Sitemap);

		$ContentPrintPreview = parse_ini_file('ModuleSettings/Tier6-ContentLayer/Modules/XhtmlContent/AddPrintPreview.ini',FALSE);
		$ContentPrintPreview = $Tier6Databases->EmptyStringToNullArray($ContentPrintPreview);

		$MainMenuItemLookup = parse_ini_file('ModuleSettings/Tier6-ContentLayer/Modules/XhtmlMainMenu/AddMainMenuItemLookup.ini',FALSE);
		$MainMenuItemLookup = $Tier6Databases->EmptyStringToNullArray($MainMenuItemLookup);

		$UpdateMultiHeaderPageSelect = $Options['XhtmlContent']['content']['UpdateMultiHeaderPageSelect']['SettingAttribute'];
		$FormSelect = array();
		$FormSelect['PageID'] = &$UpdateMultiHeaderPageSelect;
		$FormSelect['ObjectID'] = $NewMultiHeaderPage;
		$FormSelect['StopObjectID'] = 9999;
		$FormSelect['ContinueObjectID'] = NULL;
		$FormSelect['ContainerObjectType'] = 'Option';
		$FormSelect['ContainerObjectTypeName'] = 'AdministratorFormOption';
		$FormSelect['ContainerObjectID'] = $NewMultiHeaderPage;
		$FormSelect['FormSelectDisabled'] = NULL;
		$FormSelect['FormSelectMultiple'] = NULL;
		$FormSelect['FormSelectName'] = 'MultiHeaderPage';
		$FormSelect['FormSelectNameDynamic'] = NULL;
		$FormSelect['FormSelectNameTableName'] = NULL;
		$FormSelect['FormSelectNameField'] = NULL;
		$FormSelect['FormSelectNamePageID'] = NULL;
		$FormSelect['FormSelectNameObjectID'] = NULL;
		$FormSelect['FormSelectNameRevisionID'] = NULL;
		$FormSelect['FormSelectSize'] = NULL;
		$FormSelect['FormSelectClass'] = 'ShortForm';
		$FormSelect['FormSelectDir'] = 'ltr';
		$FormSelect['FormSelectID'] = NULL;
		$FormSelect['FormSelectLang'] = 'en-us';
		$FormSelect['FormSelectStyle'] = 'width: 245px;';
		$FormSelect['FormSelectTabIndex'] = NULL;
		$FormSelect['FormSelectTitle'] = NULL;
		$FormSelect['FormSelectXMLLang'] = 'en-us';
		$FormSelect['Enable/Disable'] = 'Enable';
		$FormSelect['Status'] = 'Approved';


		$FormOptionText = $hold['FilteredInput']['PageTitle'];
		$FormOptionValue = $NewMultiHeaderPage;
		$FormOptionValue .= ' - ';
		$FormOptionValue .= $NewPageID;


		$FormOption = array();
		$FormOption['PageID'] = &$UpdateMultiHeaderPageSelect;
		$FormOption['ObjectID'] = $NewMultiHeaderPage;
		$FormOption['FormOptionText'] = $FormOptionText;
		$FormOption['FormOptionTextDynamic'] = 'false';
		$FormOption['FormOptionTextTableName'] = NULL;
		$FormOption['FormOptionTextField'] = NULL;
		$FormOption['FormOptionTextPageID'] = NULL;
		$FormOption['FormOptionTextObjectID'] = NULL;
		$FormOption['FormOptionTextRevisionID'] = NULL;
		$FormOption['FormOptionDisabled'] = NULL;
		$FormOption['FormOptionLabel'] = NULL;
		$FormOption['FormOptionLabelDynamic'] = NULL;
		$FormOption['FormOptionLabelTableName'] = NULL;
		$FormOption['FormOptionLabelField'] = NULL;
		$FormOption['FormOptionLabelPageID'] = NULL;
		$FormOption['FormOptionLabelObjectID'] = NULL;
		$FormOption['FormOptionLabelRevisionID'] = NULL;
		$FormOption['FormOptionSelected'] = NULL;
		$FormOption['FormOptionValue'] = &$FormOptionValue;
		$FormOption['FormOptionValueDynamic'] = NULL;
		$FormOption['FormOptionValueTableName'] = NULL;
		$FormOption['FormOptionValueField'] = NULL;
		$FormOption['FormOptionValuePageID'] = NULL;
		$FormOption['FormOptionValueObjectID'] = NULL;
		$FormOption['FormOptionValueRevisionID'] = NULL;
		$FormOption['FormOptionClass'] = NULL;
		$FormOption['FormOptionDir'] = 'ltr';
		$FormOption['FormOptionID'] = NULL;
		$FormOption['FormOptionLang'] = 'en-us';
		$FormOption['FormOptionStyle'] = NULL;
		$FormOption['FormOptionTitle'] = NULL;
		$FormOption['FormOptionXMLLang'] = 'en-us';
		$FormOption['Enable/Disable'] = 'Enable';
		$FormOption['Status'] = 'Approved';

		$Tier6Databases->ModulePass('XhtmlContent', 'content', 'createContent', $Content);
		$Tier6Databases->ModulePass('XhtmlHeader', 'header', 'createHeader', $Header);
		$Tier6Databases->ModulePass('XhtmlMenu', 'headerpanel1', 'createMenu', $HeaderPanel1);
		$Tier6Databases->createContentVersion($ContentLayerVersion, 'ContentLayerVersion');
		$Tier6Databases->ModulePass('XhtmlContent', 'content', 'createContentPrintPreview', $ContentPrintPreview);
		//$Tier6Databases->createContent($ContentLayer, 'ContentLayer');

		$Tier6Databases->ModulePass('XhtmlMainMenu', 'mainmenu', 'createMainMenuItemLookup', $MainMenuItemLookup);

		$Tier6Databases->ModulePass('XmlSitemap', 'sitemap', 'createSitemapItem', $Sitemap);

		$Tier6Databases->ModulePass('XhtmlForm', 'form', 'createFormOption', $FormOption);
		$Tier6Databases->ModulePass('XhtmlForm', 'form', 'createFormSelect', $FormSelect);

		$UpdateMultiHeaderPageSelect = $Options['XhtmlContent']['content']['DeleteMultiHeaderPage']['SettingAttribute'];

		$Tier6Databases->ModulePass('XhtmlForm', 'form', 'createFormOption', $FormOption);
		$Tier6Databases->ModulePass('XhtmlForm', 'form', 'createFormSelect', $FormSelect);

		$UpdateMultiHeaderPageSelect = $Options['XhtmlContent']['content']['EnableDisableStatusChangeMultiHeaderPage']['SettingAttribute'];

		$Tier6Databases->ModulePass('XhtmlForm', 'form', 'createFormOption', $FormOption);
		$Tier6Databases->ModulePass('XhtmlForm', 'form', 'createFormSelect', $FormSelect);

		$FormOptionValue = $NewPageID;
		$FormOptionValue .= ' - ';
		$FormOptionValue .= 'NULL';

		$MainMenuSelectPage = $Options['XhtmlMainMenu']['mainmenu']['MainMenuSelectPage']['SettingAttribute'];
		$FormSelect['PageID'] = $MainMenuSelectPage;
		$FormSelect['ObjectID'] = $NewPageID;
		$FormSelect['ContainerObjectID'] = $NewPageID;
		$FormSelect['FormSelectName'] = 'MenuItem1';
		$FormSelect['StopObjectID'] = NULL;
		$FormSelect['FormSelectStyle'] = NULL;
		$FormOption['PageID'] = $MainMenuSelectPage;
		$FormOption['ObjectID'] = $NewPageID;
		$Tier6Databases->ModulePass('XhtmlForm', 'form', 'createFormOption', $FormOption);
		$Tier6Databases->ModulePass('XhtmlForm', 'form', 'createFormSelect', $FormSelect);

		$MainMenuUpdatePage = $Options['XhtmlMainMenu']['mainmenu']['MainMenuUpdatePage']['SettingAttribute'];
		$FormSelect['PageID'] = $MainMenuUpdatePage;
		$FormOption['PageID'] = $MainMenuUpdatePage;
		$Tier6Databases->ModulePass('XhtmlForm', 'form', 'createFormOption', $FormOption);
		$Tier6Databases->ModulePass('XhtmlForm', 'form', 'createFormSelect', $FormSelect);

		$j = $NewPageID;
		for ($i = 2; $i < 16; $i++) {
			$j += 10000;
			$FormSelect['ObjectID'] = $j;
			$FormSelect['FormSelectName'] = 'MenuItem';
			$FormSelect['FormSelectName'] .= $i;
			$Tier6Databases->ModulePass('XhtmlForm', 'form', 'createFormSelect', $FormSelect);
		}

		$j += 10000;
		$FormSelect['ObjectID'] = $j;
		$FormSelect['FormSelectName'] = 'TopMenu';
		$Tier6Databases->ModulePass('XhtmlForm', 'form', 'createFormSelect', $FormSelect);

		$MultiHeaderPageCreatedPage = $Options['XhtmlContent']['content']['MultiHeaderPageCreatedPage']['SettingAttribute'];

		header("Location: $MultiHeaderPageCreatedPage&SessionID=$sessionname");
		exit;


		//define(NewPageID, $NewPageID);
		//define(EnableDisable, $_POST['EnableDisable']);
		//define(Status, $_POST['Status']);
		//$NewPageID = 5;
		//$DEMO = parse_ini_file('ModuleSettings/Tier6-ContentLayer/GlobalSettings/AddContentLayer.ini',TRUE);
		//print_r($DEMO);
		//$ContentLayer = array_filter($ContentLayer, 'strlen');

		//print_r($Content);
		////print_r($Header);
		////print_r($HeaderPanel1);
		////print_r($ContentLayerVersion);
		////print_r($ContentLayer);
		////print_r($Sitemap);
		////print_r($ContentPrintPreview);
		////print_r($FormSelect);
		//print_r($FormOption);

		// TEST CASE 1
		/*$Demo = array();
		$Demo ['PhotoSet1Heading'] = 'DOG';
		$Demo ['PhotoSet1TopText'] = NULL;
		$Demo ['PhotoSet1Image1Src'] = 'bird';
		$Demo ['PhotoSet1Text'] = 'chicken';
		$Demo ['PhotoSet1Alt'] = NULL;
		$Demo ['PhotoSet1Image2Src'] = NULL;
		$Demo ['PhotoSet1Image2Text'] = NULL;
		$Demo ['PhotoSet1Image2Alt'] = NULL;
		$Demo ['PhotoSet1BottomText'] = NULL;
		$Demo ['PhotoSet1Order'] = 2;

		$Demo ['PhotoSet2Heading'] = 'cat';
		$Demo ['PhotoSet2TopText'] = 'THE DOG WENT UP THE HILL!';
		$Demo ['PhotoSet2Image1Src'] = 'ROOSTER';
		$Demo ['PhotoSet2Text'] = 'Hen';
		$Demo ['PhotoSet2Alt'] = NULL;
		$Demo ['PhotoSet2Image2Src'] = NULL;
		$Demo ['PhotoSet2Image2Text'] = NULL;
		$Demo ['PhotoSet2Image2Alt'] = NULL;
		$Demo ['PhotoSet2BottomText'] = 'Something';
		$Demo ['PhotoSet2Order'] = 1;

		$Demo ['PhotoSet3Heading'] = 'cat';
		$Demo ['PhotoSet3TopText'] = 'here i am!';
		$Demo ['PhotoSet3Image1Src'] = 'chicken';
		$Demo ['PhotoSet3Text'] = 'Hen';
		$Demo ['PhotoSet3Alt'] = NULL;
		$Demo ['PhotoSet3Image2Src'] = NULL;
		$Demo ['PhotoSet3Image2Text'] = NULL;
		$Demo ['PhotoSet3Image2Alt'] = NULL;
		$Demo ['PhotoSet3BottomText'] = 'Something';
		$Demo ['PhotoSet3Order'] = NULL;

		$Demo ['PhotoSet4Heading'] = 'cat';
		$Demo ['PhotoSet4TopText'] = 'THE DOG WENT UP THE HILL!';
		$Demo ['PhotoSet4Image1Src'] = 'ROOSTER';
		$Demo ['PhotoSet4Text'] = 'Hen';
		$Demo ['PhotoSet4Alt'] = NULL;
		$Demo ['PhotoSet4Image2Src'] = NULL;
		$Demo ['PhotoSet4Image2Text'] = NULL;
		$Demo ['PhotoSet4Image2Alt'] = NULL;
		$Demo ['PhotoSet4BottomText'] = 'Something';
		$Demo ['PhotoSet4Order'] = 4;

		$Demo ['Heading'] = 'DOG';

		$Start ['Heading'] = 'Heading';
		$Start ['TopText'] = 'TopText';
		$Start ['Image1Src'] = 'Image1Src';
		$Start ['Text'] = 'Text';
		$Start ['Alt'] = 'Alt';
		$Start ['Image2Src'] = 'Image2Src';
		$Start ['Image2Text'] = 'Image2Text';
		$Start ['Image2Alt'] = 'Image2Alt';
		$Start ['BottomText'] = 'BottomText';
		$Start ['Order'] = 'Order';

		$StartKey = 'PhotoSet';
		$ConditionKey = 'Image1Src';
		$StartNumber = 1;
		$Sort = 'Order';

		$temp = $Tier6Databases->MultiArrayBuild($Start, $StartKey, $ConditionKey, $StartNumber, $Demo, $Sort);
		if ($temp != NULL ) {
			$Demo = $temp;
			print "I HAVE INPUT\n";
		}

		print_r($Demo);
		*/




		//print "TESTING\n";
		//require_once '../Testcases/Tier6-ContentLayer/MultiArrayBuild/Test8.php';

}
?>