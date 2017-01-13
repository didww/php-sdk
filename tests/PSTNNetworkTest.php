<?php

use Didww\API2\PSTNNetwork;

class PSTNNetworkTest extends \BaseTest
{

    /**
     * @link http://open.didww.com/index.php/3._Update_PSTN_Rates
     */
    public function testUpdateNetworks()
    {
        $this->startVCR('pstn_network_update_networks');

        $networkNewValues = new PSTNNetwork();
        $networkNewValues->setNetworkPrefix('1808');
        $networkNewValues->setSellRate(0.05);

        $networks = array($networkNewValues);

        $result = PSTNNetwork::updateNetworks($networks);

        $this->assertNull($result);

        $this->stopVCR();
    }

}
