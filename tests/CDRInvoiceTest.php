<?php

use Didww\API2\CDRInvoice;

class CDRInvoiceTest extends \BaseTest
{

    /**
     * @link http://open.didww.com/index.php/15._Call_History_Invoices
     */
    public function testLoad()
    {
        $this->startVCR('cdr_invoice_load');

        $cdrInvoice = new CDRInvoice();
        $cdrInvoice->setCustomerId(81);
        $cdrInvoice->setFromDate('2016-12-01');
        $cdrInvoice->setToDate('2016-12-31');

        $cdrInvoice->load();

        $this->assertEquals(0, $cdrInvoice->getAmount());
        $this->assertEquals(0.0, $cdrInvoice->getResellerAmount());

        $this->stopVCR();
    }

}
