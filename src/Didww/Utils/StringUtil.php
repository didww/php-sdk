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
 * @package Utils
 * @copyright Copyright (C) 2012 by Igor Fedoronchuk
 * @license MIT
 */


namespace Didww\Utils;

/**
 * StringUtil
 *
 * @category DIDWW
 * @package Utils
 * @author Fedoronchuk Igor <fedoronchuk@gmail.com>
 * @copyright Copyright (C) 2012 by Igor Fedoronchuk
 * @license MIT
 */

class StringUtil
{
    /**
     * Camelize (or Pascalize) a string
     *
     * @example <code>\Didww\Utils\StringUtil::camelCase('my_database_field', true);// => MyDatabaseField</code>
     *
     * @param string $string The string to camelize
     * @param boolean $lcfirst [optional] First char must be lowercase ? Default is false
     * @return string           Camelized string
     */
    public static function camelCase($string, $lcfirst = true)
    {
        if ($lcfirst) return lcfirst(preg_replace_callback(array(
                        '/_(.?)/'
                    ), function ($matches) { return strtoupper($matches[1]); }, $string));
        return ucfirst(preg_replace_callback(array(
                        '(?:^|_)(.?)/'
                    ), function ($matches) { return strtoupper($matches[1]); }, $string));
    }

    /**
     * Convert a camel cased or pascal cased string to a snake cased string (with _ for separator)
     *
     * @example <code>\Didww\Utils\StringUtil::snakeCase('myDatabaseField');// => my_database_field</code>
     *
     * @param string $string The string to snake case
     * @return string           Snake cased string
     */
    public static function snakeCase($string)
    {
        return ltrim(strtolower(preg_replace('/([A-Z])/', '_$1', $string)), '_');
    }


}
