<?php

require(__DIR__ . '/../vendor/autoload.php');

// Create configurator and set node uri
$configurator = new Relictum\RPHPSDK\RequestConfigurator(['config' => ['base_uri' => 'http://190.2.145.42/api/']]);

// Create a new request
$request = new Relictum\RPHPSDK\Request($configurator);

try {
	// Create a new user
	$request->doUserCreate([
		'mail' => 'test1@example.com',
		'pass' => 'password12345'
	]);
}
catch(Relictum\RPHPSDK\Exceptions\NodeRequestException $e) {
	// Catch exception and output error data
	var_dump($e);
}

try {
	// Login user and get auth string
	$userLoginInfo = $request->doUserLogin([
		'mail' => 'test@example.com',
		'pass' => 'password12345'
	]);

	// Set authorization for current user
	$configurator->setAuthorization(new \Relictum\RPHPSDK\Helpers\UserAuthorizationHelper($userLoginInfo->auth));

	// Output user address
	var_dump($request->getUserInfo()->address);

	// Output user balance for specific token
	$userBalanceInfo = $request->getUserBalance(['symbol' => 'USDR']);
	var_dump($userBalanceInfo->balances->current());

	// Transfer tokens
	$transfer = $request->doUserTransfer([
		'symbol' => 'USDR',
		'amount' => 13,
		'to' => '5'
	]);
	
	// Check if transfer is waiting
	if($transfer->isWaiting()) {
		
		// Waiting for the transfer - sleep just for example.
		sleep(10);
		
		// Output transfer hash
		$transferStatusInfo = $request->getUserTransferStatus([
			'wait_id' => $transfer->wait_id
		]);
		var_dump($transferStatusInfo->hash);
	}
	else {
		// Output transfer hash
		var_dump($transfer->hash);
	}
}
catch(Relictum\RPHPSDK\Exceptions\NodeRequestException $e) {
	// Catch exception and output error data
	var_dump($e);
}