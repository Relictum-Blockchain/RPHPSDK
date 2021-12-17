<?php

namespace Relictum\RPHPSDK;

/**
* A PHP API for interacting with the Relictum
*
* @package RPHPSDK
* @since   1.0.0
*/

class Request
{
	protected $authorization;
	protected $cache;
	protected $transport;
	
	protected $configurator;
	protected $config = [];
	
	public $uri;
	public $method;
	public $params;
	
	/**
	* Create a new Relictum Request object
	*
	* @param RequestConfigurator $configurator
	*/
	public function __construct(RequestConfigurator $configurator)
	{
		$this->configurator = $configurator;
	}
	
	/**
	* Set authorization helper for request
	*
	* @param AuthorizationHelperInterface $authorization
	*/
	public function setAuthorization(\Relictum\RPHPSDK\Helpers\AuthorizationHelperInterface $authorization)
	{
		$this->authorization = $authorization;
	}
	
	/**
	* Set cache helper for request
	*
	* @param CacheHelperInterface $cache
	*/
	public function setCache(\Relictum\RPHPSDK\Helpers\CacheHelperInterface $cache)
	{
		$this->cache = $cache;
	}
	
	/**
	* Set transport helper for request
	*
	* @param RequestTransportInterface $transport
	*/
	public function setTransport(\Relictum\RPHPSDK\Transports\RequestTransportInterface $transport)
	{
		$this->transport = $transport;
	}
	
	/**
	* Set additional configuration for request
	*
	* @param array $config
	*/
	public function setConfig(array $config)
	{
		$this->config = $config;
	}
	
	/**
	* Get api version from relictum node
	*
	* @return DataObjectInterface
	* @throws NetworkErrorException
	* @throws NodeRequestException
	*/
	public function getApiVersion()
	{
		return $this->execute('v', 'GET', []);
	}
	
	/**
	* Get account info from relictum node
	*
	* @param int|string $identity
	* @param array $params
	* @return DataObjectInterface
	* @throws NetworkErrorException
	* @throws NodeRequestException
	*/
	public function getAccount($identity, array $params = ['type' => 'balance'])
	{
		return $this->execute('account/' . $identity, 'GET', $params);
	}
	
	/**
	* Get accounts collection info from relictum node
	*
	* @param int|string $identity
	* @return CollectionDataObjectInterface
	* @throws NetworkErrorException
	* @throws NodeRequestException
	*/
	public function getAccounts(array $params = [])
	{
		return $this->execute('account/', 'GET', $params);
	}
	
	/**
	* Get transaction info from relictum node
	*
	* @param int|string $identity
	* @param array $params
	* @return DataObjectInterface
	* @throws NetworkErrorException
	* @throws NodeRequestException
	*/
	public function getTransaction($identity, array $params = [])
	{
		return $this->execute('transaction/' . $identity, 'GET', $params);
	}
	
	/**
	* Get transactions collection info from relictum node
	*
	* @param array $params
	* @return CollectionDataObjectInterface
	* @throws NetworkErrorException
	* @throws NodeRequestException
	*/
	public function getTransactions(array $params = [])
	{
		return $this->execute('transactions/', 'GET', $params);
	}
	
	/**
	* Get chains collection info from relictum node
	*
	* @return CollectionDataObjectInterface
	* @throws NetworkErrorException
	* @throws NodeRequestException
	*/
	public function getChains()
	{
		return $this->execute('chains', 'GET', []);
	}
	
	/**
	* Get chain data collection info from relictum node
	*
	* @param string $chain
	* @param array $params
	* @return CollectionDataObjectInterface
	* @throws NetworkErrorException
	* @throws NodeRequestException
	*/
	public function getChainData(string $chain, array $params = [])
	{
		return $this->execute('chains/' . $chain, 'GET', $params);
	}
	
	/**
	* Get contract results data from relictum node
	*
	* @param string $contract
	* @param array $params
	* @return CollectionDataObjectInterface
	* @throws NetworkErrorException
	* @throws NodeRequestException
	*/
	public function getContractResults(string $contract, array $params = [])
	{
		return $this->execute('contract/' . $contract . '/results', 'GET', $params);
	}
	
	/**
	* Get royalty info from relictum node
	*
	* @param array $params
	* @return CollectionDataObjectInterface
	* @throws NetworkErrorException
	* @throws NodeRequestException
	*/
	public function getRoyalty(array $params = [])
	{
		return $this->execute('royalty', 'GET', $params);
	}
	
	/**
	* Execute transfer with relictum node
	*
	* @param array $params
	* @return DataObjectInterface
	* @throws NetworkErrorException
	* @throws NodeRequestException
	*/
	public function doTransfer(array $params)
	{
		return $this->execute('transfer', 'POST', $params);
	}
	
	/**
	* Create payment for contract with relictum node
	*
	* @param string $contract
	* @param array $params
	* @return DataObjectInterface
	* @throws NetworkErrorException
	* @throws NodeRequestException
	*/
	public function doPaymentCreate(string $contract, array $params)
	{
		return $this->execute('payments/' . $contract . '/new', 'POST', $params);
	}
	
