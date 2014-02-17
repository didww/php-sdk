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
 * @author Igor Fedoronchuk<fedoronchuk@gmail.com>
 * @copyright Copyright (C) 2012 by Igor Fedoronchuk
 * @license MIT
 */

namespace Didww\API2;


/**
 * PaidForItem
 * Class that wraps payed for item
 * @category DIDWW
 * @package API2
 * @copyright Copyright (C) 2012 by Igor Fedoronchuk
 * @license MIT
 */
abstract class PaidForItem extends ServerObject
{
    /**
     * CustomerId of item
     * @var int
     */
    protected $customerId = null;

    /**
     * source of item
     * @var string
     */
    protected $source = null;

    /**
     * destination of item
     * @var string
     */
    protected $destination = null;

    /**
     * date of item in GMT
     * @var string
     */
    protected $dateGmt = null;

    /**
     * reason of item status
     * @var string
     */
    protected $reason = null;

    /**
     * amount value for reseller in USD  for item
     * @var float
     */
    protected $resellerBilledUsd = null;

    /**
     * amount value for customer in points  for item
     * @var float
     */
    protected $customerBilledPoints = null;

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
        $this->customerId = $customerId;
    }

    /**
     * get source property
     * @return  string
     */
    public function getSource()
    {
        return $this->source;
    }

    /**
     * set source property
     * @param string $source
     */
    public function setSource($source)
    {
        $this->source = $source;
    }

    /**
     * get description property
     * @return string
     */
    public function getDestination()
    {
        return $this->destination;
    }

    /**
     * set description property
     * @param string $destination
     */
    public function setDestination($destination)
    {
        $this->destination = $destination;
    }

    /**
     * get  dateGmt property
     * @return string
     */
    public function getDateGmt()
    {
        return $this->dateGmt;
    }

    /**
     * set  dateGmt property
     * @param string $dateGmt
     */
    public function setDateGmt($dateGmt)
    {
        $this->dateGmt = $dateGmt;
    }


    /**
     * get resellerBilledUsd property
     * @return float
     */
    public function getResellerBilledUsd()
    {
        return $this->resellerBilledUsd;
    }

    /**
     * set resellerBilledUsd property
     * @param float $resellerBilledUsd
     */
    public function setResellerBilledUsd($resellerBilledUsd)
    {
        $this->resellerBilledUsd = $resellerBilledUsd;
    }

    /**
     *  get customerBilledPoints property
     * @return float
     */
    public function getCustomerBilledPoints()
    {
        return $this->customerBilledPoints;
    }

    /**
     * set customerBilledPoints property
     * @param float $customerBilledPoints
     */
    public function setCustomerBilledPoints($customerBilledPoints)
    {
        $this->customerBilledPoints = $customerBilledPoints;
    }

    /**
     * get reason property
     * @return string
     */
    public function getReason()
    {
        return $this->reason;
    }

    /**
     * set reason property
     * @param string $reason
     */
    public function setReason($reason)
    {
        $this->reason = $reason;
    }

}