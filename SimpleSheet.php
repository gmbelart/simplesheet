<?php

/**
 * Copyright 2016
 * Simple class to get data from google spreadsheet or update it
 * 
 * @author Ahmad Hajar (me@ahmadhajar.com)
 * @license MIT
 * 
 */
class SimpleSheet
{
	public $service;
	public $spreadsheetId;
	public $response;

	/**
	 * 
	 * @param JSON File $configFile		get this file from https://console.developers.google.com/, 
	 *                  				enable Sheets API, 
	 *                  				then create Credentials > Service account key -> JSON
	 * @param String $spreadsheetId 	Spreadsheet ID
	 */
	function __construct($configFile, $spreadsheetId)
	{
		$client = new Google_Client();
		$client->setAuthConfig($configFile);
		$client->setScopes([ Google_Service_Sheets::SPREADSHEETS ]);

		$this->service = new Google_Service_Sheets($client);

		$this->spreadsheetId = $spreadsheetId;
	}

	/**
	 * Get value from specified range. 
	 * https://developers.google.com/sheets/guides/concepts#a1_notation
	 * 
	 * @param  String $range 	A1 Notation
	 * @return Array
	 */
	public function get($range)
	{
		$this->response = $this->service->spreadsheets_values->get($this->spreadsheetId, $range);
		return $this->response->getValues();
	}

	/**
	 * Update cell value with specified range. 
	 * https://developers.google.com/sheets/guides/concepts#a1_notation
	 * 
	 * @param  String $range A1 Notation
	 * @param  Array $data array of data [[data1, data2, data3], [data4, data5, data6]]
	 * @return Array
	 */
	public function update($range, $data){
		$dataRange = new Google_Service_Sheets_ValueRange();
		$dataRange->setMajorDimension('ROWS');
		$dataRange->setRange($range);
		$dataRange->setValues($data);

		$this->response = $this->service->spreadsheets_values->update($this->spreadsheetId, $range, $dataRange, ['valueInputOption' => 'RAW']);

		return [
			'spreadsheetId' => $this->response->getSpreadsheetId(),
			'updatedCells' => $this->response->getUpdatedCells(),
			'updatedColumns' => $this->response->getUpdatedColumns(),
			'updatedRange' => $this->response->getUpdatedRange(),
			'updatedRows' => $this->response->getUpdatedRows()
		];
	}

	/**
	 * Get original response from Google Service
	 * 
	 * @return Object Google_Service_Sheets_UpdateValuesResponse
	 */
	public function getResponse()
	{
		return $this->response;
	}
}