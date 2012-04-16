<?
	// TEST CASE 3 for Method MultiArrayCombine
	// $Tier6Databases -> MultiArrayCombine($StartNumber, array $Source);
	// Tests out a combine mulitdimensional array into a single dimensional array with 2 deep using an invalid non-integer Start Number.
	// Should throw an execption and return NULL;
	
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
	
	$StartNumber = 'NONNUMBER';
	$temp = $Tier6Databases->MultiArrayCombine($StartNumber, $Demo);
	if ($temp != NULL ) {
		$Demo = $temp;
		print "I HAVE INPUT\n";
	}
	
	print_r($Demo); 
?>