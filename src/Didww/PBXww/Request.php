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

namespace Didww\PBXww;

/**
 * Request
 * class to create request to pbxww iframe
 * @category DIDWW
 * @package API2
 * @copyright Copyright (C) 2012 by Igor Fedoronchuk
 * @license MIT
 *
 */
class Request extends \Didww\API2\Object
{
    const PBXWW_DEFAULT_HOST = 'acf.didreseller.com';

    /**
     * encrypted message string
     * @var string
     */
    protected $message;

    /**
     * key for crypting
     * @var string
     */
    protected $key;

    /**
     * resellerId of pbxww request
     * @var int
     */
    protected $resellerId;

    /**
     * site name to display on pbxww panel
     * @var type
     */
    protected $siteName;

    /**
     * site url to display on pbxww  panel
     * @var type
     */
    protected $siteUrl;

    /**
     *  help url to display on pbxww panel
     * @var string
     */
    protected $helpUrl;

    /**
     * support url to display on pbxww panel
     * @var string
     */
    protected $supportUrl;

    /**
     * link to order new did (if available)
     * @var string
     */
    protected $orderUrl;

    /**
     * current customer language
     * @var string
     */
    protected $language;

    /**
     * current customer timezone
     * @var string
     */
    protected $timezone;

    /**
     * array of numbers
     * @var array
     */
    protected $_numbers;

    /**
     *
     * @var int
     */
    protected $_time;

    /**
     *
     * @var string
     */
    protected $_host;

    /**
     * @var bool
     */
    protected $_isSSL = true;


    /**
     * current customerId
     * @var int
     */
    protected $_customerId;

    function __construct(array $args = array())
    {
        $this->setHost(self::PBXWW_DEFAULT_HOST);
        parent::__construct($args);
    }

    /**
     *
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     *
     * @param string $message
     */
    public function setMessage($message)
    {
        $this->message = $message;
    }

    /**
     *
     * @return string
     */
    public function getKey()
    {
        return $this->key;
    }

    /**
     *
     * @param string $key
     */
    public function setKey($key)
    {
        $this->key = $key;
    }

    /**
     *
     * @return int
     */
    public function getResellerId()
    {
        return $this->resellerId;
    }

    /**
     *
     * @param int $resellerId
     */
    public function setResellerId($resellerId)
    {
        $this->resellerId = $resellerId;
    }

    /**
     *
     * @return string
     */
    public function getSiteName()
    {
        return $this->siteName;
    }

    /**
     *
     * @param string $siteName
     */
    public function setSiteName($siteName)
    {
        $this->siteName = $siteName;
    }

    /**
     *
     * @return string
     */
    public function getSiteUrl()
    {
        return $this->siteUrl;
    }

    /**
     *
     * @param string $siteUrl
     */
    public function setSiteUrl($siteUrl)
    {
        $this->siteUrl = $siteUrl;
    }

    /**
     *
     * @return string
     */
    public function getHelpUrl()
    {
        return $this->helpUrl;
    }

    /**
     *
     * @param string $helpUrl
     */
    public function setHelpUrl($helpUrl)
    {
        $this->helpUrl = $helpUrl;
    }

    /**
     *
     * @return string
     */
    public function getSupportUrl()
    {
        return $this->supportUrl;
    }

    /**
     *
     * @param string $supportUrl
     */
    public function setSupportUrl($supportUrl)
    {
        $this->supportUrl = $supportUrl;
    }

    /**
     *
     * @return string
     */
    public function getOrderUrl()
    {
        return $this->orderUrl;
    }

    /**
     *
     * @param string $orderUrl
     */
    public function setOrderUrl($orderUrl)
    {
        $this->orderUrl = $orderUrl;
    }

    /**
     *
     * @return string
     */
    public function getLanguage()
    {
        return $this->language;
    }

    /**
     *
     * @param string $language
     */
    public function setLanguage($language)
    {
        $this->language = $language;
    }

    /**
     *
     * @return string
     */
    public function getTimezone()
    {
        return $this->timezone;
    }

    /**
     *
     * @param string $timezone
     */
    public function setTimezone($timezone)
    {
        $this->timezone = $timezone;
    }

    /**
     *
     * @return array
     */
    public function getNumbers()
    {
        return $this->_numbers;
    }

    /**
     *
     * @param array $numbers
     */
    public function setNumbers($numbers)
    {
        $this->_numbers = $numbers;
    }

    /**
     *
     * @return string
     */
    public function getTime()
    {
        return $this->_time;
    }

    /**
     *
     * @param string $time
     */
    public function setTime($time)
    {
        $this->_time = $time;
    }

    /**
     * @return string
     */
    public function getHost()
    {
        return $this->_host;
    }

    /**
     *
     * @param string $host
     */
    public function setHost($host)
    {
        $this->_host = $host;
    }

    /**
     *
     * @return bool
     */
    public function getIsSSL()
    {
        return $this->_isSSL;
    }

    /**
     *
     * @param bool $isSSL
     */
    public function setIsSSL($isSSL)
    {
        $this->_isSSL = $isSSL;
    }

    /**
     *
     * @param string $resellerKey
     * @return array
     *
     */
    public function getParams($resellerKey)
    {
        if (!$this->message) {
            $this->crypt($resellerKey);
        }
        $params = $this->toArray();
        $params['sub_customer_id'] = $this->getCustomerId();
        return $params;
    }

    private function crypt($resellerKey)
    {
        $t = time();
        $iv = sprintf("%016d", (string)$t);
        $params = "$t#{$this->_customerId}#" . implode(",", $this->_numbers);
        $message = mcrypt_encrypt(MCRYPT_RIJNDAEL_128, $resellerKey, $this->pkcs5_pad($params, 16), MCRYPT_MODE_CBC, $iv);
        $this->message = rtrim(strtr(base64_encode($message), '+/', '-_'));
        $this->key = $iv;
        $this->_time = $t;
    }

    /**
     * Fix of encryption
     * @param $text
     * @param $blocksize
     * @return string
     */
    private function pkcs5_pad($text, $blocksize)
    {
        $pad = $blocksize - (strlen($text) % $blocksize);
        return $text . str_repeat(chr($pad), $pad);
    }

    /**
     *
     * @return int
     */
    public function getCustomerId()
    {
        return $this->_customerId;
    }

    /**
     *
     * @param int $customerId
     */
    public function setCustomerId($customerId)
    {
        $this->_customerId = $customerId;
    }

}