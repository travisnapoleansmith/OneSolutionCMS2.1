<?php
	// Creates a new file from an existing file.  The new file will have all " replaced with \"
	// for CSV files.

	$i = 1;
	$FileName = "TestFile$i.csv";
	$NewFileName = "C:\TestFile$i.csv";

	$OldFile = file($FileName, FILE_USE_INCLUDE_PATH);
	$NewFile = fopen($NewFileName, 'w', TRUE);

	foreach ($OldFile as $Fields) {
		$Record = array();
		$hold = $Fields;
		if ($hold[0] == '"') {
			$hold = substr($hold, 1);
		}

		$hold = trim($hold);

		if ($hold[strlen($hold)-1] == '"') {
			$hold = rtrim($hold, "\"");
		}
		$hold = explode('","', $hold);
		foreach ($hold as $NewKey => $NewFields) {
			$NewFields = str_replace('"', '\"', $NewFields);
			$NewFields = preg_replace('/  +/', '', $NewFields);
			$hold[$NewKey] = $NewFields;
		}

		$temp = $hold[0];
		$hold[0] = '"' . $temp;

		$key = count($hold) - 1;
		$temp = $hold[$key];
		$hold[$key] = $temp . '"';
		$hold = implode('","' , $hold);
		$hold .= "\n";

		fwrite($NewFile, $hold);
	}
	fclose($NewFile);

	print "Task Completed for TestFile$i.csv!\n";
?>