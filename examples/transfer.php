<?php

require(__DIR__ . '/../vendor/autoload.php');

$privateKeyPath = __DIR__ . '/key.key';
$privateKeyPassphrase = 'passphrase';

$authorizationHelper = new \Relictum\RPHPSDK\Helpers\AuthorizationHelper($privateKeyPath, $privateKeyPassphrase);

// Create configurator and set node uri
$configurator = new Relictum\RPHPSDK\RequestConfigurator([
	'config' => ['base_uri' => 'http://190.2.146.126/api/'],
	'authorization' => $authorizationHelper
]);

// Create a new request
$request = new Relictum\RPHPSDK\Request($configurator);

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
catch(Relictum\RPHPSDK\Exceptions\NodeRequestException $e) {
	// Catch exception and output error data
	var_dump($e);
}

// Output node response
var_dump($response);