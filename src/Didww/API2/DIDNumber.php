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
 * DIDNumber
 * Class to wrap number object
 * @category DIDWW
 * @package API2
 * @copyright Copyright (C) 2012 by Igor Fedoronchuk
 * @license MIT
 */
class DIDNumber extends ServerObject
{
    /**
     * @const Didww Order completed status
     */
    const ORDER_STATUS_COMPLETED = 'Completed';
    /**
     * @const Didww Order pending status
     */
    const ORDER_STATUS_PENDING = 'Pending';
    /**
     * @const Didww Order cenceled status
     */
    const ORDER_STATUS_CANCELED = 'Canceled';
    /**
     * @const Didww number blocked status
     */
    const DID_STATUS_BLOCKED = -1;
    /**
     * @const Didww number removed status
     */
    const DID_STATUS_REMOVED = -2;
    /**
     * @const Didww number active status
     */
    const DID_STATUS_ACTIVE = 1;
    /**
     * @const Didww number unknown status
     */
    const DID_STATUS_UNKNOWN = 0;

    /**
     * country name of didnumber
     * @var string
     */
    protected $countryName = null;

    /**
     * city name of didnumber
     * @var string
     */
    protected $cityName = null;

    /**
     * didnumber assigned
     * @var string
     */
    protected $didNumber = null;

    /**
     * status of did
     * @var string 1|0|-1|-2
     */
    protected $didStatus = null;

    /**
     * timeleft of did number
     * @var string
     */
    protected $didTimeleft = null;

    /**
     * expired date of didnumber
     * @var string
     */
    protected $didExpireDateGmt = null;

    /**
     * didww order id
     * @var string
     */
    protected $orderId = null;

    /**
     * status of didww order Completed | Canceled | Pending
     * @var string
     */
    protected $orderStatus = null;

    /**
     * specific did mapping string
     * @var string
     */
    protected $didMappingFormat = null;

    /**
     * setup price paid for did
     * @var string
     */
    protected $didSetup = null;

    /**
     * monthly  price paid for did
     * @var string
     */
    protected $didMonthly = null;

    /**
     * paid period
     * @var string
     */
    protected $didPeriod = null;

    /**
     * prepaid amount of customer that was paid
     * @var string
     */
    protected $prepaidBalance = null;

    /**
     * Order object related to current DIDnumber object
     * @var Order
     */
    protected $_order = null;

    /**
     * Construct new didnumber object
     * @param Order $order
     */
    function __construct(Order $order = NULL)
    {
        $this->setOrder($order);
        parent::__construct();
    }

    /**
     * get _order property
     * @return Order
     */
    function getOrder()
    {
        return $this->_order;
    }

    /**
     *set _order property
     * @param Order $order
     */
    function setOrder(Order $order = NULL)
    {
        $this->_order = $order;
    }

    /**
     * get countryName property
     * @return string
     */
    function getCountryName()
    {
        return $this->countryName;
    }

    /**
     * get cityName property
     * @return string
     */
    function getCityName()
    {
        return $this->cityName;
    }

    /**
     * get didNumber property
     * @return string
     */
    function getDidNumber()
    {
        return $this->didNumber;
    }

    /**
     * get didStatus property
     * @return string
     */
    function getDidStatus()
    {
        return (int)$this->didStatus;
    }

    /**
     *get didTimeleft property
     * @return string
     */
    function getDidTimeLeft()
    {
        return $this->didTimeleft;
    }

    /**
     * get didExpireDateGmt property
     * @return string
     */
    function getDidExpireDateGmt()
    {
        return $this->didExpireDateGmt;
    }

    /**
     * get didMappingFormat property
     * @return string
     */
    function getDidMappingFormat()
    {
        return $this->didMappingFormat;
    }

    /**
     * get orderId property
     * @return string
     */
    function getOrderId()
    {
        return $this->orderId;
    }

    /**
     * get orderStatus property
     * @return string
     */
    function getOrderStatus()
    {
        return $this->orderStatus;
    }

    /**
     *get prepaidBalance property
     * @return string
     */
    function getPrepaidBalance()
    {
        return $this->prepaidBalance;
    }

    /**
     * get didMonthly property
     * @return string
     */
    function getDidMonthly()
    {
        return $this->didMonthly;
    }

    /**
     * get didSetup property
     * @return string
     */
    function getDidSetup()
    {
        return $this->didSetup;
    }

    /**
     * get didPeriod property
     * @return string
     */
    function getDidPeriod()
    {
        return $this->didPeriod;
    }

    /**
     * set countryName property
     * @param string $countryName
     */
    public function setCountryName($countryName)
    {
        $this->countryName = $countryName;
    }

