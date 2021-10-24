<?php

namespace Relictum\RPHPSDK\Helpers;

class AuthorizationHelper implements AuthorizationHelperInterface
{
	private $key;
	private $passphrase = '';
	
	/**
	* Create a new Relictum Authorization object to authorize requests using a private key
	*
	* @param ?string $keyPath
	* @param string $passphrase
	*/
	public function __construct(?string $keyPath = null, string $passphrase = '')
	{
		if($keyPath !== null) {
			$this->setKey($keyPath, $passphrase);
		}
	}
	
	public function authorize(array $params) : array
	{
		if( ! empty($params) && ! empty($params['data']) && ! empty($this->key)) {
			$data = $params['data'];
			$params['sign'] = $this->getSign($data);
		}
		
		return $params;
	}
	
	/**
	* Set a private key to authorize requests
	*
	* @param string $keyPath
	* @param string $passphrase
	*/
	public function setKey(string $keyPath, string $passphrase = '')
	{
		$this->key = 'file://' . $keyPath;
		return $this->setPassphrase($passphrase);
	}
	
	/**
	* Set a passphrase to private key
	*
	* @param string $passphrase
	*/
	public function setPassphrase(string $passphrase)
	{
		$this->passphrase = $passphrase;
		return $this;
	}
	
	public function getSign(array $data): string
	{
		$sign = rtrim(strtr($this->encryptData(sha1(json_encode($data))), '+/', '-_'), '=');
				
		return $sign;
	}
	
    private function encryptData($data) {
        $maxlength = $this->getOpensslEncryptCharSize();
        $output = '';
        while ($data) {
            $input = substr($data, 0, $maxlength);
            $data = substr($data, $maxlength);
            $encrypted = '';
            $result = openssl_private_encrypt($input, $encrypted, $this->getOpensslPKey());
            if ($result === false) {
                return null;
            }
            $output.=$encrypted;
        }
        return base64_encode($output);
    }
	
	private function getOpensslPKey() {
        return openssl_pkey_get_private($this->key, $this->passphrase);
    }

    private function getOpensslCertBits() {
        $detail = openssl_pkey_get_details($this->getOpensslPKey());
        return (isset($detail['bits'])) ? $detail['bits'] : null;
    }

    private function getOpensslCertChars() {
        $certLength = $this->getOpensslCertBits();
        return $certLength / 8;
    }

    private function getOpensslEncryptCharSize() {
        return $this->getOpensslCertChars() - 11;
    }
}
