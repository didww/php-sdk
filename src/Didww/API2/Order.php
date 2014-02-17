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
 * Order
 *
 * @category DIDWW
 * @package API2
 * @copyright Copyright (C) 2012 by Igor Fedoronchuk
 * @license MIT
 */
class Order extends ClientObject
{
    /**
     * id to identify reseller's customer
     * @var int
     */
    protected $customerId = null;

    /**
     * ISO2 code
     * @var string
     */
    protected $countryIso = null;

    /**
     * phone prefix of city
     * @var string
     */
    protected $cityPrefix = null;

    /**
     *period of order in months
     * @var int
     */
    protected $period = null;

    /**
     * mapping of new order
     * @var Mapping
     */
    protected $mapData = null;

    /**
     * prepaid founds of customer to change balance
     * @var float
     */
    protected $prepaidFunds = 0;

    /**
     * unique transaction hash
     * @var string
     */
    protected $uniqHash = null;

    /**
     * API2 city ID
     * @var int
     */
    protected $cityId = null;

    /**
     * flag to use autorenew of order on API side
     * @var bool
     */
    protected $autorenewEnable = true;

    /**
     * country object of order
     * @var Country
     */

    protected $_country = null;

    /**
     * DIDNumber object of order
     * @var DIDNumber
     */
    protected $_number = false;

    /**
     * Class constructor
     * @param array $properties
     */
    function __construct($properties = array())
    {
        $this->_number = new DIDNumber($this);
        $this->mapData = new Mapping();
        $this->cityPrefix = 0;
        parent::__construct($properties);
    }

    /**
     *get customerId property
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
     * get countryIso property
     * @return string
     */
    public function getCountryIso()
    {
        return $this->countryIso;
    }

    /**
     * set countryIso property
     * @param string $countryIso
     */
    public function setCountryIso($countryIso)
    {
        $this->countryIso = $countryIso;
    }

    /**
     * get cityPrefix property
     * @return string
     */
    public function getCityPrefix()
    {
        return $this->cityPrefix;
    }

    /**
     * set cityPrefix property
     * @param string $cityPrefix
     */
    public function setCityPrefix($cityPrefix)
    {
        $this->cityPrefix = $cityPrefix;
    }

    /**
     * get period property
     * @return int
     */
    public function getPeriod()
    {
        return $this->period;
    }

    /**
     * set period property
     * @param int $period
     */
    public function setPeriod($period)
    {
        $this->period = (int)$period;
    }

    /**
     * get mapData property
     * @return Mapping
     */
    public function getMapData()
    {
        return $this->mapData;
    }

    /**
     * set  mapData property
     * @param Mapping $mapData
     */
    public function setMapData(Mapping $mapData)
    {
        $this->mapData = $mapData;
    }

    /**
     * get prepaidFunds property
     * @return float
     */
    public function getPrepaidFunds()
    {
        return $this->prepaidFunds;
    }

    /**
     * set prepaidFunds property
     * @param float $prepaidFunds
     */
    public function setPrepaidFunds($prepaidFunds)
    {
        $this->prepaidFunds = $prepaidFunds;
    }

    /**
     * get uniqHash property
     * @return string
     */
    public function getUniqHash()
    {
        return $this->uniqHash;
    }

    /**
     * set uniqHash property
     * @param string $uniqHash
     */
    public function setUniqHash($uniqHash)
    {
        $this->uniqHash = $uniqHash;
    }

    /**
     * get cityId property
     * @return int
     */
    public function getCityId()
    {
        return $this->cityId;
    }

    /**
     *set cityId property
     * @param int $cityId
     */
    public function setCityId($cityId)
    {
        $this->cityId = $cityId;
    }

    /**
     *get autorenewEnable property
     * @return bool
     */
    public function getAutorenewEnable()
    {
        return $this->autorenewEnable;
    }

    /**
     *set autorenewEnable property
     * @param bool $autorenewEnable
     */
    public function setAutorenewEnable($autorenewEnable)
    {
        $this->autorenewEnable = (int)(bool)$autorenewEnable;
    }


    /**
     * get _country property
     * @return Country
     */
    public function getCountry()
    {
        if (!($this->_country instanceof Country)) {
            $this->_country = new Country();
            $this->_country->setCountryIso($this->getCountryIso());
        }
        return $this->_country;
    }

    public function hasPBXwwMapping()
    {
        return (bool) strpos($this->getMapData()->getMapDetail(), 'didreseller.com');
    }

    /**
     * get object state as array
     * @see parent::toArray()
     * @param array $options
     * @return array
     */
    public function toArray($options = array())
    {

        $includeNumber = true;
        if (isset($options['includeNumber'])) {
            $includeNumber = (bool)$options['includeNumber'];
            unset($options['includeNumber']);
        }

        return array_merge(parent::toArray($options), $includeNumber ? $this->_ensureNumber()->toArray() : array());
    }