    /**
     *set cityName property
     * @param string $cityName
     */
    public function setCityName($cityName)
    {
        $this->cityName = $cityName;
    }

    /**
     * set didNumber property
     * @param string $didNumber
     */
    public function setDidNumber($didNumber)
    {
        $this->didNumber = $didNumber;
    }

    /**
     *set didStatus property
     * @param int $didStatus
     */
    public function setDidStatus($didStatus)
    {
        $this->didStatus = (int)$didStatus;
    }

    /**
     *set didTimeleft property
     * @param string $didTimeleft
     */
    public function setDidTimeleft($didTimeleft)
    {
        $this->didTimeleft = (int)$didTimeleft;
    }

    /**
     *set didExpireDateGmt property
     * @param string $didExpireDateGmt
     */
    public function setDidExpireDateGmt($didExpireDateGmt)
    {
        $this->didExpireDateGmt = $didExpireDateGmt;
    }

    /**
     * set orderId property
     * @param int $orderId
     */
    public function setOrderId($orderId)
    {
        $this->orderId = (int)$orderId;
    }

    /**
     * set orderStatus property
     * @param string $orderStatus
     */
    public function setOrderStatus($orderStatus)
    {
        $this->orderStatus = $orderStatus;
    }

    /**
     *set didMappingFormat property
     * @param string $didMappingFormat
     */
    public function setDidMappingFormat($didMappingFormat)
    {
        $this->didMappingFormat = $didMappingFormat;
    }

    /**
     * set didSetup property
     * @param float $didSetup
     */
    public function setDidSetup($didSetup)
    {
        $this->didSetup = (float)$didSetup;
    }

    /**
     * set didMonthly property
     * @param float $didMonthly
     */
    public function setDidMonthly($didMonthly)
    {
        $this->didMonthly = (float)$didMonthly;
    }

    /**
     * set didPeriod property
     * @param int $didPeriod
     */
    public function setDidPeriod($didPeriod)
    {
        $this->didPeriod = (int)$didPeriod;
    }

    /**
     * set prepaidBalance property
     * @param float $prepaidBalance
     */
    public function setPrepaidBalance($prepaidBalance)
    {
        $this->prepaidBalance = (float)$prepaidBalance;
    }

    /**
     * magic __toString
     * @return string
     */
    public function __toString()
    {
        return $this->getDIDNumber();
    }

    /**
     * create did number for order
     * @link http://open.didww.com/index.php/5._Order_Create
     * @param Order $order
     * @return DIDNumber
     */
    public static function create(Order $order)
    {
        $properties = self::getClientInstance()->call('ordercreate', $order->toArray(array('includeNumber' => false)));
        $did = new DIDNumber($order);
        $did->getOrder()->setCityId($properties['city_id']);
        unset($properties['result'], $properties['autorenew_enable'], $properties['city_prefix'], $properties['country_iso'], $properties['country_iso'], $properties['city_id']);
        $did->fromArray($properties);
        return $did;
    }

    /**
     * change API2 order autorenew enable
     * @param bool $flag
     */
    function changeAutorenew($flag)
    {
        $this->call('order_autorenew_status', array(
            "customer_id" => $this->_order->getCustomerId(),
            "did_number" => $this->getDIDNumber(),
            "status" => (int)$flag
        ));
        $this->_order->setAutorenewEnable($flag);
    }

    /**
     * renew order for current period
     * @link http://open.didww.com/index.php/7._Order_Autorenew
     * @return DIDNumber
     */
    public function renew()
    {
        $properties = $this->call('orderautorenew', array(
            "customer_id" => $this->_order->getCustomerId(),
            "did_number" => $this->getDIDNumber(),
            "period" => $this->_order->getPeriod(),
            "uniq_hash" => $this->generateUniqueHash()
        ));

        $this->getOrder()->setCityId($properties['city_id']);
        unset($properties['result'], $properties['autorenew_enable'], $properties['city_prefix'], $properties['country_iso'], $properties['city_id']);

        unset($properties['result'], $properties['autorenew_enable']);
        $this->fromArray($properties);
        return $this;
    }

    /**
     * cancel order and deactivate did number
     * http://open.didww.com/index.php/6._Order_Cancel
     * @return DIDNumber
     */
    public function cancel()
    {
        $this->call('ordercancel', array(
            "customer_id" => $this->_order->getCustomerId(),
            "did_number" => $this->getDIDNumber()
        ));
        $this->orderStatus = self::ORDER_STATUS_CANCELED;
        $this->didStatus = self::DID_STATUS_BLOCKED;
        return $this;
    }

