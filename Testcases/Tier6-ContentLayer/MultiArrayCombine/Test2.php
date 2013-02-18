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

	// TEST CASE 2 for Method MultiArrayCombine
	// $Tier6Databases -> MultiArrayCombine($StartNumber, array $Source);
	// Tests out a combine mulitdimensional array into a single dimensional array with 2 deep.
	// Should return a single dimensional array

	$Demo = array();
	$Demo ['DemoField1'] = 'DOG1';
	$Demo ['DemoField2'] = 'DOG2';

	$Demo [1]['Demo1Field1'] = 'DOG1-1';
	$Demo [1]['Demo1Field2'] = 'DOG1-2';
	$Demo [1][1]['Demo1-1Field1'] = 'DOG1-1-1';
	$Demo [1][1]['Demo1-1Field2'] = 'Dog1-1-2';
	$Demo [1][2]['Demo1-2Field1'] = 'DOG1-2-1';
	$Demo [1][2]['Demo1-2Field2'] = 'Dog1-2-2';

	$Demo [2]['Demo2Field1'] = 'DOG2-1';
	$Demo [2]['Demo2Field2'] = 'DOG2-2';
	$Demo [2][1]['Demo2-1Field1'] = 'DOG2-1-1';
	$Demo [2][1]['Demo2-1Field2'] = 'Dog2-1-2';
	$Demo [2][2]['Demo2-2Field1'] = 'DOG2-2-1';
	$Demo [2][2]['Demo2-2Field2'] = 'Dog2-2-2';

	$Demo ['DemoField3'] = 'DOG3';
	$Demo ['DemoField4'] = 'DOG4';

	$StartNumber = 1;
	$temp = $Tier6Databases->MultiArrayCombine($StartNumber, $Demo);
	if ($temp != NULL ) {
		$Demo = $temp;
		print "I HAVE INPUT\n";
	}

	print_r($Demo);
?>