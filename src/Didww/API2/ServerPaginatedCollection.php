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
 * ServerPaginatedCollection
 *
 * @category DIDWW
 * @package API2
 * @copyright Copyright (C) 2012 by Igor Fedoronchuk
 * @license MIT
 */
abstract class ServerPaginatedCollection extends ServerObject implements \ArrayAccess, \Countable, \Iterator
{
    /**
     * ascending orderings
     */

    const ORDER_ASC = "ASC";

    /**
     * descending property
     */
    const ORDER_DESC = "DESC";

    /**
     * total cdr count
     * @var int
     */
    protected $total = 0;

    /**
     * limit of _cdrList collection length
     * @var int
     */
    protected $limit = 50;

    /**
     * offset of _cdrList collection
     * @var int
     */
    protected $offset = 0;

    /**
     * property for odering by
     * @var string
     */
    protected $orderBy = null;

    /**
     *  order direction
     * @var string
     */
    protected $orderDir = "DESC";

    /**
     * collection of cdr
     * @var array
     */
    protected $_list = array();

    /**
     * flag if was loaded from API
     * @var bool
     */
    protected $_loaded = false;

    /**
     * filter by customerId
     * @var int
     */
    protected $customerId = null;

    /**
     * filter by fromDate
     * @var string
     */
    protected $fromDate = null;

    /**
     * filter by toDate
     * @var string
     */
    protected $toDate = null;

    /**
     * get _loaded property
     * @return bool
     */
    public function isLoaded()
    {
        return $this->_loaded;
    }

    /**
     * get limit property
     * @return int
     */
    public function getLimit()
    {
        return $this->limit;
    }

    /**
     * get total property
     * @return int
     */
    public function getTotal()
    {
        return $this->total;
    }

    /**
     * set total property
     * @param int $total
     */
    public function setTotal($total)
    {
        $this->total = $total;
    }

    /**
     * set limit property
     * @param int $limit
     */
    public function setLimit($limit)
    {
        $this->limit = (int)$limit;
    }

    /**
     * get offset property
     * @return int
     */
    public function getOffset()
    {
        return $this->offset;
    }

    /**
     * set offset property
     * @param int $offset
     */
    public function setOffset($offset)
    {
        $this->offset = (int)$offset;
    }

    /**
     * get orderBy propery
     * @return string
     */
    public function getOrderBy()
    {
        return $this->orderBy;
    }

    /**
     * set orderBy property
     * @param string $orderBy
     */
    public function setOrderBy($orderBy)
    {
        $this->order = $orderBy;
    }

    /**
     * get orderDir property
     * @return string
     */
    public function getOrderDir()
    {
        return $this->orderDir;
    }

    /**
     * set orderDir property
     * @param string $orderDir
     * @throws CDRCollectionException
     */
    public function setOrderDir($orderDir = CDRCollection::ORDER_ASC)
    {
        if ($orderDir != self::ORDER_ASC && $orderDir != self::ORDER_DESC) {
            throw new CDRCollectionException("Unknown order direction");
        }
        $this->orderDir = $orderDir;
    }

    /**
     * set order direction to ascending
     */
    public function setOrderDirASC()
    {
        $this->orderDir = "ASC";
    }

    /**
     * set order direction to descending
     */
    public function setOrderDirDESC()
    {
        $this->orderDir = "DESC";
    }

    /**
     * get customerId proeprty
     * @return int
     */
    public function getCustomerId()
    {
        return $this->customerId;
    }

    /**
     * set customerId property
     * @param int $customerId
     */
    public function setCustomerId($customerId)
    {
        $this->customerId = (int)$customerId;
    }

    /**
     * get fromDate property
     * @return string
     */
    public function getFromDate()
    {
        return $this->fromDate;
    }

    /**
     * set fromDate property
     * @param string $fromDate
     */
    public function setFromDate($fromDate)
    {
        $this->fromDate = $fromDate;
    }

