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
 * @author Igor Fedoronchuk<fedoronchuk@gmail.com>
 * @copyright Copyright (C) 2012 by Igor Fedoronchuk
 * @license MIT
 */

namespace Didww\API2;


/**
 * SMS
 * Class that wraps SMS data
 * @category DIDWW
 * @package API2
 * @copyright Copyright (C) 2012 by Igor Fedoronchuk
 * @license MIT
 */
class SMS extends PaidForItem
{

    /**
     * success property
     * @var bool
     */
    protected $success;

    /**
     *set success property
     * @return bool
     */
    public function getSuccess()
    {
        return $this->success;
    }

    /**
     * get success property
     * @param bool $success
     */
    public function setSuccess($success)
    {
        $this->success = (bool)$success;
    }


}