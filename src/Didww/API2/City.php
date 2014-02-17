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
 * City
 * Class that wrap city array API data
 * @category DIDWW
 * @package API2
 * @author Fedoronchuk Igor <fedoronchuk@gmail.com>
 * @copyright Copyright (C) 2012 by Igor Fedoronchuk
 * @license MIT
 */

class City extends ServerObject
{
    /**
     * unique city id
     * @var int
     */
    protected $cityId = NULL;

    /**
     * city prefix
     * @var string
     */
    protected $cityPrefix = NULL;

    /**
     * nxx prefix
     * NANPA standard: Country Code + NPA+NXX+XXXXXX
     * @var string
     */
    protected $cityNxxPrefix = NULL;

    /**
     * setup cost
     * @var float
     */
    protected $setup = NULL;

    /**
     * monthly cost
     * @var float
     */
    protected $monthly = NULL;

    /**
     * City name
     * @var string
     */
    protected $cityName = NULL;

    /**
     * if true than is available for purchase
     * @var bool
     */
    protected $isavailable = NULL;

    /**
     * if country requires special registration
     * @var bool
     */
    protected $islnrrequired = NULL;

    /**
     * Country object if city
     * @var Country
     */
    protected $_country = NULL;

    /**
     * get _country property
     * @return Country
     */
    public function getCountry()
    {
        return $this->_country;
    }

    /**
     * set _country property
     * @param Country $country
     */
    public function setCountry(Country $country)
    {
        $this->_country = $country;
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
     * set cityId property
     * @param int $cityId
     */
    public function setCityId($cityId)
    {
        $this->cityId = (int)$cityId;
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
     * get cityNxxPrefix property
     * @return string
     */
    public function getCityNxxPrefix()
    {
        return $this->cityNxxPrefix;
    }

    /**
     *set cityNxxPrefix property
     * @param string $cityNxxPrefix
     */
    public function setCityNxxPrefix($cityNxxPrefix)
    {
        $this->cityNxxPrefix = $cityNxxPrefix;
    }

    /**
     * get setup property
     * @return float
     */
    public function getSetup()
    {
        return $this->setup;
    }

    /**
     * set setup property
     * @param float $setup
     */
    public function setSetup($setup)
    {
        $this->setup = $setup;
    }

    /**
     * get monthly property
     * @return float
     */
    public function getMonthly()
    {
        return $this->monthly;
    }

    /**
     * set monthly property
     * @param float $monthly
     */
    public function setMonthly($monthly)
    {
        $this->monthly = $monthly;
    }

    /**
     * get cityName property
     * @return string
     */
    public function getCityName()
    {
        return $this->cityName;
    }

    /**
     * set cityName property
     * @param string $cityName
     */
    public function setCityName($cityName)
    {
        $this->cityName = $cityName;
    }

    /**
     * get isavailable property
     * @return bool
     */
    public function getIsavailable()
    {
        return $this->isavailable;
    }

    /**
     * set isavailable property
     * @param bool $isavailable
     */
    public function setIsavailable($isavailable)
    {
        $this->isavailable = (bool)$isavailable;
    }

    /**
     * get islnrrequired property
     * @return bool
     */
    public function getIslnrrequired()
    {
        return $this->islnrrequired;
    }

    /**
     * set islnrrequired property
     * @param bool $islnrrequired
     */
    public function setIslnrrequired($islnrrequired)
    {
        $this->islnrrequired = (bool)$islnrrequired;
    }
}

