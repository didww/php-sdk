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
 * Balance
 * Class that wraps customer's balance operations
 * @category DIDWW
 * @package API2
 * @copyright Copyright (C) 2012 by Igor Fedoronchuk
 * @license MIT
 */
class Balance extends ServerObject
{
    /**
     *operation to remove funds
     */
    const OP_REMOVE = 2;

    /**
     *operation to add funds
     */
    const OP_ADD = 1;

    /**
     * customer id
     * @var int
     */
    protected $customerId = null;

    /**
     * current customer balance value
     * @var float
     */
    protected $prepaidBalance = null;

    /**
     * Unique string to avoid duplicated transaction
     * must be 32 symbols length (use md5)
     * @var string
     */
    protected $_transactionId = null;

    /**
     * value of funds for operation
     * @var float
     */
    protected $_funds = null;

    /**
     * method to return list of all balances from API
     * @return array
     */
    protected static function _getAllBalances()
    {
        $result = self::getClientInstance()->call('getprepaidbalancelist', array(
            "customer_id" => '0'
        ));
        $resellerSubAccount = (object)array('customer_id' => '0', 'prepaid_balance_amount' => '0.0000'); // 0 - is reseller's sub account
        array_unshift($result, $resellerSubAccount);
        return $result;
    }

    /**
     * method to return list of all balances indexed by customer id
     * @link http://open.didww.com/index.php/16._Get_Prepaid_Balance_List
     * @todo change name to getArray
     * @return array
     */
    public static function getBalanceArray()
    {
        $balances = array();
        foreach (self::_getAllBalances() as $value) {
            $balances[$value->customer_id] = $value->prepaid_balance_amount;
        }
        return $balances;
    }


    /**
     * method to return list of DidwwBalance objects from API
     * @link http://open.didww.com/index.php/16._Get_Prepaid_Balance_List
     * @todo change name to getList
     * @return array
     */
    public static function getBalanceList()
    {
        $balances = array();
        foreach (self::_getAllBalances() as $value) {
            $value = (array)$value;
            unset($value['result']);
            unset($value['error']);
            $balance = new Balance(array("prepaid_balance" => $value['prepaid_balance_amount'], "customer_id" => $value["customer_id"]));
            $balances[$value['customer_id']] = $balance;
        }
        return $balances;
    }


    /**
     * set prepaidBalance property
     * @param float $value
     */
    public function setPrepaidBalance($value)
    {
        $this->prepaidBalance = $value;
    }

    /**
     * get customerId property
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
        $this->customerId = $customerId;
    }

    /**
     * get prepaidBalance property
     * @return int
     */
    public function getPrepaidBalance()
    {
        return $this->prepaidBalance;
    }

    /**
     * method to remove funds from customer balance
     * @param float $funds
     * @param string $transactionId md5 hash of transaction to avoid duplications
     * @return Balance
     */
    function removeFunds($funds, $transactionId = NULL)
    {
        return $this->changeBalance(abs($funds) * -1, $transactionId);
    }

    /**
     * method to add funds to customer balance
     * @param float $funds
     * @param string $transactionId md5 hash of transaction to avoid duplications
     * @return Balance
     */
    function addFunds($funds, $transactionId = NULL)
    {
        return $this->changeBalance(abs($funds), $transactionId);
    }

    /**
     * method to change customer balance with funds value
     * @link http://open.didww.com/index.php/10._Update_Prepaid_Balance
     * @param float $funds
     * @param string $transactionId d5 hash of transaction to avoid duplications
     * @return Balance
     * @throws BalanceException
     */
    function changeBalance($funds, $transactionId = NULL)
    {
        if (!$this->getCustomerId() > 0) {
            throw new BalanceException("Customer is invalid");
        }

        if (!(is_numeric($funds))) {
            throw new BalanceException("Funds value is invalid");
        }

        $this->_funds = $funds;
        $this->_transactionId = ($transactionId ? $transactionId : $this->generateTransactionId());


        if (!is_string($this->_transactionId) || strlen($this->_transactionId) != 32) {
            throw new BalanceException(" TransactionId value is invalid");
        }

        $response = $this->call('updateprepaidbalance', array(
            "customer_id" => $this->getCustomerId(),
            "prepaid_funds" => $this->_funds,
            "operation_type" => ($this->_funds > 0) ? self::OP_ADD : self::OP_REMOVE,
            "uniq_hash" => $this->_transactionId
        ));
        //set prepaid balance value

        $this->setPrepaidBalance($response['prepaid_balance']);
        return $this;
    }

    function getBilledServices()
    {
        $customer_id = $this->getCustomerId();
        if (!isset($customer_id)) {
            throw new BalanceException("Customer Id is undefined");
        }
        $response = $this->call('getservicelist', array(
            "customer_id" => $this->getCustomerId()
        ));
        $orders = array();
        if (count($response)) {
            foreach ($response as $serviceData) {
                $order = new \Didww\API2\Order();
                $order->setCustomerId($this->getCustomerId());
                $order->fromServiceData($serviceData);
                $orders[] = $order;
            }

        }
        return $orders;
    }

    /**
     * method to set current value of customer balance from API
     * @link http://open.didww.com/index.php/9._Get_Prepaid_Balance
     * @return Balance
     */
    function synchronizePrepaidBalance()
    {
        if (!$this->getCustomerId()) {
            throw new BalanceException("Customer Id is undefined");
        }

        $response = $this->call('getprepaidbalance', array(
            "customer_id" => $this->getCustomerId()
        ));

        $this->setPrepaidBalance($response['prepaid_balance']);
        return $this;
    }

    /**
     * generate unique md5 transaction string
     * @return string
     */
    protected function generateTransactionId()
    {
        return md5($this->customerId . "." . $this->_funds . "." . gmdate("YmdHis"));
    }

}


/**
 * BalanceException
 * Exception for class Balance
 * @category DIDWW
 * @package API2
 * @copyright Copyright (C) 2012 by Igor Fedoronchuk
 * @license MIT
 */
class BalanceException extends BaseException
{
}