    /**
     * create object from flat array
     * @see parent::fromList()
     * @param array $array
     */

    public function  fromFlatList($array)
    {
        //try to load order properties
        $assignType = $this->getAssignType();
        $this->setAssignType(\Didww\API2\Object::ASSIGN_IGNORE);
        $array = parent::fromArray($array);
        $this->setAssignType($assignType);

        //try to load number properties
        $number = $this->_ensureNumber();
        $assignType = $number->getAssignType();
        $number->setAssignType(\Didww\API2\Object::ASSIGN_IGNORE);
        $array = $number->fromArray($array);
        $number->setAssignType($assignType);

        //finally create mapping object
        $mapping = Mapping::create($array);

        $this->setMapData($mapping);
    }


    /**
     * create object from  array
     * @see parent::fromArray
     * @param array $array
     */
    public function fromArray($array)
    {

        if (!empty($array['number'])) {
            $this->_ensureNumber()->fromArray($array['number']);
            unset($array['number']);
        }

        if (!empty($array['map_data'])) {
            $this->setMapData(Mapping::create($array['map_data']));
            unset($array['map_data']);
        }

        parent::fromArray($array);
    }

    /*
     * didnumber wrapping
     * get DIDNumber object associated with order
     * @return \Didww\API2\DIDNumber 
     */
    protected function _ensureNumber()
    {
        if (!$this->_number instanceof DIDNumber) {
            $this->setNumber(new DIDNumber($this));
        }
        return $this->getNumber();
    }

    /**
     * create DIDNumber using DIDWW API2
     * @return Order
     */
    function createNumber()
    {
        if (!($this->getNumber() instanceof DIDNumber) || !$this->getNumber()->getDIDNumber()) {
            $tmpHash = false;
            if (!$this->uniqHash) {
                $tmpHash = true;
                $this->uniqHash = $this->generateUniqueHash();
            }
            $this->_number = DIDNumber::create($this);

            if ($tmpHash) {
                $this->uniqHash = NULL;
            }
        }
        return $this;
    }

    /**
     * get $_number property
     * @return DIDNumber
     */
    function getNumber()
    {
        return $this->_number;
    }

    /**
     * set $_number property
     * @param DIDNumber $number
     */
    function setNumber(DIDNumber $number)
    {
        $this->_number = $number;
    }

    /**
     * methods delegators to DIDNumber object
     *
     * @method bool isOrderPending()
     * @method bool isActive()
     * @method bool isBlocked()
     * @method bool isRemoved()
     * @method bool isOrderCompleted()
     * @method bool updateMapping(Mapping $newMapping)
     * @method DIDNumber reloadByOrderId()
     * @method DIDNumber fromServiceData($data)
     * @method DIDNumber reloadByNumber()
     * @method DIDNumber cancel()
     * @method DIDNumber renew()
     * @method DIDNumber changeAutorenew($flag)
     * @method string getCountryName()
     * @method string getCityName()
     * @method string getDIDNumber()
     * @method string getDIDStatus()
     * @method string getDIDTimeLeft()
     * @method string getDIDExpireDateGmt()
     * @method string getDIDMappingFormat()
     * @method int getOrderId()
     * @method string getOrderStatus()
     * @method float getPrepaidBalance()
     * @method float getDIDMonthly()
     * @method float getDIDSetup()
     * @method int getDIDPeriod()
     * @method setCountryName(string $countryName)
     * @method setCityName(string $cityName)
     * @method setDIDNumber(int $didNumber)
     * @method setDIDStatus(int $didStatus)
     * @method setDIDTimeLeft(int $timeLeft)
     * @method setDIDExpireDateGmt(string $dateStr)
     * @method setDIDMappingFormat(string $mappingFormat)
     * @method setOrderId(string $orderId)
     * @method setOrderStatus(string $orderStatus)
     * @method setPrepaidBalance(float $preparedBalance)
     * @method setDIDMonthly(float $didMonthly)
     * @method setDIDSetup(float $didSetup)
     * @method setDIDPeriod(int $period)
     *
     *
     * @param string $methodName
     * @param array $args
     * @return mixed
     * @throws \BadMethodCallException
     */

    public function __call($methodName, $args)
    {
        if (method_exists($this->_number, $methodName)) {
            return call_user_func_array(array($this->_ensureNumber(), $methodName), $args);
        }
        throw  new BadMethodCallException("Method $methodName doesn't exist");
    }


    /**
     * generte uniqueHash for order create API call
     * @return string
     */
    public function generateUniqueHash()
    {
        return md5(sprintf("%s.%s.%s.%s.%s.%s.%s",
            $this->getCustomerId(),
            $this->getCountryIso(),
            $this->getCityId(),
            $this->getCityPrefix(),
            $this->getMapData()->getMapDetail(),
            $this->getAutorenewEnable(),
            date("YmdHis")
        ));
    }

}
