<?php

require __DIR__ . '/../src/autoload.php';

use Didww\API2\ApiCredentials, Didww\API2\ApiClient as Client;

\VCR\VCR::turnOn(); // Important. Must be here, because of SOAP-requests


class BaseTest extends PHPUnit\Framework\TestCase
{
    protected function setUp()
    {
        $userName = "api2-php-sdk-phpunit@didww.com";
        $password = "K84K7MIVNWQ0Z6D9YC0X0FIGBF6AATO";
        $testMode = true;
        Client::setCredentials(new ApiCredentials($userName, $password, $testMode));
        Client::setDebug(false);

        parent::setUp();
    }

    protected function startVCR($cassetteName)
    {
        \VCR\VCR::turnOn();
        \VCR\VCR::insertCassette($cassetteName);
    }

    protected function stopVCR()
    {
        \VCR\VCR::eject();
        \VCR\VCR::turnOff();
    }
}
