DIDWW API 2 client for PHP 5.3

[![Build Status](https://travis-ci.org/didww/php-sdk.svg?branch=master)](https://travis-ci.org/didww/php-sdk)
[![Coverage Status](https://coveralls.io/repos/didww/php-sdk/badge.svg?branch=master&service=github)](https://coveralls.io/github/didww/php-sdk?master)

About DIDWW API 2.0 !
-----

The DIDWW API is available free of charge to resellers and no licensing costs are applicable. 
In addition, no setup fees are payable to DIDWW for services purchased via this API, 
adding to the attractiveness and flexibility of this model from a business perspective. 

Read more http://open.didww.com/index.php/DIDWW_API_2.0

Usage
-----

###Connection initialization
```php  
    $userName = "user@gmail";
    $password = "44AEIRTCH5NE2MAPDXYGKHJHH";
    $testMode = false;
    use Didww\API2\ApiCredentials, Didww\API2\ApiClient as Client;
    Client::setCredentials(new ApiCredentials($userName,$password,$testMode));
    Client::setDebug(false);
```    

###Create DID number
```php    
    use Didww\API2\Order;
    use Didww\API2\MappingToGtalk;
    
    $order = new Order();
    $order->setMapData(new MappingToGtalk("googlemail@gmail.com"));
    $order->setCustomerId(81);
    $order->setCountryIso("IL");
    $order->setCityId(908);
    $order->setCityPrefix(8);
    $order->setPeriod(1);
    $number = $order->createNumber();
```
###Change Mapping
```php    
    use Didww\API2\MappingToGtalk;
    $order->updateMapping(new MappingToGtalk("anothergooglemail@gmail.com"));
```    

###Customer balance list
```php
    use Didww\API2\Balance;
    $balances =  Balance::getBalanceList();
```   
    

###Working with balance
```php
    $balance = new Balance();
    $balance->setCustomerId(81);
    $balance->synchronizePrepaidBalance();
    echo $balance->getPrepaidBalance();
    $balance->removeFunds(10);
    $balance->addFunds(20);
```

###CDR and CDR charges
```php
    use Didww\API2\CDR;
    use Didww\API2\CDRInvoice;
    use Didww\API2\CDRCollection;
    
    $invoice = new CDRInvoice();
    $invoice->setCustomerId(81);
    $invoice->setFromDate('2012-01-01');
    $invoice->setToDate('2012-01-31');
    
    $invoice->load();
    echo $invoice->getAmount();
    
    
    $cdrs = new CDRCollection();
    $cdrs->setFromDate('2012-01-01');
    $cdrs->setToDate('2012-03-01');
    $cdrs->setCustomerId(85);
    $cdrs->load();
```

###Regions
```php
    use Didww\API2\Country;
    $countries = Country::getAll();
```

###Cities
```php
 use Didww\API2\Country;
 $country = new Country(array('country_iso'=>'US'));
 $country->loadCities()->getCities();
```

And much more....
    



