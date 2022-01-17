<?php

namespace Relictum\RPHPSDK;

/**
* A PHP API for interacting with the Relictum
*
* @package RPHPSDK
* @since   1.0.0
*/

class Executor
{
	protected static $config = [
		'creators' => [
			'chains/([a-z\-\_]+)' => \Relictum\RPHPSDK\Creators\ChainDataCreator::class,
		],
		'classess' => [
			'account/([0-9]+|[a-zA-Z0-9]{32})' => \Relictum\RPHPSDK\DataObjects\AccountCollectionDataObject::class,
			'nft/list' => \Relictum\RPHPSDK\DataObjects\NftListCollectionDataObject::class,
			'user/transfer' => \Relictum\RPHPSDK\DataObjects\UserTransferDataObject::class,
		],
	];
	
	/**
	* Execute request and get data object
	*
	* @param Request $request
	* @return DataObjectInterface
	* @throws NetworkErrorException
	* @throws NodeRequestException
	*/
	public static function execute(Request $request) : \Relictum\RPHPSDK\DataObjects\DataObjectInterface
	{		
		$data = $request->send();
		if(isset($data['success']) && filter_var($data['success'], FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE) == false) {
			throw new \Relictum\RPHPSDK\Exceptions\NodeRequestException($data['error']);
		}
		$creator = self::findCreator($request);
		
		$dataObject = $creator->create($data, self::findClass($request));
		$dataObject->setRequest($request);
		return $dataObject;
	}
	
	/**
	* Get Request object from data object
	*
	* @param DataObjectInterface $dataObject
	* @return Request
	*/
	public static function getRequest(\Relictum\RPHPSDK\DataObjects\DataObjectInterface $dataObject) : Request
	{
		$request = $dataObject->getRequest();
		$newRequest = clone $request;
		return $newRequest;
	}
	
	/**
	* Set custom data or creator classes for specific requests
	*
	* @param array $config
	*/
	public static function setConfig(array $config) : void
	{
		if( ! empty($config['creators'])) {
			self::$config['creators'] = array_merge(self::$config['creators'], $config['creators']);
		}
		if( ! empty($config['classess'])) {
			self::$config['classess'] = array_merge(self::$config['classess'], $config['classess']);
		}
	}
	
	/**
	* Set custom creator class for specific request uri
	*
	* @param string $uri
	* @param string $class
	*/
	public static function setCreator(string $uri, string $class) : void
	{		
		self::$config['creators'][$uri] = $class;
	}
	
	/**
	* Set custom data object class for specific request uri
	*
	* @param string $uri
	* @param string $class
	*/
	public static function setDataObjectClass(string $uri, string $class) : void
	{		
		self::$config['classess'][$uri] = $class;
	}
	
	protected static function findCreator(Request $request)
	{
		foreach(self::$config['creators'] AS $uri=>$class) {
			if(preg_match('@^' . $uri . '$@', $request->uri) === 1) {
				$className = $class;
			}
		}
		
		if( ! empty(self::$config['creators'][$request->uri])) {
			$className = self::$config['creators'][$request->uri];
		}
		
		if(empty($className)) {
			$className = str_replace('-', ' ', $request->uri);
			$className = str_replace('/', '\ ', $className);
			$className = ucwords($className);
			$className = 'Relictum\\RPHPSDK\\Creators\\' . str_replace(' ', '', $className) . 'DataCreator';
		}
		
		if(is_object($className)) {
			return $className;
		}
		
		if(class_exists($className)) {
			return new $className;
		}
		else {
			return new \Relictum\RPHPSDK\Creators\DefaultDataCreator;
		}
	}
	
	protected static function findClass(Request $request)
	{
		$className = '';
		
		foreach(self::$config['classess'] AS $uri=>$class) {
			if(preg_match('@^' . $uri . '$@', $request->uri) === 1) {
				$className = $class;
			}
		}
		
		if( ! empty(self::$config['classess'][$request->uri])) {
			$className = self::$config['classess'][$request->uri];
		}
		
		if(is_object($className)) {
			return get_class($className);
		}
		
		if(class_exists($className)) {
			return $className;
		}
		else {
			return null;
		}
	}
}
