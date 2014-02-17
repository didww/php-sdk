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
 * TollFree
 *
 * @category DIDWW
 * @package API2
 * @copyright Copyright (C) 2012 by Igor Gonchar
 * @license MIT
 */
class TollFree extends ServerObject
{
    /**
     * source prefix
     * @var string
     */
    protected $srcPrefix = NULL;

    /**
     * destination prefix
     * @var string
     */
    protected $dstPrefix = NULL;

    /**
     * rate per minute in usd
     * @var float
     */
    protected $rate = NULL;

    /**
     * connect fee in usd
     * @var float
     */
    protected $connectFee = NULL;

    /**
     * is reject call
     * @var bool
     */
    protected $rejectCalls = NULL;

    /**
     * get $srcPrefix property
     * @return string
     */
    public function getSrcPrefix()
    {
        return $this->srcPrefix;
    }

    /**
     * set $srcPrefix property
     * @param string $srcPrefix
     */
    public function setSrcPrefix($srcPrefix)
    {
        $this->srcPrefix = $srcPrefix;
    }

    /**
     * get $dstPrefix property
     * @return string
     */
    public function getDstPrefix()
    {
        return $this->dstPrefix;
    }

    /**
     * set $dstPrefix property
     * @param string $dstPrefix
     */
    public function setDstPrefix($dstPrefix)
    {
        $this->dstPrefix = $dstPrefix;
    }

    /**
     * get $rate property
     * @return float
     */
    public function getRate()
    {
        return $this->rate;
    }

    /**
     * set $rate property
     * @param float $rate
     */
    public function setRate($rate)
    {
        $this->rate = $rate;
    }

    /**
     * get $connectFee property
     * @return float
     */
    public function getConnectFee()
    {
        return $this->connectFee;
    }

    /**
     * set $connectFee property
     * @param float $connectFee
     */
    public function setConnectFee($connectFee)
    {
        $this->connectFee = $connectFee;
    }

    /**
     * get $rejectCalls property
     * @return bool
     */
    public function getRejectCalls()
    {
        return $this->rejectCalls;
    }

    /**
     * set $rejectCalls property
     * @param float $rejectCalls
     */
    public function setRejectCalls($rejectCalls)
    {
        $this->rejectCalls = (bool)$rejectCalls;
    }

    /**
     * get collection of toll free
     * @return array
     */

    public static function getAll()
    {
        return self::getClientInstance()->call("get_toll_free_data");
    }

    /**
     * update toll free rates from simple array
     * @param array $array
     */
    public static function updateRatesFromArray($array = array())
    {

        self::getClientInstance()->call('update_toll_free_data', array("rates" => $array));
    }

}

/**
 * TollFreeException
 *
 * @category DIDWW
 * @package API2
 * @copyright Copyright (C) 2012 by Igor Fedoronchuk
 * @license MIT
 */
class TollFreeException extends BaseException
{
}