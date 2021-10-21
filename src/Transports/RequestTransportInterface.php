<?php

namespace RPHPSDK\Relictum\Transports;

interface RequestTransportInterface
{
	public function getData(string $uri, string $method, array $params, array $config) : array;
}
