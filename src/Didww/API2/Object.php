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
 * @copyright Copyright (C) 2012 by Igor Fedoronchuk and Igor Gonchar
 * @license MIT
 */

namespace Didww\API2;

/**
 * Object
 *
 * @category DIDWW
 * @package API2
 * @copyright Copyright (C) 2012 by Igor Fedoronchuk and Igor Gonchar
 * @license MIT
 */
abstract class Object implements \Didww\Utils\ArrayTransform
{
    /**
     * if property doesn't exist - raise notice
     * @const  ASSIGN_STRICT
     */
    const ASSIGN_STRICT = 0;

    /**
     * if property doesn't exist -  create it
     * @const  ASSIGN_CREATE
     */
    const ASSIGN_CREATE = 1;

    /**
     * if property doesn't exist -  do nothing
     * @const  ASSIGN_IGNORE
     */
    const ASSIGN_IGNORE = 2;

    /**
     * type of assign to  use in fromArray method
     * @var int
     */
    private $_assignType = self::ASSIGN_STRICT;

    /**
     * load object properties from array
     * @param array $array
     * @return array unused array elements
     *
     */
    public function fromArray($array)
    {
        $result = array();
        foreach ($array as $key => $value) {
            $property = \Didww\Utils\String::camelCase($key);

            $setter = "set" . ucfirst($property);

            if (method_exists($this, $setter)) {
                $this->{$setter}($value);
                continue;
            }

            if (property_exists($this, $property)) {
                $this->{$property} = $value;
                continue;
            }


            if (self::ASSIGN_CREATE == $this->_assignType) {
                $this->{$property} = $value;
                continue;
            }
            $result[$property] = $value;
            if (self::ASSIGN_STRICT == $this->_assignType) {
                trigger_error("Property is undefined: $property");
            }
        }
        return $result;

    }

    /**
     * convert object to flat array
     * @param array $options
     * @return array
     */
    public function toFlatList($options = array())
    {
        return \Didww\Utils\ArrayUtils::flatten($this->toArray($options));
    }

    /**
     *
     * load object properties from flat array
     * by default use fromArray otherwise should be overriden
     * @param array $array
     */
    public function fromFlatList($array)
    {
        $this->fromArray($array);
    }

    /**
     * convert object to array with snaked keys
     * @param array $options
     * @return array
     */
    public function toArray($options = array())
    {
        $result = array();
        foreach (get_object_vars($this) as $key => $value) {
            if ($key[0] == '_') {
                continue;
            }
            if ($value instanceof Object) {
                $value = $value->toArray($options);
            }
            $result[\Didww\Utils\String::snakeCase($key)] = $value;
        }
        return $result;
    }

    /**
     * Class constructor
     * @param array $args array of properties
     */
    function __construct(array $args = array())
    {
        $this->fromArray($args);
    }

    /**
     * magic string
     * @return string
     */
    function __toString()
    {
        return print_r($this, true);
    }

    /**
     * set assign type
     * @param int $type
     */
    function setAssignType($type)
    {
        $this->_assignType = $type;
    }

    /**
     * get current assign type
     * return int
     */
    function getAssignType()
    {
        $this->_assignType;
    }

}

 