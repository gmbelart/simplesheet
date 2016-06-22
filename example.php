<?php

require 'vendor/autoload.php';
require 'SimpleSheet.php';

// get this file from https://console.developers.google.com/, 
// enable Sheets API, 
// then create Credentials > Service account key -> JSON
$configFile = 'your-config.json';

$spreadsheetId = 'your-spreadsheet-id';

$sheet = new SimpleSheet($configFile, $spreadsheetId);

// getting data on Sheet1 from A1 to C3
$sheetValue = $sheet->get('Sheet1!A1:C3');

echo '<pre>';
print_r($sheetValue);

// update data
$newData = [
	['data 1', 'data 2', 'data 3'], // Row 1 for A1-C1
	['data 4', 'data 5', 'data 6'], // Row 2 for A2-C2
	['data 7', 'data 8', 'data 9'] // Row 3 for A3-C3
];
// update data for Sheet1 on A1:C3
$sheet->update('Sheet1!A1:C3', $newData);

// get data again
$newSheetValue = $sheet->get('Sheet1!A1:C3');

echo '<pre>';
print_r($newSheetValue);