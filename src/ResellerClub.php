<?php

namespace afbora\ResellerClub;

use GuzzleHttp\Client as Guzzle;

class ResellerClub 
{
	const API_URL = 'https://httpapi.com/api/';
	const API_TEST_URL = 'https://test.httpapi.com/api/';

	private $guzzle;
	private $apis = [];
	private $creds = []; // Get calls do not use default query string

	public function __construct($userid, $apikey, $testmode = false)
	{
		$this->creds = [
			'auth-userid' => $userid,
			'api-key' => $apikey
		];

		$this->guzzle = new Guzzle([
			'base_uri' => $testmode ? self::API_TEST_URL :  self::API_URL,
			'defaults' => [
				'query' => $this->creds
			],
			'verify' => false
		]);
	}

	private function _getAPI($api)
	{
		if (empty($this->apis[$api])) {
			$class = 'afbora\\ResellerClub\\APIs\\' . $api;
			$this->apis[$api] = new $class($this->guzzle, $this->creds);
		}

		return $this->apis[$api];
	}

	public function domains()
	{
		return $this->_getAPI('Domains');
	}

	public function contacts()
	{
		return $this->_getAPI('contacts');
	}
}