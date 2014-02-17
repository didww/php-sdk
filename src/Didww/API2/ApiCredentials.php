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
 * ApiCredentials
 * Class that wraps credentials for API2
 * @category DIDWW
 * @package API2
 * @copyright Copyright (C) 2012 by Igor Fedoronchuk
 * @license MIT
 */
class ApiCredentials extends Object
{
    /**
     * password(key) for API2 authorization
     * @var string
     */
    protected $password;

    /**
     * username for API2 authorization
     * @var string
     */
    protected $userName;

    /**
     * authstring for API2 methods calling
     * @var string
     */
    protected $authString;

    /**
     * test mode of API2 if true sandbox server is used
     * @var boolean
     */
    protected $testMode = false;

    /**
     * construct new credentials object
     * @param string $userName
     * @param string $password
     * @param boolean $testMode
     */
    function __construct($userName = NULL, $password = NULL, $testMode = false)
    {
        $this->userName = $userName;
        $this->password = $password;
        $this->testMode = $testMode;
    }

    /**
     * get testMode property
     * @return boolean
     */
    public function getTestMode()
    {
        return $this->testMode;
    }

    /**
     * set  testMode property
     * @param boolean $testMode
     */
    public function setTestMode($testMode)
    {
        $this->testMode = $testMode;
    }

    /**
     * get authString property (generate it if undefined)
     * @return string
     */
    function getAuthString()
    {
        if (!$this->authString) {
            $this->generateAuthString();
        }
        return $this->authString;
    }

    /**
     * get password property
     * @return string
     */
    function getPassword()
    {
        return $this->password;
    }

    /**
     * set password property
     * @param string $password
     */
    function setPassword($password)
    {
        $this->resetProperty('password', $password);
    }

    /**
     * get userName property
     * @return string
     */
    function getUserName()
    {
        return $this->userName;
    }

    /**
     * set userName property
     * @param string $userName
     */
    function setUserName($userName)
    {
        $this->resetProperty('userName', $userName);
    }

    /**
     * magic __toString implementation return authString
     * @return string
     */
    function __toString()
    {
        return $this->getAuthString();
    }

    /**
     * reset property and clean up authString
     * @param string $name
     * @param mixed $value
     */
    protected function resetProperty($name, $value)
    {
        $this->{$name} = $value;
        $this->authString = null;
    }

    /**
     * method to generate authString property from userName and password properties
     * @throws ApiCredentialsException
     * @see http://open.didww.com/index.php/Authentication_Key
     */
    protected function generateAuthString()
    {
        if (empty($this->password) || empty($this->userName)) {
            throw new ApiCredentialsException(" Undefined userName and/or password ");
        }

        $this->authString = $this->getTestMode() ? sha1($this->userName . $this->password . 'sandbox') : sha1($this->userName . $this->password);
    }

}

/**
 * ApiCredentialsException
 * Exception for class ApiCredentials
 * @category DIDWW
 * @package API2
 * @copyright Copyright (C) 2012 by Igor Fedoronchuk
 * @license MIT
 */
class ApiCredentialsException extends BaseException
{
}