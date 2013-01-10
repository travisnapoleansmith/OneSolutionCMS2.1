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

	// TEST CASE 6 for Method MultiArrayCombine
	// $Tier6Databases -> MultiArrayCombine($StartNumber, array $Source);
	// Tests out a combine mulitdimensional array into a single dimensional array with 2 deep and 1 subfield matching in the parent.
	// Should return with one value being overwritten because the subfield matches the parent;

	$Demo = array();
	$Demo ['DemoField1'] = 'DOG1';
	$Demo ['DemoField2'] = 'DOG2';

	$Demo [1]['DemoField1'] = 'DOG1-1';
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