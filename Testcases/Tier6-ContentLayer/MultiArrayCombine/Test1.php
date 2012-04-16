<?
	// TEST CASE 1 for Method MultiArrayCombine
	// $Tier6Databases -> MultiArrayCombine($StartNumber, array $Source);
	// Tests out a combine mulitdimensional array into a single dimensional array with 1 deep.
	// Should return a single dimensional array
	
	$Demo = array();
	$Demo ['DemoField1'] = 'DOG1';
	$Demo ['DemoField2'] = 'DOG2';
	
	$Demo [1]['Demo1Field1'] = 'DOG1-1';
	$Demo [1]['Demo1Field2'] = 'DOG1-2';
	
	$Demo [2]['Demo2Field1'] = 'DOG2-1';
	$Demo [2]['Demo2Field2'] = 'DOG2-2';
	
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