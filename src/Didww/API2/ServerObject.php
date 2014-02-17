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
 * ServerObject
 * Abstract class for API2 response
 * @category DIDWW
 * @package API2
 * @copyright Copyright (C) 2012 by Igor Fedoronchuk
 * @license MIT
 */
abstract class ServerObject extends Object
{
    /**
     * static global client property
     * @var ApiClient
     */
    protected static $_globalClient;

    /**
     * client property of current object
     * @var ApiClient
     */
    protected $_client;

    /**
     * set client instance
     * @param ApiClient $client
     */
    public function setClient(ApiClient $client)
    {
        $this->_client = $client;
    }

    /**
     * set global client instance
     * @param ApiClient $client
     */
    public static function setGlobalClient(ApiClient $client)
    {
        self::$_globalClient = $client;
    }


    /**
     * delegate calling of soap method to internal client object
     * @param string $method
     * @param array $arguments
     * @return mixed
     */
    public function call($method, $arguments = array())
    {
        return $this->getClient()->call($method, $arguments);
    }

    /**
     * get  global client object instance
     * @return ApiClient
     */
    public static function getClientInstance()
    {
        self::setClientInstance();
        return self::$_globalClient;
    }


    /**
     * get client object instance
     * @return ApiClient
     */
    public function getClient()
    {
        self::setClientInstance();
        return $this->_client ? $this->_client : self::$_globalClient;
    }

    /**
     * create ApiClient and store it to static property
     * @return void
     *
     */
    public static function setClientInstance()
    {
        if (!self::$_globalClient instanceof ApiClient) {
            self::$_globalClient = new ApiClient();
        }

    }

}