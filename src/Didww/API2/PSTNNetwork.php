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
 * PSTNNetwork
 *
 * @category DIDWW
 * @package API2
 * @copyright Copyright (C) 2012 by Igor Fedoronchuk
 * @license MIT
 */
class PSTNNetwork extends ServerObject
{

    /**
     * network name
     * @var string
     */
    protected $networkName = NULL;

    /**
     * network prefix
     * @var string
     */
    protected $networkPrefix = NULL;

    /**
     * call cost fro reseller in usd for minute
     * @var float
     */
    protected $costRate = NULL;

    /**
     * call cost fro customer in points for minute
     * @var float
     */
    protected $sellRate = NULL;

    /**
     * country of network
     * @var Country
     */
    protected $_country = NULL;

    /**
     * get $networkName property
     * @return string
     */
    public function getNetworkName()
    {
        return $this->networkName;
    }

    /**
     *set $networkName property
     * @param string $networkName
     */
    public function setNetworkName($networkName)
    {
        $this->networkName = $networkName;
    }

    /**
     *get $networkPrefix property
     * @return string
     */
    public function getNetworkPrefix()
    {
        return $this->networkPrefix;
    }

    /**
     *set $networkPrefix property
     * @param string $networkPrefix
     */
    public function setNetworkPrefix($networkPrefix)
    {
        $this->networkPrefix = $networkPrefix;
    }


    /**
     *get $costRate property
     * @return float
     */
    public function getCostRate()
    {
        return $this->costRate;
    }


    /**
     *set $costRate property
     * @param float $costRate
     */
    public function setCostRate($costRate)
    {
        $this->costRate = $costRate;
    }


    /**
     *get $sellRate property
     * @return float
     */
    public function getSellRate()
    {
        return $this->sellRate;
    }


    /**
     *set $sellRate property
     * @param float $sellRate
     */
    public function setSellRate($sellRate)
    {
        $this->sellRate = $sellRate;
    }


    /**
     * get $_country property
     * @return Country
     */
    public function getCountry()
    {
        return $this->_country;
    }

    /**
     * set $_country property
     * @param Country $country
     */
    public function setCountry(Country $country)
    {
        $this->_country = $country;
    }

    /**
     * get collection of pstn rates
     * @link http://open.didww.com/index.php/2._Get_DIDWW_PSTN_Rates
     * @param string $lastRequestGmt
     * @return \Didww\API2\Countries[]
     */


    public static function getAll($lastRequestGmt = NULL)
    {
        $countries = array();
        $response = self::getClientInstance()->call("getdidwwpstnrates",
            array('last_request_gmt' => $lastRequestGmt)
        );


        foreach ($response as $countryWithNetworks) {

            $countries[trim($countryWithNetworks->country_iso)] = new \Didww\API2\Country((array)$countryWithNetworks);
        }
        return $countries;
    }

    /**
     * update pstn rates from countries collection
     * @link http://open.didww.com/index.php/3._Update_PSTN_Rates
     * @param \Didww\API2\Countries[] $countries
     */
    public static function updateAll($countries = array())
    {
        $networks = array();
        foreach ($countries as $country) {
            if ($country instanceof \Didww\API2\Country) {
                $networks = array_merge($networks, $country->getPSTNNetworks());
            } else {
                throw  new PSTNNetworkException("Country expected but type " .
                    \Didww\Utils\Util::getType($country) .
                    " found");
            }
        }
        self::updateNetworks($networks);
    }


    /**
     * update pstn rates from pstnnetworks collection
     * @link http://open.didww.com/index.php/3._Update_PSTN_Rates
     * @param \Didww\API2\PSTNNetwork[] $networks
     */
    public static function updateNetworks($networks = array())
    {
        $request = array();

        foreach ($networks as $network) {
            if ($network instanceof \Didww\API2\PSTNNetwork) {

                $request[] = array(
                    "network_prefix" => trim($network->getNetworkPrefix()),
                    "sell_rate" => $network->getSellRate()
                );


            } else {
                throw  new PSTNNetworkException("PSTNNetwork expected but type " .
                    \Didww\Utils\Util::getType($network) .
                    " found");
            }
        }


        self::updateNetworksFromArray($request);
    }

    /**
     *update pstn rates from simple array
     * @param array $array
     */
    public static function updateNetworksFromArray($array = array())
    {

        self::getClientInstance()->call('updatepstnrates', array("rates" => $array));
    }

}

/**
 * PSTNNetworkException
 *
 * @category DIDWW
 * @package API2
 * @copyright Copyright (C) 2012 by Igor Fedoronchuk
 * @license MIT
 */
class PSTNNetworkException extends BaseException
{
}