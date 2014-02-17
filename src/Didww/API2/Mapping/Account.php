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
 * Account
 *
 * @category DIDWW
 * @package API2
 * @copyright Copyright (C) 2012 by Igor Fedoronchuk
 * @license MIT
 */

abstract class Account extends \Didww\API2\Mapping
{
    /**
     * The class constructor
     * @param string $account
     */
    function __construct($account = NULL)
    {
        $this->mapProto = 0;
        $this->setAccount($account);
        parent::__construct();
    }

    /**
     * set account of  mapping
     * @see Mapping::setMapDetail()
     * @param string $account
     */
    function  setAccount($account)
    {
        $this->setMapDetail($account);
    }

    /**
     * get account of mapping
     * @see Mapping::getMapDetail()
     * @return string
     */
    function getAccount()
    {
        return $this->mapDetail;
    }

}

