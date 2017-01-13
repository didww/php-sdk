<?php

use Didww\API2\Country;

class CountryTest extends \BaseTest
{
    /**
     * @link http://open.didww.com/index.php/1._Get_DIDWW_Regions
     */
    public function testGetAll()
    {
        $this->startVCR('didww_getdidwwcountries');

        $countries = Country::getAll();

        $this->assertCount(58, $countries);
        $this->assertInstanceOf('Didww\API2\Country', $countries[array_rand($countries)]);

        $this->stopVCR();
    }


    /**
     * @link http://open.didww.com/index.php/1._Get_DIDWW_Regions
     */
    public function testGetCity()
    {
        $this->startVCR('didww_getdidwwregions-united_states-prefix_909');

        $country = new Country(array('country_iso'=>'US'));
        $city = $country->loadCities('909')->getCity(50);

        $this->assertInstanceOf('Didww\API2\City', $city);
        $this->assertEquals(50, $city->getCityId());
        $this->assertEquals('Ontario', $city->getCityName());

        $this->stopVCR();
    }


    /**
     * @link http://open.didww.com/index.php/1._Get_DIDWW_Regions
     */
    public function testGetCities()
    {
        $this->startVCR('didww_getdidwwregions-canada-prefix_909');

        $country = new Country(array('country_iso'=>'US'));
        $cities = $country->loadCities('909')->getCities();

        $this->assertCount(2, $cities);
        foreach ($cities as $item) {
            $this->assertInstanceOf('Didww\API2\City', $item);
        }

        $this->stopVCR();
    }


    /**
     * @link http://open.didww.com/index.php/2._Get_DIDWW_PSTN_Rates
     */
    public function testGetPSTNNetworks()
    {
        $this->startVCR('country_ua_get_pstn_networks');

        $country = new Country(array('country_iso'=>'UA'));

        $networks = $country->loadPSTNNetworks()->getPSTNNetworks();

        foreach ($networks as $item) {
            $this->assertInstanceOf('Didww\API2\PSTNNetwork', $item);
        }
        $this->assertCount(27, $networks);

        $this->stopVCR();
    }
}
