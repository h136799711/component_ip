<?php
/**
 * 注意：本内容仅限于博也公司内部传阅,禁止外泄以及用于其他的商业目的
 * @author    hebidu<346551990@qq.com>
 * @copyright 2017 www.itboye.com Boye Inc. All rights reserved.
 * @link      http://www.itboye.com/
 * @license   http://www.opensource.org/licenses/mit-license.php MIT License
 * Revision History Version
 ********1.0.0********************
 * file created @ 2017-10-26 14:43
 *********************************
 ********1.0.1********************
 *
 *********************************
 */

namespace by\component\mq\core;

use by\component\mq\interfaces\ExchangeInterface;

/**
 * Class Exchange
 * 交换机
 * @package by\component\mq\core
 */
class Exchange implements ExchangeInterface
{

    private $name;
    private $exchangeType;
    private $passive = false;
    private $durable = false;
    private $autoDelete = true;
    private $internal = false;
    private $nowait = false;
    private $arguments = null;
    private $ticket = null;

    public function __construct($name, $exchangeType)
    {
        $this->setName($name);
        $this->setExchangeType($exchangeType);
    }


    // getter setter

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getExchangeType()
    {
        return $this->exchangeType;
    }

    /**
     * @param mixed $exchangeType
     */
    public function setExchangeType($exchangeType)
    {
        $this->exchangeType = $exchangeType;
    }

    /**
     * @return bool
     */
    public function isPassive()
    {
        return $this->passive;
    }

    /**
     * @param bool $passive
     */
    public function setPassive($passive)
    {
        $this->passive = $passive;
    }

    /**
     * @return bool
     */
    public function isDurable()
    {
        return $this->durable;
    }

    /**
     * @param bool $durable
     */
    public function setDurable($durable)
    {
        $this->durable = $durable;
    }

    /**
     * @return bool
     */
    public function isAutoDelete()
    {
        return $this->autoDelete;
    }

    /**
     * @param bool $autoDelete
     */
    public function setAutoDelete($autoDelete)
    {
        $this->autoDelete = $autoDelete;
    }

    /**
     * @return bool
     */
    public function isInternal()
    {
        return $this->internal;
    }

    /**
     * @param bool $internal
     */
    public function setInternal($internal)
    {
        $this->internal = $internal;
    }

    /**
     * @return bool
     */
    public function isNowait()
    {
        return $this->nowait;
    }

    /**
     * @param bool $nowait
     */
    public function setNowait($nowait)
    {
        $this->nowait = $nowait;
    }

    /**
     * @return null
     */
    public function getArguments()
    {
        return $this->arguments;
    }

    /**
     * @param null $arguments
     */
    public function setArguments($arguments)
    {
        $this->arguments = $arguments;
    }

    /**
     * @return null
     */
    public function getTicket()
    {
        return $this->ticket;
    }

    /**
     * @param null $ticket
     */
    public function setTicket($ticket)
    {
        $this->ticket = $ticket;
    }

}