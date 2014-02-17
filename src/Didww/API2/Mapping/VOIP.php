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
namespace Didww\API2\Mapping;

/**
 * MappingToVOIP
 * DID mapping to VOIP
 * @category DIDWW
 * @package API2
 * @copyright Copyright (C) 2012 by Igor Fedoronchuk
 * @license MIT
 */
class VOIP extends \Didww\API2\Mapping
{
    /**
     * host of mapping detail
     * @var string
     */
    protected $_host = null;

    /**
     * account of mapping detail
     * @var string
     */
    protected $_account = null;

    /**
     * Class constructor
     * @param string $host
     * @param string $account
     */
    public function __construct($host = NULL, $account = NULL)
    {
        $this->setAccount($account);
        $this->setHost($host);
        $this->createMapDetails();
        $this->mapType = 'URI';
    }

    /**
     * get $_host property
     * @return string
     */
    public function getHost()
    {
        return $this->_host;
    }

    /**
     *set $_host property
     * @param string $host
     */
    public function setHost($host)
    {
        $this->_host = $host;
    }

    /**
     * get $_account property
     * @return string
     */
    public function getAccount()
    {
        return $this->_account;
    }

    /**
     * set $_account property
     * @param string $account
     */
    public function setAccount($account)
    {
        $this->_account = $account;
    }

    /**
     *set mapDetail by $_account and  $_host properties
     */
    public function createMapDetails()
    {
        $this->setMapDetail($this->getHost() . '/' . $this->getAccount());
    }
}
