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

	require_once ("../../../Libraries/GlobalLayer/GooglePHPExcelReader/excel_reader2.php");

	$File = NULL;
	if ($_GET['File']) {
		$File = $_GET['File'];
	}

	$Location = NULL;
	$Location = 'UPLOAD/';

	$FileName = $Location . $File;

	if (file_exists($FileName)) {
		$Page = new XMLWriter();
		$Page->openMemory();

		$Page->setIndent(4);
		$Page->startDocument('1.0', 'utf-8');
			$Page->startElement('rows');
			$Page->startElement('caption');
			$Page->text('Table Caption');
			$Page->endElement(); // ENDS CAPTION

			if (strstr($File, '.csv')) {
				if (($Handle = fopen($FileName, "r")) !== FALSE) {
					$i = 1;
					$HeaderSize = NULL;
					while (($Data = fgetcsv($Handle)) !== FALSE) {
						if ($i == '1') {
							$HeaderSize = count($Data);
							$Page->startElement('head');
								$Page->writeAttribute('align', 'center');
								for ($j = 1; $j <= $HeaderSize; $j++) {
									$Page->startElement('column');
										$Page->writeAttribute('type', 'ed');
										$Page->writeAttribute('sort', 'str');
										$Page->writeAttribute('width', '110');
										$Page->text('Column ' . $j);
									$Page->endElement(); // ENDS COLUMN
								}
							$Page->endElement(); // ENDS HEAD
						}

						$Page->startElement('row');
						if ($i == '1') {
							$Page->writeAttribute('id', $i);

						} else {
							$ID = ($i * 100) - 100;
							$Page->writeAttribute('id', $ID);
						}

						foreach ($Data as $Key => $Cell) {
							$Page->startElement('cell');
								$Page->text($Cell);
							$Page->endElement(); // ENDS CELL
						}
						$Page->endElement();// ENDS ROW
						$i++;
					}

					$Page->startElement('tfoot');
						$Page->startElement('tr');
						for ($j = 1; $j <= $HeaderSize; $j++) {
							$Page->startElement('cell');
								$Page->text('Footer Column ' . $j);
							$Page->endElement(); // ENDS CELL
						}
						$Page->endElement(); // ENDS TR
					$Page->endElement(); // ENDS TFOOT

				}
			} else if (strstr($File, '.xls')) {
				$Data = new Spreadsheet_Excel_Reader($FileName);

				$RowCount = $Data->rowcount();
				$ColumnCount = $Data->colcount();
				$Column1 = $Data->colindexes[1];
				$Row = 1;
				$Col = 1;
				$Sheet = 0;
				$Cells = $Data->sheets[$Sheet]['cells'];
				$ColumnNames = array();
				for ($i = 1; $i <= $ColumnCount; $i++) {
					$ColumnNames[$i] = $Data->colindexes[$i];
				}

				$Page->startElement('head');
					$Page->writeAttribute('align', 'center');

					foreach ($ColumnNames as $Key => $Data) {
						$Page->startElement('column');
							$Page->writeAttribute('type', 'ed');
							$Page->writeAttribute('sort', 'str');
							$Page->writeAttribute('width', '110');
							$Page->text('Column ' . $Key);
						$Page->endElement(); // ENDS COLUMN
					}

				$Page->endElement(); // ENDS HEAD

				foreach ($Cells as $Key => $Value) {
					$Page->startElement('row');
					if ($Key == '1') {
						$Page->writeAttribute('id', $Key);
					} else {
						$ID = ($Key * 100) - 100;
						$Page->writeAttribute('id', $ID);
					}
					foreach ($Value as $ColumnKey => $ColumnValue) {
						$Page->startElement('cell');
							$Page->text($ColumnValue);
						$Page->endElement(); // ENDS CELL
					}
					$Page->endElement(); // ENDS ROW
				}

				$Page->startElement('tfoot');
					$Page->startElement('tr');

					foreach ($ColumnNames as $Key => $Data) {
						$Page->startElement('cell');
							$Page->text('Footer Column ' . $Key);
						$Page->endElement(); // ENDS CELL
					}
					$Page->endElement(); // ENDS TR
				$Page->endElement(); // ENDS TFOOT
			}
			$Page->endElement(); // ENDS ROWS
		$pageoutput = $Page->flush();
		header('Content-type: text/xml');
		header("Cache-Control: no-cache, must-revalidate");
		header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");
		print $pageoutput;
	} else {
		header("HTTP/1.0 404 Not Found");
	}
?>