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
 * @author Fedoronchuk Igor <fedoronchuk@gmail.com>
 * @copyright Copyright (C) 2012 by Igor Fedoronchuk
 * @license MIT
 */

namespace Didww\API2;

/**
 * ApiDetails
 * Class that has wraps data about reseller account
 * @category DIDWW
 * @package API2
 * @copyright Copyright (C) 2012 by Igor Fedoronchuk
 * <code>
 * //connection to didww api2
 * use Didww\API2\ApiDetails;
 * $details =  new ApiDetails();
 * echo $details->getResellerBalance();
 * </code>
 * @license MIT
 */
class ApiDetails extends ServerObject
{
    /**
     * server full version of API2
     * @var string
     */
    protected $apiVersion = null;

    /**
     * name of reseller price list
     * @var string
     */
    protected $resellerDidPricelist = null;

    /**
     * name of reseller pstn tariff
     * @var string
     */
    protected $resellerPstnTariff = null;

    /**
     * current  balance of reseller
     * @var float
     */
    protected $resellerBalance = null;

    /**
     * status of reseller balance
     * @var string
     */
    protected $resellerBalanceStatus = null;

    /**
     * id of reseller
     * @var int
     */
    protected $resellerId = null;

    /**
     * constructor
     * every time new object is created, Api method is called
     */
    public function __construct()
    {
        parent::__construct();
        $properties = $this->call('getdidwwapidetails', array());

        $properties = (array)$properties;
        unset($properties['result']);
        unset($properties['error']);
        $this->fromArray($properties);
    }

    /**
     * get apiVersion property
     * @return string
     */
    public function getApiVersion()
    {
        return $this->apiVersion;
    }

    /**
     * set apiVersion property
     * @param string $apiVersion
     */
    public function setApiVersion($apiVersion)
    {
        $this->apiVersion = $apiVersion;
    }


    /**
     * get resellerDidPricelist property
     * @return string
     */
    public function getResellerDidPricelist()
    {
        return $this->resellerDidPricelist;
    }

    /**
     * set resellerDidPricelist property
     * @param string $resellerDidPricelist
     */
    public function setResellerDidPricelist($resellerDidPricelist)
    {
        $this->resellerDidPricelist = $resellerDidPricelist;
    }

    /**
     * get resellerPstnTariff property
     * @return string
     */
    public function getResellerPstnTariff()
    {
        return $this->resellerPstnTariff;
    }

    /**
     * set resellerPstnTariff property
     * @param string $resellerPstnTariff
     */
    public function setResellerPstnTariff($resellerPstnTariff)
    {
        $this->resellerPstnTariff = $resellerPstnTariff;
    }

    /**
     * get  resellerBalance property
     * @return float
     */
    public function getResellerBalance()
    {
        return $this->resellerBalance;
    }

    /**
     * set resellerBalance property
     * @param float $resellerBalance
     */
    public function setResellerBalance($resellerBalance)
    {
        $this->resellerBalance = $resellerBalance;
    }

    /**
     * get resellerId property
     * @return int
     */
    public function getResellerId()
    {
        return $this->resellerId;
    }

    /**
     * set resellerId property
     * @param int $resellerId
     */
    public function setResellerId($resellerId)
    {
        $this->resellerId = $resellerId;
    }

    /**
     * get resellerBalanceStatus property
     * @return string
     */
    public function getResellerBalanceStatus()
    {
        return $this->resellerBalanceStatus;
    }


    /**
     * set resellerBalanceStatus property
     * @param string $resellerBalanceStatus
     */
    public function setResellerBalanceStatus($resellerBalanceStatus)
    {
        $this->resellerBalanceStatus = $resellerBalanceStatus;
    }

    /**
     * magic __toString implementation
     * @return string
     */
    public function __toString()
    {
        return print_r($this, true);
    }

}