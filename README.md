
## SimpleSheet

If you just need to get data from your Google Spreadsheet or update it, maybe this class is for you.

This class work with [Google Api Client](https://github.com/google/google-api-php-client)

## What you need before use this class
1. [Google Api Client](https://github.com/google/google-api-php-client)
2. Credentials file. You can get it from [here](https://developers.google.com/api-client-library/php/auth/service-accounts#creatinganaccount). Or go to [console.developers.google.com](console.developers.google.com), enable **Sheets API**, go to **Credentials**, create new credentials -> **Service Account Key** -> JSON
3. Spreadsheet ID
4. Open credentials file, you'll see **client_email**. Share your spreadsheet to that email, and make sure it has edit permission.

## Example

``` php
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
```

Don't forget to run this command to download Google Api Client library.
```
composer update
```
