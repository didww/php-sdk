<?php

use Didww\API2\Mapping\IAX;
use Didww\API2\Order;

class OrderTest extends \BaseTest
{

    /**
     * @link http://open.didww.com/index.php/5._Order_Create
     */
    public function testCreateNumber()
    {
        $this->startVCR('order_create_number');

        $order = new Order();
        $order->setUniqHash('f688de8622ea6379029690b9580520be'); // fixtures/order_create_number
        $order->setMapData(new IAX("localhost", "username"));
        $order->setCustomerId(81);
        $order->setCountryIso("US");
        $order->setCityId(1537);
        $order->setPeriod(1);

        $response = $order->createNumber();

        $this->assertInstanceOf('Didww\API2\Order', $response);
        $this->assertInstanceOf('Didww\API2\DIDNumber', $response->getNumber());
        $this->assertInstanceOf('Didww\API2\Mapping\IAX', $response->getMapData());

        $this->assertFalse($response->hasPBXwwMapping());
        $this->assertEquals(1537, $response->getCityId());
        $this->assertEquals(0, $response->getPrepaidFunds());
        $this->assertEquals(1, $response->getPeriod());
        $this->assertEquals(0, $response->getCityPrefix());
        $this->assertEquals("US", $response->getCountryIso());
        $this->assertEquals(81, $response->getCustomerId());


        $this->stopVCR();
    }

}
