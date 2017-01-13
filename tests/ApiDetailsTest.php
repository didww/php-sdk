<?php
use Didww\API2\ApiDetails;

class ApiDetailsTest extends \BaseTest
{

    // http://open.didww.com/index.php/12._Get_DIDWW_API_Details
    public function testApiDetails()
    {
        $this->startVCR('didww_getdidwwapidetails');

        $details = new ApiDetails();

        $this->assertInstanceOf('Didww\API2\ApiDetails', $details);
        $this->assertEquals('Sandbox API v2.0.158', $details->getApiVersion());
        $this->assertEquals('Retail New (Unbundled)', $details->getResellerDidPricelist());
        $this->assertEquals('Retail Main', $details->getResellerPstnTariff());
        $this->assertEquals('-527.3700', $details->getResellerBalance());
        $this->assertEquals(157041, $details->getResellerId());
        $this->assertEquals('Active', $details->getResellerBalanceStatus());

        $this->stopVCR();
    }

}
