<?php
/**
 * Copyright (C) 2012 Igor Fedoronchuk
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 *
 * @category DIDWW
 * @package API2
 * @copyright Copyright (C) 2012 by Igor Fedoronchuk
 * @license MIT
 */

namespace Didww\API2;


/**
 * CDRInvoice
 *
 * @category DIDWW
 * @package API2
 * @copyright Copyright (C) 2012 by Igor Fedoronchuk
 * @license MIT
 *
 */

class CDRInvoice extends ServerObject
{
    /**
     * customer id of invoice
     * @var int
     */
    protected $customerId = NULL;

    /**
     * invoice begin date
     * @var string
     */
    protected $fromDate = NULL;

    /**
     * invoice end date
     * @var string
     */
    protected $toDate = NULL;

    /**
     * amount for invoice
     * @var float
     */
    protected $amount = NULL;

    /**
     * reseller amount for invoice
     * @var float
     */
    protected $resellerAmount = NULL;

    /**
     * get customerId property
     * @return int
     */
    public function getCustomerId()
    {
        return $this->customerId;
    }

    /**
     * set customerId property
     * @param int $customerId
     */
    public function setCustomerId($customerId)
    {
        $this->customerId = (int)$customerId;
    }

    /**
     * get fromDate property
     * @return string
     */
    public function getFromDate()
    {
        return $this->fromDate;
    }

    /**
     * set fromDate property
     * @param string $fromDate
     */
    public function setFromDate($fromDate)
    {
        $this->fromDate = $fromDate;
    }

    /**
     * get  toDate property
     * @return string
     */
    public function getToDate()
    {
        return $this->toDate;
    }

    /**
     * set toDate property
     * @param string $toDate
     */
    public function setToDate($toDate)
    {
        $this->toDate = $toDate;
    }

    /**
     * get amount
     * @return float
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * get reseller amount
     * @return float
     */
    public function getResellerAmount()
    {
        return $this->resellerAmount;
    }

    /**
     * load amount from API2
     * @return \Didww\API2\CDRInvoice
     */
    public function load()
    {
        $response = $this->call('callhistory_invoices', array(
            'customer_id' => $this->getCustomerId(),
            'from_date' => $this->getFromDate(),
            'to_date' => $this->getToDate()
        ));
        $this->fromArray($response);
        return $this;
    }

}