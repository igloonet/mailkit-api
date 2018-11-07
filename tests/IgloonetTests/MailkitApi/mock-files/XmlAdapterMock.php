<?php

namespace IgloonetTests\MailkitApi;

class XmlAdapterMock extends \Igloonet\MailkitApi\RPC\Adapters\XmlAdapter
{
	public function __construct()
	{
		parent::__construct('clientId', 'clientMd5');

	}

	/**
	 * @param string $method
	 * @param $requestData
	 * @param $options
	 * @return bool|string
	 */
	protected function getContent(string $method, $requestData, $options)
	{
		if (isset($requestData[2])) {
			return @file_get_contents(__DIR__ . '/api-data/xml/' . $method . '.' . $requestData[2] . '.xml');
		}

		return @file_get_contents(__DIR__ . '/api-data/xml/' . $method .'.xml');;
	}
}