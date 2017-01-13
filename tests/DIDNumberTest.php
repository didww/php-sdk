<?php
use Didww\API2\DIDNumber;
use Didww\API2\Order;
use Didww\API2\Mapping\IAX;

class DIDNumberTest extends \BaseTest
{

    /**
     * @link http://open.didww.com/index.php/6._Order_Cancel
     */
    public function testCancel()
    {
        $this->startVCR('did_number_cancel');

        $did = $this->buildDIDNumber();

        $result = $did->cancel();

        $this->assertEquals("Canceled", $result->getOrderStatus());

        $this->stopVCR();
    }


    /**
     * @link http://open.didww.com/index.php/11._DID_Number_Restore
     */
    public function testRestore()
    {
        $this->startVCR('did_number_restore');

        $order = new Order();
        $order->setCustomerId(81);
        $order->setPeriod(1);
        $order->setAutorenewEnable(false);
        $order->setUniqHash('e2be12904dd886bd8868ed1f86b8f618');

        $did = new DIDNumber();
        $did->setOrder($order);
        $did->setDidNumber('12518068985');

        $did->restore();

        $this->assertTrue($did->isActive());

        $this->stopVCR();
    }


    /**
     * @link http://open.didww.com/index.php/7._Order_Autorenew
     */
    public function testRenew()
    {
        $this->startVCR('did_number_renew');

        $order = new Order();
        $order->setCustomerId(81);
        $order->setPeriod(1);
        $order->setUniqHash('e2be12904dd886bd8868ed1f86b8f611');

        $did = new DIDNumber();
        $did->setOrder($order);
        $did->setDidNumber('12518068987');

        $result = $did->renew();

        $this->assertEquals("Completed", $result->getOrderStatus());

        $this->stopVCR();
    }


    public function testRenew__failed()
    {
        $this->startVCR('_failed.did_number_renew');

        $order = new Order();
        $order->setCustomerId(81);
        $order->setPeriod(1);
        $order->setUniqHash('e2be12904dd886bd8868ed1f86b8f611');

        $did = new DIDNumber();
        $did->setOrder($order);
        $did->setDidNumber('12518068987');

        try {
            $did->renew();
        } catch (\Exception $e) {
            $errorMessage = $e->getMessage();
        }

        $this->assertEquals('Transaction refused', $errorMessage);

        $this->stopVCR();
    }


    public function testChangeAutorenew()
    {
        $this->startVCR('did_number_change_auto_renew');

        $did = $this->buildDIDNumber();

        $this->assertEquals(0, $did->getOrder()->getAutorenewEnable());

        $did->changeAutorenew(true);

        $this->assertEquals(1, $did->getOrder()->getAutorenewEnable());

        $this->stopVCR();
    }


    /**
     * @link http://open.didww.com/index.php/8._Update_Mapping
     */
    public function testUpdateMapping()
    {
        $this->startVCR('did_number_update_mapping_iax');

        $did = $this->buildDIDNumber();

        $result = $did->updateMapping(new IAX("example.com", "testuser"));

        $this->assertTrue($result);

        $this->stopVCR();
    }


    /**
     * @link http://open.didww.com/index.php/13._Get_Service_Details
     */
    public function testReloadByNumber()
    {
        $this->startVCR('did_number_reload_by_number');

        $did = $this->buildDIDNumber();

        $did->reloadByNumber();

        $this->assertEquals('United States', $did->getCountryName());
        $this->assertEquals('Mobile', $did->getCityName());
        $this->assertEquals('12518068985', $did->getDidNumber());
        $this->assertEquals(1, $did->getDidStatus());
        $this->assertEquals(2677439, $did->getDidTimeLeft());
        $this->assertEquals(1876303, $did->getOrderId());
        $this->assertEquals('Completed', $did->getOrderStatus());
        $this->assertEquals('URI:IAX2/example.com/testuser', $did->getDidMappingFormat());
        $this->assertEquals(0, $did->getDidSetup());
        $this->assertEquals(0.35, $did->getDidMonthly());
        $this->assertEquals(1, $did->getDidPeriod());
        $this->assertEquals(5, $did->getPrepaidBalance());

        $this->stopVCR();
    }

    // TODO: test reloadByOrderId()



    protected function buildDIDNumber()
    {
        $order = new Order();
        $order->setCustomerId(81);
        $order->setPeriod(1);
        $order->setAutorenewEnable(false);
        $order->setUniqHash('e2be12904dd886bd8868ed1f86b8f617');

        $did = new DIDNumber();
        $did->setOrder($order);
        $did->setDidNumber('12518068985');

        return $did;
    }
}
