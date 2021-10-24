<?php

namespace Relictum\RPHPSDK\Helpers;

interface CacheHelperInterface extends RequestHelperInterface
{
	public function getCache(string $uri, string $method, array $params, array $config);
	public function setCache(string $uri, string $method, array $params, array $config, $dataObject);
}
