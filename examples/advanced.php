<?php

require(__DIR__ . '/../vendor/autoload.php');

class MyRelictumCache implements Relictum\RPHPSDK\Helpers\CacheHelperInterface
{
	// Get caching data for a specific requests
	public function getCache(string $uri, string $method, array $params, array $config) {
		// Getting data from the storage here
		if($method == 'GET') {
			$file = __DIR__ . '/' . $this->getCacheKey($uri, $params) . '.cache';
			if(file_exists($file)) {
				$data = unserialize(file_get_contents($file));
				return $data;
			}
		}
		return null;
	}
	
	// Set caching data for a specific requests
	public function setCache(string $uri, string $method, array $params, array $config, $dataObject) {
		// Save data to the storage here
		if($method == 'GET') {
			$file = __DIR__ . '/' . $this->getCacheKey($uri, $params) . '.cache';
			file_put_contents($file, serialize($dataObject));
		}
	}
	
	protected function getCacheKey($uri, $params) {
		return preg_replace('/[^A-Za-z0-9]/', '_', $uri) . md5(serialize($params));
	}
}

// Create configurator and set node uri
$configurator = new Relictum\RPHPSDK\RequestConfigurator([
	'config' => ['base_uri' => 'http://190.2.146.126/api/'],
	'cache' => MyRelictumCache::class // Set your own query caching system
]);

class MyTransactionDataObject extends Relictum\RPHPSDK\DataObjects\DefaultDataObject
{
	// Your own method that complements the functionality of the node data object
	public function getFrom() {
		// Getting and sending a new instance of a request in a data object
		return \Relictum\RPHPSDK\Executor::getRequest($this)->getAccount($this->from_account)->current();
	}
	
	// Your own method that complements the functionality of the node data object
	public function getTo() {
		// Getting and sending a new instance of a request in a data object
		return \Relictum\RPHPSDK\Executor::getRequest($this)->getAccount($this->to_account)->current();
	}
}

\Relictum\RPHPSDK\Executor::setDataObjectClass('transaction/([0-9]+|[a-zA-Z0-9]{64})', MyTransactionDataObject::class);

// Create a new request
$request = new Relictum\RPHPSDK\Request($configurator);

// Get a transaction
$transaction = $request->getTransaction(1);

// Call your own method to get the transaction sender as data object
var_dump($transaction->getFrom());