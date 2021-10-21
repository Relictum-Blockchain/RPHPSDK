<?php

namespace RPHPSDK\Relictum\Helpers;

class UserAuthorizationHelper implements AuthorizationHelperInterface
{
	private $authString;
	
	/**
	* Create a new Relictum User Authorization object to authorize requests using a user temporary auth string
	*
	* @param ?string $authString
	*/
	public function __construct(string $authString = '')
	{
		$this->setAuthString($authString);
	}
	
	public function authorize(array $params) : array
	{
		if( ! empty($this->authString)) {
			$params['auth'] = $this->authString;
		}
		
		return $params;
	}
	
	/**
	* Set a user auth string to authorize requests
	*
	* @param string $authString
	*/
	public function setAuthString(string $authString)
	{
		$this->authString = $authString;
	}
}
