<?php

namespace RPHPSDK\Relictum\Helpers;

class CacheHelper implements CacheHelperInterface
{
	/**
	* Get caching data for a specific requests
	*
	* @param string $uri
	* @param string $method
	* @param array $params
	* @param array $config
	* @return DataObjectInterface|null
	*/
	public function getCache(string $uri, string $method, array $params, array $config) {
		return null;
	}
	
	/**
	* Set caching data for a specific requests
	*
	* @param string $uri
	* @param string $method
	* @param array $params
	* @param array $config
	* @param DataObjectInterface|null $dataObject
	*/
	public function setCache(string $uri, string $method, array $params, array $config, $dataObject) {
	}
}
