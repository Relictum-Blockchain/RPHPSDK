<?php

require(__DIR__ . '/../vendor/autoload.php');

// Create configurator and set node uri
$configurator = new RPHPSDK\Relictum\RequestConfigurator(['config' => ['base_uri' => 'http://190.2.146.126/api/']]);

// Create a new request
$request = new RPHPSDK\Relictum\Request($configurator);

// Output node api version
var_dump($request->getApiVersion()->version);

// Create a new request
$request = new RPHPSDK\Relictum\Request($configurator); 
// Get last transactions
$transactions = $request->getTransactions(['count' => 7]);

// Output transaction fields
var_dump($transactions->fields());

// Iterating over the received collection
foreach($transactions AS $transaction) {
	// Output transaction data
	var_dump($transaction);
}

// Create a new request
$request = new RPHPSDK\Relictum\Request($configurator);
// Get specific account data
$account = $request->getAccount(1);
// Output account data
var_dump($account);

// Create a new request
$request = new RPHPSDK\Relictum\Request($configurator);
try {
	// Try to get transaction with wrong identity
	$request->getTransaction(11111111);
}
catch(RPHPSDK\Relictum\Exceptions\NodeRequestException $e) {
	// Catch exception and output error data
	var_dump($e);
}