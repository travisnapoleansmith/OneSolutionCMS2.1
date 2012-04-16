<?
	// TEST CASE 9 for Method MultiArrayBuild
	// $Tier6Databases -> MultiArrayBuild(array $Start, $StartKey, $ConditionalKey, $StartNumber, array $Source);
	// Tests out with sorting unordered list no malformed order number no unlisted root field, no unlisted non-root field and 1 NULL Condition Key.
	
	$Demo = array();
	$Demo ['Demo1Field1'] = 'DOG1';
	$Demo ['Demo1Field2'] = NULL;
	$Demo ['Demo1Field3'] = 'bird';
	$Demo ['Demo1Field4'] = 'chicken';
	$Demo ['Demo1Field5'] = NULL;
	$Demo ['Demo1Field6'] = NULL;
	$Demo ['Demo1Field7'] = NULL;
	$Demo ['Demo1Field8'] = NULL;
	$Demo ['Demo1Field9'] = NULL;
	$Demo ['Demo1Field10'] = NULL;
	$Demo ['Demo1Order'] = 2;
	
	$Demo ['Demo2Field1'] = 'cat2';
	$Demo ['Demo2Field2'] = 'THE DOG WENT UP THE HILL!';
	$Demo ['Demo2Field3'] = 'ROOSTER';
	$Demo ['Demo2Field4'] = 'Hen';
	$Demo ['Demo2Field5'] = NULL;
	$Demo ['Demo2Field6'] = NULL;
	$Demo ['Demo2Field7'] = NULL;
	$Demo ['Demo2Field8'] = NULL;
	$Demo ['Demo2Field9'] = 'Something';
	$Demo ['Demo2Field10'] = NULL;
	$Demo ['Demo2Order'] = 1;
	
	$Demo ['Demo3Field1'] = 'cat3';
	$Demo ['Demo3Field2'] = 'here i am!';
	$Demo ['Demo3Field3'] = 'chicken';
	$Demo ['Demo3Field4'] = 'Hen';
	$Demo ['Demo3Field5'] = NULL;
	$Demo ['Demo3Field6'] = NULL;
	$Demo ['Demo3Field7'] = NULL;
	$Demo ['Demo3Field8'] = NULL;
	$Demo ['Demo3Field9'] = 'Something';
	$Demo ['Demo3Field10'] = 'DIDDO';
	$Demo ['Demo3Order'] = 3;
	
	$Demo ['Demo4Field1'] = NULL;
	$Demo ['Demo4Field2'] = 'THE DOG WENT UP THE HILL!';
	$Demo ['Demo4Field3'] = 'ROOSTER';
	$Demo ['Demo4Field4'] = 'Hen';
	$Demo ['Demo4Field5'] = NULL;
	$Demo ['Demo4Field6'] = NULL;
	$Demo ['Demo4Field7'] = NULL;
	$Demo ['Demo4Field8'] = NULL;
	$Demo ['Demo4Field9'] = 'Something';
	$Demo ['Demo4Field10'] = NULL;
	$Demo ['Demo4Order'] = NULL;
	
	$Start ['Field1'] = 'Field1';
	$Start ['Field2'] = 'Field2';
	$Start ['Field3'] = 'Field3';
	$Start ['Field4'] = 'Field4';
	$Start ['Field5'] = 'Field5';
	$Start ['Field6'] = 'Field6';
	$Start ['Field7'] = 'Field7';
	$Start ['Field8'] = 'Field8';
	$Start ['Field9'] = 'Field9';
	$Start ['Field10'] = 'Field10';
	$Start ['Order'] = 'Order';
	
	$StartKey = 'Demo';
	$ConditionKey = 'Field1';
	$StartNumber = 1;
	$Sort = 'Order';
	
	$temp = $Tier6Databases->MultiArrayBuild($Start, $StartKey, $ConditionKey, $StartNumber, $Demo, $Sort);
	if ($temp != NULL ) {
		$Demo = $temp;
		print "I HAVE INPUT\n";
	}
	
	print_r($Demo); 
?>