    /**
     * restore order
     * @return DIDNumber
     */
    public function restore()
    {
        $this->call('didrestore', array(
            "customer_id" => $this->_order->getCustomerId(),
            "did_number" => $this->getDIDNumber(),
            "period" => $this->_order->getPeriod(),
            "uniq_hash" => $this->generateUniqueHash(),
            "isrenew" => $this->_order->getAutorenewEnable()
        ));
        $this->didStatus = self::DID_STATUS_ACTIVE;
        return $this;
    }

    /**
     * reload dudnumber data by did
     * http://open.didww.com/index.php/13._Get_Service_Details
     * @return DIDNumber
     */
    public function reloadByNumber()
    {
        $this->_reload($this->getDIDNumber());
        return $this;
    }

    /**
     * reload dudnumber data by didww order id
     * http://open.didww.com/index.php/13._Get_Service_Details
     * @return DIDNumber
     */
    public function reloadByOrderId()
    {
        $this->_reload(NULL, $this->getOrderId());
        return $this;
    }


    public function  fromServiceData($properties)
    {
        $properties = (array)$properties;
        if ($this->_order) {
            $this->_order->setCountryIso($properties['country_iso']);
            $this->_order->setCityPrefix($properties['city_prefix']);
            $this->_order->setAutorenewEnable($properties['autorenew_enable']);

            // only URI supporting
            if (preg_match("/^URI:(\w+)\/(\S+)$/", $properties['did_mapping_format'], $matches)) {

                if (count($matches) == 3) {
                    $mapping = Mapping::create(
                        array(
                            "map_type" => 'URI',
                            "map_proto" => $matches[1],
                            "map_detail" => $matches[2]
                        )
                    );
                    $this->_order->setMapData($mapping);
                }
            }
        }
        unset($properties['city_prefix'], $properties['country_iso'], $properties['autorenew_enable']);
        $assignType = $this->getAssignType();

        $this->setAssignType(\Didww\API2\Object::ASSIGN_IGNORE);
        $this->fromArray($properties);
        $this->setAssignType($assignType);
    }


    /**
     * reload didnumber by number or order id
     * @param string $didNumber
     * @param string $orderId
     */
    protected function _reload($didNumber = NULL, $orderId = NULL)
    {
        $properties = $this->call('getservicedetails', array(
            "customer_id" => $this->_order->getCustomerId(),
            "order_id" => $orderId,
            "did_number" => $didNumber
        ));
        unset($properties['result']);
        $this->fromServiceData($properties);
    }

    /**
     * update mapping of did number
     * @link http://open.didww.com/index.php/8._Update_Mapping
     * @param Mapping $newMapping
     */
    public function updateMapping(Mapping $newMapping = NULL)
    {
        $mapping = empty($newMapping) ? $this->_order->getMapData() : $newMapping;
        $this->call('updatemapping', array(
            "customer_id" => $this->_order->getCustomerId(),
            "did_number" => $this->getDIDNumber(),
            "map_data" => $mapping->toArray()
        ));
        $this->_order->setMapData($newMapping);
        return true;
    }

    /**
     * check if didnumer is active
     * @return bool
     */
    public function isActive()
    {
        return $this->getDidStatus() == self::DID_STATUS_ACTIVE;
    }

    /**
     * check if didnumer is blocked
     * @return bool
     */
    public function isBlocked()
    {
        return $this->getDidStatus() == self::DID_STATUS_BLOCKED;
    }

    /**
     * check if didnumer is removed
     * @return bool
     */
    public function isRemoved()
    {
        return $this->getDidStatus() == self::DID_STATUS_REMOVED;
    }

    /**
     * check if order is completed
     * @return bool
     */
    public function isOrderCompleted()
    {
        return $this->getOrderStatus() == self::ORDER_STATUS_COMPLETED;
    }

    /**
     * check if order is canceled
     * @return bool
     */
    public function isOrderCanceled()
    {
        return $this->getOrderStatus() == self::ORDER_STATUS_CANCELED;
    }

    /**
     * check if order is pending
     * @return bool
     */
    public function isOrderPending()
    {
        return $this->getOrderStatus() == self::ORDER_STATUS_PENDING;
    }


    /**
     * generate unique hash for did renew operation
     * @return string
     */
    protected function generateUniqueHash()
    {
        return $this->_order->getUniqHash() ?:
            md5(sprintf("%s.%s.%s.%s.%s.%s",
                $this->getDIDExpireDateGmt(),
                $this->getOrderId(),
                $this->getDIDMappingFormat(),
                $this->getDIDPeriod(),
                $this->getDIDTimeLeft(),
                $this->getDIDNumber()
            ));
    }

}

