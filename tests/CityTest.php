<?php
use Didww\API2\Country;

class CityTest extends \BaseTest
{
    protected $_country_iso = 'US';
    protected $_city_id = 50;
    protected $_prefix = '909';
    protected $_city;


    public function testGetCountry()
    {
        $this->assertInstanceOf('Didww\API2\Country', $this->subjectCity()->getCountry());
    }

    public function testGetCityId()
    {
        $this->assertEquals($this->_city_id, $this->subjectCity()->getCityId());
    }

    public function testGetCityPrefix()
    {
        $this->assertEquals($this->_prefix, $this->subjectCity()->getCityPrefix());
    }

    public function testGetCityNxxPrefix()
    {
        $this->assertEmpty($this->subjectCity()->getCityNxxPrefix());
    }

    public function testGetSetup()
    {
        $this->assertEquals('0.00', $this->subjectCity()->getSetup());
    }

    public function testGetMonthly()
    {
        $this->assertEquals('0.09', $this->subjectCity()->getMonthly());
    }

    public function testGetCityName()
    {
        $this->assertEquals('Ontario', $this->subjectCity()->getCityName());
    }

    public function testGetIsavailable()
    {
        $this->assertTrue($this->subjectCity()->getIsavailable());
    }

    public function testGetIslnrrequired()
    {
        $this->assertFalse($this->subjectCity()->getIslnrrequired());
    }








    protected function setUp()
    {
        parent::setUp();
        $this->startVCR();
    }

    protected function tearDown()
    {
        $this->stopVCR();
    }


    protected function startVCR($cassetteName = 'didww_getdidwwregions-united_states-prefix_909')
    {
        parent::startVCR($cassetteName);
    }

    protected function subjectCity()
    {
        if (!$this->_city) {
            $country = new Country(array('country_iso' => $this->_country_iso));
            $this->_city = $country->loadCities($this->_prefix)->getCity($this->_city_id);
        }
        return $this->_city;
    }
}
