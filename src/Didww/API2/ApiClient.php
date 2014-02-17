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
 * ApiClient
 * Class that wraps calls to DIDWW API 2
 * @category DIDWW
 * @package API2
 * @copyright Copyright (C) 2012 by Igor Fedoronchuk
 * @license MIT
 */

class ApiClient
{
    /**
     * Array of error codes from DIDWWAPI-2
     * @static array  $_errorCodes all possible error codes of didww api Global result type
     * all possible error code descriptions
     */
    protected static $_errorCodes = array(
        "100" => "Access denied",
        "150" => "Server error when validating an API client request",
        "151" => "Array has invalid data",
        "200" => "Server error when processing an API client request",
        "300" => "Type not valid",
        "301" => "Protocol not valid",
        "302" => "Unsupported format for this type",
        "303" => "PSTN prefix not supported",
        "400" => "API Order ID not found or invalid",
        "401" => "API Order ID not in valid status",
        "405" => "Transaction refused",
        "410" => "Transaction out of balance",
        "411" => "Account balance is disabled/suspened/has not enough amount for purchases",
        "430" => "Customer: Prepaid Balance disabled or not exist",
        "500" => "Region(s) not found or invalid",
        "501" => "City not found",
        "505" => "DIDs not available for this region",
        "600" => "DID Number not found or invalid",
    );

    /**
     * url for API 2 production mode
     */
    const PRODUCTION_WSDL = "https://api.didww.com/api2/index.php?wsdl";

    /**
     *url for API 2 Sandbox mode
     */
    const SANDBOX_WSDL = "https://sandbox-api.didww.com/api2/index.php?wsdl";

    /**
     * credentials if didww api 2 client
     * @var ApiCredentials
     */
    static $_credentials = null;

    /**
     * flag for debugging input parameters  and output data to stdout
     * @var bool
     */
    protected static $_debug = false;

    /**
     * custom API2 wsdl url
     * @var string
     */
    protected static $_wsdl = null;

    /**
     * time of last soap request
     * @var int
     */
    protected $time = 0;

    /**
     * php soap client object
     * @var \SoapClient
     */

    protected $_client = NULL;

    /**
     * get credentials
     * @return ApiCredentials
     */
    public static function getCredentials()
    {
        return self::$_credentials;
    }

    /**
     * set credentials for API 2
     * @param ApiCredentials $credentials
     */
    public static function setCredentials(ApiCredentials $credentials)
    {
        self::$_credentials = $credentials;
    }

    /**
     * return current wsdl url or url by production/sandbox mode
     * @return string
     */
    public static function getWSDL()
    {
        if (!empty(self::$_wsdl)) {
            return self::$_wsdl;
        }
        return self::getCredentials()->getTestMode() ? self::SANDBOX_WSDL : self::PRODUCTION_WSDL;
    }

    /**
     * Set custom wsdl url
     * @param string $url
     */
    public static function setWSDL($url)
    {
        self::$_wsdl = $url;
    }

    /**
     * get debug mode is on
     * @return bool
     */
    public static function getDebug()
    {
        return self::$_debug;
    }

    /**
     * Set debug mode
     * @param bool $debug
     * @return bool
     */
    public static function setDebug($debug)
    {
        self::$_debug = $debug;
    }

    /**
     * didww api client constructor
     * @param array $options to use with SoapClient object http://www.php.net/manual/en/soapclient.soapclient.php#refsect1-soapclient.soapclient-parameters
     * @throws ApiClientException
     */
    public function __construct($options = array())
    {
        if (!self::$_credentials instanceof ApiCredentials) {
            throw new ApiClientException("Api client can't be created without valid credentials");
        }
        $options = self::$_debug ? array('trace' => 1) : array();
        $options['style'] = SOAP_DOCUMENT;
        $options['use'] = SOAP_LITERAL;

        $this->_client = new \SoapClient(self::getWSDL(), $options);
    }

    /**
     * debug method
     * @param string $message
     * @param string $rawXML
     */
    function debug($message, $rawXML = '')
    {
        error_log(sprintf("DIDWWApiClient debug. %s  %s", $message, $rawXML));
    }


    /**
     * method to call didww api 2 soap method
     * @param string $method
     * @param array $arguments
     * @return mixed
     * @throws ApiClientException
     */
    public function call($method, $arguments = array())
    {
        $arguments = array_merge(array('auth_string' => self::getCredentials()->getAuthString()), $arguments);
        $method = 'didww_' . $method;
        $timeStart = microtime(true);

        try {
            $result = $this->_client->__soapCall($method, $arguments);

        } catch (\Exception $e) {
            if (self::$_debug) {
                $this->debug("raw request", $this->_client->__getLastRequest());
                $this->debug("raw response", $this->_client->__getLastResponse());
            }
            throw $e;
        }

        if (self::$_debug) {
            $this->debug("raw request", $this->_client->__getLastRequest());
            $this->debug("raw response", $this->_client->__getLastResponse());
        }

        /**
         * check if api returned error and throw exception
         */
        if (isset($result->error) && $result->error > 0) {
            $message = isset (self::$_errorCodes[$result->error]) ? self::$_errorCodes[$result->error] :
                'Unknown error with code : ' . $result->error;
            throw new ApiClientException($message);
        }

        $timeFinish = microtime(true);
        $this->time = $timeFinish - $timeStart;
        if (self::$_debug) {
            $this->debug("response from $method:", $result);
        }


        return (array)$result;
    }

    /**
     * time of last call
     * @return int
     */
    public function getTime()
    {
        return $this->time;
    }

    /**
     * return array of API methods
     * @return array
     */
    public function methods()
    {
        return $this->_client->__getFunctions();
    }
}

/**
 * ApiClientException
 * Exception for class ApiClient
 * @category DIDWW
 * @package API2
 * @copyright Copyright (C) 2012 by Igor Fedoronchuk
 * @license MIT
 */
class ApiClientException extends BaseException
{
}


