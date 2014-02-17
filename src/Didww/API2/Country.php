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
 * Country
 * Base region DIDWW object
 * @category DIDWW
 * @package API2
 * @author Fedoronchuk Igor <fedoronchuk@gmail.com>
 * @copyright Copyright (C) 2012 by Igor Fedoronchuk
 * @license MIT
 */
class Country extends ServerObject
{
    /**
     * country name
     * @var string
     */
    protected $countryName = NULL;

    /**
     * telecom prefix
     * @var string
     */
    protected $countryPrefix = NULL;

    /**
     * iso code
     * @var string
     */
    protected $countryIso = NULL;

    /**
     *collection of country cities
     * @var \Didww\API2\City[]
     */
    protected $_cities = NULL;

    /**
     * collection of country networks
     * @var \Didww\API2\PSTNNetwork[]
     */
    protected $_pstnNetworks = NULL;

    /**
     * flag if city collection was loaded from API2
     * @var bool
     */
    protected $_loadedCities = false;

    /**
     *flag if network collection was loaded from API2
     * @var bool
     */
    protected $_loadedNetworks = false;

    /**
     * get countryName property
     * @return string
     */
    public function getCountryName()
    {
        return $this->countryName;
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
     * get countryPrefix property
     * @return string
     */
    public function getCountryPrefix()
    {
        return $this->countryPrefix;
    }

    /**
     * set countryPrefix property
     * @param string $countryPrefix
     */
    public function setCountryPrefix($countryPrefix)
    {
        $this->countryPrefix = $countryPrefix;
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
        $this->countryIso = trim($countryIso);
    }

    /**
     * get _cities property
     * @return \Didww\API2\City[]
     */
    public function getCities()
    {
        return $this->_cities;
    }

    /**
     * method to set __cities property  (collection of cities)
     * @param \Didww\API2\City[] $cities
     */
    public function setCities($cities)
    {
        $this->_cities = $cities;
    }

    /**
     * get _pstnNetworks property
     * @return \Didww\API2\PSTNNetwork[]
     */
    public function getPSTNNetworks()
    {
        return $this->_pstnNetworks;
    }

    /**
     * method to set _pstnNetworks property  (collection of networks)
     * @param \Didww\API2\PSTNNetwork[] $networks
     */
    public function setPSTNNetworks($networks)
    {
        $this->_pstnNetworks = $networks;
    }

    /**
     * Object::fromArray overriding
     * @param array $array
     *
     * <code>
     * $country =  new Country();
     * $country->fromArray(array('country_iso'=>'UA'));
     * echo $country->loadCities()->loadPSTNNetworks();
     * </code>
     */
    function fromArray($array = array())
    {
        if (isset($array['cities'])) {
            if (is_array($array['cities'])) {
                $this->setCitiesFromArray($array['cities']);
                $this->_loadedCities = true;
            }
            unset($array['cities']);
        }
        if (isset($array['networks'])) {

            if (is_array($array['networks'])) {
                $this->setPSTNNetworksFromArray($array['networks']);
                $this->_loadedNetworks = true;
            }
            unset($array['networks']);
        }

        parent::fromArray($array);
    }

    /**
     * method to build City objects from multidimension array
     * @param array $cities
     * @return void
     */
    protected function setCitiesFromArray($cities = array())
    {
        $this->_cities = array();
        foreach ($cities as $city) {
            $city = new City((array)$city);
            $city->setCountry($this);
            $this->_cities[$city->getCityId()] = $city;
        }
    }

    /**
     * method to build PSTNNetwork objects from multidimension array
     * @param array $networks
     * @return void
     */
    protected function setPSTNNetworksFromArray($networks = array())
    {
        $this->_pstnNetworks = array();
        foreach ($networks as $network) {
            $network = new PSTNNetwork((array)$network);
            $network->setCountry($this);
            $this->_pstnNetworks[] = $network;
        }
    }

    /**
     * method to load pstn networks from API2
     * @link http://open.didww.com/index.php/2._Get_DIDWW_PSTN_Rates read for details of API method
     * @param string $networkPrefix
     * @return \Didww\API2\Country
     */
    public function loadPSTNNetworks($networkPrefix = NULL)
    {
        if (!$this->getCountryIso()) {
            throw new CountryException("ISO code is undefined");
        }
        if (!$this->_loadedNetworks) {

            $response = $this->call("getdidwwpstnrates", array(
                "country_iso" => $this->getCountryIso(),
                "pstn_prefix" => $networkPrefix
            ));
            $country = reset($response);
            $this->fromArray((array)$country);
            $this->_loadedNetworks = true;
        }
        return $this;
    }

    /**
     * method load cities from API2
     * @link http://open.didww.com/index.php/1._Get_DIDWW_Regions} read for details of API method
     * @param string $prefix
     * @return \Didww\API2\Country
     */
    public function loadCities($prefix = NULL)
    {
        if (!$this->getCountryIso()) {
            throw new CountryException("ISO code is undefined");
        }

        if (!$this->_loadedCities) {
            $response = $this->call("getdidwwregions", array(
                "country_iso" => $this->getCountryIso(),
                "city_prefix" => $prefix
            ));


            $country = reset($response);
            $this->fromArray((array)$country);
            $this->_loadedCities = true;
        }
        return $this;
    }

    /**
     * Method to get regions from DIDWW API
     *
     * @link http://open.didww.com/index.php/1._Get_DIDWW_Regions} read for details of API method
     * @param string $iso if isset, returns only this country
     * @return \Didww\API2\Country[]
     */
    public static function getAll($iso = NULL)
    {
        $countries = array();
        $response = self::getClientInstance()->call("getdidwwcountries", array('country_iso' => $iso)
        );
        foreach ($response as $c) {
            $country = new Country((array)$c);
            $countries[$country->getCountryIso()] = $country;
        }
        return $countries;
    }

    /**
     *
     * method get Country by ISO
     * @param string $countryIso
     * @return \Didww\API2\Country
     */
    public static function find($countryIso)
    {
        $country = new Country();
        $country->setCountryIso($countryIso);
        $country->loadCities();
        return $country;
    }

    /**
     * method get city by id
     * @param int $id
     * @return \Didww\API2\City
     * @throws CountryException
     */
    public function getCity($id)
    {
        $this->loadCities();
        if (isset($this->_cities[$id])) {
            return $this->_cities[$id];
        }
        throw new CountryException("City not found");
    }

}

/**
 * CountryException
 * Exception for class Country
 * @category DIDWW
 * @package API2
 * @copyright Copyright (C) 2012 by Igor Fedoronchuk
 * @license MIT
 */
class CountryException extends BaseException
{
}