	/**
	* Get payments info for contract with relictum node
	*
	* @param string $contract
	* @param array $params
	* @return CollectionDataObjectInterface
	* @throws NetworkErrorException
	* @throws NodeRequestException
	*/
	public function checkPayments(string $contract, array $params)
	{
		return $this->execute('payments/' . $contract . '/pay', 'GET', $params);
	}
	
	/**
	* Get version of webuser api from relictum node
	*
	* @param array $params
	* @return DataObjectInterface
	* @throws NetworkErrorException
	* @throws NodeRequestException
	*/
	public function getUserVersion(array $params = [])
	{
		return $this->execute('user/version', 'POST', $params);
	}
	
	/**
	* Register new user with relictum node webuser api
	*
	* @param array $params
	* @return DataObjectInterface
	* @throws NetworkErrorException
	* @throws NodeRequestException
	*/
	public function doUserCreate(array $params)
	{
		return $this->execute('user/create', 'POST', $params);
	}
	
	/**
	* Login user and get user auth data with relictum node webuser api 
	*
	* @param array $params
	* @return DataObjectInterface
	* @throws NetworkErrorException
	* @throws NodeRequestException
	*/
	public function doUserLogin(array $params)
	{
		return $this->execute('user/login', 'POST', $params);
	}
	
	/**
	* Get info about user from relictum node webuser api
	*
	* @param array $params
	* @return DataObjectInterface
	* @throws NetworkErrorException
	* @throws NodeRequestException
	*/
	public function getUserInfo(array $params = [])
	{
		return $this->execute('user/getinfo', 'POST', $params);
	}
	
	/**
	* Get user balance info from relictum node webuser api
	*
	* @param array $params
	* @return DataObjectInterface
	* @throws NetworkErrorException
	* @throws NodeRequestException
	*/
	public function getUserBalance(array $params)
	{
		return $this->execute('user/balance', 'POST', $params);
	}
	
	/**
	* Get user private key from relictum node webuser api
	*
	* @param array $params
	* @return DataObjectInterface
	* @throws NetworkErrorException
	* @throws NodeRequestException
	*/
	public function getUserPkey(array $params = [])
	{
		return $this->execute('user/pkey', 'POST', $params);
	}
	
	/**
	* Execute user transfer with relictum node webuser api 
	*
	* @param array $params
	* @return DataObjectInterface
	* @throws NetworkErrorException
	* @throws NodeRequestException
	*/
	public function doUserTransfer(array $params)
	{
		return $this->execute('user/transfer', 'POST', $params);
	}
	
	
	/**
	* Get status of transfer, created by relictum node webuser api 
	*
	* @param array $params
	* @return DataObjectInterface
	* @throws NetworkErrorException
	* @throws NodeRequestException
	*/
	public function getUserTransferStatus(array $params)
	{
		return $this->execute('user/transfer/status', 'POST', $params);
	}
	/**
	* Get nft list from relictum node
	*
	* @param array $params
	* @return CollectionDataObjectInterface
	* @throws NetworkErrorException
	* @throws NodeRequestException
	*/
	public function getNftList(array $params = [])
	{
		return $this->execute('nft/list', 'GET', $params);
	}
	
	/**
	* Create a sale request for an NFT token with relictum node
	*
	* @param array $params
	* @return DataObjectInterface
	* @throws NetworkErrorException
	* @throws NodeRequestException
	*/
	public function doNftBid(array $params)
	{
		return $this->execute('nft/bid', 'POST', $params);
	}
	
	/**
	* Get nft file info from relictum node
	*
	* @param int|string $identity
	* @return DataObjectInterface
	* @throws NetworkErrorException
	* @throws NodeRequestException
	*/
	public function getNftFile($identity)
	{
		return $this->execute('nft/file/' . $identity, 'GET', []);
	}
	
	/**
	* Execute the current request to the relictum node
	*
	* @param string $uri
	* @param string $method
	* @param array $params
	* @return DataObjectInterface
	* @throws NetworkErrorException
	* @throws NodeRequestException
	*/
	public function execute($uri, $method, $params)
	{
		$this->configurator->configure($this);
		
		$this->uri = $uri;
		$this->method = $method;
		$this->params = $params;
		
		return Executor::execute($this);
	}
	
	/**
	* Send request data to the relictum node
	*
	* @return array
	* @throws NetworkErrorException
	*/
	public function send()
	{
		if($this->cache) {
			$dataObject = $this->cache->getCache($this->uri, $this->method, $this->params, $this->config);
			if($dataObject !== null) {
				return $dataObject;
			}
		}
		
		if($this->authorization) {
			$this->params = $this->authorization->authorize($this->params);
		}
		
		$dataObject = $this->transport->getData($this->uri, $this->method, $this->params, $this->config);
		
		if($this->cache) {
			$this->cache->setCache($this->uri, $this->method, $this->params, $this->config, $dataObject);
		}
		
		return $dataObject;
	}
	
}