    /**
     * get toDate property
     * @return string
     */
    public function getToDate()
    {
        return $this->toDate;
    }

    /**
     * set toDate property
     * @param string $toDate
     */
    public function setToDate($toDate)
    {
        $this->toDate = $toDate;
    }

    /**
     * get data set of collection
     * @return array
     */
    public function getList()
    {
        if (!$this->_loaded) {
            $this->load();
            $this->_loaded = true;
        }
        return $this->_list;
    }

    /**
     * load collection from API2
     */
    public function load()
    {


        $response = $this->call($this->getMethod(), $this->getArgs());
        $this->_list = array();
        $key = $this->getResponseKey();
        foreach ($response[$key] as $value) {

            $this->appendToList($value);
        }

        $this->setLimit($response['pagination']->limit);
        $this->setOffset($response['pagination']->offset);
        $this->setTotal($response['pagination']->total);
    }

    /**
     * API method for loading dataset
     */
    protected abstract function getMethod();

    /**
     * API arguments for loading dataset
     */
    protected abstract function getArgs();

    /**
     * Class name for binding dataset elements
     */
    protected abstract function getCollectionType();

    /**
     * key in response data for loading collection
     */
    protected abstract function getResponseKey();

    /**
     * method to add element to result collection
     * @param stdClass $value
     */
    protected abstract function appendToList($value);

    /*
     * Countable Interface implementation
     */

    /**
     * Countable::count()
     * @see Countable::count()
     *
     */
    public function count()
    {
        return count($this->_cdrList);
    }

    /*
     * ArrayAccess Interface implementation
     * ArrayAccess::offsetSet
     * @see ArrayAccess::offsetSet
     * @param mixed $offset
     * @param mixed $value
     */
    public function offsetSet($offset, $value)
    {
        $type = $this->getCollectionType();
        if (!$value instanceof $type) {
            throw new ServerPaginatedCollectionExceptoin("$type expected but type " .
                \Didww\Utils\Util::getType($value) .
                " found");
        }
        if (is_null($offset)) {
            $this->_list[] = $value;
        } else {
            $this->_list[$offset] = $value;
        }
    }

    /**
     * ArrayAccess::offsetExists
     * @see ArrayAccess::offsetExists
     * @param mixed $offset
     */
    public function offsetExists($offset)
    {
        return isset($this->_list[$offset]);
    }

    /**
     * ArrayAccess::offsetUnset
     * @see ArrayAccess::offsetUnset
     * @param mixed $offset
     */
    public function offsetUnset($offset)
    {
        unset($this->_list[$offset]);
    }

    /**
     * ArrayAccess::offsetGet
     * @see ArrayAccess::offsetGet
     * @param mixed $offset
     */
    public function offsetGet($offset)
    {
        return isset($this->_list[$offset]) ? $this->_list[$offset] : null;
    }

    /*
     * Iterator implementation
     * 
     */

    /**
     * Iterator::rewind
     * @see Iterator::rewind
     */
    public function rewind()
    {
        reset($this->_list);
    }

    /**
     * Iterator::current
     * @see Iterator::current
     */
    public function current()
    {
        return current($this->_list);
    }

    /**
     * Iterator::key
     * @see Iterator::key
     */
    public function key()
    {
        return key($this->_list);
    }

    /**
     * Iterator::next
     * @see Iterator::next
     */
    public function next()
    {
        return next($this->_list);
    }

    /**
     * Iterator::valid
     * @see Iterator::valid
     */
    public function valid()
    {
        return $this->current() !== false;
    }

}

/**
 * ServerPaginatedCollectionExceptoin
 * Exception for class CDRCollection
 * @category DIDWW
 * @package API2
 * @copyright Copyright (C) 2012 by Igor Fedoronchuk
 * @license MIT
 */
class ServerPaginatedCollectionExceptoin extends BaseException
{

}

