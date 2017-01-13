<?php

use Didww\API2\Balance;

class BalanceTest extends \BaseTest
{

    public function testGetBalanceList()
    {
        $this->startVCR('balance_get_balance_list');

        $balance = new Balance();
        $balance->setCustomerId(81);

        $list = $balance->getBalanceList();

        foreach ($list as $item) {
            $this->assertInstanceOf('Didww\API2\Balance', $item);
        }

        $this->assertEquals(1, 1);

        $this->stopVCR();
    }

    public function testGetPrepaidBalance()
    {
        $this->startVCR('balance_get_prepaid_balance');

        $balance = new Balance();
        $balance->setCustomerId(81);
        $balance->synchronizePrepaidBalance();

        $this->assertEquals(5.0, $balance->getPrepaidBalance());

        $this->stopVCR();
    }


    public function testChangeBalance()
    {
        $this->startVCR('balance_change_balance');

        $balance = new Balance();
        $balance->setCustomerId(81);
        $balance->synchronizePrepaidBalance();

        $this->assertEquals(5, $balance->getPrepaidBalance());

        $balance->changeBalance(5, '3a5a96ea5f5e389b855fa023bc76e93a');

        $this->assertEquals('5.00000', $balance->getPrepaidBalance());

        $this->stopVCR();
    }


    public function testGetBilledServices()
    {
        $this->startVCR('balance_get_billed_services');

        $balance = new Balance();
        $balance->setCustomerId(81);

        $orders = $balance->getBilledServices();

        foreach($orders as $item) {

            $this->assertInstanceOf('Didww\API2\Order', $item);
            $this->assertEquals(81, $item->getCustomerId());
        }

        $this->stopVCR();
    }

}
