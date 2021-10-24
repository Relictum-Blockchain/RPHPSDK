<?php

namespace Relictum\RPHPSDK;

/**
* A PHP API for interacting with the Relictum
*
* @package RPHPSDK
* @since   1.0.0
*/

class RequestConfigurator
{
	protected $config = [
		'authorization' => \Relictum\RPHPSDK\Helpers\AuthorizationHelper::class,
		'cache' => \Relictum\RPHPSDK\Helpers\CacheHelper::class,
		'transport' => \Relictum\RPHPSDK\Transports\GuzzleTransport::class,
	];
	
	/**
	* Create a new Relictum Request Configurator object
	*
	* @param array $config
	*/
	public function __construct(array $config = [])
	{
		$this->config = array_merge($this->config, $config);
	}

	/**
	* Apply the configuration to the specified request
	*
	* @param Request $request
	*/
	public function configure(Request $request)
	{
		foreach($this->config AS $key=>$config) {
			
			$setMethod = 'set' . ucfirst($key);
			
			if( ! method_exists($request, $setMethod)) {
				continue;
			}
			
			if(is_object($config)) {
				$request->$setMethod($config);
			}
			elseif(is_string($config) && class_exists($config)) {
				$request->$setMethod(new $config);
			}
			elseif(is_array($config)) {
				$request->$setMethod($config);
			}
		}
	}

	/**
	* Set authorization class for Request Configurator
	*
	* @param AuthorizationHelperInterface $object
	*/
	public function setAuthorization(\Relictum\RPHPSDK\Helpers\AuthorizationHelperInterface $object)
	{
		$this->set('authorization', $class);
	}

	/**
	* Set cache class for Request Configurator
	*
	* @param CacheHelperInterface $object
	*/
	public function setCache(\Relictum\RPHPSDK\Helpers\CacheHelperInterface $object)
	{
		$this->set('cache', $class);
	}

	/**
	* Set transport class for Request Configurator
	*
	* @param RequestTransportInterface $object
	*/
	public function setTransport(\Relictum\RPHPSDK\Transports\RequestTransportInterface $object)
	{
		$this->set('transport', $class);
	}
	
	protected function set(string $configParam, object $object)
	{
		$this->config[$configParam] = $class;
	}
}
