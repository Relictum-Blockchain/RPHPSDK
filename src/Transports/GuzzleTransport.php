<?php

namespace Relictum\RPHPSDK\Transports;

class GuzzleTransport implements RequestTransportInterface
{
	/**
	* Get array with raw data from node
	*
	* @param string $uri
	* @param string $method
	* @param array $params
	* @param array $config
	* @return array
	* @throws NetworkErrorException
	*/
	public function getData(string $uri, string $method, array $params, array $config) : array
	{
		$httpclient = new \GuzzleHttp\Client([
			'base_uri' => $config['base_uri']
		]);
		$response = $httpclient->request(
			$method,
			$uri,
			[
				($method != 'POST' ? \GuzzleHttp\RequestOptions::QUERY : \GuzzleHttp\RequestOptions::JSON) => $params
			]);
		
		if ($response->getStatusCode() == 200) {
			if(strpos($response->getHeaders()['Content-Type'][0], 'json') !== false) {
				return json_decode($response->getBody(), true);
			}
			else {
				return [
					'data' => (string) $response->getBody(),
					'type' => $response->getHeaders()['Content-Type'][0],
					'length' => $response->getHeaders()['Content-Length'][0]
				];
			}
		}
		throw new \Relictum\RPHPSDK\Exceptions\NetworkErrorException($response->getBody()->getContents());
	}
}
