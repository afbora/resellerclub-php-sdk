<?php

namespace afbora\ResellerClub;

use GuzzleHttp\Client as Guzzle;
use GuzzleHttp\Psr7\Response;

trait Helper
{
	protected $guzzle;
	private $creds = [];

	public function __construct(Guzzle $guzzle, array $creds)
	{
		$this->creds = $creds;
		$this->guzzle = $guzzle;
	}

	protected function get($method, $args = [], $prefix = '')
	{
		return $this->parse(
			$this->guzzle->get(
				$this->api .'/'. $prefix . $method.'.json?'.preg_replace('/%5B[0-9]+%5D/simU', '', http_build_query(array_merge($args, $this->creds)))
			)
		);
	}

	protected function getXML($method, $args = [], $prefix = '')
	{
		return $this->parse(
			$this->guzzle->get(
				$this->api .'/'. $prefix . $method.'.xml?'.preg_replace('/%5B[0-9]+%5D/simU', '', http_build_query(array_merge($args, $this->creds)))
			),
			'xml'
		);
	}

	protected function post($method, $args = [], $prefix = '')
	{
		return $this->parse(
			$this->guzzle->post($prefix . $method.'.json', $args)
		);
	}

	protected function parse(Response $response, $type = 'json')
	{
		switch ($type) {
			case 'json':
				return json_decode((string) $response->getBody(), true);
			case 'xml':
				return simplexml_load_file((string) $response->getBody());
			default:
				throw new Exception("Invalid repsonse type");
		}
	}

	protected function processAttributes($args = [])
	{
		$data = [];

		$i = 0;
		foreach ($attributes as $key => $value) {
			$i++;
			$data["attr-name{$i}"] = $key;
			$data["attr-value{$i}"] = $value;
		}

		return $data;
	}
}