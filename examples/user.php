<?php

require(__DIR__ . '/../vendor/autoload.php');

// Create configurator and set node uri
$configurator = new RPHPSDK\Relictum\RequestConfigurator(['config' => ['base_uri' => 'http://190.2.146.126/api/']]);

// Create a new request
$request = new RPHPSDK\Relictum\Request($configurator);

try {
	// Create a new user
	$request->doUserCreate([
		'mail' => 'test@example.com',
		'pass' => 'password12345'
	]);
}
catch(RPHPSDK\Relictum\Exceptions\NodeRequestException $e) {
	// Catch exception and output error data
	var_dump($e);
}

// Login user and get auth string
$userLoginInfo = $request->doUserLogin([
	'mail' => 'test@example.com',
	'pass' => 'password12345'
]);

// Set authorization for current user
$configurator->setAuthorization(new \RPHPSDK\Relictum\Helpers\UserAuthorizationHelper($userLoginInfo->auth));

// Output user balance for specific token
var_dump($request->getUserBalance(['symbol' => 'USDR']));

// Transfer tokens
$request->doUserTransfer([
	'symbol' => 'USDR',
	'amount' => 13,
	'to' => '5'
]);