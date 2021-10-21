<?php

require(__DIR__ . '/../vendor/autoload.php');

$privateKeyPatch = __DIR__ . '/key.key';
$privateKeyPassphrase = 'passphrase';

$authorizationHelper = new \RPHPSDK\Relictum\Helpers\AuthorizationHelper($privateKeyPatch, $privateKeyPassphrase);

// Create configurator and set node uri
$configurator = new RPHPSDK\Relictum\RequestConfigurator([
	'config' => ['base_uri' => 'http://190.2.146.126/api/'],
	'authorization' => $authorizationHelper
]);

// Create a new request
$request = new RPHPSDK\Relictum\Request($configurator);

try {
	// Create a new transfer
	$response = $request->doTransfer([
		'token' => 'USDR', // token
		'amount' => 20, // amount of tokens
		'data' => [
			'account' => 1 // ID of the recipient node
		]
	]);
}
catch(RPHPSDK\Relictum\Exceptions\NodeRequestException $e) {
	// Catch exception and output error data
	var_dump($e);
}

// Output node response
var_dump($response);