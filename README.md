# Relictum PHP SDK
A library for PHP that interacts with the relictum blockchain API

## Install

```bash
> composer require relictumblockchain/rphpsdk
```
## Requirements

* PHP >7.3

## Example

```php

// Create configurator and set node uri
$configurator = new RPHPSDK\Relictum\RequestConfigurator(['config' => ['base_uri' => 'http://190.2.146.126/api/']]);

// Create a new request
$request = new RPHPSDK\Relictum\Request($configurator);

// Output node api version
var_dump($request->getApiVersion()->version);



```

See the examples folder for more use cases.