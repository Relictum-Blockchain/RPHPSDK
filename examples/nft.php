<?php

require(__DIR__ . '/../vendor/autoload.php');

// Create configurator and set node uri
$configurator = new Relictum\RPHPSDK\RequestConfigurator(['config' => ['base_uri' => 'http://190.2.146.126/api/']]);

// Create a new request
$request = new Relictum\RPHPSDK\Request($configurator);

// Get nft list with a specific owner
$nft = $request->getNftList(['owner' => 'TilPMUibitrwRWbnUjmRNVjcjusxSXct']);

// Iterating over the received nft collection
foreach($nft AS $nftToken) {
	// Output token data
	var_dump($nftToken);
	// Download and save nft file
	$nftToken->saveFile(__DIR__);
}