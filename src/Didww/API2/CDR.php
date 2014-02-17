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
 * @author Igor Fedoronchuk <fedoronchuk@gmail.com>
 * @copyright Copyright (C) 2012 by Igor Fedoronchuk
 * @license MIT
 */

namespace Didww\API2;

/**
 * CDR
 * Class that wraps CDR array
 * @category DIDWW
 * @package API2
 * @copyright Copyright (C) 2012 by Igor Fedoronchuk
 * @license MIT
 */
class CDR extends PaidForItem
{
    /**
     * status of CDR
     * @var string
     */
    protected $status = null;

    /**
     * duration of call
     * @var int
     */
    protected $duration = null;

    /**
     * callerId of CDR
     * @var string
     */

    protected $callerId = null;

    /**
     * get status property
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * set status property
     * @param string $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }

    /**
     * get duration property
     * @return int
     */
    public function getDuration()
    {
        return $this->duration;
    }

    /**
     * set duration property
     * @param int $duration
     */
    public function setDuration($duration)
    {
        $this->duration = $duration;
    }

    /**
     * get reason property
     * @return string
     */
    public function getReason()
    {
        return $this->reason;
    }

    /**
     * set reason property
     * @param string $reason
     */
    public function setReason($reason)
    {
        $this->reason = $reason;
    }

    /**
     * get  $callerId property
     * @return string
     */
    public function getCallerId()
    {
        return $this->callerId;
    }

    /**
     * set $callerId property
     * @param string $callerId
     */
    public function setCallerId($callerId)
    {
        $this->callerId = $callerId;
    }

}