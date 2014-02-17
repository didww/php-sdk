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
 * Mapping
 * Class wuth properties for mapping management
 * @category DIDWW
 * @package API2
 * @copyright Copyright (C) 2012 by Igor Fedoronchuk
 * @license MIT
 */

class Mapping extends ClientObject
{
    /**
     * type of mapping
     * @var string
     */
    protected $mapType = null;

    /**
     * type of proto
     * @var string
     */
    protected $mapProto = null;

    /**
     *
     * mapping details
     * @var string
     */
    protected $mapDetail = null;

    /**
     * pref server for mapping
     * @var int
     */
    protected $mapPrefServer = 0;

    /**
     * mapping itsp provider id
     * @var int
     */
    protected $mapItspId = null;

    /**
     * set mapDetail property
     * @param string $mapDetail
     */
    public function setMapDetail($mapDetail)
    {
        $this->mapDetail = $mapDetail;
    }

    /**
     * get mapDetail property
     * @return string
     */
    public function getMapDetail()
    {
        return $this->mapDetail;
    }

    /**
     * get mapType property
     * @return string
     */
    public function getMapType()
    {
        return $this->mapType;
    }

    /**
     * set mapType property
     * @param string $mapType
     */
    public function setMapType($mapType)
    {
        $this->mapType = $mapType;
    }

    /**
     * get mapProto property
     * @return string
     */
    public function getMapProto()
    {
        return $this->mapProto;
    }

    /**
     * set mapProto property
     * @param string $mapProto
     */
    public function setMapProto($mapProto)
    {
        $this->mapProto = $mapProto;
    }

    /**
     *get mapPrefServer property
     * @return int
     */
    public function getMapPrefServer()
    {
        return $this->mapPrefServer;
    }

    /**
     * set setMapPrefServer property
     * @param int $mapPrefServer
     */
    public function setMapPrefServer($mapPrefServer)
    {
        $this->mapPrefServer = (int)$mapPrefServer;
    }

    /**
     * get mapItspId property
     * @return int
     */
    public function getMapItspId()
    {
        return $this->mapItspId;
    }

    /**
     * set  mapItspId property
     * @param int $mapItspId
     */
    public function setMapItspId($mapItspId)
    {
        $this->mapItspId = (int)$mapItspId;
    }

    /**
     * factory to build mapping object by params array
     * @param array $params array of key=>value properties
     * @return Mapping
     */
    public static function create($params = array())
    {
        if (isset($params['type'])) {
            $className = "Didww\API2\Mapping\\" . $params['type'];
            $mapping = new $className();
            unset($params['type']);
        } else {
            $mapping = new Mapping();
        }
        $mapping->fromArray($params);

        return $mapping;
    }


    /**
     *The class constructor
     */
    function __constructor()
    {
    }

}
