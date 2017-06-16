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
	
	/*
		Configuration is the tab ini configuration file.
		buildColumnTemplate creates the template used for each column name used in Grid Stats Data.
		
		Returns array Elements: contains the keys 'TEMPLATE' for Grid Stats Data's Template.
	*/
	
	function buildColumnTemplate($Configuration, &$Elements) {
		if ($Configuration != NULL) {
			if (is_array($Configuration) === TRUE) {
				$TemplateArray = $Configuration['TEMPLATE'];
				if ($TemplateArray != NULL & is_array($TemplateArray) === TRUE) {
					foreach ($TemplateArray as $TemplateElementsKey => $TemplateElements) {
						if (isset($TemplateElements) === TRUE) {
							$Elements['TEMPLATE'][$TemplateElementsKey] = $TemplateElements;
						}
					}
				}
				return TRUE;
			} else {
				return FALSE;
			}
		} else {
			return TRUE;
		}
	}
?>