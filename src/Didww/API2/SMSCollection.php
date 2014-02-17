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
 * @author Gonchar Igor <gigorok@gmail.com>
 * @copyright Copyright (C) 2012 by Igor Fedoronchuk
 * @license MIT
 */

namespace Didww\API2;

/**
 * CDRCollection
 * wraps collection of cdrs from API2 for per-page navigation
 * @category DIDWW
 * @package API2
 * @copyright Copyright (C) 2012 by Igor Fedoronchuk
 * @license MIT
 */
class SMSCollection extends ServerPaginatedCollection
{

    /**
     * filter by success argument
     * @var string
     */
    protected $success = null;

    /**
     * filter by destination
     * @var string
     */
    protected $destination = null;

    /**
     * filter by source
     * @var string
     */
    protected $source = null;

    /**
     * get success property
     * @return string
     */
    public function getSuccess()
    {
        return $this->success;
    }

    /**
     * set success property
     * @param string $success
     */
    public function setSuccess($success)
    {
        $this->success = (bool)$success;
    }


    /**
     *get $destination property
     * @return string
     */
    public function getDestination()
    {
        return $this->destination;
    }


    /**
     *get $destination property
     * @param string $destination
     */
    public function setDestination($destination)
    {
        $this->destination = $destination;
    }

    /**
     *get $source property
     * @return string
     */
    public function getSource()
    {
        return $this->source;
    }

    /**
     *get $source property
     * @param string $source
     */
    public function setSource($source)
    {
        $this->source = $source;
    }

    /**
     * get method for smslog
     * @return string
     */
    protected function getMethod()
    {
        return "getsmslog";
    }

    /**
     *get arguments for smslog method
     * @return array
     */
    protected function getArgs()
    {

        return array(
            'customer_id' => $this->getCustomerId(),
            'from_date' => $this->getFromDate(),
            'to_date' => $this->getToDate(),
            'destination' => $this->getDestination(),
            'source' => $this->getSource(),
            'success' => $this->getSuccess(),
            'limit' => $this->getLimit(),
            'offset' => $this->getOffset(),
            'order' => $this->getOrderBy(),
            'order_Dir' => $this->getOrderDir(),
        );
    }

    /**
     * get type of collection
     * @return string
     */
    protected function getCollectionType()
    {
        return 'Didww\API2\SMS';
    }

    /**
     *get key of response
     * @return string
     */
    protected function getResponseKey()
    {
        return "smslist";
    }

    /**
     * add element to list
     * @param stdObject $value
     */
    protected function appendToList($value)
    {
        $this->_list[] = new SMS((array)$value);
    }

}

/**
 * SMSCollectionException
 * Exception for class SMSCollection
 * @category DIDWW
 * @package API2
 * @copyright Copyright (C) 2012 by Igor Fedoronchuk
 * @license MIT
 */
class SMSCollectionException extends BaseException
{

}

